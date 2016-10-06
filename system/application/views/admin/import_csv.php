
<link href="../style/style.css" rel="stylesheet" type="text/css" />


<H1 class="headingclass" > Import Coupons </H1>

<form  name="frm" method="post" action="<?php echo site_url(ADMIN_PATH."/coupons_management/upload_csv_file");?> "  enctype="multipart/form-data">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="<?=site_url(ADMIN_PATH."/coupons_management")?>">ADMIN</a> &gt;&gt; Scratch Coupon Management </span></td>
    <td>
	<a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	<span class="bodytext">Back</span></a></td>
  </tr>
</table>
<br /><br />
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" style="border:1px solid #81A4CE;">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="39%" align="right"><b>CSV File To Import<span class="small"></span>  :</b> </td>
      <td width="61%">
	 
	 <input name="file_csv" type="file" />
		
    </tr>
	
		
    <tr>
      <td colspan="2" align="center">
	<br /> <input type="submit" name="Submit" value="Import" /></td>
    </tr>
  </table>
</form>

