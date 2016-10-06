<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<title>WANNA QUIZ :: How It Works</title>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/form.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu-v.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>

<script type="text/javascript">

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

</script>


<!--[if lte IE 6]>
	<link href="css/ie-6.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/unitpngfix.js"></script>
<![endif]-->

<!--[if IE 7]>
	<link href="css/ie-7.css" rel="stylesheet" type="text/css" />
<![endif]--> 

<!--[if IE 8]>
	<link href="css/ie-8.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body>

	<?php include('includes/howitwork_header.php'); ?>


<div id="body_wrap">
	<div class="bodywrapInner">
        <div class="home_leftside">
            <div>
                
                <?php include('includes/member_links.php'); ?>
                
                <?php include('includes/personalscoreboard.php'); ?>
        
                <div class="clear"></div>
            </div>
            
        </div>
        
        <?php include('includes/helplinks.php'); ?>
    
    	<div class="clear"></div>
    </div>
</div>

<div class="footer_bg">
    <?php include('includes/footer.php'); ?>
</div>
</body>
</html>
