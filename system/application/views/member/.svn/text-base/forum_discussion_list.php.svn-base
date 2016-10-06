
<script>
     var j = jQuery.noConflict();
     function dochange(id)
{
    if(id!='')
        jQuery('#sub_category').load('<?=base_url()?>forum/forum_get_subcategory_options',{pid:id});
    else
        jQuery('#sub_category').html('<select><option value="">- Sub Category -</option></select>');
}
function add_discussion(){ //alert('hii');
              
                var dis = j('#discussion').val();
                var cat=j('#cat_id').val();
                var sub_cat=j('#sub_cat_id').val();
                var tag=j('#tag').val();
                var discussion_detail=j('#discussion_detail').val();
                
                if(dis == ''||cat=='' )
               {
                    alert('The field should not be empty!')
                }
                else
                {
                   
                    j.post('<?=base_url()?>forum/add_discussion', 
                    { discussion:dis,categories:cat,sub_categories:sub_cat,tag:tag,discussion_detail:discussion_detail} , 
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

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="<?=base_url()?>css/layout1.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/typo.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>css/form1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<!--[if IE 6]>
		<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script type="text/javascript">
			DD_belatedPNG.fix('.png_bg, img');
		</script>
<![endif]-->
</head>

<body>
<div class="two_col_cont">
 
  <div class="right_large_col floatR">
    <div class="rounded_white_bg">
      <div class="pos">
        <h1 class="blue_title"><span>  <?=$recent_Category['name'];?></span></h1>
        <div class="clearfix space_bottom"> <? if($this->session->userdata('wannaquiz_user_id')){?><a href="#" class="scalable_btn" onclick="toggle('addDiscussion')"><span>Post New Thread</span></a> <?}?></div>
        <div class="list_cont"> 
             <div class="list_slot clearfix discussion_list bold list_style">
           <div class="cell_1 cell"> <div class="discussion_topic">Thread Starter</div>
            </div>
            
            <div class="cell_2 cell font11">
            <div class="cell_pos">Replies/Views</div>
            </div>
            <div class="cell_3 cell">
            <div class="">Last Reply By</div>
            </div>
          </div>
             <div class="pos" style="display:none" id="addDiscussion">
        <h1 class="blue_title" ><span>New Thread</span></h1>
        <h6 class="title6">Some Rules</h6>
        <div class="text_desc font11">
          <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
          <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
        </div>
       
            <label><strong class="font11 lh1_66">Title</strong></label>
            <input type="text" class="large_text_ip" name="discussion" id="discussion" />
             <label><strong class="font11 lh1_66">Category</strong></label>
            <select name="categories" class="select_input" onchange="dochange(this.value);" id="cat_id" name="cat_id">
              <option value="">- Select Category -</option>
                                                     <?php $categories = $this->forum_category_model->get_all_categories('0');
                                                        if($categories) {
                                                        foreach($categories as $rows) { ?>
							<option value="<?=$rows->id?>"><?=$rows->name?></option>
                                                          <?php } } ?>
            </select>
             <div>
             <label><strong class="font11 lh1_66" >Sub Category</strong></label>
             <div id="sub_category" class="select_input_outer" >
            <select name="sub_cat_id" id="sub_cat_id" class="" >
                 	<option>- Sub Category -</option>
	  </select></div>&nbsp;</div>
              <label><strong class="font11 lh1_66">Message</strong></label>
            <textarea rows="20" cols="20" class="large_textarea" name="discussion_detail" id="discussion_detail"></textarea>
              
            <label><strong class="font11 lh1_66">Tag</strong> </label>
          <textarea rows="20" cols="20" class="large_textarea" name="tag" id="tag"></textarea>
              
            <div class="clearfix"><span class="scalable_btn aqua">
              
              <input type="submit" value="Post Thread"  onclick="add_discussion()" />
                   </span>
             </div>
        
      </div>
          <?php 
          if($recent){
           foreach($recent as $rows){ ?>
         
          <div class="list_slot clearfix discussion_list list_style ">
              <div class="cell_1 cell"><div class="discussion_topic">
                   <?if($rows->sticky==1){?>
                     <img src='<?= base_url()?>images/needle.png'/>Sticky: 
                      <?}?>
                <a href="<?=site_url('forum/forum_discussion_detail/'.$rows->disc_id)?>" class="blue_link"><?  echo $rows->discussion_title; ?> </a> </div>
            <div class="font11 bold"><?  echo $rows->username; ?> |<?  echo $rows->created; ?>  </div></div>
            
            <div class="cell_2 cell font11">
                <?$res=$this->forum_model->get_total_reply($rows->disc_id);
               ?>   <div class="cell_pos"><div ><strong>Replies: </strong><?=$res[0]['total']?> </div>
            <div ><strong>Views: </strong><?=$rows->views?></div></div>
            </div>
            <div class="cell_3 cell">
                 <?$result=$this->forum_model->get_last_comment($rows->disc_id);
               $post=$result->result_array();
              ?>
                
            <div class=""><a href="<?=site_url($post[0]['username'])?>" class="blue_link"><?=$post[0]['username'];?></a></div>
            <div class="font11">
                <?$today=strtotime(date('Y-m-d H:i:s'));
              $post_day=strtotime($post[0]['comment_date']);
              ?>
                 <? if(empty($post)) 
            $last_post_date = "No Replies ";
        else if($post[0]['comment_date']!='0')
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
               <?=$last_post_date?>
            </div>
            </div>
          </div>
          <?php }}
          else {?>
             <div class="list_slot clearfix discussion_list">
              <div class="discussion_topic" >
               <?  echo "No Threads Available" ?> </div>
             </div>
              <?}?>
        </div>
        <div class="paginnation clearfix">
          <?=$this->pagination->create_links();?>
        </div>
      </div>
    </div>
  </div>
</div>





