</script>
 <!-- For Calendar --> 
<script type="text/javascript" src="<?=base_url();?>calendar/calendar.js"></script>
<script type="text/javascript" src="<?=base_url();?>calendar/calendar-en.js"></script>
<script type="text/javascript" src="<?=base_url();?>calendar/calendar-setup.js"></script>
<link href="<?=base_url();?>calendar/calendar.css" rel="stylesheet" type="text/css"/>

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

<h2 class="headingclass" >Project Reports </h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="">ADMIN</a> 
      >><a href=""> Project Reports </a></span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>

<br />
<table width="854" cellpadding="1">
  <tr>
   	<td width="192"><strong>[<?php if($task=='auction_winner') echo 'Auction Winner'; else echo anchor(ADMIN_PATH.'/reports/project_list/auction_winner','Auction Winner'); ?>]</strong></td>

	<td width="180"><strong>[<?php if($task=='bid_reports') echo 'Bidding Report'; else echo anchor(ADMIN_PATH.'/reports/project_list/bid_reports','Bidding Report'); ?>]</strong></td>
<td width="168"><strong>[<?php if($task=='daily_bid_reports') echo 'Daily Bid Report'; else echo anchor(ADMIN_PATH.'/reports/project_list/daily_bid_reports','Daily Bid Report'); ?>]</strong></td>
	<td width="156"><strong>[<?php if($task=='ongoing_auction') echo 'Ongoing Auction Report'; else echo anchor(ADMIN_PATH.'/reports/project_list/ongoing_auction','Ongoing Auction Report');?>]</strong></td>
    
	<td width="134"><strong>[<?php if($task=='top_ten_user') echo 'Top Ten Bidders'; else echo anchor(ADMIN_PATH.'/reports/project_list/top_ten_user','Top Ten Bidders'); ?>]</strong></td>
  </tr><tr>

	<td><strong>[<?php if($task=='passive_user') echo 'Passive User'; else echo anchor(ADMIN_PATH.'/reports/project_list/passive_user','Passive User'); ?>]</strong></td>
	
	<td><strong>[<?php if($task=='top_five_auction') echo 'Top 5 Popular Auction'; else echo anchor(ADMIN_PATH.'/reports/project_list/top_five_auction','Top 5 Popular Auction'); ?>]</strong></td>

	<td><strong>[<?php if($task=='completed_transaction') echo 'Completed Transaction'; else echo anchor(ADMIN_PATH.'/reports/project_list/completed_transaction','Completed Transaction'); ?>]</strong></td>
			
</tr>
</table><br />

			<?php if($task=='completed_transaction' || $task=='bid_reports' ) { ?>
			<table>
			  <form name="date_form" action="<?=site_url(ADMIN_PATH.'/reports/project_list/'.$task)?>" method="post">
				<tr> 
				  <td height="36"><strong>Start Date : </strong>&nbsp;&nbsp; </td>
				  <td><input type="text" name="start_date" value="" id="start_date" size="20" maxlength="60">
				  						 <img src="<?=base_url()?>calendar/calendar.gif" width="16" class="dot" height="15" align="top" id="calendarImage1" style="cursor: pointer;">
											  <script type="text/javascript">
												Calendar.setup(
												{
													inputField  : "start_date",        // ID of the input field
													ifFormat    : "%Y-%m-%d",  // the date format
													button      : "calendarImage1",   // ID of the button
													showsTime   : "true"         // ID of the button
												}
												)
											</script>
 </td><td>&nbsp;&nbsp;</td>
				  <td height="36"><strong>End Date : </strong>&nbsp;&nbsp; </td>
				  <td><input type="text" name="end_date" value="" id="end_date" size="20" maxlength="60">
				  						 <img src="<?=base_url()?>calendar/calendar.gif" width="16" class="dot" height="15" align="top" id="calendarImage2" style="cursor: pointer;">
											  <script type="text/javascript">
												Calendar.setup(
												{
												inputField  : "end_date",        // ID of the input field
												ifFormat    : "%Y-%m-%d",  // the date format
												button      : "calendarImage2",   // ID of the button
												showsTime   : "true"         // ID of the button
												}
												)
											</script>
 </td>
				   <td> 
				   <input type="hidden" name="show" value="show" />
				   <input type="Submit" name="submit" value="Show" class="bttn">  </td>
				</tr>
			  </form>
			</table>
			<?php } ?>

<!-- to display the auction winner  -->	

<?php if($task=='auction_winner') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/auction_winner')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
<?php
$a3 = array();
$a3['values'][] = 'Winner ID';
$a3['values'][] = 'Winner Name';
$a3['values'][] = 'Auction Name';
?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>

  <tr> 
    <th width="98" align="left">Winner ID</th>
    <th width="198" align="left">Winner Name</th>
    <th width="161" align="left">Auction Name</th>
<?php 
 		$a4 = array();
		$count=0;
if(count($auction_winner)!=0){
foreach($auction_winner as $rows){
	 // this is for the excel export
	  $a4[$count][] = $rows->user_id;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->auc_name;
	  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->user_id?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td align="left"><?=$rows->auc_name?></td>
    </td>
  </tr>
<?php  
$count++;
}
 //$this->session->set_userdata('report_values',$a4);	
?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>


<!-- to display the bid reports of particular days  -->	

<?php if(($this->input->post('show') && $task=='bid_reports')) { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/bid_reports')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr><td colspan="6"><strong>Total No. of Bids:&nbsp; <?php echo count($bid_reports);?></strong></td></tr>
 <?php
$a3 = array();
$a3['values'][] = 'Bid ID';
$a3['values'][] = 'Member Name';
$a3['values'][] = 'Auction Name';
$a3['values'][] = 'Bid Amount';
$a3['values'][] = 'Date';
?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
  <tr> 
    <th width="98" align="left">Bid ID</th>
    <th width="198" align="left">Member Name</th>
    <th width="161" align="left">Auction Name</th>
    <th width="178" align="left">Bid Amount</th>
    <th width="161" align="left">Date</th>
<?php 
		$a4 = array();
		$count=0;
if(count($bid_reports)!=0){
foreach($bid_reports as $rows){
 	// this is for the excel export
	  $a4[$count][] = $rows->id;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->bid_amount;
	  $a4[$count][] =$rows->bid_date;
	  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->id?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td align="left"><?=$rows->auc_name?></td>
    <td width="178" align="left"><?=$this->currency_code?><?=$rows->bid_amount?></td>
    <td width="178" align="left"><?=$rows->bid_date?></td>
    </td>
  </tr>
<?php  $count++;}?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>
<!-- To display Daily Bidding Report-->

<?php if($task=='daily_bid_reports') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/daily_bid_reports')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <tr><td colspan="6"><strong>Total No. of Bids:&nbsp; <?php echo count($daily_bid_reports);?></strong></td></tr>
 <?php
$a3 = array();
$a3['values'][] = 'Bid ID';
$a3['values'][] = 'Member Name';
$a3['values'][] = 'Auction Name';
$a3['values'][] = 'Bid Amount';
$a3['values'][] = 'Date';
?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
  <tr> 
    <th width="98" align="left">Bid ID</th>
    <th width="198" align="left">Member Name</th>
    <th width="161" align="left">Auction Name</th>
    <th width="178" align="left">Bid Amount</th>
    <th width="161" align="left">Date</th>
<?php 
		$a4 = array();
		$count=0;
if(count($daily_bid_reports)!=0){
foreach($daily_bid_reports as $rows){
 	// this is for the excel export
	  $a4[$count][] = $rows->id;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->bid_amount;
	  $a4[$count][] =$rows->bid_date;
	  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->id?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td align="left"><?=$rows->auc_name?></td>
    <td width="178" align="left"><?=$this->currency_code?><?=$rows->bid_amount?></td>
    <td width="178" align="left"><?=$rows->bid_date?></td>
    </td>
  </tr>
<?php  $count++;}?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>

<!-- to display the top ten bidders  -->	

<?php if($task=='top_ten_user') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/top_bidders')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 <?php
$a3 = array();
$a3['values'][] = 'Member ID';
$a3['values'][] = 'Member Name';
$a3['values'][] = 'Email';
$a3['values'][] = 'Address';

?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
  <tr> 
    <th width="98" align="left">Member ID</th>
    <th width="198" align="left">Member Name</th>
    <th width="161" align="left">Email</th>
    <th width="178" align="left">Address</th>
<?php 
		$a4 = array();
		$count=0;
if(count($top_ten_user)!=0){
foreach($top_ten_user as $rows){
	// this is for the excel export
	  $a4[$count][] = $rows->user_id;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->email;
	  $a4[$count][] =$rows->address;
		  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->user_id?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td align="left"><?=$rows->email?></td>
    <td width="178" align="left"><?=$rows->address?></td>
    </td>
  </tr>
<?php  $count++;}?>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>


<!-- to display the passive users i.e. who haven't bid on any auctions  -->	

<?php if($task=='passive_user') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/passive_users')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 <?php
$a3 = array();
$a3['values'][] = 'Member ID';
$a3['values'][] = 'Member Name';
$a3['values'][] = 'Email';
$a3['values'][] = 'Address';

?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
 
  <tr> 
    <th width="98" align="left">Member ID</th>
    <th width="198" align="left">Member Name</th>
    <th width="161" align="left">Email</th>
    <th width="178" align="left">Address</th>
<?php 
	$a4 = array();
	$count=0;
if(count($passive_user)!=0){
foreach($passive_user as $rows){
	// this is for the excel export
	  $a4[$count][] = $rows->user_id;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->email;
	  $a4[$count][] =$rows->address;
		  
	  $this->session->set_userdata('report_values',$a4);

?>
  <tr> 
   
    <td align="left"><?=$rows->user_id?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td align="left"><?=$rows->email?></td>
    <td width="178" align="left"><?=$rows->address?></td>
    </td>
  </tr>
<?php  $count++;}?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>


<!-- to display the top five popular auction  -->	

<?php if($task=='top_five_auction') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/top_five_auctions')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <?php
$a3 = array();
$a3['values'][] = 'Auction ID';
$a3['values'][] = 'Auction Name';
$a3['values'][] = 'Retail Price';
$a3['values'][] = 'No. of Bids';


?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
  <tr> 
    <th width="98" align="left">Auction ID</th>
    <th width="198" align="left">Auction Name</th>
    <th width="161" align="left">Retail Price</th>
    <th width="161" align="left">No. of Bids</th>
<?php 
	$a4 = array();
	$count=0;

if(count($top_five_auction)!=0){
foreach($top_five_auction as $rows){
	// this is for the excel export
	  $a4[$count][] = $rows->auc_id;
	  $a4[$count][] =$rows->auc_name;
	  $a4[$count][] =$rows->retail_value;
	  $a4[$count][] =$rows->total_bids;
		  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->auc_id?></td>
    <td align="left"><?=$rows->auc_name?></td>
    <td align="left"><?=$this->currency_code?><?=$rows->retail_value?></td>
    <td width="178" align="left"><?=$rows->total_bids?></td>
    </td>
  </tr>
<?php $count++; }?>
<?php } else { ?>
<tr>
<td colspan="4" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>


<!-- to display the current open auctions  -->	

<?php if($task=='ongoing_auction') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/ongoing_auctions')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 <?php
$a3 = array();
$a3['values'][] = 'Auction ID';
$a3['values'][] = 'Auction Name';
$a3['values'][] = 'Retail Price';
$a3['values'][] = 'End Date';


?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
  <tr> 
    <th width="98" align="left">Auction ID</th>
    <th width="198" align="left">Auction Name</th>
    <th width="161" align="left">Retail Price</th>
    <th width="161" align="left">End Date</th>
<?php
$a4 = array();
$count=0;
if(count($ongoing_auction)!=0){
foreach($ongoing_auction as $rows){
	// this is for the excel export
	  $a4[$count][] = $rows->auc_id;
	  $a4[$count][] =$rows->auc_name;
	  $a4[$count][] =$rows->retail_value;
	  $a4[$count][] =date('Y-m-d H:i:s',$rows->end_date);
		  
	  $this->session->set_userdata('report_values',$a4);

?>
  <tr> 
   
    <td align="left"><?=$rows->auc_id?></td>
    <td align="left"><?=$rows->auc_name?></td>
    <td align="left"><?=$this->currency_code?><?=$rows->retail_value?></td>
    <td width="178" align="left"><?=date('Y-m-d H:i:s',$rows->end_date)?></td>
    </td>
  </tr>
<?php $count++; }?>
	<tr>
	<td colspan="6">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="6" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>


<!-- to display the completed transactions  -->	

<?php if($this->input->post('show') && $task=='completed_transaction') { ?>
<a href="<?=site_url(ADMIN_PATH.'/export_report/export/completed_transactions')?>">Export To Excel</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
  <?php
$a3 = array();
$a3['values'][] = 'Invoice ID';
$a3['values'][] = 'Member Name';
$a3['values'][] = 'Address';
$a3['values'][] = 'Auction Name';
$a3['values'][] = 'Payment Method';
$a3['values'][] = 'Amount';
$a3['values'][] = 'Payment Date';
?>
  <?php  $this->session->set_userdata('excel_headers',$a3);	?>
 
  <tr> 
    <th width="76" align="left">Invoice ID</th>
    <th width="120" align="left">Member Name</th>
    <th width="144" align="left">Address</th>
    <th width="143" align="left">Auction Name</th>
    <th width="131" align="left">Payment Method</th>
    <th width="58" align="left">Amount</th>
	 <th width="138" align="left">Payment Date</th>
<?php 
$a4 = array();
$count=0;
if(count($completed_transaction)!=0){
foreach($completed_transaction as $rows){
	// this is for the excel export
	  $a4[$count][] = $rows->invoice;
	  $a4[$count][] =$rows->first_name;
	  $a4[$count][] =$rows->address;
	  $a4[$count][] =$rows->auc_name;
	  $a4[$count][] =$rows->payment_method;
	   $a4[$count][] =$rows->received_amount;
	   $a4[$count][] =$rows->payment_date;
		  
	  $this->session->set_userdata('report_values',$a4);
?>
  <tr> 
   
    <td align="left"><?=$rows->invoice?></td>
    <td align="left"><?=$rows->first_name?></td>
    <td width="144" align="left"><?=$rows->address?></td>
    <td align="left"><?=$rows->auc_name?></td>
    <td width="131" align="left"><?=$rows->payment_method?></td>
    <td width="58" align="left"><?=$this->currency_code?><?=$rows->received_amount?></td>
	  <td width="138" align="left"><?=$rows->payment_date?></td>
    <td width="0"></td>
  </tr>
<?php  $count++; }?>
	<tr>
	<td colspan="7">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="7" align="center">Sorry No Records Found</td>
</tr>

<?php }?>

</table>
<?php } ?>

<br />
<div align='left'>


</div>

<br />