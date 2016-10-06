<?php
class Site_settings extends Front_controller {

	function Site_settings()
	{
		parent::Front_controller();	
	    $this->load->library('parser');
        $this->load->Model('Site_setting_model');
	}
	
	function index()
	{
		$this->site();
	}
	
	function site(){
 
 		$data['title']="Wannaquiz:Site Settings";
 		$data['main']='admin/site_settings';
        $data['site_info']=$this->Site_setting_model->get_site_info('1');
		$this->load->view('admin/admin',$data);
	}
	
	function update()
	{
        $this->Site_setting_model->update_site_settings();
        $this->session->set_flashdata('message','Site Settings Updated');
        redirect(ADMIN_PATH.'/site_settings');
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */