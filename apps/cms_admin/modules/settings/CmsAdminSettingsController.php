<?php

class CmsAdminSettingsController extends CmsAdminController 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDefault()
	{
		if($this->hasPostParam('source'))
		{
			$post = $this->fetchPostParams();

			foreach($post['settings'] as $key => $value)
			{
				$setting = new CmsSetting($this->db);
				$setting->initWithKey($key);
				$setting->setSettingValue($value);
				$setting->save();
			}

			CmsActivityLogCollection::addSiteActivity('settings', 'updated', json_encode($post['settings']));

			DinklyFlash::set('success', 'Settings updated');
		}

		//Get our settings
		$this->setting_keys = CmsSettingKeyCollection::getKeys();
		$this->setting_values = CmsSettingCollection::getAll(true);

		return true;
	}
}