<h2 class="headingclass" >Text Ads Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/quiz_display_management')?>"> Quiz Display Management</a> >> Edit
	 </span></td>
    <td><a href="javascript:void(0);" onclick="javascript:back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:void(0);" onclick="javascript:back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<hr />
<table width="100%"  border="0">
  <tr>
    <td width="17%" >[ <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management')?>"><strong> VIEW QUIZ DISPLAY DATA </strong></a>]</td>
    <td width="59%" height="35">&nbsp;</td>
    <td width="24%" valign="top">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="4" >
	<tr>
		<td> 
		</td>
	</tr>
	
</table>

<form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/quiz_display_management/update_quiz_display/')?>" onSubmit="return submitForm('');" >
            <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                <tr>
                    <td align="center" valign="top" bgcolor="#FFFFFF">
                        <table width="95%" border="0" cellspacing="1" cellpadding="4" >
                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">User Type<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <input name="user_type" type="text" class="comment" value="<?=$display_info->user_type?>" size="50"></td>
                            </tr>
                            

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">Percentage</td>
                                <td align="left" valign="middle" class="cat_block1"><input name="percentage" type="text" class="comment" value="<?=$display_info->percentage?>" size="50"></td>
                            </tr>

                            <tr align="center">
                                <td align="right" class="cat_block1">&nbsp; </td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input type="hidden" name="id" value="<?=$display_info->id?>" />
                                    <input type="submit" name="Submit" value="Submit" class="bttn"  style="width:70px">
                                </td>
                            </tr>
                            <tr align="right">
                                <td colspan="2" class="err">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
  <br />



					</td>
                  </tr>
                </table>



<script>
function submitForm(id)
{ 
	if(document.frm_banner.banner_name.value=="")
	{
		alert('Banner Name is Empty.');
		document.frm_banner.banner_name.focus();
		return false;
	} 
	if(id==1)
	{
		if(document.frm_banner.picture.value==0)
		{
			alert('Please select Picture for banner.');
			document.frm_banner.picture.focus();
			return false;
		}
		
		filearr=document.frm_banner.picture.value.split('.');
		filearr.reverse()
		filen=filearr[0];
		if(filen.toUpperCase()!="GIF" && filen.toUpperCase()!="JPG" && filen.toUpperCase()!="JPEG" && filen.toUpperCase()!="PNG")
		{
			alert("Picture should be gif,jpg,jpeg or png.");
			document.frm_banner.picture.focus();
			return false;
		}
	}
	
	if(document.frm_banner.url.value==0)
	{
		alert('Please enter the URL.');
		document.frm_banner.url.focus();
		return false;
	}
	
	if(document.frm_banner.active[0].checked==false && document.frm_banner.active[1].checked==false)
	{
		alert('Please select active active.');
		document.frm_banner.active[0].focus();
		return false;
	}
	return true;	
}
</script>
			