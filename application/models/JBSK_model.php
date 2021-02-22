<?php

class JBSK_model extends CI_Model {

    // CONSTRUCTOR
    public function __construct() {
        $this->load->database();
    }

    // RETURNS THE COUNT OF THE QUERY
    private function query_count($query, $values = []) {
        $qry = $this->db->query($query, $values);
        $row = $qry->row();
        return $row->count;
    }

    // ========================================================================================== //

    // GET INFORMATION METHOD
    public function get_info() {
        $query = $this->db->query("EXEC [AUTH_FindJobseeker] @email = ?", [$this->session->email]);
        $row   = $query->row();

        $firstName  = $row->firstName;
        $middleName = $row->middleName;
        $lastName   = $row->lastName;

        $fullName = $middleName == NULL ? $firstName . ' ' . $lastName : $firstName . ' ' . $middleName . ' ' . $lastName;

        $userdata = [
            'userName'         => $firstName,
            'fullName'         => $fullName,
            'firstName'        => $firstName,
            'middleName'       => $middleName,
            'lastName'         => $lastName,
            'birthDate'        => $row->birthDate,
            'age'              => $row->age,
            'gender'           => $row->gender,
            'cityProvince'     => $row->cityProvince,
            'contactNumber'    => $row->contactNumber,
            'email'            => $row->email,
            'profilePic'       => $row->profilePic,
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
    public function remove_resume() {
        return $this->db->query("EXEC [JBSK_RemoveResume] @resumeID = ?", [$this->input->post('resumeID')]);
    }

    // UPDATE RESUME METHOD
    public function update_resume() {
        $input = $this->input->post();
        $resumeData = $this->view_resume();

        $resumeFlag = $input['resumeFlag'] == '' ? 0 : 1;

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
            $resumeData->resumeID,
            $input[ 'headline'    ],
            $input[ 'description' ],
            $input[ 'education'   ],
            $input[ 'skills'      ],
            $input[ 'experiences' ],
            $resumeFlag,
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

    // NUMBER OF ALL RECENT POSTS
    public function recent_posts_num() {
        return $this->query_count("EXEC [JBSK_RecentPostsNum] @jobseekerID = ?", [$this->session->id]);
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

    // NUMBER OF ALL APPLIED JOBS BASED TO STATUS
    public function applied_jobs_to_status_num($status) {
        return $this->query_count("
            EXEC [JBSK_AppliedJobsToStatusNum] 
                @jobseekerID = ?,
                @status      = ?
        ", [
            $this->session->id,
            $status,
        ]);
    }

    // APPLIED JOBS
    public function applied_jobs_to_status($status, $offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_AppliedJobsToStatus]
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

    // NUMBER OF ALL APPLIED JOBS
    public function applied_jobs_num() {
        return $this->query_count("EXEC [JBSK_AppliedJobsNum] @jobseekerID = ?", [$this->session->id]);
    }

    // ADD BOOKMARK
    public function add_bookmark() {
        return $this->db->query("
            EXEC [JBSK_AddBookmark] 
                @jobseekerID = ?,
                @jobPostID   = ?
        ", [
            $this->session->id,
            $this->input->post('jobPostID'),
        ]);
    }

    // REMOVE BOOKMARK
    public function remove_bookmark() {
        return $this->db->query("EXEC [JBSK_RemoveBookmark] @bookmarkID = ?", [$this->input->post('bookmarkID')]);
    }

    // NUMBER OF ALL BOOKMARKS
    public function bookmarks_num() {
        return $this->query_count("EXEC [JBSK_BookmarksNum] @jobseekerID = ?", [$this->session->id]);
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

    // VIEW JOB DETAILS
    public function application_status($jobPostID) {
        $JobStatus_query = $this->db->query("
            EXEC [JBSK_ApplicationStatus] 
                @jobPostID   = ?,
                @jobseekerID = ?
        ", [
            $jobPostID,
            $this->session->id,
        ]);
        return $JobStatus_query->row();
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
    public function search_result_num() {
        return $this->query_count("
            EXEC [JBSK_SearchResultNum]
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

    // NUMBER OF ALL STATUS NOTIFICATIONS
    public function status_notifications_num() {
        return $this->query_count("
            EXEC [JBSK_StatusNotificationsNum]
                @jobseekerID = ?
        ", [
            $this->session->id, 
        ]);
    }

    // GET STATUS NOTIFICATIONS
    public function get_status_notifications($offsetRows, $fetchedRows) {
        $query = $this->db->query("
            EXEC [JBSK_GetStatusNotifications]
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

    // SET NOTIFICATION READFLAG
    public function set_notification_readflag() {
        $this->db->query("
            EXEC [JBSK_SetNotificationReadFlag] 
                @notificationID = ?,
                @readFlag       = ?
        ", [
            $this->input->post('notificationID'),
            $this->input->post('readFlag'),
        ]);
    }

    // NUMBER OF ALL UNREAD NOTIFICATIONS 
    public function unread_status_notifications_num() {
        return $this->query_count("EXEC [JBSK_UnreadStatusNotificationsNum] @jobseekerID = ?", [$this->session->id]);
    }
}
