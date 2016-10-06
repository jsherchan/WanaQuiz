<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Quiz extends Front_controller {

/**
 * Constructor
 *
 * @access	public
 */
    function Quiz() {
        parent::Front_controller();
        $this->load->model('Quiz_model');
        $this->load->model('Country_management_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper('text_helper');
       
    //$this->output->enable_profiler(true);
    }

    // --------------------------------------------------------------------

    /**
     * Initial Method
     *
     * @access	public
     */

    function filter_content()
    {
        $user_id = $this->input->post('user_id');
        $filter = $this->input->post('filter');
    // exit($filter);
        if($this->Quiz_model->filter_quiz($user_id,$filter)) echo '1';
        else echo '0';
    }
    
    function view($id='',$off='') {
        if($id=='') redirect("quiz/search/");
  
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['user'] = $this->Quiz_model->get_user_by_quizid($id);
      // echo $id;
      // filter content 
      
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
       
        if($data['user']->user_id!=$uid && $this->Quiz_model->check_user_quiz_played($id,$uid))
        {
            $this->session->set_userdata('unview','You have already played the Quiz');
            redirect("quiz/search/");
        }        
        
        if($data['user']->user_type !=0){
        $check_quiz_budget = $this->Quiz_model->get_user_quiz_budget($data['user']->user_id);
        $budget_status = $check_quiz_budget->budget_status;
        }
        else $budget_status = '1';
        if($budget_status!='1'){
            $data['main'] = 'quiz_error';
            $this->load->view('index',$data);
        }
        else{
            $check_quiz_played = $this->Quiz_model->check_quiz_played($id);
            //echo $check_quiz_played; exit;
            if($off=='') {
            //$this->session->unset_userdata('game_mode');
            //$this->session->unset_userdata('previous_player');
            }
            if($check_quiz_played!='0' ) {
            //$this->session->unset_userdata('game_mode');
                $this->session->set_userdata('set_score','no');
            }
            else
                $this->session->set_userdata('set_score','yes');

            $this->load->helper('cookie');
            $this->load->model('Category_model');
            $this->load->model('Advertise_management_model');
            
            $this->Quiz_model->set_user_position($this->session->userdata('wannaquiz_user_id'));
            $this->Quiz_model->set_levels($this->session->userdata('wannaquiz_user_id'));

            $this->Quiz_model->set_quiz_views($id);
            $user_id = $data['user']->user_id;
            //$this->Quiz_model->set_ads_view($user_id,'long_text');
            $this->Quiz_model->set_quiz_impression($id);
            //$ads_rotation = $user->ads_rotation;
            $data['text_ads_info'] = $this->Quiz_model->get_text_ads($user_id,$id);
            $data['banner_ads_info'] = $this->Quiz_model->get_banner_ads($user_id,$id);
            $data['quiz_id']=$id;
            $data['quiz_comments']=$this->Quiz_model->get_quiz_comments($qid,0,0);
            $result=$this->Quiz_model->get_quiz_comments($id,0,0);
            $config['base_url'] = base_url().'quiz/view/'.$id;

            $config['total_rows']=  count($result);
            $config['per_page'] = '5';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);

            $quiz_info= $this->Quiz_model->get_photo_quiz_detail($id);
            $data['user_type']=$quiz_info->user_type;
            if(!$quiz_info)
            {
                $this->session->set_userdata('unview','Quiz Not Available');
                redirect("quiz/search/");
            }
            $data['quiz_info']= $quiz_info;
            $data['title']=$quiz_info->quiz_question." - WannaQuiz";
            $quiz_image = $this->Quiz_model->get_quiz_image_by_qid($data['quiz_id']);
            $data['quiz_image'] = $quiz_image->images;
            if($quiz_info->user_type=='regular') {
                $this->load->model('Advertise_management_model');
                $data['adsense_ads'] = $this->Advertise_management_model->getRandomAdsenseAdv();
                $data['banners_ads'] = $this->Advertise_management_model->getRandomBannerAdv();
                $data['affiliate_ads'] = $this->Advertise_management_model->getRandomAffiliateAdv();
            }

            $parent_cat = $this->Category_model->get_parent_id($quiz_info->category_id);
                if($parent_cat->parent_id==0)
                   $parent_id = $quiz_info->category_id;
                else $parent_id = $parent_cat->parent_id;
                    
            $data['admin_rec_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid($parent_id,'rectangular');
            $data['admin_vertical_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid_quiz($parent_id,'vertical');
          
         
            // print_r($data['admin_vertical_ads']);
            //        if(count($data['admin_ads'])<1)
            //        $data['admin_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid($parent_id);

            $data['category'] = $this->Category_model->get_categories();
          // print_r($data['category']);
         
            $data['quiz_comments']=$this->Quiz_model->get_quiz_comments($id,$config['per_page'],$offset);
            $data['categories']=$this->Category_model->get_categories();
            $playlist = $this->Quiz_model->get_playlist($this->session->userdata('wannaquiz_user_id'));
            if($playlist)
                $data['playlist'] = $playlist;
            else $data['playlist'] = NULL;
            //echo $this->session->userdata('set_playlist_quiz_user');
            if($this->session->userdata('set_playlist_quiz_user')!='')
                $user_id1 = $this->session->userdata('set_playlist_quiz_user');
            else $user_id1 = $user_id;
            //echo $user_id1;
            $data['user_playlist'] = $this->Quiz_model->get_playlist($user_id1);
            //print_r($data['user_playlist']);
            if(count($data['user_playlist'])<1)
                $this->session->unset_userdata('set_playlist_quiz_user');


    //            $qout = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/Welcome_2_Vista_1.flv";
    //        $ffmpegcmd1 = "/usr/bin/flvtool2 -UPs $qout";
    //        $output = array();
    //        exec($ffmpegcmd1,$output);
    //        print_r($output);//exit;
            $this->load->view('quiz_detail',$data);
        }
    }
     function views($id='',$off='') {
        if($id=='') redirect("quiz/search/");
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['user'] = $this->Quiz_model->get_user_by_quizid($id);
  
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');

//        if($data['user']->user_id!=$uid && $this->Quiz_model->check_user_quiz_played($id,$uid))
//        {
//            $this->session->set_userdata('unview','You have already played the Quiz');
//            redirect("quiz/search/");
//        }        
        
        if($data['user']->user_type !=0){
        $check_quiz_budget = $this->Quiz_model->get_user_quiz_budget($data['user']->user_id);
        $budget_status = $check_quiz_budget->budget_status;
        }
        else $budget_status = '1';
        if($budget_status!='1'){
            $data['main'] = 'quiz_error';
            $this->load->view('index',$data);
        }
        else{
            $check_quiz_played = $this->Quiz_model->check_quiz_played($id);
            //echo $check_quiz_played; exit;
            if($off=='') {
            //$this->session->unset_userdata('game_mode');
            //$this->session->unset_userdata('previous_player');
            }
            if($check_quiz_played!='0' ) {
            //$this->session->unset_userdata('game_mode');
                $this->session->set_userdata('set_score','no');
            }
            else
                $this->session->set_userdata('set_score','yes');

            $this->load->helper('cookie');
            $this->load->model('Category_model');
            $this->load->model('Advertise_management_model');
            
            $this->Quiz_model->set_user_position($this->session->userdata('wannaquiz_user_id'));
            $this->Quiz_model->set_levels($this->session->userdata('wannaquiz_user_id'));

            $this->Quiz_model->set_quiz_views($id);
            $user_id = $data['user']->user_id;
            //$this->Quiz_model->set_ads_view($user_id,'long_text');
            $this->Quiz_model->set_quiz_impression($id);
            //$ads_rotation = $user->ads_rotation;
            $data['text_ads_info'] = $this->Quiz_model->get_text_ads($user_id,$id);
            $data['banner_ads_info'] = $this->Quiz_model->get_banner_ads($user_id,$id);
            $data['quiz_id']=$id;
            $data['quiz_comments']=$this->Quiz_model->get_quiz_comments($qid,0,0);
            $result=$this->Quiz_model->get_quiz_comments($id,0,0);
            $config['base_url'] = base_url().'quiz/view/'.$id;

            $config['total_rows']=  count($result);
            $config['per_page'] = '5';
            $config['uri_segment'] = '4';
            $offset=$this->uri->segment(4,0);
            $this->pagination->initialize($config);

            $quiz_info= $this->Quiz_model->get_photo_quiz_detail($id);
            $data['user_type']=$quiz_info->user_type;
            if(!$quiz_info)
            {
                $this->session->set_userdata('unview','Quiz Not Available');
                redirect("quiz/search/");
            }
            $data['quiz_info']= $quiz_info;
            $data['title']=$quiz_info->quiz_question." - WannaQuiz";
            $quiz_image = $this->Quiz_model->get_quiz_image_by_qid($data['quiz_id']);
            $data['quiz_image'] = $quiz_image->images;
            if($quiz_info->user_type=='regular') {
                $this->load->model('Advertise_management_model');
                $data['adsense_ads'] = $this->Advertise_management_model->getRandomAdsenseAdv();
                $data['banners_ads'] = $this->Advertise_management_model->getRandomBannerAdv();
                $data['affiliate_ads'] = $this->Advertise_management_model->getRandomAffiliateAdv();
            }

            $parent_cat = $this->Category_model->get_parent_id($quiz_info->category_id);
               if($parent_cat->parent_id==0)
                   $parent_id = $quiz_info->category_id;
                else $parent_id = $parent_cat->parent_id;
            $data['admin_rec_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid($parent_id,'rectangular');
           
            $data['admin_vertical_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid_quiz($parent_id,'vertical');
           
            $data['category'] = $this->Category_model->get_categories();
           
         
            $data['quiz_comments']=$this->Quiz_model->get_quiz_comments($id,$config['per_page'],$offset);
            $data['categories']=$this->Category_model->get_categories();
            $playlist = $this->Quiz_model->get_playlist($this->session->userdata('wannaquiz_user_id'));
            if($playlist)
                $data['playlist'] = $playlist;
            else $data['playlist'] = NULL;
            //echo $this->session->userdata('set_playlist_quiz_user');
            if($this->session->userdata('set_playlist_quiz_user')!='')
                $user_id1 = $this->session->userdata('set_playlist_quiz_user');
            else $user_id1 = $user_id;
            //echo $user_id1;
            $data['user_playlist'] = $this->Quiz_model->get_playlist($user_id1);
            //print_r($data['user_playlist']);
            if(count($data['user_playlist'])<1)
                $this->session->unset_userdata('set_playlist_quiz_user');


    //            $qout = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/uploaded_video_questions/Welcome_2_Vista_1.flv";
    //        $ffmpegcmd1 = "/usr/bin/flvtool2 -UPs $qout";
    //        $output = array();
    //        exec($ffmpegcmd1,$output);
    //        print_r($output);//exit;
            $this->load->view('quiz_detail',$data);
        }
    }
    

    function get_current_gmdate($format,$gm_hour,$gm_min,$gm_sec) {
        $year=gmdate("Y");
        $month=gmdate("m");
        $day=gmdate("d");
        $hour=gmdate("H") +$gm_hour;
        $min=gmdate("i") + $gm_min;
        return mktime($hour,$min,$gm_sec,$month,$day,$year);
    }

    function addVideoQuizStep2($action) {
        if($action == 1)
            $data['edit']='1';
        else $data['edit']= '0';
        $data['category'] = $this->Category_model->get_categories();
        $data['quiz_id'] = $this->input->post('quiz_id');
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($data['quiz_id']);
        $data['product'] = $this->Quiz_model->get_products();
        if($this->input->post('country_target'))
                {
                    foreach($this->input->post('country_target') as $rows){
                    $country_target.=$rows.",";
                    }
                }
                else $country_target ='';
                if($this->input->post('state'))
                {
                    foreach($this->input->post('state') as $rows){
                    $state_target.=$rows.",";
                    }
                }
                else $state_target ='';
                  if($this->input->post('city'))
                {
                    foreach($this->input->post('city') as $rows){
                    $city_target.=$rows.",";
                    }
                }
                else $city_target ='';
         
         $this->session->set_userdata(array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            //'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_level'=>$this->input->post('quiz_level'),
            'quiz_question_type'=>$this->input->post('quiz_question_type'),
            'option1'=>$this->input->post('option1'),
            'option2'=>$this->input->post('option2'),
            'option3'=>$this->input->post('option3'),
            'right_answer'=>$this->input->post('right_answer'),
            'single_open_answer'=>$this->input->post('single_question'),
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),
            'quiz_id' => $this->input->post('quiz_id'),
            'quiz_videos'=>$this->input->post('quiz_videos'),
            'video_answer'=>$this->input->post('video_answer'),
            'quiz_url_type'=>'addVideoQuestion',
            'quiz_url_type_last'=>'addVideoQuizStep3',
            'country_target'=>$country_target,
            'state_target'=>$state_target,
            'city_target'=>$city_target
         ));
         
        $data['category'] = $this->Category_model->get_categories();
        $data['title']="Add Quiz Step2  : wannaquiz";
        $user = $this->Member_model->get_member($this->session->userdata('wannaquiz_user_id'));
        $data['user_type'] = $user->user_type;
        $data['user_credits'] = $user->user_credits;

        $data['main']="quiz/add_video_quiz_step2";
        $this->load->view('quiz_home',$data);
    }

    function addVideoQuizStep3($action) {
        if($action == 1)
            $data['edit']='1';
        else
            $data['edit']= '0';
        $quiz_id = $this->input->post('quiz_id');
        $data['banner_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_banner_ads',$quiz_id);
        $data['long_text_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_long_text_ads',$quiz_id);
        $data['short_text_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_short_text_ads',$quiz_id);
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        //echo $this->input->post('category');exit;
        $this->session->set_userdata(
            array(
            'category_id' =>$this->input->post('category'),
            'check_for_future_question'=>$this->input->post('check_for_future_question'),
            'advertiser_budget'=>$this->input->post('advertiser_budget'),
            'advertiser_custom_budget'=>$this->input->post('advertiser_custom_budget'),
            'budget_per_selection'=>$this->input->post('budget_per_selection'),
            'budget_for'=>$this->input->post('budget_for')
        ));
    //echo $this->session->userdata('category_id');exit;
        $data['title']="Add Quiz Step2  : wannaquiz";
        $data['main']="quiz/add_video_quiz_step3";
        $this->load->view('quiz_home',$data);
    }

    function addPhotoQuizStep2($action) {
    //upload cropped image and sace into temp folder
        /*$x1 = $this->input->post('x1');
        $y1 = $this->input->post('y1');
        $x2 = $this->input->post('x2');
        $y2 = $this->input->post('y2');
        $w = $this->input->post('w');
        $h = $this->input->post('h');

        $new_image_file_name=time().'_'.$this->input->post('large_image_name');
        $large_image_location='./user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$this->input->post('large_image_name');
        $thumb_image_location='./photo_question_thumbs/'.$new_image_file_name;
        $thumb_width=100;

        //Scale the image to the thumb_width set above
        $scale = $thumb_width/$w;
        $cropped =$this->Quiz_model->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

        // large image crop of the same proportion
        $large_image_location='./user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$this->input->post('large_image_name');
        $thumb_image_location='./photo_question_images/'.$new_image_file_name;
        $thumb_width=200;

        //Scale the image to the thumb_width set above
        $scale = $thumb_width/$w;
        $cropped =$this->Quiz_model->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
*/
        //echo "hello".$this->input->post('image_id'); exit;
        $data['category'] = $this->Category_model->get_categories();
        if($action == 1) {
            $data['edit']='1';
            $data['quiz_id'] = $this->input->post('quiz_id');
        }
        else {
            $data['edit']= '0';
            $last_quiz_id = $this->Quiz_model->get_last_quiz();
            $data['quiz_id'] = $last_quiz_id+1;
        }

        $user = $this->Member_model->get_member($this->session->userdata('wannaquiz_user_id'));
        $data['user_credits'] = $user->user_credits;
        $data['product'] = $this->Quiz_model->get_products();
        $data['user_type'] = $user->user_type;
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($data['quiz_id']);
        //save step1 data in session and make thumbnail for the question..

       //  else
        // echo($this->input->post('country_target'));
         if($this->input->post('country_target'))
                {
                    foreach($this->input->post('country_target') as $rows){
                    $country_target.=$rows.",";
                    }
                }
                else $country_target ='';
              
                if($this->input->post('state'))
                {
                    foreach($this->input->post('state') as $rows){
                    $state_target.=$rows.",";
                    }
                }
                else $state_target ='';
                  if($this->input->post('city'))
                {
                    foreach($this->input->post('city') as $rows){
                    $city_target.=$rows.",";
                    }
                }
                else $city_target ='';
                
           $this->session->set_userdata(
            array(
            'quiz_level' =>$this->input->post('quiz_level'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_type'=>$this->input->post('quiz_question_type'),
            'option1'=>$this->input->post('option1'),
            'option2'=>$this->input->post('option2'),
            'option3'=>$this->input->post('option3'),
            'right_answer'=>$this->input->post('right_answer'),
            'single_open_answer'=>$this->input->post('single_question'),
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),
            'quiz_long_answer'=>$this->input->post('quiz_long_answer'),
            'image_name'=> $this->input->post('ques_image'),//$new_image_file_name,
            'image_id'=>$this->input->post('image_id'),
            'quiz_id' => $this->input->post('quiz_id'),
            'quiz_url_type'=>'addPhotoQuestion',
            'quiz_url_type_last'=>'addPhotoQuizStep3',
            'country_target'=>$country_target,
            'state_target'=>$state_target,
            'city_target'=>$city_target
        ));
        if(!$this->session->userdata('quiz_level'))
        {        
            $this->session->set_userdata(
                array(
                'quiz_level' =>$this->input->post('quiz_level'),
                'quiz_question'=>$this->input->post('quiz_question'),
                'quiz_type'=>$this->input->post('quiz_question_type'),
                'option1'=>$this->input->post('option1'),
                'option2'=>$this->input->post('option2'),
                'option3'=>$this->input->post('option3'),
                'right_answer'=>$this->input->post('right_answer'),
                'single_open_answer'=>$this->input->post('single_question'),
                'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
                'quiz_comment'=>$this->input->post('quiz_comment'),
                'quiz_long_answer'=>$this->input->post('quiz_long_answer'),
                'image_name'=> $this->input->post('ques_image'),//$new_image_file_name,
                'image_id'=>$this->input->post('image_id'),
                'quiz_id' => $this->input->post('quiz_id'),
                'quiz_url_type'=>'addPhotoQuestion',
                'quiz_url_type_last'=>'addPhotoQuizStep3',
                 'country_target'=>$country_target,
                'state_target'=>$state_target,
                'city_target'=>$city_target   
            ));
        }

       
            $data['title']="Add Quiz Step2  : WannaQuiz";
        $data['main']="quiz/add_photo_quiz_step2";
        $this->load->view('quiz_home',$data);
    }

    function addPhotoQuizStep3($action) {
        if($action == 1)
            $data['edit']='1';
        else $data['edit']= '0';
        $quiz_id = $this->input->post('quiz_id');
        $data['banner_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_banner_ads',$quiz_id);
        $data['long_text_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_long_text_ads',$quiz_id);
        $data['short_text_info'] = $this->Quiz_model->get_advertisement_info('tbl_advertiser_short_text_ads',$quiz_id);
        $data['quiz_info'] = $this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        
        $custom_budget = $this->input->post('custom_quiz_budget');
        if($custom_budget!='')
        $advertiser_budget = $custom_budget;
        else
        $advertiser_budget = $this->input->post('advertiser_budget');

        $custom_per_selection = $this->input->post('custom_per_selection');
        if($custom_per_selection!='')
        $budget_per_selection = $custom_per_selection;
        else
        $budget_per_selection = $this->input->post('budget_per_selection');

        //echo $this->session->userdata('quiz_long_answer'); exit;
        //echo $this->input->post('category');exit;
    
        $this->session->set_userdata(
            array(
            'category_id' =>$this->input->post('category'),
            'check_for_future_question'=>$this->input->post('check_for_future_question'),
            'advertiser_budget'=>$advertiser_budget,
            'advertiser_custom_budget'=>$this->input->post('advertiser_custom_budget'),
            'budget_per_selection'=>$budget_per_selection,
            'budget_for'=>$this->input->post('budget_for')
        ));

        $data['title']="Add Quiz Step2  : wannaquiz";
          
        $data['main']="quiz/add_photo_quiz_step3";
        $this->load->view('quiz_home',$data);
    }

    function insert_quiz($action){        
        $this->checkMemberLogin();
        $quantity=$this->input->post('quantity');
        $ad_space = $this->input->post('ad_space');
        $quiz_type=$this->input->post('quiz_type');
        if($action == 1)
            $data['edit']='1';
        else $data['edit']= '0';
       // echo $this->input->post('category'); exit;
        $this->session->set_userdata( array('category_id' =>$this->input->post('category')));
       if($ad_space=='') {
            if($quiz_type=='photo'){
             $quiz_id = $this->Quiz_model->insertPhotoQuizAdvertiser();
            }
            else {
                $quiz_id = $this->Quiz_model->insertVideoQuizAdvertiser();
                $data['quiz_type']="video"; 
                 }
               
          $user_id = $this->session->userdata('wannaquiz_user_id');
         $member_cpc = $this->Quiz_model->check_member_cpc($this->session->userdata('wannaquiz_user_id'));
       
        //print_r($member_cpc); exit;
        if($member_cpc->cpc=='')
        $this->db->insert('tbl_member_cpc',array('user_id'=>$user_id,'cpc'=>$cat_info->cpc));
        }
        $data['title']="Add Quiz Step3  : WannaQuiz";
        $data['main']="quiz/add_photo_quiz_step3";
       $this->load->view('quiz_home',$data);

    }

    function payment() {

        $this->checkMemberLogin();
        //$this->checkMemberProfile();
        $quantity=$this->input->post('quantity');
        $ad_space = $this->input->post('ad_space');
        $quiz_type=$this->input->post('quiz_type');
        //$this->session->set_userdata('quiz_type',$quiz_type);
        $custom_budget = $this->input->post('custom_quiz_budget');
        $quiz_id = $this->input->post('quiz_id');

        if($custom_budget!='')
        $advertiser_budget = $custom_budget;
        else
        $advertiser_budget = $this->input->post('advertiser_budget');

        $custom_per_selection = $this->input->post('custom_per_selection');
        if($custom_per_selection!='')
        $budget_per_selection = $custom_per_selection;
        else
        $budget_per_selection = $this->input->post('budget_per_selection');

        $this->session->set_userdata(
            array(
            'category_id' =>$this->input->post('category'),
            'check_for_future_question'=>$this->input->post('check_for_future_question'),
            'advertiser_budget'=>$advertiser_budget,
            'advertiser_custom_budget'=>$this->input->post('advertiser_custom_budget'),
            'budget_per_selection'=>$budget_per_selection,
            'budget_for'=>$this->input->post('budget_for')
        ));

        $coupon_amount = 0;
        $coupon_code = $this->input->post('coupon');
        //check for a coupon code
        if($coupon_code!=''){
             $check_coupon = $this->Quiz_model->check_user_coupon($coupon_code,$this->session->userdata('wannaquiz_user_id'));
             //check whether there is already coupon code used by the same user. Proceed only if not used coupon code twice by same user
             if(!$check_coupon){
                $coupon_info = $this->Quiz_model->get_coupon_amount($coupon_code);
                $coupon_amount = $coupon_info->amount;
                $this->session->set_userdata('coupon_code_id',$coupon_info->id);
             }
             else {
                 $coupon_amount = 0;
             }
         }
         
        $this->load->model('Payment_setting_model');
        //        if($quantity=='') {
        //            $this->session->set_flashdata('message', 'Please filled your quantity');
        //            redirect('gameboard/checkout');
        //        }

        //check whether it is just quiz edit or quiz credit edit. if there is ad_space it is quiz credit edit.
        if($ad_space=='') {
            if($quiz_type=='photo')
                $quiz_id = $this->Quiz_model->insertPhotoQuizAdvertiser();
            else $quiz_id = $this->Quiz_model->insertVideoQuizAdvertiser();
            
        }

        
        /*
         * sending information to redirect to payment gateway form
         */
        $data['paypal_info']=$this->Payment_setting_model->get_payment_info('1');
        $data['item_type']="package";

        $data['item_id']=$quiz_id;        
       
        $advertiser_amount = $advertiser_budget;
        
        $user_credits = $this->input->post('user_credits');
        //echo $user_credits.'/'.$advertiser_budget; exit;

        if($this->input->post('user_credits') > '0' && $this->input->post('user_credits') > $advertiser_budget){
            $this->db->where('user_id',$this->session->userdata('wannaquiz_user_id'));
            $this->db->update('tbl_members',array('user_credits'=>($this->input->post('user_credits')-$advertiser_budget)));

            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',array('status'=>'1'));

            if ($ad_space!=''){
            $this->Quiz_model->editQuizBudget($this->input->post('quiz_id'));
            
        }
            
            $data['main']= "quiz/add_photo_quiz_success_msg";
        }
        else if($this->input->post('user_credits') > '0' && $this->input->post('user_credits') < $custom_budget){
            $this->db->where('user_id',$this->session->userdata('wannaquiz_user_id'));
            $this->db->update('tbl_members',array('user_credits'=>'0'));

            $data['main']="redirect_to_payment_gateway";
        }
        else if($advertiser_amount > $coupon_amount){
            $data['main']="redirect_to_payment_gateway";
            $data['amount']=($advertiser_amount - $coupon_amount);
        }
        else if($advertiser_amount < $coupon_amount){
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',array('status'=>'1'));
            $data['main']= "quiz/add_photo_quiz_success_msg";

            $this->db->where('user_id',$this->session->userdata('wannaquiz_user_id'));
            $this->db->update('tbl_members',array('user_credits'=>$this->input->post('user_credits')+($coupon_amount - $advertiser_budget)));

            if ($ad_space!=''){
            $this->Quiz_model->editQuizBudget($this->input->post('quiz_id'));
            $quiz_id = $this->input->post('quiz_id');
            }
        }
        if($coupon_code!='')
        $this->Quiz_model->update_coupon_code($coupon_code);
        $data['payment_gateway']=$this->input->post('payment_method');
        $data['paypal_type'] = 'quiz_views';
        $data['title']='Payment Gateway : WannaQuiz';
        $this->load->view('ex',$data);
    }

    function quiz_budget(){
        
        $this->checkMemberLogin();
        //$this->checkMemberProfile();
        $this->load->model('Payment_setting_model');
        $quantity=$this->input->post('quantity');
        $ad_space = $this->input->post('ad_space');
        $quiz_type=$this->input->post('quiz_type');
        $quiz_id = $this->input->post('quiz_id');
        $remaining_budget = $this->input->post('remaining_budget');

        $custom_budget = $this->input->post('custom_quiz_budget');
        $custom_per_selection = $this->input->post('custom_per_selection');
        $pre_budget = $this->input->post('pre_budget');
        $payment = $this->input->post('radio');        

        if($custom_budget!='') $advertiser_budget = $custom_budget;
        else if($this->input->post('advertiser_budget')=='rem_credits' || $this->input->post('advertiser_budget')==0) $advertiser_budget = 0;
        else $advertiser_budget = $this->input->post('advertiser_budget');

        if($custom_per_selection!='') $budget_per_selection = $custom_per_selection;
        else $budget_per_selection = $this->input->post('budget_per_selection');

        $this->session->set_userdata(
            array(
            'category_id' =>$this->input->post('category'),
            'check_for_future_question'=>$this->input->post('check_for_future_question'),
            'advertiser_budget'=>$advertiser_budget,
            'advertiser_custom_budget'=>$this->input->post('advertiser_custom_budget'),
            'budget_per_selection'=>$budget_per_selection,
            'budget_for'=>$this->input->post('budget_for')
        ));

        $coupon_amount = 0;
        $coupon_code = trim($this->input->post('coupon'));

        //check for a coupon code        
        if($coupon_code!='')
        {
            $coupon_info = $this->Quiz_model->get_coupon_amount($coupon_code);
#echo '<pre>' . print_r($coupon_info) . '</pre>';
#exit;            
            if(!$coupon_info) # return if no such code exists
            {
                $coupon_amount = 0;
                $this->session->set_userdata("coupon_code_error","Invalid Coupon Code !");
                
                if($ad_space=='') redirect("quiz/addPhotoQuizStep2/0");
                else redirect("member/buyadspace");
             }

             $check_coupon = $this->Quiz_model->check_user_coupon($coupon_info->id,$this->session->userdata('wannaquiz_user_id'));             
#echo '<pre>' . print_r($coupon_info) . '</pre>';exit;

             //check whether there is already coupon code used by the same user. Proceed only if not used coupon code twice by same user
             if(!$check_coupon){ 
                $coupon_info = $this->Quiz_model->get_coupon_amount($coupon_code);                
                $coupon_amount = $coupon_info->amount;
                
                $this->session->set_userdata('coupon_code_id',$coupon_info->id);
                
                $this->Quiz_model->insert_coupon_history($this->session->userdata('wannaquiz_user_id'),$coupon_info->id);
                
                $this->Quiz_model->insert_quiz_budget($budget_per_selection,$this->session->userdata('wannaquiz_user_id'),$coupon_amount);
                if($ad_space=='')
                $data['main'] = "quiz/add_photo_quiz_step3";
                else
                $data['main'] = "member/buyadspace";
             }
             else 
             {
                 $coupon_amount = 0;
                  $this->session->set_userdata("coupon_code_error","Coupon Used Already !");
                 
                 if($ad_space=='') redirect("quiz/addPhotoQuizStep2/0");
                 else redirect("member/buyadspace");}
         }
         else if( ($this->input->post('advertiser_budget')=='rem_credits' || $payment=='user_credits') && $payment!='paypal')
         {
             $this->Quiz_model->insert_quiz_budget($budget_per_selection,$this->session->userdata('wannaquiz_user_id'));             

             if($ad_space=='')
                $data['main'] = "quiz/add_photo_quiz_step3";
                else
                $data['main'] = "member/buyadspace";
         }
        else{
            $data['paypal_info']=$this->Payment_setting_model->get_payment_info('1');
            $data['item_type']="package";
            $data['amount'] = $advertiser_budget;

            $datas = array('user_id'=>$this->session->userdata('wannaquiz_user_id'),
                            'budget_per_selection'=>$budget_per_selection,
                            'per_selection'=>$this->input->post('budget_for'),
                            'remaining_budget'=>$budget_per_selection,
                            'budget_status'=>0
            );

            $this->db->insert('tbl_quiz_budgets',$datas);

            $data['main']="redirect_to_payment_gateway";
            
        }
        //check whether it is just quiz edit or quiz credit edit. if there is ad_space it is quiz credit edit.
        if($ad_space=='') {
            if($quiz_type=='photo')
                $quiz_id = $this->Quiz_model->insertPhotoQuizAdvertiser();
            else $quiz_id = $this->Quiz_model->insertVideoQuizAdvertiser();

        }

//        if($this->input->post('category')!=''){
//        $cat_info = $this->Category_model->get_parent_id($this->input->post('category'));
//        $user_id = $this->session->userdata('wannaquiz_user_id');
//        $member_cpc = $this->Quiz_model->check_member_cpc($this->session->userdata('wannaquiz_user_id'));
//        //print_r($member_cpc); exit;
//        if($member_cpc->cpc=='')
//        $this->db->insert('tbl_member_cpc',array('user_id'=>$user_id,'cpc'=>$cat_info->cpc));
//        }

        if($coupon_code!='') $this->Quiz_model->update_coupon_code($coupon_code);
        $data['payment_gateway']=$this->input->post('payment_method');
        $data['paypal_type'] = 'quiz_views';
        $data['title']='Payment Gateway : WannaQuiz';
        $this->load->view('index',$data);
    }

    function get_user_quiz_budget($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_quiz_budgets');
        if($query->num_rows()>0)
        return $query->row();
        else return false;
    }

    function addPhotoQuizAdvertiser() {
    // insert PhotoQuiz
        $this->Quiz_model->insertPhotoQuizAdvertiserBanners();
        $this->session->set_flashdata('quiz_add_message',' Photo quiz successfully added. But it may take some hours to display in site. For more upload <a href="'.base_url().'member/addPhotoQuestion">"Click Here"</a>');
        redirect(site_url('member/viewQuestions/photo'));
    }

    function addVideoQuizAdvertiser() {
    // insert VideoQuiz
        $this->Quiz_model->insertVideoQuizAdvertiserBanners();
        $this->session->set_flashdata('quiz_add_message',' Video quiz successfully added. But it may take some hours to display in site. For more upload <a href="'.base_url().'member/addPhotoQuestion">"Click Here"</a>');
       
        redirect(site_url('member/viewQuestions/$video'));
    }

    function addPhotoQuizRegular() {
        $this->load->model('Award_model');
        // insert PhotoQuiz
        $this->Quiz_model->insertPhotoQuizRegular();
        $this->Award_model->insertQuizCreationAward();        
        $this->session->set_flashdata('quiz_add_message',' Photo quiz successfully added! But it may take some hours to display in site.');
        redirect(site_url('member/viewQuestions/photo'));        
    }

    function editPhotoQuizRegular() {
        $this->Quiz_model->editPhotoQuizRegular();
        $this->session->set_flashdata('message',' Photo quiz successfully edited');
        redirect(site_url('member/viewQuestions/photo'));
    }

    function editPhotoQuizAdvertiser() {
        
        $this->Quiz_model->editPhotoQuizAdvertiser();
        $this->session->set_flashdata('message',' Photo quiz successfully edited');
        redirect(site_url('member/viewQuestions/photo'));
    }

    function addVideoQuizRegular() {
    // insert VideoQuiz
        $this->load->model('Award_model');
        $this->Quiz_model->insertVideoQuizRegular();
        $this->Award_model->insertQuizCreationAward();
        $this->session->set_flashdata('quiz_add_message',' Video quiz successfully added. But it may take some hours to display in site. ');
        redirect(site_url('member/viewQuestions/video'));
    }

    function editVideoQuizRegular() {
        $this->Quiz_model->editVideoQuizRegular();
        $this->session->set_flashdata('message',' Video quiz successfully edited');
        redirect(site_url('member/viewQuestions/video'));
    }

    function editVideoQuizAdvertiser() { //print_r($this->session->userdata);echo $this->session->userdata('category_id');exit;
        $this->Quiz_model->editVideoQuizAdvertiser();
        $this->session->set_flashdata('message',' Video quiz successfully edited');
        redirect(site_url('member/viewQuestions/video'));
    }

    function rating($quiz_id) { //echo $quiz_id;exit;
        $this->load->model('Award_model');
        $this->db->where('user_id',$this->session->userdata('wannaquiz_user_id'));
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->get('tbl_quiz_ratings',$option);
        $rating=$this->input->post('rating');
        $user = $this->Quiz_model->get_user_by_quizid($quiz_id);

        //echo $query->num_rows();exit;
        if($query->num_rows()>0)
        echo "Sorry! You can not rate the same quiz twice!";
        elseif($user->user_id==$this->session->userdata('wannaquiz_user_id'))
        echo "Sorry! You can not rate your own quiz!";
        elseif($this->session->userdata('wannaquiz_user_id')=="" )
        echo "Please login first!";
        else {
                $data=array('quiz_id'=>$quiz_id,
                    'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                    'rating'=>$rating,
                    'rating_date'=>current_date_time_stamp()
                );
                $this->db->insert('tbl_quiz_ratings',$data);

                $this->db->where('quiz_id',$quiz_id);
                $this->db->where('rating','5.0');
                $total_max_rating_query = $this->db->get('tbl_quiz_ratings');

                //$average = $this->Quiz_model->average_quiz_rating($quiz_id);
                $total_avg_rating = $this->Quiz_model->total_quiz_rating($quiz_id);
                //if($total_max_rating_query->num_rows()>=20) {
                //                if($average >= '4.9'){
                //                    $this->Award_model->insertQuizAutherRatingAward($user->user_id);
                //                }
                if($total_avg_rating>='4.9') {
                    $this->Award_model->insertQuizAutherRatingAward($user->user_id);
                    $this->Quiz_model->update_quiz_rating_award_flag($quiz_id);
                }
                echo $total_avg_rating;
                echo 'success';
            }


        }


    function addClick() {
      
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        $profile = $this->input->post('profile');        
        $this->Quiz_model->set_ads_click($id,$type);
    //$this->Quiz_model->set_quiz_click($id);
    }

    function setProfileViewClick() {
        $profile_id = $this->input->post('profile_id');
        $action = $this->input->post('action');
        $this->Quiz_model->set_profile_view_click($action,$profile_id);
    }

    function getCategoryCPC() {
        $cid = $this->input->post('cid');
        $category_cpc = $this->Quiz_model->get_category_cpc($cid);
        echo $message = '<div class="border_lightblue">
                                            <div class="content_10box">
                                                <div class="input_clear">
                                                    <div class="quizmakingform_left">
                                                        Category for your question:
            <span class="font11 italic"><!--(check the box if you agree)--></span>
                                                    </div>

                                                    <div class="quizmakingvideoform_right">
                                                        <div class="padding_5bottom">
                                                            <div class="quizmakingform_radio">
                                                            <!--<input type="checkbox" name="category_id" value="1" />--> <label style="width:200px;">'.$category_cpc->name.'</label>
                                                            <label>CPC <span class="color_green bold">$'.$category_cpc->cpc.'</span></label>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>

                                                    <div class="clear"></div>
                                                </div>

                                            </div>
                                        </div>';
    }


    function getPhotoQuizForFlash() {

        $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo,tbl_quiz_images qm where q.quiz_id=qo.quiz_id and q.quiz_id=qm.quiz_id AND q.quiz_id=".$_POST['quiz_id'];

        $query=$this->db->query($sql);
        $data=$query->row();
        $answer=$this->getRightAnswer($data->quiz_id,$data->right_option);
        if ($query->num_rows()==0) {
            $r_string = '&errorcode=3&msg='.mysql_error().'&';
        }
        else {
            $r_string = '&errorcode=0&msg='.$sql.'&n='.$query->num_rows();
            $i = 0;
            foreach ($query->row_array() as $key => $row) {
                $r_string .= '&' . $key . $i . '=' . stripslashes($row);
            //$i++;
            }
            // add extra & to prevent returning extra chars at the end
            $r_string .='&answer='.$answer.'&';
        }
        echo $r_string;
    //return $r_string;
    }

    function getVideoQuizForFlash() {
        $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo,tbl_quiz_videos qv where q.quiz_id=qo.quiz_id and q.quiz_id=qv.quiz_id AND q.quiz_id=".$_POST['quiz_id'];

        $query=$this->db->query($sql);
        $data=$query->row();
        $answer=$this->getRightAnswer($data->quiz_id,$data->right_option);

        if ($query->num_rows()==0) {
            $r_string = '&errorcode=3&msg='.mysql_error().'&';
        }
        else {
            $r_string = '&errorcode=0&n='.$query->num_rows();
            $i = 0;
            foreach ($query->row_array() as $key => $row) {
                $r_string .= '&' . $key . $i . '=' . stripslashes($row);
            }



            $r_string .='&answer='.$answer.'&';
        }

        echo $r_string;
    }

    function storeScore() {
        $implode_email = $_COOKIE['email'];
        $explode_email = explode(",",$implode_email);
        if(isset($_COOKIE['email'])) {
            $user = $this->Member_model->get_member($this->session->userdata('wannaquiz_user_id'));
            $user_email = $user->email;
            for($i=0;$i<=count($explode_email);$i++) {
                if($user_email!=$explode_email[$i]) { //echo "enter";
                    $data=array(
                        'quiz_id'=>$_POST['quiz_id'],
                        'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                        'answer_status'=>$_POST['score'],
                        'answer_date'=>current_date_time_stamp(),
                        'points'=>$_POST['point']
                    );

                    $this->db->insert('tbl_quiz_answers',$data);
                }
            }
        }
        else { //echo "exit";
            $data=array(
                'quiz_id'=>$_POST['quiz_id'],
                'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                'answer_status'=>$_POST['score'],
                'answer_date'=>current_date_time_stamp(),
                'points'=>$_POST['point']
            );

            $this->db->insert('tbl_quiz_answers',$data);
        }
    }

    function getRightAnswer($quiz_id,$option_id) {
        $sql="SELECT * from tbl_quiz_options where quiz_id='".$quiz_id."'";
        $query=$this->db->query($sql);
        $data=$query->row();
        if($option_id=="option1")
            return $data->option1;
        elseif($option_id=="option2")
            return $data->option2;
        else
            return $data->option3;
    }

    function quizCommit() {
              
        $data = $this->Quiz_model->quiz_commit();
        if($data) {
            $message="success*" ;

            $qid = $this->input->post('quiz_id');

            $result=$this->Quiz_model->get_quiz_comments($qid,0,0);
            $config['base_url'] = site_url('/quiz/view/'.$qid);
            $config['total_rows']= count($result);
            $config['per_page'] = '5';
            $config['uri_segment'] = '3';
            $offset=$this->uri->segment(3,0);
            $this->pagination->initialize($config);
            $quiz_comments=$this->Quiz_model->get_quiz_comments($qid,$config['per_page'],$offset);
            if($quizComments->user_id==$this->session->userdata("wannaquiz_user_id"))
                $delete = ' | <a href="#" onclick="deleteQuizComment('.$quizComments->comment_id.')">Delete</a>';
            foreach($quiz_comments as $quizComments) {
                $like_comment = $this->Quiz_model->get_quiz_comment_like($quizComments->comment_id);
                $unlike_comment = $this->Quiz_model->get_quiz_comment_unlike($quizComments->comment_id);

                $answer = "toggle('reply_".$quizComments->comment_id."')";
                $script = '#reply_'.$quizComments->comment_id;

                $spam = "quizSpam('".$quizComments->comment_id."', 'comment');";
                $message.='<div class="padding_10topbottom">
                            	<div>
                                    <div class="quizcomment_name"><a href="'.base_url().$quizComments->username.'" class="bold">'.$quizComments->username.'</a> ('.date("Y-m-d H:i:s",$quizComments->comment_date).')</div>
                                    <div class="comment_reply"><div class="text_center"><a style="cursor:pointer" onclick="'.$answer.'">Answer</a> | <a href="#" onclick="'.$spam.'">Spam</a>'.$delete.'</div></div>
                                    <div class="comment_arrange">
                                        <div class="text_right">
                                            <span id="like_'.$quizComments->comment_id.'"> '.$like_comment.' Like </span>
                                            <span><a style="cursor:pointer" onclick="like_quiz_comment('.$quizComments->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                            <span><a style="cursor:pointer" onclick="like_quiz_comment('.$quizComments->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                            <span id="unlike_'.$quizComments->comment_id.'">'.$unlike_comment.' Unlike </span>
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="padding_10topbottom">
                                	'.$quizComments->comment.'
                                </div>
                            </div>

                            <div id="reply_comment_'.$quizComments->comment_id.'">';
                $comment_reply = $this->Quiz_model->get_reply_comments($quizComments->comment_id);
                if(count($comment_reply)>0) {
                    foreach($comment_reply as $reply) {
                         #   print_r($reply);
                        #    exit;
                        $like_comment1 = $this->Quiz_model->get_quiz_comment_like($reply->comment_id);
                        $unlike_comment1 = $this->Quiz_model->get_quiz_comment_unlike($reply->comment_id);
                        $quizSpan1 = "quizSpam('".$reply->comment_reply_id."', 'comment');";

                        if($reply->user_id==$this->session->userdata('wannaquiz_user_id')) {
                            $delete1 = ' | <a href="#" onclick="deleteQuizCommentReply('.$reply->comment_reply_id.')">Delete</a>';
                        }
                        $message.= '<div class="borderbottom_gray"></div>
                                <div class="borderleft_5gray">
                                	<div class="content_10box">
                                    	<div>
                                            <div class="comment_subname1"> <a href="#" class="bold">'.$reply->first_name.'&nbsp;'.$reply->last_name.$reply->username.'</a> ('.date("Y-m-d H:i:s",$reply->comment_date).')</div>
                                            <div class="comment_reply"><div class="text_center"><a href="#" onclick='.$quizSpan1.'">Spam</a>'.$delete1.'</div></div>
                                            <div class="comment_arrange1">
                                                <div class="text_right">
                                                    <span id="like_'.$reply->comment_id.'"> '.$like_comment1.' Like </span>
                                                    <span><a style="cursor:pointer" onclick="like_quiz_comment('.$reply->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                    <span><a style="cursor:pointer" onclick="like_quiz_comment('.$reply->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                    <span id="unlike_'.$reply->comment_id.'">'.$unlike_comment1.' Unlike </span>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="padding_10topbottom">
                                            '.$reply->comment.'
                                        </div>
                                    </div>
                                </div>

                            </div>';
                }}

                $message.='<div class="content_wrap">
                                <div class="quizcomment_title" style="display:none" id="reply_'.$quizComments->comment_id.'">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this video</div>
                                        <textarea class="textbox" style="width:350px; height:100px;" id="quiz_reply_comment_'.$quizComments->comment_id.'"></textarea>
                                        <input type="hidden" name="friend_id" id="friend_id" value="'.$this->session->userdata("wannaquiz_user_id").'" />
                                    </div>
                                    <div class="input_clear">
                                    	<div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="quiz_reply_commit('.$quizComments->comment_id.','.$this->session->userdata("wannaquiz_user_id").')"/>
                                        <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                        <div>Not more than 500 characters</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                                <div class="clear"></div>
                        </div>';
            }
            echo $message;
        }
        else $message = "error|error";
    }

    function deleteQuizComment($comment_id) {
        $data = $this->Quiz_model->delete_quiz_comment($comment_id);
        if($data)
            $message="success" ;
        else $message = "error";
        echo $message;
    }

    function quizReplyCommit() {
        $data = $this->Quiz_model->quiz_reply_commit();
        if($data) {
            $message="success*" ;

            $qid = $this->input->post('quiz_id');
            $comment_id = $this->input->post('comment_id');
            //$profile_comments=$this->Member_model->get_profile_comments($mem_id);
            // $count_comments=$this->Member_model->count_profile_comments($mem_id);
            $comment_reply = $this->Quiz_model->get_reply_comments($comment_id);
              if($quizComments->user_id==$this->session->userdata("wannaquiz_user_id"))
                $delete = ' | <a href="#">Delete</a>';
            if(count($comment_reply)>0) {
                foreach($comment_reply as $reply) {

                    $like_comment1 = $this->Quiz_model->get_quiz_comment_like($reply->comment_id);
                    $unlike_comment1 = $this->Quiz_model->get_quiz_comment_unlike($reply->comment_id);
                    $quizSpan1 = "quizSpam('".$reply->comment_reply_id."', 'comment');";

                    if($reply->user_id==$this->session->userdata('wannaquiz_user_id')) {
                        $delete1 = ' | <a href="#" onclick="deleteQuizCommentReply('.$reply->comment_reply_id.')">Delete</a>';
                    }
                    $message.= '<div class="borderbottom_gray"></div>
                                <div class="borderleft_5gray">
                                	<div class="content_10box">
                                    	<div>
                                            <div class="comment_subname1"> <a href="#" class="bold">'.$reply->username.'</a> ('.date("Y-m-d H:i:s",$reply->comment_date).')</div>
                                            <div class="comment_reply"><div class="text_center">
                                           
                                            <a href="#" onclick='.$quizSpan1.'">Spam</a>'.$delete1.'</div></div>
                                            <div class="comment_arrange1">
                                                <div class="text_right">
                                                    <span id="like_'.$reply->comment_id.'"> '.$like_comment1.' Like </span>
                                                    <span><a style="cursor:pointer" onclick="like_quiz_comment('.$reply->comment_id.',1)"><img src="'.base_url().'images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                    <span><a style="cursor:pointer" onclick="like_quiz_comment('.$reply->comment_id.',0)"><img src="'.base_url().'images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                    <span id="unlike_'.$reply->comment_id.'">'.$unlike_comment1.' Unlike </span>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="padding_10topbottom">
                                            '.$reply->comment.'
                                        </div>
                                    </div>
                                </div>

                            </div>';
            }}
            echo $message;
        }
        else $message = "error|error";

    }

    function deleteQuizCommentReply($comment_reply_id) {
        $data = $this->Quiz_model->delete_quiz_comment_reply($comment_reply_id);
        if($data)
            $message="success" ;
        else $message = "error";
        echo $message;
    }

    function spamQuizComment($comment_id) {
        $this->load->model('Site_setting_model');
        $this->load->model('Email_model');
        $flag= $this->input->post('flag');
        $data = $this->Quiz_model->spam_quiz_comment($comment_id);
        $comment = $this->Quiz_model->get_spam_quiz_comment($comment_id);
        if($data) {
            $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = $site_info->site_email;
            $template=$this->Email_model->get_email_template("SPAM");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;
//<a href='".ADMIN_PATH('comment_spam')."'>
            $comment_link="<a href='#'>".$comment."</a>";

            $parseElement=array("COMMENT"=>$comment_link,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($email,$subject,$emailbody,$headers);
            $message="success" ;
        }

        else $message = "error";
       echo $message;

    }

    function likeQuizComment() {
        $data = $this->Quiz_model->like_quiz_comment();
        $comment_id = $this->input->post('comment_id');
        $like_comment = $this->Quiz_model->get_quiz_comment_like($comment_id);
        $unlike_comment = $this->Quiz_model->get_quiz_comment_unlike($comment_id);
        if($data) {
            echo $message='success|'.$like_comment.' Like|'.$unlike_comment.' Unlike';
        }
         elseif($data == '0') {
            echo $message='unsuccess|Sorry you can not perform this action twice!';
         }
         else echo $message = 'error';
    }

    function search() { 
        #var_dump($_SESSION);exit;
         $this->load->model('Member_model');
        $user_id = $this->session->userdata('wannaquiz_user_id');
                
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);

            $result = $this->Quiz_model->search_quiz($user_id,$filter);
            $video_result = $this->Quiz_model->search_video_quiz($user_id,$filter);
                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            
            $data['filter'] = $filter;
        }        
        else
        {
            $result = $this->Quiz_model->search_quiz($user_id);
            $video_result = $this->Quiz_model->search_video_quiz($user_id);
        }
 
        $config['base_url'] = site_url('/quiz/search/');
        $config['total_rows'] = count($result);
        //echo $config['total_rows'];
        $config['uri_segment'] = 3;      
        $config['per_page'] = 10;        
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next &raquo;';
        $config['previous_link'] = '&raquo; Previous';
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';        
        $this->pagination->initialize($config);

        if($user_id)
        {
            $result = $this->Quiz_model->search_quiz($user_id,$filter,$config['per_page'],$this->uri->segment(3,0));        
          
            $video_result = $this->Quiz_model->search_video_quiz($user_id,$filter,$config['per_page'],$this->uri->segment(3,0));
        }
        else
        {
            $result = $this->Quiz_model->search_quiz($user_id,'',$config['per_page'],$this->uri->segment(3,0));
            $video_result = $this->Quiz_model->search_video_quiz($user_id,'',$config['per_page'],$this->uri->segment(3,0));
        }
        
        $data['result'] = $result;
        $data['video_result'] = $video_result;
        $data['title']='website under construction';
        $data['main']='quiz/search_body';
        $data['category'] = $this->Category_model->get_categories();
        $data['categories'] = $this->Category_model->get_categories();
        $data['admin_ads'] = $this->Quiz_model->get_admin_search_ads();
        $this->load->view("index",$data);

    }

    function searchByCategory() {
        $quiz_level=$this->input->post('quiz_level');
        $cat_id=$this->input->post('cat_id');
        //$subcat_id=substr($this->input->post('subcat_id'),0,-1);
        $subcat_id = $this->input->post('subcat_id');
        
        $query = $this->db->get('tbl_quizes');
        if($query->num_rows()>0) {
            $query_result = $query->result();
            $total_rows = count($query_result);
        }

        $sql = "select * from tbl_quiz_display order by percentage desc";
        $query1 = $this->db->query($sql);
        //echo $sql;exit;
        if($query1->num_rows()>0) {
            $query_result1 = $query1->result();
            //print_r($query_result1);exit;
            $user = $query_result1[0]->user_type;
            $percentage = $query_result1[0]->percentage;
            //echo "test";

           // echo $user; exit;

            if($user == 'regular') {
                $regular_question_display = ($percentage/100)*$total_rows;

                if(!$this->session->userdata('regular_question_display')) {
                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                    $this->session->set_userdata('regular_question_display',1);
                }
                else if($this->session->userdata('regular_question_display') <= $regular_question_display) {
                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                        $this->session->set_userdata('regular_question_display',$this->session->userdata('regular_question_display')+1);
                    }
                    else {
                        $user2 = $query_result1[1]->user_type;
                        $percentage2 = $query_result1[1]->percentage;

                        if($user2 == 'sponsor') {
                            $advertiser_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('advertiser_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                                $this->session->set_userdata('advertiser_question_display',1);
                            }
                            else if($this->session->userdata('advertiser_question_display') <= $advertiser_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                                    $this->session->set_userdata('advertiser_question_display',$this->session->userdata('advertiser_question_display')+1);
                                }
                                else {
                                    $user3 = $query_result2[2]->user_type;
                                    $percentage3 = $query_result2[2]->percentage;

                                    $special_question_display = ($percentage3/100)*$total_rows;

                                    if(!$this->session->userdata('special_question_display')) {
                                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                        $this->session->set_userdata('special_question_display',1);
                                    }
                                    else if($this->session->userdata('special_question_display') <= $special_question_display) {
                                            $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                            $this->session->set_userdata('special_question_display',$this->session->userdata('special_question_display')+1);
                                        }
                                }
                        }

                        else {
                            $special_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('special_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                $this->session->set_userdata('special_question_display',1);
                            }
                            else if($this->session->userdata('special_question_display') <= $special_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                    $this->session->set_userdata('special_question_display',$this->session->userdata('special_question_display')+1);
                                }
                        }
                        $this->session->unset_userdata('regular_question_display');
                        $this->session->unset_userdata('advertiser_question_display');
                        $this->session->unset_userdata('special_question_display');
                    }
            }

            if($user == 'advertiser') {
                $advertiser_question_display = ($percentage/100)*$total_rows;

                if(!$this->session->userdata('advertiser_question_display')) {
                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                    $this->session->set_userdata('advertiser_question_display',1);
                }
                else if($this->session->userdata('advertiser_question_display') <= $advertiser_question_display) {
                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                        $this->session->set_userdata('advertiser_question_display',$this->session->userdata('advertiser_question_display')+1);
                    }
                    else {
                        $user2 = $query_result1[1]->user_type;
                        $percentage2 = $query_result1[1]->percentage;

                        if($user2 == 'regular') {
                            $regular_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('regular_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                $this->session->set_userdata('regular_question_display',1);
                            }
                            else if($this->session->userdata('regular_question_display') <= $regular_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                    $this->session->set_userdata('regular_question_display',$this->session->userdata('regular_question_display')+1);
                                }
                                else {
                                    $user3 = $query_result2[2]->user_type;
                                    $percentage3 = $query_result2[2]->percentage;

                                    $special_question_display = ($percentage3/100)*$total_rows;

                                    if(!$this->session->userdata('special_question_display')) {
                                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                        $this->session->set_userdata('special_question_display',1);
                                    }
                                    else if($this->session->userdata('special_question_display') <= $special_question_display) {
                                            $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                            $this->session->set_userdata('special_question_display',$this->session->userdata('special_question_display')+1);
                                        }
                                }
                        }

                        else {
                            $special_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('special_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                $this->session->set_userdata('special_question_display',1);
                            }
                            else if($this->session->userdata('special_question_display') <= $special_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                                    $this->session->set_userdata('special_question_display',$this->session->userdata('special_question_display')+1);
                                }
                        }
                        $this->session->unset_userdata('regular_question_display');
                        $this->session->unset_userdata('advertiser_question_display');
                        $this->session->unset_userdata('special_question_display');
                    }
            }

            if($user == 'special') {
                $special_question_display = ($percentage/100)*$total_rows;

                if(!$this->session->userdata('special_question_display')) {
                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                    $this->session->set_userdata('special_question_display',1);
                }
                else if($this->session->userdata('sepcial_question_display') <= $special_question_display) {
                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'special');
                        $this->session->set_userdata('special_question_display',$this->session->userdata('special_question_display')+1);
                    }
                    else {
                        $user2 = $query_result1[1]->user_type;
                        $percentage2 = $query_result1[1]->percentage;

                        if($user2 == 'advertiser') {
                            $advertiser_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('advertiser_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                                $this->session->set_userdata('advertiser_question_display',1);
                            }
                            else if($this->session->userdata('advertiser_question_display') <= $advertiser_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'advertiser');
                                    $this->session->set_userdata('advertiser_question_display',$this->session->userdata('adevertiser_question_display')+1);
                                }
                                else {
                                    $user3 = $query_result2[2]->user_type;
                                    $percentage3 = $query_result2[2]->percentage;

                                    $regular_question_display = ($percentage3/100)*$total_rows;

                                    if(!$this->session->userdata('regular_question_display')) {
                                        $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                        $this->session->set_userdata('regular_question_display',1);
                                    }
                                    else if($this->session->userdata('regular_question_display') <= $regular_question_display) {
                                            $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                            $this->session->set_userdata('regular_question_display',$this->session->userdata('regular_question_display')+1);
                                        }
                                }
                        }

                        else {
                            $regular_question_display = ($percentage2/100)*$total_rows;

                            if(!$this->session->userdata('regular_question_display')) {
                                $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                $this->session->set_userdata('regular_question_display',1);
                            }
                            else if($this->session->userdata('regular_question_display') <= $regular_question_display) {
                                    $result = $this->Quiz_model->search_by_category($quiz_level,$cat_id,$subcat_id,'regular');
                                    $this->session->set_userdata('regular_question_display',$this->session->userdata('regular_question_display')+1);
                                }
                        }
                        $this->session->unset_userdata('regular_question_display');
                        $this->session->unset_userdata('advertiser_question_display');
                        $this->session->unset_userdata('special_question_display');
                    }
            }
           // print_r($result);exit;
            echo $quiz_id=$result->quiz_id;
        }
    }

    function addFavourites() {
         $this->checkMemberLogin();
         $data = $this->Quiz_model->add_favourites();
          if($data){
              if($data=='2'){
             $message="success*";
             $message.="This quiz has been already saved in favourite list!";
             echo $message;
             
             }
             else if($data=='1'){
                 $message="success*";
                 $message.="This quiz has been added to favourite list!";
                 echo $message;
                 
             }
             
         }
         else echo $message= "error|error";
         
        
       
    }

    function addPlaylist() {
        $this->checkMemberLogin();
        $result = $this->Quiz_model->add_playlist();
        if($result){
            if($result=='1')
                   echo "success";
            else echo "already added";
        }
            
        else echo "error|error";
    }
     function addPlaylists() {
          $this->checkMemberLogin();
           $result = $this->Quiz_model->add_playlist();
          if($result)
             echo "success";
          else echo "error|error";
     }

    function editPlaylist() {
        $this->Quiz_model->edit_playlist();
    }
    //function to sort multi-array using specific key
    function subval_sort_arr($arr, $subKey, $sort) {
        foreach($arr as $k => $v) {
            $b[$k] = strtolower($v[$subKey]);
        }
        $sort($b);
        foreach($b as $key => $val) {
            $c[] = $arr[$key];
        }
        return $c;
    }

    function quiz_stats($mem_id,$status='') {
        $user_id=$this->session->userdata('wannaquiz_user_id');
        $playedCats = array();
        $quiz_stat_info = $this->Quiz_model->get_quiz_stat($mem_id);
        if(count($quiz_stat_info)>0) {
            sort($quiz_stat_info);
            $idArr = array();
            //get the quizes played
            //get quizes not played
            //

            $p = 0;
            foreach($quiz_stat_info as $v) {
                array_push($idArr, $v->id);
                $playedCats[$p]["id"] = $v->id;
                $playedCats[$p]["name"] = $v->name;
                $playedCats[$p]["total"] = $v->total;
                $p++;
            }


            $idsCsv = implode(",", $idArr);
        }
        else $idsCsv = '0';
        $category = $this->Category_model->get_categories_ext($idsCsv);
        $notPlayedCats = array();
        $c = 0;
        foreach($category as $val) {
            $notPlayedCats[$c]["id"] = $val->id;
            $notPlayedCats[$c]["name"] = $val->name;
            $notPlayedCats[$c]["total"] = 0;
            $c++;
        }
        /*echo "<pre>";
        print_r($playedCats); exit;*/
        $countNotPlayed = count($notPlayedCats);  //12
        $countPlayed = count($playedCats);  //4
        $totalCat = ($countNotPlayed + $countPlayed);
        //per page 9; totCat = 12; played=4; notPlayed=8
        $mergedArr = array_merge($playedCats, $notPlayedCats);
        $sortedArr = $this->subval_sort_arr($mergedArr, 'name', asort);





        $cat = array();
        $cat1 = array();
        $cat_total = "";
        $cat_names = "";
        $cname="";

        if(count($sortedArr)>0) {
            if($status == '') {
                if(count($sortedArr)>6) {
                    $a = 0; $b = 6;
                }
                else {
                    $a = 0; $b = count($sortedArr);
                }
            }
            else if($status == 'more1'){
                if(count($sortedArr)>12){
                    $a=6; $b=12;
                }
                else {
                    $a=6;$b=count($sortedArr);
                }
            }
            else { $a = 12; $b = 18; }
            //echo $a.'/'.$b;
            for($j=$a;$j<$b;$j++) {
                $cat[]= $sortedArr[$j]->name;
                $cat_total.= $sortedArr[$j]['total'].',';
                $cname.= '"'.$sortedArr[$j]['name'].'"'.',';
            }
            if(count($cat_total)>0)
                $data['total_cat'] = rtrim($cat_total,',');
            else $data['total_cat'] = '0';
            $data['cat_names'] = rtrim($cname,',');

            if($data['total_cat']>1000)
            $data['max'] = ($data['total_cat'] * 1.2);
            else $data['max'] = 1000;

        //echo '<pre>'; print_r($data['cat_names']); print_r($data['total_cat']);exit;
        }

        //        else  $data['total_cat'] = 0;
        //        $data['category'] =$category;
        //
        //        if(count($category)>0) {
        //            foreach($category as $categories) {
        //                $cat1[] = $categories->name;
        //            }
        //        }
        //        $total_category =$cat1;
        //
        //        if(count($quiz_stat_info)>0) {
        //            $total_category = array_diff($cat1,$cat);
        //        }
        //
        //        $added_category = array_merge($cat,$total_category);
        //        //print_r($cat); print_r($cat1);
        //        //echo '<pre>';print_r($added_category); print_r($data['total_cat']);echo '</pre>'; exit;
        //        //sort($added_category);
        //        if($status==''){
        //            if(count($added_category)>9)
        //            { $a = 9; $data['more']='1'; }
        //            else { $a = $added_category; $data['more']='0';}
        //            for($i=0;$i<$a; $i++) {
        //                $cat_names.= '"'.$added_category[$i].'"'.",";
        //            }
        //        }
        //        else {
        //            for($i=9;$i<18; $i++) {
        //                $cat_names.= '"'.$added_category[$i].'"'.",";
        //            }
        //            //$data["total_cat"] = "";
        //        }
        //
        //        $data['cat_names'] = rtrim($cat_names,",");
        //        //print_r($data['total_cat']); print_r($data['cat_names']);
        $this->load->view('quiz/quiz_stats',$data);

    }

    function categoryDetail($user_type,$cname) {
        $category_name = str_replace('_',' ',$cname);
        $cid = $this->Category_model->get_category_id_from_name($category_name);
        $this->load->model('Category_model');
        $this->load->model('Advertise_management_model');
        $config['base_url'] = base_url().'quiz/categoryDetail/'.$user_type.'/'.$cname;
        $result=$this->Quiz_model->get_questions_by_category($cid,$user_type,0,0);
        $config['total_rows']=  count($result);
        $config['per_page'] = '15';
        $config['uri_segment'] = '5';
        $offset=$this->uri->segment(5,0);
        $this->pagination->initialize($config);
        
        $user_id = $this->session->userdata('wannaquiz_user_id');
        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);
            
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            
            $data['filter'] = $filter;
        }

        $data['category_detail'] = $this->Category_model->get_category_by_id($cid);
        $data['category_questions'] = $this->Quiz_model->get_questions_by_category($cid,$user_type,$config['per_page'],$offset);
        $data['user_type'] = $user_type;
        $data['sub_category'] = $this->Quiz_model->get_subcategory($cid);
        $data['admin_ads'] = $this->Advertise_management_model->get_admin_ads_by_cid_category($cid,'rectangular','category');
        
        $data['main']='gameboard/gameboard_category';
        $this->load->view("index",$data);
    }

    function category($user_type) {
        $categories = $this->Category_model->get_categories();
        $this->load->model('Advertise_management_model');
        $data['categories'] = $categories;
        $data['user_type']= $user_type;
        $data['admin_ads'] = $this->Advertise_management_model->get_admin_ads_by_allcid();
        $data['main']='quiz/category';
        $this->load->view("index",$data);
    }

    //----------------GAMING QUIZ AJAX FUNCTIONS ------------------------------------------
    function getQuestion() {
        $quiz_id=$this->input->post('quiz_id');
        //echo $quiz_id; exit;
        $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo,tbl_quiz_videos qv where q.quiz_id=qo.quiz_id and q.quiz_id=qv.quiz_id and q.status='1' AND q.quiz_id=".$quiz_id ;

        $query=$this->db->query($sql);
        $data=$query->row();
        $quiz_vid = explode(".",$data->quiz_videos);
        echo "result1=".$quiz_vid[0].".flv";
    }

    function getAnswer() {
        $quiz_id=$this->input->post('quiz_id');

        $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo,tbl_quiz_videos qv where q.quiz_id=qo.quiz_id and q.quiz_id=qv.quiz_id AND q.status='1' and q.quiz_id=".$quiz_id;

        $query=$this->db->query($sql);
        $data=$query->row();
        $vid_answer = explode(".",$data->video_answer);
        echo "result1=".$vid_answer[0].".flv";
    }


    function welcomeUser() {
        $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                            	<div class="content_wrap">

                                                        	<div class="lightblue_bg">
                                                            	<div style="height:60px;">
                                                            		<div class="font14 bold text_center" style="padding:20px 0 0 0;">Welcome! '.$this->session->userdata('wannaquiz_username').' you can start playing!</div>
                                                                </div>
                                                            </div>


                                                    </div>
                                            	<div class="content_10box">

                                                    <div>

                                                        <div>
                                                        	<div style="position:absolute; bottom:10px; right:200px;">
                                                            <div class="text_center bold content_wrap">
                                                            	<div><a href="#">Save score</a></div>
                                                                <div><a href="#">Score today</a></div>
                                                                <div><a href="#">Total Score</a></div>
                                                            </div>
                                                        	<div class="pointboard_bg">
                                                            	<div class="pointboard_bgInner">
                                                            		<div class="font10">Questions Answered</div>
                                                                    <div class="bold" style="font-size:17px; height:30px;">0</div>
                                                                    <div style="height:36px; line-height:36px;" class="bold color_blue">'.$this->session->userdata('wannaquiz_username').'</div>
                                                                    <div class="font10">Points</div>
                                                                    <div class="bold" style="font-size:17px; height:30px;">7</div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        	<div style="position:absolute; bottom:10px; right:20px;">
                                                            	<div class="game_optionicon"><a href="#">Options</a></div>
                                                            </div>
                                                        </div>

                                                        <div class="clear"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        echo $html;
    }

    function showVideoAgain() {
        $quiz_id=$this->input->post('quiz_id');
        $html=' <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="552" HEIGHT="343" id="banner_rotativo" ALIGN="">

                                    <PARAM NAME=movie VALUE="'.base_url().'video_question.swf?q='.$quiz_id.'">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#3399CC>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <EMBED wmode="opaque" src="'.base_url().'video_question.swf?q='.$quiz_id.'" quality=high bgcolor=#3399CC WIDTH="552" HEIGHT="343" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                     </OBJECT>';

        echo $html;
    }

    function getQuestionOptions() {
        $quiz_html = '';
        $quiz_type = $this->input->post('quiz_type'); 
        $quiz_id=$this->input->post('quiz_id');
        $sql="SELECT * from tbl_quizes q,tbl_quiz_options qo where q.quiz_id=qo.quiz_id AND q.quiz_id=".$quiz_id;

        $query=$this->db->query($sql);
        $data=$query->row();
        $category_id = $data->category_id;
        $answer=$this->getRightAnswer($data->quiz_id,$data->right_option);
        if($this->session->userdata('wannaquiz_user_id') && $this->session->userdata('game_mode')=="multi") {
            if($this->session->userdata('player_id') == 99) {
                $player_id = 0;
            } else {
                $player_id = $this->session->userdata('player_id');
            }

            $user_array = $this->session->userdata('multiplayer');
            $user = $user_array[$player_id];

            $mp_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $user);
            $total_points = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
            $total_answered = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);
        }
        else if($this->session->userdata('wannaquiz_user_id')) {
                $user=$this->session->userdata('wannaquiz_username');
                $total_points=$this->Quiz_model->getUserTotalScoredBonusPoints($this->session->userdata('wannaquiz_user_id'));
                $total_answered=$this->Quiz_model->getUserTotalQuestionsAnswered($this->session->userdata('wannaquiz_user_id'));
            }
            else {
                $guest_array_final = $this->session->userdata('guest_answer');
                $user="Guest";
                if(empty($guest_array_final)) {
                    $total_points=0;
                    $total_answered=0;
                }
                else {
                    $total_points=$guest_array_final['total_points'];
                    $total_answered=$guest_array_final['total_answer'];
                }
            }
        if($quiz_type == 'video') {
            $quiz_html .=  '
                <div class="gamerightside">
                    <a href="javascript:void(0);" id="showVideo" onclick="javascript:showVideoAgain(\''.$quiz_id.'\');" style="cursor:pointer;">Play video again</a>
                </div>';
        }
        else
            $quiz_html .=  '
                <div class="gamerightside">
                    <a href="javascript:void(0);" id="showPhoto" onclick="javascript:showPhotoAgain(\''.$quiz_id.'\');" style="cursor:pointer;">View Photo Again</a>
                </div>';
        
        $html='<div id="game_wrap">
                <div id="game_bg">
                <div class="content_10box">
                    <div class="content_wrap">                    
                            <div class="gameleftside" style="padding-left:24px;text-align:left;width:336px; height:35px; overflow:hidden"><div class="font14 bold" title="'.$data->quiz_question.'">'
                            .$data->quiz_question.
                            '</div>
                        </div>'
                        .$quiz_html.
                        '<div class="clear"></div>
                    <div class="separator_blue"></div>
                </div>
            <div class="answers_option_cont">
                <div class="gameleftside" style="width:335px;">
    <div class="padding_10topbottom">
        <div class="answer_smalloption" style="height:45px; overflow:hidden"><a href="javascript:void(0);" onclick="playVideoAnswer(\'option1\',\''.$quiz_id.'\')" style="background:url('.base_url().'images/option_smalla.jpg) no-repeat top left; text-align:left;" title="'.$data->option1.'">'.$data->option1.'</a></div>
    </div>
    <div class="padding_10topbottom">
        <div class="answer_smalloption" style="height:45px; overflow:hidden"><a href="javascript:void(0);" onclick="playVideoAnswer(\'option2\',\''.$quiz_id.'\')" style="background:url('.base_url().'images/option_smallb.jpg) no-repeat top left; text-align:left;" title="'.$data->option2.'">'.$data->option2.'</a></div>
    </div>
    <div class="padding_10topbottom">
        <div class="answer_smalloption" style="height:45px; overflow:hidden"><a href="javascript:void(0);" onclick="playVideoAnswer(\'option3\',\''.$quiz_id.'\')" style="background:url('.base_url().'images/option_smallc.jpg) no-repeat top left; text-align:left;" title="'.$data->option3.'">'.$data->option3.'</a></div>
    </div>
                </div>
             <div>
             <div style="position:absolute; bottom:30px; right:36px;">
                <div class="pointboard_smallbg">
                    <div class="pointboard_smallbgInner">
                        <div style="padding-top:5px; font-size:9px;">Questions Answered</div>
                        <div class="bold" style="font-size:17px; height:25px;">'.$total_answered.'</div>
                        <div style="height:27px; line-height:25px;" class="bold color_blue">';
    if(strlen($user)>12)
    $user = substr($user,0,10).'...';
    $html.=$user.'</div>
                            <div class="font10">Points</div>
                            <div class="bold" style="font-size:17px; height:30px;">'.$total_points.'</div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="clear"></div>

                    </div>
                </div>
            </div>
        </div>';
        echo $html;
    }


    function playVideoAnswer() {
        $this->load->model('Award_model');
        $option_id=$this->input->post('option');
        $quiz_id=$this->input->post('quiz_id');
        $quiz_info=$this->Quiz_model->get_quiz_info_by_qid($quiz_id);
        //print_r($quiz_info);exit;
        $cat_id = $quiz_info->category_id;
        $cat_info = $this->Category_model->get_parent_id($cat_id);
        if($cat_info->parent_id==0)
            $category_id=$cat_id;
        else $category_id =$cat_info->parent_id;
        //echo $category_id;exit;
        if($quiz_info->right_option==$option_id) {
            $answer_status=1;
            if($quiz_info->quiz_level==2)
                $point=1;
            else
                $point=2;
        }
        else {
            $answer_status=0;
            $point=0;
        }

        if(!$this->session->userdata('wannaquiz_user_id')) {
            if($this->session->userdata('guest_answer') ) {
                $guest_array_old = $this->session->userdata('guest_answer');
                $total_answer = $guest_array_old['total_answer'] + 1;
                $total_points = $guest_array_old['total_points'] + $point;

                $guest_array = array('guest_answer' => array('total_answer' => $total_answer, 'total_points' => $total_points));
            }
            else {
                $guest_array = array('guest_answer' => array('total_answer' => $answer_status, 'total_points' => $point));
            }
            $this->session->set_userdata($guest_array);

        }else if($this->session->userdata('wannaquiz_user_id') && $this->session->userdata('game_mode')=="multi") {
                $multiplayer_array = $this->session->userdata('multiplayer');
                if($this->session->userdata('player_id') == 99) {
                    $player_id = 0;
                } else {
                    $player_id = $this->session->userdata('player_id');
                }
                $current_player_name = $multiplayer_array[$player_id];
                $multiplayer_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $current_player_name);

                $data=array(
                    'quiz_id'=>$quiz_id,
                    'multiplayer_id'=>$multiplayer_id,
                    'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                    'answer_status'=>$answer_status,
                    'played_date'=>date('Y-m-d',time()),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'point'=>$point
                );
                //echo $this->session->userdata('set_score').'////';
                if($this->session->userdata('set_score') != 'no')
                    $this->db->insert('tbl_multiplayer_point',$data);

            }else if($this->session->userdata('wannaquiz_user_id')) {
                // check whether there are any referring friend emails. and check whether that referring email and the user email matches. if they matched the points sholud not save.
                    $flag = 0;
                    $implode_email = $_COOKIE['email'];
                    $explode_email = explode(",",$implode_email);
                    //print_r($explode_email);
                    if(isset($_COOKIE['email'])) {
                        $user = $this->Member_model->get_member($this->session->userdata('wannaquiz_user_id'));
                        $user_email = $user->email;
                        for($i=0;$i<count($explode_email);$i++) {
                            if($user_email==$explode_email[$i])
                                $flag = 1;
                        }
                        //echo $flag; exit;
                        if($flag!=1) {
                            $check = $this->Quiz_model->check_user_quiz_played($quiz_id,$this->session->userdata('wannaquiz_user_id'));
                            if($check<1 && $quiz_info->user_id != $this->session->userdata('wannaquiz_user_id')) {
                                $data=array(
                                    'quiz_id'=>$quiz_id,
                                    'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                                    'answer_status'=>$answer_status,
                                    'answered_date'=>current_date_time_stamp(),
                                    'points'=>$point
                                );

                                $this->db->insert('tbl_quiz_answers',$data);
                                $random_category_id = $this->session->userdata('random_category_id');
                                $this->Category_model->insertCategoryPoints($this->session->userdata('wannaquiz_user_id'),$category_id,$point);
                            }

                        }
                    }
                    else {
                        $check = $this->Quiz_model->check_user_quiz_played($quiz_id,$this->session->userdata('wannaquiz_user_id'));
                        if($check<1 && $quiz_info->user_id != $this->session->userdata('wannaquiz_user_id')) {
                            $data=array(
                                'quiz_id'=>$quiz_id,
                                'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                                'answer_status'=>$answer_status,
                                'answered_date'=>current_date_time_stamp(),
                                'points'=>$point
                            );

                            $this->db->insert('tbl_quiz_answers',$data);
                            $random_category_id = $this->session->userdata('random_category_id');
                            $this->Category_model->insertCategoryPoints($this->session->userdata('wannaquiz_user_id'),$category_id,$point);
                        }
                    }
                    // check whether the user already get the helpful award. if he is not getting helpful award, check whether he played over 50 quizes. if yes he will be awarded by helpful award.
                    $user_award = $this->Award_model->check_user_helpful_awards($this->session->userdata('wannaquiz_user_id'));
                    if($user_award<1) {
                        $total_quizes = $this->Quiz_model->count_user_played_quizes($this->session->userdata('wannaquiz_user_id'));
                        if($total_quizes>='50') {
                            $this->Award_model->insertHelpfulAward($this->session->userdata('wannaquiz_user_id'));
                        }
                    }

                    //update tbl_positions and update user total points.
                    $this->Quiz_model->set_user_position($this->session->userdata('wannaquiz_user_id'));
                    //for providing milestone award.
                    $this->Quiz_model->get_milestone_award($this->session->userdata('wannaquiz_user_id'));
                    //get user's total points and provide him a level according to his points.
                    $point_info = $this->Quiz_model->get_user_position($this->session->userdata('wannaquiz_user_id'));
                    //echo $this->session->userdata('wannaquiz_user_id'); print_r($point_info); exit;
                    
                    if($point_info->total_points>=0 && $point_info->total_points<100)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'1',$point_info->total_points);
                    if($point_info->total_points>=100 && $point_info->total_points<200)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'2',$point_info->total_points);
                    if($point_info->total_points>=200 && $point_info->total_points<300)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'3',$point_info->total_points);
                    if($point_info->total_points>=300 && $point_info->total_points<400)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'4',$point_info->total_points);
                    if($point_info->total_points>=400 && $point_info->total_points<750)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'5',$point_info->total_points);
                    if($point_info->total_points>=750 && $point_info->total_points<1000)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'6',$point_info->total_points);
                    if($point_info->total_points>1000 && $point_info->total_points<1250)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'7',$point_info->total_points);
                    if($point_info->total_points>1250 && $point_info->total_points<1500)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'8',$point_info->total_points);
                    if($point_info->total_points>1500 && $point_inf->total_pointso<2000)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'9',$point_info->total_points);
                    if($point_info->total_points>2000 && $point_info->total_points<2500)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'10',$point_info->total_points);
                    if($point_info->total_points>2500 && $point_info->total_points<3000)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'11',$point_info->total_points);
                    if($point_info->total_points>3000 && $point_info->total_points<3500)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'12',$point_info->total_points);
                     if($point_info->total_points>3500 && $point_info->total_points<4000)
                        $this->Quiz_model->set_member_level($this->session->userdata('wannaquiz_user_id'),'13',$point_info->total_points);


                    //check tbl_quiz_answers for correct answers in a row. and awarded a user by prefect score award.
                    $this->Quiz_model->get_perfect_score_A($this->session->userdata('wannaquiz_user_id'));
                    $this->Quiz_model->get_perfect_score_H($this->session->userdata('wannaquiz_user_id'));

                    $this->Award_model->insert_user_category_award($this->session->userdata('wannaquiz_user_id'));
                }

        if($this->session->userdata('game_mode')) {
            if($this->session->userdata('game_mode')=='multi')
                $game_mode='multi';
            else
                $game_mode='single';
        }
        else
            $game_mode='single';
        if($quiz_info->quiz_type == "photo") 
        {
            $answer_image = $this->Quiz_model->get_quiz_answerimage_by_qid($quiz_info->image_id);
            $image=base_url().'photo_question_images/'.$answer_image->photo_name;            
          // print_r($answer_image);
         //  echo '<br>';
           //echo  $image;
            $dims = getimagesize($image);

            if( $dims[0] < $dims[1] ) 
    {
        $con = 'game_wrap';
        $bg = 'game_bg';
        $txt = 'textimgbg';
        $src = $image . '&h=340&w=&zc=0';
    }
    else
    {
        $con = 'game_wrap';
        $bg = 'game_bg';
        $txt = 'textimgbg';
        #$src = $image . '&w=510&h=&zc=0';
        $src = $image . '&h=340&w=&zc=0';
    }

#<img src="' . $image . '" width="' . $dims[0] . '" height="' . $dims[1] . '" alt="quiz answer video" id="thumbnail" />
            $html = '
                <div id="'.$con.'">
                    <div id="'.$bg.'">
                        <div class="content_10box" style="padding:0px">                                                                            
                            <div class="content_wrap">                                                        
                                <img src="'.base_url().'resizer.php?src='.$src.'" alt="quiz answer video" id="thumbnail" />
                                <div class="'.$txt.'" style="display:none" id="textimgalign">
                                    <div class="textimg1" id="answer"></div>                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        else if($quiz_info->quiz_type == "video") {
                $html=' <div align="center" style="z-index:-100;" id="game_flash">
                        <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="550" HEIGHT="343" id="banner_rotativo" ALIGN="">

                                    <PARAM NAME=movie VALUE="'.base_url().'video_answer.swf?q='.$quiz_id.'&game_mode='.$game_mode.'">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#000000>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <EMBED wmode="opaque" src="'.base_url().'video_answer.swf?q='.$quiz_id.'&game_mode='.$game_mode.'" quality=high bgcolor=#000000 WIDTH="550" HEIGHT="343" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                     </OBJECT>
                    </div>';
            }
        echo $html;

    // check perfect score for average and hard question.

    }


    function showAnswerResult($status='') {        
        if(!$this->session->userdata('game_mode')) {
            $this->session->set_userdata('game_mode',"single");
        }
        $this->load->model('Category_model');
        if($this->session->userdata('wannaquiz_user_id') && $this->session->userdata('game_mode')=="multi") {
            if(!$this->session->userdata('player_id')) {
                $this->session->set_userdata('player_id', 99);
            }
            else {
                $old_player_id = $this->session->userdata('player_id');
                if($old_player_id == 99) {
                    $old_player_id = 0;
                }
                $this->session->set_userdata('player_id', $old_player_id);
            }

            $user_array = $this->session->userdata('multiplayer');
            if($this->session->userdata('player_id') == 99) {
                $player_id = 0;
            }
            else {
                $player_id = $this->session->userdata('player_id');
            }

            if(count($user_array) == $player_id) {
                $this->session->set_userdata('player_id', 99);
                $player_id = 0;
            }

            $user = $user_array[$player_id];

            $mp_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $user);
            $total_points = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
            $total_answered = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);
        }
        else if($this->session->userdata('wannaquiz_user_id')) {
                $user=$this->session->userdata('wannaquiz_username');
                $total_points=$this->Quiz_model->getUserTotalScoredBonusPoints($this->session->userdata('wannaquiz_user_id'));
                $total_answered=$this->Quiz_model->getUserTotalQuestionsAnswered($this->session->userdata('wannaquiz_user_id'));
            }
            else {
                $guest_array_final = $this->session->userdata('guest_answer');
                $user="Guest";
                $total_points=$guest_array_final['total_points'];
                $total_answered=$guest_array_final['total_answer'];
            }
        $quiz_id = $this->input->post('quiz_id');
        $quiz_info = $this->Quiz_model->get_user_by_quizid($quiz_id);

        $categories=$this->Category_model->get_categories();
        //echo $status; exit;

        if($status=='') 
            { //echo "hehe";
            $quiz_id=$this->input->post('quiz_id');            
            $advertiser_ad = $this->Member_model->get_advertiser_advertisement('',$quiz_id);
            $catid = substr($this->session->userdata("cat_id"),0,-1);

            if(!empty($catid)) {
                $regular_ad = $this->Member_model->get_regular_catid_advertisement($catid);
            }

            if(!empty($advertiser_ad)) {             
                $advertise_id = $advertiser_ad->id;
                $advertise = $advertiser_ad->link_short_desc;
                $advertise_link = $advertiser_ad->link_url;
                $ads_type = "short_text";                
            }
            else if(!empty($regular_ad)) {
                    $advertise_id = $regular_ad->id;
                    $advertise = $regular_ad->adv_detail;
                    $advertise_link = $regular_ad->link_url;
                    $ads_type = $regular_ad->adv_type;
                }
                else {                    
                    $reg_ad = $this->Member_model->get_regular_advertisement();
#print_r($reg_ad);exit;
                    $advertise_id = $reg_ad->id;
                    $advertise = $reg_ad->adv_detail;
                    $advertise_link = $reg_ad->link_url;
                    $ads_type = $reg_ad->adv_type;

                }

            if($quiz_info->quiz_type == "photo"){
                $sql1 = "SELECT images FROM tbl_quiz_images where quiz_id=".$quiz_id;
                $query1=$this->db->query($sql1);
                $data1=$query1->row();
                $photo_image = explode(".",$data1->images);
                $image_url = '<img src="'.base_url().'photo_question_thumbs/'.$photo_image[0].'.jpg" width="66" height="50" alt="advertiser_image" />';                
            }
            else {
                $sql = "SELECT quiz_videos FROM tbl_quiz_videos where quiz_id=".$quiz_id;
                $query=$this->db->query($sql);
                $data=$query->row();
                $video_image = explode(".",$data->quiz_videos);
                $image_url = '<img src="'.base_url().'converted_video_images/'.$video_image[0].'.jpg" width="66" height="50" alt="advertiser_image" />';
            }

            //$this->Quiz_model->insert_rotated_banner_ads($advertise_id,$quiz_id);
            

            if($advertise_link=='') {$advertise_link='#'; $target = '';  }
            else $target = '_blank';
# here
            if($quiz_info->user_type!=0 && $advertise_id!='') 
            {
                $this->Quiz_model->insert_ads_view_click_log($advertise_id,'short_text');
                $ad_content ='<div class="content_wrap" style="float:left;width:530px;margin-left:5px;text-align:left;">
                                                                    <div class="lightblue_bg" style="height:70px;">
                                                                        <div class="content_10box">
                                                                            <div class="gameleftside" style="padding-right:10px;">'.$image_url.'</div>
                                                                            <div class="gameleftside" style="width:233px;">
                                                                                <div>Offer from publisher of last question:</div>
                                                                            </div>
                                                                            <div class="gameleftside" style="width:380px;">
                                                                                <div><br /><a href="http://'.$advertise_link.'" target="'.$target.'" onclick="trackClick('.$advertise_id.','.$quiz_info->user_id.','."'".$ads_type."'".')">'.substr($advertise,0,80).'</a></div>

                                                                            </div>
                                                                            <div class="clear"></div>
                                                                        </div>
                                                                    </div>
                                                        </div>';
            }
        }
        if(!$this->session->userdata('wannaquiz_user_id')) { //echo "test";exit;
            $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                                '.$ad_content.'
                                            	<div class="content_10box">
                                                
                                                    <div>
                                                        <div class="gameleftside" style="width:285px;text-align:left;">
                                                        	<div class="game_desc">
                                                            	<h1>How to play further?</h1>
                                                                <ol>
                                                                    <li>
                                                                        The colored buttons below are drop-down

                                                                        menus. Select you favourite categories

                                                                        and then choose a "Hard" or "Average"

                                                                        question.

                                                                    </li>
                                                                    <li>Just browse or search for questions.</li>
                                                                    <li>Answer questions from just <a href="'.site_url('home').'">one player</a>.</li>
                                                                    <li>Join and design your own <a href="'.site_url('gameboard').'">free game board</a>
                                                                            and play against your family/friends.
                                                                    </li>
                                                                </ol>

                                                                	<p>To Save your score, make questions, earn awards and play against others:</p>
                                                                    <p><a href="'.site_url('home/login/'.base64_encode('home')).'">Login</a></p>
                                                                    <p><a href="'.site_url('registration').'">Join Wannaquiz</a></p>


                                                            </div>

                                                        </div>
                                                        <div class="gamerightside" style="width:166px;">
                                                        	<div>
								<!--<form method="post" name="form_category">
									<div class="font11" style="position:absolute; top:10px; right:-20px; z-index:1000;">
                                        <div class="padding_2bottom"  style="width:195px;">
                                            <div class="cathistory_bg" style="width:159px;">
                                                <a href="javascript:void(0);" id="history" onclick="hide_unhide(\'123\')" class="color_white bold movies_game"  style="width:160px; text-align:center;">Categories</a>
                                            </div>

                                            <div id="category_123" style="display:none; width:158px;" class="catlinks"
                                                <div class="catcontentbox">
                                                    <div class="content_10box">-->';
        }
        else if($this->session->userdata('game_mode')=="single") {
                $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                                '.$ad_content.'
                                            	<div class="content_10box">
                                                    <div>
                                                        <div class="gameleftside" style="width:285px;text-align:left;">
                                                        	<div class="game_desc">
                                                            	<h1>You can continue playing by:</h1>
                                                                <ol>
                                                                    <li>Choosing categories below and pressing the "Hard" or "Average" buttons.</li>
                                                                    <li>Browse or search for questions.</li>
                                                                    <li>Answer questions from just <a href="'.site_url('home').'">one player</a>.</li>
                                                                    <li>Creating a free <a href="'.site_url('gameboard').'">Free game board</a></li>
                                                                </ol>
                                                            </div>

                                                        </div>
                                                        <div class="gamerightside" style="width:166px;">
                                                        	<div>
								<!--<form method="post" name="form_category">
									<div class="font11" style="position:absolute; top:10px; right:-20px; z-index:1000;">
                                        <div class="padding_2bottom"  style="width:195px;">
                                            <div class="cathistory_bg"  style="width:159px;">
                                                <a href="javascript:void(0);" id="history" onclick="hide_unhide(\'123\')" class="color_white bold movies_game"  style="width:160px; text-align:center;">Categories</a>
                                            </div>

                                            <div id="category_123" style="display:none; width:158px;" class="catlinks">
                                                <div class="catcontentbox">
                                                    <div class="content_10box">-->';
            }
            else if($this->session->userdata('game_mode')=="multi") {
                    $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                                '.$ad_content.'
                                            	<div class="content_10box">

                                                    <div>
                                                        <div class="gameleftside" style="width:285px;text-align:left;">
                                                        	<div class="game_desc">
                                                            	<h1>You can continue playing by:</h1>
                                                                <ol>
                                                                	<li>Choosing categories below and pressing the "Hard" or "Average" buttons.</li>
                                                                    <li>Browse or search for questions.</li>
                                                                    <li>Answer questions from just <a href="'.site_url('home').'">one player</a>.</li>
                                                                    <li>Creating a free <a href="'.site_url('gameboard').'">Free game board</a></li>

                                                                </ol>
                                                                  <div class="padding_10topbottom">
                                                                    <p>Player is <span class="bold">'.$user.'</span></p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="gamerightside" style="width:166px;">
                                                        	<div>
								<!--<form method="post" name="form_category">
									<div class="font11" style="position:absolute; top:10px; right:-20px; z-index:1000;">
                                        <div class="padding_2bottom"  style="width:195px;">
                                            <div class="cathistory_bg"  style="width:159px;">
                                                <a href="javascript:void(0);" id="history" onclick="hide_unhide(\'123\')" class="color_white bold movies_game" style="text-align:center; width:160px;">Categories</a>
                                            </div>

                                            <div id="category_123" style="display:none; width:158px;" class="catlinks">
                                                <div class="catcontentbox">
                                                    <div class="content_10box">-->';
                }
        foreach($categories as $row) {
            $html.='  <!--<div>
                                      <input type="checkbox" name="category" value="'.$row->id.'">
                                       <label>'.$row->name.'</label>
                                      </div>-->';

        }

        $html.='<!--</div>
                </div>
                </div>
                </div>
                                        <div>
                                            <div class="catsub_left" style="width:83px;">
                                                <div class="cathistory_hard"><input type="hidden" name="level" value="3" ><a  class="color_white bold hard_game_cat" onclick="submit_cat_form(\'form_category\',\'3\')">Hard</a></div>
                                            </div>
                                            <div class="catsub_left" style="width:83px;">
                                                <div class="cathistory_average"><a class="color_white bold avg_game_cat" onclick="submit_cat_form(\'form_category\',\'2\')">Average</a></div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
									</form>-->
									</div>

                                                        	<div style="position:absolute; bottom:20px; right:10px;">
                                                        	<div class="pointboard_bg">
                                                            	<div class="pointboard_bgInner">
                                                            		<div class="font10">Questions Answered</div>
                                                                    <div class="bold" style="font-size:17px; height:30px;">'.$total_answered.'</div>
                                                                    <div style="height:36px; line-height:36px;" class="bold color_blue">';
        if(strlen($user)>12){
            $user = substr($user,0,10).'...';
            }
            //else echo $user;
        $html.=$user.'</div>
                                                                    <div class="font10">Points</div>
                                                                    <div class="bold" style="font-size:17px; height:30px;">'.$total_points.'</div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>

                                                        <div class="clear"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        <!--</div>-->';
        $this->session->set_userdata('multiplayer_total_answered',$total_answered);
        $this->session->set_userdata('multiplayer_user',$user);
        $this->session->set_userdata('multiplayer_total_points',$total_points);

        echo $html;
    }

    // Gaming System after Login -----------------

    function showAnswerResultMulti() {
        $user_array = $this->session->userdata('multiplayer');
        //echo $user_array;exit;
        if(!$this->session->userdata('player_id')) {
            $this->session->set_userdata('player_id', 99);
        }
        else {
            $old_player_id = $this->session->userdata('player_id');
            if($old_player_id == 99) {
                $old_player_id = 0;
            }
            if($this->input->post('flag')!='play_further') {
                $this->session->set_userdata('player_id', $old_player_id+1);

            }


        }


        if($this->session->userdata('player_id') == 99) {
            $player_id = 0;
        }
        else {
            $player_id = $this->session->userdata('player_id');
        }

        if(count($user_array) == $player_id) {
            $this->session->set_userdata('player_id', 99);
            $player_id = 0;
        }

        $user = $user_array[$player_id];
        //echo '<pre>'; print_r($user_array[$player_id-1]); echo '</pre>';
        //        if($this->input->post('flag')=='play_further')
        //        $this->session->set_userdata('previous_player',$user_array[$player_id]);


        $mp_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $user);
        $total_points = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
        $total_answered = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);

        $quiz_id=$this->input->post('quiz_id');
        
        $advertiser_ad = $this->Member_model->get_advertiser_advertisement('',$quiz_id);
        $catid = substr($this->session->userdata("cat_id"),0,-1);

        if(!empty($catid)) {
            $regular_ad = $this->Member_model->get_regular_catid_advertisement($catid);
        }

        if(!empty($advertiser_ad)) {
            $advertise_id = $advertiser_ad->id;
            $advertise = $advertiser_ad->link_short_desc;
            $advertise_link = $advertiser_ad->link_url;
            $ads_type = "short_text";

        }
        else if(!empty($regular_ad)) {
                $advertise_id = $regular_ad->id;
                $advertise = $regular_ad->adv_detail;
                $advertise_link = $regular_ad->link_url;
                $ads_type = $regular_ad->adv_type;
            }
            else {
                $reg_ad = $this->Member_model->get_regular_advertisement();
                $advertise_id = $reg_ad->id;
                $advertise = $reg_ad->adv_detail;
                $advertise_link = $reg_ad->link_url;
                $ads_type = $reg_ad->adv_type;

            }
        if($advertise_link=='') {$advertise_link='#'; $target = '';  }
        else $target = '_blank';
        $data=array(
            'banner_id'=>$advertise_id,
            'ip_address'=>$_SERVER['REMOTE_ADDR'],
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'action'=>"view",
            'ads_type'=>$ads_type,
            'action_date_time'=>current_date_time_stamp()
        );
        $this->db->insert('tbl_adv_banners_view_click',$data);

        $score_html = '';

        $multiplayer = $this->session->userdata('multiplayer');

        $last_data = count($multiplayer);

        if($this->session->userdata('previous_player')) {// echo 'Hello';
            $previous_player = $this->session->userdata('previous_player');
        }
        else
            $previous_player = $user_array[$player_id-1];
        //echo $previous_player;
        $nextplayer= $user_array[$player_id];
        $this->session->set_userdata('previous_player',$nextplayer);
        $nextplayer1= $previous_player;//$user_array[$player_id-1];

        if($nextplayer1=='') {
        //$nextplayer1=$user_array[$player_id+1];
        }
        if($nextplayer=='') {
            $nextplayer=$user_array[$player_id-2];
        }
        //echo $nextplayer.'/'.$nextplayer1;
        $mp_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $nextplayer1);
        $mp_point = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
        $mp_answer = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);
        $type = "'today'";
        $type1 = "'total'";
        $onclick = "showMultiScore(".$type.",".$quiz_id.",'".$previous_player."')";
        $onclick1 = "showMultiScore(".$type1.",".$quiz_id.",'".$previous_player."')";
        $score_html .= '<div style="float:right; width:155px;">
                                <div style="">
                                                                    <div class="text_center bold content_wrap">
                                                                            <div id="score1"><a href="javascript:void(0);" onclick="'.$onclick.'">Score today</a></div>
                                                                            <div id=""><a id="score" href="javascript:void(0);" onclick="'.$onclick1.'">Total Score</a></div>
                                                                    </div>
                                                                </div>
                                <div class="pointboard_bg">
									<div class="pointboard_bgInner">
										<div class="font10">Questions Answered</div>
										<div class="bold" style="font-size:17px; height:30px;">'.$mp_answer.'</div>
										<div style="height:36px; line-height:36px;" class="bold color_blue">';
        if(strlen($nextplayer1)>12)
        $nextplayer1 = substr($nextplayer1,0,10).'...';
        $score_html.=$nextplayer1.'</div>
										<div class="font10">Points</div>
										<div class="bold" style="font-size:17px; height:30px;">'.$mp_point.'</div>
									</div>
								</div></div>';
        //}

        $mp_id1 = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $nextplayer);
        $mp_point1 = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id1);
        $mp_answer1 = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id1);
        $score_html .= '<div style="float:right; width:155px; margin-right:40px;">
                                <div style="">
                                <div class="text_center font11 content_wrap" style="width:135px;"><!--<a href="javascript:void(0);" onclick="showAnswerResult()">--> This is the Next Player. Select a Question<!--</a>--></div>
                                </div>

    <div class="pointboard_bg">
									<div class="pointboard_bgInner">
										<div class="font10">Questions Answered</div>
										<div class="bold" style="font-size:17px; height:30px;">'.$mp_answer1.'</div>
										<div style="height:36px; line-height:36px;" class="bold color_blue">';
        if(strlen($nextplayer)>12)
        $nextplayer = substr($nextplayer,0,10).'...';
        $score_html.=$nextplayer.'</div>
										<div class="font10">Points</div>
										<div class="bold" style="font-size:17px; height:30px;">'.$mp_point1.'</div>
									</div>
								</div></div>';


//        $sql = "SELECT quiz_videos FROM tbl_quiz_videos where quiz_id=".$quiz_id;
//        $query=$this->db->query($sql);
//        $data=$query->row();
//        $video_image = explode(".",$data->quiz_videos);
        $categories=$this->Category_model->get_categories();
        $quiz_info = $this->Quiz_model->get_user_by_quizid($quiz_id);
        if($quiz_info->quiz_type == "photo"){
                $sql1 = "SELECT images FROM tbl_quiz_images where quiz_id=".$quiz_id;
                $query1=$this->db->query($sql1);
                $data1=$query1->row();
                $photo_image = explode(".",$data1->images);
                $image_url = '<img src="'.base_url().'photo_question_thumbs/'.$photo_image[0].'.jpg" width="66" height="50" alt="advertiser_image" />';
            }
            else {
                $sql = "SELECT quiz_videos FROM tbl_quiz_videos where quiz_id=".$quiz_id;
                $query=$this->db->query($sql);
                $data=$query->row();
                $video_image = explode(".",$data->quiz_videos);
                $image_url = '<img src="'.base_url().'converted_video_images/'.$video_image[0].'.jpg" width="66" height="50" alt="advertiser_image" />';
            }
        if($quiz_info->user_type!=0) {
            $ad_content ='<div class="content_wrap" style="float:left">
                            <div class="lightblue_bg" style="height:70px;">
                                <div class="content_10box">
                                    <div class="gameleftside" style="padding-right:10px;">'.$image_url.'</div>
                                    <div class="gameleftside" style="width:250px;">
                                        <div>Offer from publisher of last question:</div>
                                    </div>
                                    <div class="gameleftside" style="width:380px;">
                                        <div><a href="http://'.$advertise_link.'" target="'.$target.'" onclick="trackClick('.$advertise_id.','.$quiz_info->user_id.','."'".$ads_type."'".')">'.substr($advertise,0,80).'</a></div>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>';
        }
        else {
            $ad_content = '<div style="height:50px"></div>';
        }
        $html='<div id="game_wrap">
                    <div id="game_bg">
                        '.$ad_content.'
                        <div class="gamerightside" style="width:166px;">
                            <div>
                            <!--<form method="post" name="form_category">
                                    <div class="font11" style="position:absolute; top:10px; right:-20px; z-index:1000;">
                                        <div class="padding_2bottom" style="width:195px;">
                                            <div class="cathistory_bg" style="width:159px;">
                                                <a href="javascript:void(0);" id="history" onclick="hide_unhide(\'123\')" class="color_white bold movies_game" style="text-align:center; width:160px;">Categories</a>
                                            </div>

                                            <div id="category_123" style="display:none; width:158px;" class="catlinks">
                                                <div class="catcontentbox">
                                                    <div class="content_10box">-->';

        foreach($categories as $row) {
            $html.='                                <!--<div>
                                                        <input type="checkbox" name="category" value="'.$row->id.'">
                                                        <label>'.$row->name.'</label>
                                                    </div>-->';

        }
        $html.=                                 '<!--</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="catsub_left" style="width:83px;">
                                                <div class="cathistory_hard"><input type="hidden" name="level" value="3" ><a  class="color_white bold hard_game_cat" onclick="submit_cat_form(\'form_category\',\'3\')">Hard</a></div>
                                            </div>
                                            <div class="catsub_left" style="width:83px;">
                                                <div class="cathistory_average"><a class="color_white bold avg_game_cat" onclick="submit_cat_form(\'form_category\',\'2\')">Average</a></div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>-->
                           </div>
                        </div>
                        <div class="clear"></div>
                                <div class="content_10box" >
                                    <div>
                                        <div style="width:360px; margin:0 auto;">
                                            <!--<div class="anythingSlider">
                                              <div class="wrapper">
                                                    <ul>-->
                                            '.$score_html.'
                                            <div class="clear"></div>
                                            <!--</ul></div></div>-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        $this->session->set_userdata('nextplayer',$nextplayer);
        $this->session->set_userdata('nextplayer1',$nextplayer1);
        $this->session->set_userdata('mp_answer',$mp_answer);
        $this->session->set_userdata('mp_answer1',$mp_answer1);
        $this->session->set_userdata('mp_point',$mp_point);
        $this->session->set_userdata('mp_point1',$mp_point1);
        $this->session->set_userdata('video_image',$video_image[0]);
        $this->session->set_userdata('advertise_id',$advertise_id);
        $this->session->set_userdata('ads_type',$ads_type);
        $this->session->set_userdata('advertise',$advertise);
        $this->session->set_userdata('previousPlayer',$previous_player);
        $this->session->set_userdata('quizId',$quiz_id);

        echo $html;

    }

    function trackClick() {
        $banner_id = $this->input->post('banner_id');
        $ads_type = $this->input->post('ads_type');
        $this->Quiz_model->set_track_click($ads_type);
        
    }

    function showUserScore() {
        $score_type = $this->input->post('score_type');
        $score = $this->Member_model->get_user_score($this->session->userdata('wannaquiz_user_id'), $score_type);
        $answer = $this->Member_model->get_user_answer($this->session->userdata('wannaquiz_user_id'), $score_type);
        $sql = "SELECT user_id,username FROM tbl_members where user_id=".$this->session->userdata('wannaquiz_user_id');
        $query=$this->db->query($sql);
        $data=$query->row();
        $name = $data->username;
        $score_html .= '<div class="content_wrap">
									<div class="gameleftside" style="padding-right:10px;">
										<div class="name_bg">'.$name.'</div>
									</div>
									<div class="gameleftside">
										<div class="padding_10top font11">answered '.$answer.' questions and scored '.$score.' points</div>
									</div>
									<div class="clear"></div>
								</div>';
        //$status = "'initial'";
        $html='<div id="game_wrap">
                                        	<div id="game_bg">

                                            	<div class="content_10box">
                                                	<div class="content_wrap">
                                                        <div class="gameleftside" style="padding-right:10px;"><div class="bold font14">'.ucfirst($score_type).' Score</div></div>
                                                        <div class="gamerightside">
                                                            <a href="javascript:void(0);" onclick="showAnswerResult();">Play Further</a>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                    <div style="height:217px; overflow:auto;">
													'.$score_html.'
													</div>
                                                </div>
                                            </div>
                                        </div>';
        echo $html;
    }

    function showMultiScore() {
        $score_html = '';
        $winner = '';
        $multiplayer = $this->session->userdata('multiplayer');
        $total_user_point = array();
        $type=$this->input->post('type');
        $quiz_id=$this->input->post('quiz_id');
        $previous_player = $this->input->post('previous_player');
        $this->session->set_userdata('previous_player',$previous_player);

        $onclick1 = "showMultiScore('total',".$quiz_id.",'".$previous_player."')";

        foreach($multiplayer as $mp) {
            $mp_id = $this->Member_model->get_multiplayer_id_by_name($this->session->userdata('wannaquiz_user_id'), $mp);
            if($type=="total") {
                $mp_point = $this->Member_model->get_multiplayer_total_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
                $mp_answer = $this->Member_model->get_multiplayer_total_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);
                $type_status=" over all ";
                $score_type= "Total";
            }
            else {
                $mp_point = $this->Member_model->get_multiplayer_today_point($this->session->userdata('wannaquiz_user_id'), $mp_id);
                $mp_answer = $this->Member_model->get_multiplayer_today_answer($this->session->userdata('wannaquiz_user_id'), $mp_id);
                $type_status=" today's ";
                $score_type= "Today's";
            }
            //$winner_id = $this->Member_model->get_multiplayer_winner($this->session->userdata('wannaquiz_user_id'), $mp_id);
            $score_html .= '<li><div class="content_wrap">
                                    <div class="gameleftside" style="padding-right:10px;">
                                            <div class="name_bg">'.$mp.'</div>
                                    </div>
                                    <div class="gameleftside">
                                            <div class="padding_10top font11">answered '.$mp_answer.' questions and scored '.$mp_point.' points</div>
                                    </div>
                                    <div class="clear"></div>
                            </div></li>';
            $total_user_point[$mp] = $mp_point;
        }
        arsort($total_user_point);
        $total = "'total'";
        $single = "'single'";
        foreach($total_user_point as $key=>$value) {
            $winner .=  '   <div class="padding_10top font11" style="position:absolute; bottom:10px; float:left">
                                <div>'.$key.' is '.$type_status.' winner with '.$value.' points</div>
                                <div>Your score has been saved.</div>
                                <div>Thanks for playing!</div>
                            </div>
                            <div style="text-align:right">
                                <a id="score" href="javascript:void(0);" onclick="'.$onclick1.'">Total Score</a><br>
                                <a href="javascript:void(0);" onclick="selectPlayers('.$single.')">'.$this->session->userdata("wannaquiz_username").'</a>
                                ';
            break;
        }

        $html='<div id="game_wrap">
                                        	<div id="game_bg">

                                            	<div class="content_10box">
                                                	<div class="content_wrap">
                                                        <div class="gameleftside" style="padding-right:10px;"><div class="bold font14">'.$score_type.' Score</div></div>
                                                        <div class="gamerightside">
                                                            <a href="javascript:void(0);" onclick="showAnswerResultMulti('.$quiz_id.',\'play_further\');">Play Further</a>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                    <div style="height:217px; overflow:hidden;">
                                                        <div>
                                                            <ul id="mycarousel1" class="jcarousel-skin-tango">
                                                                '.$score_html.'
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    '.$winner.'

                                                </div>
                                            </div>
                                        </div>';
        echo $html;
    }

    function showPlayerOptions() {

        $html='<div id="game_wrap">
                                        	<div id="game_bg">                                                
                                            	<div class="content_wrap">

                                                        	<div class="lightblue_bg">
                                                            	<div style="height:60px;">
                                                            		<div class="content_10box bold">
                                                                    	WannaQuiz can remember the score for up to eight players.
Note: multiplayer scores are saved and viewable here, not displayed on your profile page.
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </div>
                                            	<div class="content_10box">
                                                	<div>
                                                        <div class="formleft"><div class="font14 bold">Keep Score for:</div></div>
                                                        <!--<div class="formright"><a href="#">Help</a></div>-->
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="content_10box">
                                                    	<div class="padding_10topbottom">
                                                			<div class="singleperson_icon"><a href="javascript:void(0);" onclick="selectPlayers(\'single\')"><span>One Player</span></a> </div>
                                                        </div>

                                                    	<div class="padding_10topbottom">
                                                			<div class="moreperson_icon"><a href="javascript:void(0);" onclick="selectPlayers(\'multi\')"><span>More Players</span></a></div>
                                                        </div>
                                                    </div>
                                                    <div style="position:absolute; bottom:10px; right:20px;">
                                                            	<div class=""><a href="'.base_url().'home/help_center">Help</a></div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>';

        echo $html;

    }

    function selectPlayers() {
        $this->load->model('Member_model');
        $play_mode=$this->input->post('type');



        if($play_mode=='single') {
            $this->session->set_userdata('game_mode', 'single');
            $this->showAnswerResult('initial');

        }else {

            $friends=$this->Member_model->get_multiplayer($this->session->userdata('wannaquiz_user_id'),8,0);
            $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                            	<div class="content_wrap">

                                                        	<div class="lightblue_bg">
                                                            	<div style="height:60px;">
                                                            		<div class="content_10box bold">
                                                                    	WannaQuiz can remember the score for up to eight players.
Just click the checkboxes and replace \'player...\' with any name you want.
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </div>
                                            	<div class="content_10box">
                                                	<div class="moreperson_icon"><a href="#">More Players</a></div>
                                                    <div class="content_10box">
                                                    	<form name="group_game_form" action="" method="post">
                                                        	<div class="formleft">';
            $i=0; $m=1;
            if(!empty($friends)) {
                $output = array_slice($friends,0,4);
            }
            $remaining = 4-count($output);
            if(!empty($output)) {
                foreach($output as $row) {
                    $html.='<div class="input_clear">
                                                                	<input type="text" class="textbox" name="group_member_tb" value="'.$row->multiplayer_name.'" style="width:175px;" readonly/>
                                                                    <input type="checkbox" name="group_member" value="'.$m.'" />
                                                                </div>';
                    $i++; $m++;
                }
            }
            for($j=1;$j<=$remaining;$j++) {
                $html.='<div class="input_clear">
                                                                	<input type="text" class="textbox" name="group_member_tb" value="Player '.$m.'" style="width:175px;" />
                                                                    <input type="checkbox" name="group_member" value="'.$m.'" />
                                                                </div>';
                $m++;
            }

            $html.='</div>
															<div class="formright">';
            if(!empty($friends)) {
                $output_right = array_slice($friends,4);
            }
            $remaining_right = 4-count($output_right);
            if(!empty($output_right)) {
                foreach($output_right as $row) {
                    $html.='<div class="input_clear">
                                                                	<input type="text" class="textbox" name="group_member_tb" value="'.$row->multiplayer_name.'" style="width:175px;" readonly/>
                                                                    <input type="checkbox" name="group_member" value="'.$m.'" />
                                                                </div>';
                    $m++;

                }
            }
            for($k=1;$k<=$remaining_right;$k++) {
                $html.='<div class="input_clear">
                                                                	<input type="text" class="textbox" name="group_member_tb" value="Player '.$m.'" style="width:175px;" />
                                                                    <input type="checkbox" name="group_member" value="'.$m.'" />
                                                                </div>';
                $m++;
            }
            $html.='
                                                            </div>
                                                            <div class="clear"></div>
                                                        </form>
                                                    </div>
                                                    <div class="text_right">
                                                    	<a href="javascript:void(0);" id="" onclick="show_player_option();">Back</a>&nbsp;|&nbsp;<a href="'.base_url().'home/help_center">Help</a>&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="saveSettings()">Save Setting</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>';


        }

        echo $html;

    }

    function getRandomQuestion() {
        $quiz_level=$this->input->post('quiz_level');
        $cat_ids=$this->input->post('cat_ids');
        $quiz_type=$this->input->post('quiz_type');
        $this->session->set_userdata("cat_id",$cat_ids);
        $quiz_info=$this->Quiz_model->getRandomQuizByCategories($quiz_level,$cat_ids,$quiz_type);
        $quiz_id=$quiz_info->quiz_id;
        $category_id = $quiz_info->category_id;
        $this->session->set_userdata('random_category_id',$category_id);

        if(empty($quiz_info)) {
            $html='<div id="game_wrap">
                                        	<div id="game_bg">
                                            	<div class="content_10box">
                                                	<div class="content_wrap">
                                                    	<div class="font20 text_center" style="padding-top:110px;">Sorry, No quiz is available in this category!
														</div></div></div></div>';
        }
        else {
            $sql = "SELECT q.quiz_id,q.quiz_question,o.option1,o.option2,o.option3 FROM tbl_quizes q,tbl_quiz_options o WHERE o.quiz_id=q.quiz_id AND q.quiz_id=".$quiz_id;
            $query=$this->db->query($sql);
            $data=$query->row();
            $html=' <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="490" HEIGHT="334" id="banner_rotativo" ALIGN="">

										<PARAM NAME=movie VALUE="'.base_url().'video_question.swf?q='.$quiz_id.'">
										<PARAM NAME=quality VALUE=high>
										<PARAM NAME=bgcolor VALUE=#3399CC>
										<PARAM NAME="WMode" VALUE="opaque">
										<param name="allowScriptAccess" value="sameDomain" />
										<EMBED wmode="opaque" src="'.base_url().'video_question.swf?q='.$quiz_id.'" quality=high bgcolor=#3399CC WIDTH="490" HEIGHT="334" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
						 </OBJECT>*<div class="content_10box">
												<div style="width:350px; margin:0 auto;">
													<div style="border:1px solid #CCFFFF;">
														<div class="content_10box">
											<div class="color_blue bold">WannaQuiz question in Written Form:</div>

											<div class="padding_10topbottom">'.$data->quiz_question.'</div>
											<div>
												<span class="color_blue">A)</span> <span>'.$data->option1.'&nbsp;</span>
												<span style="color:red;">B)</span> <span>'.$data->option2.'&nbsp;</span>
												<span class="color_green">C)</span> <span>'.$data->option3.'&nbsp;</span>
											</div>
														</div>
													</div>
												</div>
											 </div>';
        }

        echo $html;
    }

    function saveSettings() {
        $this->session->set_userdata('game_mode', 'multi');
        $this->session->unset_userdata('previous_player');
        $user_id = $this->session->userdata('wannaquiz_user_id');
        //$member_ids=$this->input->post('member_ids');
        //$member_ids=rtrim($member_ids,',');
        $member_names=$this->input->post('member_names');
        $member_names=rtrim($member_names,',');
        $multiplayer_list = explode(",",$member_names);
        $multiname = array_reverse($multiplayer_list);
        $this->session->set_userdata(array('multiplayer'=>$multiname));
        foreach($multiname as $multi) {
            $multiname_exist=$this->Member_model->get_multiplayer_by_name($this->session->userdata('wannaquiz_user_id'),$multi);
            if(!$multiname_exist) {
                $data=array('user_id'=>$user_id,'multiplayer_name'=>$multi);
                $this->db->insert('tbl_multiplayer',$data);
            }
        }

        $this->session->unset_userdata('player_id');

        $this->showAnswerResult('initial');
        echo $html;

    }

    function quizesByCategory() {
        $quiz_data = $this->Quiz_model->get_quizes_by_category_subcategory();
        if(count($quiz_data)>0) {
            foreach($quiz_data as $result) {
                $message.= '<option value='.$result->quiz_id.'>'.$result->quiz_question.'</option>' ;
        }}
        echo $message;
    }

    function get_perfect_score_A() {
        $this->Quiz_model->get_perfect_score_A($this->session->userdata('wannaquiz_user_id'));
    }
    function get_perfect_score_H() {
        $this->Quiz_model->get_perfect_score_H($this->session->userdata('wannaquiz_user_id'));
    }

    function get_milestone_award() {
        $this->Quiz_model->get_milestone_award(8);
    }

    function get_question_by_quiz_id() {
        $quiz_id= $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->get('tbl_quizes');
        if($query->num_rows()>0)
            echo $question = $query->row()->quiz_question;

    }

    function get_quiz_long_answer() {
        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->get('tbl_quizes');
        if($query->num_rows()>0)
            echo $question = $query->row()->quiz_long_answer;
    }

    function deleteFavourites() {
        $quizid= $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quizid);
        $query =$this->db->delete('tbl_quiz_favourites');
        if($query)
            echo "success";
        else echo "error";
    }

    function quizmachine() {
        $this->load->view('example.html');
    }

    function generate_quiz_by_machine($div_id) {
        $data = explode("_",$div_id);
        $category = $data[1];
        $level = $data[2];
        if($category!='Unknown') {
            $row = $this->Category_model->get_four_categories($category);
            $category_id = $row->id;

            $result = $this->Quiz_model->search_by_category($level,$category_id,'');
        }
        else
            $result=$this->Quiz_model->getRandomQuiz($quiz_level);
        $quiz_id = $result->quiz_id;
        if($quiz_id=='') {
            $this->session->set_userdata('no_quiz','No Quiz Remaining!');
            redirect(site_url(''));
        }
        else
            redirect(site_url('quiz/view/'.$quiz_id));
    }

    function add_quiz_success() {
        $data['invoice'] = $_POST['invoice'];
        $data['quiz_id'] = $_POST['item_id'];
        $data['main'] = 'quiz/add_photo_quiz_success_msg';
        $this->load->view('quiz_home',$data);

    }

    function getCategoryDetailByProductId() {
        $product_id = $this->input->post('product_id');
        $category_id = $this->input->post('category_id');
        $sub_category_id = $this->input->post('sub_category_id');
        $category_info = $this->Category_model->get_category_by_id($category_id);
        $checked = '';
        $checked1 = '';
        //$subcategory = $this->Category_model->get_sub_categories($category_id);

        
        //if($category_info->parent_id=='0')
//        if($sub_category_id!='0') {
//            $subcategory_info = $this->Category_model->get_category_by_id($sub_category_id);
//
//            $message.=    '<div style="height:22px"><input type="radio" name="category" style="margin-left:0px" class="unique"  value="'.$subcategory_info->id.'"/> <label style="width:200px;">'.$subcategory_info->name.'</label>
//                            <label>CPC <span class="color_green bold">'.$subcategory_info->cpc.'</span></label>
//                            <div class="clear"></div></div>
//                       ';
//        }
//        else
        //{ echo $category_id;
         //echo $sub_category_id.'*';
        if($sub_category_id=='')
        $checked = 'checked';

            $message=' <div class="quizmakingform_radio ">
                       <div style="height:22px"><input type="radio" name="category" class="unique" value="'.$category_info->id.'" '.$checked.'/> <label style="width:200px;">'.$category_info->name.'</label>
                        <label>CPC <span class="color_green bold">'.$category_info->cpc.'</span></label><div class="clear"></div></div>';
            $subcategory = $this->Category_model->get_sub_categories($category_id);
            
            if($subcategory)
            {
                foreach($subcategory as $subcategories) {
                    //echo $subcategories->id.'/'.$sub_category_id.',';

                    if($sub_category_id == $subcategories->id){
                        $checked1 = 'checked';
                    }
                    else $checked1 = '';
                    $message.=    '<div style="height:22px"><input type="radio" name="category" style="margin-left:0px" class="unique" '.$checked1.'  value="'.$subcategories->id.'"/> <label style="width:200px;">'.$subcategories->name.'</label>
                                <label>CPC <span class="color_green bold">'.$subcategories->cpc.'</span></label>
                                <div class="clear"></div></div>
                           ';

                }
            }
        //}
//        else {
//            $message=' <div class="quizmakingform_radio ">
//                       <div style="height:22px"><input type="radio" name="category" class="unique" value="'.$category_info->id.'"/> <label style="width:200px;">'.$category_info->name.'</label>
//                        <label>CPC <span class="color_green bold">'.$category_info->cpc.'</span></label><div class="clear"></div></div>';
//            $subcategory = $this->Category_model->get_sub_categories($category_info->parent_id);
//            foreach($subcategory as $subcategories) {
//                if($category_id == $subcategories->id)
//                $checked = 'checked';
//                else $checked='';
//                $message.=    '<div style="height:22px"><input type="radio" name="category" style="margin-left:0px" class="unique" '.$checked.'  value="'.$subcategories->id.'"/> <label style="width:200px;">'.$subcategories->name.'</label>
//                            <label>CPC <span class="color_green bold">'.$subcategories->cpc.'</span></label>
//                            <div class="clear"></div></div>
//                       ';
//
//            }
//        }
        $message.='</div>';
        echo $message;
    }

    function upload_banners($id,$banner_id) {
        $image_info=$this->upload_files('userfile_'.$id);
        $image_name = $image_info['file_name'];
       // print_r($image_info);
       if($image_info ['is_image']==1){
        if($banner_id!=0) {
            $this->db->where('banner_id',$banner_id);
            $query = $this->db->get('tbl_advertiser_banner_ads');
            if($query->num_rows()>0) {
                $result = $query->row();
                if(file_exists("advertiser_banners/".$result->banner_image))
                    unlink("advertiser_banners/".$result->banner_image);

                if(file_exists("advertiser_banner_thumbs/".$result->banner_image))
                    unlink("advertiser_banner_thumbs/".$result->banner_image);
            }

            $this->db->where('banner_id',$banner_id);
            $this->db->update('tbl_advertiser_banner_ads',array('banner_image'=>$image_name));
            $banid = $banner_id;
        }
        else {
            $quiz_id = $this->session->userdata('quiz_id');
            $user_id = $this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_advertiser_banner_ads',array('banner_image'=>$image_name,'advertiser_id'=>$user_id,'quiz_id'=>$quiz_id));

            $new_banner_id= $this->db->insert_id();
            $banid = $new_banner_id;
        }
        $data=$image_name.'|';
        $data.=$id.'|';
        echo $data.=$banid;
        //create thumbnail
        image_thumb('advertiser_banners/'.$image_info['file_name'],'advertiser_banners/advertiser_banner_thumbs',$image_info['file_name'],365,170);
         }
     else echo "null";
    }
   

    function upload_file($file) {
        $config['upload_path'] ='./advertiser_banners/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']= '3000';
        $config['max_width']  = '';
        $config['max_height']  = '';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
         return $data;
    }
     function upload_files($file) {
        $config['upload_path'] ='./advertiser_banners/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']= '3000';
        $config['max_width']  = '160';
        $config['max_height']  = '600';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
         return $data;
    }

    function report_quiz() {
        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',array('status'=>'0'));
        $report = $this->input->post('report');
        //echo $reporter_id = $this->input->post('reporter_id');
        $data = $this->Quiz_model->quiz_report();
        if($data)
            echo "success";
        else echo "error";
    }

    function activeQuiz() {
        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->update('tbl_quizes',array('status'=>'1','modified_date'=>$this->get_current_gmdate("Y-m-d H:i:s",gmdate("H"),gmdate("i"),gmdate("s"))));
        if($query) echo 'success';
        else echo 'error';
    }

    function deactiveQuiz() {
        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->update('tbl_quizes',array('status'=>'0','modified_date'=>$this->get_current_gmdate("Y-m-d H:i:s",gmdate("H"),gmdate("i"),gmdate("s"))));
        if($query) echo 'success';
        else echo 'error';
    }

    function featureQuiz() {
        $quiz_id = $this->input->post('quiz_id');
        $status = $this->input->post('status');
        if($status == 'yes')
            $status_value = '1';
        else $status_value = '0';
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->update('tbl_quizes',array('featured_quiz'=>$status_value,'modified_date'=>$this->get_current_gmdate("Y-m-d H:i:s",gmdate("H"),gmdate("i"),gmdate("s"))));
        if($query) echo 'success';
        else echo 'error';
    }



    function tryNewQuiz() {

        $quiz_id = $this->input->post('quiz_id');
        $status = $this->input->post('status');
        if($status == 'yes')
            $status_value = '1';
        else $status_value = '0';
        //echo $status_value; exit;
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->update('tbl_quizes',array('try_new_quiz'=>$status_value,'modified_date'=>$this->get_current_gmdate("Y-m-d H:i:s",gmdate("H"),gmdate("i"),gmdate("s"))));
        if($query) echo 'success';
        else echo 'error';
    }

    function set_selected_category() {
        $category = $this->input->post('category_name');
        $class = $this->input->post('class_color');
        $this->session->set_userdata('selected_cat',$category);
        $this->session->set_userdata('selected_cat_class',$class);
    }

    function set_playlist_session() {
        $this->session->unset_userdata('set_playlist_quiz_user');
        $this->session->unset_userdata('set_playlist_quiz');
        $input_data = $this->input->post('playlist');
        $user_id = $this->input->post('user_id');
        $this->session->set_userdata('set_playlist',$input_data);
        $user_playlist1 = $this->Quiz_model->get_playlist($user_id);
        $data['user_playlist'] = $user_playlist1;
        //print_r($data['user_playlist']); //exit;
        $quiz_id = $this->input->post('quiz_id');
        $data['user'] = $this->Quiz_model->get_user_by_quizid($quiz_id);
        $this->load->view('quiz/user_playlist',$data);
    }

    function playlist_quiz_click_ses() {
        $user_id = $this->input->post('user_id');
        $quiz_id = $this->input->post('quiz_id');
        $playlist_id = $this->input->post('playlist');
        $this->session->set_userdata('set_playlist','playlist');
        $this->session->set_userdata('set_playlist_id',$playlist_id);
        if($this->session->userdata('set_playlist_quiz_user')=='') {
            $this->session->set_userdata('set_playlist_quiz_user',$user_id);
            $this->session->set_userdata('set_playlist_quiz',$quiz_id);}
    }

    function fifty_user_category() {
        $data = $this->Quiz_model->get_fifty_users_per_category();
        echo 'heelloo';
        echo '<pre>'; print_r($data);exit;
    }

    function testVideoLength(){
        $this->load->helper('videoconversion_helper');
        $question_file_name = $this->input->post('video_question');
        $answer_file_name = $this->input->post('video_answer');
        $inputpath='uploaded_videos';
        $question_video_length = video_length($inputpath,$question_file_name);
        $answer_video_length = video_length($inputpath,$answer_file_name);
        if($question_video_length > '00:00:20.00')
        echo "%question_error";
        else echo "%question_success";

        echo "%";

        if($answer_video_length > '00:00:25.00')
        echo "answer_error%";
        else echo "answer_success%";
    }
    
     function get_cities()
    {
       $countriesArr = array(); 
       $statesArr=array();
       $country_code=$this->input->post('country');
       $state_code=$this->input->post('state_code');
       $countriesArr = explode("|||", $country_code);
       $statesArr = explode("|||", $state_code);
//       echo "<pre>";
//       print_r($countriesArr);
//       print_r($statesArr);
          $cities =$this->Country_management_model->get_city($countriesArr,$statesArr);
            
             
         
                $options = '<select name="city[]" class="right_input" id="city" multiple="multiple">            
            ';
        
        if($cities)
        {
           //$options .= '<option value="">- Select City -</option>';
            
            foreach($cities as $row)
              $options .= '<option value="' . $row['city_name'] . '">' . $row['city_name'] . '</option>';                
            
        }
        else{
            $options .= '<option value="">- None -</option>';
        
        $options .= '</select>';
        }
        echo $options;
      }
          
   

   function get_states()
     {
       $countriesArr = array(); 
       $country_code=$this->input->post('term');

       $countriesArr = explode("|||", $country_code);
      
       $states =$this->Country_management_model->get_state($countriesArr);
       //print_r($row);
      
       $options = '<select name="state[]" class="right_input"  id="state" onchange="dochanges(this.value);" multiple="multiple" >            
            ';
        
        if($states )
        {
            echo '<label  class="left_label">State / Region ( separate by commas)</label>';
//            $options .= '<option value="">- Select State -</option>';
            
            foreach($states as $row)
                 $options .= '<option value="' . $row['state_name'] . '">' . $row['state_name'] . '</option>';                
        }
        else{
            $options .= '<option value="">- None -</option>';
        
        $options .= '</select>';
        }
        echo $options;
 
         
   }

  
}
?>
