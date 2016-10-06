
<script>
function trim(str)
  {
  	return str.replace(/^\s+|\s+$/g,'');
  }
  
  function changeState()
{
	 document.form1.postf.value='';
	 document.form1.submit();
}
function check_amount()
{
	if(trim(document.form1.amount.value)=='')
	{
		document.form1.amount.value='0.00';
	}
}
  
</script>


<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
<h2 class="headingclass" >Edit Members Details </h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a>>> Edit Member</span></td>
    <td><a href="javascript:history.back();">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	</a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>


<form name="form1" method="post" action="<?=site_url(ADMIN_PATH.'/members/update') ?>" onsubmit="check_amount();">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"> 
        <table width="95%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="35%">&nbsp;</td>
            <td width="65%">&nbsp;</td>
          </tr>
          <? if($this->session->userdata('wannaquiz_fb_id')) { ?>
           <tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>Username:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><?php echo $member_details->username;?></td>
          </tr>
          <? } ?>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>First Name:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="firstname"  class="comment" value="<?php echo $member_details->first_name;?>"></td>
          </tr>
        
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Last Name:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="lastname" class="comment" value="<?php echo $member_details->last_name;?>"></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Address 1:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input name="address1" class="comment" type="text" id="address1" value="<?php echo $member_details->address;?>" size="30" maxlength="40" /></td>
          </tr>
         	  
		   <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Country:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="country" id="country" class="comment" value="<?php echo $member_details->country;?>"></td>
          </tr>
		  
		   <tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>State/Region:<font color="red">*</font></strong></div></td>
            <td align="left" valign="middle">
			<input type="text" name="states" id="states" class="comment" value="<?php echo $member_details->states;?>">
			</td>
          </tr>
		  
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Suburb/City:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="city" id="city" class="comment" value="<?php echo $member_details->city;?>"></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Postcode:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="zip"   class="comment" value= "<?php echo $member_details->zip;?>"></td>
          </tr>
         
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Phone No:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><span class="style1"></span> 
           <!--
		      <input name="phone1" type="text" class="comment" id="phone1" value="" size="3" maxlength="3">
              - 
            <input name="phone2" type="text"   class="comment" id="phone2" value="" size="3" maxlength="3"> 
            - <input name="phone3" type="text"   class="comment" id="phone3" value= "" size="4" maxlength="4">
			
			
			-->
			<input name="phone" type="text" class="comment" id="phone" value="<?php echo $member_details->phone;?>">
			</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Email Address:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" class="comment" name="email" value="<?php echo $member_details->email;?>"> </td>
          </tr>
                   
        
             <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Credit Balance:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" class="comment" name="credit_balance" value="<?php echo $member_details->credit_balance;?>"> </td>
          </tr>
          
              
		 
		  <tr align="center">
            <td align="left"><div align="right"><strong>User Status </strong></div></td>
            <td align="left" valign="middle">
			
			<input type="radio" name="activated" value="0"  <? if($member_details->activated==0) echo "checked"; ?> />
			Unverified
			<input type="radio" name="activated" value="1" <? if($member_details->activated==1) echo "checked"; ?>  >
              Verified
			  <input type="radio" name="activated" value="2" <? if($member_details->activated==2) echo "checked"; ?>  >
              Suspended
			   </td>
          </tr>
		  
		  
        
          
        </table></td>
		
		<td bgcolor="#FFFFFF" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td><table>
		      <tr>
		        <td colspan="2" align="center" valign="middle" class="content"><div align="right"><strong>Shipping Address</strong></div></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping  Name:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="shipname"  class="comment" value="<?php echo $shipping_info->name;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address1:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="shipaddr1"  class="comment" value="<?php echo $shipping_info->address1;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address2:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="shipaddr2"  class="comment" value="<?php echo $shipping_info->address2;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping City:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_city"  class="comment" value="<?php echo $shipping_info->city;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Zipcode:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_zipcode"  class="comment" value="<?php echo $shipping_info->postcode;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Country:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_country"  class="comment" value="<?php echo $shipping_info->country;?>" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Phone:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_phone"  class="comment" value="<?php echo $shipping_info->phone;?>" /></td>
		        </tr>
	        </table></td>
	      </tr>
		  <tr>
		    <td><table width="87%" border="0" cellspacing="0" cellpadding="0">
		      
		      <tr>
		        <td width="61%" height="46"><strong>Remaining Credit Balance:</strong></td>
		        <td width="39%"><? echo $member_details->credit_balance; ?></td>
		        </tr>
	        </table></td>
	      </tr>
	    </table></td>
	 </tr>
	   <tr align="center"> 
            <td colspan="2" bgcolor="#FFFFFF" align="center" valign="middle"><input type="submit" name="Submit" value="Submit" class="bttn" style="width:70px" > 
              <input name="user_id" type="hidden" id="uauctionid" value="<?php echo $member_details->user_id;?> "></td>
          </tr>
	 
	<tr align="right"> 
            <td colspan="2" class="err"><font size="1"> (*) marked fields are 
              required </font></td>
     </tr>
  </table>
</form>


