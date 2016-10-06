<?php
class User_model extends Model
{
    function User_model()
    {
        parent::Model();
    }
      
    /**
     * Login
     * 
     * <p>Check if username/password combination exists.
     * Returns the user_id of the visitor</p>
     * 
     * @param string $username
     * @param string $password
     * @param string $session_id
     * @return int user_id 0 if not logged in
     */
    function login($username, $password)
    {
    	$query = $this->db->getwhere('tbl_administrators', array('username' =>$this->validation->username, 'password' => md5($this->validation->password)));
    	
    	if($query->num_rows() == 0)
    	{
	   		return 0;
    	}
    	else
    	{
    		$row = $query->row();
    		return $row->id;
    	}
    }
  
    /**
     * Retrieves the database row for the user
     * 
     * @param int $user_id
     * @param string $session_id
     * @return User object with properties that correspond to the table columns
     */
    function getDetails($user_id)
    {
    	$query = $this->db->getwhere('tbl_administrators', array('id' => $user_id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
    
    /**
     * Clears the user's session_id in the database
     *
     * @param int $id
     */
  	
	
	function getAllowedControllers($mem_id){
		$sql="SELECT * FROM tbl_group_members GM, tbl_security S where GM.group_ID=S.group_ID AND GM.member_ID=?";
		$query = $this->db->query($sql,array($mem_id));
		if($query->num_rows()>0){
			$data=$query->row();
			if($data->controller_id!=""){
				$controller_trim=rtrim($data->controller_id,':');
				$controller_array=explode(':',$controller_trim);
				return $controller_array;
			}
			else				
				return $controller_array=array();
		}
		else 
			return $controller_array=array();
	}
	
	function getControllerInfo($controller_id){
		$sql="SELECT * FROM tbl_controllers where ID=?";
		$query = $this->db->query($sql,array($controller_id));
		return $query->row();
	}
	
	function getAllControllers(){
		$sql="SELECT * FROM tbl_controllers";
		$query = $this->db->query($sql);
		$result=$query->result();
		$controller="";
		foreach($result as $rows){
			$controller.=$rows->ID.":";
		}
		$controller=rtrim($controller,":");
		$controller_array=explode(':',$controller);
		return $controller_array;
	}

    ///--------------- LOGIN FRONT
    function login_front($username, $password,$type,$type1=null)
    {
        if($type1!=null)
    	$sql = "select * from tbl_members where username=? and password=md5(?) and activated='1' and user_type in ('$type','$type1')";
        else
        $sql = "select * from tbl_members where username=? and password=md5(?) and activated='1' and user_type='$type'";        
        $query = $this->db->query($sql,array($username,$password));
        //echo $this->db->last_query($sql);
        
		//$query = $this->db->getwhere('tbl_members', array('username' =>$username, 'password' => md5($password),'activated' =>'1'));
		
		if($query->num_rows() == 0)
    	{
	   		
			return 0;
    	}
    	else
    	{
    		$data['last_login']=current_date_time_stamp();
    		$this->db->update('tbl_members', $data, array('username' => $username));
    		$row = $query->row();
			
			return $row->user_id;
    	}
    }

    function getUser_details($user_id)
    {
    	$query = $this->db->getwhere('tbl_members', array('user_id' => $user_id));

    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }

    function check_exist_email($email)
    {
    	$query = $this->db->getwhere('tbl_member_profile', array('email' =>$email));

    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		$row = $query->row();
    		return $row->member_id;
    	}
    }
     function getUser_address($user_id)
    {
    	$query = $this->db->getwhere('tbl_address', array('member_id' => $user_id));

    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
    
}
?>