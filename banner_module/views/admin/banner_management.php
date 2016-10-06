<h2 class="headingclass" >Banner Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt; Banner  Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<hr />
<!--
<table width="100%"  border="0">
  <tr>
    <td width="17%" >[ <a href="<?=site_url(ADMIN_PATH.'/banner_management/add_banner/') ?>"><strong> ADD BANNER </strong></a>]</td>
    <td width="59%" height="35">&nbsp;</td>
    <td width="24%" valign="top">&nbsp;</td>
  </tr>
</table>
-->
<? // include_once("others/succ_msg.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  
			  
			  <tr>
                <td class="border_block" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                  <tr>
                    <td colspan="2"><link href="css/base.css" rel="stylesheet" type="text/css" />
  
 
<table width="100%" border="0" cellspacing="0" cellpadding="4" >
	<tr>
		<td> 
		  <div align="center">
		  <span class='succMsg'>
		   
		    </span>
          </div></td>
	</tr>
</table>

<table width="100%" border="0"  cellpadding="4" cellspacing="0" class="Mtable">
  <tr > 
  <th width="84"  class="th" ><div align="left">Banner No.</div></th>
    <th width="208"  class="th"><div align="left">Banner Name</div></th>
    <th width="251"  class="th"><div align="center">Image</div></th>
    <th width="98"  class="th"><div align="center">Status</div></th>
	<th width="199"  class="th"><div align="center">Date Updated</div></th>
	
	<th width="69" class="th"><div align="center">Edit</div></th>
	<th width="59" class="th"><div align="center">Delete</div></th>

<?php if(count($banner_list)>0){
foreach($banner_list as $rows){
?>  
  <tr align="center" class=""> 
  <td ><div align="left"><?=$rows->ban_id?></div></td>
    <td ><div align="left"><?=$rows->ban_name?></div></td>
    <td> <img src="<?=site_url('./banner_images/'.$rows->ban_image)?>" width="200"   /> </td>
    <td> <?  if($rows->ban_active==1) echo "Active"; else echo "Not Active"; ?></td>
	<td> <?=$rows->ban_date_added?></td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/banner_management/edit_banner/'.$rows->ban_id) ?>">
				<img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Transaction" border="0">				</a>				</td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/banner_management/delete_banner/'.$rows->ban_id) ?>">
				<img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm()"  border="0">				</a>				</td>
</tr>			  
  <? }
    }?>
</table>
<br />
<div align='left'>


</div>

<br />


					</td>
                  </tr>
                </table></td>
			  </tr>
</tbody></table>



<script>

function doConfirm()
{
	msg=confirm("Are you sure you want to delete this Banner Permanently?");
	if(msg!=true)
	{
		return false;
	}
}

</script>	
			