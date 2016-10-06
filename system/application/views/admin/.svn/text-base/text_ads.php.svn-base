<h2 class="headingclass" >Text Ads Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt; <a href="<?=site_url(ADMIN_PATH.'/banner_management')?>">Text Ads  Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
    <tr>
        <td width="20%">
            <strong><a href="<?=site_url(ADMIN_PATH.'/banner_management/textAds')?>" style="color:#003399">[Text Ads]</a></strong>
        </td>

        <td>
            <a href="<?=site_url(ADMIN_PATH.'/banner_management/add_text_ads')?>" style="color:#003399">[Add Text]</a>
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
                        <th width="208"  class="th"><div align="left">Text Name</div></th>
                        <th width="199"  class="th"><div align="center">Category</div></th>
                        <th width="199"  class="th"><div align="center">Question</div></th>
                        <th width="199"  class="th"><div align="center">Content</div></th>
                        <th width="199"  class="th"><div align="center">Url</div></th>
                        <th width="199"  class="th"><div align="center">CPC</div></th>

                        <th width="69" class="th"><div align="center">Edit</div></th>
                        <th width="59" class="th"><div align="center">Delete</div></th>

                        <?php if(count($text_ads_list)>0) {
                            foreach($text_ads_list as $rows) {
                                 $cat_info = $this->Category_model->get_category_by_id($rows->category_id);
                                $quiz_detail= $this->Quiz_model->get_photo_quiz_detail($rows->quiz_id);
                                ?>
                    <tr align="center" class="">
                        <td ><div align="left"><?=$rows->id?></div></td>
                        <td ><div align="left"><?=$rows->text_name?></div></td>
                        <td> <?=$cat_info->name?></td>
                        <td> <?=$quiz_detail->quiz_question?></td>
                        <td> <?=$rows->content?></td>
                        <td> <?=$rows->url?></td>
                        <td> <?=$rows->cpc?></td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/banner_management/edit_text_ads/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Text Ads" border="0">				</a>				</td>
                        <td>

                            <a href="<?=site_url(ADMIN_PATH.'/banner_management/delete_text_ads/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Text Ads" onClick="return doConfirm()"  border="0">				</a>				</td>
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
