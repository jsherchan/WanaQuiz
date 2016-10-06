
function submit_budget()
{
    var custom_quiz_budget = $('#custom_quiz_budget').val();
    var checked_radio = $("input[name='radio']:checked").val();
    var quiz_budget;

    if(custom_quiz_budget !='') quiz_budget = custom_quiz_budget;
    else quiz_budget = $('#advertiser_budget').val();

    if (custom_quiz_budget=='' && checked_radio == 'paypal')
        { $.prompt("Please Select Either 'From Remaining Credits' or 'PayPal' to Set Ad Budget"); return false; }

    if( checked_radio == 'user_credits')
    {
        //$('#user_credits').removeAttr('disabled');
        if(custom_quiz_budget == '' && quiz_budget == '0')
            {$.prompt('Please Select Budget for the Quiz'); return false;}

        var user_credit = '<?=$mem_info->user_credits?>';
        if(user_credit == '') user_credit = 0;

        if(quiz_budget < user_credit)
            $.prompt
            (
                'You will now have '+(user_credit-quiz_budget)+' Credits remaining in your Account' ,
                { buttons: { Ok: true, Cancel: false },
                callback: function(v,m,f){
                        if(v){
                            document.forms.buy.submit();
                        }}});

        else
            $.prompt("You don't have enough credit . Redirect to PayPal for purchase ?",{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                        if(v){
                            document.forms.buy.submit();
                        }}});
    }
    else
    {
         if(custom_quiz_budget == '' && quiz_budget == '0')
            {$.prompt('Please select the quiz budget'); return false;}
        else
        document.forms.buy.submit();
    }

}