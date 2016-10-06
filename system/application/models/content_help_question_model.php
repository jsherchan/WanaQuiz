<? 
class Content_help_question_model extends Model {

	function Content_help_question_model()
	{
		parent::Model();
	}
	
	function add_content_questions()
	{
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE),
					   'date_added'=>current_date_time_stamp());
		$this->db->insert('tbl_content_help_questions',$options);
		
	}
	
	function edit_content_question(){
		$qes_id=$this->input->post('id');
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE)
					   );
		$this->db->where('id',$qes_id);					
		$this->db->update('tbl_content_help_questions',$options);
	}
		
	//front controller fetching the answer by question		
	function get_content_by_question($ques_id)
	{
		$sql="SELECT * FROM tbl_content_help_questions where id=?";
		$query=$this->db->query($sql,array($ques_id));
		return $query->row();
	}
	
	function get_question_info($id)
	{
		$options=array('id'=>$id);
		$query=$this->db->getwhere('tbl_content_help_questions',$options);
		return $query->row();
	}
	
	function get_questions(){
		$sql="SELECT * FROM tbl_content_help_questions order by sort_order";
		$query=$this->db->query($sql);
		return $query->result();
	}
}
