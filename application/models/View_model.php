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
        return $query->row();
    }

    // VIEW COMPANY DETAILS
    public function company_details($employerID) {
        $query = $this->db->query("EXEC [VIEW_CompanyDetails] @employerID = " . $employerID);
        return $query->row();
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