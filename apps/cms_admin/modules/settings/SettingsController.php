<?php

class SettingsController extends Dinkly 
{
	public function __construct()
	{
		//Connect to primary database first
		DinklyDataConfig::setActiveConnection('super_admin');

		//Prep for messaging
		$this->good = null;
		$this->bad = null;

		//Not logged in, boot'em out
		if(!SiteAdminUser::isLoggedIn())
		{
			$this->loadModule('cms_admin', 'login', 'default', true);
			return false;
		}

		//Initialize site and connect to its database
		$this->site = new CustomerSite();
		$this->site->init($_SESSION['cms_admin']['customer_site_id']);
		$this->site->connectToSiteDb();

		//Get our settings
		$this->setting_keys = SettingKeyCollection::getKeys();
		$this->setting_values = SettingCollection::getAll(true);
	}


	public function setMessages($parameters)
	{
		if(isset($parameters['saved']))
		{
			$this->good[] = "Settings saved";
		}		
	}

	//A save funnel for each of the different sections of settings
	public function loadSaveSettings()
	{
		if(isset($_POST['posted']))
		{
			$settings = $_POST['settings'];
			$source = $_POST['source'];

			foreach($settings as $key => $value)
			{
				$setting = new Setting();
				$setting->initWithKey($key);
				$setting->setSettingValue($value);
				$setting->save();
			}

			SiteActivityLogCollection::addSiteActivity('settings', 'updated', json_encode($settings));

			$this->loadModule('cms_admin', 'settings', $source, true, true, array('saved' => true));
		}

		return false;
	}

	public function loadDefault()
	{
		//Redirect to general
		$this->loadModule('cms_admin', 'settings', 'general', true);

		return true;
	}

	public function loadGeneral($parameters)
	{
		$this->setMessages($parameters);

		return true;
	}

	public function loadAddress($parameters)
	{
		$this->setMessages($parameters);

		return true;
	}

	public function loadHours($parameters)
	{
		$this->setMessages($parameters);

		return true;
	}

	public function loadAnalytics($parameters)
	{
		$this->setMessages($parameters);

		return true;
	}

	public function loadSeo($parameters)
	{
		$this->setMessages($parameters);

		return true;
	}
}