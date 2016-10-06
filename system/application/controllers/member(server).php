<?php

class Member extends Front_controller {

    var $user_type;
    var $user_id;
    function Member() {

        parent::Front_controller();
        $this->load->library('session');
        $this->load->library('parser');
        $this->load->model('Member_model');
        $this->load->model('Media_model');
        $this->load->model('User_model');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->user_type=$this->getMemberType();
        $this->user_id=$this->session->userdata('wannaquiz_user_id');

    }

    function index() {
        $this->checkMemberLogin();
        $data['title']="Member Home";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="member/regular_member_home";
        $this->load->view('userhome',$data);
    }

    function userHome() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/userHome')));
        $this->checkMemberLogin();
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['company_info'] = $this->Member_model->get_company_detail($this->user_id);
        $data['address'] = $this->Member_model->get_address($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        //echo"test";
        if($data['mem_info']->user_type!=0){
            $data['content1']=$this->pages_model->get('advertiser_member_how_to_start1');
            $data['content2']=$this->pages_model->get('advertiser_member_how_to_start2');
            $data['content3']=$this->pages_model->get('advertiser_member_how_to_start3');
        }
        else{
            $data['content1']=$this->pages_model->get('regular_member_how_to_start1');
            $data['content2']=$this->pages_model->get('regular_member_how_to_start2');
            $data['content3']=$this->pages_model->get('regular_member_how_to_start3');
        }
        $data['title']="Member Home";
        $data['main']="member/advertiser_member_home";
        $this->load->view('userhome',$data);
    }

    function advertiser($page) {
        $this->checkMemberLogin();
        $data['title']="Member Home";

        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_friends']=$this->Member_model->get_friends($this->user_id);
        $data['mem_profile']=$this->Member_model->get_member_profile($mem_id);
        $data['count_comments']=$this->Member_model->count_profile_comments($mem_id);
        $config['base_url'] = site_url('/member/advertiser/'.$page);
        $config['total_rows']= $count_comments;
        $config['per_page'] = '5';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);
        $data['subscriber']= $this->Member_model->check_subscriber($mem_id);
        $data['subscriber_info'] = $this->Member_model->get_subscribers($mem_id);
        $data['profile_id']=$mem_id;
        $data['profile_comments']=$this->Member_model->get_profile_comments($mem_id,$config['per_page'],$offset);
        if($page=='profile')
            $data['main']="member/advertiser_profile";
        if($page=='buy')
            $data['main']="member/advertiser_buy";
        if($page=='buy2')
            $data['main']="member/advertiser_buy2";

        $this->load->view('userhome',$data);
    }

    function profile($username) {
    //$this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $this->load->model('Award_model');
        $mem_id = $this->Member_model->get_user_id($username);
        $this->Quiz_model->set_user_position($mem_id);
        $this->Quiz_model->set_levels($mem_id);
        $this->Quiz_model->set_profile_view_click('view',$mem_id);
        $data['title']="Member Home";
        $this->Quiz_model->set_ads_view($mem_id,'banner');
        $data['mem_info']=$this->Member_model->get_member($mem_id);
        $data['mem_profile']=$this->Member_model->get_member_profile($mem_id);
        $data['company_detail'] = $this->Member_model->get_company_detail($mem_id);
        $data['mem_friends']=$this->Member_model->get_friends($mem_id);
        $data['level_info'] = $this->Quiz_model->get_member_level($mem_id);
        $data['previous_level_info'] =$this->Quiz_model->get_member_previous_level($mem_id,($data['level_info']->level_id - 1));
        $data['count_comments']=$this->Member_model->count_profile_comments($mem_id);
        $result=$this->Member_model->get_profile_comments($mem_id,0,0);
        $config['base_url'] = base_url().'member/profile/'.$username;
        $data['member_awards'] = $this->Award_model->get_member_awards($mem_id);
        $data['member_category_titles'] = $this->Category_model->get_member_category_titles($mem_id);

        $config['total_rows']=  count($result);
        $config['per_page'] = '5';
        $config['uri_segment'] = '4';
        $offset=$this->uri->segment(4,0);
        $this->pagination->initialize($config);

        $data['levels'] = $this->Quiz_model->get_levels($mem_id);
        //print_r($levels = $this->Quiz_model->get_levels($mem_id));//exit;
        $data['quiz_avg_points'] = $this->Quiz_model->get_quiz_points('2',$mem_id);
        $data['quiz_hard_points'] = $this->Quiz_model->get_quiz_points('3',$mem_id);
        $data['user_position'] = $this->Quiz_model->get_user_position($mem_id);
        $data['best_category'] = $this->Quiz_model->best_category($mem_id);
        $last_played_game = $this->Quiz_model->last_played_game($mem_id);
        $data['last_played_game_points'] = $last_played_game->points;
        // echo $last_played_game->answered_date;
        if($last_played_game->answered_date!='0') {
            $last_played_date = current_date_time_stamp()-$last_played_game->answered_date;
            if($last_played_date/60 < 60)
                 $data['last_played_date'] = number_format($last_played_date/(60))." mins. ago";
            else if($last_played_date/(60*60) < 24)
                    $data['last_played_date'] = number_format($last_played_date/(60*60))." hrs ago";
                else if($last_played_date/(60*60*24) < 7)
                        $data['last_played_date'] = number_format($last_played_date/(60*60*24))." days ago";
                    else if($last_played_date/(60*60*24*7) < 4)
                            $data['last_played_date'] = number_format($last_played_date/(60*60*24*7))." weeks ago";
                        else if($last_played_date/(60*60*24*31) < 12)
                                $data['last_played_date'] = number_format($last_played_date/(60*60*24*31))." months ago";
                            else if($last_played_date/(60*60*24*31*12) > 1)
                                    $data['last_played_date'] = number_format($last_played_date/(60*60*24*31*12))."years ago";
        }
        else $data['last_played_date'] = "n/a";
        $data['profile_comments']=$this->Member_model->get_profile_comments($mem_id,$config['per_page'],$offset);
        $data['subscriber']= $this->Member_model->check_subscriber($mem_id);
        $data['subscriber_info'] = $this->Member_model->get_followings($mem_id);
        $data['follower_info'] = $this->Member_model->get_followers($mem_id);
        $data['category'] = $this->Category_model->get_categories();
        //$data['banner_ads_info'] = $this->Quiz_model->get_banner_ads($mem_id);
        $data['text_ads_info'] = $this->Quiz_model->get_rotated_text_ads($mem_id);
        //echo count($data['text_ads_info']);
        $data['all_text_ads_info'] = $this->Quiz_model->get_all_text_ads($mem_id);
        $data['banner_ads_info'] = $this->Quiz_model->get_all_banner_ads($mem_id);
        $data['profile_id']=$mem_id;
        $data['profile_banners'] = $this->Quiz_model->get_profile_banners($mem_id);
        $data['admin_ads'] = $this->Quiz_model->get_admin_profile_ads();
        $data['total_answered']=$this->Quiz_model->getUserTotalQuestionsAnswered($mem_id);
        $data['total_correct_answered']=$this->Quiz_model->getUserTotalCorrectAnswered($mem_id);
        $data['user_playlist'] = $this->Quiz_model->get_playlist($mem_id);
        $data['main']="member/member_profile";
        $this->load->view('userhome',$data);
    }

    function allSubscribers($offset=0) {
        $this->load->library('Jquery_pagination');
        $mem_id = $this->input->post('mem_id');
        $member_id=$this->session->userdata('member_id');
        $follower_info = $this->Member_model->get_followers($member_id);
        $config['base_url'] = site_url('member/allSubscribers/');
		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */

        $config['div'] = '#following_paginate';
		/* CSS selector  for the AJAX content */

        $limit = 2;
        $config['total_rows'] = count($follower_info);
        $config['per_page'] = $limit;
        // echo $offset;
        $this->jquery_pagination->initialize($config);
        $data['pagination1'] =  $this->jquery_pagination->create_links();
        $data['data'] = $this->Member_model->get_followers($member_id,$limit,$offset);

        $this->load->view('member/see_all',$data);
    }

    function allSubscribings($offset=0) {
        $this->load->library('Jquery_pagination');
        $mem_id = $this->input->post('mem_id');
        $member_id=$this->session->userdata('member_id');
        $following_info = $this->Member_model->get_followings($member_id);
        $config['base_url'] = site_url('member/allSubscribings/');
		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */

        $config['div'] = '#following_paginate';
		/* CSS selector  for the AJAX content */

        $limit = 2;
        $config['total_rows'] = count($following_info);
        $config['per_page'] = $limit;
        // echo $offset;
        $this->jquery_pagination->initialize($config);
        $data['pagination1'] =  $this->jquery_pagination->create_links();
        $data['data'] = $this->Member_model->get_followings($member_id,$limit,$offset);

        $this->load->view('member/see_all',$data);
    }

    function allFriends($offset=0) {
        $this->load->library('Jquery_pagination');
        $member_id=$this->session->userdata('member_id');
        $mem_friends=$this->Member_model->get_friends($member_id);

        $config['base_url'] = site_url('member/allFriends/');
		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */

        $config['div'] = '#following_paginate';
		/* CSS selector  for the AJAX content */

        $limit = 2;
        $config['total_rows'] = count($mem_friends);
        $config['per_page'] = $limit;
        // echo $offset;
        $this->jquery_pagination->initialize($config);
        $data['pagination1'] =  $this->jquery_pagination->create_links();
        $data['data'] = $this->Member_model->get_friends($member_id,$limit,$offset);

        $this->load->view('member/see_all',$data);
    }

    function report($type='') {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');

        $data['title']="Member Report";
        $data['text_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'long_text');
        $data['banner_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'banner');
        $data['flash_text_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'short_text');

        $date2 = current_date_time_stamp();
        $today = date("Y-m-d",$date2);
        $date1 = strtotime('-1 month', strtotime($today));
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $data['report1'] = $this->Quiz_model->get_banner_report($date1,$date2);
        $data['report2'] = $this->Quiz_model->get_text_report($date1,$date2);
        $data['report3'] = $this->Quiz_model->get_text_flash_report($date1,$date2);
        $data['type']=$type;
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="member/advertiser_reports";
        $this->load->view('userhome',$data);
    }

    function report1() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Report";
        $data['text_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'long_text');
        $data['banner_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'banner');
        $data['flash_text_ads'] = $this->Quiz_model->get_ads_by_user_id($this->user_id,'short_text');
        $data['profile_report'] = $this->Member_model->get_member($this->user_id);

        $type = $this->input->post('ads_type');
        $date_range = $this->input->post('radio1');
        if($date_range == 'select') {
            $date2 = current_date_time_stamp();
            $today = date("Y-m-d",$date2);
            $date_type = $this->input->post('select');
            if($date_type == '7day') {
                $date1 = strtotime('-7 days',strtotime($today));
            //echo $date2 = date("Y-m-d",$newdate);
            }
            elseif($date_type == '1month')
                $date1 = strtotime('-1 month', strtotime($today));
            elseif($date_type == '1year')
                $date1 = strtotime('-1 year',strtotime($today));

        }
        else {
            $date1 = $this->input->post('date1');
            $date1 = strtotime($date1);

            $date2 = $this->input->post('date2');
            $date2 = strtotime($date2);
        }

        $data['report1'] = $this->Quiz_model->get_banner_report($date1,$date2);
        $data['report2'] = $this->Quiz_model->get_text_report($date1,$date2);
        $data['report3'] = $this->Quiz_model->get_text_flash_report($date1,$date2);
        $data['report4'] = $this->Quiz_model->get_profile_report($date1,$date2);
        $data['type']=$type;
        $data['date1'] = $date1;
        $data['date2'] = $date2;
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/advertiser_reports";
        $this->load->view('userhome',$data);
    }

    function uploadVideo() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/advertiser_upload_video";
        $video_list=$this->Media_model->getMemberVideoImages($this->user_id);
        $config['base_url'] = site_url('/member/uploadVideo');
        $config['total_rows']=count($video_list);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['video_list']=$this->Media_model->getMemberVideoImages($this->user_id,$config['per_page'],$offset);

        $this->load->view('userhome',$data);

    }
	/*
	This function is working  for single video upload
	*/
    function uploadVideoContent($userfile,$video='') {
        //echo $userfile.'/'.$video; exit;
        $this->load->library('images');
		$this->load->helper('image');
        $this->checkMemberLogin();
        $this->load->helper('videoconversion');
        //$data=$this->upload_video($userfile); //upload original file into the server folder uploaded_videos
        //$input=$data['file_name'];
        $input = $video;
        // echo "hiiiiii".$input; exit;
        if($_SERVER['HTTP_HOST']=='localhost') {
            $rootpath=realpath('E:\Program Files\xampp\htdocs\wannaquiz');
        }
        else {
            $rootpath=$_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz';//realpath('\home\proshore\domains\proshore.eu\public_html\clients\wannaquiz');
        }
        //echo $rootpath; exit;
        $inputpath="uploaded_videos";

        if($userfile=='userfile')
            $outputpath="uploaded_video_questions";
        else
            $outputpath="uploaded_video_answers";

        $outputpath1="converted_video_images";
        $width=320;
        $height=240;
        $bitrate=64;
        $samplingrate=22050;

        $outfile =$input;  					// original file wmv
        $image_file = explode(".",$outfile);
        //video conversion
        $flv_file=convert_media($input, $rootpath, $inputpath, $outputpath, $width, $height, $bitrate, $samplingrate);

        // capturing image file
        $flv_image=grab_image($outfile, $rootpath, $inputpath,$outputpath1, "1", "1", "jpg", "120", "120");
        $this->images->squareThumb('converted_video_images/'.$image_file[0].'.jpg','converted_video_images/converted_video_images_thumbs/'.$image_file[0].'.jpg',100);
        return $input;
    }


    function upload_video($video_file) {
        $this->checkMemberLogin();
        $config['upload_path'] ='./uploaded_videos/';
        $config['allowed_types'] ='wmv|avi|mpeg|mpg|3gp|flv|swf';
        $config['max_size']	='300000';
        $this->load->library('upload', $config);
        $this->upload->do_upload($video_file);
        $data = $this->upload->data();

        return $data;
    }


    function uploadPhoto() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Photo";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/advertiser_upload_photo";
        $data['user_id']=$this->session->userdata('wannaquiz_user_id');
        $photos_list=$this->Media_model->getMemberPhotos($this->user_id);

        $config['base_url'] = site_url('/member/uploadPhoto');
        $config['total_rows']=count($photos_list);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id,$config['per_page'],$offset);
        $this->load->view('userhome',$data);
    }

     function addPhotoQuestion($photo_id='') {

        if($photo_id=="") {
            $this->session->unset_userdata('first_image');
            $this->session->unset_userdata('second_image');
            $this->session->unset_userdata('ans_id');
        }
        //echo $this->session->userdata('first_image').'/'. $this->session->userdata('second_image').'/'.$this->session->userdata('ans_id');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/addPhotoQuestion')));
        $this->checkMemberLogin();
        $data['edit']=0;
        $data['title']="Quiz Management";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['category'] = $this->Category_model->get_categories();
        $data['image_width']='';
        if($this->user_type==0)
            $data['main']="quiz/add_photo_quiz_regular";
        else
            $data['main']="quiz/add_photo_quiz_step1";
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id);
        $data['ques_photo']='';
        if($photo_id!="") {
            $photo_info=$this->Media_model->getMemberPhotosByID($photo_id);

            $data['image_height']=getHeight('user_uploaded_photos/'.$this->user_id.'/'. $photo_info->photo_name);
            $data['image_width']=getWidth('user_uploaded_photos/'.$this->user_id.'/'.$photo_info->photo_name);
            if($this->session->userdata('first_image') !='' && $this->session->userdata('second_image')=='') {
                $data['ques_photo']=$this->session->userdata('first_image');
                $data['ans_photo'] = $photo_info->photo_name;
                $data['ans_id'] = $photo_info->photo_id;
                $this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->set_userdata('ans_id',$photo_info->photo_id);
                //$this->session->unset_userdata('first_image');
            }
            else if($this->session->userdata('first_image') !='' && $this->session->userdata('second_image')!=''){
                $data['ques_photo']=$photo_info->photo_name;
                 $this->session->set_userdata('first_image',$photo_info->photo_name);
                $data['ans_photo'] = $this->session->userdata('second_image');
                $data['ans_id'] = $this->session->userdata('ans_id');
                //$this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->unset_userdata('second_image');
                $this->session->unset_userdata('ans_id');

            }
            else if($this->session->userdata('first_image') =='' && $this->session->userdata('second_image')!='') {
                $data['ques_photo']= $photo_info->photo_name;
                $data['ans_photo'] = $this->session->userdata('second_image');
                $data['ans_id'] = $this->session->userdata('ans_id');
                $this->session->set_userdata('first_image',$data['ques_photo']);
            }
            else {
                $data['ques_photo']= $photo_info->photo_name;
                $this->session->set_userdata('first_image',$data['ques_photo']);
                $this->session->set_userdata('second_image','');

            }
            $data['photo_info']=$photo_info;
        }

        $this->load->view('quiz_home',$data);
    }

    function undoAddPhotoQuestion($type) {

        $this->checkMemberLogin();
        $data['edit']=0;
        $data['title']="Quiz Management";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['category'] = $this->Category_model->get_categories();

        if($this->user_type==0)
            $data['main']="quiz/add_photo_quiz_regular";
        else
            $data['main']="quiz/add_photo_quiz_step1";
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id);
        if($type=='first'){
            $this->session->unset_userdata('first_image');
            $data['ans_photo']=$this->session->userdata('second_image');
        }
        else{
            $this->session->unset_userdata('second_image');
            $data['ques_photo']=$this->session->userdata('first_image');
        }




        $this->load->view('quiz_home',$data);
    }

    function addVideoQuestion($video_id='') {
        //echo $this->session->userdata('first_video').'/'. $this->session->userdata('second_video').'/'.$this->session->userdata('ans_id');
        if($video_id=="") {
            $this->session->unset_userdata('first_video');
            $this->session->unset_userdata('second_video');
            $this->session->unset_userdata('ans_id');
        }
        $this->session->unset_userdata('quiz_tmp_id');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/addVideoQuestion')));
        $this->checkMemberLogin();
        $data['category'] = $this->Category_model->get_categories();
        $data['title']="Member Upload Photo";

        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        if($this->user_type==0)
            $data['main']="quiz/add_video_quiz_regular";
        else
            $data['main']="quiz/add_video_quiz_step1";

        //$data['ques_video']=$video;
        $data['videos_list']=$this->Media_model->getMemberVideoImages($this->user_id);
        if($video_id!="") {
            $video_info=$this->Media_model->getMemberVideosByID($video_id);
            $video = $video_info->video_name;
            //echo $video; exit;
            //$this->session->set_userdata('crop_video',$video);
            //$video_que = $this->uploadVideoContent($video);

            if($this->session->userdata('first_video') !='' && $this->session->userdata('second_video')=='') {
                $data['ques_video']=$this->session->userdata('first_video');
                $video_que = $this->uploadVideoContent('userfile1',$video);
                $data['ans_video'] = $video;
                $data['ans_id'] = $video_info->video_id;
                $this->session->set_userdata('second_video',$video);
                $this->session->set_userdata('ans_id',$video_info->video_id);
            }
            else if($this->session->userdata('first_video') !='' && $this->session->userdata('second_video')!=''){
                $data['ques_video']=$video_info->video_name;
                 $this->session->set_userdata('first_video',$video_info->video_name);
                $data['ans_video'] = $this->session->userdata('second_video');
                $data['ans_id'] = $this->session->userdata('ans_id');
                //$this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->unset_userdata('second_video');
                $this->session->unset_userdata('ans_id');

            }
            else if($this->session->userdata('first_video') =='' && $this->session->userdata('second_video')!='') {
                $data['ques_video']= $video_info->video_name;
                $data['ans_video'] = $this->session->userdata('second_video');
                $data['ans_id'] = $this->session->userdata('ans_id');
                $this->session->set_userdata('first_video',$data['ques_video']);
            }
            else {
                $video_que = $this->uploadVideoContent('userfile',$video);
                $data['ques_video']= $video;
                $this->session->set_userdata('first_video',$data['ques_video']);
                $this->session->set_userdata('second_video','');
            }
        }
        $this->load->view('quiz_home',$data);
    }

    function undoAddVideoQuestion($type) {

        $this->checkMemberLogin();
        $data['category'] = $this->Category_model->get_categories();
        $data['title']="Member Upload Photo";

        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        if($this->user_type==0)
            $data['main']="quiz/add_video_quiz_regular";
        else
            $data['main']="quiz/add_video_quiz_step1";

        //$data['ques_video']=$video;
        $data['videos_list']=$this->Media_model->getMemberVideoImages($this->user_id);
        if($type=='first'){
            $this->session->unset_userdata('first_video');
            $data['ans_video']=$this->session->userdata('second_video');
        }
        else{
            $this->session->unset_userdata('second_video');
            $data['ques_video']=$this->session->userdata('first_video');
        }

        $this->load->view('quiz_home',$data);
    }

    function sec2hms ($sec, $padHours = false) {
        $secArr = explode(".", $sec);
         $sec = $secArr[0];
         $miliSecs = $secArr[1];
        $hms = "";

        // there are 3600 seconds in an hour, so if we
        // divide total seconds by 3600 and throw away
        // the remainder, we've got the number of hours
        $hours = intval(intval($sec) / 3600);

        // add to $hms, with a leading 0 if asked for
        $hms .= ($padHours)
            ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
            : $hours. ':';

        // dividing the total seconds by 60 will give us
        // the number of minutes, but we're interested in
        // minutes past the hour: to get that, we need to
        // divide by 60 again and keep the remainder
        $minutes = intval(($sec / 60) % 60);

        // then add to $hms (with a leading 0 if needed)
        $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';

        // seconds are simple - just divide the total
        // seconds by 60 and keep the remainder
        $seconds = intval($sec % 60);

        // add to $hms, again with a leading 0 if needed
        $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

        return $hms.".".$miliSecs;
    }

    function cropVideo() {
        $this->load->library('images');
		$this->load->helper('image');
        $this->session->unset_userdata('first_video');
        $this->session->unset_userdata('second_video');
        $pause_time =  $this->sec2hms($this->input->post('pause_time'),true);
        $total_time = $this->sec2hms($this->input->post('total_time'),true);
        $cut_duration = $this->input->post('cut_duration');
        //echo $pause_time.'/'.$total_time.'/'.$cut_duration; //exit;
        //echo $this->input->post('video_name');exit;
        if($_SERVER['SERVER_NAME']=='localhost')
            $file = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$this->input->post('video_name');
        else $file = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$this->input->post('video_name');
        $file1 = explode(".",$this->input->post('video_name'));
        //echo dirname(__FILE__);
        $answer_path = time()."_".$file1[0].".flv"; 
        $question_path = time()."_".$file1[0].".flv"; 

        echo $question_path_final = time()."_".$file1[0]."_q.flv";echo "*";
        echo $answer_path_final = time()."_".$file1[0]."_a.flv"; echo "*";
         

        if($_SERVER['SERVER_NAME']=='localhost'){
            $out = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_answers/".$answer_path;
            $qout = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$question_path;

            $out_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_answers/".$answer_path_final;
            $qout_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$question_path_final;
        }
        else {
            $out = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path;
            $qout = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path;

            $out_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path_final;
            $qout_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path_final;
        }
        //-ss is the start time i.e. video cut from this point in HH:mm:ss and -t is the end time in HH:mm:ss i.e. cut to this point
        //the path to ffmpeg could be different in your case
        // system("/usr/local/bin/ffmpeg -i $file -ss 00:00:09 -t 00:00:19 $out");
        //system("/usr/local/bin/ffmpeg -i $file -acodec libfaac -ss 00:00:02 -t 00:00:12 -ar 22050 -ab 32 -f flv -s 400x250 $out");
        //system("/usr/local/bin/ffmpeg -sameq -ss $pause_time -t $total_time -i $file $out");
        //system("/usr/local/bin/ffmpeg -sameq -ss 00:00:00.0 -t $pause_time -i $file $qout");
        
        system("/usr/local/bin/ffmpeg -sameq -ss $pause_time -t $total_time -i $file $out");
        system("/usr/local/bin/ffmpeg -sameq -ss 00:00:00.0 -t $pause_time -i $file $qout");
        
        //echo "/usr/bin/flvtool2 -U stdin $out"; echo "****";
        system("/usr/bin/flvtool2 -U stdin $out_path < $out");
        system("/usr/bin/flvtool2 -U stdin $qout_path < $qout");

        $data['ans_video'] = $answer_path_final;
        $data['ques_video'] = $question_path_final;
        $file_name = explode(".",$question_path_final);

       $this->images->squareThumb('converted_video_images/'.$file1[0].'.jpg','converted_video_images/converted_video_images_thumbs/'.$file_name[0].'.jpg',100);

       if(file_exists($_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path);

        if(file_exists($_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path);

        $this->session->set_userdata('first_video',$data['ques_video']);
        $this->session->set_userdata('second_video',$data['ans_video']);
        echo $this->load->view("quiz/ans_video_right_ajax", $data, true);echo "*";
        echo $this->load->view("quiz/question_video_right_ajax", $data, true);
    }

    function editPhotoQuestion($quiz_id='',$photo_id='',$type='') { //echo $quiz_id;
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        $data['quiz_ans'] = $this->Member_model->get_quiz_info($quiz_id);
        $data['title']="Quiz Management";
        if($data['quiz_info']->user_type == 'advertiser')
            $data['main']="quiz/add_photo_quiz_step1";
        else
            $data['main']="quiz/add_photo_quiz_regular";


        $data['edit']=1;
        //$this->session->set_userdata('edit',1);
        $data['quiz_id'] = $quiz_id;
        $data['category'] = $this->Category_model->get_categories();
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id);
        $sql = "select images from tbl_quiz_images where quiz_id=".$quiz_id;
        $query=$this->db->query($sql);
        $result=$query->row();
        if($photo_id!="") {
            $photo_info=$this->Media_model->getMemberPhotosByID($photo_id);
            $data['image_height']=getHeight('user_uploaded_photos/'.$this->user_id.'/'. $photo_info->photo_name);
            $data['image_width']=getWidth('user_uploaded_photos/'.$this->user_id.'/'.$photo_info->photo_name);
            if($type == "unset") {
                $data['ques_photo']= $result->images;
                $data['ans_photo'] = $photo_info->photo_name;
            }
            else if($this->session->userdata('first_image') !='' && $this->session->userdata('second_image')=='') {
                $data['ques_photo']=$this->session->userdata('first_image');
                $data['ans_photo'] = $photo_info->photo_name;
                $data['ans_id'] = $photo_info->photo_id;
                $this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->set_userdata('ans_id',$photo_info->photo_id);
                //$this->session->unset_userdata('first_image');
            }
            else if($this->session->userdata('first_image') !='' && $this->session->userdata('second_image')!=''){
                $data['ques_photo']=$photo_info->photo_name;
                 $this->session->set_userdata('first_image',$photo_info->photo_name);
                $data['ans_photo'] = $this->session->userdata('second_image');
                $data['ans_id'] = $this->session->userdata('ans_id');
                //$this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->unset_userdata('second_image');
                $this->session->unset_userdata('ans_id');

            }
            else if($this->session->userdata('first_image') =='' && $this->session->userdata('second_image')!='') {
                $data['ques_photo']= $photo_info->photo_name;
                $data['ans_photo'] = $this->session->userdata('second_image');
                $data['ans_id'] = $this->session->userdata('ans_id');
                $this->session->set_userdata('first_image',$data['ques_photo']);
            }
            else {
                $data['ques_photo']= $photo_info->photo_name;
                $this->session->set_userdata('first_image',$data['ques_photo']);
                $this->session->set_userdata('second_image','');

            }
//            else if($this->session->userdata('first_image') !='') {
//                    $data['ques_photo']=$this->session->userdata('first_image');
//                    $data['ans_photo'] = $photo_info->photo_name;
//                    $data['ans_id'] = $photo_info->photo_id;
//                    $this->session->unset_userdata('first_image');
//                } else {
//                    $data['ques_photo']= $photo_info->photo_name;
//                    $this->session->set_userdata('first_image',$data['ques_photo']);
//                }
        }
        $this->load->view('quiz_home',$data);
    }

    function undoEditPhotoQuestion($quiz_id,$type) {

        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        $data['quiz_ans'] = $this->Member_model->get_quiz_info($quiz_id);
        $data['title']="Quiz Management";
        if($data['quiz_info']->user_type == 'advertiser')
            $data['main']="quiz/add_photo_quiz_step1";
        else
            $data['main']="quiz/add_photo_quiz_regular";


        $data['edit']=1;
        //$this->session->set_userdata('edit',1);
        $data['quiz_id'] = $quiz_id;
        $data['category'] = $this->Category_model->get_categories();
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id);
        $sql = "select images from tbl_quiz_images where quiz_id=".$quiz_id;
        $query=$this->db->query($sql);
        $result=$query->row();
        if($type=='first'){
            $this->session->unset_userdata('first_image');
            $data['ans_photo']=$this->session->userdata('second_image');
        }
        else{
            $this->session->unset_userdata('second_image');
            $data['ques_photo']=$this->session->userdata('first_image');
        }
        $this->load->view('quiz_home',$data);
    }


    function editVideoQuestion($quiz_id='',$video_id='',$type='') {
       echo $this->session->userdata('first_video').'/'. $this->session->userdata('second_video').'/'.$this->session->userdata('ans_id');
       $this->load->model('Quiz_model');
        $this->checkMemberLogin();
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        $data['quiz_ans'] = $this->Member_model->get_quiz_info($quiz_id);
        $data['title']="Quiz Management";
        if($data['quiz_info']->quiz_style == 'regular')
            $data['main']="quiz/add_video_quiz_regular";
        else {
            $data['main']="quiz/add_video_quiz_step1";

        }
        $data['edit']=1;
        $data['quiz_id'] = $quiz_id;
        $data['category'] = $this->Category_model->get_categories();
        $data['video_info'] = $this->Quiz_model->get_video_quiz_by_ID($quiz_id);
        $data['videos_list']=$this->Media_model->getMemberVideoImages($this->user_id);
        if($type=="unset") {
            $sql = "select * from tbl_quiz_videos where quiz_id=".$quiz_id;
            $query=$this->db->query($sql);
            $result=$query->row();
            $data['ques_video'] = $result->quiz_videos;
            $data['ans_video'] = $result->video_answer;
        }
        if($video_id!=0) {
            $video_info=$this->Media_model->getMemberVideosByID($video_id);
            $video = $video_info->video_name;
            $video_que = $this->uploadVideoContent($video);
            if($this->session->userdata('first_video') !='' && $this->session->userdata('second_video')=='') {
                $data['ques_video']=$this->session->userdata('first_video');
                $video_que = $this->uploadVideoContent('userfile1',$video);
                $data['ans_video'] = $video;
                $data['ans_id'] = $video_info->video_id;
                $this->session->set_userdata('second_video',$video);
                $this->session->set_userdata('ans_id',$video_info->video_id);
            }
            else if($this->session->userdata('first_video') !='' && $this->session->userdata('second_video')!=''){
                $data['ques_video']=$video_info->video_name;
                 $this->session->set_userdata('first_video',$video_info->video_name);
                $data['ans_video'] = $this->session->userdata('second_video');
                $data['ans_id'] = $this->session->userdata('ans_id');
                //$this->session->set_userdata('second_image',$photo_info->photo_name);
                $this->session->unset_userdata('second_video');
                $this->session->unset_userdata('ans_id');

            }
            else if($this->session->userdata('first_video') =='' && $this->session->userdata('second_video')!='') {
                $data['ques_video']= $video_info->video_name;
                $data['ans_video'] = $this->session->userdata('second_video');
                $data['ans_id'] = $this->session->userdata('ans_id');
                $this->session->set_userdata('first_video',$data['ques_video']);
            }
            else {
                $video_que = $this->uploadVideoContent('userfile',$video);
                $data['ques_video']= $video;
                $this->session->set_userdata('first_video',$data['ques_video']);
                $this->session->set_userdata('second_video','');
            }
//            if($this->session->userdata('first_video') !='') {
//                $data['ques_video']=$this->session->userdata('first_video');
//                $video_que = $this->uploadVideoContent('userfile1',$video);
//                $data['ans_video'] = $video;
//                $data['ans_id'] = $video_info->video_id;
//                $this->session->unset_userdata('first_video');
//            } else {
//                $video_que = $this->uploadVideoContent('userfile',$video);
//                $data['ques_video']= $video;
//                $this->session->set_userdata('first_video',$data['ques_video']);
//            }
        }
        $quiz_tmp_id=$data['video_info']->quiz_temp_id;
        $this->session->set_userdata('quiz_tmp_id',$quiz_tmp_id);
        $this->load->view('quiz_home',$data);
    }

    function undoEditVideoQuestion($quiz_id,$type) {

        $this->load->model('Quiz_model');
        $this->checkMemberLogin();
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        $data['quiz_ans'] = $this->Member_model->get_quiz_info($quiz_id);
        $data['title']="Quiz Management";
        if($data['quiz_info']->quiz_style == 'regular')
            $data['main']="quiz/add_video_quiz_regular";
        else {
            $data['main']="quiz/add_video_quiz_step1";

        }
        $data['edit']=1;
        $data['quiz_id'] = $quiz_id;
        $data['category'] = $this->Category_model->get_categories();
        $data['video_info'] = $this->Quiz_model->get_video_quiz_by_ID($quiz_id);
        $data['videos_list']=$this->Media_model->getMemberVideoImages($this->user_id);
        if($type=='first'){
            $this->session->unset_userdata('first_video');
            $data['ans_video']=$this->session->userdata('second_video');
        }
        else{
            $this->session->unset_userdata('second_video');
            $data['ques_video']=$this->session->userdata('first_video');
        }

        $this->load->view('quiz_home',$data);
    }

    function load_player($filename,$player_name,$path) {
        $data='<strong>Below is the processed video</strong><br /><br />
            <a href="'.base_url().$path.'/'.$filename.'.flv'.'" style="display:block;width:180px;height:135px;" id="'.$player_name.'"></a><script language="JavaScript">
				flowplayer("'.$player_name.'", "'.base_url().'flowplayer/flowplayer-3.1.5.swf",{
                                    clip: {
                                        // these two configuration variables does the trick
                                        autoPlay: false,
                                        autoBuffering: true // <- do not place a comma here
                                    }
                                });
			</script>';
        echo $data;
    }

    function uploadVideoQuestion() {
        $tmp_id=$this->session->userdata('quiz_tmp_id');
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $video_que = $this->uploadVideoContent('userfile');
        //$video_que = $this->upload_video('userfile');
        $insert_data = $this->Quiz_model->addTempQuizVideoQuestion($video_que,$tmp_id);

        echo $video_que;
    }

    function uploadVideoAnswer() {
        $tmp_id=$this->session->userdata('quiz_tmp_id');
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $video_ans = $this->uploadVideoContent('userfile1');
        //$video_ans = $this->upload_video('userfile1');
        $insert_data = $this->Quiz_model->addTempQuizVideoAnswer($video_ans,$tmp_id);

        echo $video_ans;
    }

    function viewQuestions($type) {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Uploaded questions";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="quiz/view_questions";
        $data['type'] = $type;

        $data['friend_list'] = $this->Member_model->get_friends($this->user_id,$config['per_page'],$offset);
        if($type=="photo") {
            $question_list = $this->Quiz_model->get_user_photo_questions();
            $config['base_url'] = site_url('/member/viewQuestions/photo');
            $config['total_rows']=count($question_list);
            $config['per_page'] = '8';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['question_list'] = $this->Quiz_model->get_user_photo_questions($config['per_page'],$offset);
        }
        elseif($type=='video') {
            $question_list=$this->Quiz_model->get_user_video_questions();
            $config['base_url'] = site_url('/member/viewQuestions/video');
            $config['total_rows']=count($question_list);
            $config['per_page'] = '8';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['question_list']=$this->Quiz_model->get_user_video_questions($config['per_page'],$offset);
        }

        else $data['question_list'] = $this->Quiz_model->get_user_questions();
        $this->load->view('userhome',$data);
    }

    function embedPlayer() {
        $this->checkMemberLogin();
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="member/embed_player";
        $this->load->view('userhome',$data);
    }

    function professionalCreate($content) {
        $this->checkMemberLogin();
        $data['title']="Professional creates your question";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['page'] =$this->pages_model->get($content);
        $data['cms_variable']=$content;
        $data['main']="member/professional_create";
        $this->load->view('userhome',$data);
    }

    function buyAdSpace($qid=null) {
        $this->checkMemberLogin();
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['category'] = $this->Category_model->get_categories();
        $data['main']="member/advertiser_buy_adspace";
        $data['quiz_id'] = $qid;
        $this->load->view('userhome',$data);
    }

    function buyAdSpace2() {
        $this->checkMemberLogin();
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="member/advertiser_buy_adspace2";
        $this->load->view('userhome',$data);
    }

    function updatePublicprofile() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['main']="member/update_public_profile";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['company_detail'] = $this->Member_model->get_company_detail($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['user_banner'] = $this->Quiz_model->get_profile_banners($this->user_id);

        //print_r($data['user_banner']);
        $this->load->view('userhome',$data);
    }

    function editProfile() {
        $this->checkMemberLogin();
        $firstname = $this->input->post('fname');
        $lastname = $this->input->post('lname');
        $dod = $this->input->post('dod');
        $dom = $this->input->post('dom');
        $doy = $this->input->post('doy');
        $website = $this->input->post('website');
        $profile_description  = $this->input->post('profile_desc');
        $subject = $this->input->post('subject');
        $company_name = $this->input->post('company_name');
        $company_website = $this->input->post('company_website');
        $company_info = $this->input->post('company_info');
        $personal_info = $this->input->post('personal_info');
        $user_type = $this->input->post('user_type');
        $mem_info=$this->Member_model->get_member($this->user_id);
        $editdata = $this->Member_model->updateMember();
        // echo $this->input->post('banner1');

        for($i=1;$i<=2;$i++) {
            if($_FILES['banner'.$i]['name']!='') {
                $this->upload_file('banner'.$i);
        }}
        if($editdata != 0) {
            $test = '';
            for($i=1;$i<=31;$i++) {
                if($i == $dod)
                    $day.='<option value="'.$i.'" selected="selected">'.$i.'</option>';
                else
                    $day.='<option value="'.$i.'" >'.$i.'</option>';
            }
            for($k=1; $k<=12;$k++) {
                if($k == $dom)
                    $month.='<option value="'.$k.'" selected="selected">'.$k.'</option>';
                else
                    $month.='<option value="'.$k.'" >'.$k.'</option>';
            }
            for($j=(date('Y')-16); $j>(date('Y')-100);$j--) {
                if($j == $doy)
                    $year.='<option value="'.$j.'" selected="selected">'.$j.'</option>';
                else
                    $year.='<option value="'.$j.'" >'.$j.'</option>';
            }
        }

        //            $message = "successfully edited|success";
        //            $message.='|<div class="general_form padding_10top">
        //                                                    <div class="input_clear">
        //                                                        <label>First Name</label>
        //                                                        <input type="text" class="textbox" name="fname" value="'.$firstname.'" id="fname" />
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                        <label>Sur Name</label>
        //                                                        <input type="text" class="textbox" name="lname" value="'.$lastname.'" id="lname"/>
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                        <label>Date of Birth </label>
        //                                                        <select name="dod" style="width:55px; margin-right:5px;" id="dod">
        //                                                            <option value="">Day</option>
        //
        //                                                            '.$day.'
        //                                                        </select>
        //                                                         <select name="dom" style="width:70px; margin-right:5px;" id="dom">
        //                                                            <option value="">Month</option>
        //                                                            '.$month.'
        //                                                        </select>
        //                                                        <select name="doy" style="width:65px;" id="doy">
        //                                                            <option value="">Year</option>
        //                                                            '.$year.'
        //                                                        </select>
        //                                                        <div class="clear"></div>
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                        <label>Website</label>
        //                                                        <input type="text" class="textbox" name="website" value="'.$website.'" id="website"/>
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                        <label>Profile Description</label>
        //                                                        <textarea class="textbox" name="profile_escription" style="width:300px; height:100px;" id="profile_description">'.$profile_description.'</textarea>
        //                                                    </div>
        //                                                     <div class="input_clear">
        //                                                        <label>Subject</label>
        //                                                        <input type="text" class="textbox" name="subject" value="'.$subject.'" id="subject"/>
        //                                                    </div>';
        //
        //            if($mem_info->user_type == 1) {
        //                $message.='<div class="bold">Company Information</div>
        //                                <div class="input_clear">
        //                                                        <label>Company Name</label>
        //                                                        <input type="text" class="textbox" name="company_name" value="'.$company_name.'" id="company_name" />
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                    	<label>Company Website</label>
        //                                                        <input type="text" class="textbox" name="company_website" value="'.$company_website.'" id="company_website" />
        //                                                    </div>
        //
        //                                                </div>
        //                                                <!--<div class="general_formcheckbox">
        //                                                	<div class="input_clear">
        //                                                    	<label style="width:150px; padding-right:15px;">Show Email address</label>
        //                                                        <input type="radio" name="show-email" value="yes"/>
        //                                                        <label style="margin-right:20px;">Yes</label>
        //                                                        <input type="radio" name="show-email" value="no"/>
        //                                                        <label>No</label>
        //                                                    </div>
        //                                                </div>-->
        //
        //                                                <div class="general_form">
        //                                                    <div class="input_clear">
        //                                                    	<label>Company information</label>
        //                                                        <textarea class="textbox" name="company_desc" style="width:300px; height:100px;" id="company_desc">'.$company_info.'</textarea>
        //                                                    </div>
        //                                                    <div class="input_clear">
        //                                                    	<label>Personal information <br /> (optional eg why did you started your company?)</label>
        //                                                        <textarea class="textbox"  name="personal_desc" style="width:300px; height:100px;" id="personal_desc">'.$personal_info.'</textarea>
        //                                                    </div>
        //
        //                                                </div>
        //
        //                                                <div class="bold">Upload Banner Images</div>
        //                                                        <div class="general_form padding_10top">
        //                                                                <div class="input_clear">
        //                                                                    <label>Banner 1 (top)</label>
        //                                                                    <input type="file" name="banner1" id="banner1" />
        //                                                                </div>
        //                                                                <div class="input_clear">
        //                                                                    <label>Banner 2 (bottom)</label>
        //                                                                    <input type="file" name="banner2" id="banner2" />
        //                                                                </div>
        //                                                            </div>
        //
        //                                                ';
        //
        //            }echo $message;
        //        }
        //        else
        //            echo $message = 'edit not worked|false';

        $this->updatePublicprofile();

    }

    function upload_file($file) {
        $config['upload_path'] ='./advertiser_banners/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '3000';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();

        return $data;
    }

    function uploadProfilePicture() {
        $this->checkMemberLogin();
        $this->load->library('images');
        $image_info=$this->uploadFile('userfile');
        //create thumbnail
        image_thumb(UPLOADS.'/'.$image_info['file_name'],PROFILE_IMAGES_THUMB,$image_info['file_name'], 50, 50);
        image_thumb(UPLOADS.'/'.$image_info['file_name'],PROFILE_IMAGES,$image_info['file_name'], 100, 100);
        //$this->images->squareThumb($originalPath . $original, $newPath . $new, 100);
        $this->images->squareThumb(UPLOADS.'/'.$image_info['file_name'],FRIENDS.'/'.$image_info['file_name'], 58);
        $this->Member_model->updateProfilePicture($image_info['file_name']);
    }

    // not used function but for the example
    function image () {
        $this->checkMemberLogin();
        $original = 'test_image.jpg';
        $new = 'test_image_altered.jpg';
        $originalPath = '/full/path/to/original/image/folder/';
        $newPath = '/full/path/to/altered/image/folder/';
        $this->load->library('images');

        // Create square thumbnail example
        $this->images->squareThumb($originalPath . $original, $newPath . $new, 100);

        // Create resized thumbnail example
        $this->images->resize($originalPath . $original, 150, 150, $newPath . $new);

        // Create squared image
        $this->images->square($originalPath . $original, $newPath . $new);
    }

    function uploadFile($file) {
        $this->checkMemberLogin();
        $config['upload_path'] ='./uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '3000';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
        return $data;
    }


    function friendList() {
        $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/friendList')));
        $this->checkMemberLogin();
        $friends = $this->Member_model->count_friends($this->user_id);
        $config['base_url'] = site_url('/member/friendList/');
        $config['total_rows']=count($friends);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $data['friend_list'] = $this->Member_model->get_friends($this->user_id,$config['per_page'],$offset);
        $data['date'] = current_date_time_stamp();
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['title']="Manage Friends~ Wannaquiz";
        $data['main']="member/friend_list";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $this->load->view('userhome',$data);
    }

    function sendFriendRequest() {
        $this->checkMemberLogin();
        $friend_id=$this->input->post('friend_id');
        $friend_request = $this->Member_model->send_friend_request($friend_id);
        if($friend_request)
            echo "Your friend request has been sent";
        else echo "You have already send friend request";
    }

    function message($status=0) {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        if($status==0) {
            $data['main']="member/message_received";
            $data['message_list']=$this->Member_model->mail_received();
        }
        else {
            $data['main']="member/message_sent";
            $data['message_list']=$this->Member_model->mail_sent();
        }
        $this->load->view('userhome',$data);
    }

    function messageDetail($id) {
        $this->checkMemberLogin();
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['message_info']=$this->Member_model->get_message($id);
        $data['reply_list']=$this->Member_model->get_message_replies($id);
        $data['message_list']=$this->Member_model->mail_received();
        if($data[message_info]->subject == 'Friend request') {
            $member_friend = $this->Member_model->check_member_friend($data[message_info]->user_id,$data[message_info]->recipient_id);
            if($member_friend)
                $data[friend_status] = "not added";
        //echo "test";
        }
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $this->Member_model->set_message_read($id);
        $data['title']="Member Upload Video";
        $data['main']="member/message_detail";
        $this->load->view('userhome',$data);
    }

    function replyMessage() {
        $this->checkMemberLogin();
        $this->Member_model->reply_message();
        $mem_info=$this->Member_model->get_member($this->user_id);
        $mem_profile = $this->Member_model->get_member_profile($this->user_id);
        if($mem_info->profile_picture!="")
            $profile_image_path=base_url().FRIENDS.'/'.$mem_profile->profile_picture;
        else
            $profile_image_path=base_url()."images/avatar_img.jpg";

        echo '<div class="content_wrap">
			  <div class="editwall_img">
			  <img src="'.$profile_image_path.'" width="58" height="58" alt="avatar" />
			  </div>
			  <div class="readmail_desc">
				  <div>
				  <div class="border_gray">
					  <div class="bg_white">
					  <div class="wallarrow"><a href="#"><img src="'.base_url().'images/arrow_point.png" width="11" height="9" alt="arrow" /></a></div>
					  <div class="content_10box">
						  <div> <span class="bold"><a href="#" class="color_gray">'.ucfirst($mem_profile->first_name).' '.ucfirst($mem_profile->last_name).'</a></span> <span class="font10">| '.date('d F Y,H:i a',current_date_time_stamp()).'</span> </div>
						  <div class="padding_10topbottom">'.$this->input->post('message').'

						  </div>

					  </div>
					  </div>

				  </div>
				  </div>

			  </div>

			  <div class="clear"></div>
			 </div>';
    }

    function profileCommit() {
        $this->checkMemberLogin();
        $data = $this->Member_model->profile_commit();
        if($data) {
            $message="success*" ;

            $mem_id = $this->input->post('profile_id');

            $count_comments=$this->Member_model->count_profile_comments($mem_id);
            $config['base_url'] = site_url('/member/profileCommit/');
            $config['total_rows']= $count_comments;
            $config['per_page'] = '5';
            $config['uri_segment'] = '3';
            $offset=$this->uri->segment(3,0);
            $this->pagination->initialize($config);
            $profile_comments=$this->Member_model->get_profile_comments($mem_id,$config['per_page'],$offset);

            $user_id = $this->session->userdata('wannaquiz_user_id');

            foreach($profile_comments as $profileComments) {
                if($profileComments->user_id==$user_id || $profileComments->comentator_id == $user_id)
                    $delete = ' | <a href="#" onclick="deleteMemberComment('.$profileComments->comment_id.')">Delete</a>';

                $answer = "toggle('reply_".$profileComments->comment_id."')";
                $spam = "memberCommentSpam(".$profileComments->comment_id.",'comment')";

                $like_comment = $this->Member_model->get_profile_comment_like($profileComments->comment_id);
                $unlike_comment = $this->Member_model->get_profile_comment_unlike($profileComments->comment_id);

                $message.='<div class="padding_10topbottom">
                            	<div>
                                    <div class="comment_name"><a href="#" class="bold">'.$profileComments->first_name.'&nbsp;'.$profileComments->last_name.'</a> ('.$profileComments->coment_date.')</div>
                                    <div class="comment_reply"><div class="text_center"><a style="cursor:pointer" onclick="'.$answer.'">Answer</a> | <a href="#" onclick="'.$spam.'">Spam</a>'.$delete.'</div></div>
                                    <div class="comment_arrange">
                                        <div class="text_right">
                                            <span id="like_'.$profileComments->comment_id.'"> '.$like_comment.' Like </span>
                                            <span><a style="cursor:pointer" onclick="like_profile_comment('.$profileComments->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                            <span><a style="cursor:pointer" onclick="like_profile_comment('.$profileComments->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                            <span id="unlike_'.$profileComments->comment_id.'">'.$unlike_comment.' Unlike </span>

                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="padding_10topbottom">
                                	'.$profileComments->comment.'
                                </div>
                            </div>
                            <div id="reply_comment_'.$profileComments->comment_id.'">';

                $comment_reply = $this->Member_model->get_reply_comments($profileComments->comment_id);
                //print_r($comment_reply);
                if(count($comment_reply)>0) {
                    foreach($comment_reply as $reply) {

                        $like_comment1 = $this->Member_model->get_profile_comment_like($reply->comment_id);
                        $unlike_comment1 = $this->Member_model->get_profile_comment_unlike($reply->comment_id);
                        $commentSpam1 = "memberCommentSpam('".$reply->comment_reply_id."', 'comment');";

                        if($reply->user_id==$user_id || $reply->comentator_id==$user_id) {
                            $delete1 = '| <a href="#" onclick="deleteMemberCommentReply('.$reply->comment_id.')">Delete</a>';
                        }
                        $message.= '<div class="borderbottom_gray"></div>
                                    <div class="borderleft_5gray">
                                        <div class="content_10box">
                                            <div>
                                                <div class="comment_subname"><a href="#" class="bold">'.$reply->first_name.'&nbsp;'.$reply->last_name.'</a> ('.date("Y-m-d H:i:s",$reply->coment_date).')</div>
                                                <div class="comment_reply"><div class="text_center"><a href="#" onclick="'.$commentSpam1.'">Spam</a>'.$delete1.'</div></div>
                                                <div class="comment_arrange">
                                                    <div class="text_right">
                                                        <span id="like_'.$reply->comment_id.'"> '.$like_comment1.' Like </span>
                                                        <span><a style="cursor:pointer" onclick="like_profile_comment('.$reply->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                        <span><a style="cursor:pointer" onclick="like_profile_comment('.$reply->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                        <span id="unlike_'.$reply->comment_id.'">'.$unlike_comment1.' Unlike </span>

                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                            <div class="padding_10topbottom">
                '.$reply->comment.'
                                            </div>
                                        </div>
                                    </div>';

                    } }
                $message.='</div>
                                <div class="comment_title" style="display:none" id="reply_'.$profileComments->comment_id.'">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this video</div>
                                        <textarea class="textbox" style="width:350px; height:100px;" id="profile_reply_comment_'.$profileComments->comment_id.'"></textarea>
                                        <input type="hidden" name="friend_id" id="friend_id" value="'.$this->session->userdata("wannaquiz_user_id").'" />
                                    </div>
                                    <div class="input_clear">
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="profile_reply_commit('.$profileComments->comment_id.')"/>
                                        <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                        <div>Not more than 500 characters</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>';
            }
            echo $message;
        }
        else $message = "error|error";

    }

    function profileReplyCommit() {
        $this->checkMemberLogin();
        $data = $this->Member_model->profile_reply_commit();
        if($data) {
            $message="success*" ;

            $mem_id = $this->input->post('profile_id');
            $comment_id = $this->input->post('comment_id');
            $comment_reply = $this->Member_model->get_reply_comments($comment_id);
            if(count($comment_reply)>0) {
                foreach($comment_reply as $reply) {

                    $like_comment1 = $this->Member_model->get_profile_comment_like($reply->comment_id);
                    $unlike_comment1 = $this->Member_model->get_profile_comment_unlike($reply->comment_id);
                    $commentSpam1 = "memberCommentSpam('".$reply->comment_reply_id."', 'comment');";

                    if($reply->user_id==$user_id || $reply->comentator_id==$user_id) {
                        $delete1 = '| <a href="#" onclick="deleteMemberCommentReply('.$reply->comment_id.')">Delete</a>';
                    }
                    $message.= '<div class="borderbottom_gray"></div>
                                    <div class="borderleft_5gray">
                                        <div class="content_10box">
                                            <div>
                                                <div class="comment_subname"><a href="#" class="bold">'.$reply->first_name.'&nbsp;'.$reply->last_name.'</a> ('.date("Y-m-d H:i:s",$reply->coment_date).')</div>
                                                <div class="comment_reply"><div class="text_center"><a href="#" onclick="'.$commentSpam1.'">Spam</a>'.$delete1.'</div></div>
                                                <div class="comment_arrange">
                                                    <div class="text_right">
                                                        <span id="like_'.$reply->comment_id.'"> '.$like_comment1.' Like </span>
                                                        <span><a style="cursor:pointer" onclick="like_profile_comment('.$reply->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                        <span><a style="cursor:pointer" onclick="like_profile_comment('.$reply->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                        <span id="unlike_'.$reply->comment_id.'">'.$unlike_comment1.' Unlike </span>

                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                            <div class="padding_10topbottom">
                '.$reply->comment.'
                                            </div>
                                        </div>
                                    </div>';

                } }

            echo $message;
        }
        else $message = "error|error";

    }

    function deleteMemberComment($comment_id) {
        $data = $this->Member_model->delete_member_comment($comment_id);
        if($data)
            $message="success" ;
        else $message = "error";
        echo $message;
    }

    function deleteMemberCommentReply($comment_reply_id) {
        $data = $this->Member_model->delete_member_comment_reply($comment_reply_id);
        if($data)
            $message="success" ;
        else $message = "error";
        echo $message;
    }

    function spamMemberComment($comment_id) {
        $this->load->model('Site_setting_model');
        $this->load->model('Email_model');
        $flag= $this->input->post('flag');
        $data = $this->Member_model->spam_member_comment($comment_id);
        $comment = $this->Member_model->get_spam_member_comment($comment_id);
        if($data) {
            $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("SPAM");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("COMMENT"=>$comment_link,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($email,$subject,$emailbody,$headers);
            $message="success" ;
        }

        else $message = "error";
        echo $message;

    }


    function likeProfileComment() {
        $this->checkMemberLogin();
        $data = $this->Member_model->like_profile_comment();
        $comment_id = $this->input->post('comment_id');
        $like_comment = $this->Member_model->get_profile_comment_like($comment_id);
        $unlike_comment = $this->Member_model->get_profile_comment_unlike($comment_id);
        if($data) {
            echo $message='success|'.$like_comment.' Like|'.$unlike_comment.' Unlike';
        }
        elseif($data == '0') {
            echo $message='unsuccess|Sorry you can not perform this action twice!';
        }
        else echo $message = 'error';
    }

    function sendMessage() {
        $this->checkMemberLogin();
        $this->Member_model->send_message();
        echo "Sent";
    }

    function deleteMessage() {
        $this->checkMemberLogin();
        $this->Member_model->delete_message();
        echo "deleted";
    }
    function deleteBulkMessages($message_type) {
        $this->checkMemberLogin();
        $this->Member_model->delete_bulk_messages($message_type);
        if($message_type == 'sent')
            $message_list = $this->Member_model->mail_sent();
        else
            $message_list = $this->Member_model->mail_received();

        if($message_list>0) {
            foreach($message_list as $list) {
                $message.='<div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                    	<div>
                                                        	<div class="msg_checkbox"><input type="checkbox" name="mailids[]" value="'.$list->id.'"/></div>
                                                        	<div class="msg_from">

                                                                    '.$this->Member_model->get_sender_receiver($list->id,0).'
                                                                </div>
                                                            <div class="msg_subject"><a href="'.site_url('member/messageDetail/'.$list->id).'">'.$list->subject.'</a></div>
                                                            <div class="msg_date">'.date('Y-m-d',$list->created).'</div>';
                if($list->read_flag==0) {
                    $message.='<div class="msg_new"><div class="newmsg_icon"><a href="'.site_url('member/messageDetail/'.$list->id).'">New !</a></div></div>';

                }
                $message.='<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>';

            }echo $message;
        }
        else echo "There is no any messages!";
    }

    function deleteQuestions() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $delete_question = $this->Member_model->delete_questions();

        if($delete_question == "true") { $message='deleted|';
            $mem_info=$this->Member_model->get_member($this->user_id);
            $question_list=$this->Quiz_model->get_user_photo_questions();
            if(count($question_list)> 0) {
                foreach($question_list as $question) {
                    $message.='<div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                    	<div>
                                                        	<div class="msg_checkbox"><input type="checkbox" name="mailid[]" value="'.$question->quiz_id.'" /></div>
                                                        	<div class="viewimg">
                                                            	<div class="border_green"><a href="'.site_url('quiz/view/'.$question->quiz_id).'"><img alt="feature quest img" src="'.base_url().'photo_question_thumbs/'.$question->images.'"></a></div>
                                                            </div>
                                                            <div class="viewques"><a href="'.site_url('quiz/view/'.$question->quiz_id).'">'.$question->quiz_question.'</a></div>
                                                            <div class="msg_date text_center"><a href="'.base_url().'member/editPhotoQuestion/'.$question->quiz_id.'/'.$question->image_id.'" id="edit"><img src="'.base_url().'images/edit.png"  /></a></div>
                                                            <div class="msg_date text_center"><a style="cursor:pointer" id="delete" onclick="delete_quiz('.$question->quiz_id.')"><img src="'.base_url().'images/delete.png"  /></a></div>

                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>';
                }
                echo $message;
            }
            else
                echo $message='<div>There is no any question!</div>';

        }
        else $message='not_deletable|You can not delete this question!';
    }

    function deletePlaylist() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $delete_question = $this->Member_model->delete_questions();

        if($delete_question) {
            $message1='deleted|';

        //            $mem_info=$this->Member_model->get_member($this->user_id);
        //            $quiz_info = $this->Quiz_model->get_quiz($this->user_id);
        //            if(count($quiz_info)>0)
        //                                {
        //                                    foreach($quiz_info as $quizInfo)
        //                                    {
        //
        //                 $message1.= '<div class="content_10box">
        //                                    <div class="playlist_checkbox">
        //                                        <div class="padding_10top">
        //                                            <input type="checkbox" name="mailid[]" value="'.$quizInfo->quiz_id.'" />
        //                                        </div>
        //                                    </div>
        //                                    <div class="playlist_img">
        //                                        <div class="border_green">';
        //                if($quizInfo->quiz_type == 'photo') {
        //                  $image = $this->Quiz_model->get_photo_quiz_by_id($quizInfo->quiz_id);
        //                 $message1.= '<img src="'.base_url().'photo_question_thumbs/'.$image->images.'" width="94" height="71" alt="song img" />';
        //                } else {
        //                       $videos = $this->Quiz_model->get_video_quiz_by_id($quizInfo->quiz_id);
        //                       $video=explode('.',$videos->quiz_videos);
        //                       $message1.='<a href="'.base_url().'converted_videos/'.$video[0].'flv" style="display:block;width:180px;height:135px" id="player_'.$videos->quiz_id.'"></a>';
        //                        }
        //
        //                $message1.= '<div class="plusicon_align">
        //                                                <a href="#"><img src="'.base_url().'images/plus_icon.png" width="11" height="11" alt="plus icon" /></a>
        //                                            </div>
        //                                        </div>
        //
        //                                        <div class="input_clear">
        //                                            <div class="greensmallbtn_leftborder"></div>
        //                                            <div class="greensmallbtn_bg"><a style="cursor:pointer" id="delete" onclick="delete_quiz('.$quizInfo->quiz_id.')">Remove questions</a></div>
        //                                            <div class="greensmallbtn_rightborder"></div>
        //
        //                                            <div class="clear"></div>
        //                                        </div>
        //                                    </div>
        //
        //                                    <div class="playlist_detail">
        //                                        <div class="playlist_detailInner">
        //                                            <div><a href="'.base_url().'quiz/view/'.$quizInfo->quiz_id.'">'.$quizInfo->quiz_question.'</a></div>
        //                                            <div class="font11">'.$quizInfo->quiz_comment.'</div>
        //                                            <div class="padding_10topbottom">
        //                                                <div class="font11">
        //                                                    <div>Added: ';
        //                        $posted_date = $quizInfo->posted_date;
        //                        $message1.= $posted_date = date("M d,Y H:i",$posted_date).'</div>
        //                                                    <div>Form: <a href="#">'.$mem_info->username.'</a></div>
        //                                                    <div>Views: '.$this->Quiz_model->get_quiz_views($quizInfo->quiz_id).'</div>
        //                                                </div>
        //                                            </div>
        //                                            <div>
        //                                                <div id="rate_'.$quizInfo->quiz_id.'" class="rating"></div>
        //                                            </div>
        //                                        </div>
        //                                    </div>
        //
        //                                    <!--<div class="playlist_num">
        //                                        <div class="playlisting">
        //                                        	1
        //                                        </div>
        //                                    </div>-->
        //
        //                                    <div class="clear"></div>
        //                                </div>
        //                                <div class="borderbottom_dotted"></div>';
        //                                }}
        //            echo $message1;
        }
        else $message1='not_deletable|You can not delete this question!';

    }

    function deletePlaylistQuiz() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $delete_question = $this->Member_model->delete_playlist_quiz();

        if($delete_question) {
            $message1='deleted|';
        }
        else $message1='not_deletable|You can not delete this question!';

    }

    function playlist() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/playlist')));
        $data['title']="Member Playlist";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['quiz_info'] = $this->Quiz_model->get_quiz($this->user_id);
        $data['playlist'] = $this->Quiz_model->get_playlist($this->user_id);
        $data['main']="member/playlist";
        $result = $this->Quiz_model->get_quizes_from_playlist($this->user_id,$selected_playlist,0,0);
        $config['base_url'] = base_url().'member/playlist';
        //echo '<pre>'; print_r($result); echo '</pre>';
        $config['total_rows']=  count($result);
        $config['per_page'] = '2';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $selected_playlist = $this->input->post('select_playlist');
        $data['playlist_quizes'] = $this->Quiz_model->get_quizes_from_playlist($this->user_id,$selected_playlist, $config['per_page'],$offset);

        $this->load->view('userhome',$data);
    }

    function favourites() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/favourites')));
        $data['title']="Member Favourites";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['quiz_info'] = $this->Quiz_model->get_quiz($this->user_id);
        $data['main']="member/favourite";
        $result = $this->Quiz_model->get_favourite_quizes($this->user_id,0,0);
        $config['base_url'] = base_url().'member/favourites';

        $config['total_rows']=  count($result);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);

        $data['favourite_quizes'] = $this->Quiz_model->get_favourite_quizes($this->user_id, $config['per_page'],$offset);

        $this->load->view('userhome',$data);
    }

    function referFriends() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/refer_friends";
        $this->load->view('userhome',$data);
    }

    function changePassword() {
        $this->checkMemberLogin();
        $new=$this->input->post('newpassword');
        $renew=$this->input->post('renew');
        $old=$this->input->post('oldpassword');

        if(strcmp($new,$renew)!=0) {
            $message="newpassword|new passwords do not match";
        }
        else {
            $user_id = $this->Member_model->check_password($old);
            if($user_id != 0) {
                $this->Member_model->updatePassword($new);
                $message="success|You have successfully changed your password!";
            }
            else
                $message="oldpassword|current password doesn't exist";
        }
        echo $message.'|<div id="success_message" align="center"></div><div class="input_clear"><label>Current Password</label>
                  <input type="password" class="textbox" name="oldpassword"/>
                  <div class="error_msg" style="padding-left:165px;" id="error_old_password"></div>
                  </div>
                  <div class="input_clear">
                  <label>New Password</label>
                  <input type="password" class="textbox" name="newpassword"  />
				  <div class="error_msg" style="padding-left:165px;" id="error_new_password"></div>
                  </div>
                  <div class="input_clear">
                  <label>Retype New Password</label>
                  <input type="password" class="textbox" name="re_newpassword"  />
                  </div>';
    }


    function changeEmail() {
        $this->checkMemberLogin();
        $this->load->helper('emailvalidation');
        $new=$this->input->post('newemail');
        $old=$this->input->post('old');
        if($new=='') {
            $message="newemail|Please enter new email";
        }
        elseif(is_rfc3696_valid_email_address($new)==0) {
            $message="newemail|Invalid email address";

        }
        else {
            $this->Member_model->updateEmail($new);
            $message="nopassword|success";
        }
        echo $message.'|<div id="success_message" align="center"></div>	<div class="input_clear"><label>Current email</label>
                       <div id="changed_email"><input type="text" class="textbox" name="currentemail" value="'.$old.'" readonly/></div>
                        </div>
                       <div class="input_clear">
                       <label>New email</label>
                       <input type="text" class="textbox" name="newemail"  />
					    <div class="error_msg" style="padding-left:165px;"  id="error_new_email" ></div>
                       </div>';
    }


    function inviteFriend() {    				  // Process refer friends ----------------------
        $this->checkMemberLogin();
        $this->load->helper('cookie_helper');
        $this->load->model('Email_model');
        $this->load->model('User_model');
        $this->load->model('Site_setting_model');


        $user_id=$this->user_id;
        $site_info=$this->Site_setting_model->get_site_info(1);
        $user_detail=$this->Member_model->get_member_profile($user_id);

        $data['title']="Refer Friends: wannaquiz";
        $data['main']="member/refer-friends";


        $headers= "From: noreply@wannaquiz.com \x0d\x0a";
        $headers .= "MIME-Version: 1.0\x0d\x0a";
        $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
        $emails=array();
        // send mails to the friends listed
        for($i=0;$i<6;$i++) {
            $email=$_POST['email'][$i];
            $user_message = $_POST['message'][$i];
            $template=$this->Email_model->get_email_template("EMAIL_FRIEND");
            //print_r($template);exit;
            $subject=$template->template_subject;
            $mail_body=$template->template_design;

            $refer_link="<a href='".site_url('registration/ref/'.$user_id)."'>".site_url('registration/ref/'.$user_id)."</a>";

            $parseElement=array("FNAME"=>$user_detail->first_name,"LNAME"=>$user_detail->last_name,"SITENAME"=>$site_info->site_name,"REFERLINK"=>$refer_link,"FRIEND"=>$email,"USERMESSAGE"=>nl2br($user_message));

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $mail_body=$this->Email_model->parse_email($parseElement,$mail_body);

            if(!empty($email)) {
                if(mail($email, $subject, $mail_body ,$headers)) {
                    $emails[]=$email;
                }

            }
        }

        $implode_email = implode(",",$emails);
        set_cookie('email',$implode_email,time()+604800);

        if(count($emails)==0) {
            $this->session->set_flashdata('error_message','Sorry! Unable to send friend invitation!');
            redirect('member/referfriends');
        //$data['main']="member/refer-friends";
        }
        else {
            $this->session->set_flashdata('message','Invitation send successfully!');
            redirect('member/referfriends');

        }
    //$this->parser->parse('userhome',$data);
    }

    function checkMemberLogin() {
        $this->load->library('session');
        if($this->user_id=="") {
            $this->session->set_flashdata('message',$this->lang->line('msg_please_login'));
            $url='home/login';
            if($this->session->userdata('redURL')) {
                $url='home/login/'.$this->session->userdata('redURL');
            }
            redirect($url);
        }
    }

    function blockFriend() {
        $this->checkMemberLogin();
        $friend_id = $this->input->post('friendID');
        $data = $this->Member_model->block_friend($friend_id);
        if($data) {
            $message= 'success';
            $message.='|<div class="unblock_icon" >
                                                                        <a style="cursor:pointer" onclick="unblock('.$friend_id.')">
                                                                            Unblock
                                                                        </a>
                                                                    </div>';
            echo $message;
        }
        else echo $message='error';
    }

    function unblockFriend() {
        $this->checkMemberLogin();
        $friend_id = $this->input->post('friendID');
        $data = $this->Member_model->unblock_friend($friend_id);
        if($data) {
            $message= 'success';
            $message.='|<div class="block_icon" >
                                                                        <a style="cursor:pointer" onclick="block('.$friend_id.')">
                                                                            block
                                                                        </a>
                                                                    </div>';
            echo $message;
        }
        else echo $message='error';
    }

    function subscribe() {
        $this->checkMemberLogin();
        $data = $this->Member_model->set_subscriber();

        if($data=='subscribed')
            echo $message = 'subscribed';
        elseif($data=='unsubscribed') echo $message = 'unsubscribed';
        elseif($data == 'inserted')
            echo $message = 'subscribed';
    }

    function addFriend() {
        $this->checkMemberLogin();
        $friend_id = $this->input->post('friend_id');
        $data = $this->Member_model->add_friend($friend_id);
        $mem_info = $this->Member_model->get_member_profile($friend_id);
        if($data)
            $message ="Friend added|";
        $message.=$mem_info->first_name.'|';
        $message.=$mem_info->last_name;
        echo $message;
    }
    function deleteVideoContent() {
        $this->checkMemberLogin();
        $video_id = $this->input->post('video_id');
        $delete_action = $this->Member_model->delete_video_content($video_id);
        $video_list = $this->Media_model->getMemberVideoImages($this->user_id);
        if($delete_action) {
            if(count($video_list)>0) {
                foreach($video_list as $video) {
                    $vd=explode('.',$video->video_name);
                    if($_SERVER['SERVER_NAME']=='localhost')
                        $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                    else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                    if(file_exists($a))
                        $mid_data1 = '<img src="'.base_url().'converted_video_images/converted_video_images_thumbs/'.$vd[0].'.jpg" alt="feature quest img" />';
                    else
                        $mid_data1 = '<img src="'.base_url().'images/video_img.jpg" alt="feature quest img" height="100px" width="100px">';
                    $message.= '<div class="viewimg">
                                        <div class="border_green">'.$mid_data1.'</div>
                                        <div><a href="#" style="color:red;" onclick="delete_content('.$video->video_id.')"><span class="font14 bold">X</span> Delete</a></div>
                                `    </div>';
                }
                echo $message;
            } else echo "There is no any video content!";
        }
    }

    function deletePhotoContent() {
        $this->checkMemberLogin();
        $photo_id = $this->input->post('photo_id');
        $delete_action = $this->Member_model->delete_photo_content($photo_id);
        $photos_list = $this->Media_model->getMemberPhotos($this->user_id);
        if($delete_action) {
            if(count($photos_list)>0) {
                foreach($photos_list as $photo) {
                    if($_SERVER['SERVER_NAME']=='localhost')
                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$photo->photo_name;
                    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$photo->photo_name;
                    if(file_exists($photo_path)) {
                        $mid_picture = '<img src="'.base_url().'photo_question_thumbs/'.$photo->photo_name.'" alt="feature quest img" />';
                    } else {
                        $mid_picture = '<img src="'.base_url().'images/default_img.jpg" alt="feature quest img" height="100px" width="100px">';
                    }
                    $message.= '<div class="viewimg">
                                        <div class="border_green"><a href="'.base_url().'user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$photo->photo_name.'" rel="lightbox">'.$mid_picture.'</a></div>
                                        <div><a href="#" style="color:red;" onclick="delete_content('.$photo->photo_id.')"><span class="font14 bold">X</span> Delete</a></div>
                                    </div>';
                }
                echo $message;
            } else echo "There is no any Photo content!";
        }
    }

    function openinviter() {
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $this->load->library('Inviter');
        $plugin = 'hotmail';
        $username = 'sdongol_2000@hotmail.com';//$this->input->post('username');
        $password = 'ka3206su';//$this->input->post('password');

        if(empty($username) || empty($password)) {
            echo '<form action="" method="post">
			Username :<input type="text" name="username" />
			<br />
			Password:<input type="text" name="password" />
			<br />
			<input type="submit" name="submit" value="send"/>
			</form>';
        }
        else {
            $users = $this->inviter->grab_contacts($plugin,$username,$password)   ;
            echo '<pre>';
            print_r($users);
            echo '</pre>';
        }
    }

    function wannaquizHelp($content) {
        $data['page'] =$this->pages_model->get($content);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/wannaquiz_help";
        $this->load->view('userhome',$data);
    }

    function transaction() {
        $id = $this->session->userdata('wannaquiz_user_id');
        $data['member_details']=$this->Member_model->get_member($id);
        $member_transactions=$this->Member_model->member_transactions($id);
        $config['base_url'] = site_url('/member/transaction/');
        $config['total_rows']= count($member_transactions);
        $config['per_page'] = '50';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['member_transactions'] = $this->Member_model->member_transactions($id,$config['per_page'],$offset);
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['main']="member/transaction";
        $this->load->view('userhome',$data);
    }

    function advertisements() {
        $data['main']="member/add_management";
        $this->load->view('userhome',$data);
    }

    function quizView() {
        $data['main']="member/quiz_view";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $question_list=$this->Quiz_model->get_user_questions();
        $config['base_url'] = site_url('/member/quizView/');
        $config['total_rows']= count($question_list);
        $config['per_page'] = '15';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['question_list']=$this->Quiz_model->get_user_questions($config['per_page'],$offset);
        $this->load->view('userhome',$data);
    }

    function updateModerator() {
        $result = $this->Member_model->update_moderator();
        if($result) echo 'success';
        else echo 'error';
    }

    function upgradePartner() {
        $result = $this->Member_model->upgrade_partner();
        if($result) echo 'success';
        else echo 'error';
    }

}

?>