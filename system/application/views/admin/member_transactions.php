
<script type="text/javascript">
function docomplete()
{
    job=confirm("Are You sure To Complete this transaction?");
    if(job!=true)
	{
		return false;
	}
}
</script>

<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
<h2 class="headingclass" >View Member Transactions </h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a>
      >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a>>>View Member Transactions </span></td>
    <td><a href="javascript:history.back();">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	</a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<table width="100%" cellpadding="1">
  <tr>
    <td><strong>[<?php  echo anchor(ADMIN_PATH.'/members/member_details/'.$member_details->user_id.'/','Member Details');?>]</strong></td>
  </tr>
  <tr>
    <td><strong>[<?php echo  anchor(ADMIN_PATH.'/members/transactions/'.$member_details->user_id,'View Transactions');?>]</strong></td>
    <td><strong>[<?php if($f=="all") echo "All Users"; else echo  anchor(ADMIN_PATH.'/members/members_list/all/joined_date/DESC/','All Users');?>]</strong></td>
  </tr>
</table>
<br/><br/>
<b>Member Name: <? echo $member_details->username;?></b>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
 
  <tr>
    <th width="76" align="left">Invoice Id</th>
    <th width="131" align="left">Payment Method</th>
    <th width="58" align="left">Amount</th>
    <th width="138" align="left">Payment Date</th>
    <th align="left"><div align="center">Payment Status</div></th>
<?php //print_r($member_transactions); echo "hiii";
$a4 = array();
$count=0;
if(count($member_transactions)!=0){
foreach($member_transactions as $rows){

?>
  <tr>

    <td align="left"><?=$rows->invoice?></td>
    <td width="131" align="left"><?=$rows->payment_method?></td>
    <td width="58" align="left"><?=$rows->received_amount?></td>
    <td width="138" align="left"><?=$rows->pay_time?></td>
             <td align="center"><?php if($rows->payment_status=='Completed') {
             echo $rows->payment_status;
             }  elseif($rows->payment_status=='Incomplete') {?>
            <a href="<?=site_url(ADMIN_PATH.'/members/complete_it/'.$rows->invoice)?>" onclick="return docomplete();"><?=$rows->payment_status?></a>
             <?php } ?></td>
  </tr>
<?php  $count++; }?>
	<tr>
	<td colspan="7">
	<?php echo $this->pagination->create_links();?>
	</td>
	</tr>
<?php } else { ?>
<tr>
<td colspan="7" align="center"><?=$this->lang->line('sorry_no_records')?></td>
</tr>

<?php }?>

</table>
