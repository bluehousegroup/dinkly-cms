<?php

class CmsAdminHomeController extends CmsAdminController 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDefault($parameters)
	{
		$this->activity_log = CmsActivityLogCollection::getRecent($this->db, 7);
		
		return true;
	}
}