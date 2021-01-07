<?php

class VIEW_model extends CI_Model {

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
            @offsetRows  = ?, 
            @fetchedRows = ?
        ", [
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // VIEW JOB MODELS
    public function job_details($jobPostID) {
        $query = $this->db->query("EXEC [VIEW_JobDetails] @jobPostID = ?", [$jobPostID]);
        return $query->row();
    }

    // VIEW COMPANY DETAILS
    public function company_details($employerID) {
        $query = $this->db->query("EXEC [VIEW_CompanyDetails] @employerID = ?",[$employerID]);
        return $query->row();
    }

    // VIEW ALL AVAILABLE JOBS
    public function all_available_jobs($employerID) {
        return $this->db->query("EXEC [VIEW_AllAvailableJobs] @employerID = ?", [$employerID]);
    }

    // VIEW AVAILABLE JOBS
    public function available_jobs($employerID, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [VIEW_AvailableJobs]
                @employerID  = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $employerID,
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // VIEW ALL RESEARCH RESULT
    public function all_search_result() {
        return $this->db->query("
            EXEC [VIEW_AllSearchResult] 
                @jobTitle = ?,
                @location = ?
        ", [
            $this->input->get('keyword'),
            $this->input->get('place'),
        ]);
    }

    // VIEW SEARCH RESULT
    public function search_result($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [VIEW_SearchResult] 
                @jobTitle    = ?,
                @location    = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $this->input->get('keyword'),
            $this->input->get('place'),
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }
}