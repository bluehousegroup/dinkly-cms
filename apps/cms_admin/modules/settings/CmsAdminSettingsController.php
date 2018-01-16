<?php

class CmsAdminSettingsController extends CmsAdminController 
{
	public function __construct()
	{
		parent::__construct();
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
		//Get our settings
		$this->setting_keys = CmsSettingKeyCollection::getKeys();
		$this->setting_values = CmsSettingCollection::getAll(true);

		return true;
	}
}