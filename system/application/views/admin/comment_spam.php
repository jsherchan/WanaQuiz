<h2 class="headingclass" >Comment Spam Management</h2>

<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are You Sure To Delete This user Permanently?");
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


</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a>
                >> Comment Spam Management </span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
    </tr>
    <tr>
        <td>
            <table width="98%" cellpadding="1">
                <tr>
                    <td width="50%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/comment_spam')?>" style="color:#003399"> Quiz Comment Spam </a> ]</strong></td>
                    <td width="50%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/comment_spam/getProfileCommentSpams')?>" style="color:#003399"> Profile Comment Spam </a> ]</strong></td>


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

<table width="87%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="13%" align="left"><div align="center">No.</div></th>
        <th width="13%" align="left"><div align="left">
                <b> <?php if($spam_type=='quiz') { ?>Quiz_id <?php } else { ?>Profile id <? }?></b> </div></th>
        <th width="13%" align="left"><div align="left">
                <b>Commentator id </b> </div></th>

        <th width="50%" align="left"><div align="center"><b>Comment</b></div></th>
        <th width="11%" align="left"><div align="center"><b>delete</b></div></th>
    </tr>
    <?php //print_r($profile_comment_spam);
    //print_r($quiz_comment_spam);
    $i=1;
    if($spam_type == 'profile')
        $data = $profile_comment_spam;
    else $data = $quiz_comment_spam;

    if(count($data)>0) {
        foreach($data as $rows) {
            ?>

    <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"> <?php if($spam_type =='quiz') {?><?=$rows->quiz_id?><? } else {?><?=$rows->user_id?><? }?></td>
        <td align="left">
            <div align="left">
                <b><?php if($spam_type=='quiz') {?><?=$rows->user_id?> <?php } else {?><?=$rows->comentator_id; }?></b>
            </div>
        </td>

        <td align="center"><?=$rows->comment?></td>
        <td align="center">
            <a href="<?=site_url(ADMIN_PATH.'/comment_spam/delete/'.$spam_type.'/'.$rows->comment_id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Comment" onClick="return doconfirm();" /></a>
        </td>
    </tr>

        <? $i++;} } else {?>
    <tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
    <? } ?>
</table>
<p>