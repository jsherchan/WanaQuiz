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
    <div class="quizmaking_topborder full_adj300">
        <div>
            <div class="title_align">
                <div class="bluetitlebg_leftborder"></div>
                <div class="bluetitlebg_bg" style="width:1016px;">
                    <div class="bold font14 color_white"><?php echo $category_detail->name;?></div>
                </div>
                <div class="bluetitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="quizmaking_bg">
        <div class="whiteboxrightside_bgInner">
            <div class="content_10box">
                <div class="font13">
                    <a href="#">Wannaquiz</a> &gt; <a href="<?=base_url()?>quiz/category/<?=$user_type?>">Categories</a> &gt;
                    <?php if($category_detail->parent_id==0) { ?>
                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$category_detail->name)?>">
                                <?php echo $category_detail->name;?>
                            </a>
                          <? } else { $data = $this->Category_model->get_category_by_id($category_detail->parent_id);?>
                                <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$data->name)?>">
                                    <?=$data->name?>
                                </a> &gt;
                                <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$category_detail->name)?>">
                                    <?=$category_detail->name?>
                                </a>
                          <? } ?>
                </div>

                <div class="padding_10topbottom">
                   
                            <!--<div class="featurevideo_img">
                                <div>
                                    <img src="<?=base_url()?>category_images/<?=$category_detail->category_image?>" width="180" height="135" alt="feature video" />
                                </div>
                            </div>
                            <div class="category_detail" style="height:auto;">
                                <div class="featurevideo_detailInner" style="padding-left:85px;">

                                    <div>
                                        <div style="width:305px;">
                                            &nbsp;<?=$category_detail->category_description?>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                     <?php if($category_detail->parent_id==0) { ?>
                     <div class="border_gray">
                        <div class="content_10box">
                            <div class="featurevideo_name">
                                <!--<div class="borderleft_gray">-->
                                    <div class="featurevideo_detailInner">
                                        <div class="bold">Subcategories</div>
                                        <div class="padding_10topbottom"><?php //print_r($sub_category)?>
                                                <?php if(count($sub_category)>0) {
                                                    foreach($sub_category as $subcategory) { ?>
                                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$subcategory->name)?>"><?php echo$subcategory->name?></a>,
                                            <? }} else echo"There is no sub category!"; ?>
                                        </div>
                                    </div>
                                <!--</div>-->
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                    <? }?>
                </div>

            </div>

            <div class="content_10box">
                <div class="bold font14">Questions</div>
            </div>
            <div class="borderbottom_dotted"></div>
            <div class="padding_10topbottom">
                <div class="category_left" style="width:745px;">
                    <div class="category_leftInner">
                        <?php if(count($category_questions)>0) {
                            #var_dump($category_questions);exit;
                            foreach($category_questions as $cquestions) {?>
                        <div class="content_10box">

                            <div class="playlist_img">
                                <div class="border_green">
                                            <?php if($cquestions->quiz_type=='photo') {?>
                                    <a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>">
                                                    <? if($_SERVER['SERVER_NAME']=='localhost')
                                                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$cquestions->images;
                                                    #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$cquestions->images;
                                                    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$cquestions->images;
                                                    if(file_exists($photo_path)) {
                                                        ?>
                                        <img src="<?=base_url()?>photo_question_thumbs/<?=$cquestions->images?>" alt="feature quest img" />
                                                    <? } else {?>
                                        <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                    <? } ?>
        <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$cquestions->images?>" width="94" height="71" alt="plus icon" />-->
                                    </a>
                                            <? } else {?>
                                                <?php $vd=explode('.',$cquestions->images);
                                                if($_SERVER['SERVER_NAME']=='localhost')
                                                    $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                ?>
                                    <a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>">
                                                    <?php if(file_exists($a)) { ?>
                                        <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                    <? } else {?>
                                        <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                    <? } ?>
                                    </a>
                                    <!--<a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>"><img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img"></a>-->
                                            <? }?>

                                    <div class="plusicon_align1">
                                        <!--<a href="#"><img src="images/plus_icon.png" width="11" height="11" alt="plus icon" /></a>-->
                                    </div>
                                </div>

                            </div>

                            <div class="categorylist_detail" style="width:310px;">
                                <div class="playlist_detailInner">
                                    <div><a href="<?=site_url('quiz/view/'.$cquestions->quiz_id)?>"><?=$cquestions->quiz_question?></a></div>

                                    <div class="padding_10topbottom">
                                        <div class="font11">
                                            <div>From: <a href="<?=base_url()?><?=$cquestions->username?>"><?=$cquestions->username?></a></div>
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
                        <? }
                    echo $this->pagination->create_links();
                    } else {?>
                        <div style="padding:10px">
                            There are no more questions! Why not make your own ??
                        </div>
                        <? }?>

                    </div>
                </div>

                <div class="adv300">
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
                    <?}} else 
                        {
                        
                        $category_ads=$this->Advertise_management_model->get_admin_ads_by_cid_sub_category($category_detail->parent_id,'rectangular','category');
                       if(count($category_ads)>0){
                        
                         if($category_ads[0]->adv_dimension=='vertical') $image_width = '160';
                            else $image_width = '300';
                            ?>
                       <a style="cursor:pointer" href="http://<?=$category_ads[0]->link_url?> " target="_blank">
                                        <?php
                                        
                                        $image='advertisement_banners/'.$category_ads[0]->adv_banner;
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
                                            
                    <? }else {?>
                        <div class="text_center">
                        <img src="<?=base_url()?>images/advertisement.jpg" width="300" height="250" alt="advertisement" />
                    </div>
                   <? }}
                    
?>
                   
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
                                             <div>Form: <a href="#">Peter</a></div>
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
    <div class="quizmaking_bottomborder"></div>
</div>