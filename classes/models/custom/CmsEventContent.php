<?php

class CmsEventContent extends CmsContent
{
	protected $html;

	protected $events;

	public function initWithContent($content_array)
	{
		foreach($content_array as $key => $value)
		{
			$this->$key = $value;
		}
	}

	public function getEvents()
	{
		if(!$this->events)
		{
			$this->events = CmsEventCollection::getAll();
		}
		return $this->events;
	}

	public function initAsTemplate($yaml)
	{
		$parts = $yaml[key($yaml)];

		$this->setCode($parts['code']);
		$this->setDesc($parts['desc']);
	}
}