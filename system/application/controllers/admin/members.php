<?php
class Members extends Front_controller {

	function Members()
	{
		parent::Front_controller();	
		$this->load->model('Search_model');
		$this->load->library('parser');
		$this->load->library('pagination');
		$this->load->helper('common_helper');
	}
	
	function index()
	{
		redirect(ADMIN_PATH.'/members/members_list/all/joined_date/DESC','refresh');
	
	}
	
	function members_list($flag,$sort_field,$sort_order){
	    
 		$data['title']="Wannaquiz:Members Management";
 		$data['main']='admin/members';
		$data['f']=$flag;
		
		//set pagination configuration	
		$config['base_url'] = site_url(ADMIN_PATH.'/members/members_list/'.$flag.'/'.$sort_field.'/'.$sort_order.'/');
		
		$member_result=$this->Member_model->get_all_members($flag,$sort_field,$sort_order,0,0);	
                $config['total_rows']=count($member_result);
		$config['per_page'] = '30'; 
		$config['uri_segment'] = '7';
		$offset=$this->uri->segment(7,0);
	
		$this->pagination->initialize($config); 
	
		//CALL MEMBER Models
		$data['member_list']=$this->Member_model->get_all_members($flag,$sort_field,$sort_order,$config['per_page'],$offset);
		if($sort_order=="ASC")
			$data['sort_order']="DESC";
		else
			$data['sort_order']="ASC";
			
			$data['offset']=$offset;
		
		$this->parser->parse('admin/admin',$data);
	}
	
	function member_details($id){
	    $this->load->model('Country_management_model');
 		$data['title']="Wanna Quiz:Members Details";
 		$data['main']='admin/member_details';
		
		//CALL MEMBER Models
		$data['member_details']=$this->Member_model->get_member($id);
                $data['member_info'] = $this->Member_model->get_member_profile($id);
                $data['member_add'] = $this->Member_model->get_address($id);
		
		//Get Shipping Details 
		//$data['shipping_info']=$this->Member_model->get_member_shipping_addr($id);
	
		$this->load->view('admin/admin',$data);
	}
	
	function add_member()
	{
		$data['title']="Wannaquiz:Members Details";
 		$data['main']='admin/add_members';
		$this->load->view('admin/admin',$data);
	}
	function edit_member($id){
		$this->load->model('Country_management_model');
 		$data['title']="Wannaquiz:Members Details";
 		$data['main']='admin/edit_members';
		
		//CALL MEMBER Models
		$data['member_details']=$this->Member_model->get_member($id);
		//Get Shipping Details 
		//$data['shipping_info']=$this->Member_model->get_member_shipping_addr($id);
		
		$this->load->view('admin/admin',$data);
	}
	
	function delete($id){
	 
 		//CALL MEMBER Models
		$this->Member_model->delMember($id);
		$this->session->set_flashdata('message','Member Deleted');
		redirect(ADMIN_PATH.'/members');
		
	}
	
	function update(){
	  if($this->input->post('user_id')){
 		//CALL MEMBER Models
		$this->Member_model->updateBackEndMember();
		$this->session->set_flashdata('message','Member Updated');
		redirect(ADMIN_PATH.'/members');
		}
	}
	
	function insert()
	{
		$this->Member_model->insertBackEndMember();
		$this->session->set_flashdata('message','Member Added');
		redirect(ADMIN_PATH.'/members');
	}
	
	function ajaxsearch()
	{
		$s_member =$this->input->post('search_member');
		echo $this->Search_model->getSearchResults($s_member);
	}

	function search()
	{
		$data['title'] = "Member Management Search Results";
		$search_member = $this->input->post('search_member');
		$data['search_results'] = $this->Search_model->getSearchResults($search_member);
		$data['msg']="Searched Results for '".$this->input->post('search_member')."'";
		$data['main']='admin/member_searched';
		$this->parser->parse('admin/admin',$data);
		
	}

        function quizSearch()
	{
		$data['title'] = "Quiz Management Search Results";
		$search_quiz = $this->input->post('search_quiz');
                $config['base_url'] = site_url(ADMIN_PATH.'/members/quizSearch');
                $quiz_images = $this->Search_model->getQuizSearchResults($search_quiz,$this->input->post('search_type'));
               
                $config['total_rows']=count($quiz_images);
                $config['per_page'] = '20';
                $config['uri_segment'] = '4';
                $offset=$this->uri->segment(4,0);
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();

		$data['quiz_images'] = $this->Search_model->getQuizSearchResults($search_quiz,$this->input->post('search_type'),$config['per_page'],$offset);
                 //print_r($data['quiz_images']); exit;
		$data['msg']="Searched Results for '".$this->input->post('search_quiz')."'";
                $data['flag'] = $this->input->post('search_type');
		$data['main']='admin/media_comment';
		$this->parser->parse('admin/admin',$data);

	}
			
	function upgradeToLargeAdvertiser($user_id,$flag){
        $data=array('user_type'=>'3');
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_members',$data);
        $this->session->set_flashdata('message','Member Upgraded to Large Advertiser');
        redirect(ADMIN_PATH.'/members/members_list/'.$flag.'/joined_date/DESC');
	}
	
	function removefrombidrobot($user_id){
        $data=array('user_type'=>'0');
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_members',$data);
        $this->session->set_flashdata('message','Member Removed From Bidrobot System');
        redirect(ADMIN_PATH.'/members');
	}

    function transactions($id)
	{

		$data['main']='admin/member_transactions';
		$data['title']=SITENAME.' :'.$this->lang->line('mem_title');
		$data['member_details']=$this->Member_model->get_member($id);
		$data['member_transactions']=$this->Member_model->member_transactions($id);

		$this->load->view('admin/admin',$data);
	}

        function updateModerator(){
           // echo $user_id.'/'.$value;exit;
            $user_id=$this->input->post('user_id');
            $this->db->where('user_id',$user_id);
             $this->db->update('tbl_members',array('moderator'=>'1'));
            $this->db->where('user_id',$user_id);
            $this->db->update('tbl_moderator', array('active'=>'1'));
            return true;
            
           }
            function RehireModeartor(){
            $user_id=$this->input->post('user_id');
            //$this->db->where('user_id',$user_id);
             //$this->db->update('tbl_members',array('moderator'=>'1'));
            $this->db->where('user_id',$user_id);
            $this->db->update('tbl_moderator', array('delete'=>'0'));
            return true;
           }
          function cancelModeartor()
          { 
              $user_id=$this->input->post('user_id');
             echo $user_id;
              $this->db->where('user_id',$user_id);
              $query = $this->db->update('tbl_moderator',array('active'=>'-1'));
              $this->db->where('user_id',$user_id);
              $query = $this->db->update('tbl_members',array('moderator'=>'-1'));
              return true;
           }
            function unblockModeartor()
          {
              $user_id=$this->input->post('user_id');
              $this->db->where('user_id',$user_id);
              $query = $this->db->update('tbl_moderator',array('active'=>'1'));
              $this->db->where('user_id',$user_id);
              $query = $this->db->update('tbl_members',array('moderator'=>'1'));
              return true;
           }

     function cancelPartner(){
         $user_id = $this->input->post('user_id');
//         $status = $this->input->post('status');
//         if($status=='0')
//         $data = array('active'=>$status,'admin_adsense_code'=>'');
//         else $data = array('active'=>$status);

        $member_info = $this->Member_model->get_member($user_id);
        $user_email = $member_info->email;

        $this->db->where('user_id',$user_id);
        $query = $this->db->delete('tbl_partners');


        if($query){
            echo 'success';

            $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("REJECT_PARTNER");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'));

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($user_email,$subject,$emailbody,$headers);
        }
        else echo 'error';
    }

    function add_user_adsense_code(){
        $user_id = $this->input->post('user_id');
        $vertical_code = $this->input->post('user_vertical_code');
        $rectangular_code = $this->input->post('user_rectangular_code');
//        $this->config->set_item('global_xss_filtering', FALSE);
//        echo $this->config->item('global_xss_filtering');
        
        
        //$code = htmlspecialchars($code);
//        $myFile = "test.txt";
//        $fh = fopen($myFile, 'w') or die("can't open file");
//        $stringData = "Floppy Jalopy\n";
//        fwrite($fh, $stringData);
//        $stringData = "Pointy Pinto\n".$code;
//        fwrite($fh, $stringData);
//        fclose($fh);
//        echo $code;
 //       exit;
        //$this->db->where('user_id',$user_id);
        $member_info = $this->Member_model->get_member($user_id);
        $user_email = $member_info->email;
        $sql = "UPDATE tbl_partners SET user_vertical_code = '$vertical_code', user_rectangular_code = '$rectangular_code', active='1' WHERE user_id = $user_id";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //$query = $this->db->update('tbl_partners',array('admin_adsense_code'=>$code,'active'=>1));
        if($query){
            echo 'success';

             $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("ACCEPT_PARTNER");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'));

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($user_email,$subject,$emailbody,$headers);
        }
        else 'error';
    }

    function member_cpc(){
        $data['title']="Wanna Quiz:Members CPC";
        $query = $this->db->get('tbl_member_cpc');
        $data['member_cpc'] = $query->result();
        $data['main']='admin/member_cpc';
        $this->load->view('admin/admin',$data);
    }

    function add_member_cpc(){
        $data['title']="Wanna Quiz:Add Members CPC";
        $data['main']='admin/add_member_cpc';
        $this->load->view('admin/admin',$data);
    }

    function insert_member_cpc(){
        $data['title']="Wanna Quiz:Add Members CPC";
       $user_id = $this->input->post('user_id');
       $cpc = $this->input->post('cpc');
       $query = $this->db->insert('tbl_member_cpc',array('user_id'=>$user_id,'cpc'=>$cpc));
       if($query)
       $this->session->set_flashdata('message','successfully inserted');
       redirect(ADMIN_PATH.'/members/member_cpc');
    }

    function edit_member_cpc($user_id){
 		$data['title']="Wannaquiz:Edit Members CPC";
 		$data['main']='admin/edit_member_cpc';

		$data['member_cpc']=$this->Member_model->get_member_cpc($user_id);

		$this->load->view('admin/admin',$data);
	}

    function update_member_cpc(){
        $user_id = $this->input->post('user_id');
        $this->db->where('user_id',$user_id);
        $query = $this->db->update('tbl_member_cpc',array('user_id'=>$this->input->post('user_id'),'cpc'=>$this->input->post('cpc')));
        if($query)
        $this->session->set_flashdata('message','successfully edited');
        redirect(ADMIN_PATH.'/members/member_cpc');
    }

    function delete_member_cpc($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_member_cpc');
        if($query)
        $this->session->set_flashdata('message','successfully deleted');
        redirect(ADMIN_PATH.'/members/member_cpc');
    }

    function decode_user_adsense_code(){
        $vertical_code = $this->input->post('user_vertical_code');
        $rectangular_code = $this->input->post('user_rectangular_code');
        echo base64_decode($vertical_code)."%";
        echo base64_decode($rectangular_code);
       //echo ($vertical_code)."%";
       //echo ($rectangular_code);
    }
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */