<script>
function block(friend_id) {
    $.post('<?=base_url()?>member/blockFriend', {friendID:friend_id} , function(data)
	{
			   if (data != '' || data != undefined || data != null)
			   {
			  		dt=data.split('|');

				// $('#change_password_div').html(dt[2]);
                               // alert(dt[0]);alert(dt[1]);
				 if(dt[0]=='success')
                                     {//alert('yes');
				 	 $('#status_'+friend_id).html(dt[1]);
                                     }

				else{
					$('#error_message').html(dt[0]);
				}
				//$.prompt(dt[0]);
			   }

     });
}

function unblock(friend_id) {
    $.post('<?=base_url()?>member/unblockFriend', {friendID:friend_id} , function(data)
	{
			   if (data != '' || data != undefined || data != null)
			   {
			  		dt=data.split('|');

				// $('#change_password_div').html(dt[2]);
                               // alert(dt[0]);alert(dt[1]);
				 if(dt[0]=='success')
                                     {//alert('yes');
				 	 $('#status_'+friend_id).html(dt[1]);
                                     }

				else{
					$('#error_message').html(dt[0]);
				}
				//$.prompt(dt[0]);
			   }

     });
}


</script>
<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">Friend List</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<div class="content_10box">
                                	Block persons; no messages from these person will be received and the person is not able to write on the user's personal wall.
                                </div>
                                sdfsdfsdfsd
                                <div class="content_wrap">
                                    <?php
                                    //print_r($friend_list);
                                    if(count($friend_list)>0)
                                    {
                                    foreach($friend_list as $friends)
                                    {//echo $friends->friend_id;
                                     $mem_profile = $this->Member_model->get_member_profile($friends->friend_id);
                                     //print_r($mem_profile);
                                     //echo $mem_profile->profile_picture;
                                    ?>
                                    <div class="blockbox_left">
                                        <div class="content_10box">
                                            <div class="border_gray">
                                                <div class="bg_graygradient">
                                                    <div class="blockbox_height">
                                                        <div class="content_10box">
                                                            <div class="blocked_img">
                                                                <div class="border1_green">
                                                                    <?
                                                                        if(isset($this->session->userdata('wannaquiz_fb_id'))||isset($this->session->userdata('wannaquiz_tw_id')))
                                                                            $img = $mem_profile->profile_picture;
                                                                        else
                                                                            $img = base_url() . 'user_profile_images/' . $mem_profile->profile_picture;
                                                                    ?>
                                                                    <a href="<?=base_url()?><?=$friends->username;?>"><img src="<?=$img?>" width="88" height="88" /></a>                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="blocked_detail">
                                                                <div class="bold"><?=$friends->username;?></div>
                                                                <div><?=$mem_profile->gender;?>, <?=date("Y-m-d",$date)-date("Y-m-d",$mem_profile->dob);?></div>
                                                                <div id="error_message"></div>
                                                                <div class="blockicon_align" id="status_<?=$friends->friend_id?>">

                                                                        <?php if($friends->block == 1) // status 1 is blocked
                                                                        {?>
                                                                    <div class="unblock_icon" >
                                                                        <a style="cursor:pointer" onclick="unblock(<?=$friends->friend_id?>)">
                                                                            Unblock
                                                                        </a>
                                                                    </div>
                                                                        <?php } else {?>
                                                                    <div class="block_icon" >
                                                                        <a style="cursor:pointer" onclick="block(<?=$friends->friend_id?>)">
                                                                            Block
                                                                        </a>
                                                                    </div>
                                                                        <? }?>

                                                                </div>
                                                            </div>
                                                            
                                                            <div class="clear"></div>
                                                           
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }} else {?>
                                    <div class="content_10box">
                                	There is no any friends in your list!
                                </div>
                                    <? }?>
                                   
                                    <div class="clear"></div>
                                </div>
                                <!--<div class="content_10box">
                                	<div class="searchbtn_leftborder"></div>
                                    <div class="searchbtn_bg" style="padding:0 20px;"><a href="#">Save</a></div>
                                    <div class="searchbtn_rightborder"></div>
                                    
                                    <div class="clear"></div>
                                </div>-->
                            </div>
                            <div>
								<?php echo $this->pagination->create_links();?>
                               </div>
                        </div>

                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>