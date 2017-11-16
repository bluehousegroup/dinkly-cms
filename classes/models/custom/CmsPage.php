<?php

class CmsPage
{
	protected $detail;

	protected $content;

	protected $template;

	protected $design;

	public function init($site_nav_item_id, $draft = false, $autosave = false)
	{
		$this->detail = new CmsPageDetail();

		if($autosave)
		{
			$this->detail->initAutosave($site_nav_item_id);
		}
		else { $this->detail->initWithNavId($site_nav_item_id, null, $draft); }

		if(!$this->detail->isNew())
		{
			$this->content = CmsPageContentCollection::getAllByDetailId($this->detail->getId());
		}
	}

	public function initWithDetailId($detail_id)
	{
		$this->detail = new CmsPageDetail();
		$this->detail->init($detail_id);

		$this->content = CmsPageContentCollection::getAllByDetailId($this->detail->getId());
	}

	public function initWithSlug($slug, $draft = false, $autosave = false)
	{
		$this->detail = new CmsPageDetail();
		if($autosave)
		{
			$this->detail->initAutosaveWithSlug($slug);
		}
		else { $this->detail->initWithSlug($slug, null, $draft); }

		if(!$this->detail->isNew())
		{
			$this->content = CmsPageContentCollection::getAllByDetailId($this->detail->getId());
		}
	}

	public function getTemplate()
	{
		if(!$this->template)
		{
			$templates = $this->getDesign()->getPageTemplates();

			//Pin down which template we'll be using
			foreach($templates as $template)
			{
				if($template->getCode() == $this->getDetail()->getPageTemplateCode())
				{
					$this->template = $template;
				}
			}
		}

		return $this->template;
	}

	public function getContentIndex()
	{
		$index = array();

		if(!$this->getTemplate()) { return false; }

		if($this->getTemplate()->getContentBlocks() != array())
		{ 
			//Return an index of template content blocks, and fill if we have the data
			foreach($this->getTemplate()->getContentBlocks() as $template_block)
			{ 
				if($template_block->getCode())
				{
					$content_class = get_class($template_block);

					$content_array = array();

					if($this->content != array())
					{ 
						foreach($this->content as $slice)
						{
							if($slice->getContentType() == 'slideshow')
							{
								//Slideshow slide codes are appended with their position
								$parts = explode('_', $slice->getContentCode());
								$content_code = $parts[0];
								$position = $parts[1];

								if($content_code == $template_block->getCode())
								{
									//get objects
									if(!isset($content_array[$position])) { $content_array[$position] = array(); }

									$content_array[$position][$slice->getContentKey()] = $slice->getContentValue();
								}
							}
							else
							{
								if($slice->getContentCode() == $template_block->getCode())
								{
									//get objects
									$content_array[$slice->getContentKey()] = $slice->getContentValue();
								}
							}
						} 
					}

					$content_object = new $content_class;
					$content_object->initWithContent($content_array);			

					$index[$template_block->getCode()] = $content_object;
				}
			}
		}

		return $index;
	}

	public function getDetail() { return $this->detail; }

	public function getDesign() 
	{
		if(!$this->design)
		{
			$settings = CmsConfigCollection::getSettings();
			$this->design = CmsDesignCollection::getByCode($settings['design_code']);
		}
		return $this->design;
	}

	public function getContent() { return $this->content; }
}