<?php

class Ajax_set_previleges extends Controller
{
	function Ajax_set_previleges()
	{
		parent::Controller();
		//$this->load->model
	}
	
	function index()
	{
		$group_id=$_REQUEST['group_id'];
		$dd='';
		$tt='	
		 <form action="'.site_url(ADMIN_PATH.'/security/setPermissionToGroup').'" method="post">	
		<table>
		<tr><td colspan="2">Give Access To Following Controllers</td>
		</tr>';
		
		$controllers=$this->getControllers();
		foreach($controllers as $rows){
			if($rows->ID==$this->checkControllerAccess($rows->ID,$group_id)) 
				$checked="checked";
			else 
				$checked="";
			$dd.='<tr> 
		  <td height="36"><input type="checkbox" name="controller[]" value="'.$rows->ID.'" '.$checked.'> </td>
		  <td>'.$rows->controller_name.' </td>
		 </tr>';
		}
			
	
		$tt=$tt.$dd.'<input type="hidden" name="group_id" value="'.$group_id.'" />
		<tr>
		<td colspan="2" align="center"><input type="Submit" name="add" value="Add" class="bttn">  </td>
		</tr>
		</table>
	 </form>';
		
		echo $tt;
	}
	
	function getControllers(){
		$sql="Select * from tbl_controllers";
		$query=$this->db->query($sql);
		return $query->result();
	}
	
	function checkControllerAccess($controller_id,$group_id){
		$sql="Select * from tbl_security where group_ID='$group_id'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data=$query->row();
			$controllers=explode(':',$data->controller_id);
			for($i=0;$i<count($controllers);$i++){
				if($controllers[$i]==$controller_id){
					return $controllers[$i];
					break;					
				}	
			}
		}
		else 
			return 0;
		
	}
	
}
/* End of File*////