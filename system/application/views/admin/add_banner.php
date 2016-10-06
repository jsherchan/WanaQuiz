<script type="text/javascript">
function select_subcategory(id){
    
    $.post("<?=base_url().ADMIN_PATH ?>/banner_management/get_category_questions", {cid:id}, function(data){
       if(data!=null && data!='' && data!=undefined){
           $('#questions').html(data);
       }
       //alert(data);
    });
}
</script>

<h2 class="headingclass" >Banner Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/banner_management')?>"> Banner Management</a> >> Add Banner
            </span></td>
        <td><a href=""><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href=""><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<hr />
<table width="100%"  border="0">
    <tr>
        <td width="17%" >[ <a href="<?=site_url(ADMIN_PATH.'/banner_management')?>"><strong> VIEW BANNER LIST </strong></a>]</td>
        <td width="59%" height="35">&nbsp;</td>
        <td width="24%" valign="top">&nbsp;</td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <td colspan="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="4" >
            <tr>
                <td>
                </td>
            </tr>

        </table>

        <form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/banner_management/insert_banner/')?>" onSubmit="return submitForm('');" >
            <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                <tr>
                    <td align="center" valign="top" bgcolor="#FFFFFF">
                        <table width="95%" border="0" cellspacing="1" cellpadding="4" >
                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Banner Name<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <input name="banner_name" type="text" class="comment" value="" size="50"></td>
                            </tr>
                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Category<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <select name="category">
                                        <option value="1" />Select Category</option>
                                        <?php foreach($category as $categories) { ?>
                                        <option value="<?=$categories->id?>" onclick="select_subcategory(<?=$categories->id?>)"/><?=$categories->name?></option>
                                        <?} ?>

                                    </select>

                                </td>
                            </tr>

                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Questions<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                   <div class="select_wrap" >
                                       <div name="questions" class="select_field" id="questions" style="overflow:auto; height:150px; width:250px; border:1px solid">
                                            <label value="1" >Select Questions</label>
                                                                                        
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle" class="title_content_block">
                                    <span class="cat_block1">Image</span><span class="style1">*</span>
                                </td>
                                <td align="left" valign="middle" class="title_content_block">
                                    <input name="banner" type="file" id="banner"  size="30" maxlength="30"><br />
			(Please make sure width=158px  to display correctly in front end)</td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">URL<span class="style1">*</span></td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input name="url" id="url"  type="text" class="comment" value="" size="35"><br />
			(Please enter full URL like: http://www.hotmail.com)

                                </td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">Width<span class="style1">*</span></td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input name="width" id="width"  type="text" class="comment" value="" size="35"><br />
                                </td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">Height<span class="style1">*</span></td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input name="height" id="height"  type="text" class="comment" value="" size="35"><br />
                                </td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">CPC<span class="style1">*</span></td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input name="cpc" id="cpc"  type="text" class="comment" value="" size="35"><br />


                                </td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="title_content_block">Status<span class="style1">*</span></td>
                                <td align="left" valign="middle" class="title_content_block">

                                    <input type="radio" name="active" value="0" >Deactive <input type="radio" name="active" value="1" />Activate</td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle" class="cat_block1">Image</td>
                                <td align="left" valign="middle" class="cat_block1"><img src="" /></td>
                            </tr>

                            <tr align="center">
                                <td align="right" class="cat_block1">&nbsp; </td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input type="submit" name="Submit" value="Submit" class="bttn"  style="width:70px">
                                    <input type="hidden" name="prev_img" value="" />
                                    <input type="hidden" name="prev_img_spanish" value="" />
                                    <input name="action" type="hidden"  value="">
                                    <input type="hidden" name="bannerId" value="" />
                                    <input type="hidden" name="org_src" value="" />			   </td>
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
