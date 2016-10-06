<?#=var_dump(get_defined_vars())?>
<?#=$filter.'=f'?>
<script>
    function hide_text(_field, _default, _current) {
      if (_default == _current) {
        _field.value='';
      }
    }
<?php if($this->session->userdata('wannaquiz_user_id')) { ?>
    function filter_content()
    {
        var uid = <?=$this->session->userdata('wannaquiz_user_id')?>;
        var val = $('#stat').html(); // get current status
        var a = (val=='On') ? 'Off' : 'On'; // toggle status ( to show change )
        var s = "<?=base_url()?>images/ad_" + val.toLowerCase() + ".png";
        var t = "Turn " + val + " Adult Content ?";
        
        var u = "<br /><b>You must be 18 Years old to view Adult Content</b><br />";
         u +="<p style='font-weight:normal;padding-top:5px; width:400px;'>There is no nudity allowed on WannaQuiz.<br/>Adult content is e.g. a quiz about the show <br/>'Sex and the City' or questions about scary subjects.</p>";
         u +="<a href='<?php echo base_url()?>home/show/age_appropriate'><br/>Read More<br/></a>";
        
        u += t;
        //t = t.replace(val,a);
        
        if(a=='Off') t = u;

        $.prompt( 
            t ,
            //{buttons:{Ok:true,Cancel:false} ,
            { buttons: { Continue: true, Cancel: false } ,
            callback: function(v,m,f)
                { 
                    if(v) 
                    { 
                        $.post
                        (
                                '<?=base_url()?>quiz/filter_content', 
                                {user_id:uid , filter:a}, 
                                function(data)
                                {
                                    if(data)
                                    {
                                       //console.log(data);
                                       //return;
                                        $('#filter').attr('alt',a)
                                                    .attr('src',s)
                                                    .attr('t',t);
                                        $('#stat').html(a);
                                        
                                        location.reload();
                                    }
                                }
                        );
                    } 
                }
            }
        );        
    }
<? } else { ?>
function filter_content()
    {        
        var t = "<b>You must be a member to view adult Adult Content !</b><br />";
         t +="<p style='font-weight:normal;padding-top:5px; width:400px;'>There is no nudity allowed on WannaQuiz.<br/>Adult content is e.g. a quiz about the show <br/>'Sex and the City' or questions about scary subjects.</p>";
         t +="<a href='<?php echo base_url()?>home/show/age_appropriate'><br/>Read More<br/></a>";
          t += "<p stype='padding-top:5px;'>Do you want to Register ?</p>";
        
        $.prompt( 
            t ,
            {buttons:{Continue:true,Cancel:false} ,
            callback: function(v,m,f) { if(v) { window.location = "<?=base_url()?>/registration";
 } }
            }
        );
        
    }
    <? } ?>

  </script>
<div class="headerloggedin_bg">
	<div id="header_wrap">
    	<div>
            <div class="headerloggedin_left">
              <div class="headerloggedin_logo"><a href="<?=base_url()?>">WannaQuiz</a></div>
            </div>
            <div class="headerloggedin_right">
                <div class="headerloggedin_linksbox">
                    <div class="headerloggedin_linksboxInner">
                    	<form name="searchloggedin" action="<?=base_url()?>quiz/search" method="post">
                            <div class="header_links">
                                <ul>
                                    <li>
                                        <img id="search_help" class="search_help" 
                                     src="<?=base_url()?>/images/help.png" 
                                     style="float:left; margin-top:0px; cursor:pointer; margin-right:10px;" 
                                     onclick ="$('#helpnote').slideDown('slow');" 
                                        />
                                    <div id="helpnote" class="close__" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:33px; left:444px; background-color:#F0F0F0; line-height:1.4em; color: #000;">
                                         <p style="text-align:right; color:blue; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001" class="close_help" onclick="$('#helpnote').hide('slow');"> X </p>
                                         <p><strong style="color:blue; font-weight:bold;">On: </strong>Age Filter is On ( no Adult content )</p><br>
                                         <p><strong style="color:blue; font-weight:bold;">Off: </strong>Age Filter is Off ( Adult content included )</p><br>
                                         <p>There is no nudity allowed on WannaQuiz.<br> 
                                           Adult content is e.g. a quiz about the show “Sex</br> 
                                          and the City” or questions about scary subjects.
                                        </p><br>
                                         <div><a href="<?=base_url()?>home/show/age_appropriate"><p style="color:blue;">Read more</p></a></div>
                                     </div>
                                    </li>
                                    <?
                                     $uid = $this->session->userdata('wannaquiz_user_id');
                                       $mem_info=$this->Member_model->get_member($uid);
                                      $filter= $mem_info->filter_adult;
                                      if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
                                       else $this->session->unset_userdata('filtered');
                                       
                                    if($this->session->userdata('wannaquiz_user_id')) { ?>
                                    
                                        <? if($filter=='1'|| $this->session->userdata('guest_filter')=='1') $v = 'On'; else $v = 'Off';?>
                                        <? $s = ($v=='On') ? 'off' : 'on'; ?>
                                        
                                        <li>
                                            <a href="#" onclick="filter_content();" style="text-decoration: none;">
                                                <b id="stat"><?=$v?></b>                                            
                                                <img id="filter" src="<?=base_url()?>images/ad_<?=$s?>.png" title="Filter Adult Content" alt="<?=ucwords($v)?>" />
                                            </a>
                                        </li>
                                    <? } else { ?>
                                        <li>
                                            <a href="#" onclick="filter_content();" style="text-decoration: none;">
                                                <b id="stat">On</b>
                                                <img id="filter" src="<?=base_url()?>images/ad_off.png" title="Filter Adult Content" alt="Off" />
                                            </a>
                                        </li>
                                    <? } ?>
                                    <li class="header_links_separator">&nbsp;</li>
                                	<li>
                                            <input type="text" class="textbox_headersearch" name="search" value="Search for ..." onclick="$(this).val('');" onblur="if($(this).val()=='') $(this).val('Search for ...');" style="width:115px; height:16px;" id="search" />                                            
                                        </li>                                	
                                	<li>
                                            <a href="#" class="bold"><input type="submit" name="submit" class="loggedinsearch" value="Search" onclick="if($('#search').val()=='Search for ...') $('#search').val('');" /></a> |                                            
                                        </li>                                    
                                    <li>
                                        <a href="<?=site_url('member/userHome')?>" class="signup">
                                        <? 
                                        if($this->session->userdata('wannaquiz_fb_id'))
                                        {
                                            if(strlen($this->session->userdata('first_name'))>10) 
                                                echo substr($this->session->userdata('first_name'),0,8).'...'; 
                                            else echo $this->session->userdata('first_name');
                                        }
                                        else if($this->session->userdata('wannaquiz_tw_id'))
                                        {
                                            if(strlen($this->session->userdata('first_name'))>10) 
                                                echo substr($this->session->userdata('first_name'),0,8).'...'; 
                                            else echo $this->session->userdata('first_name');
                                        }
                                        else if(!$this->session->userdata('wannaquiz_fb_id') && !$this->session->userdata('wannaquiz_tw_id') && $this->session->userdata('wannaquiz_username'))
                                        { 
                                            if(strlen($this->session->userdata('wannaquiz_username'))>10) 
                                                echo substr($this->session->userdata('wannaquiz_username'),0,8).'...'; 
                                            else echo $this->session->userdata('wannaquiz_username');                                                
                                        }  
                                        
                                        else echo "Userarea";?></a> | </li>
                                    <?php
                                    if($this->session->userdata('wannaquiz_user_id')!=''){
                                    $user_playlist = $this->Quiz_model->get_playlists($this->session->userdata('wannaquiz_user_id'));
                                            $playlist_count = count($user_playlist); }
                                        else $playlist_count = 0;
                                        ?>
                                    <li><a href="<?=site_url('member/playlist')?>">Playlist (<?=$playlist_count?>)</a> | </li>
                                    <li><? if($this->session->userdata('wannaquiz_user_id')==''){?><a href="<?=site_url('home/login')?>">Login</a><? } else {?><a href="<?=site_url('home/logout')?>">Logout</a> <? }?>| </li>
                                      <li> 
                                          <?php $check_moderator = $this->Member_model->check_user_moderator($this->session->userdata('wannaquiz_user_id'));
                                            $check_delete=$this->Member_model->check_delete($this->session->userdata('wannaquiz_user_id'));
                                         if($check_delete['delete']=='1'){
                                             echo "You Can Not Moderate";
                                         }
                                         else{
                                           if($check_moderator)
                                          {?>
                                            <a href="<?=site_url('moderator_management')?>">Moderator</a> | </li>
                                          <?}}?>
                                         <li><a href="<?=site_url('home/help_center')?>">Help <img src="<?=base_url()?>images/sitemap_icon.jpg" width="12" height="12" alt="sitemap" /></a> | </li>
                                    <?php if($this->session->userdata('wannaquiz_user_id')!='') { ?>
                                    <?php $this->load->helper('general_helper');?>
                                    <li><a href="<?=site_url('member/message/0')?>"><img src="<?=base_url()?>images/mail_icon.jpg" width="16" height="13" alt="mail" /> Mail (<?php if($this->Member_model->get_new_messages()!='') echo $this->Member_model->get_new_messages(); else echo 0;?>)</a>  </li>
                                    <? }?>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        	<div class="clear"></div>
        </div>
        <div>
        	<div class="headerloggedin_nav">
                <div class="ddsmoothmenu" id="smoothmenu1">
                    <ul>
                        <li><a href="<?=site_url('')?>">Home</a></li>
                        <li <? if(isset($nav) && $nav=='howitworks'){?> class="navselected" <? }?>><a href="<?=site_url('page/howitworks')?>">How it works</a>
                            <ul>
                                <li><a href="<?=base_url()?>home/show/single_player_game">Play a game</a></li>
                                <li><a href="<?=base_url()?>home/show/video_question">Make a video question</a></li>
                                <li><a href="<?=base_url()?>home/show/photo_question">Make a photo question</a></li>
                            </ul>
                        </li>
                        <?php if($this->session->userdata('wannaquiz_user_id')==''){?>
                        <li <? if(isset($nav) && $nav=='register' ){?> class="navselected" <? }?>><a href="<?=site_url('registration')?>">Signup</a>
                            <!--<ul>
                                <li><a href="<?=site_url('registration/regular')?>">Register as regular user</a></li>
                                <li><a href="<?=site_url('registration/advertiser')?>">Register as advertiser</a></li>
                              
                            </ul>-->
                        </li>
                        <?}?>
                         <?php if(!$user_type){?>
                     <li <? if(isset($nav) && $nav=='content'){?> class="navselected" <? }?>><a href="">Browse </a>
                        <ul>
                            <li><a href="<?=site_url('quiz/category/regular')?>">Regular Users</a></li>
                            <li><a href="<?=site_url('quiz/category/advertiser')?>">Sponsors</a></li>
                        </ul>
                    </li>
                       
                   <?}else {?>
                    
                     <li <? if(isset($nav) && $nav=='content'){?> class="navselected" <? }?>>
                      <a href="<?=site_url('quiz/category/'.$user_type)?>">
                    <?if($user_type=='advertiser')echo "Sponsor";
                         else echo "Regular"; ?></a>
                         <ul>
                      <li>
                           <?if($user_type=='advertiser'){?> <a href="<?=site_url('quiz/category/regular')?>">Regular</a> <?}else{?>
                           <a href="<?=site_url('quiz/category/advertiser')?>">Sponsors</a> <?}?>
                           
                      </li>
                  </ul>
                  </li>   
                   
                     <?}?>
                    
                        <li <? if(isset($nav) && $nav=='faq'){?> class="navselected" <? }?>><a href="<?=site_url('home/help_center/faq')?>">FAQ</a></li>
                        <li <? if(isset($nav) && $nav=='advertise'){?> class="navselected" <? }?>><a href="<?=site_url('home/help_center/advertise')?>">Advertise</a></li>                                                
                        <div class="clear"></div>
                    </ul>
                </div>
            </div>
            
            <div class="headerloggedin_upload" style="width:250px;margin-top: 24px;margin-left: 85px;">
                <? #$this->load->view('addthis'); ?>
            </div>
            <div class="clear"></div>
        </div>        
        
    </div>
</div>