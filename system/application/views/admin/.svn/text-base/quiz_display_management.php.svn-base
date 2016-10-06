<h2 class="headingclass" >Quiz Display Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt;<a href="<?=site_url(ADMIN_PATH.'/quiz_display_management/')?>"> Quiz Display  Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
    <tr>
        
        <td width="20%">
            <strong> <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management')?>" style="color:#003399">[Quiz Display Data]</a></strong>
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
                        <th width="84"  class="th" ><div align="left">S No.</div></th>
                        <th width="208"  class="th"><div align="left">User Type</div></th>
                        <th width="208"  class="th"><div align="left">Percentage</div></th>
                        
                        <th width="69" class="th"><div align="center">Edit</div></th>
                        <th width="59" class="th"><div align="center">Delete</div></th>

                        <?php if(count($display_data)>0) {
                            foreach($display_data as $rows) {
                                ?>
                    <tr align="center" class="">
                        <td ><div align="left"><?=$rows->id?></div></td>
                        <td ><div align="left"><?=$rows->user_type?></div></td>
                        <td> <?=$rows->percentage?></td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management/edit_quiz_display/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Transaction" border="0">				</a>				</td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management/delete_quiz_display/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm()"  border="0">				</a>				</td>
                    </tr>
                        <? }
                    }?>
                </table>
                <br />
                <div align='left'>


                </div>

                <br />


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
