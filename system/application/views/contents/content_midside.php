<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="helpmid_links">
                                    	<?=$page->title?>
                                    </div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                                <div>
                                	<div class="content_wrap">
                            
                                        <div class="content_10box">
                                        	
                                            
                                            <div class="help_opt4desc">
                                            	<div class="help_optdescInner">
                                                	<?=$page->detail?>
                                                        <?php if($url=='sound'){ ?>
                                                     <div style="padding-top:10px; padding-bottom:20px">
                                                        <div style="font-weight:bold">Voice - sound level test</div>
                                                        <div id="div1" style="float:left; padding:10px 0 10px 0">
                                                            <div id='player1'></div>
                                                            <script type='text/javascript'>
                                                                var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                                                so.addParam('allowfullscreen','true');
                                                                so.addParam('allowscriptaccess','always');
                                                                so.addParam('wmode','opaque');
                                                                so.addVariable('file','<?=base_url()?>Voice - sound level test.mp3');
                                                                so.write('player1');
                                                            </script>
                                                        </div>
                                                        <div class="clear"></div>

                                                        <div style="font-weight:bold; padding-top:10px">Music - sound level test</div>
                                                        <div style="padding-top:10px; padding-bottom:10px">
                                                            <div id='player2'></div>
                                                            <script type='text/javascript'>
                                                                var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                                                so.addParam('allowfullscreen','true');
                                                                so.addParam('allowscriptaccess','always');
                                                                so.addParam('wmode','opaque');
                                                                so.addVariable('file','<?=base_url()?>Music - sound level test.mp3');
                                                                so.write('player2');
                                                            </script>
                                                        </div>
                                                        <span style="width:auto;">Download:<a href="<?=base_url()?>download"> Voice - sound level test</a> | <a href="<?=base_url()?>download1"> Music - sound level test</a></span>
                                                        <div style="padding:10px 0 0 0">Music must be made by yourself or in the public <a href="<?=base_url()?>page/show/sound">domain/creative commons</a></div>
                                                        <!--<div id="vault1"></div>-->

                                                    </div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>