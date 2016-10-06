<?php

class Award_management_model extends Model {

    function Award_management_model() {
        parent::Model();
    }

    function get_award_list() {
        $query = $this->db->get('tbl_awards');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_score_badge_info($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_score_and_badge', $options);
        return $query->row();
    }

    function insert($image_name) {
        $data = array('level_name' => $this->input->post('level_name',TRUE),
            'quiz_type' => $this->input->post('quiz_type',TRUE),
            'threshold_score' => $this->input->post('threshold_score',TRUE),
            'badge_image' => $image_name);
        $this->db->insert('tbl_score_and_badge', $data);
    }

    function update($image_name) {
        $data = array('level_name' => $this->input->post('level_name',TRUE),
            'quiz_type' => $this->input->post('quiz_type',TRUE),
            'threshold_score' => $this->input->post('threshold_score',TRUE),
            'badge_image' => $image_name);
        $this->db->where('id', $this->input->post('id',TRUE));
        $this->db->update('tbl_score_and_badge', $data);
    }

    // AWARDS MANAGEMENT

    function award_list() {
        $query = $this->db->get('tbl_awards');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_award_info($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_awards', $options);
        return $query->row();
    }

    function insert_award($image_name) {
        $data = array('award_name' => $this->input->post('award_name',TRUE),
            'bonus_points' => $this->input->post('bonus_points',TRUE),
            'trophy_image' => $image_name);
        $this->db->insert('tbl_awards', $data);
    }

    function update_award($image_name) {
        $data = array('award_name' => $this->input->post('award_name',TRUE),
            'bonus_points' => $this->input->post('bonus_points',TRUE),
            'trophy_image' => $image_name);
        $this->db->where('id', $this->input->post('id',TRUE));
        $this->db->update('tbl_awards', $data);
    }

    // Quiz Bonus Point Management
    function quiz_bonus_point_list() {
        $query = $this->db->get('tbl_quiz_answered_bonus_points');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_quiz_bonus_point_info($id) {
        $options = array('id' => $id);
        $query = $this->db->getwhere('tbl_quiz_answered_bonus_points', $options);
        return $query->row();
    }

    function insert_quiz_bonus_point() {
        $data = array('question_answered_in_row' => $this->input->post('question_answered_in_row',TRUE),
            'quiz_type' => $this->input->post('quiz_type',TRUE),
            'bonus_points' => $this->input->post('bonus_points',TRUE));
        $this->db->insert('tbl_quiz_answered_bonus_points', $data);
    }

    function update_quiz_bonus_point() {
        $data = array('question_answered_in_row' => $this->input->post('question_answered_in_row',TRUE),
            'bonus_points' => $this->input->post('bonus_points',TRUE),
            'quiz_type' => $this->input->post('quiz_type',TRUE));
        $this->db->where('id', $this->input->post('id',TRUE));
        $this->db->update('tbl_quiz_answered_bonus_points', $data);
    }

}

/* End of file award_management_model.php */
/* Location: ./system/application/models/award_management_model.php */