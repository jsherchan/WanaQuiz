<h2 class="headingclass" >View Country Detail</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This State's Detail Parmanently?");
	if(job!=true)
	{
		return false;
	}
}
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH)?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/country_management')?>">Country and State Management</a> >> <?=$country_info[0]['country_name']?> </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width="450" cellpadding="1">
  <tr>
    <td><strong>[ <a href="<?=site_url(ADMIN_PATH.'/country_management/add_states/'.$country_info[0]['country_id'])?>">ADD NEW STATES</a> ]</strong></td>
	   
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 
         
    <th align="left"><div align="center">No.</div></th>
	<th align="left"><div align="left"><a href="<?=site_url(ADMIN_PATH.'/country_management/states_list/'.$country_info[0]['country_id'].'/state_name/'.$sort)?>"><b>State Name</b></a> </div></th>
	<th align="left"><div align="left"><a href="<?=site_url(ADMIN_PATH.'/country_management/states_list/'.$country_info[0]['country_id'].'/state_abbr/'.$sort)?>"><b>State Abbr</b></a></div></th>
	<th align="left"><div align="center"><b>Edit State Detail</b></div></th>
    <th align="left"><div align="center"><b>Delete</b></div></th>
	
 <?php if(count($states_list)!=0){
$j=1;
foreach($states_list as $rows){?>
	 
	 <tr> 
      
     
    <td align="center"><?=$j?></td>
    <td align="left">
  <!--  <a href="<?=site_url(ADMIN_PATH.'/country_management/city_list/'.$country_info[0]['country_id'].'/'.$rows->state_id.'/city_name/ASC')?>"> <?=$rows->state_name?> </a>--><?=$rows->state_name?></td>
	 <td align="left"><?=$rows->state_abbr?></td>
	
		
    <td align="center"> <a href="<?=site_url(ADMIN_PATH.'/country_management/edit_state/'.$country_info[0]['country_id'].'/'.$rows->state_id)?>"> 
      <img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Country"></a> </td>
			
    <td align="center"><a href="<?=site_url(ADMIN_PATH.'/country_management/delete_state/'.$country_info[0]['country_id'].'/'.$rows->state_id)?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' alt="Delete Country" onClick="return doconfirm();"></a> 
    </td>
	 </tr>
	<? 
	$j++;
	} 
	?>
	<tr>
	<td colspan="5">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="5" align="center">Sorry No Records Found</td>
</tr>

<?php }?>	
</table>

