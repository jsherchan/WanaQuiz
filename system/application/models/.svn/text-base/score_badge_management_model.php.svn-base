<?php
class Score_badge_management_model extends Model {

    function Score_badge_management_model() {
        parent::Model();
    }

    function score_badge_list() {
        $query = $this->db->get('tbl_score_and_badge');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_score_badge_info($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_score_and_badge',$options);
        return $query->row();
    }

    function insert($image_name) {
        $data=array('level_name'=>$this->input->post('level_name',TRUE),
            'quiz_type'=>$this->input->post('quiz_type',TRUE),
            'threshold_score'=>$this->input->post('threshold_score',TRUE),
            'badge_image'=>$image_name);
        $this->db->insert('tbl_score_and_badge',$data);
    }

    function update($image_name) {
        $data=array('level_name'=>$this->input->post('level_name',TRUE),
            'quiz_type'=>$this->input->post('quiz_type',TRUE),
            'threshold_score'=>$this->input->post('threshold_score',TRUE),
            'badge_image'=>$image_name);
        $this->db->where('id',$this->input->post('id',TRUE));
        $this->db->update('tbl_score_and_badge',$data);
    }

    // AWARDS MANAGEMENT

    function award_list($num,$limit) {
        $this->db->limit($num,$limit);
        $query = $this->db->get('tbl_awards');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }
    function count_award_list()
    {
         $query = $this->db->get('tbl_awards');
       return $query->num_rows();
    }

    function get_award_info($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_awards',$options);
        return $query->row();
    }

    function insert_award($image_name) {
        $data=array('award_name'=>$this->input->post('award_name',TRUE),
            'award_link_name'=>$this->input->post('award_link_name',TRUE),
            'bonus_points'=>$this->input->post('bonus_points',TRUE),
            'award_image'=>$image_name);
        $this->db->insert('tbl_awards',$data);
    }

    function update_award($image_name) {
        $data=array('award_link_name'=>$this->input->post('award_link_name',TRUE),
            'award_name'=>$this->input->post('award_name',TRUE),
            'bonus_points'=>$this->input->post('bonus_points',TRUE),
            'award_image'=>$image_name);
        $this->db->where('id',$this->input->post('id',TRUE));
        $this->db->update('tbl_awards',$data);
    }



    // Quiz Bonus Point Management
    function quiz_bonus_point_list() {
        $query = $this->db->get('tbl_quiz_answered_bonus_points',TRUE);
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_quiz_bonus_point_info($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_quiz_answered_bonus_points',$options);
        return $query->row();
    }

    function insert_quiz_bonus_point() {
        $data=array('question_answered_in_row'=>$this->input->post('question_answered_in_row',TRUE),
            'quiz_type'=>$this->input->post('quiz_type',TRUE),
            'bonus_points'=>$this->input->post('bonus_points',TRUE));
        $this->db->insert('tbl_quiz_answered_bonus_points',$data);
    }

    function update_quiz_bonus_point() {
        $data=array('question_answered_in_row'=>$this->input->post('question_answered_in_row',TRUE),
            'bonus_points'=>$this->input->post('bonus_points',TRUE),
            'quiz_type'=>$this->input->post('quiz_type',TRUE));
        $this->db->where('id',$this->input->post('id',TRUE));
        $this->db->update('tbl_quiz_answered_bonus_points',$data);
    }

    function get_levels() {
        $query = $this->db->get('tbl_level',TRUE);
        if($query->num_rows()>0)
            return $query->result();
        else return false;
    }

    function insert_levels() {
        $data=array(
            'level'=>$this->input->post('level_number',TRUE),
            'level_name'=>$this->input->post('level_name',TRUE),
            'points'=>$this->input->post('points',TRUE),
            );
        $query = $this->db->insert('tbl_level',$data);
        if($query) return true;
        else return false;
    }

    function get_level_info($id){
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_level');
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function update_level(){
        $id = $this->input->post('id',TRUE);
        $this->db->where(id,$id);
        $data = array('level'=>$this->input->post('level_number',TRUE),
            'level_name'=>$this->input->post('level_name',TRUE),
            'points'=>$this->input->post('points',TRUE)
        );
        $query = $this->db->update('tbl_level',$data);
        if($query) return true;
        else return false;
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */