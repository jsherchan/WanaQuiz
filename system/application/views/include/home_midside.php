<?
#$ip= $_REMOTE_ADDR;

#echo 'myip: ' . $data['ip']= GetHostByName($ip);
?>
<!--<link rel="stylesheet" href="<?=base_url()?>anythingslider/css/page.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url()?>anythingslider/css/slider.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?=base_url()?>anythingslider/js/jquery.easing.1.2.js"></script>
<script src="<?=base_url()?>anythingslider/js/jquery.anythingslider.js" type="text/javascript" charset="utf-8"></script> -->

<!--
  jCarousel library
-->
<!--link href="<?php echo base_url();?>style.css" rel="stylesheet" type="text/css" /-->
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>-->
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />


<script type="text/javascript">

    var game_question;
    function formatText(index, panel) {
        return index + "";
    }

    /*$(function () {



        $("#slide-jump").click(function(){
            $('.anythingSlider').anythingSlider(8);
        });


    });*/
</script>
<script language="javascript">
    var cat_id;
    var subcat_id;
    $(document).ready(function(){

        game_question = $("#game_question").html();
        $("#history").click(function(){
            $("#historylinks").slideToggle(200);

            return false;
        });

        $("#do_option").click(function(){

            //get the ajax page and response
            $.post('<?=base_url()?>quiz/showPlayerOptions', {} , function(data){
                if (data != '' || data != undefined || data != null){

                    $("#game_question").html(data);
                }
            });


        });


    });

    function show_player_option(){
              //get the ajax page and response
            $.post('<?=base_url()?>quiz/showPlayerOptions', {} , function(data){
                if (data != '' || data != undefined || data != null){

                    $("#game_question").html(data);
                }
            });

    }

    function hide_unhide(obj){
        //$("#subcategory_"+obj).slideToggle(200);
        $("#category_"+obj).slideToggle(200);
        return false;
    }

    function selected_cat(id,name,class1,rowid,subid){ //alert(name);
        $.post('<?=base_url()?>quiz/set_selected_category', {category_name:name,class_color:class1} , function(data){

        });
        $('#cat_title_'+rowid).html('<a href="javascript:void(0);" id="history" onclick="hide_unhide('+rowid+')" class="color_white font14 bold '+class1+'" style="text-align:center">'+name+'</a>');
        $('.catlinks').hide();
        $('input[name=category_'+id+']').is(':checked')
        $('input[name=category_'+id+']').attr('checked', false);
        $('input[name=subcategory_'+subid+']').is(':checked')
        $('input[name=subcategory_'+subid+']').attr('checked', false);
        //alert(rowid);
        cat_id=id;
        subcat_id=subid;


    }

    function submit_form(form_id,lev,rowid)
    {
        if(form_id=='form_q'){ //alert('hi');return false;
            document.getElementById(form_id).level.value=lev;
            $.post('<?=base_url()?>home/generateRandomQuestion', {quiz_level:lev} , function(data){

                if(data==''){
                    $("#game_question").html("There is no more questions for this category! Why not make your own?");
                    $("#game_question").show();
                   // clearTimeout(timeout);
                }
                else if (data != '' || data != undefined || data != null){
                    window.location = '<?=base_url()?>quiz/views/'+data+'/0';
                    //							 dt=data.split('*');
                    //							 $("#game_question").html(dt[0]);
                }
            });

        }
        else
        {
            //				cat_id="";
            //				cat_id = document.getElementById(form_id).category_id.value;
            //				boxes=document.getElementById(form_id).subcategory.length;
            //					ids = "";
            //					for (i=0; i<boxes;i++) {
            //
            //					if (document.getElementById(form_id).subcategory[i].checked) {
            //							ids= document.getElementById(form_id).subcategory[i].value+','+ids;
            //						}
            //					}
            //alert(cat_id);alert(subcat_id);
            if(cat_id==undefined)
                cat_id = rowid;
            if(subcat_id==undefined)
                subcat_id='';
            //alert(subcat_id);
            $.post('<?=base_url()?>quiz/searchByCategory', {quiz_level:lev,subcat_id:subcat_id,cat_id:cat_id} , function(data){

                if(data==''){
                    cat_id=undefined;
                    $("#game_question").html("There is no more questions for this category! Why not make your own?");
                    $("#game_question").show();
                   // clearTimeout(timeout);
                }
                else if (data != '' || data != undefined || data != null){
                    window.location = '<?=base_url()?>quiz/views/'+data+'/0';
                    //							 dt=data.split('*');
                    //							 $("#game_question").html(dt[0]);
                }
            });
        }
    }

    function selectAllCheckbox(divname, obj)
    {

        if (obj.checked)
        { //alert('Hi');
            $("#" + divname + " input[type='checkbox']").attr('checked', true);
        }
        else
        {
            $("#" + divname + " input[type='checkbox']").attr('checked', false);
        }
    }

    // GAMING SECTIONS --------------------
    function submit_cat_form(form_name,quiz_level){ //alert(form_name);
        type = "video";
        // alert(cat_id); alert(subcat_id);
        if(subcat_id==undefined)
            ids = cat_id;
        else ids = subcat_id;
        //boxes=document.forms[form_name].category.length;
        //        var data_post = $("form[name='"+form_name+"']").serialize();
        //        console.log(data_post);
        //        return false;

        //        ids = "";
        //        for (i=0; i<boxes;i++) {
        //
        //            if (document.forms[form_name].category[i].checked) {
        //                ids= document.forms[form_name].category[i].value+','+ids;
        //            }
        //        }
        $.post('<?=base_url()?>quiz/getRandomQuestion', {quiz_level:quiz_level,cat_ids:ids,quiz_type:type} , function(data){
            if (data != '' || data != undefined || data != null){

                dt=data.split('*')
                $("#game_question").html(dt[0]);
            }
        });

    }


    function getQuestionOptions(id) {
        $("#game_flash").hide();

        //get the ajax page and response
        $.post('<?=base_url()?>quiz/getQuestionOptions', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();


            }
        });
    }

    // STEP 3---------------------------------------------
    function playVideoAnswer(selected_option,quiz_id){
        $.post('<?=base_url()?>quiz/playVideoAnswer', {option:selected_option,quiz_id:quiz_id} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
            }
        });
    }

    // STEP 4---------------------------------------------
    function showAnswerResult(id) {//alert(game_question);
        if(id=='' || id==undefined){
            $("#game_question").html(game_question);
        }
        else {
            $("#game_flash").hide();
            //get the ajax page and response
            $.post('<?=base_url()?>quiz/showAnswerResult', {quiz_id:id} , function(data){
                if (data != '' || data != undefined || data != null){

                    $("#game_question").html(data);
                    $("#game_question").show();
                }
            });
        }

    }

    function showAnswerResultMulti(id,flag) { //alert(flag);
        if(flag == 'play_further')
            flag = 'play_further';
        else flag = 'no_play_further';
        $("#game_flash").hide();
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/showAnswerResultMulti', {quiz_id:id,flag:flag} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
                $('.anythingSlider').anythingSlider({
                    easing: "easeInOutExpo",        // Anything other than "linear" or "swing" requires the easing plugin
                    autoPlay: true,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
                    delay: 3000,                    // How long between slide transitions in AutoPlay mode
                    startStopped: false,            // If autoPlay is on, this can force it to start stopped
                    animationTime: 600,             // How long the slide transition takes
                    hashTags: true,                 // Should links change the hashtag in the URL?
                    buildNavigation: true,          // If true, builds and list of anchor links to link to each slide
                    pauseOnHover: true,             // If true, and autoPlay is enabled, the show will pause on hover
                    startText: "Go",             // Start text
                    stopText: "Stop",               // Stop text
                    navigationFormatter: formatText       // Details at the top of the file on this use (advanced use)
                });

            }
        });

        //setTimeout(showAnswerResult(),5000);
    }

    function trackClick(id,type) {
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/trackClick', {banner_id:id,ads_type:type} , function(data){
            if (data != '' || data != undefined || data != null){

//                $("#game_question").html(data);
//                $("#game_question").show();


            }
        });
    }

    function showUserScore(type) {
        $("#game_flash").hide();
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/showUserScore', {score_type:type} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
            }
        });
    }

//    function showMultiScore(type,quiz_id) {
//        $("#game_flash").hide();
//        //get the ajax page and response
//        $.post('<?=base_url()?>quiz/showMultiScore', {type:type,quiz_id:quiz_id} , function(data){
//            if (data != '' || data != undefined || data != null){
//
//                $("#game_question").html(data);
//                $("#game_question").show();
//                jQuery('#mycarousel1').jcarousel();
//            }
//        });
//    }

    function showMultiScore(type,id,previous_player) {

        $("#game_flash").hide();
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/showMultiScore', {quiz_id:id,type:type,previous_player:previous_player} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
            }
        });
    }

    function showVideoAgain(id)
    {

        $.post('<?=base_url()?>quiz/showVideoAgain', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
            }
        });

        $("#game_question").html(data);
        $("#game_question").show();

    }


    function selectPlayers(type){
        $.post('<?=base_url()?>quiz/selectPlayers', {type:type} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
            }
        });
    }

    function tutorial(){
//        $("#game_question").html("<a href='<?=base_url()?>uploaded_video_questions/muziek.flv' style='display:block;width:480px;height:300px' id='player'></a>");
//        flowplayer("player", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{clip: {autoPlay: false,autoBuffering: true }});
            $('#game_flash').show();
            $('#game_question').hide();
                                                                    
    }

    function saveSettings(){
        checkboxes=document.group_game_form.group_member.length;

        ids = "";
        names = "";
        for (i=0; i<checkboxes;i++) {

            if (document.group_game_form.group_member[i].checked) {
                //alert(document.group_game_form.group_member[i].value);
                //ids= document.group_game_form.group_member[i].value+','+ids;

                if(document.group_game_form.group_member_tb[i].value != '') {
                    names= document.group_game_form.group_member_tb[i].value+','+names;
                }
            }
        }

        if(names == '') {
            alert('Please fill in names.');
            return false;
        }

        $.post('<?=base_url()?>quiz/saveSettings', {member_names:names} , function(data){
            if (data != '' || data != undefined || data != null){
                $("#game_question").html(data);
            }
        });
    }

</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
     
    stLight.options({publisher:'dd0b74cb-f06f-4778-9887-b0c1bda3b021'});
      
</script>
<script type="text/javascript" src="<?php echo base_url();?>jcarousel_slider/lib/jquery.jcarousel.js"></script>
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>jcarousel_slider/skins/tango/skin_1.css" />
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery('#mycarousel1').jcarousel();
    });
</script>
<?php if($this->session->userdata('no_quiz')!=''){ $this->session->unset_userdata('no_quiz') ?>
<script>
    alert('There is no quiz remaining! Play again!');
</script>
<? }?>

<div class="midside">
    <div class="midsideInner">
        <div class="content_wrap">
            <div class="whiteboxmidside_topborder">
                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:470px;">
                        
                        <div class="font14 color_white"><span class="bold">Welcome!</span> New to WannaQuiz? <span onclick="tutorial()" style="cursor:pointer; color:#0066CC">Click here</span> to watch the video tutorial!</div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="whiteboxmidside_bg">
                <div class="whiteboxrightside_bgInner">
                    <div class="content_10box">
                        <div class="content_wrap">

                            <!-- GAMING SECTIONS  -->
                             <div align="center" style="z-index:-100; display:none" id="game_flash">
                                <? if($quiz_info->quiz_type=="video") {?>
                                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="502" HEIGHT="312" id="banner_rotativo" ALIGN="">
                                    <PARAM NAME=movie VALUE="<?=base_url()?>tutorial.swf?q=intro.flv">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#000000>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                                    <? }?>
                                    
                                    <EMBED wmode="opaque" src="<?=base_url()?>tutorial.swf?q=intro.flv" quality=high bgcolor=#000000 WIDTH="502" HEIGHT="312" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                                </OBJECT>
                                



                            </div>
                            <div style="z-index:-100;" id="game_question">
                               

                                <? if(!$this->session->userdata('wannaquiz_user_id')) {?>

                                <div id="game_wrap1">
                                    <div id="game_bg1">
                                        <div class="gamelogo_bg">
                                            <div class="gamelogo_bgInner">
                                                <div class="gametrans_bg">
                                                    <div class="content_10box">
                                                        <div class="text_center">
                                                            <div class="font14 bold">Start playing as a guest , <a href="<?=site_url('home/login/'.base64_encode('home'))?>">Login</a> or <a href="<?=site_url('registration')?>">Join</a></div>

                                                            <div class="padding_10topbottom">
                                                                The buttons below are drop-down menus
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="front_text">
                                                                First click and select a category below
                                                            </div>
                                                            <div style="float:left; width:30px"><img src="<?=base_url()?>images/arrow_blue.png"></div>
                                                            <div><img src="<?=base_url()?>images/movies_drop_down.PNG"></div>
                                                        </div>
                                                        <div>
                                                            <div class="front_text" >
                                                                After that click a 'Hard' or 'Average' button to start a hard or average question
                                                            </div>
                                                            <div style="float:left; width:30px; padding-top:5px"><img src="<?=base_url()?>images/arrow_green.png"></div>
                                                            <div style="padding-top:15px"><img src="<?=base_url()?>images/buttons.png"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <? }else {
                                if($this->session->userdata('game_mode') != 'multi'){
                                $this->session->set_userdata(game_mode,"single");?>
                                <div id="game_wrap1">
                                    <div id="game_bg1">
                                        <div class="content_wrap">

                                            <div class="lightblue_bg">
                                                <div style="height:60px;">
                                                    <div class="font14 bold text_center" style="padding:20px 0 0 0;">Welcome! <?=$this->session->userdata('wannaquiz_username')?> you can start playing!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_10box">

                                            <div>

                                                <div>
                                                    <div style="position:absolute; bottom:35px; right:170px;">
                                                        <div class="text_center bold content_wrap">
                                                            <!--                                                            	<div><a href="#">Save score</a></div>
                                                            -->                                                                <div><a href="javascript:void(0);" onclick="showUserScore('today')">Score today</a></div>
                                                            <div><a href="javascript:void(0);" onclick="showUserScore('total')">Total Score</a></div>
                                                        </div>
                                                        <div class="pointboard_bg">
                                                            <div class="pointboard_bgInner">
                                                                <div class="font10">Questions Answered</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$total_answered?></div>
                                                                <div style="height:36px; line-height:36px;" class="bold color_blue">
                                                                    <?
                                                                    if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                                    {
                                                                        if(strlen($this->session->userdata('first_name'))>10) 
                                                                            echo substr($this->session->userdata('first_name'),0,8).'...'; 
                                                                        else echo $this->session->userdata('first_name');
                                                                    }
                                                                    else if(!$this->session->userdata('wannaquiz_fb_id') && !$this->session->userdata('wannaquiz_tw_id') && $this->session->userdata('wannaquiz_username'))
                                                                    { 
                                                                        if(strlen($this->session->userdata('wannaquiz_username'))>10) 
                                                                            echo substr($this->session->userdata('wannaquiz_username'),0,8).'...'; 
                                                                        else echo $this->session->userdata('wannaquiz_username');                                                
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="font10">Points</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$total_points?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="position:absolute; bottom:10px; right:20px;">
                                                        <div class="game_optionicon"><a href="javascript:void(0);" id="do_option">Options</a></div>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <? } elseif($this->session->userdata('nextplayer')=='' || $this->session->userdata('nextplayer1')==''){ ?>
                                <div id="game_wrap1">
                                        <div id="game_bg1">

                                        <div class="content_10box">

                                            <div>
                                                <div class="gameleftside" style="width:260px;">
                                                    <div class="game_desc">
                                                        <h1>You can start playing by:</h1>
                                                        <ol>
                                                            <li>These buttons are drop-down menus. Select your favourite categories and then choose a 'hard' or  'average' question.</li>
                                                            <li><a href="'.site_url('home/quizMachine').'">Quiz Machine</a></li>
                                                            <li><a href="'.site_url('gameboard').'">Free game board</a></li>
                                                            <li><a href="">Just Search or browse</a></li>
                                                        </ol>
                                                        <div class="padding_10topbottom">
                                                            <p>Player is <span class="bold"><?=$this->session->userdata('multiplayer_user')?></span></p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="gamerightside" style="width:166px;">
                                                    <div>
                                                    </div>

                                                    <div style="position:absolute; bottom:10px; right:10px;">
                                                        <div class="pointboard_bg">
                                                            <div class="pointboard_bgInner">
                                                                <div class="font10">Questions Answered</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('multiplayer_total_answered')?></div>
                                                                <div style="height:36px; line-height:36px;" class="bold color_blue"><?=$this->session->userdata('multiplayer_user')?></div>
                                                                <div class="font10">Points</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('multiplayer_total_points')?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </div>
                                             <div style="padding:10px; bottom:10px; right:20px;">
                                                        <div class="game_optionicon"><a href="javascript:void(0);" id="do_option">Options</a></div>
                                                    </div>
                                    </div>
                                </div>
                                <? } else { ?>
                                <div id="game_wrap1">
                                    <div id="game_bg1">
                                        <div class="content_wrap" style="float:left">
                                            <div class="lightblue_bg" style="height:70px;">
                                                <div class="content_10box">
                                                    <div class="gameleftside" style="padding-right:10px;"><img src="<?=base_url()?>converted_video_images/<?=$this->session->userdata('video_image')?>.jpg" width="66" height="50" alt="winner" /></div>
                                                    <div class="gameleftside" style="width:250px;">
                                                        <div>Offer by publisher of last question:</div>
                                                    </div>
                                                    <div class="gameleftside" style="width:380px;">
                                                        <div><a href="#" target="_blank" onclick="trackClick('<?=$this->session->userdata('advertise_id') ?>','<?=$this->session->userdata('ads_type') ?>')"><?=substr($this->session->userdata('advertise'),0,80)?></a></div>

                                                    </div>
                                                    <div class="clear"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="gamerightside" style="width:166px;">
                                            <div>


                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="content_10box">

                                            <div>
                                                <div style="width:360px; margin:0 auto;">
                                                    <div style="float:right; width:155px;">
                                                        <div style="">
                                                            <div class="text_center bold content_wrap">
                                                                <div id="score1"><a href="javascript:void(0);" onclick="showMultiScore('today','<?=$this->session->userdata("quizId")?>','<?=$this->session->userdata("previousPlayer")?>')">Score today</a></div>
                                                                <div id=""><a id="score" href="javascript:void(0);" onclick="showMultiScore('total','<?=$this->session->userdata("quizId")?>','<?=$this->session->userdata("previousPlayer")?>')">Total Score</a></div>
                                                            </div>
                                                        </div>
                                                        <div class="pointboard_bg">
                                                            <div class="pointboard_bgInner">
                                                                <div class="font10">Questions Answered</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('mp_answer')?></div>
                                                                <div style="height:36px; line-height:36px;" class="bold color_blue"><?=$this->session->userdata('nextplayer1')?></div>
                                                                <div class="font10">Points</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('mp_point')?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div style="float:right; width:155px; margin-right:40px;">
                                                        <div style="">
                                                            <div class="text_center font11 content_wrap" style="width:135px;"><!--<a href="javascript:void(0);" onclick="showAnswerResult()">--> This is the Next Player. Select a Question<!--</a>--></div>
                                                        </div>

                                                        <div class="pointboard_bg">
                                                            <div class="pointboard_bgInner">
                                                                <div class="font10">Questions Answered</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('mp_answer1')?></div>
                                                                <div style="height:36px; line-height:36px;" class="bold color_blue"><?=$this->session->userdata('nextplayer')?></div>
                                                                <div class="font10">Points</div>
                                                                <div class="bold" style="font-size:17px; height:30px;"><?=$this->session->userdata('mp_point1')?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="clear"></div>
                                                    <!--</ul></div></div>-->
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?}}?>
                            </div>
                            <!--  END OF GAMING SECTION -->

                        </div>

                        <div class="content_wrap">
                            <div class="category_icon">Choose Your Category</div>
                            <div class="padding_10topbottom">
                                <?
                                //foreach($categories as $row) {
                                for($i=0;$i<4;$i++) {
                                if($i==0) {$category = 'Animals'; $class = 'english'; $level_hard = 'hard_english'; $level_average = 'avg_english';}
                                elseif($i==1) {$category = 'Movies'; $class = 'movies'; $level_hard = 'hard_movies'; $level_average = 'avg_movies';}
                                elseif($i==2) {$category = 'Music'; $class = 'music'; $level_hard = 'hard_music'; $level_average = 'avg_music';}
                                else {$category = 'History'; $class = 'history'; $level_hard = 'hard_history'; $level_average = 'avg_history';}
                                $row = $this->Category_model->get_four_categories($category);                                
                                ?>
                                <form method="post" name="form_<?=$row->name?>" id="form_<?=$row->id?>">
                                    <input type="hidden" name="category_id" value="<?php echo $row->id?>" >
                                    <div class="cat_left" style="position:relative;">
                                        <div class="padding_2bottom">
                                            <div class="cathistory_bg" id="cat_title_<?=$row->id?>">
                                                <a href="javascript:void(0);" id="history" onclick="hide_unhide(<?=$row->id?>)" class="color_white font14 bold <?=$class?>" style="text-align:center"><?=$row->name?></a>
                                            </div>
                                            <div id="category_<?=$row->id?>" style="display:none" class="catlinks">                                              
                                                <?php foreach ($categories as $all_categories) { ?>
                                                <div class="catcontentbox">
                                                    <div class="content_10box">
                                                        <input type="checkbox" name="category_<?=$all_categories->id?>" value="<?=$all_categories->id?>" onclick="selected_cat('<?=$all_categories->id?>','<?=$all_categories->name?>','<?=$class?>','<?=$row->id?>')" id="cat_<?=$all_categories->id?>"><?=$all_categories->name?>
                                                    </div>

                                                    <div id="subcategory_<?=$all_categories->id?>" style="display:block; padding-left:20px">
                                                        <?php $subcategories = $this->Category_model->get_sub_categories($all_categories->id);
                                                        if(count($subcategories)>0) {
                                                        foreach($subcategories as $subcategory) {
                                                        $query = $this->Quiz_model->count_quiz_by_subcatid($subcategory->id);
                                                        if($query || $subcategory->flag=='1') {
                                                        ?>

                                                        <div class="content_10box">
                                                            <input type="checkbox" name="subcategory_<?=$subcategory->id?>" value="<?php echo $subcategory->id?>"  onclick="selected_cat('<?=$all_categories->id?>','<?=$subcategory->name?>','<?=$class?>','<?=$row->id?>','<?=$subcategory->id?>')" id="subcat_<?=$subcategory->id?>">
                                                            <?php echo $subcategory->name; ?>
                                                        </div>

                                                        <? } } } ?><div class="clear"></div>
                                                    </div>
                                                </div>
                                                <? } ?>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="catsub_left">
                                                <div class="cathistory_hard">
                                                    <input type="hidden" name="level" value="2" >
                                                    <a  class="color_white bold <?=$level_hard?>" onclick="submit_form('form_<?=$row->id?>','3','<?=$row->id?>')">Hard</a>
                                                    <!--<a  class="color_white bold <?=$level_hard?>" onclick="submit_cat_form('form_<?=$row->name?>','3')">Hard</a>-->
                                                </div>
                                            </div>
                                            <div class="catsub_left">
                                                <div class="cathistory_average"><a class="color_white bold <?=$level_average?>" onclick="submit_form('form_<?=$row->id?>','2','<?=$row->id?>')">Average</a></div>
                                                <!--<a  class="color_white bold <?=$level_hard?>" onclick="submit_cat_form('form_<?=$row->name?>','2')">Average</a>-->
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                                <? } ?>
                                <form  method="post" name="form_q" id="form_q">
                                    <div class="cat_left" style="position:relative; padding-left:120px;" >                                        <div class="padding_2bottom">
                                            <div class="cathistory_bg">
                                                <a href="javascript:void(0);" id="history"  class="color_white font14 bold unknown" ><?//=$row->name?></a>
                                            </div>

                                        </div>
                                        <div>
                                            <input type="hidden" name="category_q" value="category_q">
                                            <div class="catsub_left">
                                                <div class="cathistory_hard"><input type="hidden" name="level" value="2" ><a  class="color_white bold hard_unknown" onclick="submit_form('form_q','3')">Hard</a></div>
                                            </div>
                                            <div class="catsub_left">
                                                <div class="cathistory_average"><a class="color_white bold avg_unknown" onclick="submit_form('form_q','2')">Average</a></div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="clear"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="whiteboxmidside_bottomborder"></div>
            </div>
            <div class="content_wrap">
                <div class="whiteboxmidside_topborder"><div class="content_10box"  style="padding-left:20px; line-height:30px;"><strong>Like Us ?</strong></div></div>
                <div class="whiteboxmidside_bg">
                        <div class="whiteboxrightside_bgInner">
                            <div style="width:49%;float:left;">
                                <div class="content_10box"  style="padding-left:20px; border-right:1px solid #CCC;">
                                    <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FWannaquiz%2F149220485149722&amp;width=292&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>
                                    <div style="border-bottom:1px dotted #CCC; margin-bottom:10px; padding-left:5px; height:1px; clear:both;"></div>
                                    <div style="float:left; display:inline-block; margin-right:10px;"><a style="float:left; display:inline-block;" href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
                                        <div class="sharequiz_icon"  style="float:left; display:inline-block; padding-top:2px;">
                                            <span class="st_sharethis" displayText="Share this Page"></span>
                                        </div>
                                    <div style="padding-top:10px; clear:both">
                                      <p>Get a new question each day in your Facebook or Twitter feed.</p>
                                      <p>The question on Facebook is different from the one on Twitter.</p>
                                    </div>
                                </div>
                                
                            </div>
                            <div style="width:49%;float:left;">
                                <div class="content_10box" style="padding-left:25px;">
                                    <div style="padding:0 0 10px 0">Additional Facebook/Twitter accounts: </div>
                                    <div ><a href="http://twitter.com/WQEdTech" target="_blank">WannaQuiz for Teachers (EdTech)</a></div>
                                    <div><a href="http://twitter.com/WQSponsors" target="_blank">WannaQuiz for Entrepeneurs (Sponsors)</a></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                </div>
                <div class="whiteboxmidside_bottomborder"></div>
            
        </div>
    </div>
</div>