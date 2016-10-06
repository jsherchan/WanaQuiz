<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>
<script type="text/javascript">
var selected_radio;
function get_subcategory(category)
{
    $.post('<?=base_url()?>quiz/quizesByCategory', {category_id:category} , function(data){ 
        if (data != '' || typeof data != 'undefined' || data != null)
                        {
                            $('#question').html(data);
                        }
        else $('#question').html('There is no any question');
    });

}

function check_custom_budget(){
     var val = $('#advertiser_budget').val();
    if(val!='rem_credits') $('[value="paypal"]').attr('checked',true);
   else $('[value="user_credits"]').attr('checked',true);
 
         if(val == 'own')
            $('#custom_quiz_budget').show();
        else 
            $('#custom_quiz_budget').hide();
    }

    function check_per_selection(){
        if($('#budget_per_selection').val() == 'own')
        $('#custom_per_selection').show();
        else $('#custom_per_selection').hide();
    }

    function quiz_credit(){
        $('#advertiser_budget').attr('disabled',true);
        $('#custom_quiz_budget').attr('disabled',true);
        
        if($("input[name='radio']:checked").length > 0 )
        {
            selected_radio = $("input[name='radio']:checked").val();
            $("input[name='radio']:checked").attr('checked',false);
        }
    }

    function check_enabled(){        
       if (document.getElementById('coupon').value == "")
       {
            $('#advertiser_budget').attr('disabled',false);
            $('#custom_quiz_budget').attr('disabled',false);
                        
            $("input[name='radio']").each(
            function()
            {
                if($(this).val()==selected_radio)
                    $(this).attr('checked',true);
            });
       } 
       else {
           $('#advertiser_budget').attr('disabled',true);
           $('#custom_quiz_budget').attr('disabled',true);
       }
    }

function submit_budget()
{    
    var custom_quiz_budget = $('#custom_quiz_budget').val();
    var custom_per_selection = $('#custom_per_selection').val();
    var checked_radio = $("input[name='radio']:checked").val();
    var remaining_budget = <?=($quiz_budget_details->remaining_budget) ? $quiz_budget_details->remaining_budget : 0?>;
    var advertiser_budget = $('#advertiser_budget').val();
    var coupon = $.trim($('#coupon').val());

    var quiz_budget;

    if(custom_per_selection !='') quiz_budget = custom_per_selection;
    else quiz_budget = $('#budget_per_selection').val();
    
    if(coupon=='' && (checked_radio == '' || checked_radio == undefined)) { $.prompt("Please Choose a Payment Method"); return false; }

    if (custom_quiz_budget=='' && advertiser_budget=='rem_credits' && checked_radio == 'paypal')
        { $.prompt("Please Select 'PayPal' to Set Ad Budget"); return false; }
     
     if(coupon!='' && quiz_budget > 0)
    {
        $.prompt
        ("Continue to Coupon Processing ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                    if(v){
                        $("input[name='radio']:checked").val('paypal');
                        document.forms.buy.submit();
                    }}});
    }
    
    else
    {
        if(quiz_budget < remaining_budget && coupon == '')
        {
            $.prompt
            (
                'You will now have '+(remaining_budget-quiz_budget)+' Credits remaining in your Account' ,
                {
                    buttons: { Ok: true, Cancel: false },
                    callback: function(v,m,f)
                    {
                        if(v) { document.forms.buy.submit(); }
                    }
                }
            );
        }

        else
        {
        $.prompt("Redirect to PayPal for purchase ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                    if(v){
                        document.forms.buy.submit();
                    }}});
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
                                    <div class="bold font14 color_white">Buy Clicks</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<!--<div class="content_10box">
                                	<div class="padding_5top bold">
                                        <div class="advert_company"> Your saldo is </div>
                                        <div class="advert_name text_right color_green"> $ 0.75 </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>-->
                                
                                <div class="borderbottom_dotted"></div>
                                
                                <!--div class="content_10box">
                                	<div class="padding_10topbottom">
                                    	<div class="font14 bold">Buy more Views and Clicks</div>
                                    </div-->
                                    <div class="padding_10topbottom">
                                        <div class="font14 bold">&nbsp;&nbsp;&nbsp;Total Remaining Balance : $ <?php if($quiz_budget_details->total_budget) echo $quiz_budget_details->total_budget; else echo '0'; ?> </div>
                                    </div>                                    
                                    <div class="padding_10topbottom">
                                        
                                 <form name="buy" action="<?=site_url('quiz/quiz_budget')?>" method="post">
    
                                            <input type="hidden" id="ad_space" name="ad_space" value="ad_space">
                                        	<div class="general_form">                                            	
                                                <div class="input_clear">
                                                	<label>Buy Clicks</label>
                                                        <select name="advertiser_budget" onchange="check_custom_budget()" id="advertiser_budget">
                                                           <option value="rem_credits">Please Select</option>
                                                           <option value="10">$10</option>
                                                            <option value="20">$20</option>
                                                            <option value="50">$50</option>
                                                            <option value="100">$100</option>
                                                            <option value="250">$250</option>
                                                             <option value="500">$500</option>
                                                              <option value="750">$750</option>
                                                              <option value="1000">$1,000</option>
                                                            <option value="own"> Custom Amount </option>
                                                    </select>
                                                        <input type="text" name="custom_quiz_budget" style="display:none; float:right; width:120px" id="custom_quiz_budget">
                                                </div>
                                               
                                                <div class="input_clear">
                                                	<label>Ad Budget</label>
                                                    <select name="budget_per_selection" onchange="check_per_selection()" id="budget_per_selection">                                                        
                                                    	<option value="2">$2</option>
                                                        <option value="5">$5</option>
                                                        <option value="10">$10</option>
                                                        <option value="15">$15</option>
                                                        <option value="20">$20</option>
                                                        <option value="50">$50</option>
                                                        <option value="75">$75</option>
                                                        <option value="100">$100</option>
                                                        <option value="250">$250</option>
                                                        <option value="500">$500</option>
                                                        <option value="750">$750</option>
                                                        <option value="1000">$1,000</option>
                                                        <option value="own"> Custom Amount </option>
                                                    </select>                                                        
                                                        <input type="text" name="custom_per_selection" style="display:none; float:right; width:120px" id="custom_per_selection">
                                                        &nbsp;&nbsp;&nbsp;
<!--                                                        Remaining : $ <strong><?=($quiz_budget_details->remaining_budget) ? $quiz_budget_details->remaining_budget : 0?></strong>-->
                                                        <input type="hidden" name="pre_budget" id="pre_budget" value="<?=($quiz_budget_details->remaining_budget) ? $quiz_budget_details->remaining_budget : 0?>" />
                                                </div>
                                                <div class="input_clear">
                                                	<label>Per</label>
                                                    <select name="budget_for">
                                                        <option value="day">Day</option>
                                                        <option value="week">Week</option>
                                                        <option value="month">Month</option>
                                                    </select>
                                                </div>
                                                <div class="input_clear">
                                                    <label style="" >Coupon Code ( optional )</label>
                                                    <input type="text" name="coupon" id="coupon" style="float:left; width:195px" onfocus="quiz_credit()" onblur="check_enabled()">
                                                    <div style="color:red">&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('coupon_code_error'); $this->session->unset_userdata('coupon_code_error'); ?></div>
                                                </div>

                                            </div>
                                            
                                            <div class="padding_10topbottom">
                                                <div class="general_formcheckbox">
                                                    <div class="input_clear">
                                                        <label style="width:150px; padding-right:15px;">&nbsp;&nbsp;&nbsp;Choose Payment Method</label>
                                                        <input type="radio" name="radio" id="radio" style="margin-top:10px;" value="" />
                                                        <label style="margin:0 5px;"><img src="<?=base_url()?>images/ideal_icon.jpg" width="42" height="39" alt="IDEAL" /></label>
                                                        <label style="margin-top:10px;">Ideal</label>
                                                    </div>
                                                    <div class="input_clear">
                                                        <label style="width:150px; padding-right:15px;">&nbsp;</label>
                                                        <input type="radio" name="radio" id="radio" style="margin-top:20px;" checked value="paypal"/>
                                                        <label style="margin:0 5px;"><img src="<?=base_url()?>images/paypal_icon.jpg" width="75" height="42" alt="paypal" /></label>
                                                        <label style="margin-top:10px;">PayPal</label>
                                                    </div>
<!--                                                   <div class="input_clear">
                                                        <label style="width:150px; padding-right:15px;">&nbsp;</label>
                                                        <input type="radio" name="radio" id="radio" style="margin-top:20px;" checked value="user_credits"/>
                                                        <label style="margin:18px 5px;">Use My Credits <strong>( <?=($mem_info->user_credits) ? $mem_info->user_credits : 0?> )</strong></label>
                                                        
                                                    </div>-->
<!--                                                    <input type="hidden" name="user_credits" id="user_credits" value ="<?=$mem_info->user_credits?>" disabled>                                                    -->
                                                </div>
                                            </div>
                                            
                                            <div class="input_clear">
                                            	<div style="padding-left:165px;">
                                                	<div class="searchbtn_leftborder"></div>
                                                        <input type="button" class="searchbtn_bg" value="Continue" name="submit1" style="padding:0 5px;"  onclick="submit_budget()"/>
                                                    <div class="searchbtn_rightborder"></div>
                                                    
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                                                
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>