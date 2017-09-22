<?php
/**
 * CmsConfigCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsConfigCollection extends DinklyDataCollection
{
	public static function getSettings($db)
	{
		$config_settings = self::getAll($db);

		$output = array();
		if($config_settings != array())
		{
			foreach($config_settings as $setting)
			{
				$output[$setting->getSettingKey()] = $setting->getSettingValue();
			}
		}

		return $output;
	}
}

