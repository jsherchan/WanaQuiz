<?php

class Product_management extends Controller {

    function Product_management() {
        parent::Controller();
        $this->load->model('Product_management_model');
        $this->load->library('parser');
        $this->load->library('pagination');
    }

    function index() {
         $config['base_url'] = site_url('admin/product_management/index/');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['total_rows']= $this->Product_management_model->count_product_list();
      
        $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
        $config['cur_tag_open'] = '<li class="active">';
        $config['cur_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '<li>Next &raquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo; Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['product_list']=$this->Product_management_model->product_list($config['per_page'], $this->uri->segment(4, 0));
     
        $data['title']="Product Management~wannaquiz";
        $data['main']='admin/product_management';
        $data['flag']='';
        $this->parser->parse('admin/admin',$data);
    }

    function banner() {
        $data['title']="Banner Management~wannaquiz";
        $data['main']='admin/banner_management';
        $data['flag']= 'add_banner';
        $data['banner_list']=$this->Banner_management_model->banner_list();
        $this->parser->parse('admin/admin',$data);
    }

    function add_product() {
        $data['title']="Product Management->Add Product~Wannaquiz";
        $data['main']='admin/add_product';
        $data['category'] = $this->Category_model->get_categories();
        //$data['banner_info']=$this->Banner_management_model->get_banner_info($banner_id);
        $this->load->view('admin/admin',$data);
    }

    function edit_product($product_id) {
        $data['title']="Product Management->Edit Product~Wannaquiz";
        $data['main']='admin/edit_product';
        $data['product_info']=$this->Product_management_model->get_product_info($product_id);
        $data['category'] = $this->Category_model->get_categories();
        $this->load->view('admin/admin',$data);
    }

    function insert_product() {
        $this->Product_management_model->insert_product_data();
        redirect(ADMIN_PATH.'/product_management','refresh');
    }

    function upload_banner($file) {
        $config['upload_path'] ='./banner_images/';
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

    function update_product() {
        $product_info=$this->Product_management_model->get_product_info($this->input->post('id'));
        $this->Product_management_model->update_product_data();
        $this->session->set_flashdata('message','Product Edited');
        redirect(ADMIN_PATH.'/product_management','refresh');
    //$this->load->view('admin/admin');
    }

    function delete_product($id) {
        $product_info=$this->Product_management_model->get_product_info($id);
        $delete_data = $this->Product_management_model->delete_product_data($id);

        redirect(ADMIN_PATH.'/product_management','refresh');
    }

    function get_subcategories(){
        $cid = $this->input->post('cid');
        $sql = "SELECT * FROM tbl_categories WHERE parent_id = $cid";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            $subcategory = $query->result();
            $sub_category = '<option value="">All Subcategories</option>';
            foreach($subcategory as $subcategories){
                $sub_category .= '<option value="'.$subcategories->id.'">'.$subcategories->name.'</option>';
            }
            echo $sub_category;

        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */