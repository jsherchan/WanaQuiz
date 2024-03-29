<?php
class Forum_model extends Model {

    function Forum_model() {
        parent::Model();

    }

    function index() {

    }

    function get_root_cat() {
                $qry="select * from tbl_forum_category where parent_id = 0";
                $res= $this->db->query($qry);
                return $res;
    }
    function get_sub_cat($id) {
                $qry="select * from tbl_forum_category where parent_id = $id";
                $res=$this->db->query($qry);
                return $res;
    }

    function add_forum($user_id='') {
       
        $data['user_id']=$user_id;
        $data['discussion_title']=trim($this->input->post('discussion_title'));
        $data['cat_id']=$this->input->post('cat_id');
        $data['sub_cat_id']=$this->input->post('sub_cat_id');
        $data['tags']=$this->input->post('tags');
        $data['url']=url_title($data['discussion_title']);
        $data['content']=$this->input->post('content');
        $data['created']=date('Y:m:d H:i:s');
        $id=$this->db->insert('tbl_discussion',$data);
#$log_id=$this->db->insert_id();
#$this->insert_log($log_id);
/*        
if($this->input->post('facebook')=='on'){
         $f_username=$this->input->post('f_username');
         $f_password=$this->input->post('f_password');
         $title= $data['recipe_title'];
       $id=  $desc=$this->get_link($id);

       $this->footer_model->fb_share($title,$desc,$f_username,$f_password);
        }
        if($this->input->post('twitter')=='on'){
         $t_username=$this->input->post('t_username');
         $t_password=$this->input->post('t_password');
         $title= $data['recipe_title'];
         $desc=$this->get_link($id);

       $this->footer_model->twitterSetStatus($t_username,$t_password,$desc);
        }
          if($this->input->post('hyves')=='on') {
            $t_username=$this->input->post('h_username');
            $t_password=$this->input->post('h_password');
            $title= $data['recipe_title'];
            $desc=$this->$this->get_link($id);

            $this->footer_model->share_hyves($h_username,$h_password,$desc,"");
        } 
 */
        return $data['url'];
    }
    function insert_log($disc_id){
                $data['type']='forum_add';
                $data['type_id']=$disc_id;
                $data['user_id']=$this->session->userdata('user_id');
                $this->db->insert('tbl_neomundo_log',$data);
    }
    function get_recent_discussion($limit,$offset='') {

                $qry="SELECT d.discussion_title, d.created, d.user_id, d.content, d.disc_id, p.name
                FROM tbl_discussion d
                JOIN tbl_mem_personal_detail p ON d.user_id = p.mem_id
                ORDER BY created DESC
                LIMIT $offset ,$limit ";
                $res= $this->db->query($qry);
                return $res;
    }

    function get_all_discussion_by_category($cat_id,$num,$limit)
        {   
                $sql="select m.username, d.* from 
                    tbl_discussion d 
                       join tbl_members m on m.user_id=d.user_id where d.cat_id=$cat_id  and d.flag='1' order by d.created DESC limit ".$limit.",".$num;
               $result=$this->db->query($sql);
                 return $result->result();
        }  
    function get_all_discussion_by_sub_category($sub_id,$num,$limit)
        {               
            $sql="select m.username, d.* from 
                    tbl_discussion d 
                       join tbl_members m on m.user_id=d.user_id where d.sub_cat_id=$sub_id  and d.flag='1' order by d.created DESC limit ".$limit.",".$num;
               $res=$this->db->query($sql);
                return $res->result();
                       
        }  

function get_count_sub_Category($id)
        {
                $option=array('sub_cat_id'=>$id);
                $this->db->limit($num, $limit);
                $query=$this->db->getwhere('tbl_discussion',$option);
                
                return $query->num_rows();
        }

       function get_cat_cout()
       {
           $sql="select count(c.name) as total, c.name, d.discussion_title from tbl_forum_categories c
                    join tbl_discussion d   on c.id=d.cat_id ";
           $res=$this->db->query($sql);
           return $res;
           
       }
       
       function  get_thread_count($id)
       {
           $sql="SELECT count(disc_id) as post from tbl_discussion d
            join tbl_forum_categories c on d.cat_id=c.id where d.cat_id=$id";
           $res=$this->db->query($sql);
           return $res;
       }
       function get_post_count($id)
       {
           $sql="SELECT count(d.disc_id) as post from tbl_discussion_comment d
            join tbl_discussion c on d.disc_id=c.disc_id 
           join tbl_forum_categories f on c.cat_id=f.id
           where c.cat_id=$id";
           $res=$this->db->query($sql);
           return $res;
       }
       
       function  get_last_post($id)
       {
           $sql="SELECT m.username, d.disc_id, d.discussion_title, d.created from tbl_members m
                join tbl_discussion d
                on m.user_id=d.user_id where  cat_id=$id order by d.created desc limit 1";
           $res=$this->db->query($sql);
           return $res;
       }
       
       function get_last_comment($id)
       {
           $sql="SELECT m.username, d.discussion_title, e.comment_date from tbl_members m
                join tbl_discussion d
                on m.user_id=d.user_id
                 join tbl_discussion_comment e on d.disc_id=e.disc_id where d.disc_id=$id  order by e.comment_date desc limit 1 ";
            $res=$this->db->query($sql);
           return $res;
       }
       
        
    function get_num_discussion() {
                $res=$this->db->query('select * from tbl_discussion');
                $num=$res->num_rows();
    }
    function forum_detail($disc_id) {
               $qry="select * from tbl_discussion where disc_id='$disc_id'";
                $res=$this->db->query($qry);
                $data=$res->row_array();
                return $data;
    }
    function forum_detail123($disc_id) {
               $qry="select * from tbl_discussion where disc_id='$disc_id'";
                $res=$this->db->query($qry);
                return $res;
    }
    function get_category_id($cat_id) {
                $query="select name from tbl_forum_categories where id= $cat_id";
                $res=$this->db->query($query);
                return $res->row_array();
      
    }
    function get_total_reply($id)
    {
            $sql="SELECT count(c.disc_id) as total FROM tbl_discussion_comment c
            join tbl_discussion d on c.disc_id=d.disc_id where c.disc_id=$id";
            $res=$this->db->query($sql);
                return $res->result_array();
    }
    
    function count_discussion($id)
    {
                $sql=" select count(cat_id) as catagory from tbl_discussion where cat_id=$id";
                $res=$this->db->query($sql);
                 return $res->row();
    }
    
    
   function get_comment_by_id($id,$num,$lim)
    {
                $query="SELECT m.user_id, m.username, m.moderator, d.profile_picture, c.discussion_title, c.content, md.id, md.user_id, md.comment, md.comment_date
                FROM tbl_members m
                JOIN tbl_discussion_comment md ON ( md.user_id = m.user_id )
                JOIN tbl_discussion c ON ( c.disc_id = md.disc_id )
                left join tbl_member_profile d on (d.member_id=md.user_id)
                where c.disc_id=$id and md.status='1'group by md.id  limit ".$lim.",".$num ;      
                 $res=$this->db->query($query);
                 return $res->result_array(); 
                
   }
   function get_level($id)
   {        $sql="select a.level_name, m.current_points  from tbl_level a
            join tbl_member_levels m on a.id=m.level_id where m.user_id=$id";
            $res=$this->db->query($sql);
            return $res->result_array(); 
   }
   
   function get_count_comment($id)
                 {
                $query="SELECT m.username, d.photo_name, md.discussion_title, md.content, c.id, c.user_id, c.comment, c.comment_date
                FROM tbl_members m
                JOIN tbl_discussion md ON ( md.user_id = m.user_id )
                JOIN tbl_discussion_comment c ON ( c.disc_id = md.disc_id )
                left join tbl_members_photos d on (d.user_id=md.user_id)
                where c.disc_id=$id group by c.id " ;      
                 $res=$this->db->query($query);
                return $res->num_rows(); 
               }
function check_forum_exits($id){
                  $qry="select disc_id from tbl_discussion where disc_id = ?";
                  $res=  $this->db->query($qry,array($id));

                  return $res->num_rows();
}


    function iwant($recipe_id) {
                $user_id=$this->session->userdata('user_id');
                if($user_id=='') {
                    $msg="Please Login first to add this disscussion to your list";
                    redirect('forum/forum_detail/'.$recipe_id.'/'.$msg);
                }
                $qry="select * from tbl_forum_iwant where disc_id = $recipe_id and user_id=$user_id";
                $res=$this->db->query($qry);
                $num= $res->num_rows();
                if($num==0) {
                    $qry="insert into tbl_forum_iwant set disc_id='$recipe_id', user_id='$user_id'";
                    $this->db->query($qry);
                    $msg='This Discussion Has been sucessfully Added to your list';
                    $this->session->set_flashdata('msg',$msg);
                }else {
                    $this->session->set_flashdata('msg',"You have already added this Discussion to your list");
                }
        //redirect('forum/forum_detail/'.$recipe_id.'/'.$msg);
         //$link= $this->forum_model->get_link_redirect($recipe_id);
       
     //return $link;
    }
    ////////////comment copied form recipe_model
    function get_link_redirect($recipe_id) {
                $qry="select c.name as category,r.discussion_title,(select name from tbl_forum_category where id=r.sub_cat_id)as sub_category from tbl_discussion r join
                      tbl_forum_category c on(r.cat_id=c.id)where r.disc_id =?";
                $res=$this->db->query($qry,array($recipe_id));
                $data=$res->row_array();
                return  $link=base_url().forum.'/'.$data['category'].'/'.$data['sub_category'].'/'.$data['discussion_title'];
    }

    function add_comment() {
                $data['user_id']=$this->session->userdata('user_id');
                $data['disc_id']=$this->input->post('disc_id');
                $data['comment']=strip_tags($this->input->post('comment'));
                $data['added_date']=time();
                if($data['comment']!=''){
                $this->db->insert('tbl_discussion_comments',$data);
                }
                $id=$data['disc_id'];
               // redirect('forum/forum_detail/'.$id);
    }
    function get_comment_by_forum_id($disc_id) {
                $qry="select * from tbl_disc_comments where disc_id= $disc_id  and parent_id = 0 order by added_date desc";
                $res=$this->db->query($qry);
                return $res;

    }
    function reply_comment() {
                $data['parent_id']= $this->input->post('parent');
                $data['disc_id']=$this->input->post('disc_id');
                $data['comment']=$this->input->post('comment');
                $data['added_date']=time();
                $data['user_id']=$this->session->userdata('user_id');
                //print_r($data);
                $this->db->insert('tbl_disc_comments',$data);
                 $this->db->last_query();

               $this->get_link($data['disc_id']);
    }


    function get_child_comment($comment_id) {
            //   echo "ksjdf";
                $qry="select * from tbl_disc_comments where parent_id = $comment_id";
                return  $res=$this->db->query($qry);

    }
    function get_num_comments($id) {
                $qry="Select * from tbl_disc_comments where disc_id=$id";
                $res=$this->db->query($qry);
                echo $res->num_rows();

    }

    function delete_comment($id) {
        $qry="delete  from tbl_disc_comments where comment_id = $id";
        $this->db->query($qry);

    }
    //
    //       function get_fren_tip(){
    //                 $user_id=$this->session->userdata('user_id');
    //
    //
    //      		   $qry= "SELECT * FROM `tbl_mem_personal_detail`
    //        p join tbl_member_friends m on p.mem_id = m.friend_id where m.user_id=$user_id limit 0,2";
    //                 $res=$this->db->query($qry);
    //                 return $res;
    //            }

    function tip_disc() {

                $user_id=$this->session->userdata('user_id');
                $disc_id=$this->input->post('disc_id');
                $member_id=$this->input->post('member');
                if(is_array($member_id)) {


                    foreach ($member_id as $mid) {
                        $qry="insert into tbl_disc_tipped set user_id=$user_id,disc_id=$disc_id, member_id=$mid";
                        $this->db->query($qry);
                    }
                }else {
                    $msg="Please Select Your Friend To Tip This Discussion";
                    redirect('forum/forum_detail/'.$disc_id.'/'.$msg);
                }


    }
    function discussion_menu_sub($id='') {
        
        $qry="select * from tbl_discussion where sub_cat_id = ? order by created desc";
        $res=$this->db->query($qry,array($id));
        return $res;
    }
    //added by bikash
    function discussion_menu_sub1($cat=''){
        $qry="select * from tbl_discussion as d inner join tbl_forum_category as f on d.sub_cat_id=f.id  where f.name = ? order by d.created desc";
        $res=$this->db->query($qry,array($cat));
        return $res;
    }

    function discussion_menu_cat1($cat=''){
        $qry="select * from tbl_discussion as d inner join tbl_forum_category as f on d.cat_id=f.id  where f.name = ? order by d.created desc";
        $res=$this->db->query($qry,array($cat));
        return $res;
    }


    function get_similar_disc($disc_cat_id) {
        $qry="select * from tbl_discussion where cat_id = $disc_cat_id limit 0,4";
        $res=$this->db->query($qry);
        return $res;
    }


    function disc_by_id($id) {
        $qry="select discussion_title from tbl_discussion where disc_id = ?";
        $res=$this->db->query($qry,array($id));
        $data=$res->row();
        echo $data->discussion_title;

    }
    function get_latest_replies() {
                $qry="SELECT c.comment, c.disc_id, p.name, r.discussion_title,m.username,r.cat_id,r.sub_cat_id
                FROM tbl_disc_comments c
                JOIN tbl_mem_personal_detail p ON c.user_id = p.mem_id
                JOIN tbl_discussion r ON ( r.disc_id = c.disc_id )join tbl_mem m
                on(p.mem_id = m.id)
                GROUP BY c.disc_id
                ORDER BY c.added_date DESC
                LIMIT 0 , 3";
                $res=$this->db->query($qry);
                return $res;
    }
    function count_forum() {
        return  $this->db->count_all('tbl_discussion');
    }

    function get_most_commented() {
        $qry="SELECT count(c.disc_id) as total, c.comment,r.disc_id, r.discussion_title,r.cat_id,r.sub_cat_id from tbl_disc_comments c
join tbl_discussion r on (r.disc_id=c.disc_id)
group by c.disc_id order by total desc
limit 0,4";

        $res=$this->db->query($qry);
        return $res;
    }

    function get_frontpage_forum($num,$limit) {
     
        $qry="select * from tbl_discussion order by created  DESC  limit ".$limit.",".$num;
        $res=$this->db->query($qry);
        return $res->result();
          }
    function get_catcount_forum($cat){
         $qry="select * from tbl_discussion where cat_id=$cat";
        $res=$this->db->query($qry);
        return $res->num_rows();
    }
    function get_subcount_forum($cat){
         $qry="select * from tbl_discussion where sub_cat_id=$cat";
        $res=$this->db->query($qry);
        return $res->num_rows();
    }
    function get_sub_forum($cat,$offset) {

        $qry="select * from tbl_discussion where sub_cat_id=$cat order by created  DESC  limit $offset,5";
        $res=$this->db->query($qry);
        $data=$res;
         $this->db->last_query();
        return $data;

    }
    function get_cat_forum($cat,$offset) {

        $qry="select * from tbl_discussion where cat_id=$cat order by created  DESC  limit $offset,5";
        $res=$this->db->query($qry);
        $data=$res;
         $this->db->last_query();
        return $data;

    }
    function get_cat_id($name){
        $this->db->where('url',$name);
        $query=$this->db->get('tbl_forum_category');
        $row=$query->row();
        return $row->id;
    }
    function countforum(){
        $qry="select * from tbl_discussion where tags like '%".$this->uri->segment(3)."%'";
        $res=$this->db->query($qry);
        return $res->num_rows;
    }
    function get_frontpage_forumbytag($offset) {

        $qry="select * from tbl_discussion where tags like '%".$this->uri->segment(3)."%' order by created  DESC  limit $offset,5";
        $res=$this->db->query($qry);
        $data=$res;
         $this->db->last_query();
        return $data;

    }
    function get_recent_act() {
        $query="select d.*, m.username from tbl_discussion d
join tbl_mem m on (m.id=d.user_id)

order by created desc limit 0,4";
        return $this->db->query($query);
    }

/******************ratings***************/
    function add_rating($disc_id) {
        $data['user_id']=$this->session->userdata('user_id');
        $data['no_rating']=$this->input->post('rating');
        $data['disc_id']=$disc_id;
        $this->db->insert('tbl_forum_rating',$data);
    }
    function get_rating($disc_id) {

        $qry=" SELECT sum( no_rating ) / count( user_id ) AS result
FROM tbl_forum_rating
WHERE disc_id =$disc_id";
        $res=$this->db->query($qry);
        $data=$res->row();
        return intval($data->result);

    }
    function count_rating($disc_id) {
        $qry="SELECT count(no_rating) as count from tbl_forum_rating where disc_id =$disc_id";
        $res=$this->db->query($qry);
        $data=$res->row();
        echo $data->count;
    }
    function check_rating($disc_id) {
        $user_id=$this->session->userdata('user_id');
        $qry="select * from tbl_forum_rating where disc_id = $disc_id and user_id = $user_id";
        $res=$this->db->query($qry);
        $num=$res->num_rows();
        return $num;
    }
    function get_iwant() {
        $user_id=$this->session->userdata('user_id');
        $qry="SELECT r.disc_id, r.user_id, r.discussion_title, r.user_id, r.cat_id, r.sub_cat_id, w.disc_id
FROM tbl_discussion r
JOIN tbl_forum_iwant w ON w.disc_id = r.disc_id
WHERE w.user_id =?";
        $res=$this->db->query($qry,array($user_id));


        return $res;
    }
    function get_userwant() {
        $this->db->where('username',$this->uri->segment(2));
        $query=$this->db->get('tbl_mem');
        $row=$query->row();
        $qry="SELECT r.disc_id, r.user_id, r.discussion_title, r.user_id, r.cat_id, r.sub_cat_id, w.disc_id
        FROM tbl_discussion r
        JOIN tbl_forum_iwant w ON w.disc_id = r.disc_id
        WHERE w.user_id =?";
        $res=$this->db->query($qry,$row->id);


        return $res;
    }
    function get_userhave() {
        $this->db->where('username',$this->uri->segment(2));
        $query=$this->db->get('tbl_mem');
        $row=$query->row();
        $qry="select * from tbl_discussion where user_id=?";
        $res=$this->db->query($qry,$row->id);
       // echo $this->db->last_query();
        return $res;
    }
    function get_ihave() {
        $qry="select * from tbl_discussion where user_id=?";
        $res=$this->db->query($qry,array($this->session->userdata('user_id')));
       // echo $this->db->last_query();
        return $res;
    }
    function get_forum_category($cat_id) {
        $qry="select name from tbl_forum_category where id =?";
        $res=$this->db->query($qry,array($cat_id));
        foreach($res->result() as $data) {
            echo $data->name;
        }
        
    }
    function getCategorySearchResults ($search_category)
	{
		$this->db->where('name', $search_category);
		$this->db->orderby('name');
		$query = $this->db->get('tbl_forum_categories');
                
		if ($query->num_rows() > 0)
			return $query->result();
        else
           return NULL;
	}
        
    function get_forum_list($num,$limit)
        {
            $qry="select * from tbl_discussion limit ".$limit.",".$num;
            $res=$this->db->query($qry);
            
            if($res->num_rows()>0)
                return $res->result_array();
            else
                return false;

        }
        function get_forum()
        {
            $qry="select * from tbl_discussion";
            $res=$this->db->query($qry);
            return $res->num_rows();
          
        }
        
        function get_forum_by_id($id) {
         $sql="SELECT m.username, m.joined_date, g.moderator, p.profile_picture, d.* from tbl_members as m
            join tbl_members g on g.user_id=m.user_id
           join tbl_member_profile p on m.user_id=p.member_id
          join tbl_discussion d
           on m.user_id=d.user_id where d.disc_id=$id and d.flag='1'";
        
           $result=$this->db->query($sql);
           if($result->num_rows()>0)
                   return $result->result_array();
           else return false;
        }
         function get_user($user)
        {
             $query="select user_id,username from tbl_members where user_id=$user";
           $res=$this->db->query($query);
           if($res->num_rows()>0)
            return $res->result_array();
        else
            return NULL;
          }
    function get_forum_tipped() {
        $qry="select t.disc_id,t.member_id, f.discussion_title,f.sub_cat_id,f.cat_id from tbl_disc_tipped t join tbl_discussion f on t.disc_id=f.disc_id where t.member_id=?";
        $res=$this->db->query($qry,array($this->session->userdata('user_id')));
      //  echo $this->db->last_query();
        
        return $res->result();
    }
    function get_forum_usertipped() {
        $this->db->where('username',$this->uri->segment(2));
        $query=$this->db->get('tbl_mem');
        $row=$query->row();
        $qry="select t.disc_id,t.member_id, f.discussion_title,f.sub_cat_id,f.cat_id from tbl_disc_tipped t join tbl_discussion f on t.disc_id=f.disc_id where t.member_id=?";
        $res=$this->db->query($qry,$row->id);
      //  echo $this->db->last_query();

        return $res->result();
    }
    function get_latest_forum() {
        $qry="select discussion_title, cat_id, sub_cat_id,disc_id,created from tbl_discussion order by created desc limit 0,8";
        $res=$this->db->query($qry);
        return $res->result();

    }
    function echo_category($cat_id) {
        $qry="select name from tbl_forum_category where id = $cat_id";
        $res=$this->db->query($qry,array(cat_id));
        $data=$res->row_array();
        echo url_title($data['name']);
    }

   
    function get_my_discussion($user_id) {
           $qry="SELECT d . * , md.name, m.username, m.id,fc.name
            FROM tbl_discussion d
            JOIN tbl_mem_personal_detail md ON ( d.user_id = md.mem_id )
            JOIN tbl_mem m ON ( m.id = md.mem_id )
            join tbl_forum_category fc on (fc.id=d.cat_id)
             WHERE d.user_id =?";
        $res= $this->db->query($qry,array($user_id));
        return $res->result();
    }
    function get_category($cat_id) {
        $query="select * from tbl_forum_category where id = $cat_id";
        $res=$this->db->query($query);
        $data=$res->result();
        foreach ($data as $val) {
            return $val;
        }
    }
    function get_recipe_comment_user($user_id) {
        $qry="select c.comment_id as cid, c.recipe_id as item_id, r.recipe_title,r.cat_id,r.sub_cat_id ,c.comment as comment  from tbl_recipe_comments c join tbl_recipe r on (r.recipe_id = c.recipe_id)where c.user_id=?";
        $res=$this->db->query($qry,array($user_id));
     
        return $res->result();
    }
     function get_product_comment_user($user_id) {
        $qry="select c.comment_id as cid, c.product_id as item_id, r.name,r.cat_id,r.sub_cat_id ,c.comment as comment  from tbl_product_comments c join tbl_product r on (r.product_id = c.product_id)where c.user_id=?";
        $res=$this->db->query($qry,array($user_id));
 $this->db->last_query();
        return $res->result();
    }
    function get_discussion_comment_user($user_id) {
        $qry="sELECT m.username, md.name,c.comment_id as cid, c.comment, c.user_id, p.discussion_title AS discussion_title, p.disc_id,p.cat_id,p.sub_cat_id
            FROM tbl_mem m
            JOIN tbl_mem_personal_detail md ON ( md.mem_id = m.id )
            JOIN tbl_disc_comments c ON ( c.user_id = md.mem_id )
            JOIN tbl_discussion p ON ( p.disc_id = c.disc_id )
            WHERE c.user_id =?
            ORDER BY c.added_date DESC";
        $res=$this->db->query($qry,array($user_id));
        return $res->result();
    }
    function get_blog_comment_user($user_id) {
        $qry="select c.comment_id as cid, c.blog_id as item_id, r.blog_title,r.cat_id,r.sub_cat_id ,c.comment as comment  from tbl_blog_comments c join tbl_blog r on (r.blog_id = c.blog_id)where c.user_id=?";
        $res=$this->db->query($qry,array($user_id));
      // echo $this->db->last_query()
        return $res->result();
    }
    function get_group_comment($user_id) {
        $recipe=$this->get_recipe_comment_user($user_id);
        $disc=$this->get_discussion_comment_user($user_id);
        $blog=$this->get_blog_comment_user($user_id);
        $data=array($recipe,$disc,$blog);
        return $data;
    }
    function get_forum_title($id) {
        $qry="select * from tbl_discussion where disc_id = '$id'";
        $res=$this->db->query($qry);
        $data=$res->result_array();
        foreach ($data as $d) {
            echo $d['discussion_title'];
        }
    }
    function get_blog_title($id) {
        $qry="select * from tbl_blog where blog_id = '$id'";
        $res=$this->db->query($qry);
        $data=$res->result_array();
        foreach ($data as $d) {
            echo $d['blog_title'];
        }
    }
    function delete_recipe($id) {
        $qry="delete from tbl_recipe where recipe_id=?";
        $this->db->query($qry,array($id));
        $this->db->delete('tbl_recipe_comments',array('recipe_id'=>$id));
        $this->db->delete('tbl_recipe_rating',array('recipe_id'=>$id));
        $this->db->delete('tbl_recipe_view',array('recipe_id'=>$id));
    }

        /**********************ajax pagnianon*/
    function get_fren_tip($offset,$limit,$disc_id) {
        $user_id=$this->session->userdata('user_id');
        $qry = "SELECT DISTINCT(mf.friend_id), pd.name,pd.picture,pd.mem_id FROM tbl_member_friends mf
left JOIN tbl_disc_tipped bt ON(bt.user_id = mf.user_id AND bt.disc_id <> ? )
left join tbl_mem_personal_detail pd ON(pd.mem_id = mf.friend_id)
WHERE mf.user_id = ? AND mf.friend_id NOT IN(SELECT member_id FROM tbl_disc_tipped WHERE user_id = ?) LIMIT $offset ,$limit";
        $query = $this->db->query($qry, array($disc_id, $user_id,$user_id));

        $res=$query->result();
        return $res;
    }
    function count_record($disc_id) {
        $user_id=$this->session->userdata('user_id');
        $qry = "SELECT DISTINCT(mf.friend_id), pd.name,pd.picture,pd.mem_id FROM tbl_member_friends mf
left JOIN tbl_disc_tipped bt ON(bt.user_id = mf.user_id AND bt.disc_id <> ? )
left join tbl_mem_personal_detail pd ON(pd.mem_id = mf.friend_id)
WHERE mf.user_id = ? AND mf.friend_id NOT IN(SELECT member_id FROM tbl_disc_tipped WHERE user_id = ?)";
        $query = $this->db->query($qry, array($disc_id, $user_id,$user_id));
        //echo $this->db->last_query();
        return $query->num_rows();
    }
    function get_user_name($user_id){
        $qry="select name from tbl_mem_personal_detail where mem_id = ?";
        $res=$this->db->query($qry,array($user_id));
        $data=$res->row_array();
        echo $data['name'];
    }
      function get_user_profile($user_id){
        $qry="select username from tbl_mem where id = ?";
        $res=$this->db->query($qry,array($user_id));
        $data=$res->row_array();
        echo $data['username'];
    }
   function test_friend(){
           $user_id = $this->session->userdata('user_id');
           $qry="select friend_id from tbl_member_friends where user_id=?";
           $res=$this->db->query($qry,array($user_id));
           return $res->num_rows();
       }
       function edit($id){           
        $data['discussion_title']=$this->input->post('discussion_title');
        $data['cat_id']=$this->input->post('cat_id');
        $data['sub_cat_id']=$this->input->post('sub_cat_id');
        $data['tags']=$this->input->post('tags');
        $data['content']=$this->input->post('content');
        $data['created']=time();
      $this->db->update('tbl_discussion', $data, array("disc_id"=>$id));
      //echo $this->db->last_query();
       }
       function delete($id){
           $qry="delete from tbl_discussion where disc_id= '$id'";
           $this->db->query($qry);
           
       }
        function get_comment_user($user_id){
          $res=$this->db->query("select * from tbl_disc_comments where disc_id = $user_id");
         return $res;
      }
      function get_forum_titles($id){
          $qry="select discussion_title from tbl_discussion where disc_id=?";
          $res=$this->db->query($qry,array($id));
          $data=$res->row_array();
        //  echo $this->db->last_query();
          echo $data['discussion_title'];
      }
      function del_comment($id){
          $qry="delete from tbl_disc_comments where comment_id ='$id'";
          $res=$this->db->query($qry);
        //  echo $this->db->last_query();
      }
      function search_forum($f){
          $value=$f;
       $qry="SELECT * 
       FROM `tbl_discussion`
        WHERE `discussion_title` LIKE '%$value%'"; 
         $res= $this->db->query($qry);         
         
         if($res->num_rows()>0)
            return $res->result_array();
         else
             return NULL;
      }
       function count_comment($disc_id){
   $query="select * from tbl_disc_comments where disc_id =?";
        $res=$this->db->query($query,array($disc_id));

        echo $res->num_rows();
    }
    function commenter_detail($public_id){
         $qry="select m.username,md.name from tbl_mem_personal_detail md join tbl_mem m on(m.id=md.mem_id) where md.mem_id=?";
           $res=$this->db->query($qry,array($public_id));
           $data=$res->row_array();
           //echo $this->db->last_query();
           return $data;
       }
    function get_product_comments($public_id){
     $qry="select m.username,md.name,c.comment,c.user_id,p.name as product_name,p.cat_id,p.sub_cat_id, p.product_id from tbl_mem m join
tbl_mem_personal_detail md on(md.mem_id=m.id) join
tbl_product_comments c
on (c.user_id=md.mem_id) join
tbl_product p on (p.product_id=c.product_id) where c.user_id =? order by c.added_date desc";
        $res=$this->db->query($qry,array($public_id));
        return $res->result();
    }
    function compare_forum($disucssion_title){
        $disc_title=trim($disucssion_title);
        
        $qry="select discussion_title from tbl_discussion where discussion_title = ?";
        $res=$this->db->query($qry,array($disc_title));
        return $res->num_rows();
    }

    function get_disc_id($disc_title){
        $qry="select disc_id from tbl_discussion where url =?";
        $res=$this->db->query($qry,array($disc_title));
        $data=$res->row_array();
//        echo $this->db->last_query();
        return $data['disc_id'];
      
    }
    function get_link($disc_id)
    {
        $qry="select f.url,c.name  as category ,(select name from tbl_forum_category where id = f.sub_cat_id) as sub_category from tbl_forum_category c join
                tbl_discussion f on (f.cat_id=c.id) where f.disc_id=?";
        $res=$this->db->query($qry,array($disc_id));
        $data=$res->row_array();
        $link='forum/'.$data['category'].'/'.$data['sub_category'].'/'.$data['url'];
      redirect($link);
    }
    function check_name($name){
    $res=$this->db->get_where('tbl_discussion',array('discussion_title'=>$name));
        return $res->num_rows();

    }
    function get_cat_name($cat_id){
       $qry="select name from tbl_forum_category where id=?";
       $res=$this->db->query($qry,array($cat_id));
      // echo $this->db->last_query();
       $data=$res->row_array();
       return $data['name'];
    }

    function get_recipies_home(){
        $this->db->where('type','forum');
        $query=$this->db->get('tbl_contents');
        return $query->row();
    }

    function add_view222($rec_id){
        $user_id=$this->session->userdata('user_id');
        $data['recipe_id']=$recipe_id;
        $qry="insert into tbl_forum_view set forum_id ='$rec_id', user_id='$user_id'";
        $this->db->query($qry);
        return $this->db->insert_id();
    }

    function forum_view($recipe_id) {
        $this->db->where('url',$this->uri->segment(3));
        $query=$this->db->get('tbl_forum_category');
        $row=$query->row();
       $qry="SELECT count( v.forum_id ) forumcount, v.forum_id
                            FROM tbl_forum_view as v inner join tbl_discussion as d on v.forum_id=d.disc_id
                            WHERE d.sub_cat_id=$row->id and v.user_id
                            IN (
                            SELECT user_id
                            FROM `tbl_forum_view`
                            WHERE forum_id =$recipe_id
                            ) and v.forum_id<> '$recipe_id'
                            GROUP BY v.forum_id
                            ORDER BY forumcount DESC
                            LIMIT 0 , 3";
        $res=  $this->db->query($qry);
        return($res);

    }

    function get_cat_desc($url){
        $this->db->where('url',$url);
        $query=$this->db->get('tbl_forum_category');
        return $query->row();
    }

    function count_number_of_post()
    {
        $sql="select count(m.user_id) as totalPost , m.user_id from tbl_discussion_comment d left join tbl_members m on (d.user_id= m.user_id)group by m.user_id";
        $res=$this->db->query($sql);
        return $res->result_array();
        
    }
    function get_deleted_discussion()
    {
        $sql="Select * from tbl_discussion where flag='-1'";
        $res=$this->db->query($sql);
        return $res->result_array();
                     
    }
    function get_deleted_posts()
    {
        $sql="select *from tbl_discussion_comment where status='-1'";
        $res=$this->db->query($sql);
        return $res->result_array();
   }


}

?>
