<?php
/**
 * CmsPageContentCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsPageContentCollection extends DinklyDataCollection
{
	public static function getAllByDetailId($page_detail_id, $revision = 0)
	{
		$db = self::fetchDB();
		$peer_object = new CmsPageContent;

		$query = $peer_object->getSelectQuery() . " where page_detail_id=" . $db->quote($page_detail_id);

		if($revision)
		{
			$query .= " and revision=" . $db->quote($revision);
		}

		return self::getCollection($peer_object, $query);
	}
}

