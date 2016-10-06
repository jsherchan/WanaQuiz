<?php
class Mail_settings extends Front_controller {

	function Mail_settings()
	{
		parent::Front_controller();	
        $this->load->library('parser');
        $this->load->Model('Email_template_model');
	}
	
	function index()
	{
		redirect(ADMIN_PATH.'/mail_settings/template/REGISTRATION','');
	}
		
	function template($name){
 
 		$data['title']="Wannaquiz:Mail Settings";
 		$data['main']='admin/mail_settings';
		$data['template_info']=$this->Email_template_model->get_template_info($name);
		$this->load->view('admin/admin',$data);
	}
	
	function update(){
		$this->Email_template_model->update_email_template();
		$this->session->set_flashdata('message','Email Template Updated');
	    redirect(ADMIN_PATH.'/mail_settings/template/'.$this->input->post('TemplateCode'),'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */