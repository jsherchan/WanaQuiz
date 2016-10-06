<?php
class Moderator_management extends Front_controller {

   
    function Moderator_management() {

        parent::Front_controller();
          $this->load->model('Quiz_model');
        $this->load->model('Pages_model');
        $this->load->model('Moderator_management_model');
         $this->load->model('Moderator_activities_model');
         $this->load->model('Cron_check_volunteer_award_model');
         $this->load->library('pagination');
       
    }
       
    function index()
    {
        $this->checkMemberLogin();
       //filter adult
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        //filter adult
        $data['title']="Modolator Page";
        $data['mem_info']=$this->Member_model->get_member($this->user_id);
        $data['mem_page_data']= $this->Pages_model->get('introduction');
        $data['main']="member/modeartor_quiz_report";
         $config['base_url'] = site_url('/moderator_management');
            $config['total_rows'] = $this->Moderator_management_model->count_question_report();
            
            $config['per_page'] = 10;
            $config['uri_segment'] = 2;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['question_report']=$this->Moderator_management_model->get_quiz_content_report($config['per_page'], $this->uri->segment(2, 0));
        $this->load->view('moderatorhome',$data);
    }
    function quiz_content_reprot()
    {
            $this->checkMemberLogin();
              //filter adult
                 $uid = $this->session->userdata('wannaquiz_user_id');
                $data['mem_info']=$this->Member_model->get_member($uid);
                $data['filter'] = $data['mem_info']->filter_adult;

                if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                else $this->session->unset_userdata('filtered');
                //filter adult end
            $config['base_url'] = site_url('/moderator_management/quiz_content_reprot');
            $config['total_rows'] = $this->Moderator_management_model->count_question_report();
            
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['question_report']=$this->Moderator_management_model->get_quiz_content_report($config['per_page'], $this->uri->segment(3, 0));
            $data['main']="member/modeartor_quiz_report";
            $this->load->view('moderatorhome',$data);
        
    }
    function quiz_report_blockunblock()
    {   
           
            $quiz_id=$this->input->post('quiz_id',TRUE);
            $status=$this->input->post('status',TRUE);
            $this->db->where('quiz_id',$quiz_id);
            if($status==0)
            {
            $data['action']="Quiz was Unblocked";
            $query = $this->db->update('tbl_quizes',array('status'=>'1'));
            }
            else 
            {
            $data['action']="Quiz was Blocked";
            $query = $this->db->update('tbl_quizes',array('status'=>'0'));
            }
            $data['item_type']="quizes";
            $data['item_id']=$quiz_id;                                                                //insert to activity table
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
           
    }
    
    function delete_report()
    {
            $id=$this->input->post('report_id',TRUE);
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_quiz_reports');
            $quiz_id=$this->input->post('quiz_id',TRUE);
            $data['item_id']=$id;
            $data['item_type']="quiz_reports";
            $data['action']="Report was Deleted";

            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
             $this->db->where('quiz_id',$quiz_id);
             $this->db->update('tbl_quizes', array('status'=>'1'));
              $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
   
    function delete_comment()
    {
            $id=$this->input->post('comment_id',TRUE);
            $this->db->where('comment_id',$id);
            $query=$this->db->update('tbl_quiz_comments',array('status'=>'-1', 'deleted_date'=>date("Y-m-d H:i:s")));
                                     //insert to activity table
            $data['item_type']="quiz_comments";
            $data['item_id']=$id;        
            $data['action']="Comment was  Deleted";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
             $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
   
    function delete_quiz()
    {
            $id=$this->input->post('report_id',TRUE);
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_quiz_reports');
            
            $quiz_id=$this->input->post('quiz_id',TRUE);
            $this->db->where('quiz_id',$quiz_id);

            $delete_date=date('Y-m-d H:i:s');
            $query = $this->db->update('tbl_quizes',array('status'=>'-1','deleted_date'=>$delete_date));
              
            $data['item_type']="quizes";
            $data['item_id']=$quiz_id;        
            $data['action']="Quiz was Deleted";                                                                 //insert to activities table

            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
             $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
    
    function quiz_reaction()
    {
            $this->checkMemberLogin();
            //filter adult
                 $uid = $this->session->userdata('wannaquiz_user_id');
                $data['mem_info']=$this->Member_model->get_member($uid);
                $data['filter'] = $data['mem_info']->filter_adult;

                if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                else $this->session->unset_userdata('filtered');
                //filter adult end
            $config['base_url'] = site_url('/moderator_management/quiz_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_quiz_reaction();
            
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

           $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['question_reaction']=$this->Moderator_management_model->get_quiz_reaction($config['per_page'], $this->uri->segment(3, 0));
           
            $data['main']="member/moderator_quiz_reaction";
       
            $this->load->view('moderatorhome',$data);
    }
    
    function quizeditComment()
    {
            $comment_id=$this->input->post('comment_id',TRUE);
            $comment=$this->input->post('comment',TRUE);
            $this->db->where('comment_id',$comment_id);
            $this->db->update('tbl_quiz_comments',array('comment'=>$comment,'status'=>'1'));
            
     //insert to activity table
            $data['item_type']="quiz_comments";
            $data['item_id']=$comment_id;        
            $data['action']="Comment was Edited";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data);
             $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
             return true;
    }
    
    function forum_discussion_report()
    {
            $this->checkMemberLogin();
           //filter adult
                 $uid = $this->session->userdata('wannaquiz_user_id');
                $data['mem_info']=$this->Member_model->get_member($uid);
                $data['filter'] = $data['mem_info']->filter_adult;

                if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                else $this->session->unset_userdata('filtered');
                //filter adult end
            $config['base_url'] = site_url('/moderator_management/forum_discussion_report');
            $config['total_rows'] = $this->Moderator_management_model->count_reported_discussion();
            
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['discussion_report']=$this->Moderator_management_model->get_reported_discisson($config['per_page'], $this->uri->segment(3, 0));
            $data['main']="member/moderator_discussion_report";
            $this->load->view('moderatorhome',$data);
        
    }
    
     function discussion_report_blockunblock()
    {
            $disc_id=$this->input->post('disc_id',TRUE);
            $flag=$this->input->post('flag',TRUE);
            
            $this->db->where('disc_id',$disc_id);
            if($flag==0)
            {
            $data['action']="Thread was Unblocked";    
            $query = $this->db->update('tbl_discussion',array('flag'=>'1'));
            }
            else 
            {
           $data['action']="Thread was Blocked"; 
            $query = $this->db->update('tbl_discussion',array('flag'=>'0'));
            }
                        //insert to activity table
            $data['item_type']="discussion";
            $data['item_id']=$disc_id;        
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data);
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
    
    function delete_discussion_report()
    {
            $id=$this->input->post('report_id',TRUE);
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_discussion_report');
            $disc_id=$this->input->post('disc_id',TRUE);
            $this->db->where('disc_id',$disc_id);
            $this->db->update('tbl_discussion',array('flag'=>'1'));
                                                                              //insert to activity table;
            $data['item_type']="discussion_report";
            $data['item_id']=$id;        
            $data['action']="Thread Report was Deleted";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
    function delete_discussion()
    {
            $id=$this->input->post('report_id',TRUE);
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_discussion_report');
            
            $disc_id=$this->input->post('disc_id',TRUE);
            $this->db->where('disc_id',$disc_id);
            $query = $this->db->update('tbl_discussion',array('flag'=>'-1','deleted_date'=>date('Y-m-d H:i:s')));
                        //insert to activities table
             $data['item_type']="discussion";
            $data['item_id']=$disc_id;        
            $data['action']="Thread was Deleted";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
             $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
    
    function fourm_discussion_reaction()
    {
             $this->checkMemberLogin();
           //filter adult
                 $uid = $this->session->userdata('wannaquiz_user_id');
                $data['mem_info']=$this->Member_model->get_member($uid);
                $data['filter'] = $data['mem_info']->filter_adult;

                if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                else $this->session->unset_userdata('filtered');
                //filter adult end
             $config['base_url'] = site_url('/moderator_management/fourm_discussion_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_discussion_reaction();
          
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['discussion_reaction']=$this->Moderator_management_model->get_discisson_reaction($config['per_page'], $this->uri->segment(3, 0));
            $data['main']="member/moderator_discussion_reaction";
            $this->load->view('moderatorhome',$data);
    }
    function delete_discussion_comment()
    {
        
           $id=$this->input->post('comment_id',TRUE);
            $this->db->where('id',$id);
            $query=$this->db->update('tbl_discussion_comment',array('status'=>'-1','deleted_date'=>date("Y-m-d H:i:s")));
                                                                                   //insert to activity table
            $data['item_type']="discussion_comment";
            $data['item_id']=$id;        
            $data['action']="Post was Deleted";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
             $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
    }
   function discussion_comment_edit()
   {
            $id=$this->input->post('comment_id',TRUE);
            $datas['comment']=$this->input->post('comment',TRUE);
            $this->db->where('id',$id);
            $datas['comment_date']=date('Y:m:d H:i:s');
            $this->db->update('tbl_discussion_comment',$datas);
            
     //insert to activity table
            $data['item_type']="discussion_comment";
            $data['item_id']=$id;        
            $data['action']="Post was Edited";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data);
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            
             return true;
   }
   
 function memeber_text_reaction()
   {
            $this->checkMemberLogin();
            //filter adult
                 $uid = $this->session->userdata('wannaquiz_user_id');
                $data['mem_info']=$this->Member_model->get_member($uid);
                $data['filter'] = $data['mem_info']->filter_adult;

                if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                else $this->session->unset_userdata('filtered');
                //filter adult end
            $config['base_url'] = site_url('/moderator_management/memeber_text_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_member_text_raction();
            
            $config['per_page'] = '5';
            $config['uri_segment'] = 3;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix">';
            $config['cur_tag_open'] = '<li class="active">';
            $config['cur_tag_close'] = '</li>';
            $config['full_tag_close'] = '</ul>';
            $config['next_link'] = '<li>Next &raquo;';
            $config['prev_tag_open'] = '<li>';
             $config['prev_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo; Prev';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';

            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
     
            $data['text_reaction']=$this->Moderator_management_model->get_member_text_reaction($config['per_page'], $this->uri->segment(3, 0));
            $data['main']="member/moderator_text_reaction";
            $this->load->view('moderatorhome',$data);
   }
   function delete_test_comment()
   {
            $id=$this->input->post('comment_id',TRUE);
            $this->db->where('comment_id',$id);
            $query=$this->db->update('tbl_member_comments',array('status'=>'-1','deleted_date'=>date("Y-m-d H:i:s")));
                                                                                   //insert to activity table
            $data['item_type']="member_comments";
            $data['item_id']=$id;        
            $data['action']="Text was Deleted";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data); 
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
            return true;
   }
    function text_comment_edit()
    {
            $id=$this->input->post('comment_id',TRUE);
            $datas['comment']=$this->input->post('comment',TRUE);
            $this->db->where('comment_id',$id);
            $datas['coment_date']=date('Y:m:d H:i:s');
            print_r($datas);
            $this->db->update('tbl_member_comments',$datas);
            
     //insert to activity table
            $data['item_type']="member_comments";
            $data['item_id']=$id;        
            $data['action']="Text was Edited";
            $data['date']=date('Y:m:d H:i:s');
            $data['moderator_id']=$this->session->userdata('wannaquiz_user_id');
            $this->db->insert('tbl_moderator_activities',$data);
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
             return true;
   }
   

  
}
//member/regular_member_home
?>