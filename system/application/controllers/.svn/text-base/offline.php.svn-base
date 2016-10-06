<?php
class Offline extends Controller
{
	function Offline()
	{
		parent::Controller();
		$this->load->model('Site_setting_model');
	}
	
	function index()
	{
		$site_info=$this->Site_setting_model->get_site_info(1);
        $data['site_info']=$site_info;
		if($site_info!=NULL && $site_info->site_status!='online')
		{
            $this->load->view('offline',$data);
		}
		else
		{
			redirect('home','refresh');
		}
	}
}