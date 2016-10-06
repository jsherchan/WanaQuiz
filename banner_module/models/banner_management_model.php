<?php
class Banner_management_model extends Model {

	function Banner_management_model()
	{
		parent::Model();	
	}
	
	
	function banner_list()
	{
		$data=array();
		$query = $this->db->get('tbl_banners');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[]=$rows;							
				}
			
			$query->free_result();
		return $data;
		}
	}
		
	function get_banner_info($banner_id)
	{		
		$options=array('ban_id'=>$banner_id);
		$query = $this->db->getwhere('tbl_banners',$options,1);
		
		return $query->row();
	
	}
	
		
	function update_banner(){
	$data=array('ban_name'=>$_POST['banner_name'],
							'ban_location'=>$_POST['banner_location'],
							'ban_url'=>$_POST['banner_url'],
							'ban_active'=>$_POST['active'],'ban_date_added'=>date('Y-m-d H:i:s'));
	$this->db->where('ban_id',$this->input->post('banner_id'));
	$this->db->update('tbl_banners',$data);
	
	if($_FILES['banner']['name']!=""){
		$data=array('ban_image'=>$_FILES['banner']['name']);
		$this->db->where('ban_id',$_POST['banner_id']);
		$this->db->update('tbl_banners',$data);
		}
	}
		
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */