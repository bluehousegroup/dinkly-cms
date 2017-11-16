<?php

use Symfony\Component\Yaml\Yaml;

class CmsDesignCollection
{
	public static function getShortNames($base = '../')
	{
		$designs = self::getAll($base);

		$design_names = array();
		foreach($designs as $design)
		{
			$design_names[] = $design->getShortName();
		}

		return $design_names;
	}

	public static function getAll($base = '../')
	{
		$designs = array();

		$it = new RecursiveDirectoryIterator($base . 'web/designs/');
		foreach(new RecursiveIteratorIterator($it) as $file)
		{
			$path_parts = pathinfo($file);

			if($path_parts['filename'] == 'config' && $path_parts['extension'] == 'yml')
			{
				$design_config = Yaml::parse($file);
				
				$design = new CmsDesign();
				$design->init($design_config);
				$designs[] = $design;
			}
		}

		return $designs;

	}

	public static function getByCode($code)
	{
		$it = new RecursiveDirectoryIterator('../web/designs/');
		foreach(new RecursiveIteratorIterator($it) as $file)
		{
			$path_parts = pathinfo($file);

			if($path_parts['filename'] == 'config' && $path_parts['extension'] == 'yml')
			{
				$design_config = Yaml::parse($file);

				if($design_config['code'] == $code)
				{
					$design = new CmsDesign();
					$design->init($design_config);

					return $design;
				}
			}
		}
	}
}