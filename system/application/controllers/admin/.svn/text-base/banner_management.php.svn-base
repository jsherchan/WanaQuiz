<?php

class Banner_management extends Controller {

	function Banner_management()
	{
		parent::Controller();	
        $this->load->model('Banner_management_model');
        $this->load->library('parser');
	}
	
	function index()
	{
		$data['title']="Banner Management~wannaquiz";
 		$data['main']='admin/banner_management';
                $data['flag']='';
		$data['banner_list']=$this->Banner_management_model->banner_list();
		$this->parser->parse('admin/admin',$data);
	}
	
	function banner(){
  		$data['title']="Banner Management~wannaquiz";
 		$data['main']='admin/banner_management';
                $data['flag']= 'add_banner';
		$data['banner_list']=$this->Banner_management_model->banner_list();
		$this->parser->parse('admin/admin',$data);
	}

        function add_banner(){
            $data['title']="Banner Management->Add Banner~Wannaquiz";
            $data['main']='admin/add_banner';
            $data['category'] = $this->Category_model->get_categories();
            //$data['banner_info']=$this->Banner_management_model->get_banner_info($banner_id);
            $this->load->view('admin/admin',$data);
        }
	
	function edit_banner($banner_id){
		$data['title']="Banner Management->Edit Banner~Wannaquiz";
 		$data['main']='admin/edit_banner';
		$data['banner_info']=$this->Banner_management_model->get_banner_info($banner_id);
                $data['category'] = $this->Category_model->get_categories();
		$this->load->view('admin/admin',$data);
	}

        function insert_banner(){
            if($_FILES['banner']['name']!=""){
			$file_info=$this->upload_banner('banner');
		}
            $this->Banner_management_model->insert_banner_data();
            redirect(ADMIN_PATH.'/banner_management','refresh');
        }

        function upload_banner($file)
	{
		$config['upload_path'] ='./banner_images/';
		$config['allowed_types'] = 'jpg|gif|png';
		$config['max_size']	= '1000';
		$config['max_width']  = 0;
		$config['max_height']  =0;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;
	}
	
	function update_banner()
	{
	// before updating banner image 
	// delete previous banner if any 
	$banner_info=$this->Banner_management_model->get_banner_info($this->input->post('id',TRUE));
	if(file_exists("./banner_images/".$banner_info->image) && $_FILES['banner']['name']!="")
				unlink("./banner_images/".$banner_info->image);
		
	$this->upload_image('banner');
	
	 //CALL Auction Models
	$this->Banner_management_model->update_banner_data();
	$this->session->set_flashdata('message','Banner Edited');
	redirect(ADMIN_PATH.'/banner_management','refresh');
	//$this->load->view('admin/admin');
	}
	
	function upload_image($file)
	{
		$config['upload_path'] = './banner_images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}


    function textAds(){
        $data['title']="Text Ads Management~wannaquiz";
 		$data['main']='admin/text_ads';
                $data['flag']='add_text';
		$data['text_ads_list']=$this->Banner_management_model->get_text_adv();
		$this->parser->parse('admin/admin',$data);
    }

    function add_text_ads(){
        $data['title']="Banner Management->Add Text Ads~Wannaquiz";
        $data['main']='admin/add_text';
        $data['category'] = $this->Category_model->get_categories();
        //$data['banner_info']=$this->Banner_management_model->get_banner_info($banner_id);
        $this->load->view('admin/admin',$data);
    }

    function insert_text_ads(){
        $this->Banner_management_model->insert_text_ads_data();
            redirect(ADMIN_PATH.'/banner_management/textAds','refresh');
    }

    function edit_text_ads($banner_id){
		$data['title']="Text Ads Management->Edit ~Wannaquiz";
 		$data['main']='admin/edit_text_ads';
		$data['text_info']=$this->Banner_management_model->get_text_adv_info($banner_id);
		$this->load->view('admin/admin',$data);
	}

    function update_text_ads(){
        $this->Banner_management_model->update_text_ads_data();
        $this->session->set_flashdata('message','Text Ads Edited');
        redirect(ADMIN_PATH.'/banner_management/textAds','refresh');
    }

    function get_category_questions(){
        $cid = $this->input->post('cid',TRUE);
        $result = $this->Quiz_model->get_all_questions_by_cat($cid);
        if($result){ 
            foreach($result as $questions){ 
                $data.= '<input type="checkbox" value="'.$questions->quiz_id.'" name="question_values[]">'.$questions->quiz_question.'<br>';
            }
        }
            else $data='<option>no questions</option>';
            echo $data;
        
    }

    function delete_banner($id){
        $banner_info=$this->Banner_management_model->get_banner_info($id);
        $delete_data = $this->Banner_management_model->delete_banner_data($id);
        
        //print_r($banner_info);//exit;
	if(file_exists("./banner_images/".$banner_info->image) && $delete_data)
            unlink("./banner_images/".$banner_info->image);
        redirect(ADMIN_PATH.'/banner_management','refresh');
    }

    function delete_text_ads($id){
        //$banner_info=$this->Banner_management_model->get_banner_info($id);
        $delete_data = $this->Banner_management_model->delete_text_ads_data($id);

        redirect(ADMIN_PATH.'/banner_management/textAds','refresh');
    }
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */