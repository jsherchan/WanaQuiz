<script type="text/javascript" src="<?php echo base_url();?>flowplayer/flowplayer-3.1.4.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?=base_url()?>codebase/dhtmlxvault.css" />
<script language="JavaScript" type="text/javascript" src="<?=base_url()?>codebase/dhtmlxvault.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/swfobject_player.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/swfobject.js"></script>
<script type="text/javascript" src="<?=base_url()?>uploadify/js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.oembed.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/player.swf"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>uploadify/css/uploadify.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script language="JavaScript" type="text/javascript">
    //    var vault = null;
    //    function doOnLoad() {
    //        vault = new dhtmlXVaultObject();
    //        vault.setImagePath("<?=base_url()?>codebase/imgs/");
    //        vault.setServerHandlers("<?=base_url()?>?c=media&m=uploadVideoHandler", "<?=base_url()?>media/getInfoHandler", "<?=base_url()?>media/getIdHandler");
    //        //vault.setFilesLimit(1);
    //        vault.onAddFile = function(fileName) {
    //            var ext = this.getFileExtension(fileName);
    //            if (ext != "flv" && ext != "wmv" && ext != "avi" && ext !="mpeg" && ext != "mpg") {
    //                alert("You may upload only video files (flv, wmv, avi, mpeg, mpg). Please retry.");
    //                return false;
    //            }
    //            else return true;
    //        };
    //
    //        vault.onUploadComplete = function(files) {
    //            var s="";
    //            for (var i=0; i<files.length; i++) {
    //                var file = files[i];
    //                //  s += ("id:" + file.id + ",name:" + file.name + ",uploaded:" + file.uploaded + ",error:" + file.error)+"\n";
    //                s+=file.name;
    //            }
    //            //alert(s);
    //            $('#video_content').show();
    //            $('#video_content').load('<?=base_url()?>media/videoUploaded');
    //            $('#videoShow').show();
    //            $('#videoShow').load('<?=base_url()?>media/uploaded/'+s);
    //
    //        };
    //
    //
    //        vault.create("vault1");
    //    }
    //
    //    $(document).ready(function(){
    //        doOnLoad();
    //    });

    $(document).ready(function()
{
	$("#delete_all").click(function(){
	var tt='';
	for (var i=0;i<document.playlist.elements.length;i++)
	{
		var e=document.playlist.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox') )
		{
			if(e.checked)
			tt=e.value+','+tt;
		}
	}
	if(tt=="")
		alert('Please check the message to delete');

	else{ //alert(tt);
             $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
		$.post('<?=base_url()?>member/deleteVideoContent', {ids:tt} , function(data){
                    if (data != '' || data != undefined || data != null)
                {    
                        $('#video_content').html(data);
                   
                    }
                });
                }}});
		}
	});

});


    function delete_content(video_id)
    {
        $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                    $.post('<?=base_url()?>member/deleteVideoContent', {ids:video_id} , function(data){
                        if (data != '' || data != undefined || data != null)
                        {
                            $('#video_content').html(data);
                        }
                    });
                }
            }});
    }

    function checkAll()
    {
            for (var i=0;i<document.playlist.elements.length;i++)
            {
                    var e=document.playlist.elements[i];
                    if ((e.name != 'allbox') && (e.type=='checkbox'))
                    {
                            e.checked=document.playlist.allbox.checked;
                    }
            }
    }

    function checkAllBoxes(){
        $('.check_name').attr('checked',true);
        $('.allbox').attr('checked',true);
    }

</script>
<style>
    body {font-size:12px}
    /*.{font-family:arial;font-size:12px}*/
    h1 {cursor:hand;font-size:16px;margin-left:10px;line-height:10px}
    xmp {color:green;font-size:12px;margin:0px;font-family:courier;background-color:#e6e6fa;padding:2px}
    .hdr{
        background-color:lightgrey;
        margin-bottom:10px;
        padding-left:10px;
    }
</style>

<div class="midside">
    <div class="midsideInner">
        <div class="content_wrap">
            <div class="whiteboxmidside_topborder">
                <div class="title_align">
                    <div class="bluetitlebg_leftborder"></div>
                    <div class="bluetitlebg_bg" style="width:470px;">
                        <div class="bold font14 color_white">Upload Video content</div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="whiteboxmidside_bg">
                <div class="whiteboxrightside_bgInner">
                <form name="playlist" action="" method="post">
                    <div class="content_10box" >
                        <div class="padding_2bottom">
                            <div>
                                <div class="bold">
                                        <div class="msg_checkbox"><input type="checkbox" name="allbox" onclick="checkAll()" value="on" class="allbox"/></div>

                                        <div class="addoptional_desc"><a href="javascript:;" onclick="checkAllBoxes()">Check All</a> &nbsp;&nbsp;&nbsp; <a href="#" id="delete_all">Delete All</a></div>

                                        <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bold font14" >Uploaded Video contents</div>
                        <div id="video_content">
                            <? if($video_list!=NULL) {
                                foreach($video_list as $video) {
                                    $vd=explode('.',$video->video_name);
                                    ?>
                            <div class="viewimg">
                                <div class="border_green">
                                    <!--<a href="<?=base_url()?>converted_video_images/<?=$vd[0]?>.jpg" rel="lightbox">-->
                                            <? //$a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            if($_SERVER['SERVER_NAME']=='localhost')
                                                $a = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            #else $a = $_SERVER['DOCUMENT_ROOT']."/clients/wannaquiz/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            else $a = $_SERVER['DOCUMENT_ROOT']."/converted_video_images/converted_video_images_thumbs/".$vd[0].".jpg";
                                            if(file_exists($a)) {
                                                ?>
                                    <img src="<?=base_url()?>converted_video_images/converted_video_images_thumbs/<?=$vd[0]?>.jpg" alt="feature quest img" />
                                            <? } else {?>
                                    <img src="<?=base_url()?>images/video_img.jpg" alt="feature quest img" height="100px" width="100px">
                                            <? } ?>
                                    <!--</a>-->
                                </div>
                                <div><label><input type="checkbox" name="name_<?=$video->video_id?>" value="<?=$video->video_id?>" class="check_name"></label><!--<a href="#" style="color:red;" onclick="delete_content(<?=$video->video_id?>)"><span class="font14 bold">X</span> Delete</a>--></div>
                            </div>
                                <? }?>

                            <?}else {?>
                            <div>You have not uploaded anything yet!</div>
                            <? } ?>
                        </div>
                        <div class="clear"></div>

                    </div>
                </form>
                    <div style="text-align:right"><?=$pagination;?></div>
                    <div class="content_10box">
                        <div class="">
                            <div class="bold font14">Upload Video content</div>
                            <div class="desc">
                                <p>
                                            	You can upload multiple videos at once.
                                </p>
                            </div>
                            <div id="error_msg" style="display:none; color:red">Your video is too long. Videos may only be up to 50 seconds in length.</div>
                            <div class="padding_10topbottom">

                                <div id="fileInput"></div>
                                <script type="text/javascript">// <![CDATA[
                                    $(document).ready(function() {
                                        $('#fileInput').uploadify({
                                            'uploader'  : '<?=base_url()?>uploadify/js/uploadify.swf',
                                            'script'    : '<?=base_url()?>media/videoUploadHandler',
                                            'cancelImg' : '<?=base_url()?>uploadify/cancel.png',
                                            'auto'      : true,

                                            'multi'          : true,
                                            'scriptData' : {'gallery_id':0,
                                                'sub_gallery':0,
                                                'user_id':<?=$this->session->userdata("wannaquiz_user_id")?>},
                                                onComplete: function(event, queueID, fileObj, response, data) {
                                                //if(response!=1) $('b#fileInput').uploadifyClearQueue();
                                                 //console.log(response);
                                                 //alert(data); 
                                                 //return false;
                                                 
                                                 msg=response.split('%');
                                                 
                                                if(msg[1] == 'success')
                                                { 
                                                    $('#video_content').load('<?=base_url()?>media/videoUploaded');
                                                    $('#error_msg').hide();
                                                }
                                                
                                                else {
                                                    alert(msg[1]);
                                                    $('#error_msg').show();
                                                }
                                            }

                                        });

                                    });
                                    // ]]></script>
                                <br /> <!--<a href="javascript:$('#fileInput').uploadifyUpload();"  >Upload Files</a> | <a href="javascript:$('#fileInput').uploadifyClearQueue();">Clear Queue</a>-->

                                <div>
                                    <div style="padding:10px 0 10px 0; color:#000080; font-weight:bold">Please compare the sound level before uploading!</div>
                                    <div style="padding:0 0 10px 0;">
                                        On WannaQuiz videos are short and watched one after another. Users don't want to adjust their sound every couple of seconds... so please compare your sound level below and adjust it, if necessary, before uploading. <a href="<?=base_url()?>page/show/sound">Read more</a>
                                    </div>
                                    <div style="color:#008000">
                                        Very loud/soft videos might be removed!
                                    </div>
                                </div>

                                <div style="padding-top:10px; padding-bottom:20px">
                                    <div style="font-weight:bold">Voice - sound level test</div>
                                    <div id="div1" style="float:left; padding:10px 0 10px 0">
                                        <div id='player1'></div>
                                        <script type='text/javascript'>
                                            var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                            so.addParam('allowfullscreen','true');
                                            so.addParam('allowscriptaccess','always');
                                            so.addParam('wmode','opaque');
                                            so.addVariable('file','<?=base_url()?>Voice - sound level test.mp3');
                                            so.write('player1');
                                        </script>
                                    </div>                                    
                                    <div class="clear"></div>

                                    <div style="font-weight:bold; padding-top:10px">Music - sound level test</div>
                                    <div style="padding-top:10px; padding-bottom:10px">
                                        <div id='player2'></div>
                                        <script type='text/javascript'>
                                            var so = new SWFObject('<?=base_url()?>js/player.swf','mpl','300','24','9');
                                            so.addParam('allowfullscreen','true');
                                            so.addParam('allowscriptaccess','always');
                                            so.addParam('wmode','opaque');
                                            so.addVariable('file','<?=base_url()?>Music - sound level test.mp3');
                                            so.write('player2');
                                        </script>
                                    </div>
                                    <span style="width:auto;">Download:<a href="<?=base_url()?>download"> Voice - sound level test</a> | <a href="<?=base_url()?>download1"> Music - sound level test</a></span>
                                    <div style="padding:10px 0 0 0">Music must be made by yourself or in the <a href="<?=base_url()?>page/show/sound">public domain/creative commons</a></div>
                                    <!--<div id="vault1"></div>-->

                                </div>
                            </div>
                            <div class="clear"></div>
                            <div id="videoShow">  </div>

                            <div class="redbox">
                                <div class="content_10box">
                                    <div class="desc">
                                        <p>
                                            <span class="bold" style="color:#000080">Copyrights: </span> Do not upload movie clips/trailers, TV shows, music videos, music concerts, or commercials without permission, unless you created the content yourself.
                                        </p>
                                        <p>By clicking "Upload Files" you state that you do not violate WannaQuiz' <a href="<?=base_url()?>page/show/terms_conditions">Terms of Service</a> and you are the copyright owner of the entire content or have authorization to upload it.</p>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>


                </div>
            </div>
            <div class="whiteboxmidside_bottomborder"></div>
        </div>
    </div>
</div>