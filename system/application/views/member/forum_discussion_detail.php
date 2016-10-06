   <script type="text/javascript" src="<?=base_url()?>js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
        <script type="text/javascript">
$(document).ready(function(){
    
        $('.edit_comment').attr("href","javascript:void(0)");
	$('.edit_comment').toggle(function(){$(this).parents(".talk_box:first").find(".comment_edit_moderator:first").stop(true,true).fadeIn(200)},
	function(){$(this).parents(".talk_box:first").find(".comment_edit_moderator:first").stop(true,true).fadeOut(200)})
	$('.large_textarea').click(function(){
           $(this).css({"height":"80px"});
        });
    
}); 
        
        
</script>
        <style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
                        .comment_edit_moderator strong, .comment_edit_moderator textarea{display: block; margin-bottom: 5px;}
                        .comment_edit_moderator textarea{width: 90%;}
		</style>

<script type="text/javascript">
            var j = jQuery.noConflict();
          function addcomment(id){ //alert('hii');
              
                var cmt = $('#comment').val();
               if(cmt == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>forum/add_comment', 
                    {disc_id:id, comment:cmt} , 
                    function(data){
                      
                            if(data=='success');
                           location.reload();
                        });
                        
                }

            }
            
            function reply_comment(id,disc_id)
            {
              var cmt = $('#comment_reply_'+id).val();
               if(cmt == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>forum/add_comment_reply', 
                    {disc_id:disc_id, reply_id:id, comment:cmt} , 
                    function(data){
                           if(data=='success');
                           location.reload();
                        });
                        
                }
            }
         function hideShowReaction(){
                $('#text_reaction').toggle();
            }

            function toggle(obj) {
              var el =document.getElementById(obj);
              if ( el.style.display != 'none' ) {
                    el.style.display = 'none';
                }
                else {
                    el.style.display = '';
                }
            }
        
     function report_comment(cmt_id, user_id)
{ 
	job=confirm("Are you sure you want to Report this comment?");
	if(job==true)
       
        {   j.post("<?=site_url('forum/report_discussion_comment/')?>", {comment_id:cmt_id, reporter_id:user_id}, 
            function(data){
                 if(data=='success')
               location.reload();
                });
            }
        else {
		return false;
	}
}
   function report_discussion(disc_id, user_id)
{ 
	job=confirm("Are you sure you want to Report this comment?");
	if(job==true)
       
        {   j.post("<?=site_url('forum/report_discussion/')?>", {disc_id:disc_id, reporter_id:user_id}, 
            function(data){
                 if(data=='success')
               location.reload();
                });
            }
        else {
		return false;
	}
}
        </script>
<link href="<?=base_url()?>css/typo.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<div class="right_large_col floatR">
<div class="rounded_white_bg">
      <div class="pos">
        <h1 class="normal_title">
    <?if($forum_info[0]['sticky']==1){?>
     <img src='<?= base_url()?>images/needle.png'/>Sticky:<? }
echo $forum_info[0]['discussion_title']; ?> </h1>
       
        <div class="forum_meta"><strong> <?=$forum_info[0]['views']?> Views <?$res=$this->forum_model->get_total_reply($forum_info[0]['disc_id']);
               ?><?=$res[0]['total']?>  Replies </strong> <span class="blue_link">Latest reply:</span> <?=$forum_info[0]['created']?>by <a href="<?=site_url($forum_info[0]['username'])?>" class="blue_link"><?=$forum_info[0]['username']?></a></div>
       <? if($this->session->userdata('wannaquiz_user_id'))
              {?>
        <a class="scalable_btn aqua" onclick="toggle('addcomment_<?=$forum_info[0]['disc_id']?>')"><span>Post Your Comment</span></a>
        <?}?>     
        <div class="paginnation clearfix">
            <?=$this->pagination->create_links();?>
        </div>
        <div class="clear"></div>
             <div class="talk_box clearfix forum_original_poster">
              
           <div class="user_details font10"><a href="<?=site_url($forum_info[0]['username'])?>" class="font11 authorname"><?=$forum_info[0]['username']; ?></a> 
              <?if($forum_info[0]['moderator']==1) {?> <span class="red_txt">Moderator</span> <?}?>  |<?$res=$this->forum_model->get_level($forum_info[0]['user_id']);
               $level=$res[0]['level_name'];
              $level = ucwords(str_replace(' ',': ',$level));
               echo $level; ?> 
              |Highest Rank: 
                 <? $best_category = $this->Quiz_model->best_category($forum_info[0]['user_id']); 
                  $best_level = $this->Quiz_model->best_rank($res[0]['current_points']);
                                                          if(empty($best_category->name)) {?><strong><span class="blue_link" > 'None'</span> </strong>
                                                          <?}
                                                            else {?><strong><span class="blue_link" > <?php echo ucwords($best_category->name) . ' ' . ucwords($best_level);?> </span> </strong>
                                                               
                                                        <?}?>
           
               
              | Join Date: <?=$forum_info[0]['joined_date'] ?>  | Posts: <strong class="green_txt"><? if($count_post[$forum_info[0]['user_id']]['totalPost']) echo $count_post[$forum_info[0]['user_id']]['totalPost']; 
               else echo "0"?></strong></div>
          <div class="profile_imge"> <a href="<?=site_url($forum_info[0]['username'])?>">
          
                                             <? if($forum_info[0]['profile_picture']!="") {?>
                                                   <? if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                          <img src="<?=$forum_info[0]['profile_picture']?>" alt="avatar" /> <? } else {?>
                                                   <? } ?>
                                                       <img src="<?=base_url()?>user_profile_images_thumb/<?=$forum_info[0]['profile_picture']?>" alt="avatar" /> 
                                                   <? } else {?>
                                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="50" height="50" alt="avatar" /><? }?>
          
              </a>
          </div>
          <div class="comment_show">
            <div class="arrow_tip"></div>
            <div class="pos"><?=$forum_info[0]['content']; ?>
                <div class="forum_comment_date"> <?=$forum_info[0]['created'] ?></div>
             
              
            
            </div>
            
                </div><div class="forum_actions textR">
                    
                  <? if($this->session->userdata('wannaquiz_user_id'))
              {?>
                 <a href="javascript:void(0)" onclick="toggle('addcomment_<?=$forum_info[0]['disc_id']?>')"><img src="<?=site_url('images/comment_1.png')?>" alt="" width="16" />Reply</a> 
               
                <a href="javascript:void(0)" onclick="report_discussion('<?=$forum_info[0]['disc_id']?>','<?=$this->session->userdata("wannaquiz_user_id")?>')"><img src="<?=site_url('images/flag_2.png')?>" alt="" width="16" />Report</a>
           <?}?> 
           </div>
        </div>
        
<!--        // banner advertisement here -->
          <div class="talk_box  clearfix textC">
             
              <a href="#"> <img height="90px" width="728px" src="<?=base_url()?>advertisement_banners/banner_leaderboard.PNG" alt="Advertisement" /></a>
        </div>
        
<!--     //banner advertisement end -->
            
     <div class="pos" style="display:none" id="addcomment_<?=$forum_info[0]['disc_id']?>" >
        <h1 class="blue_title"><span>Post your comment</span></h1>
        <h6 class="title6">Some Rules</h6>
        <div class="text_desc font11">
          <p>No unnecessary post please</p>
          
        </div>
       
          
            <label><strong class="font11 lh1_66">Your Comment</strong></label>
            <textarea rows="20" cols="20" class="large_textarea" name="comment" id="comment"></textarea>
            
            <div class="clearfix"><span class="scalable_btn aqua">
              <input type="submit" value="Publish Comment"  onclick="addcomment('<?=$forum_info[0]['disc_id']?>')" />
              </span></div>
         
      
      </div>
        <?php 
        if($comment_info>0)
        {
            foreach ($comment_info as $rows){ ?>
        
               <div class="talk_box clearfix" id="list">
                    <div class="user_details font10"><a href="<?=site_url($rows['username'])?>" class="font11 authorname"><?=$rows['username']?></a>
                       <?if($rows['moderator']==1){?> <span class="red_txt">Moderator</span> <?}?>| <?$res=$this->forum_model->get_level($rows['user_id']);
                         $level=$res[0]['level_name'];
                        $level = ucwords(str_replace(' ',': ',$level));
               echo $level; ?>|Highest Rank: 

               <?                              
               $best_category = $this->Quiz_model->best_category($rows['user_id']);
               $best_level = $this->Quiz_model->best_rank($best_category->total);
                      ?> <strong><span class="blue_link" ><?echo ucwords($best_category->name) . ' ' . ucwords($best_level);?></span> </strong><?

               ?> |  Join Date: <?=$forum_info[0]['joined_date']; ?> | Posts: <strong class="green_txt"><?=$count_post[$rows['user_id']]['totalPost']?></strong></div>
          <div class="profile_imge"> <a href="<?=site_url($rows['username'])?>">
                                                 <? if($rows['profile_picture']!="") {?>
                                                   <? if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                          <img src="<?=$rows['profile_picture']?>" alt="avatar" /> <? } else {?>
                                                   <? } ?>
                                                       <img src="<?=base_url()?>user_profile_images_thumb/<?=$rows['profile_picture']?>" alt="avatar" /> 
                                                   <? } else {?>
                                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="50" height="50" alt="avatar" /><? }?>
          
                                    </a></div>
                   
                   
                   <div class="comment_show">
            <div class="arrow_tip"></div>
            <div class="pos">
              <div class="forum_comment_date"><?=$rows['comment_date']?> </div>
              <p><?=$rows['comment']?></p>
            </div>
            
          </div><div class="forum_actions textR">
             
              <? if($this->session->userdata('wannaquiz_user_id'))
              {?>
              <a href="#" class="edit_comment"><img src="<?=site_url('images/comment_1.png')?>" alt="" width="16" />Reply</a>
               
                <a href="javascript:void(0)" onclick="report_comment('<?=$rows['id']?>','<?=$this->session->userdata("wannaquiz_user_id")?>')"><img src="<?=site_url('images/flag_2.png')?>" alt="" width="16" />Report</a>
           <?}?>          
          </div>
          
          <div class="comment_edit_moderator">
          
            <label><strong class="font11 lh1_66">Reply</strong></label>
            <textarea rows="20" cols="20" class="large_textarea" id="comment_reply_<?=$rows['id']?>"></textarea>
            <div class="clear"></div>
            <div class="clearfix"><span class="scalable_btn aqua">
              <input type="submit" value="Reply Comment" onclick="reply_comment('<?=$rows['id']?>','<?=$forum_info[0]['disc_id']?>')"/>
              </span></div>
          
        </div>
        </div>
        <?php  } }
        else echo " No Forum Discussion Acailable"?>
          

        <body>

         <div class="paginnation clearfix">
             <?=$this->pagination->create_links();?>
        </div>
        </div>
      </div>
    </div> 
</div>
