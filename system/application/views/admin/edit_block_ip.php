<h2 class="headingclass" >Block IP Management</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/block_ips')?>">Block IP Management</a> >> Edit Block IP </span></td>
    <td><a href="javascript:history.back();"><img src="images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<?php if(count($ip_info)){

foreach($ip_info as $rows){?>
<form name="edit_IPform" method="post"   action="<?=site_url(ADMIN_PATH.'/block_ips/edit')?>">
  <table width="70%" height="232" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"><table width="99%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="45%">&nbsp;</td>
            <td width="55%">&nbsp;</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content">IP Address</td>
            <td align="left" valign="middle"><input name="ip_address" type="text" class="comment" id="ip_address" value="<?=$rows->blockip_address?>" size="30" maxlength="30"></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="content">Block IP Reason</td>
            <td align="left" valign="middle"><textarea name="ip_desc" cols="50" rows="5" ><?=$rows->blockip_desc?></textarea>
</td>
          </tr>
		   
          <tr align="center"> 
            <td height="35" colspan="2" class="err"> 
              <??>            </td>
          </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td align="left" valign="middle">
			 <input name="ip_id" type="hidden" id="ip_id" value="<?=$rows->blockip_id?>">
			<input type="submit" name="Submit" value="Submit" class="bttn" > 
            </td>
          </tr>
          <tr align="right"> 
            <td colspan="2" class="err"><font size="1"> (*) marked fields are 
              required </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php 
}

}
?>

