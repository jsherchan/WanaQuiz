<?php 
ob_start();
class Cron_check_referring_award_model extends Model {

	function Cron_check_referring_award_model()
	{
		parent::Model();
                $this->load->model('Award_model');
	}

	function check_referring_user_point($user_id){
            
            //$user_id = $this->session->userdata('wannaquiz_user_id');
            $this->db->where('referer_id',$user_id);
            $this->db->where('referring_award','0');
            $query = $this->db->get('tbl_members');
            //$query = $this->db->get();
            if($query->num_rows()>0){
                $data = $query->result();
                //print_r($data); exit;
                foreach($data as $datas){
                    $this->db->where('user_id',$datas->user_id);
                    $query1 = $this->db->get('tbl_position');
                    if($query1->num_rows()>0){
                        $data1 = $query1->row();
                        //print_r($data1); exit;
                        if($data1->total_points>=100){
                            $this->Award_model->insertReferringAward($user_id);
                            $this->db->where('user_id',$datas->user_id);
                            $this->db->update('tbl_members',array('referring_award'=>'1'));
                        }
                    }
                }
            }
        }

}
?>

