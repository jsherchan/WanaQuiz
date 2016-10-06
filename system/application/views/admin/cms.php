<h2 class="headingclass" >CONTENT MANAGEMENT </h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure You Want To Delete?");
	if(job!=true)
	{
		return false;
	}
}
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/cms')?>">CONTENT MANAGEMENT </a></span></td>
    <td width="12%"><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
</table>

<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
	
<a href="<?=site_url(ADMIN_PATH.'/cms/add_page/')?>">	[ + ADD PAGE]</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
      <tr>
        <th width="12%" align="left"><div align="left">Page Name</div></th>
        <th width="22%" align="left"><div align="left">
	  <b> Page Title </b> </div></th>
        <th width="50%" align="left"><div align="left">View Page</div></th>
       
       	
		<th width="8%" align="left"><div align="center"><b>DELETE</b></div></th>
		<th width="8%" align="left"><div align="center"><b>Edit</b></div></th>
        <? 
		 if(count($content_list)!=0){
		foreach($content_list as $rows){
		?>
      </tr>
      <tr>
        <td align="left"><?php echo $rows->type; ?></td>
        <td align="left"> <?php echo $rows->title;?></td>
		
        <td align="left">
            <a href ="<?=$rows->url?>" target="_blank"><?=$rows->url?>
            <!--<a href="<?php echo base_url().'page/show/'.$rows->type;?>" target="_blank"><?php echo base_url().'page/show/'.$rows->type;?></a>-->
        </td>
		<td align="center"><a href="<?=site_url(ADMIN_PATH.'/cms/delete_page/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onclick="return doconfirm()"></a></td>
		<td align="center"><a href="<?=site_url(ADMIN_PATH.'/cms/edit_page/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Newsletter"></a></td>		
      </tr>
	  
      <? } } else{ ?>
<tr><td colspan="5" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
	
<p>