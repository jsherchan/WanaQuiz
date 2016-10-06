<?php
class Order_management extends Front_controller {

	function Order_management()
	{
		parent::Front_controller();	
	 	$this->load->model('Transaction_model');
	 	$this->load->library('pagination');
    	$this->load->helper('url');
		$this->load->database();
		
	
	$this->load->library('parser');
	}
	
	function index()
	{
		$this->trans('pay_time','DESC',0);
		
	}
	
	function trans($order_title,$order_type,$title){
 
 		$data['title']="Ebidshopper :Order Management";
 		$data['main']='admin/order';
		$data['f']=$title;
		if($order_type=='ASC')
			$data['order_type']='DESC';
		else
			$data['order_type']='ASC';
		if($title==0)
			$sql="transaction_info where payment_status='Completed' AND auction_id<>0 AND item_name='Won Auction Purchase'";
		if($title==1)
			$sql="transaction_info where payment_status='Completed' AND auction_id<>0 AND item_name='Normal Auction Purchase'";

	//$sql="SELECT COUNT(*) AS `numrows` FROM transaction_info where member_type='buyer'";	

	$config['base_url'] = base_url().'index.php/'.ADMIN_PATH.'/order_management/trans/'.$order_title.'/'.$order_type.'/'.$title.'/';

	$config['total_rows']=$this->db->count_all($sql);
	$config['per_page'] = '30'; 
	$config['num_links'] = 5;
	$config['uri_segment']=7;
	$config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';

	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';
	$config['next_link'] = ' &gt;';
	$config['prev_link'] = '&lt; ';
	$offset=$this->uri->segment(7, 0);
	$this->pagination->initialize($config); 
	
	//load the model and get results
	
	$data['order_info']=$this->Transaction_model->get_buyers_order_info($config['per_page'],$offset,$order_title,$order_type,$title);
		
		
	$this->parser->parse('admin/admin',$data);
	
	}
	
	function delete($id)
	{
		$this->db->where('invoice',$id);
		$this->db->delete('transaction_info');
		$this->session->set_flashdata('message','Order information deleted successfully.');
		
		redirect(ADMIN_PATH.'/order_management');
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */