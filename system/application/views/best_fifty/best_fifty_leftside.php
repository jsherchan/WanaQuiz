<div class="leftside">
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="greentitlebg_leftborder"></div>
                <div class="greentitlebg_bg" style="width:178px;">
                    <div class="bold font14 color_white">Top 50 Players</div>
                </div>
                <div class="greentitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div class="help_links">
                    <div id="" class="">
                        <ul>
                            <li>
                                <a href="<?=base_url()?>home/best_fifty">Best Overall Players</a>
                            </li>
                            <?php //print_r($categories);
                            if($categories){
                                foreach($categories as $category){
                            ?>
                            <li><a href="<?=base_url()?>home/best_fifty/<?=$category->id?>"><?=$category->name?></a></li>
                            <?
                                }
                            }
                            ?>
                        </ul>
                        <div class="borderbottom_dotted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
</div>