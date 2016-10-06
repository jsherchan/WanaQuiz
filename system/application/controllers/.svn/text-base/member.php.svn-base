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
        $this->load->model('country_management_model');
        $this->load->model('coupon_code_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->user_type=$this->getMemberType();
        $this->user_id=$this->session->userdata('wannaquiz_user_id');
    }
  function index() {
        $this->load->model('Pages_model');
        $this->checkMemberLogin();
        $data['title']="Member Home as abodf";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_page_data']= $this->Pages_model->get('introduction');
        $data['main']="member/regular_member_home";
        $this->load->view('userhome',$data);
    }

    function userHome() {        
        $this->checkMemberLogin();
        
        // $data['winner_of_the_day']=$this->Quiz_model->get_winner_of_day();
         // print_r($data['winner_of_the_day']);
          $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/userHome')));
        $this->checkMemberLogin();
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['filter'] = $data['mem_info']->filter_adult;
        
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

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
            if(!$mem_id) redirect('');
        $this->Quiz_model->set_user_position($mem_id);
        $this->Quiz_model->set_levels($mem_id);
        $this->Quiz_model->insert_profile_view_click('view',$mem_id);
        $data['title']="Member Home";
        //$this->Quiz_model->set_ads_view($mem_id,'banner');
        $data['mem_info']=$this->Member_model->get_member($mem_id);        
       
        $user_id = $this->session->userdata('wannaquiz_user_id');
        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);
            
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            
            $data['filter'] = $filter;
        }
         $data['partner_info']=$this->Member_model->check_user_partner($mem_id);
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
         $data['crdt'] = $this->Member_model->get_default_user_credits($mem_id);

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
        if(empty($data['best_category'])) $data['best_category'] = 'None';
        
        $last_played_game = $this->Quiz_model->last_played_game($mem_id);        
        $data['last_played_game_points'] = empty($last_played_game) ? 'None' : $last_played_game->points ;
        // echo $last_played_game->answered_date;
        if(empty($last_played_game)) 
            $data['last_played_date'] = "Never";
        else if($last_played_game->answered_date!='0') {
            $last_played_date = current_date_time_stamp()-$last_played_game->answered_date;
            if($last_played_date/60 < 60)
                 $data['last_played_date'] = number_format($last_played_date/(60))." min (s) ago";
            else if($last_played_date/(60*60) < 24)
                    $data['last_played_date'] = number_format($last_played_date/(60*60))." hr (s) ago";
                else if($last_played_date/(60*60*24) < 7)
                        $data['last_played_date'] = number_format($last_played_date/(60*60*24))." day (s) ago";
                    else if($last_played_date/(60*60*24*7) < 4)
                            $data['last_played_date'] = number_format($last_played_date/(60*60*24*7))." week (s) ago";
                        else if($last_played_date/(60*60*24*31) < 12)
                                $data['last_played_date'] = number_format($last_played_date/(60*60*24*31))." month (s) ago";
                            else if($last_played_date/(60*60*24*31*12) > 1)
                                    $data['last_played_date'] = number_format($last_played_date/(60*60*24*31*12))."year (s) ago";
        }        
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
        $mem_id = $this->input->post('mem_id',TRUE);
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
        $mem_id = $this->input->post('mem_id',TRUE);
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
        $data['profile_report'] = $this->Member_model->get_member($this->user_id);
       // print_r($data['profile_report']);

        $date2 = current_date_time_stamp();
        $today = date("Y-m-d",$date2);
        $date1 = strtotime('-1 month', strtotime($today));
        $data['date1'] = $date1;
        $data['date2'] = $date2;

        $data['report1'] = $this->Quiz_model->get_banner_report($date1,$date2);
        $data['report2'] = $this->Quiz_model->get_text_report($date1,$date2);
        $data['report3'] = $this->Quiz_model->get_text_flash_report($date1,$date2);
        $data['report4'] = $this->Quiz_model->get_profile_report($date1,$date2);
        $data['type']=$type;
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['mem_info']=$this->Member_model->get_member($this->user_id);

$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
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

        $type = $this->input->post('ads_type',TRUE);
        $date_range = $this->input->post('radio1',TRUE);
        if($date_range == 'select') {
            $date2 = current_date_time_stamp();
            $today = date("Y-m-d",$date2);
            $date_type = $this->input->post('select',TRUE);
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
            $date1 = $this->input->post('date1',TRUE);
            $date1 = strtotime($date1);

            $date2 = $this->input->post('date2',TRUE);
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

$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

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

        $data['filter'] = $data['mem_info']->filter_adult;
        
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

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
       // echo $userfile.'/'.$video; exit;
        $this->load->library('images');
	$this->load->helper('image');
        $this->checkMemberLogin();
        $this->load->helper('videoconversion');
        
        $input = $video;
        
        if($_SERVER['HTTP_HOST']=='localhost') { $rootpath="D:/xampp/htdoc/wannaquiz/"; }
        else { $rootpath = '/home/wannaquiz/domains/wannaquiz.com/public_html/'; }
        
        #else $rootpath=$_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz';//realpath('\home\proshore\domains\proshore.eu\public_html\clients\wannaquiz');
        
        $inputpath = $rootpath . "uploaded_videos";

        if($userfile=='userfile')
            $outputpath = $rootpath . "uploaded_video_questions";
        else
            $outputpath = $rootpath . "uploaded_video_answers";

        $outputpath1 = $rootpath . "converted_video_images";
         $VideoFileName=$inputpath.'/'.$input;
         //echo $VideoFileName;
         $dimension=get_video_dimensions($VideoFileName);
//         $width=$dimension['width'];
//         $height=$dimension['height'];  
//        // print_r($dimension);
//        $asp=$width/$height;
//        if($asp>=1.33 && $asp <=1.35)
//        {
//            $width=360;
//            $height=270;
//        }
//        if($asp>=1.70 && $asp <=1.78)
//        {
//            $width=360;
//            $height=270;
//        }
         $width=360;
         $height=270;
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

        $data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
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

       function addPhotoQuestion($photo_id='',$j='') {
        $data['ph_id'] = $photo_id;
        $data['js']=$j;
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
        $data['country_list']=$this->country_management_model->get_country();
        $data['image_width']='';
        if($this->user_type==0)
            $data['main']="quiz/add_photo_quiz_regular";
        else
            $data['main']="quiz/add_photo_quiz_step1";
        
#exit($data['main']);
        $data['photos_list']=$this->Media_model->getMemberPhotos($this->user_id);
         $data['total_photo']=count($data['photos_list']);
        $data['ques_photo']='';
        if($photo_id!="") {
            $photo_info=$this->Media_model->getMemberPhotosByID($photo_id);

            //$data['image_height']=getHeight('user_uploaded_photos/'.$this->user_id.'/'. $photo_info->photo_name);
            //$data['image_width']=getWidth('user_uploaded_photos/'.$this->user_id.'/'.$photo_info->photo_name);
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
        $data['v_id'] = $video_id;
         $data['js']=$j;
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
        $data['country_list']=$this->country_management_model->get_country();
        $data['title']="Member Upload Photo";

        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        if($this->user_type==0)
            $data['main']="quiz/add_video_quiz_regular";
        else
            $data['main']="quiz/add_video_quiz_step1";

        //$data['ques_video']=$video;
        $data['videos_list']=$this->Media_model->getMemberVideoImages($this->user_id);
        $data['total_videos']=count($data['videos_list']);
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
# for online usage
    function cropVideo(){
        $this->load->library('images');
		$this->load->helper('image');
        $this->session->unset_userdata('first_video');
        $this->session->unset_userdata('second_video');
        $pause_time =  $this->sec2hms($this->input->post('pause_time',TRUE),true);
        $total_time = $this->sec2hms($this->input->post('total_time',TRUE),true);
        $cut_duration = $this->input->post('cut_duration',TRUE);
        //echo $pause_time.'/'.$total_time.'/'.$cut_duration; //exit;
        //echo $this->input->post('video_name');exit;
        if($_SERVER['SERVER_NAME']=='localhost')
            $file = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$this->input->post('video_name',TRUE);
        #else $file = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$this->input->post('video_name');
        else $file = $_SERVER['DOCUMENT_ROOT']."/uploaded_video_questions/".$this->input->post('video_name',TRUE);
        $file1 = explode(".",$this->input->post('video_name',TRUE));
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
            #$out = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path;
            #$qout = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path;
            $out = $_SERVER['DOCUMENT_ROOT']."/uploaded_video_answers/".$answer_path;
            $qout = $_SERVER['DOCUMENT_ROOT']."/uploaded_video_questions/".$question_path;

            #$out_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_answers/".$answer_path_final;
            #$qout_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/".$question_path_final;
            $out_path = $_SERVER['DOCUMENT_ROOT']."/uploaded_video_answers/".$answer_path_final;
            $qout_path = $_SERVER['DOCUMENT_ROOT']."/uploaded_video_questions/".$question_path_final;
        }
        //-ss is the start time i.e. video cut from this point in HH:mm:ss and -t is the end time in HH:mm:ss i.e. cut to this point
        //the path to ffmpeg could be different in your case
        // system("/usr/local/bin/ffmpeg -i $file -ss 00:00:09 -t 00:00:19 $out");
        //system("/usr/local/bin/ffmpeg -i $file -acodec libfaac -ss 00:00:02 -t 00:00:12 -ar 22050 -ab 32 -f flv -s 400x250 $out");
        //system("/usr/local/bin/ffmpeg -sameq -ss $pause_time -t $total_time -i $file $out");
        //system("/usr/local/bin/ffmpeg -sameq -ss 00:00:00.0 -t $pause_time -i $file $qout");

        system("./bin/ffmpeg -async 1 -sameq -ss $pause_time -t $total_time -i $file $out");
        system("./bin/ffmpeg -async 1 -sameq -ss 00:00:00.0 -t $pause_time -i $file $qout");

        //echo "/usr/bin/flvtool2 -U stdin $out"; echo "****";
        system("./bin/flvtool2 -U stdin $out_path < $out");
        system("./bin/flvtool2 -U stdin $qout_path < $qout");

        $data['ans_video'] = $answer_path_final;
        $data['ques_video'] = $question_path_final;
        $file_name = explode(".",$question_path_final);
        $file_name_a = explode(".",$answer_path_final);

       $this->images->squareThumb('converted_video_images/'.$file1[0].'.jpg','converted_video_images/converted_video_images_thumbs/'.$file_name[0].'.jpg',100);
       $this->images->squareThumb('converted_video_images/'.$file1[0].'.jpg','converted_video_images/converted_video_images_thumbs/'.$file_name_a[0].'.jpg',100);

       if($_SERVER['SERVER_NAME']=='localhost'){
       if(file_exists($_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_answers/".$answer_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_answers/".$answer_path);

        if(file_exists($_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$question_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/wannaquiz/uploaded_video_questions/".$question_path);
       }
       else
       {
           if(file_exists($_SERVER['DOCUMENT_ROOT']."/uploaded_video_answers/".$answer_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/uploaded_video_answers/".$answer_path);

        if(file_exists($_SERVER['DOCUMENT_ROOT']."/uploaded_video_questions/".$question_path))
                    unlink($_SERVER['DOCUMENT_ROOT']."/uploaded_video_questions/".$question_path);
       }
        $this->session->set_userdata('first_video',$data['ques_video']);
        $this->session->set_userdata('second_video',$data['ans_video']);
        echo $this->load->view("quiz/ans_video_right_ajax", $data, true);echo "*";
        echo $this->load->view("quiz/question_video_right_ajax", $data, true);
    }

    function editPhotoQuestion($quiz_id='',$photo_id='',$type='',$j='') { //echo $quiz_id;
        $this->checkMemberLogin();
        $data['ph_id'] = $photo_id;
         $data['js']=$j;
        $this->load->model('Quiz_model');
        $data['country_list']=$this->country_management_model->get_country();
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
      
        if($data['quiz_info']->country_target!="" && $data['quiz_info']->state_target!=""){
        $data['state_name']=$this->country_management_model->getStateName($data['quiz_info']->country_target,$data['quiz_info']->state_target); 
             }
       
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
         $data['total_photo']=count($data['photos_list']);
        $sql = "select images from tbl_quiz_images where quiz_id=".$quiz_id;
        $query=$this->db->query($sql);
        $result=$query->row();
        if($photo_id!="") {
            $photo_info=$this->Media_model->getMemberPhotosByID($photo_id);
            //$data['image_height']=getHeight('user_uploaded_photos/'.$this->user_id.'/'. $photo_info->photo_name);
            //$data['image_width']=getWidth('user_uploaded_photos/'.$this->user_id.'/'.$photo_info->photo_name);
            if($type == "unset") {
                $data['ques_photo']= $result->images;
                $data['ans_photo'] = $photo_info->photo_name;
                $data['ans_id'] = $photo_info->photo_id;
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
       // echo $data['ans_photo']; exit;
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


    function editVideoQuestion($quiz_id='',$video_id='',$type='',$j='') {
       //echo $this->session->userdata('first_video').'/'. $this->session->userdata('second_video').'/'.$this->session->userdata('ans_id');
       $this->load->model('Quiz_model');
        $this->checkMemberLogin();
        $data['v_id'] = $video_id;
         $data['js']=$j;
        $data['country_list']=$this->country_management_model->get_country();
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        if($data['quiz_info']->country_target!="" && $data['quiz_info']->state_target!=""){
        $data['state_name']=$this->country_management_model->getStateName($data['quiz_info']->country_target,$data['quiz_info']->state_target); 
             }
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
        $data['total_videos']=count($data['videos_list']);
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
       // print_r($data['mem_info']);
        $data['filter'] = $data['mem_info']->filter_adult;        
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
        $data['type'] = $type;

        $data['friend_list'] = $this->Member_model->get_friends($this->user_id,$config['per_page'],$offset);
        if($type=="photo") {
            $question_list = $this->Quiz_model->get_user_photo_questions(null,null,$data['mem_info']->user_type);
            $config['base_url'] = site_url('/member/viewQuestions/photo');
            $config['total_rows']=count($question_list);
            $config['per_page'] = '8';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['question_list'] = $this->Quiz_model->get_user_photo_questions($config['per_page'],$offset,$data['mem_info']->user_type);
            $data['main']="quiz/view_questions";
        }
        elseif($type=='video') {
            $question_list=$this->Quiz_model->get_user_video_questions(null,null,$data['mem_info']->user_type);
            $config['base_url'] = site_url('/member/viewQuestions/video');
            $config['total_rows']=count($question_list);
            $config['per_page'] = '8';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data['question_list']=$this->Quiz_model->get_user_video_questions($config['per_page'],$offset,$data['mem_info']->user_type);
            $data['main']="quiz/view_questions";
        }

        else {
            $data['question_list'] = $this->Quiz_model->get_user_questions(null,null,$data['mem_info']->user_type);
            $data['main']="quiz/view_all_questions";
        }
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
        $this->load->model('Quiz_model');
        $this->checkMemberLogin();
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['category'] = $this->Category_model->get_categories();
        $data['quiz_budget_details'] = $this->Quiz_model->get_user_quiz_budget($this->user_id);
        $data['main']="member/advertiser_buy_adspace";
        $data['quiz_id'] = $qid;
        $this->load->view('userhome',$data);
    }

    function buyAdSpace2() {
        $this->checkMemberLogin();
         $uid=$this->session->userdata('wannaquiz_user_id');
         $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);        
        $data['main']="member/advertiser_buy_adspace2";
        $this->load->view('userhome',$data);
    }

    function updatePublicprofile() { #$type='') {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['main']="member/update_public_profile";
        
        #if($type) $data['main'] .= '/' . $type;
        
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
       $data['country_list']=$this->Country_management_model->get_all_country();
      $data['mem_add'] = $this->Member_model->get_address($this->user_id);
      $data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['company_detail'] = $this->Member_model->get_company_detail($this->user_id);
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['user_banner'] = $this->Quiz_model->get_profile_banners($this->user_id);

        //print_r($data['user_banner']);
        $this->load->view('userhome',$data);
    }

    
    function changePassword() {
        $this->checkMemberLogin();
        $new=$this->input->post('newpassword',TRUE);
        $renew=$this->input->post('re_newpassword',TRUE);
        $old=$this->input->post('oldpassword',TRUE);

        $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        $this->form_validation->set_rules('re_newpassword', 'Retype', 'required|matches[newpassword]');
        $this->form_validation->set_rules('oldpassword', 'Current Password', 'required|callback_check_password[$old]');
        
        if($this->form_validation->run()==FALSE) 
        { 
            $this->session->set_userdata('update_password',validation_errors());            
        }
        else
        {
            $this->Member_model->updatePassword($new);
            $this->session->set_userdata('update_password','Password Changed Successfully');
        }
    }


    function changeEmail() {
        $this->checkMemberLogin();
        $this->load->helper('emailvalidation');
        $new=$this->input->post('newemail',TRUE);
        $old=$this->input->post('currentemail',TRUE);

        
        $this->form_validation->set_rules('newemail', 'New Email', 'required|valid_email|callback_check_email_exist[$new]');
        
        if($this->form_validation->run()==FALSE) 
        { 
            $this->session->set_userdata('update_email',validation_errors());
        }
        else
        {
            $this->Member_model->updateEmail($new);
            $this->session->set_userdata('update_email','Email Changed Successfully to <u>' . $new . '</u>');            
            # do something and return;
        }        
    }
    
    function editProfile($type='') 
    {
        $this->load->model('Registration_model');
        $this->checkMemberLogin();                
        
#       $mem_info=$this->Member_model->get_member($this->user_id);
#       $editdata = $this->Member_model->updateMember();        
#echo 'type=' . $type;    
        if($type=='address'){
            $c=$this->input->post('country',TRUE);
            $s=$this->input->post('state',TRUE);
           
          if($c){
          $sql="select country_name from country where country_code like '%$c%'";
          $ct=$this->db->query($sql);
          $cs=$ct->result_array();
          $country=$cs[0]['country_name'];
          }
          if($s){
           $que="select state_name from states where country_code like '%$c%' and state_code like'%$s%'";
             $st=$this->db->query($que);
              $ss=$st->result_array();
              $state=$ss[0]['state_name'];
          }
            $address= array(
            'country'=>$country,
            'state'=>$state,
            'city'=>$this->input->post('city',TRUE)
                );
            $this->db->where('member_id',$this->session->userdata('wannaquiz_user_id'));
            $this->db->update('tbl_address',$address);
            
        }
        if($type=='email')
        {
            $this->changeEmail();
        }
            
        if($type=='password')
        {
            $this->changePassword();
        }
            
        
        if($type=='profile')
        {
            $user_type = $this->input->post('user_type',TRUE);
            $website = $this->input->post('website',TRUE);
            $other_website1 = $this->input->post('other_website1',TRUE);
            $company_website = $this->input->post('company_website',TRUE);

# for webiste 1
            if($website!='')
            {
                if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $website))
                    $website = $this->input->post('website',TRUE);
                else 
                    $website = $website;
            }
            
            else $website='';

# for website 2
            if($other_website1 != '')
            {
                if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $other_website1))
                    $other_website1 = $this->input->post('$other_website1',TRUE);
                else 
                    $other_website1 = $other_website1;
            }
            
            else $other_website1 = '';
            
# for company website
            if($company_website != '')
            {
                if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $company_website))
                    $company_website = $this->input->post('company_website',TRUE);
                else 
                    $company_website = $company_website;
            }
            
            else $company_website = '';

# branch processing as per member type
            if($user_type !=0)
            {
                $profile = array(
                'first_name' => $this->input->post('fname',TRUE),
                'last_name' => $this->input->post('lname',TRUE),       
                'website' => $website,
                'other_website1' => $other_website1,
                'profile_description' => $this->input->post('profile_description',TRUE)
                );
            
                $address = array(
                'company_name' => $this->input->post('company_name',TRUE),
                'company_website' => $company_website,
                'company_info' => $this->input->post('company_desc',TRUE),
                'personal_information' => $this->input->post('personal_desc',TRUE)
                );
            }
            else if($user_type==0)
            {
                $profile = array(
                'first_name' => $this->input->post('fname',TRUE),
                'last_name' => $this->input->post('lname',TRUE),                
                'profile_description' => $this->input->post('profile_description',TRUE),
                 'website' =>$website,
                'other_website1'=>$this->input->post('other_website1',TRUE),
                'other_website2'=>$this->input->post('other_website2',TRUE),
                'other_website3'=>$this->input->post('other_website3',TRUE)
                );
            }            
            
            $this->form_validation->set_rules('fname', 'First Name','required');
            $this->form_validation->set_rules('lname', 'Surname','required');
            
            if($user_type!=0)
            {
                if($website)
                    $this->form_validation->set_rules('website', 'Website','callback_check_company_website[$website]');
                if($other_website)
                    $this->form_validation->set_rules('other_website1', 'Other Website','callback_check_company_website[$other_website]');

                $this->form_validation->set_rules('company_name', 'Company Name','callback_check_company_name[' . $this->input->post('company_name',TRUE) . ']');
                $this->form_validation->set_rules('company_website', 'Company Website','callback_check_company_website[$company_website]');
            }            
            
            if($this->form_validation->run()==FALSE) 
            { 
                $this->session->set_userdata('update_profile',validation_errors());
            }
            else
            {
                if($user_type==0)
                    $this->Member_model->update_member($profile);
                else if($user_type!=0)
                    $this->Member_model->update_member($profile,$address);
                
                $this->session->set_userdata('update_profile','Profile Updated Successfully');            
                # do something and return;
            }
        }
        
        #$type = '#error_' . $type;
        $this->updatePublicprofile();#$type);

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
#        echo '<pre>' . var_dump($image_info) . '</pre>';exit;
        //create thumbnail
        #exit(UPLOADS.'/'.$image_info['file_name'].PROFILE_IMAGES_THUMB.$image_info['file_name']);
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
    //  echo $this->db->last_query();
        $data['date'] = current_date_time_stamp();
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['title']="Manage Friends~ Wannaquiz";
        $data['main']="member/friend_list";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        
$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
        $this->load->view('userhome',$data);
    }

    function sendFriendRequest() {
        $this->checkMemberLogin();
        $friend_id=$this->input->post('friend_id',TRUE);
        $friend_request = $this->Member_model->send_friend_request($friend_id);
         if($friend_request){
           if($friend_request=='2'){
             $message="success*";
             $message.="You Have Alredy Sent The Friend Request!";
             echo $message;
             
             }
             else if($friend_request=='1'){
                 $message="success*";
                 $message.="Friend Request is Sent!";
                 echo $message;
                 
             }
          }
    else echo "error|error";
    }
    function message($status=0) {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $data['title']="Member Upload Video";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        
    $data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
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
       // echo $this->user_id;
        $data['msg']="Sent Message";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['message_info']=$this->Member_model->get_message($id);
        $data['receiver_username']=$this->Member_model->get_member($data['message_info']->recipient_id);
      
        $data['reply_list']=$this->Member_model->get_message_replies($id);
        //$data['message_list']=$this->Member_model->mail_received();
        if($data[message_info]->subject == 'Friend request') {
            $member_friend = $this->Member_model->check_member_friend($data[message_info]->user_id,$data[message_info]->recipient_id);
            if($member_friend)
            $data[friend_status] ='not added';
           // else $data[friend_status]='0';
        }
        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $this->Member_model->set_message_read($id);
        $data['title']="Member Upload Video";
        $data['main']="member/message_detail";
        $this->load->view('userhome',$data);
    }

     function messageDetailReceive($id) {
        $this->checkMemberLogin();
       // echo $this->user_id;
        $data['msg']="Received Message";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['message_info']=$this->Member_model->get_messagereceive($id);
      //  echo $this->db->last_query();
      //  print_r($data['message_info']);
       
        $data['reply_list']=$this->Member_model->get_message_replies($id);
       // $data['message_list']=$this->Member_model->mail_received();
        if($data[message_info]->subject == 'Friend request') {
            $member_friend = $this->Member_model->check_member_friend($data[message_info]->user_id,$data[message_info]->recipient_id);
             if($member_friend)
                 $data[friend_status] ='not added';
           // else $data[friend_status]='1';
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
						  <div> <span class="bold"><a href="#" class="color_gray">'.$mem_profile->username.'</a></span> <span class="font10">| '.date('d F Y,H:i a',current_date_time_stamp()).'</span> </div>
						  <div class="padding_10topbottom">'.$this->input->post('message',TRUE).'

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

            $mem_id = $this->input->post('profile_id',TRUE);

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
                                    <div class="comment_name"><a href="#" class="bold">'.$profileComments->username.'</a> ('.date('Y-m-d H:i:s',$profileComments->coment_date).')</div>
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
                                                <div class="comment_subname"><a href="'.base_url().$reply->username.'" class="bold">'.$reply->username.'</a> ('.date("Y-m-d H:i:s",$reply->coment_date).')</div>
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

            $mem_id = $this->input->post('profile_id',TRUE);
            $comment_id = $this->input->post('comment_id',TRUE);
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
                                                <div class="comment_subname"><a href="#" class="bold">'.$reply->username.'</a> ('.date("Y-m-d H:i:s",$reply->coment_date).')</div>
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
        $flag= $this->input->post('flag',TRUE);
        $data = $this->Member_model->spam_member_comment($comment_id);
        $comment = $this->Member_model->get_spam_member_comment($comment_id);
        if($data) {
            $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = $site_info->site_email;
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
        $comment_id = $this->input->post('comment_id',TRUE);
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
        $send_message=$this->Member_model->send_message();
       if($send_message)
            echo "success";
       else echo "error|error";
    }

    function deleteMessage() {
        $this->checkMemberLogin();
        $this->Member_model->delete_message();
        echo "deleted";
    }
    function deleteBulkMessages($message_type) {
        $this->checkMemberLogin();
        $this->Member_model->delete_bulk_messages($message_type);
        if($message_type == 'sent'){
            $type=1;
            $message_list = $this->Member_model->mail_sent();
        }
        else{
          $type=0;
          $message_list = $this->Member_model->mail_received();
        }
        if($message_list>0) {
            foreach($message_list as $list) {
                $message.='<div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                    	<div>
                                                        	<div class="msg_checkbox"><input type="checkbox" name="mailids[]" value="'.$list->id.'"/></div>
                                                        	<div class="msg_from">

                                                                    '.$this->Member_model->get_sender_receiver($list->id,$type).'
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
                                                        	<div class="msg_checkbox"><input type="checkbox" name="name_'.$question->quiz_id.'" value="'.$question->quiz_id.'" class="check_name"/></div>
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
        $delete_question = $this->Member_model->delete_playlist_quiz();

        if($delete_question) {
           $message1='deleted|';
        }
        else $message1='not_deletable|You can not delete this question!';
    echo $message1;
    }

    function playlist() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $selected_playlist = $this->input->post('select_playlist',TRUE);
        $this->session->set_userdata('redURL',base64_encode(site_url('member/playlist')));
        $data['title']="Member Playlist";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['selected_playlist']= $selected_playlist;
       $data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
        $data['mem_profile'] = $this->Member_model->get_member_profile($this->user_id);
        $data['quiz_info'] = $this->Quiz_model->get_quiz($this->user_id);
        $data['playlist'] = $this->Quiz_model->get_playlist($this->user_id);
    // print_r($data['playlist']);
        $data['main']="member/playlist";
        $result = $this->Quiz_model->get_quizes_from_playlist($this->user_id,$selected_playlist,0,0);
      // print_r($result);
        $config['base_url'] = base_url().'member/playlist';
       // echo '<pre>'; print_r($result); echo '</pre>';
        $config['total_rows']=  count($result);
        $config['per_page'] = '8';
        $config['uri_segment'] = '3';
        $offset=$this->uri->segment(3,0);
        $this->pagination->initialize($config);
       
        $data['playlist_quizes'] = $this->Quiz_model->get_quizes_from_playlist($this->user_id,$selected_playlist, $config['per_page'],$offset);
       
       // print_r( $data['playlist_quizes']);
        $this->load->view('userhome',$data);
    }
    

    function favourites() {
        $this->checkMemberLogin();
        $this->load->model('Quiz_model');
        $this->session->set_userdata('redURL',base64_encode(site_url('member/favourites')));
        $data['title']="Member Favourites";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        
$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

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

$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

        $data['recently_played'] = $this->Quiz_model->get_recently_played_quizes($this->user_id);
        $data['unplayed_quiz'] = $this->Quiz_model->get_unplayed_quizes($this->user_id);
        $data['main']="member/refer_friends";
        $this->load->view('userhome',$data);
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
        $friend_id = $this->input->post('friendID',TRUE);
        $data = $this->Member_model->block_friend($friend_id);
        if($data) {
            $message= 'success';
            $message.='|<div class="unblock_icon" >
                                                                        <a style="cursor:pointer" onclick="unblock('.$friend_id.')">
                                                                            Unblock
                                                                        </a>
                                                                    </div>
                                                                     <label><input type="checkbox" name="name_<?=$photo->photo_id?>" value="<?=$photo->photo_id?>" class="check_name"></label>';
            echo $message;
        }
        else echo $message='error';
    }

    function unblockFriend() {
        $this->checkMemberLogin();
        $friend_id = $this->input->post('friendID',TRUE);
        $data = $this->Member_model->unblock_friend($friend_id);
        if($data) {
            $message= 'success';
            $message.='|<div class="block_icon" >
                                                                        <a style="cursor:pointer" onclick="block('.$friend_id.')">
                                                                            Block
                                                                        </a>
                                                                    </div>
                                                                     <label><input type="checkbox" name="name_<?=$photo->photo_id?>" value="<?=$photo->photo_id?>" class="check_name"></label>';
            echo $message;
        }
        else echo $message='error';
    }

    function subscribe() {
        if($this->checkMemberLogin())
        echo "not_logged_in";
        $data = $this->Member_model->set_subscriber();

        if($data=='subscribed')
            echo $message = 'subscribed';
        elseif($data=='unsubscribed') echo $message = 'unsubscribed';
        elseif($data == 'inserted')
            echo $message = 'subscribed';
    }

    function addFriend() {
        $this->checkMemberLogin();
        $friend_id = $this->input->post('friend_id',TRUE);
        $data = $this->Member_model->add_friend($friend_id);
        $mem_info = $this->Member_model->get_member_profile($friend_id);
        if($data){
            $message ="Friend added|";
        $message.=$mem_info->username;
        echo $message;
        }
        else echo "error|error";
    }
    function deleteFriendList()
    {
         $this->checkMemberLogin();
        $delete_action = $this->Member_model->delete_friend();
      return true;
        
    }
    function deleteVideoContent() {
        $this->checkMemberLogin();
        $video_id = $this->input->post('video_id',TRUE);
        $delete_action = $this->Member_model->delete_video_content($video_id);
        $video_list = $this->Media_model->getMemberVideoImages($this->user_id);
        if($delete_action) {
            if(count($video_list)>0) {
                //foreach($video_list as $video) {
                    if(count($video_list)>8)$x=8; else $x= count($video_list); 
                    for($i=0; $i<$x; $i++){
                    $vd=explode('.',$video_list[$i]->video_name);
                    if($_SERVER['SERVER_NAME']=='localhost')
                        $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                    #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                    else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                    if(file_exists($a))
                        $mid_data1 = '<img src="'.base_url().'converted_video_images/converted_video_images_thumbs/'.$vd[0].'.jpg" alt="feature quest img" />';
                    else
                        $mid_data1 = '<img src="'.base_url().'images/video_img.jpg" alt="feature quest img" height="100px" width="100px">';
                    $message.= '<div class="viewimg">
                                        <div class="border_green">'.$mid_data1.'</div>
                                        <div><label><input type="checkbox" name="name_'.$video_list[$i]->video_id.'" value="'.$video_list[$i]->video_id.'"></label><!--<a href="#" style="color:red;" onclick="delete_content('.$video_list[$i]->video_id.')"><span class="font14 bold">X</span> Delete</a>--></div>
                                `    </div>';
                }//}
                echo $message;
            } else echo "There is no any video content!";
        }
    }
    

    function deletePhotoContent() {
        #ini_set('display_errors',1);
        $this->checkMemberLogin();
        $delete_action = $this->Member_model->delete_photo_content();
        $photos_list = $this->Media_model->getMemberPhotos($this->user_id);
        //var_dump($photos_list);exit;
        //if($delete_action) {
            if(count($photos_list)>0) {
                //foreach($photos_list as $photo) {
                if(count($photos_list)>8)$x=8; else $x= count($photos_list);
                    for($i=0; $i<$x; $i++){
                    if($_SERVER['SERVER_NAME']=='localhost')
                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$photos_list[$i]->photo_name;
                    #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$photos_list[$i]->photo_name;
                    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$photos_list[$i]->photo_name;
                    if(file_exists($photo_path)) {
                       $mid_picture = '<img src="'.base_url().'photo_question_thumbs/'.$photos_list[$i]->photo_name.'" alt="feature quest img" />';
                    } else {
                        $mid_picture = '<img src="'.base_url().'images/default_img.jpg" alt="feature quest img" height="100px" width="100px">';
                    }
                    $message.= '<div class="viewimg">
                                        <div class="border_green"><a href="'.base_url().'user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$photos_list[$i]->photo_name.'" rel="lightbox">'.$mid_picture.'</a></div>
                                        <div><label><input type="checkbox" name="name_'.$photos_list[$i]->photo_id.'" value="'.$photos_list[$i]->photo_id.'" class="check_name"></label><!--<a href="#" style="color:red;" onclick="delete_content('.$photos_list[$i]->photo_id.') " ><span class="font14 bold">X</span> Delete</a>--></div>
                                    </div>';
                }
                echo $message;
            } else echo "There is no any Photo content!";
        //}
    }

    function openinviter() {
        #ini_set('display_errors',1);
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

$data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

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

    function request_moderator()
    {
        $id = $this->input->post('user_id',TRUE);
        //return $id;
        $this->Member_model->set_moderator_request($id);        
        echo 'success';
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
    
    /* load callback functions from Registration controller */
    function check_terms()
	{
        if ($this->input->post('terms',TRUE)!='yes')
        {
            $this->form_validation->set_message('check_terms', 'You must accept terms and conditions');
            return FALSE;                            
        }
        else
        {
            return TRUE;        
        }
	}
    function check_privacy()
	{
        if ($this->input->post('privacy',TRUE)!='yes')
        {
            $this->form_validation->set_message('check_privacy', 'You should agree to privacy and policy.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
	}

   
	function check_adult()
	{
        if ($this->input->post('check_adult',TRUE)!='yes')
        {
            $this->form_validation->set_message('check_adult', 'You should confirm your age older than !8 years.');
            return FALSE;                            
        }
        else
        {
            return TRUE;        
        }
	}

	function check_uname() {

            if ($this->input->post('uname',TRUE)=='') {

                $this->form_validation->set_message('check_uname', 'Username field is required.');
                return FALSE;
            }
            else {
                $sql="select * from tbl_members where username=?";
                $query=$this->db->query($sql,array($this->input->post('uname',TRUE)));
                if($query->num_rows()>0) {
                    $this->form_validation->set_message('check_uname', 'Similar username already exists. Plz try again.');
                    return false;
                }
            }
            return TRUE;

        }

        function check_company_name($cname) 
        {
            $mem_id = $this->session->userdata('wannaquiz_user_id');
            
            $sql="select member_id from tbl_advertisers where company_name=?";
            $query=$this->db->query($sql,array($cname));
            
            if($query->num_rows()>0) 
            {
                $result = $query->row_array();
                
                if($result['member_id']==$mem_id) return TRUE;
                else
                {
                    $this->form_validation->set_message('check_company_name', 'Company name already exists. Plz try again.');
                    return FALSE;
                }                
            }
            return TRUE;

        }
	
	function check_email_exist($email)
	{
        $sql="select * from tbl_member_profile where email=?";
		$query=$this->db->query($sql,array($email));
		if($query->num_rows()>0) 
		{
		  $this->form_validation->set_message('check_email_exist', 'Email Id already exists.');
		  return false;
		}
        return TRUE;        

	}

        function check_company_website($website)
	{
                $mem_id = $this->session->userdata('wannaquiz_user_id');
                
                $sql="select member_id from tbl_advertisers where company_website=?";
		$query=$this->db->query($sql,array($website));
                
		if($query->num_rows()>0)
		{
                    $result = $query->row_array();                
                    if($result['member_id']==$mem_id) return TRUE;
                    else
                    {
                      $this->form_validation->set_message('check_company_website', 'Same Company Website exists.');
                      return FALSE;
                    }
		}
        return TRUE;

	}
        
        function _alpha_dash_space($str_in = '')
	{
		//if (!preg_match("/^([-a-z0-9_ ])+$/i", $str_in))  //alpha-numeric characters, underscores, and dashes.
		if (!preg_match("/^([a-z0-9])+$/i", $str_in))
		{
			$this->form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha-numeric characters.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
        
        function check_password($password) 
        {   
            $query = $this->db->getwhere('tbl_members', array('user_id' =>$this->session->userdata('wannaquiz_user_id'), 'password' => md5($password)));
            #exit($this->db->last_query());
            $row = $query->row();
            
            if($query->num_rows() == 0) {
                $this->form_validation->set_message('check_password', "Password doesn't match with Existing Password");
                return FALSE;
            }
            else {
                return TRUE;
            }
        }
        function moderator_control()
        {
           $id=$this->input->post('user_id',TRUE);
            $this->load->model('Quiz_model');
           $quizcount=$this->Quiz_model->get_count_quiz($id);
          
           if($quizcount<=10)
           {
               echo 'success';
           }
           else echo 'false';
        }
      
}
?>