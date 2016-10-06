<h2 class="headingclass" >News Management</h2>
<script type="text/javascript" src="<?= base_url()?>tiny_mice/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>

<table width="100%" cellpadding="5">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/news')?>">NEWS MANAGEMENT</a>
      >> Edit News</span></td>
    <td width="16%" align="right"><a href="<?=base_url()?>index.php/heppaadmin/news"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="<?=base_url()?>index.php/heppaadmin/news"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
   
    <td align="right">&nbsp;</td>
  </tr>
</table>



<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
		
?>

<Table align=left cellpadding=2 cellspacing=0 width=99% border="0" class="light">
<form action="<? echo site_url(ADMIN_PATH.'/news/edit');?>" method="Post" name="frm_cms">

<tr>
      <td width="660"><strong>News Type</strong></td>
</tr>

<tr>
<td> <select name="news_type">
<option value="ebid" <? if($news_info->news_type=='ebid') echo "selected";?>>Ebid News</option>
<option value="press" <? if($news_info->news_type=='press') echo "selected";?>>Press News</option>
</select>
</td>
</tr>


<tr>
      <td width="660"><strong>Title</strong></td>
</tr>

<tr>
<td> 
<input size="60" class="inputtext" type="text" id="news_title" name="news_title" value="<?=$news_info->news_title?>"></td>
</tr>

<tr>
      <td><strong>Content </strong></td>
</tr>

<tr>
<td > 
  <textarea name="news_description" cols="70" rows="20"><?=$news_info->news_description?></textarea>
</td>
</tr>

  <tr>
            <td align="left" valign="middle">
  <input type="radio" name="status" value="1" <?php if($news_info->status==1) echo "checked" ?>/> Save & Publish 
  <input type="radio" name="status" value="0" <?php if($news_info->status==0) echo "checked" ?>/> Save as draft 
  
			</td>
          </tr>

<tr height=25 valign="middle">
<td><input type="submit" name="submit" value="Submit" class="bttn" onClick="submitForm();" ><input name="news_id" type="hidden" value="<?=$news_info->news_id?>"></td>
</tr>
</form>
</table>

