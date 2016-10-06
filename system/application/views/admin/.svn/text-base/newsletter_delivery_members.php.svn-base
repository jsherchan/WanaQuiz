<h2 class="headingclass" >Newsletter Management</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This user Permanently?");
	if(job!=true)
	{
		return false;
	}
}


</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home/')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/newsletter/')?>"> Newsletter Management</a> >>Delivery Statistics</span></td>
    <td width="10%"><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="100%" cellpadding="1">
  <tr>
    <td width="26%" ><strong>[<? if($flag=='sent') {?>Newsletter Sent Members<? } else {?> <a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/sent')?>" style="color:#003399">View Newsletter Sent Members </a><? }?> ]</strong></td>
	
	<td width="25%" align="right"><strong>[ <? if($flag=='opened') {?>Newsletter Opened Members<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/opened')?>" style="color:#003399">View Newsletter Opened Members </a> <? }?>]</strong></td>
	
	<td width="29%" align="right"><strong>[ <? if($flag=='bounced') {?>Newsletter Bounced Members<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/bounced')?>" style="color:#003399">View Newsletter Bounced Members </a><? }?> ]</strong></td>
	</tr>
	
	 <tr>
    <td width="22%" colspan="3" ><strong>Newsletter Subject : <a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$newsletter_info->newsletter_id)?>"><?=$newsletter_info->news_subject?></a></strong></td>
		
	</tr>
	
</table>
  </td>
  </tr>
</table>

<br>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<table width="87%" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="13%" align="left"><div align="center">Member ID</div></th>
        <th width="38%" align="left"><div align="left">
	  <b> Username</b> </div></th>
	
	  <th width="38%" align="left"><div align="left">
	  <b>Email</b> </div></th>
	 
        <th width="30%" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="19%" align="left"><div align="center"><b>delete</b></div></th>
        <? 
		$i=1;
		if(count($member_info)>0) {
		foreach($member_info as $rows) { 
		?>
      </tr>
      <tr>
        <td align="center"><?=$rows->user_id?></td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/members/member_details/'.$rows->user_id)?>"> <?=$rows->username?></a></td>
		
	  <td align="left"><div align="left">
	  <b><?=$rows->email?></b> </div></td>
	 
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/members/edit_member/'.$rows->user_id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a>	    </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/newsletter/delete_member/'.$rows->user_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>	    </td>
      </tr>
	  
      <? } } else{?>
<tr><td colspan="5" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
<p>