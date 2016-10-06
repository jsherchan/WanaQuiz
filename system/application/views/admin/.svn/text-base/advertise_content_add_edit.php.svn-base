<h2 class="headingclass" >Content Management</h2>
<script type="text/javascript" src="<?= base_url()?>tiny_mice/tiny_mce.js"></script>

<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>
<script type="text/javascript"  src="<?= base_url()?>tiny_mice/plugins/tinybrowser/tb_tinymce.js.php"></script>

<br>

<!--<link href="../css/style.css" rel="stylesheet" type="text/css">-->
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="">ADMIN</a>
                >>Advertise content management</span></td>
        <td class="blue_bold"><a href="<?=site_url(ADMIN_PATH.'/admin')?>"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="<?=site_url(ADMIN_PATH.'/admin')?>">BACK</a></td>
    </tr>
</table>


<table width="99%">
    <tr><td width="100%" align="left">
            <?php if($this->session->flashdata('message')) {
                echo "<div class='message'>".$this->session->flashdata('message')."</div>";
            }
            ?>
        </td></tr></table>

<?php if(isset($add)){
    $this->db->from('tbl_advertise_content_questions');
    $this->db->order_by("id", "asc");
    $query = $this->db->get();
    $last_row = $query->last_row('array');
    //echo '<pre>';print_r($last_row);
    $last_id = $last_row['id'];
}

?>

<table align=left cellpadding=2 cellspacing=0 width=99% border="0" class="light">
    <form action="<?php if(!isset($add)) echo site_url(ADMIN_PATH.'/advertise_content_management/edit/'); else echo site_url(ADMIN_PATH.'/advertise_content_management/add/');?>" method="Post" name="form">
        <tr>
            <td width="660"><strong>Quiz Id</strong></td>
        </tr>

        <tr>
            <td><input size="50" class="inputtext" type="text" readonly id="question" name="question" value="<?php if(!isset($add)) echo $content_questions_info->id; else echo $last_id+1;?>"></td>
        </tr>
        <tr>
            <td width="660"><strong>Question</strong></td>
        </tr>

        <tr>
            <td><input size="50" class="inputtext" type="text" id="question" name="question" value="<?php if(!isset($add)) echo $content_questions_info->question;?>"></td>
        </tr>


        <tr>
            <td><strong>Answer</strong></td>
        </tr>

        <tr>
            <td>

                <textarea name="answer" id="answer" cols="70" rows="20"><?php if(!isset($add)) echo stripslashes($content_questions_info->answer);?></textarea>
            </td>
        </tr>

        <tr>
            <td width="660"><strong>Url Link</strong></td>
        </tr>

        <tr>
            <td>
                <input size="50" class="inputtext" type="text" id="url" name="url" value="<?php if(!isset($add)) echo $content_questions_info->url_link;?>">
                ( Add quiz_id at the last of url. eg. http://sitename/home/advertise/20 )
            </td>
            
        </tr>

        <tr>
            <td width="660"><strong>sort order</strong></td>
        </tr>
        <tr>
            <td>

                <input type="text" name="sort_order" id="sort_order" value="<?php if(!isset($add)) echo stripslashes($content_questions_info->sort_order);?>" />
            </td>
        </tr>

        <tr height=25 valign="middle">
            <td>
                <input type="hidden" name="id" value="<?php if(!isset($add)) echo $content_questions_info->id?>" />
                <input type="submit" value="<?php if(!isset($add)) echo "UPDATE "; else echo "ADD ";?>" class="bttn" onClick="submitForm();">
            </td>
        </tr>
    </form>
</table>

