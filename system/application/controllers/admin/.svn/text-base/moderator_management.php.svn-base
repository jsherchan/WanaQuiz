<?php

class Moderator_management extends Controller {

    function Moderator_management() {
        parent::Controller();
        $this->load->model('Moderator_management_model');
        $this->load->library('parser');
          $this->load->library('pagination');
    }

    function index() {
        $config['base_url'] = site_url('admin/moderator_management/index/');
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['total_rows']= $this->Moderator_management_model->count_moderator_list();
        $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix nav_pagination">';
        $config['cur_tag_open'] = '<li class="active">';
        $config['cur_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '<li>Next &raquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo; Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['title']="Moderator Management~wannaquiz";
        $data['main']='admin/moderator_management';
        $adsense_code = $this->Moderator_management_model->get_admin_adsense_code();
        $admin_vertical_code = $adsense_code->admin_vertical_adsense_code;
        $data['admin_vertical_code'] = base64_encode($admin_vertical_code);
        $admin_rectangular_code = $adsense_code->admin_rectangular_adsense_code;
        $data['admin_rectangular_code'] = base64_encode($admin_rectangular_code);
        $data['partner_list']=$this->Moderator_management_model->moderator_list($config['per_page'], $this->uri->segment(4, 0));
        $this->parser->parse('admin/admin',$data);
    }

    function edit_moderator($data_id) {
        $data['title']="Moderator Management->Edit Moderator~Wannaquiz";
        $data['main']='admin/edit_moderator';
        $data['moderator_info']=$this->Moderate_management_model->get_moderator_info($data_id);
        $this->load->view('admin/admin',$data);
    }



    function update_moderator() {
        $this->Moderator_management_model->update_moderator_data();
        $this->session->set_flashdata('message','Data Edited');
        redirect(ADMIN_PATH.'/moderator_management','refresh');
    //$this->load->view('admin/admin');
    }


    function delete_moderator($user_id) {
        
        //$delete_data = $this->Moderator_management_model->delete_moderator_data($user_id);
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_moderator', array('delete'=>'1'));
       // $this->db->where('user_id',$user_id);
        //$this->db->update('tbl_members', array('moderator'=>'0'));
       
         redirect(ADMIN_PATH.'/moderator_management','refresh');
    }
     function add_admin_adsense_code(){
        $user_id = $this->input->post('user_id');
        $vertical_code = $this->input->post('admin_vertical_code');
        $rectangular_code = $this->input->post('admin_rectangular_code');
        
        $sql = "UPDATE tbl_moderator SET admin_vertical_code = '$vertical_code', admin_rectangular_code = '$rectangular_code', active='1' WHERE user_id = $user_id";
        $query = $this->db->query($sql);
       
        
        if ($query)
            echo "success";
        else 
            echo 'error';
        
     }
     
     
     function moderator_search()
    {   
        $moderator = $this->input->post('moderator');
        $data['moderator_list'] = $this->Moderator_management_model->search_moderator($moderator);
        //print_r($data['moderator_list']);
      
       
           ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="4" class="ttable">
                    <tr>   
                      <th width="208"  class="th"><div align="left">User id</div></th>
                        <th width="208"  class="th"><div align="left">User Name</div></th>
                        <th width="208"  class="th"><div align="left">Moderator</div></th>
                         <th width="59" class="th"><div align="center">Delete</div></th>
                    </tr>
             <? if($data['moderator_list'])
                { 
            foreach($data['moderator_list'] as $list) 
            {?>
                    <tr>
              <td><div align="left"> <?=$list['user_id']?></div></td>
              <td><div align="left"><a href="<?=base_url()?><?=$list['username']?>"><?=$list['username']?></a></td>
              <td>  
                    <div align="left" id="partner">
                    <?php if($list['active']=='0'){?>
                    <a href="javascript:void(0)" onclick='return acceptModerator("<?=$list['user_id']?>","1")'>Accept </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="return declineModerator('<?=$list['user_id']?>','0')">Reject</a>
                    <? } else { ?>
                    <b>Moderator</b> (<a href="javascript:void(0)" onclick="declineModerator('<?=$list['user_id']?>','0')">Cancel Moderator</a>)
                    <? } ?>
                    </div>
              </td>
               <td>
                            <a href="<?=site_url(ADMIN_PATH.'/moderator_management/delete_moderator/'.$list['user_id']) ?>">
                                <img src='<?=base_url()?>images/admin_images/delete.gif' title="Delete Transaction" onClick="return doConfirm()"  border="0">				
                            </a>
                 </td>
              </tr>
            
            <?}
        }
        else
            echo '<td align="center" colspan="7">No User of Such Name is  found</td>';
        ?> 
                </table> <?
    }
    

  }


/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */