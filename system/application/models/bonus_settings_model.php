<?

class Bonus_settings_model extends Model
{

	function Bonus_settings_model()
	{
		parent::Model();
	}
	
	function insert_offer()
	{
        $options=array('offer_type'=>$this->input->post('offer_type',TRUE),'amount'=>$this->input->post('amount',TRUE),'bid_credit'=>$this->input->post('bid_credit',TRUE),'activate'=>'no','description'=>$this->input->post('description',TRUE),'validity_days'=>$this->input->post('validity_days',TRUE));
        $this->db->insert('tbloffer',$options);
		$id=mysql_insert_id();
		return $id;
       
	}
	
	function get_all_bonus_offer_info()
	{
		$sql="SELECT * FROM tbloffer";
		$offer_info=$this->db->query($sql);
		foreach($offer_info->result() as $rows)
			$data[]=$rows;
		return $data;
	}
	
	function get_bonus_offer_info_by_id($id)
	{
		$sql="SELECT * FROM tbloffer WHERE offer_id=?";
		$query=$this->db->query($sql,array($id));
		return $query->row();
	}
	
	function edit()
	{
		$options=array('code'=>$this->input->post('code',TRUE),'offer_type'=>$this->input->post('offer_type',TRUE),'amount'=>$this->input->post('amount',TRUE),'bid_credit'=>$this->input->post('bid_credit',TRUE),'activate'=>$this->input->post('activate',TRUE),'description'=>$this->input->post('description',TRUE),'validity_days'=>$this->input->post('validity_days',TRUE));
        $this->db->where('offer_id',$this->input->post('id',TRUE));
        $this->db->update('tbloffer',$options);
	}
	
	function checkAlreadyRedeemCoupon($coupon_code,$user_id){
	
		$sql1="SELECT * FROM tbl_bid_credits_earned WHERE offer_code_characters=? AND mem_id=?";
		$query1=$this->db->query($sql1,array($coupon_code,$user_id));
			if($query1->num_rows()>0)
				return "yes";
			
			else
				return "no";
	}
	
	function insert_code($code_id,$mem_id,$bid_credits){
		$now=date('Y-m-d');
		$sql="INSERT INTO tbl_bid_credits_earned SET offer_code_id='$code_id',mem_id='$mem_id',earned_date='$now',bid_credits_earned='$bid_credits'";
		$result=$this->db->query($sql);
		return $result;
	
	}
	
	function insert_free_coupon_code($id,$code_characters,$mem_id,$bid_credits){
		$now=date('Y-m-d',current_date_time_stamp());
		$sql="INSERT INTO tbl_bid_credits_earned SET offer_code_id='$id',offer_code_characters='$code_characters',mem_id='$mem_id',earned_date='$now',bid_credits_earned='$bid_credits'";
		$result=$this->db->query($sql);
		return $result;
	
	}
	
	function checkDailyFreeBidEarned($mem_id,$offer_id){
		$now=date('Y-m-d');
		$sql="SELECT * FROM tbl_bid_credits_earned WHERE offer_code_id=? AND mem_id=? AND earned_date='$now'";
		$query=$this->db->query($sql,array($offer_id,$mem_id));
		if($query->num_rows()!=0){
				return 0;
			}
			else{
				return 1;
			}
	
	}
	
	function insertCouponRecharge($coupon_id,$mem_id,$bid_credits){
		$now=date('Y-m-d');
		$sql="INSERT INTO tbl_bid_credits_earned SET coupon_code='$coupon_id',mem_id='$mem_id',earned_date='$now',bid_credits_earned='$bid_credits'";
		$this->db->query($sql);
		
	}
	
	
}

?>