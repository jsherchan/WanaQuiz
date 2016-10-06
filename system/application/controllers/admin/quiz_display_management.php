<?php

class Quiz_display_management extends Controller {

    function Quiz_display_management() {
        parent::Controller();
        $this->load->model('Quiz_display_management_model');
        $this->load->library('parser');
    }

    function index() {
        $data['title']="Quiz Display Management~wannaquiz";
        $data['main']='admin/quiz_display_management';

        $data['display_data']=$this->Quiz_display_management_model->Quiz_display_data();
        $this->parser->parse('admin/admin',$data);
    }

    function edit_quiz_display($data_id) {
        $data['title']="Quiz Display Management->Edit Quzi Display~Wannaquiz";
        $data['main']='admin/edit_quiz_display';
        $data['display_info']=$this->Quiz_display_management_model->get_quiz_display_info($data_id);
        $this->load->view('admin/admin',$data);
    }



    function update_quiz_display() {
        //$display_info=$this->Quiz_display_management_model->get_quiz_display_info($this->input->post('id'));
        $this->Quiz_display_management_model->update_quiz_display_data();
        $this->session->set_flashdata('message','Data Edited');
        redirect(ADMIN_PATH.'/quiz_display_management','refresh');
    //$this->load->view('admin/admin');
    }


    function delete_quiz_display($id) {
        //$banner_info=$this->Banner_management_model->get_banner_info($id);
        $delete_data = $this->Quiz_display_management_model->delete_quiz_display_data($id);

        redirect(ADMIN_PATH.'/quiz_display_management','refresh');
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */