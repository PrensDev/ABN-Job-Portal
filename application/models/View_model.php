<?php

class View_model extends CI_Model {

    
    // __CONSTRUCTOR
    public function __construct() {
        $this->load->database();
    }


    // VIEW RECENT POSTS
    public function recent_posts() {
        $query = $this->db->query("EXEC [VIEW_RecentPosts]");
        return $query->result();
    }


    // VIEW JOB MODELS
    public function job_details($jobPostID) {
        $query = $this->db->query("EXEC [VIEW_JobDetails] @jobPostID = " . $jobPostID);

        if ($query->num_rows() == 1) {
            $row = $query->row();
            
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
                'employerID'       => $row->employerID,
                'companyName'      => $row->companyName,
                'location'         => $row->location,
                'contactNumber'    => $row->contactNumber,
                'email'            => $row->email,
                'website'          => $row->website,
            ];
            return $jobDetails;
        } else {
            return FALSE;
        }
    }


    // VIEW COMPANY DETAILS
    public function company_details($employerID) {
        $query = $this->db->query("EXEC [VIEW_CompanyDetails] @employerID = " . $employerID);
        $row = $query->row();

        $companyDetails = [
            'employerID'    => $row->employerID,
            'companyName'   => $row->companyName,
            'description'   => $row->description,
            'location'      => $row->location,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'website'       => $row->website,
        ];

        return $companyDetails;
    }


    // VIEW COMPANY AVAILABLE JOBS
    public function available_jobs() {

    }
}