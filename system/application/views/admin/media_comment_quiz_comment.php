<h2 class="headingclass" >Media Comment Management</h2>

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
      >> Quiz Comment Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="98%" cellpadding="1">
  <tr>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management')?>" style="color:#003399"> Quiz Image Management </a> ]</strong></td>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getQuizVideos')?>" style="color:#003399"> Quiz Video Management </a> ]</strong></td>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getQuizComments')?>" style="color:#003399"> Quiz Comment Management </a> ]</strong></td>
  </tr>
  <tr>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getProfileComments')?>" style="color:#003399"> Profile Comment Management </a> ]</strong></td>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getProfileImages')?>" style="color:#003399"> Profile Image Management </a> ]</strong></td>
	
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
        <th width="13%" align="left"><div align="left">
                <b><? if($flag1=='quiz_comment'){ ?> Quiz_id <? } else {?> Profile id <? } ?> </b> </div></th>
        <th width="13%" align="left"><div align="left">
                <b>Commentator id </b> </div></th>

        <th width="50%" align="left"><div align="center"><b><? if($flag1=='quiz_comment') {?>Quiz Comments<? } else { ?>Profile Comments <? } ?></b></div></th>
        <th width="11%" align="left"><div align="center"><b>Delete</b></div></th>
    </tr>
        <? 
		$i=$offset+1;
                if($flag1=='quiz_comment')
                $data = $quiz_comments;
                else $data = $profile_comments;
                if(count($data)>0) {
		foreach($data as $rows) {
		?>
      
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"><?  if($flag1=='quiz_comment'){ ?><?=$rows->quiz_id?> <? } else {?><?=$rows->user_id?> <? } ?></td>
		
	  <td align="left"><div align="left">
	  <b><?  if($flag1=='quiz_comment'){ ?><?=$rows->user_id?> <?} else { ?> <?=$rows->comentator_id; ?> <? } ?></b> </div></td>
	  
        <td align="center"><?=$rows->comment?>  </td>
		<td align="center">
		<? if($flag1=='quiz_comment') {?><a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuizComments/'.$rows->comment_id)?>"> <? } else {?><a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuizComments/'.$rows->comment_id)?>"><? }?> <img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" />  </a> </td>
      </tr>
	  
      <? $i++;} } else{?>
<tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
<div><?=$pagination?></div>
<p>