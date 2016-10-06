<?
class Security extends Front_controller {

	function Security()
	{
		parent::Front_controller();
		$this->load->library('parser');
		$this->load->model('Security_model');
			
	}
	
	function index()
	{
 		$data['title']="Wannaquiz:Security";
 		$data['main']='admin/security';
		$data['group_list']=$this->Security_model->get_all_groups(10);
		$this->load->view('admin/admin',$data);
			
	}
	
	function getAllGroups(){
		$data['title']="Wannaquiz: Groups";
 		$data['main']='admin/news';
		$data['flag']='ebid';
		$data['news_info']=$this->Security_model->get_all_ebid_news(50,'all');
		$this->load->view('admin/admin',$data);
	
	}
	
	function getGroupByID(){
		$data['title']="Wannaquiz: Group";
 		$data['main']='admin/news';
		$data['flag']='press';
		$data['news_info']=$this->Security_model->get_all_press_news(50,'all');
		$this->load->view('admin/admin',$data);
	}
	
	function addGroup()
	{
 		$this->Security_model->insert_group();
		$this->session->set_flashdata('message','Group Added Successfully');
		redirect(ADMIN_PATH.'/security');
	}
	
	function removeGroup($id)
	{
 		$this->Security_model->delete_group($id);
		$this->session->set_flashdata('message','Group Deleted Successfully');
		redirect(ADMIN_PATH.'/security');
	}
	
	function editGroup($id){
		$data['title']="Wannaquiz:Edit Group";
 		$data['main']='admin/edit_group';
		$data['group_info']=$this->Security_model->get_group_info_by_id($id);
		$this->load->view('admin/admin',$data);
	}
	function edit(){
		$this->Security_model->update_group($this->input->post('group_id'));
		$this->session->set_flashdata('message','Group Updated Successfully');
		redirect(ADMIN_PATH.'/security');
	}
	
	function group($id){
		$data['title']="Wannaquiz:Group Management";
 		$data['main']='admin/group';
		$data['group_info']=$this->Security_model->get_group_info_by_id($id);
		$data['group_members_list']=$this->Security_model->get_all_groups_members($id,50);
		$this->load->view('admin/admin',$data);
	}
	
	function addAdminMembers(){
		$this->Security_model->insert_admin_member();
		$this->session->set_flashdata('message','Member Added Successfully');
		redirect(ADMIN_PATH.'/security/group'.'/'.$this->input->post('group_id'));
	}
	
	function removeGroupMember($id,$group_id){
		$this->Security_model->delete_admin_member($id);
		$this->session->set_flashdata('message','Member Deleted Successfully');
		redirect(ADMIN_PATH.'/security/group'.'/'.$group_id);
	}
	
	function editGroupMember($mem_id,$group_id){
		$data['title']="Wannaquiz:Edit Group Member";
 		$data['main']='admin/edit_group_member';
		$data['group_info']=$this->Security_model->get_group_info_by_id($group_id);
		$data['member_info']=$this->Security_model->get_group_member_info_by_id($mem_id);
		$this->load->view('admin/admin',$data);
	}
	
	function updateGroupMember(){
		$this->Security_model->update_admin_member();
		$this->session->set_flashdata('message','Group Member Updated Successfully');
		redirect(ADMIN_PATH.'/security/group'.'/'.$this->input->post('group_id'));
	}
		
	function setPermissionToGroup(){
		$this->Security_model->setPermission();
		$this->session->set_flashdata('message','Previleged Set Successfully');
		redirect(ADMIN_PATH.'/security/group'.'/'.$this->input->post('group_id'));
	
	}
	
			
			
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */