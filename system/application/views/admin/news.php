<h2 class="headingclass" >News Management</h2>

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
    <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a> 
      >> News Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="71%" cellpadding="1">
  <tr>
    <td width="18%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/news/addnews')?>" style="color:#003399">+Add News </a> ]</strong></td>
	
	<td width="32%" align="right"><strong><? if($flag=="ebid"){?>[ View Ebid News ]<? } else{?>[ <a href="<?=site_url(ADMIN_PATH.'/news/getEbidNews')?>" style="color:#003399"> View Ebid News </a> ]<? }?></strong></td>
	
	<td width="32%" align="right"><strong><? if($flag=="press"){?>[ View Press News ]<? } else{?>[ <a href="<?=site_url(ADMIN_PATH.'/news/getPressNews')?>" style="color:#003399"> View Press News </a> ]<? }?></strong></td>
	
	<td width="18%" align="right"><strong><? if($flag=="all"){?>[ All ]<? } else{?>[ <a href="<?=site_url(ADMIN_PATH.'/news')?>" style="color:#003399"> All </a> ]<? }?></strong></td>
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



<? if($flag=="ebid" || $flag=="press"){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ttable">
      <tr>
        <th width="60" align="left"><div align="center">No.</div></th>
        <th width="319" align="left"><div align="left"><b>Title </b></div></th>
        <th width="154" align="left"><div align="center"><b>Posted Date</b></div></th>
        <th width="112" align="left"><div align="center"><b>Status</b></div></th>
		<th width="83" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="92" align="left"><div align="center"><b>Delete</b></div></th>

      </tr>
     <? $i=1;
	 	if(count($news_info)>0) {
	 	foreach($news_info as $rows) {
	?>
	  <tr>
        <td align="center"><?=$i?></td>
        <td align="left"><?=$rows->news_title?> </td>
        <td align="center"><?=$rows->posted_date?> </td>
        <td align="center"><?
        if($rows->status==1)
		{
			echo 'Published';
		}
		else
		{
			echo 'Unpublished';
		}
		?> </td>
		
        <td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/news/editnews/'.$rows->news_id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit News"/></a>
		 </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/news/delete/'.$rows->news_type.'/'.$rows->news_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Edit News" onClick="return doconfirm();" /></a>
		 </td>
      </tr>
	  <? $i++;} } ?>
    </table>
<? } else {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ttable">
      <tr>
        <th width="60" align="left"><div align="center">No.</div></th>
        <th width="319" align="left"><div align="left"><b>Title </b></div></th>
        <th width="154" align="left"><div align="center"><b>Posted Date</b></div></th>
        <th width="112" align="left"><div align="center"><b>Status</b></div></th>
		 <th width="111" align="left"><div align="center"><b>News Type</b></div></th>
   		<th width="83" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="92" align="left"><div align="center"><b>Delete</b></div></th>

      </tr>
     <? $i=1;
	 	if(count($news_info)>0) {
	 	foreach($news_info as $rows) {
	?>
	  <tr>
        <td align="center"><?=$i?></td>
        <td align="left"><?=$rows->news_title?> </td>
        <td align="center"><?=$rows->posted_date?> </td>
        <td align="center"><?
        if($rows->status==1)
		{
			echo 'Published';
		}
		else
		{
			echo 'Unpublished';
		}
		?> </td>
		 <td align="center"><?=$rows->news_type?> </td>
        <td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/news/editnews/'.$rows->news_id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit News"/></a>
		 </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/news/delete/'.$rows->news_type.'/'.$rows->news_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Edit News" onClick="return doconfirm();" /></a>
		 </td>
      </tr>
	  <? $i++;} } ?>
    </table>
<? }?>