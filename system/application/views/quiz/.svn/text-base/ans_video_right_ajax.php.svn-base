
  <div class="padding_10topbottom">
    <div class="font16">The answer <img src="<?=base_url()?>images/arrowdown_gray.jpg" width="12" height="13" alt="arrow down" />
    <?php if($edit==0)$page = 'undoAddVideoQuestion'; else $page = 'undoEditVideoQuestion/'.$quiz_id;?><a href="<?=base_url()?>member/<?=$page?>/second">Undo</a></div>
  </div>
  <!--<img src="<?=base_url()?>images/quizans_img2.jpg" width="490" height="334" alt="quiz answer video" />-->
  <div class="border_green" id="video_answer"></div>
  <?php /*if($edit==1) { */
										 $vid_ans = explode(".",$ans_video);
										 if($vid_ans[0]==""){
										 $vid_ans[0] = "novideo";
										 }?>
  <!--<a href="<?=base_url().'uploaded_video_answers/'.$vid_ans[0].'.flv'?>" style="display:block;width:180px;height:135px" id="player_b"></a>
                                                <script>
                                                    flowplayer("player_b", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                                                        clip: {
                                                            // these two configuration variables does the trick
                                                            autoPlay: false,
                                                            autoBuffering: true // <- do not place a comma here
                                                        }
                                                    });
                                                </script>  -->
  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="490" HEIGHT="308" id="banner_rotativo" ALIGN="">
    <PARAM NAME=movie VALUE="<?=base_url()?>flowplayer/video_ans.swf?q=<?=$vid_ans[0]?>.flv">
    <PARAM NAME=quality VALUE=high>
    <PARAM NAME=bgcolor VALUE=#000000>
    <PARAM NAME="WMode" VALUE="opaque">
    <param name="allowScriptAccess" value="sameDomain" />
    <EMBED wmode="opaque" src="<?=base_url()?>flowplayer/video_ans.swf?q=<?=$vid_ans[0]?>.flv" quality=high bgcolor=#000000 WIDTH="490" HEIGHT="308" NAME="banner_rotativo" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
  </OBJECT>
  <? /*}*/ ?>
 