<?php

use Symfony\Component\Yaml\Yaml;

abstract class CmsContent
{
	protected $code;
	protected $desc;
	protected $hint;

	public function init($yaml)
	{
		$parts = $yaml[key($yaml)];

		$this->setCode($parts['code']);
		$this->setDesc($parts['desc']);
		if(isset($parts['hint'])) { $this->setHint($parts['hint']); }
		else { $this->setHint(null); }
	}

	public function initWithContent($content_array)
	{
		foreach($content_array as $key => $value)
		{
			$this->$key = $value;
		}
	}

	public function getInput() { }

	public function setCode($code) { $this->code = $code; }

	public function setDesc($desc) { $this->desc = $desc; }

	public function setHint($hint) { $this->hint = $hint; }

	public function getCode() { return $this->code; }

	public function getDesc() { return $this->desc; }

	public function getHint() { return $this->hint; }
}