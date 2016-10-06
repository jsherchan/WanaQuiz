<?php
class Site_statistics_model extends Model {

	function Site_statistics_model()
	{
		parent::Model();	
	}
	
	function get_site_log($num,$offset)
	{
		$data=array();
		$this->db->order_by("act_time", "desc");
		$query = $this->db->get('tbl_log_activity',$num,$offset);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$data[]=$rows;
							
				}
			
			$query->free_result();
		return $data;
		}
	}
	
	function insert_site_log($user_id,$username,$ip,$action){
		$now=current_date_time_stamp();
		$ip_from=$this->countryCityFromIP($ip);
		//echo '<pre>'; print_r($ip_from); exit;
		$data=array('act_user_id'=>$user_id,'act_user'=>$username,'act_ip'=>$ip,'act_name'=>$action,'act_time'=>$now);
		$this->db->insert('tbl_log_activity',$data);
		$log_id=mysql_insert_id();
		
		//delete the current status of user if any		
		 $this->db->where("uid", $user_id);
                $this->db->delete("tbl_login");
		
		// for the current status
		if($action=="Logout")
			$active=0;
		else
			$active=1;
		
		$data=array('uid'=>$user_id,'uname'=>$username,'active'=>$active,'lastlogin'=>$now);
		$this->db->insert('tbl_login',$data);
		
		$cntry = $ip_from['country'];
		if($ip_from['country']!=""){
                    $sql = "update tbl_log_activity set act_country = '?' where act_id = ?";
                    $query = $this->db->query($sql,array($cntry,$log_id));
//		$data=array('act_country'=>$cntry);
//		$this->db->where('act_id',$log_id);
//		$this->db->update('tbl_log_activity',$data);
		}
		
		if($ip_from['city']!=""){
                    $sql = "update tbl_log_activity set act_city = '?' where act_id = ?";
                    $query = $this->db->query($sql,array($ip_from['city'],$log_id));
		}
		
	}
	
	function delLog($id)
	{
	  if ($id) {
            $this->db->where("act_id", $id);
            $this->db->delete("tbl_log_activity");
        }
	}

	function countryCityFromIP($ipAddr)
	{
        //function to find country and city from IP address

        //verify the IP address for the
        ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
        $ipDetail=array(); //initialize a blank array
        /*
        //get the XML result from hostip.info
        $xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);
        $match=array();
        
        if($xml){
                //get the city name inside the node <gml:name> and </gml:name>
                @preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);
                //print_r($match);
                $ipDetail['city']="Unknown";
            }
            else
                $ipDetail['city']="Unknown";

        if($xml){
                //get the country name inside the node <countryName> and </countryName>
                @preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);

                //assign the country name to the $ipDetail array

                $ipDetail['country']=$matches[1];
            }
            else
                  $ipDetail['country']="Unknown";
            */
//            $apiKey = "5dc8dee5bde0f7cbe0f090cf5e3c679856138cabe70e502a7e88859edda95f4f";
//            //$ip = "77.168.60.74";
//
//            $url = "http://api.ipinfodb.com/v2/ip_query.php?key=$apiKey&ip=$ipAddr&timezone=false";
//            $result = file_get_contents($url);
//            $xml = simplexml_load_string($result);
//            if($xml){
//                if($xml->CountryName === "Reserved") {
//                    $ipDetail['country']="Nepal";
//                    $ipDetail['city']="Kathmandu";
//                }
//                else {
//                    $ipDetail['country']=$xml->CountryName;
//                    $ipDetail['city']=$xml->City;
//                }
//            }
//            else {
//                $ipDetail['country']='Unknown';
//                $ipDetail['city'] = 'Unknown';
//            }
            //return the array containing city, country and country code
            //$ipDetail['country']="unknown";
            //$ipDetail['city'] = "unknown";
            return $ipDetail;

    }
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */