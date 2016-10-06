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
      >><a href="<?=site_url(ADMIN_PATH.'/security')?>"> Security Management </a></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>



<table width="550" cellpadding="1">
  <tr>
    <td><strong>[ <b><a href="#" onclick="unhide_form()">Add Group</a></b> ]</strong></td>
  </tr>
</table>
<br />
<div id="category_form" style="display:none">
<table>
  <form name="add_category_form" action="<?=site_url(ADMIN_PATH.'/security/addGroup')?>" method="post">
    <tr> 
      <td height="36"><strong>Group Name : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="group_name" value="" size="30" maxlength="60"> 
	   </td>
	 </tr>
		
	
	<tr>
	<td colspan="2" align="center"><input type="Submit" name="add" value="Add" class="bttn">  </td>
    </tr>
  </form>
</table>
</div>

<br />
<table width="550" cellpadding="1">
  <tr>
    <td><strong><b><?= anchor(site_url(ADMIN_PATH.'/security'),'Home')?></b></strong></td>
  </tr>
</table>
<br />

<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr> 
    <th width="82" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
    <th width="527" align="center"> <a href="" style="color:#FFFFFF">  Group Name</a></th>
   
    <th width="171" align="center"> Edit </th>
    <th width="215" align="center"> Delete </th>
<? if(count($group_list)>0){
 foreach($group_list as $group){
?>
  <tr> 
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/Group'.'/'.$group->ID)?>"><?=$group->ID?> </a> </td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/Group'.'/'.$group->ID)?>"><?=$group->group_name?></a>  </td>
	<td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/editGroup'.'/'.$group->ID)?>"> 
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/removeGroup'.'/'.$group->ID)?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a> 
    </td>
  </tr>
<?php 
	}
}
?>
<tr>
<td colspan="9" align="center">Sorry No Records Found</td>
</tr>
</table>
<br />
<div align='left'>


</div>

<br />