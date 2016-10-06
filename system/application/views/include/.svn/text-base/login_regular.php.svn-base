<script>
    function regular_forget_password(){
    $('#forgot_regular_password').show();
    $('#regular_login').hide();
}

function submit_regular_email(){
    var email = $('#regular_email').val();
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
<div>
                                	<div class="optionbox_topborder">
                                    	<div class="optiontitle_align">
                                        	<div class="user_icon font14 bold">Regular User</div>
                                        </div>
                                        <div class="borderbottom_dotted"></div>
                                    </div>
                                    <div class="optionbox_bg" id="regular_login">
                                    	<div class="content_10box" >
                                        	<div class="content_wrap">
                                            	
                                            </div>
                                            <div style="color:red"><?=$this->session->flashdata('regular_login_message')?></div>
                                            <div class="padding_10topbottom">
                                            	<form name="add_login" action="<?=site_url('home/login/')?>" method="post">
                                               <input type="hidden" value="<?=$redUrl?>" name="redUrl" />
                                               <input type="hidden" value="0" name="user_type">
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
                                                        <div style="padding-left:30px;"><a href="#" onclick="regular_forget_password()">Forgot details ?</a></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div>
                                        <div class="padding_10topbottom" align="center"> 
                                            <div style="display: inline-block; float: left; margin-left: 22px; margin-right: -10px;">
      <?php if($fb_status=='0') { ?>	
      <div id="fb-root"></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
         FB.init({ 
            appId:<?=$appId?>, cookie:true, 
            status:true, xfbml:true 
         });
         FB.Event.subscribe('auth.login', function(response) { return; window.location.href = '<?=base_url()?>home/facebook'; });
         
         function login()
         {
             window.location.href = '<?=base_url()?>home/facebook';
         }
      </script>
            <fb:login-button onlogin="login();" size="medium" scope="email,user_birthday">Login with Facebook</fb:login-button>
      <?php } else{?>
        <a href="<?=base_url();?>home/facebook"><img src="<?=base_url();?>images/fb_login.png" /></a>
        <?php } ?>
         </div>
                    <a href="<?=base_url();?>home/twitter">
                        <img src="<?=base_url();?>images/login.twitter.png" alt="login with twitter"  id="twt"/></a>
                                            <div class="clear"></div>
                                        </div>   
                                            </div>
                                    </div>

                                     <div class="optionbox_bg" id="forgot_regular_password" style="display:none">
                                    	<div class="content_10box">
                                        	<div class="content_wrap">
                                            	If you forgot your password, enter your email id and we will forward you a new password!
                                            </div>
                                            <div style="color:red"><?=$this->session->flashdata('regular_login_message')?></div>
                                            <div class="padding_10topbottom">
                                            	<form name="forget_password" action="" method="post">

                                                	<div class="general_form">
                                                    	<div class="input_clear">
                                                        	<label style="width:100px;">Email Id</label>
                                                            <input type="text" class="textbox" name="regular_email" id="regular_email" />
                                                            <?php echo form_error('regular_email')?>
                                                        </div>

                                                    </div>
                                                    <div class="input_clear">
                                                        <div class="padding_10topbottom" style="padding-left:100px;">
                                                            <input type="button" class="greensignupsmallbtn" value="Submit" name="submit" onclick="submit_regular_email()"/>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="optionbox_bottomborder"></div>
                                </div>