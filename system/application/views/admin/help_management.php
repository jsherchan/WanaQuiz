<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style><h2 class="headingclass" >Help Management</h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> 
      >>HELP MANAGEMENT >> <? if($f=="")echo "ADD"; else echo"EDIT";?> HELP TOPIC</span></td>
    <td align="right">
	<a href="<?=site_url(ADMIN_PATH.'/help_management')?>">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a>
	<a href="<?=site_url(ADMIN_PATH.'/help_management')?>"><span class="bodytext">BACK</span>
	</a>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><span class="style1"><br />
    </span></td>
  </tr>
</table>

<table width="100%">
<tr><td width="22%">[<strong><? if(count($help_category_info)>0) echo anchor(ADMIN_PATH.'/help_management/addhelp_questions','Add Help Questions')?></strong>]</td>
<td width="78%">[<strong><? if(count($help_category_info)>0) echo anchor(ADMIN_PATH.'/help_management/viewhelp_question','View Help Questions')?></strong>]</td>
</tr></table>

<form name="frm" method="post" enctype="multipart/form-data"  action="<? if($f=="") echo site_url(ADMIN_PATH.'/help_management/add_topic'); else echo site_url(ADMIN_PATH.'/help_management/edit');?>">
  <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="light" style="padding:6px">
  <tr align="left"> 
            <td align="right" class="err"><span class="style2">The fields marked with</span><b> <font color="#FF0000" size="2"> * </font><span class="content">are 
              mandatory.</span></b></td>
    </tr>
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"> 
        <table width="60%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="30%" colspan="2"><?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
</td>
          </tr>
          <tr>
            <td width="30%" align="left" valign="middle" class="content"><span class="hmenu_font">HELP TOPIC  :<font color="#FF0000" size="2"></font></span><font color="#FF0000" size="2"> * </font></td>
            <td width="70%" align="left" valign="middle">
			<input name="name" type="text" id="name" value="<? if($f!="") { foreach($help_topic_by_id as $rows) echo $rows->name;}?>" size="40" /></td>
          </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td height="35" align="left" valign="middle">
			<input type="submit" name="Submit" value="<? if($f=="") echo "Add Help Topic"; else echo "Edit Help Topic"?>" class="bttn" onclick="" style="width:100px"> 
			<input name="job" type="hidden"  value="<? if($f!="") echo $rows->id;?>">
		    <input name="hqa_id" type="hidden" value=""></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<br />
<br />
<table width="80%" align="center">
<tr><td width="100%" align="left">
<?php if($this->session->flashdata('message1')){
		echo "<div class='message'>".$this->session->flashdata('message1')."</div>";
		}
	?>
</td></tr></table>
<table width="80%" align="center" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="13%" align="left"><div align="center">S.N.</div></th>
        <th width="54%" align="left"><div align="left"><strong>Help Topic </strong></div></th>
        <th width="17%" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="16%" align="left"><div align="center"><b>delete</b></div></th>
        <? $i=1;
		if(count($help_category_info)>0) {
		//for($i=1;$i<=count($help_category_info);$i++) { 
		foreach($help_category_info as $rows){
		?>
      </tr>
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"> <?=$rows->name?></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/help_management/add_edit/edit/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a>	    </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/help_management/delete/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Help Topic" onClick="return doconfirm();" /></a>	    </td>
      </tr>
	  
      <? $i++;} } else{?>
<tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
<script>


function submitform2()
{  
  //alert(oEdit1.getHTMLBody());
	document.forms.frm.elements.answer.value = oEdit1.getHTMLBody();
		//document.forms.form1.submit();
	return true;
}

function doconfirm()
{
	job=confirm("Are you sure to delete this help topic Permanently?");
	if(job!=true)
	{
		return false;
	}
}

</script>
