 <script type="text/javascript" src="<?=base_url()?>star_ratings/jquery.rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>star_ratings/rating.css">

<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />

<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
    
    #short a,#full a {display: block; word-wrap: break-word;}
</style>

<script type="text/javascript">
    $(document).ready(function() {
    //alert($('#display_more').val());
     if($('#display_more').val() > 0)
        $('#more').show();
    else $('#more').hide();    
<?
$avg_rating=$this->Quiz_model->calculate_total_rating($user->quiz_id);
?>
        $('#rate_<?=$user->quiz_id?>').rating('<?=base_url()?>quiz/rating/<?=$user->quiz_id?>','<?=$avg_rating?>', {maxvalue:5,increment:.5});

    });
</script>
<script type="text/javascript">
    function more(){
        $('#more').show();
        $('#show_more').hide();
        $('#show_less').show();
    }

    function less(){
        $('#more').hide();
        $('#show_more').show();
        $('#show_less').hide();
    }
     function add_favourites(quiz_id){ //alert('hii');
              
                     $.post('<?=base_url()?>quiz/addFavourites', {quiz_id:quiz_id} , function(data){       
                        if (data != '' || data != undefined || data != null)
                        {   dt=data.split('*');
                            if(dt[0]=='success')
                             $.prompt(dt[1]);
                            else $.prompt('You must be logged in to add to favorites');

                        }
                    });
              

            }

//    function add_favourites(quiz_id)
//    {
//        $.post('<?=base_url()?>quiz/addFavourites', {quiz_id:quiz_id} , function(data){
//            if (data != '' || data != undefined || data != null)
//            {
//                $.prompt(data);
//            }
//        });
//    }


    function playlist_add(uid){ 
        sendMessage(uid);
    }

    function show_playlist(){         
        $.post('<?=base_url()?>quiz/set_playlist_session', {user_id:'',quiz_id:'',playlist:'playlist'} , function(data){});
        $('#all_questions').hide();
        $('#playlist_questions').show();
        $('#sign').html(' - ');
        $('#sign1').html(' + ');
    }

    function show_all_questions(user_id,quiz_id){

        $.post('<?=base_url()?>quiz/set_playlist_session', {user_id:user_id,quiz_id:quiz_id,playlist:'all_questions'} , function(data){
            if (data != '' || data != undefined || data != null)
            {
                //alert(data);
                $('#load_playlist').html(data);
            }
            //alert(data); return false;
            });
        $('#all_questions').show();
        $('#playlist_questions').hide();
        $('#sign').html(' + ');
        $('#sign1').html(' - ');
    }

    function sendMessage(uid){ 
        $.post('<?=base_url()?>quiz/addPlaylists',{id:uid},function(data)
    { 
        if(data=='success'){
        var id= uid;
        var quiz_id = <?=$user->quiz_id?>;
        var txt = '<?php if($playlist) {?> <span id="" >Playlist Title: <select id="my_playlist" name="my_playlist"><?php foreach ($playlist as $play_list) {?> <option value="<?=$play_list->playlist_title?>"><?=$play_list->playlist_title?></option>\n\
    <? }?></select></span> <? }?><span style="padding-left:120px"><a style="cursor:pointer" onclick=test1()>Create Playlist</a></span><div style="display:none" id="playlist">Playlist Title: <input type="text" id="" name="playlist" value="" /></div><input type="hidden" id="member_id" name="member_id" value="'+id+'" /><input type="hidden" id="quiz_id" name="quiz_id" value="'+quiz_id+'" />';

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

                                    $.post('<?=base_url()?>quiz/addPlaylist', {id:id,playlist:playlist,quiz_id:quiz_id} , function(data){

                                        if (data != '' || data != undefined || data != null)
                                        {
                                            if(data=='success')
                                                $.prompt("Successfully added to the playlist");
                                            else if(data=='already added')
                                                $.prompt("You have already added this quiz in "+playlist);
                                            else
                                                $.prompt("You must be loggend in to add to Playlists");
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
        else $.prompt("You Must be logged in to add to Playlist");
        });
        }



        function test1()
        { 
            $('#playlist').show();
            //$('#my_playlist').hide();
        }

        function show_description()
        {
            $('#full').show();
            $('#short').hide();
        }
        
        function hide_description()
        {
            $('#short').show();
            $('#full').hide();
        }

        function playlist_question_click(quiz_id,user_id,playlist,url){ //alert(playlist);
            $.post('<?=base_url()?>quiz/playlist_quiz_click_ses', {quiz_id:quiz_id,user_id:user_id,playlist:playlist} , function(data){
                window.location = url;
            })

        }

        function report_quiz(id,reporter_id){ 
            $.prompt('Do you want to report this quiz?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                    if(v){
                        var txt = '<input type="hidden" id="quiz_id" name="quiz_id" value="'+id+'" />\n\
                            <input type="hidden" id="reporter_id" name="reporter_id" value="'+reporter_id+'" /><p>Report:&nbsp;<br><input type="radio" name="report" value="Spam" checked> Spam <br>\n\
                                                                                                             <input type="radio" name="report" value="Pornographic Material"> Pornographic Material <br>\n\
                                                                                                             <input type="radio" name="report" value="Hate or Racism"> Hate or Racism <br>\n\
                                                                                                             <input type="radio" name="report" value="Crueltly"> Crueltly (to People or Animals) <br>\n\
                                                                                                             <input type="radio" name="report" value="Copyright Infringement"> Copyright Infringement ';

                                                                                                                                 jqistates = {
                                                                                                                                     state0: {
                                                                                                                                         html: txt,
                                                                                                                                         focus: 1,
                                                                                                                                         buttons: { Send: true, Cancel: false },
                                                                                                                                         submit: function(v, m, f){
                                                                                                                                             var e = "";
                                                                                                                                             if (v) {
                                                                                                                                                 if (e == "") {
                                                                                                                                                     var id=f.quiz_id;
                                                                                                                                                     var reporter_id=f.reporter_id;
                                                                                                                                                     var code = f.report;
                                                                                                                                                     if(code!=""){
                                                                                                                                                         if(code=='Copyright Infringement') {
                                                                                                                                                             $.prompt('Report the copyright infringement by clicking our link and please explain the infringement to us: <br> <a href="mailto:copyrights@wannaquiz.com">copyrights@wannquiz.com</a>',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                                                                                                                                                                     if(v){

                                                                                                                                                                         $.post('<?=base_url()?>quiz/report_quiz', {quiz_id:id,report:code,reporter_id:reporter_id} , function(data){
                                                                                                                                                                             if (data != '' || typeof data != undefined || data != null)
                                                                                                                                                                             {
                                                                                                                                                                                 if(data=='success')
                                                                                                                                                                                 {
                                                                                                                                                                                     $.prompt('Your report was sent successfully!');
                                                                                                                                                                                 }
                                                                                                                                                                                 else $.prompt('error');
                                                                                                                                                                             }
                                                                                                                                                                         });
                                                                                                                                                                     }}});
                                                                                                                                                         }
                                                                                                                                                         else {
                                                                                                                                                             $.post('<?=base_url()?>quiz/report_quiz', {quiz_id:id,report:code,reporter_id:reporter_id} , function(data){
                                                                                                                                                                 if (data != '' || typeof data != undefined || data != null)
                                                                                                                                                                 {
                                                                                                                                                                     if(data=='success')
                                                                                                                                                                     {
                                                                                                                                                                         $.prompt('Your report was sent successfully!');
                                                                                                                                                                     }
                                                                                                                                                                     else $.prompt('error');
                                                                                                                                                                 }
                                                                                                                                                             });
                                                                                                                                                         }

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
                                                                                                                         }});
                                                                                                                 }
</script>
<?php //print_r($user);exit;
//print_r($quiz_info);exit;?>
<div class="leftside">
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="bold font14">Quiz Uploaded by</div>
            </div>
        </div>
        <div class="whiteboxleftside_bg" style="height:auto;">
            <div class="whiteboxrightside_bgInner">
                <div class="borderbottom_dotted"></div>
                <div class="content_10box">
                    <div>
                        <div class="quizvideo_left">
                            <div class="border1_green">
                                <a href="<?=base_url()?><?=$user->username?>">
                                    <? if($mem_profile->profile_picture!="") {?>
                                   <? if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                          <img src="<?=$mem_profile->profile_picture?>" alt="avatar" /> <? } else {?>
                                   <? } ?>
                                       <img src="<?=base_url()?>user_profile_images_thumb/<?=$mem_profile->profile_picture?>" alt="avatar" /> 
                                   <? } else {?>
                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="88" height="88" alt="avatar" /><? }?>
                                </a>
                            </div>
                        </div>
                        <div class="quizvideo_info">
                            <div class="bold"><a href="<?=base_url()?><?=$user->username?>"><?=$user->username?></a></div>
                            <div class="padding_5top">Joined: <?php $date = $user->joined_date; echo date("Y-m-d",$date);?></div>
                            <div class="padding_5top">Quizzes: <?php $quiz_data = $this->Quiz_model->get_quiz($user->user_id); echo count($quiz_data);?></div>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="padding_10topbottom" id="short">
                        <?php #$description = str_replace('Q:', '<br>Q:<br>',$quiz_info->quiz_comment); ?>                        
                        <?php #$desctiption = nl2br($description); ?>
                        <?php $description = nl2br($quiz_info->quiz_comment);
                        //echo preg_replace("/(http:\/\/[-a-z0-9\._]+)/","<a href='$1'>$1</a>",$description);

                        $desc = character_limiter(preg_replace("/(http:\/\/[-a-zA-Z0-9\._\/@]+)/","<a href='$1'>$1</a>",$description),25,'<br /><a href="javascript:void(0)" onclick="show_description()">  ... More</a>');
                        echo $desc;
                        #echo str_replace('<a','<br /><a',$desc);
                        
                        ?>                        
                    </div>

                    <div class="padding_10topbottom" id="full" style="display:none">
                        <?php #$description = str_replace('Q:', '<br>Q:', $description); ?>
                        <?php #$description = str_replace('A:', '<br>A:<br>', $description); ?>
                        <?php $desctiption = nl2br($description); ?>
                        <?php 
                        //echo preg_replace("/(http:\/\/[-a-z0-9\._]+)/","<a href='$1'>$1</a>",$description);

                        echo preg_replace("/(http:\/\/[-a-zA-Z0-9\._\/@]+)/","<a href='$1'>$1</a>",$description);?>
                        <br />
                        <a href="javascript:void(0)" onclick="hide_description()">Less ...</a>
                    </div>
                    
                </div><div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>

    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="bold font14">More From <a href="<?=base_url()?><?=$user->username?>"><?=$user->username?></a></div>
            </div>
        </div>

        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div class="borderbottom_dotted"></div>
                <div class="content_10box" >
                     <div><span id="sign1"> - </span><a href="javascript:void(0)" onclick="show_all_questions('<?=$user->user_id?>','<?=$user->quiz_id?>')">All Questions</a></div>
                    <?php if($this->session->userdata('set_playlist')=='all_questions' || $this->session->userdata('set_playlist')=='') $show = 'block'; else $show ='none'; ?>
                    <div style="display:<?=$show?>" id="all_questions">
                    <!--<div>From: <span class="bold"><a href="<?=base_url()?>member/profile/<?=$user->user_id?>" ><?=$user->username?></a></span></div>-->
                        <div class="padding_10topbottom">
                            <div id="leftpane" class="menu_list">
                                <?php
                              //  print_r($categories);
                                //foreach($category as $categories) {
//                                if(count($categories)>=10) $a=3;
//                                else
                                $a = count($categories);
                                
                                $array_id = array();
                                for($i=0;$i<$a;$i++) { //echo $categories[$i]->id;
                                    $subcategory = $this->Category_model->get_sub_categories($categories[$i]->id);

                                    if(count($subcategory)>0) {
                                        $sub_category1= array();
                                        foreach($subcategory as $subcategories) {
                                            $sub_category1[] = $subcategories->id;

                                            //$quiz = $this->Quiz_model->get_quiz_by_user_category($user->user_id,$subcategories->id,$categories[$i]->id);
                                    }
                                    $sub_category = implode(",",$sub_category1);
                                    $tmp_val = $sub_category.','.$categories[$i]->id;
                                    }
                                    else
                                    $tmp_val = $categories[$i]->id;
                                    $array_id[] = $tmp_val;
                                       //$quiz = $this->Quiz_model->get_quiz_by_user_category($user->user_id,'',$categories[$i]->id);
                                }
                                // print_r($array_id);
                                if(count($array_id)>10) $limit =10 ; else $limit = count($array_id);
                                for($j=0;$j<$limit; $j++) {
                                    $quiz = $this->Quiz_model->get_quiz_by_user_category($user->user_id,$array_id[$j],$filter);
                                   
                                    if(count($quiz)>0)
                                    {
                                        ?>
                                     <?php
                                    $parent_cat = $this->Category_model->get_parent_id($quiz_info->category_id);
                                    
                                    //echo $quiz_info->category_id.'/'.$parent_cat->parent_id.'/'.$categories[$j]->id;
                                    if($parent_cat->parent_id==0) {
                                        if($quiz_info->category_id == $categories[$j]->id) $display1 = 'block'; else $display1 = '';
                                    }
                                    else { //echo"hi";
                                        if($parent_cat->parent_id == $categories[$j]->id) $display1 = 'block'; else $display1 = '';
                                    }
                                    ?>
                                <h2 class="leftmenu_head"> 
                                     <?php if($display1=='block'){ ?>
                                        <!-- google_ad_section_start -->
                                        <? }?>
                                        <?=$categories[$j]->name?></h2>

                                        <?php if($display1=='block'){ ?>
                                        <!-- google_ad_section_end -->
                                        <? }?>

                                       
                                <div class="leftmenu_body" style="display:<?=$display1?>">
                                    <div>
                                                <?php

                                                foreach($quiz as $quizes) {
                                                    ?>

                                        <div class="content_10box">
                                            <div class="padding_10top">
                                                <div class="text_center">
                                                                <?php if($quizes->quiz_type =='photo') {?>

                                                    <div class="border_green">
                                                        <a href="<?=base_url()?>quiz/views/<?=$quizes->quiz_id?>">

                                                            <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                            else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$quizes->images;
                                                                    if(file_exists($photo_path)){
                                                                    ?>
                                                                        <img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />
                                                                    <? } else {?>
                                                                        <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                            <? } ?>


                                                            <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />-->
                                                        </a>
                                                    </div>
                                                                <? } else { $vd=explode('.',$quizes->images);
                                                                    if($_SERVER['SERVER_NAME']=='localhost')
                                                                        $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    ?>

                                                    <div class="border_green">
                                                        <a href="<?=site_url('quiz/views/'.$quizes->quiz_id)?>">
                                                                            <?php if(file_exists($a)) { ?>
                                                            <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                            <? } else {?>
                                                            <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                            <? } ?>
                                                        </a>
                                                        <!--<a href="<?=base_url()?>quiz/view/<?=$quizes->quiz_id?>">
                                                            <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                        </a>-->
                                                    </div>
                                                                <? }?>

                                                </div>

                                                <div>
                                                    <div class="color_blue">
                                                        <a href="<?=base_url()?>quiz/views/<?=$quizes->quiz_id?>"><?=$quizes->quiz_question?></a>
                                                    </div>
                                                    <div class="font11">
                                                            	From: <a href="<?=base_url()?><?=$user->username?>"><?=$quizes->username?></a>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <div class="borderbottom_dotted"></div>
                                                <? }//}else echo "There is no quizes in this category!";

                            ?>


                                    </div>
                                </div>
                                    <? } 
                                }?>

                                <div style="" id="more">
                                   
                                    <?php
                                    //print_r($array_id);
                                    //echo $quiz_info->category_id;
                                    $flagi=0;
                                    $parent_cat = $this->Category_model->get_parent_id($quiz_info->category_id);
                                   // print_r($parent_cat);
                                    for($k=10;$k<count($array_id);$k++) { 
                                     
                                        //echo $parent_cat->parent_id.'/'.$categories[$k]->id.'**';
                                        if($parent_cat->parent_id==0) {
                                            if($quiz_info->category_id == $categories[$k]->id) {
                                                $display = 'block';
                                                $flagi++;
                                            }
                                            else $display = '';
                                        }
                                        else {
                                            if($parent_cat->parent_id == $categories[$k]->id){
                                                $display = 'block';
                                                $flagi++;
                                            }
                                             else $display = '';
                                        }
                                        $quiz = $this->Quiz_model->get_quiz_by_user_category($user->user_id,$array_id[$k]);
                                        //print_r($quiz);
                                        if(count($quiz)>0) $counter++;
                                        if(count($quiz)>0) {
                                            ?>
                                    
                                            <h2 class="leftmenu_head" ><?=$categories[$k]->name?></h2>
                                    <div class="leftmenu_body" style="display:<?=$display?>">
                                        <div>
                                                    <?php
                                                    foreach($quiz as $quizes) {
                                                        ?>

                                            <div class="content_10box">
                                                <div class="padding_10top">
                                                    <div class="text_center">
                                                                    <?php if($quizes->quiz_type =='photo') {?>
                                                        <div class="border_green">
                                                            <a href="<?=base_url()?>quiz/views/<?=$quizes->quiz_id?>">

                                                                 <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                    $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                    #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                 else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$quizes->images;
                                                                        if(file_exists($photo_path)){
                                                                        ?>
                                                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />
                                                                        <? } else {?>
                                                                            <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                <? } ?>

                                                                <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />-->
                                                            </a>
                                                        </div>
                                                                    <? } else { $vd=explode('.',$quizes->images);
                                                         if($_SERVER['SERVER_NAME']=='localhost')
                                                                        $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                         else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                    ?>

                                                    <div class="border_green">
                                                        <a href="<?=site_url('quiz/views/'.$quizes->quiz_id)?>">
                                                                            <?php if(file_exists($a)) { ?>
                                                            <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                            <? } else {?>
                                                            <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                            <? } ?>
                                                        </a>
                                                        <!--<a href="<?=base_url()?>quiz/view/<?=$quizes->quiz_id?>">
                                                            <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                        </a>-->
                                                    </div>
                                                                    <? }?>

                                                    </div>

                                                    <div>
                                                        <div class="color_blue">
                                                            <a href="<?=base_url()?>quiz/views/<?=$quizes->quiz_id?>">
                                                                            <?=$quizes->quiz_question?>
                                                            </a>
                                                        </div>
                                                        <div class="font11">
                                                            	From: <a href="<?=base_url()?><?=$user->username?>"><?=$quizes->username?></a>
                                                        </div>
                                                    </div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div>

                                            <div class="borderbottom_dotted"></div>
                                                    <? }//}else echo "There is no quizes in this category!";
                                                     ?>


                                        </div>
                                    </div>
                                            <? } } ?>
                                            <input type="hidden" value="<?=$flagi?>" id="display_more">
                                </div>


                            </div>
                            <div class="text_center" id="show_more">
                                <a style="cursor:pointer" onclick="more()">More </a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                            </div>
                            <div class="text_center" id="show_less" style="display:none">
                                <a style="cursor:pointer" onclick="less()">less</a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                            </div>

                        </div>
                    </div>
                                <!-- playlist start-->
                    <div id="load_playlist">
                        <div> <span id="sign"> + </span><a href="javascript:void(0)" onclick="show_playlist()">Playlist Questions</a></div>
                        <?php if($this->session->userdata('set_playlist')=='playlist') $show1 = 'block'; else $show1 ='none'; ?>
                        <div style="display:<?=$show1?>" id="playlist_questions">
                       <!--<div>From: <span class="bold"><a href="<?=base_url()?>member/profile/<?=$user->user_id?>" ><?=$user->username?></a></span></div>-->
                          <div class="padding_10topbottom">
                                <div id="leftpane" class="menu_list">
                                    <?php
                                    //echo '<pre>';print_r($user_playlist);echo'</pre>';
                                    //foreach($category as $categories) {
                                    $playlist_rows = 0;
                                    if(count($user_playlist)>=10) $a=2;
                                    else $a = count($user_playlist);
                                    for($i=0;$i<$a;$i++) { //echo $playlist[$i]->id;
                                        if($this->session->userdata('set_playlist_quiz_user'))
                                            $user_id1 = $this->session->userdata('set_playlist_quiz_user');
                                        else $user_id1 = $user->user_id;

                                        $playlist_quiz = $this->Quiz_model->get_quizes_from_playlist($user_id1,$user_playlist[$i]->id,0,0);
                                        //print_r($playlist_quiz);
                                        if(count($playlist_quiz)>0)

                                            $playlist_quiz = $this->Quiz_model->get_quizes_from_playlist($user_id1,$user_playlist[$i]->id,0,0);

                                        if(count($playlist_quiz)>0) {
                                            ?>

                                    <h2 class="leftmenu_head"><?=$user_playlist[$i]->playlist_title?></h2>
                                            <?php
                                            $playlist_id = $this->Quiz_model->get_playlist_id($user->quiz_id);
                                            //echo $quiz_info->category_id.'/'.$parent_cat->parent_id.'/'.$categories[$i]->id;
                                            //echo $user_playlist[$i]->id;
                                            //echo $this->session->userdata('set_playlist_id').'/'.$user_playlist[$i]->id;
                                            if($user_playlist[$i]->id == $this->session->userdata('set_playlist_id')) $display1 = 'block'; else $display1 = '';
                                            //echo $display1;
                                            ?>
                                    <div class="leftmenu_body" style="display:<?=$display1?>">
                                        <div>
                                                    <?php

                                                    //echo '<pre>'; print_r($playlist_quiz);
                                                    //echo $this->session->userdata('set_playlist_quiz_user');
                                                    foreach($playlist_quiz as $playlistquizes) {
                                                       // echo $playlistquizes->playlist_id;
                                                        ?>
                                              
                                            <div class="content_10box">
                                                <div class="padding_10top">
                                                    <div class="text_center">
                                                                    <?php if($playlistquizes->quiz_type =='photo') {?>
                                                        <div class="border_green">
                                                            <a href="javascript:void(0)"  onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>','<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>')">
                                                                
                                                                 <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$playlistquizes->images;
                                                                        else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$playlistquizes->images;
                                                                            if(file_exists($photo_path)){
                                                                            ?>
                                                                                <img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes->images?>" alt="feature quest img" />
                                                                            <? } else {?>
                                                                                <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                    <? } ?>

                                                                <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes->images?>" alt="feature quest img" />-->
                                                            </a>
                                                        </div>
                                                                    <? } else { $vd=explode('.',$playlistquizes->images); ?>
                                                        <div class="border_green">
                                                            <a href="javascript:void(0)" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>','<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>')"<? } ?>>
                                                                <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                            </a>
                                                        </div>
                                                                    <? }?>

                                                    </div>

                                                    <div>
                                                        <div class="color_blue">
                                                            <a href="<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>','<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>')"<? } ?>><?=$playlistquizes->quiz_question?></a>
                                                        </div>
                                                        <div class="font11">
                                                            	From: <a href="<?=base_url()?><?=$user->username?>"><?=$playlistquizes->username?></a>
                                                        </div>
                                                    </div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div> 

                                            <div class="borderbottom_dotted"></div>
                                                    <? }//}else echo "There is no quizes in this category!";



                                                    ?>


                                        </div>
                                    </div>
                                        <? } if($display1=='') $display='block'; else $display='none';
                                    }?>

                                    <div id="more" style="display:<?=$display?>">
                                       
                                        <?php for($i=10;$i<count($user_playlist);$i++) {
                                            $subcategory = $this->Category_model->get_sub_categories($categories[$i]->id);
                                            ?>
                                            <?php $parent_cat = $this->Category_model->get_parent_id($quiz_info->category_id);
                                            //echo $parent_cat->parent_id.'/'.$categories[$i]->id;
                                            if($parent_cat->parent_id==0) {
                                                if($quiz_info->category_id == $categories[$i]->id) $display = 'block'; else $display = '';
                                            }
                                            else {
                                                if($parent_cat->parent_id == $categories[$i]->id) $display = 'block'; else $display = '';
                                            }

                                            $playlist_quiz1 = $this->Quiz_model->get_quizes_from_playlist($user->user_id,$user_playlist[$i]->id,0,0);
                                            if(count($playlist_quiz)>0) {
                                                ?>
                                        <h2 class="leftmenu_head" style="display:<?=$display?>"><?=$playlist_quiz1[$i]->playlist_title?></h2>
                                        <div class="leftmenu_body" style="display:<?=$display?>">
                                            <div>
                                                        <?php
                                                        foreach($playlist_quiz1 as $playlistquizes1) {
                                                            ?>

                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="text_center">
                                                                        <?php if($playlistquizes1->quiz_type =='photo') {?>
                                                            <div class="border_green" >
                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->playlist_id?>','<?=base_url()?>quiz/views/<?=$playlistquizes1->quiz_id?>')">
                                                                    
                                                                    <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$playlistquizes1->images;
                                                                        else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$playlistquizes1->images;
                                                                            if(file_exists($photo_path)){
                                                                            ?>
                                                                                <img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes1->images?>" alt="feature quest img" />
                                                                            <? } else {?>
                                                                                <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                    <? } ?>
                                                                    
                                                                    <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes1->images?>" alt="feature quest img" />-->
                                                                </a>
                                                            </div>
                                                                        <? } else { $vd=explode('.',$playlistquizes1->images); ?>
                                                            <div class="border_green">
                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->playlist_id?>','<?=base_url()?>quiz/view/<?=$playlistquizes1->quiz_id?>')">
                                                                    <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                </a>
                                                            </div>
                                                                        <? }?>

                                                        </div>

                                                        <div>
                                                            <div class="color_blue">
                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->palylist_id?>','<?=base_url()?>quiz/view/<?=$playlistquizes1->quiz_id?>')">
                                                                                <?=$playlistquizes1->quiz_question?>
                                                                </a>
                                                            </div>
                                                            <div class="font11">
                                                            	From: <a href="<?=base_url()?><?=$user->username?>"><?=$playlistquizes1->username?></a>
                                                            </div>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                </div>

                                                <div class="borderbottom_dotted"></div>
                                                        <? }//}else echo "There is no quizes in this category!";



                                                        ?>


                                            </div>
                                        </div>
                                            <? }}?>
                                    </div>


                                </div>
                                <!--<div class="text_center" id="show_more">
                                    <a style="cursor:pointer" onclick="more()">More </a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                </div>
                                <div class="text_center" id="show_less" style="display:none">
                                    <a style="cursor:pointer" onclick="less()">less</a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                </div>-->

                            </div>
                        </div>
                    </div>
                                    <!--Playlist end -->
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
    
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="bold font14"><?php echo $quiz_info->quiz_question?></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div class="borderbottom_dotted"></div>
                <div class="content_10box">
                    <div>
                        <div style="float:left; display:inline-block;">Rate: &nbsp;</div>
                        <!-- Rating Stars -->
                        <div id="rate_<?=$user->quiz_id?>" class="rating"></div>
                        <!-- End Rating Stars-->
                        <div class="clear"></div>
                    </div>

                    <div class="padding_10topbottom">
                                    	Views: <?php echo $this->Quiz_model->get_quiz_views($user->quiz_id)?>
                    </div>

                    <div>
                        <div class="padding_5bottom">
                            <div class="fav_icon" onclick="add_favourites(<?=$user->quiz_id?>)"><a href="#">Add to favorites</a></div>
                        </div>
                        <div class="padding_5bottom">                            
                            <? #$this->load->view('addthis'); ?>
                        </div>
                        <div class="padding_5bottom">
                            <div class="playlist_icon" ><a href="#" id="add_playlist" onclick="playlist_add(<?=$this->session->userdata('wannaquiz_user_id')?>)">Add to playlist</a></div>
                        </div>
                        <?php if($this->session->userdata('wannaquiz_user_id') !='' ) { ?>
                        <div class="padding_5bottom">
                            <div class="report_icon"><a href="javascript:void(0)" onclick="report_quiz('<?=$user->quiz_id?>','<?=$this->session->userdata("wannaquiz_user_id")?>')">Report</a></div>
                        </div>
                        <? }?>
                    </div>

                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
    
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">

        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">

                <div class="padding_10leftright">
                    <form name="subscribe" action="" method="post">
                        <!--<div class="input_clear">
                            <div>
                                <div class="searchbtn_leftborder"></div>
                                <input type="submit" class="searchbtn_bg" name="submit" value="Subscribe" />
                                <div class="searchbtn_rightborder"></div>
                                <div class="clear"></div>
                            </div>
                            <div>to: <span class="bold"> Meriam Fieona</span></div>
                        </div>-->
                        <div class="input_clear">
                            <label class="bold">URL:</label><br />
                            <div class="textbox" style="height:auto; padding:2px;" ><?=base_url()?>quiz/views/<?=$user->quiz_id?></div>
                        </div>
                        <!--<div class="input_clear">
                            <label class="bold">Embeded:</label><br />
                            <?php if($user->quiz_type=='video') {
                                $video_quiz = $this->Quiz_model->get_video_quiz_by_ID($user->quiz_id);
                                $video = $video_quiz->quiz_videos;
                                $video = explode(".",$video);
                                ?>
                            <textarea class="textbox" cols="26" style="height:50px" onfocus="this.select()" readonly="readonly">
                                <embed src="<?=base_url()?>flvplayer/player.swf?file=<?=base_url().'converted_videos/'.$video[0]?>.flv&autoStart=true" width="320" height="240" quality="medium" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
                            </textarea>
                            <? } else {?>
                            <textarea class="textbox" cols="26" style="height:30px; background-color:silver" onfocus="this.select()" readonly="readonly">

                            </textarea>
                            <? }?>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
</div>