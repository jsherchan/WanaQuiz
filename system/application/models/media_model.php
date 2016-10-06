<?
class Media_model extends Model {

    function Media_model() {
        parent::Model();
    }


    function getFeaturedVideos($num=null,$offset=null) {
        $limit=" LIMIT $offset,$num";
        if($num!=null || $offset!=null)
            $sql="select * from ((Select q.*,qv.quiz_videos,m.username,c.name,0 From tbl_quiz_videos qv, tbl_quizes q,tbl_members m,tbl_categories c where m.user_id=q.user_id and q.category_id=c.id and q.user_type='regular' and q.quiz_id=qv.quiz_id and q.quiz_type='video' and q.featured_quiz='1' )
                UNION ALL (Select q.*,qv.quiz_videos,m.username,c.name,qb.budget_status From tbl_quiz_videos qv, tbl_quizes q,tbl_members m,tbl_categories c,tbl_advertiser_quiz_budget qb where m.user_id=q.user_id and q.category_id=c.id and q.quiz_id=qv.quiz_id and q.user_type='advertiser' and q.quiz_id=qb.quiz_id and qb.budget_status='1' and q.quiz_type='video' and q.featured_quiz='1' limit 3)) a where a.quiz_id not in(select quiz_id from tbl_quiz_answers where user_id = '$user_id') order by a.modified_date DESC $limit";
        else
            $sql="select * from ((Select q.*,qv.quiz_videos,m.username,c.name,0 From tbl_quiz_videos qv, tbl_quizes q,tbl_members m,tbl_categories c where m.user_id=q.user_id and q.category_id=c.id and q.user_type='regular' and q.quiz_id=qv.quiz_id and q.quiz_type='video' and q.featured_quiz='1' )
                UNION ALL (Select q.*,qv.quiz_videos,m.username,c.name,qb.budget_status From tbl_quiz_videos qv, tbl_quizes q,tbl_members m,tbl_categories c,tbl_advertiser_quiz_budget qb where m.user_id=q.user_id and q.category_id=c.id and q.quiz_id=qv.quiz_id and q.user_type='advertiser' and q.quiz_id=qb.quiz_id and qb.budget_status='1' and q.quiz_type='video' and q.featured_quiz='1' limit 3)) a where a.quiz_id not in(select quiz_id from tbl_quiz_answers where user_id = '$user_id') order by a.modified_date DESC";
        $query=$this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function getFeaturedQuestions($num=null,$offset=null) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $limit=" LIMIT $offset,$num";
        if($num!=null || $offset!=null)
            $sql="select * from 
                    (
                        (Select q.*,qm.images,m.username,c.name,c.id,0
                        FROM tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_categories c
                        where m.user_id=q.user_id
                        AND q.quiz_id=qm.quiz_id
                        and q.status='1'
                        and q.category_id=c.id
                        and q.user_type='regular'
                        and q.quiz_type='photo'
                        and q.featured_quiz='1' )
                        UNION ALL
                        (Select q.*,qm.images,m.username,c.name,c.id,qb.budget_status
                        FROM tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_categories c,tbl_advertiser_quiz_budget qb
                        where m.user_id=q.user_id
                        AND q.quiz_id=qm.quiz_id
                        and q.status='1'
                        and q.category_id=c.id
                        and q.user_type='advertiser'
                        and q.quiz_id=qb.quiz_id
                        and qb.budget_status='1'
                        and q.quiz_type='photo'
                        and q.featured_quiz='1' )
                        ) a
                        where a.quiz_id not in(select quiz_id from tbl_quiz_answers where user_id = '$user_id')
                        order by a.modified_date DESC $limit";
        else
            $sql="select * from ((Select q.*,qm.images,m.username,c.name,c.id,0 FROM tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_categories c where m.user_id=q.user_id AND q.quiz_id=qm.quiz_id and q.status='1' and q.category_id=c.id and q.user_type='regular' and q.quiz_type='photo' and q.featured_quiz='1' )
                UNION ALL (Select q.*,qm.images,m.username,c.name,c.id,qb.budget_status FROM tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_categories c,tbl_advertiser_quiz_budget qb where m.user_id=q.user_id AND q.quiz_id=qm.quiz_id and q.status='1' and q.category_id=c.id and q.user_type='advertiser' and q.quiz_id=qb.quiz_id and qb.budget_status='1' and q.quiz_type='photo' and q.featured_quiz='1' )) a where a.quiz_id not in(select quiz_id from tbl_quiz_answers where user_id = '$user_id') order by a.modified_date DESC";
        $query=$this->db->query($sql);
        //echo $this->db->last_query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;

    }

    function getMemberVideoImages($user_id,$num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";
        else $limit='';

        $sql="Select * From tbl_members_videos mv,tbl_members m where m.user_id=mv.user_id AND mv.user_id=? order by video_id DESC $limit";
        $query=$this->db->query($sql,array($user_id));
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function getMemberPhotos($user_id,$num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";
        else $limit='';
        $sql="
            Select * 
            From tbl_members_photos mp,tbl_members m 
            where m.user_id=mp.user_id 
            AND mp.user_id=? 
            AND mp.deleted!='1' 
            order by photo_id DESC $limit";
        #exit($sql);
        $query=$this->db->query($sql,array($user_id));
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function getMemberPhotosByID($photo_id) {
        $sql="Select * From tbl_members_photos where photo_id=?";
        $query=$this->db->query($sql,array($photo_id));
        return $query->row();
    }
   function checkPhotoInQuiz($photo_image)
   {
    $sql="select images, images2 from tbl_quiz_images where images=? or images2=?";
    $query=$this->db->query($sql,array($photo_image,$photo_image));
    if($query->num_rows()>0)
            return true;
        else
            return NULL;
   }
    function getMemberVideosByID($video_id) {
        $sql="Select * From tbl_members_videos where video_id=?";
        $query=$this->db->query($sql,array($video_id));
        return $query->row();
    }
    function checkVideoInQuiz($video_name){
         $sql="select * from tbl_quiz_videos where quiz_videos=? or video_answer=?";
     $query=$this->db->query($sql,array($video_name,$video_name));
        if($query->num_rows()>0)
            return true;
        else
            return NULL;
    }

    function calculate_total_rating($media_id) {
        $sql="Select sum(rating) as sum,count(*) as total FROM tbl_media_ratings where media_id=?";
        $query=$this->db->query($sql,array($media_id));
        $data=$query->row();
        $total=$data->total;
        $sum=$data->sum;
        if($total==0)
            $avg_rating=0;
        else
            $avg_rating=number_format($sum/$total,1);

        return $avg_rating;
    }


}
?>