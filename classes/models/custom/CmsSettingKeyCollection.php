<?php

use Symfony\Component\Yaml\Yaml;

class CmsSettingKeyCollection
{
	public static function isValidKey($key)
	{
		if(!in_array($key, self::getKeys())) { return false; }
		else { return true; }
	}

	public static function getKeys()
	{
		$keys = Yaml::parse($_SERVER['APPLICATION_ROOT'].'config/setting_keys.yml');

		return $keys;
	}

	public static function getSocialKeys($withValues = false)
	{
		$keys = Yaml::parse($_SERVER['APPLICATION_ROOT'].'config/cms_setting_keys.yml');
		$socialKeys = array();

		foreach($keys as $key => $value)
		{
			if(substr($key, 0, strlen("social_")) == "social_")
			{
				if($withValues)
				{
					$setting = new CmsSetting();
					$setting->initWithKey($key);
					if(stristr($setting->SettingValue, "http"))
						$socialKeys[] = $key;
				}
				else
				{
					$socialKeys[] = $key;
				}
			}
		}

		return $socialKeys;
	}
}

