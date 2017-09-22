<?php
/**
 * CmsActivityLogCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsActivityLogCollection extends DinklyDataCollection
{
	public static function addSiteActivity($entry_type, $event, $data = '')
	{
		//Example: SiteActivityLogCollection::addSiteActivity('user', 'new', json_encode($array));
		$site_activity = new CmsActivityLog();
		$site_activity->setCreatedAt(date('Y-m-d H:i:s'));
		$site_activity->setEntryType($entry_type);
		$site_activity->setUserId($_SESSION['dinkly']['cms_admin']['logged_id_num']);
		$site_activity->setEvent($event);
		$site_activity->setData(json_encode($data));
		$site_activity->save();
	}

	public static function getRecent($db, $limit = 5)
	{
		$site_activity = array();
		
		$activity_log = new CmsActivityLog();

		$query = $activity_log->getSelectQuery() . " order by id desc limit " . $limit;

		$entries = static::getCollection($activity_log, $query, $db);

		//Make sure we've got activity to bother with
		if($entries != array())
		{
			$entries = array_reverse($entries);

			foreach($entries as $activity)
			{
				$site_activity[] = $activity;
			}
		}

		return $site_activity;
	}
}