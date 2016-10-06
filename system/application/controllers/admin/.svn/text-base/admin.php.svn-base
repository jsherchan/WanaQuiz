<?php

class Admin extends Controller {
	function Admin()
	{
		parent::Controller();	
		//$this->load->helper('url');
   		//$this->load->helper('form');
   		$this->load->library('parser');
		$this->load->library('validation');
		
	}
	
	function index()
	{
		
		   $data['title']="Wannaquiz:Cpanel Login";
		   //$this->load->vars($data);
		   $this->parser->parse('admin/users_login',$data);
		   //$this->load->view('admin/admin');
		 
				
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */