<?
class Change_password_model extends Model {

	function Change_password_model()
	{
		parent::Model();
	}
	
	function checkold_password($user_name,$old_password)
	{
		$this->db->select('id');
		$this->db->where('username',$user_name);
		$this->db->where('password',$old_password);
		
		$query=$this->db->get('tbl_administrators');
		
		if ($query->num_rows()>0)
		{
			$row=$query->row_array();
			return $row['id']; 
		}
		else{
		return 0;
		}
	}

}



?>