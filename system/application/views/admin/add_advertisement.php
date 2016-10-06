<script type="text/javascript">
    function adsense(){ //alert(jQuery('#adv_type').val());
        if(jQuery('#adv_type').val() == 'adsense'){
            jQuery('#url_link').html('');
            jQuery('#banner_id').html('');
        }

        else {
            jQuery('#url_link').html('<td align="right" valign="middle" class="title_content_block">\n\
                                    <span class="cat_block1">Advertisement Link URL</span>\n\
                                 </td> <td align="left" valign="middle" class="title_content_block">\n\
                                 <input name="link_url" type="input" id="link_url"  size="45" value ="<?php if($link_url !='') echo $link_url; ?>"><br />');

             jQuery('#banner_id').html('<td align="right" valign="middle" class="title_content_block">\n\
        <span class="cat_block1">Advertisement Banner if any</span><span class="style1">*</span>\n\
    </td> <td align="left" valign="middle" class="title_content_block">\n\
    <input name="adv_banner" type="file" id="adv_banner"  size="30" maxlength="30"><br />\n\
    (Please make sure width=158px  to display correctly in front end)</td>');
            }
      }

      function select_dimension(){
          if(jQuery('#adv_dimension').val()=='vertical')
              jQuery('.no_vertical').hide();
          else jQuery('.no_vertical').show();
      }

    function position(){ //alert(jQuery('#adv_type').val());
        if(jQuery('#category').val() != ''){
            jQuery('#position').html('');

        }

        else {
            jQuery('#position').html('<td width="25%" align="right" valign="middle" class="cat_block1">Advertisement Position\n\
                                            <span class="style1">*</span>\n\
                                      </td>\n\
                                      <td width="75%" align="left" valign="middle" class="cat_block1">\n\
                                            <select name="adv_position">\n\
                                                    <option value="home" <?php if($adv_position!='' && $adv_position == 'home') {?>selected<? } ?>>Home</option>\n\
                                                    <option value="profile" <?php if($adv_position!='' && $adv_position == 'profile') {?>selected<? } ?>>Member Profile</option>\n\
                                                    <option value="search" <?php if($adv_position!='' && $adv_position == 'search') {?>selected<? } ?>>Search Pge</option>\n\
                                            </select>\n\
                                    </td>');

         
        }
    }
</script>
<h2 class="headingclass" >Advertisement Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/advertise_management')?>"> Advertisement Management</a> >> Add Advertises
            </span></td>
        <td><a href=""><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href=""><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<hr />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <td colspan="2">
        <table width="100%" border="0" cellspacing="0" cellpadding="4" >
            <tr>
                <td>
                </td>
            </tr>

        </table>
        <?=$error?>
        <form name="frm_banner" method="post" enctype="multipart/form-data"  action="<?=site_url(ADMIN_PATH.'/advertise_management/insert_advertisement/')?>" >
            <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
                <tr>
                    <td align="center" valign="top" bgcolor="#FFFFFF">
                        <table width="95%" border="0" cellspacing="1" cellpadding="4" >
                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Category Name<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <select id="category" name="cat_id"><!-- onchange="position()">-->
                                        <option value="">Select Category</option>
                                        <?php
                                        if(count($category)>0) {
                                            foreach($category as $categories) {
                                                $subcategory = $this->Category_model->get_sub_categories($categories->id);

                                                ?>

                                        <option value="<?=$categories->id?>" <?php if($cat_id!='' && $cat_id == $categories->id) { ?>selected<?}?>><?=$categories->name?></option>
                                                <?php
                                                if(count($subcategory)>0) {
                                                    foreach($subcategory as $subcategories) {?>
                                                    <option style="" value="<?php echo $subcategories->id; ?>" <?php if($cat_id!='' && $cat_id == $subcategories->id) {  ?>selected<?}?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subcategories->name; ?></option>

                                                    <?}}}}?>
                                    </select>
                            </tr>

                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Advertisement Type<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <select name="adv_type" onchange="adsense()" id="adv_type">
                                        
                                        <option value="personal" <?php if($adv_type!='' && $adv_type == 'personal') {?>selected<? } ?>>Personal</option>
                                        <option value="adsense" <?php if($adv_type!='' && $adv_type == 'adsense') {?>selected<? } ?>>Google Adsense</option>
                                        <option value="affiliate" <?php if($adv_type!='' && $adv_type == 'affiliate') {?>selected<? } ?>>Affiliate</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Advertisement Dimension<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <select name="adv_dimension" id="adv_dimension" onchange="select_dimension()">
                                       
                                        <option value="rectangular" <?php if($adv_dimension!='' && $adv_dimension == 'rectangular') {?>selected<? } ?>>Rectangular</option>
                                        <option value="vertical" <?php if($adv_dimension!='' && $adv_dimension == 'vertical') {?>selected<? } ?>>Vertical</option>

                                    </select>
                                </td>
                            </tr>

                            <tr id="position">
                                <td width="25%" align="right" valign="middle" class="cat_block1">Advertisement Position<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <select name="adv_position">
                                        <option value="profile" <?php if($adv_position!='' && $adv_position == 'profile') {?>selected<? } ?>>Member Profile</option>
                                        <option value="home" <?php if($adv_position!='' && $adv_position == 'home') {?>selected<? } ?> id="home" class="no_vertical">Home</option>
                                        <option value="search" <?php if($adv_position!='' && $adv_position == 'search') {?>selected<? } ?>>Search Page</option>
                                        <option value="quiz_category" <?php if($adv_position!='' && $adv_position == 'quiz_category') {?>selected<? } ?> class="no_vertical">Quiz + Category</option>
                                        <option value="quiz" <?php if($adv_position!='' && $adv_position == 'quiz') {?>selected<? } ?> id="quiz" class="">Quiz</option>
                                        <option value="category" <?php if($adv_position!='' && $adv_position == 'category') {?>selected<? } ?> class="no_vertical">Category</option>

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td width="25%" align="right" valign="middle" class="cat_block1">Advertisement Detail<span class="style1">*</span></td>
                                <td width="75%" align="left" valign="middle" class="cat_block1">
                                    <textarea name="adv_detail" id="adv_detail"  cols="45" rows="5"><?php if($adv_detail !='') echo $adv_detail; ?></textarea>

                                </td>
                            </tr>
                            <tr id="url_link">
                                <td align="right" valign="middle" class="title_content_block"><span class="cat_block1">Advertisement Link URL</span></td>
                                <td align="left" valign="middle" class="title_content_block">
                                    <input name="link_url" type="input" id="link_url"  size="45" value ="<?php if($link_url !='') echo $link_url; ?>"><br />
                                </td>
                            </tr>
                            <tr id="banner_id">
                                <td align="right" valign="middle" class="title_content_block"><span class="cat_block1">Advertisement Banner if any</span><span class="style1">*</span></td>
                                <td align="left" valign="middle" class="title_content_block">
                                    <input name="adv_banner" type="file" id="adv_banner"  size="30" maxlength="30"><br />
			(Please make sure width=158px  to display correctly in front end)</td>
                            </tr>


                            <tr align="center">
                                <td align="right" class="cat_block1">&nbsp; </td>
                                <td align="left" valign="middle" class="cat_block1">
                                    <input type="submit" name="Submit" value="Submit" class="bttn"  style="width:70px" onclick="validate_image()">
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
    </td>
</tr>
</table>



