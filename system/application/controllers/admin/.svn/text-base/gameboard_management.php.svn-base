<?php
class Gameboard_management extends Front_controller {

	function Gameboard_management()
	{
		parent::Front_controller();	
	 	$this->load->model('Gameboard_model');
    	
	$this->load->library('parser');
	}
	
	function index()
	{
		$this->view_gameboards('id','DESC');
		
	}
		
	function add_gameboard()
	{
		$data['title']="Gameboard Management ~ wannaquiz";
 		$data['main']='admin/gameboard';
				
		$data['view_gameboard_layout']="no";
		$this->parser->parse('admin/admin',$data);
	}
	
	function edit_gameboard($board_id)
	{
		$data['title']="Gameboard Management ~ wannaquiz";
 		$data['main']='admin/gameboard';
		$data['gameboard_info']=$this->Gameboard_model->get_gameboard_info_by_id($board_id);
		$data['view_gameboard_layout']="no";
		
		$this->load->view('admin/admin',$data);
	
	}
	
	function view_gameboards($sort_field,$sort_order)
	{
		$this->load->library('pagination');
 		$data['title']="Gameboard Management~ wannaquiz";
 		$data['main']='admin/gameboard';
		
		$config['base_url'] = site_url(ADMIN_PATH.'/gameboard_management/view_gameboards/'.$sort_field.'/'.$sort_order.'/');
		$board_info=$this->Gameboard_model->get_all_gameboards_info($sort_field,$sort_order,0,0);
		$config['total_rows']=count($board_info);
		
		$config['per_page'] = '50'; 
		$config['uri_segment'] = '6';
		$offset=$this->uri->segment(6,0);
	
		$this->pagination->initialize($config);
		
		
		$data['gameboard_list']=$this->Gameboard_model->get_all_gameboards_info($sort_field,$sort_order,$config['per_page'],$offset);
		$data['view_gameboard_layout']="yes";
		
		if($sort_order=="ASC")
			$data['sort_order']="DESC";
		else
			$data['sort_order']="ASC";
			
			$data['offset']=$offset;
		
		$this->parser->parse('admin/admin',$data);
		
	}
		
	function update()
	{
		if($_FILES['gameboard_image']['name']!=""){
			$file_info=$this->upload_gameboard('gameboard_image');
		}
		else
			$file_info['file_name']=$this->input->post('hboard_image');
		
		$this->Gameboard_model->edit($file_info['file_name']);
		$this->session->set_flashdata('message','Gameboard edited successfully.');
		redirect(ADMIN_PATH.'/gameboard_management/');
	}
	
	function insert()
	{
		
		if($_FILES['gameboard_image']['name']!=""){
                    list($width, $height, $type, $attr) = getimagesize($_FILES['gameboard_image']['tmp_name']);
                    if($this->input->post('board_type') == 'free'){
                        if($width < '650' || $height < '800'){
                            $this->session->set_flashdata('message','Image size is not supported!');
                            redirect(ADMIN_PATH.'/gameboard_management/add_gameboard');
                        }
                    }
                    else {
                        if($width < '800' || $height < '800'){
                            $this->session->set_flashdata('message','Image size is not supported!');
                            redirect(ADMIN_PATH.'/gameboard_management/add_gameboard');
                        }
                    }
			$file_info=$this->upload_gameboard('gameboard_image');
		}
		else
			$file_info['file_name']=$this->input->post('hboard_image');
		$this->Gameboard_model->insert($file_info['file_name']);
		$this->session->set_flashdata('message','Gameboard inserted successfully.');
		redirect(ADMIN_PATH.'/gameboard_management/');
	}
	
	function delete_gameboard($id){
		 $this->db->where("id", $id);
         $this->db->delete("tbl_gameboard");
		 $this->session->set_flashdata('message','Gameboard deleted successfully.');
		redirect(ADMIN_PATH.'/gameboard_management/');
	}
	
		
	function upload_gameboard($file)
	{
		$config['upload_path'] ='./gameboard_images/';
		$config['allowed_types'] = 'jpg|gif|png|PNG';
		$config['max_size']	= '1000';
		$config['max_width']  =0;
		$config['max_height']  =0;
				
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}	
	
		
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */