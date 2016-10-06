<?

class News_model extends Model {

    function News_model() {
        parent::Model();
        $this->load->library('parser');
    }

    function insert_news() {
        if ($this->input->post('submit',TRUE)) {
            $options = array('news_title' => $this->input->post('news_title', TRUE), 'news_description' => $this->input->post('news_description', TRUE), 'posted_date' => date('Y-m-d H:i:s'), 'status' => $this->input->post('status', TRUE), 'news_type' => $this->input->post('news_type', TRUE));
            $this->db->insert('tbl_news', $options);
            return true;
        }
        else
            return false;
    }

    function edit_news() {
        $data = array('news_title' => $this->input->post('news_title', TRUE), 'status' => $this->input->post('status', TRUE), 'news_description' => $this->input->post('news_description', TRUE), 'news_type' => $this->input->post('news_type', TRUE));
        $this->db->where('news_id', $this->input->post('news_id', TRUE));
        $this->db->update('tbl_news', $data);
    }

    function get_edit_news($id) {
        $options = array('news_id' => $id);
        $query = $this->db->getwhere('tbl_news', $options);
        return $query->row();
    }

    function get_all_press_news($limit, $news_status) {
        if ($news_status == 'all') {
            $sql = "Select * from tbl_news where news_type='press' order by posted_date DESC limit " . $limit;
            $news_info = $this->db->query($sql);
        } else {
            $sql = "Select * from tbl_news where status='?' and news_type='press' order by posted_date DESC limit " . $limit;
            $news_info = $this->db->query($sql, array($news_status));
        }

        return $news_info->result();
    }

    function get_all_ebid_news($limit, $news_status) {
        if ($news_status == 'all') {
            $sql = "Select * from tbl_news where news_type='ebid' order by posted_date DESC limit " . $limit;
            $news_info = $this->db->query($sql);
        } else {
            $sql = "Select * from tbl_news where status='?' and news_type='ebid' order by posted_date DESC limit " . $limit;
            $news_info = $this->db->query($sql,array($news_status));
        }

        return $news_info->result();
    }

    function get_all_news_info($limit) {
        $sql = "Select * from tbl_news order by posted_date DESC limit " . $limit;
        $news_info = $this->db->query($sql);
        return $news_info->result();
    }

    //to get email body and subject
    function get_news_by_id($news_id) {
        $options = array('news_id' => $news_id);
        $query = $this->db->getwhere('tbl_news', $options);

        return $query->row();
        ;
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */