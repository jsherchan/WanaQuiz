<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_delete_work extends Controller
{
    function __construct()
    {
        parent::Controller();
        $this->load->model('quiz_model');
        $this->load->model('forum_model');     
        $this->load->model('moderator_activities_model');     
    }
    
    function index()
    {
       
    $result = $this->forum_model->get_deleted_discussion();
    foreach($result as $rows)
        {
            $date_deleted=strtotime($rows['deleted_date']);
            $dateafter =$date_deleted+(30*24*60*60);
            $datenow=strtotime(date('Y-m-d H:i:s'));
            if($dateafter<=$datenow && $rows['flag']==-1)
                {
                    $this->db->where('disc_id',$rows['disc_id']);
                    $this->db->delete('tbl_discussion');
                }
        }
        
     $quiz = $this->quiz_model->get_deleted_quiz();
     foreach($quiz as $rows)
     {
            $date_deleted=strtotime($rows['deleted_date']);
            $dateafter =$date_deleted+(30*24*60*60);
            $datenow=strtotime(date('Y-m-d H:i:s'));
            if($dateafter<=$datenow && $rows['status']==-1)
            {
                $this->db->where('quiz_id',$rows['quiz_id']);
                $this->db->delete('tbl_quizes');
            }
}
      
      $comment = $this->quiz_model->get_deleted_comment();
      foreach($comment as $rows)
     {
            $date_deleted=strtotime($rows['deleted_date']);
            $dateafter =$date_deleted+(30*24*60*60);
            $datenow=strtotime(date('Y-m-d H:i:s'));
            if($dateafter<=$datenow && $rows['status']=='-1')
            {
                $this->db->where('comment_id',$rows['id']);              
                $this->db->delete('tbl_quiz_comments');
            }
     }
     
     $post = $this->forum_model->get_deleted_posts();
     foreach($post as $rows)
     {
           $date_deleted=strtotime($rows['deleted_date']);
           $dateafter =$date_deleted+(30*24*60*60);
           $datenow=strtotime(date('Y-m-d H:i:s'));
           if($dateafter<=$datenow && $rows['status']=='-1')
               {
                    $this->db->where('id',$rows['id']);
                    $this->db->delete('tbl_discussion_comment');
                }
     }

     $moderator_activity = $this->moderator_activities_model->get_moderator_activity();
     foreach($moderator_activity as $rows)
     {
       $date_deleted=strtotime($rows['date']);
       $dateafter =$date_deleted+(60*24*60*60);
       $datenow=strtotime(date('Y-m-d H:i:s'));
       if($dateafter<=$datenow)
              {
                    $this->db->where('id',$rows['id']);
                    $this->db->delete('tbl_moderator_activities');
             }
      }
   }
    
}
?>