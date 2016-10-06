<?

class Gameboard_model extends Model {

    function Gameboard_model() {
        parent::Model();
    }

    function getPremiumgameBoards($id=0) {
//            if($num==0 && $offset==0)
//            $limit='';
//            else
//            $limit=" LIMIT $offset,$num";
        if ($id == 0)
            $sql = "Select * From tbl_gameboard where board_type='premium' order by id DESC";
        else
            $sql = "Select * From tbl_gameboard where board_type='premium' and id=? order by id DESC ";
        if ($id == 0)
            $query = $this->db->query($sql);
        else
            $query = $this->db->query($sql, array($id));
        //print_r($query->result());
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function getFreeGameBoards($id=0) {
//            if($num==0 && $offset==0)
//            $limit='';
//            else
//            $limit=" LIMIT $offset,$num";
        if ($id == 0)
            $sql = "Select * From tbl_gameboard where board_type='free' order by id DESC";
        else
            $sql = "Select * From tbl_gameboard where board_type='free' and id=? order by id DESC ";
        if ($id == 0)
            $query = $this->db->query($sql);
        else
            $query = $this->db->query($sql, array($id));
        //print_r($query->result());
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function getMemberGameboard($user_id) {
        $sql = "Select * From tbl_user_gameboard ug where ug.user_id=? ";
        $query = $this->db->query($sql, array($user_id));
        return $query->row();
    }

    function insertGameboard($board_image) {
        $user_id = $this->session->userdata('wannaquiz_user_id');

        if ($this->gameboardExist($user_id) == 0) {
            $data = array('gameboard_id' => 1,
                'user_id' => $user_id,
                'user_board_image' => $board_image,
                'created_date' => current_date_time_stamp());
            $this->db->insert('tbl_user_gameboard', $data);
        } else {
            $this->updateGameboard($board_image);
        }
    }

    function updateGameboard($board_image) {
        $data = array('user_board_image' => $board_image,
            'created_date' => current_date_time_stamp());
        $this->db->where("user_id", $this->session->userdata('wannaquiz_user_id'));
        $this->db->update('tbl_user_gameboard', $data);
    }

    function gameboardExist($user_id) {
        $sql = "Select * From tbl_user_gameboard  where user_id=? ";
        $query = $this->db->query($sql, array($user_id));
        return $query->num_rows();
    }

    // Admin Funstions -----------------------------------------------------

    function get_all_gameboards_info($sort_field, $sort_order, $num, $offset) {
        if ($num == 0 && $offset == 0)
            $limit = "";
        else
            $limit=" LIMIT $offset,$num";
        $orderby = " ORDER BY $sort_field $sort_order";

        $sql = "Select * From tbl_gameboard order by id DESC $limit";
        $query = $this->db->query($sql);


        if ($query->num_rows() > 0)
            return $query->result();
        else
            return NULL;
    }

    function get_gameboard_info_by_id($board_id) {
        $sql = "Select * From tbl_gameboard where id=?";
        $query = $this->db->query($sql,array($board_id));
        return $query->row();
    }

    function insert($board_picture) {
        $data = array('board_name' => $this->input->post('board_name',TRUE),
            'board_type' => $this->input->post('board_type',TRUE),
            'board_image' => $board_picture,
            'board_price' => $this->input->post('board_price',TRUE),
            'shipping_cost' => $this->input->post('shipping_cost',TRUE));
        $this->db->insert('tbl_gameboard', $data);
    }

    function edit($board_picture) {
        $data = array('board_name' => $this->input->post('board_name',TRUE),
            'board_type' => $this->input->post('board_type',TRUE),
            'board_image' => $board_picture,
            'board_price' => $this->input->post('board_price',TRUE),
            'shipping_cost' => $this->input->post('shipping_cost',TRUE));
        $this->db->where('id', $this->input->post('id',TRUE));
        $this->db->update('tbl_gameboard', $data);
    }

}

?>