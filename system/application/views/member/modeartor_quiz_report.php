<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" />
<script>
     var j = jQuery.noConflict(); 
function blockunblockquiz(id, st)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url('moderator_management/quiz_report_blockunblock/')?>", {quiz_id:id, status:st}, function(data){
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
       
        {   j.post("<?=site_url('moderator_management/delete_report/')?>", {report_id:id,quiz_id:d_id}, function(data){
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
           j.post(
            "<?=site_url('moderator_management/delete_quiz/')?>", 
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
<div class="right_large_col floatR">
 <div class="rounded_white_bg">
      <div class="pos">
        <h1 class="blue_title"><span>Flagged Quizzes</span></h1>
        <div class="list_cont">
   <?         
foreach($question_report as $rows)
{  // print_r($rows); 
 ?>
    
         
          <div class="list_slot clearfix" id="list_<?=$rows['id']?>">
            <div class="profile_imge"><a href="<?=site_url($rows['username'])?>" ><?  echo $rows['username']; ?> </a> <a href="<?=site_url($rows['username'])?>">
                 <? if($rows['profile_picture']!="") {?>
                                                   <? if($this->session->userdata('wannaquiz_fb_id')) { ?>
                                                          <img src="<?=$rows['profile_picture']?>" alt="avatar" /> <? } else {?>
                                                   <? } ?>
                                                       <img src="<?=base_url()?>user_profile_images_thumb/<?=$rows['profile_picture']?>" alt="avatar" /> 
                                                   <? } else {?>
                                                        <img src="<?=base_url()?>images/avatar_img.jpg" width="50" height="50" alt="avatar" /><? }?>
                                                      </a> </div>
                                        <div class="reported_desc">
                                          <div class="q">Q</div>
                                          <div class="image_list">   
                                         <a href="<?=site_url('quiz/view/'.$rows['quiz_id'])?>">
                                            <?php if($rows['quiz_type'] =='photo') {
                                                    if($_SERVER['SERVER_NAME']=='localhost')
                                                    $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$rows['images'];
                                                    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$rows['images'];
                                                if(file_exists($photo_path)) { 
                                                    ?>
                                    <img src="<?=base_url()?>photo_question_thumbs/<?=$rows['images']?>" alt="feature quest img" />
                                                <? } else { ?>
                                    <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                <? } }
                                            ?> 
                                </a>
                                          </div>
              <div class="inner_rep_desc"> <a href="<?=site_url('quiz/view/'.$rows['quiz_id'])?>" class="reported_question"><?=$rows['quiz_question']; ?></a>
                <div class="report_meta"> by <a href="<?=site_url($rows['username'])?>" class="reported_author"><?=$rows['username']; ?></a> | <?  echo $rows['report_type']; ?> | <?  echo date('Y:m:d h:m:s',$rows['date']); ?> </div>
              </div>
              <div class="clear"></div>
            </div>
            <div class="delete"> <a href="javascript:void(0)" onclick='return delete_report("<?=$rows['id']?>","<?=$rows['quiz_id']?>")'class="delete_btn">Delete Report</a> 
                <a href="javascript:void(0)" onclick='return delete_quiz("<?=$rows['quiz_id']?>","<?=$rows['id']?>")' class="delete_btn ">Delete Quiz</a>
                <? if($rows['status']==1)
                 { ?>
                         <a href="javascript:void(0)" onclick='return blockunblockquiz("<?=$rows['quiz_id']?>","<?=$rows['status']?>")' class="delete_btn black_btn">Block Quiz</a>
                       
                 <?  }   else  { ?>
                        <a href="javascript:void(0)" onclick='return blockunblockquiz("<?=$rows['quiz_id']?>","<?=$rows['status']?>")' class="delete_btn black_btn">Unblock Quiz</a>
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


