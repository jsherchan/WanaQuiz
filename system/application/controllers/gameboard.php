<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gameboard extends Front_controller {

    function Gameboard() {
        parent::Front_controller();
        $this->load->model('gameboard_model');
        $this->load->library('pagination');
        $this->load->library('validation');
        $this->load->library('form_validation');

    }

    function index() {
        $data['title']="Gameboard  : wannaquiz";
        
        $data['main']="gameboard/gameboard_selection";
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $this->load->view('index',$data);

    }

    function type($type) {
        $this->session->set_userdata('redURL',base64_encode(site_url('gameboard/type/'.$type)));
        $this->checkMemberLogin();
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $sql = "select board_image from tbl_gameboard where board_type = '$type'";
        $query = $this->db->query($sql);
        $data['gameboard_image'] = $query->row()->board_image;
        $data['title']="Gameboard  : wannaquiz";
        $data['main']="gameboard/gameboard_upload";
        $data['type']=$type;
        $this->load->view('index',$data);

    }


    function gameboard_image_preview() {
        $this->load->library('images');
        
        $user_id=$this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $data['title']="Gameboard  : wannaquiz";
        $board_type=$this->input->post('board_type',TRUE);
        $data['board_type'] = $board_type;
        if($_FILES['userfile']['name']!="") {
            $image_count=$this->gameboard_model->gameboardExist($user_id);

            //check for  already exist image if yes delete
            if($image_count>=1) {

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
            
            $data['org_image']=$image_info['file_name'];

            $data['image'] = $image[0];
            $data['preview'] = 'yes';
            $data['main'] = 'gameboard/customized_gameboard';
            $data_array = array('board_type'=>$board_type,
                                'org_image'=>$image_info['file_name'],
                                'image'=>$image[0],
                                'preview'=>'yes'
                                );
            $this->session->set_userdata($data_array);
            redirect('gameboard/show_gameboard_image');
        }
        else {
            $this->session->set_flashdata('message','You must choose the file to upload');
            redirect('gameboard/type/'.$board_type);
        }
    }

    function show_gameboard_image(){
        $this->load->library('images');
        $data['title']="Gameboard  : wannaquiz";
        $data['main'] = 'gameboard/customized_gameboard';
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $data['board_type'] = $this->session->userdata('board_type');
        $data['org_image'] = $this->session->userdata('org_image');
        $data['image'] = $this->session->userdata('image');
        $data['preview'] = $this->session->userdata('preview');
        $this->load->view('index',$data);
    }


    function customizedGameboard() {        
        $this->load->library('images');
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $data['title']="Gameboard  : WannaQuiz";
        $board_type=$this->input->post('board_type',TRUE);
        
      
        $image_name = $this->input->post('image_name',TRUE);

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($board_type=='free'){
                $targ_w = 350;
                $targ_h = 350;
            }
            else{
                $targ_h = 350;
                $targ_w = 350;
            }
                $jpeg_quality = 90;

                $src = base_url().'gameboard_images/gameboard_resized_images/'.$image_name;
                $x = explode('.', $image_name);
		$file_type = end($x);
        
                if($file_type=='jpg' || $file_type=='jpeg' || $file_type=='JPEG' ||$file_type=="JPG")
                $img_r = imagecreatefromjpeg($src);
                elseif($file_type=='png' || $file_type=='PNG' )
                $img_r = imagecreatefrompng($src);
                elseif($file_type=='gif' || $file_type=='GIF')
                $img_r = imagecreatefromgif($src);
                
                $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
                #echo $img_r; echo "hi";exit;
                imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
                $targ_w,$targ_h,$_POST['w'],$_POST['h']);

                //header('Content-type: image/jpeg');
                if($file_type=='jpg' || $file_type=='jpeg' || $file_type=='JPEG' ||$file_type=='JPG')
                imagejpeg($dst_r,'tmp_uploads/croped_images/'.$image_name,$jpeg_quality);
                elseif($file_type=='png' || $file_type=='PNG' )
                imagepng($dst_r,'tmp_uploads/croped_images/'.$image_name,9);
                elseif($file_type=='gif' || $file_type=='GIF')
                imagegif($dst_r,'tmp_uploads/croped_images/'.$image_name,9);

              #exit('r');
        }
        //image_thumb('tmp_uploads/'.$image_info['file_name'],'watermarks',$image_info['file_name'], '374', '290');
        
        $this->images->resize ('tmp_uploads/croped_images/'.$image_name, 454, 580, 'watermarks/'.$image_name,'false' );        
        $this->images->squareThumb ('watermarks/'.$image_name, 'gameboard_thumb_images/'.$image_name,'115' );
        
        $image=explode('.',$image_name);
      
        if($image[1] == "jpg" || $image[1]=="JPEG" || $image[1]=="jpeg" || $image[1]=="JPG") {
            imagepng(imagecreatefromjpeg("watermarks/".$image_name),"watermarks/".$image[0].".png");
        }
        elseif($image[1] == "gif" || $image[1]=="GIF") {
            imagepng(imagecreatefromgif("watermarks/".$image_name),"watermarks/".$image[0].".png");
        }

        if($image[1]!="png" || $image[1]=="PNG") {
            //imagepng(imagecreatefrompng("watermarks/".$image_name));
            $this->images->delete("watermarks/".$image_name);
        }
        $this->gameboard_model->insertGameboard($image_name);
        

        $data['gameboard_image']=$image_name;
        $data['user_image']=$image_name;
        $this->session->set_userdata('user_image',$data['user_image']);
        $data['image'] = $image[0];

        $data_array = array('gameboard_image'=>$image_name,
                                'image'=>$image[0]
                                );
            $this->session->set_userdata($data_array);
            #exit($board_type);
        if($board_type=='free') {
//            $data['main']="gameboard/customized_gameboard";
//            //create gameboard image with the user image  and update the table
//            $gameboard_image=getGameboardWithImage($image[0].".png",'game_board_normal.jpg',$image_name);
            redirect('gameboard/customizedFreeGameboard');
        }
        if($board_type=='premium') {
            redirect('gameboard/customizedPremiumGameboard');
        }

        $this->load->view('index',$data);
    
    }

    function customizedFreeGameboard(){
        $this->load->library('images');
        $data['title']="Gameboard  : WannaQuiz";
        $data['main']="gameboard/gameboard_free";
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $data['gameboard_image'] = $this->session->userdata('gameboard_image');
        $data['user_image'] = $this->session->userdata('gameboard_image');
        $data['image'] = $this->session->userdata('image');
        $data['free_boards'] = $this->gameboard_model->getFreeGameBoards();
        $this->load->view('index',$data);

    }

    function customizedPremiumGameboard(){
        $this->load->library('images');
        $data['title']="Gameboard  : wannaquiz";
        $data['main']="gameboard/gameboard_premium";
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
        $data['gameboard_image'] = $this->session->userdata('gameboard_image');
        $data['user_image'] = $this->session->userdata('gameboard_image');
        $data['image'] = $this->session->userdata('image');
        $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();
        $this->load->view('index',$data);

    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);

        echo $newImageWidth = ceil($width * $scale);echo"%";
        echo $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image);
                break;
        }
        

        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
            case "image/gif":
                imagegif($newImage,$thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$thumb_image_name,90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }


    function upload_file($file) { //echo $file;        
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


    function order($id) {
        $data['title']="Gameboard Order : wannaquiz";
        $this->load->library('images');
        $this->load->model('Country_management_model');
        $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();
        $data['board_id'] = $id;
        $data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');
        $data['main']="gameboard/gameboard_order";
        $this->load->view('index',$data);
    }

    function checkout() {
        $data['title']="Gameboard checkout : wannaquiz";
        
        $user_id = $this->session->userdata('wannaquiz_user_id');        
        if($user_id)
        {
            $filter = $this->Member_model->get_filter($user_id);                        
            if($filter) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
            else $this->session->unset_userdata('filtered');
            $data['filter'] = $filter;
        }
        
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

        if($this->form_validation->run()==FALSE) {
            $data['title']="Gameboard Order";
            $data['main']="gameboard/gameboard_order";
            $this->load->library('images');
            $this->load->model('Country_management_model');
            $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards();

            $data['country_list']=$this->Country_management_model->get_all_countries('0','countries_name','ASC','','0');

            $this->load->view('index',$data);
        }
        else {
            $board_id = $this->input->post('board_id',TRUE);
            $this->Member_model->update_member_address();
            $data['site_info']=$this->Site_setting_model->get_site_info('1');
            $data['premium_boards'] = $this->gameboard_model->getPremiumgameBoards($board_id);
            $data['main']="gameboard/gameboard_checkout";
            $boardname = $this->input->post('board_name',TRUE);

            $this->load->view('index',$data);
        }
    }

    function print_board() {
        $this->load->library('images');
        //print_r($_POST);
        $board_name = $this->input->post('board_name',TRUE);
        $type = $this->input->post('type',TRUE);
        $image = $this->input->post('image',TRUE);
        if($type!='free')
        echo $gameboard_image = getGameboardWithImage1($image.".png",$board_name,$image.".jpg");
        else
        echo $gameboard_image = getGameboardWithImage($image.".png",$board_name,$image.".jpg");
    }

    function payment() {

        $this->checkMemberLogin();
        //$this->checkMemberProfile();
        $quantity=$this->input->post('quantity',TRUE);
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
        $data['item_id']=$this->input->post('board_id',TRUE);
        $data['amount']=$this->session->userdata('shopping_cart_total');
        $data['payment_gateway']=$this->input->post('payment_method',TRUE);
        $data['paypal_type'] = 'gameboard';
        $data['title']='Payment Gateway : Wannaquiz';
        $this->load->view('index',$data);
    }

    function gameboard_cost() {
        $shopping_cart_total = $this->input->post('total',TRUE);
        $this->session->set_userdata('shopping_cart_total',$shopping_cart_total);
    }

    function rotateImage(){
       $org_image = $this->input->post('org_name',TRUE);
       echo $org_image;
       $this->session->set_userdata('org_image_name',$org_image);
       
                        // File and rotation
                        if($_SERVER['SERVER_NAME']=='localhost')
                        $filename = $_SERVER['DOCUMENT_ROOT'].'/wannaquiz/gameboard_images/gameboard_resized_images/'.$org_image;
                        else
#$filename = $_SERVER['DOCUMENT_ROOT'].'/clients/wannaquiz/gameboard_images/gameboard_resized_images/'.$org_image;
$filename = $_SERVER['DOCUMENT_ROOT'].'/gameboard_images/gameboard_resized_images/'.$org_image;
                        $degrees = -90;
                        echo $filename;
                        // Content type
                        //header('Content-type: image/jpeg');

                        // Load
                        $x = explode('.', $org_image);
                        $file_type = end($x);
                        if($file_type=='jpg' || $file_type=='jpeg' || $file_type=='JPEG')
                        $source = imagecreatefromjpeg($filename);
                        elseif($file_type=='png' || $file_type== 'PNG')
                        $source = imagecreatefrompng($filename);
                        elseif($file_type=='gif' || $file_type== 'GIF')
                        $source = imagecreatefromgif($filename);
                        // Rotate
                        $rotate = imagerotate($source, $degrees, 0);

                        // Output
                        //unlink($_SERVER['DOCUMENT_ROOT'].'/wannaquiz/gameboard_images/gameboard_resized_images/'.$org_image);
                        
                        if($file_type=='jpg' || $file_type=='jpeg' || $file_type=='JPEG')
                        $newFile = imagejpeg($rotate, $filename, 90);
                        elseif($file_type=='png' || $file_type== 'PNG')
                        $newFile = imagepng($rotate, $filename, 9);
                        elseif($file_type=='gif' || $file_type== 'GIF')
                        $newFile = imagegif($rotate, $filename, 9);
                       
                        


    }


}


/* End of file page.php */
/* Location: ./application/controllers/page.php */