       <link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
        <style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>
<script>
     var j = jQuery.noConflict();
function delete_comment(id)
{
   	job=confirm("Are you sure you want to Delete Comment?");
	if(job==true)
       
        {   j.post("<?=site_url('moderator_management/delete_test_comment/')?>", {comment_id:id}, function(data){
                    if(data=='success');
                     j('#list_'+id).hide(1000);
                });
            }
        else 
        {
		return false;
	}
}
 function discussion_edit_comment(uid){ //alert('hii');
             
               var comment = j('#edit_comments_'+uid).val();
              if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    j.post('<?=base_url()?>moderator_management/text_comment_edit', 
                    {comment_id:uid, comment:comment} , 
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
            
                var el = document.getElementById(obj);
             if ( el.style.display != 'none' ) {
                    el.style.display = 'none';
                }
                else {
                    el.style.display = '';
                }
            }
</script>
<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" /> 

<div class="right_large_col floatR">
<div class="rounded_white_bg">
      <div class="pos">
        <h1 class="blue_title"><span>Reported Member Text Comments</span></h1>
        <div class="list_cont">
         <? foreach($text_reaction as $rows){
          ?>
            <div class="list_slot clearfix reported_user_list" id="list_<?=$rows['comment_id']?>">
            
            <div class="reported_comments_desc">
                 <div class="reported_comments">
                 <div class=""><strong>Comments:</strong></div>
                 <p><?=$rows['comment']?> </p>
                 </div>
                
                 <div class="report_meta">Commented by <a href="<?=site_url($rows['username'])?>" class="reported_author"><?=$rows['username']?></a> | Date: <?=date("Y-m-d H:i:s",$rows['coment_date'])?></div>
       <div style="display:none" id="editcomment_<?=$rows['comment_id']?>"
        
            <label><strong class="font11 lh1_66" >Edit this Comment</strong></label>
            <textarea rows="20" cols="20" class="large_textarea" id="edit_comments_<?=$rows['comment_id']?>"value="<?=$rows['comment']?>"><?=$rows['comment']?></textarea>
            <div class="clear"></div>
            <div class="clearfix"><span class="scalable_btn aqua">
              <input type="submit" value="Save edited disscussion" onclick="discussion_edit_comment('<?=$rows['comment_id']?>')"/>
              </span></div>
          
       </div>
            
            </div>
            <div class="delete"> <a href="javascript:void(0)" onclick='return delete_comment("<?=$rows['comment_id']?>")' class="delete_btn">Delete </a> 
                <a style="cursor:pointer"  class="delete_btn black_btn edit_comment" onclick="toggle('editcomment_<?=$rows['comment_id']?>')">Edit Comment</a>
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