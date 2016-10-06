<?php
class Email_model extends Model
{
	
	function Email_model()
	{
		parent::Model();
	}
	
			
		//to get email body and subject
		function get_email_template($mail_type)
		{
			$options=array('template_code'=>$mail_type);
			$query=$this->db->getwhere('tbl_email_templates',$options);
					
			return $query->row();;
		}
		
		//to parse the the email which is available in the 

		function parse_email($parseElement,$mail_body)
		{

			foreach($parseElement as $name=>$value)
			{
				$parserName=$name;
				$parseValue=$value;
		
				
				$mail_body=str_replace("[$parserName]",$parseValue,$mail_body);

			}
					
			return $mail_body;
		}
		
	
		
}
?>