<?php
/**
 * CmsPageDetailCollection
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsPageDetailCollection extends DinklyDataCollection
{
	public static function deleteAutosaves($site_nav_item_id)
	{
		//Fetch all related content records and delete them, then delete the detail record
		$autosaves = self::getAutosaves($site_nav_item_id);
		if($autosaves != array())
		{
			foreach($autosaves as $a)
			{
				$content_records = CmsPageContentCollection::getAllByDetailId($a->getId());
				if($content_records != array())
				{
					foreach($content_records as $c)
					{
						$c->delete();
					}
				}

				$a->delete();
			}
		}

		return true;
	}

	public static function getAutosaves($site_nav_item_id)
	{
		$db = self::fetchDB();
		$peer_object = new CmsPageDetail;
		$select = "select * from cms_page_detail where site_nav_item_id=" . $db->quote($site_nav_item_id)
			. " and is_autosave=1";
		
		return self::getCollection($peer_object, $select);
	}

	public static function getHighestRevision($site_nav_item_id)
	{
		$db = self::fetchDB();
		$peer_object = new CmsPageDetail;

		$select = "select revision from cms_page_detail where site_nav_item_id=" 
		. $db->quote($site_nav_item_id) . " order by revision desc limit 1";
		$results = $db->query($select)->fetchAll();

		$highest_disabled_revision = 0;
		if($results != array())
		{
			return $results[0]['revision'];
		}
	}

	//Returns all disabled page details grouped by the highest shared revision number
	public static function getAllDisabledByHighestRevision()
	{
		$db = self::fetchDB();
		$peer_object = new CmsPageDetail;

		$select = "select revision from cms_page_detail where is_enabled=0 order by revision desc limit 1";
		$results = $db->query($select)->fetchAll();

		$highest_disabled_revision = 0;
		if($results != array())
		{
			$highest_disabled_revision = $results[0]['revision'];
		}

		$select = $peer_object->getSelectQuery() . " where is_enabled = 0 and revision = " . $db->quote($highest_disabled_revision);
		
		return self::getCollection($peer_object, $select);
	}

	public static function getAllRevisions($site_nav_item_id)
	{
		$db = self::fetchDB();
		$peer_object = new CmsPageDetail;

		$select = "select * from cms_page_detail where is_autosave=0 and site_nav_item_id="
			. $db->quote($site_nav_item_id) . " order by revision desc";

		$results = $db->query($select)->fetchAll();

		if($results != array())
		{
			return self::getCollection($peer_object, $select);
		}		
	}

	//Returns true if the slug exists for site
	public static function isDuplicateSlug($new_slug, $id = null)
	{
		$db = self::fetchDB();

		//Exclude the supplied id in case the slug wasn't changed
		$exclude= ""; $drafts_allowed = 0; $lives_allowed = 0;
		if($id)
		{ 
			$exclude = "AND id != $id";

			//Get ids record and increment draft and live allowed as needed
			$select = "SELECT * FROM cms_page_detail WHERE id=$id";
			$result = $db->query($select)->fetchAll();
			$ids_details = $result;
			if($ids_details[0]['is_current_draft'] == false) $drafts_allowed = 1;
			elseif($ids_details[0]['is_current_live'] == false) $lives_allowed = 1;
		}

		//Get all the draft and live slugs and loop through to see if it is a dupe
		$select = "SELECT * FROM cms_page_detail WHERE is_deleted=0 AND (is_current_draft=1 OR is_current_live=1) $exclude";
		$result = $db->query($select)->fetchAll();
		$slugs = $result;

		$found_slug = false; $drafts_found = 0;	$lives_found = 0;
		foreach($slugs as $slug)
		{
			if($slug['slug'] == $new_slug)
			{
				if(!$found_slug )
				{
					if($slug['is_current_draft']) $drafts_found++;

					if($slug['is_current_live']) $lives_found++;

					if($drafts_found > $drafts_allowed) $found_slug = true;
					elseif($lives_found > $lives_allowed) $found_slug = true;
				}
			}
		}

		return $found_slug; //returns true if is dup slug

	}
}