<?php

class General_model extends Model {

    function General_model() {
        parent::Model();
    }

    function bid_posted($id) {
        $sql = "SELECT COUNT(*) as bid_no FROM tbl_biddone WHERE product_id=?";

        $query = $this->db->query($sql, array($id));

        $bid_no = $query->row();
        return $bid_no->bid_no;
    }

    function bid_frequency($id) {
        $sql = "SELECT COUNT(bid_amount) as frequency, bid_amount FROM tbl_biddone WHERE product_id='?' group by bid_amount";
        $query = $this->db->query($sql, array($id));

        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    function amount_collected($id) {
        $sql = "SELECT SUM(bid_amount) as total_amount FROM tbl_biddone WHERE product_id=?";

        $query = $this->db->query($sql, array($id));

        $bid_no = $query->row();
        return $bid_no->total_amount;
    }

    function max_bid($id) {
        $sql = "SELECT COUNT(bid_amount) as max_bid FROM tbl_biddone WHERE product_id=? group by bid_amount";

        $query = $this->db->query($sql, array($id));

        $bid_no = $query->row();
        return $bid_no->max_bid;
    }

    function get_bidders_detail($auc_id) {
        $sql = "SELECT * FROM tbl_memberinfo M, tbl_biddone B WHERE B.product_id=? AND M.user_id=B.user_id";
        $query = $this->db->query($sql, array($auc_id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data[] = $rows;
            }

            $query->free_result();
            return $data;
        }
    }

    function get_username($id) {
        $sql = "SELECT username FROM tbl_memberinfo WHERE user_id=?";
        $query = $this->db->query($sql, array($id));
        if ($query->row()) {
            $data = $query->row();
            return $data->username;
        }
        else
            return 0;
    }

    function get_news_detail($id, $lang_id=1) {
        if ($lang_id == 1)
            $sql = "SELECT news_subject as subject, news_text as news_body FROM tbl_news WHERE news_id=?";
        if ($lang_id == 2)
            $sql = "SELECT news_subject_lang2 as subject, news_text_lang2 as news_body FROM tbl_news WHERE news_id=?";
        $query = $this->db->query($sql, array($id));
        $data = $query->row();
        return $data;
    }

    function get_city($id) {
        $sql = "SELECT city FROM tbl_memberinfo WHERE user_id=?";
        $query = $this->db->query($sql, array($id));

        $data = $query->row();
        return $data->city;
    }

    function get_product_name($id) {
        $lang_id = $this->session->userdata('front_language_id');
        $sql = "select auction_name from tbl_products p, tbl_product_details pd where p.auc_id='?' and pd.language_id = '?' and p.auc_id = pd.auction_id";
        $query = $this->db->query($sql, array($id, $lang_id));

        $bid = $query->row();
        return $bid->auction_name;
    }

    function get_product_detail($id) {
        $sql = "select * from tbl_products where auc_id=?";
        $query = $this->db->query($sql, array($id));

        return $query->row();
    }

    function get_product_status($id) {
        $sql = "select auction_status from tbl_products where auc_id=?";
        $query = $this->db->query($sql, array($id));

        $product = $query->row();
        return $product->auction_status;
    }

    function day_difference($st_date, $end_date) {

        $s = strtotime($end_date) - strtotime($st_date);

        $m = intval($s / 60);
        $s = $s % 60;

        $h = intval($m / 60);
        $m = $m % 60;

        $d = intval($h / 24);
        $h = $h % 24;

        $diff = "";
        return $d;
    }

    function getBidDetailsOnAuctionByDay($id, $st_date, $end_date) {
        $start_time = explode(" ", $start_time);
        $start_date_parts = explode("-", $start_time[0]);
        $start = $start_time[0] . " 00:00:00";

        $start_year = $start_date_parts[0];
        $start_month = $start_date_parts[1];
        $start_day = $start_date_parts[2];


        $end_time = explode(" ", $end_time);
        $end_date_parts = explode("-", $end_time[0]);
        $end = $end_time[0] . " 11:59:59";

        $end_year = $end_date_parts[0];
        $end_month = $end_date_parts[1];
        $end_day = $end_date_parts[2];

        $diffrence = $this->day_difference($start, $end);


        for ($i = 0; $i <= $diffrence; $i++) {


            $date_value = date("Y-m-d", mktime(0, 0, 0, date("$start_month"), date("$start_day") + $i, date("$start_year")));

            $start_time = $date_value . " 00:00:00";
            $end_time = $date_value . " 23:59:59";

            $query = "SELECT COUNT(id),SUM(bid_amount) FROM tbl_biddone WHERE 
				bid_date>='$start_time' and bid_date<='$end_time' and product_id='$auc_id'";
            $result_day = $query->row();
            $values[$date_value] = $result_day;
        }

        /* echo"<pre>";
          var_dump($values);
          echo"</pre>";
         */
        return $values;
    }

    function calcDateDiff($date1 = 0, $date2 = 0) {

        // $date1 needs to be greater than $date2.
        // Otherwise you'll get negative results.
        if ($date2 > $date1)
            return FALSE;

        $seconds = $date1 - $date2;

        // Calculate each piece using simple subtraction

        $weeks = floor($seconds / 604800);
        $seconds -= $weeks * 604800;

        $days = floor($seconds / 86400);
        $seconds -= $days * 86400;

        $hours = floor($seconds / 3600);
        $seconds -= $hours * 3600;

        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;

        // Return an associative array of results
        return array("weeks" => $weeks, "days" => $days, "hours" => $hours, "minutes" => $minutes, "seconds" => $seconds);
    }

    function get_local_time() {
        $hour_delay = $this->config->item('gm_hour');
        $minute_delay = $this->config->item('gm_minute');
        return date("F d, Y H:i:s", mktime(gmdate("H") + $hour_delay, gmdate("i") + $minute_delay, gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
    }

    function checkDayGreaterThanToday($today, $givendate) { // $today and $given date must be in int
        if ($givendate > $today)
            return 1;  // yes
        else
            return 0; // no
    }

    function getSiteInfo($site_id) {

        $options = array('site_id' => $site_id);
        $query = $this->db->getwhere('tblsite_setting', $options);
        return $query->row();
    }

}

?>