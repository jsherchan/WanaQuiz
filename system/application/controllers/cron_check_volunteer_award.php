<?php 
class Cron_check_volunteer_award extends Front_Controller {

	function Cron_check_volunteer_award()
	{
		parent::Front_Controller();
                
	
	}

	function index(){
            $this->load->model('Cron_check_volunteer_award_model');
            //echo $this->session->userdata('wannaquiz_user_id');
            $this->Cron_check_volunteer_award_model->check_moderator_activity_point($this->session->userdata('wannaquiz_user_id'));
        }

}
