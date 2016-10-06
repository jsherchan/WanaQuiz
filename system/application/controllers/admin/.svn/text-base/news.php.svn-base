<?

class News extends Front_controller {

	function News()
	{
		parent::Front_controller();
		$this->load->library('parser');
		$this->load->model('News_model');
		
	}
	
	function index()
	{
 		$data['title']="Wannaquiz:News";
 		$data['main']='admin/news';
		$data['flag']='all';
		$data['news_info']=$this->News_model->get_all_news_info(50);
		$this->parser->parse('admin/admin',$data);
		//$this->load->view('admin/admin');
	
	}
	
	function getEbidNews(){
		$data['title']="ebidshopper : Ebid News";
 		$data['main']='admin/news';
		$data['flag']='ebid';
		$data['news_info']=$this->News_model->get_all_ebid_news(50,'all');
		$this->parser->parse('admin/admin',$data);
	
	}
	
	function getPressNews(){
		$data['title']="ebidshopper : Ebid News";
 		$data['main']='admin/news';
		$data['flag']='press';
		$data['news_info']=$this->News_model->get_all_press_news(50,'all');
		$this->parser->parse('admin/admin',$data);
	}
	
	function addnews()
	{
 		$data['title']="Wannaquiz:News";
 		$data['main']='admin/addnews';
		$this->parser->parse('admin/admin',$data);
		//$this->load->view('admin/admin');

	}
	
	function insert_data()
	{
		$value=$this->News_model->insert_news();
		if($value)
		{
			$this->session->set_flashdata('message','News added successfully');
			redirect(ADMIN_PATH.'/news/','refresh');
		}
		else
		{
			$this->session->set_flashdata('message','News cannot be Added Successfully');
			redirect(ADMIN_PATH.'/news/addnews');
		}
		
		$this->parser->parse('admin/admin',$data);

	}
	
	
	
	function editnews($news_id)
	{
		$data['title']="Wannaquiz:News";
 		$data['main']='admin/editnews';
		//$data['affiliate_info']=$this->Affiliate_management_model->get_Affiliate_info_by_id($affliate_id);
		$data['news_info']=$this->News_model->get_news_by_id($news_id);
		$this->load->view('admin/admin',$data);
	
	}
	
	function edit()
	{	
	
	$this->News_model->edit_news();
	$this->session->set_flashdata('message','Selected News Edited');
	if($_REQUEST['news_type']=='ebid')
		redirect(ADMIN_PATH.'/news/getEbidNews');
	else
		redirect(ADMIN_PATH.'/news/getPressNews');
	}
	
	function delete($news_type,$id)
	{
		if ($id) 
		{
            $this->db->where("news_id", $id);
            $this->db->delete("tblnews");
        }
	$this->session->set_flashdata('message','Selected News Deleted Successfully.');
	if($news_type=="press")
		redirect(ADMIN_PATH.'/news/getPressNews');
	else	
		redirect(ADMIN_PATH.'/news/getEbidNews');
	}

		
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */