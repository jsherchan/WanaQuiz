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
	document.getElementById('setprevileges').style.display='';
	
}

function set_previleges(group_id)
{	
		$.post("<?=site_url(ADMIN_PATH.'/ajax_set_previleges')?>", {group_id: group_id} , function(data)
		{
			
			 if (data != '' || data != undefined || data != null) 
			   {
			   		$('#category_form').html(''); 	
				  $('#setprevileges').html(data); 	
			   }
          });							
	

}
</SCRIPT> 

<h2 class="headingclass" >Group Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/security')?>"> Group Management </a> >> <?=$group_info->group_name?></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>



<table width="550" cellpadding="1">
  <tr>
    <td><strong>[ <b><a href="javascript:void(0);" onclick="unhide_form()">Add Member</a></b> ]</strong></td>
	 <td><strong>[ <b><a href="javascript:void(0);" onclick="set_previleges(<?=$group_info->ID?>)">Set Access Previleges</a></b> ]</strong></td>
  </tr>
</table>
<br />
<div id="category_form" style="display:none">
<table>
  <form name="add_category_form" action="<?=site_url(ADMIN_PATH.'/security/addAdminMembers')?>" method="post">
    <tr> 
      <td height="36"><strong>Admin Name : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="name" value="" size="30" maxlength="60"> 
	   </td>
	 </tr>
	
	  <tr> 
      <td height="36"><strong>Userame : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="username" value="" size="30" maxlength="60"> 
	   </td>
	 </tr>
	 
	  <tr> 
      <td height="36"><strong>Password : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="password" name="password" value="" size="30" maxlength="60"> 
	   </td>
	 </tr>
	 
	   <tr> 
      <td height="36"><strong>Email : </strong>&nbsp;&nbsp; </td>
      <td>
	  <input type="text" name="email" value="" size="30" maxlength="60"> 
	   </td>
	 </tr>
	<input type="hidden" name="group_id" value="<?=$group_info->ID?>" />
	<tr>
	<td colspan="2" align="center"><input type="Submit" name="add" value="Add" class="bttn">  </td>
    </tr>
  </form>
</table>
</div>

<br />
<div id="setprevileges"></div>

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
    <th width="527" align="center"> <a href="" style="color:#FFFFFF">  Member Name</a></th>
	 <th width="527" align="center"> <a href="" style="color:#FFFFFF">  Username</a></th>
    <th width="527" align="center"> <a href="" style="color:#FFFFFF">  Email</a></th>
    <th width="171" align="center"> Edit </th>
    <th width="215" align="center"> Delete </th>
<? if(count($group_members_list)>0){
 foreach($group_members_list as $members){
?>
  <tr> 
    <td align="left"><?=$members->id?> </td>
	 <td align="left"><?=$members->name?> </td>
    <td align="left"><?=$members->username?>  </td>
	<td align="left"><?=$members->email?> </td>
  	<td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/editGroupMember'.'/'.$members->id.'/'.$group_info->ID)?>"> 
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH.'/security/removeGroupMember'.'/'.$members->id.'/'.$group_info->ID)?>"> 
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