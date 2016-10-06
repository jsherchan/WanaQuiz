<?php

class Ajax extends Controller
{
	function Ajax()
	{
		parent::Controller();
		//$this->load->model
	}
	
	function get_sub_category($id)
	{
		$this->load->model('Category_model');
		$data=$this->Category_model->get_all_categories($id,'name','ASC');
		$out_str='<select class="category_select"  id="subcategory" name="subcategory">';
		$out_str.='<option value="-1">Select Sub Category</option>';
		
		if(count($data)>0)
		{
			foreach($data as $row)
			{
				$out_str.='<option value="'.$row->id.'>'.$row->name.'</option>';
			}
		}
		$out_str.='</select>';
		echo $out_str;
	}
	
	function delete_auction_image($image_id,$image_name)
	{
		$this->load->model('Auction_model');
		$this->Auction_model->delete_image_by_id($image_id);
		$images=$this->Auction_model->image_count($image_name);
		
		
		if($images->image_count <=1)
		{
				if(file_exists("./auction_images/".$image_name))
					unlink("./auction_images/".$image_name);
		}

		
	}
}
/* End of File*/