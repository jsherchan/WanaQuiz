<?

class Comment_spam extends Front_controller {

    function Comment_spam() {
        parent::Front_controller();
        $this->load->library('parser');
        $this->load->model('Comment_spam_model');
        $this->load->model('Email_model');

    }

    function index() {
        $data['title'] = 'Wannaquiz:Comment Spam';
        $data['quiz_comment_spam'] = $this->Comment_spam_model->get_quiz_comment_spams();
        $data['main']='admin/comment_spam';
        $data['spam_type'] = 'quiz';
        $this->parser->parse('admin/admin',$data);
    }

    function getProfileCommentSpams() {
        $data['title'] = 'Wannaquiz:Comment Spam';
        $data['profile_comment_spam'] = $this->Comment_spam_model->get_profile_comment_spams();
        $data['main']='admin/comment_spam';
        $data['spam_type'] = 'profile';
        $this->parser->parse('admin/admin',$data);
    }

    function delete($spam_type,$comment_id) {
        if ($comment_id) {
            $this->db->where("comment_id", $comment_id);
            if($spam_type=='quiz')
                $this->db->delete("tbl_quiz_comments");
            else
                $this->db->delete("tbl_member_comments");
        }
        $this->session->set_flashdata('message','Selected Comment Deleted Successfully.');
         if($spam_type=='quiz')
            redirect(ADMIN_PATH.'/comment_spam');
        else
            redirect(ADMIN_PATH.'/comment_spam/getProfileCommentSpams');

    }
}
?>