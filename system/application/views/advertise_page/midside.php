<div class="midside">
    <div class="midsideInner">
        <div class="content_wrap">
            <div class="whiteboxmidside_topborder">
                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:470px;">
                        <div class="helpmid_links" id="question">
                            <?=$content->title?>
                        </div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="whiteboxmidside_bg">
                <div class="whiteboxrightside_bgInner">
                    <div>
                        <div class="content_wrap">


                            <div class="content_10box">
                            
                                <div class="font13" style="text-align:left">
                                    <a href="<?=base_url()?>">Wannaquiz</a> >
                                    <a href="<?=base_url()?>home/help_center">Help Center</a> >
                                    <?php if($cat_level==0){?>
                                    <a href="<?=base_url()?>home/show/<?=$content->type?>"><?=$content->title?></a>
                                    <? } else if($cat_level==1){
                                        $parent_info =$this->Help_management_model->get_help_id_info($parent_id,'');
                                    ?>
                                    <a href="<?=base_url()?>home/show/<?=$parent_info[0]['type']?>"><?=$parent_info[0]['name']?></a> >
                                    <a href="<?=base_url()?>home/show/<?=$content->title?>"><?=$content->title?></a>
                                    <? } else {
                                        $sub_parent_info =$this->Help_management_model->get_help_id_info($parent_id,'');
                                        $parent_info =$this->Help_management_model->get_help_id_info($sub_parent_info[0]['parent_id'],'');
                                    ?>
                                    
                                    <a href="<?=base_url()?>home/show/<?=$parent_info[0]['type']?>"><?=$parent_info[0]['name']?></a> >
                                    <a href="<?=base_url()?>home/show/<?=$sub_parent_info[0]['type']?>"><?=$sub_parent_info[0]['name']?></a> >
                                    <a href="<?=base_url()?>home/show/<?=$content->type?>"><?=$content->title?></a>
                                    <? }?>
                                </div>


                                <div class="help_opt4desc">
                                    <div class="help_optdescInner" id="answer">
                                        <div style="float:left">
                                            <?php //echo $help_image;
                                            $image1='help_management_images/'.$help_image;
                                            if (file_exists($image1)) {
                                                ?>
                                            <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image1; ?>&h=150&w=&zc=0" alt="Help Image" id="thumbnail" />
                                            <?}?>
                                        </div>
                                        <?=$content->detail?>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                            <div class="borderbottom_dotted"></div>

                            <div class="content_10box">
                                <div class="help_opt4desc">
                                    <div class="help_optdescInner" id="answer">
                                        <?php
                                        //echo '<pre>'; print_r($sub_help_lists);//exit;
                                        if(count($sub_help_lists)>0) {
                                            foreach($sub_help_lists as $subHelpList) {
                                            //echo "hello";
                                                $sub_content =$this->pages_model->get($subHelpList->CMSType);
                                                //echo '<pre>';print_r($sub_content); echo '</pre>';

                                                ?>
                                        <div>
                                            <div><b><?=$subHelpList->CMSTitle?></b></div>
                                            <div style="float:left">
                                                        <?php
                                                        $image='help_management_images/'.$subHelpList->help_image;
                                                        if (file_exists($image)) {
                                                            ?>
                                                <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=150&w=&zc=0" alt="Help Image" id="thumbnail" />
                                                        <?}?>
                                            </div>
                                            <div><?=$sub_content->detail?></div>
                                        </div>
                                        <div class="clear"></div>
                                            <? } }?>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="whiteboxmidside_bottomborder"></div>
        </div>
    </div>
</div>