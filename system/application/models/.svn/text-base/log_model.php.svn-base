<?php

class Log extends Model {

    function Log_model() {
        parent::Model();
        $this->load->library('parser');
    }

    function get_user_logs($uid, $type='', $limit="") {

        if ($type == "") {

            $sql = "select * from tbl_logs where user_id = ?";
        } else {

            $sql = "select * from tbl_logs where user_id = ? and type = '$type'";
        }
        if ($limit != "") {

            $sql = "select * from tbl_logs where user_id = ? and type = '$type' and limit $limit order by created DESC";
        }

        $query = $this->db->query($sql, array($uid));
        echo $this->db->last_query($sql);
        $query->result();
        return $data;
    }

}

?>