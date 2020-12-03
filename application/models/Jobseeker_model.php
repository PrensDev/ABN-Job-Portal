<?php

class Jobseeker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_jobseekers() {
        $query = $this->db->get('JobSeekers');
        return $query->result_array();
    }

}