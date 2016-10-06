<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script type="text/javascript">
    var j = jQuery.noConflict();
    
    j(document).ready(function()
    {
//        $('a').removeAttr('href');
        //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
        j("#firstpane>h2.menu_head:first-child").addClass('sel_accord');
        j("#firstpane h2.menu_head").click(function()
        {
            
            if(!$(this).is('.sel_accord')){
                j("#firstpane h2.menu_head").removeClass('sel_accord').next("div.menu_body").stop(true,true).slideUp(300);
                j("#firstpane h2.menu_head span").css({background:"url(<?=base_url()?>images/down.png) no-repeat right center"});
                j(this).addClass('sel_accord').next("div.menu_body").stop(true,true).slideDown(300);
                j(this).find('span').css({background:"url(<?=base_url()?>images/up.png) no-repeat no-repeat right center"});
            }else if($(this).is('.sel_accord')){
                j("#firstpane h2.menu_head").removeClass('sel_accord').next("div.menu_body").stop(true,true).slideUp(300);
                j("#firstpane h2.menu_head span").css({background:"url(<?=base_url()?>images/down.png) no-repeat right center"});
            }
        });
        //slides the element with class "menu_body" when mouse is over the paragraph


        
         j("#add_friend").click(function(){

            var id=<?=$mem_info->user_id?>;

            //send email request through ajax
            j.post('<?=base_url()?>member/sendFriendRequest', {friend_id:id} , function(data)
            { 
                if (data != '' || data != undefined || data != null)
                        {   dt=data.split('*');
                            if(dt[0]=='success')
                             $.prompt(dt[1]);
                            else $.prompt('You must be logged in to Send Friend Request');

                        }

            });


        });
        
//        j("#add_friend").click(function(){
//
//            var id=<?=$mem_info->user_id?>;
//
//            //send email request through ajax
//            j.post('<?=base_url()?>member/sendFriendRequest', {friend_id:id} , function(data)
//            {
//                if (data != '' || typeof data != undefined || data != null)
//                {  
//                    if(data=='sent')
//                        j.prompt('Your friend request has been !');
//
//                    if(data=='already_sent')
//                        j.prompt('You have already send friend request !');
//                }
//                    else
//                    window.location = "<?=base_url()?>home/login";
//               
//
//            });
//
//
//        });



        j("#block_user").click(function(){
            j.prompt("Friend has been blocked");
        });

        j("#send_message").click(function(){
            sendMessage()	;
        });

        function sendMessage(){
            var id=<?=$mem_info->user_id?>;
            var txt = 'Subject:&nbsp;&nbsp;<input type="text" id="subject" name="subject" value="" /><input type="hidden" id="member_id" name="member_id" value="'+id+'" /><p>Message:&nbsp;<textarea name="message" id="message" ></textarea>';

            jqistates = {
                state0: {
                    html: txt,
                    focus: 1,
                    buttons: { Cancel: false, Send: true },
                    submit: function(v, m, f){
                        var e = "";
                        if (v) {
                            if (e == "") {
                                var subject = f.subject;
                                var id=f.member_id;
                                var message = f.message;
                                if(subject!="" && message!=""){

                                    j.post('<?=base_url()?>member/sendMessage', {id:id,subject:subject,message:message} , function(data){
                                        if (data != '' || typeof data != undefined || data != null)
                                        {
                                            if(data=='success')
                                            j.prompt(" Message Sent Successfully");
                                            else
                                               j.prompt(" You Must be Logged in to send message");
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
            j.prompt(jqistates);
        }



    });

    function profile_commit(comment_id){
        var comment = j('#profile_comment').val();
        if(comment == '')
        {
            alert('The field should not be empty!')
        }
        else
        {
            j.post('<?=base_url()?>member/profileCommit', {profile_id:'<?=$profile_id?>',user_id:'<?=$this->session->userdata('wannaquiz_user_id')?>',comment:comment} , function(data){

                if (data != '' || typeof data != undefined || data != null)
                {
                    dt=data.split('*');
                    if(dt[0]=='success')
                    {
                        $('#comment').html(dt[1]);
                        //location.reload(location.href="<?=base_url()?>member/profile/<?=$profile_id?>#comment");


                        //$('#comment').focus();
                    }
                    else $.prompt('You must be logged in to comment');

                }
            });
        }

    }

    function profile_reply_commit(comment_id){
        var comment = j('#profile_reply_comment_'+comment_id).val();
        if(comment == '')
        {
            alert('The field should not be empty!')
        }
        else
        {
            j.post('<?=base_url()?>member/profileReplyCommit', {profile_id:'<?=$profile_id?>',comment_id: comment_id,user_id:'<?=$this->session->userdata('wannaquiz_user_id')?>',comment:comment} , function(data){

                if (data != '' || typeof data != undefined || data != null)
                {
                    dt=data.split('*');
                    if(dt[0]=='success')
                    {
                        $('#reply_comment_'+comment_id).html(dt[1]);
                        $('#reply_'+comment_id).hide('slow');
                        //location.reload(location.href="<?=base_url()?>member/profile/<?=$profile_id?>#reply_comment_"+comment_id);
                    }
                    else $.prompt('You must be logged in to comment');

                }
            });
        }

    }


    function echeck(str) {

        var at="@"
        var dot="."
        var lat=str.indexOf(at)
        var lstr=str.length
        var ldot=str.indexOf(dot)
        if (str.indexOf(at)==-1){
            // alert("Invalid E-mail ID")
            return false
        }

        if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
            // alert("Invalid E-mail ID")
            return false
        }

        if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
            // alert("Invalid E-mail ID")
            return false
        }

        if (str.indexOf(at,(lat+1))!=-1){
            // alert("Invalid E-mail ID")
            return false
        }

        if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
            // alert("Invalid E-mail ID")
            return false
        }

        if (str.indexOf(dot,(lat+2))==-1){
            //alert("Invalid E-mail ID")
            return false
        }

        if (str.indexOf(" ")!=-1){
            // alert("Invalid E-mail ID")
            return false
        }

        return true
    }

    function like_profile_comment(comment_id,status)
    {
        j.post('<?=base_url()?>member/likeProfileComment', {comment_id:comment_id,status:status} , function(data){

            if (data != '' || typeof data != undefined || data != null)
            {
                dt=data.split('|');
                if(dt[0]=='success')
                {
                    j('#like_'+comment_id).html(dt[1]);
                    j('#unlike_'+comment_id).html(dt[2]);
                }
                else if(dt[0]=='unsuccess')
                    alert(dt[1]);
                else alert(dt[0]);

            }
        });

    }

    function toggle(obj) {
        var el = document.getElementById(obj);
        if ( el.style.display != 'none' ) {
            el.style.display = 'none';
        }
        else {
            el.style.display = '';
        }
    }

    function subscribe_unsubscribe(status){

        j.post('<?=base_url()?>member/subscribe', {profile_id:<?=$profile_id?>,status:status} , function(data)
        {
            if(data=='subscribed'){
                j.prompt("Favorite added to your profile page");

                j('#unsubscribe_friend').show();
                j('#subscribe_friend').hide();

            }
            else if(data=='unsubscribed'){
                j.prompt("Favorite removed from your profile page");
                j('#unsubscribe_friend').hide();
                j('#subscribe_friend').show();
            }
            else 
                window.location = "<?=base_url()?>home/login"
                //alert('error');
        });


    };

    //		$("#unsubscribe_friend").click(function(){
    //
    //                                $.post('<?=base_url()?>member/subscribe', {profile_id:<?=$profile_id?>,status:0} , function(data)
    //                                {
    //                                    if(data=='unsubscribed'){
    //                                    $.prompt("Successfully unsubscribed");
    //
    //                                    $("#subscribe").html('<a href="javascript:void(0)" style="padding:0 5px;" id="subscribe_friend">Subscribe</a>');
    //
    //                                    }
    //                                    else alert('error');
    //                                });
    //
    //		});

    function see_all_subscribings(){
        var mem_id = <?=$profile_id?>;

        j.post('<?=base_url()?>member/allSubscribings', {mem_id:mem_id} , function(data){

            if (data != '' || typeof data != undefined || data != null)
            {
                j.prompt(data);
            }
        });
    }

    function see_all_subscribers(){
        var mem_id = <?=$profile_id?>;
        j.post('<?=base_url()?>member/allSubscribers', {mem_id:mem_id} , function(data){

            if (data != '' || typeof data != undefined || data != null)
            {
                j.prompt(data);
            }
        });
    }

    function see_all_friends()
    {
        var mem_id = <?=$profile_id?>;
        j.post('<?=base_url()?>member/allFriends', {mem_id:mem_id} , function(data){

            if (data != '' || typeof data != undefined || data != null)
            {
                j.prompt(data);
            }
        });
    }

    function deleteMemberComment(comment_id,username)
    {

        j.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                    j.post('<?=base_url()?>member/deleteMemberComment/'+comment_id, function(data){
                        if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('successfully deleted!');
                                //$('#reply_comment_'+comment_id).html(dt[1]);
                                //$('#reply_'+comment_id).hide('slow');
                                //location.reload(location.href="<?=base_url()?>"+username+"#reply_comment_"+comment_id);
                                window.location.reload();
                            }
                            else alert('error');
                        }

                    });
                }}});
    }

    function deleteMemberCommentReply(comment_reply_id,username)
    {

        j.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                    j.post('<?=base_url()?>member/deleteMemberCommentReply/'+comment_reply_id, function(data){
                        if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('successfully deleted!');
                                //$('#reply_comment_'+comment_id).html(dt[1]);
                                //$('#reply_'+comment_id).hide('slow');
                                //location.reload(location.href="<?=base_url()?>"+username);
                                window.location.reload();
                            }
                            else alert('error');
                        }

                    });
                }}});
    }

    function memberCommentSpam(comment_id,flag){
        j.prompt('Do you want to spam it?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                    j.post('<?=base_url()?>member/spamMemberComment/'+comment_id,{flag:flag}, function(data){
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

    function setProfileViewClick(profile_id){
        j.post('<?=base_url()?>quiz/setProfileViewClick/',{profile_id:profile_id,action:'click'}, function(data){
           });
    }

    function more_categories(){
        j('#chart').hide();
        j('#chart1').show();
    }

    function more_categories1(){
        j('#chart1').hide();
        j('#chart2').show();
    }

    function pre_categories(){
        j('#chart1').hide();
        j('#chart').show();
    }

    function pre_categories1(){
        j('#chart2').hide();
        j('#chart1').show();
    }

    function show_playlist(){
        //$.post('<?=base_url()?>quiz/set_playlist_session', {playlist:'playlist'} , function(data){});
        $('#all_questions').hide();
        $('#playlist_questions').show();
        $('#sign').html(' - ');
        $('#sign1').html(' + ');
    }

    function playlist_question_click(quiz_id,user_id,playlist,url){ //alert(playlist);
        $.post('<?=base_url()?>quiz/playlist_quiz_click_ses', {quiz_id:quiz_id,user_id:user_id,playlist:playlist} , function(data){
            window.location = url;
        })

    }

    function show_all_questions(url){
        $.post('<?=base_url()?>quiz/set_playlist_session', {user_id:'',quiz_id:'',playlist:'all_questions'} , function(data){
            if(url!='')
                window.location=url;
        });
        $('#all_questions').show();
        $('#playlist_questions').hide();
        $('#sign').html(' + ');
        $('#sign1').html(' - ');
    }

    function show_bio(){
        $('#bio_detail').show();
        $('#bio_less').hide();
    }

    function hide_bio(){
        $('#bio_detail').hide();
        $('#bio_less').show();
    }

</script>

<script type="text/javascript">
    function getfocus(){
        document.getElementById('profile_comment').focus()
    }

</script>
<script>
     function addClick(obj,id,type,profile)
    { //alert(profile);return false;        
        j.post('<?=base_url()?>quiz/addClick', {id:id,type:type,profile:profile});//, function(data){alert(data);});
            //return true;
            //window.open('http://'+link,'_blank');

            //document.location.href = 'http://'+link;
            //document.location.target='blank';
            //return false;
            //alert(data);
        //});
    }

</script>
<script>
    function more(){
        j('#more').show();
        j('#show_more').hide();
        j('#show_less').show();
    }

    function less(){
        j('#more').hide();
        j('#show_more').show();
        j('#show_less').hide();
    }
</script>

<script type="text/javascript" src="<?=base_url()?>js/swfobject.js"></script>
<script>
    swfobject.embedSWF(
    "<?=base_url()?>js/open-flash-chart.swf", "my_chart", "650", "300",
    "9.0.0", "",
    {"data-file":"<?=base_url();?>quiz/quiz_stats/<?=$profile_id?>"}
);

</script>

<script>
    swfobject.embedSWF(
    "<?=base_url()?>js/open-flash-chart.swf", "my_chart1", "650", "300",
    "9.0.0", "",
    {"data-file":"<?=base_url();?>quiz/quiz_stats/<?=$profile_id?>/more1"}
);

</script>
<script>
    swfobject.embedSWF(
    "<?=base_url()?>js/open-flash-chart.swf", "my_chart2", "650", "300",
    "9.0.0", "",
    {"data-file":"<?=base_url();?>quiz/quiz_stats/<?=$profile_id?>/more2"}
);

</script>
<script type="text/javascript" src="<?=base_url()?>js/admin_js/help_tips.js"></script>

<!--
  jCarousel library
-->
<script type="text/javascript" src="<?php echo base_url();?>jcarousel_slider/lib/jquery.jcarousel.js"></script>
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>jcarousel_slider/skins/tango/skin.css" />

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            vertical:true,
            auto:1,

            scroll:5,
            wrap:'both'
        }

    );
    });

</script>

<!--<script type="text/javascript" src="<?=base_url()?>js/jquery.cycle.all.min.js"></script>
<style type="text/css">
    .slideshow1 { height: 200px; width: 200px; margin: auto }
    .slideshow1 img { padding: 10px; border: 1px solid #ccc; background-color: #eee; }
</style>
  initialize the slideshow when the DOM is ready 
<script type="text/javascript">
    $(document).ready(function() {
        $('.slideshow1').cycle({
            fx: 'scrollLeft', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
            activePagerClass: 'activeSlide',
            continuous: 0,
            random: 0,
            autostop:0,
            autostopCount:0

        });
    });
</script>-->

<?php $this->session->set_userdata('member_id',$profile_id);?>
<?php //print_r($mem_profile);?>

<div id="body_wrap">
    <div class="bodywrapInner">
        <?php $this->load->view('include/advance_search_box.php'); ?>
       	<div class="advertprofile_left advertprofile_left_adj300">
            <div class="advertprofile_leftInner">
                <div class="content_wrap content_wrap_adj300">
                    <div class="advertiseleft_topborder">
                        <div class="title_align">
                            <div class="greentitlebg_leftborder"></div>
                            <div class="greentitlebg_bg" style="width:265px;">
                                <div class="bold font14 color_white">Member panel</div>
                            </div>
                            <div class="greentitlebg_rightborder"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="advertiseleft_bg advertiseleft_bg_adj300">
                        <div class="whiteboxrightside_bgInner">
                            <div class="content_10box">
                                <div class="profile_img" style="width:100px">
                                    <div class="border1_green">
                                        
                                        <? if($mem_profile->profile_picture!="") {?>
                                       <? if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                              <img src="<?=$mem_profile->profile_picture?>" /> <? } else {?>                                       
                                           <img src="<?=base_url()?>user_profile_images/<?=$mem_profile->profile_picture?>" alt="<?=$mem_profile->username?>" /> 
                                        <? }} else {?>
                                           <img src="<?=base_url()?>images/avatar_img.jpg" height="75" width="100" alt="Member" /><? }?>
                         
                                    </div>
                                </div>
                                <div class="profile_desc">
                                    <div class="profile_descInner">
                                        <div class="bold">
                                            <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>
                                        </div>
                                        <?php if($profile_id != $this->session->userdata('wannaquiz_user_id')) {?>
                                        <div class="input_clear">
                                            <div class="searchbtn_leftborder"></div>

                                            <div class="searchbtn_bg" id="subscribe">
                                                    <?php
                                                    // echo $subscriber;
                                                    if($subscriber == "unsubscribed") {?>
                                                <a href="javascript:void(0)" style="padding:0 5px; display:block" id="subscribe_friend" onclick="subscribe_unsubscribe(1)">Favorite</a>
                                                <a href="javascript:void(0)" style="padding:0 5px; display:none" id="unsubscribe_friend" onclick="subscribe_unsubscribe(0)">Non Favorite</a>
                                                    <? } else { ?>
                                                <a href="javascript:void(0)" style="padding:0 5px; display:block" id="unsubscribe_friend" onclick="subscribe_unsubscribe(0)">Non Favorite</a>
                                                <a href="javascript:void(0)" style="padding:0 5px; display:none" id="subscribe_friend" onclick="subscribe_unsubscribe(1)">Favorite</a>
                                                    <? }?>
                                            </div>

                                            <div class="searchbtn_rightborder"></div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="font11">
                                            <div>
                                                <a href="javascript:void(0)" id="add_friend">Add as friend </a> | <!--<a href="javascript:void()" id="block_user">Block User</a>-->
                                                <a href="javascript:void(0)" id="send_message">Send message</a>
                                            </div>
                                            <!--<div>
                                                <a href="javascript:void(0)" id="send_message">Send message</a>
                                            </div>-->
                                        </div>
                                        <? }?>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>
                            <div class="borderbottom_dotted"></div>

                            <div class="content_10box">
                                <div class="bold">Profile</div>
                                <div class="padding_5topbottom">
                                    <div class="profile_img">
                                    	Name
                                    </div>

                                    <div class="profile_desc">
                                        <div class="bold text_right"><?=ucfirst($mem_profile->first_name).' '.ucfirst($mem_profile->last_name)?></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                    <div class="profile_img">
                                    	Joined
                                    </div>

                                    <div class="profile_desc">
                                        <div class="bold text_right"><?=date('F jS , Y',$mem_info->joined_date)?></div>
                                    </div>


                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                    <div class="profile_img">
                                    	Fans
                                    </div>

                                    <div class="profile_desc">
                                        <div class="bold text_right"><?=count($follower_info)?></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                    <div class="profile_img">
                                    	Favorites
                                    </div>

                                    <div class="profile_desc">
                                        <div class="bold text_right"><?=count($subscriber_info)?></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                    <div class="profile_img">
                                    	Website
                                    </div>

                                    <div class="profile_desc">
                                        <div class="bold text_right" >
                                            <?php if($mem_profile->website!=''){?>
                                            <a href="http://<?=$mem_profile->website;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="blank">
                                                <?php if(strlen($mem_profile->website)>21) echo substr($mem_profile->website,0,21).'...'; else echo $mem_profile->website;?>
                                            </a>
                                            <?php } else {?>
                                            <a href="http://<?=$company_detail->company_website;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="blank">
                                                <?php if(strlen($company_detail->company_website)>21) echo substr($company_detail->company_website,0,21).'...'; else echo $company_detail->company_website;?>
                                            </a>
                                            <?php } ?>
                                             <p><a href="http://<?=$mem_profile->other_website1;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="blank">
                                                    <?php if(strlen($mem_profile->other_website1)>21) echo substr($mem_profile->other_website1,0,21).'...'; else echo $mem_profile->other_website1;?>
                                                </a></p>
                                            <p><a href="http://<?=$mem_profile->other_website2;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="blank">
                                                    <?php if(strlen($mem_profile->other_website2)>21) echo substr($mem_profile->other_website2,0,21).'...'; else echo $mem_profile->other_website2;?>
                                                </a></p>
                                                <p><a href="http://<?=$mem_profile->other_website3;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="blank">
                                                    <?php if(strlen($mem_profile->other_website3)>21) echo substr($mem_profile->other_website3,0,21).'...'; else echo $mem_profile->other_website3;?>
                                                </a></p>
                                        </div>
                                    </div>
                               <div class="profile_desc">
                                        <div class="bold text_right">
                                           
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <?php if($mem_info->user_type==0) {?>
                                <div class="borderbottom_gray"></div>
                                 
                                <div class="padding_5topbottom">
                                  
                                    <p style="font-weight:bold; color:#008000; padding:10px 0 10px 0">Bio:</p>
                                    <div id="bio_less">
                                        <?php if(strlen($mem_profile->profile_description)>300) {
                                            echo substr(trim($mem_profile->profile_description),0,300).'... <label onclick="show_bio()" style="color:#0066CC; cursor:pointer">more</label>';
                                        }
                                        else echo $mem_profile->profile_description;
                                    ?>
                                    </div>
                                    
                                    <div style="display:none" id="bio_detail"><?php echo $mem_profile->profile_description;?> <lable onclick="hide_bio()" style="color:#0066CC; cursor:pointer">less</label></div>
                                </div>
                             <?php }
                               ?>
                                <div class="borderbottom_gray"></div>
                           
                                <?php if($partner_info && $mem_info->user_type==0) {?>
                                <div class="padding_10topbottom">
                                    <div class="bold"><?=$mem_info->username?> is:</div>
                                    <div class="padding_10top">
                                        <img src="<?=base_url()?>images/sponsor_img.jpg" width="111" height="15" alt="sponsor img" /> <span class="bold color_green">Partner</span>
                                    </div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <?}?>

                                <div class="padding_10topbottom">
                                    <div class="bold">Favorites (<?=count($subscriber_info)?>)</div>
                                    <div class="padding_10topbottom">
                                        <?php
                                        //echo '<pre>'; print_r($subscriber_info); echo '</pre>';                                        
                                        if(count($subscriber_info)>0) {
                                            foreach($subscriber_info as $subs_info) {
                                                ?>
                                        <div class="addsubscriber">
                                            <div class="addsubscriberInner">
                                                <div class="text_center">
                                                    <div class="border1_green"><a href="<?=base_url()?><?=$subs_info->username?>">
                                                            <?if($subs_info->profile_picture){?>
                                                             <?  if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                              <img src="<?=$follower->profile_picture?>" /> <? } else {?>  
                                                            <img src="<?=base_url().FRIENDS.'/'.$subs_info->profile_picture?>" width="58" height="58" alt="subscriber" />
                                                        <?php }} else {?>
                                                             <img src="<?=base_url()?>images/avatar_img.jpg" alt="Member" width="58px" height="58px" /> <?php }?></a>
                                                        </div>
                                                    <div class="padding_5top"><a href="<?=base_url()?><?=$subs_info->username?>"><?=$subs_info->username;?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                            <? } } else echo "No favorites yet!";?>


                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><?php if(count($subscriber_info)>0) {?><a href="#" onclick="see_all_subscribings()">See all</a><? } ?></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                    <div class="bold">Fans (<?=count($follower_info)?>)</div>
                                    <div class="padding_10topbottom">
                                        <?php
                                        //echo '<pre>'; print_r($follower_info); echo '</pre>';
                                        if(count($follower_info)>0) { //print_r($follower_info);
                                            foreach($follower_info as $follower) {
                                                ?>
                                        <div class="addsubscriber">
                                            <div class="addsubscriberInner">
                                                <div class="text_center">
                                                    <div class="border1_green">
                                                      
                                                         <a href="<?=base_url()?><?=$follower->username?>">
                                                               <?if($follower->profile_picture){?>
                                                            <?  if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                              <img src="<?=$follower->profile_picture?>" /> <? } else {?>  
                                                             <img src="<?=base_url().FRIENDS.'/'.$follower->profile_picture?>" alt="subscriber" />
                                                            <?php }} else {?> 
                                                        <img src="<?=base_url()?>images/avatar_img.jpg" alt="Member" width="58px" height="58px" /> <?php }?></a>
                                                          </div>
                                                    <div class="padding_5top"><a href="<?=base_url()?><?=$follower->username?>"><?=$follower->username;?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                            <? } } else echo "You have no fans yet!";?>


                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><?php if(count($follower_info)>0) {?> <a href="#" onclick="see_all_subscribers()"  >See all</a><? } ?></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                    <div class="bold">Friends (<?=count($mem_friends)?>)</div>
                                    <div class="padding_10topbottom">
                                        <?
                                        if(count($mem_friends)>0) {
                                            foreach($mem_friends as $friends) {?>

                                        <div class="addsubscriber">
                                            <div class="addsubscriberInner">
                                                <div class="text_center">
                                                    <div class="border1_green">
                                                          <a href="<?=site_url($friends->username)?>">
                                                               <?if($friends->profile_picture){?>
                                                            <?  if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                              <img src="<?=$friends->profile_picture?>" /> <? } else {?>  
                                                             <img src="<?=base_url().FRIENDS.'/'.$friends->profile_picture?>" alt="<?=$friends->username?>" />
                                                            <?php }} else {?> 
                                                    <img src="<?=base_url()?>images/avatar_img.jpg" alt="Member" width="58px" height="58px" /> <?php }?>
                                                          </a></div>
                                                    <div class="padding_5top"><a href="<?=site_url($friends->username)?>"><?=$friends->username?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                            <? }
                                        }?>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><a href="#" <?php if(count($mem_friends)>0) {?> onclick="see_all_friends()" <? } ?> >See all</a></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="advertiseleft_bottomborder"></div>
                </div>



            </div>
       	</div>
        <div class="advertprofile_right advertprofile_right_adj300">
            <div class="content_wrap">
                <div class="advertprofile_mid">
                    <?php if($mem_info->user_type!=0) {?>
                    <div class="advertprofile_mid">
                        <div>
                            <div class="advertisemid_topborder">
                                <div class="title_align">
                                    <div class="bluetitlebg_leftborder"></div>
                                    <div class="bluetitlebg_bg" style="width:390px;">
                                        <div class="bold font14 color_white">Company Information</div>
                                    </div>
                                    <div class="bluetitlebg_rightborder"></div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="advertisemid_bg">
                                <div class="content_10box">
                                    <div class="desc" style="padding:10px">
                                            <?=$company_detail->company_info;?>
                                    </div>

                                    <div class="padding_10topbottom">
                                        <div class="bluebtn_leftborder"></div>
                                        <div class="bluebtn_bg">
                                            <?php if($mem_profile->website!='')
                                            $website = $mem_profile->website;
                                            else
                                            $website = $company_detail->company_website;
                                            ?>
                                            <a href="http://<?=$website;?>" onclick="setProfileViewClick(<?=$profile_id?>)" target="_blank">Visit <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>’s Website</a>
                                        </div>
                                        <div class="bluebtn_rightborder"></div>

                                        <div class="clear"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="advertisemid_bottomborder"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?} ?>

                    <div>
                        <div class="advertisemid_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:390px;">
                                    <div class="bold font14 color_white">Public Profile</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>

                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="advertisemid_bg">
                            <div class="content_10box">
                                <div style="margin:0 auto; width:410px;">
                                    <div class="bold"><span class="fon16">More From: </span> <span class="color_lightblue">
                                        <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>
                                        </span></div><br>
                                    <div><span id="sign1"> - </span><a href="javascript:void(0)" onclick="show_all_questions('')">All Questions</a></div>
                                    <div style="display:<?=$show?>" id="all_questions">
                                        <div class="padding_10topbottom">
                                            <div id="firstpane" class="menu_list">

                                                <?php
                                                $counter = 0;
                                                $flag = 0;
                                                $a = count($category);

                                                $array_id =  array();

                                                for($i=0;$i<$a;$i++) {

                                                    if(!empty($category[$i]) && $flag==0) $flag = '1';
                                                    $subcategory = $this->Category_model->get_sub_categories($category[$i]->id);

                                                    if(count($subcategory)>0) {
                                                        $sub_category1 = array();

                                                        foreach($subcategory as $subcategories) {
                                                            $sub_category1[] = $subcategories->id;

                                                        }

                                                        $sub_category = implode(",",$sub_category1);

                                                        $tmp_val = $sub_category.','.$category[$i]->id;
                                                    }

                                                    else
                                                        $tmp_val = $category[$i]->id;
                                                    $array_id[] = $tmp_val;

                                                }
                                                if(count($array_id)>3) $limit = 3; else $limit = count($array_id);
                                                for($j=0;$j<$limit; $j++) {
                                                    $quiz = $this->Quiz_model->get_quiz_by_user_category($profile_id,$array_id[$j],$filter);

                                                    if(count($quiz)>0) $counter++;
                                                    if(count($quiz)>0) {
                                                    //
                                                        ?>

                                                <h2 class="menu_head"><span><?=$category[$j]->name?></span></h2>

                                                <div class="menu_body" <?php if($flag == 1) { ?>style="display:block"<? } $flag = 2;?>>

                                                    <div>
                                                                <?php


                                                                foreach($quiz as $quizes) {
                                                                    ?>

                                                        <div class="content_10box">
                                                            <div class="padding_10top">
                                                                <div class="featuredquest_left">
                                                                                <?php if($quizes->quiz_type =='photo') {?>
                                                                    <div class="border_green">
                                                                        <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">

                                                                                            <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                                            #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                                            else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$quizes->images;
                                                                                            if(file_exists($photo_path)) {
                                                                                                ?>
                                                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />
                                                                                            <? } else {?>
                                                                            <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                            <? } ?>
                                                                    <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />-->
                                                                        </a>
                                                                    </div>
                                                                                <? } else {
                                                                                    $vd=explode('.',$quizes->images); ?>





                                                                    <div class="border_green">
                                                                        <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">
                                                                                            <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                            else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                            ?>

                                                                                            <?php if(file_exists($a)) { ?>
                                                                            <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                                            <? } else {?>
                                                                            <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                            <? } ?>
                                                                                                            <!--<img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">-->
                                                                        </a>
                                                                    </div>
                                                                                <? }?>
                                                                </div>

                                                                <div class="accordionhistory_right">
                                                                    <div class="color_blue">
                                                                        <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">
                                                                                        <?=$quizes->quiz_question?>
                                                                        </a>
                                                                    </div>
                                                                    <div class="font11">
                                                            	Views: <?php echo $this->Quiz_model->get_quiz_views($quizes->quiz_id)?>
                                                                    </div>
                                                                </div>

                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <div class="borderbottom_dotted"></div>

                                                                <? } ?>

                                                    </div>
                                                </div>
                                                    <?

                                                    }

                                                }?>
                                                
                                                <?php if($counter>3) $display = 'block'; else $disply='none';?>
                                                <div style="display:none" id="more">
                                                    <?php for($k=3;$k<count($array_id);$k++) {
                                                        $quiz = $this->Quiz_model->get_quiz_by_user_category($profile_id,$array_id[$k],$filter);

                                                        if(count($quiz)>0) $counter++;
                                                        if(count($quiz)>0) {
                                                            ?>

                                                    <h2 class="menu_head"><span><?=$category[$k]->name?></span></h2>

                                                    <div class="menu_body" <?php if($flag == 1) { ?>style="display:block"<? } $flag = 2;?>>

                                                        <div>
                                                                    <?php


                                                                    foreach($quiz as $quizes) {
                                                                        ?>

                                                            <div class="content_10box">
                                                                <div class="padding_10top">
                                                                    <div class="featuredquest_left">
                                                                                    <?php if($quizes->quiz_type =='photo') {?>
                                                                        <div class="border_green">
                                                                            <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">

                                                                                                <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                    $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                                                #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$quizes->images;
                                                                                                else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$quizes->images;
                                                                                                if(file_exists($photo_path)) {
                                                                                                    ?>
                                                                                <img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />
                                                                                                <? } else {?>
                                                                                <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                                <? } ?>
                                                                        <!--<img src="<?=base_url()?>photo_question_thumbs/<?=$quizes->images?>" alt="feature quest img" />-->
                                                                            </a>
                                                                        </div>
                                                                                    <? } else {
                                                                                        $vd=explode('.',$quizes->images); ?>





                                                                        <div class="border_green">
                                                                            <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">
                                                                                                <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                    $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                ?>

                                                                                                <?php if(file_exists($a)) { ?>
                                                                                <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                                                <? } else {?>
                                                                                <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                                <? } ?>
                                                                                                                <!--<img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">-->
                                                                            </a>
                                                                        </div>
                                                                                    <? }?>
                                                                    </div>

                                                                    <div class="accordionhistory_right">
                                                                        <div class="color_blue">
                                                                            <a href="javascript:void(0)"  onclick="show_all_questions('<?=site_url('quiz/views/'.$quizes->quiz_id)?>')">
                                                                                            <?=$quizes->quiz_question?>
                                                                            </a>
                                                                        </div>
                                                                        <div class="font11">
                                                            	Views: <?php echo $this->Quiz_model->get_quiz_views($quizes->quiz_id)?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                            <div class="borderbottom_dotted"></div>

                                                                    <? } ?>

                                                        </div>
                                                    </div>


                                                        <? }} ?>
                                                </div>

                                            </div>
                                            <?php if($counter>=3) { ?>
                                            <div class="text_center" id="show_more">
                                                <a style="cursor:pointer" onclick="more()">More </a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                            </div>
                                            <div class="text_center" id="show_less" style="display:none">
                                                <a style="cursor:pointer" onclick="less()">less</a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                            </div>
                                            <? }?>

                                        </div>
                                    </div>

                                    <div id="load_playlist">
                                        <div> <span id="sign"> + </span><a href="javascript:void(0)" onclick="show_playlist()">Playlist Questions</a></div>

                                        <div style="display:none" id="playlist_questions">
                                            <div class="padding_10topbottom">
                                                <div id="firstpane" class="menu_list">

                                                    <?php
                                                    $counter1 = 0;
                                                    $flag1 = 0;
                                                    $playlist_rows = 0;
                                                    $abs = 0;
                                                   // echo '<pre>';print_r($user_playlist);
                                                    //echo count($user_playlist);
                                                    if(count($user_playlist)>=10) $abs=10;
                                                    else $abs = count($user_playlist);
                                                    for($i=0;$i<$abs;$i++) { //echo $user_playlist[$i]->playlist_title;//exit;
                                                        if(!empty($user_playlist[$i]) && $flag1==0) $flag1 = '1';
                                                        //print_r($category[2]->id);
                                                         $playlist_quiz = $this->Quiz_model->get_quizes_from_playlist($profile_id,$user_playlist[$i]->playlist_id,$filter,0,0);
                                                      //  print_r($playlist_quiz);
                                                       // if(count($playlist_quiz)>0)

                                                           // $playlist_quiz = $this->Quiz_model->get_quizes_from_playlist($profile_id,$user_playlist[$i]->playlist_id,0,0);

                                                        if(count($playlist_quiz)>0) { $counter1++;

                                                            ?>

                                                    <h2 class="menu_head"><span><?=$user_playlist[$i]->playlist_title?></span></h2>

                                                    <div class="menu_body" <?php if($flag1 == 1) { ?>style="display:block"<? } $flag1 = 2;?>>

                                                        <div>
                                                                    <?php


                                                                    foreach($playlist_quiz as $playlistquizes) {
                                                                        ?>

                                                            <div class="content_10box">
                                                                <div class="padding_10top">
                                                                    <div class="featuredquest_left">
                                                                                    <?php if($playlistquizes->quiz_type =='photo') {?>
                                                                        <div class="border_green">
                                                                            <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">
                                                                                                <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                    $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$playlistquizes->images;
                                                                                                #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$playlistquizes->images;
                                                                                                else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$playlistquizes->images;
                                                                                                if(file_exists($photo_path)) {
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
                                                                            <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">
                                                                                                <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                    $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                ?>

                                                                                                <?php if(file_exists($a)) { ?>
                                                                                <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                                                <? } else {?>
                                                                                <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                                <? } ?>
                                                                                                                    <!--<img height="71" width="94" src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">-->
                                                                            </a>
                                                                        </div>
                                                                                    <? }?>
                                                                    </div>

                                                                    <div class="accordionhistory_right">
                                                                        <div class="color_blue">
                                                                            <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">
                                                                                            <?=$playlistquizes->quiz_question?>
                                                                            </a>
                                                                        </div>
                                                                        <div class="font11">
                                                                            Views: <?php echo $this->Quiz_model->get_quiz_views($playlistquizes->quiz_id)?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                            <div class="borderbottom_dotted"></div>

                                                                    <? } ?>

                                                        </div>
                                                    </div>
                                                        <? }

                                                        if($display1=='') $display='block'; else $display='none';?>
                                                    <? } ?>
                                                    <div id="more" style="display:none">
                                                        <?php for($i=10;$i<count($user_playlist);$i++) {
                                                            $playlist_quiz1 = $this->Quiz_model->get_quizes_from_playlist($profile_id,$user_playlist[$i]->id,$filter,0,0);
                                                            if(count($playlist_quiz)>0) {
                                                                ?>
                                                        <h2 class="menu_head" style="display:<?=$display?>"><span><?=$playlist_quiz1[$i]->playlist_title?></span></h2>

                                                        <div class="menu_body" style="display:<?=$display?>">

                                                            <div>
                                                                        <?php
                                                                        foreach($playlist_quiz1 as $playlistquizes1) {
                                                                            ?>
                                                                <div class="content_10box">
                                                                    <div class="padding_10top">
                                                                        <div class="featuredquest_left">
                                                                                        <?php if($playlistquizes1->quiz_type =='photo') {?>
                                                                            <div class="border_green">
                                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">

                                                                                                    <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                        $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$playlistquizes1->images;
                                                                                                    #else $photo_path = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/photo_question_thumbs/".$playlistquizes1->images;
                                                                                                    else $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$playlistquizes1->images;
                                                                                                    if(file_exists($photo_path)) {
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
                                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">
                                                                                                    <? if($_SERVER['SERVER_NAME']=='localhost')
                                                                                                        $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                    #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                    else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                                                                    ?>

                                                                                                    <?php if(file_exists($a)) { ?>
                                                                                    <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                                                                                    <? } else {?>
                                                                                    <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                                                                    <? } ?>
                                                                                                                            <!--<img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">-->
                                                                                </a>
                                                                            </div>
                                                                                        <? }?>
                                                                        </div>

                                                                        <div class="accordionhistory_right">
                                                                            <div class="color_blue">
                                                                                <a href="javascript:void(0)" onclick="playlist_question_click('<?=$playlistquizes->quiz_id?>','<?=$profile_id?>','<?=$playlistquizes->playlist_id?>','<?=site_url('quiz/view/'.$playlistquizes->quiz_id)?>')">
                                                                                                <?=$quizes->quiz_question?>
                                                                                </a>
                                                                            </div>
                                                                            <div class="font11">
                                                                                Views: <?php echo $this->Quiz_model->get_quiz_views($playlistquizes1->quiz_id)?>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="borderbottom_dotted"></div>
                                                                        <? }//}
                                                                        //if(count($quiz)<1) echo "There is no quizes in this category!";?>


                                                            </div>
                                                        </div>
                                                            <? } }?>
                                                    </div>
                                                </div>
                                                <?php if($counter1>=5) { ?>
                                                <div class="text_center" id="show_more">
                                                    <a style="cursor:pointer" onclick="more()">More </a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                                </div>
                                                <div class="text_center" id="show_less" style="display:none">
                                                    <a style="cursor:pointer" onclick="less()">less</a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
                                                </div>
                                                <? }?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="advertisemid_bottomborder"></div>
                    </div>
                </div>
                <div class="rightside">
                    <div class="rightsideInner">
                        <div class="content_wrap">
                            
                            <?php if($mem_info->user_type!=0) {
                           // print_r($banner_ads_info);
                                if(count($banner_ads_info)>0) {
                                    $this->Quiz_model->insert_ads_view_click_log($banner_ads_info[0]->banner_id,'banner',$mem_info->user_id);
                                    ?>
                                 <div class="content_wrap">
                                  <div class="quizright_topborder"></div>
                                   <div class="quizright_bg">
                                   <div class="whiteboxrightside_bgInner">
                                        <div style="padding:10px; color:#000080; font-weight:bold; font-family:serif; text-align:center">Offer from page owner: </div>
                                        <!--<div class="slideshow1">-->
                                                <?php
                                                //print_r($banner_ads_info);
                                                //foreach($banner_ads_info as $banner_ads) {
                                                if($this->session->userdata('adv_flag') =='2') {
                                                    $this->session->set_userdata('adv_flag','1');
                                                    ?>
                                        <div class="content_10box">
                                            <div class="text_center">
                                                    <!--<img src="< ?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                                <div style="font-size:smaller; color:green;">

                                                    <a  href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" target="_blank" onclick="addClick(this,<?=$banner_ads_info[0]->banner_id?>,'banner','<?=$mem_info->user_id?>');">
                                                                    <?php $image='advertiser_banners/'.$banner_ads_info[0]->banner_image;
                                                                    if (file_exists($image)) {
                                                                        list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                                        //echo $imageWidth.'/'.$imageHeight;
                                                                        if($imageWidth<'160') {
                                                                            $imagew = $imageWidth;
                                                                            $imageh = $imageHeight;
                                                                        }
                                                                        else {
                                                                            $imagew = '160';
                                                                            $imageh='';
                                                                        }
                                                                    }
                                                                    ?>
                                                        <img src="<?=base_url()?>advertiser_banners/<?=$banner_ads_info[0]->banner_image?>"  alt="banner image" />
                                             
                                                       
                                                    </a>

                                                  </div>
                                             </div>
                                        </div>
                                                <!--
                                                <div style="color:blue">
                                                    <b><a href="http://<?=$banner_ads_info[0]->url?>" target="_blank" style="cursor:pointer" onclick="addClick(this,<?=$banner_ads_info[0]->banner_id?>,'banner','<?=$mem_info->user_id?>')">
                                                                        <?php if(strlen($banner_ads_info[0]->url)>21)
                                                                            echo substr($banner_ads_info[0]->url,0,21).'...';
                                                                        else echo $banner_ads_info[0]->url;?>

                                                        </a></b>
                                                </div>
                                            </div>
                                        </div>

                                                <? } else {
                                                    $this->session->set_userdata('adv_flag', '2');
                                                    ?>


                                        <div style="width:234px; margin:0 auto;" align="center">
                                                        <?php //foreach($text_ads_info as $text_ads){
                                                        if(count($text_ads_info)>0) {
                                                            if(count($text_ads_info)>=5) $limit = 5; else $limit = count($text_ads_info);
                                                            //echo $limit;
                                                            for($i=0;$i<$limit;$i++) {
                                                            $this->Quiz_model->insert_ads_view_click_log($text_ads_info[$i]->id,'long_text',$mem_info->user_id);
                                                                ?>

                                            <div class="content_10box">
                                                <div class="text_center">
                                                        <!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                                    <div style="color:blue"><b><u><a href="http://<?=$text_ads_info[$i]->link_url?>" style="cursor:pointer" target="_blank" onclick="addClick(this,<?=$text_ads_info[$i]->id?>,'long_text','<?=$mem_info->user_id?>')"><?=$text_ads_info[$i]->link_title?></a></u></b></div>
                                                    <div><?=$text_ads_info[$i]->link_description?></div>
                                                    <div style="font-size:smaller; color:green;">
                                                        <a href="http://<?=$text_ads_info[$i]->link_url?>" style="cursor:pointer" target="_blank" onclick="addClick(this,<?=$text_ads_info[$i]->id?>,'long_text','<?=$mem_info->user_id?>')">
                                                                                <?php if(strlen($text_ads_info[$i]->link_url)>21)
                                                                                    echo substr($text_ads_info[$i]->link_url,0,21).'...';
                                                                                else echo $text_ads_info[$i]->link_url;?>

                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                                                <?
                                                                if(count($text_ads_info)>5)
                                                                    $this->Quiz_model->insert_rotated_text_ads($text_ads_info[$i]->id,0);
                                                                    

                                                            }//exit;
                                                            if(count($text_ads_info)<=5) {
                                                                foreach($all_text_ads_info as $all_ads) {
                                                                //echo $all_ads->id.'hello';
                                                                    $this->Quiz_model->reset_rotated_text_ads($all_ads->id,0);
                                                                    $this->Quiz_model->insert_ads_view_click_log($all_ads->id,'long_text', $mem_info->user_id);
                                                                }
                                                            }

                                                        }?>
                                        </div>
                                                <? }?>

                                        <!--</div>-->

                                    </div>
                                </div>
                                      <div class="quizright_bottomborder"></div>
                                 </div>
                           
                                <? } else { ?>

                                    <?php
                                    // print_r($text_ads_info);
                                    if(count($text_ads_info)>0) {?>

                            <div class="content_wrap">
                                <div class="quizright_topborder whiteboxrightside_topborder1"></div>
                                <div class="quizright_bg whiteboxrightside_bg">
                                    <div class="whiteboxrightside_bgInner right_slider">
                                        <div style="padding:15px; color:#000080; font-weight:bold; text-align:center">Offer from page owner:</div>

                                                    <?php
                                                    //print_r($text_ads_info);
                                                    // foreach($text_ads_info as $ads_info) {
                                                    for($i=0;$i<5;$i++) {
                                                        $this->Quiz_model->insert_ads_view_click_log($text_ads_info[$i]->id,'long_text',$mem_info->user_id);
                                                        ?>

                                        <div class="content_10box">
                                            <div class="text_center">
                                                    <!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                                <div style="color:blue"><b><u><a href="http://<?=$text_ads_info[$i]->link_url?>" style="cursor:pointer" onclick="addClick(this,<?=$text_ads_info[$i]->id?>,'long_text','<?=$mem_info->user_id?>')"><?=$text_ads_info[$i]->link_title?></a></u></b></div>
                                                <div><?=$text_ads_info[$i]->link_description?></div>
                                                <div style="font-size:smaller; color:green;">
                                                    <a href="http://<?=$text_ads_info[$i]->link_url?>" style="cursor:pointer" onclick="addClick(this,<?=$text_ads_info[$i]->id?>,'long_text','<?=$mem_info->user_id?>')">
                                                                        <?php if(strlen($text_ads_info[$i]->link_url)>21)
                                                                            echo substr($text_ads_info[$i]->link_url,0,21).'...';
                                                                        else echo $text_ads_info[$i]->link_url;?>

                                                    </a>
                                                </div>

                                            </div>
                                        </div>



                                                    <? } //else {?>
                                        <!--<div class="content_10box">
                            	<div class="text_center">
                                                <div style="font-size:larger">Text Advertisment Here!</div>
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                                <div class="quizright_bottomborder whiteboxrightside_bottomborder"></div>
                            </div>
                                    <? }} } else {
                                        ?>
                            
                            <div class="whiteboxrightside_topborder1">
                                <!--<div class="title_align">
                                    <div class="font14 bold">Our Offer</div>
                                </div>-->
                            </div>
                            <div class="whiteboxrightside_bg">
                                <div class="whiteboxrightside_bgInner">
                                    <div class="padding_5top">
                                        <div class="borderbottom_dotted"></div>
                                    </div>
                                    <div class="content_10box">
                                <div class="content_wrap" align="center">

                                        <?php
                                        //echo '<pre>';print_r($admin_ads);exit;
                           if($this->session->userdata('adsense_status')=='')
                            $this->session->set_userdata('adsense_status','user');
                         $user_id = $mem_info->user_id;
                        
                        $check = $this->Member_model->check_user_partner($user_id);
                         if($check->active=='1'){
                         $partner_info = $this->Member_model->get_user_partner_info($user_id); 
                        // print_r($partner_info);
                                 ?>
                        
                            <?php if($this->session->userdata('adsense_status')=='user'){?>
                                                           
                          
                            	
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://google.com " target="_blank">
                                                <?php
                                                  echo  $partner_info->user_rectangular_code;
                                                  
//                                                $image='useruploads/images/'.$partner_info->user_rectangular_code;
//                                                $image = trim($image);
//                                                if (file_exists($image)) {
//                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
//                                                //echo $imageWidth.'/'.$imageHeight;
//                                                if($imageWidth<'300'){
//                                                        $imagew = $imageWidth;
//                                                        if($imageHeight<'250') $imageh = $imageHeight;
//                                                        else $imageh = '250';
//                                                    }
//                                                    else{
//                                                        $imagew = '300';
//                                                        if($imageHeight<'250') $imageh = $imageHeight;
//                                                        else $imageh = '250';
//                                                    }
//                                                }
                                                 //echo $imagew;
                                                ?>

                                                <?php //print_r(getimagesize($image)); ?>
                                                <?php //http://localhost/wannaquiz/resizer.php?src=advertiser_banners/forum1.jpg&h=600&w=160&zc=0 ?>
                                                
<!--                                             <img src="<?php// echo base_url() . 'resizer.php?src='.$image.'&amp;h='.$imageh.'&amp;w='.$imagew.'&amp;zc=0'; ?>"  alt="banner" />-->
                                                <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                     
                              <?//partner add end ?>
                           
                          <?php $this->session->set_userdata('adsense_status','admin');
                           
                            //admin adsense
                            } else {
                              // print_r($admin_ads);
                                if(count($admin_ads)>0) {
                            if($admin_ads[0]->adv_type!='adsense'){
                                if($admin_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                else $image_width = '300';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                           
                            	
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://<?=$admin_ads[0]->link_url?> " target="_blank">
                                                <?php
                                              //  echo $admin_ads[0]->adv_banner;
                                                $image='advertisement_banners/'.$admin_ads[0]->adv_banner;
                                                if (file_exists($image)) {
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                //echo $imageWidth.'/'.$imageHeight;
                                                if($imageWidth<$image_width){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<'250') $imageh = $imageHeight;
                                                        else $imageh = '250';
                                                    }
                                                    else{
                                                        $imagew = $image_width;
                                                        if($imageHeight<'250') $imageh = $imageHeight;
                                                        else $imageh = '250';
                                                    }
                                                }
                                               // else echo "hereeeee";
                                                ?>

                                                <?php //print_r(getimagesize($image)); ?>
                                                <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />
                                                <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                        <div style="color:blue">
                                            <b><u><a style="cursor:pointer" >
                                                     <?php if(strlen($admin_ads[0]->link_url)>21)
                                                        echo substr($admin_ads[0]->link_url,0,21).'...';
                                                        else echo $admin_ads[0]->link_url;
                                                        ?>
                                                  </a></u></b>
                                        </div>

                               
                           
                                    <? } else {?>
                                       <?php echo $admin_ads[0]->adv_detail;?>
                                      <?}}?>

                            <?php $this->session->set_userdata('adsense_status','user');
                            }?>
                        
                        <?php }
                        else {
                            // print_r($admin_ads);
                                if(count($admin_ads)>0) {
                            if($admin_ads[0]->adv_type!='adsense'){
                                if($admin_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                else $image_width = '300';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                           
                            	
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://<?=$admin_ads[0]->link_url?> " target="_blank">
                                                <?php
                                                     echo $admin_ads[0]->adv_banner;   
                                                $image='advertisement_banners/'.$admin_ads[0]->adv_banner;
                                                if (file_exists($image)) {
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                //echo $imageWidth.'/'.$imageHeight;
                                                if($imageWidth<$image_width){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<'250') $imageh = $imageHeight;
                                                        else $imageh = '250';
                                                    }
                                                    else{
                                                        $imagew = $image_width;
                                                        if($imageHeight<'250') $imageh = $imageHeight;
                                                        else $imageh = '250';
                                                    }
                                                }
                                               // else echo "hereeeee";
                                                ?>

                                                <?php //print_r(getimagesize($image)); ?>
                                                <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />
                                                <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                        <div style="color:blue">
                                            <b><u><a style="cursor:pointer" >
                                                     <?php if(strlen($admin_ads[0]->link_url)>21)
                                                        echo substr($admin_ads[0]->link_url,0,21).'...';
                                                        else echo $admin_ads[0]->link_url;
                                                        ?>
                                                  </a></u></b>
                                        </div>

                               
                           
                                    <? } else {?>
                                    <div >
                                         <?php echo $admin_ads[0]->adv_detail;?>
                                    </div>
                                    <?}}?>

                            <?php $this->session->set_userdata('adsense_status','user');
                            }?>
                       
                      
                                     
                                </div>
                                    <?//Level management ?>
                                            <?php //print_r($level_info); echo "//////////////"; print_r($previous_level_info);
                                            if($previous_level_info) { //echo "hiii";
                                                $max_points = $level_info->points - $previous_level_info->points;
                                                $current_points = $level_info->current_points - $previous_level_info->points;
                                            }
                                            else {
                                                $max_points = $level_info->points;
                                                $current_points = $level_info->current_points;
                                            }
                                            ?>
                                        <div class="content_wrap content_wrap_adj">
                                            <div class="bold">
                                                <div>My quiz info</div>
                                                <div class="padding_5topbottom font14" >Level <span style="color:#0066CC"><?php if($level_info) echo $level_info->level_id; else echo 1;?></span></div>
                                            </div>
                                                <? if($level_info) {

                                                    ?>

                                            <div style="background-color:#000066; width:200px; height:16px; padding:2px 2px 2px 2px; margin-bottom:2px;">
                                                <img src="<?=base_url()?>bar/test/0/<?=$max_points?>/<?=$current_points?>/0" />
                                            </div>
                                            <div class="font11"> You need <span style="color: rgb(0, 102, 204);"><?php echo ($level_info->points - $level_info->current_points +1)?></span> points to complete <span style="color: rgb(0, 102, 204);">level <?=$level_info->level_id?></span>.</div>
                                                <? } else {?>
                                            <div style="background-color:#000066; width:200px; height:16px; padding:2px 2px 2px 2px; margin-bottom:2px;">
                                                <img src="<?=base_url()?>bar/test/0/100/0/0" />
                                            </div>
                                            <div class="font11"> You need <span style="color: rgb(0, 102, 204);">99</span> points for complete <span style="color: rgb(0, 102, 204);">level 1</span>.</div>
                                                <? }?>

                                        </div>

                                        <div class="clear"></div><br>

                                        <div class="bold content_wrap_adj">
                                            <div class="borderbottom_gray"></div>
                                            <div class="padding_10topbottom">
                                                <div class="quizinfo_left">Wannaquiz Points:</div>
                                                <div class="quizinfo_right"><div class="color_green text_right"><?=$user_position->total_points;//$quiz_hard_points->q_points+$quiz_avg_points->q_points?></div> </div>

                                                <div class="clear"></div>
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                            <div class="padding_10topbottom">
                                                <div>
                                                    <div class="quizinfo_left">Overall Point Rank:</div>
                                                    <div class="quizinfo_right"><div class="color_darkbrown text_right"><?=$user_position->position?></div> </div>

                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Best category:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">
                                                        <?php
                                                            if(empty($best_category->name)) echo 'None';
                                                            else echo  $best_category->name;
                                                        ?>
                                                    </div> </div>

                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">                                                    
                                                    <div class="quizinfo_left">Best category points:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">
                                                        <?php
                                                            if(empty($best_category->total)) echo 0;
                                                            else echo $best_category->total;
                                                        ?>
                                                    </div> </div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                            <div class="borderbottom_gray"></div>

                                            <div class="padding_10topbottom">
                                                <div>
                                                    <div class="quizinfo_left">Last Played Game:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right"><?=$last_played_date?></div> </div>

                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Last Point (s) earned:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right"><?=$last_played_game_points?></div> </div>

                                                    <div class="clear"></div>
                                                </div>

                                            </div>
                                            <div class="borderbottom_gray"></div>

                                        </div>
                                        <div class="text_right content_wrap_adj" style="padding-top:10px;"><a href="<?php echo site_url('home/show/levels')?>">(help)</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="whiteboxrightside_bottomborder"></div>
                            <?} ?>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>

            <div class="content_wrap">
                <div class="advertiselong_topborder"></div>
                <div class="advertiselong_bg">
                    <div class="borderbottom_dotted"></div>
                    <?php if($mem_info->user_type==0) {?>
                    <div class="content_10box">

                        <div class="content_10box">
                            <div class="medal_icon"> <span class="bold color_blue">
                                    <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>'s</span> Awards: </div>
                            <div class="padding_10topbottom">
                                    <?php
                                    //                                if(count($levels)>0){
                                    //                                foreach($levels as $badges){
                                    //                                    if($badges->quiz_type=='average'){
                                    // print_r($member_awards);
                                    if(count($member_awards)>0) {
                                        foreach($member_awards as $awards) {
                                            if($awards->type!= '1') {
                                             ?>
                                <div class="awardbox">
                                    <div class="content_5box">
                                        <div class="awardbox_bg">
                                            <div class="awardbox_bgInner">
                                                                <?php $image=base64_encode('award_images/'.$awards->award_image);?>
                                                <a href="<?php echo site_url('home/show/awards')?>" onmouseover="fixedtooltip('test', this, event, '250px')" onmouseout="delayhidetip()" style="display:block; background:url(<?=site_url('pictures/sizeit/75/75/'.$image)?>) no-repeat 50% 50%; height:75px; width:75px;" ></a>
                                                
                                            </div>
                                        </div>
                                                        <?php if($awards->total>1) {
                                                             if($awards->award_link_name!='1000_milestone')
                                                               {
                                                            ?>
                                        <div style="text-align:center"><?=$awards->total?>X</div>
                                                        <? }} ?>
                                    </div>
                                </div>
                                            <? }}} else echo "There is no any badges!";?>


                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="content_10box">
                            <div class="medal_icon"> <span class="bold color_blue">
                                    <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>'s</span> Category Ranks:</div>
                            <div class="padding_10topbottom">
                                    <?php
                                    //echo '<pre>';print_r($member_awards);exit;                                    
                                    if(count($member_awards)>0) {
                                        
                                        foreach($member_awards as $awards) {
                                            if($awards->type== '1') {
                                               
                                                ?>
                                <div class="awardbox">
                                    <div class="content_5box">
                                        <div class="awardbox_bg">
                                            <div class="awardbox_bgInner">
                                                                <?php $image=base64_encode('award_images/'.$awards->award_image);?>
                                         
                                                <a href="<?php echo site_url('home/show/levels')?>" onmouseover="fixedtooltip('test', this, event, '250px')" onmouseout="delayhidetip()" style="display:block; background:url(<?=site_url('pictures/sizeit/75/75/'.$image)?>) no-repeat 50% 50%;  height:75px; width:75px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                            <? }}} else echo "There is no any badges!"; ?>

                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="content_10box">
                            <div class="bg_yellow">
                                <div class="content_10box">
                                    <div>
                                        <div class="quizinfo_left bold">Quizzes Played:</div>
                                        <div class="quizinfo_left">
                                            <div class="color_darkbrown">
                                                    <?=$total_answered?>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="padding_5top">
                                        <div class="quizinfo_left bold">Quizzes Correct: </div>
                                        <div class="quizinfo_left">
                                            <span class="color_darkbrown">
                                                    <?=$total_correct_answered?> / <?=$total_answered?>
                                            </span>
                                            (<?php if($total_answered!=0) echo round(($total_correct_answered/$total_answered)*100,2) .'%'; else echo "0 %";?>)
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_10box">
                            <div class="bold"><span class="color_blue">
                                    <?
                                                if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id'))
                                                    echo $this->session->userdata('first_name');
                                                else
                                                    echo $mem_info->username
                                            ?>'s</span> Quiz stats</div>
                            <div class="content_10box">
                                <div class="text_center">
                                    <div id="chart"><div id="my_chart" style="display:block"></div><span><a href="javascript:void(0)" onclick="more_categories()">More</a></span></div>
                                    <div id="chart1" style="display:none"><span><a href="javascript:void(0)" onclick="pre_categories()">Pre</a></span><div id="my_chart1"></div><span><a href="javascript:void(0)" onclick="more_categories1()">More</a></span></div>
                                    <div id="chart2" style="display:none"><span><a href="javascript:void(0)" onclick="pre_categories1()">Pre</a></span><div id="my_chart2"></div></div>

<!--<img src="<?=base_url()?>images/quiz_graph.jpg" width="638" height="351" alt="graph" />-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php } ?>

                    <div class="borderbottom_dotted"></div>
                    <div class="content_10box">
                        <div class="content_wrap">
                            <div class="bg_blue">
                                <div class="content_5box">
                                    <div class="comment_title">
                                        <div><img src="<?=base_url()?>images/down_arrow.jpg" width="18" height="11" alt="arrow" /> <span class="bold">Text reactions: (<?=$count_comments?>)</span></div>
                                    </div>
                                    <div class="comment_titleright">
                                        <div class="text_right"><a onclick="getfocus()">Add Text Reaction</a></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div id="comment">
                                <?php //print_r($profile_comments);
                                $user_id = $this->session->userdata('wannaquiz_user_id');
                                if(count($profile_comments)>0) {
                                    foreach($profile_comments as $profileComments) {
                                        $like_comment = $this->Member_model->get_profile_comment_like($profileComments->comment_id);
                                        $unlike_comment = $this->Member_model->get_profile_comment_unlike($profileComments->comment_id);
                                        ?>

                                <div class="padding_10topbottom" id="comment_<?=$profileComments->comment_id?>">
                                    <div>
                                        <div class="comment_name"><a href="#" class="bold"><?=$profileComments->username?></a> (<?=date("Y-m-d H:i:s",$profileComments->coment_date)?>)</div>
                                        <div class="comment_reply"><div class="text_center"><a style="cursor:pointer" onclick="toggle('reply_<?=$profileComments->comment_id?>')">Answer</a>  
                                              <?  if($this->session->userdata('wannaquiz_user_id')){?>
                                              |  <a href="#" onclick="memberCommentSpam('<?=$profileComments->comment_id?>','comment')">Spam</a>
                                                       <?}?>
                                                      <?php if($profileComments->user_id==$user_id || $profileComments->comentator_id == $user_id) {?> | <a href="#" onclick="deleteMemberComment('<?=$profileComments->comment_id?>','<?=$profileComments->username?>')">Delete</a><? } ?></div></div>
                                       
                                        <div class="comment_arrange">
                                            <div class="text_right">
                                                <span id="like_<?=$profileComments->comment_id?>"> <?=$like_comment?> Like </span> <span><a style="cursor:pointer" onclick="like_profile_comment('<?=$profileComments->comment_id?>',1)"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span> <span><a style="cursor:pointer" onclick="like_profile_comment('<?=$profileComments->comment_id?>',0)"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a> </span><span id="unlike_<?=$profileComments->comment_id?>"><?=$unlike_comment?> Unlike </span>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                    <div class="padding_10topbottom">
                                                <?=nl2br($profileComments->comment)?>
                                    </div>
                                </div>
                                <div id="reply_comment_<?=$profileComments->comment_id?>">
                                            <?php
                                            $comment_reply = $this->Member_model->get_reply_comments($profileComments->comment_id);
                                            //print_r($comment_reply);
                                            if(count($comment_reply)>0) {
                                                foreach($comment_reply as $reply) {

                                                    $like_comment = $this->Member_model->get_profile_comment_like($reply->comment_id);
                                                    $unlike_comment = $this->Member_model->get_profile_comment_unlike($reply->comment_id);
                                                    ?>

                                    <div class="borderbottom_gray"></div>
                                    <div class="borderleft_5gray">
                                        <div class="content_10box">
                                            <div>
                                                <div class="comment_subname"><a href="#" class="bold"><?=$reply->username?></a> (<?=date("Y-m-d H:i:s",$reply->coment_date)?>)</div>
                                                <div class="comment_reply"><div class="text_center"><!--<a href="">Answer</a> |--> 
                                                         <?  if($this->session->userdata('wannaquiz_user_id')){?>
                                                              <a href="#" onclick="memberCommentSpam('<?=$reply->comment_id?>','comment')">Spam</a>
                                                                 <?}
                                                                  if($reply->user_id==$user_id || $reply->comentator_id==$user_id) {?> | <a href="#" onclick="deleteMemberCommentReply('<?=$reply->comment_id?>','<?=$reply->username?>')">Delete</a><?}?></div></div>
                                                <div class="comment_arrange">
                                                    <div class="text_right">
                                                        <span id="like_<?=$reply->comment_id?>"> <?=$like_comment?> Like </span> <span><a style="cursor:pointer" onclick="like_profile_comment('<?=$reply->comment_id?>','1')"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span> <span><a style="cursor:pointer" onclick="like_profile_comment('<?=$reply->comment_id?>','0')"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a></span><span id="unlike_<?=$reply->comment_id?>"><?=$unlike_comment?> Unlike </span>
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
                                <div class="comment_title" style="display:none" id="reply_<?=$profileComments->comment_id?>">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this video</div>
                                        <textarea class="textbox" style="width:350px; height:100px;" id="profile_reply_comment_<?=$profileComments->comment_id?>"></textarea>
                                        <input type="hidden" name="friend_id" id="friend_id" value="<?=$this->session->userdata('wannaquiz_user_id')?>" />
                                    </div>
                                    <div class="input_clear">
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="profile_reply_commit(<?=$profileComments->comment_id?>)"/>
                                        <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                        <div>Not more than 500 characters</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                                <div class="clear"></div>

                                <div class="borderbottom_gray"></div>
                                    <?}} ?>
                            </div>
                            <!-- <div>
                                 <div class="borderbottom_gray"></div>
                                 <div class="borderleft_5gray">
                                	<div class="content_10box">
                                    	<div>
                                             <div class="comment_subname"><a href="#" class="bold">dsfdsfsf</a> (2weeks ago)</div>
                                             <div class="comment_reply"><div class="text_center"><a href="#">Answer</a> | <a href="#">Spam</a></div></div>
                                             <div class="comment_arrange">
                                                 <div class="text_right">
                                                     <span> 0 </span> <span><a href="#"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span> <span><a href="#"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a></span>
                                                 </div>
                                             </div>

                                             <div class="clear"></div>
                                         </div>
                                         <div class="padding_10topbottom">
                                             Eos fugit mazim omittam in, per cu oportere suavitate. Eum doctus recusabo conclusionemque ea!
                                         </div>
                                     </div>
                                 </div>
                             </div>-->

                            <div class="padding_10top">
                                <div class="bg_blue">
                                    <div class="content_5box">
                                        <div class="comment_title">
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

                        <div class="content_wrap" id="test_reaction">

                            <form name="reactionform" action="" method="post">
                                <div class="comment_title">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this Profile</div>
                                        <textarea class="textbox" style="width:350px; height:100px;" id="profile_comment"></textarea>
                                        <input type="hidden" name="friend_id" id="friend_id" value="<?=$this->session->userdata('wannaquiz_user_id')?>" />
                                    </div>
                                    <div class="input_clear">
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="profile_commit(<?=$profileComments->comment_id?>)"/>
                                        <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                        <div>Not more than 500 characters</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <!--<div class="comment_titleright"><a href="#" class="text_right">Add a video reaction</a></div>-->
                                <div class="clear"></div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="advertiselong_bottomborder"></div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>
