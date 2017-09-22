<?php

class LoginController extends Dinkly
{
	public function loadDefault($parameters)
	{
		//Connect to primary database first
		DinklyDataConfig::setActiveConnection('super_admin');

		$this->domain_name = CustomerSite::getCurrentDomain();
		$this->site = new CustomerSite();
		$this->site->initWithCurrentDomain();

		//Prep for messaging
		$this->good = null;
		$this->bad = null;

		//Handle login post and attempt to authenticate
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['domain']))
		{
			$domain = $_POST['domain'];

			$site = new CustomerSite();
			$site->initWithCurrentDomain($domain);

			if(!SiteAdminUser::authenticate($_POST['username'], $_POST['password'], $site->getId()))
			{
				$parameters['bad_auth'] = true;
			}
		}

		//Sweet, they're logged in, send them on their way
		if(SiteAdminUser::isLoggedIn())
		{
			$this->loadModule('site_admin', 'home', 'default', true);
			return false;
		}

		//Connect to primary database first
		DinklyDataConfig::setActiveConnection('super_admin');

		$this->setMessages($parameters);

		return true;
	}

	public function loadLogout()
	{
		SiteAdminUser::logout();

		$this->loadModule('site_admin', 'login', 'default', true);

		return false;
	}

	public function setMessages($parameters)
	{
		if(isset($parameters['domain']))
		{
			$this->bad[] = 'No matching site.';
		}
		if(isset($parameters['bad_auth']))
		{
			$this->bad[] = 'Invalid login.';
		}
	}
}
