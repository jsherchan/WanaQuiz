<?
class Comment_spam_model extends Model {

	function Comment_spam_model()
	{
		parent::Model();
		$this->load->library('parser');
		$this->load->model('Email_model');
	}

	function get_profile_comment_spams(){
            $sql = "select * from tbl_member_comments where spam='1'";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_quiz_comment_spams(){
            $sql = "select * from tbl_quiz_comments where spam='1'";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }
}


?>
