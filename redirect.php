<?php

/* Start session and load library. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('twitteroauth/tweet.php');
/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
//echo date("Y-m-d H:i:s");
//echo "<br/>";
//var_dump($connection);

/* Get temporary credentials. */
$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
//echo"<br/><br/>";
//var_dump($request_token);



/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];


/* If last connection failed don't display authorization link. */
//echo $connection->http_code;exit;
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
$url = $connection->getAuthorizeURL($token);


    header('Location: ' . $url); 
    break;
  default:
    /* Show notification if something went wrong. */
    echo 'Could not connect to Twitter. Refresh the page or try again later.';
}
