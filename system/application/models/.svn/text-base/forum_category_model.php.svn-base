<?php

class Forum_category_model extends Model {

    function Forum_category_model() {
        parent::Model();
    }

    function get_all_categories($parent_id='0') {
        $option = array('parent_id' => $parent_id);

        $query = $this->db->getwhere('tbl_forum_categories', $option);

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_all_categorie($parent_id='0') {
        $option = array('parent_id' => $parent_id, 'flag' => '1');
        $query = $this->db->getwhere('tbl_forum_categories', $option);

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_catagory_by_id($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('tbl_forum_categories');
        return $res->result();
    }

    function get_cat_id_info($id) {
        $data = array();
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_forum_categories', $options, 1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = array('id' => $rows['id'], 'name' => $rows['name'],
                    'parent_id' => $rows['parent_id'],
                    'cat_level' => $rows['cat_level'],
                    'sort_order' => $rows['sort_order'],
                    'flag' => $rows['flag']);
            }

            $query->free_result();
            return $data;
        }
    }

    // this breadcrum for ADMIN SECTION
    function get_bread_crumb($parent_id) {
        $data = $this->get_category_by_id($parent_id);
        $bdc = anchor(site_url(ADMIN_PATH . '/forum/forum_categories/' . $data->id . '/name/ASC'), $data->name);
        if ($data->cat_level == 0)
            $bdc = $bdc;

        if ($data->cat_level == 1) {
            $parent_cat = $this->get_category_by_id($data->parent_id);
            $bdc = anchor(site_url(ADMIN_PATH . '/forum/forum_categories/' . $parent_cat->id . '/name/ASC'), $parent_cat->name) . "->" . $bdc;
        }

        return $bdc;
    }

    function get_parent_id($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_forum_categories', $options, 1);
        $data = $query->row();
        return $data->parent_id;
    }

    function get_cat_level($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_forum_categories', $options, 1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data = $rows['cat_level'];
            }
            $query->free_result();
            return $data;
        }
    }

    function add_category($cat) {
        if ($this->get_cat_level($this->input->post('parent_id',TRUE)) == "")
            $cat_level = 0;
        else
            $cat_level=$this->get_cat_level($this->input->post('parent_id',TRUE)) + 1;

        $sort_order = $this->get_new_sort_order($this->input->post('parent_id',TRUE)) + 1;

        $data = array(
            'name' => $cat,
            'cat_level' => $cat_level,
            'sort_order' => $sort_order,
            'parent_id' => $this->input->post('parent_id',TRUE),
            'date_added' => date('Y-m-d H:i:s'),
            'flag' => $this->input->post('cat_status',TRUE)
        );
        $this->db->insert('tbl_forum_categories', $data);
        return $this->db->insert_id();
    }

    function edit_forum_category() {
        $data = array('name' => $this->input->post('cat_name',TRUE),
            'flag' => $this->input->post('cat_status',TRUE),
            'last_modified' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('cat_id',TRUE));
        $this->db->update('tbl_forum_categories', $data);
    }

    function get_new_sort_order($parent_id) {
        $sql = "select sort_order from tbl_forum_categories where parent_id='?' order by sort_order desc";
        $query = $this->db->query($sql,array($parent_id));
        $data = $query->row();
        return $data->sort_order;
    }

    function get_order_by_id($id) {
        $this->db->select('sort_order');
        $query = $this->db->get_where('tbl_forum_categories', array('id' => $id));
        $data = $query->row();
        return $data->sort_order;
    }

    function change_order($pos, $id) {
        $parent_id = $this->get_parent_id($id);
        $cur_id = $id;
        $cur_order = $this->get_order_by_id($id);

        if ($pos == 'down') {
            $this->db->order_by('sort_order', 'asc');
            $query = $this->db->get_where('tbl_forum_categories', array('sort_order >' => $cur_order, 'parent_id' => $parent_id));
            $result = $query->first_row();

            if (count($result) == 0) {
                return 0;
            } else {
                $new_id = $result->id;
                $new_order = $result->sort_order;

                $data = array('sort_order' => $new_order);
                $this->db->where('id', $cur_id);
                $this->db->update('tbl_forum_categories', $data);

                $data = array('sort_order' => $cur_order);
                $this->db->where('id', $new_id);
                $this->db->update('tbl_forum_categories', $data);
            }
        } else {
            $this->db->order_by('sort_order', 'asc');
            $query = $this->db->get_where('tbl_forum_categories', array('sort_order <' => $cur_order, 'parent_id' => $parent_id));
            $result = $query->last_row();

            if (count($result) == 0) {
                return 0;
            } else {
                $new_id = $result->id;
                $new_order = $result->sort_order;

                $data = array('sort_order' => $new_order);
                $this->db->where('id', $cur_id);
                $this->db->update('tbl_forum_categories', $data);

                $data = array('sort_order' => $cur_order);
                $this->db->where('id', $new_id);
                $this->db->update('tbl_forum_categories', $data);
            }
        }
    }

    // Functions for the front website ----------------------------
    function get_categories() {
        $options = array('parent_id' => 0);
        $query = $this->db->getwhere('tbl_forum_categories', $options);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return false;
    }

    function check_sub_category($id) {
        $sql = "SELECT * FROM tbl_forum_categories WHERE parent_id=?";

        $query = $this->db->query($sql, array($id));

        return $query->num_rows();
    }

    function get_sub_categories($parent_id) {
        $options = array('parent_id' => $parent_id);
        $query = $this->db->getwhere('tbl_forum_categories', $options);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return null;
        $query->free_result();
        return $data;
    }

    function get_sub_categorie($parent_id) {
        $options = array('parent_id' => $parent_id, 'flag' => '1');
        $query = $this->db->getwhere('tbl_forum_categories', $options);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return null;
        $query->free_result();
        return $data;
    }

    function count_products_by_category($cat_id) {
        $options = array('cat_id' => $cat_id, 'auction_status' => 'open');
        $query = $this->db->getwhere('tbl_products', $options);
        return $query->num_rows();
    }

    function get_category_by_id($cat_id) {
        $this->db->where('id', $cat_id);
        $query = $this->db->get('tbl_forum_categories');
        return $query->row();
    }

    function getCategorySearchResults($search_category) {
        $this->db->where('name', $search_category);
        $this->db->orderby('name');
        $query = $this->db->get('tblcategories');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */