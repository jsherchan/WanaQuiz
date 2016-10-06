<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moderator_activities extends Controller
{
    function __construct()
    {
        parent::Controller();
        $this->load->model('moderator_activities_model');
        $this->load->model('Forum_model');     
        $this->load->model('Moderator_management_model');     
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    
    function index()
    {
        $config['base_url'] = site_url('admin/moderator_activities/index/');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['total_rows']= $this->moderator_activities_model->count_activities_user();
        $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['modarator_list'] = $this->moderator_activities_model->get_activities_user($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/modeartor_activities';        
        $this->load->view('admin/admin',$data);
    }
    
     function unblock()
   {
                    $id=$this->input->post('id');
                    $url=$this->input->post('item_type');
                    $item_id=$this->input->post('item_id');
                if($url=='quizes')
                {
                    $this->db->where('quiz_id',$item_id);
                    $this->db->update('tbl_quizes',array('status'=>'1'));
                    $this->db->where('id',$id);
                    $this->db->update('tbl_moderator_activities',array('action'=>'Quiz is Unblocked'));
                    $this->session->set_flashdata('msg','Quiz is Unblocked');
                    return true;
                    
                }
                 else if($url=='discussion')
                {
                    $this->db->where('disc_id',$item_id);
                    $this->db->update('tbl_discussion',array('flag'=>'1'));
                    $this->session->set_flashdata('msg','Thread is Unblocked');
                    $this->db->where('id',$id);
                    $this->db->update('tbl_moderator_activities',array('action'=>'Thread is Unblocked'));
                    return true;
                                     
                }
                else
                {
                    $this->session->set_flashdata('msg','Fail to do Operation');
                   return true;
                }   
               return false;
   }
   function undelete()
   {
            $id=$this->input->post('id');
            $url=$this->input->post('item_type');
            $item_id=$this->input->post('item_id');
          if($url=='quizes')
          {
                $this->db->where('quiz_id',$item_id);
                $this->db->update('tbl_quizes',array('status'=>'1'));
                $this->db->where('id',$id);
                $this->db->update('tbl_moderator_activities',array('action'=>'Quiz is Undeleted'));
                $this->session->set_flashdata('msg','Quiz is Undeleted');
                return true;
                
          }
          else if($url=='discussion')
          {
                $this->db->where('disc_id',$item_id);
                $this->db->update('tbl_discussion',array('flag'=>'1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Thread is Undeleted'));
                $this->session->set_flashdata('msg','Thread is Undeleted');
                return true;
              
          }
          else if($url=='quiz_comments')
          {
              $this->db->where('comment_id',$item_id);
                $this->db->update('tbl_quiz_comments',array('status'=>'1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Comment is Undeleted'));
                $this->session->set_flashdata('msg','Comment is Undeleted');
                return true;
          }
          else if($url=='discussion_comment') 
              
          {
                 $this->db->where('id',$item_id);
                $this->db->update('tbl_discussion_comment',array('status'=>'1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Post is Undeleted'));
                $this->session->set_flashdata('msg','Post is Undeleted');
                return true;
          }
          else if($url=='member_comments') 
              
          {
                 $this->db->where('comment_id',$item_id);
                $this->db->update('tbl_member_comments',array('status'=>'1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Text is Undeleted'));
                $this->session->set_flashdata('msg','Text is Undeleted');
                return true;
          }
          else 
          {
                $this->session->set_flashdata('msg','Fail to do Operation');
                return true;
          }
               
              return false;
          
   }
   function delete()
   {
             $id=$this->input->post('id');
            $url=$this->input->post('item_type');
            $item_id=$this->input->post('item_id');
            echo $id;
            echo $item_type;
            echo $item_id;
          if($url=='quizes')
          {
                $this->db->where('quiz_id',$item_id);
                $this->db->update('tbl_quizes',array('status'=>'-1'));
                $this->db->where('id',$id);
                $this->db->update('tbl_moderator_activities',array('action'=>'Quiz is Deleted'));
                $this->session->set_flashdata('msg','Quiz is Deleted');
                return true;
                
          }
          else if($url=='discussion')
          {
                $this->db->where('disc_id',$item_id);
                $this->db->update('tbl_discussion',array('flag'=>'-1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Thread is Deleted'));
                $this->session->set_flashdata('msg','Thread is Deleted');
                return true;
                              
          }
          else if($url=='quiz_comments')
          {
              $this->db->where('comment_id',$item_id);
                $this->db->update('tbl_quiz_comments',array('status'=>'-1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Comment is Deleted'));
                $this->session->set_flashdata('msg','Comment is Deleted');
                return true;
          }
          else if($url=='discussion_comment') 
              
          {
                 $this->db->where('id',$item_id);
                $this->db->update('tbl_discussion_comment',array('status'=>'-1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Post is Deleted'));
                $this->session->set_flashdata('msg','Post is Deleted');
                return true;
          }
          else if($url=='member_comments') 
              
          {
                 $this->db->where('comment_id',$item_id);
                $this->db->update('tbl_member_comments',array('status'=>'-1'));
                 $this->db->where('id',$id);
                  $this->db->update('tbl_moderator_activities',array('action'=>'Text is Deleted'));
                $this->session->set_flashdata('msg','Text is Deleted');
                return true;
                          }
          else 
          {
                $this->session->set_flashdata('msg','Fail to do Operation');
               return true;
          }
               
             return false;
          
   }
   
   
    function block()
   {            
                $id=$this->input->post('id');
                $url=$this->input->post('item_type');
                $item_id=$this->input->post('item_id');
                 if($url=='quizes')
                  {
                    $this->db->where('quiz_id',$item_id);
                    $this->db->update('tbl_quizes',array('status'=>'0'));
                     $this->db->where('id',$id);
                    $this->db->update('tbl_moderator_activities',array('action'=>'Quiz is Blocked'));
                    $this->session->set_flashdata('msg','Quiz is Blocked');
                    return true;
                 }
                 else if($url=='discussion')
                {
                    $this->db->where('disc_id',$item_id);
                    $this->db->update('tbl_discussion',array('flag'=>'0'));
                     $this->db->where('id',$id);
                    $this->db->update('tbl_moderator_activities',array('action'=>'Thread is Blocked'));
                    $this->session->set_flashdata('msg','Thread is Blocked');
                    return true;
                }
                  
                else 
                {
                    $this->session->set_flashdata('msg','Fail to do Operation');
                    return true;
                }
                return false;
          }
   function moderator_activity_by_user($user_id)
   {
      $config['base_url'] = site_url('admin/moderator_activities/moderator_activity_by_user/'.$user_id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 5;
        $config['total_rows']= $this->moderator_activities_model->count_activities_by_user($user_id);
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['moderator_list'] = $this->moderator_activities_model->get_activities_by_user($user_id,$config['per_page'], $this->uri->segment(5, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/moderator_activity_user';        
        $this->load->view('admin/admin',$data);
   }
   function deleted_items()
   {
       $config['base_url'] = site_url('admin/moderator_activities/deleted_items');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
      //  $config['total_rows']= $this->moderator_activities_model->count_activities_by_user($user_id);
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_items($config['per_page'], $this->uri->segment(4, 0));
      
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/moderator_activity_user';        
        $this->load->view('admin/admin',$data);
   }
   function deleted_quiz()
   {
        $config['base_url'] = site_url('admin/moderator_activities/deleted_quiz');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['total_rows']= $this->moderator_activities_model->count_deleted_quiz();
        $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_quiz($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/deleted_quiz';        
        $this->load->view('admin/admin',$data);
    }
    function deleted_quiz_reaction()
   {
         $config['base_url'] = site_url('admin/moderator_activities/deleted_quiz_reaction');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
       $config['total_rows']= $this->moderator_activities_model->count_deleted_quiz();
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_quiz_reaction($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/deleted_quiz_reaction';        
        $this->load->view('admin/admin',$data);
    }
    function deleted_thread()
   {
   $config['base_url'] = site_url('admin/moderator_activities/deleted_items');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
       $config['total_rows']= $this->moderator_activities_model->count_deleted_threads();
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_threads($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/deleted_thread';        
        $this->load->view('admin/admin',$data);
    }
    function deleted_thread_reaction()
   {
         $config['base_url'] = site_url('admin/moderator_activities/deleted_thread_reaction/');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
       $config['total_rows']= $this->moderator_activities_model->count_deleted_post();
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_post($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/deleted_thread_reaction';        
        $this->load->view('admin/admin',$data);
    }
    
     function deleted_text_reaction()
   {
         $config['base_url'] = site_url('admin/moderator_activities/deleted_text_reaction/');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
       $config['total_rows']= $this->moderator_activities_model->count_deleted_text();
       $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
        $data['deleted_list'] = $this->moderator_activities_model->get_deleted_text($config['per_page'], $this->uri->segment(4, 0));
        $data['title'] = 'Moderator Activities';
        $data['main'] = 'admin/deleted_text_reaction';        
        $this->load->view('admin/admin',$data);
    }
   
    function reported_quiz()
    {
            $config['base_url'] = site_url('admin/moderator_activities/reported_quiz');
            $config['total_rows'] = $this->Moderator_management_model->count_question_report();
           
            $config['per_page'] = 10;
            $config['uri_segment'] = 4;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['reported_item']=$this->Moderator_management_model->get_quiz_content_report($config['per_page'], $this->uri->segment(4, 0));
            $data['main']="admin/reported_quiz";
           $this->load->view('admin/admin',$data);
    }
      function reported_quiz_reaction()
    {
           
             $config['base_url'] = site_url('admin/moderator_activities/reported_quiz_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_quiz_reaction();
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;
            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['reported_reaction']=$this->Moderator_management_model->get_quiz_reaction($config['per_page'], $this->uri->segment(4, 0));
           
            $data['main']="admin/reported_quiz_reaction";
             $this->load->view('admin/admin',$data);
    }
    function reported_thread()
    {
           $config['base_url'] = site_url('admin/moderator_activities/reported_thread');
            $config['total_rows'] = $this->Moderator_management_model->count_reported_discussion();
            
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;

           $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['discussion_report']=$this->Moderator_management_model->get_reported_discisson($config['per_page'], $this->uri->segment(4, 0));
             $data['main']="admin/reported_thread";
           $this->load->view('admin/admin',$data);
        
    }
   function reported_thread_reaction()
    {
            
             $config['base_url'] = site_url('admin/moderator_activities/reported_thread_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_discussion_reaction();
                       
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['discussion_reaction']=$this->Moderator_management_model->get_discisson_reaction($config['per_page'], $this->uri->segment(4, 0));
              $data['main']="admin/reported_thread_reaction";
           $this->load->view('admin/admin',$data);
    }
    
    function reported_text_reaction()
    {
            
             $config['base_url'] = site_url('admin/moderator_activities/reported_text_reaction');
            $config['total_rows'] = $this->Moderator_management_model->count_member_text_raction();
                       
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['text_reaction']=$this->Moderator_management_model->get_member_text_reaction($config['per_page'], $this->uri->segment(4, 0));
              $data['main']="admin/reported_text_reaction";
           $this->load->view('admin/admin',$data);
    }
    
    //Reported Items
    //Reported Quiz
    function delete_quiz()
    {
            $id=$this->input->post('report_id');
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_quiz_reports');
           
            $quiz_id=$this->input->post('quiz_id');
            $this->db->where('quiz_id',$quiz_id);
            $delete_date=date('Y-m-d H:i:s');
            $query = $this->db->update('tbl_quizes',array('status'=>'-1','deleted_date'=>$delete_date));
           return true;
    }
     function delete_report()
    {
            $id=$this->input->post('report_id');
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_quiz_reports');
            return true;
    }
     function quiz_blockunblock()
    {   
           
            $quiz_id=$this->input->post('quiz_id');
            $status=$this->input->post('status');
            $this->db->where('quiz_id',$quiz_id);
            if($status==0)
            {
            $query = $this->db->update('tbl_quizes',array('status'=>'1'));
            }
            else 
            {
             $query = $this->db->update('tbl_quizes',array('status'=>'0'));
            }
              return true;
     }
     
     //Reported Quiz Reaction 
     function quizeditComment()
    {
            $comment_id=$this->input->post('comment_id');
            $comment=$this->input->post('comment');
            $this->db->where('comment_id',$comment_id);
            $this->db->update('tbl_quiz_comments',array('comment'=>$comment));
            
             return true;
    }
    
    function delete_comment()
    {  
            $id=$this->input->post('comment_id');
            $this->db->where('comment_id',$id);
            $query=$this->db->update('tbl_quiz_comments',array('status'=>'-1', 'deleted_date'=>date("Y-m-d H:i:s")));
                                    
            return true;
    }
    //Reported Discussion 
     function discussion_report_blockunblock()
    {
            $disc_id=$this->input->post('disc_id');
            $flag=$this->input->post('flag');
            
            $this->db->where('disc_id',$disc_id);
            if($flag==0)
            {
            $query = $this->db->update('tbl_discussion',array('flag'=>'1'));
            }
            else 
            {
            $query = $this->db->update('tbl_discussion',array('flag'=>'0'));
            }
           return true;
    }
     function delete_discussion()
    {
            $id=$this->input->post('report_id');
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_discussion_report');
            
            $disc_id=$this->input->post('disc_id');
            $this->db->where('disc_id',$disc_id);
            $query = $this->db->update('tbl_discussion',array('flag'=>'-1','deleted_date'=>date('Y-m-d H:i:s')));
           return true;
    }
    function delete_discussion_report()
    {
            $id=$this->input->post('report_id');
            $this->db->where('id',$id);
            $query=$this->db->delete('tbl_discussion_report');
            return true;
    }
    
    // Report Discussion Reaction 
    function delete_discussion_comment()
    {
            $id=$this->input->post('comment_id');
            $this->db->where('id',$id);
            $query=$this->db->update('tbl_discussion_comment',array('status'=>'-1','deleted_date'=>date("Y-m-d H:i:s")));
           return true;
    }
    
    function discussion_comment_edit()
   {
            $id=$this->input->post('comment_id');
            $datas['comment']=$this->input->post('comment');
            $this->db->where('id',$id);
            $datas['comment_date']=date('Y:m:d H:i:s');
            $this->db->update('tbl_discussion_comment',$datas);
            return true;
   }
   //Reported Member Text Reacton 
   function delete_text_comment()
    {
            $id=$this->input->post('comment_id');
            $this->db->where('comment_id',$id);
            $query=$this->db->update('tbl_member_comments',array('status'=>'-1','deleted_date'=>date("Y-m-d H:i:s")));
           return true;
    }
    
    function text_comment_edit()
   {
            $id=$this->input->post('comment_id');
            $datas['comment']=$this->input->post('comment');
            $this->db->where('comment_id',$id);
            $datas['coment_date']=date('Y:m:d H:i:s');
            $this->db->update('tbl_member_comments',$datas);
            echo $this->db->last_query();
            exit;
            return true;
   }
   function flagged_quiz()
   {
        $config['base_url'] = site_url('admin/moderator_activities/flagged_quiz');
            $config['total_rows'] = $this->moderator_activities_model->count_flagged_quiz();
                       
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['flagged_quiz']=$this->moderator_activities_model->get_flagged_quiz($config['per_page'], $this->uri->segment(4, 0));
            $data['main']="admin/flagged_quiz";
           $this->load->view('admin/admin',$data); 
   }
    function flagged_thread()
   {
        $config['base_url'] = site_url('admin/moderator_activities/flagged_thread');
            $config['total_rows'] = $this->moderator_activities_model->count_flagged_thread();
                       
            $config['per_page'] = 5;
            $config['uri_segment'] = 4;

            $config['first_link'] = ' ';
            $config['last_link'] = ' ';
            $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
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
     
            $data['flagged_thread']=$this->moderator_activities_model->get_flagged_thread($config['per_page'], $this->uri->segment(4, 0));
              $data['main']="admin/flagged_thread";
           $this->load->view('admin/admin',$data); 
           
   }
   
    
}

