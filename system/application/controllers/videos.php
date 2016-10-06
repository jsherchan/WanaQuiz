<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Videos extends Controller {
    function Videos()
	{
		parent::Controller();
		$this->load->helper('videoconversion');
		$this->load->library('session');
		$this->load->library('images');
		$this->load->helper('image');
                $this->load->library('pagination');
              
	}

function index()
{
     $rootpath="D:/xampp/htdoc/wannaquiz/";
     $inputpath = $rootpath . "uploaded_videos";
     $file_name="Earth.wmv";
      $video_duration = video_length($inputpath,$file_name);
      echo "this".$video_duration;
       exit;
 
}
}

 ?>
