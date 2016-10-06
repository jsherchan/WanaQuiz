<?php

class Report_quiz_management extends Controller {

	function Report_quiz_management()
	{
		parent::Controller();	
        $this->load->model('Report_quiz_management_model');
        $this->load->library('parser');
	}
	
	function index()
	{
            $this->load->model('Ip_block_model');
		$data['title']="Report Quiz Management~wannaquiz";
 		$data['main']='admin/report_quiz_management';
                $data['flag']='';
		$data['report_list']=$this->Report_quiz_management_model->report_list();
		$this->parser->parse('admin/admin',$data);
	}
	
	
    function delete_quiz_report($id,$type){
        $delete_data = $this->Report_quiz_management_model->delete_quiz_report_data($id,$type);
        redirect(ADMIN_PATH.'/report_quiz_management','refresh');
    }

    function delete_quiz($id){
        $delete_data = $this->Report_quiz_management_model->delete_quiz($id);
        redirect(ADMIN_PATH.'/report_quiz_management','refresh');
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */