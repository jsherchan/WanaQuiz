<?

class Newsletter extends Front_controller {

	function Newsletter()
	{
		parent::Front_controller();
		$this->load->library('parser');
		$this->load->model('Newsletter_model');
		$this->load->model('Email_model');
		
	}
	
	function index()
	{
 		$data['title']="Wannaquiz:Newsletter";
 		$data['main']='admin/newsletter';
		$data['newsletter_info']=$this->Newsletter_model->get_all_newsletter_info('Draft');
		//$data['member_info']=$this->Newsletter_model->get_member_newsletter();
		$data['flag']='Draft';
		$this->parser->parse('admin/admin',$data);
	}
	
	function addnewsletter($action="",$id="")
	{
 		$data['title']="Wannaquiz:Newsletter";
 		$data['main']='admin/addnewsletter';
		$data['f']=$action;

		if($action!="")
		{
			$rows=$this->Newsletter_model->get_edit_newsletter_info($id);	
			
				$data['subject']=$rows->news_subject;
				$data['content']=$rows->news_text;
				$data['id']=$rows->newsletter_id;
			
		}
		
		$this->parser->parse('admin/admin',$data);
		//$this->load->view('admin/admin');

	}
	
	function insert_data()
	{
		$value=$this->Newsletter_model->insert_newsletter();
		if($value)
		{
			$this->session->set_flashdata('message','Newsletter added successfully');
			redirect(ADMIN_PATH.'/newsletter/viewnewsletter/Draft','refresh');
		}
		else
		{
			$this->session->set_flashdata('message','Newsletter cannot be Added Successfully');
			redirect(ADMIN_PATH.'/newsletter/addnewsletter');
		}
		
		$this->parser->parse('admin/admin',$data);

	}
	

	function viewnewsletter($status)
	{
	 	$data['title']="Wannaquiz:Newsletter";
 		$data['main']='admin/newsletter';
		$data['newsletter_info']=$this->Newsletter_model->get_all_newsletter_info($status);
		$data['flag']=$status;
		$this->parser->parse('admin/admin',$data);
	}
	
	function edit()
	{
		if($this->input->post('submit'))
		{
			$options=array('news_text'=>$_POST['news_text'],'news_subject'=>$_POST['news_subject']);
			$this->db->where('newsletter_id',$_POST['id']);
			$update_query=$this->db->update('tbl_newsletters',$options);
			
			if($update_query)
				$this->session->set_flashdata('message','Newsletter was updated successfully.');
			
			if($_POST['action']=="save_n_send"){
				$group=$_POST['newsletter_group'];
				$this->Newsletter_model->send_newsletter($_POST['id'],$group);
			}

		}
		
	redirect(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$_POST['id']);
	
	}
	
	function delete($status,$id)
	{
		if ($id) 
		{
            $this->db->where("newsletter_id", $id);
            $this->db->delete("tbl_newsletters");
        }
	$this->session->set_flashdata('message','Selected Newsletter Deleted Successfully.');
	
	redirect(ADMIN_PATH.'/newsletter/viewnewsletter/'.$status);
	
	}

	function delete_member($id)
	{
		if ($id) 
		{
			$data=array('newsletter_subscribe'=>'no');
            $this->db->where("user_id", $id);
            $this->db->update("tbl_memberinfo",$data);
        }
	$this->session->set_flashdata('message','Selected Member Deleted Successfully.');
	
	redirect(ADMIN_PATH.'/newsletter/mailingGroups/subscribers');
	
	}
	
	function mailingGroups($group_type){
		$data['title']="Wannaquiz:Newsletter";
 		$data['main']='admin/newsletter_groups';
		$data['newsletter_group_info']=$this->Newsletter_model->get_newsletter_groups($group_type);
		$data['flag']=$group_type;
		$this->parser->parse('admin/admin',$data);
	
	}
	
	function deliveryStatus($newsletter_id){
		$data['title']="Wannaquiz:Newsletter Delivery Status";
 		$data['main']='admin/newsletter_delivery_status';
		$data['newsletter_info']=$this->Newsletter_model->get_edit_newsletter_info($newsletter_id);
		$data['opened_emails']=$this->Newsletter_model->get_newsletter_delivery_count($newsletter_id,'opened');
		$data['bounced_emails']=$this->Newsletter_model->get_newsletter_delivery_count($newsletter_id,'bounced');
		$data['total_sent_emails']=$this->Newsletter_model->get_newsletter_delivery_count($newsletter_id,'sent');
		$this->load->view('admin/admin',$data);
	}
	
	function deliveryStatistics($newsletter_id,$newsletter_status){
		$data['title']="Wannaquiz:Newsletter Delivery Statisctics";
 		$data['main']='admin/newsletter_delivery_members';
		$data['member_info']=$this->Newsletter_model->get_newsletter_delivery_members($newsletter_id,$newsletter_status);
		$data['newsletter_info']=$this->Newsletter_model->get_edit_newsletter_info($newsletter_id);
		$data['flag']=$newsletter_status;
		$this->load->view('admin/admin',$data);
	
	}
	
	function emailOpened($newsletter_id,$member_id){
		$this->Newsletter_model->updateNewsletterRecipient($newsletter_id,$member_id,'opened');
	}
	
	function getBouncedCount(){
		$this->load->library('bounce_email_counter');
		$this->bounce_email_counter->setLogin('mail.proshore.eu','bounce@proshore.eu','proshore');
		$this->bounce_email_counter->campaign_id=2;
		//set this 0 or 1 values depending upon you want to delete email
		$this->bounce_email_counter->delete_mail=0;
		$this->bounce_email_counter->openEmailInbox();
		
		$bounced_details=$this->bounce_email_counter->countBouncedEmails();
		
		if(count($bounced_details)>0){
			for($i=0;$i<count($bounced_details);$i++){
					$newsletter_id=$bounced_details[$i][0];
					$member_id=	$bounced_details[$i][1];
					$this->Newsletter_model->updateNewsletterRecipient($newsletter_id,$member_id,'bounced');
				}
		}
	
	}
	
}
?>