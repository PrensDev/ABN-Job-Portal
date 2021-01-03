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

    // ========================================================================================== //

    // GET INFORMATION METHOD
    public function get_info() {
        $query = $this->db->query("EXEC [AUTH_FindJobseeker] @email = '" . $this->session->email . "'");
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

    // VIEW RESUME METHOD
    public function view_resume() {
        $query = $this->db->query("EXEC [JBSK_ViewResume] @jobseekerID = " . $this->session->id);
        return $query->row();
    }

    // CREATE RESUME METHOD
    public function create_resume() {
        $input = $this->input->post();

        $status = $input['status'] == '' ? 0 : 1;
        
        $this->db->query("
            EXEC [JBSK_CreateResume]
                @jobseekerID    =  " . $this->session->id . ",
                @headline       = '" . $input[ 'headline'    ] . "',
                @description    = '" . $input[ 'description' ] . "',
                @education      = '" . $input[ 'education'   ] . "',
                @skills         = '" . $input[ 'skills'      ] . "',
                @experiences    = '" . $input[ 'experiences' ] . "',
                @resumeFlag     =  " . $status . "
        ");
    }

    // REMOVE RESUME METHOD
    public function remove_resume($resumeID) {
        $this->db->query("EXEC [JBSK_RemoveResume] @resumeID = " . $resumeID);
    }

    // UPDATE RESUME METHOD
    public function update_resume($resumeID) {
        $input = $this->input->post();

        $status = $input['status'] == '' ? 0 : 1;

        $this->db->query("
            EXEC [JBSK_UpdateResume]
                @resumeID    =  " . $resumeID . ",
                @headline    = '" . $input[ 'headline'    ] . "',
                @description = '" . $input[ 'description' ] . "',
                @education   = '" . $input[ 'education'   ] . "',
                @skills      = '" . $input[ 'skills'      ] . "',
                @experiences = '" . $input[ 'experiences' ] . "',
                @resumeFlag  =  " . $status . "
        ");
    }

    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        $this->db->query("
            EXEC [JBSK_UpdateInfo]
                @jobseekerID   =  " . $this->session->id . ",
                @firstName	   = '" . $input[ 'firstName'     ] . "',
                @middleName	   = '" . $input[ 'middleName'    ] . "',
                @lastName	   = '" . $input[ 'lastName'      ] . "',
                @birthDate	   = '" . $input[ 'birthDate'     ] . "',
                @gender		   = '" . $input[ 'gender'        ] . "',
                @cityProvince  = '" . $input[ 'cityProvince'  ] . "',
                @contactNumber = '" . $input[ 'contactNumber' ] . "'
        ");
    }

    // VIEW RECENT POSTS
    public function view_recent_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_ViewRecentPosts]
                @jobseekerID = " . $this->session->id . ",
                @offsetRows  = " . $offsetRows . ",
                @fetchedRows = " . $fetchedRows . "
        ");
        return $query->result();
    }

    // VIEW ALL RECENT POSTS
    public function view_all_recent_posts() {
        return $this->db->query("EXEC [JBSK_ViewAllRecentPosts] @jobseekerID = " . $this->session->id);
    }

    // SUBMIT APPLICATION
    public function submit_application() {
        $input = $this->input->post();
        return $this->db->query("
            EXEC [JBSK_SubmitApplication]
                @jobPostID = " . $input['jobPostID'] . ",
                @resumeID  = " . $input['resumeID'] ."
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
    public function add_bookmark($jobPostID) {
        return $this->db->query("
            EXEC [JBSK_AddBookmark] 
                @jobseekerID = " . $this->session->id . ",
                @jobPostID   = " . $jobPostID . "
        ");
    }

    // REMOVE BOOKMARK
    public function remove_bookmark($bookmarkID) {
        return $this->db->query("EXEC [JBSK_RemoveBookmark] @bookmarkID = " . $bookmarkID);
    }

    // GET ALL BOOKMARKS
    public function get_all_bookmarks() {
        return $this->db->query("EXEC [JBSK_GetAllBookmarks] @jobseekerID = " . $this->session->id);
    }

    // GET BOOKMARKS
    public function get_bookmarks($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_GetBookmarks]
                @jobseekerID = " . $this->session->id . ",
                @offsetRows  = " . $offsetRows . ",
                @fetchedRows = " . $fetchedRows . "
        ");
        return $query->result();
    }

    // NUMBER OF BOOKMARKS
    public function bookmarks_num() {
        $query = $this->db->query("EXEC [JBSK_NumOfBookmarks] @jobseekerID = " . $this->session->id);
        $row   = $query->row();
        return $row->bookmarksNum;
    }

    // VIEW JOB DETAILS
    public function job_details($jobPostID) {
        $query = $this->db->query("
            EXEC [JBSK_ViewJobDetails] 
                @jobPostID   = " . $jobPostID . ",
                @jobseekerID = " . $this->session->id . "
        ");
        return $query->row();
    }

    // SET PROFILE PICTURE
    public function set_profile_pic($imgName) {
        $this->db->query("
            EXEC [JBSK_SetProfilePic]
                @jobseekerID =  " . $this->session->id . ",
                @profilePic  = '" . $imgName . "'
        ");
    }

    // VIEW AVAILABLE JOBS
    public function view_available_jobs($employerID, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_ViewAvailableJobs]
                @jobseekerID = " . $this->session->id . ",
                @employerID  = " . $employerID  . ",
                @offsetRows  = " . $offsetRows  . ",
                @fetchedRows = " . $fetchedRows . "
        ");
        return $query->result();
    }
}