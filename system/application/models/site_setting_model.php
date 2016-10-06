<?php
class Site_setting_model extends Model {

	function Site_setting_model()
	{
		parent::Model();	
	}
	
	function get_site_info($site_id)
	{
		$data=array();
		$options=array('site_id'=>$site_id);
		$query = $this->db->getwhere('tbl_site_settings',$options,1);
		return $query->row();
	}
	
	function update_site_settings(){
		$data=array('site_name'=>$this->input->post('site_name',TRUE),
#								'facebook_app_id'=>$this->input->post('facebook_app_id'),
#								'facebook_api_secret'=>$this->input->post('facebook_api_secret'),
#								'tweet_consumer_key'=>$this->input->post('tweet_consumer_key'),
#								'tweet_consumer_secret'=>$this->input->post('tweet_consumer_secret'),
								'site_offline_msg'=>$this->input->post('site_offline_msg',TRUE),
								'site_email'=>$this->input->post('site_email',TRUE),
								'site_buss_email'=>$this->input->post('site_buss_email',TRUE),
								'site_meta_desc'=>$this->input->post('site_meta_desc',TRUE),
								'site_meta_keywords'=>$this->input->post('site_meta_keywords',TRUE),
								'gmt_hour'=>$this->input->post('gmt_hour',TRUE),
								'gmt_minute'=>$this->input->post('gmt_minute',TRUE),
								'site_status'=>$this->input->post('site_status',TRUE),
                                                                'site_tax'=>$this->input->post('site_tax',TRUE)
								);
		$this->db->where('site_id','1');
		$this->db->update('tbl_site_settings',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */