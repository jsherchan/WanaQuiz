<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="greentitlebg_leftborder"></div>
                            <div class="greentitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Featured Video Questions</div>
                            </div>
                            <div class="greentitlebg_rightborder"></div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">

                    <?
                    //print_r($feat_videos);
                    
                    if(count($feat_videos)>0){
                      foreach($feat_videos as $videos){
                              
                                                    $geo = $_SESSION['target_city'];
                                                    #echo $geo . '<br />';                                                    
                                                    #echo $result_data->country_target . '<br />';
                                                    #echo $result_data->city_target . '<br />';
                                                    
                                                    if($result_data->country_target && $geo!='')
                                                    {
                                                        $country=explode(',',rtrim($result_data->country_target,','));
                                                        $country_check = FALSE;

                                                        foreach($country as $c):
                                                            if(stristr($geo,$c))
                                                            {
                                                                $country_check = TRUE;
                                                                continue;
                                                            }
                                                        endforeach;

                                                        if($result_data->city_target!='') 
                                                        {
                                                            $city=explode(',',rtrim($result_data->city_target,','));                                                  
                                                            $city_check = FALSE;

                                                            foreach($city as $ct):
                                                                if(stristr($geo,$ct))
                                                                {
                                                                $city_check = TRUE;
                                                                continue;
                                                                }
                                                            endforeach;
                                                            
                                                            if(!$city_check) continue;
                                                        }
                                                        
                                                        if(!$country_check) continue;                                                        
                                                    }
                                                   
                                                    if($user_id && $ids && $this->Quiz_model->check_similar_quiz($ids,$answers,$result_data->quiz_id,$result_data->user_id))
                                                        continue;
                                                    else
                                                    {                                                             

                                            ?>
                       <? $video=explode('.',$videos->quiz_videos)?>
                      <div class="content_10box">
                            <div class="featurevideo_img">
                                <div class="border_green">
                                    <?php $vd=explode('.',$videos->quiz_videos);
                                        if($_SERVER['SERVER_NAME']=='localhost')
										$a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                                     else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                    ?>
                                    <a href="<?=site_url('quiz/view/'.$videos->quiz_id)?>">
                                        <?php if(file_exists($a)){ ?>
                                        <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img">
                                        <? } else {?>
                                        <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                        <? } ?>
                                    </a>
                                    </div>
                            </div>
                            <div class="featurevideo_detail">
                                <div class="featurevideo_detailInner">
                                    <div><a href="<?=site_url('quiz/view/'.$videos->quiz_id)?>"><?=$videos->quiz_question?> </a></div>
                                    <div class="font11">
                                        <div class="padding_5top">
                                           
                                        </div>
                                        <div class="padding_5top"><a href="<?=site_url('quiz/view/'.$videos->quiz_id)?>">more >> </a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="featurevideo_name">
                                <div class="borderleft_gray">
                                    <div class="featurevideo_detailInner">
                                        <div>
                                            <div class="padding_5top">From: <a href="<?=base_url()?><?=$videos->username?>"><?=$videos->username?></a></div>
                                            <div class="padding_5top">Views: <?php echo $this->Quiz_model->get_quiz_views($videos->quiz_id)?></div>
                                       
                                            <div class="padding_5top">
                                           <!-- STAR RATINGS    -->
                                            <div id="rate_video_<?=$videos->quiz_id?>" class="rating">
                                            </div>
                                            <!--  END STAR RATINGS-->
                                            </div>
                                            <div class="padding_5top clear">More in:  <a href="<?=base_url()?>quiz/categoryDetail/<?=$videos->user_type?>/<?=str_replace(' ','_',$videos->name)?>"><?=$videos->name?></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clear"></div>
                        </div>
                        
                        <div class="borderbottom_dotted"></div>
                     <? }}
                     ?>
                        <div id="" style="text-align:right;">
                            <?php echo $pagination; ?>
                        </div>
                    <? }?>
                      
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>