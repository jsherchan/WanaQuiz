<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are you sure you want to delete this log detail Permanently?");
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


function submitform(act_val)
{
	document.searchform.activated.value=act_val;
	document.forms.searchform.submit();
	//alert(document.searchform.activated.value);
}
</SCRIPT> 
<h2 class="headingclass" >View Site Logs</h2>
<br>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin/');?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/site_statistics/');?>">Site Statisctics</a> </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>


<br />

	<? if($this->session->flashdata('message')){
			echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
		?>
<form name="frm" method="post" action="<?=site_url(ADMIN_PATH.'/site_statistics/deleteChecked/')?>">

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr> <th width="36" align="left"> 
   <input type="checkbox" value="on" name="allbox" onClick="checkAll();"/></th>
    <th width="36" align="left"> ID </th>
	<th width="97" align="left">Username</th>
    <th width="167" align="left">Login Time</th>
	<th width="100" align="left">IP Address</th>
	<th width="153" align="left">Country</th>
	<th width="215" align="left">City</th>
    <th width="105" align="left">Detail</th>
	 <th width="56" align="left">Delete</th>
   
 <?php if(count($logs_info)!=0){
foreach($logs_info as $rows){?>

  <tr> <td>
  	<input type="checkbox" name="logids[]" value="<?=$rows->act_id;?>" /></td>
    <td width="36" align="left"> <?=$rows->act_user_id;?></td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/members/member_details/'.$rows->act_user_id)?>"><?=$rows->act_user;?></a></td>
	<td align="left"><?php echo date('Y-m-d H:i:s',$rows->act_time);?></td>
	<td width="100" align="left"><?=$rows->act_ip;?></td>
	<td width="153" align="left"><?=$rows->act_country;?></td>
	<td width="215" align="left"><?=$rows->act_city;?></td>
    <td align="left"><b><?=$rows->act_name;?></b> </td>
	<td align="left">
	
	<a href="<?=site_url(ADMIN_PATH.'/site_statistics/delete/'.$rows->act_id)?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Log Detail" onClick="return doconfirm();">
	  </a>
	</td>
  </tr>
    
    <? } } ?>
<tr> 
    <td colspan="9" align="left">
	<input type="submit" value="DELETE"/>
	</td>
</tr>
<tr> 
    <th colspan="9" align="left">
	<?php echo $this->pagination->create_links();?>	</th>
</tr>
</table>
</form>
<br />
<div align='left'>
</div>



