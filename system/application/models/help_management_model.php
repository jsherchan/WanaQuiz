<?php
class Help_management_model extends Model {

    function Help_management_model() {
        parent::Model();
    }

    function get_all_helps($parent_id='0',$sort_field='sort_order',$sort_order='ASC') {
        
/*        if($this->session->userdata('wannaquiz_user_id') || $this->session->userdata('wannaquiz_guest_id'))
        {
        $options=array(
            'parent_id'=>$parent_id,
            'status'=>'0'
            );
        }
        else
*/            $options=array('parent_id'=>$parent_id);
#var_dump($options);        
        $this->db->orderby($sort_field,$sort_order);
        $query = $this->db->getwhere('tbl_help_management',$options);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_sub_helps($url,$sort_field='sort_order',$sort_order='ASC'){
        //echo $url; echo "hello";
        $options=array('CMSType'=>$url);        
        $query = $this->db->getwhere('tbl_help_management',$options);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0){
            $result = $query->row();
            $options1 = array('parent_id'=>$result->id);
            $this->db->orderby($sort_field,$sort_order);
            $query1 = $this->db->getwhere('tbl_help_management',$options1);
            //echo $this->db->last_query();
            if($query1->num_rows>0)
            return $query1->result();
            else return null;
        }
        else
            return NULL;
    }

    function add_help($filename){
        if($this->get_help_level($this->input->post('parent_id',TRUE))=="")
            $cat_level=0;
        else
            $cat_level=$this->get_help_level($this->input->post('parent_id',TRUE))+1;

        $data=array('CMSType'=>$this->input->post('CMSType',TRUE),
            'CMSTitle'=>$this->input->post('CMSTitle',TRUE),
            'flag'=>$this->input->post('status',TRUE),
            'parent_id'=>$this->input->post('parent_id',TRUE),
            'cat_level'=>$cat_level,
            'help_image' => $filename,
            'sort_order'=>$this->input->post('sort_order',TRUE));
        $this->db->insert('tbl_help_management',$data);

        $now=current_date_time_stamp();
	$data=array('type'=>$this->input->post('CMSType',TRUE),
            'title'=>$this->input->post('CMSTitle',TRUE),
            'detail'=>$this->input->post('CMSDetails',TRUE),
            'meta_desc'=>$this->input->post('CMSMeta_desc',TRUE),
            'meta_keywords'=>$this->input->post('CMSMeta_keywords',TRUE),
            'url' => $this->input->post('CMSUrl',TRUE),
            'date'=>$now);
	$this->db->insert('tbl_contents',$data);
    }

     function edit_help($id){
         #exit($this->input->post('CMSDetails'));
         //echo $id; echo $this->input->post('cmsid'); exit;
        // echo $this->input->post('CMSType').$this->input->post('CMSTitle');exit;
         $this->db->where('id',$id);
         $data=array('CMSType'=>$this->input->post('CMSType',TRUE),
             'CMSTitle'=>$this->input->post('CMSTitle',TRUE),
             'help_image'=>$_FILES['category_image']['name'],
             'flag'=>$this->input->post('status',TRUE),
             'sort_order'=>$this->input->post('sort_order',TRUE),             
                 );
         $this->db->update('tbl_help_management',$data);
#'status'=>$this->input->post('status',TRUE),

        $options=array('title'=>$this->input->post('CMSTitle',TRUE),
                    'type'=>$this->input->post('CMSType',TRUE),
                    'detail'=>$this->input->post('CMSDetails',TRUE),
                    'meta_desc'=>$this->input->post('CMSMeta_desc',TRUE),
                    'url'=>$this->input->post('CMSUrl',TRUE),
                    'meta_keywords'=>$this->input->post('CMSMeta_keywords',TRUE));
		$this->db->where('id',$this->input->post('cmsid',TRUE));
		$this->db->update('tbl_contents',$options);
    }

    // this breadcrum for ADMIN SECTION
    function get_bread_crumb($parent_id) {
        $data=$this->get_help_id_info($parent_id,'');
        $bdc=anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$data[0]['id'].'/CMSTitle/ASC'),$data[0]['name']);
        if($data[0]['cat_level']==0)
            $bdc=$bdc;

        if($data[0]['cat_level']==1) {
            $parent_cat=$this->get_help_id_info($data[0]['parent_id']);
            $bdc =anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$parent_cat[0]['id'].'/CMSTitle/ASC'),$parent_cat[0]['name'])."->".$bdc;
        }

        if($data[0]['cat_level']==2) {
            $parent_cat=$this->get_help_id_info($data[0]['parent_id']);
            $grand_parent=$this->get_help_id_info($parent_cat[0]['parent_id']);
            $bdc =anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$grand_parent[0]['id'].'/CMSTitle/ASC'),$grand_parent[0]['name'])."->".anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$parent_cat[0]['id'].'/name/ASC'),$parent_cat[0]['name'])."->".$bdc;
        }

        if($data[0]['cat_level']==3) {
            $parent_cat=$this->get_help_id_info($data[0]['parent_id']);
            $grand_parent=$this->get_help_id_info($parent_cat[0]['parent_id']);
            $grand_grand_parent = $this->get_help_id_info($grand_parent_cat[0]['parent_id']);
            $bdc =anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$grand_grand_parent[0]['id'].'/CMSTitle/ASC'),$grand_grand_parent[0]['name'])."->".anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$grand_parent[0]['id'].'/name/ASC'),$grand_parent[0]['name'])."->".anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$parent_cat[0]['id'].'/name/ASC'),$parent_cat[0]['name'])."->".$bdc;
        }

        return $bdc;

    }

    // this breadcrum for Front web site
    function bread_crumb($parent_id) {
        $data=$this->get_cat_id_info($parent_id);
        $bdc=$data[0]['name'];

        if($data[0]['cat_level']==0)
            $bdc=$bdc;

        if($data[0]['cat_level']==1) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $bdc =$parent_cat[0]['name']."->".$bdc;
        }

        if($data[0]['cat_level']==2) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $grand_parent=$this->get_cat_id_info($parent_cat[0]['parent_id']);
            $bdc =$grand_parent[0]['name']."->".$parent_cat[0]['name']."->".$bdc;
        }

        return $bdc;

    }

    function get_help_id_info($id='',$url='') {
        $data=array();
        if($id=='')
        $options=array('CMSType'=>$url);
        else
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_help_management',$options,1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[]=array('id'=>$rows['id'],
                    'name'=>$rows['CMSTitle'],
                    'type'=> $rows['CMSType'],
                    'help_image'=>$rows['help_image'],
                    //'category_description'=>$rows['category_description'],
                    //'cpc'=>$rows['cpc'],
                    'parent_id'=>$rows['parent_id'],
                    'cat_level'=>$rows['cat_level'],
                    //'sort_order'=>$rows['sort_order'],
                    'flag'=>$rows['flag'],
                    'sort_order'=>$rows['sort_order']);
            }

            $query->free_result();
            return $data;
        }
    }

    function get_help_detail($id='',$url=''){
        if($id=='')
        $options=array('CMSType'=>$url);
        else
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_help_management',$options);
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

   function get_help_level($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_help_management',$options,1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data=$rows['cat_level'];
            }

            $query->free_result();
            return $data;
        }
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */