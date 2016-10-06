<script>

function copy_address(value){

	if(value=='yes'){
			document.my_address_form.same_as_billing.value="no";
			document.my_address_form.firstname1.value=document.my_address_form.firstname.value;
                        document.my_address_form.lastname1.value=document.my_address_form.lastname.value;
			document.my_address_form.street1.value=document.my_address_form.street.value;
			document.my_address_form.postcode1.value=document.my_address_form.postcode.value;
			document.my_address_form.city1.value=document.my_address_form.city.value;
			//document.my_address_form.ship_state.value=document.my_address_form.bill_state.value;
			document.my_address_form.email1.value=document.my_address_form.email.value;
			document.my_address_form.phone1.value=document.my_address_form.phone.value;
		}
		else{
		$.post("<?=base_url()?>member/ajaxGetShipingAddress", {} , function(data){
		   	ddt=data.split("|");
		  	document.my_address_form.fistname1.value=ddt[0];
			document.my_address_form.lastname1.value=ddt[1];
			document.my_address_form.street1.value=ddt[2];
			document.my_address_form.city1.value=ddt[3];
			document.my_address_form.postcode1.value=ddt[4];
			document.my_address_form.email1.value=ddt[5];
			document.my_address_form.phone1.value=ddt[6];
		});
		document.my_address_form.same_as_billing.value="yes";
		}
	}
</script>
<script>
function selectBillState(cid)
{

	$.post('<?=base_url()?>member/getBillStates', {country_id: cid} , function(data)
	{
				  $('#bill_state_list').html(data);

          });
}

function selectShipState(cid)
{

	$.post('<?=base_url()?>member/getShipStates', {country_id: cid} , function(data)
	{
				  $('#ship_state_list').html(data);

          });
}
</script>
<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Premium Game Boards</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                        <div class="content_10box">
                        	<div class="contact_left">
                            	<div class="contact_leftInner">
                                	<div class="padding_10topbottom">(Fields with a * are required)</div>
                                    <div>
                                    	<form name="my_address_form" action="<?=site_url('gameboard/checkout')?>" method="post">
                                            <input type="hidden" name="board_id" value="<?=$board_id?>">
                                        	<div class="content_wrap">
                                            	<div class="contactbox_topborder"></div>
                                                <div class="contactbox_border">
                                                <div class="contactbox_bg">
                                                	<div class="content_10box">
                                                    	<div class="font16 bold">1. Contact information</div>
                                                        <div class="content_10box">
                                                        	<div class="contact_form">
                                                            	<!--<div class="input_clear">
                                                                	<label>Order</label>
                                                                    <select>
                                                                    	<option>-Select-</option>
                                                                    </select>
                                                                </div>-->
                                                                <div class="input_clear">
                                                                	<label>First name *</label>
                                                                   	<input type="text" class="textbox" name="firstname" value="<?=set_value('firstname')?>"/>
                                                                         <?php echo form_error('firstname')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Surname *</label>
                                                                   	<input type="text" class="textbox" name="lastname" value="<?=set_value('lastname')?>"/>
                                                                         <?php echo form_error('lastname')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Street *</label>
                                                                   	<input type="text" class="textbox" name="street" value="<?=set_value('street')?>"/>
                                                                         <?php echo form_error('street')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Post code *</label>
                                                                   	<input type="text" class="textbox" name="postcode" value="<?=set_value('postcode')?>"/>
                                                                         <?php echo form_error('postcode')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>City *</label>
                                                                   	<input type="text" class="textbox" name="city" value="<?=set_value('city')?>"/>
                                                                         <?php echo form_error('city')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Country *</label>
                                                                   	<select class="country_box" name="bill_country" id="bill_country" onchange="selectBillState(this.value)" >
                                                                                    <?php foreach($country_list as $row){?>
                                                                                    <option value="<?=$row->countries_id?>" <?php if($row->countries_id==$billing_info->country) echo "selected";?>><?=$row->countries_name?></option>
                                                                                    <?php }?>
                                                                      </select>
                                                                        <?php echo form_error('country')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>E-mail address *</label>
                                                                   	<input type="text" class="textbox" name="email" value="<?=set_value('email')?>"/>
                                                                         <?php echo form_error('email')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Telephone *</label>
                                                                   	<input type="text" class="textbox" name="phone" value="<?=set_value('phone')?>"/>
                                                                         <?php echo form_error('phone')?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="contactbox_bottomborder"></div>
                                            </div>
                                            
                                            <div class="content_wrap">
                                            	<div class="contactbox_topborder"></div>
                                                <div class="contactbox_border">
                                                <div class="contactbox_bg">
                                                	<div class="content_10box">
                                                    	<div>
                                                        	<div style="float:left; width:200px;">
                                                    			<div class="font16 bold">2. Delivery Address</div>
                                                            </div>
                                                            <div style="float:left; width:260px;">
                                                            	<input class="check_box" name="same_as_billing" type="checkbox" value="yes" onclick="copy_address(this.value)" />
                                                                <label>Copy data from contact information</label>
                                                            </div>
                                                            
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="content_10box">
                                                        	<div class="contact_form">
                                                            	<!--<div class="input_clear">
                                                                	<label>Order</label>
                                                                    <select>
                                                                    	<option>-Select-</option>
                                                                    </select>
                                                                </div>-->
                                                                <div class="input_clear">
                                                                	<label>First name *</label>
                                                                   	<input type="text" class="textbox" name="firstname1" value="<?=set_value('firstname1')?>"/>
                                                                         <?php echo form_error('firstname1')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Surname *</label>
                                                                   	<input type="text" class="textbox" name="lastname1" value="<?=set_value('lastname1')?>"/>
                                                                         <?php echo form_error('lastname1')?>
                                                                </div>
                                                                <!--<div class="input_clear">
                                                                	<label>Company name *</label>
                                                                   	<input type="text" class="textbox" name="companyname" value="<?=set_value('companyname')?>"/>
                                                                         <?php echo form_error('comopanyname')?>
                                                                </div>-->
                                                                <div class="input_clear">
                                                                	<label>Street *</label>
                                                                   	<input type="text" class="textbox" name="street1" value="<?=set_value('street1')?>"/>
                                                                         <?php echo form_error('street1')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Post code *</label>
                                                                   	<input type="text" class="textbox" name="postcode1" value="<?=set_value('postcode1')?>"/>
                                                                         <?php echo form_error('postcode1')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>City *</label>
                                                                   	<input type="text" class="textbox" name="city1" value="<?=set_value('city1')?>"/>
                                                                         <?php echo form_error('city1')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Country *</label>
                                                                   	<select class="country_box" name="ship_country" id="ship_country" onchange="selectShipState(this.value)" >
                                                                                    <?php foreach($country_list as $row){?>
                                                                                    <option value="<?=$row->countries_id?>" <?php if($row->countries_id==$shipping_info->country) echo "selected";?>><?=$row->countries_name?></option>
                                                                                    <?php }?>
                                                                      </select>
                                                                        <?php echo form_error('country')?>
                                                                </div>
                                                                <!--<div class="input_clear">
                                                                	<label>Message passing the package</label>
                                                                   	<textarea class="textbox" style="width:250px; height:150px;"></textarea>
                                                                </div>-->
                                                                <div class="input_clear">
                                                                	<label>E-mail address *</label>
                                                                   	<input type="text" class="textbox" name="email1" value="<?=set_value('email1')?>"/>
                                                                         <?php echo form_error('email1')?>
                                                                </div>
                                                                <div class="input_clear">
                                                                	<label>Telephone *</label>
                                                                   	<input type="text" class="textbox" name="phone1" value="<?=set_value('phone1')?>"/>
                                                                         <?php echo form_error('phone1')?>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="contactbox_bottomborder"></div>
                                            </div>
                                            
                                            <div class="padding_10topbottom">
                                            	<div style="padding-left:190px;">
                                                    <div class="searchbtn_leftborder"></div>
                                                    <input type="submit" name="submit" class="searchbtn_bg" value="Continue to checkout" />
                                                    <div class="searchbtn_rightborder"></div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="contact_right">
                            	<div class="padding_10topbottom">
                                	Your Order Selection
                                </div>
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
                                                                         <img src="<?=base_url()?>gameboard_thumb_images/<?=$this->session->userdata('user_image')?>" style="width:108px; height:109px; margin-top:25px; margin-left:0px;"></img>
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
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>