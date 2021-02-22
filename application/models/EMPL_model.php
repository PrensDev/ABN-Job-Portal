<?php

class EMPL_model extends CI_Model {
    
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

    // ==================================================================================================== //

    // GET INFORMATION METHOD
    public function get_info() {
        $query = $this->db->query("EXEC [AUTH_FindEmployer] @email = ?", [$this->session->email]);
        $row = $query->row();
        $location = $row->brgyDistrict . ', ' . $row->cityProvince;

        $userdata = [
            'userName'      => $row->companyName,
            'profilePic'    => $row->profilePic,
            'id'            => $row->employerID,
            'companyName'   => $row->companyName,
            'street'        => $row->street,
            'brgyDistrict'  => $row->brgyDistrict,
            'cityProvince'  => $row->cityProvince,
            'location'      => $location,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'website'       => $row->website,
            'description'   => $row->description,
        ];

        return $userdata;
    }
    
    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        return $this->db->query("
            EXEC [EMPL_UpdateInfo]
                @employerID    = ?,
                @companyName   = ?,
                @street        = ?,
                @brgyDistrict  = ?,
                @cityProvince  = ?,
                @contactNumber = ?,
                @website       = ?,
                @description   = ?
        ", [
            $this->session->id,
            $input[ 'companyName' ],
            ucfirst($input[ 'street' ]),
            ucfirst($input[ 'brgyDistrict' ]),
            ucfirst($input[ 'cityProvince' ]),
            $input[ 'contactNumber' ],
            $input[ 'website' ],
            ucfirst($input[ 'description' ]) ,
        ]);
    }

    // POST NEW JOB METHOD
    public function post_new_job() {
        $jobPostFlag = $this->input->post('jobPostFlag') == '' ? 0 : 1;
        return $this->db->query ("
            EXEC [EMPL_PostNewJob]
                @employerID		  = '" . $this->session->id . "',
                @jobTitle		  = '" . ucwords($this->input->post( 'jobTitle' )) . "',
                @jobType		  = '" . $this->input->post( 'jobType' ) . "',
                @field	          = '" . $this->input->post( 'field' ) . "',
                @description	  = '" . ucfirst($this->input->post( 'description' )) . "',
                @responsibilities = '" . ucfirst($this->input->post( 'responsibilities' )) . "',
                @skills			  = '" . ucfirst($this->input->post( 'skills' )) . "',
                @experiences	  = '" . ucfirst($this->input->post( 'experiences' )) . "',
                @education		  = '" . ucfirst($this->input->post( 'education' )) . "',
                @minSalary		  = '" . $this->input->post( 'minSalary'        ) . "',
                @maxSalary		  = '" . $this->input->post( 'maxSalary'        ) . "',
                @jobPostFlag	  =  " . $jobPostFlag                                  . "
        ");
    }

    // GET ALL POSTS METHOD
    public function posts_num() {
        return $this->query_count("EXEC [EMPL_PostsNum] @employerID = ?", [$this->session->id]);
    }

    // GET POSTS METHOD
    public function get_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("EXEC [EMPL_GetPosts] 
            @employerID  = ?,
            @offsetRows  = ?,
            @fetchedRows = ?
        ", [
            $this->session->id,
            $offsetRows,
            $fetchedRows,
        ]);
        return $query->result();
    }

    // GET JOB DETAILS METHOD
    public function get_job_details($jobPostID) {
        $query = $this->db->query("
            EXEC [EMPL_ViewPost] 
                @jobPostID  = ?,
                @employerID = ? 
        ", [
            $jobPostID,
            $this->session->id,
        ]);

        if($query->num_rows() == 1) {
            $row = $query->row();
            
            $jobDetails = [
                'jobPostID'        => $row->jobPostID,
                'jobTitle'         => $row->jobTitle,
                'jobType'          => $row->jobType,
                'field'            => $row->field,
                'description'      => $row->description,
                'responsibilities' => $row->responsibilities,
                'skills'           => $row->skills,
                'experiences'      => $row->experiences,
                'education'        => $row->education,
                'minSalary'        => $row->minSalary,
                'maxSalary'        => $row->maxSalary,
                'dateCreated'      => $row->dateCreated,
                'dateModified'     => $row->dateModified,
                'jobPostFlag'      => $row->jobPostFlag,
                'applicantsNum'    => $row->applicantsNum,
            ];
            return $jobDetails;
        } else {
            return FALSE;
        }
    }

    // GET NUMBER OF APPLICANTS METHOD
    public function applicants_num($jobPostID, $status) {
        return $this->query_count("
            EXEC [EMPL_ApplicantsNum] 
                @jobPostID =  " . $jobPostID .",
                @status    = '" . $status . "'
        ");
    }

    // VIEW APPLICANTS METHOD
    public function view_applicants($offsetRows, $fetchedRows, $jobPostID, $status) {
        $query = $this->db->query("
            EXEC [EMPL_ViewApplicants]
                @offsetRows  = ?,
                @fetchedRows = ?,
                @jobPostID   = ?,
                @status      = ?
        ", [
            $offsetRows,
            $fetchedRows,
            $jobPostID,
            $status,
        ]);

        return $query->result();
    }

    // UPDATE JOB POST METHOD
    public function update_post($jobPostID) {
        $input  = $this->input->post();
        $jobPostFlag = $input['jobPostFlag'] == '1' ? 1 : 0;
        return $this->db->query("
            EXEC [EMPL_UpdatePost]
                @jobPostID		  =  " . $jobPostID . ",
                @jobTitle		  = '" . ucwords($input[ 'jobTitle' ]) . "',
                @jobType		  = '" . $input[ 'jobType' ] . "',
                @field	          = '" . ucwords($input[ 'field' ]) . "',
                @description	  = '" . ucfirst($input[ 'description' ]) . "',
                @responsibilities = '" . ucfirst($input[ 'responsibilities' ]) . "',
                @skills			  = '" . ucfirst($input[ 'skills' ]) . "',
                @experiences	  = '" . ucfirst($input[ 'experiences' ]) . "',
                @education		  = '" . ucfirst($input[ 'education' ]) . "',
                @minSalary		  =  " . $input[ 'minSalary' ] . ",
                @maxSalary		  =  " . $input[ 'maxSalary' ] . ",
                @jobPostFlag	  =  " . $jobPostFlag . "
        ");
    }

    // DELETE POST METHOD
    public function delete_post() {
        return $this->db->query("
            EXEC [EMPL_DeletePost] 
                @jobPostID  = ?,
                @employerID = ? 
        ", [
            $this->input->post('jobPostID'),
            $this->session->id,
        ]);
    }

    // VIEW APPLICANT PROFILE
    public function view_applicant_profile($jobseekerID, $jobPostID) {
        $query = $this->db->query("
            EXEC [EMPL_ViewApplicantProfile]
                @jobseekerID = ?,
                @jobPostID   = ?
        ", [
            $jobseekerID,
            $jobPostID,
        ]);
        return $query->row();
    }

    // HIRE APPLICANT
    public function hire_applicant() {
        $hired = $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = ?,
                @status        = ?
        ", [
            $this->input->post('applicationID'),
            'Hired',
        ]);

        if($hired) {
            $this->AUTH_model->notify_JBSK_status();
        }
    }

    // REJECT APPLICANT
    public function reject_applicant() {
        $rejected = $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = ?,
                @status        = ?
        ", [
            $this->input->post('applicationID'),
            'Rejected'
        ]);

        if($rejected) {
            $this->AUTH_model->notify_JBSK_status();
        }
    }

    // CANCEL HIRING
    public function cancel_hiring_rejecting() {
        $canceled = $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = ?,
                @status        = ?
        ", [
            $this->input->post('applicationID'),
            'Pending'
        ]);

        if ($canceled) {
            $this->AUTH_model->remove_JBSK_status_notification();
        }
    }

    // SET PROFILE PICTURE
    public function set_profile_pic($imgName) {
        $this->db->query("
            EXEC [EMPL_SetProfilePic]
                @employerID = ?,
                @profilePic = ?
        ", [
            $this->session->id,
            $imgName
        ]);
    }
}