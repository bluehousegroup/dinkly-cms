<?php
/**
 * Dinkly
 *
 * 
 *
 * @package    Dinkly
 * @subpackage CoreClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
use Symfony\Component\Yaml\Yaml;

class Dinkly extends BaseDinkly
{
	//Put your juicy overrides here

	/**
	 * (Legacy, use to preserve pre v3.12 behavior)
	 *
	 * Interpret friendly URLS and load app and module based on Context 
	 * as well as interpreting parameters where applicable
	 * @param string $uri default null to be parsed to get correct context
	 * @return Array of matching objects or false if not found
	 */
	
	public function route($uri = null)
	{
		$context = $this->getContext($uri);

		$_SESSION['dinkly']['current_app_name'] = $context['current_app_name'];

		$this->loadModule($context['current_app_name'], $context['module'], $context['view'], false, true, $context['get_params']);
	}
	
	/**
	 * We override the built-in error handling to make sense of the special shortened urls
	 */
	public function loadError($requested_app_name, $requested_camel_module_name, $requested_view_name = null, $requested_plugin_name = null)
	{
		$uri = $_SERVER['REQUEST_URI'];
		$uri_parts = array_filter(explode("/", $uri));

		if($uri_parts != array())
		{
			//Strip the slug off the url
			$slug = $uri_parts[1];
			unset($uri_parts[1]);

			//Keep the rest intact to be parsed as parameters
			$url_chunk = implode('/', $uri_parts);
			$pivot_url = '/home/default/' . $url_chunk;
			
			$page = new CmsPage();
			$parts = explode('/', $slug);
			$page->initWithSlug($slug, false, false);

			$this->resetContext($pivot_url);
			$context = $this->getContext();

			$context['get_params']['slug'] = $slug;

			if($page->getDetail())
			{
				return $this->loadModule('cms_site', 'home', 'default', false, true, $context['get_params']);
			}
		}

		//Check for base dinkly 404
		$error_controller = $_SERVER['APPLICATION_ROOT'] . "apps/error/modules/http/ErrorHttpController.php";
		
		if(file_exists($error_controller))
		{
			return $this->loadModule('error', 'http', '404', false, $parameters = array('requested_app' => $requested_app_name, 'requested_module' => $requested_camel_module_name, 'requested_view' => $requested_view_name, 'requested_plugin' => $requested_plugin_name));
		}
	}

	/**
	 * Load desired module and redirect if necessary (Legacy, use to preserve pre v3.12 behavior)
	 * Requires legacy route($uri) function to work properly
	 * 
	 *
	 * @param string $app_name name of app we are trying to load
	 * @param string $module_name string of desired module to load
	 * @param string $view string if passed goes to specified view otherwise default
	 * @param bool $redirect default false, make true to redirect to different view
	 * @param bool $draw_layout default true to get module view (overrides return value in controller)
	 * @param array $parameters Array of parameters that can be used to populate views
	 * @param boolean #load_as_component Disregards whether headers were sent, allowing for nested calls to loadModule
	 *
	 * @return bool true if app loaded currectly else false and sent to default app
	 */

	
	public function loadModule($app_name, $module_name = null, $view_name = 'default', $redirect = false, $draw_layout = true, $parameters = null, $load_as_component = false)
	{
		return parent::loadModule($app_name, $module_name, $view_name, $redirect, $parameters, $load_as_component);
	}
	

	/**
	 * Load previous module (Legacy, use to preserve pre v3.12 behavior)
	 * Requires legacy route($uri) function to work properly
	 *
	 * @param string $depth How deep into the context stack you want to go. Default is 1, which returns the module 1
     *                      previous to the current.	                        
     * @param bool $redirect default false, make true to redirect to different view
	 * @param bool $draw_layout default true to get module view
	 * @param array $parameters Array of parameters that can be used to populate views (defaults to last module's parameters)
	 *
	 * @return bool true if app loaded currectly else false and sent to default app
	 */

	
	public function loadPreviousModule($depth = 1, $redirect = false, $draw_layout = true, $parameters = array())
	{
		self::loadPreviousModule($depth, $redirect, $parameters);
	}
	
}