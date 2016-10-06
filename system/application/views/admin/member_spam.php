<h2 class="headingclass" >Comment Spam Management</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This user Permanently?");
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
    <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a> 
      >> Comment Spam Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="98%" cellpadding="1">
  <tr>
    <td width="50%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/comment_spam/getQuizCommentSpam')?>" style="color:#003399"> Quiz Comment Spam </a> ]</strong></td>
    <td width="50%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/comment_spam/getProfileCommentSpam')?>" style="color:#003399"> Profile Comment Spam </a> ]</strong></td>
	
	
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
        <th width="13%" align="left"><div align="center">No.</div></th>
        <th width="38%" align="left"><div align="left">
	  <b> Subject</b> </div></th>
	 <? if($flag=='Sent') {?> 
	  <th width="38%" align="left"><div align="left">
	  <b>Delivery Statistics</b> </div></th>
	  <? }?>
        <th width="30%" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="19%" align="left"><div align="center"><b>delete</b></div></th>
        <? 
		$i=1;
		if(count($newsletter_info)>0) {
		foreach($newsletter_info as $rows) { 
		?>
      </tr>
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$rows->newsletter_id)?>"> <?=$rows->news_subject?></a></td>
		 <? if($flag=='Sent') {?> 
	  <td align="left"><div align="left">
	  <b><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatus/'.$rows->newsletter_id)?>">Delivery Statistics</a></b> </div></td>
	  <? }?>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$rows->newsletter_id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a>	    </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/newsletter/delete/'.$flag.'/'.$rows->newsletter_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>	    </td>
      </tr>
	  
      <? $i++;} } else{?>
<tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
<p>