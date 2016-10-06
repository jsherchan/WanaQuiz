<script type="text/javascript" src="<?=base_url()?>crop_js/jquery-pack.js"></script>
<script>
$(document).ready(function () {
$('#category').click(function(){
   
   var category = $('#category').val() ;
   $.post('<?=base_url()?>quiz/getCategoryCPC', {cid:category} , function(data){
       if (data != '' || data != undefined || data != null)
            { 
               $('#selected_category').html(data);
            }
        });
    });
});
</script>

<div class="padding_10topbottom">
  <div class="quizmaking_topborder">
    <div class="title_align">
      <div class="font13 bold">Congratulations!!!</div>
    </div>
  </div>
  <div class="quizmaking_bg">
    <div class="whiteboxrightside_bgInner">
      <div class="borderbottom_dotted"></div>
      <div class="content_10box">
        <div class="padding_10leftright">
          <div class="padding_10topbottom">
          <p>Congratulations!! You have successfully uploaded your question.</p><br />
<p>          Your Balance for this quiz is <?=$this->session->userdata('gross')?> <br />
<p>If you have not typed your text advertisements or uploaded banners before, please do so now.

You can also update your ads.</p><br />
<?php $path = $this->session->userdata('quiz_url_type_last'); ?>
<p><a href="<?=base_url()?>quiz/<?=$path?>/0">Upload/Update ads</a></p><br />
<?php
if($path=='addPhotoQuizStep3'){ $final_path = 'photo'; }
else $final_path = 'video';
$this->session->set_flashdata('quiz_add_message', $final_path .' quiz successfully added. For more upload <a href="'.base_url().'member/addPhotoQuestion">"Click Here"</a>'); ?>
<p><a href="<?=base_url()?>member/viewQuestions/<?=$final_path?>">Skip>></a></p>


          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="quizmaking_bottomborder"></div>
</div>
