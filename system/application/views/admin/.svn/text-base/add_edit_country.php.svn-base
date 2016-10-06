
<script>
function verify_form(frm)
{
  
  if(!isNaN(frm.c_name.value))
  {
   fix_element('Invalid Country Name',frm.c_name);
   return false;
  }
  
  if(trim(frm.c_name.value)=='')
  {
   fix_element('Please Enter the Name of the Country',frm.c_name);
   return false;
  }
  
  
  
  if(isNaN(frm.telephone_code.value))
  {
   fix_element('Invalid Telephone Code',frm.telephone_code);
   return false;
  }
  else if(frm.telephone_code.value.indexOf(".")>-1)
  {
   fix_element('Invalid Telephone Code',frm.telephone_code);
   return false;
   }
}

function fix_element(msg,element)
{
	alert(msg);
	element.focus();

}
function trim(str)
{
 return str.replace(/^\s+|\s+$/g,'');
}
</script>

<? /*
$country_code=$_REQUEST['country_code'];
$postf=$_POST['postf'];

	if(!isset($_REQUEST['stat']))
	{
		echo'<h2 class="headingclass" >Edit Country Details</h2>';
		$query = "select * from tbl_country where country_code=$country_code";
		$data=$qry->querySelectSingle($query);	
	}
	else
	{
		echo'<h2 class="headingclass" >Add New Country</h2>';
	}
	*/
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH)?>">ADMIN</a> >> <a href="<?=site_url(ADMIN_PATH.'/country_management')?>">Country and State Management</a> </span></td>
    <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<form name="form1" method="post"   action="<? if(!isset($add_country)) { echo site_url(ADMIN_PATH.'/country_management/edit/'); } else echo site_url(ADMIN_PATH.'/country_management/add/');?>" onsubmit="return verify_form(this);">
  <table width="60%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" cellspacing="1" cellpadding="1">
          <tr> 
            <td width="28%">&nbsp;</td>
            <td width="72%">&nbsp;</td>
          </tr>
          <tr> 
            <td align="left" valign="middle" class="content">Country Name:<span class="style1">*</span></td>
            <td align="left" valign="middle">
			<?php if(!isset($add_country)) {?><input name="country_id" type="hidden" value="<?=$country_info[0]['country_id']?>" size="30" maxlength="30"><?php }?>
			<input name="country_name" type="text" class="comment" id="country_name" value="<?  if(!isset($add_country)) { echo $country_info[0]['country_name']; }?>" size="30" maxlength="30"></td>
          </tr>
          <tr>
            <td align="left" valign="middle" class="content">Country ISO Code:<span class="style1">*</span></td>
            <td align="left" valign="middle"><input name="country_code" type="text" class="comment" id="country_code" value="<?  if(!isset($add_country)) { echo $country_info[0]['country_code']; }?>" size="30" maxlength="30"></td>
			
		</tr>
          <tr align="center"> 
            <td height="35" colspan="2" class="err"> 
              <??>
            </td>
          </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" class="bttn" >       </td>
          </tr>
          <tr align="right"> 
            <td colspan="2" class="err"><font size="1"> (*) marked fields are 
              required </font></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>


<?  /*
if($postf=='reg')
{
	
	$c_name=trim($_POST['c_name']);
	$telephone_code=trim($_POST['telephone_code']);
	if($c_name=='')
		$errmsg='Please Enter Name of the Country';
	elseif($telephone_code=='')
	    $errmsg='Please enter the Telephone Code of the Country';
	if(trim($errmsg)=='')
	{
		if($_POST['country_code']!='')
			$catquery="update tbl_country set  c_name='$c_name',telephone_code='$telephone_code' where country_code=$country_code";
		else
			echo $catquery="insert into tbl_country(c_name,telephone_code) values ('$c_name',$telephone_code)";
	
		$affected_rows=$qry->queryExecute($catquery);
		if($affected_rows>=0)
			echo "<script> document.location='index2.php?function=country';</script>";
	
	}
	else
	{
		echo "<br><div align='center'><font color='red'><strong>$errmsg</strong></font></div>";
	}
}
*/
?>