<?

class Cms_model extends Model {

	function Cms_model()
	{
		parent::Model();
	}
	
	function get_all_cms($cms_type)
	{
		if($cms_type!=""){
			$options=array('type'=>$cms_type);
			$query=$this->db->getwhere('tbl_contents',$options);
		}
		else	
			$query=$this->db->get('tbl_contents');
			if ($query->num_rows() > 0) 
				return $query->result();
			else
				return NULL;
	}

        function check_cmstype($cms_type){
            $options=array('type'=>$cms_type);
            $query=$this->db->getwhere('tbl_contents',$options);
            if($query->num_rows()>0)
            return true;
            else return false;
        }

	
}
?>