<?php

class CmsSiteHomeController extends CmsSiteController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadDisplayImage($parameters)
	{
		if(isset($parameters['image_id']))
		{
			$image = new CmsImage();
			$image->init($parameters['image_id']);

			header("Content-type: " . $image->getFormat());
			echo $image->getImageData();
			die();
		}
		return false;
	}

	public function initVariables($content)
	{
		//Push page variables into the local scope for easy access in the template
		//Be careful not to have duplicate names here
		foreach($content as $key => $block)
		{
			$var_name = $key;
			$this->$var_name = $block;
		}
	}

	public function loadDefault($parameters)
	{ 
		//Initialize some variables
		$this->page = null;
		$this->page_template_code = null;
		$this->single_page_layout = false;
		$this->nav_items = array();
		$this->logo_path = null;
		$this->revision_number = null;
		$this->is_draft = false;

		//For a one page layout, we'll need all pages right off the bat
		$this->template_files = array();

		//Not the most elegant thing in the world, but it works
		if(isset($parameters['image_id'])) { $this->loadDisplayImage($parameters); }

		$this->is_draft = false;
		if(isset($parameters['draft'])) { $this->is_draft = true; }

		$this->is_autosave = false;
		if(isset($parameters['autosave'])) { $this->is_autosave = true; $this->is_draft = false; }

		$this->is_revision = false;
		if(isset($parameters['revision'])) { $this->is_revision = true; $this->is_draft = false; }

		$this->structure = CmsSiteNavItemCollection::getStructure($this->is_draft);

		//Grab page slug, leave null if we can't find one
		$this->base_path = '/';
		$parts = explode('/', $_SERVER['REQUEST_URI']);
		if(!isset($parts[1])) { $this->slug = 'home'; }
		else { $this->slug = $parts[1]; }

		if($this->is_autosave) //First we check if an autosave is being requested
		{
			$this->page = new CmsPage();
			$parts = explode('/', $_SERVER['REQUEST_URI']);
			$this->page->init($parts[3], false, true);

			//If we don't have an autosave to load, grab the draft instead
			if(!$this->page->getDetail()->getId())
			{ 
				$this->page->init($parts[3], true);

				//If we still don't get a page to load, grab the published version
				if(!$this->page->getDetail()->getId())
				{
					$this->page->init($parts[3]);
				}
			}
		}
		else if($this->is_revision) //...or a specific revision (noe: detail id is used, not the revision)
		{
			$this->page = new CmsPage();
			$parts = explode('/', $_SERVER['REQUEST_URI']);
			$this->page->initWithDetailId($parts[3]);
			$this->revision_number = $parts[3];
		}
		else if($this->slug) //...or this is probably the real deal, look up by slug
		{
			$this->page = new CmsPage();
			$this->page->initWithSlug($this->slug, $this->is_draft);
		}
		else
		{
			$this->page = new CmsPage();
			
			//Not sure what this does again, yet
			$structure = $this->structure;
			reset($this->structure);

			if(isset($structure[key($structure)]))
			{
				$this->page = $structure[key($structure)]->getPage($this->is_draft);
			}
		}

		//Which file to load in the designs/html folder
		$this->template_file = null;

		//If we have a matching page detail record, continue, otherwise send to 404
		if(!$this->page->getDetail())
		{
			header("HTTP/1.0 404 Not Found");

			//No matching page found, send to the 404
			$this->template_file = '404.php';
			$this->settings['page_title'] = $this->settings['meta_title'] . ' - 404 Page Not Found';
			return true;
		}
		else { $this->template_file = 'home.php'; }

		//If this is a single page layout, we only ever need one explicit template
		if($this->page)
		{
			$this->page_template_code = $this->page->getTemplate()->getCode();

			//And the navigation
			$this->nav_items = $this->site->getStructure($this->is_draft);

			//Override default SEO vals if they exist at the page-detail level
			if($this->page->getDetail()->getMetaTitle() != '')
			{
				$this->settings['meta_title'] = $this->page->getDetail()->getMetaTitle();
			}

			if($this->page->getDetail()->getMetaKeywords() != '')
			{
				$this->settings['meta_keywords'] = $this->page->getDetail()->getMetaKeywords();
			}

			if($this->page->getDetail()->getMetaDescription() != '')
			{
				$this->settings['meta_description'] = $this->page->getDetail()->getMetaDescription();
			}

			//Set page title setting
			$this->settings['page_title'] = $this->page->getDetail()->getTitle();

			if($this->page->getDesign()->getLayout() == 'single')
			{
				$this->single_page_layout = true;
				foreach($this->site->getStructure(true) as $nav_item)
				{
					$this->template_files[$nav_item->getPage()->getDetail()->getTitle()] = $nav_item->getPage()->getTemplate()->getCode() . '.php';

					//Some pages require some extra juice to work properly
					$this->extendController($nav_item->getPage()->getTemplate()->getCode());

					$content = $nav_item->getPage()->getContentIndex();

					$this->initVariables($content);
				}
			}
			else  //Else, this is a standard mulitple page layout
			{
				$this->template_file = $this->page->getTemplate()->getCode() . '.php';

				$content = $this->page->getContentIndex();

				$this->initVariables($content);
			}

			//Set logo
			$this->logo_path = $this->page->getDesign()->getDefaultLogo();
			if($this->settings['logo_image_original_id'])
			{
				$this->logo_path = '/display_image/image_id/' . $this->settings['logo_image_original_id'];
			}

			//Some pages require some extra juice to work properly
			$this->extendController($this->page->getTemplate()->getCode());
		}

		return true;
	}

	//Given a page_code, this will attempt to find a matching extension function to run. Handy for overrides, or specific tweaks for modules.
	public function extendController($page_code)
	{
		$titleFunction = "load" . Dinkly::convertToCamelCase($page_code, true) . 'Extension';
		if(in_array($titleFunction, get_class_methods($this)))
			$this->$titleFunction();
	}

	public function loadBlogExtension()
	{
		//Get the title from the last part of the slug
		$slug_parts = explode("/", $_SERVER["REQUEST_URI"]);
		$slug = end($slug_parts);

		$this->last_three_posts = CmsPostCollection::getBlogPostList(3);

		if(strstr($slug, "archive"))
		{
			$year = date("Y"); $month = null; $archive_parts = explode("_", $slug);
			if(isset($archive_parts[1])) $year = $archive_parts[1];
			if(isset($archive_parts[2])) $month = $archive_parts[2];
			
			//Get a list of posts using archive paramaters
			$this->posts = CmsPostCollection::getBlogArchive($year, $month);

			//override these to be blog specific
			$this->settings['page_title'] = "Restaurant Marketing Blog | Fourtopper";
			$this->settings['meta_title'] = "Restaurant Marketing Blog | Fourtopper";
			$this->settings['meta_description'] = "Discover how your restaurant website can be used to drive more traffic through your door and increase your revenue.";
		}
		elseif($slug != "blog" AND $slug != "")
		{

			//do query on title and return posts record
			$post_array = CmsPostCollection::getBlogPost($slug);

			foreach($post_array as $temp) {	$this->post = $temp; }

			//override these to be blog specific
			$this->settings['page_title'] = $this->post->getPostTitle()." | Fourtopper";
			$this->settings['meta_title'] = $this->post->getPostTitle()." | Fourtopper";
			$this->settings['meta_description'] = strip_tags(substr($this->post->getPostContent(),0,150));
		}
		else
		{
			//Get a list of all posts ordered by publish date
			$this->posts = CmsPostCollection::getBlogPostList(15);

			//override these to be blog specific
			$this->settings['page_title'] = "Restaurant Marketing Blog | Fourtopper";
			$this->settings['meta_title'] = "Restaurant Marketing Blog | Fourtopper";
			$this->settings['meta_description'] = "Discover how your restaurant website can be used to drive more traffic through your door and increase your revenue.";
		}

		//Get stuff needed for the archive nav
		$this->oldest_post_year = array(); $this->post_dates = array();
		$this->current_year = date("Y");
		$this->oldest_post = CmsPostCollection::getOldestPost();
		if($this->oldest_post)
		{
			$this->oldest_post_year = date("Y", strtotime($this->oldest_post->getPostDate()));
			$this->all_posts = CmsPostCollection::getBlogPostList();
			foreach($this->all_posts as $this->all_post){ $this->post_dates[] = date("m-Y", strtotime($this->all_post->getPostDate())); }
		}
	}

	public function loadEventsExtension()
	{
		//Get the title of the event from the slug
		$slug = explode("/", $_SERVER["REQUEST_URI"]);
		$slug = end($slug);

		if($this->page->getDesign()->getLayout() != 'single' 
			&& $slug != $this->page->getDetail()->getSlug() && $slug != "")
		{
			$slug = urldecode($slug);
			//do query on title and return event record
			$this->events = array(CmsEventCollection::getByTitle($slug));

			//If an event with that name does not exist, kick to event list
			if($this->events[0] == false)
			{
				$location = explode("/", $_SERVER['REQUEST_URI']);
				array_pop($location);
				header("Location: " . implode("/", $location));
				die();
			}

			$this->event = $this->events[0];
			$this->isDetail = true;
		}
		else
		{
			//Get a list of all posts ordered by publish date
			$this->events = CmsEventCollection::getAll(1);

			$this->isDetail = false;
		}
	}
}