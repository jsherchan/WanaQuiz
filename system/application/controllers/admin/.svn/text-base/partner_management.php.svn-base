<?php

class Partner_management extends Controller {

    function Partner_management() {
        parent::Controller();
        $this->load->model('Partner_management_model');
        $this->load->library('parser');
    }

    function index() {
        $data['title']="Partner Management~wannaquiz";
        $data['main']='admin/partner_management';

        $adsense_code = $this->Partner_management_model->get_admin_adsense_code();
        $admin_vertical_code = $adsense_code->admin_vertical_adsense_code;
        $data['admin_vertical_code'] = base64_encode($admin_vertical_code);
        $admin_rectangular_code = $adsense_code->admin_rectangular_adsense_code;
        $data['admin_rectangular_code'] = base64_encode($admin_rectangular_code);
        $data['partner_list']=$this->Partner_management_model->partner_list();
        $this->parser->parse('admin/admin',$data);
    }

    function edit_partner($data_id) {
        $data['title']="Partner Management->Edit Partner~Wannaquiz";
        $data['main']='admin/edit_partner';
        $data['partner_info']=$this->Partner_management_model->get_partner_info($data_id);
        $this->load->view('admin/admin',$data);
    }



    function update_partner() {
        $this->Partner_management_model->update_partner_data();
        $this->session->set_flashdata('message','Data Edited');
        redirect(ADMIN_PATH.'/partner_management','refresh');
    //$this->load->view('admin/admin');
    }


    function delete_partner($user_id) {
        $delete_data = $this->Partner_management_model->delete_partner_data($user_id);

        redirect(ADMIN_PATH.'/partner_management','refresh');
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */