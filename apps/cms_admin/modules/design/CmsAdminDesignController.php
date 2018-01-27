<?php

class CmsAdminDesignController extends CmsAdminController 
{
	public function loadDefault($parameters)
	{
		$this->settings = CmsSettingCollection::getAll(true);
		$this->theme_code = $this->settings['theme_code'];
		$this->theme = CmsThemeCollection::getByCode($this->theme_code);
		$this->themes = CmsThemeCollection::getAll();

		if($this->hasPostParam('source'))
		{
			echo '<pre>';
			print_r($_POST);
			die();

			$theme_setting = new CmsSetting();
			$theme_setting->initWithKey('theme_code');
			$previous_theme_code = $theme_setting->getSettingValue('theme_code');

			if(!$previous_theme_code)
			{
				$previous_theme_code = 'table34';
			}
			
			$new_theme_code = $this->fetchPostParam('theme_code');

			//Create index of the previous design's page template codes
			$previous_theme = CmsThemeCollection::getByCode($previous_theme_code);
			$previous_page_templates = $previous_theme->getPageTemplates();
			$previous_template_index = array();

			foreach($previous_page_templates as $template)
			{
				$previous_template_index[] = $template->getCode();
			}

			//Create index of the new design's page template codes
			$new_theme = CmsThemeCollection::getByCode($new_theme_code);
			$new_page_templates = $new_theme->getPageTemplates();
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
			$nav_items = CmsSiteNavItemCollection::getStructure(true);

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
			$currently_disabled_pages = CmsPageDetailCollection::getAllDisabledByHighestRevision();

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
			CmsSiteNavItemCollection::resetNav();

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
				$new_nav = new CmsSiteNavItem();
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
			$theme_setting->setSettingValue($new_theme_code);
			$theme_setting->save();

			//Update Custom CSS
			$custom_css_setting = new CmsSetting($this->db);
			$custom_css_setting->initWithKey('custom_css');
			$custom_css_setting->setSettingValue($this->getPostParam('custom_css'));
			$custom_css_setting->save();

			//Update Custom CSS
			$custom_css_setting = new CmsSetting($this->db);
			$custom_css_setting->initWithKey('logo_image_id');
			$custom_css_setting->setSettingValue($this->getPostParam('logo_image_id'));
			$custom_css_setting->save();

			CmsActivityLogCollection::addSiteActivity('design', 'changed', json_encode($this->fetchPostParams()));

			DinklyFlash::set('success', 'Design updated');

			//Pull the latest
			$this->settings = CmsSettingCollection::getAll(true);
			$this->theme_code = $this->settings['theme_code'];
			$this->theme = CmsThemeCollection::getByCode($this->theme_code);
			$this->themes = CmsThemeCollection::getAll();
		}

		return true;
	}

	public function loadUpdateLogoBackground()
	{
		if($this->hasPostParam('background'))
		{
			$setting = new CmsSetting($this->db);
			$setting->initWithKey('logo_background');
			$setting->setSettingValue($this->fetchPostParam('background'));
			$setting->save();

			die('success');
		}

		return false;
	}
}