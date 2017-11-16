<?php

class CmsSetting extends BaseCmsSetting
{
	public function initWithKey($key)
	{
		try { CmsSettingKeyCollection::isValidKey($key); }
		catch(Exception $e)
		{
			throw new Exception('Invalid setting key.');
		}
		
		$Select = $this->getSelectQuery() . " where setting_key=". $this->db->quote($key);
		$result = $this->db->query($Select)->fetchAll();

		$this->setSettingKey($key);

		if($this->isNew()) { $this->setCreatedAt(date('Y-m-d G:i:s')); }

		if($result != array())
		{
			$this->hydrate($result, true);
		}
	}
}
