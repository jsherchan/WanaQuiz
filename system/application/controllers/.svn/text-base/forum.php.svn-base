<?php
class Forum extends Controller {

    function Forum () {
        parent::Controller();
        $this->load->model('forum_model');
        $this->load->model('quiz_model');
        $this->load->model('forum_category_model');
        $this->load->model('Award_model');
        $this->load->library('form_validation');
        $this->load->helper('text');
        $this->load->library('pagination');
    }

    function index() {
    //        $limit='',$msg=''
        $this->forum_list();
    }
    function forum_list() {
        
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        $data['title']='Forum discussion';
        // $data['recent']= $this->forum_model->get_frontpage_forum($config['per_page'], $this->uri->segment(10, 0));
        $data['category_list']=$this->forum_category_model->get_all_categorie();
        $data['category_count']=$this->forum_model->get_cat_cout();
        $data['main']='member/forum_all_categories';
        $this->load->view('forumhome',$data);
        
    }
    function forum_by_category($id)
    {
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        $data['title']='Forum discussion';
        $config['base_url'] = site_url('forum/forum_by_category/'.$id);
        $res=$this->forum_model->count_discussion($id);
        $config['total_rows']=$res->catagory;
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
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
        $data['recent']= $this->forum_model->get_all_discussion_by_category($id,$config['per_page'], $this->uri->segment(4, 0));
        $data['recent_Category']=$this->forum_model->get_category_id($id); 
        $data['category_list']=$this->forum_category_model->get_all_categorie();
        
        $data['main']='member/forum_discussion_list';
        $this->load->view('forumhome',$data);
    }
    
    function forum_sub_by_category($id)
    
    {
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered'); 
        $data['title']='Forum discussion';
          $config['base_url'] = site_url('forum/forum_sub_by_category/'.$id);
        $res=$this->forum_model->get_count_sub_Category($id);
        $config['total_rows']=$res;
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
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
        $data['recent']= $this->forum_model->get_all_discussion_by_sub_category($id,$config['per_page'], $this->uri->segment(4, 0));
         $data['recent_Category']=$this->forum_model->get_category_id($id); 
        $data['category_list']=$this->forum_category_model->get_all_categorie();
        
        $data['main']='member/forum_discussion_list';
        $this->load->view('forumhome',$data);
    }
    
     function forum_get_subcategory_options()
    {
        $pid = $this->input->post('pid',TRUE);
        $cats = $this->forum_category_model->get_sub_categories($pid);
        
        $options = '<select name="sub_cat_id" id="sub_cat_id">';
        
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
    function forum_discussion_detail($disc_id)
    {   
        $uid = $this->session->userdata('wannaquiz_user_id');
        $data['mem_info']=$this->Member_model->get_member($uid);
        $data['filter'] = $data['mem_info']->filter_adult;
       
        if($data['filter']) $this->session->set_userdata('filtered','You have chosen to Filter Adult Content');
        else $this->session->unset_userdata('filtered');
        
        $config['base_url'] = site_url('forum/forum_discussion_detail/'.$disc_id);
        $res=$this->forum_model->get_count_comment($disc_id);
        $config['total_rows']=$res;
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
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
        
        $this->db->where('disc_id',$disc_id);
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->update(tbl_discussion);
        $data['count_post']=$this->forum_model->count_number_of_post();
        $data['forum_info'] = $this->forum_model->get_forum_by_id($disc_id);
        $data['comment_info'] = $this->forum_model->get_comment_by_id($disc_id,$config['per_page'], $this->uri->segment(4, 0));
        $data['category_list']=$this->forum_category_model->get_all_categories();
        $data['title'] = 'Forum Discussion Detail';
        $data['main'] = 'member/forum_discussion_detail';        
        $this->load->view('forumhome',$data);
    
    }
    
    function report_discussion()
    {
         $data['disc_id']= $this->input->post('disc_id',TRUE);
         $data['report_type']='spam';
         $data['reporter']=$this->input->post('reporter_id',TRUE);
         $data['reported_date']=date("Y-m-d H:i:s");
         $res = $this->db->insert('tbl_discussion_report',$data);
        if($res)
        echo "success";
        else echo "error";
        return;
    }
     function report_discussion_comment()
    {
         $id = $this->input->post('comment_id',TRUE);
         $this->db->where('id',$id);
        $res = $this->db->update('tbl_discussion_comment',array('spam'=>'1'));
        if($res)
        echo "success";
        else echo "error";
        return;
    }
    
    function tag(){
        $offset=$this->uri->segment(4);
       if($offset==''){
           $offset=0;
       }
        $data['title']='Forum Home';
        $config['base_url'] = site_url('forum/tag/'.$this->uri->segment(3));
       $config['total_rows'] = $this->forum_model->countforum();//$this->db->count_all('tbl_discussion');
        $config['per_page'] = 10;
       
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['page']='home';
        $data['pag_links'] = $this->pagination->create_links();
        $data['recent']= $this->forum_model->get_frontpage_forumbytag($offset);
        $data['content']=$this->forum_model->get_recipies_home();
        $data['main']='includes/forum_home';
        $data['ra']=$this->forum_model->get_recent_act();
        $data['msg']=$this->session->flashdata('msg');
        $this->load->view('index',$data);
    }

    function get_fren_tip() {
        $res=$this->forum_model->get_fren_tip();
        print_r($res);
        return $res;
    }

    function add_discussion() 
    {
        $data['discussion_title']=$this->input->post('discussion',TRUE);
        $data['user_id']=$this->session->userdata('wannaquiz_user_id');
        $data['cat_id']=$this->input->post('categories',TRUE);
        $data['sub_cat_id']=$this->input->post('sub_categories',TRUE);
        $data['tags']=$this->input->post('tag',TRUE);
        $data['content']=$this->input->post('discussion_detail',TRUE);
        $data['sticky_position']='100';
        $data['created']=date('Y:m:d H:i:s');
         $this->db->insert(tbl_discussion,$data);

         return true;
    }

    function add_forum() {

       $compare= $this->forum_model->compare_forum($this->input->post('discussion_title',TRUE));
       if($compare!=0){
        //   $this->session->set_flashdata('title_error','');
          $this->add_discussion('Sorry this discussion title is already registered');
         return false;
       }
        $this->form_validation->set_rules('discussion_title', 'Discussion Title', 'required');
        $this->form_validation->set_rules('tags', 'Tags', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        //  $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->add_discussion();
        }
        else {
            $url=$this->forum_model->add_forum($this->session->userdata('user_id'));
            $msg='Your Discussion Has Been Sucessfully Added';
            $this->session->set_flashdata('msg', $msg);
            $this->db->where('id',$this->input->post('cat_id',TRUE));
            $query=$this->db->get('tbl_forum_categories');
            $cat=$query->row();
            $this->db->where('id',$this->input->post('sub_cat_id',TRUE));
            $query=$this->db->get('tbl_forum_categories');
            $sub=$query->row();
           
            redirect('forum/'.$cat->name.'/'.$sub->name.'/'.$url);
        }
    }



    function forum_detail($disc_id='',$msg='',$disc_title='') {
         $disc_title=   $this->uri->segment(4);
//          $disc_title= str_replace("-"," ",$disc_title);
         $disc_id=$this->forum_model->get_disc_id($disc_title);
         if($disc_id=='') {
            redirect('forum/index');
            }
        $check=  $this->forum_model->check_forum_exits($disc_id);
        if($disc_id=='' || $check=='') {
            redirect('forum/index');
            }
         
        $this->load->model('forum_model');
        $res= $this->forum_model->forum_detail($disc_id);
        $data['msg']=$this->session->flashdata('msg');
        $data['main']='includes/forum_post';
        $data['forum']=$res;
        $data['forum_id']=$disc_id;
/*ajax pagination*/
        $config['base_url'] = base_url().'forum/popup/'.$disc_id.'/';
        //   $config['total_rows'] =200;//$this->blog_model->count_record();
        $config['per_page'] = 8;
        $config['uri_segment']=4;
        $offset=$this->uri->segment(3,0);
        $config['total_rows'] =$this->forum_model->count_record($disc_id);
        $this->pagination->initialize($config);
        $data['pag_links'] = $this->pagination->create_links();
        $data['res']= $this->forum_model->get_fren_tip(0,8,$disc_id);

        $forum_name=$this->footer_model->get_forumname($disc_id);
        $title=$this->footer_model->get_forum_catheader($forum_name->cat_id);
        $subtitle=$this->footer_model->get_forum_catheader($forum_name->sub_cat_id);
        //$data['neomundo_title']=$forum_name->discussion_title."-".$subtitle->pagetitle."/".$title->pagetitle;
        $data['neomundo_title']=$forum_name->discussion_title."-".$title->pagetitle;
        $data['neomundo_keyword']=$subtitle->metakeyword;
        $data['neomundo_desc']=$subtitle->metadesc;
        $this->load->view('index',$data);
        $this->forum_model->add_view222($disc_id);
    }


    function popup($disc_id,$id=0) {
        if($id=='') {
            $id=0;
        }
        //  echo "this is the test";

        $config['base_url'] = base_url().'forum/popup/'.$disc_id.'/';
        $data['main']='includes/discussion_tip';
        $config['per_page'] = 8;
        $config['uri_segment']=4;
        $offset=$this->uri->segment(4,0);
        $config['total_rows'] =$this->forum_model->count_record($disc_id);
        $this->pagination->initialize($config);

        $data['pag_links'] = $this->pagination->create_links();
        $data['res']= $this->forum_model->get_fren_tip($id,8,$disc_id);
        echo $this->load->view("includes/discussion_tip", $data, true);



    }



    function iwant($disc_id) {
    //echo $disc_id;
        $this->forum_model->iwant($disc_id);
        redirect($_SERVER['HTTP_REFERER']);
    // $this->forum_detail($disc_id);
    }

    function check_recipe_comment() {

        $user_id=$this->session->userdata('user_id');
        $qry="select * from tbl_recipe r left outer join tbl_recipe_comments c on r.recipe_id=c.recipe_id
        left outer join tbl_mem_personal_detail m on m.mem_id=c.user_id where r.user_id='$user_id'
        and c.read_flag=0 AND c.user_id !=$user_id";
        $res= $this->db->query($qry);
        return $res;
    }

    function add_comment() {
        $data['user_id']=$this->session->userdata('wannaquiz_user_id');
        echo $data['user_id'];
         $data[disc_id]=$this->input->post('disc_id',TRUE);
         $data['comment_date']=date("Y-m-d H:i:s");
         
         $data['comment']=$this->input->post('comment',TRUE);
         $this->db->insert('tbl_discussion_comment',$data);
          $user_award = $this->Award_model->check_user_helpful_awards($this->session->userdata('wannaquiz_user_id'));
           if($user_award<1) {
                        $total_replies = $this->forum_model->count_user_reply($this->session->userdata('wannaquiz_user_id'));
                           if($total_replies>=10) {
                            $this->Award_model->insertHelpfulAward($this->session->userdata('wannaquiz_user_id'));
                        }
                    }
         return true;
     
   }
   function add_comment_reply() {
        $data['user_id']=$this->session->userdata('wannaquiz_user_id');
         $data[disc_id]=$this->input->post('disc_id',TRUE);
         $data[comment_reply_id]=$this->input->post('reply_id',TRUE);
         $data['comment_date']=date("Y-m-d H:i:s");
         $data['comment']=$this->input->post('comment',TRUE);
         $this->db->insert('tbl_discussion_comment',$data);
          $user_award = $this->Award_model->check_user_helpful_awards($this->session->userdata('wannaquiz_user_id'));
                    if($user_award<1) {
                        $total_replies = $this->forum_model->count_user_reply($this->session->userdata('wannaquiz_user_id'));
                        if($total_replies>='10') {
                            $this->Award_model->insertHelpfulAward($this->session->userdata('wannaquiz_user_id'));
                        }
                    }
         return true;
     
   }

  
    function delete_comment($id,$rid) {

        $msg="Comment has been deleted sucessfully.";
        $this->forum_model->delete_comment($id);
        redirect('forum/forum_detail/'.$rid.'/'.$msg);
    }

    function tip_disc() {
        
        $rec_id=$this->input->post('disc_id',TRUE);
        $this->forum_model->tip_disc();
        $this->session->set_flashdata('msg','You have sucessfully tipped this Post to your friends');
        //redirect('forum/forum_detail/'.$rec_id.'/');
        redirect($_SERVER['HTTP_REFERER']);
    }

    function discussion_menu_sub($sub_id='') {
  
  // echo $sub_id;
        if($sub_id=='') {
            redirect('forum/index');
        }
        $res= $this->forum_model->discussion_menu_sub($sub_id);
        $data['recent']=$res;
        $data['catname']=$this->forum_model->get_cat_name($sub_id);
       // exit;
        $data['ra']=$this->forum_model->get_recent_act();
        $data['main']='includes/forum_home';
        $this->load->view('index',$data);
    }

    function forum_cat_list() {
        //echo 'here';exit;
        $offset=$this->uri->segment(3);
       if($offset==''){
           $offset=0;
       }
       //echo 'here';exit;
        $cat_name=$this->uri->segment(2);
        $cat_id=$this->forum_model->get_cat_id($cat_name); 
        $data['title']='Forum Home';
        $config['base_url'] = site_url('forum/'.$cat_name.'/');
       $config['total_rows'] = $this->forum_model->get_catcount_forum($cat_id);//$this->db->count_all('tbl_discussion');exit;
        $config['per_page'] = 10;

        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['page']='home';
        $data['pag_links'] = $this->pagination->create_links();
        $data['recent']= $this->forum_model->get_cat_forum($cat_id,$offset);
        $data['content']=$this->forum_model->get_cat_desc($cat_name);//$this->forum_model->get_recipies_home();
        $data['main']='includes/forum_home';
        $data['ra']=$this->forum_model->get_recent_act();
        $data['msg']=$this->session->flashdata('msg');
        $data['catname']=$cat_name;
        $title=$this->footer_model->get_forum_catheader($cat_id);
        $data['neomundo_title']=$title->pagetitle;
        $data['neomundo_keyword']=$title->metakeyword;
        $data['neomundo_desc']=$title->metadesc;
        $this->load->view('index',$data);




    }
    function forum_sub_list() {
        $offset=$this->uri->segment(4);
       if($offset==''){
           $offset=0;
       }
       //echo 'here';exit;

        $cat_name=$this->uri->segment(3);
        $cat_id=$this->forum_model->get_cat_id($cat_name);
        $data['title']='Forum Home';
        $config['base_url'] = site_url('forum/'.$this->uri->segment(2).'/'.$cat_name.'/');
       $config['total_rows'] = $this->forum_model->get_subcount_forum($cat_id);//$this->db->count_all('tbl_discussion');exit;
        $config['per_page'] = 10;

        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['page']='home';
        $data['pag_links'] = $this->pagination->create_links();
        $data['recent']= $this->forum_model->get_sub_forum($cat_id,$offset);
        $data['content']=$this->forum_model->get_cat_desc($cat_name);//$this->forum_model->get_recipies_home();
        $data['main']='includes/forum_home';
        $data['ra']=$this->forum_model->get_recent_act();
        $data['msg']=$this->session->flashdata('msg');
        $data['catname']=$cat_name;

        $subcat_id=$this->forum_model->get_cat_id($this->uri->segment(2));
        $title=$this->footer_model->get_forum_catheader($subcat_id);
        $subtitle=$this->footer_model->get_forum_catheader($cat_id);
        $data['neomundo_title']=$subtitle->pagetitle."-".$title->pagetitle;
        $data['neomundo_keyword']=$subtitle->metakeyword;
        $data['neomundo_desc']=$subtitle->metadesc;
        $this->load->view('index',$data);




    }
    //added by bikash
    function forum_sub_list1($cat1='') {

   $cat2=$this->uri->segment(3);
   $cat1=$this->uri->segment(2);
    //echo 'here';exit;
  // echo $sub_id;
        /*if($cat2=='') {
            redirect('forum/index');
        }*/
        if($cat2==''){
        $res= $this->forum_model->discussion_menu_cat1($cat1);
        }else{
            $res= $this->forum_model->discussion_menu_sub1($cat2);
        }
        $data['recent']=$res;
        //$data['catname']=$this->forum_model->get_cat_name($cat2);
       // exit;
        if($cat2==""){
        $data['catname']=$cat1;
        }else{
        $data['catname']=$cat2;
        }
        $data['ra']=$this->forum_model->get_recent_act();
        if($cat2==''){
        $data['content']=$this->forum_model->get_cat_desc($cat1);
        }else{
            $data['content']=$this->forum_model->get_cat_desc($cat2);
        }
       
        $data['main']='includes/forum_home';
        $this->load->view('index',$data);
    }
/*********************ratings************************
    function add_rating($disc_id) {
        $user_id=$this->session->userdata('user_id');
        if($user_id==''){
            ?>
<script type="text/javascript">
    $.prompt('Please first to rate.');
</script>
<?
        }else{
        $check=$this->forum_model->check_rating($disc_id);
        if($check==0) {
            $this->forum_model->add_rating($disc_id);
        }else {
            ?>
<script type="text/javascript">
    $.prompt('Sorry A User Cannot Rate Multiple Times');
</script>
        <?
        }

    }
    }*/



    function add_rating($product_id) {
//        echo "soem";
//        exit;
        if(!$this->session->userdata('user_id')) {
            $this->forum_model->count_rating($product_id);
            echo "_";
            echo $this->forum_model->get_rating($product_id);
            echo "-";
            echo "Please login first to rate this discussion";;
        }
        else {
            $check=$this->forum_model->check_rating($product_id);
            if($check==0) {
                $this->forum_model->add_rating($product_id);

                $this->forum_model->count_rating($product_id);
                echo "_";
                echo $this->forum_model->get_rating($product_id);
                echo "-";
                echo "Thank you for rating this discussion";
            }
            else {
                $this->forum_model->count_rating($product_id);
                echo "_";
                echo $this->forum_model->get_rating($product_id);
                echo "-";
                echo "Sorry an user cannot rate multiple times for the same discussion";

            }
        }
    }
    function get_rating($recipe_id) {
        $rating= $this->forum_model->get_rating($disc_id);
    }

    function month() {
        $month=array(January, February, MARCH
            , April, May, June,  July,
            August, September,
            October, November, December);
        print_r($month);
    }
    function check_name(){
       $name=$this->input->post('name',TRUE);
       $check=$this->forum_model->check_name($name);
       if($check!=0){
           echo'<font color="red">Sorry this  discussion title is already registed</font>';
       }else{
           echo '<font color="green">this discussion title is valid</font>';
       }
    }
    function deleteiwant(){
        $id= $this->uri->segment(3);
        $this->db->where('disc_id',$id);
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->delete('tbl_forum_iwant');
        $this->session->set_flashdata('msg','Discussion has been sucessfully deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    function deleteihave(){
        $id= $this->uri->segment(3);
        $this->db->where('disc_id',$id);
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->delete('tbl_discussion');
        $this->session->set_flashdata('msg','Discussion has been sucessfully deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    function deletetipped(){
        $id= $this->uri->segment(3);
        $this->db->where('disc_id',$id);
        $this->db->where('member_id',$this->session->userdata('user_id'));
        $this->db->delete('tbl_disc_tipped');
        $this->session->set_flashdata('msg','Discussion has been sucessfully deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }    
}

?>
