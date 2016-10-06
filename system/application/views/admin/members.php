<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
			.jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
			.jqi .field{ margin: 4px 0; }
			.jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
			.jqi .field input { border: solid 1px #777777; width: 200px; }
		</style>
<SCRIPT language="javascript">
    function doconfirm()
    {
        job=confirm("Are you sure you want to delete this member detail Permanently?");
        if(job!=true)
        {
            return false;
        }
    }
    function submitform(act_val)
    {
        document.searchform.activated.value=act_val;
        document.forms.searchform.submit();
        //alert(document.searchform.activated.value);
    }

    function submitform_byorder(act_val)
    {
        document.searchform.order_by.value=act_val;
        document.forms.searchform.submit();
        //alert(document.searchform.activated.value);
    }

    function acceptModerator()
    {
        job=confirm("Are you sure you want to accept this member as moderator?");
        if(job!=true)
        {
            return false;
        }
    }

    function declineModerator()
    {
        job=confirm("Are you sure you want to decline this member as moderator?");
        if(job!=true)
        {
            return false;
        }
    }

    function send_message(id){
		var txt = 'Subject:&nbsp;&nbsp;<input type="text" id="subject" name="subject" value="" /><input type="hidden" id="member_id" name="member_id" value="'+id+'" /><p>Message:&nbsp;<textarea name="message" id="message" ></textarea>';

		jqistates = {
			state0: {
				html: txt,
				focus: 1,
				buttons: { Cancel: false, Send: true },
				submit: function(v, m, f){
				var e = "";
					if (v) {
						if (e == "") {
							var subject = f.subject;
							var id=f.member_id;
							var message = f.message;
							if(subject!="" && message!=""){

								j.post('<?=base_url()?>member/sendMessage', {id:id,sender:'admin',subject:subject,message:message} , function(data){
								   if (data != '' || typeof data != undefined || data != null)
								   {
										j.prompt("Success");
								   }
				 				 });

									return true;
								}
							else{
								jQuery.prompt.goToState('state1');
								}
						}

						return false;
					}
					else return true;
				}
			},
			state1: {
				html: '<span id="error">Required field missing. </span>',
				focus: 1,
				buttons: { Back: false, Cancel: true },
				submit: function(v,m,f){
					if(v)
						return true;
					jQuery.prompt.goToState('state0');
					return false;
				}
			}
		};
			j.prompt(jqistates);

    }
</SCRIPT> 
<script type="text/javascript">
    //<![CDATA[
    base_url = '<?= base_url();?>index.php/';
    //]]>
</script>
<script type="text/javascript" src="<?= base_url()?>js/function_search.js"></script>

<h2 class="headingclass" >View Members Details </h2>
<br>
<table width="800" cellpadding="1">

</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"> <span class="header"><a href="<?=site_url(ADMIN_PATH.'/home')?>">ADMIN</a>
                >><a href="<?=site_url(ADMIN_PATH.'/members')?>"> Member Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?= base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();"><span class="bodytext">Back</span></a> </td>
    </tr>
</table>
<table>

    <tr>
        <td>

            <form name="searchform" action="<?= site_url(ADMIN_PATH.'/members/search/')?>" method="post">
                <div>
                    <label for="function_name"><strong>Search Members By Name, Number or Email : </strong></label>&nbsp;&nbsp;
                    <input type="text" name="search_member" id="search_member" size="30" maxlength="60">
                    <input type="submit" value="search" id="search_button" />

                </div>
            </form>
        </td>
    </tr>
</table>
<br />
<table width="800" cellpadding="1">
    <tr>
        <td><strong>[
                <?php echo  anchor(ADMIN_PATH.'/members/add_member/','Add Member');?>
                ]</strong></td>
        <td> <strong>[ <? if($f=='0') {?>Normal Users<? }else {?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/0/joined_date/DESC')?>">Normal Users</a><? }?>]</strong></td>
        <td> <strong>[<? if($f=='1') {?>Small Advertisers<? }else {?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/1/joined_date/DESC')?>">Small Advertisers</a><? }?>]</strong></td>
        <td> <strong>[<? if($f=='2') {?>Large Advertisers<? }else {?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/2/joined_date/DESC')?>">Large Advertisers</a><? }?>]</strong></td>
        <td ><strong>[<? if($f=='all') {?>All<? }else {?><a href="<?=site_url(ADMIN_PATH.'/members/members_list/all/joined_date/DESC')?>">All</a><? }?>]</strong></td>
        <td ><strong>[<a href="<?=site_url(ADMIN_PATH.'/members/member_cpc')?>">Member CPC</a>]</strong></td>
    </tr>
</table>

<p><?php if($this->session->flashdata('message')) {
        echo "<div class='message'>".$this->session->flashdata('message')."</div>";
    }
    ?>
<div id="member_description" style="display:none;">
    <p>Enter your function above</p>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
    <tr>
        <th width="96" align="left"> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/user_id/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> User ID </a> </th>
        <th width="178" align="left"> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/username/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> Username </a> </th>
        <th width="119" align="left"> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/email/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> Email </a></th>
        <th width="178" align="left">  Send Message  </th>
        <th width="290" align="center"><b> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/joined_date/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> Reg Date </a> </b></th>
        <th width="290" align="center"><b> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/moderator/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> Moderator </a> </b></th>
        <? if($f=='1') {?>
        <th width="290" align="center"><b> <a href="<?=site_url(ADMIN_PATH.'/members/members_list/'.$f.'/user_type/'.$sort_order.'/'.$offset.'/')?>" style="color:#FFFFFF"> Upgrade member </a> </b></th>
        <? }?>
        <th width="178" align="left">  Transaction  </th>
        <th width="72" align="center"> Edit </th>
        <th width="88" align="center"> Delete </th>
        <?php if(count($member_list)!=0) {
            foreach($member_list as $rows) {?>
    <tr>

        <td align="left"><?php echo  $rows->user_id;?></td>
        <td align="left"><a href="<? echo site_url(ADMIN_PATH."/members/member_details/".$rows->user_id);?>"><?php echo $rows->username;?> </a></td>
        <td width="119" align="left">  <?php echo $rows->email;?></td>
        <td width="119" align="left">  <a href="javascript:void(0)" onclick="send_message('<?=$rows->user_id?>')">Send Message</a></td>
        <td align="left"><?php echo date('Y-m-d H:i:s',$rows->joined_date);?></td>

                <? if($f=='1') {?>
        <td align="left">
                        <? if($rows->user_type=='1') {?><a href="<?=site_url(ADMIN_PATH.'/members/upgradeToLArgeAdvertiser/'.$rows->user_id.'/'.$f)?>">Upgrade to Large Member</a><? }?>
        </td>
                <? }?>

        <td width="76" align="left">
                    <?php if($rows->moderator=='2') { ?>
            <a href="<?=site_url(ADMIN_PATH.'/members/updateModerator/'.$rows->user_id.'/2')?>" onclick="return acceptModerator()">Accept</a> &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;<a href="<?=site_url(ADMIN_PATH.'/members/updateModerator/'.$rows->user_id.'/0')?>" onclick="return declineModerator()">Decline</a>
                    <? } elseif($rows->moderator=='1') {?><b>Moderator</b> <? } ?>
        </td>
        <td width="76" align="left"><a href="<?=site_url(ADMIN_PATH.'/members/transactions/'.$rows->user_id)?>">Transactions</a></td>
        <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/members/edit_member/<?php echo $rows->user_id; ?>" >
                <img src='<?= base_url()?>images/admin_images/edit.gif' title="Edit Member"></a> </td>
        <td align="center"><a href="<?= base_url()?><?=ADMIN_PATH;?>/members/delete/<?php echo $rows->user_id; ?>">
                <img src='<?= base_url()?>images/admin_images/delete.gif' title="Delete Member Detail" onClick="return doconfirm();"></a>
        </td>
    </tr>
        <?php  }?>
    <tr>
        <td colspan="6">
                <?php echo $this->pagination->create_links();?>
        </td>
    </tr>
    <?php } else { ?>
    <tr>
        <td colspan="6" align="center">Sorry No Records Found</td>
    </tr>

    <?php }?>
</table>
