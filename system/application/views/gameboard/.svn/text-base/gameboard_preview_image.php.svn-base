
<script src="<?=base_url()?>Jcrop/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?=base_url()?>Jcrop/css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>Jcrop/demos/demo_files/demos.css" type="text/css" />

<script language="Javascript">

    jQuery(function(){
        if('<?=$board_type?>' == 'free')
        ratio = 4/5;
        else ratio =1;
        jQuery('#cropbox').Jcrop({
            aspectRatio: ratio,
            onChange: updateCoords
        });

    });

    function updateCoords(c)
    {
        jQuery('#x').val(c.x);
        jQuery('#y').val(c.y);
        jQuery('#w').val(c.w);
        jQuery('#h').val(c.h);
        //alert(c.w+'/'+c.h);
    };

    function checkCoords()
    {
        if (parseInt(jQuery('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    };

    function rotate_image(org_name){//alert(org_name);
        jQuery.post('<?=base_url()?>gameboard/rotateImage',{org_name:org_name},function(data){ //alert(data);
           window.location.reload();
        })
    }

</script>




<div class="content_wrap">
    <div class="whitelongbox_topborder">
        <div>
            <div class="title_align">
                <div class="bluetitlebg_leftborder"></div>
                <div class="bluetitlebg_bg" style="width:715px;">
                    <div class="bold font14 color_white">Game Boards</div>
                </div>
                <div class="bluetitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="whitelongbox_bg">
        <div class="whiteboxrightside_bgInner">
            <div class="content_10box">
                <div>Crop the image: Put your cursor on the image, click and hold your mouse button and select the part that will show up in the center of your board. <br>
                    Note: Don’t drag too far outside the image, otherwise IE accelerator might mess up the selection process.
</div><br>


                <!-- This is the form that our event handler fills -->

                <form action="<?=site_url('gameboard/customizedGameboard')?>" method="post" name="preview_image">
                    <input type="hidden" name="board_type" value="<?=$board_type?>" />
                    <input type="hidden" name="image_name" value="<?=$org_image?>" />
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />

                    <input type="hidden" name="large_image_name" value="<?=$ques_photo?>">
                    <div id="">
                                                           <?php //$image=base_url().'tmp_uploads/'.$org_image;
                        //                                         list($imageWidth, $imageHeight, $imageType, $imageAttr) = getimagesize($image);
                        //                                         if($imageWidth > $imageHeight){
                        //                                             $h = '500';
                        //                                             $w = '';
                        //                                         }
                        //                                         else {
                        //                                             $h='';
                        //                                             $w = '670';
                        //                                         }
                        //                                        ?>

                        <?php if(!$this->session->userdata('org_image_name')) {
                            if($_SERVER['SERVER_NAME']=='localhost')
                            $this->images->resize($_SERVER['DOCUMENT_ROOT'].'/wannaquiz/tmp_uploads/'.$org_image, 670, 670, $_SERVER['DOCUMENT_ROOT'].'/wannaquiz/gameboard_images/gameboard_resized_images/'.$org_image);
                            else
                            #$this->images->resize($_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz/tmp_uploads/'.$org_image, 670, 670, $_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz/gameboard_images/gameboard_resized_images/'.$org_image);
                                $this->images->resize($_SERVER['DOCUMENT_ROOT'].'/tmp_uploads/'.$org_image, 670, 670, $_SERVER['DOCUMENT_ROOT'].'/gameboard_images/gameboard_resized_images/'.$org_image);
                        }?>

                        <div id="image_rotate" onclick="rotate_image('<?php if($this->session->userdata('org_image_name')) echo $this->session->userdata('org_image_name'); else echo $org_image;?>')" >
                            <span style="color:blue; cursor:pointer"> Rotate Image: </span>
                            <span>Click "Rotate Image" to rotate your image 90 degree.</span>
                        </div>
                        <br>
                        <div id="crop_image">
                            <img id="cropbox" src="<?=base_url()?>gameboard_images/gameboard_resized_images/<?php if($this->session->userdata('org_image_name')) echo $this->session->userdata('org_image_name'); else echo $org_image; $this->session->unset_userdata('org_image_name');?>">
                        </div>
                        <!--<img id="cropbox" src="<?php echo base_url(); ?>resizer.php?src=<?php echo $image; ?>&h=<?=$h?>&w=<?=$w?>&zc=0" alt="" id="" />-->
                        <!--<img id="cropbox" src="<?=base_url()?>tmp_uploads/<?=$org_image?>" width="700px"  alt="gameframe" />-->
                    </div>
                    <div><input type="submit" id="save" value="Crop"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="whitelongbox_bottomborder"></div>
</div>
<script>
    $(document).ready(function() {
        $('#printboard').click(function() {

            var txt = '<img src="<?=base_url()?>results/<?=$gameboard_image?>" width="400"><br>Print';
            $.prompt(txt,{
                buttons: { Print: true, Cancel: false },
                submit: function(v,m,f){
                    if(v)
                        window.print();
                }
            });


            /*w=window.open();
        w.document.write($('#id2').html());
        w.print();
        w.close();*/
        });
    });
</script>
