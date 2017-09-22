<?php

class CmsAdminLoginController extends CmsAdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDefault($parameters)
	{
		//Handle login post and attempt to authenticate
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			if(!CmsAdminUser::authenticate($_POST['username'], $_POST['password']))
			{
				$parameters['bad_auth'] = true;
			}
		}

		//Sweet, they're logged in, send them on their way
		if(CmsAdminUser::isLoggedIn())
		{
			$this->loadModule('cms_admin', 'home', 'default', true);
			return false;
		}

		$this->setMessages($parameters);

		return true;
	}

	public function loadLogout()
	{
		CmsAdminUser::logout();

		$this->loadModule('cms_admin', 'login', 'default', true);

		return false;
	}

	public function setMessages($parameters)
	{
		if(isset($parameters['bad_auth']))
		{
			$this->bad[] = 'Invalid login.';
		}
	}
}
