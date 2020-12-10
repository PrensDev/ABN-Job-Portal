<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    

    // INDEX FUNCTION
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
        $this->Auth_model->deactivate();
        session_destroy();
        redirect();
    }

    
    // GET USER DATA
    protected function get_userdata() {
        if ( $this->session->userType == 'Job Seeker' ) {
            return $this->Jobseeker_model->get_info();
        } else if ( $this->session->userType == 'Employer' ) {
            return $this->Employer_model->get_info();
        }
    }
    

    // USER INFORMATION VIEW
    public function information() {
        if( $this->session->has_userdata('userType') ) {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Information',];
            
            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);

            if ( $this->session->userType == 'Job Seeker' ) {
                $this->load->view('auth_sections/jobseeker/header', $userdata);
                $this->load->view('auth_sections/jobseeker/information', $userdata);
            } else if ( $this->session->userType == 'Employer' ) {
                $this->load->view('auth_sections/employer/header', $userdata);
                $this->load->view('auth_sections/employer/information', $userdata);
            }
            
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }


    // USER SETTINGS
    public function settings() {
        if( $this->session->has_userdata('userType') ) {
            $userdata = $this->get_userdata();
            $pagedata = ['title'=> $userdata['username'] . ' - Settings'];

            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);
            
            if ( $this->session->userType == 'Job Seeker' ) {
                $this->load->view('auth_sections/jobseeker/header', $userdata);
            } else if ( $this->session->userType == 'Employer' ) {
                $this->load->view('auth_sections/employer/header', $userdata);
            }
            
            $this->load->view('auth_sections/settings', $userdata);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }

    
    // EDIT INFORMATION VIEW
    public function edit_information() {
        if ( $this->session->has_userdata('userType')) {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Edit Information'];

            $this->form_validation->set_message([
                'required'      => 'This field cannot be blank',
            ]);
            
            if ( $this->session->userType == 'Job Seeker' ) {
                $this->form_validation->set_rules([
                    [
                        'field' => 'firstName',
                        'label' => 'first name',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'lastName',
                        'label' => 'last name',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'birthDate',
                        'label' => 'date of birth',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'gender',
                        'label' => 'gender',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'street',
                        'label' => 'street',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'brgyDistrict',
                        'label' => 'baranggay/district',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'cityMunicipality',
                        'label' => 'city/municipality',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'contactNumber',
                        'label' => 'phone/telephone Number',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'description',
                        'label' => 'description',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'skills',
                        'label' => 'skills',
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

                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load->view('auth_sections/jobseeker/edit_information_form', $userdata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    $this->Jobseeker_model->update_info();
                }
            } else if ( $this->session->userType == 'Employer' ) {
                $this->form_validation->set_rules([
                    [
                        'field' => 'companyName',
                        'label' => 'company name',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'street',
                        'label' => 'street name',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'brgyDistrict',
                        'label' => 'baranggay/district',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'cityMunicipality',
                        'label' => 'city/municipality',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'description',
                        'label' => 'description',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'website',
                        'label' => 'website',
                        'rules' => 'valid_url',
                    ],
                    [
                        'field' => 'contactNumber',
                        'label' => 'phone/telephone Number',
                        'rules' => 'required',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load->view('auth_sections/employer/edit_information_form', $userdata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    $this->Employer_model->update_info();
                }
            }
        } else {
            $this->Auth_model->err_page();
        } 
    }


    // JOB POSTS VIEW
    public function job_posts($jobPostID = NULL) {
        if ( $this->session->userType == 'Employer' ) {
            $userdata = $this->Employer_model->get_info();
            $jobPosts = $this->Employer_model->get_job_posts();

            if ( $jobPostID == NULL ) {
                $pagedata = [
                    'title' => $userdata['username'] . ' - Job Posts',
                    'jobPosts' => $jobPosts,
                ];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/job_posts', $pagedata);
            } else {
                $jobDetails = $this->Employer_model->get_job_details($jobPostID);

                if (! $jobDetails) {
                    $this->Auth_model->err_page();
                } else {
                    $pagedata = ['title' => $jobDetails['jobTitle'] . ' - ' . $userdata['username'] . ' - Job Post'];
    
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load->view('auth_sections/employer/job_details', $jobDetails);
                }
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
        if ( $this->session->userType == 'Employer' ) {
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
                    $jobDetails = $this->Employer_model->get_job_details($jobPostID, $this->session->id);
                    if(! $jobDetails) {
                        $this->Auth_model->err_page();
                    } else {
                        $userdata = $this->Employer_model->get_info();
                        $pagedata = ['title' => $userdata['username'] . ' - Edit Job Post'];
    
                        $this->load->view('templates/header', $pagedata);
                        $this->load->view('sections/navbar', $userdata);
                        $this->load->view('auth_sections/employer/edit_post_form', $jobDetails);
                        $this->load->view('sections/footer');
                        $this->load->view('templates/footer');
                    }
                } else {
                    $this->Employer_model->update_job_post($jobPostID);
                }
            }
        } else {
            $this->Auth_model->err_page();
        }        
    }


    // DELETE POST VIEW
    public function delete_post($jobPostID = NULL) {
        if ($this->session->userType == 'Employer') {
            if ($jobPostID == NULL) {
                $this->Auth_model->err_page();
            } else {
                $this->Employer_model->delete_post($jobPostID);
            }
        } else {
            $this->Auth_model->err_page();
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