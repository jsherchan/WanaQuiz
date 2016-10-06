<?php

class Payment_settings extends Front_controller {

	function Payment_settings()
	{
		parent::Front_controller();	
        $this->load->library('parser');
        $this->load->Model('Payment_setting_model');
	}
	
	function index()
	{
		$this->payment();
	}
	
	function payment(){
 
 		$data['title']="Wannaquiz:Payment Management";
 		$data['main']='admin/payment_settings';
		$data['payment_info']=$this->Payment_setting_model->get_payment_info('1');
		$this->load->view('admin/admin',$data);
	}
	
	function update()
	{
        $this->Payment_setting_model->update_payment_settings();
        $this->session->set_flashdata('message','Payment Settings Updated');
        redirect(ADMIN_PATH.'/payment_settings');
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */