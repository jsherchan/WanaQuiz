<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu-v.css" />
<script type="text/javascript">
    ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
<div class="leftside">
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="greentitlebg_leftborder"></div>
                <div class="greentitlebg_bg" style="width:178px;">
                    <div class="bold font14 color_white">Help Center</div>
                </div>
                <div class="greentitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div class="help_links">
                    <div id="smoothmenu2" class="ddsmoothmenu-v">
                        <ul>
                            <li>
                                <a href="<?=base_url()?>home/help_center">Help Center</a>
                            </li>
                            <?php if($all_help_list) {
                                foreach($all_help_list as $row) {?>
                                    <li>
                                        <a href="<?=base_url()?>home/show/<?=$row->CMSType?>" class=""><?=$row->CMSTitle?></a>
                                        
                                        <?php $sub_help_list = $this->Help_management_model->get_all_helps($row->id);
                                       
                                            if($sub_help_list) {
                                                ?>
                                        <ul>
                                            <?php    foreach($sub_help_list as $sub_row) {
                                                    ?>
                                       
                                            <li>
                                                <a href="<?=base_url()?>home/show/<?=$sub_row->CMSType?>" class=""><?=$sub_row->CMSTitle?></a>
                                                
                                                    <?php $sub_sub_help_list = $this->Help_management_model->get_all_helps($sub_row->id);
                                                    if($sub_sub_help_list) { ?>
                                                <ul>
                                                    <?php    foreach($sub_sub_help_list as $sub_sub_row) {
                                                            ?>
                                                    <li>
                                                        <a href="<?=base_url()?>home/show/<?=$sub_sub_row->CMSType?>" class=""><?=$sub_sub_row->CMSTitle?></a>
                                                    </li>
                                                        <? }?>
                                                    </ul>
                                                <?}?>
                                                
                                            </li>
                                            
                                            <? }?>
                                            </ul>
                                        <?} ?>
                                        
                                    </li>
                                <? }}?>

                        </ul>
                        <div class="borderbottom_dotted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
</div>