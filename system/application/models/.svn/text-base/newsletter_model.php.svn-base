<?

class Newsletter_model extends Model {

    function Newsletter_model() {
        parent::Model();
        $this->load->library('parser');
        $this->load->model('Email_model');
    }

    function insert_newsletter() {
        if ($this->input->post('submit',TRUE)) {
            $options = array('news_subject' => $this->input->post('news_subject', TRUE), 'news_text' => $this->input->post('news_text', TRUE));
            $this->db->insert('tbl_newsletters', $options);
            $news_letter_id = $this->db->insert_id();

            if ($this->input->post('action',TRUE) == "save_n_send") {
                $group = $this->input->post('newsletter_group', TRUE);
                $this->send_newsletter($news_letter_id, $group);
            }
            return true;
        }
        else
            return false;
    }

    function get_edit_newsletter_info($id) {
        $options = array('newsletter_id' => $id);
        $this->db->order_by("newsletter_id", "desc");
        $query = $this->db->getwhere('tbl_newsletters', $options);
        return $query->row();
    }

    function get_all_newsletter_info($status) {
        $options = array('status' => $status);
        $this->db->order_by("newsletter_id", "desc");
        $newsletter_info = $this->db->getwhere('tbl_newsletters', $options);
        return $newsletter_info->result();
    }

    function getNewsletterSubscribers() {
        $sql = "select * from tbl_members m, tbl_member_profile mp where m.newsletter_subscribe='1' and m.user_id = mp.member_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function getInvitedMembers() {
        $sql = "select * from tbl_members m, tbl_member_profile mp where m.referer_id!='0' and m.user_id = mp.member_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNotLoggedInMembers() {
        $now = current_date_time_stamp();

        $days_before = $now - (30 * 24 * 60 * 60);
        $sql = "SELECT * FROM tbl_members m, tbl_member_profile mp where m.user_id
		NOT IN(
		Select DISTINCT(act_user_id) FROM tbl_log_activity where act_time>='$days_before') and m.user_id=mp.member_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNotWonMembers() {
        $sql = "SELECT * FROM tbl_members m, tbl_member_profile mp where m.user_id NOT IN(SELECT user_id From tbl_member_awards) and m.user_id= mp.member_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllMembers() {
        $sql = "SELECT * FROM tbl_members m, tbl_member_profile mp where mp.email<>''";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function send_newsletter($newsletter_id, $group_name) {

        //get members From Selected Group--------------	
        if ($group_name == "subscribers")
            $members = $this->getNewsletterSubscribers();
        if ($group_name == "invited")
            $members = $this->getInvitedMembers();
        if ($group_name == "not_logged_in_4_30_days")
            $members = $this->getNotLoggedInMembers();
        if ($group_name == "losers")
            $members = $this->getNotWonMembers();
        if ($group_name == "all")
            $members = $this->getAllMembers();

        $status = 'not_sent';
        foreach ($members as $value) {
            $headers = "From: noreply@wannaquiz.com \x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $headers .= 'Reply-To: bounce@proshore.eu' . "\r\n";
            $headers .= 'Campaign:' . $newsletter_id . '-' . $value->user_id . '-bouncedemail' . "\r\n";
            $template = $this->get_newsletter_template($newsletter_id);

            $subject = $template->news_subject;
            $emailbody = $template->news_text;

            $email = $value->email;
            $parseElement = array("Newsletter_body" => $emailbody, "email" => 'info@wannaquiz.com', "memberemail" => $email);

            $subject = $this->Email_model->parse_email($parseElement, $subject);
            $emailbody = $this->Email_model->parse_email($parseElement, $emailbody);
            $emailbody.="<p><a href='" . site_url('home/unsubscribe/' . $email) . "'>Click here to unsubscribe to newsletter</a>";
            $emailbody.="<img src='" . site_url(ADMIN_PATH . '/newsletter/emailOpened/' . $newsletter_id . '/' . $value->user_id) . "' width='1' height='1'>";
            if (mail($email, $subject, $emailbody, $headers, "-f bounce@proshore.eu"))
                $status = 'sent';

            $this->insertNewsletterRecipient($newsletter_id, $value->user_id, $status);
        }
        $count = count($members);
        if ($status == 'sent')
            $this->updateNewsletterStatus($newsletter_id);
        echo "<script>alert('Mail send Successfully to $count members')</script>";
        echo "<script>location.href='" . site_url(ADMIN_PATH . '/newsletter/viewnewsletter/Sent') . "'</script>";
    }

    function updateNewsletterStatus($newsletter_id) {
        $options = array('status' => 'Sent');
        $this->db->where('newsletter_id', $newsletter_id);
        $this->db->update('tbl_newsletters', $options);
    }

    function insertNewsletterRecipient($newsletter_id, $mem_id, $status) {
        $options = array('newsletter_id' => $newsletter_id, 'member_id' => $mem_id, 'status' => $status);
        $this->db->insert('tbl_newsletter_recipient', $options);
    }

    function updateNewsletterRecipient($newsletter_id, $mem_id, $status) {
        $options = array('status' => $status);
        $this->db->where('newsletter_id', $newsletter_id);
        $this->db->where('member_id', $mem_id);
        $this->db->update('tbl_newsletter_recipient', $options);
    }

    //to get email body and subject
    function get_newsletter_template($newsletter_id) {
        $options = array('newsletter_id' => $newsletter_id);
        $query = $this->db->getwhere('tbl_newsletters', $options);

        return $query->row();
        ;
    }

    function get_newsletter_groups($group_type) {
        if ($group_type == "subscribers")
            $results = $this->getNewsletterSubscribers();
        if ($group_type == "invited")
            $results = $this->getInvitedMembers();
        if ($group_type == "not_won")
            $results = $this->getNotWonMembers();
        if ($group_type == "not_logged_in")
            $results = $this->getNotLoggedInMembers();
        if ($group_type == "all")
            $results = $this->getAllMembers();

        return $results;
    }

    function get_newsletter_delivery_count($newsletter_id, $status) {

        if ($status == 'sent') {
            $sql = "SELECT * FROM tbl_newsletter_recipient where newsletter_id='?'";
            $query = $this->db->query($sql, array($newsletter_id));
        } else {
            $sql = "SELECT * FROM tbl_newsletter_recipient where newsletter_id='?' AND status='?'";
            $query = $this->db->query($sql, array($newsletter_id, $status));
        }

        return $query->num_rows();
    }

    function get_newsletter_delivery_members($newsletter_id, $status) {

        if ($status == 'sent') {
            $sql = "SELECT * FROM tbl_newsletter_recipient NR,tbl_memberinfo M where NR.member_id=M.user_id AND NR.newsletter_id='?'";
            $query = $this->db->query($sql, array($newsletter_id));
        } else {
            $sql = "SELECT * FROM tbl_newsletter_recipient NR,tbl_memberinfo M where NR.member_id=M.user_id AND  NR.newsletter_id='?' AND NR.status='?'";
            $query = $this->db->query($sql, array($newsletter_id, $status));
        }

        return $query->result();
    }

}

?>
