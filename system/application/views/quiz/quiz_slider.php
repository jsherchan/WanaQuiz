<link href="<?php echo base_url();?>css/styles.css" rel="stylesheet" type="text/css" />
<?if($js=='') $js=1;?>
<!--
  jCarousel library
-->
<script type="text/javascript" src="<?php echo base_url();?>jcarousel_slider/lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>jcarousel_slider/skins/tango/skin.css" />

<div>
                                <ul id="mycarousel" class="jcarousel-skin-tango">
                                    <?
                                    if($videos_list!=NULL){
                                        $j=1;
                                    foreach($videos_list as $video){                                        
                                            $vd=explode('.',$video->video_name);
                                            if($edit == 0)
                                               $url ="addVideoQuestion";
                                             else
                                                    $url = 'editVideoQuestion/'.$quiz_id;?>
                                    
                                        <li>
                                    <div>
                                        <a href="<?=site_url('member/'.$url.'/'.$video->video_id.'/'.$j)?>" id="v_<?=$video->video_id?>" title="<?=$j?>">
                                            <img src="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg"  alt="img" height="71" width="94"/>
                                        </a>
                                    </div>
                                        </li>
                                      <? $j++; } }?>

                                        <div class="clear"></div>
                                    </ul>
                            </div>

<script type="text/javascript">
   jQuery(document).ready(function() {
         index = <?=($v_id!='') ? $v_id : 1 ?>;
         index = (index!=1) ? <?=$js ?> : 1;
         //console.log(index);
       <?php if( $total_videos >8 ){ ?>
       jQuery('#mycarousel').jcarousel
        (
            {
                wrap: 'circular',
                scroll:8 ,
                start: index
                
             }
        );
            <?php }
else {?>
      jQuery('#mycarousel').jcarousel();
<?}?>
    }); 
  
</script>