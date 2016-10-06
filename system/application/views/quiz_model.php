<?php
class Quiz_model extends Model {
    function Quiz_model() {
        parent::Model();
        $this->load->model('Email_model');
        $this->load->model('Award_model');
        $this->load->model('Country_management_model');
    }
    
    function best_rank($points)
    {        
        $sql = "
            SELECT * from 
            tbl_category_titles
            ";        
        $query = $this->db->query($sql, array($user_id));
        
        $levels = $query->result();
        
        foreach($levels as $level):
            $p = explode('-',$level->points);
        
            if($p[0] < $points && $points < $p[1]) return $level->category_title;
        endforeach;
    }
    
   
    function insert_coupon_history($uid,$cid)
    {
        $data = array(
            'user_id' => $uid,
            'coupon_code_id' => $cid
        );
        $this->db->insert('tbl_coupon_history', $data);
    }
    
    function filter_quiz($uid,$f)
    {        
        $val = array (
            'On' => 1,
            'Off' => 0
        );
        
        $data1 = array ('filter_adult'=>$val[$f]);
        $data2 = array ('user_id'=>$uid);        

        $v = $this->db->update('tbl_members',$data1,$data2);        
#echo($this->db->last_query());
        return $v;
    }

/*
 * function to check similar-answer-type quizzes
 *      return value TRUE : does not show quiz
 *      return value FALSE : shows quiz
 * author : Bishwa P. Deoja ( courtesy Roshan Bhattarai )
 */
    function get_quizzes_played($user_id)
    {        
        # the holder for all quizzes played in five sessions
        $ids=array(); 
# the holder for all quiz correct answers
        $answers=array(); 
# get quizes played in the last five sessions        
        $sql = "
            SELECT quiz_id 
            FROM tbl_quiz_answers 
            WHERE user_id = ? 
            AND answered_date 
            BETWEEN 
            (
            SELECT act_time 
            FROM `tbl_log_activity` 
            WHERE act_name = 'Login' 
            AND act_user_id=? 
            ORDER BY act_id DESC 
            LIMIT 4,1
            )
            AND
            (
            SELECT act_time 
            FROM `tbl_log_activity` 
            WHERE act_name = 'Login' 
            AND act_user_id=? 
            ORDER BY act_id DESC 
            LIMIT 0,1
            )";
        
        $query = $this->db->query($sql ,array($user_id,$user_id,$user_id));
#exit($this->db->last_query());
        $result = $query->result();
        
        # check if user hasn't play any quiz in the last five sessions
        if(empty($result)) return FALSE;
        
        else
        {
            $ind = 0; # index value for $answers array            
# collect correct quiz answers
            foreach($result as $quiz):
                $ids[$ind] = $quiz->quiz_id;
                $sql = "
                    SELECT 
                    (
                    CASE right_option
                    WHEN  'option1'
                    THEN option1
                    WHEN  'option2'
                    THEN option2
                    WHEN  'option3'
                    THEN option3
                    END
                    )
                    AS o 
                    FROM tbl_quiz_options 
                    WHERE 
                    quiz_id=?
                    ";
                $q1 = $this->db->query($sql,array($quiz->quiz_id));
                $r1 = $q1->result();
# add to the answer's array list
                $answers[$ind] = $r1[0]->o;
                $ind++;
            endforeach;         
            
            return array($ids,$answers);
        }
    }
    
    function check_similar_quiz($ids,$answers,$qid,$uid)
    {
        $id = $this->session->userdata('wannaquiz_user_id');        

# question creator sees own quiz
        if($id==$uid) return FALSE;
# check if user hasn't played any quiz
        if($this->db->where('user_id',$id)->count_all_results('tbl_quiz_answers') == 0) return FALSE;
# check whether quiz has already been attempted
        if($this->db->where('quiz_id',$qid)->where('user_id',$uid)->count_all_results('tbl_quiz_answers')!=0) return TRUE;

# check if current quiz id $qid is already in played list ( do not check further , or show quiz )        
            if(in_array($qid,$ids)) return TRUE;
# get current quiz $qid's correct option
            $sql = "
                SELECT 
                (
                CASE right_option
                WHEN  'option1'
                THEN option1
                WHEN  'option2'
                THEN option2
                WHEN  'option3'
                THEN option3
                END
                )
                AS o 
                FROM tbl_quiz_options 
                WHERE 
                quiz_id=?
                ";
            $q2 = $this->db->query($sql,array($qid));
            $r2 = $q2->result();
            $cur = $r2[0]->o; # current_correct_option
/*
$val = $this->session->userdata('count');
$val;
$this->session->set_userdata('count',$val.$qid);
*/      
# check current quiz correct option with $answers for a match ; do not show
            foreach($answers as $a) :    
                if(stristr($a,$cur)) return TRUE; # if match found return to not show quiz
            endforeach;
# show quiz
            return FALSE;
        
    }
    
    function check_last_five_sessions($id)
    {
        $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        
        $sql = "
                SELECT COUNT(act_id) count 
                FROM tbl_log_activity
                WHERE act_name='Login'
                AND act_user_id=?
                AND act_time > ? 
                ";
        $query = $this->db->query($sql,array($id,$today));
        $r = $query->result();
            return $r[0]->count;
    }

    function insertPhotoQuizRegular() {
        
        //Insert Question into the database
        $ip_address = $_SERVER['REMOTE_ADDR'];
      $data=array(

            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_level'=>$this->input->post('quiz_level'),
            'quiz_question_type'=>$this->input->post('quiz_question_type'),
            'quiz_type'=>'photo',
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),
            'quiz_long_answer'=>$this->input->post('quiz_long_answer'),
            'status'=>'1',
            'quiz_style'=>'regular',
            'user_type'=>'regular',
            'posted_date'=>current_date_time_stamp(),
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->input->post('category'),
            'ip_address'=>$ip_address,
             
   );
 #print_r($data);
 #exit;
       $this->db->insert('tbl_quizes',$data);
        $quiz_id=$this->db->insert_id();

        if($this->input->post('quiz_question_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->input->post('single_question'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->input->post('option1'),
                'option2'=>$this->input->post('option2'),
                'option3'=>$this->input->post('option3'),
                'right_option'=>$this->input->post('right_answer'),
            );

            $this->db->insert('tbl_quiz_options',$data);
        }

        //insert question image into the database
        $data=array(
            'quiz_id'=>$quiz_id,
            'images'=> $this->input->post('ques_image'),
            'images2'=> $this->input->post('ans_image'),
        );

        $this->db->insert('tbl_quiz_images',$data);


    }

    function insertVideoQuizRegular() {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $data=array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            //'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_level'=>$this->input->post('quiz_level'),
            'quiz_question_type'=>$this->input->post('quiz_question_type'),
            'quiz_type'=>'video',
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),

            'status'=>'1',
            'quiz_style'=>'regular',
            'user_type'=>'regular',
            'posted_date'=>current_date_time_stamp(),
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->input->post('category'),
            'ip_address'=>$ip_address,
        );

        $this->db->insert('tbl_quizes',$data);
        $quiz_id=$this->db->insert_id();

        if($this->input->post('quiz_question_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->input->post('single_question'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->input->post('option1'),
                'option2'=>$this->input->post('option2'),
                'option3'=>$this->input->post('option3'),
                'right_option'=>$this->input->post('right_answer'),
            );

            $this->db->insert('tbl_quiz_options',$data);
        }


        //insert question videos into the database
      /*  $temp_quiz_id = $this->session->userdata('temp_quiz_id');
        // echo $temp_quiz_id."test";
        $this->db->where('id',$temp_quiz_id);
        $query = $this->db->get('tbl_temp_quiz_videos');
        $query1 = $query->row();
        $quiz_videos = $query1->quiz_videos;
        $video_answer = $query1->video_answer;
		$quiz_temp_id = $query1->id;*/
        $data=array(
            'quiz_id'=>$quiz_id,
            'quiz_videos'=>$this->input->post('quiz_videos'),
            'video_answer'=>$this->input->post('video_answer'),
        );

        if($this->db->insert('tbl_quiz_videos',$data))
            $this->session->unset_userdata('temp_quiz_id');

    }

    function editPhotoQuizRegular() {
        /*$this->load->helper('image');
        $x1 = $this->input->post('x1');
        $y1 = $this->input->post('y1');
        $x2 = $this->input->post('x2');
        $y2 = $this->input->post('y2');
        $w = $this->input->post('w');
        $h = $this->input->post('h');

        $new_image_file_name=time().'_'.$this->input->post('large_image_name');
        $large_image_location='./user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$this->input->post('large_image_name');
        $thumb_image_location='./photo_question_thumbs/'.$new_image_file_name;
        $thumb_width=100;

        //Scale the image to the thumb_width set above
        $scale = $thumb_width/$w;
        $cropped =$this->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

        // large image crop of the same proportion
        $large_image_location='./user_uploaded_photos/'.$this->session->userdata('wannaquiz_user_id').'/'.$this->input->post('large_image_name');
        $thumb_image_location='./photo_question_images/'.$new_image_file_name;
        $thumb_width=200;

        //Scale the image to the thumb_width set above
        $scale = $thumb_width/$w;
        $cropped =$this->resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

        // save original image into photo_answer_thumbs()
        $thumb_path='photo_answer_thumbs/'.$new_image_file_name;
        image_thumb($large_image_location,$thumb_path,$new_image_file_name, 300,300);
*/
        $ip_address = $_SERVER['REMOTE_ADDR'];
        
        $data=array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_level'=>$this->input->post('quiz_level'),
            'quiz_question_type'=>$this->input->post('quiz_question_type'),
            'quiz_type'=>'photo',
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),
            'quiz_long_answer'=>$this->input->post('quiz_long_answer'),
            'status'=>'1'   ,
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->input->post('category'),
            'ip_address'=>$ip_address,
            
        );
        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',$data);
        //$quiz_id=$this->db->insert_id();

        if($this->input->post('quiz_question_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->input->post('single_question'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->input->post('option1'),
                'option2'=>$this->input->post('option2'),
                'option3'=>$this->input->post('option3'),
                'right_option'=>$this->input->post('right_answer'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quiz_options',$data);
        }

        //insert question image into the database
        $data=array(
            'quiz_id'=>$quiz_id,
            'images'=> $this->input->post('ques_image')
        );

        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quiz_images',$data);

    }

    function editPhotoQuizAdvertiser() {
    
             $ip_address = $_SERVER['REMOTE_ADDR'];
            
          $data=array(

            'image_id'=>$this->session->userdata('image_id'),
            'quiz_question'=>$this->session->userdata('quiz_question'),
            'quiz_level'=>$this->session->userdata('quiz_level'),
            'quiz_question_type'=>$this->session->userdata('quiz_type'),
            'quiz_type'=>'photo',
            'quiz_suitable_for'=>$this->session->userdata('quiz_suitable_for'),
            'quiz_comment'=>$this->session->userdata('quiz_comment'),
            'quiz_long_answer'=>$this->session->userdata('quiz_long_answer'),
            'status'=>'1'   ,
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->session->userdata('category_id'),
            'ip_address'=>$ip_address,
            'ads_rotation'=>'yes',
            'country_target'=>$this->session->userdata('country_target'),
            'state_target'=>$this->session->userdata('state_target'),
            'city_target'=>$this->session->userdata('city_target')
            
        );
        $quiz_id = $this->session->userdata('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',$data);
        //$quiz_id=$this->db->insert_id();

        if($this->session->userdata('quiz_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->session->userdata('single_open_answer'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(

                'option1'=>$this->session->userdata('option1'),
                'option2'=>$this->session->userdata('option2'),
                'option3'=>$this->session->userdata('option3'),
                'right_option'=>$this->session->userdata('right_answer')
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quiz_options',$data);
        }

        //update question image into the database
        $data=array(

            'images'=> $this->session->userdata('image_name')
        );

        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quiz_images',$data);

        //update advertiser budget --------------------------
        $data=array(

            'total_budget'=>$this->session->userdata('advertiser_budget'),
            'budget_per_selection'=>$this->session->userdata('budget_per_selection'),
            'per_selection'=>$this->session->userdata('budget_for'),
            'budget_status'=>'1'
        );
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_advertiser_quiz_budget',$data);

        //update Banners ---------------------------------
        for($i=1;$i<=4;$i++) {
            $image_name='banner_file_'.$i;
//            if($_FILES[$image_name]['tmp_name']!='') {
                //$file_info=$this->upload_file($image_name);
                $banner_id[$i] = $this->input->post('banner_'.($i-1));
               // print_r($banner_id[$i]);exit;
                if($banner_id[$i]!=''){
                    $data=array(

                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->where('banner_id',$banner_id[$i]);
                    $this->db->update('tbl_advertiser_banner_ads',$data);
                 }
                 else {
                     $data1=array(
                        'quiz_id'=>$quiz_id,
                        'advertiser_id'=>$this->session->userdata('wannaquiz_user_id'),
                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->insert('tbl_advertiser_banner_ads',$data1);
                 }

        //    }
        }

        //insert Long Text Ads ---------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('long_text_ads_title_'.$i)!="") {
                $long_text_id[$i] = $this->input->post('long_text_'.$i);
                if($long_text_id[$i]!=''){
                    $data=array(
                        'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                        'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                        'link_url'=>$this->input->post('long_text_ads_url_'.$i)
                    );

                    $this->db->where('id',$long_text_id[$i]);
                    $this->db->update('tbl_advertiser_long_text_ads',$data);
                }
                else {
                    $data1=array(
                        'quiz_id'=>$quiz_id,
                        'advertiser_id'=>$this->session->userdata('wannaquiz_user_id'),
                        'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                        'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                        'link_url'=>$this->input->post('long_text_ads_url_'.$i)
                    );
                    $this->db->insert('tbl_advertiser_long_text_ads',$data1);
               }
            }
        }
        //insert Short text ads---------------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('short_text_ads_descrption_'.$i)!="") {

                $short_text_id[$i] = $this->input->post('short_text_'.$i);
                if($short_text_id[$i]!=''){
                    $data=array(
                        'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                        'link_url'=>$this->input->post('link_url_'.$i)
                    );

                    $this->db->where('id',$short_text_id[$i]);
                    $this->db->update('tbl_advertiser_short_text_ads',$data);
                }
                else{
                    $data=array(
                        'quiz_id'=>$quiz_id,
                        'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                        'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                        'link_url'=>$this->input->post('link_url_'.$i)
                    );

                    $this->db->insert('tbl_advertiser_short_text_ads',$data);
                }
            }
        }
    }

    function editVideoQuizAdvertiser() {
       
       $ip_address = $_SERVER['REMOTE_ADDR'];
          
        $data=array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            //'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->session->userdata('quiz_question'),
            'quiz_level'=>$this->session->userdata('quiz_level'),
            'quiz_question_type'=>$this->session->userdata('quiz_question_type'),
            'quiz_type'=>'video',
            'quiz_suitable_for'=>$this->session->userdata('quiz_suitable_for'),
            'quiz_comment'=>$this->session->userdata('quiz_comment'),

            'status'=>'1'   ,
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->session->userdata('category_id'),
            'ip_address'=>$ip_address,
            'country_target'=>$this->session->userdata('country_target'),
            'state_target'=>$this->session->userdata('state_target'),
            'city_target'=>$this->session->userdata('city_target')
        );

        $quiz_id = $this->session->userdata('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',$data);

        if($this->input->post('quiz_question_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->session->userdata('single_open_answer'),
                'link_url'=>$this->input->post('link_url_'.$i)
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(

                'option1'=>$this->session->userdata('option1'),
                'option2'=>$this->session->userdata('option2'),
                'option3'=>$this->session->userdata('option3'),
                'right_option'=>$this->session->userdata('right_answer')
            );

            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quiz_options',$data);
        }

        //update question videos into the database

       /* $temp_quiz_id = $this->session->userdata('temp_quiz_id');
        if($temp_quiz_id!='') {
            $this->db->where('id',$temp_quiz_id);
            $query = $this->db->get('tbl_temp_quiz_videos');
            $query1 = $query->row();
            $quiz_videos = $query1->quiz_videos;
            $video_answer = $query1->video_answer;
        }
        else {*/
            $quiz_videos = $this->session->userdata('quiz_videos');
            $video_answer = $this->session->userdata('video_answer');
       /* }*/
        $data=array(

            'quiz_videos'=>$quiz_videos,
            'video_answer'=>$video_answer
        );
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quiz_videos',$data);

        /*$this->session->unset_userdata('temp_quiz_id');*/

        //insert advertiser budget --------------------------
        $data=array(

            'total_budget'=>$this->session->userdata('advertiser_budget'),
            'budget_per_selection'=>$this->session->userdata('budget_per_selection'),
            'per_selection'=>$this->session->userdata('budget_for'),
            'budget_status'=>'1'
        );
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_advertiser_quiz_budget',$data);
        //update Banners ---------------------------------
        for($i=1;$i<=4;$i++) {
            $image_name='banner_file_'.$i;
            //print_r($_FILES);exit;
            //if($_FILES[$image_name]['tmp_name']!='') {
                //$file_info=$this->upload_file($image_name);

                $banner_id[$i] = $this->input->post('banner_'.($i-1));
               // print_r($banner_id[$i]);exit;
                if($banner_id[$i]!=''){
                    $data=array(

                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->where('banner_id',$banner_id[$i]);
                    $this->db->update('tbl_advertiser_banner_ads',$data);
                 }
                 else {
                     $data1=array(
                        'quiz_id'=>$quiz_id,
                        'advertiser_id'=>$this->session->userdata('wannaquiz_user_id'),
                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->insert('tbl_advertiser_banner_ads',$data1);
                 }

            //}
        }

        //insert Long Text Ads ---------------------------------
        for($i=0;$i<5;$i++) { //echo $this->input->post('long_text_ads_title_'.$i);
            if($this->input->post('long_text_ads_title_'.$i)!="") {

                $data=array(
                    'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                    'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                    'link_url'=>$this->input->post('long_text_ads_url_'.$i),
                );

                $long_text_id[$i] = $this->input->post('long_text_'.$i);

               if($long_text_id[$i]!=''){
                $this->db->where('id',$long_text_id[$i]);
                $this->db->update('tbl_advertiser_long_text_ads',$data);
               }
               else {
                    $data1=array(
                        'quiz_id'=>$quiz_id,
                    'advertiser_id'=>$this->session->userdata('wannaquiz_user_id'),
                    'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                    'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                    'link_url'=>$this->input->post('long_text_ads_url_'.$i)
                );
                    $this->db->insert('tbl_advertiser_long_text_ads',$data1);
               }
            }
        }
        //insert Short text ads---------------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('short_text_ads_descrption_'.$i)!="") {

                $short_text_id[$i] = $this->input->post('short_text_'.$i);
                if($short_text_id[$i]!=''){
                    $data=array(
                        'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                        'link_url'=>$this->input->post('link_url_'.$i)
                    );

                    $this->db->where('id',$short_text_id[$i]);
                    $this->db->update('tbl_advertiser_short_text_ads',$data);
                }
                else{
                    $data=array(
                        'quiz_id'=>$quiz_id,
                        'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                        'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                        'link_url'=>$this->input->post('link_url_'.$i)
                    );

                    $this->db->insert('tbl_advertiser_short_text_ads',$data);
                }
            }
        }
    }

    function editVideoQuizRegular() {
        $ip_address = $_SERVER['REMOTE_ADDR'];
         
                $city_target=$this->input->post('city');
        $data=array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            //'image_id'=>$this->input->post('image_id'),
            'quiz_question'=>$this->input->post('quiz_question'),
            'quiz_level'=>$this->input->post('quiz_level'),
            'quiz_question_type'=>$this->input->post('quiz_question_type'),
            'quiz_type'=>'video',
            'quiz_suitable_for'=>$this->input->post('quiz_suitable_for'),
            'quiz_comment'=>$this->input->post('quiz_comment'),

            'status'=>'1'   ,
            'modified_date'=>current_date_time_stamp(),
            'category_id'=>$this->input->post('category'),
            'ip_address'=>$ip_address
         );

        $quiz_id = $this->input->post('quiz_id');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',$data);

        if($this->input->post('quiz_question_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->input->post('single_question'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);

        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->input->post('option1'),
                'option2'=>$this->input->post('option2'),
                'option3'=>$this->input->post('option3'),
                'right_option'=>$this->input->post('right_answer'),
            );

            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quiz_options',$data);
        }

        //insert question videos into the database

        /*$temp_quiz_id = $this->session->userdata('temp_quiz_id');
        if($temp_quiz_id!='') {
            $this->db->where('id',$temp_quiz_id);
            $query = $this->db->get('tbl_temp_quiz_videos');
            $query1 = $query->row();
            $quiz_videos = $query1->quiz_videos;
            $video_answer = $query1->video_answer;
        }
        else {*/
            $quiz_videos = $this->input->post('quiz_videos');
            $video_answer = $this->input->post('video_answer');
        /*}*/
        $data=array(
            'quiz_id'=>$quiz_id,
            'quiz_videos'=>$quiz_videos,
            'video_answer'=>$video_answer
        );
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quiz_videos',$data);

        $this->session->unset_userdata('temp_quiz_id');
    }

    function insertPhotoQuizAdvertiser() {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    //Insert Question into the database--------------------------------
       // if($this->session->userdata('wannaquiz_user_id')!='')
        $category_id = $this->session->userdata('category_id');
        // else
       
//        $category_id = $this->input->post('category');
        //echo $category_id; exit;
         $data=array(
            
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'image_id'=>$this->session->userdata('image_id'),
            'quiz_question'=>$this->session->userdata('quiz_question'),
            'quiz_level'=>$this->session->userdata('quiz_level'),
            'quiz_question_type'=>$this->session->userdata('quiz_type'),
            'quiz_type'=>'photo',
            'quiz_suitable_for'=>$this->session->userdata('quiz_suitable_for'),
            'quiz_comment'=>$this->session->userdata('quiz_comment'),
            'quiz_long_answer'=>$this->session->userdata('quiz_long_answer'),
            'status'=>'1',
            'user_type'=>'advertiser',
            'quiz_credits'=>0,
            'quiz_style'=>'advertiser',
            'category_id'=>$category_id,
            'posted_date'=>current_date_time_stamp(),
            'modified_date'=>current_date_time_stamp(),
            'ads_rotation'=>'yes',
            'coupon_code_id'=>$this->session->userdata('coupon_code_id'),
            'ip_address'=>$ip_address,
            'country_target'=>$this->session->userdata('country_target'),
            'state_target'=>$this->session->userdata('state_target'),
            'city_target'=>$this->session->userdata('city_target')
        );

        $this->db->insert('tbl_quizes',$data);
        $quiz_id=$this->db->insert_id();
        $this->session->set_userdata('quiz_id',$quiz_id);
        if($this->session->userdata('quiz_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->session->userdata('single_open_answer'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);
        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->session->userdata('option1'),
                'option2'=>$this->session->userdata('option2'),
                'option3'=>$this->session->userdata('option3'),
                'right_option'=>$this->session->userdata('right_answer'),
            );
            $this->db->insert('tbl_quiz_options',$data);
        }

        //insert question image into the database --------------------------
        $data=array(
            'quiz_id'=>$quiz_id,
            'images'=> $this->session->userdata('image_name')
        );

        $this->db->insert('tbl_quiz_images',$data);

        //insert advertiser budget --------------------------
//        $data=array(
//            'quiz_id'=>$quiz_id,
//            'user_id'=> $this->session->userdata('wannaquiz_user_id'),
//            'total_budget'=>$this->session->userdata('advertiser_budget'),
//            'budget_per_selection'=>$this->session->userdata('budget_per_selection'),
//            'per_selection'=>$this->session->userdata('budget_for'),
//            'budget_status'=>'1'
//        );
//
//        $this->db->insert('tbl_advertiser_quiz_budget',$data);
        return $quiz_id;

    } // function ends

    function insertPhotoQuizAdvertiserBanners() {
    //insert Banners ---------------------------------
        $quiz_id = $this->session->userdata('quiz_id');
        for($i=1;$i<=4;$i++) {
            $image_name='banner_file_'.$i;

            //if($_FILES[$image_name]['tmp_name']!='') {
                //$file_info=$this->upload_file($image_name);

             $banner_id[$i] = $this->input->post('banner_'.($i-1));
              //print_r($_POST);
              //echo $this->input->post('banner_name_'.(1-1));
              //print_r($banner_id[$i]);exit;
                 if($banner_id[$i]!=''){
                    $data=array(
                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->where('banner_id',$banner_id[$i]);
                    $this->db->update('tbl_advertiser_banner_ads',$data);
                 }
                 else{
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                    //'banner_image'=>$file_info['file_name'],
                    'url'=>$this->input->post('banner_url_'.($i-1))
                );

                $this->db->insert('tbl_advertiser_banner_ads',$data);
                 }
            //}
        }

        //insert Long Text Ads ---------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('long_text_ads_title_'.$i)!="") {
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                    'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                    'link_url'=>$this->input->post('long_text_ads_url_'.$i),
                );

                $this->db->insert('tbl_advertiser_long_text_ads',$data);
            }
        }
        //insert Short text ads---------------------------------------

        for($i=0;$i<5;$i++) {
            if($this->input->post('short_text_ads_descrption_'.$i)!="") {
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                    'link_url'=>$this->input->post('link_url_'.$i)
                );
                //echo $this->input->post('link_url_'.$i);
                $this->db->insert('tbl_advertiser_short_text_ads',$data);
            }
        }
    }

    function insertVideoQuizAdvertiser() {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $category_id = $this->session->userdata('category_id');
               //exit;
        $data=array(
            'user_id'=>$this->session->userdata('wannaquiz_user_id'),
            'quiz_question'=>$this->session->userdata('quiz_question'),
            'quiz_level'=>$this->session->userdata('quiz_level'),
            'quiz_question_type'=>$this->session->userdata('quiz_question_type'),
            'quiz_type'=>'video',
            'quiz_suitable_for'=>$this->session->userdata('quiz_suitable_for'),
            'quiz_comment'=>$this->session->userdata('quiz_comment'),

            'status'=>'1',
            'user_type'=>'advertiser',
            'quiz_credits'=>0,
            'quiz_style'=>'advertiser',
            'category_id'=>$category_id,
            'posted_date'=>current_date_time_stamp(),
            'modified_date'=>current_date_time_stamp(),
            'ads_rotation' => 'yes',
            'coupon_code_id'=>$this->session->userdata('coupon_code_id'),
            'ip_address'=>$ip_address,
            'country_target'=>$this->session->userdata('country_target'),
            'state_target'=>$this->session->userdata('state_target'),
            'city_target'=>$this->session->userdata('city_target')
        );

        $this->db->insert('tbl_quizes',$data);
        $quiz_id=$this->db->insert_id();
        $this->session->set_userdata('quiz_id',$quiz_id);
        if($this->session->userdata('quiz_type')=='open') {
            $data=array(
                'single_line_answer'=>$this->session->userdata('single_open_answer'),
            );
            $this->db->where('quiz_id',$quiz_id);
            $this->db->update('tbl_quizes',$data);
        }
        else {
            $data=array(
                'quiz_id'=>$quiz_id,
                'option1'=>$this->session->userdata('option1'),
                'option2'=>$this->session->userdata('option2'),
                'option3'=>$this->session->userdata('option3'),
                'right_option'=>$this->session->userdata('right_answer')
            );
            $this->db->insert('tbl_quiz_options',$data);
        }

        //insert question video into the database --------------------------
        /*$temp_quiz_id = $this->session->userdata('temp_quiz_id');
        $this->db->where('id',$temp_quiz_id);
        $query = $this->db->get('tbl_temp_quiz_videos');
        $query1 = $query->row();
        $quiz_videos = $query1->quiz_videos;
        $video_answer = $query1->video_answer;*/
        $data=array(
            'quiz_id'=>$quiz_id,
            'quiz_videos'=>$this->session->userdata('quiz_videos'),
            'video_answer'=>$this->session->userdata('video_answer')
        );

        if($this->db->insert('tbl_quiz_videos',$data))
           /* $this->session->unset_userdata('temp_quiz_id');*/

        //insert advertiser budget --------------------------
//        $data=array(
//            'quiz_id'=>$quiz_id,
//            'user_id'=> $this->session->userdata('wannaquiz_user_id'),
//            'total_budget'=>$this->session->userdata('advertiser_budget'),
//            'budget_per_selection'=>$this->session->userdata('budget_per_selection'),
//            'per_selection'=>$this->session->userdata('budget_for'),
//            'budget_status'=>'1'
//        );
//
//        $this->db->insert('tbl_advertiser_quiz_budget',$data);
        return $quiz_id;

    }

    function insertVideoQuizAdvertiserBanners() {
    //insert Banners ---------------------------------
        $quiz_id = $this->session->userdata('quiz_id');
        for($i=1;$i<=4;$i++) {
            $image_name='banner_file_'.$i;
            $banner_id[$i] = $this->input->post('banner_'.($i-1));
              //print_r($banner_id[$i]);exit;
                 if($banner_id[$i]!=''){
                    $data=array(

                        'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                        //'banner_image'=>$file_info['file_name'],
                        'url'=>$this->input->post('banner_url_'.($i-1))
                    );
                    $this->db->where('banner_id',$banner_id[$i]);
                    $this->db->update('tbl_advertiser_banner_ads',$data);
                 }
                 else{
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'banner_name'=>$this->input->post('banner_name_'.($i-1)),
                    //'banner_image'=>$file_info['file_name'],
                    'url'=>$this->input->post('banner_url_'.($i-1))
                );

                $this->db->insert('tbl_advertiser_banner_ads',$data);
                 }
        }

        //insert Long Text Ads ---------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('long_text_ads_title_'.$i)!="") {
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'link_title'=>$this->input->post('long_text_ads_title_'.$i),
                    'link_description'=>$this->input->post('long_text_ads_description_'.$i),
                    'link_url'=>$this->input->post('long_text_ads_url_'.$i)
                );

                $this->db->insert('tbl_advertiser_long_text_ads',$data);
            }
        }
        //insert Short text ads---------------------------------------
        for($i=0;$i<5;$i++) {
            if($this->input->post('short_text_ads_descrption_'.$i)!="") {
                $data=array(
                    'quiz_id'=>$quiz_id,
                    'advertiser_id'=> $this->session->userdata('wannaquiz_user_id'),
                    'link_short_desc'=>$this->input->post('short_text_ads_descrption_'.$i),
                    'link_url'=>$this->input->post('link_url_'.$i)
                );

                $this->db->insert('tbl_advertiser_short_text_ads',$data);
            }
        }
    }

    function editQuizBudget($quiz_id, $gross_amount=0) {

        $budget_info = $this->get_quiz_budget($quiz_id);

        if($this->session->userdata('advertiser_budget')=='')
        $total_budget = $gross_amount;
        else $total_budget = $this->session->userdata('advertiser_budget');
        $myFile ="test.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $stringData = ($total_budget)."\n";
        fwrite($fh, $stringData);
        $stringData = $budget_info->total_budget."Tracy Tanner\n";
        fwrite($fh, $stringData);
        fclose($fh);

        $this->db->where('quiz_id',$quiz_id);
        $data=array(
            'user_id'=> $this->session->userdata('wannaquiz_user_id'),
            'total_budget'=>($budget_info->total_budget + $total_budget),
            'budget_per_selection'=>$this->session->userdata('budget_per_selection'),
            'per_selection'=>$this->session->userdata('budget_for'),
            'budget_status'=>'1'
        );
        $this->db->update('tbl_advertiser_quiz_budget',$data);
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes', array('coupon_code_id'=>$this->session->userdata('coupon_code_id')));
    }

    function get_user_video_questions($num=null,$offset=null,$user_type=0) {
         if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
        if($user_type != 0)
        $sql="Select q.*,qv.* FROM tbl_quizes q, tbl_quiz_videos qv,tbl_quiz_budgets qb where q.quiz_id=qv.quiz_id AND q.user_id = qb.user_id AND q.user_id=? and qb.budget_status='1' and q.status='1' group by q.quiz_id order by posted_date desc $limit";
        else
        $sql="Select q.*,qv.* FROM tbl_quizes q, tbl_quiz_videos qv where q.quiz_id=qv.quiz_id AND q.user_id=? and q.status='1' group by q.quiz_id order by posted_date desc $limit";
        $query=$this->db->query($sql,array($this->session->userdata('wannaquiz_user_id')));
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function get_user_photo_questions($num=null,$offset=null,$user_type=0) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';

        if($user_type != 0)
        $sql="Select * FROM tbl_quizes q, tbl_quiz_images qm,tbl_quiz_budgets qb where q.quiz_id=qm.quiz_id AND q.user_id = qb.user_id AND q.user_id=? and qb.budget_status='1' and q.status='1' group by q.quiz_id order by posted_date desc $limit";
        else
        $sql = "Select * FROM tbl_quizes q, tbl_quiz_images qm where q.quiz_id=qm.quiz_id AND q.user_id=? and q.status='1' group by q.quiz_id order by posted_date desc $limit";
        $query=$this->db->query($sql,array($this->session->userdata('wannaquiz_user_id')));
        //echo $this->db->last_query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function get_user_questions($num=null,$offset=null) {
        if($num!=null || $offset!=null)
            $limit=" LIMIT $offset,$num";

        else
        $limit='';
        $user_id = $this->session->userdata('wannaquiz_user_id');
        //  $sql="Select q.*,qm.images,qv.quiz_videos,qv.video_answer FROM tbl_quizes q, tbl_quiz_images qm,tbl_quiz_videos qv where q.quiz_id=qm.quiz_id AND q.quiz_id=qv.quiz_id AND q.user_id=? AND q.status='1'";

//        $sql="(Select q.*,qm.images,0,qb.total_budget FROM tbl_quizes q, tbl_quiz_images qm,tbl_advertiser_quiz_budget qb where q.quiz_id=qm.quiz_id and q.quiz_id=qb.quiz_id AND q.user_id=? and q.status='1')
//                UNION ALL
//                (Select q.*,qv.quiz_videos,qv.video_answer,qb.total_budget FROM tbl_quizes q, tbl_quiz_videos qv,tbl_advertiser_quiz_budget qb where q.quiz_id=qv.quiz_id and q.quiz_id=qb.quiz_id AND q.user_id=? AND q.status='1') $limit";
if($user_type != 0)
        $sql="(Select q.*,qm.images,0,qb.total_budget FROM tbl_quizes q, tbl_quiz_images qm,tbl_quiz_budgets qb where q.quiz_id=qm.quiz_id AND q.user_id = qb.user_id and q.user_id=? and qb.budget_status='1' and q.status = '1' order by posted_date desc)
                UNION ALL
                (Select q.*,qv.quiz_videos,qv.video_answer,qb.total_budget FROM tbl_quizes q, tbl_quiz_videos qv, tbl_quiz_budgets qb where q.quiz_id=qv.quiz_id and q.user_id = qb.user_id and q.user_id=? AND qb.budget_status='1' and q.status = '1' order by posted_date desc) $limit";
        else
        $sql="(Select q.*,qm.images,0 FROM tbl_quizes q, tbl_quiz_images qm where q.quiz_id=qm.quiz_id and q.user_id=? and q.status='1' order by posted_date desc)
                UNION ALL
                (Select q.*,qv.quiz_videos,qv.video_answer FROM tbl_quizes q, tbl_quiz_videos qv where q.quiz_id=qv.quiz_id and q.user_id=? AND q.status='1' order by posted_date desc) $limit";
        $query=$this->db->query($sql,array($user_id,$user_id));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function get_questions_by_category($cid,$user_type,$num,$offset) {
        $id = $this->session->userdata('wannaquiz_user_id');
        $order_by="order by modified_date DESC";
        if($num==0 && $offset==0)
            $limit='';
        else
            $limit=" LIMIT $offset,$num";
        $sql="
            (Select q.*,m.username,qm.images,0
            FROM tbl_quizes q,tbl_members m, tbl_quiz_images qm
            where q.quiz_id=qm.quiz_id
            AND q.user_id=m.user_id
            AND q.category_id=?
            AND (q.country_target='' or ( q.country_target!='' AND q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
            AND (q.state_target='' or ( q.state_target!='' AND q.state_target like '%".strtolower($_SESSION['state_target'])."%')) 
            AND (q.city_target='' or ( q.city_target!='' AND q.city_target like '%".strtolower($_SESSION['city_target'])."%'))
                  
            and q.user_type='$user_type' ";
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id') ";
         #if($id) $sql .= " and q.quiz_id not in ( select quiz_id from tbl_quiz_views where view_user_id=$id ) ";
      
        $sql .="
            and q.status='1') 
            UNION ALL 
            (Select q.*,m.username,qv.quiz_videos,qv.video_answer FROM tbl_quizes q, tbl_members m, tbl_quiz_videos qv 
            where q.quiz_id=qv.quiz_id AND q.user_id=m.user_id AND q.category_id=? 
            AND (q.country_target='' or ( q.country_target!='' AND q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
            AND (q.state_target='' or ( q.state_target!='' AND q.state_target like '%".strtolower($_SESSION['state_target'])."%')) 
            AND (q.city_target='' or ( q.city_target!='' AND q.city_target like '%".strtolower($_SESSION['city_target'])."%'))
            and q.user_type='$user_type' AND q.status='1') $order_by
            $limit";

        
        $query=$this->db->query($sql,array($cid,$cid));
  
       
//  echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function get_quiz($uid) {
        $sql = "select q.* from tbl_quizes q where q.user_id=? and q.status='1'";//q.status = 1 means open quizes
        $query = $this->db->query($sql,array($uid));
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_video_quiz_by_ID($id) {
        $sql = "select * from tbl_quiz_videos qv,tbl_quizes q where qv.quiz_id = q.quiz_id and qv.quiz_id =?";
        $query = $this->db->query($sql, array($id));
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_photo_quiz_by_id($id) {
        $sql = "select * from tbl_quiz_images qi,tbl_quizes q where qi.quiz_id = q.quiz_id and qi.quiz_id =?";
        $query = $this->db->query($sql, array($id));
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_photo_quiz_detail($id) {
        $sql = "select * from tbl_quizes where quiz_id =?";
        $query = $this->db->query($sql, array($id));
        return $query->row();

    }

    function get_quiz_views($id) {
        $sql = "select * from tbl_quiz_views where quiz_id =?";
        $query = $this->db->query($sql,array($id));
        //if($query->num_rows()>0)
        return $query->num_rows();
    }

    function set_quiz_views($id) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if($this->session->userdata('wannaquiz_user_id')!='')
            $user_id = $this->session->userdata('wannaquiz_user_id');
        else $user_id = '0';
        $date = current_date_time_stamp();

        $sql = " select * from tbl_quiz_views where quiz_id ='$id' and view_user_id='$user_id'";
        $query = $this->db->query($sql);
        if($query->num_rows<1) {
            $data = array('quiz_id'=>$id,
                'view_ip'=>$ip_address,
                'view_user_id'=>$user_id,
                'view_date'=>$date
            );
            $this->db->insert('tbl_quiz_views',$data);
        }
    }

    function get_text_ads($id,$qid) {

        $sql ="select * from tbl_advertiser_long_text_ads where advertiser_id='$id' and quiz_id='$qid'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_all_text_ads($id){
        $sql ="select * from tbl_advertiser_long_text_ads where advertiser_id='$id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_banner_ads($id,$qid=null) {

        $sql ="select * from tbl_advertiser_banner_ads where advertiser_id='$id' and quiz_id='$qid' and quiz_id!=0 ORDER BY rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_rotated_banner_ads($id,$qid=null) {

        $sql ="select * from tbl_advertiser_banner_ads aba where aba.advertiser_id='$id' and aba.quiz_id='$qid' and aba.quiz_id!=0 and aba.banner_id not in (select banner_id from tbl_adv_view_logs)ORDER BY rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function insert_rotated_banner_ads($banner_id,$quiz_id){
        $data = array('quiz_id'=>$quiz_id, 'banner_id'=>$banner_id,'view_date'=>current_date_time_stamp());
        $this->db->insert('tbl_adv_view_logs',$data);

    }

    function insert_ads_view_click_log($banner_id,$type, $profile=0){
        if($this->session->userdata('wannaquiz_user_id')!='')
        $user_id = $this->session->userdata('wannaquiz_user_id');
        else $user_id = '0';
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $action = 'view';
        $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        $date = current_date_time_stamp();
        $sql = "select * from tbl_adv_banners_view_click where banner_id =$banner_id and ip_address = '$ip_address' and ads_type ='$type' and action = '$action' and action_date_time > '$today'";
        $query = $this->db->query($sql);
                if($query->num_rows()>0){
                    return null;
                }
                else {
                    $data = array('banner_id'=>$banner_id,
                        'ip_address'=>$ip_address,
                        'profile_id' => $profile,
                        'user_id'=>$user_id,
                        'action'=>$action,
                        'ads_type'=>$type,
                        'action_date_time'=>$date
                    );
                    $this->db->insert('tbl_adv_banners_view_click', $data);
                }
    }

    function reset_rotated_banner_ads($quiz_id){
        $this->db->where('quiz_id',$quiz_id);
        $this->db->where('text_banner_id',0);
        $this->db->delete('tbl_adv_view_logs');
    }

    function get_rotated_text_ads($id,$qid=null) {
        if($qid!=null)
        $sql ="select * from tbl_advertiser_long_text_ads ata where ata.advertiser_id='$id' and ata.quiz_id='$qid' and ata.quiz_id!=0 and ata.id not in (select text_banner_id from tbl_adv_view_logs))";
        else
        $sql ="select * from tbl_advertiser_long_text_ads ata where ata.advertiser_id='$id' and ata.id not in (select text_banner_id from tbl_adv_view_logs)";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function insert_rotated_text_ads($text_id,$quiz_id){
        $data = array('quiz_id'=>$quiz_id, 'text_banner_id'=>$text_id,'view_date'=>current_date_time_stamp());
        $this->db->insert('tbl_adv_view_logs',$data);

    }

    function reset_rotated_text_ads($text_banner_id){
        $this->db->where('text_banner_id',$text_banner_id);
        //$this->db->where('banner_id',0);
        $this->db->delete('tbl_adv_view_logs');
    }


    function get_all_banner_ads($id) {

        $sql ="select * from tbl_advertiser_banner_ads where advertiser_id='$id' and quiz_id!=0 ORDER BY rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function calculate_total_rating($quiz_id) {
        $sql="Select sum(rating) as sum,count(*) as total FROM tbl_quiz_ratings where quiz_id=?";
        $query=$this->db->query($sql,array($quiz_id));
        //echo $this->db->last_query();
        $data=$query->row();
        $total=$data->total;
        $sum=$data->sum;
        if($total==0)
            $avg_rating=0;
        else
            $avg_rating=number_format($sum/$total,1);

        return $avg_rating;
    }

    ##########################################################################################################
    # IMAGE FUNCTIONS																						 #
    # You do not need to alter these functions																 #
    ##########################################################################################################
    function resizeImage($image,$width,$height,$scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);

        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$image,90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$image);
                break;
        }

        // chmod($image, 0777);
        return $image;
    }


    //You do not need to alter these functions
    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$thumb_image_name,90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    //upload function
    function upload_file($file) {
        $config['upload_path'] ='./advertiser_banners/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '3000';
        $config['max_width']  = '0';
        $config['max_height']  = '0';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload($file);
        $data = $this->upload->data();
        return $data;
    }

    //You do not need to alter these functions
    function getHeight($image) {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
    }

    //You do not need to alter these functions
    function getWidth($image) {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
    }

    function get_user_by_quizid($id) {
        $sql = "select * 
                from tbl_quizes q,tbl_members m,tbl_member_profile mp 
                where q.user_id=m.user_id 
                and m.user_id=mp.member_id 
                and q.quiz_id=?";
        $query = $this->db->query($sql, array($id));
        // echo $this->db->last_query();
        //        $this->db->where('quiz_id',$id);
        //        $query = $this->db->get('tbl_quizes');
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_ads_by_user_id($id,$type) {
        if($type=='long_text')
            $table = 'tbl_advertiser_long_text_ads';
        else if($type=='short_text')
                $table = 'tbl_advertiser_short_text_ads';
            else
                $table = 'tbl_advertiser_banner_ads';
        $sql = "select * from $table where advertiser_id =? and quiz_id!='0'";

        $query = $this->db->query($sql,array($id));
        if($query->num_rows()>0)
            return $query->result();
        else return null;

    }

    function set_ads_view($id,$type) {
        $data = $this->get_ads_by_user_id($id,$type);

        if(count($data)>0) {
            foreach($data as $ads_list) {
                if($type=='banner')
                    $banner_id = $ads_list->banner_id;
                else
                    $banner_id= $ads_list->id;

                $ip_address = $_SERVER['REMOTE_ADDR'];
                if($this->session->userdata('wannaquiz_user_id')!='')
                    $user_id = $this->session->userdata('wannaquiz_user_id');
                else $user_id = '0';
                $action = 'view';
                $date = current_date_time_stamp();
                $sql = "select * from tbl_adv_banners_view_click where banner_id =$banner_id and user_id = $user_id and ads_type ='$type'";
                $query = $this->db->query($sql);
                if($query->num_rows()>0)
                    return null;
                else {
                    $data = array('banner_id'=>$banner_id,
                        'ip_address'=>$ip_address,
                        'user_id'=>$user_id,
                        'action'=>$action,
                        'ads_type'=>$type,
                        'action_date_time'=>$date
                    );
                    $this->db->insert('tbl_adv_banners_view_click', $data);
                }
            }
        }
    }

    function set_quiz_impression($id) {
        if($this->session->userdata('wannaquiz_user_id')!='') {
            $user_id = $this->session->userdata('wannaquiz_user_id');
            $date = current_date_time_stamp();
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $sql = "select * from tbl_quiz_view_click where quiz_id ='$id' and user_id = '$user_id' ";
            $query = $this->db->query($sql);
            if($query->num_rows()>0)
                return null;
            else {
                $data = array('quiz_id'=>$id,
                    'ip_address'=>$ip_address,
                    'user_id'=>$user_id,
                    'view'=>1,
                    'click'=>0,
                    'date'=>$date
                );
                $this->db->insert('tbl_quiz_view_click', $data);
            }
        }
    }
   function insert_profile_view_click($action,$profile_id){
         $ip_address = $_SERVER['REMOTE_ADDR'];
        if($this->session->userdata('wannaquiz_user_id')!='')
            $user_id = $this->session->userdata('wannaquiz_user_id');
        else $user_id = '0';
         $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        $date = current_date_time_stamp();
        $sql = "select * from tbl_adv_banners_view_click where ip_address = '$ip_address' and ads_type ='profile' and profile_id='$profile_id' and action='$action' and action_date_time >= '$today'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return null;
        }
        
        else {
            $data = array(
                'ip_address'=>$ip_address,
                'user_id'=>$user_id,
                'action'=>$action,
                'ads_type'=>'profile',
                'action_date_time'=>$date,
                'profile_id'=>$profile_id
            );
            $this->db->insert('tbl_adv_banners_view_click', $data);
        }
    } 
    function set_profile_view_click($action,$profile_id){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if($this->session->userdata('wannaquiz_user_id')!='')
            $user_id = $this->session->userdata('wannaquiz_user_id');
        else $user_id = '0';
         $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        $date = current_date_time_stamp();
        $sql = "select * from tbl_adv_banners_view_click where ip_address = '$ip_address' and ads_type ='profile' and profile_id='$profile_id' and action='$action' and action_date_time >= '$today'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return null;
        }
        
        else {
            $data = array(
                'ip_address'=>$ip_address,
                'user_id'=>$user_id,
                'action'=>$action,
                'ads_type'=>'profile',
                'action_date_time'=>$date,
                'profile_id'=>$profile_id
            );
            $this->db->insert('tbl_adv_banners_view_click', $data);

            $member_cpc = $this->check_member_cpc($profile_id);
            $user_budget = $this->get_user_quiz_budget($profile_id);
            $cpc = $member_cpc->cpc;
            $quiz_views = $user_budget->total_budget;
            $remaining_budget = $user_budget->remaining_budget - $cpc;
            #echo $remaining_budget;echo '/';
            #echo $left_views = $quiz_views-$cpc; echo '/';

            $owner_info = $this->Member_model->get_member($profile_id);
            $owner_username  = $owner_info->username;
            $owner_email = $owner_info->email;
            if($remaining_budget<$cpc)
            {
                $status ='0';
            }

            else $status = '1';
            $budget = array('remaining_budget'=>$remaining_budget,
                'budget_status'=>$status
            );
            //print_r($budget);
            //$this->db->where('quiz_id',$this->input->post('quiz_id'));
            //$query = $this->db->update('tbl_advertiser_quiz_budget',$budget);
            $this->db->where('user_id',$profile_id);
            $query = $this->db->update('tbl_quiz_budgets',$budget);



            if($quiz_views<$cpc){
                $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("NO_VIEWS");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

           // @mail($owner_email,$subject,$emailbody,$headers);
            }
            if($quiz_views<5)
            {
                $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            //$email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("LOW_VIEWS");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

           // @mail($owner_email,$subject,$emailbody,$headers);
            }
        }
    }

    function set_ads_click($banner_id,$type) {        
        $profile = $this->input->post('profile');
        #$profile = $this->session->userdata('wannaquiz_user_id');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $action = 'click';        
        $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        $sql = "select * from tbl_adv_banners_view_click 
                where banner_id =$banner_id 
                and ip_address = '$ip_address' 
                and ads_type ='$type' 
                and action = '$action' 
                and action_date_time >= '$today'";
        #exit($sql)
        $query = $this->db->query($sql);

        if($query->num_rows()>0){
           return null;
        }

#else if($profile=='') return null;
        
        else {
            $data = array('banner_id'=>$banner_id,
                'ip_address'=>$ip_address,
                'profile_id'=>$profile,
                'user_id'=>$user_id,
                'action'=>$action,
                'ads_type'=>$type,
                'action_date_time'=>$today
            );
            
            $this->db->insert('tbl_adv_banners_view_click', $data);

            $quiz_id = $this->input->post('quiz_id');

            if($quiz_id==''){
                if($type=='long_text'){
                    $table = "tbl_advertiser_long_text_ads";
                    $id='id';
                }
                else if($type == 'short_text'){
                    $table = "tbl_advertiser_short_text_ads";
                    $id='id';
                }
                else{
                    $table = "tbl_advertiser_banner_ads";
                    $id='banner_id';
                }

                $this->db->where($id,$banner_id);
                $query = $this->db->get($table);

                if($query->num_rows()>0)
                $data_result = $query->row();
                $quiz_id = $data_result->quiz_id;
            }

            //echo $quiz_id; exit;
            //$quiz_detail = $this->get_quiz_budget_info_by_cid($quiz_id);
            $quiz_detail = $this->get_quiz_cpc($quiz_id);
            $user_budget = $this->get_user_quiz_budget($profile);            

            $quiz_views = $user_budget->total_budget;
            $remaining_budget = $user_budget->remaining_budget - $quiz_detail->cpc;            
            #$left_views = $quiz_views-$cpc;exit($left);

            $owner_info = $this->Member_model->get_owner_info($quiz_id);

            if($owner_info->user_id == $user_id) exit;

            $owner_username  = $owner_info->username;
            $owner_email = $owner_info->email;

            if($remaining_budget<$quiz_detail->cpc) $status ='0';
            else $status = '1';
            
            $budget = array
            (
                'remaining_budget'=>$remaining_budget,
                'budget_status'=>$status
            );

            //$this->db->where('quiz_id',$this->input->post('quiz_id'));
            //$query = $this->db->update('tbl_advertiser_quiz_budget',$budget);
            $this->db->where('user_id',$profile);
            $query = $this->db->update('tbl_quiz_budgets',$budget);

            if($remaining_budget<$quiz_detail->cpc)
            {                
            $site_info=$this->Site_setting_model->get_site_info(1);
            
            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = $site_info->site_email;
            $template=$this->Email_model->get_email_template("NO_VIEWS");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($owner_email,$subject,$emailbody,$headers);
            }
            if(($remaining_budget < ($quiz_detail->cpc*5))) # if there are less than five views/clicks remaining
            {
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

    function set_track_click($type){
        $banner_id= $this->input->post('banner_id');
        $profile_id = $this->input->post('profile_id');
        $user_id = $profile_id;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $action = 'click';
        $date = current_date_time_stamp();
        $today = strtotime(date("Y-m-d H:i:s",mktime(0, 0, 0)));
        $sql = "select * from tbl_adv_banners_view_click where banner_id ='$banner_id' and ip_address = '$ip_address' and ads_type ='$type' and action = '$action' and action_date_time > '$today'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
           return null;
        }

        else {
        $data=array(
                'banner_id'=>$banner_id,
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'user_id'=>$this->session->userdata('wannaquiz_user_id'),
                'action'=>"click",
                'ads_type'=>$type,
                'action_date_time'=>current_date_time_stamp()
            );
            $this->db->insert('tbl_adv_banners_view_click',$data);


                $this->db->where('id',$banner_id);
                $query = $this->db->get('tbl_advertiser_short_text_ads');
                if($query->num_rows()>0)
                $data_result = $query->row();
                $quiz_id = $data_result->quiz_id;

            $quiz_detail = $this->get_quiz_cpc($quiz_id);
            $user_budget = $this->get_user_quiz_budget($user_id);
            $cpc = $quiz_detail->cpc;
            $quiz_views = $user_budget->total_budget;
            $remaining_budget = $user_budget->remaining_budget - $cpc;          
            //get_playlist$left_views = $quiz_views-$cpc;

            $owner_info = $this->Member_model->get_owner_info($quiz_id);
            $owner_username  = $owner_info->username;
            $owner_email = $owner_info->email;
            if($remaining_budget<$cpc)
            {
                $status ='0';
            }

            else $status = '1';
            $budget = array(
                'remaining_budget'=>$remaining_budget,
                'budget_status'=>$status
            );
            //print_r($budget);
            //$this->db->where('quiz_id',$this->input->post('quiz_id'));
            //$query = $this->db->update('tbl_advertiser_quiz_budget',$budget);
            $this->db->where('user_id',$user_id);
            $query = $this->db->update('tbl_quiz_budgets',$budget);

            if($quiz_views<$cpc){
                $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            $email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("NO_VIEWS");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

           // @mail($owner_email,$subject,$emailbody,$headers);
            }
            if($quiz_views<5)
            {
                $site_info=$this->Site_setting_model->get_site_info(1);

            $headers= "From: wannaquiz.com <noreply@wannaquiz.com>\x0d\x0a";
            $headers .= "MIME-Version: 1.0\x0d\x0a";
            $headers .= "Content-type: text/html; charset=iso-8859-1\x0d\x0a";
            //$email = 'siran_majan@hotmail.com';//$site_info->site_email;
            $template=$this->Email_model->get_email_template("LOW_VIEWS");

            $subject=$template->template_subject;
            $emailbody=$template->template_design;

            $comment_link="<a href='".site_url(ADMIN_PATH.'/comment_spam')."'>".$comment."</a>";

            $parseElement=array("USERNAME"=>$owner_username,"SITENAME"=>$site_info->site_name,"CURRENT_DATE"=>gmdate('Y-m-d'),"EMAIL"=>$site_info->site_email,"QUIZES"=>$owner_info->quiz_question);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

           // @mail($owner_email,$subject,$emailbody,$headers);
            }
        }
    }

    function set_quiz_click($id) {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $date = current_date_time_stamp();
        $sql = "select * from tbl_quiz_view_click where quiz_id ='$id' and user_id = '$user_id' and click ='1' ";
        $query = $this->db->query($sql);        
        if($query->num_rows()>0)
            return null;
        else {
            $data = array('quiz_id'=>$id,
                'ip_address'=>$ip_address,
                'user_id'=>$user_id,
                'click'=>1,
                'view'=>0,
                'date'=>$date
            );
            $this->db->insert('tbl_quiz_view_click', $data);

            $quiz_detail = $this->get_quiz_info_by_cid($id);
            $cpc = $quiz_detail->cpc;
            $quiz_views = $quiz_detail->total_budget;
            $left_views = $quiz_views-$cpc;
            $credits = array('quiz_views'=>$left_views);
            $this->db->where('quiz_id',$id);
            $query = $this->db->update('tbl_quizes',$credits);
        }
    }

    function get_banner_report($date1=0,$date2=0) { //echo $date1.'/'.$date2;
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select tb.*,vc.* from tbl_advertiser_banner_ads tb, tbl_adv_banners_view_click vc where tb.banner_id=vc.banner_id and vc.ads_type='banner' and tb.advertiser_id = '$user_id' and tb.quiz_id!='0' and vc.action_date_time between '$date1' and '$date2'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_text_report($date1=0,$date2=0) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        //        if($date1=='' && $date2=='')
        //        $sql = "select tt.*,vc.* from tbl_advertiser_long_text_ads tt, tbl_adv_banners_view_click vc where tt.id=vc.banner_id and vc.ads_type='long_text' and tt.advertiser_id = '$user_id' ";
        //        else
        $sql = "select tt.*,vc.* from tbl_advertiser_long_text_ads tt, tbl_adv_banners_view_click vc where tt.id=vc.banner_id and vc.ads_type='long_text' and tt.advertiser_id = '$user_id' and vc.action_date_time between '$date1' and '$date2'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_text_flash_report($date1=0,$date2=0) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select tf.*,vc.* from tbl_advertiser_short_text_ads tf, tbl_adv_banners_view_click vc where tf.id=vc.banner_id and vc.ads_type='short_text' and tf.advertiser_id = '$user_id' and vc.action_date_time between '$date1' and '$date2'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_profile_report($date1=0,$date2=0) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        //        if($date1=='' && $date2=='')
        //        $sql = "select tt.*,vc.* from tbl_advertiser_long_text_ads tt, tbl_adv_banners_view_click vc where tt.id=vc.banner_id and vc.ads_type='long_text' and tt.advertiser_id = '$user_id' ";
        //        else
        $sql = "select vc.* from tbl_adv_banners_view_click vc where vc.ads_type='profile' and vc.profile_id = '$user_id' and vc.action_date_time between '$date1' and '$date2'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_cpc($id) { //echo $id;exit;
        $sql = "select q.category_id,c.cpc from tbl_quizes q, tbl_categories c where q.quiz_id = '$id' and q.category_id = c.id";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if($query->num_rows()>0) {
            $data = $query->row();
            return $data->cpc;
        }
        else return null;
    }

    function get_quiz_info_by_cid($id) {
        $sql = "select * from tbl_quizes q, tbl_categories c where q.quiz_id = '$id' and q.category_id = c.id";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $data = $query->row();
            return $data;
        }
        else return null;
    }

    function get_quiz_budget_info_by_cid($id) {
        $sql = "select * from tbl_quizes q, tbl_categories c,tbl_advertiser_quiz_budget qb where q.quiz_id = '$id' and q.category_id = c.id and q.quiz_id=qb.quiz_id";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $data = $query->row();
            return $data;
        }
        else return null;
    }

    function get_user_quiz_budget($uid){
        $this->db->where('user_id',$uid);
        $query = $this->db->get('tbl_quiz_budgets');        
        if($query->num_rows()>0)
        return $query->row();
        else return false;
    }

    function get_quiz_cpc($id){
        $sql = "select * from tbl_quizes q, tbl_categories c where q.quiz_id = '$id' and q.category_id = c.id ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $data = $query->row();
            return $data;
        }
        else return null;
    }

    function addTempQuizVideoQuestion($filename,$tmp_id) {
        $temp_quiz_id = $tmp_id;
        //        if(isset($this->session->userdata('temp_quiz_id')))
        //        {
        //            $temp_quiz_id = $this->session->userdata('temp_quiz_id');
        //        }
        $sql = "select * from tbl_temp_quiz_videos where temp_quiz_id ='$temp_quiz_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $quiz_videos = array('quiz_videos'=>$filename);
            $this->db->where('temp_quiz_id',$temp_quiz_id);
            $this->db->update('tbl_temp_quiz_videos',$quiz_videos);
            $id = $temp_quiz_id;

        }
        else {
            $data = array('quiz_videos'=>$filename);
            $this->db->insert('tbl_temp_quiz_videos',$data);
            $id = $this->db->insert_id();
            $data1 = array('temp_quiz_id'=>$id);
            $this->db->where('id',$id);
            $this->db->update('tbl_temp_quiz_videos',$data1);
        }
    	 $this->session->set_userdata('temp_quiz_id',$id);
		$this->db->where('id',$id);
        $data = $this->db->get('tbl_temp_quiz_videos');
        return $data->row();
    }

    function addTempQuizVideoAnswer($filename,$tmp_id) {
		if($this->session->userdata('temp_quiz_id')=='')
		 	$temp_quiz_id = $tmp_id;
		else
			 $temp_quiz_id = $this->session->userdata('temp_quiz_id');
        //        if(isset($this->session->userdata('temp_quiz_id')))
        //        {
        //            $temp_quiz_id = $this->session->userdata('temp_quiz_id');
        //        }
        $sql = "select * from tbl_temp_quiz_videos where temp_quiz_id ='$temp_quiz_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $video_answer = array('video_answer'=>$filename);
            $this->db->where('temp_quiz_id',$temp_quiz_id);
            $this->db->update('tbl_temp_quiz_videos',$video_answer);
            $id = $temp_quiz_id;

        }
        else {

            $data = array('video_answer'=>$filename);
            $this->db->insert('tbl_temp_quiz_videos',$data);
            $id = $this->db->insert_id();
            $data1 = array('temp_quiz_id'=>$id);
            $this->db->where('id',$id);
            $this->db->update('tbl_temp_quiz_videos',$data1);
        }
        $this->session->set_userdata('temp_quiz_id',$id);
        $this->db->where('id',$id);
        $data = $this->db->get('tbl_temp_quiz_videos');
        return $data->row();

       /* $data = array('video_answer'=>$filename);

        $this->db->select_max('id');
        $query = $this->db->get('tbl_temp_quiz_videos');
        $row = $query->row();
        $id = $row->id;
        $this->db->where('id',$id);
        $this->db->update('tbl_temp_quiz_videos',$data);

        $this->db->where('id',$id);
        $data = $this->db->get('tbl_temp_quiz_videos');
        return $data->row();*/
    }

    function get_recently_played_quizes($uid) {
        $sql = "select a.answered_date,a.user_id,a.quiz_type,a.category_id,a.quiz_id,a.quiz_question,a.user_type,a.username,a.images,a.name from
                ((select q.user_id,q.quiz_type,q.category_id,q.user_type,qa.quiz_id,qa.answered_date,q.quiz_question,m.username,qi.images,0,c.name from
                    tbl_quiz_answers qa, tbl_quizes q,tbl_members m, tbl_quiz_images qi,tbl_categories c
                    where qa.quiz_id = q.quiz_id and q.user_id=m.user_id and qa.quiz_id=qi.quiz_id and q.category_id=c.id and qa.user_id =?
                    group by qa.quiz_id )
                    UNION ALL
                    (select q.user_id,q.quiz_type,q.category_id,q.user_type,qa.quiz_id,qa.answered_date,q.quiz_question,m.username,qv.quiz_videos,qv.video_answer,c.name from
                    tbl_quiz_answers qa, tbl_quizes q,tbl_members m, tbl_quiz_videos qv,tbl_categories c
                    where qa.quiz_id = q.quiz_id and q.user_id=m.user_id and qa.quiz_id=qv.quiz_id and q.category_id=c.id and qa.user_id =?
                    group by qa.quiz_id )) a order by a.answered_date DESC limit 2";
        $query = $this->db->query($sql, array($uid,$uid));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
        //print_r($query->result());
            return $query->result();
        else return null;
    }

    function get_unplayed_quizes($uid) {
    //  $sql = "select q.user_id,q.category_id,q.quiz_id,q.quiz_question,m.username,qi.images,c.name from tbl_quiz_answers qa, tbl_quizes q,tbl_members m, tbl_quiz_images qi,tbl_categories c where qa.quiz_id != q.quiz_id and q.user_id=m.user_id and q.quiz_id=qi.quiz_id and q.category_id=c.id and qa.user_id =?";
    //  $sql = "select q.user_id,q.category_id,q.quiz_id,q.quiz_question,m.username,qi.images,c.name from tbl_quizes q left outer join tbl_quiz_answers qa on q.quiz_id=qa.quiz_id and q.user_id='$uid' join tbl_members m on q.user_id=m.user_id join tbl_quiz_images qi on q.quiz_id=qi.quiz_id join tbl_categories c on q.category_id=c.id";
    //$sql = "select * From (Select q.user_id, q.category_id,q.quiz_id,q.quiz_question,m.username,qi.images,c.name from tbl_quizes q left join tbl_quiz_images qi on q.quiz_id=qi.quiz_id join tbl_members m on q.user_id=m.user_id join tbl_categories c on q.category_id=c.id ) b left outer join tbl_quiz_answers s on s.quiz_id!=b.quiz_id where b.user_id=?";
        $sql = "select a.user_id,a.quiz_type,a.status,a.category_id,a.quiz_id,a.quiz_question,a.user_type,a.username,a.images,a.name from
                ((select q.*,m.username,qi.images,0,c.name from
                    tbl_quizes q, (select quiz_id from tbl_quizes where quiz_id NOT IN
                    (select quiz_id from tbl_quiz_answers where user_id='$uid') ) a, tbl_members m,tbl_quiz_images qi,tbl_categories c
                    where q.quiz_id=a.quiz_id and q.user_id=m.user_id and q.quiz_id = qi.quiz_id and q. category_id = c.id and q.status='1' and q.user_type='regular' and q.try_new_quiz='1')
                    UNION ALL
                    (select q.*,m.username,qv.quiz_videos,qv.video_answer,c.name from
                    tbl_quizes q,(select quiz_id from tbl_quizes where quiz_id NOT IN
                    (select quiz_id from tbl_quiz_answers where user_id='$uid') ) a, tbl_members m,tbl_quiz_videos qv,tbl_categories c where
                    q.quiz_id=a.quiz_id and q.user_id=m.user_id and q.quiz_id = qv.quiz_id and q. category_id = c.id and q.user_type='regular' and q.try_new_quiz='1')
                    UNION ALL
                    (select q.*,m.username,qi.images,0,c.name from
                    tbl_quizes q,(select quiz_id from tbl_quizes where quiz_id NOT IN
                    (select quiz_id from tbl_quiz_answers where user_id='$uid') ) a, tbl_members m,tbl_quiz_images qi,tbl_categories c,tbl_quiz_budgets qb where
                    q.quiz_id=a.quiz_id and q.user_id=m.user_id and q.quiz_id = qi.quiz_id and q. category_id = c.id and q.user_id=qb.user_id and q.status='1' and qb.budget_status='1' and q.user_type='advertiser' and q.try_new_quiz='1')
                    UNION ALL
                    (select q.*,m.username,qv.quiz_videos,qv.video_answer,c.name from
                    tbl_quizes q,(select quiz_id from tbl_quizes where
                    quiz_id NOT IN (select quiz_id from tbl_quiz_answers where user_id='$uid') ) a, tbl_members m,tbl_quiz_videos qv,tbl_categories c,tbl_quiz_budgets qb where
                    q.quiz_id=a.quiz_id and q.user_id=m.user_id and q.quiz_id = qv.quiz_id and q. category_id = c.id and q.user_id=qb.user_id and q.status ='1' and qb.budget_status='1' and q.user_type='advertiser' and q.try_new_quiz='1')) a
                    order by modified_date desc limit 5";
        $query = $this->db->query($sql, array($uid));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_category_cpc($cid) {
        $this->db->where('id',$cid);
        $query = $this->db->get('tbl_categories');
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_quiz_info_by_qid($qid) {

        $sql="SELECT * FROM tbl_quizes q,tbl_quiz_options qo where q.quiz_id=qo.quiz_id AND q.quiz_id='$qid'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_quiz_image_by_qid($qid) {
        $sql="SELECT images FROM tbl_quiz_images where quiz_id='$qid'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_quiz_answerimage_by_qid($id) {

        $sql="SELECT photo_name,user_id FROM tbl_members_photos where photo_id='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_quiz_budget($qid) {
        $this->db->where('quiz_id',$qid);
        $query =$this->db->get('tbl_advertiser_quiz_budget');
        return($query->row());
    }

    function get_advertisement_info($table,$qid) {
        $this->db->where('quiz_id',$qid);
        $query = $this->db->get($table);
        return($query->result());
    }

    function get_quiz_by_user_category($uid,$id) { //echo $uid.'/'.$cid.'/**';
//        if($sid=='')
//        $array = $cid;
//        else{
//            $array = array($sid,$cid);
//            $array = implode(",",$array);
            //echo $array.'/';
        //}
      $array = $id; //exit;
        $sql="select a.quiz_type,a.images,a.username,a.quiz_id,a.quiz_question,a.posted_date from
                ((Select q.quiz_id,q.quiz_question,q.quiz_type,q.posted_date,'1',qm.images,m.username,0 FROM
                    tbl_quizes q, tbl_quiz_images qm,tbl_members m
                    where q.user_id=m.user_id and q.quiz_id=qm.quiz_id and q.user_id=? and q.category_id in($array) and q.user_type='regular' and q.status='1')
                UNION ALL
                (Select q.quiz_id,q.quiz_question,q.quiz_type,q.posted_date,'1',qm.images,m.username, qb.budget_status FROM
                    tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_quiz_budgets qb
                    where q.user_id=m.user_id and q.user_id=qb.user_id and q.quiz_id=qm.quiz_id and q.user_id=? and q.category_id in($array) and q.user_type='advertiser' and qb.budget_status='1' and q.status='1')
                UNION ALL
                (Select q.quiz_id,q.quiz_question,q.quiz_type,q.posted_date,qv.video_answer,qv.quiz_videos,m.username,0
                    FROM tbl_quizes q, tbl_quiz_videos qv,tbl_members m
                    where q.user_id=m.user_id and q.quiz_id=qv.quiz_id and q.user_id=? and q.category_id in($array) and q.user_type='regular' and q.status='1')
                UNION ALL
                (Select q.quiz_id,q.quiz_question,q.quiz_type,q.posted_date,qv.video_answer,qv.quiz_videos,m.username, qb.budget_status FROM
                    tbl_quizes q, tbl_quiz_videos qv,tbl_members m,tbl_quiz_budgets qb where
                    q.user_id=m.user_id and q.user_id=qb.user_id and q.quiz_id=qv.quiz_id and q.user_id=? and q.category_id in($array) and q.user_type='advertiser' and qb.budget_status='1' and q.status='1')) a order by a.posted_date desc";
        $query=$this->db->query($sql,array($uid,$uid,$uid,$uid));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->result();
        else
            return NULL;
    }

    function get_quiz_comments($qid,$num,$offset) { //echo $num.'/'.$offset;
        if($num==0 && $offset==0)
            $limit='';
        else
            $limit=" LIMIT $offset,$num";
        $sql = "select qc.*,m.username from tbl_quiz_comments qc,tbl_members m where qc.user_id=m.user_id and qc.comment_reply_id='0'and qc.quiz_id=? and qc.status='1'order by comment_date DESC".$limit;
        $query = $this->db->query($sql,array($qid));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function delete_quiz_comment($comment_id) {
        $this->db->where('comment_id',$comment_id);
        $query = $this->db->delete('tbl_quiz_comments');
        if($query) return true;
        else return false;
    }

    function delete_quiz_comment_reply($comment_reply_id) {
        $this->db->where('comment_reply_id',$comment_reply_id);
        $query = $this->db->delete('tbl_quiz_comments');
        if($query) return true;
        else return false;
    }

    function spam_quiz_comment($comment_id){
        $flag = $this->input->post('flag');
        if($flag=='comment')
        $this->db->where('comment_id',$comment_id);
        else
        $this->db->where('comment_reply_id',$comment_id);
        $query = $this->db->update('tbl_quiz_comments',array('spam'=>'1'));
        if($query) return true;
        else return false;
    }

    function get_spam_quiz_comment($comment_id){
        $this->db->where('comment_id',$comment_id);
        $res = $this->db->get('tbl_quiz_comments');
            if($res->num_rows()>0)
        return $res->row()->comment;
        else return null;
    }

    function count_quiz_comments($qid) {

        $sql = "select * from tbl_quiz_comments where quiz_id=?";
        $query= $this->db->query($sql,array($qid));
        if($query->num_rows()>0)
            return $query->num_rows();
        else return 0;
    }

    function get_quiz_comment_like($comment_id) {
        $sql = "select * from tbl_quiz_comment_likes where comment_id ='$comment_id' and like_status ='1'";
        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    function get_quiz_comment_unlike($comment_id) {
        $sql = "select * from tbl_quiz_comment_likes where comment_id ='$comment_id' and like_status ='0'";
        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    function like_quiz_comment() {
        $comment_id = $this->input->post('comment_id');
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $status = $this->input->post('status');
        $sql ="select * from tbl_quiz_comment_likes where user_id = '$user_id' and comment_id = '$comment_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return 0;
        else {
            $data = array('comment_id'=>$comment_id,
                'user_id'=>$user_id,
                'like_status'=>$status,
                'like_date'=>current_date_time_stamp()
            );
            $insert_data = $this->db->insert('tbl_quiz_comment_likes',$data);
            if($insert_data) return true;
            else return false;
        }
    }

    function quiz_commit() {
        $quiz_id = $this->input->post('quiz_id');
        //$comentator_id = $this->input->post('user_id');
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $comment = $this->input->post('comment');

        $data = array('quiz_id'=>$quiz_id,
            'user_id'=>$user_id,
            'comment'=>$comment,
            'comment_date'=>current_date_time_stamp()
        );
        $insert_data = $this->db->insert('tbl_quiz_comments',$data);
        if($insert_data) return true;
        else return false;
    }

    function get_reply_comments($id) {
        $sql="select m.first_name, m.last_name,  qc.*, md.* from tbl_member_profile m
        join tbl_members md on m.member_id=md.user_id
        join tbl_quiz_comments qc on qc.user_id=md.user_id where qc.comment_reply_id=$id and qc.status='0'";
        
        //$sql = "select * from tbl_quiz_comments qc, tbl_members m where qc.user_id=m.user_id and comment_reply_id=?";
        $query = $this->db->query($sql, array($id));
     //   print_r($query->result());
        if($query->num_rows()>0)
         return $query->result();
        else return null;
    }

    function quiz_reply_commit() {
        $quiz_id = $this->input->post('quiz_id');
        $comment_id = $this->input->post('comment_id');
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $comment = $this->input->post('comment');

        $data = array('quiz_id'=>$quiz_id,
            'comment_reply_id'=>$comment_id,
            'user_id'=>$user_id,
            'comment'=>$comment,
            'comment_date'=>current_date_time_stamp()
        );
        $insert_data = $this->db->insert('tbl_quiz_comments',$data);
        if($insert_data) return true;
        else return false;
    }

    function search_quiz($id,$f='',$lim='',$num='') {              
         $category = $this->input->post('category');
        $search_item = $this->input->post('search');
        #echo $category . '-' . $search_item;
        # from redirection of quiz/view/[\d]
        $a=$search_item;
        $a.="_s";
        $b=$search_item;
        $b.="s";
        if(!$category) $category = '1';
         if(!$search_item) $sitem="q.quiz_question like '% %'";
          else $sitem="q.quiz_question REGEXP '[[:<:]]".$search_item."[[:>:]]' OR q.quiz_question REGEXP '[[:<:]]".$b."[[:>:]]' OR q.quiz_question like'$a' ";
       
             $sql="(Select q.*,qm.images,0,m.username,0,0
                FROM tbl_quizes q ,tbl_quiz_images qm,tbl_members m 
                where q.quiz_id=qm.quiz_id
                and q.user_id=m.user_id
                and q.quiz_type='photo' 
                and ($sitem
                and (q.country_target='' or ( q.country_target!='' and q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
               and (q.state_target='' or ( q.state_target!='' and q.state_target like '%".strtolower($_SESSION['state_target'])."%')) 
                and (q.city_target='' or ( q.city_target!='' and q.city_target like '%".strtolower($_SESSION['city_target'])."%')) 
                ";
        
        #$sql .= "and (q.country_target='' or ( q.country_target!='' and q.country_target like '%".$_SESSION['country_target']."%')) ";#
        #$sql .= "and (q.city_target='' or ( q.city_target!='' and q.city_target like '%".$_SESSION['city_target']."%')) ";
             
#and q.quiz_suitable_for='$category' ";
        
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";        
        
        $sql .= "and q.user_type='regular' and q.status='1') ";
                
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' ) ";

        $sql .= "            
                ) ";

        $sql .= "
                UNION ALL
                (Select q.*,qm.images,0,m.username,c.cpc,qb.budget_status
                    FROM tbl_quizes q
                    left join tbl_quiz_images qm on q.quiz_id=qm.quiz_id 
                    left join tbl_members m on q.user_id=m.user_id
                    left join tbl_categories c on q.category_id=c.id
                    left join tbl_quiz_budgets qb on q.user_id=qb.user_id
                    where qb.budget_status='1'
                    and q.quiz_type='photo'                     
                    and (q.country_target='' or ( q.country_target!='' and q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
                    and (q.state_target='' or ( q.state_target!='' and q.state_target like '%".strtolower($_SESSION['state_target'])."%'))                    
                    and (q.city_target='' or ( q.city_target!='' and q.city_target like '%".strtolower($_SESSION['city_target'])."%'))
                    ";
        
        #if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_views where view_user_id='$id' ) ";
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' ) ";

        $sql .= "and ($sitem and q.quiz_suitable_for='$category') ";
        
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";
        
        $sql .= "and q.user_type='advertiser'
                )
                ORDER BY modified_date DESC";
#exit($sql);
        if($lim!='') 
        {
            if($num=='') $num = 0;
            $sql .= ' LIMIT ' . $num . ',' . $lim;
        }
#exit($sql);
        $query = $this->db->query($sql);
        #echo $this->db->last_query($sql);exit;
        #echo 'count=' . $query->num_rows();
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }
    
    function search_video_quiz($id,$f='',$lim='',$num='') {              
         $category = $this->input->post('category');
        $search_item = $this->input->post('search');
        #echo $category . '-' . $search_item;
        # from redirection of quiz/view/[\d]
         $a=$search_item;
        $a.="_s";
        $b=$search_item;
        $b.="s";
        if(!$category) $category = '1';
        if(!$search_item) $sitem="q.quiz_question like '% %'";
         else $sitem="q.quiz_question REGEXP '[[:<:]]".$search_item."[[:>:]]' OR q.quiz_question REGEXP '[[:<:]]".$b."[[:>:]]' OR q.quiz_question like '$a' ";
            

        $sql="(Select q.*,qm.quiz_videos,0,m.username,0,0
                FROM tbl_quizes q ,tbl_quiz_videos qm,tbl_members m 
                where q.quiz_id=qm.quiz_id
                and q.user_id=m.user_id
                and q.quiz_type='video' 
                and ($sitem
                and (q.country_target='' or ( q.country_target!='' and q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
                and (q.state_target='' or ( q.state_target!='' and q.state_target like '%".strtolower($_SESSION['state_target'])."%')) 
                and (q.city_target='' or ( q.city_target!='' and q.city_target like '%".strtolower($_SESSION['city_target'])."%')) 
                ";
#and q.quiz_suitable_for='$category' ";
        
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";        
        
        $sql .= "and q.user_type='regular' and q.status='1') ";
                
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' ) ";

        $sql .= "            
                ) 
                UNION ALL
                (Select q.*,qm.quiz_videos,0,m.username,c.cpc,qb.budget_status
                    FROM tbl_quizes q
                    left join tbl_quiz_videos qm on q.quiz_id=qm.quiz_id 
                    left join tbl_members m on q.user_id=m.user_id
                    left join tbl_categories c on q.category_id=c.id
                    left join tbl_quiz_budgets qb on q.user_id=qb.user_id
                    where qb.budget_status='1'
                    and q.quiz_type='video' 
                    and (q.country_target='' or ( q.country_target!='' and q.country_target like '%".strtolower($_SESSION['country_target'])."%')) 
                     and (q.state_target='' or ( q.state_target!='' and q.state_target like '%".strtolower($_SESSION['state_target'])."%')) 
                    and (q.city_target='' or ( q.city_target!='' and q.city_target like '%".strtolower($_SESSION['city_target'])."%'))
                   ";
        
        #if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_views where view_user_id='$id' ) ";
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' ) ";

        $sql .= "and ($sitem and q.quiz_suitable_for='$category') ";
        
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";
        
        $sql .= "and q.user_type='advertiser'
                )";
#exit($sql);
        if($lim!='') 
        {
            if($num=='') $num = 0;
            $sql .= ' LIMIT ' . $num . ',' . $lim;
        }
#exit($sql);
        $query = $this->db->query($sql);
        #echo $this->db->last_query($sql);exit;
        #echo 'count=' . $query->num_rows();
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    /*function search_video_quiz($id,$f='') {
        $category = $this->input->post('category');
        $search_item = $this->input->post('search');
        $sql="
                Select q.*,qv.quiz_videos,qv.video_answer,m.username,0,0
                FROM tbl_quizes q
                join tbl_quiz_videos qv on q.quiz_id=qv.quiz_id
                join tbl_members m  on q.user_id=m.user_id
                where 
                (
                q.quiz_question like '%".$search_item."%' ";
#and q.quiz_suitable_for='$category' ";        
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";
        $sql .- ")
                and q.user_type='regular' 
                and q.status='1' 
                and q.quiz_type='video' ";
        
        #if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_views where view_user_id='$id' ) ";
        if($id) $sql .= "and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' ) ";

        $sql .= "
               )
                UNION ALL 
                (Select q.*,qv.quiz_videos,qv.video_answer,m.username,c.cpc,qb.budget_status
                FROM tbl_quizes q,tbl_quiz_videos qv,tbl_members m,tbl_categories c,tbl_quiz_budgets qb
                where q.quiz_id=qv.quiz_id
                and q.user_id=m.user_id
                and (q.quiz_question like '%".$search_item."%' ";
#and q.quiz_suitable_for='$category' ";
        if($f) $sql .= "and q.quiz_suitable_for!=3 ";        
        $sql .= ")
                and q.user_type='advertiser'
                and q.category_id=c.id
                and q.user_id=qb.user_id
                and qb.budget_status='1'
                and q.quiz_type='video'                
                and q.quiz_id not in ( select quiz_id from tbl_quiz_answers where user_id='$id' )) 
                ORDER BY modified_date DESC";
#and q.quiz_id not in ( select quiz_id from tbl_quiz_views where view_user_id='$id' ))";
                
        $query = $this->db->query($sql);
        echo $this->db->last_query();exit;
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }*/ 

    function search_by_category($level,$category_id,$subcategory,$user_type='') {
       //echo $this->session->userdata('game_mode');
       
        if($this->session->userdata('game_mode')=='' || $this->session->userdata('game_mode')=='single'){
        $user_id =  $this->session->userdata('wannaquiz_user_id');
       // echo $user_id;
       // echo $category_id;
         $sql2 =  "select m.user_id from tbl_members m where user_type='$user_type'";
             $query = $this->db->query($sql2);
             $result = $query->result();
             //echo $this->db->last_query();
             $user_ids=array();
             foreach($result as $res){
                    $user_ids[] = $res->user_id;
             }
             $user_idss = implode(",",$user_ids);
     
            if($subcategory=='0' OR $subcategory==''){
            $sql1 =  "Select c.id FROM tbl_categories c where c.parent_id='$category_id'";
             $query = $this->db->query($sql1);
             $result = $query->result();
             //echo $this->db->last_query();
             $a=array();
             foreach($result as $res){
                    $a[] = $res->id;
             }
             $value = implode(",",$a);
             if($value != ''){
            $sql = "SELECT a.quiz_id FROM (SELECT quiz_id,user_id FROM  tbl_quizes 
                 WHERE category_id IN ($value,$category_id) 
                 AND quiz_level='$level' 
                 AND status='1'
                   "; 
             if($user_id)
                 $sql.=" AND quiz_id NOT IN
                 (SELECT QUIZ_ID 
                 FROM tbl_quiz_answers
                 WHERE user_id = '$user_id') ";
            
            $sql .= " AND user_id IN ($user_idss)"; 
            if($user_id) $sql.=" AND user_id NOT IN ($user_id)"; 
                $sql.=" order by rand()) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1'  LIMIT 1";
             }else{
                    $sql = "SELECT a.quiz_id FROM (SELECT quiz_id, user_id 
                            FROM tbl_quizes 
                            WHERE category_id IN ($category_id) 
                             AND quiz_level='$level' AND status='1' 
                            ";
                    if($user_id) $sql .= "
                            AND a.quiz_id NOT IN
                            (SELECT QUIZ_ID FROM tbl_quiz_answers WHERE user_id = '$user_id') ";
                    $sql .= " AND user_id IN ($user_idss)"; 
                    if($user_id) $sql.=" AND user_id NOT IN ($user_id)) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
                   else $sql.=" order by rand()) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
                 }
                         //echo $sql;
	        	}
        else if($subcategory!='0' && $subcategory!=''){
            
            $sql = "SELECT a.quiz_id FROM (SELECT quiz_id, user_id FROM tbl_quizes 
                    WHERE category_id IN ($subcategory) 
                    AND quiz_level='$level' AND status='1'
                       ";
            if($user_id) $sql .= "
                     AND quiz_id NOT IN
                    (SELECT QUIZ_ID FROM tbl_quiz_answers 
                    WHERE user_id = '$user_id') ";
              $sql .= "AND user_id IN ($user_idss)";
           if($user_id) $sql.=" AND user_id NOT IN ($user_id))a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1"; 
               else $sql.=" order by rand()) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
        }
       // echo $sql;
        $query = $this->db->query($sql);
   //  echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->row();
//        else return false;
        }
      else {
      return $this->getRandomQuizForMultiplayer($level, $category_id,$subcategory,$user_type);
       }  
      // echo $this->db->last_query();
        
    }

    function add_favourites() {
       
        $quiz_id = $this->input->post(quiz_id);
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $option = array('quiz_id'=>$quiz_id,
            'user_id'=>$user_id);
        $query = $this->db->getwhere('tbl_quiz_favourites',$option);
        if($query->num_rows()>0)
            return '2';
        else {
            $data = array('quiz_id'=>$quiz_id,
                'user_id'=>$user_id,
                'favourites'=>1,
                'date'=>current_date_time_stamp()
            );
             $insert_data=$this->db->insert('tbl_quiz_favourites',$data);
            if($insert_data) return '1';
            else  return false;
        }

    }
     function get_playlists($user_id) {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_playlist');
        if($query->num_rows()>0) {
            return $query->result();
        }
        else return null;
    }
    function get_playlist($user_id) {
        $sql="select p.*, q.* from tbl_playlist p join tbl_quiz_playlist q on p.id=q.playlist_id where p.user_id=? group by p.playlist_title";
        $query = $this->db->query($sql,array($user_id));
        
        if($query->num_rows()>0) {
            return $query->result();
        }
        else return null;
    }

     function add_playlist() {
        $user_id = $this->input->post('id');
        $quiz_id = $this->input->post('quiz_id');
        $playlist_title = $this->input->post('playlist');

        $option = array('user_id'=>$user_id,
            'playlist_title'=>$playlist_title);
        $query = $this->db->getwhere('tbl_playlist',$option);
        if($query->num_rows()>0) { //echo "test"; exit;
            $playlist = $query->row();
            //echo $playlist->id;
            $option1 = array('user_id'=>$user_id,'quiz_id'=>$quiz_id,'playlist_id'=>$playlist->id);
            $query1 = $this->db->getwhere('tbl_quiz_playlist',$option1);
            if($query1->num_rows()>0)
            return '2';
            else {
            $data1 = array('quiz_id'=>$quiz_id,
                'user_id'=>$user_id,
                'playlist_id'=>$playlist->id);
            $this->db->insert('tbl_quiz_playlist',$data1);
            return '1';
            }
        }

        else {
            $data = array('user_id'=>$user_id,
                'playlist_title'=>$playlist_title
            );
            $this->db->insert('tbl_playlist',$data);
            $id = $this->db->insert_id();
            $data2 = array('quiz_id'=>$quiz_id,
                'user_id'=>$user_id,
                'playlist_id'=>$id
            );
            $this->db->insert('tbl_quiz_playlist',$data2);
            return '1';
        }
    }

    function edit_playlist() {
        $user_id = $this->input->post('id');
        $quiz_id = $this->input->post('quiz_id');
        $playlist_title = $this->input->post('playlist');

        $option = array('user_id'=>$user_id,
            'playlist_title'=>$playlist_title);
        $query = $this->db->getwhere('tbl_playlist',$option);
        if($query->num_rows()>0) { //echo "test"; exit;
            $playlist = $query->row();
            $option1 = array('quiz_id'=>$quiz_id,
                'user_id'=>$user_id);
            $data1 = array('playlist_id'=>$playlist->id);
            $this->db->where($option1);
            $this->db->update('tbl_quiz_playlist',$data1);
        }

        else {
            $data = array('user_id'=>$user_id,
                'playlist_title'=>$playlist_title
            );
            $this->db->insert('tbl_playlist',$data);
            $id = $this->db->insert_id();
            $option2 = array('quiz_id'=>$quiz_id,
                'user_id'=>$user_id
            );
            $data2 = array('playlist_id'=>$id);
            $this->db->where($option2);
            $this->db->update('tbl_quiz_playlist',$data2);
        }
    }

    function get_quizes_from_playlist($user_id,$playlist_id,$num,$offset) {
        if($num==0 && $offset==0)
            $limit='';
        else
            $limit=" LIMIT $offset,$num";
        //$user_id = $this->session->userdata('wannaquiz_user_id');
        if($playlist_id=='')
        $sql = "(Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qm.images,0,m.username,0 FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_images qm,tbl_members m where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qm.quiz_id and qp.user_id='$user_id' and q.user_type='regular' and q.status='1' group by qp.quiz_id )
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qm.images,0,m.username, qb.budget_status FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_advertiser_quiz_budget qb where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qb.quiz_id and qp.quiz_id=qm.quiz_id and qp.user_id='$user_id' and q.user_type='advertiser' and qb.budget_status='1' and q.status='1' group by qp.quiz_id)
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qv.quiz_videos,qv.video_answer,m.username,0 FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_videos qv,tbl_members m where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qv.quiz_id and qp.user_id='$user_id' and q.user_type='regular' and q.status='1' group by qp.quiz_id)
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qv.quiz_videos,qv.video_answer,m.username, qb.budget_status FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_videos qv,tbl_members m,tbl_advertiser_quiz_budget qb where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qb.quiz_id and qp.quiz_id=qv.quiz_id and qp.user_id='$user_id' and q.user_type='advertiser' and qb.budget_status='1' and q.status='1' group by qp.quiz_id)  $limit";
            //$sql = "select * from tbl_quiz_playlist qp,tbl_quizes q, tbl_ where user_id='$user_id'".$limit;
        else
        $sql = "(Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qm.images,0,m.username,0 FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_images qm,tbl_members m where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qm.quiz_id and qp.user_id='$user_id' and qp.playlist_id='$playlist_id' and q.user_type='regular' and q.status='1' group by qp.quiz_id)
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qm.images,0,m.username, qb.budget_status FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_images qm,tbl_members m,tbl_advertiser_quiz_budget qb where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qb.quiz_id and qp.quiz_id=qm.quiz_id and qp.user_id='$user_id' and qp.playlist_id='$playlist_id' and q.user_type='advertiser' and qb.budget_status='1' and q.status='1' group by qp.quiz_id)
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qv.quiz_videos,qv.video_answer,m.username,0 FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_videos qv,tbl_members m where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qv.quiz_id and qp.user_id='$user_id' and qp.playlist_id='$playlist_id' and q.user_type='regular' and q.status='1' group by qp.quiz_id)
                UNION ALL
                (Select qp.quiz_id,qp.user_id,qp.playlist_id,q.quiz_question,q.quiz_type,qv.quiz_videos,qv.video_answer,m.username, qb.budget_status FROM tbl_quiz_playlist qp, tbl_quizes q, tbl_quiz_videos qv,tbl_members m,tbl_advertiser_quiz_budget qb where qp.quiz_id = q.quiz_id and q.user_id=m.user_id and qp.quiz_id=qb.quiz_id and qp.quiz_id=qv.quiz_id and qp.user_id='$user_id' and qp.playlist_id='$playlist_id' and q.user_type='advertiser' and qb.budget_status='1' and q.status='1' group by qp.quiz_id) $limit";
            //$sql = "select * from tbl_quiz_playlist where user_id='$user_id' and playlist_id='$playlist_id'".$limit;
        $query = $this->db->query($sql);

       // echo $this->db->last_query($sql);
        if($query->num_rows()>0) {
            return $query->result();
        }
        else return null;
    }

    function get_favourite_quizes($user_id,$num,$offset) {
        if($num==0 && $offset==0)
            $limit='';
        else
            $limit=" LIMIT $offset,$num";
        $user_id = $this->session->userdata('wannaquiz_user_id');
            $sql = "select * from tbl_quiz_favourites where user_id='$user_id' and favourites='1'".$limit;
        $query = $this->db->query($sql);

        // echo $this->db->last_query();
        if($query->num_rows()>0) {
            return $query->result();
        }
        else return null;
    }

    function get_quiz_detail_by_id($qid) {
        $sql="(Select q.quiz_id,q.quiz_question,q.quiz_type,qm.images,0,mp.first_name,mp.last_name,m.username,m.user_id FROM tbl_quizes q, tbl_quiz_images qm,tbl_member_profile mp,tbl_members m where q.user_id=mp.member_id and q.quiz_id=qm.quiz_id and q.user_id=m.user_id and q.quiz_id=? and q.status='1')
                 UNION ALL
                (Select q.quiz_id,q.quiz_question,q.quiz_type,qv.quiz_videos,qv.video_answer,mp.first_name,mp.last_name, m.username,m.user_id FROM tbl_quizes q, tbl_quiz_videos qv,tbl_member_profile mp, tbl_members m where q.user_id=mp.member_id and q.quiz_id=qv.quiz_id and q.user_id=m.user_id and q.quiz_id=? and q.status='1')";
        $query = $this->db->query($sql,array($qid,$qid));
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_subcategory($cid) {
        $sql = "select * from tbl_categories where parent_id='$cid'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            return $data = $query->result();
        //return $data->name;
        }
        else return null;
    }

    function get_quiz_stat($uid) {
        $sql = "select f.id, f.name as name,count(g.parent_id) as total from tbl_categories f,tbl_quiz_answers qa,
                    (SELECT q.quiz_id,c.parent_id
                    FROM tbl_quizes q,tbl_categories c
                    where c.id=q.category_id AND
                    c.parent_id
                    IN(select id from tbl_categories where parent_id=0)
                    Union
                    SELECT q.quiz_id,q.category_id
                    FROM tbl_quizes q,tbl_categories c
                    where
                    c.id=q.category_id AND c.parent_id=0
                    ) g where g.parent_id=f.id AND g.quiz_id=qa.quiz_id AND qa.user_id=? group by g.parent_id";
        $query = $this->db->query($sql,array($uid));
        if($query->num_rows()>0)
            return $query->result();
        else
            return null;
    }

    function best_category($user_id) {
        $sql = "select f.name as name,sum(qa.points) as total from tbl_categories f,tbl_quiz_answers qa,
                (SELECT q.quiz_id,c.parent_id
                FROM tbl_quizes q,tbl_categories c
                where c.id=q.category_id AND
                c.parent_id
                IN(select id from tbl_categories where parent_id=0)
                Union
                SELECT q.quiz_id,q.category_id
                FROM tbl_quizes q,tbl_categories c
                where
                c.id=q.category_id AND c.parent_id=0
                ) g where g.parent_id=f.id AND g.quiz_id=qa.quiz_id AND qa.user_id=? group by g.parent_id order by total desc";
        $query = $this->db->query($sql, array($user_id));
        if($query->num_rows()>0)
            return $query->row();
        else return null;

    }

    function get_score_badges($level) {
        $this->db->where('quiz_type',$level);
        $query = $this->db->get('tbl_score_and_badge');
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function set_levels($user_id) {//echo $user_id;exit;
        $hard_score = $this->get_score_badges('hard');
        $avg_score = $this->get_score_badges('average');
        $total_hard_points = $this->get_quiz_points('2',$user_id);
        $total_avg_points = $this->get_quiz_points('1',$user_id);

        //print_r($hard_score);

        if(count($hard_score)>0) {
            foreach($hard_score as $hardScores) {
                $lv=$this->get_levels($user_id,$hardScores->id);

                //                  if($lv>0){
                //
                //                      if($total_hard_points->q_points >= $hardScores->threshold_score) {
                //                            $data = array('badge_id'=>$hardScores->id);
                //                            $this->db->where('user_id',$user_id);
                //                            $this->db->where('badge_id',$hardScores->id);
                //                            $this->db->update('tbl_levels',$data);
                //
                //                        }
                //                  }
                if(count($lv)<1) {
                    if($total_hard_points->q_points >= $hardScores->threshold_score) {
                        $data = array('user_id'=>$user_id,
                            'badge_id'=>$hardScores->id
                        );
                        $this->db->insert('tbl_levels',$data);
                    }
                }

            }
        }
        if(count($avg_score)>0) {
            foreach($avg_score as $avgScores) {
                $level1 = $this->get_levels($user_id,$avgScores->id);
                //                    if($level1 > 0) {
                //                        if($total_avg_points->q_points >= $avgScores->threshold_score) {
                //                            $data = array('badge_id'=>$avgScores->id);
                //                            $this->db->where('user_id',$user_id);
                //                            $this->db->update('tbl_levels',$data);
                //                        }
                //
                //                    }
                if(count($level1)<1) {//echo 'test';
                    if($total_avg_points->q_points >= $avgScores->threshold_score) {
                        $data = array('user_id'=>$user_id,
                            'badge_id'=>$avgScores->id
                        );
                        $this->db->insert('tbl_levels',$data);
                    }
                }
            }
        }
    }

    function get_quiz_points($level,$user_id) {
        $sql = "select q.quiz_level,sum(qa.points) as q_points from tbl_quiz_answers qa,tbl_quizes q where q.quiz_id=qa.quiz_id and q.quiz_level='$level' and qa.user_id=? and answer_status=1 ";
        $query = $this->db->query($sql, array($user_id));
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function set_user_position($user_id) { //echo $user_id;
        $total_hard_points = $this->get_quiz_points('3',$user_id);
        $total_avg_points = $this->get_quiz_points('2',$user_id);
        $total_points = $total_hard_points->q_points+$total_avg_points->q_points;
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_position');
        //$total_points = $query->row()->total_points;
        if($query->num_rows()>0) {
            $data = array('current_points'=>$total_points,'total_points'=>($total_points+$query->row()->bonus_points));
            $this->db->where('user_id',$user_id);
            $this->db->update('tbl_position',$data);
        }
        else {
            $data1 = array('user_id'=>$user_id,
                'current_points'=>$total_points,
                'total_points'=>($total_points+$query->row()->bonus_points),
                'date'=>current_date_time_stamp()
            );
            $this->db->insert('tbl_position',$data1);
        }

        $this->set_position();

    }

    function set_position() {
        $sql = "select * from tbl_position order by total_points desc";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $result = $query->result();
            $i=0;
            foreach($result as $data) {
                $users = $data->user_id;
                //for($i=0;$i<count($users);$i++) {
                    $position = array('position'=>$i+1);
                    $this->db->where('user_id',$users);
                    $this->db->update('tbl_position',$position);
                //}
                $i++;
            }
        }
    }

    function get_user_position($user_id) {
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_position');
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_levels($user_id,$badge=0) {//echo $badge;
        if($badge==0)
            $sql = "select * from tbl_levels l,tbl_score_and_badge sb where l.badge_id=sb.id and l.user_id='$user_id'";
        else
            $sql = "select * from tbl_levels l,tbl_score_and_badge sb where l.badge_id=sb.id and l.badge_id='$badge' and l.user_id='$user_id'";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->result();

    }

    function last_played_game($user_id) {
        $sql = "select * from tbl_quiz_answers where user_id=? order by answered_date desc";
        $query = $this->db->query($sql, array($user_id));
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_profile_banners($user_id) {
        $sql ="select * from tbl_advertiser_banner_ads where advertiser_id='$user_id' AND quiz_id=0 ORDER BY rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_admin_ads() {
        $sql = "select * from tbl_advertisements order by rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_admin_profile_ads(){
        $sql = "select * from tbl_advertisements where adv_position = 'profile' order by rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_admin_search_ads(){
        
        $sql = "select * from tbl_advertisements where adv_position = 'search' order by rand()";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function getRandomQuiz($level,$user_type="") {
         $sql2 =  "select m.user_id from tbl_members m where user_type='$user_type'";
             $query = $this->db->query($sql2);
             $result = $query->result();
             //echo $this->db->last_query();
             $user_ids=array();
             foreach($result as $res){
                    $user_ids[] = $res->user_id;
             }
             $user_idss = implode(",",$user_ids);
             $user_id=$this->session->userdata('wannaquiz_user_id');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if($level!="")
            $sql ="select * from tbl_quizes  where quiz_level='$level' and quiz_id NOT IN(SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.ip_address = '$ip_address') AND user_id IN ($user_idss) AND user_id NOT IN ($user_id) order by rand() limit 1";
        else 
            $sql ="select * from tbl_quizes where quiz_id NOT IN(SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.ip_address = '$ip_address') AND user_id IN ($user_idss) AND user_id IN ($user_idss) AND user_id NOT IN ($user_id) order by rand() limit 1";

        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->row();
        else return NULL;
    }

    function get_last_quiz() {
        $sql = "select * from tbl_quizes order by quiz_id desc";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->row()->quiz_id;
        else return null;
    }

    function get_quiz_credits() {
        $sql ="select * from tbl_quizes q, tbl_member_profile mp where q.user_id = mp.member_id and q.quiz_credits='0' and q.user_type='advertiser' and q.status='1'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return null;
    }

    function get_quizes_by_category_subcategory($category_id = null) {
        if($category_id==null)
            $category_id = $this->input->post('category_id');
        $subcategory_data = $this->get_subcategory($category_id);
        if(count($subcategory_data)>0) {
            foreach($subcategory_data as $subcategory_id) {
                $subcategory[]= $subcategory_id->id;}

            $subcategory_str="";
            $subcategory_str.=implode(",",$subcategory);
            $sql = "(Select q.*,qm.images,0,m.username FROM tbl_quizes q join tbl_quiz_images qm join tbl_members m on q.quiz_id=qm.quiz_id and q.user_id=m.user_id where q.category_id in ($subcategory_str,$category_id) and q.status='1') UNION ALL (Select q.*,qv.quiz_videos,qv.video_answer,m.username FROM tbl_quizes q join tbl_quiz_videos qv join tbl_members m on q.quiz_id=qv.quiz_id and q.user_id=m.user_id where q.category_id in ($subcategory_str,$category_id) and q.status='1')";
        }
        else
            $sql = "(Select q.*,qm.images,0,m.username FROM tbl_quizes q join tbl_quiz_images qm join tbl_members m on q.quiz_id=qm.quiz_id and q.user_id=m.user_id where q.category_id in ($category_id) and q.status='1') UNION ALL (Select q.*,qv.quiz_videos,qv.video_answer,m.username FROM tbl_quizes q join tbl_quiz_videos qv join tbl_members m on q.quiz_id=qv.quiz_id and q.user_id=m.user_id where q.category_id in ($category_id) and q.status='1')";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return ($query->result());
        else return null;
    }

    function getRandomQuizByCategories($level,$cat_ids,$quiz_type='') {

        $cat_ids=rtrim($cat_ids,',');

        if($cat_ids!=""){
			 $sql1 =  "(Select c.id FROM tbl_categories c where c.parent_id in ($cat_ids))";
			 $query = $this->db->query($sql1);
			 $result = $query->result();
			 $a=array();
			 foreach($result as $res){
			 	$a[] = $res->id;
			 }
			 $value = implode(",",$a);
			 if($value !=''){
            	$sql ="select quiz_id from tbl_quizes where quiz_level='$level' AND category_id IN($value,$cat_ids) And quiz_type='$quiz_type' order by rand() limit 1";
			 }else{
			 	$sql ="select quiz_id from tbl_quizes where quiz_level='$level' AND category_id IN($cat_ids) And quiz_type='$quiz_type' order by rand() limit 1";
			 }
		} else
            $sql ="select quiz_id from tbl_quizes where quiz_level='$level' AND quiz_type='$quiz_type' order by rand() limit 1";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->row();
        else return NULL;
    }
    
    function getRandomQuizForMultiplayer($level,$cat_ids,$subcategory_id,$user_type='') {
       $cat_ids=rtrim($cat_ids,',');
        
         $sql2 =  "select m.user_id from tbl_members m where user_type='$user_type'";
             $query = $this->db->query($sql2);
             $result = $query->result();
             //echo $this->db->last_query();
             $user_ids=array();
             foreach($result as $res){
                    $user_ids[] = $res->user_id;
             }
             $user_idss = implode(",",$user_ids);
     
            if($subcategory=='0' OR $subcategory==''){
            $sql1 =  "Select c.id FROM tbl_categories c where c.parent_id='$cat_ids'";
             $query = $this->db->query($sql1);
             $result = $query->result();
             //echo $this->db->last_query();
             $a=array();
             foreach($result as $res){
                    $a[] = $res->id;
             }
             $value = implode(",",$a);
             if($value != ''){
            $sql = "SELECT a.quiz_id FROM (SELECT quiz_id, user_id FROM tbl_quizes 
                 WHERE category_id IN ($value,$cat_ids) 
                 AND quiz_level='$level' 
                 AND status='1'
                 "; 
             if($user_id)
                 $sql.=" AND quiz_id NOT IN
                 (SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.user_id = '$user_id')";
            
            $sql .= " AND user_id IN ($user_idss)"; 
            if($user_id) $sql.=" AND user_id NOT IN ($user_id)"; 
                $sql.=" order by rand()) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
             }else{
                    $sql = "SELECT a.quiz_id FROM (SELECT quiz_id, user_id FROM tbl_quizes 
                            WHERE category_id IN ($cat_ids) 
                            AND quiz_level='$level' AND status='1'
                            ";
                    if($user_id) $sql .= "
                            AND a.quiz_id NOT IN
                            (SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.user_id = '$user_id')";
                    $sql .= " AND user_id IN ($user_idss)"; 
                    if($user_id) $sql.=" AND user_id NOT IN ($user_id)) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1"; 
               else $sql.=" order by rand())a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
             }
                         //echo $sql;
		}
        else if($subcategory!='0' && $subcategory!=''){
            
            $sql = "SELECT a.quiz_id FROM (SELECT quiz_id, user_id FROM tbl_quizes 
                    WHERE category_id IN ($subcategory) 
                    AND quiz_level='$level' AND status='1'
                      ";
           if($user_id) $sql .= "
                    AND quiz_id NOT IN
                    (SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.user_id = '$user_id')";
           $sql .= "AND user_id IN ($user_idss)";
           if($user_id) $sql.=" AND user_id NOT IN ($user_id) order by rand()) a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1"; 
           else $sql.=" order by rand())a join tbl_quiz_budgets b on a.user_id=b.user_id where b.budget_status='1' LIMIT 1";
        }
          //echo $sql;exit;
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if($query->num_rows()>0)
            return $query->row();
        else return NULL;
    }  

//   function getRandomQuizForMultiplayer($level,$cat_ids,$quiz_type='') {
//        $ip_address = $_SERVER['REMOTE_ADDR'];
//        $cat_ids=rtrim($cat_ids,',');
//
//        if($cat_ids!=""){
//			 $sql1 =  "(Select c.id FROM tbl_categories c where c.parent_id in ($cat_ids))";
//			 $query = $this->db->query($sql1);
//			 $result = $query->result();
//			 $a=array();
//			 foreach($result as $res){
//			 	$a[] = $res->id;
//			 }
//			 $value = implode(",",$a);
//			 if($value !=''){
//            	$sql ="select q.quiz_id from tbl_quizes q where q.quiz_level='$level' AND q.status='1' AND q.category_id IN($value,$cat_ids) AND q.quiz_id NOT IN(SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.ip_address = '$ip_address') order by rand() limit 1";
//			 }else{
//			 	$sql ="select q.quiz_id from tbl_quizes q where q.quiz_level='$level' AND q.status='1' AND q.category_id IN($cat_ids) AND q.quiz_id NOT IN(SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.ip_address = '$ip_address') order by rand() limit 1";
//			 }
//		         } else
//                  $sql ="select q.quiz_id from tbl_quizes q where q.quiz_level='$level' AND q.status='1' AND q.quiz_id NOT IN(SELECT mp.quiz_id from tbl_multiplayer_point mp where mp.ip_address = '$ip_address') order by rand() limit 1";
//        //echo $sql;exit;
//        $query = $this->db->query($sql);
//
//        if($query->num_rows()>0)
//            return $query->row();
//        else return NULL;
//    }

    function getUserTotalPoints($id) {
        $sql ="select sum(points) as total from tbl_quiz_answers where user_id='$id'";
        $query = $this->db->query($sql);
        $data=$query->row();
        if($query->num_rows()>0)
            return  $data->total;
        else return NULL;
    }

    function getUserTotalScoredBonusPoints($id){
        $sql = "select * from tbl_position where user_id='$id'";
        $query= $this->db->query($sql);
        $data=$query->row();
        if($query->num_rows()>0)
            return  $data->total_points;
        else return NULL;
    }

    function getUserTotalQuestionsAnswered($id) {
        $sql ="select count(answer_status) as total from tbl_quiz_answers where user_id='$id'";
        $query = $this->db->query($sql);
        $data=$query->row();
        if($query->num_rows()>0)
            return  $data->total;
        else return NULL;
    }

    function getUserTotalCorrectAnswered($id) {
        $sql ="select count(answer_status) as total from tbl_quiz_answers where user_id='$id' and answer_status='1'";
        $query = $this->db->query($sql);
        $data=$query->row();
        if($query->num_rows()>0)
            return  $data->total;
        else return NULL;
    }

    function count_user_played_quizes($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_quiz_answers');
        if($query->num_rows()>0)
        return $query->num_rows();
        else return null;
    }

    function get_winner_of_day(){
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
                group by e.parent_id";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();
        if($query->num_rows()>0)
        $data = $query->result();
        foreach($data as $datas){
            if($datas->parent_id==0)
                $category = $datas->category_id;
            if($datas->parent_id!=0)
                $category = $datas->parent_id;
            $user = $datas->user_id;
            $points = $datas->total_points;
            $user_profile = $this->Member_model->get_member($user);
            $user_email = $user_profile->email;
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

            $parseElement=array("USERNAME"=>$username,"CATEGORY"=>$category_name,"POINTS"=>$points,"SITENAME"=>$site_info->site_name);

            $subject=$this->Email_model->parse_email($parseElement,$subject);
            $emailbody=$this->Email_model->parse_email($parseElement,$emailbody);

            @mail($user_email,$subject,$emailbody,$headers);

            $this->Award_model->insertWinneroftheDay($user,$category_name);

            #echo 'username: '.$username.'<br> email: '.$user_email.'<br> category: '.$category.'<br>points: '.$points.'<br><br>';
        }

        //else return null;
    }

    function get_overall_winner(){
        $sql = 'select max(total_points) as total_points, user_id from tbl_position';
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        $data = $query->row();
        $user_id = $data->user_id;
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

       #echo 'username: '.$username.'<br> email: '.$user_email.'<br> category: '.$points.'<br><br>';
    }

    function get_fifty_users_per_category($cid=''){
         $this->load->model('Site_setting_model');

        $today = date('Y-m-d');

        $thisMorning = $today . ' 00:00:00';
        $thisMorningTimestamp = strtotime($thisMorning);

        $thisEvening = $today . ' 23:59:59';
        $thisEveningTimestamp = strtotime($thisEvening);

        //$sql = "select sum(qa.points) as total, c.id,c.name,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points from tbl_categories c,tbl_quizes q,tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.category_id = c.id and qa.answered_date between '1299246335' and '1302545723' group by c.name,qa.user_id order by total desc ";
        if($cid!='')
        $sql = "select sum(qa.points) as total,
        c.id,
        (SELECT CASE WHEN c.parent_id > 0 THEN
                (SELECT `name` FROM tbl_categories WHERE id = (select ts.parent_id FROM tbl_categories ts WHERE ts.id = c.id))
        else
        c.name END) AS parent_cat_name,
        c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points,m.username,ma.country,ma.city
        from tbl_quiz_answers qa
        left join tbl_quizes q ON(q.quiz_id = qa.quiz_id)
        left join tbl_categories c ON(c.id = q.category_id)
        left join tbl_members m ON(qa.user_id = m.user_id)
        left join tbl_address ma ON(qa.user_id = ma.member_id)
        where qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp'
        AND (c.id IN(SELECT id FROM tbl_categories WHERE parent_id = '$cid') OR c.id = '$cid')
            AND m.user_type='0' 
        group by qa.user_id order by total desc limit 50
        ";
        else
//        $sql = "select sum(qa.points) as total,
//        c.id,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points,m.username,ma.country,ma.city
//        from tbl_quiz_answers qa
//        left join tbl_quizes q ON(q.quiz_id = qa.quiz_id)
//        left join tbl_categories c ON(c.id = q.category_id)
//        left join tbl_members m ON(qa.user_id = m.user_id)
//        left join tbl_address ma ON(qa.user_id = ma.member_id)
//        where qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp'
//
//        group by qa.user_id order by total desc limit 50
//        ";
        $sql = "select sum(qa.points) as total, p.total_points,
        c.id,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points,m.username,ma.country,ma.city
        from tbl_quiz_answers qa
        left join tbl_quizes q ON(q.quiz_id = qa.quiz_id)
        left join tbl_categories c ON(c.id = q.category_id)
        left join tbl_members m ON(qa.user_id = m.user_id)
        left join tbl_address ma ON(qa.user_id = ma.member_id)
        left join tbl_position p ON(qa.user_id = p.user_id)
        where qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp'
            AND m.user_type='0' 
        group by qa.user_id order by total desc limit 50";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

    function get_all_time_fifty_user_per_category($cid=''){
        if($cid!='') {
        //$sql = "select mct.*,m.username from tbl_member_category_titles mct, tbl_members m where mct.user_id = m.user_id and category_id = '$cid' order by mct.points desc limit 50";
        $sql = "select m.user_id,mct.category_titles,sum(mct.points) as total_points,ct.category_title,m.username,ma.country,ma.city
        from tbl_member_category_titles mct, tbl_category_titles ct, tbl_categories c, tbl_members m, tbl_address ma
        where mct.category_titles=ct.id
        and mct.category_id=c.id
        and mct.user_id=m.user_id
        and mct.user_id = ma.member_id
        and mct.category_id = '$cid' 
        AND m.user_type='0'     
        group by mct.user_id order by total_points desc limit 50";
        }
        else {
        //$sql = "select mct.*, m.username,sum(mct.points)as total_points from tbl_member_category_titles mct, tbl_members m where mct.user_id = m.user_id group by mct.user_id order by total_points desc limit 50";
//        $sql = "select mct.category_titles,sum(p.total_points) as total_points,ct.category_title,m.username,ma.country,ma.city
//        from tbl_member_category_titles mct, tbl_category_titles ct, tbl_categories c, tbl_members m, tbl_address ma, tbl_position p
//        where mct.category_titles=ct.id
//        and mct.category_id=c.id
//        and mct.user_id=m.user_id
//        and mct.user_id = p.user_id
//        and mct.user_id = ma.member_id group by mct.user_id order by total_points desc limit 50";
        $sql = "select p.total_points,m.username,m.user_id,ma.country,ma.city
        from tbl_categories c, tbl_members m, tbl_address ma, tbl_position p
        where m.user_id = p.user_id
        and m.user_id = ma.member_id 
        AND m.user_type='0' 
        group by m.user_id order by total_points desc limit 50";
        }
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

    function get_user_today_points($user_id,$cid=''){
        //echo $user_id.'/'.$cid; exit;
        $this->load->model('Site_setting_model');

        $today = date('Y-m-d');

        $thisMorning = $today . ' 00:00:00';
        $thisMorningTimestamp = strtotime($thisMorning);

        $thisEvening = $today . ' 11:59:59';
        $thisEveningTimestamp = strtotime($thisEvening);

        //$sql = "select sum(qa.points) as total, c.id,c.name,c.parent_id,q.category_id,qa.quiz_id,qa.user_id,qa.answered_date,qa.points from tbl_categories c,tbl_quizes q,tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.category_id = c.id and qa.answered_date between '1299246335' and '1302545723' group by c.name,qa.user_id order by total desc ";
        if($cid!='')
        $sql = "select sum(qa.points) as total
        from tbl_quiz_answers qa
        left join tbl_quizes q ON(q.quiz_id = qa.quiz_id)
        left join tbl_categories c ON(c.id = q.category_id)
        where qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp'
        AND qa.user_id='$user_id'
        AND (c.id IN(SELECT id FROM tbl_categories WHERE parent_id = '$cid') OR c.id = '$cid')
        group by qa.user_id order by total desc limit 50
        ";
        else
        $sql = "select sum(qa.points) as total
        from tbl_quiz_answers qa
        left join tbl_quizes q ON(q.quiz_id = qa.quiz_id)
        left join tbl_categories c ON(c.id = q.category_id)
        where qa.answered_date between '$thisMorningTimestamp' and '$thisEveningTimestamp'
        AND qa.user_id='$user_id'
        group by qa.user_id order by total desc limit 50
        ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function get_perfect_score_A($user_id){
        $sql = "select q.quiz_id,q.quiz_level,qa.answered_date,qa.id,qa.user_id,qa.answer_status,qa.row_count from tbl_quizes q, tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.quiz_level='2' and qa.user_id = ? and qa.row_count!='2' order by qa.answered_date asc";
        $query = $this->db->query($sql,array($user_id));
        if($query->num_rows()>0)
        $data = $query->result();
      // echo $count=count($data); echo $user_id;//exit;
        if(count($data)>='10')
           $count=count($data);

        for($i=0;$i<$count;$i++){// echo "test".$i;
            if($data[$i]->answer_status==0){// echo $i."hello";exit;
                //if($i<10){
                    for($j=0;$j<$i+1;$j++){
                       $this->db->where('user_id',$user_id);
                       $this->db->where('id',$data[$j]->id);
                       $this->db->update('tbl_quiz_answers',array('row_count'=>2));
                   }
                //}
//                if($i>=10 && $i<15){ //echo 'here';exit;
//                    for($j=0;$j<10;$j++){  //echo $data[$j]->id.'/';
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//                    }//exit;
//                    $this->Award_model->insertPerfectScore($user_id,'10A');
//                }
//                if($i>=15 && $i<20){
//                    for($j=0;$j<15;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>2));
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'15A');
//                }
//                if($i>=20 && $i<25){
//                    for($j=0;$j<20;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>2));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'20A');
//                }
//                if($i>=25){
//                    for($j=0;$j<25;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>2));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'25A');
//                }
               // break;
            }
        }
        $count1 = 0;
        for($i=0;$i<$count;$i++){
            if($data[$i]->answer_status!=0){
                $count1 = $i+1;
            }
            else break;
        }
                //echo $count1."hi";exit;
                $zero_row_count = 0;
                if($count1>=25){
                     for($j=0;$j<25;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>2));

                        if($data[$j]->row_count==0)
                    $zero_row_count = $zero_row_count+1;
                    }
                    if($zero_row_count>=5)
                    $this->Award_model->insertPerfectScore($user_id,'25A');
                }
                if($count1>=20 && $count1<25){
                    for($j=0;$j<20;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
                        //echo $data[$j]->row_count;exit;
                    if($data[$j]->row_count==0)
                    $zero_row_count = $zero_row_count+1;
                    }
                   // echo $zero_row_count; exit;
                    if($zero_row_count>=5)
                    $this->Award_model->insertPerfectScore($user_id,'20A');
                }

                if($count1>=15 && $count1<20){
                    for($j=0;$j<15;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
                    if($data[$j]->row_count==0)
                    $zero_row_count = $zero_row_count+1;
                    }
                    if($zero_row_count>=5)
                    $this->Award_model->insertPerfectScore($user_id,'15A');
                }
                if($count1>=10 && $count1<15){
                    for($j=0;$j<10;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
                    if($data[$j]->row_count==0)
                    $zero_row_count = $zero_row_count+1;
                    }
                    if($zero_row_count>=5)
                    $this->Award_model->insertPerfectScore($user_id,'10A');
                }
            //}
       // }

    }

    function get_perfect_score_H($user_id){
//        $this->db->where('user_id',$user_id);
//                       //$this->db->where('id',$data[$j]->id);
//                       $this->db->update('tbl_quiz_answers',array('row_count'=>0));exit;
        $sql = "select q.quiz_id,q.quiz_level,qa.answered_date,qa.user_id,qa.id,qa.answer_status,qa.row_count from tbl_quizes q, tbl_quiz_answers qa where q.quiz_id = qa.quiz_id and q.quiz_level='3' and qa.user_id = '$user_id' and qa.row_count!='2' order by qa.answered_date asc ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        $data = $query->result();
        if(count($data)>='10')
           $count=count($data);//exit;

        for($i=0;$i<$count;$i++){
            if($data[$i]->answer_status==0){//echo $i; exit;
                //if($i<10){
                    for($j=0;$j<$i+1;$j++){
                       $this->db->where('user_id',$user_id);
                       $this->db->where('id',$data[$j]->id);
                       $this->db->update('tbl_quiz_answers',array('row_count'=>2));
                   }
                //}
//                if($i>=10 && $i<15){
//                    for($j=0;$j<10;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'10H');
//                }
//                if($i>=15 && $i<20){//echo $i."hello"; exit;
//                    for($j=0;$j<15;$j++){//echo $data[$j]->id.'/';
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }//exit;
//                    $this->Award_model->insertPerfectScore($user_id,'15H');
//                }
//                if($i>=20 && $i<25){
//                    for($j=0;$j<20;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'20H');
//                }
//                if($i>=25){
//                    for($j=0;$j<25;$j++){//echo "testing";
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    } //echo"here";exit;
//                    $this->Award_model->insertPerfectScore($user_id,'25H');
//                }
//                break;
            }
        }
        $count1 = 0;
        $zero_row_count1 = '0';
        //echo $zero_row_count1; exit;
        for($i=0;$i<$count;$i++){
            if($data[$i]->answer_status!=0){
                $count1 = $i+1;
            }
            else break;
        }
      //echo $count1.'/';// exit;

                if($count1>=25){
                     for($j=0;$j<25;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>2));

                        if($data[$j]->row_count==0)
                    $zero_row_count1 = $zero_row_count1+1;
                    }
                    if($zero_row_count1>=5)
                    $this->Award_model->insertPerfectScore($user_id,'25H');
                }
                if($count1>=20 && $count1<25){
                    for($j=0;$j<20;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
                        //echo $data[$j]->row_count;exit;

                    if($data[$j]->row_count==0)
                    $zero_row_count1 = $zero_row_count1+1;
                    }
                    //echo $zero_row_count1; //exit;
                    if($zero_row_count1>=5)
                    $this->Award_model->insertPerfectScore($user_id,'20H');
                }

                if($count1>=15 && $count1<20){
                    for($j=0;$j<15;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));

                    if($data[$j]->row_count==0)
                    $zero_row_count1 = $zero_row_count1+1;
                    }
                    //echo $zero_row_count1;
                    if($zero_row_count1>=5)
                    $this->Award_model->insertPerfectScore($user_id,'15H');
                }
                if($count1>=10 && $count1<15){
                    for($j=0;$j<10;$j++){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('id',$data[$j]->id);
                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
                    if($data[$j]->row_count==0)
                    $zero_row_count1++;
                    //echo $zero_row_count1;
                    }
                    if($zero_row_count1>=5)
                    $this->Award_model->insertPerfectScore($user_id,'10H');
                }

//            if($data[$i]->answer_status!=0){//echo"test".$i;exit;
//                if($count>=25){
//                     for($j=0;$j<25;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }//echo "here1";exit;
//                    $this->Award_model->insertPerfectScore($user_id,'25H');
//                }
//                if($count>=20 && $count<25){
//                    for($j=0;$j<20;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'20H');
//                }
//
//                if($count>=15 && $count<20){
//                    for($j=0;$j<15;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'15H');
//                }
//                if($count>=10 && $count<15){
//                    for($j=0;$j<10;$j++){
//                        $this->db->where('user_id',$user_id);
//                        $this->db->where('id',$data[$j]->id);
//                        $this->db->update('tbl_quiz_answers',array('row_count'=>1));
//
//                    }
//                    $this->Award_model->insertPerfectScore($user_id,'10H');
               // }
            //}
        //}
    }

    function get_milestone_award($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_position');
        $data = $query->row();
        $total_points = $data->total_points;

        if($total_points>='1000' && $total_points<'5000')
        $this->Award_model->insertMilestoneAward($user_id,'1000_milestone');
        if($total_points>='10000' && $total_points<'25000')
        $this->Award_model->insertMilestoneAward($user_id,'10000_milestone');
        if($total_points>='25000' && $total_points<'50000')
        $this->Award_model->insertMilestoneAward($user_id,'25000_milestone');
        if($total_points>='50000' && $total_points<'100000')
        $this->Award_model->insertMilestoneAward($user_id,'50000_milestone');
        if($total_points>='100000')
        $this->Award_model->insertMilestoneAward($user_id,'100000_milestone');
    }

    function set_member_level($user_id,$level,$points){
        //echo $level;exit;
             $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_member_levels');
        if($query->num_rows()>0){
            $this->db->where('user_id',$user_id);
            $data = array('level_id'=>$level,
            'current_points'=>$points
            );
            $this->db->update('tbl_member_levels',$data);
        }
        else {
            $data = array('user_id'=>$user_id,
                'level_id'=>$level,
                'current_points'=>$points
            );
            $this->db->insert('tbl_member_levels',$data);
        }
    }

    function get_member_level($user_id){
        $sql = "select * from tbl_member_levels ml, tbl_level l where ml.level_id=l.id and ml.user_id = '$user_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function get_member_previous_level($user_id,$current_level){
        $sql = "select * from tbl_member_levels ml, tbl_level l where l.id = '$current_level' and ml.user_id = '$user_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function get_all_questions_by_cat($cid){
        $sql1 =  "(Select c.id FROM tbl_categories c where c.parent_id='$cid')";
			 $query = $this->db->query($sql1);
			 $result = $query->result();
			 $a=array();
			 foreach($result as $res){
			 	$a[] = $res->id;
			 }
			 $value = implode(",",$a);
			 if($value != ''){
                            $sql = "(SELECT * FROM tbl_quizes WHERE category_id IN ($value,$cid) AND status='1')";
                         }
                         else{
			 	$sql = "(SELECT * FROM tbl_quizes WHERE category_id IN ($cid) AND status='1' )";
			 }
                        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else return false;
    }

    function count_quiz_by_subcatid($subid){
        $this->db->where('category_id',$subid);
        $this->db->where('status','1');
        $query = $this->db->get('tbl_quizes');
        if($query->num_rows()>300)
        return true;
        else return false;
    }

    function get_products(){
        $sql = "select * from tbl_products p, tbl_categories c where p.category_id = c.id order by product_name asc";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

    function quiz_report(){
        $quiz_id = $this->input->post('quiz_id');
        $type = $this->input->post('report');
        $reporter_id = $this->input->post('reporter_id');
        $data = array('quiz_id'=>$quiz_id,
                        'report_type'=>$type,
                        'reporter'=>$reporter_id,
                        'date'=>current_date_time_stamp()
        );
        $query = $this->db->insert('tbl_quiz_reports',$data);
        if($query) return true;
        else return false;
    }

    function get_playlist_id($quiz_id){
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->get('tbl_quiz_playlist');
        if($query->num_rows()>0)
        return $query->row()->playlist_id;
        else return false;

    }

    function check_quiz_played($quiz_id){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $sql = "select * from tbl_multiplayer_point where ip_address = '$ip_address' and quiz_id = $quiz_id";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    function check_user_quiz_played($quiz_id,$user_id){
        //$ip_address = $_SERVER['REMOTE_ADDR'];
        $sql = "select * from tbl_quiz_answers where user_id = '$user_id' and quiz_id = $quiz_id";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        return $query->num_rows();
    }

//    function average_quiz_rating($quiz_id){
//        $sql = "select avg(rating) as rating from tbl_quiz_ratings where quiz_id = '$quiz_id' limit 2";
//        $query = $this->db->query($sql);
//        if($query->num_rows()>0)
//        return $query->row()->rating;
//        else return null;
//
//    }

    function total_quiz_rating($quiz_id){
        $this->db->where('quiz_id',$quiz_id);
        $query = $this->db->get('tbl_quiz_ratings');
        if($query->num_rows()>=20){
            $sql = "select avg(qr.rating) as rating from tbl_quiz_ratings qr,tbl_quizes q where qr.quiz_id = '$quiz_id' and qr.quiz_id = q.quiz_id and q.quiz_rating_award_flag = '0'";
            $query1 = $this->db->query($sql);
            return $query1->row()->rating;
        }
        else return null;

    }

    function update_quiz_rating_award_flag($quiz_id){
        $this->db->where('quiz_id',$quiz_id);
        $this->db->update('tbl_quizes',array('quiz_rating_award_flag'=>'1'));
    }

    function get_coupon_amount($code){
        $this->db->where('coupon_code',$code);
        $this->db->where('activated','yes');
        $result = $this->db->get('tbl_coupons');
        if($result->num_rows()>0)
        return $result->row();
        else return null;
    }

    function check_user_coupon($code,$user_id){
        $this->db->where('coupon_code_id',$code);
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_coupon_history');       
        
        if($query->num_rows()>0)
        return true;
        else return false;
    }

    function update_coupon_code($code){
        $coupon_info = $this->get_coupon_amount($code);
        $numbers_in_use = $coupon->number_in_use;
        $this->db->where('coupon_code',$code);
        $this->db->update('tbl_coupons', array('numbers_in_use'=>$numbers_in_use+1));
    }

    function insert_quiz_budget_from_paypal($gross_amount=0){
        echo $user_id = $this->session->userdata('wannaquiz_user_id'); exit;
    }

    function insert_quiz_budget($gross_amount,$member_id,$coupon_amount=0)
    {
        $user_id = $member_id;
        #$total_budget = $gross_amount;
        $budget_info = $this->get_user_quiz_budget($user_id);        
        
        if($budget_info) $pre_budget = $budget_info->remaining_budget;
        else $pre_budget = 0;
#exit($gross_amount . '/' . $pre_budget . '/' . $coupon_amount);
# deduct user credits
        if($pre_budget > $gross_amount)
        {
            $s = '+';
            $total_budget = ($pre_budget - $gross_amount);
        }
        else if($pre_budget < $gross_amount)
        {
            $s = '-';
            $total_budget = ($gross_amount - $pre_budget);
        }
        else
        {
            $s = '+';
            $total_budget = 0;
        }
  // echo $gross_amount . '/' . $pre_budget . '/' . $s . '/' . $total_budget.'/'.$coupon_amount.'<br>';
        $this->db->where('user_id',$user_id);
        if($coupon_amount)
            $this->db->set('total_budget', 'total_budget+' . $coupon_amount . $s . $total_budget, FALSE);
        else
            $this->db->set('total_budget', 'total_budget+' . $s . $total_budget, FALSE);
        $this->db->update('tbl_quiz_budgets');
       //echo $this->db->last_query(); 
/*        if($this->session->userdata('advertiser_budget')==''){
            $data=array(
                'total_budget'=>$total_budget,
                'budget_status'=>'1'
            );
        }
        else */
        if($coupon_amount){
            $total_bget=($s == "+") ? ($coupon_amount + $total_budget) : ($coupon_amount - $total_budget);
             }
        else{ 
            $total_bget=$total_budget;
            }
            $data=array(
                'user_id'=> $this->session->userdata('wannaquiz_user_id'),
                'budget_per_selection'=>$gross_amount,
                'per_selection'=>$this->session->userdata('budget_for'),
                'remaining_budget'=>$gross_amount,
                'budget_status'=>'1'
            );
        if($budget_info){
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_quiz_budgets',$data);  
       //  echo $this->db->last_query().'<br>';
       }
     else {
        $data=array(
               'user_id'=> $this->session->userdata('wannaquiz_user_id'),
               'total_budget'=>$total_bget,
               'budget_per_selection'=>$gross_amount,
                'per_selection'=>$this->session->userdata('budget_for'),
                'remaining_budget'=>$gross_amount,
                'budget_status'=>'1'
               );
        $this->db->insert('tbl_quiz_budgets', $data);
       // echo $this->db->last_query();
     }
        #exit($this->db->last_query());
    }
    function check_member_cpc($user_id){
       $sql = "select * from tbl_quizes q, tbl_categories c where q.user_id = '$user_id' and q.category_id = c.id order by posted_date limit 1";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) {
            $data = $query->row();
            return $data;
        }    
        else return null;
    }
function get_deleted_quiz()
{
    $sql="select * from tbl_quizes where status='-1'";
    $res=$this->db->query($sql);
    return $res->result_array();
              
  }
  function get_deleted_comment()
{
    $sql="select * from tbl_quiz_comments where status='-1'";
    $res=$this->db->query($sql);
    return $res->result_array();
              
  }
  function get_count_quiz($id)
  {
      $sql="select * from tbl_quizes  where user_id=$id";
      $res=$this->db->query($sql);
      return $res->num_rows();
  }

  function get_question_by_category($cat_id)
  {
      $sql="select* from tbl_quizes where category_id=$cat_id and status='1' order by rand() limit 6";
      $res=$this->db->query($sql);
      return $res->result_array();
  }
  
  
}
?>