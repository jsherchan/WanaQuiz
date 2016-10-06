
<link href="../style/style.css" rel="stylesheet" type="text/css" />

<? if($view_gameboard_layout=="no"){?>
<H1 class="headingclass" ><? //ucfirst($_GET[action])?> Gameboard Management </H1>


<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="<?=site_url(ADMIN_PATH."/gameboard_management")?>">ADMIN</a> &gt;&gt; Scratch Coupon Management </span></td>
    <td>
	<a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" />
	<span class="bodytext">Back</span></a>
    </td>
  </tr>
</table>
<br /><br />
<form  name="frm" method="post" action="<?php if(isset($gameboard_info)) echo site_url(ADMIN_PATH."/gameboard_management/update/"); else echo site_url(ADMIN_PATH."/gameboard_management/insert/");?>" enctype="multipart/form-data" >
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" style="border:1px solid #81A4CE;">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?=$this->session->flashdata('message'); ?>
	 <tr>
      <td width="39%" align="right"><b>Name<span class="small">*</span>:</b> </td>
      <td width="61%"><input name="board_name" type="text" class="normal" value="<? if(isset($gameboard_info)) echo $gameboard_info->board_name?>"></td>
    </tr>
	 <tr>
      <td width="39%" align="right"><b>Type<span class="small">*</span>:</b> </td>
      <td width="61%">
      <select name="board_type">
       <option value="free" <? if(isset($gameboard_info) && $gameboard_info->board_type=='free') echo "selected";?>>Free </option>
       <option value="premium" <? if(isset($gameboard_info) && $gameboard_info->board_type=='premium') echo "selected";?>>Premium  </option>
      </select>
     </td>
    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Board Image<span class="small">*</span> :</b> </td>
      <td width="61%">
    
     <input type="hidden" name="hboard_image" value="<? if(isset($gameboard_info) && $gameboard_info->board_image!="") echo $gameboard_info->board_image;?>" />
  <? if(isset($gameboard_info) && $gameboard_info->board_image!=""){?>
  	<img src="<?=base_url()?>/gameboard_images/<?=$gameboard_info->board_image?>" height="50" />
  <? }?><br />
  <input name="gameboard_image" type="file" class="normal" >
        <span class="small"></span> <br>
        <span style=""> (Upload 800/800 image for premium and 650/800 for free gameboard!)</span>
      </td>

    </tr>
	
	 <tr>
      <td width="39%" align="right"><b>Price<span class="small">*</span>   :</b> </td>
      <td width="61%"><input type="text" name="board_price" value="<? if(isset($gameboard_info)) echo $gameboard_info->board_price;?>" size="10" /></td>
    </tr>

    <tr>
      <td width="39%" align="right"><b>Shipping Cost<span class="small">*</span>   :</b> </td>
      <td width="61%"><input type="text" name="shipping_cost" value="<? if(isset($gameboard_info)) echo $gameboard_info->shipping_cost;?>" size="10" /></td>
    </tr>
	
    <tr>
      <td colspan="2" align="center">
      <input type="hidden" name="id" value="<? if(isset($gameboard_info)) echo $gameboard_info->id?>" />
	 <input type="submit" name="Submit" value="<?php if(isset($gameboard_info)) echo "Edit board"; else echo "Add board"; ?>" />

     </td>

    </tr>
  </table>
</form>
<? }?>

<? if($view_gameboard_layout=="yes"){?>
<h1 class="headingclass" >View Gameboards  </h1>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="86%" height="25"><span class="header"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management')?>">ADMIN</a> &gt;&gt; Gameboard Management </span></td>
    <td><a href="javascript:window.back()"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:window.back()"><span class="bodytext">Back</span></a></td>
  </tr>
</table>
<p>
[<a href="<?=site_url(ADMIN_PATH.'/gameboard_management/add_gameboard/')?>">+Add Board</a>]  
<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>


<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="Mtable">
       
    <tr>
	<th width="9%" align="left" style="border-bottom:1px solid #93bee2" ><a href="<?=site_url(ADMIN_PATH.'/coupons_management/view_gameboard/id/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> ID </a> </th>
	  <th width="21%" align="right"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management/view_gameboard/amount/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Board Name</a></th>
	  <th width="12%" align="left"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management/view_gameboard/board_type/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Board Type </a></th>
	   <th width="21%" align="left"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management/view_gameboard/board_/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Board Image</a></th>
	   <th width="14%" align="left"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management/view_gameboard/board_price/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Board Price</a></th>
           <th width="14%" align="left"><a href="<?=site_url(ADMIN_PATH.'/gameboard_management/view_gameboard/board_price/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF">Shipping Cost</a></th>
	  <th width="12%" align="center"><b>Edit</b> </th>
       <th width="11%" align="center"><b>Delete</b> </th>
    </tr>
   <? 
   	if($gameboard_list>0){
   	   foreach($gameboard_list as $board) {?>
          <tr>
             <td align="left"><?=$board->id?></td>
             <td align="left"><?=$board->board_name?></td>
             <td align="center"><?=$board->board_type?></td>
             <td align="center"><img src="<?=base_url()?>gameboard_images/<?=$board->board_image?>" width="50"></td>
             <td align="center"><?=$board->board_price?></td>
             <td align="center"><?=$board->shipping_cost?></td>
             <td align="center"><a href="<?=site_url(ADMIN_PATH."/gameboard_management/edit_gameboard/".$board->id)?>">
                  <img src='<?=base_url()?>images/admin_images/edit.gif' alt="Edit " border="0"></a> </td>
              <td align="center"><a href="<?=site_url(ADMIN_PATH."/gameboard_management/delete_gameboard/".$board->id)?>">
                  <img src='<?=base_url()?>images/admin_images/delete.gif' alt="Delete " border="0"></a> </td>
          </tr>
  	<? } ?>
	<tr>
	<td colspan="6">
        <?php echo $this->pagination->create_links();?>
	</td>
	</tr>

<? }?>
</table>
<? }?>

