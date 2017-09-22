<?php

class PagesController extends SiteAdminController 
{
	public function loadImageUpload($parameters)
	{
		$filename = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
		$file = file_get_contents('php://input');
		$type = "image/" . $parameters['filetype'];

		$temp_location = sys_get_temp_dir() . '/' . uniqid();
		file_put_contents($temp_location, file_get_contents('php://input'));

		//somewhere in here we need to also check the cropped sizes

		//thumbnail size
		$thumb_name = sys_get_temp_dir() . '/' . uniqid();
		$thumb = Image::makeThumb($temp_location, $thumb_name, 128, $type);
		$thumb_data = file_get_contents($thumb_name);

		$thumb_image = new Image();
		$thumb_image->setImageData($thumb_data);
		$thumb_image->setFilename($filename);
		$thumb_image->setFormat($type);
		$thumb_image->save();

		$thumb_id = $thumb_image->getId();

		//original size
		$original = new Image();
		$original->setImageData($file);
		$original->setFilename($filename);
		$original->setFormat($type);
		$original->save();

		echo json_encode(array('thumb_id' => $thumb_image->getId(), 'original_id' => $original->getId()));
		die();
	}

	public function loadAutosave($parameters)
	{
		$this->initEdit($parameters, true);
		$this->handleEditPost($parameters, true);

		return false;
	}

	public function loadUpdatePageOrder($parameters)
	{
		if(isset($_POST['order']))
		{
			$ids = explode('&&&', $_POST['order']);

			$position = 1;
			foreach($ids as $id)
			{
				$nav_item = new SiteNavItem();
				$nav_item->init($id);
				$nav_item->setPosition($position);
				$nav_item->save();

				$position++;
			}

			echo 'success'; die();
		}

		return false;
	}

	public function loadDefault($parameters)
	{
		$page_id = null;
		if(!isset($this->site->getStructure()[1]))
		{
			$page_id = 1;
		}
		else { $page_id = $this->site->getStructure()[1]->getId(); }

		$parameters = array_merge($parameters, array('page' => $page_id));

		$this->loadModule('site_admin', 'pages', 'edit', true, true, $parameters);

		return true;
	}

	public function loadPublish($parameters)
	{
		$this->page_id = $parameters['page'];

		//Load current live page and unset
		$live_page = new Page();
		$live_page->init($this->page_id, false);
		$live_page->getDetail()->setIsCurrentLive(false);
		$live_page->getDetail()->setIsEnabled(true);
		$live_page->getDetail()->save();

		//Load current draft page and set as current
		$draft_page = new Page();
		$draft_page->init($this->page_id, true);
		$draft_page->getDetail()->setIsCurrentLive(true);
		$draft_page->getDetail()->setIsEnabled(true);
		$draft_page->getDetail()->save();

		SiteActivityLogCollection::addSiteActivity('page', 'published', json_encode($live_page->getDetail()));

		$this->loadModule('site_admin', 'pages', 'edit', true, true, array('page' => $this->page_id, 'published' => 1));

		return false;
	}

	public function loadDelete($parameters)
	{
		$this->page_id = $parameters['page'];

		//Load current draft page mark it deleted
		$draft_page = new Page();
		$draft_page->init($this->page_id, true);
		$site_nav_id = $draft_page->getDetail()->getSiteNavItemId();

		$detail = $draft_page->getDetail();
		$detail->setIsCurrentDraft(false);
		$detail->setIsDeleted(true);
		$detail->save();

		$draft_page->getDetail()->setIsCurrentDraft(false);
		$draft_page->getDetail()->setIsDeleted(true);
		$draft_page->getDetail()->save();

		//Load current live page mark and mark deleted (if one exists)
		$live_page = new Page();
		$live_page->init($this->page_id, false);
		if(!$live_page->getDetail()->isNew())
		{
			$detail = $live_page->getDetail();
			$detail->setIsCurrentLive(false);
			$detail->setIsDeleted(true);
			$detail->save();
		}

		//Remove from site nav table
		$nav = new SiteNavItem();
		$nav->init($site_nav_id);
		if(!$nav->isNew()) { $nav->delete(); }

		SiteActivityLogCollection::addSiteActivity('page', 'deleted', $this->page_id);

		$this->loadModule('site_admin', 'pages', '', true, true, array('deleted' => 1));

		return false;
	}

	public function loadDisplayImage($parameters)
	{
		if(isset($parameters['image_id']))
		{
			$image = new Image();
			$image->init($parameters['image_id']);

			header("Content-type: " . $image->getFormat());
			echo $image->getImageData();
			die();
		}
		return false;
	}

	public function setMessages($parameters)
	{
		if(isset($parameters['saved']))
		{
			$this->good[] = "Page saved";
		}		
		if(isset($parameters['discarded']))
		{
			$this->good[] = "Changes discarded";
		}
		if(isset($parameters['added']))
		{
			$this->good[] = "Page added";
		}
		if(isset($parameters['published']))
		{
			$this->good[] = "Page published";
		}
		if(isset($parameters['deleted']))
		{
			$this->good[] = "Page deleted";
		}
		if(isset($parameters['image_exceed']))
		{
			$this->bad[] = "One or more images exceeded the maximum size limit of 32MB. Other changes were saved.";
		}
	}

	protected function initEdit($parameters)
	{
		//Output any messaging
		$this->setMessages($parameters);

		//Initialize current page
		$this->page_id = $parameters['page'];
		$this->page = new Page();
		$this->page->init($this->page_id, true);

		//Clean up previous autosaves
		PageDetailCollection::deleteAutosaves($this->page->getDetail()->getSiteNavItemId());

		//We haven't got a single page to display, create one
		if($this->page->getDetail()->isNew())
		{
			DinklyBuilder::loadFixture('site_admin', 'SiteNavItem', true, false);
			DinklyBuilder::loadFixture('site_admin', 'PageDetail', true, false);

			$this->page->init($this->page_id, true);
		}

		$this->revisions = PageDetailCollection::getAllRevisions($this->page->getDetail()->getSiteNavItemid());

		//An index of page content
		$this->content_index = $this->page->getContentIndex();

		//Grab all the template content blocks;
		$this->template_content_blocks = $this->page->getTemplate()->getContentBlocks();
		$this->current_revision = $this->page->getDetail()->getRevision();

		//Create an array of available page templates for use in the 'add page' form
		$this->available_templates = array();
		foreach($this->site->getDesign()->getPageTemplates() as $template)
		{
			$this->available_templates[] = $template;
		}
	}

	protected function handleAddPost($parameters)
	{
		//Handle add page post
		if(isset($_POST['add_page_posted']))
		{
			//Validate
			$this->validatePost($_POST);

			//Good to go
			if(!$this->bad)
			{
				//Cut a new site nav record, which is essentially the most meta record for a page
				$site_nav_item = new SiteNavItem();
				$site_nav_item->setCreatedAt(date('Y-m-d G:i:s'));
				$site_nav_item->setPosition(SiteNavItemCollection::getHighestPosition() + 1);
				$site_nav_item->setParentId(0);
				$site_nav_item->save();

				//Line up the posted template
				$selected_template = null;
				foreach($this->site->getDesign()->getPageTemplates() as $template)
				{
					if($_POST['page_template'] == $template->getCode())
					{
						$selected_template = $template;
					}
				}

				//Create a new page detail record
				$page_detail = new PageDetail();
				$page_detail->setCreatedAt(date('Y-m-d G:i:s'));
				$page_detail->setSiteNavItemId($site_nav_item->getId());
				$page_detail->setPageTemplateCode($selected_template->getCode());
				$page_detail->setTitle($selected_template->getTemplateName());
				$page_detail->setNavLabel($selected_template->getTemplateName());
				$page_detail->setIsCurrentDraft(true);
				$page_detail->setIsCurrentLive(false);
				$page_detail->setIsEnabled(true);
				$page_detail->setRevision(1);

				//Generate and set slug
				$slug = $page_detail->genSlug($page_detail->getNavLabel());
				if(PageDetailCollection::isDuplicateSlug($slug))
				{
					$i=2;
					while(true)
					{
						if(PageDetailCollection::isDuplicateSlug($slug . '-' . $i))
						{
							$i++;
						}
						else break;
					}
					$page_detail->setSlug($slug . '-' . $i);
					$page_detail->setNavLabel($page_detail->getNavLabel() . ' ' . $i);
				}
				else $page_detail->setSlug($slug);

				$page_detail->save();

				SiteActivityLogCollection::addSiteActivity('page', 'added', json_encode($page_detail));

				unset($_POST['add_page_posted']);

				$this->loadModule('site_admin', 'pages', 'edit', true, true, array('page' => $this->page_id, 'added' => 1));
			}
		}
	}

	protected function handleEditPost($parameters, $autosave = false)
	{
		//Handle form post for updated content
		if(isset($_POST['posted']))
		{
			//Validate
			$this->validatePost($_POST);

			//Good to go
			if(!$this->bad)
			{
				//Clean up previous autosaves
				PageDetailCollection::deleteAutosaves($this->page->getDetail()->getSiteNavItemId());

				$output_parameters = array('page' => $this->page_id);

				//Update revision numbers
				$new_revision_num = PageDetailCollection::getHighestRevision($this->page->getDetail()->getSiteNavItemId()) + 1;

				$posted_content = array();

				//Update old page detail if this isn't an autosave
				if(!$autosave)
				{				
					$this->page->getDetail()->setIsCurrentDraft(false);
					$this->page->getDetail()->save();
				}

				//Set new one up
				$new_page_detail = new PageDetail();
				if($autosave)
				{
					$new_page_detail->initAutosave($this->page->getDetail()->getSiteNavItemId());
				}

				if($new_page_detail->isNew())
				{
					$new_page_detail->setCreatedAt(date('Y-m-d G:i:s'));
				}

				$new_page_detail->setSiteNavItemId($this->page->getDetail()->getSiteNavItemId());
				$new_page_detail->setPageTemplateCode($this->page->getDetail()->getPageTemplateCode());
				$new_page_detail->setTitle($_POST['page_detail_title']);
				$new_page_detail->setNavLabel($_POST['page_detail_nav_label']);

				if(isset($_POST['page_detail_meta_title']))
				{
					$new_page_detail->setMetaTitle($_POST['page_detail_meta_title']);
					$new_page_detail->setMetaDescription($_POST['page_detail_meta_description']);
					$new_page_detail->setMetaKeywords($_POST['page_detail_meta_keywords']);
				}

				//Make sure we determine if this is an autosave or a new draft
				if($autosave) { $new_page_detail->setIsAutosave(true); }
				else { $new_page_detail->setIsCurrentDraft(true); }
				$new_page_detail->setRevision($new_revision_num);

				//Create our slug
				$slug = $new_page_detail->genSlug($new_page_detail->getNavLabel());
				$new_page_detail->setSlug($slug);

				$new_page_detail->save();

				//Re-initialize page object
				$this->page = new Page();
				$this->page->init($parameters['page'], true, $autosave);

				//Deal with uploaded files
				foreach($_FILES as $key => $value)
				{
					if(stristr($key, 'content&&&'))
					{
						$parts = explode('&&&', $key);
						$content_code = $parts[2];

						if($parts[1] == 'slideshow') //Slideshow content
						{
							$slideshow_files = array();
							$size = count($value['size']);

							//Convert the standard $_FILES multi-file array into something easier to traverse
							for($i = 0; $i < $size; $i++)
							{	
								$slideshow_files[$i] = array();
								$slideshow_files[$i]['name'] = $value['name'][$i];
								$slideshow_files[$i]['type'] = $value['type'][$i];
								$slideshow_files[$i]['tmp_name'] = $value['tmp_name'][$i];
								$slideshow_files[$i]['error'] = $value['error'][$i];
								$slideshow_files[$i]['size'] = $value['size'][$i];
							}

							foreach($slideshow_files as $k => $v)
							{
								$content_code = $parts[2] . '_' . $k;

								if(!isset($posted_content[$content_code]))
								{
									$posted_content[$content_code] = array();
								}

								$slides = array();
								if(isset($this->content_index[$parts[2]]))
								{
									$slides = $this->content_index[$parts[2]]->getSlides();
								}

								//We're going to set these aside, should we not have new files to deal with
								$thumb_id = $original_id = $filename = null;
								if(isset($slides[$k]))
								{
									$thumb_id = $slides[$k]->getThumbId();
									$original_id = $slides[$k]->getOriginalId();
									$filename = $slides[$k]->getFilename();
								}

								//We only need to store an image if we actually get one
								if($v['size'] > 0)
								{
									$filename = $v['name'];

									$thumb_name = sys_get_temp_dir() . '/' . uniqid();
									$thumb = Image::makeThumb($v['tmp_name'], $thumb_name, 128, $v['type']);
									$thumb_data = file_get_contents($thumb_name);

									$thumb_image = new Image();
									$thumb_image->setImageData($thumb_data);
									$thumb_image->setFormat($v['type']);
									$thumb_image->save();

									$thumb_id = $thumb_image->getId();

									$original_data = file_get_contents($v['tmp_name']);

									$original = new Image();
									$original->setImageData($original_data);
									$thumb_image->setFormat($v['type']);
									$original->save();

									$original_id = $original->getId();
								}

								//Store the thumbnail data
								$posted_content[$content_code]['thumb_id'] = array();
								$posted_content[$content_code]['thumb_id']['content_type'] = $parts[1];
								$posted_content[$content_code]['thumb_id']['content_class'] = $parts[3];
								$posted_content[$content_code]['thumb_id']['content_value'] = $thumb_id;

								//Store the image data
								$posted_content[$content_code]['original_id'] = array();
								$posted_content[$content_code]['original_id']['content_type'] = $parts[1];
								$posted_content[$content_code]['original_id']['content_class'] = $parts[3];
								$posted_content[$content_code]['original_id']['content_value'] = $original_id;

								//Store the filename
								$posted_content[$content_code]['filename'] = array();
								$posted_content[$content_code]['filename']['content_type'] = $parts[1];
								$posted_content[$content_code]['filename']['content_class'] = $parts[3];
								$posted_content[$content_code]['filename']['content_value'] = $filename;

								//Store the caption
								$caption = $_POST['content&&&'.$parts[1].'&&&'.$parts[2].'&&&'.$parts[3].'&&&caption'][$k];
								$posted_content[$content_code]['caption'] = array();
								$posted_content[$content_code]['caption']['content_type'] = $parts[1];
								$posted_content[$content_code]['caption']['content_class'] = $parts[3];
								$posted_content[$content_code]['caption']['content_value'] = $caption;
							}
						}
					}
				}

				//Make sense of post array
				foreach($_POST as $key => $value)
				{
					if(stristr($key, 'content&&&'))
					{
						$parts = explode('&&&', $key);

						//Catch and store posted content
						if($parts[1] == 'text' || $parts[1] == 'caption' || $parts[1] == 'image')
						{
							$content_code = $parts[2];
							$content_key = $parts[4];

							if(!isset($posted_content[$content_code]))
							{
								$posted_content[$content_code] = array();
							}

							$posted_content[$content_code][$content_key] = array();
							$posted_content[$content_code][$content_key]['content_type'] = $parts[1];
							$posted_content[$content_code][$content_key]['content_class'] = $parts[3];
							$posted_content[$content_code][$content_key]['content_value'] = $value;
						}
						else if($parts[1] == 'employees')
						{
							$content_code = $parts[2];

							if(!isset($posted_content[$content_code]))
							{
								$posted_content[$content_code] = array();
							}

							$posted_content[$content_code]['employees'] = array();
							$posted_content[$content_code]['employees']['content_type'] = $parts[1];
							$posted_content[$content_code]['employees']['content_class'] = $parts[3];
							$posted_content[$content_code]['employees']['content_value'] = json_encode($value);
						}
					}
				}

				//Loop through the template content blocks and cut new versions of the page content
				foreach($posted_content as $code => $content)
				{
					foreach($content as $key => $parts)
					{
						$page_content = new PageContent();
						$page_content->setCreatedAt(date('Y-m-d G:i:s'));
						$page_content->setRevision($new_revision_num);
						$page_content->setContentType($parts['content_type']);
						$page_content->setContentKey($key);
						$page_content->setContentValue($parts['content_value']);
						$page_content->setContentCode($code);
						$page_content->setPageDetailId($new_page_detail->getId());
						$page_content->save();
					}
				}

				SiteActivityLogCollection::addSiteActivity('page', 'edited', json_encode($new_page_detail));

				unset($_POST['posted']);

				//If this is an autosave, we need to do some special stuff
				if($autosave)
				{
					//Because slideshows don't come along for the ride via ajax, we need to manually cut
					//new records based on the previous version's content
					$previous_version = new PageDetail();
					$previous_version->initWithNavId($this->page->getDetail()->getSiteNavItemid(), $this->current_revision);

					//Get the previous version's content
					$previous_content = PageContentCollection::getAllByDetailid($previous_version->getId());

					//Loop through the content, look for slideshows, and cut new records attached to the autosave
					$pos = 1; //We start at 1 on purpose (this is where the content will start on slideshow posts)
					if($previous_content != array())
					{
						foreach($previous_content as $c)
						{
							//If we have image or slideshow content continue
							if($c->getContentType() == 'slideshow')
							{
								//Clone the previous content record, setting it up to get a new id and insert
								$autosave_content = clone $c;
								$autosave_content->setId(null);
								$autosave_content->setPageDetailId($new_page_detail->getId());
								$autosave_content->setRevision($new_revision_num);

								//Make sure we get the new caption if there is one, this gets gnarly, deal with it
								if($c->getContentKey() == 'caption')
								{
									$content_class = null;
									if($c->getContentType() == 'slideshow')
									{
										$content_class = 'SlideshowContent';
										if(isset($_POST['content&&&'.$c->getContentType().'&&&slideshow&&&'.$content_class.'&&&caption']))
										{
											$autosave_content->setContentValue($_POST['content&&&'.$c->getContentType().'&&&slideshow&&&'.$content_class.'&&&caption'][$pos]);
										}
									}
								}

								//Force the entire model to be dirty and insert
								$autosave_content->forceDirty();
								$autosave_content->save(true);
							}
						}
					}

					echo 'success'; return false;
				}

				if($_POST['publish'] == 'true')
				{
					$this->loadModule('site_admin', 'pages', 'publish', true, true, $output_parameters);
				}
				else
				{
					$output_parameters['saved'] = 1;
					$this->loadModule('site_admin', 'pages', 'edit', true, true, $output_parameters);
				}
			}	
		}
	}

	public function validatePost($post_array)
	{
		if(isset($post_array['page_detail_nav_label']))
		{
			$id = $this->page->getDetail()->getId(); //this should be the page detail id
			$page_detail = new PageDetail();
			$new_slug = $page_detail->genSlug($post_array['page_detail_nav_label']);

			if(PageDetailCollection::isDuplicateSlug($new_slug, $id))
			{
				$this->bad[] = "Slug is already in use";
			}
		}
	}

	public function loadEdit($parameters)
	{
		$this->initEdit($parameters);
		$this->handleAddPost($parameters);
		$this->handleEditPost($parameters);

		return true;
	}

	public function loadNew()
	{
		return true;
	}
}

