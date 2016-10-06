<?php
ob_start();
class Csvimport extends Controller  {

function Csvimport ()
    {
        parent::Controller();
       // $this->load->database();        
        
    }


function import($filename)
    {  
        $query = $this->db->query("LOAD DATA INFILE 'E:/csv/".$filename."' REPLACE INTO TABLE tbl_coupons FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n' (coupon_code, bid_credits, amount,activated, validity_days) SET added_date='".current_date_time_stamp()."'");
      $this->session->set_flashdata('message','Coupons imported successfully.');  
      redirect(ADMIN_PATH.'/coupons_management/');
    }

}
?> 