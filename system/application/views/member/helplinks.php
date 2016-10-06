<script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">

<script type="text/javascript">
$(document).ready(function() {
	<?
        if(count($recently_played)>0) {
        foreach($recently_played as $played_quizes){
        $avg_rating=$this->Quiz_model->calculate_total_rating($played_quizes->quiz_id);
        ?>
		$('#rate_<?=$played_quizes->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$played_quizes->quiz_id?>','<?=$avg_rating?>', {maxvalue:5,increment:.5});
	<? } }?>
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	<?
        if(count($unplayed_quiz)>0) {
        foreach($unplayed_quiz as $unplayed_quizes){
        $avg_rating=$this->Quiz_model->calculate_total_rating($unplayed_quizes->quiz_id);
        ?>
		$('#rate1_<?=$unplayed_quizes->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$unplayed_quizes->quiz_id?>','<?=$avg_rating?>', {maxvalue:5,increment:.5});
	<? } }?>
});
</script>
<div class="rightside">
            <div class="rightsideInner">
                <div class="content_wrap">
                    <div class="whiteboxrightside_topborder1">
                        <div class="title_align">
                            <div class="font14 bold">Wannquiz help</div>
                        </div>
                    </div>
                    <div class="whiteboxrightside_bg">
                        <div class="whiteboxrightside_bgInner">
                        	<div class="add_links">
                                <ul>
                                    <li><a href="<?=base_url()?>home/help_center">Help files</a></li>
                                    <li><a href="<?=base_url()?>home/show/questions">Faq</a></li>
                                    <!--<li><a href="<?=base_url()?>member/wannaquizHelp/embed_player">Embed a player</a></li>-->
                                    <li><a href="<?=base_url()?>home/show/copyright">Copyrights</a></li>
                                    <li><a href="<?=base_url()?>home/show/free_photos">Get permission to use photos/videos</a></li>
                                    <li><a href="<?=base_url()?>home/help_center/advertise">Advertise</a></li>
                                    
                                </ul>
                                <div class="borderbottom_dotted"></div>
                            </div>
                        </div>
                    </div>
                    <div class="whiteboxrightside_bottomborder"></div>
                </div>
                
               <div class="content_wrap">
                   <div class="whiteboxrightside_topborder1">
                        <div class="title_align">
                            <div class="font14 bold">Quizes you recently played</div>
                        </div>
                    </div>
                    <div class="whiteboxrightside_bg">
                        <div class="whiteboxrightside_bgInner">
                            <div class="padding_10top">
                                <div class="borderbottom_dotted"></div>
                                <?php
                                if(count($recently_played)>0){

                                foreach($recently_played as $played_quizes) { ?>

                                <div class="content_10box">
                                    <div><a href="<?=site_url('quiz/view/'.$played_quizes->quiz_id)?>"><?=$played_quizes->quiz_question;?> </a></div>
                                    <div class="padding_10top">
                                    	<div class="featuredquest_left">
                                        	<div class="border_green">
                                                    <?php if($played_quizes->quiz_type=='photo'){
														if($_SERVER['SERVER_NAME']=='localhost')
                                                     $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$played_quizes->images;
                                                     #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$played_quizes->images;
                                                     else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$played_quizes->images;
                                                        if(file_exists($photo_path)){
                                                        ?>
                                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$played_quizes->images?>" alt="feature quest img" />
                                                        <? } else {?>
                                                            <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                         <?} ?>
                                                    <? } else{
                                                    $out = explode(".",$played_quizes->images);
                                                    $video_image = $out[0].".jpg";
													if($_SERVER['SERVER_NAME']=='localhost')
                                                    $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$video_image;
                                                     else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$video_image;
                                                    if(file_exists($a)){
                                                    ?>
                                                        <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$video_image?>" alt="feature quest img" />
                                                    <? } else {?>
                                                        <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                    <? }} ?>
                                                   
                                                </div>
                                        </div>

                                        <div class="featuredquest_right">
                                        	<div>
                                                <div>From: <a href="<?=site_url($played_quizes->username)?>"><?=$played_quizes->username?></a></div>
                                                <div class="padding_5top">Views: <?php echo $this->Quiz_model->get_quiz_views($played_quizes->quiz_id)?> <? if($avg_rating>=0.5) echo "on";?></div>
                                                <div class="padding_5top">
                                                    <!-- Rating Stars -->
                                                   <div id="rate_<?=$played_quizes->quiz_id?>" class="rating"></div>
                                                   <!-- End Rating Stars-->

                                                </div>
                                                <div class="padding_5top clear">More in:  <a href="<?=base_url()?>quiz/categoryDetail/<?=$played_quizes->user_type?>/<?=str_replace(' ','_',$played_quizes->name)?>"><?=$played_quizes->name?></a></div>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="borderbottom_dotted"></div>
                                <? } } else {?>
                                <div class="content_10box">You haven't played any quiz!</div>
                                <? } ?>

                            </div>

                        </div>
                    </div>
                    <div class="whiteboxrightside_bottomborder"></div>
                </div>

                <div class="content_wrap">
                   <div class="whiteboxrightside_topborder1">
                        <div class="title_align">
                            <div class="font14 bold">Try something new</div>
                        </div>
                    </div>
                    <div class="whiteboxrightside_bg">
                        <div class="whiteboxrightside_bgInner">
                            <div class="padding_10top">
                                <div class="borderbottom_dotted"></div>
                                <?php if(count($unplayed_quiz)>0)
                                {
                                    foreach($unplayed_quiz as $unplayed_quizes){
                                    ?>
                                <div class="content_10box">
                                     <div><a href="<?=site_url('quiz/view/'.$unplayed_quizes->quiz_id)?>"><?=$unplayed_quizes->quiz_question;?> </a></div>
                                    <div class="padding_10top">
                                    	<div class="featuredquest_left">
                                        	<div class="border_green">
                                                     <?php if($unplayed_quizes->quiz_type=='photo'){
														 if($_SERVER['SERVER_NAME']=='localhost')
                                                        $photo_path1 = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$unplayed_quizes->images;
                                                     else $photo_path1 = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$unplayed_quizes->images;
                                                        if(file_exists($photo_path1)){
                                                        ?>
                                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$unplayed_quizes->images?>" alt="feature quest img" />
                                                        <? } else {?>
                                                            <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                <? }} else {
                                                    $out = explode(".",$unplayed_quizes->images);
                                                    $unplayed_video_image = $out[0].".jpg";
                                                    if($_SERVER['SERVER_NAME']=='localhost')
													$b = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$unplayed_video_image;
                                                     else $b = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$unplayed_video_image;
                                                    if(file_exists($b)){
                                                ?>
                                                    <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$unplayed_video_image?>" alt="feature quest img" />
                                                    <? } else {?>
                                                        <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                    <? }} ?>
                                                    
                                                </div>
                                        </div>

                                        <div class="featuredquest_right">
                                        	<div>
                                                <div>From: <a href="<?=site_url($unplayed_quizes->username)?>"><?=$unplayed_quizes->username?></a></div>
                                                <div class="padding_5top">Views: <?php echo $this->Quiz_model->get_quiz_views($unplayed_quizes->quiz_id)?> <? if($avg_rating>=0.5) echo "on";?></div>
                                                <div class="padding_5top">
                                                    <div class="padding_5top">
                                                    <!-- Rating Stars -->
                                                   <div id="rate1_<?=$unplayed_quizes->quiz_id?>" class="rating"></div>
                                                   <!-- End Rating Stars-->

                                                </div>
                                                </div>
                                                <div class="padding_5top clear">More in:  <a href="<?=base_url()?>quiz/categoryDetail/<?=$unplayed_quizes->user_type?>/<?=str_replace(' ','_',$unplayed_quizes->name)?>"><?=$unplayed_quizes->name?></a></div>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="borderbottom_dotted"></div>
                                <?php } } else {?>
                                <div style="padding-left: 10px;">There is no quiz!</div>
                                <? }?>

                            </div>

                        </div>
                    </div>
                    <div class="whiteboxrightside_bottomborder"></div>
                </div>
                
            </div>
        </div>