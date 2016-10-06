<?php
class Email_template_model extends Model {

	function Email_template_model()
	{
		parent::Model();	
	}
	
	function get_template_info($name)
	{
		$data=array();
		$options=array('template_code'=>$name);
		$query = $this->db->getwhere('tbl_email_templates',$options,1);
		return $query->row();
		
	}
	
	function update_email_template(){
		$data=array('template_design'=>$this->input->post('message_body',TRUE),'template_subject'=>$this->input->post('subtext',TRUE));
		$this->db->where('template_code',$this->input->post('TemplateCode',TRUE));
		$this->db->update('tbl_email_templates',$data);
	}
		
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */