<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>
      

<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Game Boards</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                        <div class="content_10box">
                        	<div class="padding_10topbottom">
                            	<div class="bold">Print your gameboards</div>
                            </div>
                            
                            <div class="content_wrap">
                            	<div class="gameboard_left">
                                	<div class="gameboard_leftInner">
                                    	<div class="content_wrap">
                                            <div class="border_gray">
                                                <div class="content_5box">
                                                    <div class="color_lightblue bold">Free game boards</div>
                                                    <div class="content_10box">
                                                        <div class="text_center" id="id2">
                                                            <img src="<?=base_url()?>results/<?=$gameboard_image?>" width="209"  alt="gameframe" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="gameboard_info">
                                        	<ul>
                                            	<li>Ready to print into your A4 size sheets</li>
                                                <li>You can upload your images, that will appear in the center portion of the gameboard</li>
                                            </ul>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="gameboard_right">
                                	<div class="bold">Congratulation your image has been successfully uploaded</div>
                                    <div class="padding_10topbottom">
                                    	You can print your board now.
                                    </div>
                                    
                                    <div>
                                        <div class="searchbtn_leftborder"></div>
                                        <div class="searchbtn_bg">
                                     <!--<a href="javascript:void(0);" style="padding:0 10px;" id="printboard" onclick="window.open('welcome.html',
'welcome','width=600,height=800,menubar=yes,status=yes')">Print</a>-->
<a href="javascript:void(0);" style="padding:0 10px;" id="printboard" >Print</a>
                                        </div>
                                        <div class="searchbtn_rightborder"></div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                
                                <div class="clear"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
<script>
$(document).ready(function() {
	$('#printboard').click(function() {		
	
	var txt = '<img src="<?=base_url()?>results/<?=$gameboard_image?>" width="400"><br>Print';
	$.prompt(txt,{
		buttons: { Print: true, Cancel: false },
                submit: function(v,m,f){
					if(v)
                                            window.print();
                }
	});
	
	
	/*w=window.open();
	w.document.write($('#id2').html());
	w.print();
	w.close();*/
	});
});
</script>