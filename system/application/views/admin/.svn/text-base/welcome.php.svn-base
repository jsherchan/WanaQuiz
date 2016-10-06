<? 
$sess_uid=$this->session->userdata('wannaquiz_admin_user_id');

$user_info=$this->User_model->getDetails($sess_uid);

if($user_info->group_id==0 && $user_info->access_level==1)
	$getallowedcontrollers=$this->User_model->getAllControllers();
else
	$getallowedcontrollers=$this->User_model->getAllowedControllers($sess_uid);

?>
<table width="95%" align="center" cellpadding="0" cellspacing="0">
              
			  <tr>
			  <? 
			  if(count($getallowedcontrollers)>0){
			  for($i=0;$i<count($getallowedcontrollers);$i++){
					$controller=$this->User_model->getControllerInfo($getallowedcontrollers[$i]);
				?>
                <td width="23%" height="84" align="center">
					<table>
					<tr>
						<td align="center">
						<a href="<?=site_url(ADMIN_PATH.'/'.$controller->controller_link_name)?>" ><img src="<?= base_url()?>images/admin_images/admin_icons/<?=$controller->controller_navigation_image?>" height="48" width="48" border="0" /></a>
						</td>
					</tr>
					<tr>
                                          <td class="normal_bold"><?php echo anchor(ADMIN_PATH.'/'.$controller->controller_link_name,$controller->controller_name);?></td>
					</tr>
					</table>
				</td>
				<?
				if(($i+1)%4==0)
					echo "</tr><tr>";
				 }
				}
				?>
			 </tr>
            </table>
