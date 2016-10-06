<? #if($a) var_dump(get_defined_vars ()); ?>

<div class="rightside">
    <div class="rightsideInner">
        <div class="content_wrap">
            <div class="whiteboxrightside_topborder">
                <div class="title_align">
                    <div class="font14">On <a href="" class="color_lightblue">WannaQuiz</a> people dress up or use objects while asking questions</div>
                </div>
            </div>
            <div class="whiteboxrightside_bg">
                <div class="whiteboxrightside_bgInner">
                        <div class="text_center">
                            </br>
<!--      <div><img src="<?=base_url()?>images/people_separate.jpg" width="280" height="26" alt="separater" /></div>-->
                        <div><img src="<?=base_url()?>images/banner4.png" width="279" height="340" alt="people" /></div>
                    </div>
                </div>
            </div>
            <div class="whiteboxrightside_bottomborder"></div>
        </div>

        <div class="content_wrap">
            <div class="whiteboxrightside_topborder1"></div>
            <div class="whiteboxrightside_bg">
                <div class="whiteboxrightside_bgInner">
                        <div class="content_10box">
                        <div class="text_center">
                            <?php
                            //echo '<pre>'; print_r($admin_rectangular_ads); exit;
                            if(count($admin_rectangular_ads)>0){
                                if($admin_rectangular_ads[0]->adv_type != 'adsense'){
                                ?>
                                <a style="cursor:pointer" href="http://<?=$admin_rectangular_ads[0]->link_url?> " target="_blank">
                                        <?php $image=base_url().'advertisement_banners/'.$admin_rectangular_ads[0]->adv_banner;
                                        list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                        //echo $imageWidth.'/'.$imageHeight;
                                       if($imageWidth<'250'){
                                                $imagew = $imageWidth;
                                                $imageh = $imageHeight;
                                            }
                                            else{
                                                $imagew = '250';
                                                $imageh='';
                                            }
                                        ?>
                                        <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />
                                        <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_rectangular_ads[0]->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                    </a>
                            <? }
                            else {
                                ?>
                            <div style="height:250px; width:250px">
                                <?php echo $admin_rectangular_ads[0]->adv_detail;?>
                            </div>
                           <?php } } else { ?>

                            <img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertisement" />
                             <? }?>
                        </div>
                    </div>

                    <div class="title_align">
                        <div class="greentitlebg_leftborder"></div>
                        <div class="greentitlebg_bg" style="width:230px;">
                            <div class="bold font14 color_white">Featured Photo Questions</div>
                        </div>
                        <div class="greentitlebg_rightborder"></div>

                        <div class="clear"></div>
                    </div>

                    <div class="padding_10top">
                       <? //print_r($featured_questions);
                       
$user_id = $this->session->userdata('wannaquiz_user_id');
if($user_id=='') $user_id = FALSE;
else 
{
    $quizzes = $this->Quiz_model->get_quizzes_played($user_id);
    $ids = $quizzes[0];
    $answers = $quizzes[1];
}
                       
                       if(count($featured_questions)>0) {
                       foreach($featured_questions as $question)
                       {                                                  
                            if($user_id && $ids && $this->Quiz_model->check_similar_quiz($ids,$answers,$question->quiz_id,$question->user_id))
                                continue;

                            else {
                           
                     // $avg_rating=$this->Quiz_model->calculate_total_rating($question->quiz_id);
                                                           ?>
                       <div class="borderbottom_dotted"></div>

                      <div class="content_10box">
                            <div><a href="<?=site_url('quiz/view/'.$question->quiz_id)?>"><?=$question->quiz_question?> </a></div>
                            <div class="padding_10top">
                                <div class="featuredquest_left">
                                    <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>">
                                        <div class="border_green">
                                    <?php if($question->quiz_type =='photo') {
                                        if($_SERVER['SERVER_NAME']=='localhost')
                                                                                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$question->images;
                                             #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$question->images;
                                        else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$question->images;
                                                if(file_exists($photo_path)){
                                                ?>
                                                    <img src="<?=base_url()?>photo_question_thumbs/<?=$question->images?>" alt="feature quest img" />
                                                <? } else {?>
                                                    <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                        <? } }
                                        else {
                                            $vd=explode('.',$question->images); ?>
                                        <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                        <? }?>
                                        </div>
                                    </a>
                                </div>

                                <div class="featuredquest_right">
                                        <div>
                                        <div>From: <a href="<?=site_url($question->username)?>"><?=$question->username?></a></div>
                                        <div class="padding_5top">Views: <?php echo $this->Quiz_model->get_quiz_views($question->quiz_id)?> </div>
                                        <div class="padding_5top">
                                       <!-- Rating Stars -->
                                       <div id="rate_<?=$question->quiz_id?>" class="rating"></div>
                                       <!-- End Rating Stars-->

                                        </div>
                                        <div class="padding_5top clear">More in:  <a href="<?=base_url()?>quiz/categoryDetail/<?=$question->user_type?>/<?=str_replace(' ','_',$question->name)?>"><?=$question->name?></a></div>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                        </div>

                        <? }}?>
                       <div style="text-align:right;">
                            <?=$pagination1?>
                       </div>
                       <?} else {?>
                       <div class="content_10box"> There is no Photo Quiz!</div>

                       <? }?>
                    </div>

                </div>
            </div>
            <div class="whiteboxrightside_bottomborder"></div>
        </div>
    </div>
</div>