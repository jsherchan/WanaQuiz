<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>
<div class="content_wrap">
                <div class="whitelongbox_topborder">
                    <div>
                        <div class="title_align">
                            <div class="bluetitlebg_leftborder"></div>
                            <div class="bluetitlebg_bg" style="width:715px;">
                                <div class="bold font14 color_white">Premium Game Boards</div>
                            </div>
                            <div class="bluetitlebg_rightborder"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bg">
                    <div class="whiteboxrightside_bgInner">
                        <div class="content_10box">
                        	<div class="padding_10topbottom">
                            	<!--<div class="gameboard_left"><div class="bold"><span class="bold">1-9</span> of <span class="bold">234</span></div></div>-->
                                    <div class="gameboard_right text_right" style="width:123px;"><a href="<?=site_url('gameboard/type/premium')?>">Upload my own image</a></div>

                                <div class="clear"></div>
                            </div>
                            <div class="content_wrap">
                            <? if(count($premium_boards)>0){
                                $i=0;
                               foreach($premium_boards as $premiumBoards){
                                //for($i=0;$i<count($premium_boards);$i++){

                                ?>

                            	<div class="gameboardbox"  id="board_<?=$i?>">
                                	<div class="gameboardboxInner">
                                    	<div class="border_gray">
                                        	<div class="gameboardbox_height">
                                                <div class="gameboardbox_bgalign">
                                                    <div class="text_center">
                                                        <div class="bold font14"><a href="#">Type <?=$i+1?></a></div>
                                                        <div class="padding_10topbottom" >
                                                            <div class="gameboardbox_bg">
                                                            	<div class="gameboardbox_bgInner" >
                                                                    <?php $this->images->resize('gameboard_images/'.$premiumBoards->board_image, 158, 158, 'gameboard_thumb_images/'.$premiumBoards->board_image,'false');?>
                                                                    <a href="#"  style="display:block; background:url(<?=base_url()?>gameboard_thumb_images/<?=$premiumBoards->board_image?>) no-repeat top left; width:158px; height:158px; margin-top:-20px; margin-left:-20px">
                                                                         <img src="<?=base_url()?>gameboard_thumb_images/<?=$user_image?>" style="width:115px; height:115px; margin-top:22px"></img>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="premium_btn_align">
                                                            <div class="premium_btn" id="download_<?=$i?>" onclick="print_board('<?=$premiumBoards->board_image;?>','download','<?=$i?>')"><a href="#" style="background-color:#00B7FC;">Download</a></div>
                                                            <div class="premium_btn"><a href="javascript:void(0);" style="background-color:#999999;" onclick="print_board('<?=$premiumBoards->board_image;?>','print','<?=$i?>')" id="printboard_<?=$i?>">Print</a></div>
                                                            <div class="premium_btn"><a href="<?=site_url('gameboard/order/'.$premiumBoards->id)?>" style="background-color:#84D235;">Order Premium</a></div>
                                                        </div>

                                                    </div>
                                                </div>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                            <? $i++; } } ?>

                                <div class="clear"></div>
                            </div>

                            <div class="content_10box">
                                <div class="playlistbtn_alignright">
                                    <div class="pagination">
                                        <?php //echo $this->pagination->create_links();?>
                                        <!--<ul>
                                            <li><a href="#">Previous</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#" class="pageselected">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">Next</a></li>

                                            <div class="clear"></div>
                                        </ul>-->
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="whitelongbox_bottomborder"></div>
            </div>
  <script>
  function print_board(board_name,type,i){
  
         $.post('<?=base_url()?>gameboard/print_board', {board_name:board_name,image:'<?=$image?>'} , function(data)
         {
			 if(type=='print'){ 
                var txt = '<img src="<?=base_url()?>results/'+data+'" width="400"><br>Print';
                $.prompt(txt,{
                        buttons: { Print: true, Cancel: false },
                        submit: function(v,m,f){
                                                if(v)
                                                    window.print();
                    }
            });
            }
            else { 
                window.location ='<?=base_url()?>downloader/download/'+data;
               
            }
});

	/*w=window.open();
	w.document.write($('#id2').html());
	w.print();
	w.close();*/
  }


  </script>