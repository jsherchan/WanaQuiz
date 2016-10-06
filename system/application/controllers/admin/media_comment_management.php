<?

class Media_comment_management extends Front_controller {

    function Media_comment_management() {
        parent::Front_controller();
        $this->load->library('parser');
        $this->load->model('Media_comment_model');
        $this->load->model('Email_model');
        $this->load->library('pagination');

    }

    function index() {
        $this->load->model('Ip_block_model');
        $data['title'] = 'WannaQuiz:Quiz Images Management';
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/index/');
        $data['quiz_images'] = $this->Media_comment_model->get_quiz_images();
        $config['total_rows']=count($data['quiz_images']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['quiz_images'] = $this->Media_comment_model->get_quiz_images($config['per_page'],$offset);
        $data['main']='admin/media_comment';
        $data['offset'] = $offset;
        $data['flag'] = 'quiz_image';
        $this->parser->parse('admin/admin',$data);
    }

    function getQuizComments(){
        $data['title'] = 'Wannaquiz:Quiz Comment Management';
        $data['quiz_comments'] = $this->Media_comment_model->get_quiz_comments();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getQuizComments/');
        $config['total_rows']=count($data['quiz_comments']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_comments'] = $this->Media_comment_model->get_quiz_comments($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/media_comment_quiz_comment';
        $data['flag1'] = 'quiz_comment';
        $this->parser->parse('admin/admin',$data);
    }

    function getQuizVideos(){
        $this->load->model('Ip_block_model');
        $data['title'] = 'Wannaquiz:Quiz Videos Management';
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getQuizVideos/');
        $data['quiz_videos'] = $this->Media_comment_model->get_quiz_videos();
        $config['total_rows']=count($data['quiz_videos']);
        $config['per_page'] = '5';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_videos'] = $this->Media_comment_model->get_quiz_videos($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/media_comment';
        $data['flag'] = 'quiz_video';
        $this->parser->parse('admin/admin',$data);
    }

    function getProfileImages(){
        $data['title'] = 'Wannaquiz:Profile Image Management';
        $data['profile_images'] = $this->Media_comment_model->get_profile_images();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getProfileImages/');
        $config['total_rows']=count($data['profile_images']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['profile_images'] = $this->Media_comment_model->get_profile_images($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/media_comment_profile_image';
        //$data['spam_type'] = 'quiz_videos';
        $this->parser->parse('admin/admin',$data);
    }

    function getProfileComments() {
        $data['title'] = 'Wannaquiz:Profile Comment Management';
        $data['profile_comments'] = $this->Media_comment_model->get_profile_comments();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getProfileComments/');
        $config['total_rows']=count($data['profile_comments']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['profile_comments'] = $this->Media_comment_model->get_profile_comments($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/media_comment_quiz_comment';
        $data['flag1'] = 'profile_comment';
        $this->parser->parse('admin/admin',$data);
    }

    function deleteQuizComments($comment_id) {
        if ($comment_id) {
            $this->db->where("comment_id", $comment_id);
            
                $this->db->delete("tbl_quiz_comments");
            
        }
        $this->session->set_flashdata('message','Selected Comment Deleted Successfully.');
       
            redirect(ADMIN_PATH.'/media_comment_management/getQuizComments');

    }

    function deleteProfileImage($member_id,$profile_image) {
        if ($member_id) {
            $this->db->where("member_id", $member_id);
            $data = array('profile_picture'=>'');
                $this->db->update("tbl_member_profile",$data);
                $img = PROFILE_IMAGES.'/'.$profile_image;
                $img1 = PROFILE_IMAGES_THUMB.'/'.$profile_image;
                unlink($img);
                unlink($img1);
        }
        $this->session->set_flashdata('message','Selected Comment Deleted Successfully.');

            redirect(ADMIN_PATH.'/media_comment_management/getProfileImages');

    }

    function deleteQuiz($quiz_id,$quiz_image1,$quiz_image2,$user_id){
              if ($quiz_id) {
            $this->db->where("quiz_id", $quiz_id);
            //$data = array('status'=>'0');
                $this->db->delete("tbl_quizes");
                $this->db->where("quiz_id",$quiz_id);
                $this->db->delete("tbl_quiz_comments");
                  $this->db->where("quiz_id",$quiz_id);
                $this->db->delete("tbl_quiz_images");
                // echo $quiz_image1;
                if($quiz_image1!=''){
                    $img1 = PHOTO_QUESTION_THUMB.'/'.$quiz_image1;
                    unlink($img1);
                    $img2=PHOTO_QUESTION_IMAGES.'/'.$quiz_image1;
                    unlink($img2);
                }
                if($quiz_image2!=''){
                    $img1 = PHOTO_QUESTION_THUMB.'/'.$quiz_image2;
                    unlink($img1);
                    $img2=PHOTO_QUESTION_IMAGES.'/'.$quiz_image2;
                    unlink($img2);
                }
                
        }
        $this->session->set_flashdata('message','Selected Quiz Deleted Successfully.');

            redirect(ADMIN_PATH.'/media_comment_management');
    }

    function deleteQuizVideo($quiz_id,$video1,$video2){
        if ($quiz_id) {
            $this->db->where("quiz_id", $quiz_id);
           
                $this->db->delete("tbl_quizes");
                $this->db->where("quiz_id",$quiz_id);
                $this->db->delete("tbl_quiz_comments");
                $this->db->where("quiz_id",$quiz_id);
                $this->db->delete("tbl_quiz_images");
               // echo $quiz_image1;
                if($video1!=''){
                    $data = 'uploaded_videos'.'/'.$video1;
                    unlink($data);
                    $data1 = 'converted_videos'.'/'.$video1;
                    unlink($data1);
                }
                if($video2!=''){
                    $data2 = 'converted_videos'.'/'.$video2;
                    unlink($data2);
                    $data3 = 'uploaded_videos'.'/'.$video2;
                    unlink($data3);
                }
        }
        $this->session->set_flashdata('message','Selected Comment Deleted Successfully.');

            redirect(ADMIN_PATH.'/media_comment_management');
    }

    function getFeaturedImageQuizes(){
        $data['title'] = 'Wannaquiz:Quiz Featured Quizes';
        $data['quiz_images'] = $this->Media_comment_model->get_featured_image_quizes();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getFeaturedImageQuizes/');
        $config['total_rows']=count($data['quiz_images']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_images'] = $this->Media_comment_model->get_featured_image_quizes($config['per_page'],$offset);
        $data['main']='admin/featured_new_quizes';
        $data['offset'] = $offset;
        $data['flag'] = 'featured_quiz_image';
        $this->parser->parse('admin/admin',$data);
    }

    function getFeaturedVideoQuizes(){
        $data['title'] = 'Wannaquiz:Quiz Featured Quizes';
        $data['quiz_videos'] = $this->Media_comment_model->get_featured_Video_quizes();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getFeaturedVideoQuizes/');
        $config['total_rows']=count($data['quiz_videos']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_videos'] = $this->Media_comment_model->get_featured_Video_quizes($config['per_page'],$offset);
        $data['main']='admin/featured_new_quizes';
        $data['offset'] = $offset;
        $data['flag'] = 'featured_quiz_video';
        $this->parser->parse('admin/admin',$data);
    }

    function getTryNewImageQuizes(){
        $data['title'] = 'Wannaquiz:Quiz Featured Quizes';
        $data['quiz_images'] = $this->Media_comment_model->get_try_new_image_quizes();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getTryNewImageQuizes/');
        $config['total_rows']=count($data['quiz_images']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_images'] = $this->Media_comment_model->get_try_new_image_quizes($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/featured_new_quizes';
        $data['flag'] = 'try_new_quiz_image';
        $this->parser->parse('admin/admin',$data);
    }

    function getTryNewVideoQuizes(){
        $data['title'] = 'Wannaquiz:Quiz Featured Quizes';
        $data['quiz_videos'] = $this->Media_comment_model->get_try_new_Video_quizes();
        $config['base_url'] = site_url(ADMIN_PATH.'/media_comment_management/getTryNewVideoQuizes/');
        $config['total_rows']=count($data['quiz_videos']);
        $config['per_page'] = '40';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['quiz_videos'] = $this->Media_comment_model->get_try_new_Video_quizes($config['per_page'],$offset);
        $data['offset'] = $offset;
        $data['main']='admin/featured_new_quizes';
        $data['flag'] = 'try_new_quiz_video';
        $this->parser->parse('admin/admin',$data);
    }

}
?>