<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
     
    stLight.options({publisher:'dd0b74cb-f06f-4778-9887-b0c1bda3b021'});
      
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">
<link rel="styleshseet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>
                
     
<script>
        
</script>
<script type="text/javascript">
$(document).ready(function() {
	<? 
        if(count($quiz_info)>0){
        foreach($quiz_info as $quizInfo){

        $avg_rating=$this->Quiz_model->calculate_total_rating($quizInfo->quiz_id);
        
        ?>
		$('#rate_<?=$quizInfo->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$quizInfo->quiz_id?>','<?=$avg_rating?>', {maxvalue:5,increment:.5});
	<? } }?>

});
</script>

<link rel="stylesheet" href="<?=base_url()?>jquery-tooltip/jquery.tooltip.css" />
<link rel="stylesheet" href="screen.css" />
<script src="<?=base_url()?>jquery-tooltip/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?=base_url()?>jquery-tooltip/lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="<?=base_url()?>jquery-tooltip/jquery.tooltip.js" type="text/javascript"></script>

<script src="<?=base_url()?>jquery-tooltip/chili-1.7.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
$("#foottip a").tooltip({
	bodyHandler: function() {
		return $($(this).attr("href")).html();
	},
	showURL: false
});
})
</script>


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
	else{
		$.post('<?=base_url()?>member/deletePlaylist', {ids:tt} , function(data){
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

		}
	});

});


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
    $.post('<?=base_url()?>member/deletePlaylist', {ids:quiz_id} , function(data){
        if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        $('#content_10box_'+quiz_id).hide('slow');

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
    });
    }
    }
    });
    
}

function delete_playlist_quiz(quiz_id)
{
    $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
    if(v){
    $.post('<?=base_url()?>member/deletePlaylistQuiz', {ids:quiz_id} , function(data){
        if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        $('#content_10box_'+quiz_id).hide('slow');

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
    });
    }
    }
    });

}

function submit_playlist()
{
    document.playlist.submit();
}

function edit_playlist(quiz_id){
	sendMessage(quiz_id);
}

		function sendMessage(quiz_id){
		var id= <?=$this->session->userdata('wannaquiz_user_id')?>;
                //var quiz_id = <?=$user->quiz_id?>;
		var txt = '<?php if($playlist) {?> <span id="" >Playlist Title: <select id="my_playlist" name="my_playlist"><?php if(count($playlist)>0) {foreach ($playlist as $play_list){?> <option value="<?=$play_list->playlist_title?>"><?=$play_list->playlist_title?></option>\n\
                <? }}?></select></span> <? }?><span style="padding-left:120px"><a style="cursor:pointer" onClick=test()>Create Playlist</a></span><div style="display:none" id="playlist_title">Playlist Title: <input type="text" id="" name="playlist" value="" /></div><input type="hidden" id="member_id" name="member_id" value="'+id+'" /><input type="hidden" id="quiz_id" name="quiz_id" value="'+quiz_id+'" />';

		jqistates = {
			state0: {
				html: txt,
				focus: 1,
				buttons: { Cancel: false, Send: true },
				submit: function(v, m, f){
				var e = "";
					if (v) {
						if (e == "") {
							if(f.playlist!='')
                                                        var playlist = f.playlist;
                                                        else
                                                            var playlist = f.my_playlist;
							var id=f.member_id;
							var quiz_id = f.quiz_id;
							if(playlist!=""){

								$.post('<?=base_url()?>quiz/editPlaylist', {id:id,playlist:playlist,quiz_id:quiz_id} , function(data){
								   if (data != '' || data != undefined || data != null)
								   {
										$.prompt("Success");
								   }
				 				 });

									return true;
								}
							else{
								jQuery.prompt.goToState('state1');
								}
						}

						return false;
					}
					else return true;
				}
			},
			state1: {
				html: '<span id="error">Required field missing. </span>',
				focus: 1,
				buttons: { Back: false, Cancel: true },
				submit: function(v,m,f){
					if(v)
						return true;
					jQuery.prompt.goToState('state0');
					return false;
				}
			}
		};
			$.prompt(jqistates);
    }


function test()
{ //alert('test');
    $('#playlist_title').show();
    //$('#my_playlist').hide();
}
</script>
<div class="playlist_right">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="longwhitebox_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:770px;">
                                    <div class="bold font14 color_white">My Playlist</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="longwhitebox_bg">
                            <div class="whiteboxrightside_bgInner">
                            	
                            	<div class="content_10box">
                                	<div class="padding_10topbottom">
                                    	<form name="playlist" action="" method="post">
                                            <div class="playlistcontent_left">
                                        	<div class="">
                                                    <label class="bold">Select playlist</label>
                                                    <?php// print_r($playlist) ?>
                                                    <select style="width:180px;" onChange="submit_playlist()" name="select_playlist">
                                                        <option value="select">Select Playlist</option>
                                                       <?php 
                                                         if(count($playlist)>0)
                                                        {
                                                            foreach($playlist as $play_list) {?>
                                                            <option value="<?=$play_list->playlist_id?>" <?php if($selected_playlist==$play_list->playlist_id)echo "selected=selected";?>><?=$play_list->playlist_title?></option>
                                                            <? }}?>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="playlistcontent_right">
                                        	<div class="playlistbtn_alignright">
                                            	 <!--<div class="searchbtn_leftborder"></div>
                                               <div class="searchbtn_bg"><a href="#">Create Playlist</a></div>
                                                <div class="searchbtn_rightborder" style="margin-right:5px;"></div>
                                                -->
<!--                                                <div class="greenbtn_leftborder"></div>
                                                <div class="greenbtn_bg"><a href="<?=site_url('member/addVideoQuestion')?>">Upload a Question's'</a></div>
                                                <div class="greenbtn_rightborder" style="margin-right:5px;"></div>
                                                <span id="foottip">-->
<!--                                                   <a href="#footnote"style="cursor:help"><img src="<?=base_url()?>images/questionmark.gif" width="16" height="16" alt="help" /></a>-->
                                                   <div id="footnote" style="display:none">Upload your video questions.</div>
                                                </span>
                                                
                                            	<div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                  
                                    <?php if(count($playlist_quizes)>0) {
                                        foreach($playlist_quizes as $playlistQuizes) { 
                                            $quiz_detail = $this->Quiz_model->get_quiz_detail_by_id($playlistQuizes->quiz_id);
                                         
                                           if(count($quiz_detail)>0){
                                           ?>


                                    <div class="padding_10topbottom" id="content_10box_<?php echo $playlistQuizes->quiz_id; ?>">
                                    	<div class="bg_blue">
                                            <div class="content_10box" >
                                            	<div class="playlistcontent_left">
                                                	<!--<div class="playbtn"><a href="#"><img src="<?=base_url()?>images/playbtn.png" width="41" height="34" alt="playnow" /></a></div>-->
                                                    <?php if($quiz_detail[0]->quiz_type == 'photo') {?>
                                                    <div class="playbtn">
                                                        <a href="<?=base_url()?>quiz/view/<?=$quiz_detail[0]->quiz_id?>">
                                                            <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$quiz_detail[0]->images;
                                                                #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$quiz_detail[0]->images;
                                                            else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$quiz_detail[0]->images;
                                                                    if(file_exists($photo_path)){
                                                                    ?>
                                                                        <img src="<?=base_url()?>photo_question_thumbs/<?=$quiz_detail[0]->images?>" alt="feature quest img" />
                                                                    <? } else {?>
                                                                        <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                            <? } ?>
                                                            <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$quiz_detail[0]->images?>" alt="song img"/>-->
                                                        </a>
                                                    </div>
                                                   <?php } else { ?>
                                                     <? $video=explode('.',$quiz_detail[0]->images)?>
                                            <a href="<?=base_url().'converted_videos/'.$video[0]?>.flv" style="display:block;width:180px;height:135px" id="player_<?=$quiz_detail[0]->quiz_id?>"></a>
                                            <? }?>
                                            <script>
                                                flowplayer("player_<?=$quiz_detail[0]->quiz_id?>", "flowplayer/flowplayer-3.1.5.swf",{
                                                    clip: {
                                                        // these two configuration variables does the trick
                                                        autoPlay: false,
                                                        autoBuffering: true // <- do not place a comma here
                                                    }
                                                });
                                            </script>
                                                    <div class="playlistdetail">
                                                    	<div class="playlistdetailInner">
                                                            <div class="bold"><a href="<?=base_url()?>quiz/views/<?=$quiz_detail[0]->quiz_id?>"><?=$quiz_detail[0]->quiz_question;?></a></div>
                                                            <!--<div class="font11">Description: <span class="bold">king of pop</span> </div>-->
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="playlistcontent_right">
                                                	<div>
                                                    	<?php if($quiz_detail[0]->quiz_type == 'video') {?>
                                                        <div class="general_form">
                                                            <div class="input_clear">
                                                                <label class="bold">URL</label>
                                                                <input type="text" class="textbox" value="<?=base_url()?>quiz/views/<?=$quiz_detail[0]->quiz_id?>" onfocus="this.select()" readonly="readonly"/>
                                                            </div>
                                                            <div class="input_clear">
                                                                <label class="bold">Embed</label>
                                                                 <? $video=explode('.',$quiz_detail[0]->images)?>
                                                                <textarea class="textbox" cols="26" style="height:50px" onfocus="this.select()" readonly="readonly"><embed src="<?=base_url()?>flvplayer/player.swf?file=<?=base_url().'converted_videos/'.$video[0]?>.flv&autoStart=true" width="320" height="240" quality="medium" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></textarea>
                                                            </div>
                                                        </div>
                                                        <? }?>
                                                    </div>
                                                </div>
                                            	<div class="clear"></div>
                                            </div>
                                            <div class="separator_blue"></div>
                                            <div class="content_10box">
                                            	<div class="playlistcontent_left">
                                                	<div class="graybtn_leftborder"></div>
                                                        <div class="graybtn_bg"><a href="#" onclick="edit_playlist(<?=$playlistQuizes->quiz_id?>)">Edit</a></div>
                                                    <div class="graybtn_rightborder" style="margin-right:10px;"></div>
                                                    <div class="graybtn_leftborder"></div>
                                                    <div class="graybtn_bg"><a href="#" onclick="delete_playlist_quiz(<?=$playlistQuizes->quiz_id?>)">Delete Quiz</a></div>
                                                    <div class="graybtn_rightborder"></div>
                                                </div>
                                                
                                            	<div class="playlistcontent_right">
                                                	<div class="playicons_align">
                                                    	<div class="play_icon"><a href="<?=base_url()?>quiz/views/<?=$quiz_detail[0]->quiz_id?>">Play </a></div>
                                                        <div class="share_icon">
                                                             <span  class="st_sharethis" st_url="http://www.wannaquiz.com/quiz/view/<?=$quiz_detail[0]->quiz_id?>" displayText="Share this Quiz"></span>
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <? } } } else echo "There are no any quizes in this playlist yet!";?>
                                   <!-- <div class="padding_10topbottom">
                                    	<div class="playlistcontent_left">
                                        	<div class="searchbtn_leftborder"></div>
                                            <div class="searchbtn_bg"><a href="#" style="padding:0 5px;">Remove Questions</a></div>
                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                        <div class="playlistcontent_right">
                                        	<div class="playlistbtn_alignright">
                                            	<div class="searchbtn_leftborder"></div>
                                                <div class="searchbtn_bg"><a href="#" style="padding:0 5px;">Rearrange</a></div>
                                                <div class="searchbtn_rightborder"></div>
                                                
                                            	<div class="clear"></div>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>-->
                                    
                                </div>
                                <div>
                                <div class="borderbottom_dotted"></div>
                               
                                
                                <div class="content_10box">
                                    <div class="playlistbtn_alignright">
                                        <div class="pagination">
                                            <?php echo $this->pagination->create_links();?>
                                            <!--<ul>
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
                                </div>
                                
                            </div>
                        </div>
                        <div class="longwhitebox_bottomborder"></div>
                    </div>
                </div>
            </div>

