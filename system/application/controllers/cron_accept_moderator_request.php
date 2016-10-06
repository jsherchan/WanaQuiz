<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_accept_moderator_request extends Controller
{
    function __construct()
    {
        parent::Controller();
        $this->load->model('moderator_management_model'); 
        $this->load->library('email');
    }
     function index()
    {   
                $this->load->library('email');
                $this->email->from('your@example.com', 'Wannaquiz User Your Request is accepted');
                $this->email->to('kabindra@proshore.eu');
                $this->email->subject('Email Test');
                $this->email->message('Testing the email class.');
                $this->email->send();

                
           $moderator=$this->moderator_management_model->get_moderator();
            foreach ($moderator as $rows)
           {
                $a=strtotime($rows['request_time']);
                $a+=(30*60);
                $time_now=strtotime(date('H:i:s'));
                 if($a<=$time_now)
                     {               
                        $this->db->where('user_id',$rows['user_id']);
                        $query = $this->db->update('tbl_members',array('moderator'=>'1'));
                        $query=$this->db->update('tbl_moderator', array('active'=>'1'));
                    }
            }
    }
}
  ?>

