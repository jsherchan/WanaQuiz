<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" />
<script>
     var j = jQuery.noConflict();
function blockunblockdiscussion(id, st)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url('moderator_management/discussion_report_blockunblock/')?>", {disc_id:id, flag:st}, function(data){
                    if(data=='success');
                  location.reload();
                });
            }
        else {
		return false;
	}
}
function delete_report(id,d_id)
{ 
    
	job=confirm("Are you sure you want to Delete Report?");
	if(job==true)
       
        {   j.post("<?=site_url('moderator_management/delete_discussion_report/')?>", {report_id:id,disc_id:d_id}, function(data){
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
<div class="right_large_col floatR">
 <div class="rounded_white_bg">
      <div class="pos">
        <h1 class="blue_title"><span>Reported Discussion</span></h1>
        <div class="list_cont">
         <?
         foreach($discussion_report as $rows)
{          
    ?>
          <div class="list_slot clearfix reported_user_list" id="list_<?=$rows['id']?>">
            
            <div class="reported_comments_desc">
                 <div class="reported_comments">
                 
                <a href="#" class="blue_link"><?  echo $rows['discussion_title']; ?></a> 
                 </div>
                 
                 <div class="report_meta">Started by <a href="<?=site_url($rows['username'])?>" class="reported_author"><?  echo $rows['username']; ?></a> |<?  echo $rows['created']; ?> </div>
            </div>
            <div class="delete"> <a href="javascript:void(0)" onclick='return delete_report("<?=$rows['id']?>","<?=$rows['disc_id']?>")' class="delete_btn" >Delete Report</a> 
                <a href="javascript:void(0)" onclick='return delete_discussion("<?=$rows['disc_id']?>","<?=$rows['id']?>")'class="delete_btn ">Delete Discussion</a>
                <? if($rows['flag']==1)
                 { ?>
                         <a href="javascript:void(0)" onclick='return blockunblockdiscussion("<?=$rows['disc_id']?>","<?=$rows['flag']?>")' class="delete_btn black_btn">Block Discussion</a>
                       
                 <?  }   else  { ?>
                        <a href="javascript:void(0)" onclick='return blockunblockdiscussion("<?=$rows['disc_id']?>","<?=$rows['flag']?>")' class="delete_btn black_btn">Unblock Discussion</a>
                 <? } ?>
                
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="paginnation clearfix">
          <?=$this->pagination->create_links();?>
        </div>
    </div>
</div>
</div>
