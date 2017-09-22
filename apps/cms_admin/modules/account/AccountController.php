<?php

class AccountController extends SiteAdminController 
{
	public function loadDefault($parameters)
	{
		return true;
	}

	public function loadBilling()
	{
		return true;
	}

	public function loadUpgrade()
	{
		return true;
	}
}
