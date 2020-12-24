<?php

class Jobseeker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    protected function run_query($sql, $successPath) {
        if (! $this->db->query($sql) ) {
            echo $this->db->error();
        } else {
            redirect($successPath);
        }
    }


    // GET INFORMATION METHOD
    public function get_info() {
        $sql   = "EXEC [AUTH_FindJobseeker] @email = '" . $this->session->email . "'";
        $query = $this->db->query($sql);
        $row   = $query->row();

        $location = $row->brgyDistrict . ', ' . $row->cityMunicipality;

        $userdata = [
            'username'         => $row->firstName,
            'firstName'        => $row->firstName,
            'middleName'       => $row->middleName,
            'lastName'         => $row->lastName,
            'birthDate'        => $row->birthDate,
            'age'              => $row->age,
            'gender'           => $row->gender,
            'street'           => $row->street,
            'brgyDistrict'     => $row->brgyDistrict,
            'cityMunicipality' => $row->cityMunicipality,
            'location'         => $location,
            'contactNumber'    => $row->contactNumber,
            'email'            => $row->email,
            'description'      => $row->description,
            'skills'           => $row->skills,
            'experiences'      => $row->experiences,
            'education'        => $row->education,
        ];

        return $userdata;
    }


    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        $this->run_query("
            EXEC [JBSK_UpdateInfo]
                @jobseekerID	  = '" . $this->session->id . "',
                @firstName		  = '" . $input[ 'firstName'        ] . "',
                @middleName		  = '" . $input[ 'middleName'       ] . "',
                @lastName		  = '" . $input[ 'lastName'         ] . "',
                @birthDate		  = '" . $input[ 'birthDate'        ] . "',
                @gender			  = '" . $input[ 'gender'           ] . "',
                @street			  = '" . $input[ 'street'           ] . "',
                @brgyDistrict	  = '" . $input[ 'brgyDistrict'     ] . "',
                @cityMunicipality = '" . $input[ 'cityMunicipality' ] . "',
                @contactNumber	  = '" . $input[ 'contactNumber'    ] . "',
                @description	  = '" . $input[ 'description'      ] . "',
                @skills			  = '" . $input[ 'skills'           ] . "',
                @experiences	  = '" . $input[ 'experiences'      ] . "',
                @education		  = '" . $input[ 'education'        ] . "'
        ", 'auth/information');
    }


    // SUBMIT APPLICATION
    public function submit_application($jobPostID) {
        return $this->db->query("
            EXEC [JBSK_SubmitApplication]
                @jobPostID   = " . $jobPostID . ",
                @jobseekerID = " . $this->session->id ."
        ");
    }


    // CANCEL APPLICATION
    public function cancel_application($jobPostID) {
        return $this->db->query("
            EXEC [JBSK_CancelApplication]
                @jobPostID   = " . $jobPostID . ",
                @jobseekerID = " . $this->session->id ."
        ");
    }


    // IS JOB APPLIED
    public function is_job_applied($jobPostID) {
        $query = $this->db->query("
            EXEC [JBSK_IsJobApplied]
                @jobPostID   = " . $jobPostID . ",
                @jobseekerID = " . $this->session->id . "
        ");

        return $query->row();
    }


    // ALL APPLIED JOBS
    public function all_applied_jobs() {
        return $this->db->query("EXEC [JBSK_AllAppliedJobs] @jobseekerID = " . $this->session->id);
    }


    // APPLIED JOBS
    public function applied_jobs($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_AppliedJobs]
                @offsetRows     = " . $offsetRows . ",
                @fetchedRows    = " . $fetchedRows . ",
                @jobseekerID    = " . $this->session->id . "
        ");

        return $query->result();
    }

    // NUMBER OF APPLIED JOBS
    public function applied_jobs_num() {
        $query = $this->db->query("EXEC [JBSK_NumOfAppliedJobs] @jobseekerID = " . $this->session->id);
        $row = $query->row();
        return $row->appliedJobsNum;
    }


    // ADD BOOKMARK
    public function add_bookmark() {
        
    }
}