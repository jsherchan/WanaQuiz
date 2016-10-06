<?php 
class Cron_overall_winner extends Front_controller {

/**
 * Constructor
 *
 * @access	public
 */
    function Cron_overall_winner() {
        parent::Front_controller();
        $this->load->model('Email_model');
        $this->load->model('Award_model');
       
    }

    function index(){
        $this->getOverallWinner();
    }

    function getOverallWinner(){
        $sql = 'select max(total_points) as total_points, 
            user_id from tbl_position group by total_points 
            order by total_points desc limit 0,1';
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        $data = $query->row();
        print_r($data); 
        $user_id = $data->user_id;
       // echo $user_id;
        $user_profile = $this->Member_model->get_member($user_id);
        $user_email = $user_profile->email;
        $username = $user_profile->username;
        $points = $data->total_points;

        $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";

            $template = $this->Email_model->get_email_template("OVERALL_WINNER");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $parseElement=array("USERNAME"=>$username,"POINTS"=>$points,"SITENAME"=>$site_info->site_name);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($user_email,$subject,$emailbody,$headers);

            $this->Award_model->insertOverallWinner($user_id);

        // echo 'username: '.$username.'<br> email: '.$user_email.'<br> category: '.$points.'<br><br>';
    
    }


}


