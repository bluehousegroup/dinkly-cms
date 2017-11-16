<?php
/**
 * CmsImage
 *
 * *
 * @package    Dinkly
 * @subpackage ModelsCustomClasses
 * @author     Christopher Lewis <lewsid@lewsid.com>
 */
class CmsImage extends BaseCmsImage
{
	//Overridden from DBObject to change the max mysql packet size
	public function save($force_insert = false)
	{
		$this->db->exec("SET GLOBAL max_allowed_packet=33554432");
		if(!$this->isNew && !$force_insert) { return $this->update(); }  //Perform an Update
		else { return $this->insert(); }               //Perform an Insert
	}

	public static function makeThumb($src, $dest, $desired_width, $format = 'image/jpeg')
	{
		/* read the source image */
		$source_image = null;
		if($format == 'image/jpeg')
		{
			$source_image = imagecreatefromjpeg($src);
		}
		else if($format == 'image/png')
		{
			$source_image = imagecreatefrompng($src);
		}

		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

		imageAlphaBlending($virtual_image, false);
		imageSaveAlpha($virtual_image, true);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		if($format == 'image/jpeg')
		{
			imagejpeg($virtual_image, $dest);
		}
		else if($format == 'image/png')
		{
			imagepng($virtual_image, $dest);
		}
	}

	public static function croppedResize($src, $dest, $desired_width, $desired_height, $format = 'image/jpeg')
	{	
		$source_image = null;
		if($format == 'image/jpeg')
		{
			$source_image = imagecreatefromjpeg($src);
		}
		else if($format == 'image/png')
		{
			$source_image = imagecreatefrompng($src);
		}

		$original_width = imagesx($source_image);
		$original_height = imagesy($source_image);

		$width = round($desired_width);
		$height = round($desired_height);

		// create a new, 'virtual' image
		$virtual_image = imagecreatetruecolor($width, $height);
		
		// Preserves transparency between images
		imageAlphaBlending($virtual_image, false);
		imageSaveAlpha($virtual_image, true);
		
		$destAR = $width / $height;
		if($width > 0 && $height > 0)
		{
			// We can't divide by zero theres something wrong.
			$srcAR = $original_width / $original_height;
		
			// Destination narrower than the source
			if($destAR < $srcAR)
			{
				$srcY = 0;
				$srcHeight = $original_height;
				
				$srcWidth = round( $original_height * $destAR );
				$srcX = round( ($original_width - $srcWidth) / 2 );
			}
			else // Destination shorter than the source
			{
				$srcX = 0;
				$srcWidth = $original_width;
				
				$srcHeight = round( $original_width / $destAR );
				$srcY = round( ($original_height - $srcHeight) / 2 );
			}
			
			imagecopyresampled($virtual_image, $source_image, 0,0, $srcX, $srcY, $width, $height, $srcWidth, $srcHeight);
		}

		// Create the physical thumbnail image to its destination */
		if($format == 'image/jpeg')
		{
			imagejpeg($virtual_image, $dest);
		}
		else if($format == 'image/png')
		{
			imagepng($virtual_image, $dest);
		}
	}
}

