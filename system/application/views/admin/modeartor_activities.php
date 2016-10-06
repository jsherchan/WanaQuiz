<script>  
var j = jQuery.noConflict(); 
function undelete(id,item_type,item_id)
{ 
	job=confirm("Are you sure you want to Undelete "+item_type+" ?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/undelete/')?>", {id:id,item_type:item_type,item_id:item_id}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
   }
        function quiz_delete(id,item_type,item_id)
    { 
	job=confirm("Are you sure you want Delete "+item_type+" ?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/delete/')?>", {id:id,item_type:item_type,item_id:item_id}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
   }
       
function unblock(id,item_type,item_id)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/unblock/')?>", {id:id,item_type:item_type,item_id:item_id}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
   }
        function block(id,item_type,item_id)
{ 
	job=confirm("Are you sure you want to change Status of the  Quiz?");
	if(job==true)
       
        {   j.post("<?=site_url(ADMIN_PATH.'/moderator_activities/block/')?>", {id:id,item_type:item_type,item_id:item_id}, function(data){
                    if(data=='success');
                   location.reload();
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
                >><a href="<?=site_url(ADMIN_PATH.'/moderator_activities/')?>"> Moderator Activities </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">User Name </a></th>
        <th width="111" align="center"> <a href="#" style="color:#FFFFFF">Item Id </a></th>
        <th width="479" align="center"><a href="#" style="color:#FFFFFF">Activities </a></th>
        <th width="200 " align="center"><a href="#" style="color:#FFFFFF">Date</a></th>
        <th width="150" align="center"><a href="#" style="color:#FFFFFF">Admin Action </a></th>
        

    </tr>
        
        <? 
        $j=1;
        if(count($modarator_list)!=0){
              foreach($modarator_list as $rows) 
                   {
                  $action = explode(' ',$rows->action);
                  $c = count($action); 
                  --$c;
                 // print_r($rows);
                  ?>
    
    
      <tr>
          <td align="left"><?php echo  $j; ?></td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/moderator_activities/moderator_activity_by_user/'.$rows->moderator_id);?>"><?=$rows->username?></a></td>
        <td align="left"> <? if($action[0]=='Quiz') { ?>
            <a href="<?=base_url()?>quiz/view/<?=$rows->item_id?>"> <?=$rows->item_id;?> </a>
             <?}
             else if($action[0]=='Thread'){?>
            <a href="<?=site_url(ADMIN_PATH.'/forum/forum_discussion_detail/'.$rows->item_id);?>"><?=$rows->item_id;?></a>
            <?}else { ?>  <? echo $rows->item_id;?>
             <?}?>
          </td>
            <td align="left"><? if($action[0]=='Quiz'){ ?>
            <a href="<?=base_url()?>quiz/view/<?=$rows->item_id?>"> <?=$rows->action;?> </a>
             <?}
             else if($action[0]=='Thread'){?>
            <a href="<?=site_url(ADMIN_PATH.'/forum/forum_discussion_detail/'.$rows->item_id);?>"><?=$rows->action;?></a>
            <?}else { ?>  <? echo $rows->action;?>
             <?}?>
            </td>
       <td align="left"> <?=$rows->date  ?> </td>
   
       <td> <? 
  
       if($action[$c] == 'Deleted' &&( $action[0]=='Quiz' || $action[0]=='Thread'||$action[0]=='Post'||$action[0]=='Comment'||$action[0]=='Text')) {?>
         <a href="javascript:void(0)" onclick='return undelete("<?=$rows->id?>","<?=$rows->item_type?>","<?=$rows->item_id?>")' ><? echo 'Undelete '.$action[0]; ?></a>
       <?}
       else if($action[$c] == 'Blocked'&&( $action[0]=='Quiz' || $action[0]=='Thread'||$action[0]=='Comment' ||$action[0]=='Post'||$action[0]=='Text'))
       {?> <a href="javascript:void(0)" onclick='return unblock("<?=$rows->id?>","<?=$rows->item_type?>","<?=$rows->item_id?>")' ><? echo 'Unblock '.$action[0]; ?></a>
      <?}
       else if($action[$c] == 'Unblocked'&&( $action[0]=='Quiz' || $action[0]=='Thread'||$action[0]=='Comment' ||$action[0]=='Post'||$action[0]=='Text')) 
         {?> <a href="javascript:void(0)" onclick='return block("<?=$rows->id?>","<?=$rows->item_type?>","<?=$rows->item_id?>")' ><? echo 'Block '.$action[0]; ?></a>
      <?}
      else if($action[$c] == 'Undeleted'&&( $action[0]=='Quiz' || $action[0]=='Thread'||$action[0]=='Comment' ||$action[0]=='Post'||$action[0]=='Text'))
      {?> <a href="javascript:void(0)" onclick='return quiz_delete("<?=$rows->id?>","<?=$rows->item_type?>","<?=$rows->item_id?>")' ><? echo 'Delete '.$action[0]; ?></a>
      <?}
       else echo '---';
  
?>        </td>
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
