<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gameboard extends Front_controller {

	function Gameboard()
	{
		parent::Front_controller();
		$this->load->model('gameboard_model');
                $this->load->library('pagination');
                $this->load->library('validation');
		$this->load->library('form_validation');
		
	}

	function index()
	{
		$data['title']="Gameboard  : wannaquiz";
		$data['main']="gameboard/gameboard_selection";
		$this->load->view('index',$data);

	}
	
	function type($type)
	{
		$this->session->set_userdata('redURL',base64_encode(site_url('gameboard/type/'.$type)));
		$this->checkMemberLogin();
		$data['title']="Gameboard  : wannaquiz";
		$data['main']="gameboard/gameboard_upload";
		$data['type']=$type;
		$this->load->view('index',$data);

	}
	
	
	function customizedGameboard(){
		$this->load->library('images');
		$user_id=$this->session->userdata('wannaquiz_user_id');
		$data['title']="Gameboard  : wannaquiz";
		$board_type=$this->input->post('board_type');
		if($board_type=='premium')
                { 
                    $data['main']="gameboard/gameboard_premium";
//                    $boards = $this->gameboard_model->getPremiumgameBoards(0,0);
//                    $config['base_url'] = site_url('gameboard/customizedGameboard');
//                    //echo count($boards);
//                    $config['total_rows']= count($boards);
//                    $config['per_page'] = 2;
//                    $config['uri_segment']=3;
//                    $offset = $this->uri->segment(3,0);
//                    $this->pagination->initialize($config);
                    $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();

                }
               
		if($_FILES['userfile']['name']!=""){
			$image_count=$this->gameboard_model->gameboardExist($user_id);
			
			//check for  already exist image if yes delete
			if($image_count>=1){
			
				$board=$this->gameboard_model->getMemberGameboard($user_id);
				$prev_image=$board->user_board_image;
				$p_image=explode('.',$prev_image);
				$this->images->delete("results/".$prev_image);
				$this->images->delete("gameboard_thumb_images/".$prev_image);
				$this->images->delete("watermarks/".$p_image[0].".png");
				$this->images->delete("tmp_uploads/".$prev_image);
			}
			
			//upload converted png image to watermarks folder-----------------
			$image_info=$this->upload_file('userfile');
			//image_thumb('tmp_uploads/'.$image_info['file_name'],'watermarks',$image_info['file_name'], '374', '290');
			$this->images->resize ('tmp_uploads/'.$image_info['file_name'], 454, 580, 'watermarks/'.$image_info['file_name'],'false' );
			$this->images->squareThumb ('watermarks/'.$image_info['file_name'], 'gameboard_thumb_images/'.$image_info['file_name'],'115' );
			$image=explode('.',$image_info['file_name']);
			if($image[1] == "jpg"){
				imagepng(imagecreatefromjpeg("watermarks/".$image_info['file_name']),"watermarks/".$image[0].".png");
			}
			elseif($image[1] == "gif"){
				imagepng(imagecreatefromgif("watermarks/".$image_info['file_name']),"watermarks/".$image[0].".png");
			}
				
				if($image[1]!="png"){
					$this->images->delete("watermarks/".$image_info['file_name']);
				}
			$this->gameboard_model->insertGameboard($image_info['file_name']);
			if($board_type=='free')
			{
                            $data['main']="gameboard/customized_gameboard";
                            //create gameboard image with the user image  and update the table
                            $gameboard_image=getGameboardWithImage($image[0].".png",'game_board_normal.jpg',$image_info['file_name']);
                        }

			$data['gameboard_image']=$image_info['file_name'];
			$data['user_image']=$image_info['file_name'];
                        $this->session->set_userdata('user_image',$data['user_image']);
                        $data['image'] = $image[0];
			$this->load->view('index',$data);
		}
		else{
			$this->session->set_flashdata('message','You must choose the file to upload');
			redirect('gameboard/type/'.$board_type);
			}
	}
	
	function upload_file($file)
	{
		$config['upload_path'] ='./tmp_uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3000';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->do_upload($file);
		$data = $this->upload->data();
		return $data;					
	}	
	
	
	function order($id){
		$data['title']="Gameboard Order : wannaquiz";
                $this->load->library('images');
                $this->load->model('Country_management_model');
                $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();
                $data['board_id'] = $id;
                $data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');
		$data['main']="gameboard/gameboard_order";
		$this->load->view('index',$data);
	}
	
	function checkout(){
		$data['title']="Gameboard checkout : wannaquiz";
                $this->load->library('images');
                $this->load->model('Site_setting_model');

                $this->form_validation->set_rules('firstname', 'firstname','required');
		$this->form_validation->set_rules('lastname', 'lastname','required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exist');
		$this->form_validation->set_rules('street', 'street', 'required');
                $this->form_validation->set_rules('city', 'city', 'required');
       		$this->form_validation->set_rules('postcode', 'postcode', 'required');
                $this->form_validation->set_rules('phone', 'phone', 'required');

                $this->form_validation->set_rules('firstname1', 'firstname1','required');
		$this->form_validation->set_rules('lastname1', 'lastname1','required');
		//$this->form_validation->set_rules('emai1l', 'Email', 'required|valid_email|callback_check_email_exist');
		$this->form_validation->set_rules('street1', 'street1', 'required');
                $this->form_validation->set_rules('city1', 'city1', 'required');
      		$this->form_validation->set_rules('postcode1', 'postcode1', 'required');
                $this->form_validation->set_rules('phone1', 'phone1', 'required');

                if($this->form_validation->run()==FALSE)
		{ 
			$data['title']="Gameboard Order";
			$data['main']="gameboard/gameboard_order";
                        $this->load->library('images');
                        $this->load->model('Country_management_model');
                        $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();

                        $data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');

			$this->load->view('index',$data);
		}
		else
		{
                    $board_id = $this->input->post('board_id');
                    $this->Member_model->update_member_address();
                    $data['site_info']=$this->Site_setting_model->get_site_info('1');
                    $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards($board_id);
                    $data['main']="gameboard/gameboard_checkout";
                    $boardname = $this->input->post('board_name');
                    
                    $this->load->view('index',$data);
                }
	}

        function print_board()
        {
            $this->load->library('images');
            $board_name = $this->input->post('board_name');
            $image = $this->input->post('image');
            echo $gameboard_image = getGameboardWithImage1($image.".png",$board_name,$image.".jpg");
        }

        function payment() {

        $this->checkMemberLogin();
        //$this->checkMemberProfile();
        $quantity=$this->input->post('quantity');
        $this->load->model('Payment_setting_model');
//        if($quantity=='') {
//            $this->session->set_flashdata('message', 'Please filled your quantity');
//            redirect('gameboard/checkout');
//        }
        $data['main']="redirect_to_payment_gateway";
        /*
         * sending information to redirect to payment gateway form
         */
        $data['paypal_info']=$this->Payment_setting_model->get_payment_info('1');
        $data['item_type']="package";
        $data['item_id']=$this->input->post('board_id');
        $data['amount']=$this->session->userdata('shopping_cart_total');
        $data['payment_gateway']=$this->input->post('payment_method');
        $data['paypal_type'] = 'gameboard';
        $data['title']='Payment Gateway : Wannaquiz';
        $this->load->view('index',$data);
    }

    function gameboard_cost()
    {
        $shopping_cart_total = $this->input->post('total');
        $this->session->set_userdata('shopping_cart_total',$shopping_cart_total);
    }
	
			
}


/* End of file page.php */
/* Location: ./application/controllers/page.php */