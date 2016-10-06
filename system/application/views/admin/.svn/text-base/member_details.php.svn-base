
<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
<h2 class="headingclass" >Members Details </h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> 
      >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a>>> Member Detail</span></td>
    <td><a href="javascript:history.back();">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	</a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<br/>

  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"> 
        <table width="95%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td width="35%">&nbsp;</td>
            <td width="65%">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>Username:</div></td>
            <td align="left" valign="middle"><?php echo $member_details->username;?></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>First Name:</div></td>
            <td align="left" valign="middle"><?php echo $member_info->first_name;?></td>
          </tr>
        
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Last Name:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_info->last_name;?></td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Address 1:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_add->address;?></td>
          </tr>
         	  
		   <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Country:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_add->country;?></td>
          </tr>
		  
		  <!-- <tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>State/Region:</strong></div></td>
            <td align="left" valign="middle">
			<?php echo $member_details->states;?>
			</td>
          </tr>-->
		  
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Suburb/City:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_add->city;?></td>
          </tr>
          <!--<tr>
            <td align="left" valign="middle" class="content"><div align="right"><strong>Postcode:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_details->zip;?></td>
          </tr>-->
         
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Mobile No:</strong></div></td>
            <td align="left" valign="middle"><span class="style1"><?php echo $member_add->phone;?></span>
           <!--
		      <input name="phone1" type="text" class="comment" id="phone1" value="" size="3" maxlength="3">
              - 
            <input name="phone2" type="text"   class="comment" id="phone2" value="" size="3" maxlength="3"> 
            - <input name="phone3" type="text"   class="comment" id="phone3" value= "" size="4" maxlength="4">
			
			
			
			<?php echo $member_details->phone;?>-->
			</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content"><div align="right"><strong>Email Address:</strong></div></td>
            <td align="left" valign="middle"><?php echo $member_info->email;?></td>
          </tr>
                   
        
           
          
              
		 
		  <tr align="center">
            <td align="left"><div align="right"><strong>User Status </strong></div></td>
            <td align="left" valign="middle">
			
			<? if($member_details->activated==0) echo "Unverified"; 
				else if($member_details->activated==1) echo "Verified"; 	
				else if($member_details->activated==2) echo "Suspended"; 
			?> 
			   </td>
          </tr>
		  
		  
        
          
        </table></td>
		
		<!--<td bgcolor="#FFFFFF" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td><table>
		      <tr>
		        <td colspan="2" align="center" valign="middle" class="content"><div align="right"><strong>Shipping Address</strong></div></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping  Name:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->name;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address1:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->address1;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Address2:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->address2;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping City:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->city;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Zipcode:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->postcode;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Country:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->country;?></td>
	          </tr>
		      <tr>
		        <td align="left" valign="middle" class="content"><div align="right"><strong>Shipping Phone:</strong></div></td>
		        <td align="left" valign="middle"><?php echo $shipping_info->phone;?></td>
	          </tr>
	        </table></td>
	      </tr>
		  <tr>
		    <td height="33"><table width="87%" border="0" cellspacing="0" cellpadding="0">
		      
		      <tr>
		        <td width="61%" height="46"><strong>Remaining Credit Balance:</strong></td>
		        <td width="39%"><? echo $member_details->credit_balance; ?></td>
		        </tr>
	        </table></td>
	      </tr>
	    </table></td>-->
	 </tr>
	
  </table>



