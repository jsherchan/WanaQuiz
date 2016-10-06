<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<script type="text/javascript">
$(document).ready(function()
{
	$("#delete_messages").click(function(){
	var tt='';
	for (var i=0;i<document.sentmsg.elements.length;i++)
	{
		var e=document.sentmsg.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox') )
		{
			if(e.checked)
			tt=e.value+','+tt;
		}
	}
	if(tt=="")
		alert('please check the mesage');
	else{
		$.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                $.post('<?=base_url()?>member/deleteBulkMessages/sent', {ids:tt} , function(data){
					 if (data != '' || data != undefined || data != null) 
					 {	
						 $('#list').html(data);
					 }
				 });
			}}});
		}	
	});
										 
});

function checkAll()
{
	for (var i=0;i<document.sentmsg.elements.length;i++)
	{
		var e=document.sentmsg.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.sentmsg.allbox.checked;
		}
	}
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
                            	<form name="sentmsg" action="" method="post">
                                	<div class="content_10box">
                                		<div class="bold">Sent Message</div>
                                                 <?php if($message_info->user_id==$this->session->userdata('wannaquiz_user_id') || $message_info->user_delete_flag!=1){?>
                                        <div class="content_10box">
                                           
                                            <div>
                                                <div class="padding_2bottom">
                                                    <div class="bg_blue">
                                                    	<div class="bold">
                                                        	<div class="msg_checkbox"><input type="checkbox" value="on" name="allbox" onClick="checkAll();"  /></div>
                                                        	<div class="msg_from">To</div>
                                                            <div class="msg_subject">Subject</div>
                                                            <div class="msg_date">Date</div>
                                                            <div class="msg_new">&nbsp;</div>
                                                        
                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="list">
                                                 <? if($message_list!=NULL){
													foreach($message_list as $msg){
													?>
                                                <div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                    	<div>
                                                        	<div class="msg_checkbox"><input type="checkbox" id="mailids" name="mailids[]" value="<?=$msg->id;?>"/></div>
                                                        	<div class="msg_from">
                                                                    <?php echo $this->Member_model->get_sender_receiver($msg->id,1);?>
                                                                </div>
                                                            <div class="msg_subject"><a href="<?=site_url('member/messageDetail/'.$msg->id)?>"><?=$msg->subject?></a></div>
                                                            <div class="msg_date"><?=date('Y-m-d',$msg->created)?></div>
                                                            <div class="msg_new">&nbsp;</div>
                                                        
                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <? } }else{?>
                                               <div>No messages found!</div>
                                              <? }?>
                                                </div>
                                                
                                            </div>
                                            <div><a href="javascript:void(0);" id="delete_messages">Delete Selected</a></div>
                                        </div>
                                        <? } else {?>
                                        <div>You don't have right to read this message!!! </div>
                                        <? } ?>
                                	</div>
                                
                                </form>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>