<?
class Security_model extends Model {

	function Security_model()
	{
		parent::Model();
		$this->load->library('parser');
		
	}
	
	function insert_group()
	{
		$options=array('group_name'=>$this->input->post('group_name',TRUE));
		$this->db->insert('tbl_group',$options);
	}
	
	function update_group(){
		$options=array('group_name'=>$this->input->post('group_name',TRUE));
		$this->db->where('ID',$this->input->post('group_id',TRUE));
		$this->db->update('tbl_group',$options);
	}
	
	function delete_group($id){
		
		
		if ($id) 
		{
            $this->db->where("ID", $id);
            $this->db->delete("tbl_group");
			
			$this->db->where("group_ID", $id);
            $this->db->delete("tbl_group_members");
			
			$this->db->where("group_ID", $id);
            $this->db->delete("tbl_security");
			
			$this->db->where("group_id", $id);
            $this->db->delete("tbl_administrators");
			
			
        }
	}
	
	function get_all_groups($limit){
		$sql="Select * from tbl_group order by ID DESC limit ".$limit;
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function get_group_info_by_id($group_id){
		$options=array('ID'=>$group_id);
		$query=$this->db->getwhere('tbl_group',$options);
		return $query->row();
	}
	
	function insert_admin_member(){
		$options=array('name'=>$this->input->post('name',TRUE),'username'=>$this->input->post('username',TRUE),'password'=>md5($this->input->post('password',TRUE)),'email'=>$this->input->post('email',TRUE),'group_id'=>$this->input->post('group_id',TRUE));
		$this->db->insert('tbl_administrators',$options);
		$member_id=$this->db->insert_id();
		$options=array('group_ID'=>$this->input->post('group_id',TRUE),'member_ID'=>$member_id);
		$this->db->insert('tbl_group_members',$options);
	}
	
	function update_admin_member(){
		$options=array('name'=>$this->input->post('name',TRUE),'username'=>$this->input->post('username',TRUE),'password'=>md5($this->input->post('password',TRUE)),'email'=>$this->input->post('email',TRUE),'group_id'=>$this->input->post('group_id',TRUE));
		$this->db->where('id',$this->input->post('mem_id',TRUE));
		$this->db->update('tbl_administrators',$options);
	}
	
	function delete_admin_member($id){
		if ($id) 
		{
            $this->db->where("id", $id);
            $this->db->delete("tbl_administrators");
        }
	}
	
	function get_all_groups_members($group_id,$limit){
		$sql="Select * from tbl_group_members GM, tbl_administrators AL where AL.id=GM.member_ID AND GM.group_ID=? order by GM.ID DESC limit ".$limit;
		$query=$this->db->query($sql,array($group_id));
		return $query->result();
	}
	
	function get_group_member_info_by_id($mem_id){
		$options=array('id'=>$mem_id);
		$query=$this->db->getwhere('tbl_administrators',$options);
		return $query->row();
	}
	
	function setPermission(){
		$contrls="";
		$group_id=$this->input->post('group_id',TRUE);
		$controllers=$this->input->post('controller',TRUE);
		for($i=0;$i<count($controllers);$i++){
				if($controllers[$i]!=""){
				$contrls.=$controllers[$i].":";
				}
		}
		$sql="Select * from tbl_security where group_ID=?";
		$query=$this->db->query($sql,array($group_id));
		if($query->num_rows()>0){
			$options=array('controller_id'=>$contrls);
			$this->db->where('group_ID',$this->input->post('group_id',TRUE));
			$this->db->update('tbl_security',$options);
		}
		else{
			$options=array('group_ID'=>$this->input->post('group_id',TRUE),'controller_id'=>$contrls);
			$this->db->insert('tbl_security',$options);
		}
	}

}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */