<?php
class Payment_setting_model extends Model {

	function Payment_setting_model()
	{
		parent::Model();	
	
	
	}

	function get_payment_info($ps_id)
	{
		
		$options=array('ps_id'=>$ps_id);
		$query = $this->db->getwhere('tbl_payment_settings',$options);
		return $query->row(); 
	}
	
	function update_payment_settings(){
	$data=array('ps_email'=>$this->input->post('ps_email',TRUE),'ps_currency'=>$this->input->post('ps_currency',TRUE));
	$this->db->where('ps_id','1');
	$this->db->update('tbl_payment_settings',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */