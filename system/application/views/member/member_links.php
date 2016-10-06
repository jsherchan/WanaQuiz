<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
   <script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script>
    function moderator(id)
    {
        $.prompt('To become a Moderator you must at least create 10 questions.',
         { buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
                $.post('<?=base_url()?>member/moderator_control', {user_id:id} , function(data){
                      console.log(data);
                     if (data != '' || typeof data != undefined || data != null)
                    {
                       if(data=='success')
                        {
                    $.prompt('Do you want to moderate?',{buttons:{ok:true, Cancel:false},callback: function (v,m,f){
              if(v)
              {
                  $.post('<?=base_url()?>member/request_moderator', {user_id:id} , function(data){
                      console.log(data);
                  if (data != '' || typeof data != undefined || data != null)
                    {
                       if(data=='success')
                        {
                            $.prompt('Your request was sent successfully!');
                            $('#moderator_li').html('Update to Moderator <br />(Waiting for admin response)');
                         }
                       else $.prompt('Unable to sent your request');
                    }
                  });
                 return true;
              }
            }
          }
        );
              }
                       else $.prompt('You Have Not Entered 10 Questions');
                    }
                  });  
                }
                }
              });
                
       
       
       
   
  } 
    function partner(id){
     $.prompt('To become a partner you must at least create 10 questions and there are some other requirements. <a href="<?=base_url()?>home/show/partner" target="_blank">Read more</a>',
     { buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
        $.prompt("Do you want to be a partner?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
                var txt = '<input type="hidden" id="member_id" name="member_id" value="'+id+'" />\n\
                            <p>AdSense Code:&nbsp;<textarea name="user_vertical_code" id="" ></textarea></p>\n\
                            <p>Ad. Type: &nbsp;Vertical (160x600)</p> <br />\n\
                            <p>AdSense Code:&nbsp;<textarea name="user_rectangular_code" id="" ></textarea></p>\n\
                            <p>Ad. Type: &nbsp; Rectangular (300x250)</p>';

                jqistates = {
                    state0: {
                        html: txt,
                        focus: 1,
                        buttons: { Send: true, Cancel: false },
                        submit: function(v, m, f){
                            var e = "";
                            if (v) {
                                if (e == "") {
                                    var id=f.member_id;
                                    var vertical_code = f.user_vertical_code;
                                    var rectangular_code = f.user_rectangular_code;
                                    var ad_type = f.ad_type;
                                    if(vertical_code!="" && rectangular_code!=""){

                                        $.post('<?=base_url()?>member/upgradePartner', {user_id:id,user_vertical_code:vertical_code,user_rectangular_code:rectangular_code,ad_type:ad_type} , function(data){
                                            if (data != '' || typeof data != undefined || data != null)
                                            {
                                                if(data=='success')
                                                {
                                                    $.prompt('Your request was sent successfully!');
                                                    $('#partner_li').html('Update to Partner (Waiting for admin response)');
                                                }
                                                else $.prompt('error');
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
        }});
        }
        }});

    }
</script>
<div class="leftside">
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="greentitlebg_leftborder"></div>
                <div class="greentitlebg_bg" style="width:178px;">
                    <div class="bold font14 color_white">Member panel</div>
                </div>
                <div class="greentitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div id="smoothmenu2" class="ddsmoothmenu-v">
                    <ul>
                        <li><a href="<?=site_url($this->session->userdata('wannaquiz_username'))?>" class="helpselected">Public profile</a></li>
                        <li><a href="<?=site_url('member/updatePublicprofile')?>" class="">Update profile</a></li>
                        <li><a href="javascript:void(0);">Upload new content</a>
                            <ul>
                                <li><a href="<?=site_url('member/uploadPhoto')?>" class="helpselected">Photo Content</a></li>
                                <li><a href="<?=site_url('member/uploadVideo')?>">Video Content</a></li>                                
                            </ul>
                        </li>
                        <li><a href="#">Make quiz questions</a>
                            <ul>
                                <li><a href="<?=site_url('member/addPhotoQuestion')?>" class="helpselected">Make photo questions</a></li>
                                <li><a href="<?=site_url('member/addVideoQuestion')?>">Make video questions</a></li>                                
                            </ul>
                        </li>
                        <li><a href="#">My uploaded questons</a>
                            <ul>
                                <li><a href="<?=site_url('member/viewQuestions/photo')?>" class="helpselected">My photo questions</a></li>
                                <li><a href="<?=site_url('member/viewQuestions/video')?>">My video questions</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Mail</a>
                            <ul>
                                <li><a href="<?=site_url('member/message/0')?>" class="helpselected">Received messages</a></li>
                                <li><a href="<?=site_url('member/message/1')?>">Sent messages</a></li>
                            </ul>
                        </li>

                        <li><a href="<?=site_url('member/friendList')?>">Manage Friend-list</a></li>
                        <li><a href="<?=site_url('member/playlist')?>">Playlists</a></li>
                        <li><a href="<?=site_url('member/favourites')?>">Favorites</a></li>
                        <li><a href="<?=site_url('member/referFriends')?>">Refer Friends</a></li>
                        <li><a href="<?=site_url('gameboard')?>">Gaming Board</a></li>
                        
                        <?php if($mem_info->user_type==0){ ?>
                       
                        <li id ="moderator_li">
                        <?php $check_moderator = $this->Member_model->check_user_moderator($this->session->userdata('wannaquiz_user_id'));
                        $check_request = $this->Member_model->check_moderator_request($this->session->userdata('wannaquiz_user_id'));                                                                        
                        if($check_request['delete']=='1')
                        {echo "You Can Not Moderate"; } 
                        else{
                            if(!$check_moderator){
                                    if($check_request){ 
                                        if($check_request['active']=='-1'){
                                               ?>
                                                Blocked For Moderator
                                                <?}else {?>
                                                Update to Moderator <br />(Waiting for admin response)
                                                <? } } 
                                      else { ?>
                                                <a href="#" onclick="moderator(<?=$this->session->userdata('wannaquiz_user_id')?>)" id="moderator">Update to Moderator</a>
                                                <? }
                          } else 
                              {?>
                                <a href="<?=site_url('moderator_management')?>">Go To Moderator </a> 
                             <?}}?>
                        </li> 
                        
                        <li id="partner_li" >
                        <?php $check_partner = $this->Member_model->check_user_partner($this->session->userdata('wannaquiz_user_id'));
                            //print_r($check_partner); echo "hello";
                            if(!$check_partner){
                        ?>
                        <a href="#" onclick="partner(<?=$this->session->userdata('wannaquiz_user_id')?>)">Update to Partner</a>
                        <? } elseif($check_partner->active=='0') { ?>
                        Update to Partner (Waiting for admin response)
                        <? } else{?>
                       You are a Partner
                        <?} ?>
                        </li>
                        <?} ?>
                        <li><a href="<?=site_url('forum')?>">Forum</a>
                    </ul>
                    <div class="borderbottom_dotted"></div>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
    <?
    if($mem_info->user_type!='0') {?>
    <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="greentitlebg_leftborder"></div>
                <div class="greentitlebg_bg" style="width:178px;">
                    <div class="bold font14 color_white">Advertiser</div>
                </div>
                <div class="greentitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div class="help_links">
                    <div id="smoothmenu2" class="ddsmoothmenu-v">
                        <ul>
                            <li><a href="#">Start a new campaign</a>
                                <ul>
                                    <li><a href="<?=site_url('member/addVideoQuestion')?>" class="helpselected">New video Campaign</a></li>
                                    <li><a href="<?=site_url('member/addPhotoQuestion')?>">New photo Campaign</a></li>
                                </ul>
                            </li>
                            <!--<li><a href="<?=site_url('member/quizView')?>">Balance</a></li>-->
                            <li><a href="<?=site_url('member/report')?>">Reports</a></li>
                            <li><a href="<?=site_url('member/transaction')?>">My Transactions</a></li>
                            <!--<li><a href="<?=site_url('member/advertisements')?>">My Advertisements</a></li>-->
                        </ul>
                    </div>
                    <div class="borderbottom_dotted"></div>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
    </div>
   
   <?}?>
</div>