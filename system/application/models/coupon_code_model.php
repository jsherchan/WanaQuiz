<?
class Coupon_code_model extends Model
{

	function Coupon_code_model()
	{
		parent::Model();
	}
	
	function insert()
	{
		$data=array('coupon_code'=>$this->input->post('coupon_code',TRUE),'amount'=>$this->input->post('amount',TRUE),'activated'=>$this->input->post('activated',TRUE),'validity_days'=>$this->input->post('validity_days',TRUE),'added_date'=>current_date_time_stamp());
		$this->db->insert('tbl_coupons',$data);
		$id=mysql_insert_id();
		return $id;
       
	}
	
	function get_all_coupons_info($sort_field,$sort_order,$num,$offset)
	{
		if($num==0 && $offset==0)
			$limit="";
		else
			$limit=" LIMIT $offset,$num";
		
		$orderby=" ORDER BY $sort_field $sort_order";
		
		$sql="SELECT * FROM tbl_coupons ".$orderby." ".$limit;
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function get_coupon_info_by_id($id)
	{
		$sql="SELECT * FROM tbl_coupons WHERE ID=?";
		$query=$this->db->query($sql,array($id));
		return $query->row();
	}
	
	function edit()
	{ 
        $sql="UPDATE tbl_coupons SET coupon_code='".$this->input->post('coupon_code',TRUE)."',
			amount='".$this->input->post('amount')."',activated='".$this->input->post('activated',TRUE)."',validity_days='".$this->input->post('validity_days',TRUE)."' WHERE id=?";
		$this->db->query($sql,array($this->input->post('id',TRUE)));
	
	}
	
	function check_coupon_code_exist($coupon_code){
		$sql="SELECT * FROM tbl_coupons WHERE coupon_code=? AND activated='no'";
		$query=$this->db->query($sql,array($coupon_code));
		$data=$query->row();
		if($query->num_rows()==0)
			return 0;
		else
			return $data->ID;					
	}
	function get_user_budget($id)
        {
            $sql="select*from tbl_coupons where user_id=$id";
            $query=$this->db->query($sql);
            return $query->row_array();
            
        }
}

?>