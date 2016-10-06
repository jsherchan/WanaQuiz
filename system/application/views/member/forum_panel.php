<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
   <script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>

<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/ddsmoothmenu-v.css" />
<div class="leftside">
      <div class="content_wrap">
        <div class="whiteboxleftside_topborder">
            <div class="title_align">
                <div class="greentitlebg_leftborder"></div>
                <div class="greentitlebg_bg" style="width:178px;">
                <div class="bold font14 color_white">Forum panel</div>
                </div>
                <div class="greentitlebg_rightborder"></div>

                <div class="clear"></div>
            </div>
        </div>
        <div class="whiteboxleftside_bg">
            <div class="whiteboxrightside_bgInner">
                <div id="smoothmenu2">
                    <ul>
                        <? foreach($category_list as $rows)
                        { ?>
                                <li><?=$rows->name?> 
                              <?php $sub_categories_list = $this->forum_category_model->get_sub_categorie($rows->id);
                                       
                                            if($sub_categories_list) {
                                                ?>
                                 
                                <? foreach($sub_categories_list as $sub)
                                {?>
                        <li ><a href="<?=site_url('forum/forum_sub_by_category'.'/'.$sub->id)?>" style="color: rgb(0,150,204);"><?=$sub->name?></a>
                                         </li>
                                 <?}?>
                                        
                             <?}?>
                        </li>           
                            <? }?>
                     </ul>
                    <div class="borderbottom_dotted"></div>
                </div>
            </div>
        </div>
        <div class="whiteboxleftside_bottomborder"></div>
      </div>
</div>