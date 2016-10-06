<script>
    function hide_text(_field, _default, _current) {
      if (_default == _current) {
        _field.value='';
      }
    }
  </script>
<script type="text/javascript">
$(document).ready(function () { 
    $("#search_help").click(function(){
    $("#helpnote").slideToggle(200);
});

$(".close_help").click(function(){
         $(".close").hide();
     })
});

function filter_content()
    {        
        var t = "<b>You must be a member to view adult content !</b><br />";
        t += "Do you want to Register ?";
        
        $.prompt( 
            t ,
            {buttons:{Continue:true,Cancel:false} ,
            callback: function(v,m,f) { if(v) { window.location = "<?=base_url()?>registration";
 } }
            }
        );
        
    }

</script>
<div class="header_bg" style="position:relative; z-index:0;">
	<div id="header_wrap">
    	<div>
            <div class="header_left">
                <div class="header_logo">
                    <div class="logo"><a href="<?=site_url()?>">WANNA QUIZ</a></div>
                </div>
                
                <div class="header_quote">
                    <div class="header_quoteInner"><img src="<?=base_url()?>images/header_quote.jpg" width="255" height="27" alt="quote" /></div>
                </div>
                
                <div class="clear"></div>
            </div>
            <div class="header_right">
                <div class="header_linksbox">
                    <div class="header_linksboxInner">
                        <div class="header_links">
                            <ul>
                                <li><a href="<?=site_url('registration')?>" class="signup">Signup</a> | </li>
                                <li><a href="<?=site_url('member/playlist')?>">Playlist (0)</a> | </li>
                                <li><a href="<?=site_url('home/login')?>">Login</a> | </li>
                                
                                <li><a href="<?=site_url('home/help_center')?>">Help <img src="<?=base_url()?>images/sitemap_icon.jpg" width="12" height="12" alt="sitemap" /></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
        	<div class="clear"></div>
        </div>
            
        <div>
        	<div class="ddsmoothmenu" id="smoothmenu1">
            	<ul>
                	<li class="navselected"><a href="<?=site_url('')?>">Home</a></li>
                    <li <? if(isset($nav) && $nav=='howitworks'){?> class="navselected" <? }?>><a href="<?=site_url('page/howitworks')?>">How it works</a>
                    	<ul>
                           <li><a href="<?=base_url()?>page/howitworks">Play game</a></li>
                                <li><a href="<?=base_url()?>page/howitworks/making_video_question">Make video question</a></li>
                                <li><a href="<?=base_url()?>page/howitworks/making_photo_question">Make photo question</a></li>
                        </ul>
                    </li>
                 
                    <li <? if(isset($nav) && $nav=='register'){?> class="navselected" <? }?>><a href="<?=site_url('registration')?>">Signup</a>
                    </li>
                    <li <? if(isset($nav) && $nav=='content'){?> class="navselected" <? }?>><a href="">Browse</a>
                        <ul>
                            <li><a href="<?=site_url('quiz/category/regular')?>">Regular Users</a></li>
                            <li><a href="<?=site_url('quiz/category/advertiser')?>">Sponsors</a></li>
                        </ul>
                    </li>
                    <li <? if(isset($nav) && $nav=='faq'){?> class="navselected" <? }?>><a href="<?=site_url('home/help_center/faq')?>">FAQ</a></li>
                    <li <? if(isset($nav) && $nav=='advertise'){?> class="navselected" <? }?>><a href="<?=site_url('home/help_center/advertise')?>">Advertise</a></li>                    
                    <div class="clear"></div>
                </ul>
            </div>            
        </div>

        <div class="headersearchbox_align">
        	<div class="search_left">
            	<div class="searchbox_leftborder"></div>
                <div class="searchbox_bg" style="width: 385px">
                	<div class="search_leftbgInner" style="padding-right: 0; position:relative">
                            <img id="search_help" class="search_help" 
                                 src="<?=base_url()?>/images/help.png" 
                                 style="float:left; margin-top:0px; cursor:pointer; margin-right:10px;" 
                                 onclick ="$('#helpnote').slideDown('slow');" 
                            />
                                <div id="helpnote" class="close" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:100px; background-color:#F0F0F0; line-height:1.4em">
                                     <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer; position:relative; z-index:10001" class="close_help" onclick="$('#helpnote').hide('slow');"> X </p>
                                     <p><strong>On: </strong>Age Filter is On ( no Adult content )</p><br>
                                     <p><strong>Off: </strong>Age Filter is Off ( Adult content on )</p><br>
                                     <div><a href="<?=base_url()?>home/show/ages">Read more</a></div>
                                 </div>

                                <? if($this->session->userdata('guest_filter')=='1') $v = 'On'; else $v = 'Off';?>
                                <? $s = ($v=='On') ? 'off' : 'on'; ?>
                                      
                                <a href="#" onclick="filter_content();" style="text-decoration: none;">
                                    <b id="stat"><?=$v?></b>
                                    <img id="filter" src="<?=base_url()?>/images/ad_<?=$s?>.png" title="Filter Adult Content" alt="<?=ucwords($v)?>" />                                    
                                </a>
                            
                            <form name="search" action="<?=base_url()?>quiz/search" method="post" style="float:right;width:277px;margin-left:20px;">
                            <div class="headersearch_input">
                                <input type="text" name="search" class="textbox_headersearch" value="Search for ..." id="search" onclick="$(this).val('');" onblur="if($(this).val()=='') $(this).val('Search for ...');" style="width:200px;" />
                            </div>
                            <div class="headersearch_btn" style="width:57px; margin-right:0;">
                            	<div class="searchbtn_leftborder"></div>
                                <input type="submit" onclick="if($('#search').val()=='Search for ...') $('#search').val('');" class="searchbtn_bg" value="Search" />                                
                                <div class="searchbtn_rightborder"></div>
                            </div>                            
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
                <div class="searchbox_rightborder"></div>
                <!--div align="center">
                    <div id="fb-root"></div>
                  <script src="http://connect.facebook.net/en_US/all.js"></script>
                  <script>
                     FB.init({
                        appId:'< ?=facebook_app_id?>', cookie:true,
                        status:true, xfbml:true
                     });
                  </script>
                <fb:login-button>Login</fb:login-button>
            <br /><br/>                        
                </div-->
                <div class="clear"></div>
            </div>
            
            <div style="float: right;width:240px;">
            	<div class="searchbox_leftborder"></div>
                <div class="searchbox_bg">
                	<div class="search_rightbgInner">
                    	<div style="width:140px;">
                        	<? $this->load->view('addthis'); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="searchbox_rightborder"></div>
                
                <div class="clear"></div>
                 
            </div>
            
            <div class="clear"></div>
        </div>
        
    </div>
</div>