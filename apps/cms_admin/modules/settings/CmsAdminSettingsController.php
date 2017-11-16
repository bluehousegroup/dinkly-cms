<?php

class CmsAdminSettingsController extends CmsAdminController 
{
	public function __construct()
	{
		//Connect to primary database first
		DinklyDataConfig::setActiveConnection('super_admin');

		//Prep for messaging
		$this->good = null;
		$this->bad = null;

		//Get our settings
		$this->setting_keys = CmsSettingKeyCollection::getKeys();
		$this->setting_values = CmsSettingCollection::getAll(true);
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
				$setting = new CmsSetting();
				$setting->initWithKey($key);
				$setting->setSettingValue($value);
				$setting->save();
			}

			CmsActivityLogCollection::addSiteActivity('settings', 'updated', json_encode($settings));

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