<? 
class Faq_management_model extends Model {

	function Faq_management_model()
	{
		parent::Model();
	}
	
	function add_help_questions()
	{
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE),
					   'date_added'=>current_date_time_stamp());
		$this->db->insert('tblhelp_questions',$options);
		
	}
	
	function edit_help_question(){
		$qes_id=$this->input->post('id',TRUE);
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE)
					   );
		$this->db->where('id',$qes_id);					
		$this->db->update('tblhelp_questions',$options);
	}
		
	//front controller fetching the answer by question		
	function get_answer_by_question($ques_id)
	{
		$sql="SELECT * FROM tblhelp_questions where id=?";
		$query=$this->db->query($sql,array($ques_id));
		return $query->row();
	}
	
	function get_question_info($id)
	{
		$options=array('id'=>$id);
		$query=$this->db->getwhere('tblhelp_questions',$options);
		return $query->row();
	}
	
	function get_questions(){
		$sql="SELECT * FROM tblhelp_questions order by sort_order";
		$query=$this->db->query($sql);
		return $query->result();
	}
}
