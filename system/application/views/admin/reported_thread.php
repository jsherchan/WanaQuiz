<script>
     var j = jQuery.noConflict();
function blockunblockdiscussion(id, st)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/discussion_report_blockunblock/')?>", {disc_id:id, flag:st}, function(data){
                    if(data=='success');
                  location.reload();
                });
            }
        else {
		return false;
	}
}
function delete_report(id)
{ 
    
	job=confirm("Are you sure you want to Delete Report?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/delete_discussion_report/')?>", {report_id:id}, function(data){
                    if(data=='success');
                     j('#list_'+id).hide(1000);
                });
            }
        else {
		return false;
	}
}

function delete_discussion(disc_id,id)
{ 
   	job=confirm("Are you sure you want to Delete Discussion?");
	if(job==true)
         {
           j.post(
            "<?=site_url('moderator_management/delete_discussion/')?>", 
            {disc_id:disc_id,report_id:id}, 
            function(data){
                        if(data=='success');
                       j('#list_'+id).hide(1000);
                });
            }
            
             else {
		return false;
                }
}
</script>
<?php 
include('moderator_activity_panel.php');
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home/')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/moderator_activities/')?>"> Moderator Activities </a>>>Reported Forum Posts</span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">User Name </a></th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">Thread Title</a></th>
        <th width="200" align="center"><a href="#" style="color:#FFFFFF">Report Type</a></th>
        <th width="200 " align="center"><a href="#" style="color:#FFFFFF">Date</a></th>
        <th width="400" align="center"><a href="#" style="color:#FFFFFF">Admin Action</a></th>
        

    </tr>
        
        <? 
        $j=1;
        if(count($discussion_report)!=0){
              foreach($discussion_report as $rows) 
                   { 
                 ?>
    <tr id="list_<?=$rows['id']?>">
          <td align="left"><?php echo  $j; ?></td>
          <td><a href="<?=site_url($rows['username'])?>"><?=$rows['username'];?></a>
        <td align="left"><a href="<?=base_url()?>quiz/view/<?=$rows['disc_id']?>"><?=$rows['discussion_title']?></a></td>
        <td align="left"><?=$rows['report_type']?></td>
            <td align="left"><?=$rows['reported_date'];?></td>
      <td> <a href="javascript:void(0)" onclick='return delete_report("<?=$rows['id']?>")' class="delete_btn" >Delete Report</a> |
                <a href="javascript:void(0)" onclick='return delete_discussion("<?=$rows['disc_id']?>","<?=$rows['id']?>")'class="delete_btn ">Delete Discussion</a>|
                <? if($rows['flag']==1)
                 { ?>
                         <a href="javascript:void(0)" onclick='return blockunblockdiscussion("<?=$rows['disc_id']?>","<?=$rows['flag']?>")' class="delete_btn black_btn">Block Discussion</a>
                       
                 <?  }   else  { ?>
                        <a href="javascript:void(0)" onclick='return blockunblockdiscussion("<?=$rows['disc_id']?>","<?=$rows['flag']?>")' class="delete_btn black_btn">Unblock Discussion</a>
                 <? } ?> </td>
  </tr>
        <?php  $j++;}
        }
        else{?>
         <tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
       <? } ?>
         
<tr> 
   <th colspan="6" cellpadding="3px">  
	<?php echo $this->pagination->create_links();?>	</th>
</tr>
</table>

<br />
