<?php

class View_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }


    public function view_recent_posts() {
        $query = $this->db->query("EXEC [ViewRecentPosts]");
        return $query->result();
    }

    public function view_job_details($jobPostID) {
        $query = $this->db->query("EXEC [ViewJobDetails] @jobPostID = " . $jobPostID);

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

    public function view_company_details($employerID) {
        $query = $this->db->query("EXEC [ViewCompanyDetails] @employerID = " . $employerID);
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
}