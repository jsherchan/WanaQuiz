<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript" src="<?=base_url()?>tiny_mice/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>
<H2 class="headingclass">Update Email Settings </H2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/mail_settings')?>">Email Settings</a> </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<br>
<Table align=left cellpadding=2 cellspacing=0 width=99% border="0" class="light">
<form action="<?=site_url(ADMIN_PATH.'/mail_settings/update/')?>" method="Post" name="form1">
<tr>
      <td colspan="2"><strong>Email Template</strong>&nbsp;&nbsp;&nbsp;
	  	<select name="TempName" id="TempName" onchange="Do_Submit_Form(this.form);">
          <option value="REGISTRATION" <?php if($template_info->template_code=="REGISTRATION"){echo "selected";}?>>Member Registration</option>
		   <option value="FORGOT_PWD" <?php if($template_info->template_code=="FORGOT_PWD"){echo "selected";}?>>Forgot Password</option>
           <option value="SUSPENDED" <?php if($template_info->template_code== "SUSPENDED"){echo "selected";}?>>Manual Account Suspension</option>
		   <option value="ACTIVATED" <?php if($template_info->template_code== "ACTIVATED"){echo "selected";}?>>Manual Account Activation</option>
        		  
		  <option value="EMAIL_FRIEND" <?php if($template_info->template_code== "EMAIL_FRIEND"){echo "selected";}?>>Email to Friends</option>
                  <option value="NO_VIEWS" <?php if($template_info->template_code== "NO_VIEWS"){echo "selected";}?>>No Views remaining</option>
                  <option value="LOW_VIEWS" <?php if($template_info->template_code== "LOW_VIEWS"){echo "selected";}?>>Low Views</option>
                  <option value="TRANSACTION_SUCCESS" <?php if($template_info->template_code== "TRANSACTION_SUCCESS"){echo "selected";}?>>Transaction Complete</option>
                  <option value="SPAM" <?php if($template_info->template_code== "SPAM"){echo "selected";}?>>Comment Spam</option>
                  <option value="WINNER_OF_THE_DAY" <?php if($template_info->template_code== "WINNER_OF_THE_DAY"){echo "selected";}?>>Winner of the Day</option>
                  <option value="OVERALL_WINNER" <?php if($template_info->template_code== "QOVERALL_WINNER"){echo "selected";}?>>Overall Winner</option>
                  <option value="ACCEPT_PARTNER" <?php if($template_info->template_code== "ACCEPT_PARTNER"){echo "selected";}?>>Accept Partner</option>
                  <option value="REJECT_PARTNER" <?php if($template_info->template_code== "REJECT_PARTNER"){echo "selected";}?>>Reject Partner</option>
				   
		 </select>
	   </td>
</tr>
<tr>
      <td colspan="2"><strong>Subject</strong>&nbsp;&nbsp;&nbsp;

<input size="60" class="inputtext" type="text" id="subtext" name="subtext" value="<?php echo $template_info->template_subject;?>"></td>
</tr>

<tr>
      <td><strong>Message Body </strong></td>
      <td><span class="style1">Legends (For the Dyanamic Content) </span></td>
</tr>
<tr>
<td width="613" valign="top">
<textarea name="message_body" id="message_body" cols="70" rows="33"><?php echo stripslashes($template_info->template_design);?></textarea></td>
<td width="327" valign="top"><div align="left">
  <strong>[userid]</strong> = Member Id<br />
      <strong>[password]</strong> = User Password<br />
      <strong>[firstname]</strong> = First Name<br />
      <strong>[sendername]</strong> = Sender Name<br />
      <strong>[email]</strong> = Email address<br />
      
  
  </div></td>
</tr>

<tr height=25 valign="middle">

<td colspan="2">
<input type="hidden" name="TemplateCode" value="<?=$template_info->template_code?>">
<input type="submit" value="Update Email Settings" class="bttn" onclick="submitForm();"></td>
</tr>
</form>
</table>

<script language="javascript">

	function Do_Submit_Form(fm){

		document.location = "<?=site_url(ADMIN_PATH.'/mail_settings/template/')?>/" + fm.TempName.value;

	}

</script>


