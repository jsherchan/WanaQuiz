
<div class="content_wrap semi_full_adj300">
                <div class="quizmaking_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:796px;">
                                <?php if($user_type=='regular') $type= 'Regular users'; else $type = 'Sponsors';?>
                                <div class="bold font14 color_white">Categories (<?=$type?>)</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>
                            
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="quizmaking_bg">
                    <div class="whiteboxrightside_bgInner">
                      <?php
                      $var = 1;
                      if(count($categories)>0) {
                          foreach($categories as $category) {?>
                       
                        <?php $cname = str_replace(' ','_',$category->name);
                       if($type=="Regular users"){
                        ?>
                         <div class="cat_list">
                            <div><a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=$cname;?>" style=" font-size:14px; font-weight:bold"><?=$category->name?></a></div>
                            <?php $sub_categories = $this->Category_model->get_sub_categories($category->id);
                         
                                  if(count($sub_categories)>0) {
                                                //foreach($sub_categories as $subcategories) {
                                                for($i=0;$i<(count($sub_categories)-1);$i++){
                                                    $subcname = str_replace(' ','_',$sub_categories[$i]->name);
                                                ?>
                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=$subcname?>" ><?=$sub_categories[$i]->name?></a>,&nbsp;
                            <? }?>
                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$sub_categories[count($sub_categories)-1]->name)?>" ><?=$sub_categories[count($sub_categories)-1]->name?></a>
                            <?}?>
                        </div>
                        <? if($var % 3 == 0){?>
                        <div class="clear"></div>
                        <?} $var++;
                        }
                        else{
                            if($cname!="All_about_me"){  ?>
                         <div class="cat_list">
                            <div><a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=$cname;?>" style=" font-size:14px; font-weight:bold"><?=$category->name?></a></div>
                            <?php $sub_categories = $this->Category_model->get_sub_categories_sponsor($category->id);
                         
                                  if(count($sub_categories)>0) {
                                                //foreach($sub_categories as $subcategories) {
                                                for($i=0;$i<(count($sub_categories)-1);$i++){
                                                    $subcname = str_replace(' ','_',$sub_categories[$i]->name);
                                                ?>
                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=$subcname?>" ><?=$sub_categories[$i]->name?></a>,&nbsp;
                            <? }?>
                            <a href="<?=base_url()?>quiz/categoryDetail/<?=$user_type?>/<?=str_replace(' ','_',$sub_categories[count($sub_categories)-1]->name)?>" ><?=$sub_categories[count($sub_categories)-1]->name?></a>
                            <?}?>
                        </div>
                        <? if($var % 3 == 0){?>
                        <div class="clear"></div>
                        <?} $var++;
                          
                                }
                                        
                           }
                          }}?>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="quizmaking_bottomborder"></div>
            </div>