<?php
/**
 * CmsSiteNavItem
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsSiteNavItem extends BaseCmsSiteNavItem
{
	protected $page;

	protected $parent;

	protected $slug;

	protected $label;

	protected $is_draft;

	public function getPage($draft = false)
	{
		if(!$this->page)
		{
			$page = new CmsPage();
			$page->init($this->getId(), $draft);
			if(!$page->getDetail()->isNew()) { $this->page = $page; }
		}

		return $this->page;
	}

	public function getParent()
	{
		if(!$this->parent)
		{
			$this->parent = new CmsPage();
			$this->parent->init($this->getParentId());
		}

		return $this->parent;
	}

	public function getSlug()
	{
		if(!$this->slug)
		{
			$this->slug = $this->getPage()->getDetail()->getSlug();
		}
		return $this->slug;
	}

	public function getLabel()
	{
		if(!$this->label)
		{
			$this->label = $this->getPage()->getDetail()->getNavLabel();
		}
		return $this->label;
	}
}

