<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // SET DATA
    protected function set_data($title) {
        $userdata = NULL;

        if ( $this->session->has_userdata('userType') ) {
            $userType = $this->session->userType;

            if ( $userType == 'Job Seeker' ) {
                $userdata = $this->JBSK_model->get_info();
            } else if ( $userType == 'Employer' ) {
                $userdata = $this->EMPL_model->get_info();
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

    // LOAD MAIN VIEW
    protected function load_main_view($title, $bodyView) {
        $data = $this->set_data($title);

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar', $data['userdata']);

        if ( $bodyView == 'index' ) {
            if ($this->session->userType == 'Job Seeker') {
                $posts = $this->JBSK_model->view_recent_posts(0, 10);
            } else {
                $posts = $this->VIEW_model->recent_posts(0, 10);
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
    public function index()                 {$this->load_main_view('Home', 'index');}

    // ABOUT US VIEW
    public function about_us()              {$this->load_main_view('About Us', 'about_us');}

    // TERMS AND CONDITIONS VIEW
    public function terms_and_conditions()  {$this->load_main_view('Terms and Conditions', 'terms_and_conditions');}
}