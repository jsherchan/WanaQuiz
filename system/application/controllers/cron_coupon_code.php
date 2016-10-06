<?php
class Cron_coupon_code extends Front_Controller {

	function Cron_coupon_code()
	{
		parent::Front_Controller();


	}

	function index(){
            $query = $this->db->get('tbl_coupons');
            if($query->num_rows()>0)
            $result = $query->result();
            echo $today = strtotime(date('Y-m-d')).'**';
            //echo $today = date('Y-m-d', $today);
            //exit;
            foreach($result as $data){
                $added_date = $data->added_date;
                $number_of_days = $data->validity_days;
                echo '/'.$expire_date = strtotime(date("Y-m-d", $added_date) . " +".$number_of_days." days");
                //echo date('Y-m-d',$exipire_date);
                
                if($expire_date < $today){ echo "hi";
                    $this->db->where('id',$data->id);
                    $query1 = $this->db->update('tbl_coupons',array('activated'=>'no')) ;
                }
            }
            
        }

}
