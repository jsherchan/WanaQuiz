<script src="<?=base_url()?>js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>js/ajaxupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.limit-1.2.source.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<link rel="stylesheet" href="<?=base_url()?>jquery-tooltip/jquery.tooltip.css" />

<script src="<?=base_url()?>jquery-tooltip/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?=base_url()?>jquery-tooltip/lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="<?=base_url()?>jquery-tooltip/jquery.tooltip.js" type="text/javascript"></script>

<script src="<?=base_url()?>jquery-tooltip/chili-1.7.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
$("#help a").tooltip({
	bodyHandler: function() {
		return $($(this).attr("href")).html();
	},
	showURL: false
});

$("#limit_chars a").tooltip({
	bodyHandler: function() {
		return $($(this).attr("href")).html();
	},
	showURL: false
});
})
</script>

<script type="text/javascript">
  var errorimg="Upload_Image_of_160X600";
   $(document).ready(function() {

       $("#help_tip").click(function(){
                     $("#helpnote").slideToggle(200);

                   });

                $("#chars_tip").click(function(){
                     $("#chars").slideToggle(200);

                   });
       
       
		var button = $('#button_0'), interval;
                //alert(banner_id);
                //return false;
		new AjaxUpload(button, {
			action: '<?=base_url()?>quiz/upload_banners/0/'+$("#banner_0").val(),
			name: 'userfile_0',
			onSubmit : function(file, ext){
				// change button text, when user selects file
				button.text('Uploading');
                                this._settings.action = '<?=base_url()?>quiz/upload_banners/0/'+$("#banner_0").val();
                                //alert(this._settings.action);
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				this.disable();

				// Uploding -> Uploading. -> Uploading...
				interval = window.setInterval(function(){
					var text = button.text();
					if (text.length < 13){
						button.text(text + '.');
					} else {
						button.text('Uploading');
					}
				}, 200);
			},
			onComplete: function(file, response){
				button.text('Upload');
                              // alert("this");
                             //  alert(response);
				window.clearInterval(interval);
                               //alert(response);
				// enable upload button
				this.enable();
                                var respArr = response.split("|");
                                var tmpId = respArr[1];
                                var bnrId = respArr[2];
                                $("#banner_"+tmpId).val('');
                                $("#banner_"+tmpId).val(bnrId);
				// add file to the list
                                //alert('<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respone);
                                 //var image=base64_encode('advertiser_banners/'+file);
				$('#banner_preview_0').html( '<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respArr[0]+'" alt='+errorimg+' width="170px" height="365px">' );
			}
		});


                var button1 = $('#button_1'), interval;
                //alert(banner_id);
                //return false;
		new AjaxUpload(button1, {
			action: '<?=base_url()?>quiz/upload_banners/1/'+$("#banner_1").val(),
			name: 'userfile_1',
			onSubmit : function(file, ext){
				// change button text, when user selects file
				button1.text('Uploading');
                                this._settings.action = '<?=base_url()?>quiz/upload_banners/1/'+$("#banner_1").val();
                                //alert(this._settings.action);
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				this.disable();

				// Uploding -> Uploading. -> Uploading...
				interval = window.setInterval(function(){
					var text = button1.text();
					if (text.length < 13){
						button1.text(text + '.');
					} else {
						button1.text('Uploading');
					}
				}, 200);
			},
			onComplete: function(file, response){
				button1.text('Upload');
                               //alert(response);
				window.clearInterval(interval);
                                //alert(response);
				// enable upload button
				this.enable();
                                var respArr = response.split("|");
                                var tmpId = respArr[1];
                                var bnrId = respArr[2];
                                $("#banner_"+tmpId).val('');
                                $("#banner_"+tmpId).val(bnrId);
				// add file to the list
                                //alert('<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respone);
                                 //var image=base64_encode('advertiser_banners/'+file);
				$('#banner_preview_1').html( '<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respArr[0]+'" alt='+errorimg+' width="170px" height="365px">' );
			}
		});


                var button2 = $('#button_2'), interval;
                //alert(banner_id);
                //return false;
		new AjaxUpload(button2, {
			action: '<?=base_url()?>quiz/upload_banners/2/'+$("#banner_2").val(),
			name: 'userfile_2',
			onSubmit : function(file, ext){
				// change button text, when user selects file
				button2.text('Uploading');
                                this._settings.action = '<?=base_url()?>quiz/upload_banners/2/'+$("#banner_2").val();
                                //alert(this._settings.action);
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				this.disable();

				// Uploding -> Uploading. -> Uploading...
				interval = window.setInterval(function(){
					var text = button2.text();
					if (text.length < 13){
						button2.text(text + '.');
					} else {
						button2.text('Uploading');
					}
				}, 200);
			},
			onComplete: function(file, response){
				button2.text('Upload');
                               //alert(response);
				window.clearInterval(interval);
                                //alert(response);
				// enable upload button
				this.enable();
                                var respArr = response.split("|");
                                var tmpId = respArr[1];
                                var bnrId = respArr[2];
                                $("#banner_"+tmpId).val('');
                                $("#banner_"+tmpId).val(bnrId);
				// add file to the list
                                //alert('<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respone);
                                 //var image=base64_encode('advertiser_banners/'+file);
				$('#banner_preview_2').html( '<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respArr[0]+'" title='+errorimg+' alt='+errorimg+' width="170px" height="365px">' );
			}
		});


                var button3 = $('#button_3'), interval;
                //alert(banner_id);
                //return false;
		new AjaxUpload(button3, {
			action: '<?=base_url()?>quiz/upload_banners/3/'+$("#banner_3").val(),
			name: 'userfile_3',
			onSubmit : function(file, ext){
				// change button text, when user selects file
				button3.text('Uploading');
                                this._settings.action = '<?=base_url()?>quiz/upload_banners/3/'+$("#banner_3").val();
                                //alert(this._settings.action);
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				this.disable();

				// Uploding -> Uploading. -> Uploading...
				interval = window.setInterval(function(){
					var text = button3.text();
					if (text.length < 13){
						button3.text(text + '.');
					} else {
						button3.text('Uploading');
					}
				}, 200);
			},
			onComplete: function(file, response){
				button3.text('Upload');
                               //alert(response);
				window.clearInterval(interval);
                                //alert(response);
				// enable upload button
				this.enable();
                                var respArr = response.split("|");
                                var tmpId = respArr[1];
                                var bnrId = respArr[2];
                                $("#banner_"+tmpId).val('');
                                $("#banner_"+tmpId).val(bnrId);
				// add file to the list
                                //alert('<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respone);
                                 //var image=base64_encode('advertiser_banners/'+file);
				$('#banner_preview_3').html( '<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respArr[0]+'" alt='+errorimg+'width="170px" height="365px"/>' );
			}
		});


                var button4 = $('#button_4'), interval;
                //alert(banner_id);
                //return false;
		new AjaxUpload(button4, {
			action: '<?=base_url()?>quiz/upload_banners/4/'+$("#banner_4").val(),
			name: 'userfile_4',
			onSubmit : function(file, ext){
				// change button text, when user selects file
				button4.text('Uploading');
                                this._settings.action = '<?=base_url()?>quiz/upload_banners/4/'+$("#banner_4").val();
                                //alert(this._settings.action);
				// If you want to allow uploading only 1 file at time,
				// you can disable upload button
				this.disable();

				// Uploding -> Uploading. -> Uploading...
				interval = window.setInterval(function(){
					var text = button4.text();
					if (text.length < 13){
						button4.text(text + '.');
					} else {
						button4.text('Uploading');
					}
				}, 200);
			},
			onComplete: function(file, response){
				button4.text('Upload');
                               //alert(response);
				window.clearInterval(interval);
                                //alert(response);
				// enable upload button
				this.enable();
                                var respArr = response.split("|");
                                var tmpId = respArr[1];
                                var bnrId = respArr[2];
                                $("#banner_"+tmpId).val('');
                                $("#banner_"+tmpId).val(bnrId);
				// add file to the list
                                //alert('<img src="<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respone);
                                 //var image=base64_encode('advertiser_banners/'+file);
				$('#banner_preview_4').html( '<a style="vertical-align:middle" href="#" style="display:block; background:url(<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/'+respArr[0]+') no-repeat 50% 50%; width:170px; height:365px;" alt='+errorimg+' ></a>' );
			}
		});


	});

        function close_help_tip(){
            $('#helpnote').hide();
        }

        function close_char_tip(){
            $('#chars').hide();
        }
      
</script>

<div class="padding_10topbottom">
        	<div class="quizmaking_topborder"></div>
            <div class="quizmaking_bg">
            	<div class="whiteboxrightside_bgInner">
                	<div class="content_10box">
                    	<div class="padding_10leftright">
                        	<div class="border_gray">
                            	<div class="content_10box">
                                	<div class="text_center">
                                    	<!--<img src="<?=base_url()?>images/quizmaking_chart.jpg" width="993" height="574" alt="quiz making video" />-->
                                            <img src="<?=base_url()?>images/quizmaking.png"  alt="quiz making video" />
                                            <p style="text-align:left">Below you can add your vertical banners or text advertisements. There is also the option to choose both:</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="borderbottom_dotted"></div>
                  
                    <?php  //echo $edit;
                    if($quiz_type=='video'){
                      if($edit==0)
                            $action = site_url('quiz/addVideoQuizAdvertiser');
                            else $action = site_url('quiz/editVideoQuizAdvertiser');
                           
                       }
                    else{
                        if($edit==0)
                            $action = site_url('quiz/addPhotoQuizAdvertiser');
                            else $action = site_url('quiz/editPhotoQuizAdvertiser');
                         }
                            ?>
                    <form name="add_advertiser_photo_question" action="<?=$action?>" method="post" enctype="multipart/form-data">
                    <div class="content_10box">
                    	<div class="padding_10leftright">
                        	
                            <div class="content_wrap">
                            	<div class="quizvideo_topborder"></div>
                                <div class="quizvideo_bg">
                                	<div class="content_10box">
                                    	<div class="bannerads_icon font14 bold">Banner ads</div>
                                    </div>
                                    <div class="borderbottom_dotted"></div>
                                    <div class="content_10box">
                                    	
                                        	Your banner will be displayed next to your question (and answer). Below you can select up to four banners to rotate beside your quiz. Banner dimensions can be up to 160x600 pixels or less.
                                       
                                    </div>
                                    <?php //print_r($banner_info);?>
                                    <div class="padding_10topbottom">
                                    <? for($i=0;$i<4;$i++){?>
                                    	<input type="hidden" id="banner_<?php echo $i; ?>" name="banner_<?=$i?>" value="<?php if($edit==1 && $banner_info[$i]->banner_id!='') echo $banner_info[$i]->banner_id; else echo 0?>">
                                        <div class="bannerads_uploadbox">
                                        	<div class="bannerads_uploadboxInner">
                                            	<div class="border_gray">
                                            	<div class="bg_gray">
                                                	<div class="bannerads_uploadboxheight">
                                                    	<div class="content_10box">
                                                            <div class="content_wrap">
                                                                <div class="border_gray" id="banner_preview_<?=$i?>" style="height:365px">
                                                                    <?php if($edit!=0) { ?>
                                                                    <a href="#" style="display:block; background:url(<?=base_url()?>advertiser_banners/advertiser_banner_thumbs/<?=$banner_info[$i]->banner_image;?>) no-repeat 50% 50%; width:170px; height:365px;"></a>
                                                                    <? } else { ?>
                                                                    <a href="#" style="display:block; background:url(<?=base_url()?>images/bannerads_img.jpg) no-repeat 50% 50%; width:170px; height:365px;"></a>
                                                                    <? }?>
                                                                </div>
                                                            </div>
                                                            <div>
                                                            	
                                                                    <div class="input_clear">
                                                                    	<label>File upload</label>
                                                                        <div class="clear"></div>
                                                                        <div class="searchbtn_leftborder"></div>
                                                                        <div id="button_<?=$i?>" class="searchbtn_bg" style="width:158px;"> Upload</div>
                                                                        <input type="hidden" id ="value_<?=$i?>" name="value_i" value="<?=$i?>">
                                                                        <input type="hidden" id ="edit_banner_id" name="edit_banner_id" value="<?php if($edit==1 && $banner_info[$i]->banner_id!='') echo $banner_info[$i]->banner_id; else echo 0?>">
                                                                        
                                                                        <div class="searchbtn_rightborder"></div>
                                                                        <!--<input type="file" name="banner_file_<?=$i?>" style="width:167px;" size="11" value="<?php if($edit!=0) echo $banner_info[$i]->banner_image;?>" />-->
                                                                    </div>
                                                                    <div class="input_clear">
                                                                    	<label>URL</label>
                                                                        <input type="text" class="textbox" name="banner_url_<?=$i?>" style="width:167px;" <?php if($edit!=0){?>value="<?php echo $banner_info[$i]->url;?>"<? } ?> />
                                                                    </div>
                                                                    <div class="input_clear">
                                                                    	<label>Banner name</label>
                                                                        <input type="text" class="textbox" name="banner_name_<?=$i?>" style="width:167px;"<?php if($edit!=0){?> value="<?php echo $banner_info[$i]->banner_name;?>"<?}?> />
                                                                    </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? }?>
                                                                            
                                        <div class="clear"></div>
                                    </div>
                                    <div class="padding_10leftright" id="help" style="position:relative;">
                                    	 <div id="help_tip" style="cursor:pointer; color:#0066CC;">Help</div>
                                         <div id="helpnote" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:0px; left:50px; background-color:#F0F0F0;">
                                             <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer" onclick="close_help_tip()"> X </p>
                                             <p><strong>File Upload: </strong>You can upload your vertical banner(120 by 600 pixels or 160 by 600 pixels)</p><br>
                                            <p><strong>URL: </strong>the URL of your site or page that users will go to after clicking your banner.</p><br>
                                            <p><strong>Banner name: </strong>distinct name you give this banner so you can follow its performance in our reports.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="quizvideo_bottomborder"></div>
                            </div>
                            
                            <div>
                            
                                	<div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="textads_icon font14 bold">Text ads </div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                            	<div class="content_wrap">
                                                	<div>
                                                    	<div>Up to five text ads will be displayed beside your question and answer.</div>
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="content_wrap" style="float:left; width:50%">
                                                	<div class="bold">This is what the three input fields below will produce:</div>
                                                    <div class="content_10box">
                                                    	<div class="input_clear">
                                                        	<div class="textadd_egleft text_right">Your clickable (descriptive) link: </div>
                                                                <div class="textadd_egleft"><a href="#" style="color:#0066CC; font-weight:bold;"> &nbsp;WannaQuiz</a></div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="input_clear">
                                                        	<div class="textadd_egleft text_right">Your discription (non clickable): </div>
                                                            <div class="textadd_egleft"> &nbsp;People dress up or show objects while asking questions.</div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="input_clear">
                                                        	<div class="textadd_egleft text_right">Your clickable link: </div>
                                                            <div class="textadd_egleft"><a href="#" style="color:#04A56F; font-size:10px;"> &nbsp;www.wannaquiz.com </a></div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="content_wrap" style="float:left; width:50%">
                                                	<div class="bold">Your text ad will be shown in the following way. The other ads (up to five text ads) are displayed below the first advertisement: </div>
                                                        <div class="content_10box" style="text-align:center">
                                                    	<div class="">

                                                                <div class="textadd_egleft"><a href="#" style="color:#0066CC; font-weight:bold;"> &nbsp;WannaQuiz</a></div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="">

                                                            <div class="textadd_egleft"> &nbsp;People dress up or show objects while asking questions.</div>

                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="">

                                                            <div class="textadd_egleft"><a href="#" style="color:#04A56F; font-size:10px;"> &nbsp;www.wannaquiz.com </a></div>

                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                         
                                            <div><?php //print_r($long_text_info)?>
                                             <? for($i=0;$i<5;$i++){ ?>
                                                <input type="hidden" name="long_text_<?=$i?>" value="<?php echo $long_text_info[$i]->id;?>">
                                            	<div class="textadsbox">
                                                	<div class="textadsboxInner">
                                                    	<div class="border_gray">
                                                        	<div class="bg_gray">
                                                            	<div class="textadsbox_height">
                                                                    <div class="content_10box">
                                                                        <div class="textadsbox_left"><div class="font24 italic"><?=$i+1?></div></div>
                                                                        <div class="textadsbox_right">
                                                                        	<div class="textadsform">
                                                                            	<div class="input_clear">
                                                                                	<label>Your clickable title:</label>
                                                                                    <input type="text" id ="long_text_ads_title_<?=$i?>" name="long_text_ads_title_<?=$i?>" class="textbox" style="width:215px;" value="<?php if($edit!=0) echo $long_text_info[$i]->link_title;?>"  />
                                                                                     <label>&nbsp;</label><span style="font-size:10px"><span id="titleCharsLeft_<?=$i?>"></span> chars left.</span>
                                                                                    <script type="text/javascript">
                                                                                        $('#long_text_ads_title_<?=$i?>').limit('25','#titleCharsLeft_<?=$i?>');
                                                                                    </script>
                                                                                    <!--<div class="error_msg" style="padding-left:205px;">!Error here...</div>-->
                                                                                </div>
                                                                                <div class="input_clear">
                                                                                	<label>Your text ad (non clickable) : <?php if($i<1){ ?>(not more than 70 characters)<? } ?></label>
                                                                                    <textarea id="long_text_ads_description_<?=$i?>" name="long_text_ads_description_<?=$i?>" style="width:215px; height:80px;" class="textbox"><?php if($edit!=0) echo $long_text_info[$i]->link_description;?></textarea>
                                                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="charsLeft_<?=$i?>"></span> chars left.</span>
                                                                                    <script type="text/javascript">
                                                                                        $('#long_text_ads_description_<?=$i?>').limit('70','#charsLeft_<?=$i?>');
                                                                                    </script>
                                                                                    

                                                                                </div>
                                                                                <div class="input_clear">
                                                                                	<label>Your clickable URL :</label>
                                                                                    <input type="text" id="long_text_ads_url_<?=$i?>" name="long_text_ads_url_<?=$i?>" class="textbox" style="width:215px;" value="<?php if($edit!=0) echo $long_text_info[$i]->link_url;?>"  />
                                                                                    <!--<label>&nbsp;</label><span style="font-size:10px"><span id="urlCharsLeft_<?=$i?>"></span> chars left.</span>
                                                                                    <script type="text/javascript">
                                                                                        $('#long_text_ads_url_<?=$i?>').limit('35','#urlCharsLeft_<?=$i?>');
                                                                                    </script>-->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            
                                                    </div>
                                                </div>
                                             <? }?>
                                                                                         
                                                <div class="clear"></div>
                                                
                                                <div style="padding:10px; position:relative;" id="limit_chars">
                                                    <div id="chars_tip" style="cursor:pointer; color:#0066CC;">How many characters are in each field?</div>
                                                    <div id="chars" style="display:none; position:absolute; width:300px; padding:10px; border:1px solid #AAA; z-index: 9999; top:30px; left:50px; background-color:#F0F0F0;">
                                                        <p style="text-align:right; color:#0066CC; font-size:14px; font-weight:bold; cursor:pointer" onclick="close_char_tip()"> X </p>
                                                        <p><strong>Your clickable title: </strong>up to 25 characters</p><br>
                                                        <p><strong>Your text ad (non clickable): </strong>up to 70 characters</p><br>
                                                        <p><strong>Your clickable URL: </strong>up to 35 characters</p>
                                                    </div>
                                                </div>
                                           
                                           
                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>
                                    
                                    <div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="textads_icon font14 bold">Text ads inside the player</div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                            	<div class="content_wrap">
                                                	<div>
                                                    	After an user sees the answer to your question our software will create a thumbnail of your question (photo or video) and displays it in the player. The text that accompanies your thumbnail is: "Offer from publisher of last question:". Below you can enter up to 5 text ads (offers) beside your thmubnail.
                                                    </div>
                                                </div>
                                                
                                                <div class="content_wrap">
                                                	<div class="bold">This is what the text ad may look like in the player:</div>
                                                    <div class="padding_10top">
                                                    	<div style="width:498px;">
                                                            <div class="bg_skylightblue">
                                                                <div class="content_5box">
                                                                	<div class="textads_img"><img src="<?=base_url()?>images/text_ad_img.png" width="66" height="50" alt="text add img" /></div>
                                                                    <div class="textads_desc font11">
                                                                    	<div>Offer by publisher of last question:</div>
                                                                        <div class="input_clear">
                                                                        	<a href="#" style="color:#0033CC; text-decoration:none; font-weight:bold;">Here comes your text ad.</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                         
                                            <div><?php //print_r($short_text_info);?>
                                               <? for($i=0;$i<5;$i++){?>
                                                <input type="hidden" name="short_text_<?=$i?>" value="<?php echo $short_text_info[$i]->id;?>">
                                            	<div class="textadsbox">
                                                	<div class="textadsboxInner">
                                                    	<div class="border_gray">
                                                        	<div class="bg_gray">
                                                            	<div class="textadsbox_height">
                                                                    <div class="content_10box">
                                                                        <div class="textadsbox_left"><div class="font24 italic"><?=$i+1?></div></div>
                                                                        <div class="textadsbox_right">
                                                                        	<div class="textadsform">
                                                                            	
                                                                                <div class="input_clear">
                                                                                	<label>Your text ad after your question <?php if($i<1){ ?>(not more than 80 characters)<? } ?> :</label>
                                                                                    <textarea id="short_text_ads_descrption_<?=$i?>" name="short_text_ads_descrption_<?=$i?>" style="width:215px; height:80px;" class="textbox"><?php if($edit!=0) echo $short_text_info[$i]->link_short_desc;?></textarea>
                                                                                    <label>&nbsp;</label><span style="font-size:10px"><span id="shortCharsLeft_<?=$i?>"></span> chars left.</span>
                                                                                    <script type="text/javascript">
                                                                                        $('#short_text_ads_descrption_<?=$i?>').limit('70','#shortCharsLeft_<?=$i?>');
                                                                                    </script>
                                                                                </div>
                                                                                    <div class="input_clear">
                                                                                	<label>Link URL:</label>
                                                                                        <input type="text" id="link_url_<?=$i?>" name="link_url_<?=$i?>" class="textbox" size="45" value="<?php if($edit!=0) echo $short_text_info[$i]->link_url;?>"/>
                                                                                         <!--<label>&nbsp;</label><span style="font-size:10px"><span id="shortUrlCharsLeft_<?=$i?>"></span> chars left.</span>
                                                                                        <script type="text/javascript">
                                                                                            $('#link_url_<?=$i?>').limit('35','#shortUrlCharsLeft_<?=$i?>');
                                                                                        </script>-->
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <? }?> 
                                                                                             
                                                <div class="clear"></div>
                                            </div>
                                          
                                                                                      
                                            
                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>
                                    <input type="hidden" name="ads_rotation" value="yes">
                                    <!--<div class="content_wrap">
                                        <div class="quizvideo_topborder"></div>
                                        <div class="quizvideo_bg">
                                            <div class="content_10box">
                                                <div class="optionads_icon font14 bold">Options</div>
                                            </div>
                                            <div class="borderbottom_dotted"></div>
                                            <div class="content_10box">
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="quizvideo_bottomborder"></div>
                                    </div>
                                    -->
                                    
                                    <div class="input_clear">
                                    	<div style="padding-left:305px;">
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="button" class="searchbtn_bg" value="Back" onclick="javascript:document.location.href='<?=site_url('quiz/addPhotoQuizStep2')?>'" />
                                        <div class="searchbtn_rightborder" style="margin-right:20px;"></div>
                                        
                                        <div class="searchbtn_leftborder"></div>
                                        <input type="submit" class="searchbtn_bg" value="Save" name="submit" />
                                        <div class="searchbtn_rightborder"></div>
                                        
                                        <div class="clear"></div>
                                        </div>
                                    </div>
                                    
                              
                            </div>
                            
                        </div>
                    </div>
                  </form>
                </div>
            </div>
            <div class="quizmaking_bottomborder"></div>
        </div>
</div>