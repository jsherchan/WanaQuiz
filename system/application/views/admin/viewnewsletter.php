
<link href="../css/inc_css.css" rel="stylesheet" type="text/css" />
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<h2 class="headingclass" >View Newsletter </h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This newsletter Permanently?");
	if(job!=true)
	{
		return false;
	}
}
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/newsletter')?>">NEWSLETTER MANAGEMENT</a> 
      >> View Newsletter </span></td>
    <td><a href="<?=site_url(ADMIN_PATH.'/newsletter')?>"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="<?=site_url(ADMIN_PATH.'/newsletter')?>"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="80%" cellpadding="1">
  <tr>
	
	<td width="35%" align="left"><strong>[ <a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter')?>" style="color:#003399">Add New Newsletter </a> ]</strong></td>
	</tr>
	
</table>
  </td>
  </tr>
</table><br />
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>


<table width="87%" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="13%" align="left"><div align="center">No.</div></th>
        <th width="38%" align="left"><div align="left">
	  <b> Subject</b> </div></th>
        <th width="30%" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="19%" align="left"><div align="center"><b>delete</b></div></th>
        <? 
		$i=1;
		if(count($newsletter_info)>0) {
		foreach($newsletter_info as $rows) { 
		?>
      </tr>
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"> <?=$rows->news_subject?></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/newsletter/addnewsletter/edit/'.$rows->newsletter_id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a>	    </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/newsletter/delete/'.$rows->newsletter_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>	    </td>
      </tr>
	  
      <? $i++;} } else{?>
<tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
	
<p>