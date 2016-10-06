<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<script>
$(document).ready(function()
{
	$("#delete_all").click(function(){
	var tt='';
	for (var i=0;i<document.playlist.elements.length;i++)
	{
		var e=document.playlist.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox') )
		{
			if(e.checked)
			tt=e.value+','+tt;
		}
	}
	if(tt=="")
		alert('Please check the message to delete');

	else{ //alert(tt);
             $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
		$.post('<?=base_url()?>member/deleteQuestions', {ids:tt} , function(data){
                    if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        $('#list').html(dt[1]);

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
                });
                }}});
		}
	});

});

function checkAllBoxes(){
        $('.check_name').attr('checked','checked');
        $('.allbox').attr('checked','checked');
    }
function checkAll()
{
	for (var i=0;i<document.playlist.elements.length;i++)
	{
		var e=document.playlist.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.playlist.allbox.checked;
		}
	}
}

function delete_quiz(quiz_id)
{
    $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
    if(v){
    $.post('<?=base_url()?>member/deleteQuestions', {ids:quiz_id} , function(data){
        if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        window.location.reload();
                        //$('#list').html(dt[1]);

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
    });
    }
    }
    });
}


</script>


<div id="body_wrap">
	<div class="bodywrapInner">
        <div class="">
            <div>
                
               <?php $this->load->view('member/member_links'); ?>
                
               <div class="playlist_right">
                   <?php //if($this->session->flashdata('quiz_add_message')) { ?>
                   <!--<div style="text-align:center; padding-bottom:10px;">
                       <span style="text-align:center; line-height:40px; background-color:#FFF;  margin:0 auto; display:inline-block; padding:0 10px; -moz-border-radius:50%; -webkit-border-radius:50%; border-radius:50%;border:1px solid #AFE3E7 ">
                            <?php echo $this->session->flashdata('quiz_add_message');?>
                       </span>
                   </div>-->
                   <? //}?>
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="longwhitebox_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:770px;">
                                    <div class="bold font14 color_white">View all <?php echo $type?> quizzes</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="longwhitebox_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<form name="playlist" action="" method="post">
                            		
                                        <div class="content_10box">
                                           
                                            <div class="content_wrap">
                                            	<div class="padding_2bottom">
                                                    <div>
                                                    	<div class="bold">
                                                        	<div class="msg_checkbox"><input type="checkbox" name="allbox" onclick="checkAll()" id="allbox" value="<?php $question->quiz_id ?>" class="allbox"/></div>
                                                        	
                                                                <div class="addoptional_desc"><a href="javascript:;" onclick="checkAllBoxes()">Check All</a>
                                                                    &nbsp;&nbsp;&nbsp; <a href="#" id="delete_all">Delete All</a>
                                                                        <?php if($type=='video')$add_question='addVideoQuestion'; else $add_question = 'addPhotoQuestion';?>
                                                                    <a href="<?=base_url()?>member/<?=$add_question?>" style="margin-left:20px">Add new question</a></div>
                                                        
                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="padding_2bottom">
                                                    <div class="bg_blue">
                                                    	<div class="bold">
                                                        	<div class="msg_checkbox">&nbsp;</div>
                                                        	<div class="viewimg"><?if($type=="video") echo "Video"; else echo "Photo" ?> quizzes</div>
                                                            <div class="viewques">Your Questions</div>
                                                            <div class="msg_date text_center">Edit</div>
                                                            <div class="msg_date text_center">Delete</div>
                                                        
                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="">
                                          <?
                                          //print_r($question_list);
                                          if(count($question_list)> 0) {
                                          foreach($question_list as $question){ ?>
                                               
                                                <div class="padding_2bottom" id="list">
                                                    <div class="bg_lightblue">
                                                        <div>
                                                            <div class="msg_checkbox">
                                                                <input type="checkbox" name="name_<?=$question->quiz_id?>" value="<?=$question->quiz_id?>" class="check_name" />
                                                            </div>

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
                                                                            if(file_exists($a)){
                                                                            ?>
                                                                                <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$video_image?>" alt="feature quest img" />
                                                                            <? } else {?>
                                                                                <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                            <? }?>
                                                                        </a>
                                                                    <?} else { ?>
                                                                        <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>">
                                                                            <? 
                                                                            if($_SERVER['SERVER_NAME']=='localhost')
                                                                            $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$question->images;
                                                                            #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$question->images;
                                                                            else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$question->images;
                                                                            
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
                                                            <div class="viewques">
                                                                <a href="<?=site_url('quiz/view/'.$question->quiz_id)?>"><?=$question->quiz_question?></a>
                                                            </div>
                                                            <div class="msg_date text_center">
                                                                <?php if($question->quiz_type =='photo') $url ='editPhotoQuestion'; else $url = 'editVideoQuestion'?>
                                                                <a href="<?=base_url()?>member/<?=$url?>/<?=$question->quiz_id?>/<?=$question->image_id;?>/unset" id="edit">
                                                                    <img src="<?=base_url()?>images/edit.png"  />
                                                                </a>

                                                            </div>
                                                            <div class="msg_date text_center">
                                                                <a style="cursor:pointer" id="delete" onclick="delete_quiz(<?=$question->quiz_id?>)">
                                                                    <img src="<?=base_url()?>images/delete.png"  />
                                                                </a>
                                                            </div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? }?>
                                                    <div style="text-align:right"><?=$pagination?></div>
                                        <?} else { ?>
                                                <div>There are no questions!</div>
                                                <? }?>
                                                </div>
                                        </div>
                                	</div>
                                
                                </form>
                            </div>
                        </div>
                        <div class="longwhitebox_bottomborder"></div>
                    </div>
                </div>
            </div>
        
                <div class="clear"></div>
            </div>
            
        </div>
    	<div class="clear"></div>
    </div>
</div>



