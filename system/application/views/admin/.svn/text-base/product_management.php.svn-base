<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are you sure you want to delete this member detail Permanently?");
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


</SCRIPT> 
<script type="text/javascript">
    //<![CDATA[
    base_url = '<?= base_url();?>index.php/';
    //]]>
</script>
<script type="text/javascript" src="<?= base_url()?>js/function_search.js"></script>

<h2 class="headingclass" >View Product Detail </h2>
<br>
<table width="800" cellpadding="1">

</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/product_management')?>"> Product Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<br />
<table width="800" cellpadding="1">
    <tr>
        <td> <strong>[ <a href="<?=site_url(ADMIN_PATH.'/product_management/add_product')?>">Add Products </a>]</strong></td>

        <td ><strong>[Product List]</strong></td>
    </tr>
</table>

<p><?php if($this->session->flashdata('message')) {
        echo "<div class='message'>".$this->session->flashdata('message')."</div>";
    }
    ?>
<div id="member_description" style="display:none;">
    <p>Enter your function above</p>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="96" align="left">  S No.</th>
        <th width="178" align="left"> Product Name </th>
        <th width="119" align="left"> Category </th>
        <th width="119" align="left"> Product Description</th>
        <th width="72" align="center"> Edit </th>
        <th width="88" align="center"> Delete </th>
        <?php if(count($product_list)!=0) {
            foreach($product_list as $rows) {
            $category_info = $this->Category_model->get_category_by_id($rows->category_id);
            ?>

    <tr>

        <td align="left"><?php echo  $rows->id;?></td>
        <td align="left"><?php echo $rows->product_name;?></td>
        <td align="left"><?php echo $category_info->name;?></td>
        <td width="119" align="left">  <?php echo $rows->product_description;?></td>
        <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/product_management/edit_product/<?php echo $rows->id; ?>" >
                <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
        <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/product_management/delete_product/<?php echo $rows->id; ?>">
                <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a>
        </td>
    </tr>
        <?php  }?>

    <?php } else { ?>
    <tr>
        <td colspan="6" align="center">Sorry No Records Found</td>
    </tr>
	
    <?php }?>
    
</table>
<table>
    <tr><?php echo $this->pagination->create_links();?></tr>
</table>
