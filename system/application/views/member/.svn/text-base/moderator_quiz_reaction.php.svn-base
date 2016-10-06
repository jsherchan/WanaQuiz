
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex" />
        <title><?=$title;?></title>
        <link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>css/game.css" rel="stylesheet" type="text/css" />
        <script>var base_url='<?=base_url()?>';</script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
        <script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/ddsmoothmenu.css" />
        <script type="text/javascript" src="<?=base_url()?>js/ddsmoothmenu.js"></script>

        <script type="text/javascript">

        ddsmoothmenu.init({
                mainmenuid: "smoothmenu1", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu', //class added to menu's outer DIV
                //customtheme: ["#1c5a80", "#18374a"],
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
        })
        </script>

      


        <link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
        <style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>

       

         
        <script type="text/javascript">
         var j = jQuery.noConflict();
            function quiz_edit_commit(uid){ //alert('hii');
                var comment = $('#edit_comments_'+uid).val();
             
                if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>moderator_management/quizeditComment', 
                    {comment_id:uid, comment:comment} , 
                    function(data){
                            if(data=='success');
                            location.reload();
 
                         });
                        
                }

            }
            
            
           function delete_comment(id)
        { 
    
	job=confirm("Are you sure you want to Delete Report?");
	if(job==true)
       
        {   j.post("<?=site_url('moderator_management/delete_comment/')?>", {comment_id:id}, function(data){
                    if(data=='success');
                  j('#list_'+id).hide(1000);
                });
            }
        else {
		return false;
            }
    }
       function quiz_edit_reply(uid){ //alert('hii');
                var comment = $('#edit_comment_reply').val();
                if(comment == '')
               {
                    alert('The field should not be empty!')
                }
                else
                {
                    $.post('<?=base_url()?>moderator_management/quizeditComment', 
                    {comment_id:uid, comment:comment} , 
                    function(data){
                            if(data=='success');
                            location.reload();
 
                         });
                        
                }

            }

           function hideShowReaction(){
                $('#text_reaction').toggle();
            }

            function toggle(obj) {
            
                var el = document.getElementById(obj);
             if ( el.style.display != 'none' ) {
                    el.style.display = 'none';
                }
                else {
                    el.style.display = '';
                }
            }
        </script>
  

<div class="right_large_col floatR">

    <div class="rounded_white_bg">
        <div class="pos">
            <h1 class="blue_title"><span>Reported Comments</span></h1>
            <div class="list_cont">
                <?
                $user_id = $this->session->userdata('wannaquiz_user_id');
                if(count($question_reaction)>0) {
                foreach($question_reaction as $quizComments) {

                ?>

                <div class="list_slot clearfix reported_user_list" id="list_<?=$quizComments['comment_id']?>" >

                    <div class="reported_comments_desc">
                        <div class="reported_comments">
                            <div class=""><strong>Comments:</strong></div>
                            <p><?=nl2br($quizComments['comment'])?> </p>
                        </div>
                        <div class="reported_question">
                        <strong>Question:</strong> <a href="#"><?=$quizComments['quiz_question']?>?</a>
                        </div>
                        <div class="report_meta">Commented by <a href="#" class="reported_author"><?=$quizComments['username']?>  </a> |<?=date("Y-m-d H:i:s",$quizComments['comment_date'])?></div>
                        
                        <div  style="display:none" id="editcomment_<?=$quizComments['comment_id']?>">

                        <label><strong class="font11 lh1_66">Edit this Comment</strong></label>
                        <textarea rows="20" cols="10" class="large_textarea" id="edit_comments_<?=$quizComments['comment_id']?>" value="<?=nl2br($quizComments['comment'])?>"> </textarea>
                        <div class="clear"></div>
                        <div class="clearfix"><span class="scalable_btn aqua">
                        <input type="submit" value="Save edited disscussion" id="submit_comment" onclick="quiz_edit_commit('<?=$quizComments['comment_id']?>')"/>
                        </span></div>

                        </div>

                    </div>
                    <div class="delete"> <a href="javascript:void(0)" onclick='return delete_comment("<?=$quizComments['comment_id']?>")' class="delete_btn">Delete </a> 
                    <a style="cursor:pointer"  class="delete_btn black_btn edit_comment" onclick="toggle('editcomment_<?=$quizComments['comment_id']?>')">Edit Comment</a>
                  </div>
                </div>
                <?php } }?>
            </div>
            <div class="paginnation clearfix">
            <?=$this->pagination->create_links();?>
            </div>
        </div>
    </div>
</div>

