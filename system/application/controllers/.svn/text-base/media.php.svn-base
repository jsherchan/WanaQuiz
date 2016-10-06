<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media extends Controller {
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Media()
	{
		parent::Controller();
		$this->load->helper('videoconversion');
		$this->load->library('session');
		$this->load->library('images');
		$this->load->helper('image');
                $this->load->library('pagination');
                #ini_set('display_errors',0);
	}
	function uploaded($filename){
		$out=explode(".",$filename);
		$filename = $out[0].".flv";
	
		$data='      <strong>Below is the processed video</strong>
                    <br /><br />
                    <a
                        href="'.base_url().'converted_videos/'.$filename.'"
                        style="display:block;width:425px;height:300px;"
                        id="player">
                    </a>
           <script language="JavaScript">
            flowplayer("player", "'.base_url().'flowplayer/flowplayer-3.1.5.swf",{
                                            clip: {

                                                // these two configuration variables does the trick
                                                autoPlay: false,
                                                autoBuffering: true // <- do not place a comma here
                                            }
                                        });
           </script>';
                echo $data;
         }
        
        function photoUploaded1(){
            echo 'done';
            exit('in');
		$this->load->model('Media_model');
                $photos_list = $this->Media_model->getMemberPhotos($this->session->userdata('wannaquiz_user_id'));                
                $config['base_url'] = site_url('/member/uploadPhoto');
        $config['total_rows']=count($photo_list);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        $photos_list = $this->Media_model->getMemberPhotos($this->session->userdata('wannaquiz_user_id'),$config['per_page'],$offset);
                if($photos_list!=NULL){foreach($photos_list as $photo){
                 if($_SERVER['SERVER_NAME']=='localhost')
				 $photo_path = $_SERVER['DOCUMENT_ROOT'].'/wannaquiz/photo_question_thumbs/'.$photo->photo_name;
				 else
				 #$photo_path = $_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz/photo_question_thumbs/'.$photo->photo_name;
                                 $photo_path = $_SERVER['DOCUMENT_ROOT'].'/photo_question_thumbs/'.$photo->photo_name;
                   if(file_exists($photo_path))
                   $mid_data = '<img src="'.base_url().'photo_question_thumbs/'.$photo->photo_name.'" alt="feature quest img" />';
                   else
                   $mid_data = '<img src="'.base_url().'images/default_img.jpg" alt="feature quest img" height="100px" width="100px">';
                $data.='<div class="viewimg">
                            <div class="border_green">
                                <a href="'.base_url().'user_uploaded_photos/'.$this->session->userdata("wannaquiz_user_id").'/'.$photo->photo_name.'" rel="lightbox">
                                     '.$mid_data.'
                                    
                                </a>
                            </div>
                            <div>
                                <label><input type="checkbox" name="name_'.$photo->photo_id.'" value="'.$photo->photo_id.'" class="check_name"></label>                                
                            </div>
                        </div>';
                }}
        echo $data;
	}
        function photoUploaded2(){ $this->load->model('Media_model');
                $photos_list = $this->Media_model->getMemberPhotos($this->session->userdata('wannaquiz_user_id'));                
                $config['base_url'] = site_url('/member/uploadPhoto');
        $config['total_rows']=count($photo_list);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        $photos_list = $this->Media_model->getMemberPhotos($this->session->userdata('wannaquiz_user_id'),$config['per_page'],$offset);
                if($photos_list!=NULL){foreach($photos_list as $photo){
                 if($_SERVER['SERVER_NAME']=='localhost')
				 $photo_path = $_SERVER['DOCUMENT_ROOT'].'/wannaquiz/photo_question_thumbs/'.$photo->photo_name;
				 else
				 #$photo_path = $_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz/photo_question_thumbs/'.$photo->photo_name;
                                 $photo_path = $_SERVER['DOCUMENT_ROOT'].'/photo_question_thumbs/'.$photo->photo_name;
                   if(file_exists($photo_path))
                   $mid_data = '<img src="'.base_url().'photo_question_thumbs/'.$photo->photo_name.'" alt="feature quest img" />';
                   else
                   $mid_data = '<img src="'.base_url().'images/default_img.jpg" alt="feature quest img" height="100px" width="100px">';
                $data.='<div class="viewimg">
                            <div class="border_green">
                                <a href="'.base_url().'user_uploaded_photos/'.$this->session->userdata("wannaquiz_user_id").'/'.$photo->photo_name.'" rel="lightbox">
                                     '.$mid_data.'
                                    
                                </a>
                            </div>
                            <div>
                                <label><input type="checkbox" name="name_'.$photo->photo_id.'" value="'.$photo->photo_id.'" class="check_name"></label>                                
                            </div>
                        </div>';
                }}
        echo $data; }
	
	function videoUploaded(){
		$this->load->model('Media_model');
                $video_list = $this->Media_model->getMemberVideoImages($this->session->userdata('wannaquiz_user_id'));
                $config['base_url'] = site_url('/media/videoUploaded');
        $config['total_rows']=count($video_list);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        $video_list = $this->Media_model->getMemberVideoImages($this->session->userdata('wannaquiz_user_id'),$config['per_page'],$offset);
                if($video_list!=NULL){
                    foreach($video_list as $video){
				$vd=explode('.',$video->video_name);
				if($_SERVER['SERVER_NAME']=='localhost')
                                $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
				else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                if(file_exists($a))
                $mid_data1 = '<img src="'.base_url().'converted_video_images/converted_video_images_thumbs/'.$vd[0].'.jpg" alt="feature quest img" />';
                else
                $mid_data1 = '<img src="'.base_url().'images/video_img.jpg" alt="feature quest img" height="100px" width="100px">';

                $data.='<div class="viewimg">
                            <div class="border_green">
                                    '.$mid_data1.'
                                
                            </div>
                            <div>
                                <label><input type="checkbox" name="name_'.$video->video_id.'" value="'.$video->video_id.'" class="check_name"></label>                               
                            </div>
                        </div>';
                }}
            //$data.='<div style="text-align:right">'.$pagination.'</div>';
        echo $data;
	}

	function uploadPhotoHandler(){
		$id  = $_GET['sessionId'];
		$id = trim($id);
		$inputName = $_GET['userfile'];
		$fileName  = $_FILES[$inputName]['name'];
		$tempLoc   = $_FILES[$inputName]['tmp_name'];
		//echo $_FILES[$inputName]['error'];
		
		$user_id=$this->session->userdata('wannaquiz_user_id');
		
		mkdir('user_uploaded_photos/'.$user_id, 0755, true);
		$targetPath ='user_uploaded_photos/'.$user_id.'/';
		$targetFile =  $targetPath . $fileName;
		move_uploaded_file($tempLoc,$targetFile);
	
		#$this->images->squareThumb('user_uploaded_photos/'.$user_id.'/'.$fileName,'photo_question_thumbs/'.$fileName,100);
	
		image_thumb('user_uploaded_photos/'.$user_id.'/'.$fileName,'photo_question_images/',$fileName, 470, 400);
	
		$data=array('user_id'=>$user_id,'photo_name'=>$fileName);
		$this->db->insert('tbl_members_photos',$data);
		
		$this->session->set_userdata(array('value' => -1));
	}
	
	function getInfoHandler(){
		$id = $this->input->post('sessionId',TRUE);
		$id = trim($id);
		//session_name($id);
		echo $this->session->userdata('value');
		if($this->session->userdata('value')==-1)
		{
		  $this->session->unset_userdata('value');
		}
	}
	
	function getIdHandler(){
		  $id = uniqid('id');
		 // session_name($id);
		  $this->session->set_userdata(array('value' => 0));
		  echo $id;
	}
	
	

	function uploadVideoHandler()
        {           
            $this->load->helper('videoconversion');
            $id  = $_GET['sessionId'];
            $id = trim($id);

            $inputName = $_GET['userfile'];
            $fileName  = $_FILES[Filedata]['name'];
            
            $fp=fopen('test.txt','w');
            fputs($fp,$fileName."hello");
            fclose($fp);
           
            $tempLoc   = $_FILES[$inputName]['tmp_name'];            
            $user_id=$this->session->userdata('wannaquiz_user_id');	
		
            $targetPath = 'uploaded_videos/';
            $targetFile =  $targetPath . $fileName;
    
            move_uploaded_file($tempLoc,$targetFile);
            
            if($_SERVER['HTTP_HOST']=='localhost') { $rootpath="D:/xampp/htdoc/wannaquiz/"; }        
            else $rootpath=realpath('\domains\wannaquiz.com\public_html');             
            #else { $rootpath=realpath('\home\proshore\domains\proshore.eu\public_html\clients\wannaquiz'); }

            $inputpath="uploaded_videos";
            $outputpath="converted_videos";
            $outputpath1="converted_video_images";
            $VideoFileName=$inputpath.'/'.$fileName;
            $diamension=get_video_dimensions($VideoFileName);
//           echo $diamension['width'];
//             echo $diamension['height'];
//            $width=$diamension['width'];
//            $height=$diamension['height'];
//            $asp=$width/$heignt;
//            if($asp>=1.33 && $asp <=1.35)
//           {
//            $width=360;
//            $height=270;
//            }
//           if($asp>=1.70 && $asp <=1.78)
//           {
//            $width=480;
//            $height=270;
//           }
            $width=480;
            $height=270;
            $bitrate=64;
            $samplingrate=22050;

            //video conversion
            $flv_file=convert_media($fileName, $rootpath, $inputpath, $outputpath, $width, $height, $bitrate, $samplingrate);      
            $outfile=$fileName;  					// original file wmv
            //
            // capturing image file
            $flv_image=grab_image($outfile, $rootpath, $inputpath,$outputpath1, "1", "1", "jpg", "120", "120");

            $out=explode(".",$fileName);
            $filename_image = $out[0].".jpg";

            $this->images->squareThumb('converted_video_images/'.$filename_image,'converted_video_images/converted_video_images_thumbs/'.$filename_image,100);
            //image_thumb('converted_video_images/'.$fileName,'converted_video_images/converted_video_images_thumbs/'.$fileName,100, 100);

            $data=array('user_id'=>$user_id,'video_name'=>$fileName);
            $this->db->insert('tbl_members_videos',$data);

            $this->session->set_userdata(array('value' => -1));		
	}
	
    function rating($media_id){
        
        $option = array('user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'media_id'=>$media_id
            );
        
        $query = $this->db->getwhere('tbl_media_ratings',$option);
        //echo $query->num_rows();exit;
        if($this->session->userdata('wannaquiz_user_id')=="") echo "not_logged_in";

        elseif($query->num_rows()>0)
        echo "error";

        else {
		$rating=$this->input->post('rating',TRUE);
        if($this->session->userdata('wannaquiz_user_id')!=""){
            $data=array('media_id'=>$media_id,
                        'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                        'rating'=>$rating,
                        'rating_date'=>current_date_time_stamp()
                        );
            $this->db->insert('tbl_media_ratings',$data);
        }
        echo "success";
	}

        
    }

    function imageUploadHandler(){        
        $user_id = $this->input->post('user_id',TRUE);
        //echo $this->session->userdata('wannaquiz_user_id'); exit;

         if (!empty($_FILES))
         {
            if(is_dir('user_uploaded_photos/'.$user_id)){}
            else
                mkdir('user_uploaded_photos/'.$user_id, 0777, true);
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $original_file = str_replace(' ','_',$_FILES['Filedata']['name']);
            //$targetPath = $_SERVER['DOCUMENT_ROOT'] .  '/images/gallery_images/';
            $targetPath = 'user_uploaded_photos/'.$user_id.'/';
           $filename = explode('.',$original_file);
           $targetPaths = 'photo_question_images/';
/*
           $fp=fopen('test.txt','w');
            fputs($fp,$user_id."hel".$filename);
            fclose($fp);
 * 
 */
            if(file_exists($targetPath.$original_file))
            {
                   $name = $filename[0].rand(1,10000);
                   $file_name= $name.'.'.$filename[1];
            }
            else if (file_exists($targetPaths.$original_file))
                {
                  $name = $filename[0].rand(1,10000);
                  $file_name= $name.'.'.$filename[1];
               }
            else $file_name = $original_file;

            $targetFile =  str_replace('//','/',$targetPath) . $file_name;

            if(move_uploaded_file($tempFile,$targetFile))
            {
                $src_img = 'user_uploaded_photos/'.$user_id.'/'.$file_name;
                
                $this->images->squareThumb($src_img,'photo_question_thumbs/'.$file_name,100);
                               image_thumb($src_img,'photo_question_images/',$file_name, 340, 434);
                
                $data=array('user_id'=>$user_id,'photo_name'=>$file_name);
                $this->db->insert('tbl_members_photos',$data);
                
                echo "1";
            }
            else
            {
                error_reporting(E_ALL);
                #echo "Problem With Image Upload";
                echo "0";
            }            
        }
    }

    function videoUploadHandler(){    
        #ini_set('display_errors',1);
        $this->load->helper('videoconversion');
        //$id  = $_GET['sessionId'];
        //$id = trim($id);
        #echo "test";return;
        $tempFile = $_FILES['Filedata']['tmp_name'];                                
        $original_file = str_replace(' ','_',$_FILES['Filedata']['name']);                
        $targetPath = 'uploaded_videos/';
        $filename = explode('.',$original_file);
        
        if(file_exists($targetPath.$original_file))
        {
               $name = $filename[0].rand(1,10000);
               $file_name= $name.'.'.$filename[1];
        }
        else $file_name = $original_file;

        $targetFile =  str_replace('//','/',$targetPath) . $file_name;                

        move_uploaded_file($tempFile,$targetFile);

        $user_id = $this->input->post('user_id',TRUE);                

        #else { $rootpath=realpath('\home\proshore\domains\proshore.eu\public_html\clients\wannaquiz'); }
         if($_SERVER['SERVER_NAME']=='localhost') 
            $rootpath="D:/xampp/htdocs/wannaquiz/";
        else
            $rootpath="/home/wannaquiz/domains/wannaquiz.com/public_html/";        
         
        $inputpath = $rootpath . "uploaded_videos";
        $outputpath = $rootpath . "converted_videos";
        $outputpath1 = $rootpath . "converted_video_images";
        $outputpath2 = $outputpath1 . "converted_video_images/converted_video_images_thumbs";
        
           $VideoFileName=$inputpath.'/'.$fileName;
           $dimension=get_video_dimensions($VideoFileName);
           $width=$dimension['width'];
           $height=$dimension['height'];
           if($height!=0)$asp=$width/$heignt;
           if($asp>=1.33 && $asp <=1.35)
           {
            $width=360;
            $height=270;
            }
           if($asp>=1.70 && $asp <=1.78)
           {
            $width=480;
            $height=270;
           }
           else{
           $width=480;
           $height=270;
           }
           $bitrate=64;
        $samplingrate=22050;

        //video conversion
      
        $flv_file = convert_media($file_name, $rootpath, $inputpath, $outputpath, $width, $height, $bitrate, $samplingrate);
        $video_duration = video_length($inputpath,$file_name);
       if($video_duration > '00:00:50.00') { unlink($inputpath.'/'.$file_name); echo "%error";}
        else
        {
            $outfile = $file_name; # original file wmv            
            $flv_image=grab_image($outfile, $rootpath, $inputpath,$outputpath1, "1", "1", "jpg", "120", "120"); # capturing image file
            
            if($flv_image)
            {
                $out=explode(".",$file_name);
                $filename_image = $out[0].".jpg";
                $filename_image2 = $out[0] . '2'.".jpg";

                $this->images->squareThumb($outputpath1 . '/'.$filename_image,$outputpath2 . '/'.$filename_image,100);
                $this->images->squareThumb($outputpath1 . '/'.$filename_image,$outputpath1 . '/' . $filename_image2,100);

                $data=array('user_id'=>$user_id,'video_name'=>$file_name);
                $this->db->insert('tbl_members_videos',$data);           

                $this->session->set_userdata(array('value' => -1));
                echo "%success";
           }
        }
    }		
}
/* End of file page.php */
/* Location: ./application/controllers/page.php */


