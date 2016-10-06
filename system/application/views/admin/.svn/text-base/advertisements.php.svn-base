<h2 class="headingclass" >Advertisement Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt; Advertisement  Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
	<tr>
		<td width="20%">
        <a href="<?=site_url(ADMIN_PATH.'/advertise_management/add_advertisement')?>" style="color:#003399">[+ Add Advertisement]</a>

		</td>

                <td width="20%">
                    <?php if($dimension == 'vertical'){ ?>
        <strong> <a href="<?=site_url(ADMIN_PATH.'/advertise_management/')?>" style="color:#003399">[View Vertical Advertisements]</a></strong><? } else {?>
            <a href="<?=site_url(ADMIN_PATH.'/advertise_management/')?>" style="color:#003399">[View Vertical Advertisements]</a>
            <? }  ?>

		</td>

                <td width="20%">
                     <?php if($dimension =='rectangular') { ?>
         <strong><a href="<?=site_url(ADMIN_PATH.'/advertise_management/rectangular_advertisements')?>" style="color:#003399">[View Rectangular Advertisement]</a></strong>
         <? }else{?>
         <a href="<?=site_url(ADMIN_PATH.'/advertise_management/rectangular_advertisements')?>" style="color:#003399">[View Rectangular Advertisement]</a>
         <?}?>
		</td>
     
	</tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td class="border_block" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                  <tr>
                    <td colspan="2"><link href="css/base.css" rel="stylesheet" type="text/css" />
  
<table width="100%" border="0"  cellpadding="4" cellspacing="0" class="Mtable">
  <tr > 
  <th width="84"  class="th" ><div align="center">Advertisement No.</div></th>
    <th width="198"  class="th"><div align="center">Category Name</div></th>
    <th width="189"  class="th"><div align="center">Advertisement Type</div></th>
    <th width="189"  class="th"><div align="center">Advertisement Position</div></th>
    <th width="180"  class="th"><div align="center">Advertisement Detail</div></th>
    <th width="180"  class="th"><div align="center">Link Url</div></th>
	<th width="189"  class="th"><div align="center">Advertisement Image</div></th>
	
	<th width="69" class="th"><div align="center">Edit</div></th>
	<th width="62" class="th"><div align="center">Delete</div></th>
	</tr>
<?php if(count($advertisement_list)>0){
foreach($advertisement_list as $rows){
?>  
  <tr align="center" class=""> 
  	<td><?=$rows->id?></td>
    <td >
    <? $cat_info=$this->Category_model->get_category_by_id($rows->cat_id);?>
    <?=$cat_info->name?>


    </td>
    <td> <?=$rows->adv_type?> </td>
    <td> <?=$rows->adv_position?> </td>
    <td> <?=$rows->adv_detail?> </td>
    <td> <?=$rows->link_url?> </td>
	<td> <img src='<?=base_url()?>advertisement_banners/<?=$rows->adv_banner?>' width="50" /></td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/advertise_management/edit_advertisement/'.$rows->id) ?>">
				<img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Badge" border="0">				</a>				</td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/advertise_management/delete_advertisement/'.$rows->id) ?>">
				<img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Badge" onClick="return doConfirm()"  border="0">				</a>				</td>
</tr>			  
  <? }
    }?>
</table>
					</td>
                  </tr>
                </table></td>
			  </tr>
</tbody></table>



<script>

function doConfirm()
{
	msg=confirm("Are you sure you want to delete this Advertisement Permanently?");
	if(msg!=true)
	{
		return false;
	}
}

</script>	
			