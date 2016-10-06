<?php 
	class Upload_image extends Controller
	{
		function Upload_image()
		{
			parent::Controller();
			$this->load->helper('videoconversion');
			$this->load->library('session');
			$this->load->library('images');
			$this->load->helper('image');
			error_reporting(E_ALL ^ E_NOTICE);
		}

                function index1()
                { $fp=fopen('test.txt','w');
				fputs($fp,'entered');
				fclose($fp);
                                $headers= "From: tosushilkhadka@gmail.com \x0d\x0a";
                                $headers .= "MIME-Version: 1.0\x0d\x0a";
                                $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
                                mail('siran_majan@hotmail.com','test','image',$headers);

                    echo "success";
                }

		function index()
                { 
				
				
                   if (!empty($_FILES))
                        {
							$fp=fopen('test.txt','w');
				fputs($fp,'entered1');
				fclose($fp);
                                $tempFile = $_FILES['Filedata']['tmp_name'];
                                $original_file = str_replace(' ','_',$_FILES['Filedata']['name']);
                                //$targetPath = $_SERVER['DOCUMENT_ROOT'] .  '/images/gallery_images/';
                                $targetPath = 'user_uploaded_photos/5/';
                               $filename = explode('.',$original_file);
                                if(file_exists($targetPath.$original_file))
                                {
                                       $name = $filename[0].rand(1,10000);
                                       $file_name= $name.'.'.$filename[1];
                                }
                                else $file_name = $original_file;

                                $targetFile =  str_replace('//','/',$targetPath) . $file_name;

                                move_uploaded_file($tempFile,$targetFile);
                                
                                $this->images->squareThumb('user_uploaded_photos/5/'.$file_name,'photo_question_thumbs/'.$file_name,100);
	
								image_thumb('user_uploaded_photos/5/'.$file_name,'photo_question_images/',$file_name, 400, 400);
							
								$data=array('user_id'=>5,'photo_name'=>$file_name);
								$this->db->insert('tbl_members_photos',$data);


                                echo "1";

                        }
                }


	}

?>