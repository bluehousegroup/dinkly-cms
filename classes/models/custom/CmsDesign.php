<?php

use Symfony\Component\Yaml\Yaml;

class CmsDesign
{
	protected $title;
	protected $desc;
	protected $code;
	protected $preview_image;
	protected $page_templates;
	protected $layout;
	protected $default_logo;
	protected $is_public;

	public function init($yaml)
	{
		$this->setTitle(htmlentities($yaml['title']));
		$this->setDesc(htmlentities($yaml['desc']));
		$this->setCode(htmlentities($yaml['code']));
		$this->setLayout(htmlentities($yaml['layout']));
		$this->setIsPublic(htmlentities($yaml['is_public']));
		$this->setDefaultLogo(htmlentities($yaml['default_logo']));

		$this->setPreviewImage($yaml['preview_image']);

		foreach($yaml['page_templates'] as $p)
		{
			$page_template = new PageTemplate();
			$page_template->init($p);

			$this->page_templates[] = $page_template;
		}
	}

	/* Setters */

	public function setTitle($title) { $this->title = $title; }

	public function setDesc($desc) { $this->desc = $desc; }

	public function setCode($code) { $this->code = $code; }

	public function setLayout($layout) { $this->layout = $layout; }

	public function setIsPublic($is_public) { $this->is_public = $is_public; }

	public function setPreviewImage($preview_image) { $this->preview_image = $preview_image; }

	public function setPageTemplates($page_templates) { $this->page_templates = $page_templates; }

	public function setDefaultLogo($default_logo) { $this->default_logo = $default_logo; }

	public function getShortName()
	{
		$table = array(
	        ' '=>'-', 'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
	        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
	        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
	        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
	        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
	        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
	        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
	        'ÿ'=>'y', 'R'=>'R', 'r'=>'r', "'"=>'-', '"'=>'-'
	    );

		return strtr(str_replace(' ', '', html_entity_decode($this->getTitle())), $table);
	}

	/* Getters */

	public function getTitle() { return $this->title; }

	public function getDesc() { return $this->desc; }

	public function getCode() { return $this->code; }

	public function getLayout() { return $this->layout; }

	public function getIsPublic() { return $this->is_public; }

	public function getPreviewImage() { return $this->preview_image; }

	public function getPageTemplates() { return $this->page_templates; }

	public function getDefaultLogo() { return $this->default_logo; }
}