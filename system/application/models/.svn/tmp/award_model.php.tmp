<?php

class Award_model extends Model {

    function Award_model() {
        parent::Model();
    }

    function insertQuizCreationAward() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $data = array('award_link_name' => 'quiz_auther_award',
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('quiz_auther_award');
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertQuizAutherRatingAward($user_id) {
        $data = array('award_link_name' => 'quiz_auther_rating_award',
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('quiz_auther_rating_award');
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertReferringAward($user_id) {
        $count_refer_award = $this->count_refer_award($user_id);
        if ($count_refer_award < 20) {
            $data = array('award_link_name' => 'referring_award',
                'user_id' => $user_id,
                'date' => current_date_time_stamp()
            );
            $this->db->insert('tbl_member_awards', $data);
            $award_info = $this->get_award_info('referring_award');
            $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
        }
    }

    function count_refer_award($user_id) {
        $sql = "select * from tbl_member_awards where award_link_name = 'referring_award'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return 0;
    }

    function insertHelpfulAward($user_id) {
        $data = array('award_link_name' => 'helpful_award',
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('helpful_award');
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function check_user_helpful_awards($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('award_link_name', 'helpful_award');
        $query = $this->db->get('tbl_member_awards');
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return null;
    }

    function check_user_volunteer_awards($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('award_link_name', 'volunteer_award');
        $query = $this->db->get('tbl_member_awards');
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return null;
    }

    function insertVolunteerAward($user_id) {
        $data = array('award_link_name' => 'volunteer_award',
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('volunteer_award');
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertWinneroftheDay($user_id, $category_name) {
        $category = explode(" ", $category_name);
        if ($category[1] != '') { //echo "hello";
            //for($i=0;$i<count($category);$i++){ echo $category[$i];
            $implode_category = implode("_", $category);
            //}
        }
        else
            $implode_category = $category[0];
        $data = array('award_link_name' => 'winner_of_the_day_' . $implode_category,
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('winner_of_the_day_' . $implode_category);
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertOverallWinner($user_id) {
        $data = array('award_link_name' => 'overall_winner',
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info('overall_winner');
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertPerfectScore($user_id, $level) {
        if ($level == '10A')
            $award_link_name = 'perfect_score_10A';
        if ($level == '15A')
            $award_link_name = 'perfect_score_15A';
        if ($level == '20A')
            $award_link_name = 'perfect_score_20A';
        if ($level == '25A')
            $award_link_name = 'perfect_score_25A';
        if ($level == '10H')
            $award_link_name = 'perfect_score_10H';
        if ($level == '15H')
            $award_link_name = 'perfect_score_15H';
        if ($level == '20H')
            $award_link_name = 'perfect_score_20H';
        if ($level == '25H')
            $award_link_name = 'perfect_score_25H';

        $data = array('award_link_name' => $award_link_name,
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        //echo $award_link_name;
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info($award_link_name);
        //print_r($award_info);
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function insertMilestoneAward($user_id, $milestone) {
        $data = array('award_link_name' => $milestone,
            'user_id' => $user_id,
            'date' => current_date_time_stamp()
        );
        $this->db->insert('tbl_member_awards', $data);
        $award_info = $this->get_award_info($milestone);
        $this->insert_user_bonous_points($award_info->bonus_points, $user_id);
    }

    function get_member_awards($user_id) {
        $sql = "select count(ma.award_link_name) as total,ma.*,a.* from tbl_member_awards ma join tbl_awards a on ma.award_link_name = a.award_link_name where ma.user_id =? group by ma.award_link_name";
        $query = $this->db->query($sql, array($user_id));
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function check_user_award($user_id, $award) {
        $this->db->where('user_id', $user_id);
        $this->db->where('award_link_name', $award);
        $query = $this->db->get('tbl_member_awards');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function get_user_category_award($user_id) {
        $sql = "select * from tbl_member_category_titles mct, tbl_categories c, tbl_category_titles ct where mct.category_id=c.id and mct.category_titles=ct.id and mct.user_id=?";
        $query = $this->db->query($sql, array($user_id));
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function get_user_category_award_image($name) {
        $sql = "
            select award_image 
            from tbl_awards 
            where award_link_name = '?'";

        $query = $this->db->query($sql, array($name));

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function insert_user_category_award($user_id) {
        $result = $this->get_user_category_award($user_id);
        $flag = 1;
        //print_r($result);//exit;
        if (count($result) > 0) {
            foreach ($result as $results) {
                $cat_name = explode(" ", $results->name);
                $total_cat = count($cat_name);
                $ckStr1 = str_replace(' ', '', $results->name);
                $awards = $this->get_member_awards($user_id);
                //print_r($ckStr1);echo '<br>';// exit;
                if (count($awards) > 0) {
                    foreach ($awards as $user_awards) {
                        $award_name = explode("_", $user_awards->award_link_name);
                        $ckStr2 = '';
                        $i = 0;
                        $ckme = $total_cat;
                        while ($ckme != 0) {
                            $ckStr2.=$award_name[$i];
                            $i++;
                            $ckme--;
                        }
                        //print_r($ckStr2." - ");
                        if (strtolower($ckStr1) === strtolower($ckStr2)) { //echo "i m here"; exit;
                            $this->db->where('award_link_name', $user_awards->award_link_name);
                            $this->db->where('user_id', $user_id);
                            $this->db->update('tbl_member_awards', array('award_link_name' => str_replace(" ", "_", $results->name) . '_' . $results->category_title));
                            $flag = 0;
                        }



                        //                else {
                        //                    $this->db->insert('tbl_member_awards',array('user_id'=>$user_id,'award_link_name'=>$award_name.'_'.$results->category_titles,'date'=>current_date_time_stamp()));
                        //                }
                    }
                }
                if ($flag == 1)
                    $this->db->insert('tbl_member_awards', array('user_id' => $user_id, 'award_link_name' => str_replace(" ", "_", $results->name) . '_' . $results->category_title, 'type' => '1', 'date' => current_date_time_stamp()));
            }
        }
    }

    function insert_user_bonous_points($bonus, $user_id) {
        //echo $bonus;
        $user_position = $this->Quiz_model->get_user_position($user_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('tbl_position', array('bonus_points' => ($user_position->bonus_points + $bonus), 'total_points' => $user_position->current_points + $user_position->bonus_points + $bonus));
        $this->db->where('user_id', $user_id);
        $query1 = $this->db->update('tbl_member_levels', array('current_points' => ($user_position->current_points + $user_position->bonus_points + $bonus)));
    }

    function get_award_info($type) {
        $this->db->where('award_link_name', $type);
        $query = $this->db->get('tbl_awards');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */