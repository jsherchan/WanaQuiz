<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Quiz_credits extends Front_controller {

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function Quiz_credits()
	{
		parent::Front_controller();
		$this->load->model('Quiz_model');
                $this->load->helper(array('form', 'url'));
                $this->load->library('pagination');
	}

	// --------------------------------------------------------------------
    
	/**
	 * Initial Method
	 *
	 * @access	public
	 */
	function index(){
                $this->load->model('Email_model');
                $this->load->model('Site_setting_model');
                $site_info=$this->Site_setting_model->get_site_info(1);
		$data = $this->Quiz_model->get_quiz_credits();
                if(count($data)>0){
                    foreach($data as $user_data){
			$headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
			$headers .= "MIME-Version: 1.0\x0d\x0a";
			$headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";

                        $email = $user_data->email;
                        //$email ='siran_majan@hotmail.com';
			$template=$this->Email_model->get_email_template("NO_VIEWS");

                        $subject=$template->template_subject;
			$emailbody=$template->template_design;

			$confirm="<div><a href='".site_url('member/buyAdSpace/'.$user_data->quiz_id)."'>".$user_data->quiz_question."</a></div>";

			$parseElement=array("USERNAME"=>$user_data->first_name,"QUIZES"=>$confirm,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email);

			$subject=$this->Email_model->parse_email($parseElement,$subject);
			$emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

			@mail($email,$subject,$emailbody,$headers);
                    }
                }
	}
        
        
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */