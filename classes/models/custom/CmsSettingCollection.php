<?php
/**
 * CmsSettingCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsSettingCollection extends DinklyDataCollection
{
	public static function getAll($as_array = false)
	{
		$db = self::fetchDB();
		$peer_object = new CmsSetting;

		$results = self::getCollection($peer_object, $peer_object->getSelectQuery());

		if($results != array())
		{
			if($as_array)
			{
				//Initialize with empty set
				$settings = array();
				foreach(CmsSettingKeyCollection::getKeys() as $key => $value)
				{
					$settings[$key] = null;
				}

				foreach($results as $setting)
				{
					$settings[$setting->getSettingKey()] = $setting->getSettingValue();
				}
				return $settings;
			}
			else { return $results; }
		}
		else { return null; }
	}
}

