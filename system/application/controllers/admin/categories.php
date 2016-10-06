<?php

class Categories extends Front_controller {

    function Categories() {
        parent::Front_controller();
        $this->load->library('parser');
        $this->load->model('Category_model');
    }

    function index() {
        $this->categories_list();

    }

    function categories_list($parent_id=0,$sort_field='sort_order',$sort_order='ASC') {

        $data['title']="Wannaquiz:Categories management";
        $data['main']='admin/categories';

        //CALL CATEGORY Models
        $data['category_list']=$this->Category_model->get_all_categories($parent_id,$sort_field,$sort_order);
        if($sort_order=="ASC")
            $data['sort']="DESC";
        else
            $data['sort']="ASC";

        $data['cat_id']=$parent_id;
        $data['cat_level']=$this->Category_model->get_cat_level($parent_id);
        if($parent_id!=0)
            $data['breadcrumb']=$this->Category_model->get_bread_crumb($parent_id);
        //$this->load->vars($data);
        $this->parser->parse('admin/admin',$data);
    }

    function add_categories() {
        $file_info=$this->upload_category_image('category_image');
        $this->Category_model->add_category($file_info['file_name']);
        $this->session->set_flashdata('message','Category Added Successfully');
        redirect(ADMIN_PATH.'/categories/categories_list/'.$this->input->post('parent_id',TRUE),'refresh');
    }

    function edit_category($cat_id) {

        $data['title']="Wannaquiz:Edit Category";
        $data['main']='admin/edit_category';
        $data['cat_info']=$this->Category_model->get_cat_id_info($cat_id);
        $this->parser->parse('admin/admin',$data);
    }

    function edit() {
        $cat_id = $this->input->post('cat_id',TRUE);
        $cat_info=$this->Category_model->get_cat_id_info($cat_id);
        //echo $_FILES['category_image']['name'];exit;
        if(file_exists("./category_images/".$cat_info[0]['category_image']) && $_FILES['category_image']['name']!="")
				unlink("./category_images/".$cat_info[0]['category_image']);

	$this->upload_category_image('category_image');
        $parent_id=$this->Category_model->get_parent_id($this->input->post('cat_id',TRUE));
        $this->Category_model->edit_category();
        $this->session->set_flashdata('message','Selected Category Edited');

        redirect(ADMIN_PATH.'/categories/categories_list/'.$parent_id->parent_id,'refresh');
    }


    function delete($cat_id) {
        $parent_id=$this->Category_model->get_parent_id($cat_id);
        if ($cat_id) {
            $this->db->where("id", $cat_id);
            $this->db->delete("tbl_categories");
        }
        $this->session->set_flashdata('message','Selected Category Deleted');

        redirect(ADMIN_PATH.'/categories/categories_list/'.$parent_id->parent_id,'refresh');
    }

    function add_category_titles() {
        $query = $this->Category_model->insert_category_titles();
        if($query)
            $this->session->set_flashdata('message','Successfuly inserted.');
        else $this->session->set_flashdata('message','Can not insert category title.');
        redirect(ADMIN_PATH.'/categories/getCategoryTitles','refresh');

    }
    function editCategoryTitles($cat_title_id) {

        $data['title']="Wannaquiz:Edit Category Title";
        $data['main']='admin/edit_category_title';
        $data['cat_title_info'] = $this->Category_model->get_category_title_info($cat_title_id);
        $this->parser->parse('admin/admin',$data);
    }

    function edit_cat_titles() {
        $query = $this->Category_model->edit_category_titles();
        if($query)
            $this->session->set_flashdata('message','Selected Category Title Edited');
        else $this->session->set_flashdata('message','Can not edit Selected Category Title');
        redirect(ADMIN_PATH.'/categories/getCategoryTitles','refresh');
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
        $search_category = $this->input->post('search_category',TRUE);
        $data['search_results'] = $this->Search_model->getCategorySearchResults($search_category);
        //$this->session->set_flashdata('message','Searched Results for '.$this->input->post('search_category',TRUE));
        $data['message']="Searched Results for '".$this->input->post('search_category',TRUE)."'";
        $data['main']='admin/category_searched';
        $this->parser->parse('admin/admin',$data);

    }

    function upload_category_image($file) {
        $config['upload_path'] ='./category_images/';
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

    function getCategoryTitles($sort_field='category_title',$sort_order='ASC') {
        $data['title']="Wannaquiz:Category Titles";
        $data['main']='admin/category_titles';
        if($sort_order=="ASC")
            $data['sort']="DESC";
        else
            $data['sort']="ASC";
        $data['category_titles']=$this->Category_model->get_category_titles($sort_field,$sort_order);
        $this->parser->parse('admin/admin',$data);
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */