<?php

class DesignController extends SiteAdminController 
{
	public function setMessages($parameters)
	{
		if(isset($parameters['logo_saved']))
		{
			$this->good[] = "Logo saved";
		}		
		if(isset($parameters['logo_removed']))
		{
			$this->good[] = "Logo removed";
		}
		if(isset($parameters['default_content_loaded']))
		{
			$this->good[] = "Default content loaded";
		}	
		if(isset($parameters['image_exceed']))
		{
			$this->bad[] = "Bummer, the logo exceeded the maximum size limit of 32MB. Reverting to previous logo.";
		}
	}

	public function loadSaveLogo()
	{
		if(isset($_POST['posted']))
		{
			$setting = new Setting();
			$setting->initWithKey('logo_image_thumb_id');
			$thumb_id = $setting->getSettingValue();

			$setting = new Setting();
			$setting->initWithKey('logo_image_original_id');
			$original_id = $setting->getSettingValue();

			//We only need to store an image if we actually get one
			if($_FILES['logo']['size'] > 0)
			{
				//Enforce the max post limit (based on PHP and MySQL)
				if($_FILES['logo']['size'] < Dinkly::getConfigValue('max_post_limit','site_admin'))
				{
					$filename = $_FILES['logo']['name'];
					$type = $_FILES['logo']['type'];

					$thumb_name = sys_get_temp_dir() . '/' . uniqid();
					$thumb = Image::makeThumb($_FILES['logo']['tmp_name'], $thumb_name, 128, $_FILES['logo']['type']);
					$thumb_data = file_get_contents($thumb_name);

					$thumb_image = new Image();
					$thumb_image->init($thumb_id);
					$thumb_image->setImageData($thumb_data);
					$thumb_image->setFormat($type);
					$thumb_image->save();

					$thumb_id = $thumb_image->getId();

					$original_data = file_get_contents($_FILES['logo']['tmp_name']);

					$original = new Image();
					$original->init($original_id);
					$original->setImageData($original_data);
					$original->setFormat($type);
					$original->save();

					$original_id = $original->getId();

					//Update settings
					$setting = new Setting();
					$setting->initWithKey('logo_image_thumb_id');
					$setting->setSettingValue($thumb_id);
					$setting->save();

					$setting = new Setting();
					$setting->initWithKey('logo_image_original_id');
					$setting->setSettingValue($original_id);
					$setting->save();

					$this->loadModule('site_admin', 'design', 'default', true, true, array('logo_saved' => true));
				}
				else
				{
					$this->loadModule('site_admin', 'design', 'default', true, true, array('image_exceed' => true));
				}
			}
			else
			{
				//We got no image, delete
				$setting = new Setting();
				$setting->initWithKey('logo_image_thumb_id');
				$thumb_id = $setting->getSettingValue();

				//Delete the thumb
				$thumb = new Image();
				$thumb->init($thumb_id);
				$thumb->delete();

				//Set the setting null
				$setting->setSettingValue(null);
				$setting->save();

				//Grab the original
				$setting = new Setting();
				$setting->initWithKey('logo_image_original_id');

				//Delete that too
				$thumb = new Image();
				$thumb->init($original_id);
				$thumb->delete();

				//And set you null
				$setting->setSettingValue(null);
				$setting->save();

				$this->loadModule('site_admin', 'design', 'default', true, true, array('logo_removed' => true));
			}
		}

		return false;
	}

	public function loadDefaultContent($parameters)
	{
		$design_short_name = $this->site->getDesign()->getShortName();
		$this->site->setDefaultContent($design_short_name);

		$this->loadModule('site_admin', 'design', 'default', true, true, array('default_content_loaded' => true));
	}

	public function loadDefault($parameters)
	{
		//Output any messaging
		$this->setMessages($parameters);

		$this->design_code = $this->site->getDesign()->getCode();
		$this->designs = DesignCollection::getAll();
		$this->setting_values = SettingCollection::getAll(true);

		return true;
	}

	public function loadSaveDesign()
	{
		if(isset($_POST))
		{
			$setting = new Setting();
			$setting->initWithKey('design_code');
			$previous_design_code = $setting->getSettingValue('design_code');
			$new_design_code = $_POST['design_code'];

			//Create index of the previous design's page template codes
			$previous_design = DesignCollection::getByCode($previous_design_code);
			$previous_page_templates = $previous_design->getPageTemplates();
			$previous_template_index = array();

			foreach($previous_page_templates as $template)
			{
				$previous_template_index[] = $template->getCode();
			}

			//Create index of the new design's page template codes
			$new_design = DesignCollection::getByCode($new_design_code);
			$new_page_templates = $new_design->getPageTemplates();
			$new_template_index = array();

			foreach($new_page_templates as $template)
			{
				$new_template_index[] = $template->getCode();
			}

			//What templates do we have in common?
			$shared_templates = array_intersect($previous_template_index, $new_template_index);

			//What templates do we not have in common?
			$diff_templates = array_diff($previous_template_index, $new_template_index);

			//Existing structure (all the pages and their position)
			$nav_items = $this->site->getStructure(true);

			//We'll need this later to update any previously disabled page details
			$current_revision = null;

			//Determine new nav, based on common page templates
			$new_nav = array();
			$unusable_nav_items = array();
			foreach($nav_items as $item)
			{
				foreach($shared_templates as $template)
				{
					if($template == $item->getPage(true)->getTemplate()->getCode())
					{
						$new_nav[] = $item;
						$current_revision = $item->getPage(true)->getDetail()->getRevision();
					}
				}

				foreach($diff_templates as $template)
				{
					if($template == $item->getPage(true)->getTemplate()->getCode())
					{
						$unusable_nav_items[] = $item;
					}
				}
			}

			//Assemble the current shared page details
			$new_page_details = array();
			foreach($new_nav as $item) { $new_page_details[] = $item->getPage()->getDetail(); }

			//And sort out previously disabled page details that share the highest shared revision
			$currently_disabled_pages = PageDetailCollection::getAllDisabledByHighestRevision();

			if($currently_disabled_pages != array())
			{
				foreach($new_page_templates as $template)
				{
					if(!in_array($template, $shared_templates))
					{
						foreach($currently_disabled_pages as $detail)
						{
							if($detail->getPageTemplateCode() == $template->getCode())
							{
								$new_page_details[] = $detail;
							}
						}
					}
				}
			}

			//Reset site nav table
			SiteNavItemCollection::resetNav();

			//Mark unusable page templates deleted and disabled
			foreach($unusable_nav_items as $item)
			{
				$detail = $item->getPage()->getDetail();
				$detail->setIsEnabled(false);
				$detail->setIsDeleted(true);
				$detail->save();
			}

			//Update with new nav
			$pos = 1;
			foreach($new_page_details as $detail)
			{
				//Create new nav item
				$new_nav = new SiteNavItem();
				$new_nav->setCreatedAt(date('Y-m-d G:i:s'));
				$new_nav->setPosition($pos);
				$new_nav->setParentId(0);
				$new_nav->save();

				//Get previous nav's page detail, update it's nav reference, update it's state
				$detail->setSiteNavItemId($new_nav->getId());
				$detail->setIsEnabled(true);
				$detail->setIsDeleted(false);
				$detail->setRevision($current_revision);
				$detail->save();

				$pos++;
			}

			//Update settings with new design code
			$setting->setSettingValue($new_design_code);
			$setting->save();

			SiteActivityLogCollection::addSiteActivity('design', 'changed', json_encode($_POST));

			echo 'Design successfully changed';
		}

		return false;
	}

	public function loadSaveCss()
	{
		if(isset($_POST))
		{
			$setting = new Setting();
			$setting->initWithKey('site_custom_css');
			$setting->setSettingValue($_POST['site_custom_css']);
			$setting->save();

			SiteActivityLogCollection::addSiteActivity('site_custom_css', 'saved', json_encode($_POST));

			echo 'Custom CSS successfully saved';
		}

		return false;
	}
}
