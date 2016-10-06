<?php
class Product_management_model extends Model {

    function Product_management_model() {
        parent::Model();
    }


    function product_list($num,$limit) {
        $sql = "SELECT * FROM tbl_products ORDER BY product_name ASC limit ".$limit.",".$num;
        $query = $this->db->query($sql);
        //$query = $this->db->get('tbl_products');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }
    function count_product_list()
    {
         $sql = "SELECT * FROM tbl_products ORDER BY product_name ASC ";
        $query = $this->db->query($sql);
        return $query->num_rows();
        
    }

    function get_product_info($product_id) {
        $options=array('id'=>$product_id);
        $query = $this->db->getwhere('tbl_products',$options,1);
        return $query->row();
    }

    function insert_product_data() {
        $data=array('product_name'=>$this->input->post('product_name',TRUE),
            'category_id'=>$this->input->post('category',TRUE),
            'product_description'=>$this->input->post('product_description',TRUE),
            'sub_category_id'=>$this->input->post('subcategory',TRUE)
        );
        $this->db->insert('tbl_products',$data);
    }
    
    function update_product_data() {
        $data=array('product_name'=>$this->input->post('product_name',TRUE),
            'category_id'=>$this->input->post('category',TRUE),
            'product_description'=>$this->input->post('product_description',TRUE),
            'sub_category_id'=>$this->input->post('subcategory',TRUE)
        );
        $this->db->where('id',$this->input->post('id',TRUE));
        $this->db->update('tbl_products',$data);

    }


    function delete_product_data($id) {
        $this->db->where('id',$id);
        $query = $this->db->delete('tbl_products');
        if($query) return true;
        else return false;
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */