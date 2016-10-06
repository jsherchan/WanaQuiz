<h2 class="headingclass" >Awards Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/score_badge_management/awards')?>"> Awards Management</a> >> Add Awards
	 </span></td>
    <td><a href=""><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href=""><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<hr />
<table width="100%"  border="0">
  <tr>
    <td width="34%" >[ <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/awards')?>"><strong> View Awards </strong></a>]</td>
    <td width="42%" height="35">&nbsp;</td>
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

<form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/score_badge_management/insert_award/')?>">
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF">
	  <table width="95%" border="0" cellspacing="1" cellpadding="4" >
          <tr> 
            <td width="25%" align="right" valign="middle" class="cat_block1">Award Name<span class="style1">*</span></td>
            <td width="75%" align="left" valign="middle" class="cat_block1">
			<input name="award_name" type="text" class="comment" value="" size="50"></td>
          </tr>

          <tr>
            <td width="25%" align="right" valign="middle" class="cat_block1">Award Link Name<span class="style1">*</span></td>
            <td width="75%" align="left" valign="middle" class="cat_block1">
			<input name="award_link_name" type="text" class="comment" value="" size="50"></td>
          </tr>

          <tr> 
            <td width="25%" align="right" valign="middle" class="cat_block1">Bonus Points<span class="style1">*</span></td>
            <td width="75%" align="left" valign="middle" class="cat_block1">
			<input name="bonus_points" type="text" class="comment" value="" size="50"></td>
            </td>
          </tr>
          		  
          <tr> 
            <td align="right" valign="middle" class="title_content_block"><span class="cat_block1">Award Image</span><span class="style1">*</span></td>
            <td align="left" valign="middle" class="title_content_block">
			<input name="trophy_image" type="file" id="trophy_image"  size="30" maxlength="30"><br />
			(Please make sure width=158px  to display correctly in front end)</td>
          </tr>
         
             
          <tr align="center"> 
            <td align="right" class="cat_block1">&nbsp; </td>
            <td align="left" valign="middle" class="cat_block1">
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
      </td>
    </tr>
  </table>



