<?php

class Transaction_model extends Model
{

	function Transaction_model()
	{
		parent::Model();
	}
	
				
	function get_buyers_order_info($num,$offset,$order_title,$order_type,$flag)
	{
		switch($order_title)
		{
			case 'username': 
				$orderby="ORDER BY b.username";
			break;
			
			case 'auc_name': 
				$orderby="ORDER BY p.auc_name";
			break;
			
			case 'gross_amount': 
				$orderby="ORDER BY t.gross_amount";
			break;
			
			case 'pay_time': 
				$orderby="ORDER BY t.pay_time";
			break;
			
			default: 
				$orderby="ORDER BY t.pay_time";
			break;
		}
		if($flag==0)
			$item_name="Won Auction Purchase";
		if($flag==1)
			$item_name="Normal Auction Purchase";
			
		$sql="SELECT b.username, p.auc_id, p.auc_name, t.gross_amount, t.payment_status, t.pay_time, t.invoice,t.memberid FROM transaction_info t LEFT OUTER JOIN (SELECT * FROM tbl_memberinfo)b ON t.memberid=b.user_id, tbl_products p WHERE t.auction_id=p.auc_id AND t.item_name='".$item_name."'  ".$orderby." ".$order_type." limit $offset,$num";
		$info=$this->db->query($sql);
		return $info->result();
			
	}
	
	function get_transaction_by_id($id)
	{
		$this->db->where('invoice',$id);
		$query=$this->db->get('transaction_info');
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return NULL;
		
	
	}
	
}

?>