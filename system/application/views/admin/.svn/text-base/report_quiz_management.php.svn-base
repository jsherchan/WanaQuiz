<script>
function block_ip(ip){
        jQuery.post('<?=base_url()?>admin/block_ips/add_ip', {ip_address:ip,ip_from:'quiz_page'} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='success')
                {
                    alert('Successfully blocked' );
                    location.reload();
                }
                else alert('error');

            }
        });
    }

    function unblock_ip(ip){
        jQuery.post('<?=base_url()?>admin/block_ips/unblock_ip', {ip_address:ip,ip_from:'quiz_page'} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='unblocked')
                {
                    alert('Successfully Unblocked' );
                    location.reload();
                }
                else alert('error');

            }
        });
    }
</script>
<h2 class="headingclass" >Quiz Report Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt;<a href="<?=site_url(ADMIN_PATH.'/report_quiz_management/')?>"> Quiz Report Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />

<!--<table width="100%" border="0" cellspacing="0">
    <tr>
        
        <td width="20%">
            <strong> <a href="<?=site_url(ADMIN_PATH.'/banner_management/banner')?>" style="color:#003399">[Banner Ads]</a></strong>
        </td>
       
        <?php if($flag=='add_banner'){ ?>
        <td>
            <a href="<?=site_url(ADMIN_PATH.'/banner_management/add_banner')?>" style="color:#003399">[Add Banner]</a>
        </td>
        <? } ?>

       <?php if($flag=='') {?>
        <td>
            <a href="<?=site_url(ADMIN_PATH.'/banner_management/textAds')?>" style="color:#003399">[Text Ads]</a>
        </td>
        <? } ?>
        
    </tr>
</table>-->
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="border_block" ><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td colspan="2"><link href="css/base.css" rel="stylesheet" type="text/css" />

                <table width="100%" border="0"  cellpadding="4" cellspacing="0" class="Mtable">
                    <tr >
                        <th width="84"  class="th" ><div align="left">Report No.</div></th>
                        <th width="208"  class="th"><div align="left">Question</div></th>
                        <th width="208"  class="th"><div align="left">Report Type</div></th>
                        <th width="208"  class="th"><div align="left">Reporter</div></th>
                       
                        <th width="251"  class="th"><div align="center">Cancel</div></th>
                        <th width="59" class="th"><div align="center">Delete</div></th>
                        <th width="11%" align="left"><div align="center"><b>Block Ip</b></div></th>

                        <?php if(count($report_list)>0) {
                            foreach($report_list as $rows) {
                                $quiz_detail= $this->Quiz_model->get_photo_quiz_detail($rows->quiz_id);
                                $reporter_info= $this->Member_model->get_member($rows->reporter);
                                ?>
                    <tr align="center" class="">
                        <td ><div align="left"><?=$rows->id?></div></td>                        
                        <td> <a href="<?=base_url()?>quiz/view/<?=$rows->quiz_id?>" target="blank"> <?=$quiz_detail->quiz_question?></a> </td>
                        <td> <?=$rows->report_type?> </td>
                        <td> <?=$reporter_info->username?> </td>
                        <td>
                            <a href="<?=site_url(ADMIN_PATH.'/report_quiz_management/delete_quiz_report/'.$rows->quiz_id.'/'.$rows->report_type) ?>" onclick="return doConfirm('quiz_report')">
                                Cancel
                            </a>
                        </td>
                        <td>
                            <a href="<?=site_url(ADMIN_PATH.'/report_quiz_management/delete_quiz/'.$rows->quiz_id) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm('quiz')"  border="0">
                            </a>
                        </td>
                        <td>
                            <?php $block_ip = $this->Ip_block_model->check_blocked_ip($quiz_detail->ip_address);
                                if($block_ip){ ?>
                            <a href="javascript:void();" onclick="unblock_ip('<?=$quiz_detail->ip_address?>')">Unblock</a>
                            <? } else {?>
                            <a href="javascript:void();" onclick="block_ip('<?=$quiz_detail->ip_address?>')">Block</a>
                            <? } ?>
                        </td>
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

    function doConfirm(quiz)
    {
        if(quiz=='quiz')
            msg=confirm("Are you sure you want to delete this Quiz Permanently?");
        else
            msg=confirm("Are you sure you want to delete this Quiz Report Permanently?");
        if(msg!=true)
        {
            return false;
        }
    }

</script>	
