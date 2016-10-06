<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>

<h2 class="headingclass" >Quiz Management</h2>

<SCRIPT language="javascript">
function doconfirm()
{
	job=confirm("Are You Sure To Delete This user Permanently?");
	if(job!=true)
	{
		return false;
	}
}

function checkAll()
{
	for (var i=0;i<document.forms[0].elements.length;i++)
	{
		var e=document.forms[0].elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.forms[0].allbox.checked;
		}
	}
}

function checkfill()
{
	var count=0;
	if(document.frm.newsl_id.value=='')
	{
		alert('Please Select the newsletter');
		document.frm.newsl_id.focus();
		return false;
	}

}

function active_quiz(id)
{
	jQuery.post('<?=base_url()?>quiz/activeQuiz', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('Successfully activated');
                               location.reload();
                            }
                            else alert('error');

                        }
        });

}

function deactive_quiz(id)
{
	jQuery.post('<?=base_url()?>quiz/deactiveQuiz', {quiz_id:id} , function(data){
            if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('Successfully deactivated' );
                                location.reload();
                            }
                            else alert('error');

                        }
        });

}

function feature_quiz(id,status)
{
	jQuery.post('<?=base_url()?>quiz/featureQuiz', {quiz_id:id,status:status} , function(data){
            if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('Successfully activated');
                               location.reload();
                            }
                            else alert('error');

                        }
        });

}

function try_new_quiz(id,status)
{
	jQuery.post('<?=base_url()?>quiz/tryNewQuiz', {quiz_id:id,status:status} , function(data){
            if (data != '' || data != undefined || data != null)
                        {

                            if(data=='success')
                            {
                                alert('Successfully deactivated' );
                                location.reload();
                            }
                            else alert('error');

                        }
        });

}
</SCRIPT>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="admin">ADMIN</a> 
            >> <a href="<?=site_url(ADMIN_PATH.'/media_comment_management')?>">Media Comment Management </a> >>
            <?php if ($flag =='featured_quiz_image') echo 'Featured Image Quizes';
                else if($flag == 'featured_quiz_video') echo ' Featured Video Quizes ';
                else if($flag == 'try_new_quiz_image') echo 'Try Something New Image Quizes';
                else echo ' Try Something New Video Quizes'
            ?>
        </span></td>
    <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
  <td>
  <table width="98%" cellpadding="1">
      <?php if($flag=='featured_quiz_image' || $flag == 'featured_quiz_video'){ ?>
  <tr>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getFeaturedImageQuizes')?>" style="color:#003399"> View Featured Image Quizes </a> ]</strong></td>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getFeaturedVideoQuizes')?>" style="color:#003399"> View Featured Video Quizes </a> ]</strong></td>
    
  </tr>
  <? } else {?>
  <tr>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getTryNewImageQuizes')?>" style="color:#003399">Try Something New Image Questions </a> ]</strong></td>
    <td width="22%" ><strong>[ <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/getTryNewVideoQuizes')?>" style="color:#003399"> Try Something New Video Questions</a> ]</strong></td>
  </tr>
  <? } ?>
	
</table>
  </td>
  </tr>
</table>

<br>
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
       <tr>
        <th width="13%" align="left"><div align="center">No.</div></th>
        <th width="13%" align="left"><div align="left">
                <b> Quiz_id </b> </div></th>
        <th width="13%" align="left"><div align="left">
                <b><?php if($flag=='featured_quiz_image' || $flag == 'try_new_quiz_image') { ?>Quiz Question Images <?php } else { ?> Quiz Question Videos <? } ?> </b> </div></th>

        <th width="50%" align="left"><div align="center"><b><?php if($flag=='featured_quiz_image' || $flag == 'try_new_quiz_image') { ?>Quiz Answer Images<?php } else { ?>Quiz Answer Videos<? }?></b></div></th>
        <?php if($flag=='featured_quiz_image' || $flag == 'featured_quiz_video') { ?>
        <th width="11%" align="left"><div align="center"><b>Featured Question?</b></th>
        <? } else {?>
        <th width="11%" align="left"><div align="center"><b>Try Something new?</b></th>
        <? }?>
        <th width="11%" align="left"><div align="center"><b>Delete</b></div></th>
    </tr>
        <? //print_r($quiz_images);
       // echo $flag;
		$i=$offset+1;
                if($flag == 'featured_quiz_image' || $flag == 'try_new_quiz_image')
               $data = $quiz_images;
                else $data = $quiz_videos;
		if(count($data)>0) { 
		foreach($data as $rows) {
		?>
      
      <tr>
        <td align="center"><? echo $i; ?></td>
        <td align="left"><?=$rows->quiz_id?></td>
		 
	  <td align="left">
              <div align="left">
                  <? if($flag=='featured_quiz_image' || $flag == 'try_new_quiz_image') {?>
                  <img src="<?=base_url()?><?=PHOTO_QUESTION_THUMB.'/'.$rows->images?> " alt="<?=$rows->images?>" />
                  <? } else {?>
                   <? $video=explode('.',$rows->quiz_videos)?>
                   <a href="<?=base_url().'uploaded_videos/'.$video[0]?>.flv" style="display:block;width:180px;height:135px" id="player_<?=$rows->quiz_id?>"></a>
                  <script>
                                        flowplayer("player_<?=$rows->quiz_id?>", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                                            clip: {
                                                // these two configuration variables does the trick
                                                autoPlay: false,
                                                autoBuffering: true // <- do not place a comma here
                                            }
                                        });
                                    </script>
                      
                  <? } ?>
              </div>
          </td>
	  
        <td align="center">
             <? if($flag=='featured_quiz_image' || $flag == 'try_new_quiz_image') {
             $image=base64_encode(PHOTO_QUESTION_THUMB.'/'.$rows->photo_name);
             ?>

            <img src="<?=site_url('pictures/sizeit/184/184/'.$image)?>" alt="<?=$rows->photo_name?>" />
                              <!--<img src="<?=base_url()?><?=USER_UPLOADED_PHOTOS.'/'.$rows->user_id.'/'.$rows->photo_name?>" height="180px" width="180px" alt="<?=$rows->photo_name?>" />-->
                  <? } else {?> 
                      <? $video1=explode('.',$rows->video_answer)?>
                   <a href="<?=base_url().'uploaded_videos/'.$video1[0]?>.flv" style="display:block;width:180px;height:135px" id="player1_<?=$rows->quiz_id?>"></a>
                  <script>
                                        flowplayer("player1_<?=$rows->quiz_id?>", "<?=base_url()?>flowplayer/flowplayer-3.1.5.swf",{
                                            clip: {
                                                // these two configuration variables does the trick
                                                autoPlay: false,
                                                autoBuffering: true // <- do not place a comma here
                                            }
                                        });
                                    </script>
                  <? } ?>
        </td>
        <?php //print_r($rows)?>
       <?php if($flag == 'featured_quiz_image' || $flag == 'featured_video_image'){ ?>
        <td>
            <?php if($rows->featured_quiz==0) { ?><a href="javascript:void(0)" onclick="feature_quiz('<?=$rows->quiz_id?>','yes')">Active</a><? } else {?> <b style="color:#79B800">Active</b><? }?>
            <br><br>
                    <?php if($rows->featured_quiz==1) { ?><a href="javascript:void(0)" onclick="feature_quiz('<?=$rows->quiz_id?>','no')">Inactive</a><? } else {?> <b style="color:#79B800">Inactive</b><? }?>
        </td>
        <? } else {?>
        <td>
            <?php if($rows->try_new_quiz==0) { ?><a href="javascript:void(0)" onclick="try_new_quiz('<?=$rows->quiz_id?>','yes')">Active</a><? } else {?> <b style="color:#79B800">Active</b><? }?>
            <br><br>
                    <?php if($rows->try_new_quiz==1) { ?><a href="javascript:void(0)" onclick="try_new_quiz('<?=$rows->quiz_id?>','no')">Inactive</a><? } else {?> <b style="color:#79B800">Inactive</b><? }?>
        </td>
        <? } ?>
		<td align="center">
		<? if($flag=='featured_quiz_image') {?> <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuiz/'.$rows->quiz_id.'/'.$rows->images.'/'.$rows->photo_name.'/'.$rows->user_id)?>"><? } else {?> <a href="<?=site_url(ADMIN_PATH.'/media_comment_management/deleteQuizVideo/'.$rows->quiz_id.'/'.$video[0].".flv".'/'.$video1[0].".flv")?>"> <? } ?><img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete Newsletter" onClick="return doconfirm();" /> </a>  </td>
      </tr>
	  
      <? $i++;} } else{?>
<tr><td colspan="4" align="center">::No Records were found::	  </td></tr>
<? } ?>
</table>
<div><?=$pagination?></div>
<p>