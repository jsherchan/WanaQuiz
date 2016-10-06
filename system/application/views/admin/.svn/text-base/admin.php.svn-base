<?php 
$sess_uname=$this->session->userdata('admin_user_name'); 
$sess_uid=$this->session->userdata('wannaquiz_admin_user_id');
if($sess_uname=="" || $sess_uid=="")
{
 header("Location:".site_url(ADMIN_PATH.'/admin/'));
 exit();
}
 
$user_info=$this->User_model->getDetails($sess_uid);

if($user_info->group_id==0 && $user_info->access_level==1)
	$getallowedcontrollers=$this->User_model->getAllControllers();
else
	$getallowedcontrollers=$this->User_model->getAllowedControllers($sess_uid);
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$title?></title>
<!-- For smarty template {title} -->

<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_js/interface.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_js/help_tips.js"></script>

<!--link href="<?= base_url()?>css/admin_css/fisheye.css" rel="stylesheet" type="text/css" /-->
<link href="<?= base_url()?>css/admin_css/style.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>css/admin_css/main.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>css/admin_css/ci_functions.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>css/admin_css/admin_left_menu.css" rel="stylesheet" type="text/css" />
<script>
    //$(function(){alert('in')});
</script>


</head>

<body>

<table align="center" width="1004"  border="0"  cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="19"><img src="<?= base_url()?>images/admin_images/top_cor_1.gif" width="19" height="19"></td>
    <td width="947" background="<?= base_url()?>images/admin_images/top_cor_line_1.gif"><img src="<?= base_url()?>images/admin_images/top_cor_line_1.gif" width="5" height="19"></td>
    <td width="19"><img src="<?= base_url()?>images/admin_images/top_cor_2.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td background="<?= base_url()?>images/admin_images/top_cor_line_3.gif"><img src="<?= base_url()?>images/admin_images/top_cor_line_3.gif" width="19" height="6"></td>
    <td valign="top">
	
	<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" align="left"><!--<img src="<?= base_url()?>images/admin_images/logo.jpg" >--></td>
			<td>
			<!-- Header -->
	<div id="header">
		 <div id="time"></div>
		<? if($user_info->group_id==0 && $user_info->access_level==1){?>
			<a href="<?=site_url(ADMIN_PATH.'/change_password')?>" class="button">Change Password</a>
		<? }?>
			<a href="<?=site_url(ADMIN_PATH.'/home')?>" class="button">Home</a>
			<a href="<?=site_url(ADMIN_PATH.'/users/logout')?>" class="button">Logout</a>
		
		
		<div class="border"></div>
	</div>
<!-- /Header -->
			</td>
			
           
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <!--tr>
            <td valign="top" background="<?= base_url()?>images/admin_images/grey_line.gif"><img src="<?= base_url()?>images/admin_images/grey_line.gif" width="4" height="13"></td>
          </tr-->
		  <tr>
            <td height="45" bgcolor="#EEEEEE"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <!--tr>
			  
                <td bgcolor="#EEEEEE">
					<!-- Fish EYE ADMIN HEADER >

<<div id="fisheye" class="fisheye">
		<div style="left: 310px; width: 400px;" class="fisheyeContainter">
		<? /*if(count($getallowedcontrollers)>0){
		for($i=0;$i<count($getallowedcontrollers);$i++){
			$controller=$this->User_model->getControllerInfo($getallowedcontrollers[$i]);
				?>
				<a style="width: 40px; left: 0px;" href="<?= base_url()?>index.php/<?=ADMIN_PATH?>/<?=$controller->controller_link_name?>/" class="fisheyeItem"><img src="<?= base_url()?>images/admin_images/icons/<?=$controller->controller_fisheye_image?>" width="30"><span style="display: none;"><?=$controller->controller_name?></span></a>
		<? }
		}*/?>
		</div>
</div>
<!-- END OF HEADER -->				</td>


			
			  </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
     
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td>
		&nbsp;&nbsp;<font color="#3300FF" size="+1">Welcome !<?=$this->session->userdata('admin_user_name')?></font><a href="<?=site_url('')?>" class="button" target="_blank">Site Preview</a> 
		</td>
		</tr>
          <tr>
            <td width="200" valign="top">
<div id="left">

	<? if (in_array("1", $getallowedcontrollers)) {?>
		<table style="width: 100%; cursor: pointer;" class="header" onClick="SwitchMenu('sub1','hidetext1')" cellpadding="3" cellspacing="0">
			<tr>
				<td style="font-size: 8pt;">
				<img src="<?= base_url()?>css/admin_css/spacer.gif" alt="" class="sqr" style="vertical-align: middle;" height="8" width="8"> Member Management</td>
				<td style="font-size: 7pt; text-align: right;">
				<span class="cur" id="hidetext1">[+]</span>
				</td>
			</tr>
			<tr><td colspan="2"></td>
			</tr>
		</table>

		<div class="sub1" id="sub1" style="display:none;">
				<ul class="navlist">

							<li><a href="<?=site_url(ADMIN_PATH.'/members/members_list/all/joined_date/DESC/')?>" >Total Users: <font color="#FFFFFF"> (<?php echo $this->Member_model->getTotalMembers('')?>)</font></a></li>
       <li><a href="<?=site_url(ADMIN_PATH.'/members/members_list/1/joined_date/DESC/')?>" > Verified Users: <font color="#FFFFFF"> (<?php echo $this->Member_model->getTotalMembers('1')?>)</font></a></li>
       <li><a href="<?=site_url(ADMIN_PATH.'/members/members_list/0/joined_date/DESC/')?>" >Unverified Users: <font color="#FFFFFF"> (<?php echo $this->Member_model->getTotalMembers('0')?>)</font></a></li>
       <li><a href="<?=site_url(ADMIN_PATH.'/members/members_list/current/joined_date/DESC/')?>" >current users logged: <font color="#FFFFFF">(<?php echo $this->Member_model->getCurrentLoggedMembers()?>) </font></a></li>
						
					</ul>
				</div>
		<? }?>
	
	<? if (in_array("9", $getallowedcontrollers)) {?>		
		<table style="width: 100%; cursor: pointer;" class="header" onClick="SwitchMenu('sub3','hidetext3')" cellpadding="3" cellspacing="0">
			<tr>
				<td style="font-size: 8pt;">
				<img src="<?= base_url()?>css/admin_css/spacer.gif" alt="" class="sqr" style="vertical-align: middle;" height="8" width="8"> Content Management</td>
				<td style="font-size: 7pt; text-align: right;">
				<span class="cur" id="hidetext3">[+]</span>
				</td>
			</tr>
		</table>
				<div class="sub3" id="sub3" style="display:none;">
				<ul class="navlist">			   			   			   	
					  <li><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/6')?>" title="WebSite Coniguration" target="_self"> About Us</a></li>
					 <!--  <li><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/13')?>" title="WebSite Coniguration" target="_self"> Contact Us </a></li>-->
					  <li><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/11')?>" title="WebSite Coniguration" target="_self"> Privacy Policy</a></li> 
					  <li><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/37')?>" title="WebSite Coniguration" target="_self"> Terms &amp; Conditions </a></li>
						 <li><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/42')?>" title="WebSite Coniguration" target="_self">  Help</a></li>
						
					 
						</ul>
				</div>
		<? }?>	
				
	<table style="width: 100%; cursor: pointer;" class="header" onClick="SwitchMenu('sub4','hidetext4')" cellpadding="3" cellspacing="0">
	<tr>
		<td style="font-size: 8pt;">
		<img src="<?= base_url()?>css/admin_css/spacer.gif" alt="" class="sqr" style="vertical-align: middle;" height="8" width="8"> Admin Main Menu</td>
		<td style="font-size: 7pt; text-align: right;">
		<span class="cur" id="hidetext4">[+]</span>
		</td>
	</tr>
	</table>
	<div class="sub4" id="sub4" style="display:none;">
		<ul class="navlist">									
					<? if (in_array("2", $getallowedcontrollers)) {?>
					<li><a href="<?=site_url(ADMIN_PATH.'/categories')?>" >Categories</a></li>
					<? }?>
					
					<? if (in_array("13", $getallowedcontrollers)) {?>
					<li><a href="<?=site_url(ADMIN_PATH.'/payment_settings')?>" >Payment Settings</a></li>
					<? }?>
					
					<? if (in_array("4", $getallowedcontrollers)) {?>
					<li><a href="<?=site_url(ADMIN_PATH.'/site_settings')?>" >Site Setting  </a></li>					
					<? }?>
					<? if (in_array("7", $getallowedcontrollers)) {?>
					<li> <a href="<?=site_url(ADMIN_PATH.'/newsletter')?>" >Newsletters </a></li>
					<? }?>
					
					<? if (in_array("8", $getallowedcontrollers)) {?>
					<li> <a href="<?=site_url(ADMIN_PATH.'/mail_settings')?>" >Mail Settings </a></li>
					<? }?>
					
					<? if (in_array("10", $getallowedcontrollers)) {?>
					<li><a href="<?=site_url(ADMIN_PATH.'/block_ips')?>" >Block IPs  </a></li>						
					<? }?>
					
					<? if (in_array("11", $getallowedcontrollers)) {?>
					<li><a href="<?=site_url(ADMIN_PATH.'/site_statistics')?>" >Site Statistics </a></li>					
					<? }?>
													
					</ul>
			</div>
		
		</div>	
			</td>
            <td width="83%" valign="top">
	
			<?php // $this->load->view('admin/welcome');                        
			$this->load->view($main);
			?>
			
			</td>
			</tr>
		
		</table></td>
      </tr>
	  <tr>
	  <td>
	     <?php #$this->load->view('admin/footer');?>
	  </td>
	  </tr>
    </table></td>
    <td background="<?= base_url()?>images/admin_images/top_cor_line_2.gif"><img src="<?= base_url()?>images/admin_images/top_cor_line_2.gif" width="19" height="5"></td>
  </tr>
  <tr>
    <td><img src="<?= base_url()?>images/admin_images/top_cor_3.gif" width="19" height="19"></td>
    <td background="<?= base_url()?>images/admin_images/top_cor_line_4.gif"><img src="<?= base_url()?>images/admin_images/top_cor_line_4.gif" width="4" height="19"></td>
    <td><img src="<?= base_url()?>images/admin_images/top_cor_4.gif" width="19" height="19"></td>
  </tr>
</table>
</body>
</html>

<!--<script type="text/javascript">
	 var j = jQuery.noConflict();
	j(document).ready(
		function()
		{
			j('#fisheye').Fisheye(
				{
					maxWidth: 50,
					items: 'a',
					itemsText: 'span',
					container: '.fisheyeContainter',
					itemWidth: 40,
					proximity: 90,
					halign : 'center'
				}
			)
			j('#fisheye2').Fisheye(
				{
					maxWidth: 60,
					items: 'a',
					itemsText: 'span',
					container: '.fisheyeContainter',
					itemWidth: 40,
					proximity: 80,
					alignment : 'left',
					valign: 'bottom',
					halign : 'center'
				}
			)
		}
	);

</script>-->
<script type="text/javascript">
	//sidemenu.init("sidemenu", 1)
	

//	sidemenu.init("sidemenu", 1)

function SwitchMenu(obj,id2)
{
	if(document.getElementById)
	{
        var el = document.getElementById(obj);
        if(el.style.display == "none")
        {
			document.getElementById(id2).innerHTML='[-]';
			el.style.display = "";
			//SetCookie(obj,"","-1");
		}
		else
		{
            document.getElementById(id2).innerHTML='[+]';
            el.style.display = "none";
           // SetCookie(obj,1,0);
		}
	}
}

</script>