<script type="text/javascript">
            $(document).ready(function()
            {
                //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked
                $("#leftpane2 h2.leftmenu_head").click(function()
                {
                    //alert("Click");
                    $(this).css({background:"#CB9C9C url(<?=base_url()?>images/up.png) no-repeat"}).next("div.leftmenu_body").slideToggle(300).siblings("div.leftmenu_body").slideUp("slow");
                    $(this).siblings('h2.leftmenu_head ').css({background:"#CB9C9C url(<?=base_url()?>images/down.png) no-repeat"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph

            });
        </script>
<div> <span id="sign"> + </span><a href="javascript:void(0)" onclick="show_playlist()">Playlist Questions</a></div>
<?php if($this->session->userdata('set_playlist')=='playlist') $show1 = 'block'; else $show1 ='none'; ?>
<div style="display:<?=$show1?>" id="playlist_questions">
<!--<div>From: <span class="bold"><a href="<?=base_url()?>member/profile/<?=$user->user_id?>" ><?=$user->username?></a></span></div>-->
    <div class="padding_10topbottom">
        <div id="leftpane2" class="menu_list">
            <?php
            //echo '<pre>';print_r($user_playlist);echo'</pre>';
            //foreach($category as $categories) {
            $playlist_rows = 0;
            if(count($user_playlist)>=10) $a=3;
            else $a = count($user_playlist);// echo $a.'///////';
            for($i=0;$i<$a;$i++) { //echo $playlist[$i]->id.'/ddfsfsdfsdfsd';
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
                    if($user_playlist[$i]->id ==  $playlist_id) $display1 = 'block'; else $display = '';

                    ?>
            <div class="leftmenu_body" style="display:<?=$display1?>">
                <div>
                            <?php


                            foreach($playlist_quiz as $playlistquizes) {
                                ?>

                    <div class="content_10box">
                        <div class="padding_10top">
                            <div class="text_center">
                                            <?php if($playlistquizes->quiz_type =='photo') {?>
                                <div class="border_green">
                                    <a href="<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>"  <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>')"<? } ?>>
                                        <img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes->images?>" alt="feature quest img" />
                                    </a>
                                </div>
                                            <? } else { $vd=explode('.',$playlistquizes->images); ?>
                                <div class="border_green">
                                    <a href="<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>')"<? } ?>>
                                        <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                    </a>
                                </div>
                                            <? }?>

                            </div>

                            <div>
                                <div class="color_blue">
                                    <a href="<?=base_url()?>quiz/view/<?=$playlistquizes->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes->playlist_id?>')"<? } ?>>
                                        <?=$playlistquizes->quiz_question?></a>
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
                <?php for($i=3;$i<count($user_playlist);$i++) {
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
                                        <a href="<?=base_url()?>quiz/view/<?=$playlistquizes1->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->playlist_id?>')"<? } ?>>
                                            <img src="<?=base_url()?>photo_question_thumbs/<?=$playlistquizes1->images?>" alt="feature quest img" />
                                        </a>
                                    </div>
                                                <? } else { $vd=explode('.',$playlistquizes1->images); ?>
                                    <div class="border_green">
                                        <a href="<?=base_url()?>quiz/view/<?=$playlistquizes1->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->playlist_id?>')"<? } ?>>
                                            <img height="71" width="94" src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" alt="feature quest img">
                                        </a>
                                    </div>
                                                <? }?>

                                </div>

                                <div>
                                    <div class="color_blue">
                                        <a href="<?=base_url()?>quiz/view/<?=$playlistquizes1->quiz_id?>" <?php if($this->session->userdata('set_playlist_quiz_user')=='') { ?>onclick="playlist_question_click('<?=$user->quiz_id?>','<?=$user->user_id?>','<?=$playlistquizes1->playlist_id?>')"<? } ?>>
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