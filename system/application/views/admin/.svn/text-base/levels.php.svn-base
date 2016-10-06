<h2 class="headingclass" >Level Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt; Level  Management </span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
    <tr>
        <td width="20%">
            <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/add_levels')?>" style="color:#003399">[+ ADD Levels]</a></strong>
        </td>

        <td width="20%">
            <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/getLevels')?>" style="color:#003399">[View Levels]</a></strong>
        </td>

        <!--<td width="20%">
        <strong> <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/quiz_bonus_points')?>" style="color:#003399">[Bonus Points Settings ]</a></strong>
		</td>-->

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
                        <th width="84"  class="th" ><div align="center">S. No.</div></th>
                        <th width="198"  class="th"><div align="center">Level Name</div></th>
                        <th width="189"  class="th"><div align="center">Points</div></th>

                        <th width="69" class="th"><div align="center">Edit</div></th>
                        <th width="62" class="th"><div align="center">Delete</div></th>
                    </tr>
                    <?php if(count($level_list)>0) {
                        foreach($level_list as $rows) {
                            ?>
                    <tr align="center" class="">
                        <td><?=$rows->id?></td>
                        <td ><?=$rows->level_name?></td>
                        <td> <?=$rows->points?> </td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/editLevel/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Badge" border="0">				</a>				</td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/score_badge_management/delete_level/'.$rows->id) ?>">
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
        msg=confirm("Are you sure you want to delete this Banner Permanently?");
        if(msg!=true)
        {
            return false;
        }
    }

</script>	
