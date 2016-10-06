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
                                                            <img src="<?=base_url()?>images/gameframe1.jpg" width="209" height="249" alt="game frame" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="gameboard_info">
                                        	<ul>
                                            	<li>Ready to print into your A4 size sheets</li>
                                                <li>You can upload your images, that will appear on the center portion of the game</li>
                                            </ul>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="gameboard_right">
                                	<div class="bold">Upload an image in the center of your board:</div>
                                    <div class="padding_10topbottom">
                                    	Some description about how image should be uploaded. Optimal resolution. File sizes. File types supported.
                                    </div>
                                    <div><?=$this->session->flashdata('message')?></div>
                                    <div>
                                    	<form name="uploadgameframe" action="<?=site_url('gameboard/customizedGameboard')?>" method="post" enctype="multipart/form-data">								<input type="hidden" name="board_type" value="<?=$type?>" />
                                        	<div class="input_clear">
                                            	<label>Select an image</label>
                                                <input type="file" name="userfile" />
                                            </div>
                                            <div class="input_clear">
                                            	<div style="padding-left:90px;">
                                                    <div class="searchbtn_leftborder"></div>
                                                    <input type="submit" class="searchbtn_bg" value="upload" />
                                                    <div class="searchbtn_rightborder"></div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="clear"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>