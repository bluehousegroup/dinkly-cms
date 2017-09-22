<?php

class CmsAdminUser extends BaseCmsAdminUser
{
	public $dbTable = 'site_admin_user';

	public function initWithUsername($username)
	{
		$db = self::fetchDB();
		$Select = $this->getSelectQuery() . " where username=". $this->db->quote($username);
		$result = $db->query($Select)->fetchAll();

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}
	public function setPassword($password)
	{
		$this->Password = crypt($password);
		$this->regDirty['password'] = true;
	}

	public static function isLoggedIn($app_name = null)
	{
		if(!$app_name) { $app_name = Dinkly::getCurrentAppName(); }
		if(isset($_SESSION['dinkly'][$app_name]['logged_in'])) { return $_SESSION['dinkly'][Dinkly::getCurrentAppName()]['logged_in']; }
		return false;
	}

	public static function setLoggedIn($val, $username, $id, $app_name = null, $first_name = "", $last_name ="" )
	{
		if(!$app_name) { $app_name = Dinkly::getCurrentAppName(); }
		$_SESSION['dinkly'][$app_name]['logged_in'] = $val;
		$_SESSION['dinkly'][$app_name]['logged_username'] = $username;
		$_SESSION['dinkly'][$app_name]['logged_id'] = $username;
		$_SESSION['dinkly'][$app_name]['logged_id_num'] = $id;
		$_SESSION['dinkly'][$app_name]['logged_first_name'] = $first_name;
		$_SESSION['dinkly'][$app_name]['logged_last_name'] = $last_name;
	}

	public static function getLoggedUsername($app_name = null)
	{
		if(!$app_name) { $app_name = Dinkly::getCurrentAppName(); }
		if(isset($_SESSION['dinkly'][$app_name]['logged_username'])) { return $_SESSION['dinkly'][Dinkly::getCurrentAppName()]['logged_username']; }
		return false;
	}

	public static function logout($app_name = null)
	{	
		if(!$app_name) { $app_name = Dinkly::getCurrentAppName(); }
		$_SESSION['dinkly'][$app_name]['logged_in'] = null;
		$_SESSION['dinkly'][$app_name]['logged_username'] = null;
		$_SESSION['dinkly'][$app_name]['logged_id'] = null;
	}

	/* Returns 0 for complete fail, 1 for success and 2 if the account is locked */
	/* Locks account after 5 failed attempts */
	public static function authenticate($username, $input_password)
	{
		$dbo = self::fetchDB();

		$sql = "select * from admin_user where username=".$dbo->quote($username);
		$result = $dbo->query($sql)->fetchAll();

		//We found a match for the username      
		if($result != array())
		{
			$user = new CmsAdminUser();
			$user->init($result[0]['id']);
			$hashed_password = $result[0]['password'];

			if(crypt($input_password, $hashed_password) == $hashed_password)
			{
				$count = $user->getLoginCount() + 1;

				$user->setLastLoginAt(date('Y-m-d G:i:s'));
				$user->setLoginCount($count);
				$user->save();

				self::setLoggedIn(true, $result[0]['username'], $result[0]['id'], null, $result[0]['first_name'], $result[0]['last_name']);

				return true;
			}
		}

		return false;
	}
}