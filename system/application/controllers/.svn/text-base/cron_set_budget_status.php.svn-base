<?php 
class Cron_set_budget_status extends Front_controller {

/**
 * Constructor
 *
 * @access	public
 */
    function Cron_set_budget_status() {
        parent::Front_controller();
        $this->load->model('Email_model');
        $this->load->model('Site_setting_model');
       
    }

    function index(){
        $this->setQuizBudgetStatus();
    }
  function setQuizBudgetStatus(){
        $sql = "select * from tbl_quiz_budgets where per_selection ='day'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $data = $query->result();
               //echo $today = date('H:i:s');exit;
//		echo '<pre>'; print_r($data); echo '</pre>';
        foreach($data as $datas){
              $total_budget=0;
              $total_budget=$datas->total_budget+$datas->remaining_budget;
             // echo $total_budget;
            if($total_budget>=$datas->budget_per_selection){
                $total_budget=$total_budget-$datas->budget_per_selection;
                $update_status = array('total_budget'=>$total_budget,
                    'remaining_budget'=>$datas->budget_per_selection,
                    'budget_status'=>1
                );
                $this->db->where('user_id',$datas->user_id);
                $this->db->update('tbl_quiz_budgets',$update_status);
            }
              // echo "this".$total_budget."<br>";
                else{
                    $site_info=$this->Site_setting_model->get_site_info(1);
                    $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
                    $headers .= "MIME-Version: 1.0\x0d\x0a";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
                    $email = $site_info->site_email;
                    $template=$this->Email_model->get_email_template("LOW_VIEWS");

                    $subject=$template->template_subject;
                    $emailbody=$template->template_design;

                    $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

                    $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

                    $subject=$this->Email_model->parse_email($parseElement,$subject);
                    $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

                    @mail($owner_email,$subject,$emailbody,$headers);
                }
                 }
            
             }
            
          
        }

}


