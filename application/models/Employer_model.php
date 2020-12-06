<?php

class Employer_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function post_new_job() {
        if ( $this->input->post('status') == '' ) {
            $status = 0;
        } else {
            $status = 1;
        }

        $PostNewJob_sql = "
            EXEC [PostNewJob]
                @employerID			= '" . $this->session->id                         . "',
                @jobTitle			= '" . $this->input->post( 'jobTitle'           ) . "',
                @jobType			= '" . $this->input->post( 'jobType'            ) . "',
                @industryType		= '" . $this->input->post( 'industryType'       ) . "',
                @description		= '" . $this->input->post( 'description'        ) . "',
                @responsibilities	= '" . $this->input->post( 'responsibilities'   ) . "',
                @skills				= '" . $this->input->post( 'skills'             ) . "',
                @experiences		= '" . $this->input->post( 'experiences'        ) . "',
                @education			= '" . $this->input->post( 'education'          ) . "',
                @minSalary			= '" . $this->input->post( 'minSalary'          ) . "',
                @maxSalary			= '" . $this->input->post( 'maxSalary'          ) . "',
                @jobPostFlag		=  " . $status                                    . "
        ";

        if (! $this->db->query($PostNewJob_sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/job_posts');
        }
    }
}