
<script type="text/javascript" src="<?=base_url();?>js/jquery.validate.pack.js "></script>
<script type="text/javascript" language="javascript">
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

$(document).ready(function(){
		
		//$("#frmmember").validate();

		
	});
  
</script>

<style type="text/css">
<!--
.style1 {font-size: 9px}
-->

 #frmmember label.error { font-weight:bold; color:#FF0000; padding-left:5px; }
 .error { font-weight:bold; color:#FF0000; padding-left:5px; }
</style>
<h2 class="headingclass" >Add Members Details </h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a>>> Add Member</span></td>
    <td><a href="javascript:history.back();">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	</a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>


<form name="frmmember" id="frmmember" method="post" action="<?=site_url(ADMIN_PATH.'/members/insert') ?>" onsubmit="check_amount();">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"> 
        <table width="95%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="35%">&nbsp;</td>
            <td width="65%">&nbsp;</td>
          </tr>
		   <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Username:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="username"  class="comment required" value=""></td>
          </tr>
		   <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Password:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="password" name="password"  class="comment required" value=""></td>
          </tr>
		  
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>First Name:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="firstname"  class="comment required" value=""></td>
          </tr>
        
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Last Name:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="lastname" class="comment required" value=""></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Address 1:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input name="address1" class="comment required" type="text" id="address1" value="" size="30" maxlength="40" /></td>
          </tr>
         	  
		   <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Country:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="country" id="country" class="comment required" value=""></td>
          </tr>
		  
		   <tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>State/Region:<font color="red">*</font></strong></div></td>
            <td align="left" valign="middle">
			<input type="text" name="states" id="states" class="comment required" value="">
			</td>
          </tr>
		  
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Suburb/City:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="city" id="city" class="comment required" value=""></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Postcode:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" name="zip"   class="comment required" value= ""></td>
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
			<input name="phone" type="text" class="comment required" id="phone" value="">
			</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Email Address:<font color=red>*</font></strong></div></td>
            <td align="left" valign="middle"><input type="text" class="comment required email" name="email" value=""> </td>
          </tr>
                   
        
          <tr align="center">
            <td align="left"><div align="right"><strong>Referrer's Email Address(If any):</strong></div></td>
            <td align="left" valign="middle"><input type="text" class="comment" name="referer" value="" /></td>
          </tr>
          
           <tr align="center">
            <td align="left"><div align="right"><strong>Credit Balance:</strong></div></td>
            <td align="left" valign="middle"><input type="text" class="comment" name="credit_balance" value="" /></td>
          </tr>
              
		 
		  <tr align="center">
            <td align="left"><div align="right"><strong>User Status </strong></div></td>
            <td align="left" valign="middle">
			
			<input type="radio" name="activated" value="0"   />
			Unverified
			<input type="radio" name="activated" value="1"  >
              Verified
			  <input type="radio" name="activated" value="2">
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
		        <td align="left" valign="middle"><input type="text" name="shipname"  class="comment required" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address1:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="shipaddr1"  class="comment required" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address2:</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="shipaddr2"  class="comment" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping City:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_city"  class="comment required" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Zipcode:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_zipcode"  class="comment required" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Country:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_country"  class="comment required" value="" /></td>
		        </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Phone:<font color="red">*</font></strong></div></td>
		        <td align="left" valign="middle"><input type="text" name="ship_phone"  class="comment required" value="" /></td>
		        </tr>
	        </table></td>
	      </tr>
		  <tr>
		    <td><table width="87%" border="0" cellspacing="0" cellpadding="0">
		      
		      <tr>
		        <td width="61%" height="46"><strong>Remaining Credit Balance:</strong></td>
		        <td width="39%"></td>
		        </tr>
	        </table></td>
	      </tr>
	    </table></td>
	 </tr>
	   <tr align="center"> 
            <td colspan="2" bgcolor="#FFFFFF" align="center" valign="middle"><input type="submit" name="Submit" value="Submit" class="bttn" style="width:70px" > 
              <input name="user_id" type="hidden" id="uauctionid" value=" "></td>
          </tr>
	 
	<tr align="right"> 
            <td colspan="2" class="err"><font size="1"> (*) marked fields are 
              required </font></td>
     </tr>
  </table>
</form>


