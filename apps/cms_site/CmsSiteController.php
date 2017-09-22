<?php
/**
 * CmsSiteController
 * 
 *
 * @package    Dinkly
 * @subpackage AppsCmsSiteController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */

class CmsSiteController extends Dinkly
{
	/**
	 * Default Constructor
	 * 
	 * @return bool: always returns true on successful construction of view
	 * 
	 */
	public function __construct()
	{
		$this->db = DinklyDataConnector::fetchDB();
		$this->settings = CmsConfigCollection::getSettings($this->db);
		$this->design = new CmsDesign($this->db);
		$this->structure = null;

		return true;
	}
}
