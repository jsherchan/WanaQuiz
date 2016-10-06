<script>
$(function(){
  if(<?=$ad_id?>!='0')
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

                <?php include('best_fifty_leftside.php'); ?>

                <?php include('best_fifty_midside.php'); ?>

                <div class="clear"></div>
            </div>

        </div>

        <?php //include('rightside.php'); ?>

    	<div class="clear"></div>
    </div>
</div>