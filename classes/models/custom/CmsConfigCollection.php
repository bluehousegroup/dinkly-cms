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
	public static function getSettings($db = null)
	{
		if($db == null) { $db = static::fetchDB(); }
		
		$config_settings = self::getAll($db);

		$output = array();
		if($config_settings != array())
		{
			foreach($config_settings as $setting)
			{
				$output[$setting->getSettingKey()] = $setting->getSettingValue();
			}
		}

		if(!isset($config_settings['site_custom_css']))
		{
			$output['site_custom_css'] = null;
		}

		return $output;
	}
}

