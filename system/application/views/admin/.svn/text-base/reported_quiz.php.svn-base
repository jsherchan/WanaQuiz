<script>  
var j = jQuery.noConflict(); 
function blockunblockquiz(id, st)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/quiz_blockunblock/')?>", {quiz_id:id, status:st}, function(data){
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
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/delete_report/')?>", {report_id:id}, function(data){
                    if(data=='success');
                    
                   j('#list_'+id).hide(1000);
                });
            } 
        else {
		return false;
	}
}

function delete_quiz(id, report_id)
{
   	job=confirm("Are you sure you want to Delete Quize?");
	if(job==true)
         {
           j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_quiz')?>", 
            {quiz_id:id,report_id:report_id}, 
            function(data){
                        if(data=='success');
                       j('#list_'+report_id).hide(1000);
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
                >><a href="<?=site_url(ADMIN_PATH.'/moderator_activities/')?>"> Moderator Activities </a>>>Reported Quizzes</span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">User Name </a></th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">Quiz Title</a></th>
        <th width="479" align="center"><a href="#" style="color:#FFFFFF">Report Type</a></th>
        <th width="200 " align="center"><a href="#" style="color:#FFFFFF">Date</a></th>
        <th width="400" align="center"><a href="#" style="color:#FFFFFF">Admin Action</a></th>
        

    </tr>
        
        <? 
        $j=1;
        if(count($reported_item)!=0){
              foreach($reported_item as $rows) 
                   {
                  
                 ?>
    <tr id="list_<?=$rows['id']?>">
          <td align="left"><?php echo  $j; ?></td>
          <td><a href="#"><?=$rows['username'];?></a>
        <td align="left"><a href="<?=base_url()?>quiz/view/<?=$rows['quiz_id']?>"><?=$rows['quiz_question']?></a></td>
        <td align="left"><?=$rows['report_type']?></td>
            <td align="left"><?=$rows['date'];?></td>
      <td> <a href="javascript:void(0)" onclick='return delete_report("<?=$rows['id']?>")'>Delete Report</a> |
                <a href="javascript:void(0)" onclick='return delete_quiz("<?=$rows['quiz_id']?>","<?=$rows['id']?>")' >Delete Quiz</a>|
                <? if($rows['status']==1)
                 { ?>
                         <a href="javascript:void(0)" onclick='return blockunblockquiz("<?=$rows['quiz_id']?>","<?=$rows['status']?>")' >Block Quiz</a>
                       
                 <?  }   else  { ?>
                        <a href="javascript:void(0)" onclick='return blockunblockquiz("<?=$rows['quiz_id']?>","<?=$rows['status']?>")' >Unblock Quiz</a>
                 <? } ?>
                           </td>
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
