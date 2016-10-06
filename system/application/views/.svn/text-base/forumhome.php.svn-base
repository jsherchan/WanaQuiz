<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<title>WANNA QUIZ :: Member</title>

<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
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

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>


<!--[if lte IE 6]>
	<link href="<?=base_url()?>css/ie-6.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?=base_url()?>js/unitpngfix.js"></script>
<![endif]-->

<!--[if IE 7]>
	<link href="<?=base_url()?>css/ie-7.css" rel="stylesheet" type="text/css" />
<![endif]--> 

<!--[if IE 8]>
	<link href="<?=base_url()?>css/ie-8.css" rel="stylesheet" type="text/css" />
<![endif]-->
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
<div id="body_wrap">
	<div class="bodywrapInner">
     <?php $this->load->view('include/advance_search_box.php'); ?>
        <div class="">
            <div>
                
                <?php include('member/forum_panel.php'); ?>
                
               <?php $this->load->view($main); ?>
        
                <div class="clear"></div>
            </div>
            
        </div>
    	<div class="clear"></div>
    </div>
</div>


<div class="footer_bg">
    <?php include('include/footer.php'); ?>
</div>
</body>
</html>
