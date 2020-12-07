<?php

class Employer_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function post_new_job() {
        if ( $this->input->post('status') == '' ) {
            $status = 0;
        } else {
            $status = 1;
        }

        $PostNewJob_sql = "
            EXEC [PostNewJob]
                @employerID			= '" . $this->session->id                         . "',
                @jobTitle			= '" . $this->input->post( 'jobTitle'           ) . "',
                @jobType			= '" . $this->input->post( 'jobType'            ) . "',
                @industryType		= '" . $this->input->post( 'industryType'       ) . "',
                @description		= '" . $this->input->post( 'description'        ) . "',
                @responsibilities	= '" . $this->input->post( 'responsibilities'   ) . "',
                @skills				= '" . $this->input->post( 'skills'             ) . "',
                @experiences		= '" . $this->input->post( 'experiences'        ) . "',
                @education			= '" . $this->input->post( 'education'          ) . "',
                @minSalary			= '" . $this->input->post( 'minSalary'          ) . "',
                @maxSalary			= '" . $this->input->post( 'maxSalary'          ) . "',
                @jobPostFlag		=  " . $status                                    . "
        ";

        if (! $this->db->query($PostNewJob_sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/job_posts');
        }
    }

    protected function JobDetails($jobPostID) {
        $ViewJobPost_sql = "EXEC [ViewJobPost] @jobPostID = " . $jobPostID;
        $JobDetails_query = $this->db->query($ViewJobPost_sql);

        if (! $JobDetails_query) {
            echo $this->db->error();
        } else {
            if ( $JobDetails_query->num_rows() == 1 ) {
                $JobDetails_row = $JobDetails_query->row();

                $jobDetails = [
                    'jobPostID'        => $JobDetails_row->jobPostID,
                    'jobTitle'         => $JobDetails_row->jobTitle,
                    'jobType'          => $JobDetails_row->jobType,
                    'industryType'     => $JobDetails_row->industryType,
                    'description'      => $JobDetails_row->description,
                    'responsibilities' => $JobDetails_row->responsibilities,
                    'skills'           => $JobDetails_row->skills,
                    'experiences'      => $JobDetails_row->experiences,
                    'education'        => $JobDetails_row->education,
                    'minSalary'        => $JobDetails_row->minSalary,
                    'maxSalary'        => $JobDetails_row->maxSalary,
                    'dateCreated'      => $JobDetails_row->dateCreated,
                    'dateModified'     => $JobDetails_row->dateModified,
                    'status'           => $JobDetails_row->status,
                ];

                return $jobDetails;
            } else {
                die('Multiple Posted Jobs are detected');
            }
        }
    }

    public function view_job_post($jobPostID) {
        $jobDetails = $this->JobDetails($jobPostID);
    
        $data = ['title' => $jobDetails['jobTitle'] . ' - ' . $this->session->companyName . ' - Job Post'];
        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar');
        $this->load->view('auth_sections/employer/job_details', $jobDetails);
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    protected function UpdateJobPost($input, $jobPostID) {
        if ( $input['status'] == 1 ) {
            $status = 1;
        } else {
            $status = 0;
        }
        $UpdateJobPost_sql = "
            EXEC [UpdateJobPost]
                @jobPostID			= '" . $jobPostID . "',
                @jobTitle			= '" . $input[ 'jobTitle'         ] . "',
                @jobType			= '" . $input[ 'jobType'          ] . "',
                @industryType		= '" . $input[ 'industryType'     ] . "',
                @description		= '" . $input[ 'description'      ] . "',
                @responsibilities	= '" . $input[ 'responsibilities' ] . "',
                @skills				= '" . $input[ 'skills'           ] . "',
                @experiences		= '" . $input[ 'experiences'      ] . "',
                @education			= '" . $input[ 'education'        ] . "',
                @minSalary			= '" . $input[ 'minSalary'        ] . "',
                @maxSalary			= '" . $input[ 'maxSalary'        ] . "',
                @jobPostFlag		=  " . $status . "
        ";
        if (! $this->db->query($UpdateJobPost_sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/job_posts/' . $jobPostID);
        }
    }

    public function edit_post($jobPostID) {
        $this->form_validation->set_rules([
            [
                'field' => 'jobTitle',
                'label' => 'job title',
                'rules' => 'required',
            ],
            [
                'field' => 'jobType',
                'label' => 'job type',
                'rules' => 'required',
            ],
            [
                'field' => 'industryType',
                'label' => 'industryType',
                'rules' => 'required',
            ],
            [
                'field' => 'minSalary',
                'label' => 'minimum salary',
                'rules' => 'required',
            ],
            [
                'field' => 'maxSalary',
                'label' => 'maximum salary',
                'rules' => 'required',
            ],
            [
                'field' => 'description',
                'label' => 'description',
                'rules' => 'required',
            ],
            [
                'field' => 'responsibilities',
                'label' => 'responsibilities',
                'rules' => 'required',
            ],
            [
                'field' => 'skills',
                'label' => 'skills set',
                'rules' => 'required',
            ],
            [
                'field' => 'experiences',
                'label' => 'experiences',
                'rules' => 'required',
            ],
            [
                'field' => 'education',
                'label' => 'education',
                'rules' => 'required',
            ],
        ]);

        $this->form_validation->set_message([
            'required' => 'This is a required field',
        ]);

        if ($this->form_validation->run() === FALSE) { 
            $jobDetails = $this->JobDetails($jobPostID);
            $data = ['title' => $jobDetails['jobTitle'] . ' - ' . $this->session->companyName . ' - Edit Job Post'];
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar');
            $this->load->view('auth_sections/employer/edit_post', $jobDetails);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->UpdateJobPost($this->input->post(), $jobPostID);
        }
    }

    public function delete_post($jobPostID) {
        $DeleteJobPost_sql = "EXEC [DeleteJobPost] @jobPostID = " . $jobPostID;
        if (! $this->db->query($DeleteJobPost_sql)) {
            echo $this->db->error();
        } else {
            redirect('auth/job_posts');
        }
    }
}