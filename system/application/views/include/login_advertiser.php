<?#=var_dump(get_defined_vars())?>
<script>
function advertiser_forget_password(){
    $('#forgot_password').show();
    $('#advertiser_login').hide();
}

function submit_email(){ 
    var email = $('#email').val();
    $.post('<?=base_url()?>home/forgetpassword', {email:email}, function(data)
        {
            if(data=='email_field_required')
                alert('Email field is required!');
            else if(data=='password_reset')
                alert("You have successfully reset your password. Please check your email!");
            else alert("There is no email record!");
        }
);
}
</script>
<div class="signupoption_leftInner">
                                	<div class="optionbox_topborder">
                                    	<div class="optiontitle_align">
                                        	<div class="advertise_icon font14 bold">Advertiser</div>
                                        </div>
                                        <div class="borderbottom_dotted"></div>
                                    </div>
                                    <div class="optionbox_bg" id="advertiser_login">
                                    	<div class="content_10box">
                                        	<div class="content_wrap">
                                            	
                                            </div>
                                            <div style="color:red"><?=$this->session->flashdata('advertiser_login_message')?></div>
                                            <div class="padding_10topbottom">
                                            	<form name="add_login" action="<?=site_url('home/login/')?>" method="post">
                                                <input type="hidden" value="<?=$redUrl?>" name="redUrl" />
                                                <input type="hidden" value="1" name="user_type">
                                                <input type="hidden" value="2" name="user_type1">
                                                	<div class="general_form">
                                                    	<div class="input_clear">
                                                        	<label style="width:100px;">Username</label>
                                                            <input type="text" class="textbox" name="username" />
                                                        </div>
                                                        <div class="input_clear">
                                                        	<label style="width:100px;">Password</label>
                                                            <input type="password" class="textbox" name="password" />
                                                        </div>
                                                    </div>
                                                    <div class="input_clear">
                                                        <div class="padding_10topbottom" style="padding-left:100px;">
                                                        <input type="submit" class="greensignupsmallbtn" value="Sign In" name="submit" />
                                                        <div style="padding-left:30px;"><a href="#" onclick="advertiser_forget_password()">Forgot details ?</a></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="padding_10topbottom" align="center">
                                            <!--div id="fb-root"></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
         FB.init({ 
            appId:<?=$appId?>, cookie:true, 
            status:true, xfbml:true 
         });
         FB.Event.subscribe('auth.login', function(response) { window.location.href = '<?=base_url()?>home/facebook'; });
         FB.Event.subscribe('auth.logout', function(response) { window.location.href = '<?=base_url()?>home/login'; });
      </script>
      <fb:login-button perms="email,user_checkins">Login with Facebook</fb:login-button-->
                                        </div>                                        
                                        <!--div align="center">
                                            <a href="<?=base_url();?>redirect.php"><img src="<?=base_url();?>images/login.twitter.png" alt="login with twitter"  id="twt"/></a>
                                        </div-->
                                        </div>
                                    </div>

                                    <div class="optionbox_bg" id="forgot_password" style="display:none">
                                    	<div class="content_10box">
                                        	<div class="content_wrap">
                                            	If you forgot your password, enter your email id and we will forward you a new password!
                                            </div>
                                            <div style="color:red"><?=$this->session->flashdata('advertiser_login_message')?></div>
                                            <div class="padding_10topbottom">
                                            	<form name="forget_password" action="" method="post">
                                                
                                                	<div class="general_form">
                                                    	<div class="input_clear">
                                                        	<label style="width:100px;">Email Id</label>
                                                            <input type="text" class="textbox" name="email" id="email" />
                                                            <?php echo form_error('email')?>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="input_clear">
                                                        <div class="padding_10topbottom" style="padding-left:100px;">
                                                            <input type="button" class="greensignupsmallbtn" value="Submit" name="submit" onclick="submit_email()"/>
                                                        
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="optionbox_bottomborder"></div>
                                </div>