<?php
class Country_management extends Front_controller {

	function Country_management()
	{
		parent::Front_controller();	
		
	$this->load->library('parser');
	$this->load->model('Country_management_model');
	$this->load->library('pagination');
	}
	
	function index()
	{
		$this->country_list('countries_name','ASC');
	}
	
	function country_list($sort_field='countries_name',$sort_order='ASC'){
 
 		$data['title']="Wannaquiz:Country Management";
 		$data['main']='admin/country';
		
		//set pagination configuration	
		
		$config['base_url'] = site_url(ADMIN_PATH.'/country_management/country_list/'.$sort_field.'/'.$sort_order.'/');
		$config['total_rows']=$this->db->count_all('tbl_countries');
		$config['per_page'] = '30'; 
		$config['uri_segment'] = '6';
		$offset=$this->uri->segment(6,0);
		$this->pagination->initialize($config); 
		
		
		//CALL CATEGORY Models
		$data['country_list']=$this->Country_management_model->get_all_countries(1,$sort_field,$sort_order,$config['per_page'],$offset);
		
		if($sort_order=="ASC")
			$data['sort']="DESC";
		else
			$data['sort']="ASC";
			
		//$this->load->vars($data);
		$this->parser->parse('admin/admin',$data);
	}
	
	function add_country(){
        $data['title']="Wannaquiz:Add Country";
        $data['main']='admin/add_edit_country';
        $data['add_country']="yes";
        $this->parser->parse('admin/admin',$data);
	}
	
	function add(){
        $this->Country_management_model->add_country();
        $this->session->set_flashdata('message','Category Added Successfully');
        redirect(ADMIN_PATH.'/country_management/country_list/','refresh');
	}
	
	function edit_country($country_id){
	    $data['title']="Wannaquiz:Edit Country";
        $data['main']='admin/add_edit_country';
        $data['country_info']=$this->Country_management_model->get_country_id_info($country_id);
        $this->parser->parse('admin/admin',$data);
	}
	
	function edit()
	{	
        $this->Country_management_model->edit_country();
        $this->session->set_flashdata('message','Selected Country Edited');
        redirect(ADMIN_PATH.'/country_management/country_list/','refresh');
	}
	
	function delete($country_id)
	{
	 if ($country_id) {
	
          			
			//delete states related to country
			$this->db->where("country_id", $country_id);
            $this->db->delete("tbl_states");
			
			//At last delete country table 
			$this->db->where("countries_id", $country_id);
            $this->db->delete("tbl_countries");			
			
        }
        $this->session->set_flashdata('message','Selected Country Deleted');
        redirect(ADMIN_PATH.'/country_management/country_list/','refresh');
	}
	
	// -----------STATES -----------STATES ----------STATES -------
		
	function states_list($country_id,$sort_field,$sort_order){
 
 		$data['title']="Wannaquiz:States Management";
 		$data['main']='admin/view_states';
		
		//set pagination configuration	
		
		$config['base_url'] = site_url(ADMIN_PATH.'/country_management/states_list/'.$country_id.'/'.$sort_field.'/'.$sort_order.'/');
		$query = $this->db->getwhere('tbl_states',array('country_id'=>$country_id));
		$config['total_rows']=$query->num_rows();
		$config['per_page'] = '25'; 
		$config['uri_segment'] = '7';
		$offset=$this->uri->segment(7,0);
		$this->pagination->initialize($config); 
			
		//CALL CATEGORY Models
		$data['states_list']=$this->Country_management_model->get_all_states($country_id,$sort_field,$sort_order,$config['per_page'],$offset);
		
		if($sort_order=="ASC")
			$data['sort']="DESC";
		else
			$data['sort']="ASC";
		
		$data['country_info']=$this->Country_management_model->get_country_id_info($country_id);
		//$this->load->vars($data);
		$this->parser->parse('admin/admin',$data);
	}
	
	function add_states($country_id){
        $data['title']="Wannaquiz:Add States";
        $data['main']='admin/add_edit_states';
        $data['add_states']="yes";
        $data['country_info']=$this->Country_management_model->get_country_id_info($country_id);
        $this->parser->parse('admin/admin',$data);
	}
	
	function edit_state($country_id,$state_id){
        $data['title']="Wannaquiz:Edit States";
        $data['main']='admin/add_edit_states';
        $data['state_info']=$this->Country_management_model->get_state_info($state_id);
        $data['country_info']=$this->Country_management_model->get_country_id_info($country_id);
        $this->parser->parse('admin/admin',$data);
	}
	
	
	function insert_states(){
        $this->Country_management_model->add_states();
        $this->session->set_flashdata('message','States Added Successfully');
        redirect(ADMIN_PATH.'/country_management/states_list/'.$this->input->post('country_id',TRUE).'/state_name/ASC','refresh');
	}
	
	function update_states(){
        $this->Country_management_model->edit_states();
        $this->session->set_flashdata('message','State Edited Successfully');
        redirect(ADMIN_PATH.'/country_management/states_list/'.$this->input->post('country_id',TRUE).'/state_name/ASC','refresh');
	}
	
	function delete_state($country_id,$state_id)
	{
	 if ($state_id) {
	    			
		//delete states related to country
		    $this->db->where("state_id", $state_id);
            $this->db->delete("tbl_states");
        }
        $this->session->set_flashdata('message','Selected State Deleted');
        redirect(ADMIN_PATH.'/country_management/states_list/'.$country_id.'/state_name/ASC','refresh');
	}

			
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */