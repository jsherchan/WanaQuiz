<script language="javascript"  type="text/javascript">
function formValidation()
{
	var categoryname=document.getElementById('cat_name');
	
	if(categoryname.value=='' && categoryname.value==null)
	{
		alert('Enter Category Name');
		categoryname.focus();
		return false;
	}
/*	if(isNaN(parseFloat(obj.value)))
	{
		alert('Enter only Numeric Value');
		obj.focus();
		return false;
	}*/
	return true;
						
}

</script>
<h2 class="headingclass" >Group Member Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="">ADMIN</a> >> <a href="">Group Member Management</a> </span></td>
    <td><a href="javascript:history.back();"><img src="images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<form name="edit_categoryform" method="post"   action="<?=site_url(ADMIN_PATH.'/security/updateGroupMember')?>" onsubmit="return formValidation()">
  <table width="60%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" cellspacing="1" cellpadding="2">
          <tr> 
            <td width="45%">&nbsp;</td>
            <td width="55%">&nbsp;</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content">Member Name</td>
            <td align="left" valign="middle"><input name="name" type="text" class="comment" id="name" value="<?=$member_info->AdminName?>" size="30" maxlength="30"></td>
          </tr>
                  		   
         <tr> 
      <td height="36"><strong>Userame : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="username" value="<?=$member_info->AdminUserName?>" size="30" maxlength="60"> 
	   </td>
	 </tr>
	 
	  <tr> 
      <td height="36"><strong>Password : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="password" name="password" value="********" size="30" maxlength="60"> 
	   </td>
	 </tr>
	 
	   <tr> 
      <td height="36"><strong>Email : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="email" value="<?=$member_info->AdminEmail?>" size="30" maxlength="60"> 
	   </td>
	 </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td align="left" valign="middle">
			 <input name="mem_id" type="hidden" id="mem_id" value="<?=$member_info->AdminID?>">
			 <input name="group_id" type="hidden" id="group_id" value="<?=$group_info->ID?>">
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


