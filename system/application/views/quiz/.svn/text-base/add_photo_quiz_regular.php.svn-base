<script type="text/javascript" src="<?=base_url()?>crop_js/jquery-pack.js"></script>
<script type="text/javascript" src="<?=base_url()?>crop_js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.limit-1.2.source.js"></script>
 <script type="text/javascript">
//function preview(img, selection) {
//	var scaleX = 300 / selection.width;
//	var scaleY = 300 / selection.height;
//
//
//	$('#preview').css({
//		width: Math.round(scaleX *<?=$image_width?>) + 'px',
//		height: Math.round(scaleY * <?=$image_height?>) + 'px',
//		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
//		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
//	});
//	$('#x1').val(selection.x1);
//	$('#y1').val(selection.y1);
//	$('#x2').val(selection.x2);
//	$('#y2').val(selection.y2);
//	$('#w').val(selection.width);
//	$('#h').val(selection.height);
//}

$(document).ready(function () { //alert("hi");
    //for(i=1;i<=5;i++){
     $(".help_tip").click(function(){ 
         $(this).next().slideToggle(200);

                   });
      
     $(".close_help").click(function(){
         $(".close").hide();
     })
    //}

    $(".help_tip1").click(function(){
         $("#helpnote").slideToggle(200);

                   });

	$('#save').click(function() {
            //alert(document.getElementById('quizmaking').quiz_question_type[0].checked);
//		var x1 = $('#x1').val();
//		var y1 = $('#y1').val();
//		var x2 = $('#x2').val();
//		var y2 = $('#y2').val();
//		var w = $('#w').val();
//		var h = $('#h').val();
//		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h=="" || < ?=$image_width?>==''){
//			alert("You must make a selection for the question!");
//			return false;
//		}               
                if($('#ques_photo').val()=="")
                {
                    alert("Question image is required");
                    return false;
                }
                if($('#ans_photo').val()==""){
                    alert("Answer image is required");
                    return false;
                }
                 if($('#quiz_question').val()=="")
                     {
                        alert("Question field is required");
                        return false;
                     }
//                if(document.getElementById('quizmaking').quiz_question_type[0].checked== true && $('#single_question').val()==""){
//
//                    alert("Answer required!");
//                    return false;
//                }
                if($('#multiple_answer1').val()=="" || $('#multiple_answer2').val()=="" || $('#multiple_answer3').val()==""){
                    alert("All Answers required!");
                    return false;
                }
                if(document.getElementById('quizmaking').right_answer[0].checked== false && document.getElementById('quizmaking').right_answer[1].checked == false && document.getElementById('quizmaking').right_answer[2].checked== false)
                    {
                        alert("Select your answer!");
                        return false;
                    }
                if($('#category').val()=="")
                     {
                        alert("Category field is required");
                        return false;
                     }
                else{
			return true;
		}
	});

        $('#edit').click(function() {
//		var x1 = $('#x1').val();
//		var y1 = $('#y1').val();
//		var x2 = $('#x2').val();
//		var y2 = $('#y2').val();
//		var w = $('#w').val();
//		var h = $('#h').val();
//		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
//			alert("You must make a selection for the question");
//			return false;
//		}

                 if($('#ques_photo').val()=="")
                {
                    alert("Question image is required");
                    return false;
                }
                if($('#ans_photo').val()==""){
                    alert("Answer image is required");
                    return false;
                }
                if($('#quiz_question').val()=="")
                    alert("Question field is required");
                if(document.getElementById('quizmaking').quiz_question_type[0].checked== true && $('#single_question').val()==""){

                    alert("Answer required!");
                    return false;
                }
                if(document.getElementById('quizmaking').quiz_question_type[1].checked== true && $('#multiple_answer1').val()=="" || $('#multiple_answer2').val()=="" || $('#multiple_answer3').val()==""){
                    alert("All Answers required!");
                    return false;
                }
                if(document.getElementById('quizmaking').right_answer[0].checked== false && document.getElementById('quizmaking').right_answer[1].checked == false && document.getElementById('quizmaking').right_answer[2].checked== false)
                    {
                        alert("Select your answer!");
                        return false;
                    }
                else{
			return true;
		}
	});


    $('#open_question').click(function(){
        $('#option_block').hide();
        $('#single_question_block').show();
    });

    $('#multiple_question').click(function(){
        $('#option_block').show();
        $('#single_question_block').hide();
    });
}); 

//$(window).load(function () {
//	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
//});


</script>
<div class="padding_10topbottom">
        	<div class="quizmaking_topborder">
            	<div class="title_align">
                	<div class="font13 bold">Create your questions and answers (with photos you have already uploaded)</div>
                </div>
            </div>
            <div class="quizmaking_bg">
            	<div class="whiteboxrightside_bgInner">
                	<div class="borderbottom_dotted"></div>
                	<div class="content_10box">
                    	<div class="padding_10leftright">
                            <?php if($edit==0)
                            $action = site_url('quiz/addPhotoQuizRegular');
                            else $action = site_url('quiz/editPhotoQuizRegular');
                            ?>
                        	<form name="quizmaking" action="<?=$action?>" method="post" id="quizmaking">
                            	<input type="hidden" name="image_id" value="<?=$ans_id?>">
                                <input type="hidden" name="ques_image" value="<?=$ques_photo?>" id="ques_photo">
                                <input type="hidden" name="ans_image" value="<?=$ans_photo?>" id="ans_photo">
                               <!-- Crop Image hidden fields -->
                               <!-- <input type="hidden" name="x1" value="" id="x1" />
                                <input type="hidden" name="y1" value="" id="y1" />
                                <input type="hidden" name="x2" value="" id="x2" />
                                <input type="hidden" name="y2" value="" id="y2" />
                                <input type="hidden" name="w" value="" id="w" />
                                <input type="hidden" name="h" value="" id="h" />
                                <input type="hidden" name="large_image_name" value="< ?=$ques_photo?>">-->
                                <?php if($edit==1) {?>
                                <input type="hidden" name="quiz_id" value="<?=$quiz_info->quiz_id?>" id="quiz_id" />
                                <? }?>
                              
                               <!--  End of crop hidden fields -->
                               <?php /*if($edit==0){ */?>
                                

                               <?php include('photo_quiz_slider.php');?>
                                
                                <div class="content_wrap">
                                	<div class="video_radio">
                                    	<label>Choose a photo above: it appears in the player</label>
                                       
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <? /*}*/?>
                                <div class="padding_10topbottom">
                                	<div class="quizansvideo_left">
                                    	<div class="quizansvideo_leftInner">
                                        	<div class="padding_10topbottom">
                                            	<div class="font16">The Question <img src="<?=base_url()?>images/arrowdown_gray.jpg" width="12" height="13" alt="arrow down" /> 
                                                    <?php if($edit==0)$page = 'undoAddPhotoQuestion'; else $page = 'undoEditPhotoQuestion/'.$quiz_id;?><a href="<?=base_url()?>member/<?=$page?>/first">Undo</a>
                                                </div>
                                            </div>
                                            
                                        	<? if($ques_photo==""){
												
												?>
                                            <img src="<?=base_url()?>images/quizans_img2.jpg" style="float: left; margin-right: 10px;" alt="quiz answer video" id="thumbnail" width="490" height="334"/><? } else{
												$image=base64_encode('photo_question_images/'.$ques_photo);
												?>
                                              <img src="<?=site_url('pictures/sizeit/490/334/'.$image)?>" style="float: left; margin-right: 10px;" alt="quiz answer video" id="thumbnail" />
                                            <? }?>
                                            
                                        </div>
                                    </div>
                                    <div class="quizansvideo_right">
                                    	<div class="padding_10topbottom">
                                        	<div class="font16">Your Answer <img src="<?=base_url()?>images/arrowdown_gray.jpg" width="12" height="13" alt="arrow down" />
                                                    <?php if($edit==0)$page = 'undoAddPhotoQuestion'; else $page = 'undoEditPhotoQuestion/'.$quiz_id;?><a href="<?=base_url()?>member/<?=$page?>/second">Undo</a>
                                                </div>
                                        </div>
                                        <!--<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:490px; height:334px;">-->
				<? if($ans_photo==""){?>
                                    	<img src="<?=base_url()?>images/quizans_img2.jpg" style="position: relative;" alt="Thumbnail Preview" />
                                    <? }else {$image=base64_encode('photo_question_images/'.$ans_photo);?>
                                              <img src="<?=site_url('pictures/sizeit/490/334/'.$image)?>" style="float: left; margin-right: 10px;" alt="quiz answer video" id="thumbnail" />
                                     <? }?>
                                        <!--</div>-->
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
                                            <div class="font11 italic">(this way people can find your question using search engines)
                                                <div id="help2" style="position:relative;">
                                                    <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                                                     <div class="close" style="display:none; position:absolute; width:auto; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                         <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001; font-style:normal" class="close_help"> X </p>
                                                         <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000"><img src="<?=base_url()?>images/photo_text.png"></p>
                                                    </div>
                                                </div>
                                           </div>
                                            
                                        </div>
                                        
                                        <div class="quizmakingform_right">
                                            <textarea class="textbox" style="width:610px; height:70px;" name="quiz_question" id="quiz_question"><?=$quiz_info->quiz_question?></textarea>
                                            <label>&nbsp;</label><span style="font-size:10px"><span id="question_div"></span> chars left.</span>
                                            <script type="text/javascript">
                                                jQuery('#quiz_question').limit('85','#question_div');
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
                                                         <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000"><img src="<?=base_url()?>images/photo_text1.png"></p>
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
                                                        jQuery('#multiple_answer1').limit('65','#answer1');
                                                    </script>
                                                </div>
                                                <div class="quizmakingform_checkbox">
                                                    <input type="radio" name="right_answer" value="option1" <?=$option1?>/>
                                                </div>
                                                
                                                <div class="clear"></div>
                                            </div>
                                            <div class="input_clear">
                                            	<div class="quizmakingform_checkbox">B</div>
                                                <div class="quizmakingform_inputleft" style="width:360px;">
                                                    <input type="text" class="textbox" name="option2" style="width:340px;" value="<?=$quiz_info->option2?>" id="multiple_answer2"/>
                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="answer2"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        jQuery('#multiple_answer2').limit('65','#answer2');
                                                    </script>
                                                </div>
                                                <div class="quizmakingform_checkbox"><input type="radio" name="right_answer"  value="option2" <?=$option2?>/></div>
                                                
                                                <div class="clear"></div>
                                            </div>
                                            <div class="input_clear">
                                            	<div class="quizmakingform_checkbox">C</div>
                                                <div class="quizmakingform_inputleft" style="width:360px;">
                                                    <input type="text" class="textbox" name="option3" style="width:340px;" value="<?=$quiz_info->option3?>" id="multiple_answer3"/>
                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="answer3"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        jQuery('#multiple_answer3').limit('65','#answer3');
                                                    </script>
                                                </div>
                                                <div class="quizmakingform_checkbox"><input type="radio" name="right_answer"  value="option3" <?=$option3?>/></div>
                                                
                                                <div class="clear"></div>
                                            </div>
                                           </div>

                                            <!--<div class="input_clear" id="single_question_block" style="display:none;">
                                            	<div class="quizmakingform_checkbox"></div>
                                                <div class="quizmakingform_inputleft" style="width:360px;"><input type="text" class="textbox" name="single_question" style="width:340px;" value="<?=$quiz_info->single_line_answer?>" id="single_question"/></div>
                                                <div class="quizmakingform_checkbox"></div>

                                                <div class="clear"></div>
                                            </div>-->
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>

                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                           Type your (longer) answer in one sentence:
                                           <div><span class="font11 italic">(your longer answer will be shown at the foot of your second photo)</span>
                                              <div id="help4" style="position:relative;">
                                                    <img src="<?=base_url()?>images/1306307357_help-browser.png" class="help_tip" style="cursor:pointer; ">

                                                     <div class="close" style="display:none; position:absolute; width:auto; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0; line-height:1.4em">
                                                         <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001; font-style:normal" class="close_help"> X </p>
                                                         <p style="margin-top:-14px; padding-right:14px; position:relative; z-index:10000"><img src="<?=base_url()?>images/photo_text2.png">.</p>
                                                    </div>
                                               </div>
                                           </div>
                                        </div>

                                        <div class="quizmakingform_right">
                                            <textarea class="textbox"  name="quiz_long_answer" style="width:610px; height:70px;" id="quiz_long_answer"><?=$quiz_info->quiz_long_answer?></textarea>
                                            <label>&nbsp;</label><span style="font-size:10px"><span id="long_answer"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        jQuery('#quiz_long_answer').limit('85','#long_answer');
                                                    </script>
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
                                                    <select id="category" name="category">
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
                                                        <option style="display:block " value="<?php echo $subcategories->id; ?>" <? if($subcategories->id==$quiz_info->category_id) echo "selected"?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subcategories->name; ?></option>
                                                                                                              
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
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                             <div class="clear"></div>
                                           
                                         </div>
                                                                                               
                                        
                                          
                                        <div class="clear"></div>
                                    </div>
                                
                                    
                                    <div class="padding_10topbottom">
                                        <div class="quizmakingform_left">
                                           Comment with this question: <span class="font11 italic">(shown on the same page as the question)</span>
                                        </div>
                                        
                                        <div class="quizmakingform_right">
                                            <textarea class="textbox"  name="quiz_comment" style="width:610px; height:70px;"><?=$quiz_info->quiz_comment?></textarea>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    
                                </div>
                                
                                <div class="input_clear">
                                	<div style="padding-left:240px;">
                                	<div class="searchbtn_leftborder"></div>
                                        <?php if($edit==0){?>
                                    <input type="submit" class="searchbtn_bg" value="Save" name="submit" id="save"/>
                                    <? } else {?>
                                    <input type="submit" class="searchbtn_bg" value="Edit" name="submit" onclick="editQuestion()" id="edit"/>
                                    <?}?>
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

        