<script type="text/javascript" src="<?= base_url()?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/tiny_mce/advance.js"></script>

<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>
<script type="text/javascript"  src="<?= base_url()?>js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>
<script language="javascript"  type="text/javascript">
    function formValidation()
    {
        var categoryname=document.getElementById('cat_name');

        if(categoryname.value=='' && categoryname.value==null)
        {
            alert('Enter Category Name');
            categoryname.focus();
            return false;
        }
        /*	if(isNaN(parseFloat(obj.value)))
        {
                alert('Enter only Numeric Value');
                obj.focus();
                return false;
        }*/
        return true;

    }

</script>
<h2 class="headingclass" >Help Management Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="">ADMIN</a> &gt; <a href="">Help Management</a> </span></td>
        <td><a href="javascript:history.back();"><img src="images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<?php //print_r($cat_info);
//echo $cat_info[0]->title;
?>
<form action="<?php echo site_url(ADMIN_PATH.'/help_management/update_help/'.$id);?>" method="Post" name="form" enctype="multipart/form-data">
    <input type="hidden" value="<?=$cat_info[0]->id?>" name="cmsid">
    <table>
    <tr>
        <td width="660"><strong>HEADING</strong></td>
    </tr>

    <tr>
        <td><input size="50" class="inputtext" type="text" id="CMSTitle" name="CMSTitle" value="<?php echo $cat_info[0]->title;?>"></td>
    </tr>

    <tr>
        <td width="660"><strong>Meta Descriptions</strong></td>
    </tr>

    <tr>
        <td><input size="50" class="inputtext" type="text" id="CMSMeta_desc" name="CMSMeta_desc" value="<?php echo $cat_info[0]->meta_desc;?>"></td>
    </tr>

    <tr>
        <td width="660"><strong>Meta Keywords</strong></td>
    </tr>

    <tr>
        <td><input size="50" class="inputtext" type="text" id="CMSMeta_keywords" name="CMSMeta_keywords" value="<?php echo $cat_info[0]->meta_keywords;?>"></td>
    </tr>


    <tr>
        <td width="660"><strong>Help Page Name</strong></td>
    </tr>

    <tr>
        <td><input size="50" class="inputtext" type="text" id="CMSType" name="CMSType" value="<?php echo $cat_info[0]->type;?>">* Please type small characters and if more than two words separated by (_) eg.member_page</td>
    </tr>

    <tr>
        <td><strong><?php if($cat_id!=0) echo "Sub";?> Help image : </strong>&nbsp;&nbsp; </td>
    </tr>

    <tr>
        <td>
            <input type="file" name="category_image" size="30" maxlength="60">
        </td>
    </tr>

    <tr>
        <td width="660"><strong>Url</strong></td>
    </tr>

    <tr>
        <td><input size="50" class="inputtext" type="text" id="CMSType" name="CMSUrl" value="<?php if($cat_info[0]->url !='') echo $cat_info[0]->url; else echo base_url();?>">* </td>
    </tr>

    <tr>
        <td width="660"><strong>Sort Order</strong></td>
    </tr>

    <tr>
        <td><input size="20" class="inputtext" type="text" id="sort_order" name="sort_order" value="<?php if($sort_order !='') echo $sort_order; else echo 0?>">* </td>
    </tr>

    <tr>
        <td>
            <select name="status">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
    </tr>

    <tr>
        <td><strong>CONTENT</strong></td>
    </tr>

    <tr>
        <td>

            <textarea name="CMSDetails" id="CMSDetails" cols="70" rows="20"><?php echo stripslashes($cat_info[0]->detail);?></textarea>
        </td>
    </tr>

    <tr height=25 valign="middle">
        <td><input type="submit" value="<?php echo "UPDATE PAGE"; ?>" class="bttn" onClick="submitForm();">
        </td>
    </tr>
    </table>
</form>
