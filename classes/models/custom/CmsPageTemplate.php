<?php

use Symfony\Component\Yaml\Yaml;

class CmsPageTemplate
{
	protected $code;
	protected $content_blocks;

	public function init($yaml)
	{
		$this->code = key($yaml);

		$content_blocks = $yaml[key($yaml)];

		if($content_blocks != array())
		{
			foreach($content_blocks as $type => $content)
			{
				switch(key($content))
				{
					case 'slideshow':
						$c = new CmsSlideshowContent();
						$c->initAsTemplate($content);
						break;

					case 'image':
						$c = new CmsImageContent();
						$c->initAsTemplate($content);
						break;

					case 'textarea':
					case 'text':
						$c = new CmsTextContent();
						$c->initAsTemplate($content);
						break;
						
					case 'menu':
						$c = new CmsMenuContent();
						$c->initAsTemplate($content);
						break;
						
					case 'event':
						$c = new CmsEventContent();
						$c->initAsTemplate($content);
						break;
				}

				$this->content_blocks[] = $c;
			}
		}
	}

	public function getCode() { return $this->code; }

	public function getContentBlocks() { return $this->content_blocks; }

	public function getTemplateName()
	{
		$name = str_replace('_', ' ', $this->code);

		return ucwords($name);
	}
	
}