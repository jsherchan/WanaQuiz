<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>

<h2 class="headingclass" >Media Comment Management</h2>

<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Do you want to delete this Quiz permanently?");
        if(job!=true)
        {
            return false;
        }
    }

    function checkAll()
    {
        for (var i=0;i<document.forms[0].elements.length;i++)
        {
            var e=document.forms[0].elements[i];
            if ((e.name != 'allbox') && (e.type=='checkbox'))
            {
                e.checked=document.forms[0].allbox.checked;
            }
        }
    }

    function checkfill()
    {
        var count=0;
        if(document.frm.newsl_id.value=='')
        {
            alert('Please Select the newsletter');
            document.frm.newsl_id.focus();
            return false;
        }

    }

    function active_quiz(id)
    {
        jQuery.post('<?=base_url()?>quiz/activeQuiz', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='success')
                {
                    alert('Successfully activated');
                    location.reload();
                }
                else alert('error');

            }
        });

    }

    function deactive_quiz(id)
    {
        jQuery.post('<?=base_url()?>quiz/deactiveQuiz', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='success')
                {
                    alert('Successfully deactivated' );
                    location.reload();
                }
                else alert('error');

            }
        });

    }

    function feature_quiz(id,status,budget_status)
    {
        if(budget_status == 0){
            alert("This user doesn't has sufficient budget!");
            return flase;
        }
        jQuery.post('<?=base_url()?>quiz/featureQuiz', {quiz_id:id,status:status} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='success')
                {
                    alert('Successfully activated');
                    location.reload();
                }
                else alert('error');

            }
        });

    }

    function load_question_video(id){
        jQuery('#question_video_'+id).show();
        jQuery('#video_image_'+id).hide();
    }

    function load_answer_video(id){
        jQuery('#answer_video_'+id).show();
        jQuery('#answer_video_image_'+id).hide();
    }

    function try_new_quiz(id,status,budget_status)
    {
        if(budget_status == 0){
            alert("This user doesn't has sufficient budget!");
            return flase;
        }
        jQuery.post('<?=base_url()?>quiz/tryNewQuiz', {quiz_id:id,status:status} , function(data){
            if (data != '' || data != undefined || data != null)
            {

                if(data=='success')
                {
                    alert('Successfully activated' );
                    location.reload();
                }
                else alert('error');

            }
        });

    }

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
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a>
                >> Media Comment Management </span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <td>

                        <form name="searchform" action="<?= site_url(ADMIN_PATH.'/members/quizSearch/')?>" method="post">
                            <div>
                                <label for="function_name"><strong>Search Members By Quiz Id, Quiz Question or Quiz Creator : </strong></label>&nbsp;&nbsp;
                                <input type="text" name="search_quiz" id="search_quiz" size="30" maxlength="60">
                                <input type="hidden" name="search_type" value="<?=$flag?>">
                                <input type="submit" value="search" id="search_button" />

                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <br />
    <tr>
        <td>
            <table width="98%" cellpadding="1">
                <tr>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management')?>" style="color:#003399"> Quiz Image Management </a> ]</strong></td>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getQuizVideos')?>" style="color:#003399"> Quiz Video Management </a> ]</strong></td>

                </tr>
                <tr>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getFeaturedImageQuizes')?>" style="color:#003399"> View Featured Questions </a> ]</strong></td>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getTryNewImageQuizes')?>" style="color:#003399"> View Try Something New Questions</a> ]</strong></td>
                </tr>
                <tr>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getQuizComments')?>" style="color:#003399"> Quiz Comment Management </a> ]</strong></td>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getProfileImages')?>" style="color:#003399"> Profile Comment Management </a> ]</strong></td>
                    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getProfileImages')?>" style="color:#003399"> Profile Image Management </a> ]</strong></td>

                </tr>

            </table>
        </td>
    </tr>
</table>

<br>
<?php if($this->session->flashdata('message')) {
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="13%" align="left">
            <div align="center">No.</div>
        </th>
        <th width="13%" align="left">
            <div align="left"><b> Quiz_id </b> </div>
        </th>
        <th width="13%" align="left">
            <div align="left"><b> Question </b> </div>
        </th>
        <th width="13%" align="left">
            <div align="left"><b> Created By </b> </div>
        </th>
        <th width="13%" align="left">
            <div align="left">
                <b><?php if($flag=='quiz_image') { ?>Quiz Question Images <?php } else { ?> Quiz Question Videos <? } ?> </b>
            </div>
        </th>

        <th width="50%" align="left"><div align="center"><b><?php if($flag=='quiz_image') { ?>Quiz Answer Images<?php } else { ?>Quiz Answer Videos<? }?></b></div></th>
        <th width="11%" align="left"><div align="center"><b>Status</b></th>
        <th width="11%" align="left"><div align="center"><b>Featured Question?</b></th>
        <th width="11%" align="left"><div align="center"><b>Try Something new?</b></th>
        <th width="11%" align="left"><div align="center"><b>Delete</b></div></th>
        <th width="11%" align="left"><div align="center"><b>Block Ip</b></div></th>
    </tr>
    <? //print_r($quiz_images);
    $i=$offset+1;
    // if($flag == 'quiz_image')
    if($quiz_images)
        $data = $quiz_images;

    else $data = $quiz_videos;
    if(count($data)>0) {
        foreach($data as $rows) {
            $user_type = $rows->user_type;
            if($user_type == 'advertiser') {
                $quiz_budget_info = $this->Quiz_model->get_user_quiz_budget($rows->user_id);
                $budget_status = $quiz_budget_info->budget_status;
            }
            else $budget_status = '1';
            ?>

    <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left">
            <a href="<?=base_url()?>quiz/view/<?=$rows->quiz_id?>" target="_blank"> <?=$rows->quiz_id?> </a>
        </td>
        <td align="left">
            <a href="<?=base_url()?>quiz/view/<?=$rows->quiz_id?>" target="_blank"> <?=$rows->quiz_question?> </a>
        </td>
        <td align="left">
                    <?php $user = $this->Member_model->get_member_username($rows->user_id);?>
            <a href="<?=base_url()?><?=$user->username?>">
                        <?php echo $user->username;?>
            </a>
        </td>

        <td align="left">
            <div align="left" style="position:relative">
                        <? if($flag=='quiz_image') {?>
                <img src="<?=base_url()?><?=PHOTO_QUESTION_THUMB.'/'.$rows->images?> " alt="<?=$rows->images?>" />
                        <? } else {?>
                            <? $video=explode('.',$rows->quiz_videos);
                            if($_SERVER['SERVER_NAME']=='localhost')
                                $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/".VIDEO_QUESTION_THUMB."/".$video[0].".jpg";
                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/".VIDEO_QUESTION_THUMB."/".$video[0].".jpg";
                            else $a = $_SERVER['DOCUMENT_ROOT']."/".VIDEO_QUESTION_THUMB."/".$video[0].".jpg";
                            ?>
                <a href="javascript:void(0);" onclick="load_question_video('<?=$rows->quiz_id?>')" id="video_image_<?=$rows->quiz_id?>">
                                <?php if(file_exists($a)) { ?>
                    <img src="<?=base_url()?><?=IMAGES?>/play_ico.png" alt="play.jpg" style="position:absolute; top:35px; left:35px" />
                    <img src="<?=base_url()?><?=VIDEO_QUESTION_THUMB.'/'.$video[0]?>.jpg " alt="<?=$video[0]?>.jpg>" />
                                <?php } else { ?>
                    <img src="<?=base_url()?><?php echo IMAGES?>/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                <? } ?>
                </a>
                <div id="question_video_<?=$rows->quiz_id?>" style="display:none">
                    <a href="<?=base_url()?><?=UPLOADED_VIDEO_QUESTIONS.'/'.$video[0]?>.flv" style="display:block;width:180px;height:135px" id="player_<?=$rows->quiz_id?>"></a>
                    <script>
                        flowplayer("player_<?=$rows->quiz_id?>", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                            clip: {
                                // these two configuration variables does the trick
                                autoPlay: true,
                                autoBuffering: true // <- do not place a comma here
                            }
                        });
                    </script>
                </div>
                        <? } ?>
            </div>
        </td>

        <td align="center" >
            <div style="position:relative">
                        <? if($flag=='quiz_image') {
                            $image=base64_encode(PHOTO_QUESTION_THUMB.'/'.$rows->photo_name);
                            ?>
                 <img src="<?=base_url()?><?=PHOTO_QUESTION_THUMB.'/'.$rows->photo_name?> " alt="<?=$rows->photo_name?>" />
                          <? } else {?>
                            <? $video1=explode('.',$rows->video_answer);
                            if($_SERVER['SERVER_NAME']=='localhost')
                                $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/".VIDEO_QUESTION_THUMB."/".$video1[0].".jpg";
                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/".VIDEO_QUESTION_THUMB."/".$video1[0].".jpg";
                            else $a = $_SERVER['DOCUMENT_ROOT']."/".VIDEO_QUESTION_THUMB."/".$video1[0].".jpg";
                            ?>
                <a href="javascript:void(0);" onclick="load_answer_video('<?=$rows->quiz_id?>')" id="answer_video_image_<?=$rows->quiz_id?>">
                                <?php if(file_exists($a)) { ?>
                    <img src="<?=base_url()?><?=IMAGES?>/play_ico.png" alt="play.jpg" style="position:absolute; top:40px; left:70px" />
                    <img src="<?=base_url()?><?=VIDEO_QUESTION_THUMB.'/'.$video1[0]?>.jpg " alt="<?=$video1[0]?>.jpg>" />
                                <?php } else { ?>
                    <img src="<?=base_url()?><?php echo IMAGES?>/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                <? } ?>
                </a>
                <div id="answer_video_<?=$rows->quiz_id?>" style="display:none">
                    <a href="<?=base_url()?><?=UPLOADED_VIDEO_ANSWERS.'/'.$video1[0]?>.flv" style="display:block;width:180px;height:135px" id="player1_<?=$rows->quiz_id?>"></a>
                    <script>
                        flowplayer("player1_<?=$rows->quiz_id?>", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                            clip: {
                                // these two configuration variables does the trick
                                autoPlay: true,
                                autoBuffering: true // <- do not place a comma here
                            }
                        });
                    </script>
                </div>
                        <? } ?>
            </div>
        </td>
        <td>
                    <?php if($rows->status==0) { ?><a href="javascript:void(0)" onclick="active_quiz('<?=$rows->quiz_id?>')">Active</a><? } else {?> <b style="color:#79B800">Active</b><? }?>
            <br><br>
                    <?php if($rows->status==1) { ?><a href="javascript:void(0)" onclick="deactive_quiz('<?=$rows->quiz_id?>')">Inactive</a><? } else {?> <b style="color:#79B800">Inactive</b><? }?>
        </td>
        <td>
                    <?php if($rows->featured_quiz==0) { ?><a href="javascript:void(0)" onclick="feature_quiz('<?=$rows->quiz_id?>','yes',<?=$budget_status?>)">Active</a><? } else {?> <b style="color:#79B800">Active</b><? }?>
            <br><br>
                    <?php if($rows->featured_quiz==1) { ?><a href="javascript:void(0)" onclick="feature_quiz('<?=$rows->quiz_id?>','no',<?=$budget_status?>)">Inactive</a><? } else {?> <b style="color:#79B800">Inactive</b><? }?>
        </td>
        <td>
                    <?php if($rows->try_new_quiz==0) { ?><a href="javascript:void(0)" onclick="try_new_quiz('<?=$rows->quiz_id?>','yes',<?=$budget_status?>)">Active</a><? } else {?> <b style="color:#79B800">Active</b><? }?>
            <br><br>
                    <?php if($rows->try_new_quiz==1) { ?><a href="javascript:void(0)" onclick="try_new_quiz('<?=$rows->quiz_id?>','no',<?=$budget_status?>)">Inactive</a><? } else {?> <b style="color:#79B800">Inactive</b><? }?>
        </td>
        <td align="center">
            <? if($flag=='quiz_image') {?>
            <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuiz/'.$rows->quiz_id.'/'.$rows->images.'/'.$rows->photo_name.'/'.$rows->user_id)?>"> <img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>
            <? } else {?>
            <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuizVideo/'.$rows->quiz_id.'/'.$video[0].".flv".'/'.$video1[0].".flv")?>">  <img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /></a>
            <? } ?>
           
        </td>
        <td>
            <?php $block_ip = $this->Ip_block_model->check_blocked_ip($rows->ip_address);
                if($block_ip){ ?>
            <a href="javascript:void();" onclick="unblock_ip('<?=$rows->ip_address?>')">Unblock</a>
            <? } else {?>
            <a href="javascript:void();" onclick="block_ip('<?=$rows->ip_address?>')">Block</a>
            <? } ?>
        </td>
    </tr>

            <? $i++;} } else {?>
    <tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
    <? } ?>

</table>
<div><?=$pagination?></div>
<p>