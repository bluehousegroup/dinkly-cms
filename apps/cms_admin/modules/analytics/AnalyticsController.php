<?php

class AnalyticsController extends SiteAdminController
{
	public function prettifyAnalytics($data)
	{
		$headers = array();
		foreach ($data['columnHeaders'] as $header)
		{
			$headers[] = ucwords(str_replace("ga:", "", $header['name']));
		}
		$return = array("headers" => $headers, "rows" => $data['rows']);
		return $return;
	}

	public function handleViews($views)
	{
		$this->visitors = array();
		$this->newVisitors = 0.0;
		$this->mobileVisits = 0.0;
	}

	public function getProfileId(&$analytics, $accountName, $siteUrl)
	{
		$accounts = $analytics->management_accounts->listManagementAccounts();

		// Find account (hard coded to "Fourtopper Accounts")
		if(count($accounts['items']) > 0)
		{
			$items = $accounts['items'];
			foreach($items as $item)
			{
				if($item['name'] == $accountName)
					$accountId = $item['id'];
			}

			if(!isset($accountId))
				throw new Exception("Account not found.");

			$webproperties = $analytics->management_webproperties
					->listManagementWebproperties($accountId);

			if(count($webproperties['items']) > 0)
			{
				$items = $webproperties['items'];
				$firstWebpropertyId = $items[0]['id'];

				$profiles = $analytics->management_profiles
						->listManagementProfiles($accountId, $firstWebpropertyId);

				//Get Site id
				if(count($profiles['items']) > 0)
				{
					$items = $profiles['items'];
					foreach($items as $item)
					{
						if($item['websiteUrl'] == $siteUrl)
							$siteId = $item['id'];
					}
					if(!isset($siteId))
						throw new Exception("Site: ".$siteUrl." not found.<br/>Is Google Analytics set up for this site?");
					else
						return $siteId;
				}
				else { throw new Exception('No profiles found for this user.'); }
			}
			else { throw new Exception('No webproperties found for this user.'); }
		}
		else { throw new Exception('No accounts found for this user.'); }
	}

	public function loadDefault($parameters)
	{
		//Set some default variables so notices won't get thrown
		$this->chart_months = $this->month_pageviews = $this->month_visitors = '';

		$client = CustomAnalytics::getClient();

		$analytics = new Google_AnalyticsService($client);
		try
		{
			//Init from DB
			if (($refreshToken = SocialMediaCollection::getContent("google_analytics", "access_token", true)) !== false)
			{
				$client->refreshToken($refreshToken['refresh_token']);
				//If not in DB
			}
			else
			{
				//Init from login
				//If returning from login
				if(isset($_GET['code']))
				{
					$client->authenticate();
					$_SESSION['token'] = $client->getAccessToken();
					// $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
					// header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
					$this->loadModule('cms_admin', 'analytics', 'default', true, true);
				}

				if(isset($_SESSION['token']))
				{
					$client->setAccessToken($_SESSION['token']);
				}

				//Display login
				$this->noAuth = $client->getAccessToken();

				//Save authentication to DB
				if($token = $client->getAccessToken())
				{
					$googleAuth = SocialMedia::construct("google_analytics", "access_token", $token);
					if ($googleAuth->save())
						$this->good[] = "Google Authentication saved.";
					else
						$this->bad[] = "Google Authentication not saved.";
				}
			}

			if ($client->getAccessToken())
			{
				// Create analytics service object. See next step below.
				$accounts = $analytics->management_accounts->listManagementAccounts();
				$siteUrl = "http://www.".$this->site->getDomain();
				$accountName = "Fourtopper Accounts";
				$profileId = $this->getProfileId($analytics, $accountName, $siteUrl);
				//ga:pagePath, //individual pages //, "segment" => "gaid::-11" // mobile only
				//ga:nthMonth,ga:isMobile,ga:city,ga:region,ga:source,ga:pagePath
				$date_start = '2012-02-01';
				$date_end = date("Y-m-d", time()); // Now
				$max_results = 5;
				$metrics = array();
				$dimensions = array();
				/*
				 * Location
				 */
				$metrics = 'ga:visits';
				$dimensions = "ga:city,ga:region";
				$sort = '-ga:visits';
				$this->locations = $analytics->data_ga->get(
						'ga:' . $profileId, $date_start, $date_end, $metrics, array("dimensions" => $dimensions, "sort" => $sort, 'max-results' => $max_results));
				$this->locations = $this->prettifyAnalytics($this->locations);
				/*
				 * Referrars
				 */
				$metrics = 'ga:visits';
				$dimensions = "ga:source";
				$sort = '-ga:visits';
				$this->referrers = $analytics->data_ga->get(
						'ga:' . $profileId, $date_start, $date_end, $metrics, array("dimensions" => $dimensions, "sort" => $sort, 'max-results' => $max_results));
				$this->referrers = $this->prettifyAnalytics($this->referrers);
				/*
				 * Top Content
				 */
				$metrics = 'ga:pageviews'; //'ga:visits,ga:pageviews';
				$dimensions = "ga:pagePath";
				$sort = '-ga:pageViews';
				$this->topContent = $analytics->data_ga->get(
						'ga:' . $profileId, $date_start, $date_end, $metrics, array("dimensions" => $dimensions, "sort" => $sort, 'max-results' => $max_results));
				$this->topContent = $this->prettifyAnalytics($this->topContent);
				/*
				 * Visit Info
				 */
				//all / new visitors
				//$metrics = 'ga:visits,ga:percentNewVisits';
				$metrics = 'ga:visits,ga:percentNewVisits';
				$dimensions = 'ga:isMobile';
				$sort = '-ga:visits';
				$visitors = $analytics->data_ga->get(
						'ga:' . $profileId, $date_start, $date_end, $metrics, array("sort" => $sort, 'dimensions' => $dimensions, 'max-results' => $max_results));
				$this->totalVisitors = $visitors['totalsForAllResults']['ga:visits'];
				$this->newVisitors = floor($visitors['totalsForAllResults']['ga:percentNewVisits']);
				$this->mobileVisitors = floor($visitors['rows'][1][2]);
				$this->siteUrl = $siteUrl;
				/*
				 * Page Views per day for six months
				 */
				$this->monthlyData = array();
				$metrics = 'ga:pageviews,ga:visitors'; //'ga:visits,ga:pageviews';
				$dimensions = "ga:month";
				//$sort = '-ga:pageViews';
				$this->monthlyData = $analytics->data_ga->get(
						'ga:' . $profileId, date("Y-m-d", strtotime("first day of -5 month")), $date_end, $metrics, array("dimensions" => $dimensions));
				$this->monthlyData = $this->prettifyAnalytics($this->monthlyData);

				//Assemble a cs string of the month abbreviations for the chart
				$this->month_pageviews = array(); $this->month_visitors = array();
				foreach($this->monthlyData['rows'] as $month_data)
				{
					$this->month_pageviews[] = $month_data[1];
					$this->month_visitors[] = $month_data[2];
				}
				$this->month_pageviews = implode(",", $this->month_pageviews);
				$this->month_visitors = implode(",", $this->month_visitors);

				//Assemble a cs string of the month abbreviations for the chart
				$first  = strtotime('first day this month');
				$months = array();
				for ($i = 5; $i >= 0; $i--) {
				  $months[] = '"'.date('M', strtotime("-$i month", $first)).'"';
				}
				$months = implode(",", $months);
				$this->chart_months =  $months;
			}
		}
		catch (Exception $e)
		{
			switch ($e->getCode())
			{
				case 0:
					$this->bad[] = $e->getMessage(); //"Google could not recognize authentication format.";
					break;
				case 403:
					$this->bad[] = "Your Gmail account does not appear to have any Google Analytics associated with it.<br />The account permissions may be wrong.";
					break;
				default:
					$this->bad[] = "There was an error accessing the Google Analytics account.";
					break;
			}
		}
		return true;
	}
}