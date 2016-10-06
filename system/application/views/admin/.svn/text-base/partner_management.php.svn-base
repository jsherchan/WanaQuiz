
<script type="text/javascript" src="<?=base_url()?>js/jquery-impromptu.3.1.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?=base_url()?>css/examples.css" />
<style type="text/css">
    .jqi .errorBlock{ background-color: #FFC6A5; border: solid 1px #ff0000; color: #ff0000; padding: 5px 10px; font-weight: bold; }
    .jqi .field{ margin: 4px 0; }
    .jqi .field label{ font-weight: bold; display: block; width: 150px; float: left; clear: left; }
    .jqi .field input { border: solid 1px #777777; width: 200px; }
</style>

<script type="text/javascript">
     var j = jQuery.noConflict();
function acceptPartner(user_id,status,vertical_code,rectangular_code){
    //var test = encodeURIComponent(vertical_code);
    //alert(vertical_code);//return false;
  
    var decode_vertical_code;
    var decode_rectangular_code;
    j.post('<?=base_url().ADMIN_PATH?>/members/decode_user_adsense_code', {user_vertical_code:vertical_code, user_rectangular_code:rectangular_code} , function(data){
                                            if (data != '' || typeof data != undefined || data != null)
                                            {
                                                dt=data.split('%');
                                                //alert(dt[0]);
                                                decode_vertical_code = dt[0];
                                                decode_rectangular_code = dt[1];
                                           
	job=confirm("Are you sure you want to accept this member as Partner?");
         
	if(job==true)
            {
                var txt = '<input type="hidden" id="member_id" name="member_id" value="'+user_id+'" />\n\
                            <p>AdSense Code:&nbsp;<textarea name="user_vertical_code" id="" >'+decode_vertical_code+'</textarea></p>\n\
                            <p>Ad. Type: &nbsp;Vertical (160x600)</p> <br />\n\
                            <p>AdSense Code:&nbsp;<textarea name="user_rectangular_code" id="" >'+decode_rectangular_code+'</textarea></p>\n\
                            <p>Ad. Type: &nbsp; Rectangular (300x250)</p>';

                jqistates = {
                    state0: {
                        html: txt,
                        focus: 1,
                        buttons: { Send: true, Cancel: false },
                        submit: function(v, m, f){
                            var e = "";
                            if (v) {
                                if (e == "") {
                                    var id=f.member_id;
                                    var vertical_code = f.user_vertical_code;
                                    var rectangular_code = f.user_rectangular_code;
                                    if(vertical_code!="" && rectangular_code!=""){

                                        j.post('<?=base_url().ADMIN_PATH?>/members/add_user_adsense_code', {user_id:id,user_vertical_code:vertical_code, user_rectangular_code:rectangular_code} , function(data){
                                            if (data != '' || typeof data != undefined || data != null)
                                            {
                                                if(data=='success')
                                                {
//                                                    $('#partner').html('Partner(<a href="javascript:void(0)" onclick="declinePartner('+user_id+',0)">Cancel Partner</a>)');
                                                      location.reload();
                                                }
                                                else j.prompt('error');
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

        else
	{
		return false;
	}
        }
       });
}

function declinePartner(user_id,status)
{
	job=confirm("Are you sure you want to decline this member as Partner?");
	if(job==true)
        {
                j.post("<?=site_url(ADMIN_PATH.'/members/cancelPartner/')?>", {user_id:user_id,status:status}, function(data){
                    if(data=='success');
                   location.reload();
                });
            }
        else {
		return false;
	}
}
</script>
<?php //print_r($adsense_code)
//$vcode = $admin_vertical_code;
//$vertical_code = $admin_vertical_code; //str_replace('<','&%lt;',$code);
//$rcode = $admin_rectangular_code;
//$rectangular_code = $admin_rectangular_code;//str_replace('<','&%lt;',$rcode);
?>
<h2 class="headingclass" >Partner Management </h2>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="86%" height="40"><span class="header"><a href="">ADMIN</a> &gt;&gt;<a href="<?=site_url(ADMIN_PATH.'/partner_management/')?>"> Partner  Management </a></span></td>
        <td><a href="javascript:history.back();"><img src="<?=base_url()?>images/admin_images/arrow.gif" width="17" height="15" border="0" /></a> <a href="javascript:history.back();" class="blue_bold"><span class="bodytext">Back</span></a></td>
    </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0">
    <tr>

        <td width="20%">
            <strong> <a href="<?=site_url(ADMIN_PATH.'/partner_management')?>" style="color:#003399">[Partner list]</a></strong>
        </td>

    </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="border_block" ><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td colspan="2"><link href="css/base.css" rel="stylesheet" type="text/css" />

                <table width="100%" border="0"  cellpadding="4" cellspacing="0" class="Mtable">
                    <tr >
                        
                        <th width="208"  class="th"><div align="left">User id</div></th>
                        <th width="208"  class="th"><div align="left">Partner Name</div></th>
                        <!--<th width="208"  class="th"><div align="left">User Vertical AdSense Code</div></th>
                        <th width="208"  class="th"><div align="left">User Rectangular AdSense Code</div></th>-->
                        <th width="208"  class="th"><div align="left">Partner</div></th>
                        <!--<th width="208"  class="th"><div align="left">Admin Vertical Code</div></th>
                        <th width="208"  class="th"><div align="left">Admin Rectangular AdSense Code</div></th>-->

<!--<th width="69" class="th"><div align="center">Edit</div></th>-->
                        <th width="59" class="th"><div align="center">Delete</div></th>

                        <?php
                        
                        if(count($partner_list)>0) {
                            foreach($partner_list as $rows) {
                                $user_info = $this->Member_model->get_member($rows->user_id);
                                ?>
                    <tr align="center" class="">
                        <td ><div align="left"><?=$rows->user_id?></div></td>
                        <td ><div align="left"><a href="<?=base_url()?><?=$user_info->username?>"><?=$user_info->username?></a></div></td>
                       
                        <td >
                           
                            <div align="left" id="partner">
                                <?php if($rows->active=='0'){?>
                        
                                <a href="javascript:void(0)" onclick='return acceptPartner("<?=$rows->user_id?>","1","<?=base64_encode($rows->user_vertical_code); ?>","<?=base64_encode($rows->user_rectangular_code); ?>")'>Accept </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="return declinePartner('<?=$rows->user_id?>','0')">Reject</a>
                                <? } else { ?>
                                <b>Partner</b> (<a href="javascript:void(0)" onclick="declinePartner('<?=$rows->user_id?>',0)">Cancel Partner</a>)
                                <? } ?>
                               
                            </div>
                        </td>
                       
                        
                        <!--<td>
                            <a href="<?=site_url(ADMIN_PATH.'/quiz_display_management/edit_quiz_display/'.$rows->id) ?>">
                                <img src='<?=base_url()?>images/admin_images/edit.gif' title="Edit Transaction" border="0">
                            </a>
                        </td>-->
                        <td>
                            <a href="<?=site_url(ADMIN_PATH.'/partner_management/delete_partner/'.$rows->user_id) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm()"  border="0">				
                            </a>
                        </td>
                    </tr>
                        <? }
                    }?>
                </table>
                <br />
                <div align='left'>


                </div>

                <br />


        </td>
    </tr>
</table></td>
</tr>
</tbody></table>



<script>

    function doConfirm()
    {
        msg=confirm("Are you sure you want to delete this Banner Permanently?");
        if(msg!=true)
        {
            return false;
        }
    }

</script>	
