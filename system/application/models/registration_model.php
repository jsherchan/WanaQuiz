<?php

class Registration_model extends Model {

    function Registration_model() {
        parent::Model();
        $this->load->model('Email_model');
    }

    function register() {
        $this->load->model('Award_model');
        $current_date = current_date_time_stamp();
        $dod = $this->input->post('dod', TRUE);
        $dom = $this->input->post('dom', TRUE);
        $doy = $this->input->post('doy', TRUE);
        $dob = time(0, 0, 0, $doy, $dom, $dod);
        if ($this->session->userdata('referer_id') != '')
            $referer_id = $this->session->userdata('referer_id');
        else
            $referer_id=0;
        $options = array('username' => strtolower($this->input->post('uname', TRUE)),
            'password' => md5($this->input->post('password', TRUE)),
            'joined_date' => $current_date,
            'referer_id' => $referer_id,
            'newsletter_subscribe' => $this->input->post('newsletter', TRUE),
            'user_credits' => '0');

        $this->db->insert('tbl_members', $options);
        $id = $this->db->insert_id();
        if ($this->session->userdata('referer_id') != '')
            $this->Award_model->insertReferringAward($this->session->userdata('referer_id'));
        $this->session->unset_userdata('referer_id');

        $c = $this->input->post('country', TRUE);
        $s = $this->input->post('state', TRUE);
        if ($c) {
            $sql = "select country_name from country where country_code like '%$c%'";
            $ct = $this->db->query($sql);
            $cs = $ct->result_array();
            $country = $cs[0]['country_name'];
        }
        if ($s) {
            $que = "select state_name from states where country_code like '%$c%' and state_code like'%$s%'";
            $st = $this->db->query($que);
            $ss = $st->result_array();
            $state = $ss[0]['state_name'];
        }

        $options2 = array(
            'member_id' => $id,
            'city' => $this->input->post('city', TRUE),
            'state' => $state,
            'country' => $country
        );
        $this->db->insert('tbl_address', $options2);

        $options1 = array('first_name' => $this->input->post('fname', TRUE),
            'last_name' => $this->input->post('lname', TRUE),
            'email' => $this->input->post('email', TRUE),
            'gender' => $this->input->post('gender', TRUE),
            'dob' => $dob,
            'joined_date' => $current_date,
            'member_id' => $id);
        $this->db->insert('tbl_member_profile', $options1);


        $categories = $this->Category_model->get_categories();
        foreach ($categories as $category) {
            $data = array('user_id' => $id,
                'category_id' => $category->id,
                'category_titles' => '1',
                'points' => 0
            );
            $this->db->insert('tbl_member_category_titles', $data);
        }

        $this->Award_model->insert_user_category_award($id);

        return $id;
    }

    function register_advertiser() {

        $current_date = current_date_time_stamp();
        $user_credits = $this->Member_model->get_default_user_credits();

        $options = array('username' => strtolower($this->input->post('uname', TRUE)),
            'user_type' => '1',
            'password' => md5($this->input->post('password', TRUE)),
            'joined_date' => $current_date,
            'newsletter_subscribe' => $this->input->post('newsletter', TRUE),
            'user_credits' => $user_credits);

        $this->db->insert('tbl_members', $options);
        $mem_id = $this->db->insert_id();

        $options1 = array('company_name' => $this->input->post('cname', TRUE),
            'company_website' => $this->input->post('cwebsite', TRUE),
            'member_id' => $mem_id
        );

        $this->db->insert('tbl_advertisers', $options1);
        $advertiser_id = $this->db->insert_id();
        $c = $this->input->post('country', TRUE);
        $s = $this->input->post('state', TRUE);
        if ($c) {
            $sql = "select country_name from country where country_code like '%?%'";
            $ct = $this->db->query($sql,array($c));
            $cs = $ct->result_array();
            $country = $cs[0]['country_name'];
        }
        if ($s) {
            $que = "select state_name from states where country_code like '%?%' and state_code like'%?%'";
            $st = $this->db->query($que,array($c,$s));
            $ss = $st->result_array();
            $state = $ss[0]['state_name'];
        }

        $options2 = array('address' => $this->input->post('caddress',TRUE),
            'member_id' => $mem_id,
            'city' => $this->input->post('city',TRUE),
            'state' => $state,
            'country' => $country
        );
        $this->db->insert('tbl_address', $options2);

        $dod = $this->input->post('dod',TRUE);
        $dom = $this->input->post('dom',TRUE);
        $doy = $this->input->post('doy',TRUE);
        $dob = time(0, 0, 0, $doy, $dom, $dod);
        $options3 = array('first_name' => $this->input->post('fname',TRUE),
            'last_name' => $this->input->post('lname',TRUE),
            'email' => $this->input->post('email',TRUE),
            'gender' => $this->input->post('gender',TRUE),
            'dob' => $dob,
            'joined_date' => $current_date,
            'member_id' => $mem_id
        );
        $this->db->insert('tbl_member_profile', $options3);
        $categories = $this->Category_model->get_categories();
        foreach ($categories as $category) {
            $data = array('user_id' => $mem_id,
                'category_id' => $category->id,
                'category_titles' => '1',
                'points' => 0
            );
            $this->db->insert('tbl_member_category_titles', $data);
        }
        $this->Award_model->insert_user_category_award($id);
        return $mem_id;
    }

}

?>