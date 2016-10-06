<?
if($quiz_info->quiz_type == "photo") 
{
    $image=base_url().'photo_question_images/'.$quiz_image;
    $dims = getimagesize($image);

    if( $dims[0] < $dims[1] ) 
    {
        $con = 'game_wrap1';
        $bg = 'game_bg1';
        $txt = 'textimgbg_v';
        $src = $image . '&h=300&w=&zc=0';
    }
    else
    {
        $con = 'game_wrap1';
        $bg = 'game_bg1';
        $txt = 'textimgbg';
        $src = $image . '&h=300&w=&zc=0';
    }
}
?>
<script type="text/javascript" src="<?=base_url()?>js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript">
var timeout;
    function formatText(index, panel) {
        return index + "";
    }
</script>
<script type="text/javascript">
var cat_id;
var subcat_id;
    function showPhotoAgain(){        
        var htm = '';
        htm += '<div id="<?=$con?>">';
        htm += '<div id="<?=$bg?>">';
            htm += '<div class="content_10box" style="padding:0px">';
                htm += '<div class="content_wrap" align="center">';
                    htm += '<img src="<?php echo base_url(); ?>resizer.php?src=<?=$src?>" alt="quiz answer video" id="thumbnail" />';
                    //htm += '<img src="<?=$image?>" width="<?=$dims[0]?>" height="<?=$dims[1]?>" alt="quiz answer video" id="thumbnail" />';
                    htm += '<div class="textimgalign"><div class="<?=$txt?>"><div class="textimg" id="question"></div></div></div>';
                htm += '</div>';
           htm += '</div>';
        htm += '</div>';
        htm += '</div>';
        
        $('#game_wrap1').html(htm);
        
       if('<?=$quiz_info->quiz_type ?>' == 'photo')
        setTimeout('test()', 3000);
    }

    $(document).ready(function(){
//$.scrollTo('#game_wrap', 800);
//$.scrollTo('-=42px');
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
       if('<?=$quiz_info->quiz_type ?>' == 'photo') 
       //   test();
       timeout = setTimeout('test()', 3000);
    });

    function test()
    {    
        $.post('<?=base_url()?>quiz/get_question_by_quiz_id', {quiz_id:'<?=$quiz_id?>'} , function(data){
        if (data != '' || data != undefined || data != null){
            $("#question").html("<div class='textimg' title='"+data+"' style='overflow:hidden'>"+data+"</div>");
             }
        });
        $('#textimgalign').show(); 
        //    getQuestionOptions("<?=$quiz_id?>");
        setTimeout('getQuestionOptions("<?=$quiz_id?>")', 4000);
    }

    function hide_unhide(id){
        //$("#subcategory_"+id).slideToggle(200);
        $("#category_"+id).slideToggle(200);
        return false;
    }

    function selected_cat(id,name,class1,rowid,subid){
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
    { //alert(rowid);
        $("#game_flash").hide();
        if(form_id=='form_q'){
            
            document.getElementById(form_id).level.value=lev;
            $.post('<?=base_url()?>home/generateRandomQuestion', {quiz_level:lev} , function(data){

                if(data==''){
                    $("#game_question").html("There are no more questions in this category! Why not make your own?");
                    $("#game_question").show();
                    clearTimeout(timeout);
                }
                else if (data != '' || data != undefined || data != null){
                    window.location = '<?=base_url()?>quiz/view/'+data+'/0';
                    //							 dt=data.split('*');
                    //							 $("#game_question").html(dt[0]);
                }
            });
        }
        else
        {
//            cat_id="";
//            cat_id = document.getElementById(form_id).category_id.value;
//            boxes=document.getElementById(form_id).subcategory.length;
//            ids = "";
//            for (i=0; i<boxes;i++) {
//
//                if (document.getElementById(form_id).subcategory[i].checked) {
//                    ids= document.getElementById(form_id).subcategory[i].value+','+ids;
//                }
//            }
//alert(cat_id);alert(subcat_id);
//alert(cat_id);
            if(cat_id==undefined)
            cat_id = rowid;
             if(subcat_id==undefined)
             subcat_id='';

            $.post('<?=base_url()?>quiz/searchByCategory', {quiz_level:lev,subcat_id:subcat_id,cat_id:cat_id} , function(data){
                 if(data==''){
                     cat_id=undefined;
                     $("#game_question").html("There are no more questions in this category! Why not make your own?");
                     $("#game_question").show();
                     clearTimeout(timeout);
                }
               else if (data != '' || data != undefined || data != null){ //alert(data);
                    window.location = '<?=base_url()?>quiz/view/'+data+'/0';
//                    dt=data.split('*');
//                    $("#game_question").html(dt[0]);
//                    $("#game_question").show();
//                    $("#footer_question").html(dt[1]);
//                    $("#url_question").hide();
//                    $("#footer_question").show();

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
    function submit_cat_form(form_name,quiz_level){
//        type = "video";
//        boxes=document.form_category.category.length;
//
//        ids = "";
//        for (i=0; i<boxes;i++) {
//
//            if (document.form_category.category[i].checked) {
//                ids= document.form_category.category[i].value+','+ids;
//            }
//        }
//        $.post('<?=base_url()?>quiz/getRandomQuestion', {quiz_level:quiz_level,cat_ids:ids,quiz_type:type} , function(data){
//            if (data != '' || data != undefined || data != null){
//
//                dt=data.split('*');
//                $("#game_question").html(dt[0]);
//                $("#footer_question").html(dt[1]);
//                $("#url_question").hide();
//                $("#footer_question").show();
//
//            }
//        });


        type = "video";
        // alert(cat_id); alert(subcat_id);
         if(subcat_id==undefined)
             ids = cat_id;
         else ids = subcat_id;
      
        $.post('<?=base_url()?>quiz/getRandomQuestion', {quiz_level:quiz_level,cat_ids:ids,quiz_type:type} , function(data){
            if (data != '' || data != undefined || data != null){

                dt=data.split('*')
                $("#game_question").html(dt[0]);
            }
        });
    }


    function getQuestionOptions(id, quiz_type, test, test1) {
        $("#game_flash").hide();
        quiz_type = "<?=$quiz_info->quiz_type;?>";
        if(quiz_type == undefined){
            quiz_type='';
        };
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/getQuestionOptions', {quiz_id:id,quiz_type:quiz_type,test:test,test1:test1} , function(data){
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

                if('<?=$quiz_info->quiz_type ?>' == 'photo')
                setTimeout('long_answer()',1000);
            }
        });
        
        
    }

    function long_answer(){

        $.post('<?=base_url()?>quiz/get_quiz_long_answer', {quiz_id:<?=$quiz_id?>} , function(data){
            if (data != '' || data != undefined || data != null){ //alert('hell0o');                
                $("#answer").html("<div class='textimg' title='"+data+"' style='overflow:hidden'>"+data+"</div>");
                if("<?=$this->session->userdata('game_mode')?>"=="multi" && "<?=$this->session->userdata('wannaquiz_user_id')?>"!="")
                {
                    setTimeout('showAnswerResultMulti("<?=$quiz_id?>","no_play_further")', 5000);
                }
               else //if("< ?=$this->session->userdata('game_mode')?>"== 'single')
                    setTimeout('showAnswerResult("<?=$quiz_id?>")', 5000);
            }
        });
        $('#textimgalign1').show();
        
        
            
    }
    // STEP 4---------------------------------------------
    function showAnswerResult(id) {
        $("#game_flash").hide();
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/showAnswerResult', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
            }
        });
    }

    function showAnswerResultMulti(id,flag) {
        $("#game_flash").hide();
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/showAnswerResultMulti', {quiz_id:id,flag:flag} , function(data){
            if (data != '' || data != undefined || data != null){

                $("#game_question").html(data);
                $("#game_question").show();
//                $('.anythingSlider').anythingSlider({
//                    easing: "easeInOutExpo",        // Anything other than "linear" or "swing" requires the easing plugin
//                    autoPlay: true,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
//                    delay: 3000,                    // How long between slide transitions in AutoPlay mode
//                    startStopped: false,            // If autoPlay is on, this can force it to start stopped
//                    animationTime: 600,             // How long the slide transition takes
//                    hashTags: true,                 // Should links change the hashtag in the URL?
//                    buildNavigation: true,          // If true, builds and list of anchor links to link to each slide
//                    pauseOnHover: true,             // If true, and autoPlay is enabled, the show will pause on hover
//                    startText: "Go",             // Start text
//                    stopText: "Stop",               // Stop text
//                    navigationFormatter: formatText       // Details at the top of the file on this use (advanced use)
//                });

            }
        });
    }

    function trackClick(id,profile_id,type) {
        //get the ajax page and response
        $.post('<?=base_url()?>quiz/trackClick', {banner_id:id,ads_type:type,profile_id:profile_id} , function(data){
            if (data != '' || data != undefined || data != null){

                //$("#game_question").html(data);
                //$("#game_question").show();


            }
        });
    }

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
<?php // echo'<pre>'; print_r($quiz_info); echo '</pre>';
//echo $quiz_info->quiz_type;
?>

<div class="quiz_midside">
    <div class="midsideInner">        
        <div class="content_wrap">
            <div class="quizmid_topborder"></div>
            <div class="quizmid_bg">
                <div class="whiteboxrightside_bgInner">
                    <div class="content_10box" style="padding-top:0; margin-top:0px;">
                        <div class="content_wrap">
<div style="margin-bottom: 10px;margin-left: 380px;">
    <!-- AddThis Button BEGIN - ->
    <div class="addthis_toolbox addthis_default_style">
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <a class="addthis_button_compact"></a>
    <a class="addthis_counter addthis_bubble_style"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4e32c0720a0e9d"></script>
    <!-- AddThis Button END -->
</div>
                            <!-- Gaming Question and options Sections--> 
                            <div align="center" style="z-index:-100; display:none" id="game_question"></div>
                            <!-- END of Gaming Question and options Sections-->    

                            <!-- Gaming Video Playing Sections--> 
                            <div align="center" style="z-index:-100;" id="game_flash">
                            <? if($quiz_info->quiz_type=="video") {?>
                                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="550" HEIGHT="343" id="banner_rotativo" ALIGN="">
                                    <PARAM NAME=movie VALUE="<?=base_url()?>video_question.swf?q=<?=$quiz_id?>">
                                    <PARAM NAME=quality VALUE=high>
                                    <PARAM NAME=bgcolor VALUE=#000000>
                                    <PARAM NAME="WMode" VALUE="opaque">
                                    <param name="allowScriptAccess" value="sameDomain" />
                            <? } 
                            if($quiz_info->quiz_type == "photo") { ?>
                                    <div id="<?=$con?>">
                                        <div id="<?=$bg?>">
                                            <div class="content_10box" style="padding:0px">                                                
                                                <div class="content_wrap">                                                        
                                                    <img src="<?php echo base_url(); ?>resizer.php?src=<?=$src?>" alt="quiz answer video" id="thumbnail" />
                                                    <!--img src="<?=$image?>" width="<?=$dims[0]?>" height="<?=$dims[1]?>" alt="quiz answer video" id="thumbnail" /-->
                                                    <div class="<?=$txt?>" style="display:none" id="textimgalign">
                                                        <div class="textimg" id="question"></div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <? } else { ?>
                                    <EMBED wmode="opaque" src="<?=base_url()?>video_question.swf?q=<?=$quiz_id?>" quality=high bgcolor=#000000 WIDTH="550" HEIGHT="343" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
                                </OBJECT>
                                <? }?>



                            </div>
                            <!--  END Gaming Video Playing Sections-->

                        </div>
                        <div class="content_wrap">
                            <!--<div class="category_icon">Choose Your Category</div>-->
                            <div class="padding_10topbottom" style="padding-top:0; padding-left:40px;">

                                <? ;
                                //foreach($categories as $row) {
                                for($i=0;$i<4;$i++) {
                                    if($i==0) {
                                        if($this->session->userdata('selected_cat')!='' && $this->session->userdata('selected_cat_class')=='english'){
                                        $category = $this->session->userdata('selected_cat');
                                        $class = $this->session->userdata('selected_cat_class');
                                        $level_hard = 'hard_english'; $level_average = 'avg_english';
                                        }
                                        else
                                        $category = 'Animals'; $class = 'english'; $level_hard = 'hard_english'; $level_average = 'avg_english';
                                    }
                                    elseif($i==1) {
                                        if($this->session->userdata('selected_cat')!='' && $this->session->userdata('selected_cat_class')=='movies'){
                                        $category = $this->session->userdata('selected_cat');
                                        $class = $this->session->userdata('selected_cat_class');
                                        $level_hard = 'hard_movies'; $level_average = 'avg_movies';
                                        }
                                        else
                                        $category = 'Movies'; $class = 'movies'; $level_hard = 'hard_movies'; $level_average = 'avg_movies';}
                                    elseif($i==2) {
                                        if($this->session->userdata('selected_cat')!='' && $this->session->userdata('selected_cat_class')=='music'){
                                        $category = $this->session->userdata('selected_cat');
                                        $class = $this->session->userdata('selected_cat_class');
                                        $level_hard = 'hard_music'; $level_average = 'avg_music';
                                        }
                                        else
                                        $category = 'Music'; $class = 'music'; $level_hard = 'hard_music'; $level_average = 'avg_music';}
                                    else {
                                        if($this->session->userdata('selected_cat')!='' && $this->session->userdata('selected_cat_class')=='history'){
                                        $category = $this->session->userdata('selected_cat');
                                        $class = $this->session->userdata('selected_cat_class');
                                        $level_hard = 'hard_history'; $level_average = 'avg_history';
                                        }
                                        else
                                        $category = 'History'; $class = 'history'; $level_hard = 'hard_history'; $level_average = 'avg_history';}
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
                                                        <input type="checkbox" name="category_<?=$all_categories->id?>" value="<?php echo $all_categories->id?>" onclick="selected_cat('<?=$all_categories->id?>','<?=$all_categories->name?>','<?=$class?>','<?=$row->id?>')" id="cat_<?=$all_categories->id?>"><?=$all_categories->name?>
                                                            
                                                    </div>

                                                    <div id="subcategory_<?=$all_categories->id?>" style="display:block; padding-left:20px">
                                                            <?php $subcategories = $this->Category_model->get_sub_categories($all_categories->id);
                                                            if(count($subcategories)>0) {
                                                                foreach($subcategories as $subcategory) {
                                                                    $query = $this->Quiz_model->count_quiz_by_subcatid($subcategory->id);
                                                                    if($query || $subcategory->flag=='1'){
                                                                    ?>

                                                        <div class="content_10box">
                                                            <input type="checkbox" name="subcategory_<?=$subcategory->id?>" value="<?php echo $subcategory->id?>" onclick="selected_cat('<?=$all_categories->id?>','<?=$subcategory->name?>','<?=$class?>','<?=$row->id?>','<?=$subcategory->id?>')" id="subcat_<?=$subcategory->id?>">
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
                                                <div class="cathistory_hard"><input type="hidden" name="level" value="2" ><a  class="color_white bold <?=$level_hard?>" <?php //if(!$this->session->userdata('game_mode')) { ?>onclick="submit_form('form_<?=$row->id?>','3','<?=$row->id?>')">Hard</a></div>
                                            </div>
                                            <div class="catsub_left">
                                                <div class="cathistory_average"><a class="color_white bold <?=$level_average?>" onclick="submit_form('form_<?=$row->id?>','2','<?=$row->id?>')">Average</a></div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </form>
                                <? } ?>



                                <form action="" method="post" name="form_q" id="form_q">
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
                        <div class="content_wrap" style="margin: 0 auto; width:490px;">
                            <div class="quizhelpbox_topborder"></div>
                            <div class="quizhelpbox_bg">
                                <div class="content_10box">
                                    <div class="quizhelp_left">
                                        <div class="bold font14 color_lightblue">How to play ?</div>
                                        <div class="padding_10topbottom">
                                            <div class="quizhelp_links">
                                                <ol style="padding-left:24px;">
                                                    <li> The colored buttons above are drop-down menus. Select your favorite categories and then choose a 'hard' or  'average' question.</li>
                                                    <li>Just browse or search for questions.</li>
                                                    <li>Answer questions from just<a href="#"> one person</a></li>
                                                    <li>Design your own<a href="#"> free game board</a> and play against your family/friends.</li>
                                                </ol><br />
                                                <span><a href="#">Read more</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="quizhelp_img">
                                        <img src="<?=base_url()?>images/option1_img.jpg" width="158" height="134" alt="quiz help" />
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="quizhelpbox_bottomborder"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quizmid_bottomborder"></div>
        </div>
    </div>
</div>