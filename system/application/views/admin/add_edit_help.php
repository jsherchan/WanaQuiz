<h2 class="headingclass" >Help Management</h2>
<script type="text/javascript" src="<?= base_url()?>tiny_mice/tiny_mce.js"></script>

<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>
<script type="text/javascript"  src="<?= base_url()?>tiny_mice/plugins/tinybrowser/tb_tinymce.js.php"></script>

<br>

<!--<link href="../css/style.css" rel="stylesheet" type="text/css">-->
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin/help_management')?>">ADMIN</a>
      >>HELP MANAGEMENT</span></td>
    <td class="blue_bold"><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
  </tr>
</table>


<table width="99%">
<tr><td width="100%" align="left">
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
</td></tr></table>
	
<Table align=left cellpadding=2 cellspacing=0 width=99% border="0" class="light">
<form action="<?php if(!isset($add)) echo site_url(ADMIN_PATH.'/help_management/update_help/'.$CMSID); else echo site_url(ADMIN_PATH.'/help_management/insert_help/');?>" method="Post" name="form">
<tr>
      <td width="660"><strong>HEADING</strong></td>
</tr>

<tr>
<td><input size="50" class="inputtext" type="text" id="CMSTitle" name="CMSTitle" value="<?php if(!isset($add)) echo $CMSTitle;?>"></td>
</tr>

<tr>
      <td width="660"><strong>Meta Descriptions</strong></td>
</tr>

<tr>
<td><input size="50" class="inputtext" type="text" id="CMSMeta_desc" name="CMSMeta_desc" value="<?php if(!isset($add)) echo $CMSMeta_desc;?>"></td>
</tr>

<tr>
      <td width="660"><strong>Meta Keywords</strong></td>
</tr>

<tr>
<td><input size="50" class="inputtext" type="text" id="CMSMeta_keywords" name="CMSMeta_keywords" value="<?php if(!isset($add)) echo $CMSMeta_keywords;?>"></td>
</tr>


<tr>
      <td width="660"><strong>TYPE</strong></td>
</tr>

<tr>
<td><input size="50" class="inputtext" type="text" id="CMSType" name="CMSType" value="<?php if(!isset($add)) echo $CMSType;?>">* Please type small characters and if more than two words separated by (_) eg.member_page</td>
</tr>

<tr>
      <td width="660"><strong>Url</strong></td>
</tr>

<tr>
<td><input size="50" class="inputtext" type="text" id="CMSType" name="CMSUrl" value="<?php if(!isset($add)) echo $CMSUrl; else echo base_url();?>">* </td>
</tr>

<tr>
      <td><strong>CONTENT</strong></td>
</tr>

<tr>
<td>

 <textarea name="CMSDetail" id="CMSDetail" cols="70" rows="20"><?php if(!isset($add)) echo stripslashes($CMSDetail);?></textarea>
</td>
</tr>

<tr height=25 valign="middle">
<td><input type="submit" value="<?php if(!isset($add)) echo "UPDATE PAGE"; else echo "ADD PAGE";?>" class="bttn" onClick="submitForm();">
</td>
</tr>
</form>
</table>

