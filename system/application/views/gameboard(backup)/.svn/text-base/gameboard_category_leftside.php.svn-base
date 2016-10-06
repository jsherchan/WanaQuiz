<script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">

<script type="text/javascript">
    $(document).ready(function() {
        //alert('hi');
<?
if(count($category_questions)>0) {
    foreach($category_questions as $cquestions) {
        $avg_rating=$this->Quiz_model->calculate_total_rating($cquestions->quiz_id);
        ?>
                $('#rate_<?=$cquestions->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$cquestions->quiz_id?>','<?=$avg_rating?>', {maxvalue:5,increment:.5});
    <? }}?>
            });
</script>
<div class="content_wrap">
    <div class="whitelongbox_topborder">
        <div>
            <div class="title_align">
                <div class="bluetitlebg_leftborder"></div>
                <div class="bluetitlebg_bg" style="width:715px;">
                    <div class="bold font14 color_white"><?php echo $category_detail->name;?></div>
                </div>
                <div class="bluetitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="whitelongbox_bg">
        <div class="whiteboxrightside_bgInner">
            <div class="content_10box">
                <div class="font13">
                    <?
                    if($user_type=='regular') {
                        $user_type='regular';
                        $link = base_url().'quiz/categoryDetail/regular/'.$category_detail->id;
                    }
                    else if($user_type=='advertiser') {
                            $link = base_url().'quiz/categoryDetail/advertiser/'.$category_detail->id;
                            $user_type='advertiser';
                        }
                    ?>
                    <a href="#">Wannaquiz</a> >
                    <a href="<?=base_url()?>quiz/category/<?=$user_type?>">Categories</a> >

<?php if($category_detail->parent_id==0) { ?><a href="<?=$link?>"><?php echo $category_detail->name;?></a> <? } else { $data = $this->Category_model->get_category_by_id($category_detail->parent_id);?> <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=$category_detail->parent_id?>"><?=$data->name?></a> > <a href="<?=$link?>"><?=$category_detail->name?></a><? } ?>
                </div>


                <div class="padding_10topbottom">
                    <div class="border_gray">
                        <div class="content_10box">
                            <div class="featurevideo_img">
                                <div>
                                    <img src="<?=base_url()?>category_images/<?=$category_detail->category_image?>" width="180" height="135" alt="feature photo" />
                                </div>
                            </div>
                            <div class="category_detail">
                                <div class="featurevideo_detailInner" style="padding-left:85px;">

                                    <div>
                                        <div>
<?=$category_detail->category_description?>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php if($category_detail->parent_id==0) { ?>
                            <div class="featurevideo_name">
                                <div class="borderleft_gray">
                                    <div class="featurevideo_detailInner">
                                        <div class="bold">Sub Categories</div>
                                        <div class="padding_10topbottom"><?php //print_r($sub_category)?>
    <?php if(count($sub_category)>0) {
                                                    foreach($sub_category as $subcategory) {
                                                        if($user_type=='regular') $sublink = base_url().'quiz/categoryDetail/regular/'.$subcategory->id; else $link = base_url().'quiz/categoryDetail/advertiser/'.$subcategory->id;?>

                                            <a href="<?=$sublink?>"><?php echo$subcategory->name?></a>,
        <? }} else echo"There is no sub category!"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
<? }?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content_10box">
                <div class="bold font14">Questions</div>
            </div>
            <div class="borderbottom_dotted"></div>
            <div class="padding_10topbottom">
                <div class="category_left">
                    <div class="category_leftInner">
                        <?php if(count($category_questions)>0) { //print_r($category_questions);
                        foreach($category_questions as $cquestions){?>
                        <div class="content_10box">

                            <div class="playlist_img">
                                <div class="border_green">

                                <?php if($cquestions->quiz_type=='photo'){
                                            if($_SERVER['SERVER_NAME']=='localhost')
                                            $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$cquestions->images;
                                            #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$cquestions->images;
                                            else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$cquestions->images;
                                            if(file_exists($photo_path)){
                                            ?>
                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$cquestions->images?>" alt="feature quest img" />
                                            <? } else {?>
                                            <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                            <? }
                                        }
                                    else {
                                            $vd=explode('.',$cquestions->images); //echo $vd[0]; echo "hello";
                                            if($_SERVER['SERVER_NAME']=='localhost')
                                            $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            ?>
                                            <a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>">
                                            <?php if(file_exists($a)){ ?>
                                                <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                <? } else {?>
                                                <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                <? } ?>
                                            </a>
                                        <? }?>

                                    <div class="plusicon_align1">
                                        <!--<a href="#"><img src="images/plus_icon.png" width="11" height="11" alt="plus icon" /></a>-->
                                    </div>
                                </div>

                            </div>

                            <div class="categorylist_detail">
                                <div class="playlist_detailInner">
                                    <div><a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>"><?=$cquestions->quiz_question?></a></div>

                                    <div class="padding_10topbottom">
                                        <div class="font11">
                                            <div>From: <a href="<?=base_url()?>member/profile/<?=$cquestions->user_id?>"><?=$cquestions->username?></a></div>
                                            <div>Views: <?php echo $this->Quiz_model->get_quiz_views($cquestions->quiz_id)?></div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Rating Stars -->
                                        <div id="rate_<?=$cquestions->quiz_id?>" class="rating"></div>
                                        <!-- End Rating Stars-->
                                    </div>
                                </div>
                            </div>

                            <div class="clear"></div>
                        </div>
                        <div class="borderbottom_dotted"></div>
<? }} else echo "There is no more questions!"; ?>

                    </div>
                </div>
                <!-- <div class="category_right">
                            	<div class="borderleft_gray">
                                	<div class="category_rightInner">
                                    	<div class="bold">Sponsored question</div>
                             <div class="padding_10topbottom">
                                 <div><a href="#">Contemtory dance mooves ... </a></div>
                                 <div class="padding_10top">
                                     <div class="playlist_img">
                                         <div class="border_green"><img src="images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                         <div class="plusicon_align1">
                                         <a href="#"><img src="images/plus_icon.png" width="11" height="11" alt="plus icon" /></a>
                                     </div>
                                     </div>

                                     <div class="sponsor_detail">
                                         <div>
                                             <div>From: <a href="#">Peter</a></div>
                                             <div class="padding_5top">Views: 3,654</div>
                                             <div class="padding_5top"><img src="images/star.jpg" width="16" height="16" alt="star" /> <img src="images/star.jpg" width="16" height="16" alt="star" /> <img src="images/star.jpg" width="16" height="16" alt="star" /> <img src="images/star_half.jpg" width="16" height="16" alt="star half" /> <img src="images/star_dim.jpg" width="16" height="16" alt="star dim" /></div>
                                             <div class="padding_5top">More in:  <a href="#">Dance</a></div>
                                         </div>
                                     </div>

                                     <div class="clear"></div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>-->

                <div class="clear"></div>
            </div>

        </div>
    </div>
    <div class="whitelongbox_bottomborder"></div>
</div>