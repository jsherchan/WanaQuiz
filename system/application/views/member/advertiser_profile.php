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

		$("#subscribe_friend").click(function(){

                                $.post('<?=base_url()?>member/subscribe', {profile_id:<?=$profile_id?>,status:1} , function(data)
                                {
                                    if(data=='subscribed'){
                                    $.prompt("Successfully subscribed");
                                    
                                     $("#subscribe").html('<a href="javascript:void()" style="padding:0 5px;" id="unsubscribe_friend">Unsubscribe</a>');
                                    }
                                    else alert('error');
                                });

				
		});
		
		$("#unsubscribe_friend").click(function(){

                                $.post('<?=base_url()?>member/subscribe', {profile_id:<?=$profile_id?>,status:0} , function(data)
                                {
                                    if(data=='unsubscribed'){
                                    $.prompt("Successfully unsubscribed");

                                    $("#subscribe").html('<a href="javascript:void()" style="padding:0 5px;" id="subscribe_friend">Subscribe</a>');
                                   
                                    }
                                    else alert('error');
                                });
                                
		});
		
		$("#add_friend").click(function(){
				
				var id=<?=$mem_info->user_id?>;
			
			//send email request through ajax
				$.post('<?=base_url()?>member/sendFriendRequest', {friend_id:id} , function(data)
				{			
					   if (data != '' || data != undefined || data != null) 
					   {	
					  		$.prompt(data);
						//$('#register_interest_'+id).html('You have registered your interest');
					   }
			 
         		 });
				
				
		});

               

		$("#block_user").click(function(){
				$.prompt("Friend has been blocked");
		});
	
		$("#send_message").click(function(){
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
									
								$.post('<?=base_url()?>member/sendMessage', {id:id,subject:subject,message:message} , function(data){			
								   if (data != '' || data != undefined || data != null) 
								   {	
										$.prompt("Success");													
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
			$.prompt(jqistates);
		}						  
										  
										  
		
});

function profile_commit(){
                    var comment = $('#profile_comment').val();
                    if(comment == '')
                    {
                        alert('The field should not be empty!')
                    }
                    else
                    {
                        $.post('<?=base_url()?>member/profileCommit', {profile_id:<?=$profile_id?>,user_id:<?=$this->session->userdata('wannaquiz_user_id')?>,comment:comment} , function(data){

                        if (data != '' || data != undefined || data != null)
                        {
                            dt=data.split('*');
                            if(dt[0]=='success')
                                {  
                                    $('#comment').html(dt[1]);
                                }
                                else alert('error');

                        }
                        });
                    }

 }

function profile_reply_commit(comment_id){
                    var comment = $('#profile_reply_comment_'+comment_id).val();
                    if(comment == '')
                    {
                        alert('The field should not be empty!')
                    }
                    else
                    {
                        $.post('<?=base_url()?>member/profileReplyCommit', {profile_id:<?=$profile_id?>,comment_id:comment_id,user_id:<?=$this->session->userdata('wannaquiz_user_id')?>,comment:comment} , function(data){

                        if (data != '' || data != undefined || data != null)
                        {
                            dt=data.split('*');
                            if(dt[0]=='success')
                                {
                                    $('#reply_comment_'+comment_id).html(dt[1]);
                                    $('#reply_'+comment_id).hide('slow');
                                }
                                else alert('error');

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
    $.post('<?=base_url()?>member/likeProfileComment', {comment_id:comment_id,status:status} , function(data){

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
                                <div class="profile_img" style="width:100px">
                                	<div class="border1_green">
                                        <? if($mem_profile->profile_picture!="") {?>
                                       <? if($this->session->userdata('wannaquiz_fb_id')) { ?>
                                              <img src="<?=$mem_profile->profile_picture?>" alt="<?=$this->session->userdata('wannaquiz_fb_id')?>" /> <? } else {?>
                                       <? } ?>
                                           <img src="<?=base_url()?>user_profile_images/<?=$mem_profile->profile_picture?>" alt="<?=$mem_profile->username?>" /> 
                                       <? } else {?>
                                           <img src="<?=base_url()?>images/avatar_img.jpg" alt="Member" /><? }?>                                    	
                                    	<!--<img src="<?=base_url()?>images/user_img.jpg" width="88" height="88" alt="profile photo" />-->
                                    </div>
                                </div>
                                <div class="profile_desc">
                                	<div class="profile_descInner">
                                    	<div class="bold"><?=ucfirst($mem_profile->first_name).' '.ucfirst($mem_profile->last_name)?></div>
                                        <?php if($profile_id != $this->session->userdata('wannaquiz_user_id')) {?>
                                        <div class="input_clear">
                                        	<div class="searchbtn_leftborder"></div>
                                                
                                            <div class="searchbtn_bg" id="subscribe">
                                                <?php 
                                               
                                                if($subscriber == "unsubscribed") {?>
                                                <a href="javascript:void()" style="padding:0 5px;" id="subscribe_friend">Subscribe</a>
                                                <? } else {?>
                                                <a href="javascript:void()" style="padding:0 5px;" id="unsubscribe_friend">Unsubscribe</a>
                                                <? }?>
                                            </div>

                                            <div class="searchbtn_rightborder"></div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        <div class="font11">
                                            <div>
                                                <a href="javascript:void()" id="add_friend">Add as friend </a> | <a href="javascript:void()" id="block_user">Block User</a>
                                            </div>
                                            <div>
                                                <a href="javascript:void()" id="send_message">Send message</a>
                                            </div>
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
                                    	<div class="bold text_right"><?=$mem_profile->website;?></div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_5topbottom">
                                	<div class="profile_img">
                                    	Subjects
                                    </div>
                                    
                                    <div class="profile_desc">
                                    	<div class="bold text_right"><?=$mem_profile->subject;?></div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                
                                <div class="padding_5topbottom">
                                	<?=$mem_profile->profile_description;?>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold"><?=ucfirst($mem_profile->first_name).' '.ucfirst($mem_profile->last_name)?> is:</div>
                                    <div class="padding_10top">
                                    	<img src="<?=base_url()?>images/sponsor_img.jpg" width="111" height="15" alt="sponsor img" /> <span class="bold color_green">Sponsor</span>
                                    </div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold">Subscribers (<?=count($subscriber_info)?>)</div>
                                    <div class="padding_10topbottom">
                                    	<?php echo '<pre>'; print_r($subscriber_info); echo '</pre>';
                                        if(count($subscriber_info)>0)
                                        {
                                            foreach($subscriber_info as $subs_info)
                                            {
                                        ?>
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><a href="<?=base_url()?>member/profile/<?=$subs_info->subscriber_id?>"><img src="<?=base_url().FRIENDS_IMAGES.'/'.$subs_info->profile_picture?>" width="58" height="58" alt="subscriber" /></a></div>
                                                        <div class="padding_5top"><a href="<?=base_url()?>member/profile/<?=$subs_info->subscriber_id?>"><?=$subs_info->first_name;?>&nbsp;<?=$subs_info->last_name;?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <? } } else echo "There is no any subscribers yet!";?>
                                       
                                        
                                        <div class="clear"></div>
                                    </div>
                                    <div class="text_right bold"><a href="#">See all</a></div>
                                </div>
                                <div class="borderbottom_gray"></div>
                                <div class="padding_10topbottom">
                                	<div class="bold">Friends (<?=count($mem_friends)?>)</div>
                                    <div class="padding_10topbottom">
                                    	<? 
                                        if(count($mem_friends)>0){
                                        foreach($mem_friends as $friends){?>
                                      
                                        <div class="addsubscriber">
                                        	<div class="addsubscriberInner">
                                            	<div class="text_center">
                                                	<div class="border1_green"><a href="<?=site_url('member/profile/'.$friends->user_id)?>"><img src="<?=base_url().FRIENDS.'/'.$friends->profile_picture?>" alt="<?=$friends->username?>" /></a></div>
                                                    <div class="padding_5top"><a href="<?=site_url('member/profile/'.$friends->user_id)?>"><?=$friends->username?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <? }
                                        }?>
                                                                            
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
                                    	<div><img src="<?=base_url()?>images/down_arrow.jpg" width="18" height="11" alt="arrow" /> <span class="bold">Text reactions: (<?=$count_comments?>)</span></div>
                                    </div>
                                    <div class="comment_titleright">
                                    	<div class="text_right"><a href="#">Add Text Reaction</a></div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div id="comment">
                             <?php //print_r($profile_comments);
                            if(count($profile_comments)>0)
                            { 
                            foreach($profile_comments as $profileComments) { 
                            $like_comment = $this->Member_model->get_profile_comment_like($profileComments->comment_id);
                            $unlike_comment = $this->Member_model->get_profile_comment_unlike($profileComments->comment_id);
                                ?>

                            <div class="padding_10topbottom">
                            	<div>
                                    <div class="comment_name"><a href="#" class="bold"><?=$profileComments->first_name;?>&nbsp;<?=$profileComments->last_name?></a> (<?=date("Y-m-d H:i:s",$profileComments->coment_date)?>)</div>
                                    <div class="comment_reply"><div class="text_center"><a style="cursor:pointer" onclick="javasricpt:$('#reply_<?=$profileComments->comment_id?>').show()">Answer</a> | <a href="#">Spam</a></div></div>
                                    <div class="comment_arrange">
                                        <div class="text_right">
                                            <span id="like_<?=$profileComments->comment_id?>"> <?=$like_comment?> Like </span> <span><a style="cursor:pointer" onclick="like_profile_comment(<?=$profileComments->comment_id?>,1)"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span> <span><a style="cursor:pointer" onclick="like_profile_comment(<?=$profileComments->comment_id?>,0)"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a> </span><span id="unlike_<?=$profileComments->comment_id?>"><?=$unlike_comment?> Unlike </span>
                                        </div>
                                    </div>
                                    
                                    <div class="clear"></div>
                                </div>
                                <div class="padding_10topbottom">
                                	<?=$profileComments->comment?>
                                </div>
                            </div>
                            <div id="reply_comment_<?=$profileComments->comment_id?>">
                            <?php
                            $comment_reply = $this->Member_model->get_reply_comments($profileComments->comment_id);
                            if(count($comment_reply)>0)
                            {
                                foreach($comment_reply as $reply)
                                {

                               $like_comment = $this->Member_model->get_profile_comment_like($reply->comment_id);
                               $unlike_comment = $this->Member_model->get_profile_comment_unlike($reply->comment_id);
                            ?>
                            
                                <div class="borderbottom_gray"></div>
                                <div class="borderleft_5gray">
                                	<div class="content_10box">
                                    	<div>
                                            <div class="comment_subname"><a href="#" class="bold"><?=$reply->first_name;?>&nbsp;<?=$reply->last_name?></a> (<?=date("Y-m-d H:i:s",$reply->coment_date)?>)</div>
                                            <div class="comment_reply"><div class="text_center"><a href="">Answer</a> | <a href="#">Spam</a></div></div>
                                            <div class="comment_arrange">
                                                <div class="text_right">
                                                    <span id="like_<?=$reply->comment_id?>"> <?=$like_comment?> Like </span> <span><a style="cursor:pointer" onclick="like_profile_comment(<?=$reply->comment_id?>,1)"><img src="<?=base_url()?>images/upthumb.jpg" width="15" height="15" alt="up" /></a></span> <span><a style="cursor:pointer" onclick="like_profile_comment(<?=$reply->comment_id?>,0)"><img src="<?=base_url()?>images/downthumb.jpg" width="15" height="15" alt="down" /></a></span><span id="unlike_<?=$reply->comment_id?>"><?=$unlike_comment?> Unlike </span>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="padding_10topbottom">
                                            <?=$reply->comment?>
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
                                            <?php echo $this->pagination->create_links();?>
                                            <div> <span class="bold">Page: <a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a></span></div>
                                        </div>
                                        <div class="comment_titleright">
                                            <div class="text_right"><a href="#">Next</a></div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div><a href="#">Watch all <?=$count_comments?> reactions</a></div>
                            </div>
                        </div>
                        
                        <div class="content_wrap">

                            <form name="reactionform" action="" method="post">
                                <div class="comment_title">
                                    <div class="input_clear">
                                        <div class="font16">Reaction to this Profile</div>
                                        <textarea class="textbox" style="width:350px; height:100px;" id="profile_comment"></textarea>
                                        <input type="hidden" name="friend_id" id="friend_id" value="<?=$this->session->userdata('wannaquiz_user_id')?>" />
                                    </div>
                                    <div class="input_clear">
                                    	<div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Add reaction" name="submit" id="submit_comment" onclick="profile_commit()"/>
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