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

<script type="text/javascript" src="<?= base_url();?>js/function_search.js"></script>

<h2 class="headingclass" >View Members Details</h2>
<br>
<table width="800" cellpadding="1">
  
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="">ADMIN</a> 
      >><a href=""> Member Management </a></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>
<table>
  <form name="searchform" action="<?= site_url(ADMIN_PATH.'/members/search');?>" method="post">
    <tr> 
      <td><strong>Search Members By Name, Number or Email : </strong>&nbsp;&nbsp; </td>
      <td> <input type="text" name="search_member" id="search_member" size="30" maxlength="60"> 
	  <input type="hidden" name="activated" value=""/>
	  <input type="hidden" name="order_by" value=""/>
	  </td>
	   <td> 	<input type="submit" value="search" id="search_button" />
	  </td>
    </tr>
  </form>
</table>
<br />
<table width="800" cellpadding="1">
  <tr>
    <td><strong>[
        <?php echo  anchor(ADMIN_PATH.'/members/add_member/','Add Member');?>
    ]</strong></td>
    <td> <strong>[ <? if($f=='0') {?>Normal Users<? }else{?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/0/joined_date/DESC')?>">Normal Users</a><? }?>]</strong></td>
    <td> <strong>[<? if($f=='1') {?>Small Advertisers<? }else{?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/1/joined_date/DESC')?>">Small Advertisers</a><? }?>]</strong></td>
    <td> <strong>[<? if($f=='2') {?>Large Advertisers<? }else{?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/2/joined_date/DESC')?>">Large Advertisers</a><? }?>]</strong></td>
    <td ><strong>[<? if($f=='all') {?>All<? }else{?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/all/joined_date/DESC')?>">All</a><? }?>]</strong></td>
  </tr>
</table>

<p><?php if($msg){
		echo "<div class='message'>".$msg."</div>";
		}
	?>
 <div id="member_description" style="display:none;">
	<p>Enter your function above</p>
</div>
	
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr> 
    <th width="98" align="left"> <a href="#" style="color:#FFFFFF" onclick="submitform_byorder('userid')"> Heppa ID </a> </th>
    <th width="198" align="left"> <a href="#" style="color:#FFFFFF" onclick="submitform_byorder('firstname')"> Name </a> </th>
    <th width="178" align="left"> <a href="#" style="color:#FFFFFF" onclick="submitform_byorder('email')"> Email </a></th>
    <th width="149" align="center"><b> <a href="#" style="color:#FFFFFF" onclick="submitform_byorder('registration_date')"> Reg Date </a> </b></th>
    <th width="135" align="center"> Edit </th>
    <th width="129" align="center"> Delete </th>
<?php if(count($search_results)!=0){
foreach($search_results as $rows){?>
  <tr> 
   
    <td align="left"><?php echo  $rows->user_id;?></td>
 <td align="left"><a href="<? echo site_url(ADMIN_PATH."/members/member_details/".$rows->user_id);?>"><?php echo $rows->username;?>  </a></td>
    <td width="178" align="left">  <?php echo $rows->email;?></td>
    <td align="left"><?php echo $rows->joined_date;?></td>
   	<td align="left"><a href="<?=site_url(ADMIN_PATH."/members/edit_member/".$rows->user_id);?>" > 
      <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
    <td align="left"><a href="<?=site_url(ADMIN_PATH."/members/delete/".$rows->user_id);?>"> 
      <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a> 
    </td>
  </tr>
<?php  } 

} else { ?>
<tr>
<td colspan="7" align="center">Sorry No Records Found</td>
</tr>

<?php }?>
</table>
