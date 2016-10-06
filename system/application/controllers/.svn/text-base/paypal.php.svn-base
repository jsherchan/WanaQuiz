<?php

class Paypal extends Front_controller
{

	function Paypal()
	{
		parent::Front_controller();
		$this->load->library('parser');
	}
	
	
	function paypalProccessing(){
		$this->load->model('user_model');
		$user_id=$this->session->userdata('wannaquiz_user_id');
		
                $item_id=$this->input->post('item_id',TRUE);
                $paypal_type = $this->input->post('paypal_type',TRUE);
                
                if($paypal_type=='gameboard'){
                    $id ='id';
                    $table = 'tbl_gameboard';
                    $amount=$this->session->userdata('shopping_cart_total');
                    $this->db->where($id,$item_id);
                    $query = $this->db->get($table);
                    $data1 = $query->row();
                    //echo $amount; exit;
                    $gameboard_id = $item_id;
                    $quiz_id = 0;
                    $item_name = 'gameboard';
                }
                else {                    
                    $amount=$this->input->post('amount',TRUE);                    
                    $item_name = 'quiz_views';
                    $quiz_id = $item_id;
                    $gameboard_id=0;
                }
                
                //echo $quiz_id; exit;
                    //$amount = explode('$',$amount);
		    $amount=number_format($amount,2);
               
		//insert into transaction table 
		$data['inserted_id']=$this->insert_into_transaction_table($amount,$user_id,$gameboard_id,$quiz_id,$item_name);

		$data['item_id']=$item_id;
		$data['item_name']=$item_name;
		$data['amount']=$amount;
                $data['paypal_type'] = $paypal_type;
		$data['business_email']=$this->input->post('business_email',TRUE);
		$data['currency']=$this->input->post('currency_code',TRUE);
		$data['user']=$this->user_model->getUser_details($user_id);
		
		//Load PAYPAL IPN FORM 
		$this->load->view('paypal/paypal_ipn_form',$data);
		
	}
	
	function insert_into_transaction_table($amount,$user_id,$gameboard_id,$quiz_id,$item_name)
	{
		$this->load->model('general_model');
		$timenow=strtotime($this->general_model->get_local_time());
		$timenow=date('Y-m-d H:i:s',$timenow);
		
		$options=array('payment_method'=>'paypal','user_id'=>$user_id,'gross_amount'=>$amount,
						'pay_time'=>$timenow,'item_name'=>$item_name,'quiz_id'=>$quiz_id,'gameboard_id'=>$gameboard_id);
				
		$this->db->insert('tbl_transaction_info',$options);
		$id=$this->db->insert_id();
			
		return $id;	
	}
	
	function paypalCancel($paypal_type){

		$this->session->set_flashdata('message',"Your transaction is not complete.Please Try Again");
                $quiz_url_type=$this->session->userdata('quiz_url_type');
                if($paypal_type=='gameboard')
                    redirect('gameboard', 'refresh');
                else redirect('member/'.$quiz_url_type);
		
	}
	
	function paypalSuccess($paypal_type){
	
                //echo "<pre>";
                //print_r($_POST);
                //exit;
                $this->session->set_userdata('gross',$_POST['mc_gross']);
		$this->session->set_flashdata('message',$this->lang->line('msg_won_auction_bought'));
                $quiz_url_type_last = $this->session->userdata('quiz_url_type_last');
                $invoice = $_POST['invoice'];
		redirect('quiz/add_quiz_success', 'refresh');
		
	
	}
	
	
	function paypalIPN(){
             
		$this->load->model('user_model');
                $this->load->model('Quiz_model');
		$this->load->model('payment_setting_model');
		$paypal_info=$this->payment_setting_model->get_payment_info('1');
		
		/////*********** PAYPAL IPN CODE***********************//////
		$notify_email ="siran_majan@hotmail.com";
		//$paypal_account=$paypal_info->ps_email;
                
                $paypal_info->ps_email;
		$paypal_account=$paypal_info->ps_email;
		//open a log file
		$log = fopen("paypal_ipn_err123.log", "a");
		fwrite($log, "\n\nipn - " . gmstrftime("%b %d %Y %H:%M:%S", time()) . "\n");

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) 
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);

		// assign posted variables to local variables
		$item_name = $_POST['item_name'];
                $item_id = $_POST['item_id'];
		$business = $_POST['business'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$mc_gross = number_format($_POST['mc_gross'],2,".",'');
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$receiver_id = $_POST['receiver_id'];
		$quantity = $_POST['quantity'];
		$num_cart_items = $_POST['num_cart_items'];
		$payment_date = $_POST['payment_date'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$payment_type = $_POST['payment_type'];
		$payment_status = $_POST['payment_status'];
		$payment_gross = $_POST['payment_gross'];
		$payment_fee = $_POST['payment_fee'];
		$settle_amount = $_POST['settle_amount'];
		$memo = $_POST['memo'];
		$payer_email = $_POST['payer_email'];
		$txn_type = $_POST['txn_type'];
		$payer_status = $_POST['payer_status'];
		$address_street = $_POST['address_street'];
		$address_city = $_POST['address_city'];
		$address_state = $_POST['address_state'];
		$address_zip = $_POST['address_zip'];
		$address_country = $_POST['address_country'];
		$address_status = $_POST['address_status'];
		$item_number = $_POST['item_number'];
		$tax = number_format($_POST['tax'],2,".",'');
		$option_name1 = $_POST['option_name1'];
		$option_selection1 = $_POST['option_selection1'];
		$option_name2 = $_POST['option_name2'];
		$option_selection2 = $_POST['option_selection2'];
		$for_auction = $_POST['for_auction'];
		$invoice = $_POST['invoice'];
                $splitted = explode('-',$invoice);
                $invoice = $splitted[1];
		$custom = $_POST['custom'];
		$notify_version = $_POST['notify_version'];
		$verify_sign = $_POST['verify_sign'];
		$payer_business_name = $_POST['payer_business_name'];
		$payer_id =$_POST['payer_id'];
		$mc_currency = $_POST['mc_currency'];
		$mc_fee = number_format($_POST['mc_fee'],2,".",'');
		$exchange_rate = $_POST['exchange_rate'];
		$settle_currency  = $_POST['settle_currency'];
		$parent_txn_id  = $_POST['parent_txn_id'];
		$pending_reason  = $_POST['pending_reason'];

		//write to the log file for backup if database if down then we can use this for backup
		fwrite($log,"Vals: "."$invoice"." "."$receiver_email"." "."$item_name"." "."$item_ number"." "."$quantity"." "."$payment_status"." "."$pending_reason"." "."$payment_date"." "."$payment_gross"." "."$payment_fee"." "."$txn_id"." "."$txn_type"." "."$first_ name"." "."$last_name"." "."$address_street"." "."$address_city"." "."$address_state"." "."$address_zip"." "."$address_country"." "."$address_status"." "."$payer_email"." "."$payer_status"." "."$payment_type"." "."$notify_version"." "."$verify_sign". "\ n"); 
                mail("siran_majan@hotmail.com",'start',"From:info@wannaquiz.com");

if (!$fp) 
{mail("sudan@proshore.eu",'Failed to open HTTP connection!',"From:info@wannaquiz.com");
	// HTTP ERROR
	 fwrite($log, "Failed to open HTTP connection!");
	
} 
else 
{mail("siran_majan@hotmail.com",'passed to open HTTP connection!',$req,"From:info@wannaquiz.com");
	fputs ($fp, $header . $req);
	while (!feof($fp)) 
	{
	$res = fgets ($fp, 1024);
	if (strcmp ($res, "VERIFIED") == 0) 
	{
		$date_creation = date("Y-m-d");

	//check if transaction ID has been processed before
	$check_duplicate_txn_id_query = "select txn_id from tbl_transaction_info where txn_id='".$txn_id."'";
	
	$query=$this->db->query($check_duplicate_txn_id_query);
	mail("siran_majan@hotmail.com",'response variable from paypal',$req,"From:info@wannaquiz.com");
	$nm =$query->num_rows();
	
	if ($nm==0)
	{	mail("siran_majan@hotmail.com",'received_amount',$req,"From:info@wannaquiz.com");
		//get the received amount
		$received_amount=$mc_gross-$mc_fee;
		
    	//get the memeber id of this invoice
		$prev_sent_member_query="select * from tbl_transaction_info where invoice='$invoice'";
		$query=$this->db->query($prev_sent_member_query);
		$prev_sent_detail_result=$query->row();
				
		$member_id=$prev_sent_detail_result->user_id;
		
		if($payment_status=='Completed') //check if the transaction status is completed or not
		{
                     //$this->Quiz_model->insertPhotoQuizAdvertiser(); // Inserts all the quiz information into quiz table after payment success.

                     //update quiz status 1 after payment completion
//                     $this->db->where('quiz_id',$prev_sent_detail_result->quiz_id);
//                     $this->db->update('tbl_quizes',array('status'=>'1'));
                     
                     //update quiz credits after payment completion

                    //$this->Quiz_model->editQuizBudget($prev_sent_detail_result->quiz_id,$prev_sent_detail_result->gross_amount);
                    $this->Quiz_model->insert_quiz_budget($prev_sent_detail_result->gross_amount,$member_id);


//                     $this->db->where('quiz_id',$prev_sent_detail_result->quiz_id);
//                     $quiz_credits = array('total_budget'=>$prev_sent_detail_result->gross_amount,
//                     'budget_status'=>'1');
//                     $this->db->update('tbl_advertiser_quiz_budget',$quiz_credits);

                     $this->session->set_userdata('gross_amount',$prev_sent_detail_result->gross_amount);
                     
                     $this->load->model('Award_model');
                     $this->Award_model->insertQuizCreationAward();

			if($business==$paypal_account) //checking the business email address and  
			{ mail("siran_majan@hotmail.com",'sataus=compl', 'business=paypal_account'.$invoice.$member_id."hello".$prev_sent_detail_result->quiz_id,"From:info@wannaquiz.com");
			//here action goes for the Completed Payment
				$member_info=$this->user_model->getUser_details($member_id);		//previous credit balance				
				$member_credit_balance=$member_info->credit_balance;
				if($prev_sent_detail_result->gross_amount==$mc_gross)
				{ 
					//process the transaction
					$update_transaction_query="update tbl_transaction_info set
				 								received_amount=$received_amount,receiver_email='$receiver_email',
												item_name='$item_name',quantity='$quantity',payment_status='$payment_status',
												pending_reason='$pending_reason',payment_date='$payment_date',mc_gross=$mc_gross,
												mc_fee=$mc_fee,tax=$tax,mc_currency='$mc_currency',txn_id='$txn_id',
												txn_type='$txn_type',address_status='$address_status',payer_email='$payer_email',
												payer_status='$payer_status',payment_type='$payment_type',
												notify_version='$notify_version',verify_sign='$verify_sign',
												date_creation='$date_creation' 
												where invoice=$invoice";
					$result_ipn=$this->db->query($update_transaction_query)	;
										
			
				
					mail('siran_majan@hotmail.com', "payment success", "$res\n $req\n ","From:info@wannaquiz.com");
			}
			else //else of checking the amount 
			{
				//suspicious transaction notify from the email and go for manual investigation
				mail($notify_email, "Invalid Returned Amount", "$res\n $req\n ","From:info@wannaquiz.com");
			}
			
			}
			else // if business is not our paypal account
			{
				//suspicious transaction notify from the email and go for manual investigation
				mail($notify_email, "Invalid Business Account", "$res\n $req\n ","From:info@ebidshopper.com");	
			}
		}

    
	} // end of if of the checkng txn_id
	else 
	{
		// send an email
		mail($notify_email, "VERIFIED DUPLICATED TRANSACTION", "$res\n $req \n $strQuery\n ","From:info@ebidshopper.com");
	}

  
    
	}
	else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation

	mail($notify_email, "INVALID IPN", "$res\n $req",$headers);

	}
	}
fclose ($fp);
}
	
	}
	
	function payTest(){
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
		var_dump($fp);
	}
	
}

?>