<?php

class Content_help_question_management extends Controller {

	function Content_help_question_management()
	{
		parent::Controller();	
		$this->load->library('parser');
		$this->load->model('Content_help_question_model');
	}
	
	function index()
	{
		$this->viewContentQuestion();
		
	}
		
	function viewContentQuestion()
	{
 		$data['title']="Content Help Management ~ wannaquiz.com";
 		$data['main']='admin/help_content_questions';
		$data['contentquestion_list']=$this->Content_help_question_model->get_questions();
		$this->parser->parse('admin/admin',$data);
	}
	
	function addContentQuestion()
	{
  		$data['title']="Content Help Management ~ wannaquiz.com";
 		$data['main']='admin/help_content_add_edit';
		$data['add']='add';
		$this->load->view('admin/admin',$data);
	}
	
	function editContentQuestion($id)
	{
  		$data['title']="Content Help Management ~ wannaquiz.com";
 		$data['main']='admin/help_content_add_edit';
		$data['content_questions_info']=$this->Content_help_question_model->get_question_info($id);	
		
		$this->load->view('admin/admin',$data);
	}
	
	function add()
	{
		$this->Content_help_question_model->add_content_questions();
		$this->session->set_flashdata('message','Question added.');
		redirect(ADMIN_PATH.'/content_help_question_management/');
	}
	
	function edit()
	{
		$this->Content_help_question_model->edit_content_question();
		$this->session->set_flashdata('message','Question edit');
		redirect(ADMIN_PATH.'/content_help_question_management/');
	}
	
	function deleteQuestion($id)
	{
		if ($id) 
		{
            $this->db->where("id", $id);
            $this->db->delete("tbl_content_help_questions");
          
        }
		$this->session->set_flashdata('message','Selected Question Deleted');
	
		redirect(ADMIN_PATH.'/content_help_question_management/viewContentQuestion');
			
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */