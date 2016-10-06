<?php

class Country_management_model extends Model {

    function Country_management_model() {
        parent::Model();
    }

    function get_all_countries($flag, $sort_field, $sort_order, $num, $offset) {
        $data = array();
        $this->db->where('flag', $flag);
        $this->db->orderby($sort_field, $sort_order);
        $query = $this->db->get('tbl_countries', $num, $offset);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            $query->free_result();
            return $data;
        }
    }

    function get_all_country() {
        $data = array();
        $this->db->group_by('country_name');
        $this->db->order_by('country_name');
        $query = $this->db->get('country');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }
            $query->free_result();
            return $data;
        }
    }

    function get_country_id_info($id) {
        $data = array();
        $options = array('countries_id' => $id);
        $query = $this->db->getwhere('tbl_countries', $options, 1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = array('country_id' => $rows['countries_id'], 'country_name' => $rows['countries_name'],
                    'country_code' => $rows['countries_iso_code_2']);
            }

            $query->free_result();
            return $data;
        }
    }

    function get_all_states($country_id, $sort_field, $sort_order, $num, $offset) {
        $this->db->orderby($sort_field, $sort_order);
        $this->db->limit($num, $offset);
        $options = array('country_id' => $country_id);
        $query = $this->db->getwhere('tbl_states', $options);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }

            $query->free_result();
            return $data;
        }
    }

    function get_state_info($state_id) {
        $data = array();
        $options = array('state_id' => $state_id);
        $query = $this->db->getwhere('tbl_states', $options, 1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = array('state_id' => $rows['state_id'], 'state_name' => $rows['state_name'],
                    'state_code' => $rows['state_abbr'], 'country_id' => $rows['country_id']);
            }

            $query->free_result();
            return $data;
        }
    }

    function get_cities($state_id, $sort_field, $sort_order, $num, $offset) {
        $this->db->orderby($sort_field, $sort_order);
        $this->db->limit($num, $offset);
        $options = array('state_id' => $state_id);
        $query = $this->db->getwhere('tblcities', $options);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }

            $query->free_result();
            return $data;
        }
    }

    function get_city_info($city_id) {
        $data = array();
        $options = array('city_id' => $city_id);
        $query = $this->db->getwhere('tblcities', $options, 1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[] = array('city_id' => $rows['city_id'], 'city_name' => $rows['city_name'],
                    'state_id' => $rows['state_id']);
            }

            $query->free_result();
            return $data;
        }
    }

    //-------------------------------------------------------------------------------
    function add_country() {
        $data = array('countries_name' => $this->input->post('country_name',TRUE), 'countries_iso_code_2' => $this->input->post('country_code',TRUE));
        $this->db->insert('tbl_countries', $data);
    }

    function edit_country() {
        $data = array('countries_name' => $this->input->post('country_name',TRUE), 'countries_iso_code_2' => $this->input->post('country_code',TRUE));
        $this->db->where('countries_id', $this->input-> post('country_id',TRUE));
        $this->db->update('tbl_countries', $data);
    }

    //-------------------------------------------------------------------------------
    function add_states() {
        $data = array('state_name' => $this->input->post('state_name',TRUE), 'country_id' => $this->input->post('country_id',TRUE), 'state_abbr' => $this->input->post('state_code',TRUE));
        $this->db->insert('tbl_states', $data);
    }

    function edit_states() {
        $data = array('state_name' => $this->input->post('state_name',TRUE), 'state_abbr' => $this->input->post('state_code',TRUE));
        $this->db->where('state_id', $this->input->post('state_id'));
        $this->db->update('tbl_states', $data);
    }

    //-------------------------------------------------------------------------------
    function add_city() {
        $data = array('state_id' => $this->input->post('state_id',TRUE), 'city_name' => $this->input - post('city_name',TRUE));
        $this->db->insert('tblcities', $data);
    }

    function edit_city() {
        $data = array('city_name' => $this->input->post('city_name',TRUE));
        $this->db->where('city_id', $this->input - post('city_id',TRUE));
        $this->db->update('tblcities', $data);
    }

    function check_state_city_by_country($country_id) {
        $sql = "select state_id from tblcities where state_id IN(select state_id from tbl_states where country_id='?')";
        $query = $this->db->query($sql, array($country_id));
        return $query->num_rows();
    }

    function get_country() {
        $this->db->order_by('country_name');
        $res = $this->db->get('country');
        return $res->result_array();
    }

    function get_state($code) {

        $length = count($code);
        //echo $len;
        for ($i = 0; $i < $length; $i++) {
            $a = $code[$i];
            $country_cd.="country_code=" . "'$a'" . " OR ";
        }

        $country_cods = rtrim($country_cd, ' OR');
        $que = "select * from states where $country_cods order by state_name";
        $result = $this->db->query($que);
        //echo $this->db->last_query();
        return $result->result_array();
    }

    function get_city($country_code, $state_code) {
        $length = count($country_code);
        for ($i = 0; $i < $length; $i++) {
            $a = $country_code[$i];
            $country_cd.="match(country_code) against(" . "'$a'" . ") OR ";
        }
        $country_cods = rtrim($country_cd, ' OR');
        $lengths = count($state_code);

        for ($i = 0; $i < $lengths; $i++) {
            $sa = $state_code[$i];
            $state_cos.="match(state_code) against(" . "'$sa'" . ") OR ";
        }
        $state_cd = rtrim($state_cos, ' OR');
        $option2 = "$country_cods" . " And " . "$state_cd";

        $quer = "select * from weblocations where $option2 ";
        $result = $this->db->query($quer);
        echo $this->db->last_query();

        return $result->result_array();
    }

    function get_states($id) {
        $options = array('country_code' => $id);
        $this->db->order_by('state_name');
        $query = $this->db->getwhere('states', $options);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return null;
        $query->free_result();
        return $data;
    }

    function getStateName($country_code, $state_code) {
        $country_code = explode(',', $country_code);
        $states_code = explode(',', $state_code);
        $country_codes = rtrim(implode(',', $country_code), ',');
        $states_codes = rtrim(implode(',', $states_code), ',');
        $sql = "select state_code,state_name from states where country_code IN('$country_codes') AND state_code IN ('$states_codes')";
        $result = $this->db->query($sql);
        // echo $this->db->last_query();
        return $result->result_array();
    }

    function get_citys($state_code, $country_code) {
        $options = array('country_code' => $country_code, 'state_code' => $state_code);
        $this->db->order_by('city_name');
        $query = $this->db->getwhere('weblocations', $options);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else
            return null;
        $query->free_result();
        return $data;
    }

    function getUser_address($user_id) {
        $query = $this->db->getwhere('tbl_address', array('member_id' => $user_id));
        $result = $query->row();
        $country = $result->country;
        $state = $result->state;
        $coutry_code = $this->db->getwhere('country', array('country_name' => $country));
        $result = $coutry_code->row();
        $coutnry_code = $result->country_code;
        $state_code = $this->db->getwhere('states', array('country_code' => $coutnry_code, 'state_name' => $state));
        $result = $state_code->row();
        $state_code = $result->state_code;
        $result = $coutnry_code . "{}" . $state_code;
        return $result;
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */