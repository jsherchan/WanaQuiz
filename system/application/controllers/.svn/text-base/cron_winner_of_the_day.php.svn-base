<?php 
class Cron_winner_of_the_day extends Front_controller {

/**
 * Constructor
 *
 * @access	public
 */
    function Cron_winner_of_the_day() {
        parent::Front_controller();
        $this->load->model('Email_model');
        $this->load->model('Award_model');
       
    }

    function index(){
        $this->getWinnerOfDay();
    }

    function getWinnerOfDay(){ 
        $this->load->model('Site_setting_model');

        $today = date('Y-m-d');

        $thisMorning = $today . ' 00:00:00';
        $thisMorningTimestamp = strtotime($thisMorning);

        $thisEvening = $today . ' 11:59:59';
        $thisEveningTimestamp = strtotime($thisEvening);

        //echo $sql = "select max(a.total),a.category_id,a.parent_id,a.user_id from (select sum(s.points) as total,s.user_id,s.category_id,s.parent_id from (select c.id,c.name,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points from tbl_categories c,tbl_quizes q,tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.category_id = c.id ) s group by s.user_id,s.category_id)a group by a.category_id,a.parent_id,a.user_id";
         $sql = "select max(a.total) as total_points,a.category_id,a.parent_id,a.user_id from (select sum(s.points) as total,s.user_id,s.category_id,s.parent_id from (select c.id,c.name,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points from tbl_categories c,tbl_quizes q,tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.category_id = c.id and qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp' ) s where parent_id=0 group by s.user_id,s.category_id)a
                group by a.category_id
                union
                select * from (select max(a.total),a.category_id,a.parent_id,a.user_id from (select sum(s.points) as total,s.user_id,s.category_id,s.parent_id from (select c.id,c.name,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points from tbl_categories c,tbl_quizes q,tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.category_id = c.id and qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp') s where parent_id!=0 group by s.user_id,s.category_id)a
                group by a.category_id) e
                group by e.parent_id limit 0,1";
         
        $query = $this->db->query($sql);
      // echo $this->db->last_query();
        if($query->num_rows()>0)
        $data = $query->result();
        if(count($data)>0){ 
            foreach($data as $datas){
                if($datas->parent_id==0)
                    $category = $datas->category_id;
                if($datas->parent_id!=0)
                    $category = $datas->parent_id;
                $user = $datas->user_id;
                $points = $datas->total_points;
                $user_profile = $this->Member_model->get_member($user);
                $user_email = "kabindra@proshore.eu";//$user_profile->email;
                $username = $user_profile->username;
                $category_detail = $this->Category_model->get_parent_id($category);
                $category_name = $category_detail->name;

                /* email to each winner with username, category and points*/
                $site_info=$this->Site_setting_model->get_site_info(1);

                $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
                $headers .= "MIME-Version: 1.0\x0d\x0a";
                $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";

                $template = $this->Email_model->get_email_template("WINNER_OF_THE_DAY");

                $subject=$template->template_subject;
                $emailbody=$template->template_design;

                $parseElement=array("USERNAME"=>$username,"CATEGORY"=>$category_name,"POINTS"=>$points,"SITENAME"=>"The WannaQuiz Team");

                $subject=$this->Email_model->parse_email($parseElement,$subject);
                $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

                @mail($user_email,$subject,$emailbody,$headers);

                $this->Award_model->insertWinneroftheDay($user,$category_name);

                echo 'username: '.$username.'<br> email: '.$user_email.'<br> category: '.$category.'<br>points: '.$points.'<br><br>';
            }
        }
        
        
    }

}



 