<?php

class MAIN_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // RETURNS THE COUNT OF THE QUERY
    private function query_count($query, $values = []) {
        $qry = $this->db->query($query, $values);
        $row = $qry->row();
        return $row->count;
    }

    // GET NUMBER OF RECENT POSTS
    public function recent_posts_num() {
        return $this->query_count("EXEC [MAIN_RecentPostsNum]");
    }

    // VIEW RECENT POSTS
    public function recent_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("EXEC [MAIN_RecentPosts] 
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
        $query = $this->db->query("EXEC [MAIN_JobDetails] @jobPostID = ?", [$jobPostID]);
        return $query->row();
    }

    // VIEW COMPANY DETAILS
    public function company_details($employerID) {
        $query = $this->db->query("EXEC [MAIN_CompanyDetails] @employerID = ?",[$employerID]);
        return $query->row();
    }

    // GET NUMBER OF AVAILABLE JOBS
    public function available_jobs_num($employerID) {
        return $this->query_count("EXEC [MAIN_AvailableJobsNum] @employerID = ?", [$employerID]);
    }

    // VIEW AVAILABLE JOBS
    public function available_jobs($employerID, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [MAIN_AvailableJobs]
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

    // GET NUMBER OF RESEARCH RESULT
    public function search_result_num() {
        return $this->query_count("
            EXEC [MAIN_SearchResultNum] 
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
            EXEC [MAIN_GetSearchResult] 
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