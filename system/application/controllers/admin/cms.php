<?php

class Cms extends Front_controller {

	function Cms()
	{
		parent::Front_controller();	
		$this->load->model('Cms_model');
		$this->load->library('parser');
	}
	
	function index()
	{
		$this->content_list();
		
	}
	
	function edit_page($id){
 
 		$data['title']="Wannaquiz:Content Management";
 		$data['main']='admin/cms_add_edit';
		$options=array('id'=>$id);
		$cms_info=$this->db->getwhere('tbl_contents',$options);
			
		foreach($cms_info->result_array() as $rows)
		{
			$data['CMSID']=$rows['id'];
			$data['CMSTitle']=$rows['title'];
			$data['CMSType']=$rows['type'];
                        $data['CMSUrl']=$rows['url'];
			$data['CMSDetail']=$rows['detail'];
			$data['CMSMeta_desc']=$rows['meta_desc'];
			$data['CMSMeta_keywords']=$rows['meta_keywords'];
		}
		$this->parser->parse('admin/admin',$data);
	}
	
	function add_page()
	{
        $data['title']="Wannaquiz:Content Management->Add Page";
        $data['main']='admin/cms_add_edit';
        $data['add']='add';
        $this->parser->parse('admin/admin',$data);
	}
	
	function content_list(){
        $data['title']="Wannaquiz:Content Management";
        $data['main']='admin/cms';
        $data['content_list']=$this->Cms_model->get_all_cms('');
        $this->parser->parse('admin/admin',$data);
	}
	
	function update_cms($id)
        { //print_r($_POST);echo $this->input->post('CMSDetails'); exit;
		$options=array('title'=>$this->input->post('CMSTitle',TRUE),
                    'type'=>$this->input->post('CMSType',TRUE),
                    'detail'=>$this->input->post('CMSDetails',TRUE),
                    'meta_desc'=>$this->input->post('CMSMeta_desc',TRUE),
                    'url'=>$this->input->post('CMSUrl',TRUE),
                    'meta_keywords'=>$this->input->post('CMSMeta_keywords',TRUE));
		$this->db->where('id',$id);
	
		$this->db->update('tbl_contents',$options);
		$this->session->set_flashdata('message','Content was updated successfully.');
		redirect(ADMIN_PATH.'/cms/content_list/');

	}
	
	function add_cms(){
	$now=current_date_time_stamp();
	$data=array('type'=>$this->input->post('CMSType',TRUE),
            'title'=>$this->input->post('CMSTitle',TRUE),
            'detail'=>$this->input->post('CMSDetail',TRUE),
            'meta_desc'=>$this->input->post('CMSMeta_desc',TRUE),
            'meta_keywords'=>$this->input->post('CMSMeta_keywords',TRUE),
            'url' => $this->input->post('CMSUrl',TRUE),
            'date'=>$now);
	$this->db->insert('tbl_contents',$data);
	$this->session->set_flashdata('message','Page Added');
	redirect(ADMIN_PATH.'/cms','refresh');
	}
	
	function delete_page($page_id)
	{
		if ($page_id)
	 	{
            $this->db->where("id", $page_id);
            $this->db->delete("tbl_contents");
       
			$this->session->set_flashdata('message','Page Deleted');
			redirect(ADMIN_PATH.'/cms','refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */