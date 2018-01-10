<?php

class CmsAdminLoginController extends CmsAdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDefault($parameters = array())
	{
		//Handle login post and attempt to authenticate
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			if(!CmsAdminUser::authenticate($_POST['username'], $_POST['password']))
			{
				DinklyFlash::set('error', "We couldn't verify your username and password");
			}
		}

		//Sweet, they're logged in, send them on their way
		if(CmsAdminUser::isLoggedIn())
		{
			$this->loadModule('cms_admin', 'home', 'default', true);
			return false;
		}

		return true;
	}

	public function loadLogout()
	{
		CmsAdminUser::logout();

		$this->loadModule('cms_admin', 'login', 'default', true);

		return false;
	}
}
