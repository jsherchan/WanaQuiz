<?php

class Advertise_management_model extends Model {

    function Advertise_management_model() {
        parent::Model();
    }

    function advertisements() {
        $this->db->where('adv_dimension', 'vertical');
        $query = $this->db->get('tbl_advertisements');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function rectangular_advertisements() {
        $this->db->where('adv_dimension', 'rectangular');
        $query = $this->db->get('tbl_advertisements');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_advertisement_info($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_advertisements', $options);
        return $query->row();
    }

    function insert($advertise_banner) {
        $data = array('cat_id' => $this->input->post('cat_id',TRUE),
            'adv_type' => $this->input->post('adv_type',TRUE),
            'adv_dimension' => $this->input->post('adv_dimension',TRUE),
            'adv_detail' => $this->input->post('adv_detail',TRUE),
            'link_url' => $this->input->post('link_url',TRUE),
            'adv_position' => $this->input->post('adv_position',TRUE),
            'adv_banner' => $advertise_banner);
        $this->db->insert('tbl_advertisements', $data);
    }

    function update($advertise_banner) {
        $data = array('cat_id' => $this->input->post('cat_id',TRUE),
            'adv_type' => $this->input->post('adv_type',TRUE),
            'adv_dimension' => $this->input->post('adv_dimension',TRUE),
            'adv_detail' => $this->input->post('adv_detail',TRUE),
            'link_url' => $this->input->post('link_url',TRUE),
            'adv_position' => $this->input->post('adv_position',TRUE),
            'adv_banner' => $advertise_banner);
        $this->db->where('id', $this->input->post('id',TRUE));
        $this->db->update('tbl_advertisements', $data);
    }

    function getRandomAdsenseAdv() {
        $sql = "Select * from tbl_advertisements where adv_type='adsense' order by rand() limit 6";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRandomBannerAdv() {
        $sql = "Select * from tbl_advertisements where adv_type='personal' order by rand() limit 6";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getRandomAffiliateAdv() {
        $sql = "Select * from tbl_advertisements where adv_type='affiliate' order by rand() limit 6";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_admin_ads_by_cid($cid, $type='') {
        if ($type == '') {
            $sql = "select * from tbl_advertisements where cat_id=? order by rand()";
            $query = $this->db->query($sql, array($cid));
        } else {
             $sql = "select * from tbl_advertisements where cat_id=? and adv_dimension = ? order by rand()";
            $query = $this->db->query($sql, array($cid, $type));
        }
        return $query->result();
    }

    function get_admin_ads_by_cid_quiz($cid, $type='') {
        if ($type == '') {
            $sql = "select * from tbl_advertisements where cat_id=? and adv_position='quiz' or adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid));
        } else {
            $sql = "select * from tbl_advertisements where cat_id=? and adv_dimension =? and adv_position='quiz' or adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid, $type));
        }
        return $query->result();
    }

    function get_admin_ads_by_cid_category($cid, $type='') {
        if ($type == '') {
            $sql = "select * from tbl_advertisements where cat_id=? and adv_position='category' or adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid));
        } else {
            $sql = "select * from tbl_advertisements where cat_id=? and adv_dimension = ? and adv_position='category' or adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid, $type));
        }

        return $query->result();
    }

    function get_admin_ads_by_cid_sub_category($cid, $type='') {
        if ($type == '') {
            $sql = "SELECT a . * , b.name
                FROM tbl_advertisements a
                JOIN tbl_categories b ON a.cat_id = b.parent_id
                WHERE a.cat_id = '?'
                and a.adv_dimension = 'rectangular' and a.adv_position='category' or a.adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid));
        } else {
            $sql = "SELECT a . * , b.name
                FROM tbl_advertisements a
                JOIN tbl_categories b ON a.cat_id = b.parent_id
                WHERE a.cat_id = '?' and a.adv_dimension = '?' and a.adv_position='category' or a.adv_position='quiz_category' order by rand()";
            $query = $this->db->query($sql, array($cid, $type));
        }
        return $query->result();
    }

    function get_admin_ads_by_allcid() {
        $sql = "select * from tbl_advertisements where cat_id!='0' order by rand()";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_rectangular_admin_ads() {
        $sql = "select * from tbl_advertisements where adv_dimension = 'rectangular' order by rand()";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_rectangular_admin_home_ads() {
        $sql = "select * from tbl_advertisements where adv_position = 'home' order by rand() limit 1";
        $query = $this->db->query($sql);
        return $query->result();
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */