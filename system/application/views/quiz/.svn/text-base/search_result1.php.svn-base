<?#=var_dump(get_defined_vars())?>
<?#=print_r($result)?>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />

<div id="body_wrap" style="width:auto;">
<div class="bodywrapInner">
<div class="">
    <div>

        <?php //$this->load->view('member/member_links'); ?>

        <div class="playlist_right">
            <div class="midsideInner">
                <div class="content_wrap">
                    <div class="quizmaking_topborder full_adj300_topborder full_adj300">
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:1015px;">
                                <div class="bold font14 color_white">Your Photo Quiz Results</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="quizmaking_bg">
                        <div class="whiteboxrightside_bgInner">
                            <form name="playlist" action="" method="post" class="form_adj300" style="width:754px !important;">

                                <div class="content_10box">

                                    <div class="content_wrap">
                                        <?php if($this->session->userdata('unview')): ?>
                                            <div class="bold" style="color:red;">
                                                <?=$this->session->userdata('unview')?>
                                            </div>
                                        <?php $this->session->unset_userdata('unview'); endif; ?>
                                        
                                        <?php if($this->session->userdata('filtered')): ?>
                                            <div class="bold" style="color:red;">
                                                <?=$this->session->userdata('filtered')?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="padding_2bottom">
                                            <div class="bg_blue">
                                                <div class="bold">
                                                    <div class="msg_checkbox">&nbsp;</div>
                                                    <div class="viewimg">Image</div>
                                                    <div class="viewques" style="width:345px !important;">Questions</div>
                                                    <div class="msg_date text_center">Created by</div>
                                                    <div class="msg_date text_center">Views</div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="list">
                                            <!-- google_ad_section_start -->
                                            <?
                                            //print_r($result);
                                            if(count($result)> 0) 
                                            {
                                                foreach($result as $result_data) 
                                                {                                                            
                                                    if($this->Quiz_model->check_similar_quiz($result_data->quiz_id,$result_data->user_id))
                                                        continue;
                                                    else
                                                    {                                                             
                                                ?>

                                            <div class="padding_2bottom">
                                                <div class="bg_lightblue">
                                                    <div>
                                                        <div class="msg_checkbox">

                                                        </div>

                                                        <div class="viewimg">
                                                            <div class="border_green">
                                                                <a href="<?=site_url('quiz/view/'.$result_data->quiz_id)?>">
                                                                            <?php if($result_data->quiz_type =='photo') {
                                                                                if($_SERVER['SERVER_NAME']=='localhost')
                                                                                    $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$result_data->images;
else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$result_data->images;
                                                                                if(file_exists($photo_path)) {
                                                                                    ?>
                                                                    <img src="<?=base_url()?>photo_question_thumbs/<?=$result_data->images?>" alt="feature quest img" />
                                                                                <? } else {?>
                                                                    <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                <? } }
                                                                            ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="viewques" style="width:345px !important;">
                                                            <a href="<?=site_url('quiz/view/'.$result_data->quiz_id)?>"><?=$result_data->quiz_question?></a>
                                                        </div>
                                                        <div class="msg_date text_center">
                                                            <a href="<?=site_url($result_data->username)?>"><?=$result_data->username?></a>
                                                        </div>
                                                        <div class="msg_date text_center">
                                                                    <?php echo $this->Quiz_model->get_quiz_views($result_data->quiz_id)?>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                                <? } } } else { ?>                                                        
                                            <div>There are no questions about your search terms! Why not <a href="<?=base_url()?>member/addPhotoQuestion">make your own </a>?</div>
                                            <? }?>
                                            <!-- google_ad_section_end -->
                                            <p align="right"><?=$config1?></p>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="adv300" style="padding-top:10px">
                                <?php
                                //print_r($admin_ads);
                                if(count($admin_ads)>0) {
                                    if($admin_ads[0]->adv_type!='adsense') {
                                        if($admin_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                        else $image_width = '300';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                                <!--<div class="content_10box">-->
                                <div class="text_center">
                                        <!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                    <div style="font-size:smaller; color:green;">
                                        <a style="cursor:pointer" href="http://<?=$admin_ads[0]->link_url?> " target="_blank">
                                                    <?php

                                                    $image='advertisement_banners/'.$admin_ads[0]->adv_banner;
                                                    if (file_exists($image)) {
                                                        list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                        //echo $imageWidth.'/'.$imageHeight;
                                                        if($imageWidth<$image_width) {
                                                            $imagew = $imageWidth;
                                                            $imageh = $imageHeight;
                                                        }
                                                        else {
                                                            $imagew = $image_width;
                                                            $imageh='';
                                                        }
                                                    }
                                                    //else echo "hereeeee";
                                                    ?>

                                                    <?php //print_r(getimagesize($image)); ?>
                                            <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />
                                            <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                        </a>
                                    </div>
                                    <div style="color:blue">
                                        <b><u><a style="cursor:pointer" ><?=$admin_ads[0]->link_url?></a></u></b>
                                    </div>

                                </div>
                                <!--</div>-->
                                    <? } else {?>
                                <div >
                                            <?php echo $admin_ads[0]->adv_detail;?>
                                </div>
                                    <?}} else {?>

                                <div class="text_center">
                                    <img src="<?=base_url()?>images/advertisement.jpg" width="300" height="250" alt="advertisement" />
                                </div>
                                <? } ?>
                            </div>                            
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="quizmaking_bottomborder"></div>
                    <div class="quizmaking_topborder full_adj300">
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:1015px;">
                                <div class="bold font14 color_white">Your Video Quiz Results</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="quizmaking_bg">
                        <div class="whiteboxrightside_bgInner">
                            <form name="playlist" action="" method="post"  class="form_adj300" style="width:754px !important;">

                                <div class="content_10box">

                                    <div class="content_wrap">

                                        <div class="padding_2bottom">
                                            <div class="bg_blue">
                                                <div class="bold">
                                                    <div class="msg_checkbox">&nbsp;</div>
                                                    <div class="viewimg">Video</div>
                                                    <div class="viewques" style="width:345px !important;">Questions</div>
                                                    <div class="msg_date text_center">Created by</div>
                                                    <div class="msg_date text_center">Views</div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="list">
                                            <!-- google_ad_section_start -->
                                            <?

                                            if(count($video_result)> 0) {
                                                foreach($video_result as $video_result_data) { ?>

                                            <div class="padding_2bottom">
                                                <div class="bg_lightblue">
                                                    <div>
                                                        <div class="msg_checkbox">

                                                        </div>

                                                        <div class="viewimg">
                                                            <div class="border_green">
                                                                        <?php $vd=explode('.',$video_result_data->quiz_videos);
                                                                        if($_SERVER['SERVER_NAME']=='localhost')
                                                                            $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
#else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                        ?>
                                                                <a href="<?=site_url('quiz/view/'.$video_result_data->quiz_id)?>">
                                                                            <?php if(file_exists($a)) { ?>
                                                                    <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                            <? } else {?>
                                                                    <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                            <? } ?>
                                                                </a>
                                                                <!--<a href="<?=base_url().'uploaded_video_questions/'.$video_result_data->images?>" style="display:block;width:110px;height:90px" id="player_<?=$video_result_data->quiz_id?>"></a>
                                                                <script>
                                                                    flowplayer("player_<?=$video_result_data->quiz_id?>", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                                                                        clip: {
                                                                            // these two configuration variables does the trick
                                                                            autoPlay: false,
                                                                            autoBuffering: true // <- do not place a comma here
                                                                        }
                                                                    });
                                                                </script>-->

                                                            </div>
                                                        </div>
                                                        <div class="viewques" style="width:345px !important;">
                                                            <a href="<?=site_url('quiz/view/'.$video_result_data->quiz_id)?>"><?=$video_result_data->quiz_question?></a>
                                                        </div>
                                                        <div class="msg_date text_center">
                                                            <a href="<?=site_url($video_result_data->username)?>"><?=$video_result_data->username?></a>
                                                        </div>
                                                        <div class="msg_date text_center">
                                                                    <?php echo $this->Quiz_model->get_quiz_views($video_result_data->quiz_id)?>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                                <? }} else { ?>
                                            <div>There are no questions about your search terms! Why not make your own?</div>
                                            <? }?>
                                            <!-- google_ad_section_end -->                                            
                                            <p align="right"><?=$config2?></p>
                                        </div>
                                    </div>
                                </div>

                            </form>


                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="quizmaking_bottomborder"></div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>
    <div class="clear"></div>
</div>
</div>



