<h2 class="headingclass" >Change Password</h2>


<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="normal"><a href="admin" class="blue_bold">ADMIN</a> >> Change Password </span></td>
    <td><a href="admin"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="admin" class="blue_bold"><span class="bodytext">BACK</span></a></td>
  </tr>
</table>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<?php echo $this->validation->error_string; ?> 
	
<?php echo form_open(ADMIN_PATH."/change_password/update_password");?>
<table width="90%" align="left" border="0" cellspacing="2" cellpadding="4" class="light">
<!--
<tr>
<td width=185 valign="top">Old Username </td>
<td width="418"><input name="AdminUserName" type="text" class="inputtext" id="AdminUserName" value="" size=45></td>
</tr>
-->
<tr>
<td width="185" valign="top">Old Password </td>
<td width="418"><input name="old_password" type="password" id="old_password" class="<?php //$this->validation->old_password_error?>"  value="<?php // echo $this->validation->old_password;?>" size=45><?php // echo $this->validation->old_password_error; ?></td>
</tr>
<!--
<tr>
  <td valign="top">&nbsp;</td>
  <td>&nbsp;</td>
</tr>

<tr>
<td width=185 valign="top">New Username </td>
<td width="418"><input type="text" name="new_username" class="inputtext" size=45 value=""></td>
</tr>
-->
<tr>
<td valign="top">New Password </td>
<td colspan="2">
<input type="password" name="new_password"  size=45 class="<? //=$this->validation->new_password_error?>"  value="<?php //echo $this->validation->new_password;?>"><?php //  echo $this->validation->new_password_error; ?></td>
</tr>
<tr>
<td valign="top">Confirm New Password </td>
<td colspan="2">
<input type="password" name="re_password" class="<? //=$this->validation->re_password_error?>" size=45  value="<?php //echo $this->validation->re_password;?>"><?php //echo $this->validation->re_password_error; ?></td>
</tr>

<tr>
<td colspan=3></td>
</tr>

<tr height="30">
<td>&nbsp;</td>
<td colspan="2"> <input class="bttn" type="submit" value="Change"></td>
</tr>
</table>
</form>