<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are you sure you want to delete this forum detail Permanently?");
	if(job!=true)
	{
		return false;
	}
        return true;
}

function search_forum()
{
    var f = jQuery('#search').val();
    if(f=='') return;
    else
    {
        jQuery('#forum_search').html('<td align="center" colspan="7"><img src="<?=base_url()?>images/ajax-loader.gif" alt="Loading Search Result" title="Loading Search Result" /></td>');
        //jQuery.post('<?=base_url()?>admin/forum/forum_search',{forum: f},function(data){console.log(data);});
        jQuery('#forum_search').load('<?=base_url()?>admin/forum/forum_search',{forum: f});
    }
}

</SCRIPT>

<h2 class="headingclass" >Forum Management</h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>" class="blue_bold">ADMIN</a> >> Forum Management</span></td>
    <td><a href="javascript:history.back();"> <img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /> </a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">BACK</span></a></td>

  </tr>
</table>

<table width="550" cellpadding="1">
  <tr>
    <td><strong>[<a href="<?=site_url(ADMIN_PATH.'/forum/forum_add')?>">Add New Discussion </a>]<?php // echo $this->session->userdata('neomundo_admin_id');?></strong></td>
  </tr>
</table>

<table>
   <form name="serach_discussion_form" action="<?=site_url(ADMIN_PATH.'/forum/forum_search')?>" method="post" >
    <tr>
      <td><strong>Search forum By Title: </strong>&nbsp;&nbsp; </td>
      <td> <input type="text" id="forum" name="forum" value="<?php if($search_title!="NTS") echo $search_title ?>" size="30" maxlength="60">
      </td>
	   <td> <input type="Submit" name="search" value="Search" class="bttn">  </td>
    </tr>
   </form>
  </table>

<br />
  
<?php if($this->session->flashdata('category_error')) {
    echo "<div class='message'>".$this->session->flashdata('category_error')."</div>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable" align="center">
 	<tr>
    	<th width="6%">ID</th>
        <th width="21%">forum Title</th>
        <th width="17%">User</th>
        <th width="19%">Added Date</th>
        <th width="7%">Edit</th>
        <th width="15%">Delete</th>
        <th width="15%">View Comments</th>
     </tr>
     <?php // $this->load->model('forum_model');
	 		//$=$this->forum_model->get_forum_list();
          if($forum_list) { 
			foreach($forum_list as $forum){
#                            echo $forum->discussion_title;
                            
		?>
     <tr id="forum_search">
     	<td><?=$forum['disc_id'];?></td>
        <td><?=$forum['discussion_title'];?>&nbsp;</td>
        <td><?php $user=$forum['user_id'];
		 $name=$this->Forum_model->get_user($user);?>
                 <a href="<?=site_url(ADMIN_PATH.'/members/member_details/'.$name['user_id']);?>"><a><?php
		if($name[0]['username']==''){echo 'Admin';} else ?> <a href="<?=base_url()?><?=$name[0]['username']?>" ><?echo $name[0]['username'];?></a></td>
        <td><?php $added=strtotime($forum['created']);
		echo  date("Y:m:d H:i:s",$added); 
		?>&nbsp;</td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_edit/'.$forum['disc_id']);?>"><img src="<?=base_url()?>images/admin_images/edit.gif" /></a></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_delete_discussion/'.$forum['disc_id']);?>" onclick="return doconfirm()"><img src="<?=base_url()?>images/admin_images/delete.gif" /></a></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_discussion_detail/'.$forum['disc_id']);?>"><img src="<?=base_url()?>images/admin_images/box.png"  width="16"/></a></td>
     </tr>
     <?php } } else { ?>
     <tr>
        <td align="center" colspan="7">No Discussions available yet</td>
     </tr>
     <?php } ?>
</table>
  <?=$this->pagination->create_links();?>