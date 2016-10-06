<h2 class="headingclass" >Banner Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/banner_management')?>"> Banner Management</a> >> Add Banner 
	 </span></td>
    <td><a href=""><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href=""><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<hr />
<table width="100%"  border="0">
  <tr>
    <td width="17%" >[ <a href="<?=site_url(ADMIN_PATH.'/banner_management')?>"><strong> VIEW BANNER LIST </strong></a>]</td>
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

<form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/banner_management/update_banner/')?>" onSubmit="return submitForm('');" >
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF">
	  <table width="95%" border="0" cellspacing="1" cellpadding="4" >
          <tr> 
            <td width="25%" align="right" valign="middle" class="cat_block1">Banner Name<span class="style1">*</span></td>
            <td width="75%" align="left" valign="middle" class="cat_block1">
			<input name="banner_name" type="text" class="comment" value="<?=$banner_info->ban_name?>" size="50"></td>
          </tr>
		  <tr> 
            <td width="25%" align="right" valign="middle" class="cat_block1">Banner Location<span class="style1">*</span></td>
            <td width="75%" align="left" valign="middle" class="cat_block1">
			<select name="banner_location">
				<option value="1" <?php if($banner_info->ban_location=='1') echo "select";?>>Free Bid Every Day Banner(694 width* 65 height)</option>
				<option value="2" <?php if($banner_info->ban_location=='2') echo "select";?>>Join Us And win Banner(260 width* 116 height)</option>
				<option value="3" <?php if($banner_info->ban_location=='3') echo "select";?>/>Refer To Friend Banner(244 width* 54 height)</option>
				<option value="4" <?php if($banner_info->ban_location=='4') echo "select";?>>Video Instruction Banner(260 width* 200 height)</option>
			</select>
			
			</td>
          </tr>
          <tr> 
            <td align="right" valign="middle" class="title_content_block"><span class="cat_block1">Image</span><span class="style1">*</span></td>
            <td align="left" valign="middle" class="title_content_block">
			<input name="banner" type="file" id="banner"  size="30" maxlength="30"><br />
			(Please make sure width=158px  to display correctly in front end)</td>
          </tr>
        		  
           <tr> 
            <td align="right" valign="middle" class="cat_block1">URL<span class="style1">*</span></td>
            <td align="left" valign="middle" class="cat_block1">
			<input name="banner_url" id="banner_url"  type="text" class="comment" value="<?=$banner_info->ban_url?>" size="35"><br />
			(Please enter full URL like: http://www.hotmail.com)
			
			</td>
          </tr>
		   <tr> 
            <td align="right" valign="middle" class="title_content_block">Status<span class="style1">*</span></td>
            <td align="left" valign="middle" class="title_content_block">
		
			<input type="radio" name="active" value="0" <?php if($banner_info->ban_active==0) echo "checked";?> >Deactive <input type="radio" name="active" value="1" <?php if($banner_info->ban_active==1) echo "checked";?> />Activate</td>
          </tr>
		   
          <tr> 
            <td align="right" valign="middle" class="cat_block1">Image</td>
            <td align="left" valign="middle" class="cat_block1"><?php if($banner_info->ban_image!="") { ?>
	    <img class="imgproduct" src="<?=base_url()."banner_images/".$banner_info->ban_image?>" width="300">
		<?  } ?></td>
          </tr>
              
          <tr align="center"> 
            <td align="right" class="cat_block1">&nbsp; </td>
            <td align="left" valign="middle" class="cat_block1">
			<input type="hidden" name="banner_id" value="<?=$banner_info->ban_id?>" />
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
			