<?php
class Moderator_activities_model extends  Model
{
	function Moderator_activities_model()
	{
		parent::Model();
		
	}
	  function get_activities_user($num,$limit)
        {
            $sql="select m.username, d.* from tbl_members m
            join tbl_moderator_activities d
            on m.user_id=d.moderator_id order by d.action limit ".$limit.",".$num;
           $result=$this->db->query($sql);
           return $result->result();
           
        }
        function count_activities_user()
        {
            $sql="select m.username, d.* from tbl_members m
            join tbl_moderator_activities d
            on m.user_id=d.moderator_id ";
            $res=$this->db->query($sql);
            return $res->num_rows();
        }
        function get_activities_by_user($id,$num,$limit)
        {
            $sql="SELECT m.*, u.username FROM `tbl_moderator_activities` m
                  join tbl_members u on u.user_id=m.moderator_id WHERE m.moderator_id=? group by m.action limit ".$limit.','.$num;
             $res=$this->db->query($sql,array($id));
            return $res->result();
            
        }
         function count_activities_by_user($id)
        {
            $sql="SELECT m.*, u.username FROM `tbl_moderator_activities` m
                  join tbl_members u on u.user_id=m.moderator_id WHERE m.moderator_id=? group by m.action";
            $res=$this->db->query($sql,array($id));
            return $res->num_rows();
            
        }
        function get_deleted_quiz($num,$limit)
        {
            $sql="SELECT q.quiz_question,m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_quizes q , tbl_members m 
                    WHERE q.quiz_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Quiz%'
                    AND ACTION LIKE '%Deleted') order by ma.date desc limit ".$limit.','.$num;
            $res=$this->db->query($sql);
            return $res->result();
         }
          function count_deleted_quiz()
         {
            $sql="SELECT q.quiz_question,m.username,ma.* 
                    FROM tbl_moderator_activities ma , tbl_quizes q , tbl_members m 
                    WHERE q.quiz_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Quiz%'
                    AND ACTION LIKE '%Deleted' )"; 
            $res=$this->db->query($sql);
            return $res->num_rows();
         }
        function get_deleted_quiz_reaction($num,$limit)
         {
               $sql="SELECT q.comment,m.username,ma.*
                FROM tbl_moderator_activities ma , tbl_quiz_comments q , tbl_members m 
                WHERE q.comment_id=ma.item_id 
                AND m.user_id=ma.moderator_id 
                AND ( ACTION LIKE 'Comment%'

                AND ACTION LIKE '%Deleted' ) order by ma.date desc  limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
         function count_deleted_quiz_reaction()
         {
             $sql="SELECT q.comment,m.username,ma.*  
                FROM tbl_moderator_activities ma , tbl_quiz_comments q , tbl_members m 
                WHERE q.comment_id=ma.item_id 
                AND m.user_id=ma.moderator_id 
                AND ( ACTION LIKE 'Comment%'

                AND ACTION LIKE '%Deleted' )";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
         function get_deleted_threads($num,$limit)
         {
             $sql="SELECT d.discussion_title,m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_discussion d , tbl_members m 
                    WHERE d.disc_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Thread%'
                    AND ACTION LIKE '%Deleted'
                    AND ACTION NOT LIKE '%Post%'
                    AND ACTION NOT LIKE '%Report%') order by ma.date desc limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
          function count_deleted_threads()
         {
             $sql="SELECT d.discussion_title,m.username,ma.*  
                    FROM tbl_moderator_activities ma , tbl_discussion d , tbl_members m 
                    WHERE d.disc_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Thread%'
                     AND ACTION LIKE '%Deleted'
                     AND ACTION NOT LIKE '%Post%'
                    AND ACTION NOT LIKE '%Report%') ";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
         function get_deleted_post($num,$limit)
         {
             $sql="SELECT d.comment,m.username,ma.*
                        FROM tbl_moderator_activities ma , tbl_discussion_comment d , tbl_members m 
                        WHERE d.id=ma.item_id 
                        AND m.user_id=ma.moderator_id 
                        AND ( ACTION LIKE 'Post%'

                        AND ACTION LIKE '%Deleted') order by ma.date desc limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
          function count_deleted_post()
         {
             $sql="SELECT d.comment,m.username,ma.* 
                        FROM tbl_moderator_activities ma , tbl_discussion_comment d , tbl_members m 
                        WHERE d.id=ma.item_id 
                        AND m.user_id=ma.moderator_id 
                        AND ( ACTION LIKE 'Post%'

                        AND ACTION LIKE '%Deleted' ) ";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
          function get_deleted_text($num,$limit)
         {
             $sql="SELECT d.comment,m.username,ma.*
                        FROM tbl_moderator_activities ma , tbl_member_comments d , tbl_members m 
                        WHERE d.comment_id=ma.item_id 
                        AND m.user_id=ma.moderator_id 
                        AND ( ACTION LIKE 'Text%'

                        AND ACTION LIKE '%Deleted' ) order by ma.date desc limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
          function count_deleted_text()
         {
             $sql="SELECT d.comment,m.username,ma.* 
                        FROM tbl_moderator_activities ma , tbl_member_comments d , tbl_members m 
                        WHERE d.comment_id=ma.item_id 
                        AND m.user_id=ma.moderator_id 
                        AND ( ACTION LIKE 'Text%'

                        AND ACTION LIKE '%Deleted' ) ";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
         function get_flagged_quiz($num,$limit)
         {
             $sql="SELECT q.quiz_question, q.status,m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_quizes q , tbl_members m 
                    WHERE q.quiz_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Quiz%'
                    AND ACTION LIKE '%Blocked')
                    group by q.quiz_question order by ma.date desc limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
          function count_flagged_quiz()
         {
             $sql="SELECT q.quiz_question, q.status,m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_quizes q , tbl_members m 
                    WHERE q.quiz_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Quiz%'
                    AND ACTION LIKE '%Blocked')
                    group by q.quiz_question";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
          function get_flagged_thread($num,$limit)
         {
             $sql="SELECT d.discussion_title, d.flag, m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_discussion d , tbl_members m 
                    WHERE d.disc_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Thread%'
                    AND ACTION LIKE '%Blocked')
                   group by d.discussion_title  limit ".$limit.','.$num;
             $res=$this->db->query($sql);
             return $res->result();
         }
          function count_flagged_thread()
         {
             $sql="SELECT d.discussion_title, d.flag, m.username,ma.*   
                    FROM tbl_moderator_activities ma , tbl_discussion d , tbl_members m 
                    WHERE d.disc_id=ma.item_id 
                    AND m.user_id=ma.moderator_id 
                    AND ( ACTION LIKE 'Thread%'
                    AND ACTION LIKE '%Blocked')
                   group by d.discussion_title";
             $res=$this->db->query($sql);
             return $res->num_rows();
         }
         function get_moderator_activity()
         {
             $sql="select *from tbl_moderator_activities";
             $res=$this->db->query($sql);
             return $res->result_array();
         }
}
