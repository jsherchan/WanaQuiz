<?php 

class CI_Bounce_email_counter
{
 	var $host;
 	var $user_name;
 	var $password;
 	var $campaign_id;
 	var $imap_resource;
 	var $total_emails;
 	var $bouce_count;
 	var $bounce_count_campaign;
 	var $delete_mail;
	var $bounced_addresses=array();
 	var $error;
	var $bounced_detail=array();
    //constructor for counting emails
 	function setLogin($hostname, $username, $pswd)
 	{
 		$this->host=$hostname;
		$this->user_name=$username;
		$this->password=$pswd;
		$this->campaign_id=NULL;
		$this->delete_mail=1;
 	}
	//open the email inbox
 	function openEmailInbox()
 	{
 		
		if(@$this->imap_resource=imap_open('{'.$this->host.':110/pop3}INBOX', $this->user_name, $this->password))
			@$this->total_emails=imap_num_msg($this->imap_resource);
		else if(@$this->imap_resource=imap_open('{'.$this->host.':110/pop3/notls}INBOX', $this->user_name, $this->password))
			@$this->total_emails=imap_num_msg($this->imap_resource);
		else if(@$this->imap_resource=imap_open('{'.$this->host.':143}INBOX', $this->user_name, $this->password))
			@$this->total_emails=imap_num_msg($this->imap_resource);
		else if(@$this->imap_resource=imap_open('{'.$this->host.':143/imap}INBOX', $this->user_name, $this->password))
			@$this->total_emails=imap_num_msg($this->imap_resource);	
		else
			$this->error="ERROR:couldn't open the mail inbox";
 	}
	//check the from and subject header to verify weather it is bounce email or not.
 	function is_bounced_email($mail_header)
 	{
		//matching the pattern of bounced email in subject and from of header 
		if(preg_match("/(mail delivery failed|failure notice|warning: message|delivery status notif|delivery failure|delivery problem|spam eater|returned mail|undeliverable|returned mail|delivery errors|returned to sender|message delayed|mdaemon notification|mailserver notification|mail delivery system|nondeliverable mail|mail status report|mail system error|failure delivery|delivery notification|delivery has failed|undelivered mail|returned email|returning message to sender|mail transaction failed)/i",$mail_header['Subject'])) return true;
		if(preg_match("/^(postmaster|mailer-daemon)\@/i", $mail_header['From'])) return true;
		return false;
	}
	function countBouncedEmails()
	{
		$y="";
		for($x=1; $x <= $this->total_emails; $x++) 
		{
			//just verifying weather this function works properly 
		/*	if (imap_headerinfo && imap_body)
			{*/      
               $headers=array();
			   //getting info from the header of email
			   $headerinfo = imap_headerinfo($this->imap_resource,$x);
			   $body = imap_body ($this->imap_resource,$x);
			    //assigning it to the varibles 
				$headers['From']=$headerinfo->fromaddress;
				$headers['Subject']=$headerinfo->Subject;
				//add this email addres to the bounced email address
				//if is bounced email then increment the total bounce counters
				if(CI_Bounce_email_counter::is_bounced_email($headers))
				{
					$this->bouce_count++;
					
				}
				$aa="";
				
				$b=$body;
				$mm="";
				//check the pattern specified above
			  	if(preg_match("/Campaign:([0-9]+)-([0-9]+)-bouncedemail/i",$body,$matches))
			  	{
			      	
						$yy[]=array($matches[1], $matches[2]);								
																
						if($this->delete_mail)
							imap_delete($this->imap_resource, $x);	
				} 
		}
		//delete the message marked for deletion
		if($this->delete_mail)
			imap_expunge($this->imap_resource);
		//return the totla bounced email for compaign
		//return $this->bounce_count_campaign;
		return $yy;
		//return $y;
	}
	

}

?>