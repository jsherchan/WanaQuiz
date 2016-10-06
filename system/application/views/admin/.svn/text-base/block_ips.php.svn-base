
<h2 class="headingclass" >Blocked IP Details</h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> 
      >> IP Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<hr />
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width="100%" cellpadding="1">
	  <tr>
	  	<td align="center" class="errMsg"><strong>	</strong></td>
	  </tr>
</table>

<table width="70%" cellpadding="1">
  <tr>
  	 <td>
	 <form name="ip_frm" action="<?=site_url(ADMIN_PATH.'/block_ips/add_ip')?>" method="post">
	 	<table align="center">
			<tr>
				<td>IP Address:</td>
				<td><input type="text" name="ip_address" size="20" value=""/></td>
			</tr>
			<tr>
				<td valign="top">Description:</td>
				<td><textarea name="ip_desc" cols="20" rows="2"></textarea></td>
			</tr>
			<tr>
				<td valign="top"></td>
				<td><input type="submit" name="mode" value="Add" class="bttn" /></td>
			</tr>
		</table>
	</form>
	</td>
</table>
<hr />

<table width="100%" cellpadding="0" cellspacing="0">
	  <tr>
	  	<td align="center" ><strong>
			
			</strong></td>
	  </tr>
</table>


<table width="100%" cellpadding="1">
	  <tr>
	  	<td><strong>Blocked IP List</strong></td>
	  </tr>
</table>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="4" class="ttable">
	
  <tr> 
    <th width="5%"  bgcolor="#EEFFDD" class="label_bg"> No.  </th>
    <th width="14%"  bgcolor="#EEFFDD" class="label_bg">  IP Address  </th>
    <th width="35%"  bgcolor="#EEFFDD" class="label_bg">  Reason</th>
	 <th width="22%"  bgcolor="#EEFFDD" class="label_bg">  Blocked Date</th>
	
    <th width="11%"  bgcolor="#EEFFDD" class="label_bg"> Edit </th>
    <th width="13%"  bgcolor="#EEFFDD" class="label_bg"> Delete </th>
  </tr>
<?php
$i=1;
 if(count($blocked_ip)!=0){
foreach($blocked_ip as $rows){?>
  <tr> 
    <td  align="left"><?=$i?></td>
    <td align="left"><?php echo $rows->blockip_address;?></td>
	<td align="left"><?php echo $rows->blockip_desc;?></td>
	<td align="left"><?php echo $rows->blockip_date;?></td>	 
    <td align="left"> <a href="<?=site_url(ADMIN_PATH.'/block_ips/edit_form/'.$rows->blockip_id)?>"> 
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Delete Member Detail" >
	  </a> </td>
    <td align="left">
	
	<a href="<?=site_url(ADMIN_PATH.'/block_ips/delete/'.$rows->blockip_id)?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();">
	  </a>
	  
	   
    </td>
	</tr>
	
	<?php  $i++;}?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php
} else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>
</table>

<table width="100%" align="center">
	<tr>
		<td width="112" align="left">
</td>
		<td width="189" align="right">
	</td>
	</tr>
</table>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are you sure you want to delete this IP Address?");
	if(job!=true)
	{
		return false;
	}
}
</SCRIPT> 