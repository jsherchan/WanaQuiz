<?php

class Reports_model extends Model {

    function Reports_model() {
        parent::Model();
    }

    function get_auction_winner($num, $offset) {
        $sql = "SELECT * FROM tbl_winner w LEFT OUTER JOIN (SELECT * FROM tbl_memberinfo) m ON w.user_id=m.user_id, tbl_products p WHERE w.product_id=p.auc_id AND p.auction_status='closed' LIMIT $offset,$num";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_passive_user($num, $offset) {
        $sql = "SELECT tbl_memberinfo.* FROM tbl_memberinfo LEFT JOIN tbl_biddone ON tbl_memberinfo.user_id = tbl_biddone.user_id WHERE tbl_biddone.user_id IS NULL LIMIT $offset,$num";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_top_ten_user() {
        $sql = "SELECT b.user_id, COUNT(b.user_id) AS bidcount,m.user_id,m.first_name,m.address,m.email FROM tbl_biddone b LEFT OUTER JOIN (SELECT * FROM tbl_memberinfo)m ON b.user_id=m.user_id GROUP BY b.user_id LIMIT 10";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_ongoing_auction($num, $offset) {
        $sql = "SELECT * FROM tbl_products WHERE auction_status='open' LIMIT $offset,$num";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_top_five_auction() {
        $sql = "SELECT p.auc_id,p.auc_name,p.retail_value,total_bids FROM tbl_products p 
		LEFT OUTER JOIN (
		SELECT product_id p_id, count(id ) as total_bids
		FROM tbl_biddone
		GROUP BY product_id
		)b ON p.auc_id = b.p_id ORDER BY total_bids DESC LIMIT 5";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result();

        return NULL;
    }

    function get_completed_transaction() {
        $start_date = $this->input->post('start_date', TRUE);
        $end_date = $this->input->post('end_date', TRUE);

        $sql = "SELECT * FROM transaction_info t LEFT OUTER JOIN (SELECT * FROM tbl_memberinfo) m ON t.memberid=m.user_id LEFT OUTER JOIN tbl_products p ON t.auction_id=p.auc_id WHERE t.payment_status='completed' AND t.pay_time>='$start_date' AND t.pay_time<='$end_date'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_bid_info($start_date, $end_date, $type) {
        if ($type == 'specific') {
            $sql = "SELECT * FROM tbl_biddone b, tbl_memberinfo m,tbl_products p where b.user_id=m.user_id AND b.product_id=p.auc_id AND b.bid_date>='?' AND b.bid_date<='?'";
            $query = $this->db->query($sql, array($start_date, $end_date));
        } else {
            $sql = "SELECT * FROM tbl_biddone b, tbl_memberinfo m,tbl_products p where b.user_id=m.user_id AND b.product_id=p.auc_id AND b.bid_date>='?'";
            $query = $this->db->query($sql, array($start_date));
        }
        return $query->result();
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */