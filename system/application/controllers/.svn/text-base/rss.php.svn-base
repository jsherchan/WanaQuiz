<?php
class Rss extends Controller {

	function Rss()
	{
		parent::Controller();	
	}
	
	function index(){
		$this->load->model('Site_setting_model');
		$this->load->model('auction_model');
		
		$site_info=$this->Site_setting_model->get_site_info(1);
			
		$site_name=$site_info->site_name;	
		$title="Upcoming Auctions: ".$site_name." Auctions";
		$site_url=site_url();
			
		$auctions=$this->auction_model->get_products_by_status('future',current_date_time_stamp(),25,0);	
		$count=count($auctions);
		$rssbody="";
		foreach($auctions as $rows){
			$rss_data['item_id']=$rows->auc_id;
			$rss_data['auc_name']=$rows->auc_name;
			$rss_data['description']=$rows->description;
			$rss_data['title']=$rows->auc_name;
			$rssbody.=$this->parseRssBodyFormat($site_url,$rss_data); //RSS body
		}
	
		$header=$this->rssHeader($title,$site_url,$site_name); //Get header for the RSS
		$footer=$this->rssFooter(); //Get footer for the RSS
		
		echo $complete_rss=$header.$rssbody.$footer; 
	
	}
	
	function rssHeader($title,$site_name,$site_url)
	{
		$rss_header='<?xml version="1.0" encoding="UTF-8"?>
					<rss version="2.0">
					  <channel>
						<title>'.$title.'</title>
						<link>'.$site_name.'</link>
						<description>'.$site_url.'</description>
						';
		return $rss_header;
	}
	
	function rssFooter()
	{
		$rss_footer="
					</channel>
						</rss>";
		return $rss_footer;
	}
		
	function parseRssBodyFormat($site_url,$rss_data)
	{ 
		$link=site_url('auction/detail/'.$rss_data['item_id'].'/'.make_seo_url($rss_data['auc_name']));
		
	 $rss_body=" <item>
				   <title>".$rss_data["title"]."</title>
				   <guid isPermaLink='true'><![CDATA[".$link."]]></guid>
				   <link><![CDATA[".$link."]]></link> 
				   <description><![CDATA[".$rss_data["description"]."]]></description>
				</item>
		 ";
		return $rss_body;
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */