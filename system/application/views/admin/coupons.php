
<link href="../style/style.css" rel="stylesheet" type="text/css" />

<? if($view_coupons_layout=="no"){?>
<H1 class="headingclass" ><? //ucfirst($_GET[action])?> Scratch Coupons Management </H1>

<form  name="frm" method="post" action="<?php if(isset($coupon_info)) echo site_url(ADMIN_PATH."/coupon_code/update/"); else echo site_url(ADMIN_PATH."/coupon_code/insert/");?> ">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="<?=site_url(ADMIN_PATH."/coupon_code")?>">ADMIN</a> &gt;&gt; Scratch Coupon Management </span></td>
    <td>
	<a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	<span class="bodytext">Back</span></a></td>
  </tr>
</table>
<br /><br />
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" style="border:1px solid #81A4CE;">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="39%" align="right"><b>Coupon Code<span class="small">*</span>  :</b> </td>
      <td width="61%">
	 
	  <input name="coupon_code" type="text" class="normal" id="coupon_code" value="<? if(isset($coupon_info)) echo $coupon_info->coupon_code?>">
	  <input type="hidden" name="id" value="<? if(isset($coupon_info)) echo $coupon_info->id?>" />
	  <span class="small">	  (10 to 15 digit is better for secure code Ex: 8569AYHK369MN17)</span></td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Amount<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="amount" type="text" class="normal" id="v_amt" value="<? if(isset($coupon_info)) echo $coupon_info->amount?>"></td>
    </tr>
	 <!--<tr>
      <td width="39%" align="right"><b>Bid Credits<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="bid_credits" type="text" class="normal" id="v_bid" value="<? if(isset($coupon_info)) echo $coupon_info->bid_credits?>"></td>
    </tr>-->
	
	 <tr>
      <td width="39%" align="right"><b>Validity Days<span class="small">*</span> :</b> </td>
      <td width="61%"><input name="validity_days" type="text" class="normal" id="validity_days" value="<? if(isset($coupon_info)) echo $coupon_info->validity_days?>">DAYS
        <span class="small">(90)</span></td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Activated<span class="small">*</span>   :</b> </td>
      <td width="61%"><input type="radio" name ="activated" value="no" <? if(isset($coupon_info) && $coupon_info->activated=='no') echo "checked";?> /> No
	  <input type="radio" name ="activated" value="yes" <? if(isset($coupon_info) && $coupon_info->activated=='yes') echo "checked";?>/> Yes
	 </td>
    </tr>
	
    <tr>
      <td colspan="2" align="center">
	<br /> <input type="submit" name="Submit" value="<?php if(isset($coupon_info)) echo "Edit Offer"; else echo "Add Coupon"; ?>" /></td>
    </tr>
  </table>
</form>
<? }?>

<? if($view_coupons_layout=="yes"){?>
<h1 class="headingclass" >View Scratch Coupons  </h1>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="admin.php?function=welcome">ADMIN</a> &gt;&gt; Scratch Coupons Management </span></td>
    <td><a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:window.back()"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<p>
[<a href="<?=site_url(ADMIN_PATH.'/coupon_code/add_coupon/')?>">+Add Coupons</a>]  <!--[<a href="<?=site_url(ADMIN_PATH.'/coupon_code/csvimport/')?>">Impost CSV</a>]-->

<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<table width="100%"  border="0">
  <!--<tr>
    <td width="32%">[ <a href="<?=site_url(ADMIN_PATH.'/bonus_offer_management/add_offer/')?>"><strong>Add Site Promotion Offer </strong></a> ]</td>
    <td width="44%" height="35">&nbsp;</td>
    <td width="24%" valign="top"><a href="admin.php?function=voucher"></a></td>
  </tr>-->
</table>

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="Mtable">
 
         
    <tr>
	<th width="5%" align="left" style="border-bottom:1px solid #93bee2" ><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/id/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> ID </a> </th>
	  <th width="19%" align="left"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/coupon_code/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Coupon  Code</a> </th>
	   <th width="8%" align="right"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/amount/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Amount</a></th>
	  <th width="11%" align="left"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/numbers_in_use/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">No. of times in use </a></th>
	   <th width="11%" align="left"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/validity_days/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Validity Days</a></th>
	   <th width="9%" align="left"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/activated/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Activated</a></th>
	   <th width="23%" align="left"><a href="<?=site_url(ADMIN_PATH.'/coupon_code/view_coupons/added_date/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Added Date</a></th>
	   
	  <th width="14%" align="center"><b>Edit</b> </th>
	<!--<th width="5%" align="center"><b>Delete</b> </th>-->
	
    
   <? 
   		
   	   foreach($coupon_info as $result_voucher)
	   {  
	  
   ?>	 
  <tr> 
      
     <td align="left"><?=$result_voucher->id?></td>
	 <td align="left"><?=$result_voucher->coupon_code?></td>
	  <td align="right"><?=$this->currency_code?><?=$result_voucher->amount?> </td>
	 <td align="center"><?=$result_voucher->numbers_in_use?></td>
	  <td align="center"><?=$result_voucher->validity_days?></td>
	 <td align="center"><?=$result_voucher->activated?></td>
	  <td align="center"><?=date('Y-m-d H:i:s',$result_voucher->added_date)?></td>
	 <td align="center"><a href="<?=site_url(ADMIN_PATH."/coupon_code/edit_coupon/".$result_voucher->id)?>">
          <img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit " border="0"></a> </td>
	<!--<td align="center">
	<a href="admin.php?function=voucher&action=delete&vid=<? //=$result_voucher['vid']?>" onclick="return confirm('Are you sure to delete? ')"> 
    <img src='images/delete.gif' alt="Delete" border="0" >	</a> </td>	-->
  </tr>
  
	<? } ?>
	<tr>
	<td colspan="8">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
</table>
<? } ?>
<script type="text/javascript">
function checkfrm()
{
	if(document.frm.coupon_code.value<10 || document.frm.coupon_code.value>15)
	{
		alert("coupon code must be between 10 to 15");
		document.frm.coupon_code.focus();
		return false;
	}
	else if(document.frm.v_amt.value=="")
	{
		alert("Amount field is blank.");
		document.frm.v_amt.focus();
		return false;
	}
	else if(document.frm.v_bid.value=="")
	{
		alert("Bid credit field is blank.");
		document.frm.v_bid.focus();
		return false;
	}
	
	else if(document.frm.description.value=="")
	{
		alert("description field is blank.");
		document.frm.description.focus();
		return false;
	}
}
</script>