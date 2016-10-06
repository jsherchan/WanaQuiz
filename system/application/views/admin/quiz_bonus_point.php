<h2 class="headingclass" >Quiz Bonus Point Management</h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt; Quiz Bonus Point Management </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
	<tr>
		<td width="20%">
        <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management')?>" style="color:#003399">[Badge and Level]</a></strong>
		</td>

        <td width="20%">
        <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/awards')?>" style="color:#003399">[View Awards]</a></strong>
		</td>

        <td width="20%">
        <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/add_quiz_bonus_point')?>" style="color:#003399">[+ Add Bonus Points]</a></strong>
		</td>
     
	</tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
                <td class="border_block" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                  <tr>
                    <td colspan="2"><link href="css/base.css" rel="stylesheet" type="text/css" />
  
<table width="100%" border="0"  cellpadding="4" cellspacing="0" class="Mtable">
  <tr > 
  <th width="84"  class="th" ><div align="center">ID</div></th>
    <th width="198"  class="th"><div align="center">Questions answered in a row</div></th>
    <th width="189"  class="th"><div align="center">Quiz Difficulty Level</div></th>
  	<th width="189"  class="th"><div align="center">Bonus Points</div></th>
	
	<th width="69" class="th"><div align="center">Edit</div></th>
	<th width="62" class="th"><div align="center">Delete</div></th>
	</tr>
<?php if(count($quiz_bonus_point_list)>0){
foreach($quiz_bonus_point_list as $rows){
?>  
  <tr align="center" class=""> 
  	<td><?=$rows->id?></td>
    <td ><?=$rows->question_answered_in_row?></td>
    <td> <?=$rows->quiz_type?> </td>
    <td> <?=$rows->bonus_points?></td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/score_badge_management/edit_quiz_bonus_point/'.$rows->id) ?>">
				<img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Badge" border="0">				</a>				</td>
	<td>
				
				<a href="<?=site_url(ADMIN_PATH.'/score_badge_management/delete_quiz_bonus_point/'.$rows->id) ?>">
				<img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Badge" onClick="return doConfirm()"  border="0">				</a>				</td>
</tr>			  
  <? }
    }?>
</table>
					</td>
                  </tr>
                </table></td>
			  </tr>
</tbody></table>



<script>

function doConfirm()
{
	msg=confirm("Are you sure you want to delete this Quiz Bonus Point Permanently?");
	if(msg!=true)
	{
		return false;
	}
}

</script>	
			