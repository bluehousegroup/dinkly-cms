<?php
/**
 * CmsPageDetail
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsPageDetail extends BaseCmsPageDetail
{
	public function getCreatedAt($format = 'Y-m-d G:i:s')
	{
		return date($format, strtotime($this->CreatedAt));
	}

	public function genSlug($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text)) { return 'n-a'; }

	  return $text;
	}

	public function initAutosave($site_nav_item_id)
	{
		$query = $this->getSelectQuery() . " where site_nav_item_id=". $this->db->quote($site_nav_item_id) . " and is_autosave=1";

		$result = $this->db->query($query)->fetchAll();

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}

	public function initAutosaveWithSlug($slug)
	{
		$query = $this->getSelectQuery() . " where slug=". $this->db->quote($slug) . " and is_autosave=1";

		$result = $this->db->query($query)->fetchAll();

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}

	public function initWithSlug($slug, $revision = 0, $draft = false)
	{
		$Select = $this->getSelectQuery() . " where slug=". $this->db->quote($slug);

		if($revision)
		{
			$Select .= " and revision=" . $this->db->quote($revision);
		}
		else
		{
			if($draft)
			{
				$Select .= " and is_current_draft=1";
			}
			else { $Select .= " and is_current_live=1"; }
		}

		$query = $Select . ' and is_deleted=0';

		$result = $this->db->query($query)->fetchAll();

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}

	public function initWithNavId($site_nav_item_id, $revision = 0, $draft = false)
	{
		$Select = $this->getSelectQuery() . " where site_nav_item_id=". $this->db->quote($site_nav_item_id);

		if($revision)
		{
			$Select .= " and revision=" . $this->db->quote($revision);
		}
		else
		{
			if($draft)
			{
				$Select .= " and is_current_draft=1";
			}
			else { $Select .= " and is_current_live=1"; }
		}

		$Select .= ' and is_deleted=0';

		$result = $this->db->query($Select)->fetchAll();

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}
}