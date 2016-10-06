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
	$("#<?=$message_info->id?>").click(function(){

	var element = $(this);
	var Id = element.attr("id");
	
	var test = $("#textboxcontent"+Id).val();
	var dataString = 'textcontent='+ test + '&com_msgid=' + Id;
	var mail_id='<?=$message_info->id?>';
	var fren_id=$("#friend_id").val();
	if(test=='')
	{
	alert("Please Enter Some Text");
	}
	else{
			$("#flash"+Id).show();
			$("#flash"+Id).fadeIn(400).html('<img src="<?=base_url()?>images/ajax-loader.gif" align="absmiddle"> loading.....');
			
			$.post('<?=base_url()?>member/replyMessage', {id:fren_id,message:test,mail_id:mail_id} , function(data){			
				 if (data != '' || data != undefined || data != null) 
				 {	
					  $("#loadplace"+Id).append(data);
					  $("#flash"+Id).hide();												
				 }
			 });	
		}

		return false;
		});
	
	$("#delete_message").click(function(){
             $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
		var mail_id='<?=$message_info->id?>';
                //alert(mail_id); return false;
		
		$.post('<?=base_url()?>member/deleteMessage', {mail_id:mail_id} , function(data){
				 if (data != '' || data != undefined || data != null) 
				 {	
																
				 }
			 });	
		 document.location.href='<?=base_url()?>'+'member/message/0';
                 }}});
	});
	
        $('#accept_request').click(function(){
            var friend_id = <?=$message_info->user_id;?>;
            $.post('<?=base_url()?>member/addFriend', {friend_id:friend_id} , function(data){
                 if (data != '' || data != undefined || data != null)
                 { 
                     dt=data.split('|');
                     if(dt[0]=='Friend added')
                         {
                             $.prompt("You are now friends with "+dt[1]);
                             $('#friend').hide();
                         }
                 }
                 });
        });

});

function hide_text(id){
    $('#textboxcontent'+id).html('');
}
</script>

<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">My mail</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<div class="content_10box">
                                	<div class="bold"><?php echo $msg?></div>
                                        
                                        <?php if($msg=="Received Message" && $message_info->recipient_id==$this->session->userdata('wannaquiz_user_id') || $message_info->recipient_delete_flag!=1){ ?>
                                    <div class="padding_10topbottom">
                                    	<div><a href="javascript:void(0);" id="delete_message">Delete this message</a></div>
                                        <?
                                       //echo $friend_status;
                                        if($message_info->subject=="Friend request" && $friend_status =="not added"){?>
                                           <div align="right" style="margin-top:-20px" id="friend">
                                            <div class="searchbtn_leftborder" style="margin-left:375px"></div>
                                            <input id="accept_request" class="searchbtn_bg" type="button" value="Accept Request" name="accept"/>
                                            <div class="searchbtn_rightborder"></div>
                                            <div class="clear"></div>
                                        </div>
                                        <? } ?>
                                        <div class="padding_10topbottom">
                                            <div class="bg_blue">
                                                <div class="content_10box">
                                                <div class="content_wrap">
                                                <div class="editwall_img">
                                                <?
                                               
                                                if($message_info->profile_picture!=""){?>
                                                       <img src="<?=base_url().FRIENDS.'/'.$message_info->profile_picture?>" alt="avatar" /> <? } else {?>
                                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="58" height="58" alt="avatar" /><? }?>
                                                </div>
                                                <div class="readmail_desc">
                                                    <div>
                                                    <div class="border_gray">
                                                        <div class="bg_white">
                                                        <div class="wallarrow"><img src="<?=base_url()?>images/arrow_point.png" width="11" height="9" alt="arrow" /></div>
                                                        <div class="content_10box">
                                                            <div> <span class="bold"><a href="<?=base_url()?><?=$message_info->username?>" class="color_gray"><?=$message_info->username?></a></span> <span class="font10">| <?=date('d F Y,H:i a',$message_info->created)?></span> </div>
                                                            <div class="padding_10topbottom">
                                                                <?php if($msg="Sent Message" && $message_info->subject=="Friend request")
                                                                  echo "You want to be friends with  ".$receiver_username->username." !";else     
                                                             echo nl2br($message_info->content)?>
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                    
                                                   
                                                </div>
                                                
                                                <div class="clear"></div>
                                                </div>
                                             
                                             <? if($message_info->username != 'admin') {
                                                 if($reply_list!=NULL){
												  foreach($reply_list as $reply){
												 ?>   
                                                <div class="content_wrap">
                                                <div class="editwall_img">
                                                <? if($reply->profile_picture!=""){?>
                                                       <img src="<?=base_url().FRIENDS.'/'.$reply->profile_picture?>" alt="avatar" /> <? } else {?>
                                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="58" height="58" alt="avatar" /><? }?>
                                                </div>
                                                <div class="readmail_desc">
                                                    <div>
                                                    <div class="border_gray">
                                                        <div class="bg_white">
                                                        <div class="wallarrow"><img src="<?=base_url()?>images/arrow_point.png" width="11" height="9" alt="arrow" /></div>
                                                        <div class="content_10box">
                                                            <div> <span class="bold"><a href="<?=base_url().$reply->username?>" class="color_gray"><?=$reply->username?></a></span> <span class="font10">| <?=date('d F Y,H:i a',$reply->created)?></span> </div>
                                                            <div class="padding_10topbottom">
                                                             <?=nl2br($reply->content)?>
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                 
                                                </div>
                                                
                                                <div class="clear"></div>
                                                </div>
                                             <? }
											 } ?>
                                                 <div  id="loadplace<?=$message_info->id?>" ></div>
                                                 <div id="flash<?=$message_info->id?>" class='flash_load'></div>
                                                
                                                <div class="content_wrap">
                                                <div class="editwall_img">
                                                &nbsp;
                                                </div>
                                                <div class="readmail_desc">
                                                                                                     
                                                    <div class="padding_5top" id="slidepanel<?=$message_info->id?>">
                                                                <form name="writewall" action="" method="post">
                                                                    <textarea class="textbox" style="width:400px; height:50px;" id="textboxcontent<?=$message_info->id?>" onclick="hide_text('<?=$message_info->id?>')">Write...</textarea>
                                                                    <input type="hidden" name="friend_id" id="friend_id" value="<?=$message_info->user_id?>" />
                                                                    <div>
                                                                        <div style="float:right; width:auto;">
                                                                            <div class="input_clear">
                                                                                <div>
                                                                                    <div class="searchbtn_leftborder"></div>
                                                                                    <input type="button" class="searchbtn_bg" name="savebtn" value="Reply" id="<?=$message_info->id?>"/>
                                                                                    <div class="searchbtn_rightborder"></div>
                                                                                    
                                                                                    <div class="clear"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                </div>
                                                
                                                <div class="clear"></div>
                                                </div>
                                                 <? }?>
                                            </div>
                                            </div>
                                        </div>
                                        <div><a href="javascript:void(0);" id="delete_message">Delete this message</a></div>
                                    </div>
                                     <? } else {?>
                                        <div>You don't have right to read this message!!! </div>
                                        <? } ?>
                                </div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>