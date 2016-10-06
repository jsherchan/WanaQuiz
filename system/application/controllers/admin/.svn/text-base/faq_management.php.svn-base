<?php
class Faq_management extends Controller {

	function Faq_management()
	{
		parent::Controller();	
		$this->load->library('parser');
		$this->load->model('Help_management_model');
	}
	
	function index()
	{
		$this->viewHelpQuestion();
		
	}
		
	function viewHelpQuestion()
	{
 		$data['title']="Help Management ~ urbid.com.au";
 		$data['main']='admin/helpquestions';
		$data['helpquestion_list']=$this->Help_management_model->get_questions();
		$this->parser->parse('admin/admin',$data);
	}
	
	function addHelpQuestion()
	{
  		$data['title']="Help Management ~ urbid.com.au";
 		$data['main']='admin/add_help_question';
		$this->load->view('admin/admin',$data);
	}
	
	function editHelpQuestion($id)
	{
  		$data['title']="Help Management ~ urbid.com.au";
 		$data['main']='admin/edit_help_question';
		$data['help_questions_info']=$this->Help_management_model->get_question_info($id);		
		$this->load->view('admin/admin',$data);
	}
	
	function add()
	{
		$this->Help_management_model->add_help_questions();
		$this->session->set_flashdata('message','Help question added.');
		redirect(ADMIN_PATH.'/help_management/');
	}
	
	function edit()
	{
		$this->Help_management_model->edit_help_question();
		$this->session->set_flashdata('message','Help question edit');
		redirect(ADMIN_PATH.'/help_management/');
	}
	
	function deleteQuestion($id)
	{
		if ($id) 
		{
            $this->db->where("id", $id);
            $this->db->delete("tblhelp_questions");
          
        }
		$this->session->set_flashdata('message','Selected Help Question Deleted');
	
		redirect(ADMIN_PATH.'/help_management/viewHelpQuestion/2');
			
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */