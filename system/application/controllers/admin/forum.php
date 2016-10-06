<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends Controller
{
    function __construct()
    {
        parent::Controller();
     $this->load->model('Quiz_model');
        $this->load->model('Forum_category_model');
        $this->load->model('Forum_model');        
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    
    function index()
    {
        $config['base_url'] = site_url('admin/forum/index/');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        $config['total_rows']= $this->Forum_model->get_forum();
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
        $data['forum_list'] = $this->Forum_model->get_forum_list($config['per_page'], $this->uri->segment(4, 0));
        
        $data['title'] = 'Forum Management';
        $data['main'] = 'admin/forum_management';        
        $this->load->view('admin/admin',$data);
#        $this->forum_categories();
    }

    function forum_add()
    {        
        $this->form_validation->set_rules('discussion_title', 'Discussion Title', 'required');
        $this->form_validation->set_rules('cat_id', 'Category', 'required');
        
        if($this->form_validation->run()==FALSE) 
        { 
            $this->session->set_userdata('message',validation_errors());
        }
        else
        {
            if($this->Forum_model->add_forum())
            {
                $data['title'] = 'Forum : Add Success';
                $this->session->set_userdata('message','New Discussion Added Successfully');
                   redirect(ADMIN_PATH.'/forum/','refresh');
                
            }
            else
            {
                $data['title'] = 'Forum : Add Failed';
                $this->session->set_userdata('message','Failed to add New Discussion');
                   redirect(ADMIN_PATH.'/forum/','refresh');
            }
        }
        
        $data['main'] = 'admin/forum_add';        
       $this->load->view('admin/admin',$data);
    }

    function forum_search()
    {   
            $forum = $this->input->post('forum',TRUE);
            $data['title'] = "Forum Management Search Results";
            $data['forum_list'] = $this->Forum_model->search_forum($forum);
            $this->session->set_flashdata('category_error','Searched Results for '.$this->input->post('forum',TRUE));
            $data['message']="Searched Results for '".$this->input->post('forum',TRUE)."'";
            $data['main']='admin/forum_discussion_search';
            $this->parser->parse('admin/admin',$data);
    }
    function forum_categories($parent_id=0,$sort_field='sort_order',$sort_order='ASC')
    {        
            $data['title']="Wannaquiz:Forum management";
            $data['main'] = 'admin/forum_categories';

            //CALL CATEGORY Models
            $data['category_list']=$this->Forum_category_model->get_all_categories($parent_id,$sort_field,$sort_order);
            if($sort_order=="ASC")
                 $data['sort']="DESC";
            else
                 $data['sort']="ASC";

            $data['cat_id']=$parent_id;
            $data['cat_level']=$this->Forum_category_model->get_cat_level($parent_id);
            if($parent_id!=0)
            $data['breadcrumb']=$this->Forum_category_model->get_bread_crumb($parent_id);
            $this->parser->parse('admin/admin',$data);
    }
    
    function forum_get_subcategory_options()
    {
        $pid = $this->input->post('pid',TRUE);
        $cats = $this->Forum_category_model->get_sub_categories($pid);
        
        $options = '<select name="sub_cat_id" id="sub_cat_id">            
            ';
        
        if($cats)
        {
            $options .= '<option value="">- Sub Category -</option>';
            
            foreach($cats as $cat):
                $options .= '<option value="' . $cat->id . '">' . $cat->name . '</option>';                
            endforeach;
        }
        else
            $options .= '<option value="">- None -</option>';
        
        $options .= '</select>';
        
        echo $options;
    }
    
    function forum_add_category()
    {
            $category = $this->input->post('category_name',TRUE);
            $this->form_validation->set_rules('category_name', 'Category Name', 'required');
            if($this->form_validation->run()==FALSE) 
            { 
                $this->session->set_flashdata('category_error',validation_errors());
                redirect(ADMIN_PATH.'/forum/forum_categories/'.$this->input->post('parent_id',TRUE),'refresh');
            }
            else
            {
                 if($this->Forum_category_model->add_category($category))
                 {
                    $this->session->set_flashdata('category_error','New Forum Category Added Successfully');
                    redirect(ADMIN_PATH.'/forum/forum_categories/'.$this->input->post('parent_id',TRUE),'refresh');
                    }
                else
                {
                    $this->session->set_flashdata('category_error','Failed to add New Forum Category');
                    redirect(ADMIN_PATH.'/forum/forum_categories/'.$this->input->post('parent_id',TRUE),'refresh');
                }
            }        
    }
    
    //deleting forum categories ....
    
    function delete($cat_id) 
    {
            $parent_id=$this->Forum_category_model->get_parent_id($cat_id);
            if ($cat_id) {
            $this->db->where("id", $cat_id);
            $this->db->delete("tbl_forum_categories");
            }
            $this->session->set_flashdata('category_error','Selected Forum Category is Deleted');
            redirect(ADMIN_PATH.'/forum/forum_categories/'.$parent_id->parent_id,'refresh');
    }
    
    //edit forum categories...
    function edit_forum_category($cat_id)
    {
            $data['title']="Wannaquiz:Edit Forum Category";
            $data['main']='admin/edit_forum_category';
            $data['cat_info']=$this->Forum_category_model->get_cat_id_info($cat_id);
            $this->parser->parse('admin/admin',$data);
    }
      
    function edit() 
    {
            $cat_id = $this->input->post('cat_id',TRUE);
            $cat_info=$this->Forum_category_model->get_cat_id_info($cat_id);
            //echo $_FILES['category_image']['name'];exit;
            $parent_id=$this->Forum_category_model->get_parent_id($this->input->post('cat_id',TRUE));
            $this->Forum_category_model->edit_forum_category();
            $this->session->set_flashdata('category_error','Selected Forum Category is Edited');

            redirect(ADMIN_PATH.'/forum/forum_categories/'.$parent_id->parent_id,'refresh');
    }

    function search()
    {
            $data['title'] = "Forum Management Search Results";
            $search_category = $this->input->post('search_category',TRUE);
            $data['search_results'] = $this->Forum_model->getCategorySearchResults($search_category);
            $this->session->set_flashdata('category_error','Searched Results for '.$this->input->post('search_category',TRUE));
            $data['message']="Searched Results for '".$this->input->post('search_category',TRUE)."'";
            $data['main']='admin/forum_Category_search';
            $this->parser->parse('admin/admin',$data);


    }
   function forum_edit($disc_id)
   {
             $data['title']="Wannaquiz:Edit Forum Discussion";
            $data['main']='admin/forum_edit';
            $data['forum_info'] = $this->Forum_model->get_forum_by_ids($disc_id);
            $this->parser->parse('admin/admin',$data);
   }
   function forum_edit_save()
   {
            $disc_id=$this->input->post('disc_id',TRUE);
            $this->form_validation->set_rules('discussion_title','tags','content', 'Discussion Title', 'required');
            $this->form_validation->set_rules('cat_id', 'Category', 'required');
            if($this->form_validation->run()==FALSE) 
            { 
                $this->session->set_flashdata('category_error',validation_errors());
                redirect(ADMIN_PATH.'/forum/forum_edit/'.$disc_id,'refresh');
            }
            else
            {
                $data['discussion_title']=$this->input->post('discussion_title',TRUE);
                $data['url']=$this->input->post('discussion_title',TRUE);
                $data['cat_id']=$this->input->post('cat_id',TRUE);
                $data['sub_cat_id']=$this->input->post('sub_cat_id',TRUE);
                $data['tags']=$this->input->post('tags',TRUE);
                $data['content']=$this->input->post('content',TRUE);
                $data['created']=date('Y:m:d H:i:s');
                $data['sticky']=$this->input->post('sticky',TRUE);
                $data['sticky_position']=$this->input->post('sticky_position',TRUE);
                $this->db->where('disc_id',$disc_id);
                $this->db->update('tbl_discussion',$data);
                $this->session->set_flashdata('category_error','Selected Forum is Edited');
                redirect(ADMIN_PATH.'/forum/','refresh');
            }
   }
   
      
      function forum_delete_discussion($disc_id)
      {
                $this->db->where('disc_id',$disc_id);
                $this->db->delete('tbl_discussion');
                $this->session->set_flashdata('category_error','Selected Forume discussion is deleted');
                redirect(ADMIN_PATH.'/forum/','refresh');
     }
     function forum_discussion_detail($disc_id)
     {
        $config['base_url'] = site_url('admin/forum/forum_discussion_detail/'.$disc_id);
        $res=$this->Forum_model->get_count_comment($disc_id);
        $config['total_rows']=$res;
        $config['per_page'] = 4;
        $config['uri_segment'] = 5;
        $config['first_link'] = ' ';
        $config['last_link'] = ' ';
        $config['full_tag_open'] = '<ul class="clearfix">';
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
        
         $data['forum_info'] = $this->Forum_model->get_forum_by_id($disc_id);
        $data['comment_info'] = $this->Forum_model->get_comment_by_id($disc_id,$config['per_page'], $this->uri->segment(5, 0));
         $data['title'] = 'Forum Discussion Detail';
        $data['main'] = 'admin/forum_discussion_detail';        
        $this->load->view('admin/admin',$data);
     }
      function discussion_comment_edit()
   {
            $id=$this->input->post('comment_id',TRUE);
            $datas['comment']=$this->input->post('comment',TRUE);
            $this->db->where('id',$id);
            $datas['comment_date']=date('Y:m:d H:i:s');
            $this->db->update('tbl_discussion_comment',$datas);
            return true;
   }
  
     function forum_delete_comment($comment_id,$id)
      {
                $this->db->where('id',$comment_id);
                $this->db->delete('tbl_discussion_comment');
                $this->session->set_flashdata('category_error','Comment is Deleted');
                 redirect(ADMIN_PATH.'/forum/forum_discussion_detail/'.$id,'refresh');
     }
}

/* End of file forum.php */
/* Location: ./application/controllers/admin/forum.php */