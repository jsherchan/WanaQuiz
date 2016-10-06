<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<script>
$(document).ready(function()
{
	$("#delete_all").click(function(){
	var tt='';
	for (var i=0;i<document.playlist.elements.length;i++)
	{
		var e=document.playlist.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox') )
		{
			if(e.checked)
			tt=e.value+','+tt;
		}
	}
	if(tt=="")
		alert('Please check the message to delete');

	else{ alert(tt);
             $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
		$.post('<?=base_url()?>member/deleteQuestions', {ids:tt} , function(data){
                    if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        $('#list').html(dt[1]);

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
                });
                }}});
		}
	});

});


function checkAll()
{
	for (var i=0;i<document.playlist.elements.length;i++)
	{
		var e=document.playlist.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.playlist.allbox.checked;
		}
	}
}

function delete_quiz(quiz_id)
{
    $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
    if(v){
    $.post('<?=base_url()?>member/deleteQuestions', {ids:quiz_id} , function(data){
        if (data != '' || data != undefined || data != null)
                {
                    dt=data.split('|');

                    if(dt[0]=='deleted')
                        $('#list').html(dt[1]);

                    else{
                        alert("You can not delete this quiz!");
                    }
                    }
    });
    }
    }
    });
}


</script>


<div id="body_wrap">
	<div class="bodywrapInner">
        <div class="">
            <div>
                
               <?php $this->load->view('member/member_links'); ?>
                
               <div class="playlist_right">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="longwhitebox_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:770px;">
                                    <div class="bold font14 color_white">MY Trasaction</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="longwhitebox_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<form name="playlist" action="" method="post">
                            		
                                        <div class="content_10box">
                                           
                                            <div class="content_wrap">
                                            	
                                                <div class="padding_2bottom">
                                                    <div class="bg_blue">
                                                    	<div class="bold">
                                                        	
                                                        	<div class="viewimg" style="width:80px">Invoice Id</div>
                                                            <div class="viewques" style="width:110px">Payment method</div>
                                                            <div class="viewques" style="width:120px">Item Name</div>
                                                            <div class="msg_date text_center" style="width:110px">Amount</div>
                                                            <div class="msg_date text_center" style="width:150px">Payment Date</div>
                                                            <div class="msg_date text_center" style="width:120px">Payment Status</div>
                                                        
                                                        	<div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="list">
                                          <?
                                          if(count($member_transactions)!=0){
                                            foreach($member_transactions as $rows){
                                            ?>
                                               
                                                <div class="padding_2bottom">
                                                    <div class="bg_lightblue">
                                                        <div>
                                                            <div class="viewimg" style="text-align:center; width:80px">
                                                                <div class="border_green" >
                                                                <?=$rows->invoice?>
                                                                </div>
                                                            </div>
                                                            <div class="viewques" style="text-align:center; width:110px">
                                                               <?=$rows->payment_method?>
                                                            </div>
                                                            <div class="viewques" style="text-align:center; width:120px">
                                                               <?=$rows->item_name?>
                                                            </div>
                                                            <div class="msg_date text_center" style="text-align:center; width:110px">
                                                                <?=$rows->gross_amount?>
                                                            </div>
                                                            <div class="msg_date text_center" style="text-align:center; width:150px">
                                                                <?=$rows->pay_time?>
                                                            </div>
                                                            <div class="msg_date text_center" style="text-align:center; width:120px">
                                                               <?php if($rows->payment_status==null) echo 'incomplete'; else echo $rows->payment_status;?>
                                                            </div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? }?>
                                                    <div style="text-align:right"><?=$pagination?></div>
                                        <?} else { ?>
                                                <div style="margin-left:300px">There are no transactions!</div>
                                                <? }?>
                                                </div>
                                        </div>
                                	</div>
                                
                                </form>
                            </div>
                        </div>
                        <div class="longwhitebox_bottomborder"></div>
                    </div>
                </div>
            </div>
        
                <div class="clear"></div>
            </div>
            
        </div>
    	<div class="clear"></div>
    </div>
</div>



