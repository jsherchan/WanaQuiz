<?#=var_dump($company_detail)?>
<?#=var_dump(get_defined_vars())?>
    <!-- AJAX Upload script itself doesn't have any dependencies-->
    <script type="text/javascript" src="<?=base_url()?>js/ajaxupload.js"></script>


<!--<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>-->


<script type="text/javascript">
	$(document).ready(function(){
		
		var button = $('#button1'), interval;
		
		new AjaxUpload(button, {
			action: '<?=base_url()?>member/uploadProfilePicture', 
			name: 'userfile',
			onSubmit : function(file, ext){
				// change button text, when user selects file			
				button.text('Uploading');
								
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
//console.log(response);
				window.clearInterval(interval);
							
				// enable upload button
				this.enable();
				
				// add file to the list
				$('#profile_image').html( '<img src="<?=base_url()?>user_profile_images_thumb/'+file+'" alt="avatar" />' );						
			}
		});	
			
	});

/*
function changePassword(newpswd,renew,oldpswd){
		
	$.post('<?=base_url()?>member/changePassword', {newpassword:newpswd,renew:renew,oldpassword:oldpswd} , function(data)
	{			
			   if (data != '' || data != undefined || data != null) 
			   {	
			  		dt=data.split('|');
			   	
				 $('#change_password_div').html(dt[2]);
				 if(dt[0]=='success')
				 	 $('#success_message').html(dt[1]);
					
				else{
					if(dt[0]=='oldpassword')
					 $('#error_old_password').html(dt[1]);
					if(dt[0]=='newpassword')
					 $('#error_new_password').html(dt[1]);
				}
				//$.prompt(dt[0]);
			   }
			 
     });		
	
}


function changeEmail(newemail,old){
	
	$.post('<?=base_url()?>member/changeEmail', {newemail:newemail,old:old} , function(data)
	{			
			   if (data != '' || data != undefined || data != null) 
			   {	
			   	 	
			  		dt=data.split('|');
			  
				 $('#change_email_div').html(dt[2]);
				 if(dt[1]=='success'){
				 	 $('#success_message').html(dt[1]);
					$('#changed_email').html('<input type="text" class="textbox" name="currentemail" value="'+newemail+'"/>');
				}
					
				else{
					 $('#error_new_email').html(dt[1]);
				}
				//$.prompt(dt[0]);
			   }
			 
     });		
	
}
*/

function show_more_sites(id){
    $('#more_sites'+id).toggle();
    $('#add_more'+(id-1)).hide();
    
}

/*function updatePublicprofile()
{
   var firstname = $('#fname').val();
   var lastname = $('#lname').val();
   var dod = $('#dod').val();
   var dom = $('#dom').val();
   var doy = $('#doy').val();
   var website = $('#website').val();
   var profile_desc = $('#profile_description').val();
   var subject = $('#subject').val();
   var company_name = $('#company_name').val();
   var company_website = $('#company_website').val();
   var company_info = $('#company_desc').val();
   var personal_info = $('#personal_desc').val();
   var user_type =  $('#user_type').val();
   var banner1 = $('#banner1').val();
   var banner2 = $('#banner2').val();

   $.post('<?=base_url()?>member/editProfile', {fname:firstname,lname:lastname,dod:dod,dom:dom,doy:doy,website:website,profile_desc:profile_desc,subject:subject,company_name:company_name,company_website:company_website,company_info:company_info,personal_info:personal_info,user_type:user_type,banner1:banner1,banner2:banner2} , function(data)
   {
       alert(data);return;
        if (data != '' || data != undefined || data != null)
			   {

			  		dt=data.split('|');

				 $('#edit_profile').html(dt[2]);
				 if(dt[1]=='success'){
				 	 $('#success_message').html(dt[0]);
					//$('#changed_email').html('<input type="text" class="textbox" name="currentemail" value="'+newemail+'"/>');
				}

				else{
					 $('#error_div').html(dt[1]);
				}
				//$.prompt(dt[0]);
			   }
			 
   });
   
}
*/

</script>
<script>
      
     var code;
     function dochange(id)
{
    code=id;
    if(id!='')
        $('#list_state').load('<?=base_url()?>registration/get_states',{pid:id});
    else
        $('#list_state').html('<select><option value="">- Select State -</option></select>');
}
    function dochanges(id)
{
    if(id!='')
        $('#list_city').load('<?=base_url()?>registration/get_cities',{country_code:code,pid:id});
    else
        $('#list_city').html('<select><option value="">- Select State -</option></select>');
}

</script>
<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">Update Public Profile</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                                <div class="content_10box">
                                	<div class="content_wrap">
                                		<div class="bold font14">Edit personal details</div>
                                        <div class="padding_10topbottom">
                                        	<div class="bold">Change email address</div>
                                            <form name="change_email" action="<?=base_url()?>member/editProfile/email" method="post">
                                            	<div class="general_form" id="change_email_div">
                                                	<div class="input_clear">
                                                    	<label>Current email</label>
                                                        <input type="text" class="textbox" name="currentemail" value="<?=$mem_profile->email?>" readonly />
                                                       
                                                    </div>
                                                    <div class="input_clear">
                                                    	<label>New email</label>
                                                        <input type="text" class="textbox" name="newemail"  />
                                                         <div class="error_msg" style="padding-left:165px;"  id="error_email" >
                                                            <?php                                                                 
                                                                if($this->session->userdata('update_email'))
                                                                {
                                                                    echo $this->session->userdata('update_email');
                                                                    $this->session->unset_userdata('update_email');
                                                                }
                                                            ?>
                                                         </div>
                                                    </div>
                                                </div>
                                                <div class="input_clear">
                                                	<div style="padding-left:165px;">
                                                    	<div class="searchbtn_leftborder"></div>
                                                        <input type="submit" class="searchbtn_bg" name="savebtn" value="Change" />
                                                        <!--input type="button" class="searchbtn_bg" name="savebtn" value="Save" onclick="changeEmail(document.change_email.newemail.value,document.change_email.currentemail.value)" /-->
                                                        <div class="searchbtn_rightborder"></div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="content_wrap">
                                        <div class="padding_10topbottom">
                                        	<div class="bold">Change password</div>
                                            <form name="change_password" action="<?=base_url()?>member/editProfile/password" method="post">
                                            	<div class="general_form" id="change_password_div">
                                                	<div class="input_clear">
                                                    	<label>Current Password</label>
                                                        <input type="password" class="textbox" name="oldpassword" />                                                        
                                                    </div>
                                                    <div class="input_clear">
                                                    	<label>New Password</label>
                                                        <input type="password" class="textbox" name="newpassword"  />
                                                    </div>
                                                    <div class="input_clear">
                                                    	<label>Retype New Password</label>
                                                        <input type="password" class="textbox" name="re_newpassword"  />
                                                    </div>
                                                    <div class="error_msg" style="padding-left:165px;" id="error_password">
                                                            <?php 
                                                                if($this->session->userdata('update_password'))
                                                                {
                                                                    echo $this->session->userdata('update_password');
                                                                    $this->session->unset_userdata('update_password');
                                                                }                                                                
                                                            ?>
                                                    </div>
                                                </div>
                                                <div class="input_clear">
                                                	<div style="padding-left:165px;">
                                                    	<div class="searchbtn_leftborder"></div>
                                                        <input type="submit" class="searchbtn_bg" name="savebtn" value="Change" />
                                                        <!--input type="button" class="searchbtn_bg" name="savebtn" value="Save" onclick="changePassword(document.change_password.newpassword.value,document.change_password.re_newpassword.value,document.change_password.oldpassword.value)"/-->
                                                        <div class="searchbtn_rightborder"></div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                      <div class="content_wrap">
                                        <div class="padding_10topbottom">
                                        	<div class="bold">Change Address</div>
                                            <form name="change_password" action="<?=base_url()?>member/editProfile/address" method="post">
                                            	<div class="general_form" id="change_password_div">
                                                	<div class="input_clear">
                                                            <label>Country</label>
                                                      
                                                            <select name="country" id="country" onchange="dochange(this.value);"  >
                                                        <option value="">Select Country</option>
                                                        <?php foreach($country_list as $row){
//                                                                  ?>
                                                         <option value="<?=$row->country_code?>" <?php if($mem_add->country==$row->country_name) echo 'selected="selected"';?>><?=$row->country_name?></option>
                                                        <?php }?>
                                                    </select>
                                                    </div>
                                                    <div class="input_clear">
                                                    	<label> <span class="color_orange"></span> State</label>
                                                        <div id="list_state">
                                                        <select name="state" id="state" onchange="dochanges(this.value);">
                                                               <option value="<?php echo $mem_add->state?>"><?php echo $mem_add->state?></option>
                                                            </select></div>
                                                 </div>
                                                    <div class="input_clear">
                                                    	<label> <span class="color_orange">*</span> City</label>
                                                        <div id="list_city">
                                                        <select name="city" id="city" class="" onchange="dochanges(this.value);">
                                                               <option value="<?php echo $mem_add->city?>"><?php echo $mem_add->city?></option>
                                                            
                                                  </select></div>
                                                  
                                                     </div>
                                                    
                                                </div>
                                                <div class="input_clear">
                                                	<div style="padding-left:165px;">
                                                    	<div class="searchbtn_leftborder"></div>
                                                        <input type="submit" class="searchbtn_bg" name="savebtn" value="Change" />
                                                        <div class="searchbtn_rightborder"></div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="borderbottom_dotted"></div>
                                
                                <div class="content_10box">
                                	<div class="content_wrap">
                                		<div class="bold font14" id="update_profile">Update public profile</div>
                                        <div class="padding_10topbottom">
                                        	<div class="bold">Change logo or avatar</div>
                                            <form name="change_profile" action="<?=base_url()?>member/editProfile/profile" method="post" enctype="multipart/form-data">
                                                <input type="hidden" id="user_type" value="<?php echo $mem_info->user_type;?>" name="user_type">                                                
                                            	<div class="general_form">
                                                	<div class="input_clear">
                                                    	<label>
                                                      
                                                      <span id="profile_image">
                                                <? if($mem_profile->profile_picture!="") {?>
                                                   <? if($this->session->userdata('wannaquiz_fb_id')||$this->session->userdata('wannaquiz_tw_id')) { ?>
                                                          <img src="<?=$mem_profile->profile_picture?>" alt="avatar" /> <? } else {?>
                                                          <img src="<?=base_url()?>user_profile_images_thumb/<?=$mem_profile->profile_picture?>" alt="avatar" /> 
                                                   <? } ?>                                                       
                                                   <? } else {?>
                                                       <img src="<?=base_url()?>images/avatar_img.jpg" width="50" height="50" alt="avatar" /><? }?>
                                                        </span></label>
                                                        <div style="padding-top:15px;">
                                                        <div class="searchbtn_leftborder"></div>
                                                      <div id="button1" class="searchbtn_bg" style="width:198px;"> Upload<!-- <input type="button" class="searchbtn_bg" id="button1" name="savebtn" value="Upload" />--></div>
                                                        <div class="searchbtn_rightborder"></div>
                                                        </div>
                                                     </div>
                                                    
                                                </div>                                               
                                                        <div id="error_div" class="general_form" style="color:red"></div>
                                                        <div id="success_message" class="general_form"></div>
                                                        <div id="edit_profile">
                                                            <div class="general_form padding_10top">
                                                                <div class="input_clear">
                                                                    <label>First Name</label>
                                                                    <input type="text" class="textbox" name="fname" value="<?=$mem_profile->first_name;?>" id="fname" />
                                                                </div>
                                                                <div class="input_clear">
                                                                    <label>Surname</label>
                                                                    <input type="text" class="textbox" name="lname" value="<?=ucfirst($mem_profile->last_name);?>" id="lname"/>
                                                                </div>                                                               
                                                                <?php if($mem_info->user_type == 0) { ?>
                                                                  <?php if($mem_profile->other_website1=='')
                                                                $display = 'block';
                                                                else $display='none'; ?>
                                                                <div class="input_clear" style="float:left" >
                                                                    <label>Website</label>
                                                                    <input type="text" class="textbox" name="website" value="<?=$mem_profile->website;?>" id="website"/>
                                                                </div>
                                                                    <div id="add_more0" onclick="show_more_sites('1')" style="cursor:pointer; padding:10px; color:#0066CC; display:<?=$display?>; float:left ">Add More</div>
                                                                    <div class="clear"></div>
                                                               
                                                                <?php
                                                                
                                                                for($i=1;$i<=3;$i++){$websites="other_website".$i; 
                                                                    if($mem_profile->$websites=='')
                                                                     $display = 'none';
                                                                    else $display='block';
                                                                    $website="other_website".($i+1);
                                                                   
                                                                    if($mem_profile->$website=="")
                                                                          $disp ='blcok';
                                                                     else  $disp='none';?>
                                                                   <div id="more_sites<?=$i?>" style="display:<?=$display?>">
                                                                    <div class="input_clear" style="float:left; ">
                                                                        <label>Other
                                                                            <p style="font-size:10px">(Link to your other site)</p>
                                                                        </label>
                                                                        <input type="text" class="textbox" name="other_website<?=$i?>" value="<?=$mem_profile->$websites?>" id="other_website<?=$i?>"/>
                                                                    </div>
                                                                       <?if($i<3){?>
                                                                       
                                                                       <div id="add_more<?=$i?>" onclick="show_more_sites('<?=$i+1?>')" style="cursor:pointer; padding:10px; display:<?=$disp?>; color:#0066CC; float:left">Add More</div>
                                                                    <?}?>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                    
                                                                <? }}
                                                           
                                                               if($mem_info->user_type ==0){
                                                                    ?>
                                                                       
                                                                <div class="input_clear">
                                                                    <label>Bio
                                                                    </label>
                                                                    <textarea class="textbox" name="profile_description" style="width:300px; height:100px;" id="profile_description"><?=$mem_profile->profile_description;?></textarea>
                                                                </div>
                                                                    <?}?>
                                                                <!--<div class="input_clear">
                                                                    <label>Subject</label>
                                                                    <input type="text" class="textbox" name="subject" value="<?=$mem_profile->subject;?>" id="subject"/>
                                                                </div>-->
                                                            </div>
                                                            <div class="error_msg" style="padding-left:165px;" id="error_profile">
                                                            <?php 
                                                                if($this->session->userdata('update_profile'))
                                                                {
                                                                    echo $this->session->userdata('update_profile');
                                                                    $this->session->unset_userdata('update_profile');
                                                                }                                                                
                                                            ?>
                                                            </div>
                                                            <?php if($mem_info->user_type != 0) { ?>
                                                            <div class="bold">Company Information</div>
                                                            <div class="general_form padding_10top">
                                                                <div class="input_clear">
                                                                    <label>Company Name</label>
                                                                    <input type="text" class="textbox" name="company_name" value="<?=$company_detail->company_name?>" id="company_name" />
                                                                </div>
                                                                <div class="input_clear">
                                                                    <label>Company Website</label>
                                                                    <input type="text" class="textbox" name="company_website" value="<?=$company_detail->company_website?>" id="company_website" />
                                                                </div>
                                                            </div>

                                                            <div class="general_form">
                                                                <div class="input_clear">
                                                                 
                                                                    <label>Company information</label>
                                                                    <textarea class="textbox" name="company_desc" style="width:300px; height:100px;" id="company_desc"><?=$company_detail->company_info;?></textarea>
                                                                </div>
                                                                 <?php if($mem_info->user_type ==0){
                                                                    ?>
                                                                <div class="input_clear">
                                                                    <label>Personal information 
                                                                        <p style="font-size:10px">(optional eg why did you started your company?)</p>
                                                                    </label>
                                                                    <textarea class="textbox"  name="personal_desc" style="width:300px; height:100px;" id="personal_desc"><?=$company_detail->personal_information;?></textarea>
                                                                </div>
                                                                <?php }?>    
                                                            </div>
                                                        
                                                        <?php }?>
                                                        </div>
                                                <div class="input_clear">
                                                	<div style="padding-left:165px;">
                                                    	<div class="searchbtn_leftborder"></div>
                                                        <input type="submit" class="searchbtn_bg" name="savebtn" value="Save" />
                                                        <div class="searchbtn_rightborder"></div>
                                                        
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bottomborder"></div>
                    </div>
                </div>
            </div>

