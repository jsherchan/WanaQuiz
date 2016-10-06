<?php
class Site_statistics extends Front_controller {

	function Site_statistics()
	{
        parent::Front_controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->Model('Site_statistics_model');
        $this->load->library('parser');
        $this->load->library('pagination');
        $this->load->library('table');
	}
	
	function index()
	{
	    $data['title']="Wannaquiz:Site Statistics";
        $data['main']='admin/site_statistics';

        $config['base_url'] = site_url(ADMIN_PATH.'/site_statistics/index/');
        $config['total_rows']=$this->db->count_all('tbl_log_activity');
        $config['per_page'] = '50';
        $config['uri_segment'] = '4';

        $this->pagination->initialize($config);

        //load the model and get results
        $data['logs_info']=$this->Site_statistics_model->get_site_log($config['per_page'],$this->uri->segment(4));

        // load the HTML Table Class
        $this->table->set_heading('User ID','User Name','Login Time','Ip address','Log Description');

        // load view
        $this->parser->parse('admin/admin',$data);
	
	}
	
	function delete($logid){
		$this->load->model('site_statistics_model');
		$this->site_statistics_model->delLog($logid);
		$this->session->set_flashdata('message','Log Deleted');
		redirect(ADMIN_PATH.'/site_statistics','refresh');
	}
	
	function deleteChecked(){
		$this->load->model('site_statistics_model');
		if(isset($_POST['logids'])){
			if(count($_POST['logids'])>0){
					for($i=0;$i<count($_POST['logids']);$i++){
						$this->site_statistics_model->delLog($_POST['logids'][$i]);
					}
				
				$this->session->set_flashdata('message','Log Deleted');
			}
		}
		else 
			$this->session->set_flashdata('message','You haven\'t check any log to delete');
		redirect(ADMIN_PATH.'/site_statistics');
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */