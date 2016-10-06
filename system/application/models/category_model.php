<?php
class Category_model extends Model {

    function Category_model() {
        parent::Model();
    }

    function get_all_categories($parent_id,$sort_field,$sort_order) {
        $options=array('parent_id'=>$parent_id);
        $this->db->orderby($sort_field,$sort_order);
        $query = $this->db->getwhere('tbl_categories',$options);

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    // this breadcrum for ADMIN SECTION
    function get_bread_crumb($parent_id) {
        $data=$this->get_cat_id_info($parent_id);
        $bdc=anchor(site_url(ADMIN_PATH.'/categories/categories_list/'.$data[0]['id'].'/name/ASC'),$data[0]['name']);
        if($data[0]['cat_level']==0)
            $bdc=$bdc;

        if($data[0]['cat_level']==1) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $bdc =anchor(site_url(ADMIN_PATH.'/categories/categories_list/'.$parent_cat[0]['id'].'/name/ASC'),$parent_cat[0]['name'])."->".$bdc;
        }

        if($data[0]['cat_level']==2) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $grand_parent=$this->get_cat_id_info($parent_cat[0]['parent_id']);
            $bdc =anchor(site_url(ADMIN_PATH.'/categories/categories_list/'.$grand_parent[0]['id'].'/name/ASC'),$grand_parent[0]['name'])."->".anchor(site_url(ADMIN_PATH.'/categories/categories_list/'.$parent_cat[0]['id'].'/name/ASC'),$parent_cat[0]['name'])."->".$bdc;
        }

        return $bdc;

    }

    // this breadcrum for Front web site
    function bread_crumb($parent_id) {
        $data=$this->get_cat_id_info($parent_id);
        $bdc=$data[0]['name'];

        if($data[0]['cat_level']==0)
            $bdc=$bdc;

        if($data[0]['cat_level']==1) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $bdc =$parent_cat[0]['name']."->".$bdc;
        }

        if($data[0]['cat_level']==2) {
            $parent_cat=$this->get_cat_id_info($data[0]['parent_id']);
            $grand_parent=$this->get_cat_id_info($parent_cat[0]['parent_id']);
            $bdc =$grand_parent[0]['name']."->".$parent_cat[0]['name']."->".$bdc;
        }

        return $bdc;

    }

    function get_cat_id_info($id) {
        $data=array();
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_categories',$options,1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[]=array('id'=>$rows['id'],'name'=>$rows['name'],
                    'category_image'=>$rows['category_image'],
                    'category_description'=>$rows['category_description'],
                    'cpc'=>$rows['cpc'],
                    'parent_id'=>$rows['parent_id'],
                    'cat_level'=>$rows['cat_level'],
                    'sort_order'=>$rows['sort_order'],
                    'flag'=>$rows['flag']);
            }

            $query->free_result();
            return $data;
        }
    }

    function get_sub_id($id) {
        $options=array('parent_id'=>$id);
        $query = $this->db->getwhere('tbl_categories',$options,1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data[]=array('id'=>$rows['id'],'name'=>$rows['name']);
            }

            $query->free_result();
            return $data;
        }

    }

    function get_parent_id($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_categories',$options,1);
        return $query->row();

    }


    function get_cat_level($id) {
        $options=array('id'=>$id);
        $query = $this->db->getwhere('tbl_categories',$options,1);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $rows) {
                $data=$rows['cat_level'];
            }

            $query->free_result();
            return $data;
        }
    }

    function add_category($filename) {
        if($this->get_cat_level($this->input->post('parent_id',TRUE))=="")
            $cat_level=0;
        else
            $cat_level=$this->get_cat_level($this->input->post('parent_id',TRUE))+1;

        $data=array('name'=>$this->input->post('category_name',TRUE),'category_image'=>$filename,'category_description'=>$this->input->post('category_description',TRUE),'cpc'=>$this->input->post('cpc',TRUE),'sort_order'=>$this->input->post('sort_order',TRUE),
            'flag'=>$this->input->post('cat_status',TRUE),'parent_id'=>$this->input->post('parent_id',TRUE),'cat_level'=>$cat_level);
        $this->db->insert('tbl_categories',$data);
    }

    function edit_category() {
        $sort_order=$this->input->post('cat_sort_order',TRUE);
        $data=array('name'=>$this->input->post('cat_name',TRUE),
            'category_image'=>$_FILES['category_image']['name'],
            'category_description'=>$this->input->post('category_description',TRUE),
            'cpc'=>$this->input->post('cpc',TRUE),
            'flag'=>$this->input->post('cat_status',TRUE),
            'sort_order'=>$sort_order);
        $this->db->where('id',$this->input->post('cat_id',TRUE));
        $this->db->update('tbl_categories',$data);
    }

    // Functions for the front website ----------------------------
    function get_categories() {
        $sql = "select * from tbl_categories where parent_id='0' and flag='1' order by name asc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else return false;
    }

    function get_categories_ext($idCsv) {
        $sql = "select * from tbl_categories where parent_id='0' and flag='1' and id NOT IN ($idCsv) order by name asc ";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else return false;
    }


    function check_sub_category($id) {
        $sql = "SELECT * FROM tbl_categories WHERE parent_id=?";

        $query = $this->db->query($sql,array($id));

        return $query->num_rows();
    }

    function get_sub_categories($parent_id) {
        $sql = "select * from tbl_categories where parent_id=? order by name";
        $query = $this->db->query($sql,array($parent_id));
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        else return null;
        
    }
    function get_sub_categories_sponsor($parent_id)
    {
        $sql="select c.* from tbl_categories c join tbl_quizes q on c.id=q.category_id where c.parent_id=? and q.user_type='advertiser' and q.status='1' group by c.name ";
        $query=$this->db->query($sql,array($parent_id));
       if ($query->num_rows() > 0) {
            return $query->result();
        }
        else return null;
    }

    function count_products_by_category($cat_id) {
        $options=array('cat_id'=>$cat_id,'auction_status'=>'open');
        $query = $this->db->getwhere('tbl_products',$options);
        return $query->num_rows();
    }

    function get_category_by_id($cat_id) {
        $this->db->where('id',$cat_id);
        $query=$this->db->get('tbl_categories');
        return $query->row();
    }

    function get_four_categories($category_name) {
        $this->db->where('name',$category_name);
        $query = $this->db->get('tbl_categories');
        if($query->num_rows()>0)
            return $query->row();
        else return null;
    }

    function get_category_award_info_by_cid($category_id){
        $sql= "select * from tbl_member_category_titles mct, tbl_categories c, tbl_category_titles ct where mct.category_id=c.id and mct.category_titles=ct.id and mct.category_id='$category_id'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function check_award($user_id,$award){ 
        $this->db->where('user_id',$user_id);
        $this->db->where('award_link_name',$award);
        $query = $this->db->get('tbl_member_awards');
        if($query->num_rows()>0)
        return $query->row()->id;
        else return null;
    }

    function insertCategoryPoints($user_id,$category_id,$point){  //echo $user_id.'/'.$category_id.'/'.$point; exit;
        $this->db->where('user_id',$user_id);
        $this->db->where('category_id',$category_id);
        $query = $this->db->get('tbl_member_category_titles');
        if($query->num_rows()>0){ //echo 'test';exit;
            $result = $query->row();
             $award_info = $this->get_category_award_info_by_cid($result->category_id);
             //print_r($award_info);
            $category_award = $award_info->name.'_'.$award_info->category_title;
            $award_id = $this->check_award($user_id,$category_award);
            
            $query1 = $this->db->get('tbl_category_titles');
            if($query1->num_rows()>0){
                $category_title_info = $query1->result();
                foreach($category_title_info as $category_titles){
                    $category_title_point = explode('-',$category_titles->points);
                    if($result->points>=$category_title_point[0] && $result->points<=$category_title_point[1]){
                        $this->db->where('user_id',$user_id);
                        $this->db->where('category_id',$category_id);
                        $data = array('category_titles'=>$category_titles->id,
                            'points'=>$result->points+$point
                        );

                        $this->db->update('tbl_member_category_titles',$data);
                        //echo $category_id;
                        $latest_award_info =$this->get_category_award_info_by_cid($category_id);
                        //echo "<pre>".print_r($latest_award_info)."</pre>";
                        //echo $latest_award_info->name; exit;
                        if($award_id){
                            $award_info = $this->get_category_award_info_by_cid($category_id);
                            $this->db->where('id',$award_id);
                            $array = array('award_link_name'=>$latest_award_info->name.'_'.$latest_award_info->category_title);
                            $this->db->update('tbl_member_awards',$array);
                        }

                        else {
                            $this->db->insert('tbl_member_awards',array('user_id'=>$user_id,'award_link_name'=>$latest_award_info->name.'_'.$latest_award_info->category_title,'date'=>current_date_time_stamp()));
                        }
                    }
                }
            }
        }
        else{ //echo "hello";exit;
            $data = array('user_id'=>$user_id,
                            'category_id'=>$category_id,
                            'category_titles'=>'1',
                            'points'=>$result->points+$point
                        );
                        $this->db->insert('tbl_member_category_titles',$data);
                        
                        $latest_award_info1 =$this->get_category_award_info_by_cid($category_id);
                        //echo "<pre>".print_r($latest_award_info1)."</pre>";
                        //echo $latest_award_info->name;exit;
                        $this->db->insert('tbl_member_awards',array('user_id'=>$user_id,'award_link_name'=>$latest_award_info1->name.'_'.$latest_award_info1->category_title,'date'=>current_date_time_stamp()));
        }
    }

    function get_member_category_titles($user_id){
      $sql ="select * from tbl_member_category_titles mct, tbl_category_titles ct, tbl_categories c where mct.category_titles=ct.id and mct.category_id=c.id and mct.user_id='$user_id'";
      $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

    function get_member_category_rank_per_category($user_id,$cid=''){
        if($cid!='')
        $sql ="select mct.category_titles,mct.points as total_points,ct.category_title
        from tbl_member_category_titles mct, tbl_category_titles ct, tbl_categories c
        where mct.category_titles=ct.id
        and mct.category_id=c.id
        and mct.user_id='$user_id'
        and mct.category_id = '$cid'";
        else
        $sql ="select p.total_points from tbl_position p where p.user_id='$user_id'";
       
      $query = $this->db->query($sql);
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function insert_category_titles(){
        $data = array('category_title'=>$this->input->post('category_title',TRUE),
            'points'=>$this->input->post('points',TRUE)
        );
        $query = $this->db->insert('tbl_category_titles',$data);
        if($query) return true;
        else return false;
    }

    function get_category_titles($sort_field,$sort_order){
        $this->db->orderby($sort_field,$sort_order);
        $query = $this->db->get('tbl_category_titles');
        if($query->num_rows()>0)
        return $query->result();
        else return null;
    }

     function get_category_title_info($cat_title_id){
        $this->db->where('id',$cat_title_id);
        $query = $this->db->get('tbl_category_titles');
        if($query->num_rows()>0)
        return $query->row();
        else return null;
    }

    function edit_category_titles(){
        $cat_title_id = $this->input->post('cat_title_id',TRUE);
        $data = array('category_title'=>$this->input->post('category_title',TRUE),
            'points'=>$this->input->post('points',TRUE)
        );
        $this->db->where('id',$cat_title_id);
        $query = $this->db->update('tbl_category_titles',$data);
        if($query) return true;
        else return false;
    }

    function get_category_id_from_name($cname){
        $this->db->where('name',$cname);
        $query = $this->db->get('tbl_categories');
        if($query->num_rows()>0)
        return $query->row()->id;
        else return null;
    }


}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */