<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>WANNA QUIZ : Quiz Detail</title>
        <link href="<?=base_url()?>css/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/form.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/game.css" rel="stylesheet" type="text/css" />
        <script>var base_url='<?=base_url()?>';</script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu.css" />
        <script type="text/javascript" src="<?=base_url()?>js/ddsmoothmenu.js"></script>

        <script type="text/javascript">

        ddsmoothmenu.init({
                mainmenuid: "smoothmenu1s", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu_1', //class added to menu's outer DIV
                //customtheme: ["#1c5a80", "#18374a"],
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        })


        </script>

        <link href="<?php echo base_url();?>/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
.slideshow { height: 250px; width: 257px; margin: auto }
.slideshow img { padding: 10px; border: 1px solid #ccc; background-color: #eee; }
</style>
<!-- include jQuery library -->

<!-- include Cycle plugin -->
<script type="text/javascript" src="<?=base_url()?>js/jquery.cycle.all.min.js"></script>

<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'scrollLeft', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
                activePagerClass: 'activeSlide',
                continuous: 0,
               random: 0,
               autostop:0,
               autostopCount:0

	});
});
</script>

        <link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
        <style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>

        <script type="text/javascript">
            $(document).ready(function()
            {
                //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
                $("#leftpane h2.leftmenu_head").click(function()
                { 
                    $(this).css({background:"#CB9C9C url(<?=base_url()?>images/up.png) no-repeat"}).next("div.leftmenu_body").slideToggle(300).siblings("div.leftmenu_body").slideUp("slow");
                    $(this).siblings('h2.leftmenu_head ').css({background:"#CB9C9C url(<?=base_url()?>images/down.png) no-repeat"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph

            });
        </script>

         
        <script type="text/javascript">

            function quiz_commit(uid){ //alert('hii');
                var comment = $('#quiz_comment').val();
                if(comment == '')
                {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>quiz/quizCommit', {quiz_id:"<?=$quiz_id?>",user_id:uid,comment:comment} , function(data){

                        if (data != '' || data != undefined || data != null)
                        {
                            dt=data.split('*');
                            if(dt[0]=='success')
                            {
                                $('#comment').html(dt[1]);
                                //location.reload(location.href="<?=base_url()?>quiz/view/<?=$quiz_id?>#comment");
                            }
                            else alert('error');

                        }
                    });
                }

            }

            function quiz_reply_commit(comment_id,uid){
                var comment = $('#quiz_reply_comment_'+comment_id).val();
                if(comment == '')
                {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>quiz/quizReplyCommit', {quiz_id:<?=$quiz_id?>,comment_id:comment_id,user_id:uid,comment:comment} , function(data){

                        if (data != '' || data != undefined || data != null)
                        {
                            dt=data.split('*');
                            if(dt[0]=='success')
                            {
                                $('#reply_comment_'+comment_id).html(dt[1]);
                                $('#reply_'+comment_id).hide('slow');
                                //location.reload(location.href="<?=base_url()?>quiz/view/<?=$quiz_id?>#reply_comment_"+comment_id);
                            }
                            else alert('error');

                        }
                    });
                }

            }

            function like_quiz_comment(comment_id,status)
            {
                $.post('<?=base_url()?>quiz/likeQuizComment', {comment_id:comment_id,status:status} , function(data){

                    if (data != '' || data != undefined || data != null)
                    {
                        dt=data.split('|');
                        if(dt[0]=='success')
                        {
                            $('#like_'+comment_id).html(dt[1]);
                            $('#unlike_'+comment_id).html(dt[2]);
                        }
                        else if(dt[0]=='unsuccess')
                            alert(dt[1]);
                        else alert(dt[0]);

                    }
                });

            }

            function deleteQuizComment(comment_id)
            {

                $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                        if(v){
                            $.post('<?=base_url()?>quiz/deleteQuizComment/'+comment_id, function(data){
                                if (data != '' || data != undefined || data != null)
                                {

                                    if(data=='success')
                                    {
                                        alert('successfully deleted!');
                                        //$('#reply_comment_'+comment_id).html(dt[1]);
                                        //$('#reply_'+comment_id).hide('slow');
                                        location.reload(location.href="<?=base_url()?>quiz/view/<?=$quiz_id?>#reply_comment_"+comment_id);
                                    }
                                    else alert('error');
                                }

                            });
                        }}});
            }

            function deleteQuizCommentReply(comment_reply_id)
            {

                $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                        if(v){
                            $.post('<?=base_url()?>quiz/deleteQuizCommentReply/'+comment_reply_id, function(data){
                                if (data != '' || data != undefined || data != null)
                                {

                                    if(data=='success')
                                    {
                                        alert('successfully deleted!');
                                        //$('#reply_comment_'+comment_id).html(dt[1]);
                                        //$('#reply_'+comment_id).hide('slow');
                                        location.reload(location.href="<?=base_url()?>quiz/view/<?=$quiz_id?>");
                                    }
                                    else alert('error');
                                }

                            });
                        }}});
            }

            function quizSpam(comment_id,flag){
                $.prompt('Do you want to spam it?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                        if(v){
                            $.post('<?=base_url()?>quiz/spamQuizComment/'+comment_id,{flag:flag}, function(data){
                                if (data != '' || data != undefined || data != null)
                                {
                                    if(data=='success')
                                    {
                                        alert('successfully spam!');
                                        //$('#reply_comment_'+comment_id).html(dt[1]);
                                        //$('#reply_'+comment_id).hide('slow');
                                        //location.reload(location.href="<?=base_url()?>quiz/view/<?=$quiz_id?>");
                                    }
                                    else alert('error!');
                                }
                            });
                        }}});

            }

            function hideShowReaction(){
                $('#text_reaction').toggle();
            }

            function toggle(obj) {
                //alert(obj); return false;
                var el = document.getElementById(obj);
                if ( el.style.display != 'none' ) {
                    el.style.display = 'none';
                }
                else {
                    el.style.display = '';
                }
            }
        </script>

        <script type="text/javascript">
            function getfocus(){
                document.getElementById('quiz_comment').focus()
            }

        </script>
        <script language="JavaScript">
            function setFocus() {
                document.getElementById('quiz_comment').focus();

            }
        </script>

        <!--[if lte IE 6]>
	<link href="<?=base_url()?>css/ie-6.css" rel="stylesheet" type="text/css" />
                <script type="text/javascript" src="js/unitpngfix.js"></script>
        <![endif]-->

        <!--[if IE 7]>
	<link href="<?=base_url()?>css/ie-7.css" rel="stylesheet" type="text/css" />
        <![endif]-->

        <!--[if IE 8]>
	<link href="<?=base_url()?>css/ie-8.css" rel="stylesheet" type="text/css" />
        <![endif]-->
    </head>

    <body>
        
        <div class="quizbody_bg">
            <div id="body_wrap">
                <div class="bodywrapInner">

                    <div>

                        <?php include('quiz/quiz_leftside.php'); ?>

                        <?php include('quiz/quiz_midside.php'); ?>

                        <?php include('quiz/quiz_rightside.php'); ?>

                        <div class="clear"></div>
                    </div>

                    <div>
                        <div class="quizhomeleft">
                            <div class="quizhomeleftInner">
                                <div class="content_wrap">
                                    <div class="quizhomeleft_topborder">
                                        <div class="title_align">
                                            <div class="">
                                                <div class="quizcomment_title">
                                                    <div><img src="<?=base_url()?>images/down_arrow.jpg" width="18" height="11" alt="arrow" /> <span class="bold">Text reactions: (<?=count($quiz_comments)?>)</span></div>
                                                </div>
                                                <div class="comment_titleright">
                                                    <div class="text_right" onclick="setFocus();">
                                                        <a href="javascript:void(0)" class="text_right" onclick="getfocus()">Add a text reaction</a>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="quizhomeleft_bg">
                                        <div class="whiteboxrightside_bgInner">
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                                <div class="content_wrap">
                                                    <div id="comment">
                                                        <?php //print_r($quiz_comments);
                                                        $user_id = $this->session->userdata('wannaquiz_user_id');
                                                        if(count($quiz_comments)>0) {
                                                            foreach($quiz_comments as $quizComments) {
                                                                $like_comment = $this->Quiz_model->get_quiz_comment_like($quizComments->comment_id);
                                                                $unlike_comment = $this->Quiz_model->get_quiz_comment_unlike($quixComments->comment_id);
                                                                ?>
                                                        <div class="padding_10topbottom">
                                                            <div>
                                                                <div class="quizcomment_name"><a href="<?=base_url()?>member/profile/<?=$quizComments->user_id?>" class="bold"><?=$quizComments->username?></a> (<?=date("Y-m-d H:i:s",$quizComments->comment_date)?>)</div>
                                                                <div class="comment_reply"><div class="text_center"><a style="cursor:pointer" onclick="toggle('reply_<?=$quizComments->comment_id?>')">Answer</a> | <a href="#" onclick="quizSpam('<?=$quizComments->comment_id?>','comment')">Spam</a><?php if($quizComments->user_id==$user_id ) {?> | <a href="#" onclick="deleteQuizComment('<?=$quizComments->comment_id?>')">Delete</a><? }?></div></div>
                                                                <div class="comment_arrange">
                                                                    <div class="text_right">
                                                                        <span id="like_<?=$quizComments->comment_id?>"> <?=$like_comment?> Like </span>
                                                                        <span><a style="cursor:pointer" onclick="like_quiz_comment('<?=$quizComments->comment_id?>','1')"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                                        <span><a style="cursor:pointer" onclick="like_quiz_comment('<?=$quizComments->comment_id?>','0')"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a> </span>
                                                                        <span id="unlike_<?=$quizComments->comment_id?>"><?=$unlike_comment?> Unlike </span>
                                                                    </div>
                                                                </div>

                                                                <div class="clear"></div>
                                                            </div>
                                                            <div class="padding_10topbottom">
                                                                        <?=nl2br($quizComments->comment)?>
                                                            </div>

                                                        </div>

                                                        <div id="reply_comment_<?=$quizComments->comment_id?>">
                                                                    <?php
                                                                    $comment_reply = $this->Quiz_model->get_reply_comments($quizComments->comment_id);
                                                                    //print_r($comment_reply);
                                                                    if(count($comment_reply)>0) {
                                                                        foreach($comment_reply as $reply) {

                                                                            $like_comment = $this->Quiz_model->get_quiz_comment_like($reply->comment_id);
                                                                            $unlike_comment = $this->Quiz_model->get_quiz_comment_unlike($reply->comment_id);
                                                                            ?>
                                                            <div class="borderbottom_gray"></div>
                                                            <div class="borderleft_5gray">
                                                                <div class="content_10box">
                                                                    <div>
                                                                        <div class="comment_subname1"> <a href="#" class="bold"><?=$reply->username?></a> (<?=date("Y-m-d H:i:s",$reply->comment_date)?>)</div>
                                                                        <div class="comment_reply"><div class="text_center"><a href="#" onclick="quizSpam('<?=$reply->comment_reply_id?>','reply_comment')">Spam</a><?php if($reply->user_id==$this->session->userdata('wannaquiz_user_id')) {?> | <a href="#" onclick="deleteQuizCommentReply(<?=$reply->comment_reply_id?>)">Delete</a><? }?></div></div>
                                                                        <div class="comment_arrange1">
                                                                            <div class="text_right">
                                                                                <span id="like_<?=$reply->comment_id?>"> <?=$like_comment?> Like </span>
                                                                                <span><a style="cursor:pointer" onclick="like_quiz_comment('<?=$reply->comment_id?>','1')"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span>
                                                                                <span><a style="cursor:pointer" onclick="like_quiz_comment('<?=$reply->comment_id?>','0')"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                                                <span id="unlike_<?=$reply->comment_id?>"><?=$unlike_comment?> Unlike </span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clear"></div>
                                                                    </div>
                                                                    <div class="padding_10topbottom">
                                                                                        <?=nl2br($reply->comment)?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                        <? } } ?>
                                                        </div>

                                                        <div class="content_wrap">
                                                            <div class="quizcomment_title" style="display:none" id="reply_<?=$quizComments->comment_id?>">
                                                                <div class="input_clear">
                                                                    <div class="font16">Reaction to this video</div>
                                                                    <textarea class="textbox" style="width:350px; height:100px;" id="quiz_reply_comment_<?=$quizComments->comment_id?>"></textarea>
                                                                    <input type="hidden" name="friend_id" id="friend_id" value="<?=$this->session->userdata('wannaquiz_user_id')?>" />
                                                                </div>
                                                                <div class="input_clear">
                                                                    <div class="searchbtn_leftborder"></div>
                                                                    <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="quiz_reply_commit('<?=$quizComments->comment_id?>','<?=$this->session->userdata("wannaquiz_user_id")?>')"/>
                                                                    <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                                                    <div>Not more than 500 characters</div>
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>
                                                        </div>
                                                        <div class="borderbottom_gray"></div>
                                                            <?}} ?>
                                                    </div>
                                                    <!--<div class="comment_titleright"><a href="#" class="text_right">Add a video reaction</a></div>-->
                                                    <div class="clear"></div>
                                                    <div class="padding_10top">
                                                        <div class="bg_blue">
                                                            <div class="content_5box">
                                                                <div class="quizcomment_title">
                                                                    Page: <?php echo $this->pagination->create_links();?>
                                                                    <!--<div> <span class="bold">Page: <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a></span></div>-->
                                                                </div>
                                                                <!--<div class="comment_titleright">
                                                                    <div class="text_right"><a href="#">Next</a></div>
                                                                </div>-->

                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <!--<div><a href="#">Watch all <?=$count_comments?> reactions</a></div>-->
                                                    </div>
                                                </div>

                                                <div class="content_wrap" >

                                                    <form name="reactionform" action="" method="post">
                                                        <div class="quizcomment_title" id="text_reaction">
                                                            <div class="input_clear">
                                                                <div class="font16">Reaction to this video</div>
                                                                <textarea class="textbox" style="width:350px; height:100px;" id="quiz_comment"></textarea>
                                                                <input type="hidden" name="friend_id" id="friend_id" value="<?=$this->session->userdata('wannaquiz_user_id')?>" />
                                                            </div>
                                                            <div class="input_clear">
                                                                <div class="searchbtn_leftborder"></div>
                                                                <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_quiz_comment" onclick="quiz_commit('<?=$this->session->userdata("wannaquiz_user_id")?>')"/>
                                                                <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                                                <div>Not more than 500 characters</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>

                                                        <div class="clear"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="quizhomeleft_bottomborder"></div>
                                </div>
                            </div>
                        </div>
                        <div class="quizhomeright">
                            <div class="content_wrap">
                                <div class="quizhomeright_topborder">
                                    <div class="title_align">
                                        <div class="bold font14">Search in Wannaquiz.com</div>
                                    </div>
                                </div>
                                <div class="quizhomeright_bg">
                                    <div class="whiteboxrightside_bgInner">
                                        <div class="padding_10top"><div class="borderbottom_dotted"></div></div>
                                        <div class="content_10box">
                                            <form name="search" action="<?=base_url()?>quiz/search" method="post">
                                                <div>
                                                    <div class="quizsearch">
                                                        <label>Search for</label>
                                                        <input type="text" class="textbox" name="search" style="width:200px;" />
                                                    </div>

                                                    <div class="quizsearch">
                                                        <label>Search by</label>
                                                        <!--<select id="category" name="category" style="width:143px; font-size:11px">
                                                                    <option value="">Select Category</option>
                                                                    <option value="all">All</option>
                                                        <?php
                                                        if(count($category)>0) {
                                                            foreach($category as $categories) {
                                                                $subcategory = $this->Category_model->get_sub_categories($categories->id);
                                                                ?>

                                                                    <option value="<?=$categories->id?>"><?=$categories->name?></option>
                                                                <?php
                                                                if(count($subcategory)>0) {
                                                                    foreach($subcategory as $subcategories) {?>
                                                                    <option style="margin-left:20px; " value="<?php echo $subcategories->id; ?>" <? if($subcategories->id==$quiz_info->category_id) echo "selected"?>><?php echo $subcategories->name; ?></option>

                                                                    <?}}}}?>
                                                                </select>-->
                                                        <div>
                                                            <select id="category" name="category" style="width:143px; height:22px; font-size:11px">
                                                                <option value="1">All Ages</option>
                                                                <option value="2">12+</option>
                                                                <option value="3">18+</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10topbottom">
                                                    <div class="searchbtn_leftborder"></div>
                                                    <input type="submit" class="searchbtn_bg" name="submit" value="Search" />
                                                    <div class="searchbtn_rightborder" style="margin-right:20px;"></div>
                                                    <!--<div><a href="#">Advanced Search</a></div>-->
                                                    <div class="clear"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="quizhomeright_bottomborder"></div>
                            </div>

                            <div class="content_wrap">
                                <div class="quizhomeright_topborder"></div>
                                <div class="quizhomeright_bg">
                                    <div class="whiteboxrightside_bgInner">
                                        <div class="padding_10leftright">
                                            <div>
                                                <div class="content_10box">
                                                     <?php if($user->user_type==0){ ?>
                                                    <div class="text_center">
                                                        <?php $user_id = $user->user_id; 
                                                        $check = $this->Member_model->check_user_partner($user_id);
                                                        //print_r($check);
                                                        if($check->active==1) {
                                                            if($this->session->userdata('adsense_status1')=='')
                                                            $this->session->set_userdata('adsense_status1','user');
                                                            //$partner_info = $this->Member_model->get_user_partner_info($user_id);
                                                            //if($partner_info->ad_type=='rectangular'){
                                                            ?> 
                                                        <div class="">
                                                             <?php if($this->session->userdata('adsense_status1')=='user'){?>
                                                            <label><?php echo $partner_info->user_rectangular_code?></label>
                                                            <?php $this->session->set_userdata('adsense_status1','admin');
                                                            } else {?>
                                                            <label><?php echo $partner_info->admin_rectangular_code?></label>
                                                            <?php $this->session->set_userdata('adsense_status1','user');
                                                            }?>
                                                        </div>
                                                        <?
                                                        //}
                                                    } else{
                                                        ?>
                                                        <img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertisement" />
                                                        <? } ?>
                                                    </div>
                                                    <? } ?>
                                                    <div style="display:none" id="footer_question">
                                                    </div>
                                                    <div id="url_question">
                                                        <div class="content_10box">
                                                            <div style="width:350px; margin:0 auto;">
                                                                <div style="border:1px solid #CCFFFF;">
                                                                    <div class="content_10box">
                                                                        <div class="color_blue bold">WannaQuiz question in Written Form:</div>
                                                                        <?php
                                                                        $sql = "SELECT q.quiz_id,q.quiz_question,o.option1,o.option2,o.option3 FROM tbl_quizes q,tbl_quiz_options o WHERE o.quiz_id=q.quiz_id AND q.quiz_id=".$quiz_id;
                                                                        $query=$this->db->query($sql);
                                                                        $data=$query->row();
                                                                        ?>
                                                                        <div class="padding_10topbottom"> <?php echo $data->quiz_question; ?></div>
                                                                        <div>
                                                                            <span class="color_blue">A)</span> <span><?php echo $data->option1; ?> &nbsp;</span>
                                                                            <span style="color:red;">B)</span> <span><?php echo $data->option2; ?> &nbsp;</span>
                                                                            <span class="color_green">C)</span> <span><?php echo $data->option3; ?> &nbsp;</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="padding_10topbottom">
                                                             <img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertisement" />
                                                     </div>-->
                                                </div>
                                            </div>

                                            <!--<div class="quizadd_right">
                                	<div class="content_10box">
                                    	<div class="padding_10topbottom">
                                                            <img src="<?=base_url()?>images/advertisement120.jpg" width="120" height="120" alt="advertise" />
                                                    </div>
                                                    <div class="padding_10topbottom">
                                                            <img src="<?=base_url()?>images/advertisement120.jpg" width="120" height="120" alt="advertise" />
                                                    </div>
                                                    <div class="padding_10topbottom">
                                                            <img src="<?=base_url()?>images/advertisement120.jpg" width="120" height="120" alt="advertise" />
                                                    </div>

                                                </div>
                                            </div>-->

                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="quizhomeright_bottomborder"></div>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>

                </div>
            </div>
            <div class="footer_bg">
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </body>
</html>
