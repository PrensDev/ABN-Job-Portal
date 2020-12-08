<?php

class Employer_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    protected function get_row($sql) {
        $query = $this->db->query($sql);
        if (! $query) {
            die($this->db->error());
        } else {
            return $query->row();
        }
    }

    protected function run_query($sql, $successPath) {
        if (! $this->db->query($sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/' . $successPath);
        }
    }

    public function get_info() {
        $row = $this->get_row("EXEC [FindEmployer] @email = '" . $this->session->email . "'");

        $location = $row->brgyDistrict . ', ' . $row->cityMunicipality;

        $userdata = [
            'username'      => $row->companyName,
            'location'      => $location,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'website'       => $row->website,
            'description'   => $row->description,
        ];

        return $userdata;
    }

    public function post_new_job() {
        $status = $this->input->post('status') == '' ? 0 : 1;

        $this->run_query("
            EXEC [PostNewJob]
                @employerID		  = '" . $this->session->id                       . "',
                @jobTitle		  = '" . $this->input->post( 'jobTitle'         ) . "',
                @jobType		  = '" . $this->input->post( 'jobType'          ) . "',
                @industryType	  = '" . $this->input->post( 'industryType'     ) . "',
                @description	  = '" . $this->input->post( 'description'      ) . "',
                @responsibilities = '" . $this->input->post( 'responsibilities' ) . "',
                @skills			  = '" . $this->input->post( 'skills'           ) . "',
                @experiences	  = '" . $this->input->post( 'experiences'      ) . "',
                @education		  = '" . $this->input->post( 'education'        ) . "',
                @minSalary		  = '" . $this->input->post( 'minSalary'        ) . "',
                @maxSalary		  = '" . $this->input->post( 'maxSalary'        ) . "',
                @jobPostFlag	  =  " . $status                                  . "
        ", 'job_posts');
    }

    public function get_job_details($jobPostID) {
        $row = $this->get_row("EXEC [ViewJobPost] @jobPostID = " . $jobPostID);

        $jobDetails = [
            'jobPostID'        => $row->jobPostID,
            'jobTitle'         => $row->jobTitle,
            'jobType'          => $row->jobType,
            'industryType'     => $row->industryType,
            'description'      => $row->description,
            'responsibilities' => $row->responsibilities,
            'skills'           => $row->skills,
            'experiences'      => $row->experiences,
            'education'        => $row->education,
            'minSalary'        => $row->minSalary,
            'maxSalary'        => $row->maxSalary,
            'dateCreated'      => $row->dateCreated,
            'dateModified'     => $row->dateModified,
            'status'           => $row->status,
        ];

        return $jobDetails;
    }

    public function update_job_post($input, $jobPostID) {
        $status = $input['status'] == '1' ? 1 : 0;
        $this->run_query("
            EXEC [UpdateJobPost]
                @jobPostID			= '" . $jobPostID . "',
                @jobTitle			= '" . $input[ 'jobTitle'         ] . "',
                @jobType			= '" . $input[ 'jobType'          ] . "',
                @industryType		= '" . $input[ 'industryType'     ] . "',
                @description		= '" . $input[ 'description'      ] . "',
                @responsibilities	= '" . $input[ 'responsibilities' ] . "',
                @skills				= '" . $input[ 'skills'           ] . "',
                @experiences		= '" . $input[ 'experiences'      ] . "',
                @education			= '" . $input[ 'education'        ] . "',
                @minSalary			= '" . $input[ 'minSalary'        ] . "',
                @maxSalary			= '" . $input[ 'maxSalary'        ] . "',
                @jobPostFlag		=  " . $status . "
        ", 'job_posts/' . $jobPostID);
    }

    public function delete_post($jobPostID) {
        $this->run_query("EXEC [DeleteJobPost] @jobPostID = " . $jobPostID, 'job_posts');
    }
}