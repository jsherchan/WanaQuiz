<h2 class="headingclass" >Site Setting  Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
  <tr>
    <td width="86%" height="30"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> &gt;&gt;SITESETTING MAINTENANCE</span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">BACK</span></a></td>
  </tr>
</table>
<form name="sitesetting" method="post" action="<?=site_url(ADMIN_PATH.'/site_settings/update')?>">
<br />
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width=90% align=center border=0 cellspacing=2 cellpadding=4 class="light">
<tr>
<td width=229 class="hmenu_font">WEBSITE NAME</td>
<td width="429"><input type=text name="site_name" class="inputtext" size=45 value="<?=$site_info->site_name;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">WEBSITE META DESC</td>
<td width="429"><input type=text name="site_meta_desc" class="inputtext" size=45 value="<?=$site_info->site_meta_desc;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">WEBSITE META KEYWORDS</td>
<td width="429"><input type=text name="site_meta_keywords" class="inputtext" size=45 value="<?=$site_info->site_meta_keywords;?>"></td>
</tr>

<tr>
<td width=229 valign="top" class="hmenu_font">&nbsp;</td>
<td colspan="2" valign="top">&nbsp;</td>
</tr>

<tr>
<td width=229 valign="top" class="hmenu_font">OFFLINE MESSAGE</td>
<td colspan="2">
<textarea name="site_offline_msg" rows="6" cols="45" class="mytextarea" mce_editable='false'><?=$site_info->site_offline_msg;?>
</textarea></td>
<td width="187"></td>
</tr>

<!--tr>
<td width=229 class="hmenu_font">FACEBOOK APP ID</td>
<td width="429"><input type=text name="facebook_app_id" class="inputtext" size=45 value="< ?=$site_info->facebook_app_id;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">FACEBOOOK API SECRET</td>
<td width="429"><input type=text name="facebook_api_secret" class="inputtext" size=45 value="< ?=$site_info->facebook_api_secret;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">TWEET CONSUMER KEY</td>
<td width="429"><input type=text name="tweet_consumer_key" class="inputtext" size=45 value="< ?=$site_info->tweet_consumer_key;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">TWEET CONSUMER SECRET</td>
<td width="429"><input type=text name="tweet_consumer_secret" class="inputtext" size=45 value="< ?=$site_info->tweet_consumer_secret;?>"></td>
</tr-->

<tr>
<td width=229 class="hmenu_font">WEBSITE META KEYWORDS</td>
<td width="429"><input type=text name="site_meta_keywords" class="inputtext" size=45 value="<?=$site_info->site_meta_keywords;?>"></td>
</tr>

<tr>
<td width=229 class="hmenu_font">WEBSITE META KEYWORDS</td>
<td width="429"><input type=text name="site_meta_keywords" class="inputtext" size=45 value="<?=$site_info->site_meta_keywords;?>"></td>
</tr>

<tr>
<td valign="top" class="hmenu_font">CONTACT EMAIL</td>
<td colspan="2">
<input type=text class="inputtext" name="site_email" size=45 value="<?=$site_info->site_email;?>"></td>
</tr>


<tr height="30">
<td valign="top" class="hmenu_font">BUSINESS EMAIL </td>

<td colspan="2"><input type="text" class="inputtext" name="site_buss_email" size="45" value="<?=$site_info->site_buss_email;?>" /></td>
</tr>

<tr height="30">
<td valign="top" class="hmenu_font">TAX </td>

<td colspan="2"><input type="text" class="inputtext" name="site_tax" size="45" value="<?=$site_info->site_tax;?>" /></td>
</tr>


<tr height="30">
  <td><strong>GMT Setting</strong></td>
  <td colspan="2"><select name="gmt_hour">
    <?
  for($i=0;$i<=5;$i++)
  {
	 $selectvalue='';
	 if($i==$site_info->gmt_hour)
	 {
		 $selectvalue=' selected="selected"';
	 }
	  echo '<option value="'.$i.'"' .$selectvalue.'>'.$i.'</option>';
  }
  ?> </select>&nbsp;&nbsp; : &nbsp;<select name="gmt_minute">
  <?
  for($i=0;$i<60;$i++)
  {
	  $stmin=$i;
	 if($i<10)
	 {
		 $stmin='0'.$i;
	 }
	 $selectvalue='';
	 if($stmin==$site_info->gmt_minute)
	 {
		 $selectvalue=' selected="selected"';
	 }
	  echo '<option value="'.$stmin.'"' .$selectvalue.'>'.$stmin.'</option>';
  }
  ?>
 </td>
 </tr>
  

<tr height="30">
  <td><strong>Website Status</strong></td>
  <td colspan="2"><input name="site_status" type="radio" value="online" <?php if($site_info->site_status=="online")  echo "checked"?> />ONLINE 
      <input name="site_status" type="radio" value="offline" <?php if($site_info->site_status=="offline")  echo "checked"?>/>OFFLINE</td>
</tr> 

<tr height="30">
<td valign="top" class="hmenu_font">TWITTER OAUTH TOKEN</td>

<td colspan="2"><input type="text" class="inputtext" name="site_tax" size="60" value="<?=$site_info->oauth_token;?>" disabled="disabled" /></td>
</tr>

<tr height="30">
<td valign="top" class="hmenu_font">TWITTER OAUTH TOKEN SECRED</td>

<td colspan="2"><input type="text" class="inputtext" name="site_tax" size="60" value="<?=$site_info->oauth_token_secret;?>" disabled="disabled" /></td>
</tr>

<tr height="30">
  <td>&nbsp;</td>
  <td colspan="2"><input class="bttn" type="submit" name="Submit" value="UPDATE SETTINGS" /></td>
</tr>
</table>
</form>
