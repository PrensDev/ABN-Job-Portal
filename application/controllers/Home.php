<?php

class Home extends CI_Controller {

    // CONSTRUCTOR
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
    }

    // SET USER DATA
    private function set_data($title) {
        $userdata = NULL;

        if ( $this->session->has_userdata('userType') ) {
            if ( $this->session->userType === 'Jobseeker' ) {
                $userdata = $this->JBSK_model->get_info();
            } else if ( $this->session->userType ==='Employer' ) {
                $userdata = $this->EMPL_model->get_info();
            }

            $pageTitle = $userdata['userName'] . ' - ' . $title;
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

    // LOAD MAIN VIEW
    private function load_main_view($title, $bodyView) {
        $data = $this->set_data($title);

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar', $data['userdata']);

        if ( $bodyView == 'index' ) {
            if ($this->session->userType === 'Jobseeker') {
                $posts = $this->JBSK_model->view_recent_posts(0, 10);
            } else {
                $posts = $this->MAIN_model->recent_posts(0, 10);
            }
            $data['posts'] = $posts;
            $this->load->view('index', $data);
        } else {
            $this->load->view('sections/header', $data);
            $this->load->view('sections/' . $bodyView, $data);
        }

        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }

    // ==================================================================================================== //

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
}