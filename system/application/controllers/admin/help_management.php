<?php

class Help_management extends Front_controller {

    function Help_management() {
        parent::Front_controller();
        $this->load->library('parser');
        $this->load->model('Help_management_model');
    }

    function index() {
        $this->help_management_list();

    }

    function help_management_list($parent_id=0,$sort_field='sort_order',$sort_order='ASC') {
    $this->load->model('Cms_model');
        $data['title']="Wannaquiz:Help management";
        $data['main']='admin/help';

        //CALL CATEGORY Models
        $data['help_list']=$this->Help_management_model->get_all_helps($parent_id,$sort_field,$sort_order);
        //print_r($data['help_list']);exit;
        $cat_info_CMSType = $data['help_list'][0]->CMSType;//exit;
        $cat_info = $this->Cms_model->get_all_cms($cat_info_CMSType);
        //print_r($cat_info);exit;
        $data['url'] = $cat_info[0]->url;
        if($sort_order=="ASC")
            $data['sort']="DESC";
        else
            $data['sort']="ASC";

        $data['cat_id']=$parent_id;
        $data['cat_level']=$this->Help_management_model->get_help_level($parent_id);
        if($parent_id!=0)
            $data['breadcrumb']=$this->Help_management_model->get_bread_crumb($parent_id);
        //$this->load->vars($data);
        $this->parser->parse('admin/admin',$data);
    }

    function add_help(){
        $data['title']="Wannaquiz: Add Help management";
        $data['main']='admin/add_edit_help';
        $data['add']='add';
        $this->parser->parse('admin/admin',$data);
    }

    function insert_help(){
        $file_info=$this->upload_category_image('category_image');
        $this->Help_management_model->add_help($file_info['file_name']);
	$this->session->set_flashdata('message','Page Added');
	redirect(ADMIN_PATH.'/help_management','refresh');
    }

    
    function edit_help_management($cat_id) {
        $this->load->model('Cms_model');
        $data['title']="Wannaquiz:Edit Help Management";
        $data['main']='admin/edit_help_management';
        $cat_info=$this->Help_management_model->get_help_id_info($cat_id,'');
        //print_r($cat_info);
        $cat_info_CMSType = $cat_info[0]['type'];//exit;
        $data['id'] = $cat_info[0]['id'];
        $data['sort_order']=$cat_info[0]['sort_order'];
        $data['cat_info'] = $this->Cms_model->get_all_cms($cat_info_CMSType);
        //print_r($data['cat_info']);
        $this->parser->parse('admin/admin',$data);
    }

    function update_help($id){
        $cat_info=$this->Help_management_model->get_help_id_info($id,'');
        //print_r($cat_info);
        if(file_exists("./help_management_images/".$cat_info[0]['help_image']) && $_FILES['category_image']['name']!="")
				unlink("./help_management_images/".$cat_info[0]['help_image']);
         $this->upload_category_image('category_image');
        $this->Help_management_model->edit_help($id);
	$this->session->set_flashdata('message','Page updated');
        //echo $cat_info[0]['parent_id']; exit;
        if($cat_info[0]['parent_id']==0)
	redirect(ADMIN_PATH.'/help_management','refresh');
        else
        redirect(ADMIN_PATH.'/help_management/help_management_list/'.$cat_info[0]["parent_id"],'refresh');
    }

   
    function delete_help_management($id) {
        $cat_info=$this->Help_management_model->get_help_id_info($id,'');
        $cat_info_CMSType = $cat_info[0]['type'];
        if ($id) {
            $this->db->where("id", $id);
            $this->db->delete("tbl_help_management");
        }

        if($cat_info_CMSType){
            $this->db->where('type',$cat_info_CMSType);
            $this->db->delete('tbl_contents');
        }
        $this->session->set_flashdata('message','Selected Category Deleted');

        redirect(ADMIN_PATH.'/help_management/','refresh');
    }

    
    function deleteCategoryTitles($cat_title_id) {
        $this->db->where("id", $cat_title_id);
        $query =$this->db->delete("tbl_category_titles");
        if($query)
            $this->session->set_flashdata('message','Selected Category Title Deleted');
        else $this->session->set_flashdata('message','Can not delete Selected Category Title');
        redirect(ADMIN_PATH.'/categories/getCategoryTitles','refresh');
    }

    function search() {
        $data['title'] = "Category Management Search Results";
        $search_category = $this->input->post('search_category');
        $data['search_results'] = $this->Search_model->getCategorySearchResults($search_category);
        //$this->session->set_flashdata('message','Searched Results for '.$this->input->post('search_category'));
        $data['message']="Searched Results for '".$this->input->post('search_category')."'";
        $data['main']='admin/category_searched';
        $this->parser->parse('admin/admin',$data);

    }

    function upload_category_image($file) {
        $config['upload_path'] ='./help_management_images/';
        $config['allowed_types'] = 'jpg|gif|png';
        $config['max_size']	= '1000';
        $config['max_width']  = 0;
        $config['max_height']  =0;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
        return $data;
    }

    function checkType(){
        $type = $this->input->post('CMSType');
        $this->load->model('Cms_model');
        $check_type = $this->Cms_model->check_cmstype($type);
        if($check_type)
        echo 'already_exist';
        else echo 'not exist';

    }
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */