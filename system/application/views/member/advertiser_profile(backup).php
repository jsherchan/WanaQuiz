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
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane h2.menu_head").click(function()
    {
		$(this).css({backgroundImage:"url(<?=base_url()?>images/up.png) no-repeat"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(<?=base_url()?>images/down.png) no-repeat"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph

	
</script>


<div id="body_wrap">
	<div class="bodywrapInner">
     <?php $this->load->view('include/advance_search_box.php'); ?>
       	<div class="advertprofile_left">
        	<div class="advertprofile_leftInner">
                <div class="content_wrap">
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
                    <div class="advertiseleft_bg">
                        <div class="whiteboxrightside_bgInner">
                            <div class="content_10box">
                                <div class="profile_img">
                                	<div class="border1_green">
                                    	<img src="<?=base_url()?><?=PROFILE_IMAGES.'/'.$mem_info->profile_picture?>" alt="<?=$mem_info->username?>" />
                                    	<!--<img src="<?=base_url()?>images/user_img.jpg" width="88" height="88" alt="profile photo" />-->
                                    </div>
                                </div>
                                <div class="profile_desc">
                                	<div class="profile_descInner">
                                    	<div class="bold"><?=ucfirst($mem_info->first_name).' '.ucfirst($mem_info->last_name)?></div>
                                        <div class="input_clear">
                                        	<div class="searchbtn_leftborder"></div>
                                            <div class="searchbtn_bg" id="subscribe"><a href="<?=site_url('member/updatePublicProfile')?>" style="padding:0 5px;" >Edit my profile</a></div>
                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        <div class="font11">
                                            
                                            
                                        </div>
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
                                    	<div class="bold text_right"><?=ucfirst($mem_info->first_name).' '.ucfirst($mem_info->last_name)?></div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                	<div class="profile_img">
                                    	Joined
                                    </div>
                                    
                                    <div class="profile_desc">
                                    	<div class="bold text_right"><?=date('F d,Y',$mem_info->joined_date)?></div>
                                    </div>
                                    

                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                	<div class="profile_img">
                                    	Subscribers
                                    </div>
                                    
                                    <div class="profile_desc">
                                    	<div class="bold text_right">8628</div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                	<div class="profile_img">
                                    	Website
                                    </div>
                                    
                                    <div class="profile_desc">
                                    	<div class="bold text_right">http://meramworld.com</div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                	<div class="profile_img">
                                    	Subjects
                                    </div>
                                    
                                    <div class="profile_desc">
                                    	<div class="bold text_right">travelling, photography</div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                
                                <div class="padding_5topbottom">
                                	Hey my name is Meriam Feiona. I started Meriam world in 1986 with Modo homero ubique eu usu, his justo mazim aliquid no, no altera accumsan vis. Sed error imperdiet repudiandae ei, in commune accumsan vulputate has, assum epicurei eleifend in nam. Eu velit detraxit antiopam per, eu audiam qualisque scriptorem sed. Ea pri aeque principes consulatu, at odio brute definitiones eam, usu in semper essent partiendo.
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold"><?=ucfirst($mem_info->first_name).' '.ucfirst($mem_info->last_name)?> is:</div>
                                    <div class="padding_10top">
                                    	<img src="<?=base_url()?>images/sponsor_img.jpg" width="111" height="15" alt="sponsor img" /> <span class="bold color_green">Sponsor</span>
                                    </div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold">Subscribers (8,528)</div>
                                    <div class="padding_10topbottom">
                                    	<div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jim</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo1.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jasmin</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo1.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jasmin</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo1.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jasmin</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo1.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jasmin</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jim</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jim</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><img src="<?=base_url()?>images/subscriber_photo.jpg" width="58" height="58" alt="subscriber" /></div>
                                                    <div class="padding_5top"><a href="#">Jim</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><a href="#">See all</a></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold">Friends (<?=count($mem_friends)?>)</div>
                                    <div class="padding_10topbottom">
                                    	<? foreach($mem_friends as $friends){?>
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><a href="<?=site_url('member/profile/'.$friends->user_id)?>"><img src="<?=base_url().FRIENDS_IMAGES.'/'.$friends->profile_picture?>" alt="<?=$friends->username?>" /></a></div>
                                                    <div class="padding_5top"><a href="<?=site_url('member/profile/'.$friends->user_id)?>"><?=$friends->username?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <? }?>
                                       
                                        
                                                                                
                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><a href="#">See all</a></div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="advertiseleft_bottomborder"></div>
                </div>
                
                <div class="content_wrap">
                    <div class="advertiseleft_topborder">
                        <!--<div class="title_align">
                            <div class="greentitlebg_leftborder"></div>
                            <div class="greentitlebg_bg" style="width:265px;">
                                <div class="bold font14 color_white">Member panel</div>
                            </div>
                            <div class="greentitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>-->
                    </div>
                    <div class="advertiseleft_bg">
                        <div class="whiteboxrightside_bgInner">
                        	<div class="content_10box">
                            	<div class="text_center">
                                	<div class="content_wrap">
                                		<img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertise" />
                                    </div>
                                    <div class="content_wrap">
                                		<img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertise" />
                                    </div>
                                    <div class="content_wrap">
                                		<img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertise" />
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="advertiseleft_bottomborder"></div>
                </div>
                
            </div>
       	</div>
    	<div class="advertprofile_right">
        	<div class="content_wrap">
            	<div class="advertprofile_mid">
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
                        	<div class="bold"><span class="fon16">Other questions by:</span> <span class="color_lightblue"><?=ucfirst($mem_info->first_name).' '.ucfirst($mem_info->last_name)?></span></div>
                            <div class="padding_10topbottom">
                            	<div id="firstpane" class="menu_list">
                                    <h2 class="menu_head">History</h2>
                                        <div class="menu_body" style="display:block;">
                                            <div>
                                            	<div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                                
                                                <div class="content_10box">
                                                    <div class="padding_10top">
                                                        <div class="featuredquest_left">
                                                            <div class="border_green"><img src="<?=base_url()?>images/quest_img.jpg" width="94" height="71" alt="feature quest img" /></div>
                                                        </div>
                                                        
                                                        <div class="accordionhistory_right">
                                                            <div class="color_blue">
                                                            	Per inermis mentitum oportere no, illum cetero intellegam ut mea
                                                            </div>
                                                            <div class="font11">
                                                            	Views: 3,654 - 1 weeks ago
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                                <div class="borderbottom_dotted"></div>											
                                            
                                            </div>
                                        </div>
                                        
                                         <h2 class="menu_head">Animals			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	Animals content here....
                                            </div>
                                        </div>
                                        
                                        <h2 class="menu_head">Computers			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	Computers content here....
                                            </div>
                                        </div>
                                        <h2 class="menu_head">FLora			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	FLora content here....
                                            </div>
                                        </div>
                                        <h2 class="menu_head">Health			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	Health content here....
                                            </div>
                                        </div>
                                        <h2 class="menu_head">Movies			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	Movies content here....
                                            </div>
                                        </div>
                                        <h2 class="menu_head">Televison			</h2>
                                        <div class="menu_body">
                                            <div class="content_10box">
                                            	Televison content here....
                                            </div>
                                        </div>
                                  </div>
                                  <div class="text_right">
                                  	<a href="#">More </a> <img src="<?=base_url()?>images/down.png" width="20" height="5" alt="downarrow" />
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
                                        <div class="content_wrap">
                                            <img src="<?=base_url()?>images/advertisement.jpg" width="250" height="200" alt="advertise" />
                                        </div>
                                        
                                        <div class="content_wrap">
                                            <div class="bold">
                                            	<div>My quiz info</div>
                                                <div class="padding_5topbottom font14">Level 105</div>
                                            </div>
                                            <div class="font11">43 levels from <a href="#">points</a> and 62 levels <a href="#">from badges</a>.</div>
                                        </div>
                                        
                                        <div class="bold">
                                        	<div class="borderbottom_gray"></div>
                                            <div class="padding_10topbottom">
                                            	<div class="quizinfo_left">Wannaquiz Points:</div>
                                                <div class="quizinfo_right"><div class="color_green text_right">3,840</div> </div>
                                                
                                                <div class="clear"></div>
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                            <div class="padding_10topbottom">
                                            	<div>
                                                    <div class="quizinfo_left">Overall Point Rank:</div>
                                                    <div class="quizinfo_right"><div class="color_darkbrown text_right">#87,657</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Best category:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">3,840</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Rank:</div>
                                                    <div class="quizinfo_right"><div class="color_darkbrown text_right">#380</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                            
                                            <div class="padding_10topbottom">
                                            	<div>
                                                    <div class="quizinfo_left">Last Played Game:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">2 days ago</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Points earned:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">85</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                            
                                            <div class="padding_10topbottom">
                                            	<div>
                                                    <div class="quizinfo_left">Last played team game:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">4 days agp</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Points earned:</div>
                                                    <div class="quizinfo_right"><div class="color_green text_right">103</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="padding_10top">
                                                    <div class="quizinfo_left">Total team points:</div>
                                                    <div class="quizinfo_right"><div class="color_darkbrown text_right">8,302</div> </div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                            <div class="borderbottom_gray"></div>
                                        </div>
                                        <div class="text_right"><a href="#">(help)</a></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="whiteboxrightside_bottomborder"></div>
                        </div>
                    </div>
                </div>
                
                <div class="clear"></div>
            </div>
            
            <div class="content_wrap">
            	<div class="advertiselong_topborder"></div>
                <div class="advertiselong_bg">
                	<div class="borderbottom_dotted"></div>
                	<div class="content_10box">
                    	
                        <div class="content_10box">
                        	<div class="medal_icon"> <span class="bold color_blue">Meriam Fieona's</span> Small Challenge Badgelets (each award a small number of points)</div>
                            <div class="padding_10topbottom">
                            	<div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award3.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award4.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award2.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/award1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            	<div class="clear"></div>
                            </div>
                        </div>
                        
                        <div class="content_10box">
                        	<div class="medal_icon"> <span class="bold color_blue">Meriam Fieona's</span> Mazor Challenge Badgeles (+1 level each)</div>
                            <div class="padding_10topbottom">
                            	<div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/sunimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/spec.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/rocket.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/plane.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/sunimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/spec.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/rocket.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/plane.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/cupimg1.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/sunimg.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/spec.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/rocket.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/plane.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/rocket.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="awardbox">	
                                	<div class="content_5box">
                                    	<div class="awardbox_bg">
                                        	<div class="awardbox_bgInner">
                                            	<a href="#" style="display:block; background:url(<?=base_url()?>images/plane.jpg) no-repeat 50% 50%; width:54px; height:54px;"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            	<div class="clear"></div>
                            </div>
                        </div>
                        
                        <div class="content_10box">
                        	<div class="bg_yellow">
                            	<div class="content_10box">
                                	<div>
                                    	<div class="quizinfo_left bold">Quizzes Played:</div>
                                        <div class="quizinfo_left"><div class="color_darkbrown">17003</div></div>
                                    	<div class="clear"></div>
                                    </div>
                                    <div class="padding_5top">
                                    	<div class="quizinfo_left bold">Quizzes Correct: </div>
                                        <div class="quizinfo_left"><span class="color_darkbrown">105,824/ 198,995 </span>(53%)</div>
                                    	<div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_10box">
                        	<div class="bold"><span class="color_blue">Meriam Feiona's</span> Quiz stats</div>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<img src="<?=base_url()?>images/quiz_graph.jpg" width="638" height="351" alt="graph" />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="borderbottom_dotted"></div>
                    <div class="content_10box">
                    	<div class="content_wrap">
                        	<div class="bg_blue">
                            	<div class="content_5box">
                                	<div class="comment_title">
                                    	<div><img src="<?=base_url()?>images/down_arrow.jpg" width="18" height="11" alt="arrow" /> <span class="bold">Text reactions: (210)</span></div>
                                    </div>
                                    <div class="comment_titleright">
                                    	<div class="text_right"><a href="#">Add Text Reaction</a></div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="padding_10topbottom">
                            	<div>
                                    <div class="comment_name"><a href="#" class="bold">zach444</a> (2weeks ago)</div>
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
                            <div>
                                <div class="borderbottom_gray"></div>
                                <div class="borderleft_5gray">
                                	<div class="content_10box">
                                    	<div>
                                            <div class="comment_subname"><a href="#" class="bold">zach444</a> (2weeks ago)</div>
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
                            </div>
                            <div class="padding_10top">
                            	<div class="bg_blue">
                                    <div class="content_5box">
                                        <div class="comment_title">
                                            <div> <span class="bold">Page: <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a></span></div>
                                        </div>
                                        <div class="comment_titleright">
                                            <div class="text_right"><a href="#">Next</a></div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div><a href="#">Watch all 234 reactions</a></div>
                            </div>
                        </div>
                        
                        <div class="content_wrap">
                        	<form name="reactionform" action="" method="post">
                                <div class="comment_title">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this video</div>
                                        <textarea class="textbox" style="width:350px; height:100px;"></textarea>
                                    </div>
                                    <div class="input_clear">
                                    	<div class="searchbtn_leftborder"></div>
                                        <input type="submit" class="searchbtn_bg" value="Add reaction" name="submit" />
                                        <div class="searchbtn_rightborder" style="margin-right:10px;"></div>
                                        <div>Not more than 500 characters</div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="comment_titleright"><a href="#" class="text_right">Add a video reaction</a></div>
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