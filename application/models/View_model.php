<?php

class View_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }


    public function view_recent_posts() {
        $query = $this->db->query("EXEC [ViewRecentPosts]");
        return $query->result();
    }

}