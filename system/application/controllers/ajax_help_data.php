<?php 

class Ajax_help_data extends Controller {

	function Ajax_help_data()
	{
		parent::Controller();	
	
	}
	
	function index(){
		$hqaid=$this->input->post('question_id');

		$help_ques_ans=$this->disHelpQuesById($hqaid,$this->input->post('page'));
		echo $help_ques_ans->question."|".$help_ques_ans->answer;
	}
	
function disHelpQuesById($id,$page)
	{
		if($page=='advertise')
			$sql="SELECT * FROM tbl_advertise_content_questions WHERE id=?";
		else
			$sql="SELECT * FROM tbl_content_help_questions WHERE id=?";
		$query=$this->db->query($sql);
		return $query->row();
	}
	
}
?>
