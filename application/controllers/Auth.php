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


    // LOGOUT VIEW
    public function logout() {
        session_destroy();
        redirect();
    }


    // DEACTIVATE VIEW
    public function deactivate() {
        session_destroy();
        redirect();
    }
    

    // USER INFORMATION VIEW
    public function information() {
        if( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;
            
            if ( $userType == 'Job Seeker' ) {
                $userdata = $this->Jobseeker_model->get_info();
            } else if ( $userType == 'Employer' ) {
                $userdata = $this->Employer_model->get_info();
            }

            $pagedata = ['title' => $userdata['username'] . ' - Information',];
            
            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);
            $this->load->view('auth_sections/employer/header', $userdata);
            $this->load->view('auth_sections/employer/information', $userdata);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }


    // USER SETTINGS
    public function settings() {
        if( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;
            if ( $userType == 'Job Seeker' ) {
                $userdata = $this->Jobseeker_model->get_info();
            } else if ( $userType == 'Employer' ) {
                $userdata = $this->Employer_model->get_info();
            }
            $pagedata = ['title'=> $userdata['username'] . ' - Settings'];

            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);
            $this->load->view('auth_sections/employer/header', $userdata);
            $this->load->view('auth_sections/settings');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }

    public function edit_information() {

    }


    // JOB POSTS VIEW
    public function job_posts($jobPostID = NULL) {
        if ( $this->session->userType == 'Employer' ) {
            $userdata = $this->Employer_model->get_info();

            if ( $jobPostID == NULL ) {
                $pagedata = ['title' => $userdata['username'] . ' - Job Posts'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/header', $userdata);
                $this->load->view('auth_sections/employer/job_posts');
            } else {
                $jobDetails = $this->Employer_model->get_job_details($jobPostID);
                $pagedata = ['title' => $jobDetails['jobTitle'] . ' - ' . $userdata['username'] . ' - Job Post'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/job_details', $jobDetails);
            }

            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }

    // POST NEW JOB VIEW
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
                $userdata = $this->Employer_model->get_info();
                $pagedata = ['title' => $userdata['username'] . ' - Job Posts'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/post_new_job', $pagedata);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->Employer_model->post_new_job();
            }
        } else {
            $this->Auth_model->err_page();
        }
    }

    // EDIT POST VIEW
    public function edit_post($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
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
                'required' => 'This field cannot be blank',
            ]);
    
            if ($this->form_validation->run() === FALSE) { 
                $jobDetails = $this->Employer_model->get_job_details($jobPostID);
                $userdata = $this->Employer_model->get_info();
                $pagedata = ['title' => $userdata['username'] . ' - Edit Job Post'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/edit_post_form', $jobDetails);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->Employer_model->update_job_post($this->input->post(), $jobPostID);
            }
        }
    }


    // DELETE POST VIEW
    public function delete_post($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $this->Employer_model->delete_post($jobPostID);
        }
    }

    // USER CHANGE PASSWORD VIEW
    public function change_password() {
        if (! $this->session->has_userdata('userType')) {
            redirect();
        } else {
            if ($this->session->userType == 'Job Seeker') {
                $userdata = $this->Jobseeker_model->get_info();
            } else if ($this->session->userType == 'Employer') {
                $userdata = $this->Employer_model->get_info();
            } 
            $pagedata = ['title' => $userdata['username'] . 'Change Password'];

            $this->form_validation->set_rules([
                [
                    'field' => 'oldPassword',
                    'rules' => 'required',
                ],
                [
                    'field' => 'newPassword',
                    'rules' => 'required|min_length[8]',
                ],
                [
                    'field' => 'retypeNewPassword',
                    'rules' => 'required|matches[newPassword]',
                ],
            ]);

            if ($this->form_validation->run() === FALSE) {    
                $this->load->view('templates/fullpage_header', $pagedata);
                $this->load->view('auth_sections/change_password', $userdata);
                $this->load->view('templates/footer');
            } else {
                $this->Auth_model->change_password($this->input->post());
            }
        }
    }
}