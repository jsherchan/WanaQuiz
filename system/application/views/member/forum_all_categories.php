<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/typo.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<div class="right_large_col floatR"> 
<div class="rounded_white_bg">
      <div class="pos">
        <h1 class="blue_title"><span>WannaQuiz Forum</span></h1>
       <div class="list_cont">
           <? foreach($category_list as $rows){?>
        <div class="list_slot clearfix discussion_list bold">
        
           <div class="cell_1 cell"> <div class="discussion_topic"> 
                    <? echo $rows->name?> </div>
              
            </div>
            
           
            
          </div>
                 <?php $sub_categories_list = $this->forum_category_model->get_sub_categorie($rows->id);
                  if($sub_categories_list) {
                     foreach($sub_categories_list as $sub)
                    {?>
                      
           <div class="list_slot clearfix discussion_list">
            <div class="cell_1 cell"> 
               <div class="discussion_topic">
                   <a href="<?=site_url('forum/forum_sub_by_category'.'/'.$sub->id)?>" class="blue_link bold"><?  echo $sub->name; ?></a>
                </div>
                <div class="font11"> <p></p></div>
            </div>
            <div class="cell_2 cell font11">
               <?$resthread=$this->forum_model->get_thread_count($sub->id);
               $ps=$resthread->result_array();?>
                <?$respost=$this->forum_model->get_post_count($sub->id);
               $pst=$respost->result_array();?>    
            <div class="cell_pos"><div><strong>Threads: <?=$ps[0]['post']?></strong>
              </div><div ><strong>Posts: <?=$pst[0]['post']?></strong>
              </div>
          </div>
            </div>
            <div class="cell_3 cell">
                <?$result=$this->forum_model->get_last_post($sub->id);
               $post=$result->result_array();
                 ?>
                
            <div class=""><a href="<?=site_url('forum/forum_discussion_detail/'.$post[0]['disc_id'])?>" class="blue_link"><?=$post[0]['discussion_title']?></a>
             by <a href="<?=site_url($post[0]['username'])?>" class="blue_link"><?=$post[0]['username']?></a>
            </div>
               <?$today=strtotime(date('Y-m-d H:i:s'));
              $post_day=strtotime($post[0]['created']);
              ?>
            <div class="font11">
              <? if(empty($post)) 
            $last_post_date = "No Posts";
        else if($post[0]['created']!='0')
            {
            $last_post_date = $today-$post_day;
            if($last_post_date/60 < 60)
                 $last_post_date = number_format($last_post_date/(60))." min (s) ago";
            else if($last_post_date/(60*60) < 24)
                    $last_post_date = number_format($last_post_date/(60*60))." hr (s) ago";
                else if($last_post_date/(60*60*24) < 7)
                        $last_post_date = number_format($last_post_date/(60*60*24))." day (s) ago";
                    else if($last_post_date/(60*60*24*7) < 4)
                            $last_post_date = number_format($last_post_date/(60*60*24*7))." week (s) ago";
                        else if($last_post_date/(60*60*24*31) < 12)
                                $last_post_date = number_format($last_post_date/(60*60*24*31))." month (s) ago";
                            else if($last_post_date/(60*60*24*31*12) > 1)
                                    $last_post_date = number_format($last_post_date/(60*60*24*31*12))."year (s) ago";
        }        
              ?> 
               <?=$last_post_date?></div>
            </div>
          </div>
          <?php }}}?>
        </div>
        
        <div class="paginnation clearfix">
            <?=$this->pagination->create_links();?> 
        </div>
      </div>
    </div>
</div>