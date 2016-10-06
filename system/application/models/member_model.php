<?php

class Member_model extends Model {

    function Member_model() {
        parent::Model();
        $this->load->model('Quiz_model');
    }

    function validate_user_facebook($uid = 0) {
        //confirm that facebook session data is still valid and matches
        $this->load->library('fb_connect');

        //see if the facebook session is valid and the user id in the sesison is equal to the user_id you want to validate
        $session_uid = 'fb:' . $this->fb_connect->fbSession['uid'];
        if (!$this->fb_connect->fbSession || $session_uid != $uid) {
            return false;
        }

        //Receive Data
        $this->user_id = $uid;

        //See if User exists
        $this->db->where('user_id', $this->user_id);
        $q = $this->db->get('users');

        if ($q->num_rows == 1) {
            //yes, a user exists,
            return true;
        }

        //no user exists
        return false;
    }

    function check_quiz_image($photo) {
        $sql = '
           SELECT count(*) as c 
           FROM tbl_quiz_images qi , tbl_quizes q  
           WHERE qi.quiz_id = q.quiz_id 
           AND ( qi.images = ? 
           OR qi.images2 = ? )
           ';
        $query = $this->db->query($sql, array($photo, $photo));
#    exit($this->db->last_query());
        $result = $query->result();

        if ($result[0]->c >= 1)
            return TRUE;
        else
            return FALSE;
    }

    function update_member($profile, $address='') {
        $this->db->update('tbl_member_profile', $profile, array('member_id' => $this->session->userdata('wannaquiz_user_id'))
        );
#echo $this->db->last_query();exit;

        if ($address)
            $this->db->update('tbl_advertisers', $address, array('member_id' => $this->session->userdata('wannaquiz_user_id'))
            );
#echo $this->db->last_query();
    }

    function get_filter($uid) {
        $this->db->select('filter_adult')->from('tbl_members')->where('user_id', $uid);
        $query = $this->db->get();
        return $query->row()->filter_adult;
    }

    function get_all_members($mem_type, $sort_field, $sort_order, $num, $offset) {

        $today = date('Y-m-d');

        $thisMorning = $today . ' 00:00:00';
        $thisMorningTimestamp = strtotime($thisMorning);

        if ($sort_field == 'username')
            $sort_field = 'm.username';

        if ($sort_field == 'email')
            $sort_field = 'mp.email';

        if ($sort_field == 'joined_date')
            $sort_field = 'm.joined_date';

        $orderby = " ORDER BY $sort_field $sort_order";
        if ($num == 0 && $offset == 0)
            $limit = "";
        else
            $limit=" LIMIT $offset,$num";

        if ($mem_type == "current")
            $sql = "SELECT * FROM tbl_members m,tbl_member_profile mp,tbl_login L WHERE m.user_id=mp.member_id and mp.member_id=L.uid AND lastlogin >= '$thisMorningTimestamp'  AND L.active=1" . $orderby . "" . $limit;
        else if ($mem_type == "all")
            $sql = "SELECT * FROM tbl_members m,tbl_member_profile mp where m.user_id=mp.member_id " . $orderby . " " . $limit;
        else
            $sql="SELECT * FROM tbl_members m,tbl_member_profile mp where m.user_id=mp.member_id AND m.user_type='$mem_type' " . $orderby . " " . $limit;

        $query = $this->db->query($sql);
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_member($id) {
        $sql = "SELECT * FROM tbl_members m,tbl_member_profile mp where m.user_id=mp.member_id AND m.user_id=?";
        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_user_id($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('tbl_members');
        if ($query->num_rows() > 0)
            return $query->row()->user_id;
        else
            return null;
    }

    function get_member_username($id) {
        $sql = "SELECT username FROM tbl_members m where m.user_id=?";
        $query = $this->db->query($sql, array($id));

        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_member_profile($id) {
        $sql = "select m.*, mp.* from tbl_members m join tbl_member_profile mp on m.user_id=mp.member_id where mp.member_id=?";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_company_detail($id) {
        $this->db->where('member_id', $id);
        $query = $this->db->get('tbl_advertisers');
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_address($id) {
        $this->db->where('member_id', $id);
        $query = $this->db->get('tbl_address');
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function count_friends($id) {
        $query = array();
        $sql = "SELECT * FROM tbl_member_friends mf,tbl_members m where mf.user_id=? AND mf.friend_id=m.user_id and status = '1'";
        $query = $this->db->query($sql, array($id)); //,$options,1);

        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    function get_friends($id, $num=null, $offset=null) {
        $limit = " LIMIT $offset,$num";
        if ($num != null || $offset != null)
            $sql = "SELECT * FROM tbl_member_friends mf,tbl_members m,tbl_member_profile mp where mf.user_id=? AND mf.friend_id=m.user_id and mf.friend_id=mp.member_id and status= '1' $limit";
        else
            $sql="SELECT * FROM tbl_member_friends mf,tbl_members m,tbl_member_profile mp where mf.user_id=? AND mf.friend_id=m.user_id and mf.friend_id=mp.member_id and status= '1'";
        $query = $this->db->query($sql, array($id)); //,$options,1);

        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    function get_multiplayer($id, $num=0, $offset=0) {
        $limit = " LIMIT $offset,$num";
        $sql = "SELECT * FROM tbl_multiplayer mp where mp.user_id=" . $id . " limit 8";
        $query = $this->db->query($sql, array($id)); //,$options,1);

        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    function get_multiplayer_by_name($id, $name) {
        $sql = "SELECT * FROM tbl_multiplayer mp where mp.user_id=? and mp.multiplayer_name='?'";
        $query = $this->db->query($sql, array($id, $name));
        if ($query->num_rows() > 0)
            return $query->result();
        return NULL;
    }

    function get_multiplayer_id_by_name($user_id, $name) {
        $sql = "SELECT * FROM tbl_multiplayer mp where mp.user_id=? and mp.multiplayer_name='?'";
        $query = $this->db->query($sql, array($user_id, $name)); //,$options,1);
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->multiplayer_id;
        }
        return NULL;
    }

    function get_user_score($user_id, $score_type) {
        if ($score_type == "total") {
//			$sql="SELECT sum(mp.points) as total FROM  tbl_quiz_answers mp where mp.user_id=".$user_id."";
            $sql = "SELECT total_points as total FROM  tbl_position p where p.user_id='$user_id'";
        } elseif ($score_type == "today") {
            $today = date('Y-m-d');

            $thisMorning = $today . ' 00:00:00';
            $thisMorningTimestamp = strtotime($thisMorning);

            $thisEvening = $today . ' 11:59:59';
            $thisEveningTimestamp = strtotime($thisEvening);

            $sql = "SELECT sum(mp.points) as total FROM tbl_quiz_answers mp where mp.user_id='$user_id' and mp.answered_date BETWEEN '$thisMorningTimestamp' AND '$thisEveningTimestamp'";
        }
        //echo $sql;
        $query = $this->db->query($sql);
        $data = $query->row();
        if ($data->total != '')
            return $data->total;
        else
            return 0;
    }

    function get_user_answer($user_id, $score_type) {
        if ($score_type == "total") {
            $sql = "SELECT sum(mp.answer_status) as total FROM  tbl_quiz_answers mp where mp.user_id=?";
        } elseif ($score_type == "today") {
            $today = date('Y-m-d');

            $thisMorning = $today . ' 00:00:00';
            $thisMorningTimestamp = strtotime($thisMorning);

            $thisEvening = $today . ' 11:59:59';
            $thisEveningTimestamp = strtotime($thisEvening);

            $sql = "SELECT sum(mp.answer_status) as total FROM tbl_quiz_answers mp where mp.user_id=? and mp.answered_date BETWEEN " . $thisMorningTimestamp . " AND " . $thisEveningTimestamp;
        }
        $query = $this->db->query($sql, array($user_id));
        $data = $query->row();
        if ($data->total != '')
            return $data->total;
        else
            return 0;
    }

    function get_multiplayer_total_point($user_id, $multiplayer_id) {
        $sql = "SELECT sum(mp.point) as total FROM tbl_multiplayer_point mp where mp.user_id=? and mp.multiplayer_id=?";
        $query = $this->db->query($sql, array($user_id, $multiplayer_id));
        $data = $query->row();
        if ($data->total != '')
            return $data->total;
        else
            return 0;
    }

    function get_multiplayer_today_point($user_id, $multiplayer_id) {
        $today_date = date('Y-m-d', time());
        $sql = "SELECT sum(mp.point) as total FROM tbl_multiplayer_point mp where mp.user_id=? and mp.multiplayer_id=? and mp.played_date='" . $today_date . "'";
        $query = $this->db->query($sql, array($user_id, $multiplayer_id));
        $data = $query->row();
        if ($data->total != '')
            return $data->total;
        else
            return 0;
    }

    function get_multiplayer_total_answer($user_id, $multiplayer_id) {
        $sql = "SELECT count(mp.answer_status) as total FROM tbl_multiplayer_point mp where mp.user_id=? and mp.multiplayer_id=?";
        $query = $this->db->query($sql, array($user_id, $multiplayer_id));
        $data = $query->row();
        if ($query->num_rows() > 0)
            return $data->total;
        else
            return 0;
    }

    function get_multiplayer_today_answer($user_id, $multiplayer_id) {
        $today_date = date('Y-m-d', time());
        $sql = "SELECT count(mp.answer_status) as total FROM tbl_multiplayer_point mp where mp.user_id=? and mp.multiplayer_id=? and mp.played_date='" . $today_date . "'";
        $query = $this->db->query($sql, array($user_id, $multiplayer_id));
        $data = $query->row();
        if ($query->num_rows() > 0)
            return $data->total;
        else
            return 0;
    }

    function get_advertiser_advertisement($user_id='', $quiz_id) {
        if ($user_id != '') {
            $sql = "SELECT * FROM tbl_advertiser_short_text_ads ad where ad.advertiser_id=? and ad.quiz_id=? ORDER BY RAND() LIMIT 1";
            $query = $this->db->query($sql, array($user_id, $quiz_id));
        } else {
            $sql = "SELECT * FROM tbl_advertiser_short_text_ads ad where ad.quiz_id=? ORDER BY RAND() LIMIT 1";
            $query = $this->db->query($sql, array($quiz_id));
        }


        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_regular_catid_advertisement($cat_id) {
        $sql = "SELECT * FROM tbl_advertisements ad where ad.cat_id IN(?) ORDER BY RAND() LIMIT 1";
        $query = $this->db->query($sql, array($cat_id));
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function get_regular_advertisement() {
        $sql = "SELECT * FROM tbl_advertisements ORDER BY RAND() LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->row();
        return NULL;
    }

    function delMember($id) {
        if ($id) {
            $this->db->where("user_id", $id);
            $this->db->delete("tbl_members");
        }
    }

    function insertBackEndMember() {
        $data = array('username' => $this->input->post('username',TRUE), 'password' => md5($this->input->post('password',TRUE)), 'first_name' => $this->input->post('firstname',TRUE), 'last_name' => $this->input->post('lastname',TRUE),
            'address' => $this->input->post('address1',TRUE), 'country' => $this->input->post('country',TRUE),
            'city' => $this->input->post('city',TRUE), 'zip' => $this->input->post('zip',TRUE), 'states' => $this->input->post('states',TRUE),
            'phone' => $this->input->post('phone',TRUE), 'email' => $this->input->post('email',TRUE), 'activated' => $this->input->post('activated',TRUE), 'credit_balance' => $this->input->post('credit_balance',TRUE));

        $this->db->insert('tbl_members', $data);
        $mem_id = $this->db->insert_id();

        $data = array('user_id' => $mem_id, 'name' => $this->input->post('shipname',TRUE), 'address1' => $this->input->post('shipaddr1',TRUE),
            'address2' => $this->input->post('shipaddr2',TRUE), 'city' => $this->input->post('ship_city',TRUE),
            'postcode' => $this->input->post('ship_zipcode',TRUE), 'phone' => $this->input->post('ship_phone',TRUE), 'addr_type' => 'shipping');
        $this->db->insert('tbl_member_address', $data);
    }

    function updateBackEndMember() {
        $data = array('activated' => $this->input->post('activated',TRUE), 'user_credits' => $this->input->post('credit_balance',TRUE));

        $this->db->where('user_id', $this->input->post('user_id',TRUE));
        $this->db->update('tbl_members', $data);

        $data = array('phone' => $this->input->post('phone',TRUE), 'email' => $this->input->post('email',TRUE), 'city' => $this->input->post('city',TRUE), //'/zip'=>$this->input->post('zip'),
            'state' => $this->input->post('states',TRUE), 'country' => $this->input->post('country',TRUE),
            'first_name' => $this->input->post('firstname',TRUE), 'last_name' => $this->input->post('lastname',TRUE), 'address1' => $this->input->post('shipaddr1',TRUE),
            'address2' => $this->input->post('shipaddr2',TRUE), 'city' => $this->input->post('ship_city',TRUE),
            'postcode' => $this->input->post('ship_zipcode',TRUE), 'phone' => $this->input->post('ship_phone',TRUE), 'addr_type' => 'shipping');
        $this->db->where('user_id', $this->input->post('user_id',TRUE));
        $this->db->update('tbl_member_address', $data);
    }

    function update_member_address() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $this->db->where('user_id', $user_id);
        $this->db->where('addr_type', 'billing');
        $query = $this->db->get('tbl_member_address');

        $data = array('user_id' => $user_id, 'addr_type' => 'billing', 'first_name' => $this->input->post('firstname',TRUE), 'last_name' => $this->input->post('lastname',TRUE), 'address1' => $this->input->post('street',TRUE), 'country' => $this->input->post('bill_country',TRUE),
            'city' => $this->input->post('city',TRUE), 'postcode' => $this->input->post('postcode',TRUE), 'phone' => $this->input->post('phone',TRUE),
            'email' => $this->input->post('email',TRUE));

        if ($query->num_rows() > 0) {
            $this->db->where('user_id', $user_id);
            $this->db->where('addr_type', 'billing');
            $this->db->update('tbl_member_address', $data);
        } else {
            $this->db->insert('tbl_member_address', $data);
        }

        $data1 = array('user_id' => $user_id, 'addr_type' => 'shipping', 'first_name' => $this->input->post('firstname1',TRUE), 'last_name' => $this->input->post('lastname1',TRUE), 'address1' => $this->input->post('street1',TRUE), 'country' => $this->input->post('ship_country',TRUE),
            'city' => $this->input->post('city1',TRUE), 'postcode' => $this->input->post('postcode1',TRUE), 'phone' => $this->input->post('phone1',TRUE),
            'email' => $this->input->post('email1',TRUE));

        $this->db->where('user_id', $user_id);
        $this->db->where('addr_type', 'shipping');
        $query1 = $this->db->get('tbl_member_address');
        if ($query1->num_rows() > 0) {
            $this->db->where('user_id', $user_id);
            $this->db->where('addr_type', 'shipping');
            $this->db->update('tbl_member_address', $data1);
        }
        else
            $this->db->insert('tbl_member_address', $data1);
    }

    function getTotalMembers($mem_type) {
        $options = array('activated' => $mem_type);
        if ($mem_type != "")
            $query = $this->db->getwhere('tbl_members', $options);
        else
            $query = $this->db->get('tbl_members');

        return $query->num_rows();
    }

    function getCurrentLoggedMembers() {
        $today = date('Y-m-d');

        $thisMorning = $today . ' 00:00:00';
        $thisMorningTimestamp = strtotime($thisMorning);
        $sql = "select * from tbl_login where lastlogin>='$thisMorningTimestamp' and active = '1' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return 0;
    }

    function checkMemberStatus($mem_id) {
        $sql = "SELECT status FROM tbl_members WHERE user_id='?'";
        $query = $this->db->query($sql,array($mem_id));
        $status = $query->row();
        return $status->status;
    }

    //////////FRONT MEMBER FUNCTION/////////////////////////////
    function updateMember() {

        $dod = $this->input->post('dod');
        $dom = $this->input->post('dom');
        $doy = $this->input->post('doy');


        $user_type = $this->input->post('user_type',TRUE);
        $dob = mktime(0, 0, 0, $dom, $dod, $doy);

        $website = $this->input->post('website',TRUE);
        $other_website1 = $this->input->post('other_website1',TRUE);
        $other_website2 = $this->input->post('other_website2',TRUE);
        if ($website != '') {
            if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $website))
                $website = $this->input->post('website',TRUE);
            else
                $website = 'http://' . $website;
        }
        else
            $website='';

        if ($other_website1 != '') {
            if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $other_website1))
                $other_website1 = $this->input->post('other_website1',TRUE);
            else
                $other_website1 = 'http://' . $other_website1;
        }
        else
            $other_website1='';

        if ($other_website2 != '') {
            if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $other_website2))
                $other_website2 = $this->input->post('other_website2',TRUE);
            else
                $other_website2 = 'http://' . $other_website2;
        }
        else
            $other_website2='';
        //echo $website; exit;
        $data = array('first_name' => $this->input->post('fname',TRUE),
            'last_name' => $this->input->post('lname',TRUE),
            'gender' => $this->input->post('gender',TRUE),
            'dob' => $dob,
            'website' => $website,
            'other_website1' => $other_website1,
            'other_website2' => $other_website2,
            'profile_description' => $this->input->post('profile_description',TRUE),
            'subject' => $this->input->post('subject',TRUE),
        );
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $this->db->where('member_id', $user_id);
        $updated = $this->db->update('tbl_member_profile', $data);

        if ($user_type != 0) {
            $data1 = array('company_name' => $this->input->post('company_name',TRUE),
                'company_website' => $this->input->post('company_website',TRUE),
                'company_info' => $this->input->post('company_desc',TRUE),
                'personal_information' => $this->input->post('personal_desc',TRUE)
            );

            $this->db->where('member_id', $this->session->userdata('wannaquiz_user_id'));
            $updated1 = $this->db->update('tbl_advertisers', $data1);

            $banners = $this->Quiz_model->get_profile_banners($user_id);
            //echo $banners[0]->banner_image;
            //print_r($_FILES);
            if (count($banners) < 1) {
                for ($i = 1; $i <= 2; $i++) {
                    if ($_FILES['banner' . $i]['name'] != '') {
                        $data = array('advertiser_id' => $user_id,
                            'banner_image' => $_FILES['banner' . $i]['name']
                        );
                        $this->db->insert('tbl_advertiser_banner_ads', $data);
                    }
                }
            } else {

                for ($i = 1; $i <= 2; $i++) {
                    if ($_FILES['banner' . $i]['name'] != '') {

                        unlink('./advertiser_banners/' . $banners[$i - 1]->banner_image);
                        $updated_data = array(
                            'banner_image' => $_FILES['banner' . $i]['name']
                        );
                        $this->db->where('advertiser_id', $user_id);
                        $this->db->where('quiz_id', 0);

                        $this->db->where('banner_id', $banners[$i - 1]->banner_id);
                        $this->db->update('tbl_advertiser_banner_ads', $updated_data);
                    }
                }
            }
        }

        if ($updated)
            return 1;
        if ($updated1)
            return 2;
        if ($updated && $updated1)
            return 3;
        else
            return 0;
    }

    function check_password($password) {
        $query = $this->db->getwhere('tbl_members', array('user_id' => $this->session->userdata('wannaquiz_user_id'), 'password' => md5($password)));
        $row = $query->row();
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $row->user_id;
        }
    }

    function updatePassword($new) {
        $data = array('password' => md5($new));
        $this->db->where('user_id', $this->session->userdata('wannaquiz_user_id'));
        $this->db->update('tbl_members', $data);
    }

    function updateEmail($new) {
        $data = array('email' => $new);
        $this->db->where('member_id', $this->session->userdata('wannaquiz_user_id'));
        $this->db->update('tbl_member_profile', $data);
    }

    function updateProfilePicture($filename) {

        $prev_pro_picture = $this->get_member_profile_image($this->session->userdata('wannaquiz_user_id'));
        if (file_exists(UPLOADS . "/" . $prev_pro_picture)) {
            unlink(UPLOADS . "/" . $prev_pro_picture);
            unlink(PROFILE_IMAGES_THUMB . "/" . $prev_pro_picture);
            unlink(PROFILE_IMAGES . "/" . $prev_pro_picture);
            unlink(FRIENDS_IMAGES . "/" . $prev_pro_picture);
        }

        $data = array('profile_picture' => $filename);
        $this->db->where('member_id', $this->session->userdata('wannaquiz_user_id'));
        $this->db->update('tbl_member_profile', $data);
    }

    function get_member_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_members');
        return $query->row();
    }

    function get_member_profile_image($user_id) {
        $this->db->where('member_id', $user_id);
        $query = $this->db->get('tbl_member_profile');
        $data = $query->row();
        return $data->profile_picture;
    }

    function getTotalRefered() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "Select * FROM tbl_members where referer_id=?";
        $query = $this->db->query($sql, array($user_id));
        return $query->num_rows();
    }

    // Send Friend request and main functions

    function send_friend_request($friend_id) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select friend_id from tbl_member_friends where friend_id=? and user_id=?";
        $query = $this->db->query($sql, array($friend_id, $user_id));
        if ($query->num_rows() > 0) {
            return "2";
        } else {
            $data = array('user_id' => $user_id, 'friend_id' => $friend_id, 'created' => current_date_time_stamp());
            $this->db->insert('tbl_member_friends', $data);

            //send email to the friend
            $subject = "Friend request";
            $content = "Wants to be friends with you!";

            // insert into message table
            $data = array('subject' => $subject, 'content' => $content, 'user_id' => $user_id, 'recipient_id' => $friend_id, 'created' => current_date_time_stamp());
            $this->db->insert('tbl_messages', $data);
            return "1";
        }
    }

    function reply_message() {
        $user_id = $this->session->userdata('wannaquiz_user_id');

        //send email to the friend
        $friend_id = $this->input->post('id');

        $mail_id = $this->input->post('mail_id');

        $message_info = $this->get_message($mail_id);

        $message = $message_info->content . '<p>Reply :' . $this->input->post('message');
        $subject = "Re:" . $message_info->subject;
        // insert into message table
        $data = array('subject' => $subject, 'content' => $message, 'user_id' => $user_id, 'recipient_id' => $friend_id, 'created' => current_date_time_stamp(), 'parent_id' => $mail_id);
        $this->db->insert('tbl_messages', $data);
    }

    function send_message() {
        $sender = $this->input->post('sender');
        //echo $sender;
        if ($sender == '')
            $user_id = $this->session->userdata('wannaquiz_user_id');
        else
            $user_id = '0';
        //echo $user_id;exit;
        //send email to the friend
        $friend_id = $this->input->post('id');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        // insert into message table
        $data = array('subject' => $subject, 'content' => $message, 'user_id' => $user_id, 'recipient_id' => $friend_id, 'created' => current_date_time_stamp());
        // $this->db->insert('tbl_messages',$data);
        if ($this->db->insert('tbl_messages', $data))
            return true;
        else
            return false;
    }

    function mail_received() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "Select ms.*,m.user_id, m.username ,mf.first_name,mf.last_name FROM 
            tbl_messages ms,tbl_members m,tbl_member_profile mf where ms.recipient_id=? 
            and  recipient_delete_flag='0' and m.user_id=ms.recipient_id and m.user_id=mf.member_id order by ms.created DESC";
        $query = $this->db->query($sql, array($user_id));
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_sender_receiver($id, $type) {
        if ($type == 0)
            $user = 'user_id';
        else
            $user = 'recipient_id';
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select m.* from tbl_members m,tbl_messages ms where m.user_id=ms.$user and ms.id=?";
        $query = $this->db->query($sql, array($id));
        $data = $query->row();
        return $data->username;
    }

    function mail_sent() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "Select ms.*,m.user_id,m.username ,mf.first_name,mf.last_name FROM
            tbl_messages ms,tbl_members m,tbl_member_profile mf where ms.user_id=? 
            and  ms.user_delete_flag='0' and m.user_id=ms.user_id and m.user_id=mf.member_id
            order by ms.created DESC";
        $query = $this->db->query($sql, array($user_id));
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_message($id) {
        $sql = "Select ms.*,m.user_id,m.username,mf.first_name,mf.last_name,mf.profile_picture FROM tbl_messages ms,tbl_members m,tbl_member_profile mf where ms.id=? and m.user_id=ms.recipient_id and m.user_id=mf.member_id";
        $query = $this->db->query($sql, array($id));
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else {
            $sql1 = "Select ms.*FROM tbl_messages ms where ms.id=?";
            $query1 = $this->db->query($sql, array($id));
            if ($query1->num_rows() > 0)
                $result = $query1->row();
            if ($result->user_id == 0) {
                $sql2 = "Select ms.*, a.* FROM tbl_messages ms,tbl_administrators a where ms.id=? and a.id='1'";
                $query2 = $this->db->query($sql2, array($id));
                if ($query2->num_rows() > 0)
                    return $query2->row();
            }
        }
    }

    function get_messagereceive($id) {
        $sql = "Select ms.*,m.user_id,m.username,mf.first_name,mf.last_name,mf.profile_picture FROM tbl_messages ms,tbl_members m,tbl_member_profile mf where ms.id=? and m.user_id=ms.user_id and m.user_id=mf.member_id";
        $query = $this->db->query($sql, array($id));
        // echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row();
        else {
            $sql1 = "Select ms.*FROM tbl_messages ms where ms.id=?";
            $query1 = $this->db->query($sql, array($id));
            if ($query1->num_rows() > 0)
                $result = $query1->row();
            if ($result->user_id == 0) {
                $sql2 = "Select ms.*, a.* FROM tbl_messages ms,tbl_administrators a where ms.id=? and a.id='1'";
                $query2 = $this->db->query($sql2, array($id));
                if ($query2->num_rows() > 0)
                    return $query2->row();
            }
        }
    }

    function get_message_replies($id) {

        $sql = "Select ms.*,m.user_id,m.username,mf.first_name,mf.last_name,mf.profile_picture FROM tbl_messages ms,tbl_members m,tbl_member_profile mf where ms.parent_id=? and m.user_id=ms.user_id and m.user_id=mf.member_id order by ms.created";
        $query = $this->db->query($sql, array($id));

        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function set_message_read($id) {
        $data = array('read_flag' => '1');
        $this->db->where('id', $id);
        $this->db->update('tbl_messages', $data);
    }

    function delete_message() {
        $id = $this->input->post('mail_id',TRUE);
        $type = $this->input->post('type',TRUE);

        $data = array('recipient_delete_flag' => '1');
        $data1 = array('recipient_delete_flag' => '1');

        $this->db->where('id', $id);
        $this->db->update('tbl_messages', $data);


        $this->db->where('parent_id', $id);
        $this->db->update('tbl_messages', $data1);
    }

    function delete_bulk_messages($msg_type) {
        $ids = $this->input->post('ids',TRUE);
        $ids = rtrim($ids, ',');

        $id = explode(',', $ids);

        for ($i = 0; $i < count($id); $i++) {
            if ($msg_type == 'sent')
                $data = array('user_delete_flag' => '1');
            else
                $data=array('recipient_delete_flag' => '1');
            $this->db->where('id', $id[$i]);
            $this->db->update('tbl_messages', $data);
            //echo $this->db->last_query();

            $this->db->where('parent_id', $id[$i]);
            $this->db->update('tbl_messages', $data);
        }
    }

    function delete_questions() {
        $ids = $this->input->post('ids',TRUE);
        //echo $ids; exit;
        $ids = rtrim($ids, ',');
        //print_r($ids);exit;
        $id = explode(',', $ids);
        // echo count($id); exit;
        $result = "";
        for ($i = 0; $i < count($id); $i++) {
            //$check = $this->check_quiz($id[$i]);
            //if($check) {

            $data = array('status' => '0'); // status 0 means closed
            $this->db->where('quiz_id', $id[$i]);
            $this->db->update('tbl_quizes', $data);

            //}
            // else $result = "false";
        }
        return true;
    }

    function check_quiz($id) {
        $sql = "select qa.quiz_id from tbl_quiz_answers qa,tbl_quizes q where q.quiz_id=qa.quiz_id and qa.quiz_id='$id'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
            return false;
        else
            return true;
    }

    function block_friend($friend_id) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "update tbl_member_friends set block = 1 where friend_id =? and user_id =?";
        $query = $this->db->query($sql, array($friend_id, $user_id));
        if ($query)
            return true;
        else
            return false;
    }

    function unblock_friend($friend_id) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "update tbl_member_friends set block = 0 where friend_id =? and user_id =?";
        $query = $this->db->query($sql, array($friend_id, $user_id));
        if ($query)
            return true;
        else
            return false;
    }

    function get_quiz_info($quiz_id) {
        $sql = "select * from tbl_quizes q,tbl_quiz_options qo where q.quiz_id=qo.quiz_id and q.quiz_id=?";
        $query = $this->db->query($sql, array($quiz_id));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return NULL;
    }

    function profile_commit() {
        $profile_id = $this->input->post('profile_id',TRUE);
        $comentator_id = $this->input->post('user_id',TRUE);
        $comment = $this->input->post('comment',TRUE);

        $data = array('user_id' => $profile_id,
            'comentator_id' => $comentator_id,
            'comment' => $comment,
            'coment_date' => current_date_time_stamp()
        );
        $insert_data = $this->db->insert('tbl_member_comments', $data);
        if ($insert_data)
            return true;
        else
            return false;
    }

    function profile_reply_commit() {
        $profile_id = $this->input->post('profile_id',TRUE);
        $comment_id = $this->input->post('comment_id',TRUE);
        $comentator_id = $this->input->post('user_id',TRUE);
        $comment = $this->input->post('comment',TRUE);

        $data = array('user_id' => $profile_id,
            'comment_reply_id' => $comment_id,
            'comentator_id' => $comentator_id,
            'comment' => $comment,
            'coment_date' => current_date_time_stamp()
        );
        $insert_data = $this->db->insert('tbl_member_comments', $data);
        if ($insert_data)
            return true;
        else
            return false;
    }

    function delete_member_comment($comment_id) {
        $this->db->where('comment_id', $comment_id);
        $query = $this->db->delete('tbl_member_comments');
        if ($query)
            return true;
        else
            return false;
    }

    function delete_member_comment_reply($comment_reply_id) {
        $this->db->where('comment_id', $comment_reply_id);
        $query = $this->db->delete('tbl_member_comments');
        if ($query)
            return true;
        else
            return false;
    }

    function spam_member_comment($comment_id) {
        $flag = $this->input->post('flag',TRUE);
        if ($flag == 'comment')
            $this->db->where('comment_id', $comment_id);
        else
            $this->db->where('comment_reply_id', $comment_id);
        $query = $this->db->update('tbl_member_comments', array('spam' => '1'));
        if ($query)
            return true;
        else
            return false;
    }

    function get_spam_member_comment($comment_id) {
        $sql = "select * from tbl_member_comments where comment_id='?'";
        $query = $this->db->query($sql,array($comment_id));
        if ($query->num_rows() > 0)
            return $query->row()->comment;
        else
            return null;
    }

    function get_reply_comments($id) {
        $sql = "select mc.*,m.username from tbl_member_comments mc,tbl_members m,tbl_member_profile mp where mc.comentator_id=m.user_id and mc.comentator_id=mp.member_id and comment_reply_id=?  and mc.status='1'";
        $query = $this->db->query($sql, array($id));
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function get_profile_comments($mem_id, $num, $offset) { //echo $num.'/'.$offset;
        if ($num == 0 && $offset == 0)
            $limit = '';
        else
            $limit=" LIMIT $offset,$num";
        $sql = "select mc.*,mp.*,m.username from tbl_member_comments mc,tbl_members m,tbl_member_profile mp where mc.comentator_id=m.user_id and mc.comentator_id=mp.member_id and mc.comment_reply_id='0'and mc.user_id=? and mc.status='1' order by coment_date DESC" . $limit;
        $query = $this->db->query($sql, array($mem_id));
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function count_profile_comments($mem_id) {

        $sql = "select * from tbl_member_comments where user_id=?";
        $query = $this->db->query($sql, array($mem_id));
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return 0;
    }

    function get_profile_comment_like($comment_id) {
        $sql = "select * from tbl_member_comment_likes where comment_id =? and like_status ='1'";
        $query = $this->db->query($sql,array($comment_id));

        return $query->num_rows();
    }

    function get_profile_comment_unlike($comment_id) {
        $sql = "select * from tbl_member_comment_likes where comment_id =? and like_status ='0'";
        $query = $this->db->query($sql,array($comment_id));

        return $query->num_rows();
    }

    function like_profile_comment() {
        $comment_id = $this->input->post('comment_id',TRUE);
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $status = $this->input->post('status',TRUE);
        $sql = "select * from tbl_member_comment_likes where user_id = ? and comment_id = ?";
        $query = $this->db->query($sql,array($user_id,$comment_id));
        if ($query->num_rows() > 0)
            return 0;
        else {
            $data = array('comment_id' => $comment_id,
                'user_id' => $user_id,
                'like_status' => $status,
                'like_date' => current_date_time_stamp()
            );
            $insert_data = $this->db->insert('tbl_member_comment_likes', $data);
            if ($insert_data)
                return true;
            else
                return false;
        }
    }

    function check_subscriber($mem_id) {

        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select * from tbl_member_subscribers where user_id=? and subscriber_id=?";
        $query = $this->db->query($sql, array($user_id, $mem_id));
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $status = $data->status;
            if ($status == 1)
                return "subscribed";
            else
                return "unsubscribed";
        }
        else
            return "unsubscribed";
    }

    function get_followings($user_id, $num=null, $offset=null) {
        //echo $num.'/'.$offset;
        $limit = " LIMIT $offset,$num";
        if ($num != null || $offset != null)
            $sql = "select ms.*,mf.profile_picture,m.* from tbl_member_subscribers ms,tbl_member_profile mf,tbl_members m where ms.subscriber_id=mf.member_id and ms.subscriber_id=m.user_id and ms.user_id=? and ms.status='1' $limit";
        else
            $sql = "select ms.*,mf.profile_picture,m.* from tbl_member_subscribers ms,tbl_member_profile mf,tbl_members m where ms.subscriber_id=mf.member_id and ms.subscriber_id=m.user_id and ms.user_id=? and ms.status='1'";
        $query = $this->db->query($sql, array($user_id));
        //echo $this->db->last_query($sql);
        if ($query->num_rows() > 0)
        //print_r($query->result());
            return $query->result();
        else
            return null;
    }

    function get_followers($user_id, $num=null, $offset=null) {
        $limit = " LIMIT $offset,$num";
        if ($num != null || $offset != null)
            $sql = "select ms.*,mf.profile_picture,m.* from tbl_member_subscribers ms,tbl_member_profile mf,tbl_members m where ms.user_id=mf.member_id and ms.user_id=m.user_id and ms.subscriber_id=? and ms.status='1' $limit";
        else
            $sql = "select ms.*,mf.profile_picture,m.* from tbl_member_subscribers ms,tbl_member_profile mf,tbl_members m where ms.user_id=mf.member_id and ms.user_id=m.user_id and ms.subscriber_id=? and ms.status='1'";
        $query = $this->db->query($sql, array($user_id));
        if ($query->num_rows() > 0)
        //print_r($query->result());
            return $query->result();
        else
            return null;
    }

    function set_subscriber() {
        $profile_id = $this->input->post('profile_id',TRUE);
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $status = $this->input->post('status',TRUE);

        $sql = "select * from tbl_member_subscribers where user_id=? and subscriber_id=?";
        $query = $this->db->query($sql, array($user_id, $profile_id));
        if ($query->num_rows() > 0 && $status == 1) {
            $data = $query->row();
            $subscribed_id = $data->id;
            $update_data = array('status' => 1);
            $this->db->where('id', $subscribed_id);
            $result = $this->db->update('tbl_member_subscribers', $update_data);
            if ($result)
                return 'subscribed';
            else
                return false;
        }
        elseif ($query->num_rows() > 0 && $status == 0) {
            $data = $query->row();
            $subscribed_id = $data->id;
            $update_data1 = array('status' => 0);
            $this->db->where('id', $subscribed_id);
            $result = $this->db->update('tbl_member_subscribers', $update_data1);
            if ($result)
                return 'unsubscribed';
            else
                return false;
        }
        else {
            $data = array('user_id' => $user_id,
                'subscriber_id' => $profile_id,
                'status' => $status,
                'subscribe_date' => current_date_time_stamp()
            );
            $insert_data = $this->db->insert('tbl_member_subscribers', $data);
            if ($insert_data)
                return 'inserted';
            else
                return false;
        }
    }

    function check_member_friend($user_id, $recipent_id) { //echo $user_id.'/'.$recipent_id;
        $sql = "select * from tbl_member_friends where friend_id=? and user_id=? and status = '0'";
        $query = $this->db->query($sql, array($user_id, $recipent_id));
        return $query->result_array();
    }

    function add_friend($friend_id) {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $sql = "select friend_id from tbl_member_friends where friend_id=? and user_id=? and status ='1'";
        $query = $this->db->query($sql, array($friend_id, $user_id));
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $data = array('user_id' => $user_id,
                'friend_id' => $friend_id,
                'status' => '1',
                'block' => '0',
                'created' => current_date_time_stamp()
            );
            $this->db->insert('tbl_member_friends', $data);

            $data1 = array('status' => '1');
            $this->db->where(array('user_id' => $friend_id, 'friend_id' => $user_id));
            $this->db->update('tbl_member_friends', $data1);
            return true;
        }
    }

    function delete_friend() {
        $ids = $this->input->post('ids',TRUE);
        $ids = rtrim($ids, ',');
        $id = explode(',', $ids);
        $result = "";
        for ($i = 0; $i < count($id); $i++) {
            $this->db->where('friend_id', $id[$i]);
            $this->db->delete('tbl_member_friends');
        }
        return true;
    }

    function delete_video_content($video_id) {
        $ids = $this->input->post('ids',TRUE);
        $ids = rtrim($ids, ',');
        //print_r($ids);exit;
        $id = explode(',', $ids);
        // echo count($id); exit;
        $result = "";
        for ($i = 0; $i < count($id); $i++) {
            $this->db->where('video_id', $id[$i]);
            $this->db->delete('tbl_members_videos');
        }
        //if($this->db->delete('tbl_members_videos'))
//
        return true;
//        else return false;
    }

    function delete_photo_content() {
        $ids = $this->input->post('ids',TRUE);
        $ids = rtrim($ids, ',');
        #print_r($ids);exit;
        $id = explode(',', $ids);
        // echo count($id); exit;
        $result = "";
        for ($i = 0; $i < count($id); $i++) {
# get photo name and delete image and thumbnail
            $this->db->where('photo_id', $id[$i]);
            $this->db->select('photo_name');
            $photo = $this->db->get('tbl_members_photos');

            if ($photo->num_rows() > 0) {
                $photo_data = $photo->row();
                $photo_name = $photo_data->photo_name;

                @unlink('./user_uploaded_photos/' . $this->session->userdata('wannaquiz_user_id') . '/' . $photo_name);

                if (!$this->check_quiz_image($photo_name)) {#($id[$i]))
                    @unlink('./photo_question_images/' . $photo_name);
                    @unlink('./photo_question_thumbs/' . $photo_name);

                    $this->db->where('photo_id', $id[$i]);
                    $this->db->delete('tbl_members_photos');
                } else {
                    $this->db->where('photo_id', $id[$i])->update('tbl_members_photos', array('deleted' => '1'));
                }
            }
        }
        //if($this->db->delete('tbl_members_photos'))
        return true;
        //else return false;
    }

    function delete_playlist_quiz() {
        $qid = $this->input->post('ids',TRUE);
        $this->db->where('quiz_id', $qid);
        $query = $this->db->delete('tbl_quiz_playlist');
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $this->db->where('user_id', $user_id);
        $play_list = $this->db->get('tbl_quiz_playlist');
        if (!$play_list->num_rows() > 0) {
            $user_id = $this->session->userdata('wannaquiz_user_id');
            $this->db->where('user_id', $user_id);
            $this->db->delete('tbl_playlist');
        }
        if ($query)
            return true;
        else
            return false;
    }

    function member_transactions($mem_id, $num=null, $offset=null) {
        if ($num != null || $offset != null)
            $limit = " LIMIT $offset,$num";
        else
            $limit='';
        $sql = "select t.invoice, t.user_id, t.payment_status,t.payment_method, t.received_amount,t.gross_amount, t.pay_time,t.item_name, m.user_id from tbl_transaction_info t, tbl_members m where m.user_id=? and t.user_id=m.user_id $limit";
        $query = $this->db->query($sql, array($mem_id));
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_new_messages() {
        $user_id = $this->session->userdata('wannaquiz_user_id');
        $this->db->where('recipient_id', $user_id);
        $this->db->where('read_flag', 0);
        $this->db->where('recipient_delete_flag', 0);
        $query = $this->db->get('tbl_messages');
        if ($query->num_rows() > 0)
            return $query->num_rows();
        else
            return null;
    }

    function update_moderator() {

        $user_id = $this->input->post('member_id',TRUE);
        #$vertical_code = $this->input->post('user_vertical_code');
        #$rectangular_code = $this->input->post('user_rectangular_code');
        //$this->db->where('user_id',$user_id);
        //  $query = $this->db->update('tbl_members',array('moderator'=>'1'));
        # $query1 = $this->db->get('tbl_moderator');
        # if($query1->num_rows()>0)
        #return false;
        # else {
        $data = array('user_id' => $user_id,
            #'user_vertical_code'=>$vertical_code,
            #'user_rectangular_code'=>$rectangular_code,
            'active' => 0,
                #'ad_type'=>$this->input->post('ad_type')
        );

        $query = $this->db->insert('tbl_moderator', $data);
        #}
    }

    function upgrade_partner() {
        $user_id = $this->input->post('user_id',TRUE);
        $text1 = $this->input->post('user_vertical_code',TRUE);
        $vertical_code = str_replace('�', '"', $text1);
        $text2 = $this->input->post('user_rectangular_code',TRUE);
        $rectangular_code = str_replace('�', '"', $text2);

        //$vertical_code = base64_encode($vertical_code);
        //$rectangular_code = base64_encode($rectangular_code);
        $this->db->where('user_id', $user_id);
        $query1 = $this->db->get('tbl_partners');
        if ($query1->num_rows() > 0)
            return false;
        else {
            $data = array('user_id' => $user_id,
                'user_vertical_code' => $vertical_code,
                'user_rectangular_code' => $rectangular_code,
                'active' => 0,
                'ad_type' => $this->input->post('ad_type',TRUE)
            );
            $query = $this->db->insert('tbl_partners', $data);
            //echo $this->db->last_query();

            if ($query)
                return true;
            else
                return false;
        }
    }

    function get_user_banners($user_id) {
        $this->db->where('quiz_id', 0);
        $this->db->where('advertiser_id', $user_id);
        $query = $this->db->get('tbl_advertiser_banner_ads');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return null;
    }

    function check_user_partner($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_partners');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

    function set_moderator_request($user_id) {
        #ini_set('display_errors',1);
        $data = array('user_id' => $user_id, 'active' => '0', 'request_time' => date('H:i:s'));
        $this->db->insert('tbl_moderator', $data);
#        echo $this->db->last_query();
    }

    function check_moderator_request($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_moderator');
        #echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    function check_delete($user_id) {
        $this->db->where('user_id', $user_id);
        $res = $this->db->get('tbl_moderator');
        return $res->row_array();
    }

    function check_user_moderator($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('moderator', '1');
        $query = $this->db->get('tbl_members');
        #echo $this->db->last_query();        
        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    function get_user_partner_info($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_partners');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function get_owner_info($quiz_id) {
        $sql = "select * from tbl_quizes q,tbl_members m,tbl_member_profile mp where q.user_id = m.user_id and m.user_id = mp.member_id and q.quiz_id='?'";
        $query = $this->db->query($sql,array($quiz_id));
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function get_member_cpc($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_member_cpc');
        if ($query->num_rows() > 0)
            return $query->row();
        else
            return null;
    }

    function get_default_user_credits() {
        $sql = "select user_credits from tbl_site_settings";
        $query = $this->db->query($sql);
        return $query->row()->user_credits;
    }

//----------------------------------------------------
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */