<?php

class Registration extends Front_controller
{
	function Registration()
	{
		parent::Front_controller();	
		$this->load->library('parser');
		$this->lang->load('recaptcha');
		$this->load->model('Registration_model');
		$this->load->model('Country_management_model');
		$this->load->model('user_model');
		$this->load->library('validation');
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
                $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
		$this->load->library('encrypt');
		$this->load->plugin('captcha');
		$this->load->helper(array('form', 'url'));
		$this->load->model('bonus_settings_model');
	}
	
	function index(){
		$data['title']='WannaQuiz : Registration';
		$data['main']='registration/register_step1';
                $data['nav']='register';
		$this->load->view("index",$data);
	}
	
	function regular(){
	
		$this->form_validation->set_rules('fname', $this->lang->line('text_name'),'required');
		$this->form_validation->set_rules('lname', $this->lang->line('text_surname'),'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exist');
		$this->form_validation->set_rules('gender', $this->lang->line('gender'), 'required');
                $this->form_validation->set_rules('country', $this->lang->line('country'), 'required');
                $this->form_validation->set_rules('city', $this->lang->line('city'), '');
       // $this->form_validation->set_rules('dod', $this->lang->line('dod'), 'required');
       // $this->form_validation->set_rules('dom', $this->lang->line('dom'), 'required');
       // $this->form_validation->set_rules('doy', $this->lang->line('doy'), 'required');
		$this->form_validation->set_rules('uname', $this->lang->line('text_username'),'callback_check_uname');
		$this->form_validation->set_rules('password', $this->lang->line('text_password'),'required|callback__alpha_dash_space');
		$this->form_validation->set_rules('re_password',$this->lang->line('text_repeat_password'),'required|matches[password]');
//		
		$this->form_validation->set_rules('terms', 'terms','callback_check_terms');
                $this->form_validation->set_rules('newsletter', 'newsletter','');
		$this->form_validation->set_rules('check_adult', 'Age','callback_check_adult');
		$this->form_validation->set_rules('captcha', 'Captcha','callback_recaptcha_check');

               // $data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');
		 $data['country_list']=$this->Country_management_model->get_all_country();
                if($this->form_validation->run()==FALSE)
		{ 
			if($this->input->post('referer_id',TRUE))
			$data['referer_id']=$this->input->post('referer_id',TRUE);
			$data['title']="WannaQuiz : Sign Up For Free:";
                   
                   $captcha = $this ->generate_captcha();
                   $data['captcha_image']=$captcha['image'];
                   $data['catcha_message']=$captcha['word'];
                        $data['main']="registration/register_regular";
			
			$this->parser->parse('index',$data);
		}
		else
		{
			$new_mem_id=$this->Registration_model->register();
			
			// send registration confirmation email 
			$this->reg_confirmation_email($this->input->post('email',TRUE),$new_mem_id);
			redirect('registration/step2/'.$new_mem_id);
		}
	}
	
	function advertiser(){

		$this->form_validation->set_rules('fname', $this->lang->line('text_name'),'required');
		$this->form_validation->set_rules('lname', $this->lang->line('text_surname'),'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exist');
		$this->form_validation->set_rules('uname', $this->lang->line('text_username'),'callback_check_uname');
		$this->form_validation->set_rules('password', $this->lang->line('text_password'),'required');
		$this->form_validation->set_rules('re_password',$this->lang->line('text_repeat_password'),'required|matches[password]');
                $this->form_validation->set_rules('cname', $this->lang->line('text_company_name'),'callback_check_company_name');
                $this->form_validation->set_rules('caddress', $this->lang->line('text_company_address'),'');
                $this->form_validation->set_rules('state', $this->lang->line('text_company_city'),'required');
                $this->form_validation->set_rules('city', $this->lang->line('text_company_city'),'');
                $this->form_validation->set_rules('cwebsite', $this->lang->line('text_company_website'),'callback_check_company_website');
                $this->form_validation->set_rules('country', $this->lang->line('text_company_country'),'required');
                $this->form_validation->set_rules('gender', $this->lang->line('text_gender'),'required');
		$this->form_validation->set_rules('terms', 'terms','callback_check_terms');
                $this->form_validation->set_rules('newsletter', 'newsletter','');
		$this->form_validation->set_rules('check_adult', 'Age','callback_check_adult');
                $this->form_validation->set_rules('captcha', 'Captcha','callback_recaptcha_check');
               //$data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');
               $data['country_list']=$this->Country_management_model->get_all_country();
		if($this->form_validation->run()==FALSE)
		{
			if($this->input->post('referer_id',TRUE))
			$data['referer_id']=$this->input->post('referer_id',TRUE);
			$data['title']="WannaQuiz : Sign Up For Free:";
			
                   $captcha = $this ->generate_captcha();
                   $data['captcha_image']=$captcha['image'];
                   $data['catcha_message']=$captcha['word'];
                        $data['main']="registration/register_advertiser";

			$this->parser->parse('index',$data);
		}
		else
		{
			$new_mem_id=$this->Registration_model->register_advertiser();

			// send registration confirmation email
			$this->reg_confirmation_email($this->input->post('email',TRUE),$new_mem_id);
			redirect('registration/step2/'.$new_mem_id);
		}
	}

		
	function confirm(){
		$data['title']='WannaQuiz : Registration';
		$data['main']='registration/register_confirmation';
		$this->load->view("index",$data);
	}
			
	function step2($new_mem_id){
		$this->load->model('pages_model');
		$this->load->model('Bonus_settings_model');
		$this->load->model('Email_model');
		$this->load->model('User_model');

		$data['title']="Registration Step 2:wannaquiz";
		
		$data['main']="registration/register_confirmation";
		
		$content_info=$this->pages_model->get('registration_confirmation');
		$data['CMSTitle']=$content_info->title;
		
		$parseElement=array("USERNAME"=>$mem_info->username,"EMAILID"=>$mem_info->email,"SITEURL"=>site_url(''));
		
		$data['CMSDetail']=$this->Email_model->parse_email($parseElement,$content_info->CMSDetail);
		$this->load->view('index',$data);
	
	}
	
	function reg_confirmation_email($email,$id){
			$this->load->model('Site_setting_model');
			$this->load->model('Email_model');
			
			$site_info=$this->Site_setting_model->get_site_info(1);
/*                        
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: sujit@proshore.eu' . "\r\n";
#mail("bhattarairoshan@gmail.com,bishwa@proshore.eu,cid4pn1@gmail.com", "test 2xd host", "message", $headers);
// Mail it
if(mail("roshanbh233@hotmail.com,bishwa@proshore.eu,cid4pn1@gmail.com,bishwadeoja14@yahoo.com,bishwadeoja24@hotmail.com", "test 2xd host", "message", $headers))
{
 echo "sent";
 }
 else
 echo "Mail not sent";
return;
*/			
			$headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
			$headers .= "MIME-Version: 1.0\x0d\x0a"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a"; 
			
			$template=$this->Email_model->get_email_template("REGISTRATION");		
			
                        $subject=$template->template_subject;
			$emailbody=$template->template_design;
									
			$confirm="<a href='".site_url('registration/activated/'.$id)."' style='color:#0080FF; font-weight:bold'>Confirmation Link</a>";
					
			$parseElement=array("USERNAME"=>$this->input->post('uname',TRUE),"CONFIRM"=>$confirm,"SITENAME"=>"The WannaQuiz Team","CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"FIRSTNAME"=>$this->input->post('fname',TRUE),"PASSWORD"=>$this->input->post('password',TRUE));
			
			$subject=$this->Email_model->parse_email($parseElement,$subject);
			$emailbody=$this->Email_model->parse_email($parseElement,$emailbody);
			
			@mail($email,$subject,$emailbody,$headers);
	}
	
	
	function generate_captcha(){
		// captch image generations		
		$this->load->plugin('captcha');
		$captcha_defaults = array(
				'img_path'     =>'./captcha/',
				'img_url'     => base_url().'captcha/',
				'font_path'	 => './captcha/monofont.ttf',
				'img_width'     => 200,
				'img_height' => 70
 				   );
				   
		$cap = create_captcha($captcha_defaults);
                $this->session->set_userdata(array('cinput_check'=>$cap['word']));
		return $cap;
	}
        function generate_captchas(){
		// captch image generations		
		$this->load->plugin('captcha');
		$captcha_defaults = array(
				'img_path'     =>'./captcha/',
				'img_url'     => base_url().'captcha/',
				'font_path'	 => './captcha/monofont.ttf',
				'img_width'     => 200,
				'img_height' => 70
 				   );
				   
		$cap = create_captcha($captcha_defaults);
                $this->session->set_userdata(array('cinput_check'=>$cap['word']));
                
                   $captcha_image=$cap['image'];
                $option='<br></br>';                 
                
                                           $option.=$captcha_image; 
                                               $option.=' <br></br>';
                                               $option.=' <label>Enter the characters you see above</label> </br><br>';
                                           $option.=' <input type="text" name="captcha"  size="30" />';

                                          $option.= form_error('captcha');
	echo $option;
                                          
        }
	
	
	function recaptcha_check() {
         
          // echo $this->session->userdata('cinput_check');
          // echo $this->input->post('captcha');
             if ($this->input->post('captcha',TRUE)!= $this->session->userdata('cinput_check'))
         {
            $this->form_validation->set_message('recaptcha_check', "Please Enter Captcha Code Again");
            return FALSE;                            
        }
        else
        {
            return TRUE;        
        }
//          
//           if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('captcha'),$val)) {
//	    return TRUE; 
//	  } else {
//	    $this->form_validation->set_message('recaptcha_check',$this->lang->line('recaptcha_incorrect_response'));
//	    return FALSE;
//	  }
	}

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

        function check_company_name() {

            if ($this->input->post('cname',TRUE)=='') {

                $this->form_validation->set_message('check_company_name', 'Company name field is required.');
                return FALSE;
            }
            else {
                $sql="select * from tbl_advertisers where company_name=?";
                $query=$this->db->query($sql,array($this->input->post('cname',TRUE)));
                if($query->num_rows()>0) {
                    $this->form_validation->set_message('check_company_name', 'Company name already exists. Plz try again.');
                    return false;
                }
            }
            return TRUE;

        }
	
	function check_email_exist()
	{
        $sql="select * from tbl_member_profile where email=?";
		$query=$this->db->query($sql,array($this->input->post('email',TRUE)));
		if($query->num_rows()>0) 
		{
		  $this->form_validation->set_message('check_email_exist', 'Email Id already exists.');
		  return false;
		}
        return TRUE;        

	}

        function check_company_website()
	{
        $sql="select * from tbl_advertisers where company_website=?";
		$query=$this->db->query($sql,array($this->input->post('cwebsite',TRUE)));
		if($query->num_rows()>0)
		{
		  $this->form_validation->set_message('check_compnay_website', 'Company website already exists.');
		  return false;
		}
        return TRUE;

	}
	
	function activated($id){ 
		$this->load->model('pages_model');
		$this->load->model('Bonus_settings_model');
		$this->load->model('Email_model');
		$this->load->model('User_model');
		
		$data=array('activated'=>'1');
		$this->db->where('user_id',$id);
		$this->db->update('tbl_members',$data);
		
		$data['title']="Account Activated :wannaquiz";
		$data['main']="registration/account_activated";
						
		$content_info=$this->pages_model->get('account_activated');
		$data['CMSTitle']=$content_info->title;
			
		$parseElement=array("SITEURL"=>site_url(''));
		$data['CMSDetail']=$this->Email_model->parse_email($parseElement,$content_info->detail);
		$this->parser->parse('index',$data);
	}
	
	
	
	function ref($ref_id)
	{
		//$this->load->library('recaptcha');
		
		if($this->session->userdata('wannaquiz_user_id')){
			$this->session->set_flashdata('message','You are already a registered member with us!');
			redirect('/home/', 'refresh');
			}
		else{
				//$data['captchaimage'] = $this->recaptcha->get_html();
				$data['title']="Sign Up For Free:wannaquiz";
				$data['main']="registration/register_step1";
				$data['referer_id']=$ref_id;
                                $this->session->set_userdata('referer_id',$ref_id);
				$data['country_list']=$this->Country_management_model->get_all_countries('1','countries_name','DESC','','0');
				$this->parser->parse('index',$data);
			}
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
        

	function get_states()
        {
         
        $pid = $this->input->post('pid',TRUE);
               $states = $this->Country_management_model->get_states($pid);
       $options = '<select name="state" id="state" onchange="dochanges(this.value)">            
            ';
        
        if($states)
        {
//            $options .= '<option value="">- Select State -</option>';
            
            foreach($states as $row)
              $options .= '<option value="' . $row->state_code . '">' . $row->state_name . '</option>';                
        }
        else{
            $options .= '<option value="">- None -</option>';
        
        $options .= '</select>';
        }
        echo $options;
    }
      function get_cities()
      {
           $code=$this->input->post('country_code',TRUE);
           $pid = $this->input->post('pid',TRUE);
                $cities = $this->Country_management_model->get_citys($pid,$code);
         
                $options = '<select name="city" id="city" >            
            ';
        
        if($cities )
        {
           $options .= '<option value="">- Select City -</option>';
            
            foreach($cities as $row)
              $options .= '<option value="' . $row->city_name . '">' . $row->city_name . '</option>';                
            
        }
        else{
            $options .= '<option value="">- None -</option>';
        
        $options .= '</select>';
        }
        echo $options;
      }
	
}

