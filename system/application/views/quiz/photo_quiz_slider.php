<?#='ph_id: ' . $ph_id?>
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
        if($photos_list!=NULL) {
            $j=1;
            foreach($photos_list as $photo) {
                if($edit == 0)
                    $url ="addPhotoQuestion";
                else
                    $url = 'editPhotoQuestion/'.$quiz_id;?>
        <li>
            <div><a href="<?=site_url('member/'.$url.'/'.$photo->photo_id.'/'.$j)?>" id="p_<?=$photo->photo_id?>" title="<?=$j?>">
                    <img src="<?=base_url()?>photo_question_thumbs/<?=$photo->photo_name?>"  alt="img"/> </a>            
            </div>
        </li>
            <? $j++; } 
        }?>        
    </ul>
    <div class="clear"></div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function() {
       // jQuery('#mycarousel').jcarousel({ wrap: 'circular', scroll:8});
    });

</script>
<script type="text/javascript">
    var index = <?=($ph_id!='') ? $ph_id : 1 ?>;
    index = (index!=1) ? <?=$js ?> : 1;

    jQuery(document).ready(function() {
//       console.log(index);
<?php if( $total_photo >8 ){ ?>
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
