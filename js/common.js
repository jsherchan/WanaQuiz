
function display_help(hqaid)
{
	alert('tes');
	$('#help_disp').html('<div style="padding-left:40px; padding-top:20px; padding-bottom:20px; width:500px;" align="center"><img src="'+baseurl+'images/wheel.gif" width="16" height="16" /><div>');
	$.post(baseurl+'ajax_help_data', {question_id: hqaid} , function(data)

		{			
			   if (data != '' || data != undefined || data != null) 
			   {	
			   //alert(data);
			   content=data.split("#");
				  $('#help_disp').html(content[0]);
				  $('#topic_name').html(content[1]);
			   }
			 
          });		
}

