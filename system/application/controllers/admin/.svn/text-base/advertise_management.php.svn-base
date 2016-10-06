<?php
class Advertise_management extends Controller {

	function Advertise_management()
	{
		parent::Controller();	
        $this->load->model('Advertise_management_model');
     }
	
	function index()
	{
		$this->advertisements();
	}
	
	function advertisements(){
  		$data['title']="Advertise Management~wannaquiz";
 		$data['main']='admin/advertisements';
                $data['dimension'] = 'vertical';
		$data['advertisement_list']=$this->Advertise_management_model->advertisements();
     	$this->load->view('admin/admin',$data);
	}

        function rectangular_advertisements(){
            $data['title']="Advertise Management~wannaquiz";
 		$data['main']='admin/advertisements';
                $data['dimension'] = 'rectangular';
		$data['advertisement_list']=$this->Advertise_management_model->rectangular_advertisements();
     	$this->load->view('admin/admin',$data);
        }
	
	function add_advertisement(){
        $this->load->model('Category_model');
		$data['title']="Advertise Management~wannaquiz";
 		$data['main']='admin/add_advertisement';
        $data['category'] = $this->Category_model->get_categories();
        $this->load->view('admin/admin',$data);
	}
	
	function edit_advertisement($id){
        $this->load->model('Category_model');
		$data['title']="Advertise Management~wannaquiz";
 		$data['main']='admin/edit_advertisement';
		$data['advertise_info']=$this->Advertise_management_model->get_advertisement_info($id);
        $data['category'] = $this->Category_model->get_categories();
		$this->load->view('admin/admin',$data);
	}
	
	function insert_advertisement()
	{
            //echo '<pre>'; print_r($_FILES); exit;
            if(($_FILES['adv_banner']['name']!='')){
            list($width, $height, $type, $attr) = getimagesize($_FILES['adv_banner']['tmp_name']);
            $data['cat_id'] = $this->input->post('cat_id',TRUE);
            $data['adv_type']=$this->input->post('adv_type',TRUE);
                    $data['adv_dimension']=$this->input->post('adv_dimension',TRUE);
                    $data['adv_detail']=$this->input->post('adv_detail',TRUE);
                    $data['link_url']=$this->input->post('link_url',TRUE);
                     $data['category'] = $this->Category_model->get_categories();
                     $data['adv_position'] = $this->input->post('adv_position',TRUE);

            if($this->input->post('adv_dimension',TRUE)=='vertical'){
                if($width > '160' || $height > '600'){ 
                    $data['error'] = "Image dimension doesn't matched!";
                    $data['main']='admin/add_advertisement';
                    $this->load->view('admin/admin',$data);

                }
                else {
                    $image=$this->upload_image('adv_banner');

                    //CALL Auction Models
                    $this->Advertise_management_model->insert($image['file_name']);
                    $this->session->set_flashdata('message','Advertisement Added');
                    redirect(ADMIN_PATH.'/advertise_management','refresh');
                    
                }
            }

            else { 
                if($width > '300' || $height > '250'){
                    $data['error'] = "Image dimension doesn't matched!";
                    $data['main']='admin/add_advertisement';
                    $this->load->view('admin/admin',$data);

                }
                else {
                    $image=$this->upload_image('adv_banner');

                    //CALL Auction Models
                    $this->Advertise_management_model->insert($image['file_name']);
                    $this->session->set_flashdata('message','Advertisement Added');
                    redirect(ADMIN_PATH.'/advertise_management/rectangular_advertisements','refresh');

                }
            }
            }
            else{
                $this->Advertise_management_model->insert('');
                    $this->session->set_flashdata('message','Advertisement Added');
                    if($this->input->post('adv_dimension',TRUE)=='vertical')
                    redirect(ADMIN_PATH.'/advertise_management','refresh');
                    else
                    redirect(ADMIN_PATH.'/advertise_management/rectangular_advertisements','refresh');
            }
           
		
	}

    function delete_advertisement($id)
	{
		$this->db->where("id", $id);
        $this->db->delete("tbl_advertisements");
        $this->session->set_flashdata('message','Selected Advertisement Deleted Successfully.');
        redirect(ADMIN_PATH.'/advertise_management','refresh');
	}


	function update_advertisement()
	{ 
	// before updating banner image 
	// delete previous banner if any 
	$score_badge_info=$this->Advertise_management_model->get_advertisement_info($this->input->post('id',TRUE));
	//if(file_exists("badge_images/".$score_badge_info->badge_image))
			//	unlink("badge_images/".$score_badge_info->badge_image);

	if($_FILES['adv_banner']['name']!=""){
		$image=$this->upload_image('adv_banner');
		$image=$image['file_name'];
		}
	else
		$image=$_POST['hdadv_banner'];
	
	 //CALL Auction Models
	$this->Advertise_management_model->update($image);
	$this->session->set_flashdata('message','Advertisement Edited');
        if($this->input->adv_dimension=='Vertical')
	redirect(ADMIN_PATH.'/advertise_management','refresh');
        else
        redirect(ADMIN_PATH.'/advertise_management/rectangular_advertisements','refresh');
	}
	
	function upload_image($file)
	{
		$config['upload_path'] = './advertisement_banners/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}
  	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */