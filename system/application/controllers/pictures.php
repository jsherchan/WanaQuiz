<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pictures extends Controller {

    function Pictures() {
        parent::Controller();
		ob_start();
		set_time_limit(10000);
		$this->load->library('resize_Image');
 		}
		
		
		function sizeit($width,$height,$picture_path)
		{
			$resize_image = new Resize_Image;
			// Folder where the (original) images are located with trailing slash at the end
			$images_dir = 'images/';
	
			// Image to resize
			//$image = $images_dir.$this->uri->segment(5);
			//$picture_path='http%3A%2F%2Fecx.images-amazon.com%2Fimages%2FI%2F41zt-RXYhfL.jpg';
			$image = trim(base64_decode($picture_path));
			//exit;
			//$image = 'http://ecx.images-amazon.com/images/I/41zt-RXYhfL.jpg';
			// Some validation 
			/*if(!@file_exists($image))
			{
				exit('The requested image does not exist.');
			}*/
	
			// Get the new with & height
			/*$new_width = (int)$_GET['new_width'];
			$new_height = (int)$_GET['new_height'];*/
			
			$new_width = $width;
			$new_height = $height;
	
			$resize_image->new_width = $new_width;
			$resize_image->new_height = $new_height;
	
			$resize_image->image_to_resize = $image; // Full Path to the file
	
			$resize_image->ratio = true; // Keep aspect ratio
	
			$process = $resize_image->resize(); // Output image    
		}
		
		
}
?>