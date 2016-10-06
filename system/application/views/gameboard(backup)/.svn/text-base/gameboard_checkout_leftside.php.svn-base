<script>
function total_price()
{ 
   var quantity = $('#quantity').val();
   if(parseInt(quantity)!=quantity-0) alert('Quanity field should be an integer!');
   else {
       var total = quantity*<?=$premium_boards[0]->board_price?>;
       $('#total').html('&euro; '+total);
       var sub_total = total+<?=$premium_boards[0]->shipping_cost?>;
       $('#sub_total').html('&euro; '+sub_total);
       var tax = ((<?=$site_info->site_tax?>)/100)*sub_total;
       $('#tax').html('&euro; '+tax);
       var shopping_cart_total = sub_total+tax;
       $('#shopping_cart_total').html('&euro; '+shopping_cart_total);
       //$('#input_hidden').html('<input type="hidden" name="total_price" value="'+shopping_cart_total+'">')

           $.post('<?=base_url()?>gameboard/gameboard_cost', {total:shopping_cart_total} , function(data)
				{
                                
                                });

   }
}
</script>
<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Premium Game Boards </div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                        
                            <div id="input_hidden"></div>
                        <div class="content_10box">
                        	<div class="padding_10topbottom">
                            	Confirm your order. If you still want to make changes to your order, you can back button in your browser. If your order is complete you can continue by pressing �Confirm� button. Please only click once. After completing your order you will receive a confirmation email.
                            </div>
                        	<div class="content_wrap">
                            	<div class="padding_10topbottom">
                                    <div class="bold font16">Your Order Selection</div>
                                </div>
                                <div class="contact_right">
                                    
                                    <div>
                                        <div>
                                            <div class="border_gray">
                                                <div>
                                                    <div class="gameboardbox_bgalign">
                                                        <div class="text_center">
                                                            <div class="bold font14"><a href="#">Type 1</a></div>
                                                            <div class="padding_10topbottom">
                                                                <div class="gameboardbox_bg">
                                                                    <div class="gameboardbox_bgInner">
                                                                        <?php $this->images->resize('gameboard_images/'.$premium_boards[0]->board_image, 158, 158, 'gameboard_thumb_images/'.$premium_boards[0]->board_image,'false');?>
                                                                        <a href="#"  style="display:block; background:url(<?=base_url()?>gameboard_thumb_images/<?=$premium_boards[0]->board_image?>) no-repeat top left; width:158px; height:158px; margin-top:-20px; margin-left:-20px">
                                                                             <img src="<?=base_url()?>gameboard_thumb_images/<?=$this->session->userdata('user_image')?>" style="width:118px; height:118px; margin-top:20px"></img>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="font14 bold">
                                                                Premium Game board
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <form name="contact" action="" method="post">
                                <div class="contact_left">
                                    <div class="checkout_rightInner">
                                        <div class="content_wrap">
                                        	<div class="bg_lightblue">
                                            	<div class="content_10box">
                                                	<div class="padding_5bottom bold">
                                                    	<div class="checkout_qty">Quantity</div>
                                                        <div class="checkout_price">Unit Price</div>
                                                        <div class="checkout_total">Total</div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="padding_10topbottom">
                                                    	<div class="checkout_qty">
                                                            <input type="text" id="quantity" name="quantity" style="width:40px" >
                                                        </div>
                                                        <div class="checkout_price">&euro; <?=$premium_boards[0]->board_price?></div>
                                                        <div class="checkout_total" id="total">&euro; 00</div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="bg_lightgreen">
                                            	<div class="content_10box">
                                                	<div>
                                                    	<div class="checkout_qty bold">Delivery Charges</div>
                                                        <div class="checkout_price">&nbsp;</div>
                                                        <div class="checkout_total" id="total1">&euro; <?=$premium_boards[0]->shipping_cost?></div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div>
                                                    	<div class="checkout_qty bold">Sub total</div>
                                                        <div class="checkout_price" id="">&nbsp;</div>
                                                        <div class="checkout_total" id="sub_total">&euro; 00</div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div>
                                                    	<div class="checkout_qty bold">Tax(13%)</div>
                                                        <div class="checkout_price">&nbsp;</div>
                                                        <div class="checkout_total" id="tax">&euro; 00</div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    
                                                    <div class="padding_10topbottom">
                                                    <div class="borderbottom_dotted"></div>
                                                    </div>
                                                    
                                                    <div>
                                                    	<div class="checkout_qty bold">Shopping cart total	</div>
                                                        <div class="checkout_price">&nbsp;</div>
                                                        <div class="checkout_total bold" id="shopping_cart_total">&euro; 00</div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="padding_10topbottom">
                                        	<div class="searchbtn_leftborder"></div>
                                            <div class="searchbtn_bg"><a href="#" onclick="total_price()">Update</a></div>
                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                            <?php //echo $this->session->userdata('shopping_cart_total')?>
                            
                            	<div class="clear"></div>
                            </div>
                            <form name="contact" action="<?=base_url()?>gameboard/payment" method="post">
                            <input type="hidden" name="board_id" value="<?=$premium_boards[0]->id?>">
                            <div>
                                    	
                                        	<div class="content_wrap">
                                            	<div class="contactbox_topborder"></div>
                                                <div class="contactbox_border">
                                                <div class="contactbox_bg">
                                                	<div class="content_10box">
                                                        <div class="content_10box">
                                                        	<div>
                                                                <div class="font16 bold">Choose Payment</div>
                                                               	<div class="padding_10topbottom">
                                                                	<div class="checkout_visa">
                                                                    	<div class="padding_5bottom">
                                                                        	<img src="<?=base_url()?>images/mastercard_icon.jpg" width="29" height="31" alt="master card" />
                                                                        </div>
                                                                        <div class="input_clear">
                                                                        	<input type="radio" name="payment_method" style="width:25px;" value="master_card"/>
                                                                            <label>Master card/visa</label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="checkout_paypal">
                                                                    	<div class="padding_5bottom">
                                                                        	<img src="<?=base_url()?>images/paypal_smallicon.jpg" width="63" height="32" alt="paypal" />
                                                                        </div>
                                                                        <div class="input_clear">
                                                                            <input type="radio" name="payment_method" style="width:25px;" value="paypal" checked"/>
                                                                            <label>Paypal</label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="checkout_banktransfer">
                                                                    	<div class="padding_5bottom">
                                                                        	<img src="<?=base_url()?>images/banktransfer_icon.jpg" width="63" height="32" alt="banktransfer" />
                                                                        </div>
                                                                        <div class="input_clear">
                                                                        	<input type="radio" name="payment_method" style="width:25px;" value="bank_transfer"/>
                                                                            <label>Bank Transfer</label>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="contactbox_bottomborder"></div>
                                            </div>
                                            
                                            <div class="padding_10topbottom">
                                            	<div>
                                                    <div class="searchbtn_leftborder"></div>
                                                    <input type="submit" name="submit" class="searchbtn_bg" value="Confirm" />
                                                    <div class="searchbtn_rightborder"></div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        
                                    </div>
                            </form>
                        </div>
                    
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>