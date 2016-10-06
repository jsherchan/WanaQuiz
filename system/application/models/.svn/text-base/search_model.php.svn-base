<?php

class Search_model extends Model {

    function Search_model() {
        parent::Model();
    }

    function getSearchResults($search_member) {

        $sql = "SELECT * FROM tbl_members m,tbl_member_profile mp where m.user_id=mp.member_id AND (m.user_id LIKE '%?%' OR mp.email LIKE '%$search_member%' OR m.username LIKE '%$search_member%') group by user_id ORDER BY m.username ";

        $query = $this->db->query($sql, array($search_member));

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function getCategorySearchResults($search_category) {
        $this->db->where('name', $search_category);
        $this->db->orderby('name');
        $query = $this->db->get('tbl_categories');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function getQuizSearchResults($search_quiz, $type, $num=null, $offset=null) {
        //echo $type;exit;
        //echo $search_quiz;exit;

        if ($num != null || $offset != null)
            $limit = " LIMIT $offset,$num";
        else
            $limit='';
        //echo $search_quiz;exit;
        if ($type == 'quiz_image')
        {
            $sql = "select q.*,qi.images,mp.photo_name,m.username from tbl_quizes q, tbl_quiz_images qi, tbl_members_photos mp,tbl_members m where q.quiz_id=qi.quiz_id and q.image_id=mp.photo_id and q.user_id = m.user_id and (q.quiz_id like '%?%' or q.quiz_question like '%?%' or m.username like '%?%') group by q.quiz_id order by posted_date desc $limit";
            $query = $this->db->query($sql,array($search_quiz,$search_quiz,$search_quiz));
        }
        else
        {
            $sql = "Select q.*,qv.*,m.username FROM tbl_quizes q, tbl_quiz_videos qv, tbl_members m where q.quiz_id=qv.quiz_id and q.user_id=m.user_id and q.status='1' and (q.quiz_id like '%?%' or q.quiz_question like '%?%' or m.username like '%?%') group by q.quiz_id order by posted_date desc $limit";
            $query = $this->db->query($sql,array($search_quiz,$search_quiz,$search_quiz));
        }
        
        //echo $this->db->last_query($sql);
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

}

?>