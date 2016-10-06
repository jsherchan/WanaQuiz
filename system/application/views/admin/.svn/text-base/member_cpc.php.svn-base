<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are you sure you want to delete this member detail Permanently?");
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


</SCRIPT> 
<script type="text/javascript">
//<![CDATA[
base_url = '<?= base_url();?>index.php/';
//]]>
</script>
<script type="text/javascript" src="<?= base_url()?>js/function_search.js"></script>

<h2 class="headingclass" >View Members Details </h2>
<br>
<table width="800" cellpadding="1">
  
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>
<table>
   
  <tr>
  <td>
   
	<form name="searchform" action="<?= site_url(ADMIN_PATH.'/members/search/')?>" method="post">
	 <div>
   <label for="function_name"><strong>Search Members By Name, Number or Email : </strong></label>&nbsp;&nbsp; 
     <input type="text" name="search_member" id="search_member" size="30" maxlength="60"> 
	<input type="submit" value="search" id="search_button" />
	     
	</div>
  </form>
  </td>
  </tr>
</table>
<br />
<table width="800" cellpadding="1">
  <tr>
    <td> <strong>[ <a href="<?=site_url(ADMIN_PATH.'/members/add_member_cpc')?>">Add Member CPC</a>]</strong></td>
   
    <td ><strong>[Member CPC]</strong></td>
  </tr>
</table>

<p><?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<div id="member_description" style="display:none;">
	<p>Enter your function above</p>
</div>
	
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr> 
    <th width="96" align="left">  S No.</th>
    <th width="178" align="left"> User Id </th>
    <th width="119" align="left"> CPC </th>
    <th width="72" align="center"> Edit </th>
    <th width="88" align="center"> Delete </th>
<?php if(count($member_cpc)!=0){
foreach($member_cpc as $rows){?>
  <tr> 
   
    <td align="left"><?php echo  $rows->id;?></td>
    <td align="left"><?php echo $rows->user_id;?></td>
    <td width="119" align="left">  <?php echo $rows->cpc;?></td>
    <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/members/edit_member_cpc/<?php echo $rows->user_id; ?>" >
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
    <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/members/delete_member_cpc/<?php echo $rows->id; ?>">
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a> 
    </td>
  </tr>
<?php  }?>
	
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>
</table>
