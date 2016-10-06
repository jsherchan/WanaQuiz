<script type="text/javascript" src="<?=base_url()?>js/jquery.paginate.js">
 loadPiece("<?php echo base_url();?>member/allSubscribings","#following_paginate");
</script>
<div style="width:360px;" id="following_paginate">
<?php
//print_r($data);

if(count($data)>0){
        foreach($data as $datas) { ?>
<div class="addsubscriber">
                                <div class="addsubscriberInner">
                                <div class="text_center">
                                    <div class="border1_green"><a href="<?=site_url($datas->username)?>"><img src="<?=base_url().FRIENDS.'/'.$datas->profile_picture?>" alt="<?=$datas->username?>" /></a></div>
                                    <div class="padding_5top"><a href="<?=site_url($datas->username)?>"><?=$datas->first_name?> &nbsp; <?=$datas->last_name?></a></div>
                                </div>
                            </div>
                        </div>
                        <? } }?>
    
    <div class="clear"></div>
    <?php echo $pagination1; ?>
                        </div>

                        
                        