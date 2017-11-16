<?php

class CmsTextContent extends CmsContent
{
	protected $html;

	protected $editor;

	protected $editor_height;

	public function initAsTemplate($yaml)
	{
		$parts = $yaml[key($yaml)];

		$this->setCode($parts['code']);
		$this->setDesc($parts['desc']);
		$this->setHint($parts['hint']);
		
		if(isset($parts['editor_height']))
		{
			$this->setEditorHeight($parts['editor_height']);
		}
		else { $this->setEditorHeight(80); }

		if(isset($parts['editor']))
		{
			if($parts['editor'] == 'text') { $this->setEditor('text'); }
			else if($parts['editor'] == 'ckeditor') { $this->setEditor('ckeditor'); }
			else { $this->setEditor('textarea'); }
		}
		else { $this->setEditor('textarea'); }
	}

	public function getEditorHeight() { return $this->height; }

	public function setEditorHeight($height) { $this->height = $height; }

	public function getHtml() { return $this->html; }

	public function getEditor() { return $this->editor; }

	public function setEditor($editor) { $this->editor = $editor; }

	public function getHint() { return $this->hint; }
}