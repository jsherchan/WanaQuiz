<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("#addmore").click( function() {
                      	$("#nameFields").append(" <div class='input_clear'><label>Friend's email </label><input type='text' class='textbox' name='email[]' /></label></div>");
                 });
	});
</script>

<div class="midside">
                <div class="midsideInner">
                    <div class="content_wrap">
                        <div class="whiteboxmidside_topborder">
                            <div class="title_align">
                                <div class="bluetitlebg_leftborder"></div>
                                <div class="bluetitlebg_bg" style="width:470px;">
                                    <div class="bold font14 color_white">Refer Friends</div>
                                </div>
                                <div class="bluetitlebg_rightborder"></div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="whiteboxmidside_bg">
                            <div class="whiteboxrightside_bgInner">
                            	<div class="content_10box">
                                	<div class="content_wrap">
                                    Invite one or more of your friends to WannaQuiz:
                                    </div>
                                    <?php if($this->session->flashdata('error_message')!=''){ ?>
                                    <div style="color:red">
                                        <?php  echo $this->session->flashdata('error_message');?>                                        
                                    </div>
                                    <? } else {?>
                                    <div style="color:#0066cc">
                                        <?php  echo $this->session->flashdata('message');?>
                                    </div>
                                    <? }?>
                                    <div class="padding_10topbottom">
                                    	<form name="referfren" action="<?=site_url('member/invitefriend')?>" method="post">
                                            <div class="general_form">
                                                <div id="nameFields">
                                                <div class="input_clear">
                                                    <label>Friend's email 1</label>
                                                    <input type="text" class="textbox" name="email[]" />
                                                </div>
                                                <div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message[]"></textarea>
                                                </div>
                                                <div class="input_clear">
                                                    <label>Friend's email 2</label>
                                                    <input type="text" class="textbox" name="email[]" />
                                                </div>
                                                    <div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message[]"></textarea>
                                                </div>
                                                <div class="input_clear">
                                                    <label>Friend's email 3</label>
                                                    <input type="text" class="textbox" name="email[]" />
                                                </div><div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message[]"></textarea>
                                                </div>
                                                <div class="input_clear">
                                                    <label>Friend's email 4</label>
                                                    <input type="text" class="textbox" name="email[]" />
                                                </div><div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message[]"></textarea>
                                                </div>
                                                <div class="input_clear">
                                                    <label>Friend's email 5</label>
                                                    <input type="text" class="textbox" name="email[]" />
                                                    <!--<a href="#" style="margin-left:5px;" id="addmore">Add more</a>-->
                                                </div>
                                                    <div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message[]"></textarea>
                                                </div>
                                                </div>
                                               <!-- <div class="input_clear">
                                                    <label>Title</label>
                                                    <input type="text" class="textbox" name="emailadd" />
                                                </div>
                                                <div class="input_clear">
                                                    <label>Include question</label>
                                                    <select>
                                                        <option></option>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="input_clear">
                                                    <label>Personal message</label>
                                                    <textarea class="textbox" style="width:295px; height:80px;" name="message"></textarea>
                                                </div>-->
                                            </div>
                                            <div class="input_clear">
                                            	<div style="padding-left:160px;">
                                                	<div class="searchbtn_leftborder"></div>
                                                    <input type="submit" class="searchbtn_bg" name="submit" value="Send" style="padding:0 10px;" />
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