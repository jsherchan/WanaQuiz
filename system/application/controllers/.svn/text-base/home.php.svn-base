<?php
class Home extends Front_controller {
    function Home() {
        parent::Front_controller();
        $this->load->library('parser');
       $this->load->model('Media_model');
       $this->load->model('country_management_model');
# twitter libary
        // It really is best to auto-load this library!
        $this->load->library('tweet');
       
      
        // Enabling debug will show you any errors in the calls you're making, e.g:
        $this->tweet->enable_debug(TRUE);
        #echo date('d m y','1314806824');exit;
    }

    function get_average_rating($id)
    {
        return $this->Media_model->calculate_total_rating($id);
    }
    
    function index($offset=0) {
      
        $this->load->model('Quiz_model');
        $this->load->model('Member_model');
        $this->load->model('Media_model');
        $this->load->model('Category_model');
        $this->load->model('Advertise_management_model');
        $this->checkSiteOnline();
        $this->checkBlockedIp();
       
        //$this->session->unset_userdata('previous_player');
        //$this->session->unset_userdata('game_mode');

        //echo $this->session->userdata('game_mode');
        $this->load->library('Jquery_pagination');
        $data['title']='website under construction';
        $data['flg']='home';
        $data['main']='include/home_body';
        $feat_videos=$this->Media_model->getFeaturedVideos();
        $featured_questions=$this->Media_model->getFeaturedQuestions();
        $data['categories']=$this->Category_model->get_categories();
        $data['message_list']=$this->Member_model->mail_received();
        
        $user_id = $this->session->userdata('wannaquiz_user_id');
        if($user_id) 
        {
            $data['total_points']=$this->Quiz_model->getUserTotalScoredBonusPoints($this->session->userdata('wannaquiz_user_id'));
            $data['total_answered']=$this->Quiz_model->getUserTotalQuestionsAnswered($this->session->userdata('wannaquiz_user_id'));
            
            $filter = $this->Member_model->get_filter($user_id);
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');            
            else $this->session->unset_userdata('filtered');

            $data['filter'] = $filter;        
        }
        
/* pagination starts here */        
        $config['base_url'] = site_url('home/featured_video_pagination');		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */
        $config['div'] = '#featured_video_pagination';		/* CSS selector  for the AJAX content */
        $limit = 2;
        
         # get ids and average points for featured video
        if(count($feat_videos)>0)
        {
            $com1 = '';

        foreach($feat_videos as $videos) 
        {
            $avg_rating_video=$this->Quiz_model->calculate_total_rating($videos->quiz_id); 
            $com1 .= $videos->quiz_id . '#' . $avg_rating_video . '~';
        }

        $com1 = "'" . rtrim($com1,'~') . "'";
        }
        
         # get ids and average points
        if(count($featured_questions)>0)
        {
            $com2 = '';

        foreach($featured_questions as $videos) 
        {
            $avg_rating_video=$this->Quiz_model->calculate_total_rating($videos->quiz_id); 
            $com2 .= $videos->quiz_id . '#' . $avg_rating_video . '~';
        }

        $com2 = "'" . rtrim($com2,'~') . "'";
        }
         
        $config['total_rows'] = count($feat_videos);
        $config['per_page'] = $limit;       
$config['js_rebind'] = "showRating('rate_video_'," . $com1 . ");";
        $this->jquery_pagination->initialize($config);
        $data['com1'] = $com1;
        $data['pagination'] =  $this->jquery_pagination->create_links();
        $data['feat_videos'] = $this->Media_model->getFeaturedVideos($limit,$offset);
        /* first pagination ends here */
        
        $config1['base_url'] = site_url('home/featured_question_pagination');		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */
        $config1['div'] = '#featured_question_pagination';		/* CSS selector  for the AJAX content */
        $limit = 3;
        $config1['total_rows'] = count($featured_questions);
        $config1['per_page'] = $limit;
#$config1['js_rebind'] = "alert('works')";
$config1['js_rebind'] = "showRating('rate_'," . $com2 . ");";        
        $this->jquery_pagination->initialize($config1);
        $data['com2'] = $com2;
        $data['pagination1'] =  $this->jquery_pagination->create_links();
        $data['featured_questions'] = $this->Media_model->getFeaturedQuestions($limit,$offset);
        
        /* second pagination ends here */

        $data['admin_rectangular_ads'] = $this->Advertise_management_model->get_rectangular_admin_home_ads();        
        $this->load->view("index",$data);
        
    }

    function twitter()
    {   
        
        /*$details_url = 'http://api.twitter.com/oauth/request_token';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $info = curl_exec($ch);
        echo $info; 
        
        
        die('Curl not working');*/
        
        if ( !$this->tweet->logged_in() )
        {
            //echo "I am herer";
            //exit;
            $this->tweet->set_callback(site_url('home/auth'));
            
            $this->tweet->login();
           
        }
        else 
        {
            //die("I am not herer");
            $this->auth();
            
        }
    }
    
    function auth()
    {
        $this->load->model('Twitter_model');

/*    
        if(!$this->_site_info->oauth_token)
        {
            var_dump($tokens);
        }
        exit;
        // You can set these tokens before calling logged_in to try using the existing tokens from the database
        #$tokens = array('oauth_token' => '360652365-xKVJurQMwVJX6UNAGxx1NZf05U3XSMAQbdBqeBAc', 'oauth_token_secret' => 'U7EGaCuJ2dNs1QwhFTSpPBagE3ZTZkHJDt0qHUvQjc');
        $this->tweet->set_tokens($tokens);
  */      
        
        $tokens = $this->tweet->get_tokens();
#var_dump($tokens);
            // Will throw an error with a stacktrace.
        $final = $this->tweet->call('get', 'account/verify_credentials');
#print_r($me);
#echo '<br /><br /><br />';
        $me = (array) $final;
#var_dump($me);
#exit;
        $isOurUser=$this->Twitter_model->isOurUser($me['id']);
        
        if($isOurUser=='new') 
        { 
            $user_id =  $this->Twitter_model->create_user($me);            
            $first_name=$this->Twitter_model->getUser_firstname($user_id);               
               $data = array(
                           'wannaquiz_user_id' => $user_id,
                           'wannaquiz_tw_id' => $user_id,
                           'first_name' =>$first_name,
                           'wannaquiz_username'=>$me['screen_name']
                       );
               $this->session->set_userdata($data);               
               $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_user_id'),$_SERVER['REMOTE_ADDR'],'Login');              
               redirect('member/userHome');
               
        }elseif($isOurUser=='old') {                       
               $user_id= $this->Twitter_model->get_user_id($me['id']);               
               $first_name=$this->Twitter_model->getUser_firstname($user_id);
               $data = array(
                           'wannaquiz_user_id' => $user_id,
                           'wannaquiz_fb_id' => $user_id,
                            'wannaquiz_tw_id'=>$user_id,
                           'first_name' =>$first_name,
                           'wannaquiz_username'=>$me['screen_name']
                       );
               $this->session->set_userdata($data);               
               $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_user_id'),$_SERVER['REMOTE_ADDR'],'Login');
               
               redirect('member/userHome');
        }
    }
    
    function facebook($msg='') {
        $this->load->library('session');
        $this->load->model('Facebook_model');
        $this->load->library('facebook/facebook');
        
        // Create our Application instance (replace this with your appId and secret).
        if($_SERVER['SERVER_NAME']=='www.proshore.eu' || $_SERVER['SERVER_NAME']== 'proshore' || $_SERVER['SERVER_NAME']== 'proshore.eu') 
        {
            $facebook = new Facebook(array(
            'appId'  => '259709940719350',
            'secret' => 'ecd76f55e52bbd32988f17b516efdbbc',
            'cookie' => true,
            ));
        }
        
        else if($_SERVER['SERVER_NAME']=='www.wannaquiz.com' || $_SERVER['SERVER_NAME']== 'wannaquiz' || $_SERVER['SERVER_NAME']== 'wannaquiz.com') 
        {
            $facebook = new Facebook(array(
            'appId'  => '265236566837613',
            'secret' => '23cadc82b7bfbf4cfcf0efaa2dd55dc2',
            'cookie' => true,
            ));
        }
        else {
            $config['appId']='265236566837613';
            $config['sectet']='23cadc82b7bfbf4cfcf0efaa2dd55dc2';
            $config['cookie']=true;
            $facebook=new Facebook($config);       
              }
            $fbUser = $facebook->getUser();
        
         
       
        if ($fbUser) {
            try {
                $uid = $facebook->getUser();
                $me = $facebook->api('/me');
                //echo "<pre>";
               // print_r($me); exit;
            } catch (FacebookApiException $e) {
                error_log($e);
            }
        }
        else {
            $fbUrl = $facebook->getLoginUrl(array('scope' => 'email,offline_access'));
            redirect($fbUrl);
            
        }
      //  var_dump($session);
      //  echo '<pre>';
      //  print_r($me);
      //  echo '</pre>';
      //  exit;

        $isOurUser=$this->Facebook_model->isOurUser($me['id']);

        if($isOurUser=='new') {           
            $user_id=  $this->Facebook_model->create_user($me);        
               $first_name=$this->Facebook_model->getUser_firstname($user_id);               
               $data = array(
                           'wannaquiz_user_id' => $user_id,
                           'wannaquiz_fb_id' => $user_id,
                           'first_name' =>$first_name,
                           'wannaquiz_username'=>$me['id']
                       );
               $this->session->set_userdata($data);               
               $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_user_id'),$_SERVER['REMOTE_ADDR'],'Login');              
               redirect('member/userHome');
               
        }elseif($isOurUser=='old') {                       
               $user_id= $this->Facebook_model->get_user_id($me['id']);               
               $first_name=$this->Facebook_model->getUser_firstname($user_id);
               $data = array(
                           'wannaquiz_user_id' => $user_id,
                           'wannaquiz_fb_id' => $user_id,
                           'first_name' =>$first_name,
                           'wannaquiz_username'=>$me['id']
                       );
               $this->session->set_userdata($data);               
               $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_user_id'),$_SERVER['REMOTE_ADDR'],'Login');
               
               redirect('member/userHome');
        }
        else redirect('home/login');
    }
    
    
    function login($redirect_url='') {
/*
 * setup login for facebook connect
// */
         $this->load->library('facebook/facebook.php');
if($_SERVER['SERVER_NAME']!='localhost')
{
        

        // Create our Application instance (replace this with your appId and secret).
        if($_SERVER['SERVER_NAME']=='www.proshore.eu' || $_SERVER['SERVER_NAME']== 'proshore' || $_SERVER['SERVER_NAME']== 'proshore.eu') 
        {
            $facebook = new Facebook(array(
            'appId'  => '259709940719350',
            'secret' => 'ecd76f55e52bbd32988f17b516efdbbc',
            'cookie' => true,
            ));
        }
        
        else if($_SERVER['SERVER_NAME']=='www.wannaquiz.com' || $_SERVER['SERVER_NAME']== 'wannaquiz' || $_SERVER['SERVER_NAME']== 'wannaquiz.com') 
        {
            $facebook = new Facebook(array(
            'appId'  => '265236566837613',
            'secret' => '23cadc82b7bfbf4cfcf0efaa2dd55dc2',
            'cookie' => true,
            ));
        }
        else {
            $config['appId']='265236566837613';
            $config['secret']='23cadc82b7bfbf4cfcf0efaa2dd55dc2';
            $config['cookie']=true;
            $facebook=new Facebook($config);
           }
           
         $session = $facebook->getUser();

        $me = null;
        // Session based API call.
        if ($session) {
            try {
                $uid = $facebook->getUser();
                $me = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
            }
        }

        // login or logout url will be needed depending on current user state.
        if ($me) {
            $data['fb_status']='loggedin';
            $logoutUrl = $facebook->getLogoutUrl();
        } else {
            $data['fb_status']='0';
            $loginUrl = $facebook->getLoginUrl();
        }

        // This call will always work since we are fetching public data.
        $loginUrl = $facebook->getLoginUrl();        
        $data['appId']=$facebook->getAppId();
        $data["session"]= $session;
        $data["me"]= $me;
        $data["logoutUrl"]= $logoutUrl;
        $data["loginUrl"]= $loginUrl;
        $data["uid"]= $uid;        
/*
 * end for facebook connect
 */
}    
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data['title']='Wannaquiz Login';
            $data['main']='include/login';

            $data['redUrl']=$redirect_url;
            $this->load->view("index",$data);
        }
        else {
            $user_id = $this->User_model->login_front($this->input->post('username',TRUE), $this->input->post('password',TRUE), $this->input->post('user_type',TRUE), $this->input->post('user_type1',TRUE));
            
            if($user_id != 0) {
                $this->session->set_userdata(array('wannaquiz_user_id' => $user_id));
                $user_info=$this->User_model->getUser_details($user_id);
                $user_address=$this->User_model->getUser_address($user_id);
                $user_addressCountryState=$this->Country_management_model->getUser_address($user_id);
                list($countryCode, $stateCode) = explode('{}',$user_addressCountryState);
                $_SESSION['city_target']=$user_address->city;
                $_SESSION['state_target']=$countryCode;
                $_SESSION['country_target']=$stateCode;
                $this->session->set_userdata(array('first_name' =>$user_info->first_name,'wannaquiz_username'=>$user_info->username));

                // Store Login Activitiy in the Logactivitiy table
                 $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_username'),$_SERVER['REMOTE_ADDR'],'Login');

                $redirect_url= $this->input->post('redUrl',TRUE);

                if($redirect_url!='') {

                    $redirect_url=base64_decode($redirect_url);
                    redirect($redirect_url);
                }
                else {
//                    if($user_info->user_type==0)
//                        redirect(site_url('member'));
//                    else
                        redirect(site_url('member/userHome'));
                }
            }
            else {                
                if($this->input->post('user_type',TRUE)=='0')
                    $this->session->set_flashdata('regular_login_message',"Username and Password doesn't matched!");
                else
                    $this->session->set_flashdata('advertiser_login_message',"Username and Password doesn't matched!");
                redirect('home/login/'.$redirect_url);
            }

        }

    }
    
    function logout() {
    // Store Login Activitiy in the Logactivitiy table
    if($this->session->userdata('wannaquiz_fb_id'))
        $this->logActivity($this->session->userdata('wannaquiz_fb_id'),$this->session->userdata('wannaquiz_fb_id'),$_SERVER['REMOTE_ADDR'],'Logout');
    else
        $this->logActivity($this->session->userdata('wannaquiz_user_id'),$this->session->userdata('wannaquiz_username'),$_SERVER['REMOTE_ADDR'],'Logout');

    //$this->session->unset_userdata(array('wannaquiz_user_id' => ''));
        unset($_SESSION['target_city']);
        $this->session->destroy();
        redirect('home/');
    }

    function relogin($redirect_url='') {
        if($redirect_url!="")
            $data['title']="Please login :wannaquiz";
        else
            $data['title']="Please login with correct username and password :wannaquiz";

        $data['main']="include/login";
        $data['relogin_flag']='1';
        $data['redirect_url']=$redirect_url;
        $this->load->view('index',$data);
    }
    
    function featured_video_pagination($offset=0){
        $this->load->library('Jquery_pagination');
        $feat_videos=$this->Media_model->getFeaturedVideos();
        
# get ids and average points
        if(count($feat_videos)>0)
        {
            $com1 = '';

            foreach($feat_videos as $videos) 
            {
                $avg_rating_video=$this->Media_model->calculate_total_rating($videos->quiz_id); 
                $com1 .= $videos->quiz_id . '#' . $avg_rating_video . '~';
            }

            $com1 = "'" . rtrim($com1,'~') . "'";
        }
        
        $limit = 2;
        $config['base_url'] = site_url('home/featured_video_pagination');
		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */

        $config['div'] = '#featured_video_pagination';
        $config['total_rows'] = count($feat_videos);
        $config['per_page'] = $limit;
$config['js_rebind'] = "showRating('rate_video_'," . $com1 . ")";
        $this->jquery_pagination->initialize($config);
        $data['pagination'] =  $this->jquery_pagination->create_links();
        $data['feat_videos'] = $this->Media_model->getFeaturedVideos($limit,$offset);
        
        $this->load->view('include/home_featuredvideo',$data);
    }

     function featured_question_pagination($offset=0){
        $this->load->library('Jquery_pagination');
        $featured_questions = $this->Media_model->getFeaturedQuestions();
        
        $limit = 3;
        $config1['base_url'] = site_url('home/featured_question_pagination');
		/* Here i am indicating to the url from where the pagination links and the table section will be fetched */        
# get ids and average points
        if(count($featured_questions)>0)
        {
            $com2 = '';

            foreach($featured_questions as $videos) 
            {
                $avg_rating_video=$this->Media_model->calculate_total_rating($videos->quiz_id); 
                $com2 .= $videos->quiz_id . '#' . $avg_rating_video . '~';
            }

            $com2 = "'" . rtrim($com2,'~') . "'";
        }

        $config1['div'] = '#featured_question_pagination';
        $config1['total_rows'] = count($featured_questions);
        $config1['per_page'] = $limit;
$config1['js_rebind'] = "showRating('rate_'," . $com2 . ");";
         $this->jquery_pagination->initialize($config1);
        $data['pagination1'] =  $this->jquery_pagination->create_links();
#$data['a'] = 1;
        $data['featured_questions'] = $this->Media_model->getFeaturedQuestions($limit,$offset);

        $this->load->view('include/home_rightside',$data);
    }

    function userhome() {
        $this->checkMemberLogin();
                $this->load->model('Purchase_credits_settings_model');
        $data['title']='Penny Auction, Iphone,3G, Ipod, Macbook, PS3, Samsung, LCD, win cash,BMW : ebidshopper';
        $data['main']='member/my-profile';
        $data['member_info']=$this->User_model->getUser_details($this->session->userdata('wannaquiz_user_id'));
        $this->load->view("userhome",$data);
    }    

    function forgetpassword() {
        $this->load->model('Member_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exist');
        if ($this->input->post('email',TRUE) == "") {
        //			$data['title']="Auction Site:";
        //			$data['main']="include/forget-password";
        //			$this->load->view('index',$data);
            echo "email_field_required";
        }
        else {
        // do something email thing

            if($this->User_model->check_exist_email($this->input->post('email',TRUE))!='0') {

                $user_id=$this->User_model->check_exist_email($this->input->post('email',TRUE)).'/';

                $password= substr(md5(rand()),0,7);

                $this->email_password($this->input->post('email',TRUE),$user_id,$password);
                $this->reset_password($user_id,$password);
                //			$this->session->set_flashdata('message',$this->lang->line('msg_username_password_sent'));
                //		  	redirect('/home/forgetpassword','refresh');
                echo "password_reset";

            }
            else {
            //            	$this->session->set_flashdata('message',$this->lang->line('msg_no_email_record'));
            //                redirect('/home/forgetpassword','refresh');
                echo "no_email_record";
            }
        }
    }

    function check_email_exist() {
        $sql="select * from tbl_member_profile where email=?";
        $query=$this->db->query($sql,array($this->input->post('email',TRUE)));
        if($query->num_rows()==0) {
            $this->form_validation->set_message('check_email_exist', $this->lang->line('msg_email_not_exist'));
            return false;
        }

        return TRUE;

    }


    function email_password($email,$user_id,$newpassword) {
        $this->load->model('Email_model');
        $this->load->model('User_model');
        $this->load->model('Member_model');
        $this->load->model('Site_setting_model');

        $site_info=$this->Site_setting_model->get_site_info(1);

        $headers= "From: wannaquiz <noreply@wannaquiz.com>\x0d\x0a";
        $headers .= "MIME-Version: 1.0\x0d\x0a";
        $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
        $template=$this->Email_model->get_email_template("FORGOT_PWD");

        $subject=$template->template_subject;
        $mail_body=$template->template_design;

        $user_detail=$this->User_model->getUser_details($user_id);
        $user_info = $this->Member_model->get_member_profile($user_id);
        $login_link='<a href="'.site_url('home/relogin').'">'.site_url('home/relogin')."</a>";

        $parseElement=array("FIRSTNAME"=>$user_info->first_name,"USERNAME"=>$user_detail->username,"PASSWORD"=>$newpassword,"SITENAME"=>$site_info->site_name,"LINK"=>$login_link);
        $subject=$this->Email_model->parse_email($parseElement,$subject);
        $mail_body=$this->Email_model->parse_email($parseElement,$mail_body);
        @mail($email,$subject,$mail_body,$headers);
    }

    function reset_password($user_id,$password) {
        $data=array("password"=>md5($password));
        $option=array("user_id"=>$user_id);
        $query = $this->db->update('tbl_members',$data,$option);
    }

    function help() {
        $this->load->model('pages_model');
        $this->load->model('help_management_model');
        $data['title']="Help : wannaquiz";
        $data['main']="help";
        //$data['help_topic_list']=$this->help_management_model->get_all_help_topics();
        $data['content']=$this->pages_model->get('help');

        $this->load->view('index',$data);
    }

    function Advertise($ad_id='') {
        $this->load->model('pages_model');
        $this->load->model('advertise_content_model');
        $data['title']="Advertise : wannaquiz";
        $data['main']="advertise_page/advertise_page";
        $data['topic_list']=$this->advertise_content_model->get_questions();
        $data['content']=$this->pages_model->get('advertise');
        if($ad_id!='')
        $data['ad_id'] = $ad_id;
        else $data['ad_id']=0;
        $data['nav']='advertise';
        $this->load->view('index',$data);
    }

    function Help_Center() {
        $this->load->model('pages_model');
        $this->load->model('Help_management_model');
        $data['title']="Advertise : wannaquiz";
        $data['main']="advertise_page/help_page";        
        $data['all_help_list']=$this->Help_management_model->get_all_helps('0');
        $data['content']=$this->pages_model->get('advertise');
        if($ad_id!='')
        $data['ad_id'] = $ad_id;
        else $data['ad_id']=0;
        $data['nav']='advertise';
        $data['flag']= 'help_center';
        
        $user_id = $this->session->userdata('wannaquiz_user_id');
        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);
            
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            
            $data['filter'] = $filter;
        }
          $this->load->view('index',$data);
    }

    function show($url)	{
        $this->load->model('Help_management_model');
         $user_id = $this->session->userdata('wannaquiz_user_id');
        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);
            
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            
            $data['filter'] = $filter;
        }
       if($url=="session_expired" && $this->session->userdata('wannaquiz_user_id')!="")
			$this->session->destroy();

		$ttle=str_replace('_',' ',$url);
		$data['title']=ucwords($ttle) ." | wannaquiz";

		$data['main']="advertise_page/help_page";
		if($url=='faq')
			$data['nav']="faq";
                $data['all_help_list']=$this->Help_management_model->get_all_helps(0);
                //echo $url;
                $data['url']=$url;
		$data['content'] =$this->pages_model->get($url);
                $data['sub_help_lists'] =$this->Help_management_model->get_sub_helps($url);
                $help_info =$this->Help_management_model->get_help_id_info('',$url);
                $data['help_image'] = $help_info[0]['help_image'];
                $data['cat_level'] = $help_info[0]['cat_level'];
                $data['parent_id'] = $help_info[0]['parent_id'];
                //print_r($help_info); //exit;
		$meta=$this->pages_model->get($url);
		$data['meta_desc']=$meta->CMSMeta_desc;
		$data['meta_keywords']=$meta->CMSMeta_keywords;
                $data['flag']='';
		$data['cms_variable']=1;
		$this->load->view('index',$data);
	}

    function sub_helps($url){
        if($url=="session_expired" && $this->session->userdata('wannaquiz_user_id')!="")
			$this->session->destroy();
        $ttle=str_replace('_',' ',$url);
	$data['title']=ucwords($ttle) ." | wannaquiz";

        $data['main']="advertise_page/help_page";

        $data['all_help_list']=$this->Help_management_model->get_all_helps(0);
        $data['content'] =$this->Help_management_model->get_sub_helps($url);
        $meta=$this->pages_model->get($url);
        $data['meta_desc']=$meta->CMSMeta_desc;
        $data['meta_keywords']=$meta->CMSMeta_keywords;
        $data['cms_variable']=1;
        $this->load->view('index',$data);
    }

    function Content() {
        $this->load->model('pages_model');
        $this->load->model('Content_help_question_model');
        $data['title']="Content : wannaquiz";
        $data['main']="content_page/content_page";
        $data['topic_list']=$this->Content_help_question_model->get_questions();
        $data['content']=$this->pages_model->get('content');
        $data['nav']='content';
        $this->load->view('index',$data);
    }

    function news($id=0) {
        $this->load->model('News_model');
        $data['title']="News : ebidshopper";
        $data['main']="include/news";
        if($id==0)
            $data['news_list']=$this->News_model->get_all_ebid_news(10,1);
        else
            $data['news_info']=$this->News_model->get_edit_news($id);
        $this->load->view('index',$data);
    }


    function press($id=0) {
        $this->load->model('News_model');
        $data['title']="Press News : ebidshopper";
        $data['main']="include/news";
        if($id==0)
            $data['news_list']=$this->News_model->get_all_press_news(10,1);
        else
            $data['news_info']=$this->News_model->get_edit_news($id);
        $this->load->view('index',$data);
    }


    function offline() {
        $this->load->model('site_setting_model');
        $data['title']="Site Under Maintenance: ebid";
        $data['site_info']=$this->site_setting_model->get_site_info('1');

        if($data['site_info']->site_status=='online') {
            redirect('/home','');
        }

        $this->load->view('offline',$data);
    }

    function checkSiteOnline() {
        $this->load->model('site_setting_model');
        $site_info=$this->site_setting_model->get_site_info(1);
        if($site_info->site_status=='offline') {
            redirect('/home/offline','');
        }
    }

    function checkBlockedIp() {
        $this->load->model('ip_block_model');

        $block_ips=$this->ip_block_model->get_blocked_ips("","","");
        //print_r($block_ips); echo "hii"; echo $_SERVER['REMOTE_ADDR']; EXIT;
        if(count($block_ips)>0) {
            foreach($block_ips as $ips) {
                if($_SERVER['REMOTE_ADDR']==$ips->blockip_address) {
                    echo $ips->blockip_desc;
                    exit;
                }
            }
        }
    }

    function logActivity($user_id,$username,$ip,$action) {
        $this->load->model('site_statistics_model');
        $this->site_statistics_model->insert_site_log($user_id,$username,$ip,$action);
    }

    function checkMemberLogin() {

        $this->load->library('session');
        if($this->session->userdata('wannaquiz_user_id')=="") {
            $this->session->set_flashdata('message',$this->lang->line('msg_please_login'));
            $url='home/relogin';
            if($this->session->userdata('redURL')) {
                $url='home/relogin/'.$this->session->userdata('redURL');
            }
            redirect($url);
        }
    }

    function unsubscribe($email_id) {
        $data=array('newsletter_subscribe'=>'no');
        $this->db->where('email',$email_id);
        $this->db->update('tbl_memberinfo',$data);
        redirect('');
    }

    function getPrice($value) {
        $this->load->library('currency_converter');
        $this->currency_converter->setLogin('localhost','root','','wannaquiz','currency');
        echo $this->currency_converter->convert($value,'USD','EUR');
    }

    // quiz machine for selecting random quiz 
    function generateRandomQuestion() {
        $this->quizMachine($this->input->post('level',TRUE));
    }

    function quizMachine($quiz_level="",$a="")
 {  
          $uid=$this->session->userdata('wannaquiz_user_id');
          $meminfo=$this->Member_model->get_member($uid);
          $filter = $meminfo->filter_adult;
          $this->load->model('quiz_model');
     
    if($this->session->userdata('count')==""){
       $this->session->set_userdata('count',10);
       $sql = "select * from tbl_quiz_display";
       $query1 = $this->db->query($sql);
       
       if($query1->num_rows()>0) {
            $query_result1 = $query1->result();
            $percentage_regular = ($query_result1[0]->percentage)/10;
            $percentage_sponsor = ($query_result1[1]->percentage)/10;
            $percentage_special = ($query_result1[2]->percentage)/10;
           $this->session->set_userdata(
              array(
                  'regular_quiz'=>$percentage_regular,
                  'sponsor_quiz'=>$percentage_sponsor,
                  'special_quiz'=>$percentage_special,
                  'next_quiz'=>'regular',
                  'reguar_quiz_next'=>0,
                  'sponsor_quiz_next'=>0,
                  'special_quiz_next'=>0,
                  ));
              }
           }
//           echo "regular Percentage".$this->session->userdata('regular_quiz');
//           echo "sponsor Percentage".$this->session->userdata('sponsor_quiz');
//           echo "special Percentage".$this->session->userdata('special_quiz')."<br>";
//           echo "regular".$this->session->userdata('reguar_quiz_next');
//           echo "sponsor".$this->session->userdata('sponsor_quiz_next');
//           echo "special".$this->session->userdata('special_quiz_next');
                  
           if($this->session->userdata('next_quiz')=='regular' && $this->session->userdata('reguar_quiz_next')<$this->session->userdata('regular_quiz'))  {
           //  echo "regular";
            $result = $this->Quiz_model->getRandomQuiz($quiz_level,'0',$filter);
            $this->session->set_userdata('reguar_quiz_next',$this->session->userdata('reguar_quiz_next')+1);
           //  $this->session->set_userdata('debug','regular');
            if($this->session->userdata('sponsor_quiz_next')<$this->session->userdata('sponsor_quiz'))
            $this->session->set_userdata('next_quiz','sponsor');
            else if($this->session->userdata('special_quiz_next')<$this->session->userdata('special_quiz'))  
                $this->session->set_userdata('next_quiz','special');
            else $this->session->set_userdata('next_quiz','regular');
         }    
           
        else if($this->session->userdata('next_quiz')=='sponsor'&& $this->session->userdata('sponsor_quiz_next')<$this->session->userdata('sponsor_quiz'))  {
           // echo "sponosr";
            $result = $this->Quiz_model->getRandomQuiz($quiz_level,'1',$filter);
            $this->session->set_userdata('sponsor_quiz_next',$this->session->userdata('sponsor_quiz_next')+1);
            //$this->session->set_userdata('debug','sponsor');
            if($this->session->userdata('special_quiz_next')<$this->session->userdata('special_quiz'))
            $this->session->set_userdata('next_quiz','special');
            else if($this->session->userdata('reguar_quiz_next')<$this->session->userdata('regular_quiz'))
                $this->session->set_userdata('next_quiz','regular');
            else $this->session->set_userdata('next_quiz','sponsor');
            
        }  
        
         else if($this->session->userdata('next_quiz')=='special'&& $this->session->userdata('special_quiz_next')<$this->session->userdata('special_quiz'))  {
             // echo "special";
             $result = $this->Quiz_model->getRandomQuiz($quiz_level,'2',$filter);
            $this->session->set_userdata('special_quiz_next',$this->session->userdata('special_quiz_next')+1);
          //  $this->session->set_userdata('debug','special');
            if($this->session->userdata('reguar_quiz_next')<$this->session->userdata('regular_quiz'))
            $this->session->set_userdata('next_quiz','regular');
            else if ($this->session->userdata('sponsor_quiz_next')<$this->session->userdata('sponsor_quiz'))
               $this->session->set_userdata('next_quiz','sponsor');
            else  $this->session->set_userdata('next_quiz','special');
            
        } 
     //echo "count".$this->session->userdata('count')."quiz id:";
      $this->session->set_userdata('count',$this->session->userdata('count')-1);
     if(!$quiz_id=$result->quiz_id){
           $this->quizMachine($quiz_level,1);
     }
     else{
      echo $quiz_id=$result->quiz_id;
     }
 } 
 
 
   function test() {
        $sql="Select answer_status from tbl_quiz_answers";
        $query=$this->db->query($sql);
        $result=$query->result();
        // print_r($result);
        $m=0;
        // echo count($result);
        foreach($result as $row) {
            if($row->answer_status==1) {
                $m=$m+1;
            }
            else {
                $m=0;
            }
            if($m==2)
                $j[]=$m;

            if($m==3)
                $k[]=$m;

            if($m==4)
                $l[]=$m;
        }

        print_r($j);
        echo "<br>";

        print_r($k);
        echo "<br>";

        print_r($l);
        echo "<br>";

        print_r($n);
        echo "<br>";

    }

    function best_fifty($cid=''){
        $this->load->model('Category_model');
        $this->load->model('Quiz_model');
        $data['title']="Best Fifty Players : wannaquiz";
        $data['main']="best_fifty/best_fifty_page";
        $data['categories']=$this->Category_model->get_categories();
        $data['best_players_today']=$this->Quiz_model->get_fifty_users_per_category($cid);
       // print_r($data['best_players_today']);
        $data['best_players_all_time'] = $this->Quiz_model->get_all_time_fifty_user_per_category($cid);
       //echo '<pre>'; 
        //print_r($data['best_players_all_time']);exit;
        $cat_info = $this->Category_model->get_category_by_id($cid);
        $data['category_name'] = $cat_info->name;
        $data['cid'] = $cid;
        if($cid=='')
        $data['flag']= 'overall';
        else
        $data['flag']= 'category';
        $this->load->view('index',$data);
    }

}
