
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/main.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script type="text/javascript">
     var j = jQuery.noConflict();
function acceptModerator(id,status){
     //alert(id);
               j.post('<?=base_url().ADMIN_PATH?>/members/updateModerator', {user_id:id} , function(data){
                      console.log(data);
//                      return;
//                    if (data != '' || typeof data != undefined || data != null)
                    {
//                        if(data=='success')
                        {
                            j.prompt('Modereator request is accepted !');
                             location.reload();
                        }
//                        else $.prompt('Unable to sent your request');
                    }
                  });
//       
}

function declineModerator(user_id,status)
{
	job=confirm("Are you sure you want to decline this member Moderator?");
	if(job==true)
        {
                j.post("<?=site_url(ADMIN_PATH.'/members/cancelModeartor/')?>", {user_id:user_id,status:status}, function(data){
                    if(data=='success');
                  // location.reload();
                });
            }
        else {
		return false;
	}
}
function unblockModerator(user_id,status)
{  
	job=confirm("Are you sure you want to Unblock this member Moderator?");
	if(job==true)
        {
                j.post("<?=site_url(ADMIN_PATH.'/members/unblockModeartor/')?>", {user_id:user_id,status:status}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
}
function UndeleteModerator(user_id)
{   
	job=confirm("Are you sure you want to Re-Hire this member Moderator?");
	if(job==true)
        {
                j.post("<?=site_url(ADMIN_PATH.'/members/RehireModeartor/')?>", {user_id:user_id}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
}
function search_moderator()
{  
    var f = jQuery('#search').val();
       if(f=='') return;
    else
    {
        jQuery('#moderator_search').html('<td align="center" colspan="7"><img src="<?=base_url()?>images/ajax-loader.gif" alt="Loading Search Result" title="Loading Search Result" /></td>');
        //jQuery.post('<?=base_url()?>admin/forum/forum_search',{forum: f},function(data){console.log(data);});
        jQuery('#moderator_search').load('<?=base_url()?>admin/moderator_management/moderator_search',{moderator: f});
     jQuery('.bhag').remove();
}
}
</script>
<?php //print_r($adsense_code)
//$vcode = $admin_vertical_code;
//$vertical_code = $admin_vertical_code; //str_replace('<','&%lt;',$code);
//$rcode = $admin_rectangular_code;
//$rectangular_code = $admin_rectangular_code;//str_replace('<','&%lt;',$rcode);
?>
<h2 class="headingclass" >Moderator Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt;<a href="<?=site_url(ADMIN_PATH.'/moderator_management/')?>"> Moderator  Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />
<table>
    <tr>
      <td><strong>Search Moderator(User Name): </strong>&nbsp;&nbsp; </td>
      <td> <input type="text" id="search" name="search" value="<?php if($search_title!="NTS") echo $search_title ?>" size="30" maxlength="60">
      </td>
	   <td> <input type="Submit" name="search" value="Search" onclick="search_moderator();" class="bttn">  </td>
    </tr>
  </table>

<br>
<div id="moderator_search" align="center" class=""> </div>
<div class="bhag">
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable" >
    <tr>   
                      <th width="208"  class="th"><div align="left">User id</div></th>
                        <th width="208"  class="th"><div align="left">User Name</div></th>
                        <th width="208"  class="th"><div align="left">Moderator</div></th>
                         <th width="59" class="th"><div align="center">Delete</div></th>
                    </tr>
                     
                        <?php
                          if(count($partner_list)>0) {
                            foreach($partner_list as $rows) {
                              //  print_r($rows);
                                $user_info = $this->Member_model->get_member($rows->user_id);
                                ?>
                  
                         <tr align="center" >
                        <td ><div align="left"><?=$rows->user_id?></div></td>
                        <td ><div align="left"><a href="<?=base_url()?><?=$user_info->username?>"><?=$user_info->username?></a></div></td>
                       
                        <td >
                            <div align="left" id="partner">
                                <?php if($rows->delete!='1'){
                                
                                if($rows->active=='0'){?>
                                <a href="javascript:void(0)" onclick='return acceptModerator("<?=$rows->user_id?>","1")'>Accept </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="return declineModerator('<?=$rows->user_id?>','0')">Reject</a>
                                <? } else  if ($rows->active=='1'){ ?>
                                <b>Moderator</b> (<a href="javascript:void(0)" onclick="declineModerator('<?=$rows->user_id?>',0)">Cancel Moderator</a>)
                                <? } else {?>
                                 <b>Moderator</b> Blocked | <a href="javascript:void(0)" onclick="unblockModerator('<?=$rows->user_id?>','1')"> Unblock </a>
                                <? } }
                                else {?>
                                  <b>Moderator</b> Deleted |<a href="javascript:void(0)" onclick="UndeleteModerator('<?=$rows->user_id?>')">Re-hire </a>
                                 <?}?>
                            </div>
                            
                        </td>
                       
                        
                        <!--<td>
                            <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management/edit_quiz_display/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Transaction" border="0">
                            </a>
                        </td>-->
                        <td>
                            <?if($rows->delete=='1')
                            { echo "---"; }
                            else {?>
                            <a href="<?=site_url(ADMIN_PATH.'/moderator_management/delete_moderator/'.$rows->user_id) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm()"  border="0">				
                            </a>
                            <?}?>
                        </td>
                      
                    </tr>
                        <? }
                    }?>
                      <tr> 
   <th colspan="6" cellpadding="3px">  
	<?php echo $this->pagination->create_links();?>	</th>
</tr>
                
                
                </table>
</div> 
  
<script>

    function doConfirm()
    {
        msg=confirm("Are you sure you want to delete this Banner Permanently?");
        if(msg!=true)
        {
            return false;
        }
    }

</script>	
