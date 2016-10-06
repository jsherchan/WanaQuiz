<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Game Boards</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                        <div class="content_10box">
                        	<div class="padding_10topbottom">
                            	<div class="bold">Choose your gaming board</div>
                            </div>
                            
                            <div class="content_wrap">
                            	<div class="gameboard_left">
                                	<div class="gameboard_leftInner">
                                    	<div class="content_wrap">
                                            <div class="border_gray">
                                                <div class="content_5box">
                                                    <div class="color_lightblue bold">Free game boards</div>
                                                    <div class="content_10box">
                                                        <div class="text_center">
                                                            <img src="<?=base_url()?>images/gameframe1.PNG" width="209" height="249" alt="game frame" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="gameboard_info">
                                        	<ul>
                                            	<li>Ready to print into your A4 size sheets</li>
                                                <li>You can upload your image, that will appear in the center portion of the board.
                                                    <?php if($this->session->userdata('wannaquiz_user_id') == '') { ?>Sorry, <a href="<?=base_url()?>home/login">members</a> only. <? } ?></li>
                                            </ul>
                                        </div>
                                        <div class="padding_10topbottom">
                                        	<div class="searchbtn_leftborder"></div>
                                            <div class="searchbtn_bg">
                                            	<a href="<?=site_url('gameboard/type/free')?>">Select Free</a>
                                            </div>
                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="gameboard_right">
                                	<div class="content_wrap">
                                            <div class="border_gray">
                                                <div class="content_5box">
                                                    <div class="bold"><span class="color_lightblue">Professional board</span> (only $9.99)</div>
                                                    <div class="content_10box">
                                                        <div class="text_center">
                                                            <img src="<?=base_url()?>images/gameframe.PNG" width="249" height="249" alt="game frame" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="gameboard_info">
                                        	<ul>
                                            	<li> Larger size 123"x123"</li>
                                                <li> Board will be printed on card board and sent by mail to the user with real dice</li>
                                            </ul>
                                        </div>
                                        <div class="padding_10topbottom">
                                        	<div class="searchbtn_leftborder"></div>
                                            <div class="searchbtn_bg">
                                            	<a href="<?=site_url('gameboard/type/premium')?>">Select Premium</a>
                                            </div>
                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                </div>
                                
                                <div class="clear"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>