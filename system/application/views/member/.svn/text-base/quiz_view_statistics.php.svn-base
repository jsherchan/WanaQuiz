<script>
function block(friend_id) {
    $.post('<?=base_url()?>member/blockFriend', {friendID:friend_id} , function(data)
	{
			   if (data != '' || data != undefined || data != null)
			   {
			  		dt=data.split('|');

				// $('#change_password_div').html(dt[2]);
                               // alert(dt[0]);alert(dt[1]);
				 if(dt[0]=='success')
                                     {//alert('yes');
				 	 $('#status_'+friend_id).html(dt[1]);
                                     }

				else{
					$('#error_message').html(dt[0]);
				}
				//$.prompt(dt[0]);
			   }

     });
}

function unblock(friend_id) {
    $.post('<?=base_url()?>member/unblockFriend', {friendID:friend_id} , function(data)
	{
			   if (data != '' || data != undefined || data != null)
			   {
			  		dt=data.split('|');

				// $('#change_password_div').html(dt[2]);
                               // alert(dt[0]);alert(dt[1]);
				 if(dt[0]=='success')
                                     {//alert('yes');
				 	 $('#status_'+friend_id).html(dt[1]);
                                     }

				else{
					$('#error_message').html(dt[0]);
				}
				//$.prompt(dt[0]);
			   }

     });
}


</script>
<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">Quiz View Statistics</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<div class="padding_2bottom" style="padding-left:10px;">
                                                    <div class="bg_blue">
                                                    	<div class="bold">
                                                        	
                                                        	<div class="viewimg" style="width:100px">Image</div>
                                                            <div class="viewques" style="width:180px">Your Question</div>
                                                            <div class="msg_date " style="width:80px">Left Credits</div>
                                                            <div class="msg_date " style="width:60px"></div>

                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                 <div id="list">
                                          <?
                                          //print_r($question_list);
                                          if(count($question_list)> 0) {
                                          foreach($question_list as $question){ ?>

                                                <div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                        <div>
                                                           <div class="viewimg">
                                                                <div class="border_green">

                                                                    <?php if($question->quiz_type =='video') { 
                                                                        $out = explode(".",$question->quiz_videos);
                                                                        $video_image = $out[0].".jpg";?>
                                                                        <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>">
                                                                        <? 
																		if($_SERVER['SERVER_NAME']=='localhost')
																		$a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$video_image;
            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$video_image;
            else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$video_image;
                                                                        if(file_exists($a)){ ?>
                                                                            <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$video_image?>" alt="feature quest img" />
                                                                        <? } else {?>
                                                                            <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                        <? }?>
                                                                        </a>
                                                                    <?} else {?>
                                                                        <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>">
                                                                       <?
																	   if($_SERVER['SERVER_NAME']=='localhost')
                                                                         $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$played_quizes->images;
    #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$played_quizes->images;
    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$played_quizes->images;
                                                                            if(file_exists($photo_path)){
                                                                            ?>
                                                                                <img src="<?=base_url()?>photo_question_thumbs/<?=$question->images?>" alt="feature quest img" />
                                                                            <? } else {?>
                                                                                <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                             <?} ?>
                                                                        </a>
                                                                        <? }?>
                                                                </div>
                                                            </div>
                                                            <div class="viewques" style="width:180px;">
                                                                <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>"><?=$question->quiz_question?></a>
                                                            </div>
                                                            <div class="msg_date text_center">
                                                                <?=$question->total_budget?>

                                                            </div>
                                                            <div class="msg_date text_center">
                                                                <a href="<?=base_url()?>member/buyAdSpace/<?=$question->quiz_id?>" style="cursor:pointer" id="delete" >
                                                                    Add Credits
                                                                </a>
                                                            </div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? }} else { ?>
                                                <div>There is no any question!</div>
                                                <? }?>
                                                </div>
                                <!--<div class="content_10box">
                                	<div class="searchbtn_leftborder"></div>
                                    <div class="searchbtn_bg" style="padding:0 20px;"><a href="#">Save</a></div>
                                    <div class="searchbtn_rightborder"></div>
                                    
                                    <div class="clear"></div>
                                </div>-->
                            </div>
                            <div>
								<?php echo $this->pagination->create_links();?>
                               </div>
                        </div>

                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>