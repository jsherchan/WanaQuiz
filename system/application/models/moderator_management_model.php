<?php
class Moderator_management_model extends Model {

	function Moderator_management_model()
	{
		parent::Model();	
	}
	
	
	function moderator_list($num,$limit)
	{
          $sql="select * from tbl_moderator limit ".$limit.",".$num;
           $res=$this->db->query($sql);
            if ($res->num_rows() > 0)
                return $res->result();
            else
                return NULL;
	}
        function count_moderator_list()
        {
            $query = $this->db->get('tbl_moderator');
            if ($query->num_rows() > 0)
                return $query->num_rows();
            else return NULL;
            
        }
		
	function get_moderator_info($id)
	{		
		$options=array('user_id'=>$id);
		$query = $this->db->getwhere('tbl_moderator',$options,1);
		return $query->row();
	}

       
	function update_moderator_data(){
                 
                $data=array('user_type'=>$this->input->post('user_type',TRUE),
                            'percentage'=>$this->input->post('percentage',TRUE),
                        );
                $this->db->where('id',$this->input->post('id',TRUE));
                $this->db->update('tbl_quiz_display',$data);
            
        }
    

    function delete_moderator_data($id){
        $this->db->where('user_id',$id);
      $query = $this->db->delete('tbl_moderator');
        if($query) return true;
        else return false;
    }

    function get_admin_adsense_code(){
        $query = $this->db->get('tbl_site_settings');
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }
    function get_quiz_content_report($num,$limit)
    {
            $sql="SELECT m.username,f.profile_picture, md.quiz_question, md.quiz_id, md.quiz_type,  md.status, i.images, c.id, c.report_type, c.date
            FROM tbl_members m
            JOIN tbl_quizes md ON ( md.user_id = m.user_id )
            join tbl_quiz_images i on (md.quiz_id=i.quiz_id)
            JOIN tbl_quiz_reports c ON ( c.quiz_id = md.quiz_id )
            join tbl_member_profile f on (m.user_id=f.member_id)
             order by c.date desc limit ".$limit.",".$num;
            $res = $this->db->query($sql);
            
             return ($res->result_array());
            
    }
    function count_question_report()
    { 
             $sql="SELECT m.username, md.quiz_question, md.status, c.id, c.report_type, c.date
            FROM tbl_members m
            JOIN tbl_quizes md ON ( md.user_id = m.user_id )
            JOIN tbl_quiz_reports c ON ( c.quiz_id = md.quiz_id )" ;
             $res=$this->db->query($sql);
             return $res->num_rows();
             
        
   }
   function get_quiz_reaction($num,$limit)
   {
       $sql="SELECT m.username, md.quiz_question, md.status, c.comment_id, c.comment_reply_id, c.comment, c.quiz_id, c.comment_date
            FROM tbl_members m
            JOIN tbl_quizes md ON ( md.user_id = m.user_id )
            JOIN tbl_quiz_comments c ON ( c.quiz_id = md.quiz_id ) where c.spam='1' and c.status!='-1' order by c.comment_date desc limit ".$limit.",".$num;
       $res=$this->db->query($sql);
       return ($res->result_array());
   }
   
    function get_reply_comments($id) {
        $sql = "select * from tbl_quiz_comments qc,tbl_members m where qc.user_id=m.user_id and comment_reply_id=? and qc.spam='1'";
        $query = $this->db->query($sql, array($id));
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }
   function count_quiz_reaction()
   {
             $sql="SELECT m.username, md.quiz_question, md.status, c.comment_id,c.comment_reply_id, c.comment, c.quiz_id, c.comment_date
            FROM tbl_members m
            JOIN tbl_quizes md ON ( md.user_id = m.user_id )
            JOIN tbl_quiz_comments c ON ( c.quiz_id = md.quiz_id ) where c.spam='1' and c.status='0' order by c.quiz_id and  c.comment_reply_id ";
             $res=$this->db->query($sql);
             return $res->num_rows();
    }
    
     function get_reported_discisson($num,$limit)
        {
             $sql="SELECT m.username, md.discussion_title,md.disc_id, md.created, md.flag, c.id, c.report_type, c.reported_date
            FROM tbl_members m
            JOIN tbl_discussion md ON ( md.user_id = m.user_id )
            JOIN tbl_discussion_report c ON ( c.disc_id = md.disc_id ) order by c.reported_date  desc limit ".$limit.",".$num;
            $res = $this->db->query($sql);
            
             return ($res->result_array());
    }
    
     function count_reported_discussion()
   {
             $sql="SELECT m.username, md.discussion_title,md.disc_id, md.created, c.id, c.report_type, c.reported_date
            FROM tbl_members m
            JOIN tbl_discussion md ON ( md.user_id = m.user_id )
            JOIN tbl_discussion_report c ON ( c.disc_id = md.disc_id )";
             $res=$this->db->query($sql);
             return $res->num_rows();
    }
    function get_discisson_reaction($num,$limit)
    {
            $sql="SELECT m.username, md.discussion_title, md.flag ,c.comment_reply_id, c.id, c.disc_id, c.comment, c.comment_date
            FROM tbl_members m
            JOIN tbl_discussion md ON ( md.user_id = m.user_id )
            JOIN tbl_discussion_comment c ON ( c.disc_id = md.disc_id ) where c.spam='1' and c.status!='-1' order by c.comment_date desc limit ".$limit.",".$num;
             $res = $this->db->query($sql);
             return ($res->result_array());
    }
    function count_discussion_reaction()
    {
    $sql="SELECT m.username, md.discussion_title, md.flag ,c.comment_reply_id, c.id, c.disc_id, c.comment_date
            FROM tbl_members m
            JOIN tbl_discussion md ON ( md.user_id = m.user_id )
            JOIN tbl_discussion_comment c ON ( c.disc_id = md.disc_id ) where c.spam='1' and c.status!='-1' ";
        $res = $this->db->query($sql);
            return $res->num_rows();
        
    } 
    function get_moderator()
    {
        $sql="select *from tbl_moderator";
        $res=$this->db->query($sql);
        return $res->result_array();
        
    }
     function search_moderator($m){
          $value=$m;
       $qry="select m.*, d.username from tbl_moderator m
                join tbl_members d on m.user_id=d.user_id  where d.username like '%$value%'"; 
         $res= $this->db->query($qry);         
        if($res->num_rows()>0)
            return $res->result_array();
         else
             return NULL;
      }
      
      function get_member_text_reaction($num,$limit)
      {
             $sql="select m.username, c.* from tbl_member_comments c join tbl_members m on m.user_id=c.comentator_id where c.spam='1'  and status!='-1' order by c.coment_date desc limit ".$limit.",".$num;
             $res = $this->db->query($sql);
             return ($res->result_array());
      }
      function count_member_text_raction()
      {
            $sql="select m.username, c.* from tbl_member_comments c join tbl_members m on m.user_id=c.comentator_id where c.spam='1' and status!='-1'" ;
            $res = $this->db->query($sql);
             return $res->num_rows();
      }
}


/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */