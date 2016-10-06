<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_Controller extends Controller
{

	var $_site_info;
	var $_payment_info;
	var $currency_code;
	var $vat;
	
	function Front_Controller()
	{            

            /*$t = '2010-08-25 08:00:00';
            echo $t . '<br />';
            $t = strtotime($t);
            $t += ( 30 * 24 * 60 * 60 );
            
            #echo $t;
            
            echo date('Y-m-d H:i:s',$t);
            exit;*/

		parent::Controller();
                # $this->load->library('ip2locationlite');
		$this->load->model('Site_setting_model');
		$this->load->model('Payment_setting_model');
		$this->load->model('User_model');
		$this->load->model('Member_model');
		$this->load->helper('ssl');
		//$this->lang->load('message', 'english');
		//$this->lang->load('page', 'english');
		$this->config->set_item('language','english');
		$this->_site_info=$this->Site_setting_model->get_site_info(1);
                
		$this->vat=$this->_site_info->vat;
                if($this->uri->segment(1,0)!='admin')
                $this->checkBlockedIp();
 
              $sess_uname=$this->session->userdata('admin_user_name');
               $sess_uid=$this->session->userdata('wannaquiz_admin_user_id');
                
                if($this->session->userdata('wannaquiz_user_id'))
                {
                    $this->session->unset_userdata('wannaquiz_guest_id');
                    $this->session->unset_userdata('guest_filter');
                }
                    
                else 
                {
                    $this->session->set_userdata('wannaquiz_guest_id','1');
                    $this->session->set_userdata('guest_filter','1');
                }
#echo 'guest:' . $this->session->userdata('wannaquiz_guest_id');
#echo 'gfilter:' . $this->session->userdata('guest_filter');
		if(strcmp(ADMIN_PATH,$this->uri->segment(1,0))==0){
		
			if($sess_uname=="" || $sess_uid==""){
				redirect(site_url(ADMIN_PATH.'/admin/'));	
				exit;
			}
		}
		
		if($this->_site_info!=NULL && $this->_site_info->site_status!='online' && $this->session->userdata('wannaquiz_admin_user_id')=="")
		{
			redirect(site_url('offline'));	
		}
		
		/**
		SSL configuration 
		
		*/
		
		/*if($this->uri->segment(1,0)=="registration" || $this->uri->segment(2,0)=="login" || $this->uri->segment(2,0)=="relogin" 
		|| $this->uri->segment(2,0)=="buybids" || $this->uri->segment(2,0)=="buyBidPayment" || $this->uri->segment(2,0)=="buy" || $this->uri->segment(2,0)=="selectedPaymentGateway" || $this->uri->segment(2,0)=="selectPayMethod" || $this->uri->segment(2,0)=="checkout" || $this->uri->segment(2,0)=="editprofile" || $this->uri->segment(2,0)=="ukashProcessing" || $this->uri->segment(2,0)=="paypalProccessing" || $this->uri->segment(2,0)=="buyBids" || $this->uri->segment(2,0)=="buyWonAuction" || $this->uri->segment(2,0)=="buyProduct" || $this->uri->segment(2,0)=="buyAuction" || $this->uri->segment(2,0)=="paymentFailed"){
		if($this->uri->segment(1,0)=="0")
			remove_ssl();
			else
			force_ssl();
		}
		else
			remove_ssl();*/
		
		
				
				
		$this->_payment_info=$this->Payment_setting_model->get_payment_info(1);
		$ccode=$this->_payment_info->ps_currency;
		if($ccode=='EUR')
			$this->currency_code='&euro;';
		if($ccode=='AUD' || $ccode=='USD')
			$this->currency_code='$';
		if($ccode=='GBP')
			$this->currency_code='&pound;';
		
        /* Controller Access to Different level of Admins */
		if($this->uri->segment(1,0)==ADMIN_PATH && $this->session->userdata('wannaquiz_admin_user_id')!=""){
			$offset=$this->uri->segment(2,0);
			$user_info=$this->User_model->getDetails($this->session->userdata('wannaquiz_admin_user_id'));
			if($user_info->GroupID==0 && $user_info->AccLevel==1)
				$getallowedcontrollers=$this->User_model->getAllControllers();
			else
				$getallowedcontrollers=$this->User_model->getAllowedControllers($this->session->userdata('wannaquiz_admin_user_id'));
		
			if(count($getallowedcontrollers)>0){
				for($i=0;$i<count($getallowedcontrollers);$i++){
						$controller=$this->User_model->getControllerInfo($getallowedcontrollers[$i]);
						$controller_array[]= $controller->controller_link_name;
					}
					
					if (in_array($offset, $controller_array)) 
					 	$a=1;	
					  else
					    $a=0;
					
					if($a==0){
						echo "You don\'t have permission to access this function"	;			
						exit;
					}
			}
		}
		/* End of the Controller Access  */
	}
	
	function get_site_name()
	{
		if($this->_site_info!=NULL)
		{
			return $this->_site_info->site_name;
		}
		return '';
	}
	
		
	function get_meta_description()
	{
		if($this->_site_info!=NULL)
		{
			return $this->_site_info->site_meta_desc;
		}
		return '';
	}
	
	function get_meta_keywords()
	{
		if($this->_site_info!=NULL)
		{
			return $this->_site_info->site_meta_keywords;
		}
		return '';
	}
	
	function checkMemberLogin(){
	
		$this->load->library('session');
		if($this->session->userdata('wannaquiz_user_id')=="")
		{
			$this->session->set_flashdata('message',$this->lang->line('msg_please_login'));
            $url='home/login';
            if($this->session->userdata('redURL'))
            {
                $url='home/login/'.$this->session->userdata('redURL');
            }
			redirect($url);
		}
		
	}
	
	function getMemberType(){
		$user_id=$this->session->userdata('wannaquiz_user_id');
		$mem=$this->Member_model->get_member($user_id);
		return $mem->user_type;
	}

        function checkBlockedIp() {
        $this->load->model('ip_block_model');

        $block_ips=$this->ip_block_model->get_blocked_ips("","","");
        //print_r($block_ips); echo "hii"; echo $_SERVER['REMOTE_ADDR']; EXIT;
        if(count($block_ips)>0) {
            foreach($block_ips as $ips) {
                if($_SERVER['REMOTE_ADDR']==$ips->blockip_address) {
                    echo $ips->blockip_desc;
                    exit;
                }
            }
        }
    }
}