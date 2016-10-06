<?
	echo $this->lang->line('text_redirecting_paypal')." ...................."; //echo $paypal_type.$amount."/".$item_id;exit;
?>
<form action="<? echo site_url('paypal/paypalProccessing/');?>" method="post" name="redirect_to_payment">
							
<input name="amount" value="<?=$amount?>" type="hidden"  style="width:230px;"/>

<input name="item_id" value="<?=$item_id?>" type="hidden"/> 
<input name="paypal_type" value="<?=$paypal_type?>" type="hidden"/>

<input name="business_email" value="<?=$paypal_info->ps_email?>" type="hidden"/>
<input name="currency_code" value="<?=$paypal_info->ps_currency?>" type="hidden"/>
	
<input type="submit" style="display:none" />

</form>

<script>
document.redirect_to_payment.submit();
</script>				