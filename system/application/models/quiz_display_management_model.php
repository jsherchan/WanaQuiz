<?php
class Quiz_display_management_model extends Model {

	function Quiz_display_management_model()
	{
		parent::Model();	
	}
	
	
	function quiz_display_data()
	{
		$query = $this->db->get('tbl_quiz_display');
		if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
	}
		
	function get_quiz_display_info($id)
	{		
		$options=array('id'=>$id);
		$query = $this->db->getwhere('tbl_quiz_display',$options,1);
		return $query->row();
	}

       
	function update_quiz_display_data(){
                 
                $data=array('user_type'=>$this->input->post('user_type',TRUE),
                            'percentage'=>$this->input->post('percentage',TRUE),
                        );
                $this->db->where('id',$this->input->post('id',TRUE));
                $this->db->update('tbl_quiz_display',$data);
            
        }
    

    function delete_quiz_display_data($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_quiz_display');
        if($query) return true;
        else return false;
    }
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */