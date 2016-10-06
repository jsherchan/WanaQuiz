<h2 class="headingclass" >Forum :  Discussion Detail</h2>
<script type="text/javascript">
//$(function(){alert('in')});
function dochange(id)
{
    if(id!='')
        jQuery('#sub_category').load('<?=base_url()?>admin/forum/forum_get_subcategory_options',{pid:id});
    else
        jQuery('#sub_category').html('<select><option value="">- Sub Category -</option></select>');
}
function doconfirm()
{
	job=confirm("Are you sure you want to delete Comment?");
	if(job!=true)
	{
		return false;
	}
        return true;
}
var j = jQuery.noConflict();
            function quiz_edit_commit(uid){ //alert('hii');
                var comment = j('#edit_comments_'+uid).val();
             
                if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    j.post('<?=site_url(ADMIN_PATH.'/forum/discussion_comment_edit/')?>', 
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


<table width="100%"  border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a>
      >>Forum Management >> Forum Detail</span></td>
    <td><a href="javascript:history.back();"> <img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /> </a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">BACK</span></a></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><span style='color:red;'><?php if($this->session->userdata('message')) echo $this->session->userdata('message') ; $this->session->unset_userdata('message'); ?></span></td>
  </tr>
  
<?php if($this->session->flashdata('category_error')) {
    echo "<div class='message'>".$this->session->flashdata('category_error')."</div>";
}
?>
</table>

 <table width="40%"  border="0" cellspacing="1" cellpadding="4">
    <tr>
        
      <td>Discussion Title: </td>
   
      <td><?=$forum_info[0]['discussion_title'];?></td>
    </tr>
    <tr>
        
      <td>Created Date: </td>
   
      <td><?=$forum_info[0]['created'];?></td>
    </tr>
    <tr>
	  <td>Category</td>
      <td>         
         <?php 
         $categories = $this->Forum_category_model->get_catagory_by_id($forum_info[0]['cat_id']);
         echo $categories[0]->name;
        
            ?>
	  </td>
    </tr>
     <tr>
      <td>
        
          <label>Sub Category</label>
      </td>
      <td ><?
          $s_id = $forum_info[0]['sub_cat_id'];
          
          if($s_id)
          {
               $categories = $this->Forum_category_model->get_sub_categories($s_id);
               echo $categories[0]->name;
          }
           
          ?>	  </td>
    </tr>
    <tr>
      <td><label>Tags</label></td>
      <td colspan="2"><?=$forum_info[0]['tags']?>&nbsp;</td>
    </tr>
    <tr>
      <td>Detail</td>
      <td colspan="2"><?=$forum_info[0]['discussion_title'];?>&nbsp;</td>
    </tr>
     </table>
<div>
    <table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable" align="center">
 	<tr>
    	<th width="6%">S.NO</th>
        <th width="21%">User Name</th>
        <th width="17%">Discussion Title</th>
        <th width="19%">Comment</th>
        <th width="7%">Post Date</th>
         <th width="15%">Edit</th>
         <th width="15%">Delete</th>
         </tr>
         
             <?
             foreach($comment_info as $rows)
             {
                 
                 ?>
         <tr id="forum_search">
             <td><?=$rows['id']?></td>
             <td><?=$rows['username']?></td>
             <td><?=$rows['discussion_title']?></td>
             <td><?=$rows['comment']?>
              <div  style="display:none" id="editcomment_<?=$rows['id']?>">

              <label style="display: block; padding-top: 10px;"><strong class="font11 lh1_66">Edit this Comment</strong></label>
              <textarea style="width: 90%;" rows="5" cols="10" class="large_textarea" id="edit_comments_<?=$rows['id']?>" value="<?=nl2br($rows['comment'])?>"> <?=nl2br($rows['comment'])?></textarea>
   
    <div ><span >
    <input type="submit" value="Save" id="submit_comment" onclick="quiz_edit_commit('<?=$rows['id']?>')"/>
    </span></div>

    </div>
             </td>
             <td><?=$rows['comment_date']?></td>
            
              <td align="center"><a style="cursor:pointer"  onclick="toggle('editcomment_<?=$rows['id']?>')"><img src="<?=base_url()?>images/admin_images/edit.gif" /></a></td>
              <td align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_delete_comment/'.$rows['id'].'/'.$forum_info[0]['disc_id']);?>" onclick="return doconfirm()"><img src="<?=base_url()?>images/admin_images/delete.gif" /></a></td>
         </tr>
             <?
             }?>
        
       
    </table>
     <div class="paginnation clearfix">
             <?=$this->pagination->create_links();?>
        </div>
</div>