<? 

class Advertise_content_model extends Model {

	function Advertise_content_model()
	{
		parent::Model();
	}
	
	function add_content_questions()
	{
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE),
                                           'url_link'=>$this->input->post('url',TRUE),
					   'date_added'=>current_date_time_stamp());
		$this->db->insert('tbl_advertise_content_questions',$options);
		
	}
	
	function edit_content_question(){
		$qes_id=$this->input->post('id',TRUE);
		$options=array('question'=>$this->input->post('question',TRUE),
					   'answer'=>$this->input->post('answer',TRUE),
					   'sort_order'=>$this->input->post('sort_order',TRUE),
                                           'url_link'=>$this->input->post('url',TRUE)
					   );
		$this->db->where('id',$qes_id);					
		$this->db->update('tbl_advertise_content_questions',$options);
	}
		
	//front controller fetching the answer by question		
	function get_content_by_question($ques_id)
	{
		$sql="SELECT * FROM tbl_advertise_content_questions where id=?";
		$query=$this->db->query($sql,array($ques_id));
		return $query->row();
	}
	
	function get_question_info($id)
	{
		$options=array('id'=>$id);
		$query=$this->db->getwhere('tbl_advertise_content_questions',$options);
		return $query->row();
	}
	
	function get_questions(){
		$sql="SELECT * FROM tbl_advertise_content_questions order by sort_order";
		$query=$this->db->query($sql);
		return $query->result();
	}
}
