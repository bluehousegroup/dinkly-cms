<?php

class CmsAdminHomeController extends CmsAdminController 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDefault($parameters)
	{
		return $this->loadModule('cms_admin', 'pages', 'default', true);
	}
}