<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are you sure you want to delete this category detail Permanently?");
	if(job!=true)
	{
		return false;
	}
}
function submitform(act_val)
{
	document.searchform.activated.value=act_val;
	document.forms.searchform.submit();
	//alert(document.searchform.activated.value);
}

function submitform_byorder(act_val)
{
	document.searchform.order_by.value=act_val;
	document.forms.searchform.submit();
	//alert(document.searchform.activated.value);
}

function unhide_form()
{
	document.getElementById('category_form').style.display='block';
	
}
</SCRIPT> 

<h2 class="headingclass" >Categories Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/categories')?>"> Category Management </a></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>

<table>
    <form name="category_search_form" action="<?=site_url(ADMIN_PATH.'/categories/search')?>" method="post">
    <tr> 
      <td height="36"><strong>Search Category or Sub-Category By Name : </strong>&nbsp;&nbsp; </td>
      <td> <input type="text" name="search_category" value="" size="30" maxlength="60"> 
	 
	  </td>
	   <td> <input type="Submit" name="search" value="Search" class="bttn">  </td>
    </tr>
  </form>
</table>


<?php if($message){
		echo "<div class='message'>".$message."</div>";
		}
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr> 
    <th width="112" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
    <th width="497" align="center"> <a href="" style="color:#FFFFFF">  Category </a></th>
   
    <th width="91" align="center"> Edit </th>
    <th width="97" align="center"> Delete </th>
<?php if(count($search_results)!=0){
$j=1;
foreach($search_results as $rows){?>
  <tr> 
   
    <td align="left"><?php echo  $j;?></td>
    <td align="left"><?php if($rows->parent_id==0) echo  anchor(site_url(ADMIN_PATH.'/categories/categories_list/'.$rows->parent_id),$rows->name); else echo $rows->name?></td>
	<td align="left"><a href="<?=site_url(ADMIN_PATH.'/categories/edit_category/'.$rows->id) ?>"> 
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/categories/delete/'.$rows->id) ?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a> 
    </td>
  </tr>
<?php  $j++;}

} else { ?>
<tr>
<td colspan="7" align="center">Sorry No Records Found</td>
</tr>
<?php }?>
</table>
<br />
<div align='left'>


</div>

<br />