
<link href="../css/inc_css.css" rel="stylesheet" type="text/css" />
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<h2 class="headingclass" >View Help Questions </h2>

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
    <td width="86%" height="40"> <span class="header"><a href="admin.php?function=welcome">ADMIN</a> 
      >> <?=anchor(ADMIN_PATH.'/help_management','HELP MANAGEMENT')?> >> View Help Questions </span></td>
    <td><a href="<?=site_url(ADMIN_PATH.'/help_management')?>"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="<?=site_url(ADMIN_PATH.'/help_management')?>"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>

  </td>
  </tr>
</table>
<table width="100%">
<tr><td width="22%">[<strong><? echo anchor(ADMIN_PATH.'/help_management/addhelp_questions','Add Help Questions')?></strong>]</td>
</tr></table>


<br />
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>


<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="9%" align="left"><div align="center">No.</div></th>
        <th width="27%" align="left"><div align="left">
	  <b> Help Topic</b> </div></th>
        <th width="40%" align="left"><div align="left">
	  <b> Help Topic Question</b> </div></th>
        <th width="12%" align="left"><div align="center"><b>Edit</b></div></th>
		<th width="12%" align="left"><div align="center"><b>Delete</b></div></th>
        <? 
		$i=1;
		if(count($help_topic_info)>0) {
		foreach($help_topic_info as $rows) { 
		$options=array('parent_id'=>$rows->id);
		$query=$this->db->getwhere('tblhelp_categories',$options);
		foreach($query->result() as $row){
		?>
      </tr>
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"> <?=$rows->name?></td>
		<td><?=$row->name?></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/help_management/addhelp_questions/'.$rows->id.'/'.$row->id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a>	    </td>
		<td align="center">
		<a href="<?=site_url(ADMIN_PATH.'/help_management/delete_question/'.$row->id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>	    </td>
      </tr>
	  
      <? $i++;} } } else{?>
<tr><td colspan="5" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
	
<p>