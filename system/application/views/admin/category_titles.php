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
</SCRIPT> 

<h2 class="headingclass" >Categories Details</h2>
<br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/admin')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/categories')?>"> Category Management </a></span></td>
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
        <td><strong>[ <b><a href="#" onclick="unhide_form()">Add Category Titles</a></b> ]</strong></td>
        <td><strong>[ <b><a href="<?=site_url(ADMIN_PATH.'/categories/getCategoryTitles')?>" >View Category Titles</a></b> ]</strong></td>
    </tr>
</table>
<br />
<div id="category_form" style="display:none">
    <table>
        <form name="add_category_form" action="<?=site_url(ADMIN_PATH.'/categories/add_category_titles')?>" method="post" enctype="multipart/form-data">
            <tr>
                <td height="36"><strong> Category Title : </strong>&nbsp;&nbsp; </td>
                <td>
                    <input type="text" name="category_title" value="" size="30" maxlength="60">
                    <input type="hidden" name="parent_id" value="<?=$cat_id?>"/>
                </td>
            </tr>

            <tr>
                <td height="36"><strong> Points : </strong>&nbsp;&nbsp; </td>
                <td>
                    <input type="text" name="points" > (format:0-99)
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
        <td><strong><b><?= anchor(site_url(ADMIN_PATH.'/categories'),'Home')?></b></strong></td>
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
        <th width="471" align="center"> <a href="<?=site_url(ADMIN_PATH.'/categories/getCategoryTitles/category_title/'.$sort)?>" style="color:#FFFFFF">Category Title</a></th>
        <th width="111" align="center"><a href="<?=site_url(ADMIN_PATH.'/categories/getCategoryTitles/points/'.$sort)?>" style="color:#FFFFFF">Points</a></th>
        

        <th width="51" align="center"> Edit </th>
        <th width="66" align="center"> Delete </th>
        <?php if(count($category_titles)!=0) {
            $j=1;
            foreach($category_titles as $rows) {?>
    <tr>

        <td align="left"><?php echo  $j; ?></td>
        <td align="left"><?php echo $rows->category_title;?></td>

        <td align="left"><?php  echo $rows->points; ?></td>
        
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/categories/editCategoryTitles/'.$rows->id) ?>">
                <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
        <td align="left"><a href="<?=site_url(ADMIN_PATH.'/categories/deleteCategoryTitles/'.$rows->id) ?>">
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