<div class="playlist_right">
    <?php if($this->session->flashdata('quiz_add_message')) { ?>
    <div style="text-align:center; padding-bottom:10px;">
        <span style="text-align:center; line-height:40px; background-color:#FFF;  margin:0 auto; display:inline-block; padding:0 10px; -moz-border-radius:50%; -webkit-border-radius:50%; border-radius:50%;border:1px solid #AFE3E7 ">
                <?php echo $this->session->flashdata('quiz_add_message');?>
        </span>
    </div>
    <? }?>
    <div class="midsideInner">
        <div class="content_wrap new_help">
            <div class="longwhitebox_topborder">
                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:770px;">
                        <div class="bold font14 color_white"><?php if($flag=='overall') echo 'Best Overall Players Today'; else echo $category_name."- Top 50 users of today"?></div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="longwhitebox_bg">
               <div class="content_10box">
                    <div class="whiteboxrightside_bgInner">
                        <div class="clear"></div>
                        <div class="list_table">
                            <div class="list_header clearfix textL bold">
                                <div class="data_7 ">Player</div>
                                <div class="data_6">Level</div>
                                <div class="data_6">Rank</div>
                                <div class="data_7">Location</div>
                                <div class="data_6">Points Today</div>
                                <div class="data_7">Total points</div>
                            </div>
                            <?php
                            //print_r($best_players_today);
                            if($best_players_today){
                                foreach($best_players_today as $bestPlayersToday){
                                    if($bestPlayersToday->total > 0 ){
                                    $level_info = $this->Quiz_model->get_member_level($bestPlayersToday->user_id);
                                    $category_rank = $this->Category_model->get_member_category_rank_per_category($bestPlayersToday->user_id,$cid);
                                    
                                    //echo '<pre>';print_r($level_info);print_r($category_rank);echo'</pre>';

                                ?>
                            <div class="list_row clearfix">
                                <div class="data_7 "><a href="<?=base_url()?><?=$bestPlayersToday->username?>"><?=$bestPlayersToday->username?> </a></div>
                                <div class="data_6"><?php if($level_info->level_id) echo $level_info->level_id; else echo 1;?></div>
                                <div class="data_6"><?php if($category_rank->category_title) echo $category_rank->category_title; else echo 'Novice'?></div>
                                <div class="data_7"><?php if($bestPlayersToday->country) echo $bestPlayersToday->country; else echo "Unknown"?></div>
                                <div class="data_6"><?=$bestPlayersToday->total?></div>
                                <div class="data_7"><?=$category_rank->total_points?></div>
                            </div>
                            <? } } } else echo "There are no players for today!"?>
                          
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:770px;">
                        <div class="bold font14 color_white"><?php if($flag=='overall') echo 'Best Overall Players of All Time'; else echo $category_name."- Top 50 users of all time"?></div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
                <div class="content_10box">
                    <div class="list_table">
                        <div class="list_header clearfix textL bold">
                            <div class="data_7 ">Player</div>
                            <div class="data_6">Level</div>
                            <div class="data_6">Rank</div>
                            <div class="data_7">Location</div>
                            <div class="data_6">Points Today</div>
                            <div class="data_7">Total points</div>
                        </div>
                        <?php //print_r($best_players_all_time);
                            if($best_players_all_time){
                                foreach($best_players_all_time as $bestPlayersAllTime){
                                    $level_info1 = $this->Quiz_model->get_member_level($bestPlayersAllTime->user_id);
                                    //$category_rank1 = $this->Category_model->get_member_category_rank_per_category($bestPlayersAllTime->user_id,$cid);
                                    $user_today_total_point = $this->Quiz_model->get_user_today_points($bestPlayersAllTime->user_id,$cid);
                                    //print_r($user_today_total_point);
                                    //echo '<pre>';print_r($level_info1);print_r($category_rank1);echo'</pre>';
                                    if($bestPlayersAllTime->total_points > 0){
                                ?>
                        <div class="list_row clearfix">
                            <div class="data_7 "><a href="<?=base_url()?><?=$bestPlayersAllTime->username?>"><?=$bestPlayersAllTime->username?> </a></div>
                            <div class="data_6"><?php if($level_info1->level_id) echo $level_info1->level_id; else echo 1;?></div>
                            <div class="data_6">
                                <?php //if($category_rank1->category_title) echo $category_rank1->category_title; else echo "Novice";?>
                                <?php if($bestPlayersAllTime->category_title) echo $bestPlayersAllTime->category_title; else echo "Novice";?>
                            </div>
                            <div class="data_7"><?php if($bestPlayersAllTime->country) echo $bestPlayersAllTime->country; else echo "Unknown";?></div>
                            <div class="data_6"><?php if($user_today_total_point->total) echo $user_today_total_point->total; else echo 0;?></div>
                            <div class="data_7"><?=$bestPlayersAllTime->total_points?></div>
                        </div>
                        <? } } } else echo "There are no players for today!"?>
                        
                        </div>
                    </div>
                <div class="clear"></div>
                </div>
            <div class="longwhitebox_bottomborder"></div>
            </div>
            
        </div>
    </div>
</div>