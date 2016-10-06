<script type="text/javascript" src="<?=base_url()?>crop_js/jquery-pack.js"></script>
<script>
$(document).ready(function () {
var product_id = $('#product_id').val();
    var cat_id = $('#category_id').val();
    var sub_cat_id = $('#sub_category_id').val();


select_category(product_id, cat_id, sub_cat_id);
//$('#category').click(function(){
//
//   var category = $('#category').val() ;
//   $.post('<?=base_url()?>quiz/getCategoryCPC', {cid:category} , function(data){
//       if (data != '' || data != undefined || data != null)
//            {
//               $('#selected_category').html(data);
//            }
//        });
//    });

$('.product:first-child>div').addClass('bg_skyblue').children('.bold').addClass('color_white');
$('.product>div').click(function(){
    $('.product>div').removeClass('bg_skyblue').children('.bold').removeClass('color_white');;
    $(this).addClass('bg_skyblue').children('.bold').addClass('color_white');
});


});
 function disable_custom()
    {
        $('#advertiser_budget,#custom_quiz_budget').attr('disabled','disabled');
        
        if($("input[name='radio']:checked").length > 0 )
        {
            selected_radio = $("input[name='radio']:checked").val();
            $("input[name='radio']:checked").attr('checked',false);
        }
    }

    function enable_custom()
    {        
        $('#advertiser_budget').removeAttr('disabled');

        if($('#custom_quiz_budget').attr('display')!='none')
            $('#custom_quiz_budget').removeAttr('disabled');
        
        $("input[name='radio']").each(
            function()
            {
                if($(this).val()==selected_radio)
                    $(this).attr('checked',true);
            });
    }

function check_custom_budget(){

         if($('#advertiser_budget').val() == 'own')
        $('#custom_quiz_budget').show();
        else $('#custom_quiz_budget').hide();
    }

    function check_per_selection(){
        if($('#budget_per_selection').val() == 'own')
        $('#custom_per_selection').show();
        else $('#custom_per_selection').hide();
    }

function select_category(id,category_id,sub_id){
    $.post('<?=base_url()?>quiz/getCategoryDetailByProductId', {productid:id,category_id:category_id,sub_category_id:sub_id} , function(data){
        if (data != '' || data != undefined || data != null)
            {
               $('#category').html(data);
            }
    });

}

function form_validation(){
        var category = $("input[name='category']:checked").val();
        //alert(category);
        if(category == undefined){
            alert('Category is required!');
            return false;
        }

           var custom_quiz_budget = $.trim($('#custom_quiz_budget').val());            
      if(!custom_quiz_budget)
            {
            document.forms.quizvideo.submit();
            return false;
            }
        var custom_per_selection = $.trim($('#custom_per_selection').val());
        var checked_radio = $("input[name='radio']:checked").val();
        var advertiser_budget = $('#advertiser_budget').val();
            if(!advertiser_budget) { document.forms.quizvideo.submit(); return false; }
        var coupon = $.trim($('#coupon').val());

//        var user_credit = $('#user_credits').val();
        var user_credit = <?=($user_credits>0) ? $user_credits : 0?>;
        if(user_credit == '') user_credit = 0;

        var quiz_budget;

        if(custom_per_selection !='') quiz_budget = custom_per_selection;
        else quiz_budget = $('#budget_per_selection').val();

    if (advertiser_budget==0 && coupon=='')
       { $.prompt("Please Select Budget to Set Ad Budget or Purchase Credits"); return false; }

//    if ((custom_quiz_budget!='' || advertiser_budget!=0 || advertiser_budget=='rem_credits') && checked_radio == 'paypal')
//        { $.prompt("Please Select Either 'From Remaining Credits' or 'PayPal' to Set Ad Budget"); $('#tip').show(); return false; }

    if(coupon!='' && quiz_budget > 0)
    {
        $.prompt
        ("Continue to Coupon Processing ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                    if(v){                        
                        document.forms.quizvideo.submit();
                    }}});
    }

    else if( advertiser_budget == 'rem_credits')
    {        //$('#user_credits').removeAttr('disabled');        
        if(custom_quiz_budget == '' && quiz_budget == '0')
            {$.prompt('Please Select Budget for the Quiz'); return false;}

        if(custom_quiz_budget == '' && advertiser_budget == '0')
            {$.prompt('Please Select Budget for the Quiz'); return false;}

        if(quiz_budget < user_credit)
            $.prompt
            (
                'You will now have '+(user_credit-quiz_budget)+' Credits remaining in your Account' ,
                {
                    buttons: { Ok: true, Cancel: false },
                    callback: function(v,m,f)
                    {                        
                        if(v) { document.forms.quizvideo.submit(); }
                    }
                }
            );

        else
            $.prompt("You don't have enough credit . Redirect to PayPal for purchase ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                        if(v){
                            //$('#submit1').attr('disabled','disabled');
                            document.forms.quizvideo.submit();
                        }}});
    }
    else
    {
        $.prompt("Redirect to PayPal for purchase ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                    if(v){
                        //$('#submit1').attr('disabled','disabled');
                        document.forms.quizvideo.submit();
                    }}});
        }
    

//
//        var custom_quiz_budget = $.trim($('#custom_quiz_budget').val());
//        var quiz_budget;
//        if(custom_quiz_budget !='')
//        quiz_budget = custom_quiz_budget;
//        else
//            quiz_budget = $('#advertiser_budget').val();
//
//
//        //alert($("input[name='radio']:checked").val());
//
//        if($("input[name='radio']:checked").val() == 'user_credits'){
//            $('#user_credits').removeAttr('disabled');
//            if(custom_quiz_budget == '' && quiz_budget == '0')
//                {$.prompt('Please select the quiz budget'); return false;}
//
//            var user_credit = '<?php echo $user_credits ?>';
//            if(user_credit == '' )
//                user_credit = '0';
//            //alert(quiz_budget+'/'+user_credit); return false;
//            if(quiz_budget < user_credit)
//                $.prompt('You will left only '+(user_credit-quiz_budget)+' credits in your account!',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
//                            if(v){
//                                document.forms.quizvideo.submit();
//                            }}});
//
//            else
//                $.prompt("You don't have enough credit! Do you want to proceed with Paypal for payment?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
//                    if(v){
//                        document.forms.quizvideo.submit();
//                    }}});
//        }
//
//        else{
//         if(custom_quiz_budget == '' && quiz_budget == '0')
//            {$.prompt('Please select the quiz budget'); return false;}
//        else
//        document.forms.quizvideo.submit();
//    }
//            //document.forms['quizmaking1'].submit();
//            //$('#quizmaking1').submit();
    }
</script>
<div class="padding_10topbottom">
        	<div class="quizmaking_topborder">
            	<div class="title_align">
                	<div class="font13 bold">Select Category</div>
                </div>
            </div>
            <div class="quizmaking_bg">
            	<div class="whiteboxrightside_bgInner">
                	<div class="borderbottom_dotted"></div>
                	<div class="content_10box">
                    	<div class="padding_10leftright">
                        	<div class="padding_10topbottom">
                            	<span class="color_orange">*</span> Select your product or service and we will suggest an appropiate category for your question(s) and a CPC(Cost Per Click):
                            </div>

                            <?php $user_quiz_budget = $this->Quiz_model->get_user_quiz_budget($this->session->userdata('wannaquiz_user_id'));
                                if($edit == 1)
                                $action = site_url('quiz/addVideoQuizStep3/1');
                                else{
                                if($user_quiz_budget->budget_status == '1')
                                    $action = site_url('quiz/insert_quiz/0');
                                else $action = site_url('quiz/quiz_budget/0');
                                }
                                ?>
                           
                            	<form name="quizvideo" action="<?=$action?>" method="post">
                            <div style="width:630px;">
                                <div class="padding_10topbottom">
                                    <input type="hidden" value="video" name="quiz_type">
                                    <div>
                                        <div class="border_lightblue">
                                            <div style="height:330px; overflow:scroll;">
                                                <div class="content_10box">
                                                    <div class="desc">
                                                        <!--<div class="content_wrap">
                                                            <div class="bg_skyblue">
                                                            <div class="content_5box bold color_white">Arts &amp; Crafts</div>
                                                            </div>
                                                            <p>Paintings Equipments</p>
                                                        </div>-->
                                                        <?php if(count($product)>0){
                                                            foreach($product as $products){

                                                           ?>
                                                        <div class="content_wrap product"  onclick="select_category('<?=$products->id?>','<?=$products->category_id?>','<?=$products->sub_category_id?>')">
                                                             <input type="hidden" id="product_id" value="<?=$products->id?>">
                                                            <input type="hidden" id="category_id" value="<?=$products->category_id?>">
                                                            <input type="hidden" id="sub_category_id" value="<?=$products->sub_category_id?>">
                                                            <div id="product_<?=$products->id?>" style="cursor:pointer" >
                                                                <div class="bold color_lightblue content_5box" id="class_<?=$products->id?>"><?=$products->product_name?></div>
                                                            </div>
                                                            <p style="padding:5px"><?=$products->product_description?></p>
                                                        </div>
                                                        <? } } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="quiz_id" value="<?=$quiz_id?>">
                                    <div class="padding_10topbottom" id="selected_category">
                                        <div class="border_lightblue">
                                            <div class="content_10box">
                                                <div class="input_clear">
                                                    <div class="quizmakingform_left" style="width:auto; padding-bottom:10px;">
                                                        Category for your question:
            <span class="font11 italic">(check the box if you agree)</span>
                                                    </div>

                                                    <div class="quizmakingvideoform_right">
                                                        <div class="padding_5bottom" id="category">
                                                            <div class="quizmakingform_radio">
                                                                
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <?php if($user_quiz_budget->budget_status != '1') { ?>
                                    <div class="content_wrap">
                                    	<div class="bold">Your budget</div>
                                        <div class="content_10box">
                                        	<div class="budgetform">
                                            	<div class="input_clear">
                                                	<label>Buy Clicks</label>
                                                        <select name="advertiser_budget" onchange="check_custom_budget()" id="advertiser_budget">
                                                    	 <?php
                                                    if($user_credits > 0  ){ ?>
                                                    <option value="<?=$user_credits?>">$<?=$user_credits?></option>
                                                <?php }
                                                   else {
                                                       if($edit!=0) {
                                                          $budget = $this->Quiz_model->get_quiz_budget($quiz_id)  ;
                                                        ?>
                                                        <option value="<?=$budget->total_budget?>"> $<?=$budget->total_budget?></option>
                                                        <? } else {?>
                                                    	  <option value="0">Please Select</option>
                                                        <? }?>
                                                        <option value="10"> $10 </option>
                                                        <option value="20"> $20 </option>
                                                        <option value="50"> $50 </option>
                                                        <option value="100"> $100 </option>
                                                        <option value="250"> $250 </option>
                                                         <option value="500"> $500 </option>
                                                          <option value="750"> $750 </option>
                                                           <option value="1000"> $1,000 </option>
                                                           <option value="own"> Custom Amount </option>
                                                                    <?php } ?>
                                                    </select>
                                                        <input type="text" name="custom_quiz_budget" style="display:none; margin-left:10px" id="custom_quiz_budget">
                                                        <input type="hidden" name="user_credits" value="<?=$user_credits?>">
                                                </div>
                                                <!--<div class="input_clear">
                                                	<label>Custom amount</label>
                                                    <input type="text" class="textbox" name="advertiser_custom_budget" />
                                                </div>-->
                                                <div class="input_clear">
                                                	<label>Ad Budget</label>
                                                        <select name="budget_per_selection" id="budget_per_selection" onchange="check_per_selection()">
                                                       <?php if($edit!=0) { ?>
                                                       <option value="<?=$budget->budget_per_selection?>"> $<?=$budget->budget_per_selection?></option>
                                                       <?php }?>
                                                       <option value="2"> $2 </option>
                                                       <option value="5"> $5 </option>
                                                       <option value="10"> $10 </option>
                                                       <option value="15">$15 </option>
                                                       <option value="20">$20 </option>
                                                       <option value="50">$50 </option>
                                                       <option value="75">$75 </option>
                                                       <option value="100">$100 </option>
                                                       <option value="250">$250 </option>
                                                       <option value="500">$500 </option>
                                                       <option value="750">$750 </option>
                                                       <option value="1000">$1,000 </option>
                                                       <option value="own"> Custom Amount </option>
                                                    </select>
                                                        <input type="text" name="custom_per_selection" style="display:none; margin-left:10px" id="custom_per_selection">
                                                </div>
                                                <div class="input_clear">
                                                	<label>Per</label>
                                                    <select name="budget_for">
                                                    	<?php if($edit!=0) { ?>
                                                       <option value="<?=$budget->per_selection?>"><?=$budget->per_selection?></option>
                                                       <? } ?>
                                                        <option value="day"> Day </option>
                                                         <option value="week"> Week </option>
                                                          <option value="month">Month</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input_clear">
                                    &nbsp;&nbsp;<font style="color:red"><?php echo $this->session->userdata('coupon_code_error'); $this->session->unset_userdata('coupon_code_error'); ?></font>
                                    <label style="float:left; width:110px; padding-right:5px">Coupon Code</label>
                                    <input type="text" name="coupon" id="coupon" style="float:left; width:195px" onfocus="disable_custom();" onblur="if($.trim($(this).val())=='') enable_custom();" />
                                </div>
<!--                                        <div class="input_clear">
                                            <label style="float:left; width:110px; padding-right:5px">Coupon Code</label>
                                            <input type="text" name="coupon" style="float:left; width:160px">-->
                                        </div>
                                   
                                    
                                    <div class="input_clear">
                                        <div class="quizmakingform_left padding_10top">
                                           Choose Payment Method
                                        </div>
                                        
                                        <div class="quizmakingvideoform_right">
                                         <div class="padding_5bottom">
                                        <div class="quizmakingform_radio">
                                            <input type="radio" name="radio" id="ideal" value="on" style="margin-top:10px;" />
                                            <div style="float:left; width:45px;"><img src="<?=base_url()?>images/ideal_icon.jpg" width="42" height="39" alt="ideal" /></div>
                                            <label class="padding_10top" style="width:100px;">iDeal</label>
                                            <input type="radio" name="radio" id="paypal" value="paypal" style="margin-top:10px;" checked="checked" />
                                            <div style="float:left; width:80px;">
                                                <img src="<?=base_url()?>images/paypal_icon.jpg" width="75" height="42" alt="paypal" /></div>
                                            <label class="padding_10top" style="width:100px">Paypal</label>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                        
<!--                                        <div class="quizmakingvideoform_right">
                                            <div class="padding_5bottom">
                                                <div class="quizmakingform_radio">
                                                <input type="radio" name="radio" style="margin-top:10px;" />
                                                <div style="float:left; width:45px;"><img src="<?=base_url()?>images/ideal_icon.jpg" width="42" height="39" alt="ideal" /></div>
                                               	<label class="padding_10top" style="width:100px;">iDeal</label>
                                                <input type="radio" name="radio" style="margin-top:10px;" />
                                                <div style="float:left; width:80px;"><img src="<?=base_url()?>images/paypal_icon.jpg" width="75" height="42" alt="paypal" /></div>
                                               	<label class="padding_10top">Paypal/Creditcards</label>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>-->

                                        <div class="clear"></div>
                                    </div>
                                    <? } ?>
                                    <div class="input_clear">
                                        <div style="padding-left:180px;">
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Continue" name="submit1" onclick="form_validation()"/>
                                        <div class="searchbtn_rightborder"></div>

                                        <div class="clear"></div>
                                        </div>
                                    </div>

                                

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quizmaking_bottomborder"></div>
        </div>