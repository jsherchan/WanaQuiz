<?php
class Home extends Controller {
	function Home()
	{
		parent::Controller();	
		//$this->load->helper('url');
   		//$this->load->helper('form');
   		$this->load->library('parser');
		$this->load->library('validation');
		
	}
	
	function index()
	{
		
		$data['title']="Wannaquiz~Cpanel~ ";
		$data['main']="admin/welcome";
		$data['num_mem']=5;
		$this->parser->parse('admin/admin',$data);
		
	}
	

	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */