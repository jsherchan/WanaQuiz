<script type="text/javascript" src="<?= base_url()?>js/help_tips.js"></script>
<h2 class="headingclass">Payment Configuration</h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> &gt;&gt;Payment Setting  Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<br />
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<form name="sitesetting" method="post" action="<?=site_url(ADMIN_PATH.'/payment_settings/update/')?>">
<table width=90% align=center border=0 cellspacing=2 cellpadding=4 class="light">

<tr height="30" bgcolor="#CCCCCC">
<td colspan="3" class="hmenu_font" >Paypal Settings</td>
</tr>
<tr height="30">
<td class="hmenu_font">Bussiness Email</td>

<td colspan="2"><input type="text" class="inputtext" name="ps_email" size="45" value="<?=$payment_info->ps_email;?>" />
  <a href="#" onmouseover="fixedtooltip('This email address will be used for transaction purpose in Paypal.', this, event, '250px')" onmouseout="delayhidetip()"><img src="<?=base_url()?>images/admin_images/help.gif" width="12" height="13" border="0" /></a></td>
</tr>

<tr height="30">
  <td class="hmenu_font">Currency</td>
  <td colspan="2">
  <select name="ps_currency">
  	<option value="USD" <?php if($payment_info->ps_currency=="USD") echo "selected"; ?>>US Dollar</option>
	<option value="EUR" <?php if($payment_info->ps_currency=="EUR") echo "selected"; ?>>Euro Dollar</option>
	<option value="AUD" <?php if($payment_info->ps_currency=="AUD") echo "selected"; ?>>Australian Dollar</option>
	<option value="GBP" <?php if($payment_info->ps_currency=="GBP") echo "selected"; ?>>British Pound</option>
  </select><a href="#" onmouseover="fixedtooltip('This currency will be used for transaction purpose in Paypal.', this, event, '250px')" onmouseout="delayhidetip()"><img src="<?=base_url()?>images/admin_images/help.gif" width="12" height="13" border="0" /></a>
  </td>
</tr>
<tr height="30">
  <td>&nbsp;</td>
  <td colspan="2">
  <input class="bttn" type="submit" name="Submit" value="Update Settings" /></td>
</tr>
</table>
</form>
