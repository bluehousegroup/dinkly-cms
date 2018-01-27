<?php

use Symfony\Component\Yaml\Yaml;

class CmsThemeCollection
{
	public static function getShortNames($base = '../')
	{
		$themes = self::getAll($base);

		$theme_names = array();
		foreach($themes as $theme)
		{
			$theme_names[] = $theme->getShortName();
		}

		return $theme_names;
	}

	public static function getAll($base = '../')
	{
		$themes = array();

		$it = new RecursiveDirectoryIterator($base . 'web/themes/');
		foreach(new RecursiveIteratorIterator($it) as $file)
		{
			$path_parts = pathinfo($file);

			if($path_parts['filename'] == 'config' && $path_parts['extension'] == 'yml')
			{
				$theme_config = Yaml::parse($file);
				
				$theme = new CmsTheme();
				$theme->init($theme_config);
				$themes[] = $theme;
			}
		}

		return $themes;

	}

	public static function getByCode($code)
	{
		$it = new RecursiveDirectoryIterator('../web/themes/');
		foreach(new RecursiveIteratorIterator($it) as $file)
		{
			$path_parts = pathinfo($file);

			if($path_parts['filename'] == 'config' && $path_parts['extension'] == 'yml')
			{
				$theme_config = Yaml::parse($file);

				if($theme_config['code'] == $code)
				{
					$theme = new CmsTheme();
					$theme->init($theme_config);

					return $theme;
				}
			}
		}
	}
}