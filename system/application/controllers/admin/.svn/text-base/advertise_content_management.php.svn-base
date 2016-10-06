<?php

class Advertise_content_management extends Controller {

	function Advertise_content_management()
	{
		parent::Controller();	
		$this->load->library('parser');
		$this->load->model('Advertise_content_model');
	}
	
	function index()
	{
		$this->viewContentQuestion();
		
	}
		
	function viewContentQuestion()
	{
 		$data['title']="Advertise Content Management ~ wannaquiz.com";
 		$data['main']='admin/advertise_content_questions';
		$data['contentquestion_list']=$this->Advertise_content_model->get_questions();
		$this->parser->parse('admin/admin',$data);
	}
	
	function addContentQuestion()
	{
  		$data['title']="Advertise Content Management ~ wannaquiz.com";
 		$data['main']='admin/advertise_content_add_edit';
		$data['add']='add';
		$this->load->view('admin/admin',$data);
	}
	
	function editContentQuestion($id)
	{
  		$data['title']="Advertise Content Management ~ wannaquiz.com";
 		$data['main']='admin/advertise_content_add_edit';
		$data['content_questions_info']=$this->Advertise_content_model->get_question_info($id);	
		
		$this->load->view('admin/admin',$data);
	}
	
	function add()
	{
		$this->Advertise_content_model->add_content_questions();
		$this->session->set_flashdata('message','Question added.');
		redirect(ADMIN_PATH.'/advertise_content_management/');
	}
	
	function edit()
	{
		$this->Advertise_content_model->edit_content_question();
		$this->session->set_flashdata('message','Question edit');
		redirect(ADMIN_PATH.'/advertise_content_management/');
	}
	
	function deleteQuestion($id)
	{
		if ($id) 
		{
            $this->db->where("id", $id);
            $this->db->delete("tbl_advertise_content_questions");
          
        }
		$this->session->set_flashdata('message','Selected Question Deleted');
	
		redirect(ADMIN_PATH.'/advertise_content_management/viewContentQuestion');
			
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */