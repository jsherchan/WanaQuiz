<div id="body_wrap">
    <div class="bodywrapInner">
        <div class="padding_10topbottom">
            <div class="quizmaking_topborder"></div>
            <div class="quizmaking_bg">
                <div class="whiteboxrightside_bgInner">

                    <div class="borderbottom_dotted"></div>
                    <?php if($edit==0)
                        $action = site_url('quiz/addPhotoQuizAdvertiser');
                    else $action = site_url('quiz/editPhotoQuizAdvertiser');
                    ?>
                    <form name="add_advertiser_photo_question" action="<?=$action?>" method="post" enctype="multipart/form-data">
                        <div class="content_10box">
                            <div class="padding_10leftright">

                                <div class="content_wrap">
                                    <div class="quizvideo_topborder"></div>
                                    <div class="quizvideo_bg">
                                        <div class="content_10box">
                                            <div class="bannerads_icon font14 bold">Banner ads</div>
                                        </div>
                                        <div class="borderbottom_dotted"></div>
                                        <div class="content_10box">

                                        	Your banner will be displayed to your question and answer. Here you can select up to five banners to rotate besides your question(s)

                                        </div>
                                        <?php //print_r($banner_info);?>
                                        <div class="padding_10topbottom">
                                            <? for($i=0;$i<5;$i++) {?>
                                            <input type="hidden" name="banner_<?=$i?>" value="<?php echo $banner_info[$i]->banner_id?>">
                                            <div class="bannerads_uploadbox">
                                                <div class="bannerads_uploadboxInner">
                                                    <div class="border_gray">
                                                        <div class="bg_gray">
                                                            <div class="bannerads_uploadboxheight">
                                                                <div class="content_10box">
                                                                    <div class="content_wrap">
                                                                        <div class="border_gray">
                                                                            <a href="#" style="display:block; background:url(<?=base_url()?>images/bannerads_img.jpg) no-repeat 50% 50%; width:170px; height:365px;"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div>

                                                                        <div class="input_clear">
                                                                            <label>File upload</label>
                                                                            <input type="file" name="banner_file_<?=$i?>" style="width:167px;" size="11" value="<?php echo $banner_info[$i]->banner_image;?>" />
                                                                        </div>
                                                                        <div class="input_clear">
                                                                            <label>URL</label>
                                                                            <input type="text" class="textbox" name="banner_url_<?=$i?>" style="width:167px;" value="<?php echo $banner_info[$i]->url;?>" />
                                                                        </div>
                                                                        <div class="input_clear">
                                                                            <label>Banner name</label>
                                                                            <input type="text" class="textbox" name="banner_name_<?=$i?>" style="width:167px;" value="<?php echo $banner_info[$i]->banner_name;?>" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <? }?>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="padding_10leftright">
                                            <a href="<?=base_url()?>home/help_center">Help</a>
                                        </div>
                                    </div>
                                    <div class="quizvideo_bottomborder"></div>
                                </div>

                                <div>

                                    <div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="textads_icon font14 bold">Text ads</div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                                <div class="content_wrap">
                                                    <div>
                                                        <div>Five of your text ads will be displayed beside your question.</div>
                                                        <div>Of you choose more than five text ads, they will rotate. In that case you will have selection of your text ads (randomly) displayed beside your questions (s).</div>
                                                    </div>
                                                </div>

                                                <div class="content_wrap">
                                                    <div class="bold">This is what text ad may look like:</div>
                                                    <div class="content_10box">
                                                        <div class="input_clear">
                                                            <div class="textadd_egleft text_right">Your clickable (descriptive) link:- </div>
                                                            <div class="textadd_egleft"><a href="#" style="color:#004080; font-weight:bold; text-decoration:underline;"> Wanna Quiz</a></div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="input_clear">
                                                            <div class="textadd_egleft text_right">Your discription (non clikcable):- </div>
                                                            <div class="textadd_egleft"> Wanna quiz is for all the people all over the world.</div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="input_clear">
                                                            <div class="textadd_egleft text_right">Your clickable link:- </div>
                                                            <div class="textadd_egleft"><a href="#" style="color:#04A56F; font-size:11px;"> http://www.wannaquiz.com </a></div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div><?php //print_r($long_text_info)?>
                                                <? for($i=0;$i<10;$i++) { ?>
                                                <input type="hidden" name="long_text_<?=$i?>" value="<?php echo $long_text_info[$i]->id;?>">
                                                <div class="textadsbox">
                                                    <div class="textadsboxInner">
                                                        <div class="border_gray">
                                                            <div class="bg_gray">
                                                                <div class="textadsbox_height">
                                                                    <div class="content_10box">
                                                                        <div class="textadsbox_left"><div class="font24 italic"><?=$i+1?></div></div>
                                                                        <div class="textadsbox_right">
                                                                            <div class="textadsform">
                                                                                <div class="input_clear">
                                                                                    <label>Your clickable (descriptive) link:</label>
                                                                                    <input type="text" name="long_text_ads_title_<?=$i?>" class="textbox" style="width:215px;" value="<?php echo $long_text_info[$i]->link_title;?>"  />
                                                                                    <!--<div class="error_msg" style="padding-left:205px;">!Error here...</div>-->
                                                                                </div>
                                                                                <div class="input_clear">
                                                                                    <label>Your discription (non clikcable) :</label>
                                                                                    <textarea  name="long_text_ads_description_<?=$i?>" style="width:215px; height:80px;" class="textbox"><?php echo $long_text_info[$i]->link_description;?></textarea>
                                                                                </div>
                                                                                <div class="input_clear">
                                                                                    <label>Your clickable URL :</label>
                                                                                    <input type="text" name="long_text_ads_url_<?=$i?>" class="textbox" style="width:215px;" value="<?php echo $long_text_info[$i]->link_url;?>"  />
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? }?>

                                                <div class="clear"></div>
                                            </div>


                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>

                                    <div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="textads_icon font14 bold">Text ads</div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                                <div class="content_wrap">
                                                    <div>
                                                    	Lorem ipsum no has audiam placerat deserunt, quo ex posse iracundia dissentiet, mucius aperiam incorrupte sea et. Fabellas adipisci quaerendum no vel, ex his minim mentitum dissentias, constituam comprehensam delicatissimi eos no.
                                                    </div>
                                                </div>

                                                <div class="content_wrap">
                                                    <div class="bold">This is what text ad may look like in player:</div>
                                                    <div class="padding_10top">
                                                        <div style="width:498px;">
                                                            <div class="bg_skylightblue">
                                                                <div class="content_5box">
                                                                    <div class="textads_img"><img src="<?=base_url()?>images/textadd_img.jpg" width="66" height="50" alt="text add img" /></div>
                                                                    <div class="textads_desc font11">
                                                                        <div>Offer by publisher of last question</div>
                                                                        <div class="input_clear">
                                                                            <a href="#" style="color:#0033CC; text-decoration:none; font-weight:bold;">A text with link to your site</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div><?php //print_r($short_text_info);?>
                                                <? for($i=0;$i<10;$i++) {?>
                                                <input type="hidden" name="short_text_<?=$i?>" value="<?php echo $short_text_info[$i]->id;?>">
                                                <div class="textadsbox">
                                                    <div class="textadsboxInner">
                                                        <div class="border_gray">
                                                            <div class="bg_gray">
                                                                <div class="textadsbox_height">
                                                                    <div class="content_10box">
                                                                        <div class="textadsbox_left"><div class="font24 italic"><?=$i+1?></div></div>
                                                                        <div class="textadsbox_right">
                                                                            <div class="textadsform">

                                                                                <div class="input_clear">
                                                                                    <label>Your text ad after your question (not more than 80 characters) :</label>
                                                                                    <textarea name="short_text_ads_descrption_<?=$i?>" style="width:215px; height:80px;" class="textbox"><?php echo $short_text_info[$i]->link_short_desc;?></textarea>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? }?>

                                                <div class="clear"></div>
                                            </div>



                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>

                                    <div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="optionads_icon font14 bold">Options</div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                                <input type="checkbox" name="ads_rotation" value="yes" /> <label>I want both text and banner rotated beside my question and on profile page.</label>
                                            </div>
                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>

                                    <div class="input_clear">
                                        <div style="padding-left:305px;">
                                            <div class="searchbtn_leftborder"></div>
                                            <input type="button" class="searchbtn_bg" value="Back" onclick="javascript:document.location.href='<?=site_url('quiz/addPhotoQuizStep2')?>'" />
                                            <div class="searchbtn_rightborder" style="margin-right:20px;"></div>

                                            <div class="searchbtn_leftborder"></div>
                                            <input type="submit" class="searchbtn_bg" value="Save" name="submit" />
                                            <div class="searchbtn_rightborder"></div>

                                            <div class="clear"></div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="quizmaking_bottomborder"></div>
        </div>
    </div>
</div>
