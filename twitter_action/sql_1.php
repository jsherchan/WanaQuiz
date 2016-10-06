<?php

/* * Database connect function** */
$con = mysql_connect('localhost', 'wannaquiz_user', 'oeBddY6i');
mysql_select_db('wannaquiz_site', $con);
/* * ****************** */
//$site	= "http://localhost/neomundo/";
$site = "http://www.wannaquiz.com";

//$con=mysql_connect('localhost','root','');
//mysql_select_db('neomundo',$con);


class twitter_query {
    /* function is_registered($twitter_id) {
      $qry = "select id from tbl_mem where twitter_id = '$twitter_id'";

      $res = mysql_query($qry);
      return mysql_num_rows($res);
      }

      function get_user_id($id) {
      $qry = "select id from tbl_mem where twitter_id = '$id'";
      $res = mysql_query($qry);
      $data = mysql_fetch_assoc($res);
      return $data['id'];
      } */

    function isOurUser($fb_uid) {
        $qry = "select user_id from tbl_members where twitter_uid='$fb_uid'";
        $res = mysql_query($qry);
        if (mysql_num_rows($res) != 0) {
            return 'old';
        } else {
            return 'new';
        }
    }

    function create_user($me) {
#var_dump($me);
#xit;
        //$this->load->model('Award_model');
        $current_date = current_date_time_stamp();

        #$bday = explode('/',$me['birthday']);            
        #$dod = $bday[1];
        #$dom = $bday[0];
        #$doy = $bday[2];
        #$dob = mktime(0,0,0,$dom,$dod,$doy);            
#            $dob = '';
        $name = explode(' ', $me['name']);
#exit($name[0]);                   
        /* $options = array(
          'username' => $me['id'],
          'twitter_uid' => $me['id'],
          'joined_date' => $current_date,
          'user_credits' => '0');

          $this->db->insert('tbl_members', $options);
          $id = $this->db->insert_id(); */
        $username = $me['id'];
        $twitter_id = $me['id'];
        $query = "insert into tbl_members set username = '$username', twitter_id='$twitter_id' ,joined_date='$current_date',user_credits='0'";
        $res = mysql_query($query);
        $id = mysql_insert_id();

        /* $options2 = array('member_id' => $id);
          $this->db->insert('tbl_address', $options2); */
        $query = "insert into tbl_address set member_id = '$id'";
        $res = mysql_query($query);

        /* $options1 = array(
          'first_name' => $name[0],
          #'last_name'=>$me['last_name'],
          #           'email'=>$me['email'],
          #            'gender'=> $me['gender'],
          #            'dob'=>$dob,
          #            'website' => $me['link'],
          'profile_picture' => $me['profile_image_url'],
          'joined_date' => $current_date,
          'member_id' => $id);
          $this->db->insert('tbl_member_profile', $options1); */
        $first_name = $name[0];
        $profile_pic = $me['profile_image_url'];
        $query = "insert into tbl_member_profile set first_name = '$first_name', profile_picture='$profile_pic' ,joined_date='$current_date',member_id='$id'";
        $res = mysql_query($query);

        /* $categories = $this->Category_model->get_categories();
          foreach ($categories as $category) {
          $data = array('user_id' => $id,
          'category_id' => $category->id,
          'category_titles' => '1',
          'points' => 0
          );
          $this->db->insert('tbl_member_category_titles', $data);
          }

          $this->Award_model->insert_user_category_award($id); */

        return $id;
    }

    function get_user_id($fb_uid) {
        $qry = "select user_id from tbl_members where twitter_uid='$fb_uid'";
        $res = mysql_query($query);
        $data = mysql_fetch_assoc($res);
        return $data['id'];
    }

    function getUser_firstname($id) {
        $qry = "select first_name from tbl_member_profile where member_id='$id'";
        $res = mysql_query($query);
        $data = mysql_fetch_assoc($res);
        return $data['first_name'];
    }

}

?>