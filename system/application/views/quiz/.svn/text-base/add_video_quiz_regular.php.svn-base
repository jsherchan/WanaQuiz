<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<script src="<?=base_url()?>js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.limit-1.2.source.js"></script>
<!-- AJAX Upload script itself doesn't have any dependencies-->
    <script type="text/javascript" src="<?=base_url()?>js/ajaxupload.js"></script>
<script type="text/javascript">
function cropVideo(pause_time,total_time,cut_duration,video_name) {
		//get the ajax page and response
	  	$.post('<?=base_url()?>member/cropVideo', {pause_time:pause_time,total_time:total_time,cut_duration:cut_duration,video_name:video_name} , function(data){
			 if (data != '' || data != undefined || data != null){
				 		dt=data.split('*');
                                                //alert(dt[3]);
						$("#ans_video_right").html('');
						$("#ans_video_right").html(dt[2]);
                                                $("#question_video_right").html('');
						$("#question_video_right").html(dt[3]);
						$("#hidTest").val('');
						$("#hidTest").val(dt[1]);
                                                $("#quiz_videos").val(dt[0]);
				 }
         	});
     }
</script>

<script>
    //alert(getCookie('value'));
    function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function checkCookie(postUsername)
{
var username=getCookie(postUsername);
  if (username!=null && username!="")
  {
      return username;

  //alert("Welcome again " + username);
  }
else
  {
      return false;
  }
}

    $(document).ready(function () {
         $('#continue').click(function() {            
                var video_question = j('#quiz_videos').val();
                var video_answer = j('#hidTest').val();
               $.post('<?=base_url()?>quiz/testVideoLength', {video_question:video_question,video_answer:video_answer} , function(data){
                    if (data != '' || data != undefined || data != null)
                        {
                           var msg = data.split('%');
                            //alert(msg[1]);
                            if(msg[1]=='question_error')
                                alert("Your question video is too long. Videos may only be up to 25 seconds in length.");
                            if(msg[2]=='answer_error')
                                alert("Your answer video is too long. Videos may only be up to 25 seconds in length.");
                            
                            return false;
                        }
                });
        if(checkCookie('quiz_question')){
            $('#quiz_question').val(getCookie('quiz_question')) ;
        }

        if(checkCookie('quiz_answer1')){
            $('#multiple_answer1').val(getCookie('quiz_answer1')) ;
        }

        if(checkCookie('quiz_answer2')){
            $('#multiple_answer2').val(getCookie('quiz_answer2')) ;
        }

        if(checkCookie('quiz_answer3')){
            $('#multiple_answer3').val(getCookie('quiz_answer3')) ;
        }

        if(checkCookie('category')){
            $('#category').val(getCookie('category')) ;

        }
        if(checkCookie('quiz_comment')){
            $('#quiz_comment').val(getCookie('quiz_comment')) ;

        }
        if(checkCookie('radio')){
            //alert(getCookie('radio'));
            $('#radio_id_'+getCookie('radio')).attr('checked','checked') ;

        }
        $(".help_tip").click(function(){
         $(this).next().slideToggle(200);

                   });
     $(".close_help").click(function(){
         $(".close").hide();
     })

      $(".help_tip1").click(function(){
         $("#helpnote").slideToggle(200);

                   });

	$('#save').click(function() {
           
           // setCookie('quiz_question', $('#quiz_question').val(), 1);
           // setCookie('quiz_answer1', $('#multiple_answer1').val(), 1);
          //  setCookie('quiz_answer2', $('#multiple_answer2').val(), 1);
         //   setCookie('quiz_answer3', $('#multiple_answer3').val(), 1);
         //   setCookie('category', $('#category').val(), 1);
         //   setCookie('quiz_comment', $('#quiz_comment').val(), 1);
         //   setCookie('radio', $('input:radio[name=right_answer]:checked').val(), 1);
//            setCookie('quiz_answer3', $('#multiple_answer3').val(), 1);
//            setCookie('quiz_answer3', $('#multiple_answer3').val(), 1);


            
                if($('#quiz_videos').val()=="")
                {
                    alert("Question Video is required");
                    return false;
                }
                if($('#hidTest').val()==""){
                    alert("Answer Video is required");
                    return false;
                }
                if($('#quiz_question').val()=="")
                     {
                        alert("Question field is required");
                        return false;
                     }
                if($('#multiple_answer1').val()=="" || $('#multiple_answer2').val()=="" || $('#multiple_answer3').val()==""){
                    alert("All Answers required!");
                    return false;
                }
                if(document.getElementById('quizmaking').right_answer[0].checked== false && document.getElementById('quizmaking').right_answer[1].checked == false && document.getElementById('quizmaking').right_answer[2].checked== false)
                    {
                        alert("Select your answer!");
                        return false;
                    }

                if(document.getElementById('quizmaking').category.selectedIndex==0){
                    alert("Select category!");
                    return false;
                }

                else{
                    setCookie('quiz_question', '', -1);
                    setCookie('quiz_answer1', '', -1);
                    setCookie('quiz_answer2', '', -1);
                    setCookie('quiz_answer3', '', -1);
                    setCookie('category', '', -1);
                    setCookie('quiz_comment', '', -1);
			return true;
		}
	});

        $('#edit').click(function() {

                if($('#quiz_videos').val()=="")
                {
                    alert("Question Video is required");
                    return false;
                }
                if($('#hidTest').val()==""){
                    alert("Answer Video is required");
                    return false;
                }
                if($('#quiz_question').val()=="")
                     {
                        alert("Question field is required");
                        return false;
                     }
                if($('#multiple_answer1').val()=="" || $('#multiple_answer2').val()=="" || $('#multiple_answer3').val()==""){
                    alert("All Answers required!");
                    return false;
                }
                if(document.getElementById('quizmaking').right_answer[0].checked== false && document.getElementById('quizmaking').right_answer[1].checked == false && document.getElementById('quizmaking').right_answer[2].checked== false)
                    {
                        alert("Select your answer!");
                        return false;
                    }

                if(document.getElementById('quizmaking').category.selectedIndex==0){
                    alert("Select category!");
                    return false;
                }
                else{
			return true;
		}
	});


});
});
</script>
<div class="padding_10topbottom">
    <div class="quizmaking_topborder" style="overflow:visible; position:relative; z-index:2;">
            	<div class="title_align">
                    <div class="font13 bold" style="float:left; padding-right:20px; ">Create your questions and answers (with videos you have already uploaded)</div>
                        <div id="help1" style="position:relative; ">
                            <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                             <div class="close" style="display:none; position:absolute; width:400px; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:550px; background-color:#F0F0F0; line-height:1.4em">
                                 <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001" class="close_help" > X </p>
                                 <div style="padding: 0 0 10px 0; color:#000080; font-weight:bold">Options</div>
                                 <p><strong>Two videos: </strong></p>
                                 <p>
                                    If you have already prepared two videos (question and answer) just click on the thumbnail of your question first. After this press the thumbnail of your related video answer.
                                 </p><br>
                                 <p><strong>One (longer) video </strong></p>
                                 <p>
                                    When you have one longer video (with both your question and answer in it) you also first click the thumbnail of your video. It will load in the left editor. After this play the video and pause it wherever you want. Then click the "cut button" and you will end up with two videos: your question and answer. <br><br>
                                    Note: your question, nore your answer may be longer than 25 seconds. This means your longer video (before the cut) can only be up to 50 seconds.
                                 </p><br>
                                 
                                 <div><a href="<?=base_url()?>home/help_center" style="font-weight:bold">Help</a></div>
                            </div>
                       </div>
                </div>
            </div>

            <div class="quizmaking_bg" style="position:relative; z-index:1;">
            	<div class="whiteboxrightside_bgInner">
                	<div class="borderbottom_dotted"></div>
                	<div class="content_10box">
                    	<div class="padding_10leftright">

                            <?php include('quiz_slider.php');?>
                            <?php if($edit==0)
                            $action = site_url('quiz/addVideoQuizRegular');
                            else $action = site_url('quiz/editVideoQuizRegular');
                            ?>
                        	<form name="quizmaking" action="<?=$action?>" method="post" id="quizmaking">
                                <input type="hidden" name="quiz_id" value="<?=$quiz_info->quiz_id?>" id="quiz_id" />
                                <input type="hidden" name="quiz_videos" value="<?=$ques_video?>" id="quiz_videos"/>
                                <input type="hidden" name="video_answer" id="hidTest" value="<?=$ans_video?>" />

                                <div class="padding_10topbottom">
                                    <div class="quizansvideo_left" id="question_video_right">
                                    	<div class="quizansvideo_leftInner">
                                        	<div class="padding_10topbottom">
                                            	<div class="font16">Your question (cut the answer if necessary) <img src="<?=base_url()?>images/arrowdown_gray.jpg" width="12" height="13" alt="arrow down" />
                                                    <?php if($edit==0)$page = 'undoAddVideoQuestion'; else $page = 'undoEditVideoQuestion/'.$quiz_id;?><a href="<?=base_url()?>member/<?=$page?>/first">Undo</a>
                                                </div>
                                            </div>
                                        	<!--<img src="<?=base_url()?>images/quizans_img1.jpg" width="490" height="334" alt="quiz answer video" />-->

                                            <div class="border_green" id="video_question"></div>
                                             <?php /*if($edit==1) { */
                                             $vid_ques = explode(".",$ques_video);
                                             if($ans_video!='')
                                             $s = "play";
                                             else $s="no_play";
                                             //echo $vid_ques[0];//exit;
											 if($vid_ques[0]==""){
												 $vid_ques[0]="novideo";
											 }?>
                                                <!--<a href="<?=base_url().'uploaded_video_questions/'.$vid_ques[0].'.flv'?>" style="display:block;width:180px;height:135px" id="player_a"></a>
                                                <script>
                                                    flowplayer("player_a", "<?=base_url()?>flowplayer/video.swf",{
                                                        clip: {
                                                            // these two configuration variables does the trick
                                                            autoPlay: false,
                                                            autoBuffering: true // <- do not place a comma here
                                                        }
                                                    });
                                                </script>  -->
                                                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="490" HEIGHT="308" id="banner_rotativo" ALIGN="">

                                    <PARAM NAME=movie VALUE="<?=base_url()?>flowplayer/video.swf?q=<?=$vid_ques[0]?>.flv&s=<?=$s?>">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#000000>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <EMBED wmode="opaque" src="<?=base_url()?>flowplayer/video.swf?q=<?=$vid_ques[0]?>.flv&s=<?=$s?>" quality=high bgcolor=#000000 WIDTH="490" HEIGHT="308" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                     </OBJECT>
                                                <? /*}*/ ?>
                                            <!--<div style="padding-top:15px;">
                                                <div class="searchbtn_leftborder"></div>
                                                <div id="button1" class="searchbtn_bg" style="width:198px;"> Upload</div>
                                                <div class="searchbtn_rightborder"></div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="quizansvideo_right" id="ans_video_right">
                                    	<div class="padding_10topbottom">
                                        	<div class="font16">The answer <img src="<?=base_url()?>images/arrowdown_gray.jpg" width="12" height="13" alt="arrow down" />
                                                    <?php if($edit==0)$page = 'undoAddVideoQuestion'; else $page = 'undoEditVideoQuestion/'.$quiz_id;?><a href="<?=base_url()?>member/<?=$page?>/second">Undo</a>
                                                </div>
                                        </div>
                                    	<!--<img src="<?=base_url()?>images/quizans_img2.jpg" width="490" height="334" alt="quiz answer video" />-->
                                        <div class="border_green" id="video_answer"></div>
                                         <?php /*if($edit==1) { */
										 $vid_ans = explode(".",$ans_video);
										 if($vid_ans[0]==""){
										 $vid_ans[0] = "novideo";
										 }?>
                                                <!--<a href="<?=base_url().'uploaded_video_answers/'.$vid_ans[0].'.flv'?>" style="display:block;width:180px;height:135px" id="player_b"></a>
                                                <script>
                                                    flowplayer("player_b", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                                                        clip: {
                                                            // these two configuration variables does the trick
                                                            autoPlay: false,
                                                            autoBuffering: true // <- do not place a comma here
                                                        }
                                                    });
                                                </script>  -->
                                                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="490" HEIGHT="308" id="banner_rotativo" ALIGN="">

                                    <PARAM NAME=movie VALUE="<?=base_url()?>flowplayer/video_ans.swf?q=<?=$vid_ans[0]?>.flv">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#000000>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <EMBED wmode="opaque" src="<?=base_url()?>flowplayer/video_ans.swf?q=<?=$vid_ans[0]?>.flv" quality=high bgcolor=#000000 WIDTH="490" HEIGHT="308" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                     </OBJECT>
                                                <? /*}*/ ?>
                                        <!--<div style="padding-top:15px;">
                                            <div class="searchbtn_leftborder"></div>
                                            <div id="button2" class="searchbtn_bg" style="width:198px;"> Upload</div>
                                            <div class="searchbtn_rightborder"></div>
                                        </div>-->
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div>
                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                            <span class="color_orange">*</span> This question is:
                                            <div id="help1" style="position:relative;">
                                                <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                                                 <div class="close" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                     <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001" class="close_help" > X </p>
                                                     <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000">If a question is Hard or Average will be a bit of a judgement call. Perhaps you are an expert in a certain field, then please keep the "average" non-expert in mind. Would a non-expert find your question hard or is it general knowledge (average)?</p>
                                                </div>
                                           </div>
                                        </div>

                                        <div class="quizmakingform_right">
                                            <div class="padding_5bottom">
                                                <div class="catsub_left">
                                                    <div class="hard_history"><a href="#" class="color_white bold">Hard</a></div>
                                                </div>
                                                <?php
                                                if($quiz_info->quiz_level == '3')
                                                $checked2 = 'checked';
                                                else $checked1 = 'checked';
                                                ?>
                                                <div class="quizmakingform_checkbox padding_5top">
                                                    <input type="radio" name="quiz_level" value="3" <?=$checked2?>/>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="padding_5bottom">
                                                <div class="catsub_left">
                                                            <div class="avg_history"><a href="#" class="color_white bold">Average</a></div>
                                                        </div>

                                                <div class="quizmakingform_checkbox padding_5top">
                                                    <input type="radio"  name="quiz_level" value="2" <?=$checked1?>/>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                            <span class="color_orange">*</span>  Type your question in one sentence:
                                            <div class="font11 italic"this way people can find your question using search engines)
                                                <div id="help2" style="position:relative;">
                                                    <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                                                     <div class="close" style="display:none; position:absolute; width:auto; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                         <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001; font-style:normal" class="close_help"> X</p>
                                                         <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000;"><img src="<?=base_url()?>images/video_text.png"></p>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>

                                        <div class="quizmakingform_right">
                                            <textarea class="textbox" style="width:610px; height:70px;" name="quiz_question" id="quiz_question"><?=$quiz_info->quiz_question?></textarea>
                                            <label>&nbsp;</label><span style="font-size:10px"><span id="question_div"></span> chars left.</span>
                                            <script type="text/javascript">
                                                $('#quiz_question').limit('85','#question_div');
                                            </script>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                            <span class="color_orange">*</span>Enter three multiple choice answers:
                                            <div><span class="font11 italic">(keep the answers short and click the radio button next to the right answer )</span>
                                                <div id="help3" style="position:relative;">
                                                    <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                                                     <div class="close" style="display:none; position:absolute; width:auto; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                         <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001; font-style:normal" class="close_help"> X </p>
                                                         <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000;"><img src="<?=base_url()?>images/video_text1.png"></p>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>

                                        <div class="quizmakingform_right">
                                            <div class="padding_5bottom">
                                            	<!--<div class="quizmakingform_radio">
                                                    <?php if($quiz_info->quiz_question_type == 'open')
                                                    $checked3= 'checked';
                                                    else $checked4 = 'checked';
                                                    ?>
                                            	<label>Open question</label>
                                                <input type="radio" name="quiz_question_type" value="open" id='open_question' <?=$checked3?>/>
                                                <label>Multiple choice </label>
                                                <input type="radio" name="quiz_question_type" value="multiple" id='multiple_question' <?=$checked4?>/>
                                                </div>-->
                                                <div class="clear"></div>
                                            </div>
                                            <div id="option_block">
                                                <?php if($quiz_info->right_option=='option3')
                                                    $option3='checked';
                                                elseif($quiz_info->right_option=='option2')
                                                    $option2='checked';
                                                else $option1='checked';
                                                ?>
                                                <div class="input_clear">
                                                    <div class="quizmakingform_checkbox">A</div>
                                                    <div class="quizmakingform_inputleft" style="width:360px;">
                                                        <input type="text" class="textbox" name="option1" style="width:340px;" value="<?=$quiz_info->option1?>" id="multiple_answer1"/>
                                                        <label>&nbsp;</label><span style="font-size:10px"><span id="answer1"></span> chars left.</span>
                                                        <script type="text/javascript">
                                                            $('#multiple_answer1').limit('65','#answer1');
                                                        </script>
                                                    </div>
                                                    <div class="quizmakingform_checkbox">
                                                        <input type="radio" name="right_answer" value="option1" id="radio_id_option1" <?=$option1?>/>
                                                    </div>

                                                    <div class="clear"></div>
                                                </div>
                                                <div class="input_clear">
                                            	<div class="quizmakingform_checkbox">B</div>
                                                <div class="quizmakingform_inputleft" style="width:360px;">
                                                    <input type="text" class="textbox" name="option2" style="width:340px;" value="<?=$quiz_info->option2?>" id="multiple_answer2"/>
                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="answer2"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        $('#multiple_answer2').limit('65','#answer2');
                                                    </script>
                                                </div>
                                                <div class="quizmakingform_checkbox">
                                                    <input type="radio" name="right_answer"  value="option2" id="radio_id_option2" <?=$option2?>/>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                            <div class="input_clear">
                                            	<div class="quizmakingform_checkbox">C</div>
                                                <div class="quizmakingform_inputleft" style="width:360px;">
                                                    <input type="text" class="textbox" name="option3" style="width:340px;" value="<?=$quiz_info->option3?>" id="multiple_answer3"/>
                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="answer3"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        $('#multiple_answer3').limit('65','#answer3');
                                                    </script>
                                                </div>
                                                <div class="quizmakingform_checkbox">
                                                    <input type="radio" name="right_answer"  value="option3" id="radio_id_option3" <?=$option3?>/>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                            </div>
                                            <!--<div class="input_clear" id="single_question_block1" style="display:none;">
                                                <div class="quizmakingform_checkbox"></div>
                                                <div class="quizmakingform_inputleft" style="width:360px;">
                                                    <input type="text" class="textbox" name="single_question" style="width:340px;" value="<?=$quiz_info->single_line_answer?>"/>
                                                </div>
                                                <div class="quizmakingform_checkbox"></div>

                                                <div class="clear"></div>
                                            </div>-->

                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                            <span class="color_orange">*</span> Select Category:
                                        </div>

                                        <div class="quizmakingform_right">
                                            <div class="padding_5bottom">
                                            	<div class="quizmakingform_radio">
                                                    <select id="category" name="category" >
                                                        <option value="">Select Category</option>
                                                        <?php
                                                        if(count($category)>0) {
                                                        foreach($category as $categories) {
                                                        $subcategory = $this->Category_model->get_sub_categories($categories->id);
                                                        ?>

                                                        <option value="<?php echo $categories->id; ?>" <? if($categories->id==$quiz_info->category_id) echo "selected"?>><?=$categories->name?></option>
                                                        <?php
                                                        if(count($subcategory)>0){
                                                        foreach($subcategory as $subcategories) {?>
                                                        <option style="display:block; " value="<?php echo $subcategories->id; ?>" <? if($subcategories->id==$quiz_info->category_id) echo "selected"?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subcategories->name; ?></option>

                                                        <?}}}}?>
                                                    </select>
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                     <?php if($quiz_info->quiz_suitable_for=='3')
                                                $age3='checked';
                                                elseif($quiz_info->quiz_suitable_for=='2')
                                                $age2='checked';
                                                else $age1='checked';
                                                ?>
                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                            <span class="color_orange">*</span> This question is suitable for:
                                        </div>

                                        <div class="quizmakingform_right">
                                            <div class="padding_5bottom">
                                            	<div class="quizmakingform_radio">
                                            	<label>All ages</label>
                                                <input type="radio" name="quiz_suitable_for" value="1" <?=$age1?> />
                                                <label style="width:60px; text-align:right;">Adult </label>
                                                <input type="radio" name="quiz_suitable_for" value="3" <?=$age3?> />
                                                <label style="width:60px;">
                                                    <div id="help4">
                                                        <div class="help_tip1" style="cursor:pointer; color:#0066CC"> Help </div>
                                                   </div>
                                                </label>
                                                <div style="position:relative; float:left;">
                                                    <div id="helpnote" class="close" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                         <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001" class="close_help"> X </p>
                                                         <p><strong>All ages: </strong>Seems clear</p><br>
                                                          <p><strong>Adult: </strong>Questions about movies, tv-shows ("Sex and the City", "Spartacus" etc.) or e.g. historical events that are of an adult nature. "Scary" imagery is allowed, real nudity not.</p>
                                                         <div><a href="<?=base_url()?>home/show/age_appropriate">Read more</a></div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>

                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                                                   
                                    
                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                           Comment with this question: <span class="font11 italic">(shown on same page as the question)</span>
                                        </div>

                                        <div class="quizmakingform_right">
                                            <textarea class="textbox"  name="quiz_comment" id="quiz_comment" style="width:610px; height:70px;"><?=$quiz_info->quiz_comment?></textarea>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                </div>

                                <div class="input_clear">
                                	<div style="padding-left:240px;">
                                	<div class="searchbtn_leftborder"></div>
                                        <?php if($edit==1) {
                                            $value='Edit';
                                        }
                                        else {
                                            $value = 'Save';
                                        }?>

                                    <input type="submit" class="searchbtn_bg" value="<?=$value?>" name="submit" id="continue"/>
                                    <div class="searchbtn_rightborder"></div>

                                    <div class="clear"></div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                 <div class="quizmaking_bottomborder"></div>
            </div>
           
        </div>