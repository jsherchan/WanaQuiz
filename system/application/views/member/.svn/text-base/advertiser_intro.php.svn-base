<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">
                                        Welcome 
                                        <?php echo ($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) ? $this->session->userdata('first_name') : $mem_info->username ;?>!
                                    </div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<div class="content_10box">
                                    <?php if($mem_info->user_type!=0){?>
                                    <div class="padding_5top">
                                        <div class="advert_company"> Company: </div>
                                        <div class="advert_name bold"> <?=$company_info->company_name?> </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?}?>
                                    <div class="padding_5top">
                                        <div class="advert_company"> Country: </div>
                                        <div class="advert_name bold">
                                             <!--<?php //if($mem_info->user_type!=0){?>
                                            <? //$address->address?>
                                            <? //}else{?>-->
                                            <?=$address->country?>
                                            <?php if ($this->session->userdata('wannaquiz_tw_id') && $address->country=='United States'){ ?>
                                            (<a href="<?=site_url('member/updatePublicprofile')?>">change</a>)
                                           <? } ?>
                                            <!--<? //}?>-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="padding_5top">
                                        <div class="advert_company"> Member from: </div>
                                        <div class="advert_name bold"> <?php $joined_date = $mem_info->joined_date; echo date("d M Y",$joined_date);?> </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                
                                <div class="borderbottom_dotted"></div>
                                
                                <div class="content_10box">
                                	<div class="content_wrap">
                                        <div class="border_darkblue">
                                            <div class="addhelptitle_bg"><div class="font14 bold"><?=$content1->title?></div></div>
                                            <div class="content_10box">
                                                <div class="desc">
                                                    <?=$content1->detail?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <br>
                                    <div class="content_wrap">
                                        <div class="border_darkblue">
                                            <div class="addhelptitle_bg"><div class="font14 bold"><?=$content2->title?></div></div>
                                            <div class="content_10box">
                                                <div class="desc">
                                                    <?=$content2->detail?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="content_wrap">
                                        <div class="border_darkblue">
                                            <div class="addhelptitle_bg"><div class="font14 bold"><?=$content3->title?></div></div>
                                            <div class="content_10box">
                                                <div class="desc">
                                                    <?=$content3->detail?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>