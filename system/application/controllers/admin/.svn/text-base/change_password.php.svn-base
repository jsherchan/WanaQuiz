<?
class Change_password extends Controller {

	function Change_password()
	{
		parent::Controller();
		$this->load->library('validation');
		$this->load->library('parser');
		$this->load->helper('form');
		$this->load->model('Change_password_model');
		$this->load->model('User_model');

          $sess_uname=$this->session->userdata('admin_user_name');
                $sess_uid=$this->session->userdata('wannaquiz_admin_user_id');
                if($sess_uname=="" || $sess_uid==""){
                    header("Location:".site_url(ADMIN_PATH.'/admin/'));
                    exit;
                }
	}
	
	function index()
	{
		$offset=$this->uri->segment(2,0);
		$user_info=$this->User_model->getDetails($this->session->userdata('wannaquiz_admin_user_id'));
		if($user_info->group_id!=0 && $user_info->access_level!=1){
			echo "You don\'t have permission to access this function"	;			
			exit;
		}
		$data['title']="wannaquiz:Change Password ";
 		$data['main']='admin/change_password';
		$this->parser->parse('admin/admin',$data);
	}
	
	function update_password()
	{
		$rules['old_password']	= "required";
		$rules['new_password']	= "required|matches[re_password]";	
		$rules['re_password']	= "required";		

		$this->validation->set_rules($rules);

		$fields['old_password']	= 'Old Password';
		$fields['new_password']	= 'New Password';
		$fields['re_password']	= 'Confirm Password';
		
		$this->validation->set_fields($fields);

		if ($this->validation->run() == FALSE)
		{
			$data['main']="admin/change_password";
			$this->parser->parse('admin/admin',$data);
		}
		else{
			$old_password=$this->input->post('old_password',TRUE);
			$user_id=$this->Change_password_model->checkold_password($this->session->userdata('admin_user_name'),md5($old_password));	//here $_SESSION['AdminUserName'] is the currently logged username
			if($user_id==0)
			{
				$this->session->set_flashdata('message','Password did not matched');
				redirect(ADMIN_PATH.'/change_password','refresh');
				
			}
			else{
				$confirm_password=$this->input->post('re_password',TRUE);
			
				$data=array('AdminPassword'=>md5($confirm_password));
				$this->db->where('AdminID',$user_id);
				$this->db->update('tbladmin_login',$data);
				
				$this->session->set_flashdata('message','Password has been changed.');
				//redirect(); //to login page
				redirect(ADMIN_PATH.'/change_password','refresh');
			}
		} // end of else
	}

}	//end of class

?>