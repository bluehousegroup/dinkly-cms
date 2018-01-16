<?php
/**
 * CmsAdminGroupPermissionCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsAdminGroupPermissionCollection extends DinklyDataCollection
{
	public static function getPermissionsByGroup($db = null, $group_id)
	{
		$peer_object = new CmsAdminGroupPermission();
		if($db == null) { $db = self::fetchDB(); }

		$query = $peer_object->getSelectQuery() . " where group_id = " . $db->quote($group_id);

		$group_perm_joins = self::getCollection($peer_object, $query, $db);

		if($group_perm_joins != array())
		{
			$perm_ids = array();
			foreach($group_perm_joins as $perm_join)
			{
				$perm_ids[] = $perm_join->getPermissionId();
			}

			$perms = CmsAdminPermissionCollection::getByArrayOfIds($db, $perm_ids);

			if($perms != array())
			{
				return $perms;
			}
		}
		
		return false;
	}
}

