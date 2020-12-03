<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('jobseeker_model');
        $this->load->helper('url_helper');
    }

    public function index() {

        $data = [
            'title'         => 'Home',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);

        $this->load->view('sections/navbar', $data);
        $this->load->view('index', $data);
        $this->load->view('sections/footer');

        $this->load->view('templates/footer');
    }

    public function about_us() {

        $data = [
            'title' => 'About Us',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);

        $this->load->view('sections/navbar', $data);
        $this->load->view('sections/header', $data);
        $this->load->view('sections/about_us');
        $this->load->view('sections/footer');

        $this->load->view('templates/footer');
        
    }

    public function terms_and_conditions() {

        $data = [
            'title'         => 'Terms and Conditions',
            'header_img'    => 'header.jpg',
        ];

        $this->load->view('templates/header', $data);

        $this->load->view('sections/navbar', $data);
        $this->load->view('sections/header', $data);
        $this->load->view('sections/terms_and_conditions');
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');

    }

    public function _404() {
        $this->load->view('_404');
        $this->load->view('templates/footer');
    }

    public function test() {
        $data = [
            'jobseekers' => $this->jobseeker_model->get_jobseekers(),
        ];
        
        $this->load->view('test', $data);
    }
}