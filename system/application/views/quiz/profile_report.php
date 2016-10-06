<?php $user_type = $profile_report->user_type;
 if($user_type=='1')
   $user = 'advertiser';
else $user = 'special';
?>

<div class="content_wrap">
                                         <? $total_cpc=0;?>
                        	<div class="content_10box">
                            	<div class="font14 bold color_darkblue">Profile Report</div>
                                        
                                <div class="padding_10topbottom">
                                    <div class="bg_blue text_center" style="color:blue">
                                    	<div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	Name of Advertiser
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	Impressions
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	Clicks
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	CTR
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	CPC
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	Cost
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                    //print_r($profile_report);
                                    if($profile_report!='') {
                                        $user_type = $profile_report->user_type;

                                    ?>

                                    <div class="bg_gray text_center">
                                    	<div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	<?php echo $profile_report->username?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	<?php
                                                        $i=0;
                                                        $ip = 0;
                                                       //print_r($report4);
                                                        if(count($report4)>0) {
                                                        foreach($report4 as $reports4) {
                                                           //if($reports4->action == 'view' && $reports4->link_title == $textAds->link_title) $i++;
                                                           if($ip!=$reports4->ip_address) $i++;
                                                           $ip = $reports4->ip_address;
                                                        } echo $i;
                                                        }
                                                        else echo 0;
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	<?php
                                                        $i=0;
                                                       //print_r($report4);
                                                        if(count($report4)>0) {
                                                        foreach($report4 as $reports4) {
                                                           if($reports4->action == 'click') $i++;
                                                        } echo $i;
                                                        }
                                                        else echo 0;
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	<?php
                                                        $i=0; $j=0;
                                                       //print_r($report4);
                                                        if(count($report4)>0) {
                                                        foreach($report4 as $reports4) {
                                                           if($reports4->action == 'click' ) $i++;
                                                           if($reports4->action == 'view' ) $j++;
                                                        }
                                                        if($j!=0)
                                                        echo round(($i/$j)*100,2);
                                                        else echo 0;
                                                        }
                                                        else echo 0;
                                                        ?> %
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                $ <?php
                                                    $i=0;
                                                    $cpc = 0;
                                                    if(count($report4)>0) {
                                                        foreach($report4 as $reports4) {
                                                           $quiz_id = $reports4->quiz_id;
                                                           if($user_type=='1')
                                                           $user = 'advertiser';
                                                           else $user = 'special';
                                                            
                                                            if($reports4->action == 'click' )
                                                            {
                                                                $i++;
                                                                //$cpc+= $this->Member_model->get_member_cpc($user);
                                                                $cpc= $this->Quiz_model->check_member_cpc($this->session->userdata('wannaquiz_user_id'));
                                                            }
                                                        }
                                                        if($i!=0)
                                                        //echo $cpc/$i;
                                                        echo $cpc->cpc;
                                                        else echo 0;
                                                    }
                                                    else echo 0;
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="txtaddtitle_left">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                	$ <?php
                                                    $cpc=0;
                                                    if(count($report4)>0) {
                                                        foreach($report4 as $reports4) {
                                                            if($user_type=='1')
                                                           $user = 'sponsor';
                                                           else $user = 'special';

                                                            if($reports4->action == 'click'){
                                                               $cpc = $this->Quiz_model->check_member_cpc($this->session->userdata('wannaquiz_user_id'));
                                                               $cpc1+= $cpc->cpc;
                                                            }
                                                         }
                                                        echo $cpc1;
                                                        $total_cpc+=$cpc1;
                                                    }
                                                    else echo $cpc;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                    </div>
                                    
                                 <? } else {?>
                                    
                                    <div style="width:100%; text-align: center; padding: 15px 0; color: #777; font-weight: bold; font-size: 12px;">The Report is not available!</div>
                                    <? }?>
                                	<div class="padding_10topbottom">
                                    <div class="bg_blue text_center" style="color:blue">
                                    	<div class="txtaddtitle_left" style="width:620px;">
                                        	<div class="borderrightbottom_white">
                                            	<div class="txtaddtitle_height">
                                                    <strong> Total </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="bg_blue">
                                        	<div class="borderrightbottom_white">
                                                    <div class="txtaddtitle_height" style="text-indent: 50px;">
                                                	<strong> $ <?php
                                                      echo $total_cpc; ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                </div> 
                                   
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="borderbottom_dotted"></div>