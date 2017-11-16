<?php

class CmsImageContent extends CmsContent
{
	protected $has_caption;

	protected $caption;

	protected $thumb_id;

	protected $original_id;

	protected $crop_id;

	protected $filename;

	protected $crop_width;

	protected $crop_height;

	protected $caption_editor;

	protected $caption_editor_height;

	public function initAsTemplate($yaml)
	{
		$parts = $yaml[key($yaml)];

		$this->setCode($parts['code']);
		$this->setDesc($parts['desc']);
		if(isset($parts['has_caption'])) $this->setHasCaption($parts['has_caption']);
		else $this->setHasCaption(null);
		if(isset($parts['hint'])) $this->setHint($parts['hint']);
		else $this->setHint(null);
		if(isset($parts['crop_width'])) $this->setCropWidth($parts['crop_width']);
		else $this->setCropWidth(null);
		if(isset($parts['crop_height'])) $this->setCropHeight($parts['crop_height']);
		else $this->setCropHeight(null);

		if(isset($parts['caption_editor_height']))
		{
			$this->setCaptionEditorHeight($parts['caption_editor_height']);
		}
		else { $this->setCaptionEditorHeight(80); }

		if(isset($parts['caption_editor']))
		{
			if($parts['caption_editor'] == 'text') { $this->setCaptionEditor('text'); }
			else if($parts['caption_editor'] == 'ckeditor') { $this->setCaptionEditor('ckeditor'); }
			else { $this->setCaptionEditor('textarea'); }
		}
		else { $this->setCaptionEditor('textarea'); }
	}

	public function getOriginalSource()
	{
		//If there is a cropped version use it
		if($this->getCropId() > 0)
		{
			return '/site/' . CustomerSite::getCurrentDomain() . '/display_image/image_id/' . $this->getCropId();
		}
		elseif($this->getOriginalId() > 0)
		{
			return '/site/' . CustomerSite::getCurrentDomain() . '/display_image/image_id/' . $this->getOriginalId();
		}
	}

	public function getCaptionEditorHeight() { return $this->caption_editor_height; }

	public function setCaptionEditorHeight($caption_editor_height) { $this->caption_editor_height = $caption_editor_height; }

	public function getCaptionEditor() { return $this->caption_editor; }

	public function setCaptionEditor($caption_editor) { $this->caption_editor = $caption_editor; }

	public function setHasCaption($has_caption) { $this->has_caption = $has_caption; }

	public function getHasCaption() { return $this->has_caption; }

	public function getCaption() { return $this->caption; }

	public function getThumbId() { return $this->thumb_id; }

	public function getCropId() { return $this->crop_id; }

	public function getOriginalId() { return $this->original_id; }

	public function getFilename()
	{
		if($this->original_id)
		{
			$image = new Image();
			$image->init($this->original_id);
			return $image->getFilename();
		}

		return false;
	}

	public function getHint() { return $this->hint; }

	public function setCropWidth($crop_width) { $this->crop_width = $crop_width; }

	public function getCropWidth() { return $this->crop_width; }

	public function setCropHeight($crop_height) { $this->crop_height = $crop_height; }

	public function getCropHeight() { return $this->crop_height; }
}