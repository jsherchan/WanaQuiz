
<script type="text/javascript">
         var j = jQuery.noConflict();
            function quiz_edit_commit(uid){ //alert('hii');
                var comment = j('#edit_comments_'+uid).val();
             
                if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    j.post('<?=site_url(ADMIN_PATH.'/moderator_activities/quizeditComment/')?>', 
                    {comment_id:uid, comment:comment} , 
                    function(data){
                            if(data=='success');
                            location.reload();
 
                         });
                        
                }

            }
            
            
           function delete_comment(id)
        { 
    
	job=confirm("Are you sure you want to Delete Report?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/delete_comment/')?>", {comment_id:id}, function(data){
                    if(data=='success');
                  j('#list_'+id).hide(1000);
                });
            }
        else {
		return false;
            }
    }
       function quiz_edit_reply(uid){ //alert('hii');
                var comment = j('#edit_comment_reply').val();
                if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    j.post('<?=site_url(ADMIN_PATH.'/moderator_activities/quizeditComment')?>', 
                    {comment_id:uid, comment:comment} , 
                    function(data){
                            if(data=='success');
                            location.reload();
 
                         });
                        
                }

            }

           function hideShowReaction(){
                j('#text_reaction').toggle();
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
<?php 
include('moderator_activity_panel.php');
?>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home/')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/moderator_activities/')?>"> Moderator Activities </a>>>Reported Text Reactions</span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable v_top">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">User Name </a></th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">Quiz Title</a></th>
        <th width="479" align="center"><a href="#" style="color:#FFFFFF">Comment</a></th>
        <th width="200 " align="center"><a href="#" style="color:#FFFFFF">Date</a></th>
        <th width="300" align="center"><a href="#" style="color:#FFFFFF">Admin Action</a></th>
        

    </tr>
        <? 
        $j=1;
        if(count($reported_reaction)!=0){
              foreach($reported_reaction as $rows) 
                   {
                 // print_r($rows);     
                 ?>
    <tr id="list_<?=$rows['comment_id']?>">
          <td align="left"><?php echo  $j; ?></td>
          <td><a href="<?=site_url($rows['username'])?>"><?=$rows['username'];?></a>
        <td align="left"><a href="<?=base_url()?>quiz/view/<?=$rows['quiz_id']?>"><?=$rows['quiz_question']?></a></td>
        <td align="left"><?=$rows['comment']?>
          <div  style="display:none" id="editcomment_<?=$rows['comment_id']?>">

              <label style="display: block; padding-top: 10px;"><strong class="font11 lh1_66">Edit this Comment</strong></label>
              <textarea style="width: 90%;" rows="5" cols="10" class="large_textarea" id="edit_comments_<?=$rows['comment_id']?>" value="<?=nl2br($rows['comment'])?>"> <?=nl2br($rows['comment'])?></textarea>
   
    <div ><span >
    <input type="submit" value="Save" id="submit_comment" onclick="quiz_edit_commit('<?=$rows['comment_id']?>')"/>
    </span></div>

    </div>
        
        </td>
        <td align="left"><?=date('Y-m-d H:i:s',$rows['comment_date']);?></td>
      <td><a href="javascript:void(0)" onclick='return delete_comment("<?=$rows['comment_id']?>")' >Delete </a>| 
                    <a style="cursor:pointer"  onclick="toggle('editcomment_<?=$rows['comment_id']?>')">Edit Comment</a>
                  
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
