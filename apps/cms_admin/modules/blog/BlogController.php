<?php

class BlogController extends SiteAdminController 
{
	public function loadDefault($parameters)
	{
		$this->loadModule('site_admin', 'blog', 'edit', true, true);

		return false;
	}

	public function loadEdit($parameters)
	{
		$this->edit_post = null;
		
		if(isset($parameters['post'])) 
		{
			$this->edit_post = PostCollection::getBlogPostById($parameters['post']);
		}
		
		$this->posts = PostCollection::getBlogPostList(false, true);
		
		return true;
	}

	public function loadSave($parameters)
	{ 
		//if editing, set old post as not published
		if($_POST["id"] != "")
		{
			$old_post = PostCollection::getBlogPostById($_POST["id"]);
			$old_post->setPostStatus("inherit");
			$old_post->save();
		}

		//Inherit slug or create one if new
		if($_POST["name"] != "") $slug = $_POST["name"];
		else
		{
			$slug = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $_POST["title"]);
			$slug = str_replace("+", "", $slug);
			$slug = str_replace(" ", "-", strtolower($slug));
		}

		//Create new post
		$post = new Post();
		$post->setPostTitle($_POST["title"]);
		$post->setPostName($slug);
		$post->setPostAuthor($_POST["author"]);
		$post->setPostContent($_POST["content"]);
		$post->setPostStatus("publish");
		if($_POST["post_date"]) $post->setPostDate(date("Y-m-d h:i:s", strtotime($_POST["post_date"])));
		else $post->setPostDate(date("Y-m-d h:i:s"));
		$post->setPostModified(date("Y-m-d h:i:s"));
		$post->setPostType("post");
		$post->save();

		$id = $post->getId();

		$this->loadModule('site_admin', 'blog', 'edit', true, true, array('post' => $id));
	}

	public function loadDelete($parameters)
	{ 
		//Strange this comes in as 1 if empty (guess we're screwed if we want to delete post 1 ?)
		if($parameters['post'] > 1)
		{
			$old_post = PostCollection::getBlogPostById($parameters['post']);
			$old_post->setPostStatus("inherit");
			$old_post->save();
		}

		$this->loadModule('site_admin', 'blog', 'edit', true, true);

		return false;
	}
}
