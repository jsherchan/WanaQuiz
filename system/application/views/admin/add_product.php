<script type="text/javascript">
function select_subcategory(id){
    
    $.post("<?=base_url().ADMIN_PATH ?>/banner_management/get_category_questions", {cid:id}, function(data){
       if(data!=null && data!='' && data!=undefined){
           $('#questions').html(data);
       }
       //alert(data);
    });
}

function get_subcategory(){
    cat_id = jQuery('#category').val();
    jQuery.post("<?=base_url().ADMIN_PATH ?>/product_management/get_subcategories", {cid:cat_id}, function(data){
       if(data!=null && data!='' && data!=undefined){ //alert(data);
           jQuery('#subcategory').html(data);
       }
       //alert(data);
    });
}
</script>

<h2 class="headingclass" >Product Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/product_management')?>"> Product Management</a> >> Add Product
            </span></td>
        <td><a href=""><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href=""><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<hr />
<table width="800" cellpadding="1">
    <tr>
        <td> <strong>[ Add Products ]</strong></td>

        <td ><strong>[<a href="<?=site_url(ADMIN_PATH.'/product_management')?>">Product List</a>]</strong></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="4" >
                <tr>
                    <td>
                    </td>
                </tr>

            </table>

            <form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/product_management/insert_product/')?>" onSubmit="return submitForm('');" >
                <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                    <tr>
                        <td align="center" valign="top" bgcolor="#FFFFFF">
                            <table width="95%" border="0" cellspacing="1" cellpadding="4" >
                                <tr>
                                    <td width="25%" align="right" valign="middle" class="cat_block1">Product Name<span class="style1">*</span></td>
                                    <td width="75%" align="left" valign="middle" class="cat_block1">
                                        <input name="product_name" type="text" class="comment" value="" size="50"></td>
                                </tr>
                                <tr>
                                    <td width="25%" align="right" valign="middle" class="cat_block1">Category<span class="style1">*</span></td>
                                    <td width="75%" align="left" valign="middle" class="cat_block1">
                                        <select name="category" onchange="get_subcategory()" id="category">
                                            <option value="" />Select Category</option>
                                            <?php foreach($category as $categories) { ?>
                                            <option value="<?php echo $categories->id?>" /><?php echo $categories->name?></option>
                                        <? } ?>
                                        </select>

                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" align="right" valign="middle" class="cat_block1">Sub Category<span class="style1">*</span></td>
                                    <td width="75%" align="left" valign="middle" class="cat_block1">
                                        <select name="subcategory" id="subcategory">
                                            <option>Select Sub Category</option>
                                        </select>

                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" align="right" valign="middle" class="cat_block1">Product Description<span class="style1">*</span></td>
                                    <td width="75%" align="left" valign="middle" class="cat_block1">
                                       <div class="select_wrap" >
                                           <textarea id="product_description" name="product_description"></textarea>
                                        </div>

                                    </td>
                                </tr>

                                <tr align="center">
                                    <td align="right" class="cat_block1">&nbsp; </td>
                                    <td align="left" valign="middle" class="cat_block1">
                                        <input type="submit" name="Submit" value="Submit" class="bttn"  style="width:70px">
                                    </td>
                                </tr>
                                <tr align="right">
                                    <td colspan="2" class="err">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
            <br />



        </td>
    </tr>
</table>



<script>
    function submitForm(id)
    {
        if(document.frm_banner.banner_name.value=="")
        {
            alert('Banner Name is Empty.');
            document.frm_banner.banner_name.focus();
            return false;
        }
        if(id==1)
        {
            if(document.frm_banner.picture.value==0)
            {
                alert('Please select Picture for banner.');
                document.frm_banner.picture.focus();
                return false;
            }

            filearr=document.frm_banner.picture.value.split('.');
            filearr.reverse()
            filen=filearr[0];
            if(filen.toUpperCase()!="GIF" && filen.toUpperCase()!="JPG" && filen.toUpperCase()!="JPEG" && filen.toUpperCase()!="PNG")
            {
                alert("Picture should be gif,jpg,jpeg or png.");
                document.frm_banner.picture.focus();
                return false;
            }
        }

        if(document.frm_banner.url.value==0)
        {
            alert('Please enter the URL.');
            document.frm_banner.url.focus();
            return false;
        }

        if(document.frm_banner.active[0].checked==false && document.frm_banner.active[1].checked==false)
        {
            alert('Please select active active.');
            document.frm_banner.active[0].focus();
            return false;
        }
        return true;
    }
</script>
