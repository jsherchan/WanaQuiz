<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are you sure you want to delete this category detail Permanently?");
        if(job!=true)
        {
            return false;
        }
    }
    function submitform(act_val)
    {
        document.searchform.activated.value=act_val;
        document.forms.searchform.submit();
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
    function search_forum(sc)
    {
                        jQuery.post("<?=site_url(ADMIN_PATH.'/forum/search')?>", {search_category:sc} ,function(data) {
                 alert(data);
                 
                 });
                            
      
    }
   
</SCRIPT> 

<h2 class="headingclass" >Forum Categories Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/forum/forum_categories')?>"> Forum Category Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>

<table>
    <form name="serach_category_form" action="<?=site_url(ADMIN_PATH.'/forum/search')?>" method="post" >
        
        <tr>
            <td height="36"><strong>Search Category or Sub-Category By Name : </strong>&nbsp;&nbsp; </td>
            <td> <input type="text" name="search_category" id="search_category" value="" size="30" maxlength="60">

            </td>
            <td> <input type="Submit" name="search" value="Search" class="bttn">  </td>
        </tr>
    </form> 
</table>
<br />
            <table width="550" cellpadding="1">    
                <tr>

                <td><strong>[ <b><a href="#" onclick="unhide_form()">Add <?php if($cat_id!=0) echo "Sub";?> A Forum Category</a></b> ]</strong></td>        
                </tr>
                </table>
             
<br />
<div id="category_form" style="display:none" > 
    <table>
        <form name="add_category_form" action="<?=site_url(ADMIN_PATH.'/forum/forum_add_category')?>" method="post" enctype="multipart/form-data">
            <tr>
                <td height="36"><strong><?php if($cat_id!=0) echo "Sub";?>Category Name :</strong>&nbsp;&nbsp; </td>
                <td>
                    <input type="text" name="category_name" value="" size="30" maxlength="60">
                    <input type="hidden" name="parent_id" value="<?=$cat_id?>"/>
                </td>
            </tr>
            <!--tr>
                <td height="36"><strong> Sort Order: </strong>&nbsp;&nbsp; </td>
                <td> <input type="text" name="sort_order" value="" size="5" maxlength="5"></td>
            </tr-->

            <tr>
                <td height="36"><strong> Forum Category Status: </strong>&nbsp;&nbsp; </td>
                <td> <Select name="cat_status">
                        <option value="1" >Enabled</option>
                        <option value="0" >Disabled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="Submit" name="add" value="Add" class="bttn">  </td>
            </tr>
        </form>
    </table>
</div>
<br />
<table width="550" cellpadding="1">
    <tr>
        <td><strong><b><?= anchor(site_url(ADMIN_PATH.'/forum/forum_categories'),'Home')?><?php if($cat_id!=0) echo "->".$breadcrumb?></b></strong></td>
    </tr>
</table>

<?php if($this->session->flashdata('category_error')) {
    echo "<div class='message'>".$this->session->flashdata('category_error')."</div>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="55" align="left"> <a href="#" style="color:#FFFFFF"> S.N. </a> </th>
        <th width="471" align="center"> <a href="<?=site_url(ADMIN_PATH.'/forum/forum_categories/'.$cat_id.'/name/'.$sort)?>" style="color:#FFFFFF">  <?php if($cat_id!=0) echo "Sub";?> Category </a></th>        
        <th width="111" align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_categories/'.$cat_id.'/sort_order/'.$sort)?>" style="color:#FFFFFF">Order</a></th>
        <th width="58" align="center"><a href="<?=site_url(ADMIN_PATH.'/forum/forum_categories/'.$cat_id.'/flag/'.$sort)?>" style="color:#FFFFFF">Status</a></th>

        <th width="51" align="center"> Edit </th>
        <th width="66" align="center"> Delete </th>
        <?php if(count($category_list)!=0) 
            {
            $j=1;
            foreach($category_list as $rows) 
                               {?>
    <tr>

        <td align="left"><?php echo  $j; ?></td>
        <td align="left"><?php
                    if($cat_level==0) echo  anchor(site_url(ADMIN_PATH.'/forum/forum_categories/'.$rows->id),$rows->name);
                    else  echo $rows->name;?></td>
        <td align="left">
                    <?
                    echo $rows->sort_order;
                    ?>
        </td>
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
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/forum/edit_forum_category/'.$rows->id) ?>">
                <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/forum/delete/'.$rows->id) ?>">
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