<h2 class="headingclass" >View Country Detail</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This City's Detail Parmanently?");
	if(job!=true)
	{
		return false;
	}
}
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH)?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/country_management')?>">Country and State Management</a>  >> <?=anchor(site_url(ADMIN_PATH.'/country_management/states_list/'.$country_info[0]['country_id'].'/state_name/ASC'),$country_info[0]['country_name'])?> >> <?=$state_info[0]['state_name']?> </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width="450" cellpadding="1">
  <tr>
    <td><strong>[ <a href="<?=site_url(ADMIN_PATH.'/country_management/add_city/'.$country_info[0]['country_id'].'/'.$state_info[0]['state_id'])?>">ADD NEW CITY</a> ]</strong></td>
	   
</table>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 
         
    <th align="left"><div align="center">No.</div></th>
	<th align="left"><div align="left"><a href="<?=site_url(ADMIN_PATH.'/country_management/city_list/'.$country_info[0]['country_id'].'/'.$state_info[0]['state_id'].'/city_name/'.$sort)?>"><b>City Name</b></a> </div></th>
	
	<th align="left"><div align="center"><b>Edit State Detail</b></div></th>
    <th align="left"><div align="center"><b>Delete</b></div></th>
	
 <?php if(count($city_list)!=0){
$j=1;
foreach($city_list as $rows){?>
	 
	 <tr> 
      
     
    <td align="center"><?=$j?></td>
    <td align="left"><?=$rows->city_name?> </td>
		
    <td align="center"> <a href="<?=site_url(ADMIN_PATH.'/country_management/edit_city/'.$country_info[0]['country_id'].'/'.$state_info[0]['state_id'].'/'.$rows->city_id)?>"> 
      <img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Country"></a> </td>
			
    <td align="center"><a href="<?=site_url(ADMIN_PATH.'/country_management/delete_city/'.$country_info[0]['country_id'].'/'.$state_info[0]['state_id'].'/'.$rows->city_id)?>"> 
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

