<?php

class Ip_block_model extends Model {

    function Ip_block_model() {
        parent::Model();
    }

    function get_blocked_ips($ip_id, $num, $offset) {
        $data = array();

        $options = array('blockip_id' => $ip_id);

        if ($ip_id != "")
            $query = $this->db->getwhere('tbl_block_ips', $options);
        else
            $query = $this->db->get('tbl_block_ips', $num, $offset);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }

            $query->free_result();
            return $data;
        }
    }

    function insert_ip() {
        $now = date('Y-m-d H:i:s');
        $data = array('blockip_address' => $this->input->post('ip_address',TRUE),
            'blockip_desc' => $this->input->post('ip_desc',TRUE),
            'blockip_date' => $now);
        $this->db->insert('tbl_block_ips', $data);
    }

    function edit_ip() {
        $now = date('Y-m-d H:i:s');
        $data = array('blockip_address' => $this->input->post('ip_address',TRUE),
            'blockip_desc' => $this->input->post('ip_desc',TRUE),
            'blockip_date' => $now);
        $this->db->where("blockip_id", $this->input->post('ip_id',TRUE));
        $this->db->update('tbl_block_ips', $data);
    }

    function delIP($id) {
        if ($id) {
            $this->db->where("blockip_id", $id);
            $this->db->delete("tbl_block_ips");
        }
    }

    function check_blocked_ip($ip) {
        $this->db->where('blockip_address', $ip);
        $query = $this->db->get('tbl_block_ips');
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function unblockIp() {
        $ip = $this->input->post('ip_address',TRUE);
        if ($this->check_blocked_ip($ip)) {
            $this->db->where('blockip_address', $ip);
            if ($this->db->delete('tbl_block_ips'))
                return "unblocked";
            else
                return "error";
        }
        else
            return "error";
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */