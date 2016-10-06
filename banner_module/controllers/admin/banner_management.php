<?php

class Banner_management extends Controller {

	function Banner_management()
	{
		parent::Controller();	
	 //	$this->load->helper('url');
    //	$this->load->helper('form');
	$this->load->model('Banner_management_model');
	$this->load->library('parser');
	}
	
	function index()
	{
		//redirect(ADMIN_PATH.'/banner_management/banner','refresh');
		$this->banner();
		
	}
	
	function banner(){
 
 		$data['title']="heppaa:Banner Management";
 		$data['main']='admin/banner_management';
		
		//CALL CATEGORY Models
		$data['banner_list']=$this->Banner_management_model->banner_list();
		//$this->load->vars($data);
		$this->parser->parse('admin/admin',$data);
		//$this->load->view('admin/admin');
	}
	
	function edit_banner($banner_id){
		$data['title']="heppaa:Banner Management->Add Banner";
 		$data['main']='admin/edit_banner';
		
		//CALL CATEGORY Models
		$data['banner_info']=$this->Banner_management_model->get_banner_info($banner_id);
		//$this->load->vars($data);
		$this->load->view('admin/admin',$data);
		//$this->load->view('admin/admin');
	}
	
	function update_banner()
	{
	// before updating banner image 
	// delete previous banner if any 
	$banner_info=$this->Banner_management_model->get_banner_info($this->input->post('banner_id'));
	if(file_exists("./banner_images/".$banner_info->ban_image))
				unlink("./banner_images/".$banner_info->ban_image);
		
	$this->upload_image('banner');
	
	 //CALL Auction Models
	$this->Banner_management_model->update_banner();
	$this->session->set_flashdata('message','Banner Edited');
	redirect(ADMIN_PATH.'/banner_management','refresh');
	//$this->load->view('admin/admin');
	}
	
	function upload_image($file)
	{
		$config['upload_path'] = './banner_images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */