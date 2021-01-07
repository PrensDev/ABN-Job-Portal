<?php

class JBSK_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // ========================================================================================== //

    // GET INFORMATION METHOD
    public function get_info() {
        $query = $this->db->query("EXEC [AUTH_FindJobseeker] @email = ?", [$this->session->email]);
        $row   = $query->row();

        $userdata = [
            'username'      => $row->firstName,
            'firstName'     => $row->firstName,
            'middleName'    => $row->middleName,
            'lastName'      => $row->lastName,
            'birthDate'     => $row->birthDate,
            'age'           => $row->age,
            'gender'        => $row->gender,
            'cityProvince'  => $row->cityProvince,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'profilePic'    => $row->profilePic,
        ];

        return $userdata;
    }
    
    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        return $this->db->query("
            EXEC [JBSK_UpdateInfo]
                @jobseekerID   = ?,
                @firstName	   = ?,
                @middleName	   = ?,
                @lastName	   = ?,
                @birthDate	   = ?,
                @gender		   = ?,
                @cityProvince  = ?,
                @contactNumber = ?
        ", [
            $this->session->id, 
            $input[ 'firstName'     ], 
            $input[ 'middleName'    ], 
            $input[ 'lastName'      ], 
            $input[ 'birthDate'     ], 
            $input[ 'gender'        ], 
            $input[ 'cityProvince'  ], 
            $input[ 'contactNumber' ], 
        ]);
    }

    // VIEW RESUME METHOD
    public function view_resume() {
        $query = $this->db->query("EXEC [JBSK_ViewResume] @jobseekerID = ?", [$this->session->id]);
        return $query->row();
    }

    // CREATE RESUME METHOD
    public function create_resume() {
        $input = $this->input->post();
        $status = $input['status'] == '' ? 0 : 1;
        return $this->db->query("
            EXEC [JBSK_CreateResume]
                @jobseekerID    = ?,
                @headline       = ?,
                @description    = ?,
                @education      = ?,
                @skills         = ?,
                @experiences    = ?,
                @resumeFlag     = ?
        ", [
            $this->session->id,
            $input[ 'headline'    ],
            $input[ 'description' ],
            $input[ 'education'   ],
            $input[ 'skills'      ],
            $input[ 'experiences' ],
            $status,
        ]);
    }

    // REMOVE RESUME METHOD
    public function remove_resume($resumeID) {
        return $this->db->query("EXEC [JBSK_RemoveResume] @resumeID = ?", [$resumeID]);
    }

    // UPDATE RESUME METHOD
    public function update_resume($resumeID) {
        $input = $this->input->post();

        $status = $input['status'] == '' ? 0 : 1;

        return $this->db->query("
            EXEC [JBSK_UpdateResume]
                @resumeID    = ?,
                @headline    = ?,
                @description = ?,
                @education   = ?,
                @skills      = ?,
                @experiences = ?,
                @resumeFlag  = ?
        ", [
            $resumeID,
            $input[ 'headline'    ],
            $input[ 'description' ],
            $input[ 'education'   ],
            $input[ 'skills'      ],
            $input[ 'experiences' ],
            $status,
        ]);
    }

    // VIEW RECENT POSTS
    public function view_recent_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_ViewRecentPosts]
                @jobseekerID = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $this->session->id,
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // VIEW ALL RECENT POSTS
    public function view_all_recent_posts() {
        return $this->db->query("EXEC [JBSK_ViewAllRecentPosts] @jobseekerID = ?", [$this->session->id]);
    }

    // SUBMIT APPLICATION
    public function submit_application() {
        $input = $this->input->post();
        return $this->db->query("
            EXEC [JBSK_SubmitApplication]
                @jobPostID = ?,
                @resumeID  = ?
        ", [
            $input['jobPostID'],
            $input['resumeID']
        ]);
    }

    // CANCEL APPLICATION
    public function cancel_application() {
        return $this->db->query("EXEC [JBSK_CancelApplication] @applicationID = ?", [$this->input->post('applicationID')]);
    }

    // ALL APPLIED JOBS
    public function all_applied_jobs($status) {
        return $this->db->query("
            EXEC [JBSK_AllAppliedJobs] 
                @jobseekerID = ?,
                @status      = ?
        ", [
            $this->session->id,
            $status,
        ]);
    }

    // APPLIED JOBS
    public function applied_jobs($status, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_AppliedJobs]
                @offsetRows  = ?,
                @fetchedRows = ?,
                @jobseekerID = ?,
                @status      = ?
        ", [
            $offsetRows,
            $fetchedRows,
            $this->session->id,
            $status,
        ]);
        return $query->result();
    }

    // NUMBER OF APPLIED JOBS
    public function applied_jobs_num() {
        $query = $this->db->query("EXEC [JBSK_NumOfAppliedJobs] @jobseekerID = ?", [$this->session->id]);
        $row = $query->row();
        return $row->appliedJobsNum;
    }

    // ADD BOOKMARK
    public function add_bookmark($jobPostID) {
        return $this->db->query("
            EXEC [JBSK_AddBookmark] 
                @jobseekerID = ?,
                @jobPostID   = ?
        ", [
            $this->session->id,
            $jobPostID,
        ]);
    }

    // REMOVE BOOKMARK
    public function remove_bookmark($bookmarkID) {
        return $this->db->query("EXEC [JBSK_RemoveBookmark] @bookmarkID = ?", [$bookmarkID]);
    }

    // GET ALL BOOKMARKS
    public function get_all_bookmarks() {
        return $this->db->query("EXEC [JBSK_GetAllBookmarks] @jobseekerID = ?", [$this->session->id]);
    }

    // GET BOOKMARKS
    public function get_bookmarks($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_GetBookmarks]
                @jobseekerID = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $this->session->id,
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // NUMBER OF BOOKMARKS
    public function bookmarks_num() {
        $query = $this->db->query("EXEC [JBSK_NumOfBookmarks] @jobseekerID = ?", [$this->session->id]);
        $row   = $query->row();
        return $row->bookmarksNum;
    }

    // VIEW JOB DETAILS
    public function job_details($jobPostID) {
        $query = $this->db->query("
            EXEC [JBSK_ViewJobDetails] 
                @jobPostID   = ?,
                @jobseekerID = ?
        ", [
            $jobPostID,
            $this->session->id,
        ]);
        return $query->row();
    }

    // SET PROFILE PICTURE
    public function set_profile_pic($imgName) {
        $this->db->query("
            EXEC [JBSK_SetProfilePic]
                @jobseekerID = ?,
                @profilePic  = ?
        ", [
            $this->session->id,
            $imgName,
        ]);
    }

    // VIEW AVAILABLE JOBS
    public function view_available_jobs($employerID, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_ViewAvailableJobs]
                @jobseekerID = ?,
                @employerID  = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $this->session->id,
            $employerID,
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // VIEW ALL SEARCH RESULT
    public function view_all_search_result() {
        return $this->db->query("
            EXEC [JBSK_ViewAllSearchResult]
                @jobTitle    = ?,
                @location    = ?,
                @jobseekerID = ?
        ", [
            $this->input->get('keyword'),
            $this->input->get('place'),
            $this->session->id, 
        ]);
    }

    // VIEW SEARCH RESULT
    public function view_search_result($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_ViewSearchResult]
                @jobTitle    = ?,
                @location    = ?,
                @jobseekerID = ?,
                @offsetRows  = ?,
                @fetchedRows = ?
        ", [
            $this->input->get('keyword'),
            $this->input->get('place'),
            $this->session->id, 
            $offsetRows,         
            $fetchedRows,                
        ]);
        return $query->result();
    }
}