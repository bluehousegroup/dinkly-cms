<?php

class CmsSlideshowContent extends CmsContent
{
	protected $slides;

	public function initAsTemplate($yaml)
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
			$slide = new SlideshowSlide();
			$slide->initWithContent($value);
			$this->slides[] = $slide;
		}
	}

	public function getSlides()
	{
		return $this->slides;
	}

	public function setSlides($slides)
	{
		$this->slides = $slides;
	}

	public function getThumbIds()
	{
		$ids = array();
		foreach($this->slides as $slide)
		{
			$ids[] = $slide->getThumbId();
		}
	}

	public function getOriginalIds()
	{
		$ids = array();
		foreach($this->slides as $slide)
		{
			$ids[] = $slide->getOriginalId();
		}	
	}

	public function getHint() { return $this->hint; }
}