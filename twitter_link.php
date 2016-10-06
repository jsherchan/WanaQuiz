<?php

/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */
/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('twitteroauth/tweet.php');
require_once('twitter_action/sql.php');
$obj = new twitter_query();

/* If access tokens are not available redirect to connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
    $_SESSION['oauth_status'] = 'oldtoken';
    header('Location: ./clearsessions.php');
}
/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
    /* The user has been verified and the access tokens can be saved for future use */
    $_SESSION['status'] = 'verified';

    $content = $connection->get('account/verify_credentials');
    $me = (array) $content;
    /* $twitter_screen_name=$array['screen_name'].'tw';
      $name=$array['name'];
      $twitter_id=$array['id'];
      if($obj->is_registered($twitter_id)!=0){
      $id=$obj->get_user_id($twitter_id);
      $_SESSION['twitter_id']=$id;
      header('Location:'.$site.'home/twitter_verify');
      exit;
      }



      $query="insert into tbl_members set twitter_screen_name = '$twitter_screen_name', twitter_id='$twitter_id' ,name='$name',username='$twitter_screen_name'";
      $res=mysql_query($query);
      $id=mysql_insert_id();
      $detail="insert into tbl_mem_personal_detail set mem_id='$id',name ='$name'";
      mysql_query($detail);


      $_SESSION['twitter_id']=$id; */

    $isOurUser = $obj->isOurUser($me['id']);

    if ($isOurUser == 'new') {
        $user_id = $obj->create_user($me);
        $first_name = $obj->getUser_firstname($user_id);
        /*$data = array(
            'wannaquiz_user_id' => $user_id,
            'wannaquiz_tw_id' => $user_id,
            'first_name' => $first_name,
            'wannaquiz_username' => $me['id']
        );
        $this->session->set_userdata($data);*/
        //$this->logActivity($this->session->userdata('wannaquiz_user_id'), $this->session->userdata('wannaquiz_user_id'), $_SERVER['REMOTE_ADDR'], 'Login');
        //redirect('member/userHome');
    } elseif ($isOurUser == 'old') {
        $user_id = $obj->get_user_id($me['id']);
        $first_name = $obj->getUser_firstname($user_id);
        /*$data = array(
            'wannaquiz_user_id' => $user_id,
            'wannaquiz_fb_id' => $user_id,
            'first_name' => $first_name,
            'wannaquiz_username' => $me['id']
        );
        $this->session->set_userdata($data);*/
        //$this->logActivity($this->session->userdata('wannaquiz_user_id'), $this->session->userdata('wannaquiz_user_id'), $_SERVER['REMOTE_ADDR'], 'Login');
        //redirect('member/userHome');
    }

    header('Location:' . $site . 'home/twitter_verify');
} else {
    /* Save HTTP status for error dialog on connnect page. */
    header('Location: ./clearsessions.php');
}
?>