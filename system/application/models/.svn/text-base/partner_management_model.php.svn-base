<?php
class Partner_management_model extends Model {

	function Partner_management_model()
	{
		parent::Model();	
	}
	
	
	function partner_list()
	{
           // $this->db->where('active',1);
            $query = $this->db->get('tbl_partners');
            if ($query->num_rows() > 0)
                return $query->result();
            else
                return NULL;
	}
		
	function get_partner_info($id)
	{		
		$options=array('user_id'=>$id);
		$query = $this->db->getwhere('tbl_partners',$options,1);
		return $query->row();
	}

       
	function update_partner_data(){
                 
                $data=array('user_type'=>$this->input->post('user_type',TRUE),
                            'percentage'=>$this->input->post('percentage',TRUE),
                        );
                $this->db->where('id',$this->input->post('id',TRUE));
                $this->db->update('tbl_quiz_display',$data);
            
        }
    

    function delete_partner_data($id){
        $this->db->where('user_id',$id);
        $query = $this->db->delete('tbl_partners');
        if($query) return true;
        else return false;
    }

    function get_admin_adsense_code(){
        $query = $this->db->get('tbl_site_settings');
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */