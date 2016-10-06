
<link href="../style/style.css" rel="stylesheet" type="text/css" />

<? if($view_bonus_layout=="no"){?>
<H1 class="headingclass" ><? //ucfirst($_GET[action])?> Site Promotion Management </H1>

<form  name="frm" method="post" action="<?php if($bonus_info->offer_id) echo site_url(ADMIN_PATH."/bonus_offer_management/insert/"); else echo site_url(ADMIN_PATH."/bonus_offer_management/update/");?> ">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="<?=site_url(ADMIN_PATH."/bonus_offer_management")?>">ADMIN</a> &gt;&gt; Promotion Management </span></td>
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
      <td width="39%" align="right"><b>Promotion Code<span class="small">*</span>  :</b> </td>
      <td width="61%">
	 
	  <input name="code" type="text" class="normal" id="code" value="<?=$bonus_info->code?>">
	  <input type="hidden" name="<? //$_REQUEST['action']?>" value="yes" />
	  <input type="hidden" name="id" value="<?=$bonus_info->offer_id?>" />
	  <span class="small">	  (10 to 15 digit is better for secure code Ex: 8569AYHK369MN17)</span></td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Promotion Offer Type<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="offer_type" type="text" class="normal" id="v_off_type" value="<?=$bonus_info->offer_type?>" readonly=""></td>
    </tr>
	 <tr>
      <td width="39%" align="right"><b>Promotion in Amount<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="amount" type="text" class="normal" id="v_amt" value="<?=$bonus_info->amount?>"></td>
    </tr>
	 <tr>
      <td width="39%" align="right"><b>Promotion in Bid Credit<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="bid_credit" type="text" class="normal" id="v_bid" value="<?=$bonus_info->bid_credit?>"></td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>No. of Credit Validity Days<span class="small">*</span> :</b> </td>
      <td width="61%"><input name="validity_days" type="text" class="normal" id="validity_days" value="<?=$bonus_info->validity_days?>">DAYS
        <span class="small">(90)</span></td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Short Description<span class="small">*</span>   :</b> </td>
      <td width="61%"><textarea name="description" class="normal" id="description"><?=$bonus_info->description?></textarea></td>
    </tr>
	 <tr>
      <td width="39%" align="right"><b>Activate<span class="small">*</span>   :</b> </td>
      <td width="61%"><select name="activate" class="normal" >
	  <option value="yes" <?php if($bonus_info->activate=="yes") echo "Selected"; ?>>Yes</option>
	  <option value="no" <?php if($bonus_info->activate=="no") echo "Selected"; ?>>No</option>
	  </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	<br /> <input type="submit" name="Submit" value="<?php if($bonus_info->offer_id) echo "Edit Offer"; else "Add Offer"; ?>"/></td>
    </tr>
  </table>
</form>
<? }?>

<? if($view_bonus_layout=="yes"){?>
<h1 class="headingclass" >View Site Promotion Management </h1>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="admin.php?function=welcome">ADMIN</a> &gt;&gt; Promotion Management </span></td>
    <td><a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:window.back()"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

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
	<th width="2%" align="left" style="border-bottom:1px solid #93bee2" ><b> S.N. </b> </th>
	  <th width="16%" align="left">Promotion  Code </th>
	   <th width="14%" align="left">Offer Type</th>
	  <th width="8%" align="left">Amount</th>
	  <th width="11%" align="left">Bid Credit </th>
	   <th width="9%" align="left">Validity Days</th>
	   <th width="9%" align="left">Activate</th>
	  <th width="17%" align="center"><b>Edit</b> </th>
	<!--<th width="5%" align="center"><b>Delete</b> </th>-->
	
    
   <? 
   		$count=1;
   	   foreach($bonus_offer_info as $result_voucher)
	   {  
	  
   ?>	 
  <tr> 
      
     <td align="center"><? echo $count; ?></td>
	 <td align="center"><?=$result_voucher->code?></td>
	  <td align="center"><?=$result_voucher->offer_type?> </td>
	 <td align="center"><?=$this->currency_code?><?=$result_voucher->amount?> </td>
	 <td align="center"><?=$result_voucher->bid_credit?></td>
	  <td align="center"><?=$result_voucher->validity_days?></td>
	 <td align="center"><?=$result_voucher->activate?></td>
	 <td align="center"><a href="<?=site_url(ADMIN_PATH."/bonus_offer_management/edit_offer/".$result_voucher->offer_id)?>"> 
          <img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit " border="0"></a> </td>
	<!--<td align="center">
	<a href="admin.php?function=voucher&action=delete&vid=<? //=$result_voucher['vid']?>" onclick="return confirm('Are you sure to delete? ')"> 
    <img src='images/delete.gif' alt="Delete" border="0" >	</a> </td>	-->
  </tr>
	<? $count++;} ?>
</table>
<? } ?>
<script type="text/javascript">
function checkfrm()
{
	if(document.frm.code.value<10 || document.frm.code.value>15)
	{
		alert("voucher code must be between 10 to 15");
		document.frm.code.focus();
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