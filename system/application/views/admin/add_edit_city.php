
<script>
function verify_form(frm)
{
  
  if(!isNaN(frm.c_name.value))
  {
   fix_element('Invalid Country Name',frm.c_name);
   return false;
  }
  
  if(trim(frm.c_name.value)=='')
  {
   fix_element('Please Enter the Name of the Country',frm.c_name);
   return false;
  }
  
  
  
  if(isNaN(frm.telephone_code.value))
  {
   fix_element('Invalid Telephone Code',frm.telephone_code);
   return false;
  }
  else if(frm.telephone_code.value.indexOf(".")>-1)
  {
   fix_element('Invalid Telephone Code',frm.telephone_code);
   return false;
   }
}

function fix_element(msg,element)
{
	alert(msg);
	element.focus();

}
function trim(str)
{
 return str.replace(/^\s+|\s+$/g,'');
}
</script>

<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH)?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/country_management')?>">Country and State Management</a>>> <?=anchor(site_url(ADMIN_PATH.'/country_management/states_list/'.$country_info[0]['country_id'].'/state_name/ASC'),$country_info[0]['country_name'])?> >> <?=$state_info[0]['state_name']?></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<form name="form1" method="post"   action="<? if(!isset($add_city)) { echo site_url(ADMIN_PATH.'/country_management/update_city/'); } else echo site_url(ADMIN_PATH.'/country_management/insert_city/');?>" onsubmit="return verify_form(this);">
  <table width="60%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" cellspacing="1" cellpadding="1">
          <tr> 
            <td width="28%">&nbsp;</td>
            <td width="72%">&nbsp;</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content">City Name:<span class="style1">*</span></td>
            <td align="left" valign="middle">
			<?php if(!isset($add_city)) {?><input name="city_id" type="hidden" value="<?=$city_info[0]['city_id']?>" size="30" maxlength="30"><?php }?>
			<input name="state_id" type="hidden" value="<?=$state_info[0]['state_id']?>" size="30" maxlength="30">
			<input name="country_id" type="hidden" value="<?=$country_info[0]['country_id']?>" size="30" maxlength="30">
			<input name="city_name" type="text" class="comment" id="city_name" value="<?  if(!isset($add_city)) { echo $city_info[0]['city_name']; }?>" size="30" maxlength="30"></td>
          </tr>
         
          <tr align="center"> 
            <td height="35" colspan="2" class="err"> 
             
            </td>
          </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" class="bttn" >       </td>
          </tr>
          <tr align="right"> 
            <td colspan="2" class="err"><font size="1"> (*) marked fields are 
              required </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>

