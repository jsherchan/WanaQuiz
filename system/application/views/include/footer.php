<div id="footer_wrap">
    	<div class="footer_bgimg">
        	<div class="footer_bgimgInner">
            	<div class="footer_left">
                	<div class="padding_10topbottom">
                    	<div class="font20">WannaQuiz</div>
                    </div>
                    <div class="padding_10topbottom">
                    	<div class="footer_links">
                        	<ul>
                            	 <li><a href="<?=site_url('home/show/about')?>">About</a></li>
                                 <li><a href="<?=site_url('home/help_center')?>">Help Center</a></li>
                                 <li><a href="<?=site_url('home/show/questions')?>">FAQ</a></li>
                                 <li><a href="<?=site_url('home/show/spam')?>">Spam Policy</a></li>
                                 <li><a href="<?=site_url('forum')?>">Forum</a></li>
                                 <li><a href="<?=site_url('home/show/contact_wannaquiz')?>">Contact us</a></li>
                                <li><a href="<?=site_url('home/show/top_50')?>">Top 50 players</a></li>
                                 <li><a href="<?=site_url('home/show/regular_vs_sponsor')?>">Sponsor vs Regular user</a></li> 
                                <div class="clear"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer_mid">
                	<div class="borderleft_lightblue">
                    	<div class="footer_midInner">
                        	<div class="padding_10topbottom">
                                <div class="font20">Quiz Categories</div>
                            </div>
                           
                            <div class="padding_10topbottom">
                                <div class="footer_links">
                                    <ul>
                                         <?php $category = $this->Category_model->get_categories();
                                        if(count($category)>0){
                                        foreach($category as $categories){
                                        ?>
                                        <li><a href="<?=base_url()?>quiz/categoryDetail/regular/<?=str_replace(' ','_',$categories->name)?>"><?=$categories->name?></a></li>
                                       
                                        <? } } ?>
                                        <div class="clear"></div>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="footer_right">
                	<div class="borderleft_lightblue">
                    	<div class="footer_midInner">
                        	<div class="padding_10topbottom">
                                <div class="font20">How To:</div>
                            </div>
                            <div class="padding_10topbottom">
                                <div class="footer_links">
                                    <ul>
                                        <li><a href="<?=site_url('home/show/single_player_game ')?>">Single player game</a></li>
                                        <li><a href="<?=site_url('home/show/multiplayer')?>">Multiplayer game</a></li>
                                        <li><a href="<?=site_url('home/show/video_question')?>">Video question </a></li>
                                        <li><a href="<?=site_url('home/show/photo_question')?>">Photo question</a></li>
                                        <li><a href="<?=site_url('home/show/main')?>">Quiz categories</a></li>
                                        <li><a href="<?=site_url('gameboard')?>">Game boards </a></li>
                                        <li><a href="<?=site_url('home/show/levels')?>">Levels & ranks</a></li>
                                        <li><a href="<?=site_url('home/show/partner ')?>">Become a partner</a></li>
                                        <li><a href="<?=site_url('home/show/intro_video')?>">Advertise</a></li>
                                        <li><a href="<?=site_url('home/show/teachers_and_students')?>">Teachers & students </a></li>
                                        <li><a href="<?=site_url('home/show/museum')?>">Museums </a></li>
                                        <li><a href="<?=site_url('home/show/age_appropriate')?>">Age appropriate  </a></li>
                                        <div class="clear"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="clear"></div>
            </div>
            <div class="text_center" style="font-size:10px;">
            	<div><a href="<?=site_url('page/show/terms_conditions')?>">Terms and conditions</a></div>
                <div>&copy; All Rights Reseved. Wannaquiz.com 2010</div>
            </div>
        </div>
    </div>