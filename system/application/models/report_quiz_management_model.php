<?
class Report_quiz_management_model extends Model {

	function Report_quiz_management_model()
	{
		parent::Model();
		$this->load->library('parser');
		$this->load->model('Email_model');
	}

        function report_list(){
            $sql = "select * from tbl_quiz_reports ";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

	function delete_quiz($quiz_id){
           $this->db->where('quiz_id',$quiz_id);
           $query = $this->db->update('tbl_quizes',array('status'=>'0'));
           if($query)
           $this->delete_quiz_report_data($quiz_id,null);
        }

        function delete_quiz_report_data($quiz_id,$type){
           $this->db->where('quiz_id',$quiz_id);
           if($type!=null)
           $this->db->where('report_type',$type);
           $query = $this->db->delete('tbl_quiz_reports');
        }
}


?>
