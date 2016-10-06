<?php
class Coupon_code extends Front_controller {

	function Coupon_code()
	{
		parent::Front_controller();	
	 	$this->load->model('Coupon_code_model');
    //	$this->load->helper('form');
	
	$this->load->library('parser');
	}
	
	function index()
	{
		$this->view_coupons('added_date','DESC');
		
	}
		
	function add_coupon()
	{
		$data['title']="Auction:Coupon Management";
 		$data['main']='admin/coupons';
				
		$data['view_coupons_layout']="no";
		
		$this->parser->parse('admin/admin',$data);
		//$this->load->view('admin/admin');
	}
	
	function edit_coupon($coupon_id)
	{
		$data['title']="Auction:Coupon Management";
 		$data['main']='admin/coupons';
		$data['coupon_info']=$this->Coupons_settings_model->get_coupon_info_by_id($coupon_id);
		$data['view_coupons_layout']="no";
		
		$this->load->view('admin/admin',$data);
		//$this->load->view('admin/admin');
	}
	
	function view_coupons($sort_field,$sort_order)
	{
		$this->load->library('pagination');
 		$data['title']="Auction:Coupon Management";
 		$data['main']='admin/coupons';
		
		$config['base_url'] = site_url(ADMIN_PATH.'/coupons_management/view_coupons/'.$sort_field.'/'.$sort_order.'/');
		$coupon_info=$this->Coupons_settings_model->get_all_coupons_info($sort_field,$sort_order,0,0);
		$config['total_rows']=count($coupon_info);
		
		$config['per_page'] = '50'; 
		$config['uri_segment'] = '6';
		$offset=$this->uri->segment(6,0);
	
		$this->pagination->initialize($config);
		
		
		$data['coupon_info']=$this->Coupons_settings_model->get_all_coupons_info($sort_field,$sort_order,$config['per_page'],$offset);
		$data['view_coupons_layout']="yes";
		
		if($sort_order=="ASC")
			$data['sort_order']="DESC";
		else
			$data['sort_order']="ASC";
			
			$data['offset']=$offset;
		
		$this->parser->parse('admin/admin',$data);
		
	}
		
	function update()
	{
		$this->Coupons_settings_model->edit();
		$this->session->set_flashdata('message','Coupon edited successfully.');
		redirect(ADMIN_PATH.'/coupons_management/');
	}
	
	function insert()
	{
		$this->Coupons_settings_model->insert();
		$this->session->set_flashdata('message','Coupon inserted successfully.');
		redirect(ADMIN_PATH.'/coupons_management/');
	}
	
	function csvimport(){
		$data['title']="Admin:Import Coupons";
 		$data['main']='admin/import_csv';
		$this->parser->parse('admin/admin',$data);
	}
	
	function upload_csv_file(){
		$this->upload_csv('file_csv');
		$this->import($_FILES['file_csv']['name']);
		$this->session->set_flashdata('message','Coupons imported successfully.');  
        redirect(ADMIN_PATH.'/coupons_management/');
	}
	
	function upload_csv($file)
	{
		$config['upload_path'] ='./csv/';
		$config['allowed_types'] = 'csv';
		$config['max_size']	= '1000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
				
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}	
	
	function import($filename)
    {  
        $path="E:/sunil/ebid/csv/";
		$row = 1;
 		if (($handle = fopen($path.$filename, "r")) !== FALSE) 
	 	{
  			 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   				 	$num = count($data);
  				    $row++;
   					for ($c=0; $c < $num; $c++) {
    					 $arr[] = $data[$c];
   					}
   					 $Arr[] = $arr;
   					 $arr = array();
  				 }
  			 fclose($handle);
		}
		
		foreach($Arr as $data)
		{
			   $sql="SELECT coupon_code FROM tbl_coupons Where coupon_code='".$data[0]."'";
			   $query=$this->db->query($sql);
				$data1=$query->row();		   
			  
			   if(!$data1)
			   {
					$options=array('coupon_code'=>$data[0],'amount'=>$data[1],'bid_credits'=>$data[2],
					'activated'=>$data[3],'validity_days'=>$data[4],'added_date'=>current_date_time_stamp());
					$this->db->insert('tbl_coupons',$options);
				}
		 }
		
		
	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */