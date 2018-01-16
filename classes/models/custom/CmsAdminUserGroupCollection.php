<?php
/**
 * CmsAdminUserGroupCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsAdminUserGroupCollection extends DinklyDataCollection
{
	public static function getGroupsByUser($db = null, $user_id)
	{
		$peer_object = new CmsAdminUserGroup();
		if($db == null) { $db = self::fetchDB(); }

		$query = $peer_object->getSelectQuery() . " where user_id = " . $db->quote($user_id);

		$user_group_joins = self::getCollection($peer_object, $query, $db);

		if($user_group_joins != array())
		{
			$group_ids = array();
			foreach($user_group_joins as $group_join)
			{
				$group_ids[] = $group_join->getDinklyGroupId();
			}

			$groups = CmsAdminGroupCollection::getByArrayOfIds($db, $group_ids);

			if($groups != array())
			{
				return $groups;
			}
		}
		
		return false;
	}

	public static function getUsersByGroup($db = null, $group_id)
	{
		$peer_object = new CmsAdminUserGroup();
		if($db == null) { $db = self::fetchDB(); }

		$query = $peer_object->getSelectQuery() . " where group_id = " . $db->quote($group_id);

		$user_group_joins = self::getCollection($peer_object, $query, $db);

		if($user_group_joins != array())
		{
			$user_ids = array();
			foreach($user_group_joins as $group_join)
			{
				$user_ids[] = $group_join->getDinklyUserId();
			}

			$users = CmsAdminUserCollection::getByArrayOfIds($db, $user_ids);

			if($users != array())
			{
				return $users;
			}
		}
	}
}

