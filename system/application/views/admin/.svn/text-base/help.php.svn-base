<script type="text/javascript" src="<?= base_url()?>js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/tiny_mce/advance.js"></script>

<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>
<script type="text/javascript"  src="<?= base_url()?>js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php"></script>

<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are you sure you want to delete this category detail Permanently?");
        if(job!=true)
        {
            return false;
        }
    }
    function submitForm()
    {
        var type = jQuery('#CMSType').val();
        //alert(type);
        if(jQuery('#CMSType').val()==''){
            alert('Type field can not be null');
            return false;
        }
        else{ 
            jQuery.post('<?=base_url()?>admin/help_management/checkType', {CMSType:type} , function(data){ 
			 if (data != '' || data != undefined || data != null){
                             if(data=='already_exist'){
                                 alert('Type already exists. Please type some unique value!');
                                 return false;
                             }
                             else
                             document.forms.form.submit();
                         }
        });
        } //return false;
        //document.forms.form.submit();
        //alert(document.searchform.activated.value);
    }

    function submitform_byorder(act_val)
    {
        document.searchform.order_by.value=act_val;
        document.forms.searchform.submit();
        //alert(document.searchform.activated.value);
    }

    function unhide_form()
    {
        document.getElementById('category_form').style.display='block';

    }

//    function check_type(){
//        var type = jQuery('#CMSType').val()
//
//        var ajax = jQuery.post('<?=base_url()?>admin/help_management/checkType', {CMSType:type} , function(data){
//			 if (data != '' || data != undefined || data != null){
//                             if(data=='already_exist'){
//                                 jQuery('#type_error').html('Type already exists. Please type some unique value!');
//                                 jQuery('#button').attr('disabled', true);
//                             }
//                             else{
//                                 jQuery('#type_error').html('');
//                                 jQuery('#button').removeAttr('disabled');
//                             }
//                         }
//        });
//    //ajax.abort();
//    }
</SCRIPT> 

<h2 class="headingclass" >Help Management</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/help_management')?>"> Help Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>

<table>
    <form name="category_search_form" action="<?=site_url(ADMIN_PATH.'/categories/search')?>" method="post">
        <tr>
            <td height="36"><strong>Search Category or Sub-Category By Name : </strong>&nbsp;&nbsp; </td>
            <td> <input type="text" name="search_category" value="" size="30" maxlength="60">

            </td>
            <td> <input type="Submit" name="search" value="Search" class="bttn">  </td>
        </tr>
    </form>
</table>
<br />
<table width="550" cellpadding="1">
    <tr>
        <td><strong>[ <b><a href="#" onclick="unhide_form()">Add <?php if($cat_id!=0) echo "Sub";?> Help</a></b> ]</strong></td>
        <!--<td><strong>[ <b><a href="<?=site_url(ADMIN_PATH.'/categories/getCategoryTitles')?>" >View Help Titles</a></b> ]</strong></td>-->
    </tr>
</table>
<br />
<div id="category_form" style="display:none">
    <table>
        <form action="<?php echo site_url(ADMIN_PATH.'/help_management/insert_help/');?>" method="Post" name="form" enctype="multipart/form-data">
            <tr>
                <td width="660"><strong>HEADING</strong></td>
            </tr>
            <input type="hidden" name="parent_id" value="<?=$cat_id?>"/>
            <tr>
                <td><input size="50" class="inputtext" type="text" id="CMSTitle" name="CMSTitle" value="<?php if(!isset($add)) echo $CMSTitle;?>"></td>
            </tr>

            <tr>
                <td width="660"><strong>Meta Descriptions</strong></td>
            </tr>

            <tr>
                <td><input size="50" class="inputtext" type="text" id="CMSMeta_desc" name="CMSMeta_desc" value="<?php if(!isset($add)) echo $CMSMeta_desc;?>"></td>
            </tr>

            <tr>
                <td width="660"><strong>Meta Keywords</strong></td>
            </tr>

            <tr>
                <td><input size="50" class="inputtext" type="text" id="CMSMeta_keywords" name="CMSMeta_keywords" value="<?php if(!isset($add)) echo $CMSMeta_keywords;?>"></td>
            </tr>


            <tr>
                <td width="660"><strong>Help Page Name</strong></td>
            </tr>

            <tr>
                <td><input size="50"   class="inputtext" type="text" id="CMSType" name="CMSType" value="<?php if(!isset($add)) echo $CMSType;?>">* Please type small characters and if more than two words separated by (_) eg.member_page</td>
                <td style=" color:red" id="type_error"></td>
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
                <td><input size="50" class="inputtext" type="text" id="CMSUrl" name="CMSUrl" value="<?php if(!isset($add)) echo $CMSUrl; else echo base_url();?>">* </td>
                
            </tr>

            <tr>
                <td width="660"><strong>Sort Order</strong></td>
            </tr>

            <tr>
                <td><input size="20" class="inputtext" type="text" id="order" name="sort_order" >* </td>

            </tr>

            <tr>
                <td width="660"><strong>Enable</strong></td>
            </tr>

            <tr><td>
                    <select name="status">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></td>
            </tr>

            <tr>
                <td><strong>CONTENT</strong></td>
            </tr>

            <tr>
                <td>

                    <textarea name="CMSDetails" id="CMSDetails" cols="70" rows="20"><?php if(!isset($add)) echo stripslashes($CMSDetail);?></textarea>
                </td>
            </tr>

            <tr height=25 valign="middle">
                <td><input type="button" value="Add" class="bttn" onClick="submitForm();" id="button">
                </td>
            </tr>
        </form>
    </table>
</div>


<br />
<table width="550" cellpadding="1">
    <tr>
        <td><strong><b><?= anchor(site_url(ADMIN_PATH.'/help_management'),'Home')?><?php if($cat_id!=0) echo "->".$breadcrumb?></b></strong></td>
    </tr>
</table>
<br />

<?php if($this->session->flashdata('message')) {
    echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="230" align="center"> <a href="<?=site_url(ADMIN_PATH.'/help_management/help_management_list/'.$cat_id.'/CMSTitle/'.$sort)?>" style="color:#FFFFFF">  <?php if($cat_id!=0) echo "Sub";?> Help </a></th>
        
        <!--<th width="351" align="center"><a href="<?=site_url(ADMIN_PATH.'/help_management/help_management_list/'.$cat_id.'/sort_order/'.$sort)?>" style="color:#FFFFFF">Url</a></th>-->
        <th width="58" align="center"><a href="<?=site_url(ADMIN_PATH.'/help_management/help_management_list/'.$cat_id.'/flag/'.$sort)?>" style="color:#FFFFFF">Status</a></th>
        <th width="58" align="center"><a href="<?=site_url(ADMIN_PATH.'/help_management/help_management_list/'.$cat_id.'/sort_order/'.$sort)?>" style="color:#FFFFFF">Sort Order</a></th>
        <th width="51" align="center"> Edit </th>
        <th width="66" align="center"> Delete </th>
        <?php
        //print_r($help_list);
        //echo $cat_level;
        if(count($help_list)!=0) {
            $j=1;
            foreach($help_list as $rows) {?>
    <tr>

        <td align="left"><?php echo  $j; ?></td>
        <td align="left"><?php
                    if($cat_level!=2) echo  anchor(site_url(ADMIN_PATH.'/help_management/help_management_list/'.$rows->id),$rows->CMSTitle);
                    else
                        echo $rows->CMSTitle;?></td>

        <!--<td align="left"><?php  echo $url; ?></td>-->
        <!--<td align="left">
                <?
                echo $rows->sort_order;
                ?>
        </td>-->
        <td align="left">
                    <?
                    if($rows->flag==1) {
                        echo 'Enabled';
                    }
                    else if($rows->flag==0) {
                            echo 'Disabled';
                        }
                    ?>
        </td>
        <td align="left">
                <?
                echo $rows->sort_order;
                ?>
        </td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/help_management/edit_help_management/'.$rows->id) ?>">
                <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/help_management/delete_help_management/'.$rows->id) ?>">
                <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a>
        </td>
    </tr>
            <?php  $j++;}

    } else { ?>
    <tr>
        <td colspan="9" align="center">Sorry No Records Found</td>
    </tr>
    <?php }?>
</table>
<br />
<div align='left'>


</div>

<br />