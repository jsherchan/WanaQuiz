<script language="javascript">
function doconfirm(type,name)
{
	job=confirm("Are you sure you want to "+ type +" "+ name +" ?");
	if(job!=true)
	{
		return false;
	}
        return true;
}
function item_deleted()
{
    var item=jQuery('#deleted_item').val();
  if (item=="Deleted Quizzes")
      {
          window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_quiz')?>";
      }
          else if(item=="Deleted Text Reactions")
         {
             window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_quiz_reaction')?>";
         } 
             else if (item=="Deleted Forum Posts")
                 {
                     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_thread')?>";
                 }
                  else if (item=="Deleted Forum Reactions")
                 {
                     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_thread_reaction')?>";
                  }
                   else if (item=="Deleted Profile Text")
                 {
                     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_text_reaction')?>";
                  }
     else 
     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/deleted_items')?>";
}
function item_reported()
{
      var item=jQuery('#reported_item').val();
    if (item=="Reported Quizzes")
      {
            window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/reported_quiz')?>";
      }
          else if(item=="Reported Text Reactions")
         {
            window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/reported_quiz_reaction')?>";
         } 
             else if (item=="Reported Forum Posts")
                 {
                      window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/reported_thread')?>";
                 }
                  else if (item=="Reported Forum Reactions")
                 {
                     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/reported_thread_reaction')?>";
                  }
                   else if (item=="Reported Profile Text")
                 {
                     window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/reported_text_reaction')?>";
                  }
    else  window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/')?>";
}
function item_flagged()
{
    var item=jQuery('#flagged_item').val();
  if (item=="Flagged Quizzes")
      {
           window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/flagged_quiz')?>";
      }
          else if(item=="Flagged Forum Posts")
         {
             window.location="<?=site_url(ADMIN_PATH.'/moderator_activities/flagged_thread')?>";
         } 
         else alert("No Item Selected");
}

</script>
<style>.nav_pagination{margin: 0;}</style>
<h2 class="headingclass" >Moderator Activity Detail</h2>
<br>


<br />
<table width="550" cellpadding="1">
    <tr>
        <td><strong>[ <b>Deleted Items</b> ]</strong>
    <select name="deleted_item" id="deleted_item" onchange="return item_deleted()"  >
    <option selected>Select Items </option>
    <option>Deleted Quizzes</option>
     <option >Deleted Profile Text</option>
    <option>Deleted Text Reactions</option>
    <option>Deleted Forum Posts</option>
    <option >Deleted Forum Reactions</option>
    
    </select>
     
        </td>
        
    <td><strong>[ <b>Reported Items</b> ]</strong>
        <select name="reported_item" id="reported_item" onchange="return item_reported()">
    <option selected>Select Item</option>
   <option>Reported Quizzes</option>
    <option >Reported Profile Text</option> 
   <option>Reported Text Reactions</option>
    <option>Reported Forum Posts</option>
    <option >Reported Forum Reactions</option>
    
    </select></td>
    
    <td><strong>[ <b>Flagged Items</b> ]</strong>
       <select name="flagged_item" id="flagged_item" onchange="return item_flagged()">
    <option selected>Select Items </option>
     <option>Flagged Quizzes</option>
    <option>Flagged Forum Posts</option>
    </select></td>
    
    </tr>
</table>
<br/>
<table width="550" cellpadding="1">
    <tr>
        <td><strong><b><?= anchor(site_url(ADMIN_PATH.'/moderator_activities/'),'Home')?></b></strong></td>
    </tr>
</table>

<?php if($this->session->flashdata('msg')) {
    echo "<div class='message'>".$this->session->flashdata('msg')."</div>";
}
?>