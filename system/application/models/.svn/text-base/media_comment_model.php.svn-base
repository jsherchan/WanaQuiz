<?
class Media_comment_model extends Model {

	function Media_comment_model()
	{
		parent::Model();
		$this->load->library('parser');
		$this->load->model('Email_model');
	}
	
	function get_profile_comments($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select * from tbl_member_comments $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_quiz_comments($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select * from tbl_quiz_comments $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_profile_images($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select * from tbl_member_profile $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_quiz_videos($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select * from tbl_quiz_videos qv, tbl_quizes q where q.quiz_id = qv.quiz_id order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_quiz_images($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select q.*,qi.images,mp.photo_name from tbl_quizes q, tbl_quiz_images qi, tbl_members_photos mp where q.quiz_id=qi.quiz_id and q.image_id=mp.photo_id order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_featured_image_quizes($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select q.quiz_id,q.status,q.featured_quiz,q.try_new_quiz,q.user_id,q.image_id,qi.images,mp.photo_name from tbl_quizes q, tbl_quiz_images qi, tbl_members_photos mp where q.quiz_id=qi.quiz_id and q.image_id=mp.photo_id and q.featured_quiz = '1' order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_featured_video_quizes($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
             $sql = "select * from tbl_quiz_videos qv, tbl_quizes q where q.quiz_id = qv.quiz_id and q.featured_quiz = '1' order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_try_new_image_quizes($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
            $sql = "select q.quiz_id,q.status,q.featured_quiz,q.try_new_quiz,q.user_id,q.image_id,qi.images,mp.photo_name from tbl_quizes q, tbl_quiz_images qi, tbl_members_photos mp where q.quiz_id=qi.quiz_id and q.image_id=mp.photo_id and q.try_new_quiz = '1' order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }

        function get_try_new_video_quizes($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
             $sql = "select * from tbl_quiz_videos qv, tbl_quizes q where q.quiz_id = qv.quiz_id and q.try_new_quiz = '1' order by posted_date desc $limit";
            $query= $this->db->query($sql);
            if($query->num_rows()>0)
            return $query->result();
            else return null;
        }
}
?>
