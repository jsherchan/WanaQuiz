<?#=var_dump($user)?>
<script>    
    document.domain = document.domain.substring(document.domain.indexOf('.')+1);
function addClick(obj,id,link,quiz_id,type,member_id)
{
//    console.log(obj+'~'+id+'~'+link+'~'+quiz_id+'~'+type+'~'+member_id);return;
     $.post('<?=base_url()?>quiz/addClick', {id:id,type:type,quiz_id:quiz_id,profile:member_id} , function(data){
         console.log(data);
         //window.open('http://'+link);
         //obj.target='_blank';
         //obj.href = 'http://'+link;
         //$(obj).trigger('click');
 });
 return false;
}

</script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.cycle.all.min.js"></script>
<style type="text/css">
.slideshow { height: 620px; width: 200px; margin: auto }
.slideshow img { padding: 10px; border: 1px solid #ccc; background-color: #eee; }
</style>
<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">
    /*
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'scrollLeft', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
                activePagerClass: 'activeSlide',
                continuous: 0,
               random: 0,
               autostop:0,
               autostopCount:0

	});
});*/
</script>

<!--
  jCarousel library
-->
<script type="text/javascript" src="<?php echo base_url();?>jcarousel_slider/lib/jquery.jcarousel.js"></script>
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>jcarousel_slider/skins/tango/skin.css" />

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
            vertical:true,
            auto:1,
            
            scroll:5,
            wrap:'both'
        }

    );
    });

</script>
<?php
print_r($banner_ads_info);
?>

<div class="quiz_rightside11">
            <div class="rightsideInner">
                <div class="content_wrap" style="display:none;">
                    <div class="quizhome_navleftborder" style="position:relative; z-index:2;"></div>
                    <div class="quizright_bg quizhome_navbg" style="width:194px; position:relative; z-index:5; overflow:visible;">
                        <div class="whiteboxrightside_bgInner_" style="margin-left:-15px;">
                        	<div class="padding_10leftright_" style="width:230px; line-height:33px;">
                            	<div class="quizlinks">
                                	<ul>                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="quizhome_navrightborder"></div>
                    <div class="clear"></div>
                </div>
                
                <!--<div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                        <div class="whiteboxrightside_bgInner">
                        	<div class="content_10box">
                            	<div class="text_center">

                                    <div class="opt2link">
                                        	<div class="opt2linkInner">
                                            	<div class="helpbtn"><a href="<?=site_url('page/show/quizmachine')?>">Help</a></div>
                                                <div class="green2optbtn"><a href="<?=site_url('home/quizMachine')?>">Start</a></div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="quizright_bottomborder"></div>
                </div>-->
               
                <?php //print_r($banner_ads_info);
                //echo count($text_ads);
                 
                if($user->user_type!=0){ 
                   
                if(count($banner_ads_info)>0) {?>
                <div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                        <div class="whiteboxrightside_bgInner"> 
                            <div style="padding:10px; color:#000080; font-weight:bold; font-family:serif; text-align:center"><img src="<?php echo base_url(); ?>images/offer_arrow.png" style="padding-right:5px;">Offer from page owner:</div>
                        <?php 
                        if($quiz_info->ads_rotation=='yes' && count($text_ads_info)>0) {
                            if($this->session->userdata('adv_flag') =='2'){ 
                                $this->session->set_userdata('adv_flag','1');

                            $banner_ads_info = $this->Quiz_model->get_rotated_banner_ads($user->user_id,$quiz_id);
                            //echo '<pre>'; print_r($banner_ads_info);exit;
                            if(!empty($banner_ads_info)){
                            $this->Quiz_model->insert_rotated_banner_ads($banner_ads_info[0]->banner_id,$banner_ads_info[0]->quiz_id);
                            $this->Quiz_model->insert_ads_view_click_log($banner_ads_info[0]->banner_id,'banner');
                            }
                            else { 
                                $this->Quiz_model->reset_rotated_banner_ads($quiz_id);
                                $banner_ads_info = $this->Quiz_model->get_rotated_banner_ads($user->user_id,$quiz_id);
                                $this->Quiz_model->insert_rotated_banner_ads($banner_ads_info[0]->banner_id,$banner_ads_info[0]->quiz_id);
                                $this->Quiz_model->insert_ads_view_click_log($banner_ads_info[0]->banner_id,'banner');
                            }
                            ?>
                           <!-- <div class="slideshow">-->
                           <?php //foreach($banner_ads_info as $banner_ads) { ?>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->
                                        
                                        <div style="font-size:smaller; color:green;">
                                            <a href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" target="_blank" 
                                               onclick="addClick(
                                                    this,
                                                    <?=$banner_ads_info[0]->banner_id?>,
                                                    '<?=$banner_ads_info[0]->url?>',
                                                    '<?=$banner_ads_info[0]->quiz_id?>',
                                                    'banner',
                                                    '<?=$user->user_id?>')">
                                                
                                               <?php
                                               
                                               $image='advertiser_banners/'.$banner_ads_info[0]->banner_image;                                               
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                if (file_exists($image)) {
                                                //echo $imageWidth.'/'.$imageHeight;
                                                    if($imageWidth<='160'){
                                                        $imagew = $imageWidth;
                                                        
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                    else{
                                                        $imagew = '160';
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                }
                                                ?>
                                               <?php//echo $image.'/'.$imageh.'/'.$imagew ?>
                                               <img src="<?php echo base_url().'advertiser_banners/'.$banner_ads_info[0]->banner_image?>"  alt="banner" />
                                                    </a>
                                        </div>

                                        <div style="color:blue" id="adv_click">
                                            <b><a href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" target="_blank" 
                                                  onclick="addClick(
                                                            this,
                                                            <?=$banner_ads_info[0]->banner_id?>,
                                                            '<?=$banner_ads_info[0]->url?>',
                                                            '<?=$banner_ads_info[0]->quiz_id?>',
                                                            'banner',
                                                            '<?=$user->user_id?>')">
                                                <?php if(strlen($banner_ads_info[0]->url)>21)
                                                echo substr($banner_ads_info[0]->url,0,21).'...';
                                                else echo $banner_ads_info[0]->url;
                                                ?>
                                                </a></b>
                                        </div>

                                </div>
                            </div>
                                <? } else {
                                $this->session->set_userdata('adv_flag', '2');
                                ?>

                                <div>
                            <?php
                            if(count($text_ads_info)>0){
                            foreach($text_ads_info as $text_ads){
                            $this->Quiz_model->insert_ads_view_click_log($text_ads->id,'long_text');?>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                    <div style="color:blue"><b><u><a href="http://<?=$text_ads->link_url?>" style="cursor:pointer" target="_blank" 
                                                                     onclick="addClick(
                                                                            this,
                                                                            <?=$text_ads->id?>,
                                                                            '<?=$text_ads->link_url?>',
                                                                            '<?=$text_ads->quiz_id?>',
                                                                            'long_text',
                                                                            '<?=$user->user_id?>')"><?=$text_ads->link_title?></a></u></b></div>
                                        <div><?=$text_ads->link_description?></div>
                                        <div style="font-size:smaller; ">
                                            <a href="http://<?=$text_ads->link_url?>" style="cursor:pointer; color:green;" target="_blank" 
                                                                            onclick="addClick(
                                                                                this,
                                                                                <?=$text_ads->id?>,
                                                                                '<?=$text_ads->link_url?>',
                                                                                '',
                                                                                'long_text',
                                                                                '<?=$user->user_id?>')">
                                                <?php if(strlen($text_ads->link_url)>21)
                                                echo substr($text_ads->link_url,0,21).'...';
                                                else echo $text_ads->link_url;
                                                ?>

                                            </a>
                                        </div>

                                </div>
                            </div>
                                <? }} ?>
                                </div>
                      <? }?>

                         <!--</div>   -->
                            
                            <? } else {?>
                            <div class="content_10box">
                            	<div class="text_center">

                                        <div style="color:blue">
                                            <b><u><a href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" 
                                                     onclick="addClick(
                                                                this,
                                                                <?=$banner_ads_info[0]->banner_id?>,
                                                                '<?=$banner_ads_info[0]->url?>',
                                                                '<?=$banner_ads_info[0]->quiz_id?>',
                                                                'banner',
                                                                '<?=$user->user_id?>')"><?=$banner_ads_info[0]->banner_name?></a></u></b>
                                            <?php $this->Quiz_model->insert_ads_view_click_log($banner_ads_info[0]->banner_id,'banner');?>
                                        </div>
                                        <div style="font-size:smaller; color:green;">
                                            <a href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" 
                                               onclick="addClick(
                                                   this,
                                                    <?=$banner_ads_info[0]->banner_id?>,
                                                    '<?=$banner_ads_info[0]->url?>',
                                                    '<?=$banner_ads_info[0]->quiz_id?>',
                                                    'banner',
                                                    '<?=$user->user_id?>')">
                                                
                                                <?php
                                               
                                               $image='advertiser_banners/'.$banner_ads_info[0]->banner_image;                                                                                                         
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);                                                
                                                if (file_exists($image)) {
                                                //echo $imageWidth.'/'.$imageHeight;
                                                if($imageWidth<='160'){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                    else{
                                                        $imagew = '160';
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                }                                                
                                                #$imagew = 160;
                                                #$imageh = 160;
                                                ?>
                                            <img src="<?php echo base_url().'advertiser_banners/'.$banner_ads_info[0]->banner_image?>"  alt="banner" />
                                                        <!--<img src="<?=base_url()?>advertiser_banners/<?=$banner_ads_info[0]->banner_image?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                     <div style="color:blue">
                                            <b><a href="http://<?=$banner_ads_info[0]->url?>" style="cursor:pointer" target="_blank" 
                                                  onclick="
                                                      addClick(
                                                      this,
                                                        <?=$banner_ads_info[0]->banner_id?>,
                                                        '<?=$banner_ads_info[0]->url?>',
                                                        '<?=$banner_ads_info[0]->quiz_id?>',
                                                        'banner',
                                                        '<?=$user->user_id?>')">
                                                <?php if(strlen($banner_ads_info[0]->url)>21)
                                                echo substr($banner_ads_info[0]->url,0,21).'...';
                                                else echo $banner_ads_info[0]->url;
                                                ?>
                                                </a></b>
                                        </div>

                                </div>
                            </div>
                            <? }?>
                        </div>
                    </div>
                    <div class="quizright_bottomborder"></div>
                </div>
                <? }
                else if(count($text_ads_info)>0){
                    foreach($text_ads_info as $text_ads){
                       $this->Quiz_model->insert_ads_view_click_log($text_ads->id,'long_text');?> 
                    

                    <div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                                                <div style="padding:10px; color:#000080; font-weight:bold; font-family:serif; text-align:center"><img src="<?php echo base_url(); ?>images/offer_arrow.png" style="padding-right:5px">Offer from page owner:</div>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                        <div style="color:blue"><b><u><a href="http://<?=$text_ads->link_url?>" style="cursor:pointer" 
                                                                         onclick="addClick(
                                                                             this,
                                                                             <?=$text_ads->id?>,
                                                                             '<?=$text_ads->link_url?>',
                                                                             '<?=$text_ads->quiz_id?>',
                                                                             'long_text',
                                                                             '<?=$user->user_id?>')"><?=$text_ads->link_title?></a></u></b></div>
                                        <div><?=$text_ads->link_description?></div>
                                        <div style="font-size:smaller;">
                                            <a href="http://<?=$text_ads->link_url?>" style="cursor:pointer; color:green;" 
                                               onclick="addClick(
                                                   this,
                                                    <?=$text_ads->id?>,
                                                    '<?=$text_ads->link_url?>',
                                                    '',
                                                    'long_text',
                                                    '<?=$user->user_id?>')">
                                                <?php if(strlen($text_ads->link_url)>21)
                                                    echo substr($text_ads->link_url,0,21).'...';
                                                    else
                                                    echo $text_ads->link_url;
                                                    ?>
                                                
                                            </a>
                                        </div>

                                </div>
                            </div>
                    </div>
                    <div class="quizright_bottomborder"></div>
                    </div>

                                <? }
                }
            else {?>
                        <div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                        <div class="whiteboxrightside_bgInner">
                            <!--<div class="slideshow">-->
                            <?//=$admin_ads[0]->adv_dimension.'/'.$admin_ads[0]->adv_type.'/'.$admin_ads[0]->link_url.'/'.$admin_ads[0]->id?>
                        <?php
                            
                        //print_r($admin_ads);
                        if(count($admin_vertical_ads)>0) {
                            
                            if($admin_vertical_ads[0]->adv_type!='adsense'){
                                if($admin_vertical_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                else $image_width = '250';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                        
                                          <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://<?=$admin_vertical_ads[0]->link_url?> " target="_blank">
                                           
                                             <?php 
                                             
                                              echo $admin_vertical_ads[0]=adv_banner;  
                                             $image='advertisement_banners/'.$admin_vertical_ads[0]->adv_banner;
                                                if (file_exists($image)) {
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                //echo $imageWidth.'/'.$imageHeight;
                                               if($imageWidth<$image_width){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                    else{
                                                        $imagew = $image_width;
                                                        if($imageHeight<='600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                }
                                                ?> 
                                               <img src="<?php echo base_url().'advertisement_banners/'.$admin_vertical_ads[0]->adv_banner?>"  alt="banner" />
<!--                                              <img src="<?php// echo base_url(); ?>resizer.php?src=<?php //echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />-->
<!--                                    <!--                                              <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />-->            <img src="<?=base_url()?>advertisement_banners/<?=$admin_ads[0]->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                        <div style="color:blue">
                                            <b><u><a style="cursor:pointer" >
                                                    <?php if(strlen($admin_vertical_ads[0]->link_url)>21)
                                                    echo substr($admin_vertical_ads[0]->link_url,0,21).'...';
                                                    else echo $admin_vertical_ads[0]->link_url;
                                                    ?>
                                                </a></u></b>
                                        </div>

                                </div>
                            </div>
                            <? } else{ ?>
                             <div >
                                 <?php echo $admin_vertical_ads[0]->adv_detail;?>
                            </div>
                            <?}}?>
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="quizright_bottomborder"></div>
                </div>
                        <? } ?>

                <? } else {
                   
                    if($this->session->userdata('adsense_status')=='')
                    $this->session->set_userdata('adsense_status','user');
                 $user_id = $user->user_id;

                $check = $this->Member_model->check_user_partner($user_id);
                //print_r($check);
                if($check->active=='1'){
                    $partner_info = $this->Member_model->get_user_partner_info($user_id);
                   // print_r($partner_info);
                   // print_r($admin_vertical_ads);
                    //echo $this->session->userdata('adsense_status');
                    //if($partner_info->ad_type=='vertical'){
                        ?>
                    <div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                        <div class="whiteboxrightside_bgInner" align="center">
                        <div class="">
                            <?php if($this->session->userdata('adsense_status')=='user'){?>
                                                           
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://google.com " target="_blank">
                                                <?php
                                               
                                                echo $partner_info->user_vertical_code;
//                                                $image='useruploads/images/'.$partner_info->user_vertical_code;
//                                                $image = trim($image);
//                                                if (file_exists($image)) {
//                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
//                                                echo $imageWidth.'/'.$imageHeight;
//                                                if($imageWidth<$image_width){
//                                                        $imagew = $imageWidth;
//                                                        if($imageHeight<'600') $imageh = $imageHeight;
//                                                        else $imageh = '600';
//                                                    }
//                                                    else{
//                                                        $imagew = $imageWidth;
//                                                        if($imageHeight<'600') $imageh = $imageHeight;
//                                                        else $imageh = '600';
//                                                    }
//                                                }
//                                                 //echo $imagew;
//                                                ?>

                                               <?php //print_r(getimagesize($image)); ?>
                                                <?php //http://localhost/wannaquiz/resizer.php?src=advertiser_banners/forum1.jpg&h=600&w=160&zc=0 ?>
                                             
<!--                                              <img src="<?php// echo base_url() . 'resizer.php?src='.$image.'&amp;h='.$imageh.'&amp;w='.$imagew.'&amp;zc=0'; ?>"  alt="banner" />-->
                                                <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                     
                                </div>
                            </div>
                          <?php $this->session->set_userdata('adsense_status','admin');
                           
                            //admin adsense
                            } else {
                                if(count($admin_vertical_ads)>0) {
                            if($admin_vertical_ads[0]->adv_type!='adsense'){
                                if($admin_vertical_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                else $image_width = '250';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->


                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://<?=$admin_vertical_ads[0]->link_url?> " target="_blank">
                                                <?php
                                                $image='advertisement_banners/'.$admin_vertical_ads[0]->adv_banner;
                                                if (file_exists($image)) {
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                //echo $imageWidth.'/'.$imageHeight;
                                                if($imageWidth<$image_width){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<'600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                    else{
                                                        $imagew = $image_width;
                                                        if($imageHeight<'600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                }
                                                //else echo "hereeeee";
                                                ?>

                                                <?php //print_r(getimagesize($image)); ?>
                                                
                                                 <img src="<?php echo base_url() . 'resizer.php?src='.$image.'&amp;h='.$imageh.'&amp;w='.$imagew.'&amp;zc=0'; ?>"  text="admin banner" />
                                               
                                            </a>
                                        </div>
                                        <div style="color:blue">
                                            <b><u><a style="cursor:pointer" >
                                                     <?php if(strlen($admin_vertical_ads[0]->link_url)>21)
                                                        echo substr($admin_vertical_ads[0]->link_url,0,21).'...';
                                                        else echo $admin_vertical_ads[0]->link_url;
                                                        ?>
                                                  </a></u></b>
                                        </div>

                                </div>
                            </div>
                            <? } else {?>
                            <div >
                                 <?php echo $admin_vertical_ads[0]->adv_detail;?>
                            </div>
                            <?}}?>
                                
                            <?php $this->session->set_userdata('adsense_status','user');
                            }?>
                        </div>
                        </div>
                        </div>
                    <div class="quizright_bottomborder"></div>
                </div>

                 <?php }
                else{
                ?>
                        <div class="content_wrap">
                    <div class="quizright_topborder"></div>
                    <div class="quizright_bg">
                        <div class="whiteboxrightside_bgInner" align="center">
                        
                        <!--<div class="slideshow">-->
                        <?php
                       //print_r($admin_vertical_ads);
                        //print_r($admin_vertical_ads);
                        if(count($admin_vertical_ads)>0) {
                            
                            if($admin_vertical_ads[0]->adv_type!='adsense'){
                                if($admin_vertical_ads[0]->adv_dimension=='vertical') $image_width = '160';
                                else $image_width = '250';
                                        //foreach($admin_ads as $admin_ads_info) {
                                        ?>
                            <div class="content_10box">
                            	<div class="text_center">
                                	<!--<img src="<?=base_url()?>images/googleadd.jpg" width="161" height="423" alt="google" />-->

                                        
                                        <div style="font-size:smaller; ">
                                            <a style="cursor:pointer; color:green;" href="http://<?=$admin_vertical_ads[0]->link_url?> " target="_blank">
                                                <?php 
                                       
                                                $image='advertisement_banners/'.$admin_vertical_ads[0]->adv_banner;                                                
                                                if (file_exists($image)) { 
                                                list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                                                //echo $imageWidth.'/'.$imageHeight;
                                                if($imageWidth<$image_width){
                                                        $imagew = $imageWidth;
                                                        if($imageHeight<'600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                    else{
                                                        $imagew = $image_width;
                                                        if($imageHeight<'600') $imageh = $imageHeight;
                                                        else $imageh = '600';
                                                    }
                                                }
                                                //else echo "hereeeee";
                                                ?>
                                                
                                                <?php //print_r(getimagesize($image)); ?>
                                                <img src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$imageh?>&w=<?=$imagew?>&zc=0" alt="banner" />
                                                <!--<img src="<?=base_url()?>advertisement_banners/<?=$admin_ads_info->adv_banner?>" width="150" height="150" alt="advertise" />-->
                                            </a>
                                        </div>
                                        <div style="color:blue">
                                            <b><u><a style="cursor:pointer" >
                                                     <?php if(strlen($admin_ads[0]->link_url)>21)
                                                        echo substr($admin_ads[0]->link_url,0,21).'...';
                                                        else echo $admin_ads[0]->link_url;
                                                        ?>
                                                  </a></u></b>
                                        </div>

                                </div>
                            </div>
                            <? } else {?>
                            <div >
                                 <?php echo $admin_vertical_ads[0]->adv_detail;?>
                            </div>
                            <?}} else {
                                
                                //echo "admin advertisement when user dont have a partner";
                               ?>
                       
                             <img src="<?=base_url()?>images/advertisement.jpg" width="200" height="120" alt="advertisement" />
                                     <? }?>
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="quizright_bottomborder"></div>
                </div>
                        <? //}
                }} ?>
            </div>
        </div>