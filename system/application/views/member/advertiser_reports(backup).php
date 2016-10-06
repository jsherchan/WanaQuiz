<!-- For Calendar -->
<script type="text/javascript" src="<?=base_url();?>calendar/calendar.js"></script>
<script type="text/javascript" src="<?=base_url();?>calendar/calendar-en.js"></script>
<script type="text/javascript" src="<?=base_url();?>calendar/calendar-setup.js"></script>
<script type="text/javascript" src="<?=base_url();?>scripts/jquery.validate.pack.js "></script>

<link href="<?=base_url();?>calendar/calendar.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
 #frmauction label.error { font-weight:bold; color:#FF0000; padding-left:5px; }
 .error { font-weight:bold; color:#FF0000; padding-left:5px; }
</style>
<!-- End Calendar -->
<script>
function showReports(){
    var ads_type = $('#ads_type').val();
    for (var i=0; i < document.report.radio1.length; i++)
   {
   if (document.report.radio1[i].checked)
      {
      var rad_val = document.report.radio1[i].value;
      }
   }
   if(rad_val=='select')
       var date = $('#select').val();
   else
       {
       var date1 = $('#date1').val();
       var date2 = $('#date2').val();
       }
 $.post('<?=base_url()?>member/report/'+ads_type, function(data){});
}

</script>
<div id="body_wrap">
	<div class="bodywrapInner">
     <?php $this->load->view('include/advance_search_box.php'); ?>
        <div class="home_leftside">
          <div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="greentitlebg_leftborder"></div>
                            <div class="greentitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Reports</div>
                            </div>
                            <div class="greentitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                    	<div class="content_wrap">
                        	<form name="report" action="<?=base_url()?>member/report1" method="post">
                                <div class="content_10box">
                                    <div class="bold font14">Performance of your ads</div>
                                    <div class="padding_10topbottom">
                                    	<div class="input_clear">
                                        	<div class="reprotform_label"><label>View performance of your ads by</label></div>
                                            <div class="reprotform_checkbox">&nbsp;</div>
                                            <div class="reprotform_select">
                                            	<select style="width:175px;" id="ads_type" name="ads_type">
                                                	<option value="all">All Ads</option>
                                                        <option value="text">Text Ads</option>
                                                        <option value="banner">Banner Ads</option>
                                                        <option value="text_player">Text Ads Player</option>
                                                </select>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                        <div class="input_clear">
                                        <div class="reprotform_label"><label>Date range</label></div>
                                        <div class="reprotform_checkbox"><input type="radio" name="radio1" value="select" checked/></div>
                                       
                                            <div class="reprotform_select">
                                                <select style="width:175px;" id="select" name="select">
                                                	<option value="7day">Last Seven days</option>
                                                        <option value="1month">Last one month</option>
                                                        <option value="1year">Last one year</option>
                                                </select>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        
                                        <div class="input_clear">
                                        	<div class="reprotform_label">&nbsp;</div>
                                            <div class="reprotform_checkbox"><input type="radio" name="radio1" value="input" /></div>
                                            <div class="reprotform_input">
                                                <input type="text" id="start_date" class="textbox" name="date1" value="" style="width: 100%" />
                                                <div id="calendarImage1">                                                    
                                                    <img src="<?=base_url();?>calendar/calendar.gif" width="16" height="15" align="absmiddle" style="cursor: pointer;">
                                                    <label style="font-weight:bold;">Click Calendar</label>
                                                </div>
                                                 
                                            </div>
                                            <div style="float:left; width:10px; font-size:16px; padding:0 5px;"> - </div>
                                            <div class="reprotform_input">
                                                
                                                <input name="date2" type="text" id="end_date" class="textbox" value="" style="width: 100%" />
                                                <div id="calendarImage2">
                                                    <img src="<?=base_url();?>calendar/calendar.gif" width="16" height="15" align="absmiddle" style="cursor: pointer;">
                                                    <label style="font-weight:bold;">Click Calendar</label>
                                                </div>
                                            </div>
                                            
                                            <div class="clear"></div>
                                        </div>
                                        <input type="submit" value="submit" align="right" onclick="showReports()" style="margin-left: 225px; padding: 3px; margin-top: 15px;" />
                                    </div>
                                </div>
                                    
                                <div class="borderbottom_dotted"></div>
                                <div class="content_10box" >
                                    <?php $credit_query = $this->Quiz_model->get_user_quiz_budget($this->session->userdata('wannaquiz_user_id'));?>
                                    <span style="padding-right:20px">
                                        <span style="color:blue">Total Remaining Credits:</span> <strong> $ <?php if($credit_query->total_budget) echo $credit_query->total_budget; else echo '0';?></strong>
                                    </span>
                                    <span style="">
                                        <span style="color:blue">Remaining Budget for this <?php echo ucwords($credit_query->per_selection); ?> :</span>
                                          <strong> $ <?php if($credit_query && $credit_query->remaining_budget > 0)echo $credit_query->remaining_budget; else echo 0;?>                 </strong>
                                          &nbsp;of&nbsp;
                                         <strong> $ <?php if($credit_query && $credit_query->total_budget > 0)echo $credit_query->budget_per_selection; else echo 0;?> </strong>
                                       
                                        <a href="<?=base_url()?>member/buyAdSpace"><span style="">(Change)</span></a>
                                    </span>
                                </div>
                                <div class="borderbottom_dotted"></div>
                                <div class="content_10box">
                                	<div class="repdate">Showing Report of: <span class="bold"><?=date("M d, Y",$date1)?> - <?=date("M d, Y",$date2)?></span> </div>
                                    <div class="rep_printbtn">
                                    	<div class="searchbtn_leftborder"></div>
                                        <div class="searchbtn_bg">
                                        	<a style="cursor:pointer" onClick="window.print()">Print Report</a>
                                        </div>
                                        <div class="searchbtn_rightborder"></div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                	<div class="clear"></div>
                                </div>
                                <div class="borderbottom_dotted"></div>
                            </form>
                        </div>
                        <div id="test">
                        <?php 
                        
                        if($type == 'all' || $type == ''){
                        
                       $this->load->view('quiz/text_report');
                       $this->load->view('quiz/banner_report');
                       $this->load->view('quiz/text_flash_report');
                       $this->load->view('quiz/profile_report');
                        }
                       elseif($type == 'text')
                       $this->load->view('quiz/text_report');
                       elseif($type == 'banner')
                       $this->load->view('quiz/banner_report');
                       elseif($type == 'text_player')
                       $this->load->view('quiz/text_flash_report');
                       else
                       $this->load->view('quiz/profile_report');
                       ?>
                        
                        </div>
                        
                       
                        
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
            
        </div>
        
        <?php include('updatepublicprofile_rightside.php'); ?>
    
    	<div class="clear"></div>
    </div>
</div>

<script type="text/javascript">

	   Calendar.setup(
        {
         inputField  : "start_date",        				// ID of the input field
          ifFormat    : "%Y-%m-%d %H:%M:%S",  		// the date format
          button      : "calendarImage1",   		// ID of the button
          showsTime   : "true"         				// ID of the button
        }
      )

	    Calendar.setup(
        {
         inputField  : "end_date",        				// ID of the input field
          ifFormat    : "%Y-%m-%d %H:%M:%S",  		// the date format
          button      : "calendarImage2",   		// ID of the button
          showsTime   : "true"         				// ID of the button
        }
		)

   </script>