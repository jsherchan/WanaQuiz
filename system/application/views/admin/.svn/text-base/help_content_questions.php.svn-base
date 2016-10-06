<h2 class="headingclass" >CONTENT MANAGEMENT </h2>

<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are You Sure You Want To Delete?");
        if(job!=true)
        {
            return false;
        }
    }
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> >>Content Help Questions</span></td>
        <td width="12%"><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
    </tr>
</table>

<?php if($this->session->flashdata('message')) {
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
?>

<a href="<?=site_url(ADMIN_PATH.'/content_help_question_management/addContentQuestion/')?>">	[ + ADD PAGE]</a>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="12%" align="left"><div align="left">Question ID</div></th>
        <th width="62%" align="left"><div align="left">
                <b> Question Detail</b> </div></th>
        <th width="22%" align="left"><div align="left">
                <b> Url Link</b> </div></th>
        <th width="10%" align="left"><div align="left">Sort Order</div></th>


        <th width="8%" align="left"><div align="center"><b>DELETE</b></div></th>
        <th width="8%" align="left"><div align="center"><b>Edit</b></div></th>
        <?
        if(count($contentquestion_list)!=0) {
            foreach($contentquestion_list as $rows) {
                ?>
    </tr>
    <tr>
        <td align="left"><?php echo $rows->id; ?></td>
        <td align="left"> <?php echo $rows->question;?></td>
        <td align="left"> <a href="<?=$rows->url_link?>" target="_blank"><?php echo $rows->url_link;?></a></td>
        <td align="left"><?php echo $rows->sort_order;?></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/content_help_question_management/deleteQuestion/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Content" onclick="return doconfirm()"></a></td>
        <td align="center"><a href="<?=site_url(ADMIN_PATH.'/content_help_question_management/editContentQuestion/'.$rows->id)?>"><img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit Content"></a></td>
    </tr>

        <? } } else { ?>
    <tr><td colspan="5" align="center">::No Records were found::	  </td></tr>
    <? } ?>
</table>

<p>