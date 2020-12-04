<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('jobseeker_model');
        $this->load->model('employer_model');
        $this->load->helper('url_helper');
    }
    
    // INDEX VIEW
    public function index() {
        $data = [
            'title'         => 'Home',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar');
        $this->load->view('index', $data);
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    // 404 PAGE NOT FOUND VIEW
    public function _404() {
        $data = [
            'title'         => '404: Page Not Found',
        ];

        $this->load->view('templates/fullpage_header', $data);
        $this->load->view('_404');
        $this->load->view('templates/footer');
    }

    // JOBS VIEW
    public function jobs() {
        $data = [
            'title'         => 'Jobs',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar');
        $this->load->view('sections/search_header');
        $this->load->view('sections/job_list', $data);
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    // ABOUT US VIEW
    public function about_us() {
        $data = [
            'title'         => 'About Us',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar');
        $this->load->view('sections/header', $data);
        $this->load->view('sections/about_us');
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    // TERMS AND CONDITIONS VIEW
    public function terms_and_conditions() {
        $data = [
            'title'         => 'Terms and Conditions',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar');
        $this->load->view('sections/header', $data);
        $this->load->view('sections/terms_and_conditions');
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');

    }

    // LOGIN VIEW
    public function login() {
        $data = [
            'title'         => 'Login',
        ];

        $this->load->view('templates/fullpage_header', $data);
        $this->load->view('sections/login');
        $this->load->view('templates/footer');
    }

    // JOBSEEKER REGISTRATION VIEW
    public function jobseeker_registration() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = [
            'title'         => 'Register as Job Seeker',
            'header_img'    => 'header.jpg',
        ];

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

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar');
            $this->load->view('sections/header', $data);
            $this->load->view('sections/jobseeker_regform');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->jobseeker_model->register_jobseeker();
            echo "Success";
        }
    }

    // EMPLOYER REGISTRATION VIEW
    public function employer_registration() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = [
            'title'         => 'Register as Employer',
            'header_img'    => 'header.jpg',
        ];

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

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar');
            $this->load->view('sections/header', $data);
            $this->load->view('sections/employer_regform');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->employer_model->register_employer();
            echo "Success";
        }
    }

    // TEST VIEW
    public function test() {
        $data = [
            'jobseekers' => $this->jobseeker_model->get_jobseekers(),
        ];
        
        $this->load->view('test', $data);
    }
}