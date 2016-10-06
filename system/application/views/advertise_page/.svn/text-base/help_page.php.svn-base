<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/swfobject_player.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/swfobject.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.oembed.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/player.swf"></script>
<script type="text/javascript" src="<?=base_url()?>sexylight/sexylightbox.v2.3.jquery.min.js"></script>
<script src="<?=base_url()?>sexylight/jquery.easing.1.2.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=base_url()?>sexylight/sexylightbox.css" type="text/css" media="all" />
<script type="text/javascript">

    $(document).ready(function() {
        //$('ul.sf-menu').superfish();
		SexyLightbox.initialize({color:'black', dir: '<?php echo base_url()?>sexylight/sexyimages'});

    });

</script>
<script>
$(function(){
  if('<?=$ad_id?>'!='0' && '<?=$ad_id?>'!='')
  display_help(<?=$ad_id?>);
})

function display_help(hqaid)
{
	
	$('#answer').html('<div align="center"><img src="<?=base_url()?>images/wheel.gif" width="16" height="16" /><div>');
	$.post('<?=base_url()?>ajax_help_data', {question_id: hqaid,page:'advertise'} , function(data)

		{			
			   if (data != '' || data != undefined || data != null) 
			   {	
				   content=data.split("|");
				  $('#question').html(content[0]);
				  $('#answer').html(content[1]);
			   }
			 
          });		
}
</script>
<div id="body_wrap">
	<div class="bodywrapInner">
        <div class="">
            <div>

                <?php include('help_leftside.php'); ?>

                <?php include('help_midside.php'); ?>

                <div class="clear"></div>
            </div>

        </div>

        <?php //include('rightside.php'); ?>

    	<div class="clear"></div>
    </div>
</div>


<!--<div id="body_wrap">
	<div class="bodywrapInner">
     <?php $this->load->view('include/advance_search_box.php'); ?>
        <div class="home_leftside">
           <div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white"><?=$page->title?></div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                    	<div class="content_10box">
                        	<div class="desc">
                            	<?=$page->detail?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
            
        </div>
        
        <?php// $this->load->view('include/dressed_widget'); ?>
    
    	<div class="clear"></div>
    </div>
</div>
-->