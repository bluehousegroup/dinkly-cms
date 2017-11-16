<?php

class CmsAdminUserController extends CmsAdminController
{
	public function loadKeepAlive()
	{
		echo 'refreshed';
		return false;
	}

	public function loadDelete($parameters = null)
	{
		if(isset($parameters['id']))
		{
			$user = new SiteAdminUser();
			$user->init($parameters['id']);
			$user->delete();

			SiteActivityLogCollection::addSiteActivity('user', 'deleted', $parameters['id']);

			$this->loadModule('cms_admin', 'user', 'default', true, true, array('deleted' => true));
			return false;
		}
		return false;
	}

	public function loadView($parameters = null)
	{
		if($parameters)
		{
			if(isset($parameters['created']))
			{
				$this->good[] = "User created";
			}

			if(isset($parameters['id']))
			{
				$this->user = new SiteAdminUser();
				$this->user->init($parameters['id']);
			}

			//User doesn't exist, therefore we do not belong here
			if($this->user->isNew())
			{
				$this->loadModule('cms_admin', 'user', 'default', true, true);
				return false;
			}

			if(isset($parameters['saved']))
			{
				$this->good[] = "User saved";
			}
		}

		return true;
	}

	public function loadNew()
	{
		if(isset($_POST['posted']))
		{
			//Validate
			if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL))
			{
			    $this->bad[] = "Invalid email address";
			}

			if(!SiteAdminUserCollection::isUniqueUsername($_POST['username']))
		    {
		    	$this->bad[] = "User already exists with that email address";
		    }

			if(strlen($_POST['password']) < 8)
			{
				$this->bad[] = "Password must be at least 8 characters";
			}

			//Good to go
			if(!$this->bad)
			{
				$user = new SiteAdminUser();
				$user->setCreatedAt(date('Y-m-d G:i:s'));
				$user->setUsername($_POST['username']);
				$user->setPassword($_POST['password']);
				$user->setFirstName($_POST['first_name']);
				$user->setLastName($_POST['last_name']);
				$user->setTitle($_POST['title']);
				$user->setIsActive(true);
				$user->save();

				SiteActivityLogCollection::addSiteActivity('user', 'new', json_encode($_POST));

				$this->loadModule('cms_admin', 'user', 'view', true, true, array('created' => true, 'id' => $user->getId()));
				return false;
			}
		}

		return true;
	}

	public function loadEdit($parameters)
	{
		if(!$parameters)
		{
			$this->loadModule('super_admin', 'user', 'default', true, true);
			return false;
		}

		$this->user = new SiteAdminUser();
		$this->user->init($parameters['id']);

		if(isset($_POST['posted']))
		{
			//Validate that shit
			if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL))
			{
			    $this->bad[] = "Invalid email address";
			}

			if(strlen($_POST['password']) < 8 && strlen($_POST['password']) > 1)
			{
				$this->bad[] = "Password must be at least 8 characters";
			}

			//Good to go
			if(!$this->bad)
			{
				$this->user->setUsername($_POST['username']);

				if(isset($_POST['password']))
				{
					$this->user->setPassword($_POST['password']);					
				}
				
				$this->user->setFirstName($_POST['first_name']);
				$this->user->setLastName($_POST['last_name']);
				$this->user->setTitle($_POST['title']);
				$this->user->setIsActive(true);
				$this->user->save();

				SiteActivityLogCollection::addSiteActivity('user', 'edited', json_encode($_POST));

				$this->loadModule('cms_admin', 'user', 'view', true, true, array('saved' => true, 'id' => $this->user->getId()));
			}
		}

		return true;
	}

	public function loadDefault($parameters = null)
	{
		$this->users = SiteAdminUserCollection::getAll();

		if(isset($parameters['deleted']))
		{
			$this->good[] = "User deleted";
		}

		return true;
	}
}