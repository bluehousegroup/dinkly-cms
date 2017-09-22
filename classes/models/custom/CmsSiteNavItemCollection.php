<?php
/**
 * CmsSiteNavItemCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsSiteNavItemCollection extends DinklyDataCollection
{
	public static function getAll($db = null)
	{
		if($db == null) { $db = static::fetchDB(); }

		$peer_object = new CmsSiteNavItem();
		$query = $peer_object->getSelectQuery() . " order by position asc";
		
		return static::getCollection($peer_object, $query, $db);
	}

	public static function getStructure($is_draft = false)
	{
		$nav_items = self::getAll();

		$structure = array();

		if($nav_items != array())
		{
			foreach($nav_items as $item)
			{
				if($item->getPage($is_draft))
				{
					$structure[$item->getPosition()] = $item;
				}
			}

			ksort($structure);
		}

		return $structure;
	}

	public static function resetNav()
	{
		$db = self::fetchDB();
		$db->exec("truncate site_nav_item");
		return true;
	}

	public static function getHighestPosition()
	{
		$db = self::fetchDB();
		$peer_object = new SiteNavItem;

		$results = array();
		$query = $peer_object->getSelectQuery() . ' order by position desc limit 1';
		$results = self::getCollection($peer_object, $query);

		if($results != array())
		{
			return $results[0]->getPosition();
		}
	}
}

