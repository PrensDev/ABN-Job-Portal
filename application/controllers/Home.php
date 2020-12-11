<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    protected function set_data($title) {
        $userdata = NULL;

        if ( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;

            if ( $userType == 'Job Seeker' ) {
                $userdata = $this->Jobseeker_model->get_info();
            } else if ( $userType == 'Employer' ) {
                $userdata = $this->Employer_model->get_info();
            }

            $pageTitle = $userdata['username'] . ' - ' . $title;
        } else {
            $pageTitle = $title;
        }

        $data = [
            'title'         => $pageTitle,
            'header'        => $title,
            'header_img'    => 'header.jpg',
            'userdata'      => $userdata,
        ];

        return $data;
    }
    
    protected function load_main_view($title, $bodyView) {
        $data = $this->set_data($title);

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar', $data['userdata']);

        if ( $bodyView == 'index' ) {
            $recentPosts = $this->View_model->recent_posts();
            $data['recentPosts'] = $recentPosts;
            $this->load->view('index', $data);
        } else {
            $this->load->view('sections/header', $data);
            $this->load->view('sections/' . $bodyView, $data);
        }

        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    
    // INDEX VIEW
    public function index() {
        $this->load_main_view('Home', 'index');
    }
    

    // ABOUT US VIEW
    public function about_us() {
        $this->load_main_view('About Us', 'about_us');
    }


    // TERMS AND CONDITIONS VIEW
    public function terms_and_conditions() {
        $this->load_main_view('Terms and Conditions', 'terms_and_conditions');
    }


    // JOBS VIEW
    public function jobs($jobPostsID = NULL) {
        if( $jobPostsID == NULL ) {
            $data = $this->set_data('Jobs');
    
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/search_header');
            $this->load->view('sections/job_list');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            echo $jobPostsID;
        }
    }


    // LOGIN VIEW
    public function login() {
        if ($this->session->has_userdata('userType')) {
            redirect();
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required',
                ],
                [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required' => 'This is a required field',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title' => 'Login',
                    'error' => '',
                ];
            } else {
                $error = $this->Auth_model->login();
                if (isset($error)) {
                    $data = [
                        'title' => 'Login',
                        'error' => $error,
                    ];
                }
            }
            
            $this->load->view('templates/fullpage_header', $data);
            $this->load->view('sections/login_form');
            $this->load->view('templates/footer');
        }
    }


    // JOBSEEKER REGISTRATION VIEW
    public function jobseeker_registration() {
        if ($this->session->has_userdata('userType')) {
            redirect();
        } else {
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
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|valid_email|is_unique[UserAccounts.email]',
                ],
                [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required|min_length[8]',
                ],
                [
                    'field' => 'retypePassword',
                    'label' => 'password',
                    'rules' => 'required|matches[password]',
                ],
                [
                    'field' => 'agreement',
                    'label' => 'checkbox',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required'      => 'This is a required field',
                'is_unique'     => 'This email is already used.',
                'valid_email'   => 'This email contains invalid characters',
                'min_length'    => 'Your password must be 8 characters and above',
                'matches'       => 'It doesn\'t match to your password',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->load_main_view('Register as Job Seeker', 'jobseeker_regform');
            } else {
                $this->Auth_model->register_jobseeker();
            }
        }
    }


    // EMPLOYER REGISTRATION VIEW
    public function employer_registration() {
        if ($this->session->has_userdata('userType')) {
            redirect();
        } else {
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
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required|valid_email|is_unique[UserAccounts.email]',
                ],
                [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required|min_length[8]',
                ],
                [
                    'field' => 'retypePassword',
                    'label' => 'password',
                    'rules' => 'required|matches[password]',
                ],
                [
                    'field' => 'agreement',
                    'label' => 'checkbox',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required'      => 'This is a required field',
                'is_unique'     => 'This email is already used.',
                'valid_email'   => 'This email contains invalid characters',
                'min_length'    => 'Your password must be 8 characters and above',
                'matches'       => 'It doesn\'t match to your password',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->load_main_view('Register as Employer', 'employer_regform');
            } else {
                $this->Auth_model->register_employer();
            }
        }
    }
}