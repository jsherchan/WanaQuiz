<h2 class="headingclass" >Newsletter Management</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Unsubscribe this member?");
	if(job!=true)
	{
		return false;
	}
}

function checkAll()
{
	for (var i=0;i<document.forms[0].elements.length;i++)
	{
		var e=document.forms[0].elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.forms[0].allbox.checked;
		}
	}
}

function checkfill()
{
	var count=0;
	if(document.frm.newsl_id.value=='')
	{
		alert('Please Select the newsletter');
		document.frm.newsl_id.focus();
		return false;
	}

}


</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home/')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/newsletter/')?>"> Newsletter Management</a> >>Mailing Groups</span></td>
    <td width="10%"><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="96%" cellpadding="1">
  <tr>
    <td width="24%" ><strong>[<? if($flag=='subscribers') {?>Newsletter Subscribers<? } else {?> <a href="<?=site_url(ADMIN_PATH.'/newsletter/mailingGroups/subscribers')?>" style="color:#003399">Newsletter Subscribers </a><? }?> ]</strong></td>
	
	<td width="22%" align="right"><strong>[ <? if($flag=='invited') {?>Invited Members<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/mailingGroups/invited')?>" style="color:#003399">Invited Members </a> <? }?>]</strong></td>
	
	<td width="25%" align="right"><strong>[ <? if($flag=='not_won') {?>Not Won Members<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/mailingGroups/not_won')?>" style="color:#003399">Not Won Members </a><? }?> ]</strong></td>
	
	<td width="18%" align="right"><strong>[ <? if($flag=='not_logged_in') {?>Passive Userss<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/mailingGroups/not_logged_in')?>" style="color:#003399">Passive Users </a><? }?>]</strong></td>
	
	<td width="11%" align="right"><strong>[ <? if($flag=='all') {?>All<? } else {?><a href="<?=site_url(ADMIN_PATH.'/newsletter/mailingGroups/all')?>" style="color:#003399"> All </a><? }?>]</strong></td>
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
		if(count($newsletter_group_info)>0) {
		foreach($newsletter_group_info as $rows) { 
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