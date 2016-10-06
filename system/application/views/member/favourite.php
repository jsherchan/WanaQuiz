<script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">

<script type="text/javascript">
$(document).ready(function() {
  <? if(count($favourite_quizes)>0){
        //print_r($favourite_quizes);
            foreach($favourite_quizes as $fquizes){
           $quiz_detail = $this->Quiz_model->get_quiz_detail_by_id($fquizes->quiz_id);
          // print_r($quiz_detail);
                if(count($quiz_detail)>0){
     // $avg_rating_video=$this->Media_model->calculate_total_rating($quiz_detail[0]->quiz_id);
      $avg_rating_video=$this->Quiz_model->calculate_total_rating($quiz_detail[0]->quiz_id);
                    ?>
		$('#rate_video_<?=$quiz_detail[0]->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$quiz_detail[0]->quiz_id?>','<?=$avg_rating_video?>', {maxvalue:5,increment:.5});

<? } } } ?>

});

function remove_favourites(count){ 
    for(i=1;i<=count;i++){
        var q_id = $("#check"+i+":checked").val();
       //alert(q_id);
        if(q_id != undefined)
            $.post('<?=base_url()?>quiz/deleteFavourites', {quiz_id:q_id}, function(data){
                if(data=="success")
                    alert("successfully deleted");
                else alert('error');
            });
    }

   window.location.reload();
    
}
</script>
<div id="body_wrap">
	<div class="bodywrapInner">
        <div class="">
            <div>
                <?php include('member_links.php'); ?>
<div class="playlist_right">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="longwhitebox_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:770px;">
                                    <div class="bold font14 color_white">Favorites</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="longwhitebox_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<form name="playlist" action="" method="post">
                            		<div class="content_10box">
                                    	<div class="padding_10topbottom">Click on the "Add to favorites" button on any quiz page and a link to the question will be saved here.</div>
                                        
                                        
                                        
                                        <!--<div class="padding_10topbottom">
                                        	<div class="borderbottom_gray"></div>
                                            <div class="content_5box">
                                            	<span>Sort by:</span> | <span>Title</span> | <span class="bold"><a href="#">Date added</a></span> | <span>Views</span>
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                        </div>-->
                                        
                                        <div class="padding_10topbottom">
                                        	<div class="searchbtn_leftborder"></div>
                                                <div class="searchbtn_bg"><a href="javascript:void(0)" onclick="remove_favourites('<?=count($favourite_quizes)?>')">Remove questions</a></div>
                                                <div class="searchbtn_rightborder"></div>
                                                
                                                <div class="clear"></div>
                                        </div>
                                        
                                        <div class="padding_10topbottom">
                                        	
                                            <?php if(count($favourite_quizes)>0){
                                                //print_r($favourite_quizes);
                                                $i=1;
                                                    foreach($favourite_quizes as $fquizes){
                                                   $quiz_detail = $this->Quiz_model->get_quiz_detail_by_id($fquizes->quiz_id);
                                                  // print_r($quiz_detail);
                                           		if(count($quiz_detail)>0){
										?>
                                            <div class="subscribebox">
                                            	<div class="subscribeboxInner">
                                                	<div>
                                                    	<div class="msg_checkbox"><input type="checkbox" name="check<?=$i?>" id="check<?=$i?>" value="<?=$quiz_detail[0]->quiz_id?>"/></div>
                                                        <div class="playlist_img">
                                                        	
                                                            <div class="border_green">
                                                            <?php if($quiz_detail[0]->quiz_type == 'photo') {?>
                                                                <a href="<?=base_url()?>quiz/view/<?=$quiz_detail[0]->quiz_id?>">
                                                                     <img src="<?=base_url()?>photo_question_thumbs/<?=$quiz_detail[0]->images?>" alt="song img"/>
                                                                </a>
                                                                <? } else {
                                                                            $vd=explode('.',$quiz_detail[0]->images);
                                                                            if($_SERVER['SERVER_NAME']=='localhost')
                                                                            $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                            else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    ?>
                                                                    <a href="<?=site_url('quiz/view/'.$quiz_detail[0]->quiz_id)?>">
                                                                            <?php if(file_exists($a)){ ?>
                                                                            <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                            <? } else {?>
                                                                            <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                            <? } ?>
                                                                    </a>
                                                                <? } ?>
                                                                <!--<div class="plusicon_align1">
                                                                    <a href="#"><img src="../../../../../wannaquiz_design/includes/images/plus_icon.png" width="11" height="11" alt="plus icon" /></a>
                                                                </div>-->
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div>
                                                    	<a href="<?=site_url('quiz/views/'.$quiz_detail[0]->quiz_id)?>"><?=$quiz_detail[0]->quiz_question?></a>
                                                    </div>
                                                    <div class="font11">
                                                        <div class="padding_5top">Added: <?php $date = $quiz_detail[0]->date; echo date("F j, Y, g:i a");?></div>
                                                        <div class="padding_5top">From: <a href="<?=site_url($quiz_detail[0]->username)?>"><?=$quiz_detail[0]->username?></a></div>
                                                        <div class="padding_5top">Views: <?php echo $this->Quiz_model->get_quiz_views($quiz_detail[0]->quiz_id)?></div>
                                                    </div>
                                                    
                                                    <div id="rate_video_<?=$quiz_detail[0]->quiz_id?>" class="rating"></div>
                                                    
                                                </div>
                                            </div>
                                            <? } $i++;} }?>
                                          
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="borderbottom_dotted"></div>
                                    
                                    <div class="content_10box">
                                    	<div class="playlistbtn_alignright">
                                            <div class="pagination">

                                                <?php echo $this->pagination->create_links();?>
                                                <!--
                                                <ul>
                                                    <li><a href="#">Previous</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#" class="pageselected">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">Next</a></li>
                                                    
                                                    <div class="clear"></div>
                                                </ul>-->
                                            </div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    
                                
                                </form>
                            </div>
                        </div>
                        <div class="longwhitebox_bottomborder"></div>
                    </div>
                </div>
            </div>
            
            </div>
            
        </div>
    	<div class="clear"></div>
    </div>
</div>
            