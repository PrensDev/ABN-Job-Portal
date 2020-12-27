<?php

class Employer_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }

    protected function get_row($sql) {
        $query = $this->db->query($sql);
        if (! $query) {
            die($this->db->error());
        } else {
            return $query->row();
        }
    }

    protected function run_query($sql, $successPath) {
        if (! $this->db->query($sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/' . $successPath);
        }
    }

    
    // ==================================================================================================== //

    // NUMBER OF POSTED JOBS METHOD
    public function posts_num() {
        $query = $this->get_row("EXEC [EMPL_NumOfPosts] @employerID = " . $this->session->id);
        return $query->postsNum;
    }

    // GET INFORMATION METHOD
    public function get_info() {
        $row = $this->get_row("EXEC [AUTH_FindEmployer] @email = '" . $this->session->email . "'");
        $location = $row->brgyDistrict . ', ' . $row->cityMunicipality;

        $userdata = [
            'username'         => $row->companyName,
            'companyName'      => $row->companyName,
            'street'           => $row->street,
            'brgyDistrict'     => $row->brgyDistrict,
            'cityMunicipality' => $row->cityMunicipality,
            'location'         => $location,
            'contactNumber'    => $row->contactNumber,
            'email'            => $row->email,
            'website'          => $row->website,
            'description'      => $row->description,
            'profilePic'       => $row->profilePic,
        ];

        return $userdata;
    }

    // POST NEW JOB METHOD
    public function post_new_job() {
        $status = $this->input->post('status') == '' ? 0 : 1;

        $this->run_query("
            EXEC [EMPL_PostNewJob]
                @employerID		  = '" . $this->session->id . "',
                @jobTitle		  = '" . ucwords($this->input->post( 'jobTitle' )) . "',
                @jobType		  = '" . $this->input->post( 'jobType' ) . "',
                @industryType	  = '" . $this->input->post( 'industryType' ) . "',
                @description	  = '" . ucfirst($this->input->post( 'description' )) . "',
                @responsibilities = '" . ucfirst($this->input->post( 'responsibilities' )) . "',
                @skills			  = '" . ucfirst($this->input->post( 'skills' )) . "',
                @experiences	  = '" . ucfirst($this->input->post( 'experiences' )) . "',
                @education		  = '" . ucfirst($this->input->post( 'education' )) . "',
                @minSalary		  = '" . $this->input->post( 'minSalary'        ) . "',
                @maxSalary		  = '" . $this->input->post( 'maxSalary'        ) . "',
                @jobPostFlag	  =  " . $status                                  . "
        ", 'job_posts');
    }

    // GET ALL POSTS METHOD
    public function get_all_posts() {
        return $this->db->query("EXEC [EMPL_GetAllPosts] @employerID = '" . $this->session->id . "'");
    }

    // GET POSTS METHOD
    public function get_posts($offsetRows, $fetchedRows) {
        $query = $this->db->query("EXEC [EMPL_GetPosts] 
            @employerID  = '" . $this->session->id . "',
            @offsetRows  = " . $offsetRows . ",
            @fetchedRows = " . $fetchedRows . "
        ");

        return $query->result();
    }

    // GET JOB DETAILS METHOD
    public function get_job_details($jobPostID) {
        $query = $this->db->query("
            EXEC [EMPL_ViewPost] 
                @jobPostID = " . $jobPostID . ",
                @employerID = " . $this->session->id
        );

        if($query->num_rows() == 1) {
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
                'status'           => $row->status,
                'numOfApplicants'  => $row->numOfApplicants,
            ];
            return $jobDetails;
        } else {
            return FALSE;
        }
    }

    // VIEW ALL APPLICANTS METHOD
    public function view_all_applicants($jobPostID) {
        return $this->db->query("EXEC [EMPL_ViewAllApplicants] @jobPostID = " . $jobPostID);
    }

    // VIEW APPLICANTS METHOD
    public function view_applicants($offsetRows, $fetchedRows, $jobPostID) {
        $query = $this->db->query("
            EXEC [EMPL_ViewApplicants]
                @offsetRows  = " . $offsetRows .",
                @fetchedRows = " . $fetchedRows . ",
                @jobPostID   = " . $jobPostID . "
        ");

        return $query->result();
    }

    // UPDATE JOB POST METHOD
    public function update_post($jobPostID) {
        $input  = $this->input->post();
        $status = $input['status'] == '1' ? 1 : 0;
        $this->run_query("
            EXEC [EMPL_UpdatePost]
                @jobPostID		  = '" . $jobPostID . "',
                @jobTitle		  = '" . ucwords($input[ 'jobTitle' ]) . "',
                @jobType		  = '" . $input[ 'jobType' ] . "',
                @industryType	  = '" . ucwords($input[ 'industryType' ]) . "',
                @description	  = '" . ucfirst($input[ 'description' ]) . "',
                @responsibilities = '" . ucfirst($input[ 'responsibilities' ]) . "',
                @skills			  = '" . ucfirst($input[ 'skills' ]) . "',
                @experiences	  = '" . ucfirst($input[ 'experiences' ]) . "',
                @education		  = '" . ucfirst($input[ 'education' ]) . "',
                @minSalary		  = '" . $input[ 'minSalary' ] . "',
                @maxSalary		  = '" . $input[ 'maxSalary' ] . "',
                @jobPostFlag	  =  " . $status . "
        ", 'job_details/' . $jobPostID);
    }

    // DELETE POST METHOD
    public function delete_post($jobPostID) {
        $exist = $this->get_job_details($jobPostID, $this->session->id);
        if(! $exist) {
            $this->Auth_model->err_page();
        } else {
            $this->run_query("
                EXEC [EMPL_DeletePost] 
                    @jobPostID  = " . $jobPostID . ",
                    @employerID = " . $this->session->id
            , 'job_posts');
        }
    }

    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        $this->run_query("
            EXEC [EMPL_UpdateInfo]
                @employerID       = '" . $this->session->id           . "',
                @companyName      = '" . $input[ 'companyName'      ] . "',
                @street           = '" . ucfirst($input[ 'street' ]) . "',
                @brgyDistrict     = '" . ucfirst($input[ 'brgyDistrict' ]) . "',
                @cityMunicipality = '" . ucfirst($input[ 'cityMunicipality' ]) . "',
                @contactNumber    = '" . $input[ 'contactNumber' ] . "',
                @website          = '" . $input[ 'website' ] . "',
                @description      = '" . ucfirst($input[ 'description' ]) . "'
        ", 'information');
    }

    // VIEW APPLICANT PROFILE
    public function view_applicant_profile($jobseekerID, $jobPostID) {
        $query = $this->db->query("
            EXEC [EMPL_ViewApplicantProfile]
                @jobseekerID = " . $jobseekerID . ",
                @jobPostID   = " . $jobPostID . "
        ");

        return $query->row();
    }

    // HIRE APPLICANT
    public function hire_applicant($applicationID) {
        return $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = " . $applicationID . ",
                @status        = 'Hired'
        ");
    }

    // REJECT APPLICANT
    public function reject_applicant($applicationID) {
        return $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = " . $applicationID . ",
                @status        = 'Rejected'
        ");
    }

    // CANCEL HIRING
    public function cancel_hiring_rejecting($applicationID) {
        return $this->db->query("
            EXEC [EMPL_SetApplicantStatus] 
                @applicationID = " . $applicationID . ",
                @status        = 'Pending'
        ");
    }

    // SET PROFILE PICTURE
    public function set_profile_pic($imgName) {
        $this->db->query("
            EXEC [EMPL_SetProfilePic]
                @employerID =  " . $this->session->id . ",
                @profilePic = '" . $imgName . "'
        ");
    }
}