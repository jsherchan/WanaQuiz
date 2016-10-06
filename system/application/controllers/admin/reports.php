<?php
class Reports extends Front_controller {

	function Reports()
	{
		parent::Front_controller();	
		$this->load->helper('url');
        $this->load->helper('general_helper');
        $this->load->model('reports_model');
        $this->load->library('parser');
        $this->load->library('pagination');
	}
	
	function index()
	{
		echo "no reports available for now";	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */