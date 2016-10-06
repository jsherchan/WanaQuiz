<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>uploadify/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>uploadify/js/swfobject.js"></script>
<script type="text/javascript" src="<?=base_url()?>uploadify/js/jquery.uploadify.v2.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>uploadify/css/uploadify.css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery.lightbox-0.5.js"></script>

<!--<link rel="stylesheet" type="text/css" href="<?=base_url()?>codebase/dhtmlxvault.css" />
<script language="JavaScript" type="text/javascript" src="<?=base_url()?>codebase/dhtmlxvault.js"></script>
-->
<script type="text/javascript">
    $(function() {
        // Use this example, or...
        $('a[rel*=lightbox]').lightBox(); // Select all links that contains lightbox in the attribute rel
    });
</script>

<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script language="JavaScript" type="text/javascript">
    var vault = null;
//    function doOnLoad() {
//        vault = new dhtmlXVaultObject();
//        vault.setImagePath("< ?=base_url()?>codebase/imgs/");
//        vault.setServerHandlers("< ?=base_url()?>?c=media&m=uploadPhotoHandler", "< ?=base_url()?>media/getInfoHandler", "< ?=base_url()?>media/getIdHandler");
//
//        vault.onUploadComplete = function() {
//
//            $('#video_content').show();
//            $('#video_content').load('< ?=base_url()?>media/photoUploaded');
//
//        };
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

	else{ 
             $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
            if(v){
		$.post('<?=base_url()?>member/deletePhotoContent', {ids:tt} , function(data){
                    if (data != '' || data != undefined || data != null)
                {
                    //console.log(data);
                    ///*
                    $('#video_content').html(data);
                    $('#allbox').attr('checked',false);
                    //*/
                  }
                });
                }}});
		}
	});

});


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
        $('.check_name').attr('checked','checked');
        $('.allbox').attr('checked','checked');
    }

    function delete_content(photo_id)
    {
        $.prompt('Do you want to delete?',{ buttons: { Ok: true, Cancel: false },callback: function(v,m,f){
                if(v){
                    $.post('<?=base_url()?>member/deletePhotoContent', {ids:photo_id} , function(data){
                        if (data != '' || data != undefined || data != null)
                        {                            
                            $('#video_content').html(data);
                        }
                    });
                }
            }});
    }

</script>


<style>
    body {font-size:12px}
    *{font-family:arial;font-size:12px}
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
                        <div class="bold font14 color_white">Upload photo content</div>
                    </div>
                    <div class="bluetitlebg_rightborder"></div>

                    <div class="clear"></div>
                </div>
            </div>
            <div class="whiteboxmidside_bg">
                <div class="whiteboxrightside_bgInner">
                    <form name="playlist" action="" method="post">
                    <div class="content_10box">
                        <div class="padding_2bottom">
                            <div>
                                <div class="bold">
                                        <div class="msg_checkbox"><input type="checkbox" id="allbox" name="allbox" onclick="checkAll()" value="on" class="allbox"/></div>

                                        <div class="addoptional_desc">
                                            <a href="javascript:;" onclick="checkAllBoxes()">Check All</a> &nbsp;&nbsp;&nbsp; 
                                            <a href="#" id="delete_all">Delete Photo (s)</a>
                                        </div>

                                        <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bold font14">Uploaded Photo contents</div>
                        <div id="video_content">
                            <?
                            if($photos_list!=NULL) {
                                foreach($photos_list as $photo) {?>
                            <div class="viewimg">
                                <div class="border_green">
                                    <a href="<?=base_url()?>user_uploaded_photos/<?=$this->session->userdata('wannaquiz_user_id')?>/<?=$photo->photo_name?>" rel="lightbox">
                                                <?
                                                if($_SERVER['SERVER_NAME']=='localhost')
                                                $photo_path = $_SERVER['DOCUMENT_ROOT']."/wannaquiz/photo_question_thumbs/".$photo->photo_name;
                                                else
                                                $photo_path = $_SERVER['DOCUMENT_ROOT']."/photo_question_thumbs/".$photo->photo_name;
                                                
                                                if(file_exists($photo_path)) {
                                                    ?>
                                        <img src="<?=base_url()?>photo_question_thumbs/<?=$photo->photo_name?>" alt="feature quest img" />
                                                <? } 
                                                else {?>
                                        <img src="<?=base_url()?>images/default_img.jpg" alt="feature quest img" height="100px" width="100px">
                                                <? } ?>
                                    </a>
                                </div>
                                <div><label><input type="checkbox" name="name_<?=$photo->photo_id?>" value="<?=$photo->photo_id?>" class="check_name"></label>
                                <!--<a href="#" style="color:red;" onclick="delete_content(<?=$photo->photo_id?>)"><span class="font14 bold">X</span> Delete</a>--></div>
                            </div>
                                <? }
                            } else {?>
                            <div>You have not uploaded anything yet!</div>
                            <? } ?>



                        </div>
                        <div class="clear"></div>
                    </div>
                    </form>
                    <div style="text-align:right"><?=$pagination?></div>


                    <div class="content_10box">
                        <div class="">
                            <div class="bold font14">Upload Photo content</div>
                            <div class="desc">
                                <p>
                                            	You can upload multiple photos at once.
                                </p>
                            </div>
                            <div class="padding_10topbottom">

                                <div id="fileInput"></div>
                                <script type="text/javascript">// <![CDATA[
                                $(document).ready(function() {
                                $('#fileInput').uploadify({
                                'uploader'  : '<?=base_url()?>uploadify/js/uploadify.swf',
                                'script'    : '<?=base_url()?>media/imageUploadHandler',
                                'cancelImg' : '<?=base_url()?>uploadify/cancel.png',
                                'folder'    : 'user_uploaded_photos/<?=$this->session->userdata("wannaquiz_user_id")?>/',
                                'multi'          : true,
                                'auto'      :  true,
                                'scriptData' : {'gallery_id':0,
                                                'sub_gallery':0,
                                                'user_id':<?=$this->session->userdata("wannaquiz_user_id")?> },
                                    onComplete: function(event, queueID, fileObj, response, data) {                                        
                                        //alert(response); 
                                        //console.log(response);
                                         //if(response!=1) $('#fileInput').uploadifyClearQueue();
                                         
                                         //*

                                         if(response)
                                            $('#video_content').load('<?=base_url()?>media/photoUploaded2');

                                         msg=response.split('#');
                                         if(response!=1) $('#gal_err_msg').html(msg[0]);
                                         $('#subgal_err_msg').html(msg[1]);
                                         
                                         //*/
                                    }
                                });

                                });
                                // ]]></script>
                <br /> <!--<a href="javascript:$('#fileInput').uploadifyUpload();"  >Upload Files</a> | <a href="javascript:$('#fileInput').uploadifyClearQueue();">Clear Queue</a>-->


                                
                            </div>

                            <div class="redbox">
                                <div class="content_10box">
                                    <div class="desc">
                                        <p>
                                            <span class="bold" style="color:#000080">Copyrights: </span> Do not upload photos/stills from movie clips/trailers, TV shows, music clips, music concerts, or commercials without permission unless you are the copyright owner.
                                        </p>
                                        <p>By clicking "Upload Files" you state that the image(s) do not voilate WannaQuiz' <a href="<?=base_url()?>page/show/terms_conditions">Terms of Service</a> and that you are the copyright owner of the content or have authorization to upload it.</p>
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
