<form method="post" name="paypal_form" action="https://www.sandbox.paypal.com/">
<input type="hidden" name="business" value="<?=$business_email?>"> 
<input type="hidden" name="cmd" value="_xclick"> 
<input type="hidden" name="image_url" value="<?=base_url()?>images/logo_invoice.png">
<input type="hidden" name="return" value="<?=site_url('paypal/paypalSuccess/'.$paypal_type)?>">
<input type="hidden" name="cancel_return" value="<?=site_url('paypal/paypalCancel/'.$paypal_type)?>">
<input type="hidden" name="notify_url" value="<?=site_url('paypal/paypalIPN')?>">
<input type="hidden" name="rm" value="2">
<input type="hidden" name="currency_code" value="<?=$currency?>"> <!--<? //$currency?>-->
<input type="hidden" name="lc" value="GBP">
<input type="hidden" name="bn" value="toolkit-php">
<input type="hidden" name="cbt" value="Continue >>">
<input type="hidden" name="test_ipn" value="1">
<!-- Payment Page Information --> 
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="cn" value="Comments"> 
<input type="hidden" name="cs" value="">
<input name="cpp_header_image" value="<?=base_url()?>images/logo_invoice.png" type="hidden">
<input name="cpp_headerback_color" value="FFFFFF" type="hidden">
<input name="cpp_headerborder_color" value="FFFFFF" type="hidden">
<input name="cpp_payflow_color" value="FFFFFF" type="hidden">
<!-- Product Information --> 
<input type="hidden" name="item_name" value="<?=$item_name?>">
<input type="hidden" name="amount" value="<?=$amount?>">
<input type="hidden" name="quantity" value="1"> 
<input type="hidden" name="item_number" value="">
<input type="hidden" name="undefined_quantity" value="">
<input type="hidden" name="on0" value="">
<input type="hidden" name="os0" value="">
<input type="hidden" name="on1" value="">
<input type="hidden" name="os1" value="">
<!-- Shipping and Misc Information --> 
<input type="hidden" name="shipping" value="">
<input type="hidden" name="shipping2" value="">
<input type="hidden" name="handling" value="">
<input type="hidden" name="tax" value="">
<input type="hidden" name="custom" value="">
<input type="hidden" name="invoice" value="ecb-<?=$inserted_id?>">
<!-- Customer Information --> 
<input type="hidden" name="first_name" value="<?=$user->first_name?>"> 
<input type="hidden" name="last_name" value="<?=$user->last_name?>"> 
<input type="hidden" name="address1" value="<?=$user->address?>"> 
<input type="hidden" name="address2" value="<?=$user->address?>"> 
<input type="hidden" name="city" value="<?=$user->city?>"> 
<input type="hidden" name="country" value="<?=$user->country?>"> 
<input type="hidden" name="zip" value=""> 
<input type="hidden" name="email" value="<?=$user->email?>"> 

<span style="color: rgb(255, 255, 255);">Please wait. redirecting to paypal page</span>
</form>

<script>
document.paypal_form.submit();
</script>