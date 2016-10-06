<h2 class="headingclass" >Newsletter Delivery Status</h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a> 
      >> Newsletter Management>> Newsletter Delivery Status </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="98%" cellpadding="1">
  <tr>
    <td width="22%" ><strong>Newsletter Subject : <a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$newsletter_info->newsletter_id)?>"><?=$newsletter_info->news_subject?></a></strong></td>
		
	</tr>
	
</table>
  </td>
  </tr>
</table>

<br>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<table width="87%" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="37%" align="center"><div align="center">Total Sent Emails</div></th>
        <th width="26%" align="center"><div align="center">
	  <b> Total Opened Emails</b> </div></th>
	
	  <th width="37%" align="center"><div align="center">
	  <b>Total Bounced Emails</b> </div></th>
	      
      </tr>
      <tr>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/sent')?>"><?=$total_sent_emails?></a></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/opened')?>"><?=$opened_emails?></a></td>
		<td align="center"><a href="<?=site_url(ADMIN_PATH.'/newsletter/deliveryStatistics/'.$newsletter_info->newsletter_id.'/bounced')?>"><?=$bounced_emails?> </a></td>
      </tr>
   
</table>
<p>