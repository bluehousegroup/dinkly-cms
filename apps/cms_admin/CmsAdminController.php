<?php
/**
 * CmsAdminController
 * 
 *
 * @package    Dinkly
 * @subpackage AppsCmsAdminController
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */

class CmsAdminController extends Dinkly
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

		//Prep for messaging
		$this->good = null;
		$this->bad = null;

		//Not logged in, boot'em out
		if(!CmsAdminUser::isLoggedIn() && $this->getCurrentModule() != "login")
		{
			$this->loadModule('cms_admin', 'login', 'default', true);
			return false;
		}

		return true;
	}
}
