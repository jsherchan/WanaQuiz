<style>    
    .help_block ul li { padding-left: 14px; list-style-type: none; }
    .help_block ul li ul li { padding-left: 14px; list-style-type: none; }
</style>
<script>
$(function(){
    $('.desc_help a').each(function(){
       
        if($(this).attr('href')== undefined || $(this).attr('href')==''){
            $(this).addClass('anchor_href');
        }
    });
})
</script>
<div class="playlist_right">
    <?php if($this->session->flashdata('quiz_add_message')) { ?>
    <div style="text-align:center; padding-bottom:10px;">
        <span style="text-align:center; line-height:40px; background-color:#FFF;  margin:0 auto; display:inline-block; padding:0 10px; -moz-border-radius:50%; -webkit-border-radius:50%; border-radius:50%;border:1px solid #AFE3E7 ">
                <?php echo $this->session->flashdata('quiz_add_message');?>
        </span>
    </div>
    <? }?>
    <div class="midsideInner">
        <div class="content_wrap new_help">
            <div class="longwhitebox_topborder">
                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:770px;">
                        <div class="bold font14 color_white"><?php if($flag=='help_center') echo 'Help Center'; else echo $content->title?></div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="longwhitebox_bg">
                <?php if($flag == 'help_center') { ?>
                <div class="content_10box">
                    <?php
                  //print_r($all_help_list);
                    $i=1;
                    if($all_help_list){
                        foreach($all_help_list as $help_list){
                    ?>
                    <div class="whiteboxrightside_bgInner">
                        <div class="help_block">
                            <div><strong><?=$help_list->CMSTitle?></strong></div>                            
                            <?php $sub_helps = $this->Help_management_model->get_sub_helps($help_list->CMSType);
                            //print_r($sub_helps);
                                if($sub_helps){
                                    foreach($sub_helps as $subHelps):                                                                                
                                        $sub_sub_helps = $this->Help_management_model->get_sub_helps($subHelps->CMSType);                                    
                                        if($sub_sub_helps)
                                        {
                                          
                                            echo '<a href="' . base_url() . 'home/show/' . $subHelps->CMSType . '">' . $subHelps->CMSTitle . '</a>';  
                                            echo '<ul>';
//                                            foreach($sub_sub_helps as $ssHelps):
//                                                $sub_sub_sub_helps = $this->Help_management_model->get_sub_helps($ssHelps->CMSType);                                    
//                                                
//                                                if($sub_sub_sub_helps)
//                                                {
//                                                    echo '<li>
//                                                        <strong><a href="' . base_url() . 'home/show/' . $ssHelps->CMSType . '">' . $ssHelps->CMSTitle . '</strong></a>
//                                                         ';
//                                                      
//                                                    echo '<ul>';
//                                                    foreach($sub_sub_sub_helps as $sssHelps):
//                                                        echo '<li>
//                                                            <a href="' . base_url() . 'home/show/' . $sssHelps->CMSType . '">' . $sssHelps->CMSTitle . '</a>
//                                                            </li>';
//                                                    endforeach;
//                                                    echo '</ul>';
//                                                    echo '</li>';
//                                                }
//                                            
//                                                else
//                                                {
//                                                    echo '<li>
//                                                        <a href="' . base_url() . 'home/show/' . $ssHelps->CMSType . '">' . $ssHelps->CMSTitle . '</a>
//                                                      </li>';
//                                                }        
//                                               
//                                            endforeach;
                                            
                                            echo '</ul>';
                                        }
                                        else
                                            echo '<a href="' . base_url() . 'home/show/' . $subHelps->CMSType . '">' . $subHelps->CMSTitle . '</a>';
                                    endforeach;
                                }
                            ?>
                        </div>
                    </div>
                    <? if($i%2==0){?>
                    <div class="clear"></div>
                    <?}
                            $i++;
                        }
                    }?>
                    <div class="clear"></div>
                </div>
                <?php } else{ ?>

                <div class="content_10box">

                    <div class="font11 bread_crum" style="text-align:left">
                        <a href="<?=base_url()?>">Wannaquiz</a> >
                        <a href="<?=base_url()?>home/help_center">Help Center</a> >
                        <?php

                        if($cat_level==0) {?>
                        <a href="<?=base_url()?>home/show/<?=$content->type?>"><?=$content->title?></a>
                        <? }
                        else if($cat_level==1) {
                                $parent_info =$this->Help_management_model->get_help_id_info($parent_id,'');
                                //print_r($parent_info);
                                ?>
                        <a href="<?=base_url()?>home/show/<?=$parent_info[0]['type']?>"><?=$parent_info[0]['name']?></a> >
                        <a href="<?=base_url()?>home/show/<?=$content->type?>"><?=$content->title?></a>
                            <? }
                        else {
                                $sub_parent_info =$this->Help_management_model->get_help_id_info($parent_id,'');
                                $parent_info =$this->Help_management_model->get_help_id_info($sub_parent_info[0]['parent_id'],'');
                                ?>

                        <a href="<?=base_url()?>home/show/<?=$parent_info[0]['type']?>"><?=$parent_info[0]['name']?></a> >
                        <a href="<?=base_url()?>home/show/<?=$sub_parent_info[0]['type']?>"><?=$sub_parent_info[0]['name']?></a> >
                        <a href="<?=base_url()?>home/show/<?=$content->type?>"><?=$content->title?></a>
                            <? }?>
                    </div>

                    <!--<h4 class="padL10 cat_name_1"><?=$content->title?> on  <?php if($cat_level==0) echo 'Help Center'; else if($cat_level==1) echo $parent_info[0]['name']; else echo $sub_parent_info[0]['name'];?></h4>-->
                    <div class="help_opt4desc">
                        <div class="help_optdescInner" id="answer">
                            <div class="desc_help">
                            <?=$content->detail?>
                            </div>

                            <?php if($url=='sound_check'){ ?>
                                                     <div style="padding-top:10px; padding-bottom:20px">
                                                        <div style="font-weight:bold">Voice - sound level test</div>
                                                        <div id="div1" style="float:left; padding:10px 0 10px 0">
                                                            <div id='player1'></div>
                                                            <script type='text/javascript'>
                                                                var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                                                so.addParam('allowfullscreen','true');
                                                                so.addParam('allowscriptaccess','always');
                                                                so.addParam('wmode','opaque');
                                                                so.addVariable('file','<?=base_url()?>Voice - sound level test.mp3');
                                                                so.write('player1');
                                                            </script>
                                                        </div>
                                                        <div class="clear"></div>

                                                        <div style="font-weight:bold; padding-top:10px">Music - sound level test</div>
                                                        <div style="padding-top:10px; padding-bottom:10px">
                                                            <div id='player2'></div>
                                                            <script type='text/javascript'>
                                                                var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                                                so.addParam('allowfullscreen','true');
                                                                so.addParam('allowscriptaccess','always');
                                                                so.addParam('wmode','opaque');
                                                                so.addVariable('file','<?=base_url()?>Music - sound level test.mp3');
                                                                so.write('player2');
                                                            </script>
                                                        </div>
                                                        <span style="width:auto;">Download:<a href="<?=base_url()?>download"> Voice - sound level test</a> | <a href="<?=base_url()?>download1"> Music - sound level test</a></span>
                                                        <div style="padding:10px 0 0 0">Music must be made by yourself or in the <a href="<?=base_url()?>home/show/free_music">public domain/creative commons</a></div>
                                                        <!--<div id="vault1"></div>-->

                                                    </div>
                                                    <? } ?>
                            <?php// echo $detail = substr($content->detail, 0, 500); //echo count($detail);?>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="borderbottom_dotted"></div>

                
                <? } ?>
            </div>
            <div class="longwhitebox_bottomborder"></div>
        </div>
    </div>
</div>