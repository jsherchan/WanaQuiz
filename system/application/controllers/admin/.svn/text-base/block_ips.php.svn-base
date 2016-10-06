<?php
class Block_ips extends Front_controller {

	function Block_ips()
	{
		parent::Front_controller();	
	$this->load->Model('Ip_block_model');
	$this->load->library('parser');
	$this->load->library('pagination');
	}
	
	function index()
	{
		$this->ips($ip_id="");
		
	}
	
	function ips($ip_id){
 
 		$data['title']="Wannaquiz:Block IPs";
 		$data['main']='admin/block_ips';
	
		//set pagination configuration	
		$config['base_url'] = site_url(ADMIN_PATH.'/block_ips/index/');
		$config['total_rows']=$this->db->count_all('tbl_block_ips');
		$config['per_page'] = '50';
		$config['uri_segment'] = '4';
	
		$this->pagination->initialize($config); 
		
		//CALL CATEGORY Models
		$data['blocked_ip']=$this->Ip_block_model->get_blocked_ips($ip_id,$config['per_page'],$this->uri->segment(4));
		//$this->load->vars($data);
		$this->parser->parse('admin/admin',$data);
	}
	
	function add_ip(){
  		//CALL CATEGORY Models
		$this->Ip_block_model->insert_ip();
                if($this->input->post('ip_from',TRUE)!=''){
                    echo 'success';
                }
                else{
		$this->session->set_flashdata('message','Bocked IP Added');
		redirect(ADMIN_PATH.'/block_ips','refresh');
                }
	}
	
	function edit_form($ip_id){
		$data['title']="Wannaquiz:Block IPs Details";
 		$data['main']='admin/edit_block_ip';
		
		//CALL CATEGORY Models
		$data['ip_info']=$this->Ip_block_model->get_blocked_ips($ip_id,'','');
		//$this->load->vars($data);
		$this->parser->parse('admin/admin',$data);
	
	}
	
	function edit(){
  		//CALL CATEGORY Models
		$this->Ip_block_model->edit_ip();
		$this->session->set_flashdata('message','Bocked IP Edited');
		redirect(ADMIN_PATH.'/block_ips','refresh');
	}
		
	function delete($id){
	 
 		//CALL MEMBER Models
		$this->Ip_block_model->delIP($id);
		$this->session->set_flashdata('message','Blocked IP Removed');
		redirect(ADMIN_PATH.'/block_ips','refresh');
		
	}

        function unblock_ip(){
            $unblock = $this->Ip_block_model->unblockIp();
            echo $unblock; exit;
            if($unblock == 'unblocked')
            echo 'unblocked';
            else echo "error";
        }
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */