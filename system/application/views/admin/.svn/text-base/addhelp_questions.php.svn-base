<script type="text/javascript" src="<?= base_url()?>tiny_mice/tiny_mce.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/admin_tm.js"></script>
<h2 class="headingclass" >Help Management</h2>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="padding-top:4px;">
  <tr>
    <td width="86%" height="40"> <span class="header"><a href="admin.php?function=welcome">ADMIN</a> 
      >><?=anchor(ADMIN_PATH.'/help_management','HELP MANAGEMENT')?> >> <? if($f=="") echo "Add"; else echo "Edit";?> Help Questions </span></td>
    <td align="right">
	<a href="<?=site_url(ADMIN_PATH.'/help_management')?>">
	<img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a>
	<a href="<?=site_url(ADMIN_PATH.'/help_management')?>"><span class="bodytext">BACK</span>
	</a>
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%" align="left"><span class="style1"><br />
    [<strong><? echo anchor(ADMIN_PATH.'/help_management/viewhelp_question','View Help Questions')?></strong>]</span></td>
    <? if($f!=""): ?>
	<td width="77%" align="left"><span class="style1"><br />
    [<strong><? echo anchor(ADMIN_PATH.'/help_management/addhelp_questions','Add Help Questions')?></strong>]</span></td>
	<? endif ?>
  </tr>
</table>

<?php if($this->session->flashdata('message')){
		echo "<div class='message'>".$this->session->flashdata('message')."</div>";
		}
	?>
<form name="frm" method="post" enctype="multipart/form-data"  action="<? if($f=="") echo site_url(ADMIN_PATH.'/help_management/add_question'); else echo site_url(ADMIN_PATH.'/help_management/edit_question');?>" onsubmit="return submitform2()">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="light" style="padding:6px">
  <tr align="left"> 
            <td align="right" class="err"><span class="style2">The fields marked with</span><b> <font color="#FF0000" size="2"> * </font><span class="content">are 
              mandatory.</span></b></td>
    </tr>
    <tr> 
      <td align="center" valign="top" bgcolor="#FFFFFF"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="17%">&nbsp;</td>
            <td width="83%">&nbsp;</td>
          </tr>
          
          <tr> 
            <td align="left" valign="middle" ><span class="hmenu_font"> TOPIC
			 : </span><font color="#FF0000" size="2">* </font></td>
            <td align="left" valign="middle"><select name="topic_id">
			<? if($f!="") echo '<option value="'.$f.'" selected>'.$parent_name.'</option>'; else { ?>
			  <option value="" >--Select a topic--</option>
			          <? }
		if(count($help_category_info)>0) {
		foreach($help_category_info as $rows) { 
		echo '<option value="'.$rows->id.'">'.$rows->name.'</option>'; }}
		
		?>

			  </select>           </td>
          </tr>
          <tr>
            <td align="left" valign="middle" class="content">&nbsp;</td>
            <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle" class="content"><span class="hmenu_font">QUESTION :<font color="#FF0000" size="2"></font></span><font color="#FF0000" size="2"> * </font></td>
            <td align="left" valign="middle">
			<input name="question" type="text" class="comment" id="question" value="<? if($f!="") echo $question;?>" size="50" /></td>
          </tr>            
          <tr>
            <td align="left" valign="top" class="content">&nbsp;</td>
            <td align="center" valign="middle" class="content">&nbsp;</td>
          </tr>
          <tr> 
            <td align="left" valign="top" class="content">
			<span class="hmenu_font">DESCRIPTION: </span><font color="#FF0000" size="2">*</font></td>
            <td align="left" valign="middle" class="content">
			
	
	<textarea name="answer"  id="answer" cols="70" rows="20"></textarea></td>
          </tr>
		  		  	  
          <tr align="center">
            <td>&nbsp;</td>
            <td height="35" align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr align="center"> 
            <td>&nbsp; </td>
            <td height="35" align="left" valign="middle">
			<input type="submit" name="submit" value="<? if($f=="") echo "Add Help Question"; else echo "Edit Help Question";?> " class="bttn" onclick="" style="width:100px"> 
			<input name="question_id" type="hidden"  value="<? if($f!="") echo $question_id;?>">
		    <input name="hqa_id" type="hidden" value=""></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
