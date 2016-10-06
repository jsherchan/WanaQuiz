<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administrator</title>
<link href="<?=base_url()?>css/admin_css/layout.css" rel="stylesheet" type="text/css">
<!--[if lte IE 6]>
		<link href="http://proshore.eu/haico/auctionsite//css/admin_css/ie-6.css" rel="stylesheet" type="text/css" />
<![endif]-->

	
<!--[if IE 7]>
	<link href="http://proshore.eu/haico/auctionsite//css/ie-7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<body>

<div id="wrapper">
	<div id="wrapperInner">
        <div id="logo"><a href="#">Logo of the site</a></div>
				
        <div id="login_outerbox">
        	<div id="login_formbg">
                        <div id="login_left">
                    <?php
					if(isset($message))
					{
						echo "<div><font color='#CC0000'>".$message."</font></div>";
					}
				?>
                    	<div id="loginInner">
                       <form name="login_form" method="post" action="<?=site_url(ADMIN_PATH.'/users/login/')?>" ?>
                                <fieldset>
                                    <div class="input_login">
                                        <label>User name</label>
                                        <input id="username" type="text" 
                        name="username" class="login_textbox">
                                    </div>
                                    <div class="input_login">
                                        <label>Password</label>
                                        <input id="password" type="password" 
                        name="password" class="login_textbox" >
                                    </div>
                                    <div class="login_btn_align">
                                    	<div class="login_btn"><a href="javascript:document.login_form.submit()">Login</a></div>
                                    </div>
                                </fieldset>
                         <input type="submit" style="display:none" />
						    </form>
                        </div>
                    </div>
                    
                    <div id="lock_img"></div>
            	<div class="clear"></div>
            </div>
            <div class="login_footer">
            	<div class="login_footerleft">
            	Login to the Administrator Zone.
                </div>
            	
            </div>
            
        </div>
    </div>
</div>

</body></html>