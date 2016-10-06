<script type="text/javascript" src="<?=base_url()?>anythingslider/js/jquery.easing.1.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">
<script>
function showRating(div,com)
{
    //alert('here');return;
//    alert(div+':'+com);
    
    var list = com.split('~');
    var c = '';
    
    for(var i=0; i<list.length;i++)
    {
        c = list[i].split('#');
        $('#'+div+c[0]).rating('<?=base_url()?>quiz/rating/'+c[0],c[1], {maxvalue:5,increment:.5});
    }
}
//$(loadratings);
</script>

<div id="body_wrap">
	<div class="bodywrapInner">
    
     <?php $this->load->view('include/advance_search_box.php'); ?>
       
        <div class="home_leftside">
            <div>
                
                <?php include('home_leftside.php'); ?>
                
                <?php include('home_midside.php'); ?>
        
                <div class="clear"></div>
            </div>
            <span id="featured_video_pagination">
                <?php include('home_featuredvideo.php'); ?>
            </span>
        </div>
        <span id="featured_question_pagination">
            <?php include('home_rightside.php'); ?>
        </span>
    	<div class="clear"></div>
    </div>
</div>

<script>
<? if(count($feat_videos)>0) { ?> showRating('rate_video_',<?=$com1?>); <? } ?>
<? if(count($featured_questions)>0) { ?> showRating('rate_',<?=$com2?>); <? } ?>
</script>