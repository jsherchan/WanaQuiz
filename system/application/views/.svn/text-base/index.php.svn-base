<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<title><?=$title?></title>
<link href="<?=base_url()?>css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/styles.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/game.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/examples.css" />

<script type="text/javascript"> base_url='<?=base_url()?>';</script>
<!--<script type="text/javascript" src="<?=base_url()?>js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ddsmoothmenu.js">


</script>

<script type="text/javascript">
 $(document).ready(function(){ 
     try{
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
 }catch(error){}
/*
 ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})*/
        });
</script>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('images/favicon.ico')?>" />
</head>

<body>
   
    <div class="header_bg">
	<?php 
	if(isset($flg) && $flg=='home' && $this->session->userdata('wannaquiz_user_id')=='')
		include('include/home_header.php');
	else
		include('include/loggedin_header.php');
	?>
</div>
    <div style="clear:both">
<?php $this->load->view($main); ?>
    </div>

<div class="footer_bg">
    <?php include('include/footer.php'); ?>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20748508-1']);
  _gaq.push(['_trackPageview']);
/*
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' [^] : 'http://www') [^] ) + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
*/
</script> 
 
</body>
</html>


<?php
 require('ip2locationlite.php');
 
//Set geolocation cookie
if(!$_COOKIE["geolocation[two]"]){
  $ipLite = new ip2location_lite;
  $ipLite->setKey('5c328c0f713b6bc1cade0e28ad7ed7c4383ee264c926433c982f38e20fa653b7');
 

  $visitorGeoloc = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
   if ($visitorGeolocation['statusCode'] == 'OK') {
    $data = base64_encode(serialize($visitorGeolocation));
	 $datas = base64_encode(serialize($visitorGeoloc));
  
	setcookie("geolocation[two]", $datas,  time()+3600*24*7); //set cookie for 1 week
  }
}else{
  
  $visitorGeoloc = unserialize(base64_decode($_COOKIE["geolocation[two]"]));
}
//print_r($visitorGeoloc);
//echo "fsfd".$visitorGeoloc['countryCode'].",".$visitorGeoloc['regionName'].",".$visitorGeoloc['cityName'];
//$targets=$visitorGeoloc['countryCode'].",".$visitorGeoloc['regionName'].",".$visitorGeoloc['cityName'];
 if($visitorGeoloc)
 {
 $_SESSION['city_target']=$visitorGeoloc['cityName'];
 $_SESSION['country_target']=$visitorGeoloc['countryCode']; 
 }
//     if($visitorGeoloc)
//{
//    $this->session->set_userdata('city_target',$visitorGeoloc['cityName']); 
//    $this->session->set_userdata('country_target',$visitorGeoloc['countryName']);
//}