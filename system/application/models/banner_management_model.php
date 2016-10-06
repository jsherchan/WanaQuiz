<?php
class Banner_management_model extends Model {

	function Banner_management_model()
	{
		parent::Model();	
	}
	
	
	function banner_list()
	{
		$query = $this->db->get('tbl_adv_banners_type');
		if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
	}
		
	function get_banner_info($banner_id)
	{		
		$options=array('id'=>$banner_id);
		$query = $this->db->getwhere('tbl_adv_banners_type',$options,1);
		return $query->row();
	}

        function insert_banner_data(){
            $image = $_FILES['banner']['name'];
            $question = $this->input->post('question_values',TRUE);
            //print_r($question);exit;
            foreach($question as $questions){ 
            $data=array('banner_name'=>$this->input->post('banner_name',TRUE),
                    'width'=>$this->input->post('width',TRUE),
                    'height'=>$this->input->post('height',TRUE),
                    'cpc'=>$this->input->post('cpc',TRUE),
                    'category_id'=>$this->input->post('category',TRUE),
                    'url'=>$this->input->post('url',TRUE),
                    'image'=>$image,
                    'active'=>$this->input->post('active',TRUE),
                    'quiz_id'=>$questions
                    );
            $this->db->insert('tbl_adv_banners_type',$data);
            }
        }
			
	function update_banner_data(){
                 $image = $_FILES['banner']['name'];
                $data=array('banner_name'=>$this->input->post('banner_name',TRUE),
                            'width'=>$this->input->post('width',TRUE),
                            'height'=>$this->input->post('height',TRUE),
                            'cpc'=>$this->input->post('cpc',TRUE),
                            //'category_id'=>$this->input->post('category'),
                            'url'=>$this->input->post('url',TRUE),
                            'image'=>$image,
                            'active'=>$this->input->post('active',TRUE),
                            //'quiz_id'=>$questions
                        );
                $this->db->where('id',$this->input->post('id',TRUE));
                $this->db->update('tbl_adv_banners_type',$data);
            
        }

        function insert_text_ads_data(){
            $question = $this->input->post('question_values',TRUE);
            //print_r($question);exit;
            foreach($question as $questions){
            $data=array('text_name'=>$this->input->post('text_name',TRUE),
                    'cpc'=>$this->input->post('cpc',TRUE),
                    'category_id'=>$this->input->post('category',TRUE),
                    'url'=>$this->input->post('url',TRUE),
                    'content'=>$this->input->post('content',TRUE),
                    'active'=>$this->input->post('active',TRUE),
                    'quiz_id'=>$questions
                    );
            $this->db->insert('tbl_adv_texts',$data);
            }
        }

    function get_text_adv(){
      $query = $this->db->get('tbl_adv_texts');
      if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_text_adv_info($id)
    {
		$options=array('id'=>$id);
		$query = $this->db->getwhere('tbl_adv_texts',$options);
		return $query->row();
    }
    
    function update_text_ads_data(){
    $question = $this->input->post('question_values',TRUE);
            $data=array('text_name'=>$this->input->post('text_name',TRUE),
                    'cpc'=>$this->input->post('cpc',TRUE),
                    //'category_id'=>$this->input->post('category'),
                    'url'=>$this->input->post('url',TRUE),
                    'content'=>$this->input->post('content',TRUE),
                    'active'=>$this->input->post('active',TRUE),
                    //'quiz_id'=>$questions
                    );
    $this->db->where('id',$this->input->post('id',TRUE));
    $this->db->update('tbl_adv_texts',$data);
    }

    function delete_banner_data($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_adv_banners_type');
        if($query) return true;
        else return false;
    }

    function delete_text_ads_data($id){
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_adv_texts');
        
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */