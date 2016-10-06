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
                                <div class="bold font14 color_white">Choose your account type</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                    	<div class="content_10box">
                        	<div class="signupoption_left">
                            	<?php include('login_advertiser.php'); ?>
                            </div>
                            <div class="signupoption_right">
                            	<?php include('login_regular.php'); ?>
                            </div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
            
        </div>
        
        <?php $this->load->view('include/dressed_widget'); ?>
    
    	<div class="clear"></div>
    </div>
</div>