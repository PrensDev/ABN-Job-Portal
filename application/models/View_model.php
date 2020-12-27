<?php

class View_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // ALL RECENT POSTS
    public function all_recent_posts() {
        return $this->db->query("EXEC [VIEW_AllRecentPosts]");
    }

    // VIEW RECENT POSTS
    public function recent_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("EXEC [VIEW_RecentPosts] 
            @offsetRows  = " . $offsetRows  . ", 
            @fetchedRows = " . $fetchedRows ."
        ");
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
                'profilePic'       => $row->profilePic,
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
        $row   = $query->row();

        $companyDetails = [
            'employerID'    => $row->employerID,
            'profilePic'    => $row->profilePic,
            'companyName'   => $row->companyName,
            'description'   => $row->description,
            'location'      => $row->location,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'website'       => $row->website,
        ];
        return $companyDetails;
    }

    // VIEW ALL AVAILABLE JOBS
    public function all_available_jobs($employerID) {
        return $this->db->query("EXEC [VIEW_AllAvailableJobs] @employerID = " . $employerID);
    }

    // VIEW AVAILABLE JOBS
    public function available_jobs($employerID, $offsetRows, $fetchedRows   ) {
        $query = $this->db->query("
            EXEC [VIEW_AvailableJobs]
                @employerID  = " . $employerID  . ",
                @offsetRows  = " . $offsetRows  . ",
                @fetchedRows = " . $fetchedRows . "
        ");
        return $query->result();
    }
}