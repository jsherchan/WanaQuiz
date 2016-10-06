<link href="<?=base_url()?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script>
    var j = jQuery.noConflict();
     var code;
     function dochange(id)
{
    code=id;
    if(id!='')
        jQuery('#list_state').load('<?=base_url()?>registration/get_states',{pid:id});
    else
        jQuery('#list_state').html('<select><option value="">- Select State -</option></select>');
}
    function dochanges(id)
{
    if(id!='')
        jQuery('#list_city').load('<?=base_url()?>registration/get_cities',{country_code:code,pid:id});
    else
        jQuery('#list_city').html('<select><option value="">- Select State -</option></select>');
}

//function state_Code()
//{    
//     $('#city').attr('disabled','disabled');
//     $('#city').val('Populating Cities');   
//    $.post(
//        '<?=site_url("registration/get_city")?>',
//        {term: state_c},
//        function(data)
//        {
//            $('#city').val('');
//            $('#city').removeAttr('disabled');
//            $('#city').focus();
//            var cities = data.split(',');
//            $( "#city" ).autocomplete( { source : cities });
//        });    
//}
</script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.limit-1.2.source.js"></script>
<link href="<?=base_url()?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script>
    var j = jQuery.noConflict();
     var code;
     function dochange(id)
{
    code=id;
    if(id!='')
        jQuery('#list_state').load('<?=base_url()?>registration/get_states',{pid:id});
    else
        jQuery('#list_state').html('<select><option value="">- Select State -</option></select>');
}
    function dochanges(id)
{
    if(id!='')
        jQuery('#list_city').load('<?=base_url()?>registration/get_cities',{country_code:code,pid:id});
    else
        jQuery('#list_city').html('<select><option value="">- Select State -</option></select>');
}
function reload_captcha()
{
     jQuery('#captcha_img').load('<?=base_url()?>registration/generate_captchas');
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
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Fill in Signup details</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                    	<div class="content_10box">
                        	<div class="regbox_topborder">
                            	<div class="optiontitle_align">
                                    <div class="user_icon font14 bold">Advertiser User</div>
                                </div>
                                <div class="borderbottom_dotted"></div>
                            </div>
                            <div class="regbox_bg">
                            	<div class="content_10box">
                                	<div>Please enter the information below:</div>
                                    <div class="padding_10topbottom">
                                    	<form name="signup" action="<?=site_url('registration/advertiser')?>" method="post">
                                        	<div class="general_form">
                                            	<div class="input_clear">
                                                	<label> <span class="color_orange">*</span> First Name </label>
                                                    <input type="text" class="textbox" name="fname" value="<?=set_value('fname')?>"/>
                                                    <?php echo form_error('fname')?>
                                                </div>
                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Surname </label>
                                                    <input type="text" class="textbox" name="lname" value="<?=set_value('lname')?>"/>
                                                    <?php echo form_error('lname')?>
                                                </div>
                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Email address </label>
                                                    <input type="text" class="textbox" name="email" value="<?=set_value('email')?>"/>
                                                    <?php echo form_error('email')?>
                                                </div>
                                                      <div class="input_clear">
                                                        <label> <span class="color_orange">*</span> Gender</label>
                                                        <select name="gender">
                                                           <option value="male" <?php echo set_select('gender','male')?>>Male</option>
                                                            <option value="female" <?php echo set_select('gender','female')?>>Female</option>
                                                        </select>
                                                        <?php echo form_error('gender')?>
                                                    </div>
                                                    <!--<div class="input_clear">
                                                        <label> <span class="color_orange">*</span> Date of Birth</label>
                                                        <select name="dod" style="width:55px; margin-right:5px;">
                                                            <option value="">Day</option>
                                                            <? for($i=1;$i<=31;$i++) {?>
                                                            <option value="<?=$i?>" <?=set_select('dod', $i); ?>><?=$i?></option>
                                                            <?}?>
                                                        </select>
                                                        <select name="dom" style="width:70px; margin-right:5px;">
                                                            <option value="">Month</option>
                                                            <option value="01" <?php echo set_select('dom', '01'); ?> >Jan</option>
                                                            <option value="02" <?php echo set_select('dom', '02'); ?> >Feb</option>
                                                            <option value="03" <?php echo set_select('dom', '03'); ?> >Mar</option>
                                                            <option value="04" <?php echo set_select('dom', '04'); ?> >Apr</option>
                                                            <option value="05" <?php echo set_select('dom', '05'); ?> >May</option>
                                                            <option value="06" <?php echo set_select('dom', '06'); ?> >Jun</option>
                                                            <option value="07" <?php echo set_select('dom', '07'); ?> >Jul</option>
                                                            <option value="08" <?php echo set_select('dom', '08'); ?> >Aug</option>
                                                            <option value="09" <?php echo set_select('dom', '09'); ?> >Sep</option>
                                                            <option value="10" <?php echo set_select('dom', '10'); ?> >Oct</option>
                                                            <option value="11" <?php echo set_select('dom', '11'); ?> >Nov</option>
                                                            <option value="12" <?php echo set_select('dom', '12'); ?> >Dec</option>
                                                        </select>
                                                        <select name="doy" style="width:65px;">
                                                            <option value="">Year</option>
                                                            <?php for($i=(date('Y')-16); $i>(date('Y')-100);$i--) { echo "<option value='".$i."'". set_select('doy', $i)." >".$i."</option>"; } ?>
                                                        </select>
                                                        <div class="clear"></div>
                                                        <?php echo form_error('dod')?>
                                                        <?php echo form_error('dom')?>
                                                        <?php echo form_error('doy')?>
                                                    </div>-->
                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Username</label>
                                                    <input type="text" class="textbox" name="uname" id="username" value="<?=set_value('uname')?>"/>                                                    
                                                    <?php echo form_error('uname')?>
                                                    <div class="clear"></div>
                                                    <label>&nbsp;</label><span style="font-size:10px">You have <span id="uname"></span> chars left.</span>
                                                    <script type="text/javascript">
                                                        jQuery('#username').limit(14,'#uname');
                                                     </script>
                                                </div>
                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Password </label>
                                                    <input type="password" class="textbox" name="password" value="<?=set_value('password')?>"/>
                                                    <?php echo form_error('password')?>
                                                </div>
                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Retype Password</label>
                                                    <input type="password" class="textbox" name="re_password" value="<?=set_value('re-password')?>"/>
                                                    <?php echo form_error('re_password')?>
                                                </div>

                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Country</label>
                                                      <select name="country" id="country" onchange="dochange(this.value);"  >
                                                        <option value="">Select Country</option>
                                                        <?php foreach($country_list as $row){
                                                                  ?>
                                                        
                                                        <option value="<?=$row->country_code?>" <?php echo set_select('country',$row->country_name)?>><?=$row->country_name?></option>
                                                        <?php }?>
                                                    </select>
                                                    <?php echo form_error('country')?>
                                                </div>
                                                       <div class="input_clear" >
                                                	<label> <span class="color_orange">*</span> State</label>
                                                        <div id="list_state">
                                                        <select name="state" id="state" onchange="dochanges(this.value);">
                                                                <option>- Select State -</option>
                                                            </select></div>
<!--                                                    <input type="text" name="state" class="textbox" id="state" disabled onchange="state_Code()" value="<?=set_value('state')?>"/>-->
                                                    <?php echo form_error('state')?>
                                                </div>

                                                <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> City</label>
                                                        <div id="list_city">
                                                        <select name="city" id="city" class="" onchange="dochanges(this.value);">
                                                                <option>- Select City -</option>
                                                  </select></div>
<!--                                                    <input type="text" name="city" class="textbox" id="city" disabled value="<?=set_value('city')?>"/>-->
                                                    <?php echo form_error('city')?>
                                                </div>
                                                    
                                                  <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Company Name</label>
                                                    <input type="text" class="textbox" name="cname" value="<?=set_value('cname')?>"/>
                                                    <?php echo form_error('cname')?>
                                                </div>
                                                  <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Company Address</label>
                                                    <input type="text" class="textbox" name="caddress" value="<?=set_value('caddress')?>"/>
                                                    <?php echo form_error('caddress')?>
                                                </div>
                                                 <div class="input_clear">
                                                	<label> <span class="color_orange">*</span> Company Website</label>
                                                    <input type="text" class="textbox" name="cwebsite" value="<?=set_value('cwebsite')?>"/>
                                                    <?php echo form_error('cwebsite')?>
                                                </div>
                                            </div>
                                            <div class="signupbtn_align">
                                            	<div class="general_formcheckbox">
                                                	<div class="input_clear">
                                                    	<input type="checkbox" name="terms" value="yes" />
                                                        
                                                        <label style="width:535px;">I agree to the terms outlined in <a href="<?=base_url()?>" class="color_lightblue">WannaQuiz's</a> <a href="<?=base_url()?>page/show/terms_conditions">Conditions</a> of Use</label>
                                                        <?php echo form_error('terms')?>
                                                    </div>
                                                    <div class="input_clear">
                                                    	<input type="checkbox" name="newsletter" value="1" />
                                                        <?php //echo form_error('newsletter')?>
                                                        <label style="width:535px;">I'd like to get the <a href="<?=base_url()?>" class="color_lightblue">WannaQuiz</a> Daily Email Quiz each day, completely free!
Learn something new each day.</label>
                                                    </div>
                                                    <div class="input_clear">
                                                    	<input type="checkbox" name="check_adult" value="yes" />
                                                        
                                                        <label>I am at least 13 years old. Children younger than 13 are only allowed on our site under adult supervision.</label>
                                                        <?php echo form_error('check_adult')?>
                                                    </div>
                                                    
                                                </div>
                                                <div id="captcha_img">
                                                <br></br>
                                                
                                                <?php echo $captcha_image ;?>
                                                <br></br>
                                              <label>Enter the characters you see above</label> </br><br>
                                            <input type="text" name="captcha"  size="30" />

                                            <?php echo form_error('captcha')?>
                                           </div><br>
                                                 <label>Can't Read The Image? Click</label> <a href="javascript:void(0)" onclick="reload_captcha()">Here</a> to Refresh
                                                    
                                                <div class="input_clear">
                                                	<div class="padding_10topbottom">
                                                	<input type="submit" class="greensignupsmallbtn" value="Signup" name="submit" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="regbox_bottomborder"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
            
        </div>
        
        <?php include('signupoption_rightside.php'); ?>
    
    	<div class="clear"></div>
    </div>
</div>