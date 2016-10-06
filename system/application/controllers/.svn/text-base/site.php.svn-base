<?php 
class Cron_check_referring_award extends Front_Controller {

	function Cron_check_referring_award()
	{
		parent::Front_Controller();
                
	
	}

	function index(){
            $this->load->model('Cron_check_referring_award_model');
            $this->Cron_check_referring_award_model->check_referring_user_point($this->session->userdata('wannaquiz_user_id'));
        }

}
