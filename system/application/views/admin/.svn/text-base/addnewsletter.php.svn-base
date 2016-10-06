<h2 class="headingclass" >Newsletter Management</h2>
<script type="text/javascript" src="<?= base_url()?>tiny_mice/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_js/admin_tm.js"></script>

<table width="100%" cellpadding="5">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a> >><a href="<?=site_url(ADMIN_PATH.'/newsletter')?>">NEWSLETTER MANAGEMENT</a>
      >> <? if($f=="") echo "Add"; else echo "Edit";?> Newsletter</span></td>
    <td width="16%" align="right"><a href="<?=base_url()?>index.php/admin/newsletter"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="<?=base_url()?>index.php/admin/newsletter"><span class="bodytext">Back</span></a></td>
  </tr>
  <tr>
    <td height="40">[ <strong><? echo anchor(ADMIN_PATH.'/newsletter/viewnewsletter/Draft','View Newsletter');?> </strong>]</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>



<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>

<Table align=left cellpadding=2 cellspacing=0 width=99% border="0" class="light">
<form action="<? if($f=="") echo site_url(ADMIN_PATH.'/newsletter/insert_data'); else echo site_url(ADMIN_PATH.'/newsletter/edit')?>" method="Post" name="frm_cms">
<tr>
      <td width="660"><strong>Subject</strong></td>
</tr>

<tr>
<td> 
<input size="60" class="inputtext" type="text" id="news_subject" name="news_subject" value="<? if($f!="") echo $subject;?>"></td>
</tr>

<tr>
      <td><strong>Content </strong></td>
</tr>

<tr>
<td > 
  <textarea name="news_text" cols="70" rows="20"><?php if($f!="") echo $content;?> </textarea>
</td>
</tr>

<tr height=25 valign="middle">
<input type="hidden" name="action" value="update">
<input type="hidden" name="id" value="<? if($f!="") echo $id;?>">
<td>
<!--<input type="submit" name="submit" value="<? if($f=="") echo "Save"; else echo "Save";?>" class="bttn" onClick="submitForm();" >-->
<input type="radio" name="action" value="save_only" onclick="hide_group_box()" checked="checked"/> Save Only
 <input type="radio" name="action" value="save_n_send" onclick="unhide_group_box()"/>Save and Send
</td>
</tr>


<tr><td>&nbsp;</td></tr>
<tr>
<td>
<div id="group_box" style="display:none;">
<strong>Send to</strong>
	 <select name="newsletter_group">
	    <option value="subscribers">Newsletter Subscribers</option>
	    <option value="invited">Invited Members</option>
		<option value="not_logged_in_4_30_days">Not Logged In members for 30 days</option>
		<option value="losers">Not Won Anything members </option>
		<option value="all">All members </option>
	 </select>
	 </div>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td><input type="submit" name="submit" value="Submit"/></td></tr>

</form>
</table>
<script>
function hide_group_box(){
document.getElementById('group_box').style.display="none";
}

function unhide_group_box(){
document.getElementById('group_box').style.display="block";
}

</script>
