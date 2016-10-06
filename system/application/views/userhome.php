<?php 
//echo $_SESSION['target_city'];
//$address=explode(",",$_SESSION['target_city']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<title>WANNA QUIZ :: Member</title>
<link href="<?=base_url()?>css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/styles.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu-v.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/examples.css" />
<script>base_url='<?=base_url()?>';</script>

<script type="text/javascript" src="<?=base_url()?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ddsmoothmenu.js"></script>

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

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

/*ddsmoothmenu.init({
	mainmenuid: "smoothmenu3", //Menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-h', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})*/
        }catch (error){}
});
    
   
</script>


</head>

<body>
<div class="header_bg">
	<?php 
	if(isset($flg) && $flg=='home')
		include('include/home_header.php');
	else
		include('include/loggedin_header.php');
	?>
</div>

<?php $this->load->view($main); ?>

<div class="footer_bg">
    <?php include('include/footer.php'); ?>
</div>

    
</body>
</html>
