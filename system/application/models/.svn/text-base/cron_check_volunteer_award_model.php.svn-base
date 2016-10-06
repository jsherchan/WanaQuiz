<?php 
ob_start();
class Cron_check_volunteer_award_model extends Model {

	function Cron_check_volunteer_award_model()
	{
		parent::Model();
                $this->load->model('Award_model');
	}
	function check_moderator_activity_point($user_id){
            
            //$user_id = $this->session->userdata('wannaquiz_user_id');
               $user_award = $this->Award_model->check_user_volunteer_awards($this->session->userdata('wannaquiz_user_id'));
           if($user_award<1) {
            $this->db->where('moderator_id',$user_id);
            $query = $this->db->get('tbl_moderator_activities');
            //$query = $this->db->get();
            if($query->num_rows()>20){
                 $this->Award_model->insertVolunteerAward($user_id);
               
                    }
             }
        }

}
?>

