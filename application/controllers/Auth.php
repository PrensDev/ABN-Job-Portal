<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        if ( $this->session->has_userdata('userType') ) {
            redirect();
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function logout() {
        session_destroy();
        redirect();
    }

    public function deactivate() {
        session_destroy();
        redirect();
    }
    
    public function information() {
        if( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;
            if ( $userType == 'Job Seeker' ) {
                $data = ['title' => $this->session->fullName . ' - Information'];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/jobseeker/header');
                $this->load->view('auth_sections/jobseeker/information');
            } else if ( $userType == 'Employer' ) {
                $data = ['title' => $this->session->companyName . ' - Information'];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/employer/header');
                $this->load->view('auth_sections/employer/information');
            }
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function settings() {
        if( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;
            if ( $userType == 'Job Seeker' ) {
                $data = [
                    'title'     => $this->session->fullName . ' - Settings',
                    'editLink'  => '',
                ];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/jobseeker/header');
            } else if ( $userType == 'Employer' ) {
                $data = [
                    'title'     => $this->session->companyName . ' - Settings',
                    'editLink'  => '',
                ];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/employer/header');
            }
            $this->load->view('auth_sections/settings');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function job_posts($jobPostID = NULL) {
        if ( $this->session->userType == 'Employer' ) {
            if ( $jobPostID == NULL ) {
                $data = ['title' => $this->session->companyName . ' - Posted Jobs'];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/employer/header');
                $this->load->view('auth_sections/employer/job_posts');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->Employer_model->view_job_post($jobPostID);
            }
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function post_new_job() {
        if ( $this->session->userType == 'Employer' ) {
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
                $data = ['title' => $this->session->companyName . ' - Post New Job'];
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar');
                $this->load->view('auth_sections/employer/post_new_job');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->Employer_model->post_new_job();
            }
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function edit_post($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $this->Employer_model->edit_post($jobPostID);
        }
    }

    public function delete_post($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $this->Employer_model->delete_post($jobPostID);
        }
    }
}