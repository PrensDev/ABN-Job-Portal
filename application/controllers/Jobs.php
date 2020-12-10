<?php

class Jobs extends CI_Controller {

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

    public function index() {
        $data = $this->set_data('Jobs');

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar', $data['userdata']);
        $this->load->view('sections/search_header');
        $this->load->view('sections/job_list');
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }


    // JOB DETAILS VIEW
    public function details($jobPostID = NULL) {
        echo $jobPostID;
    }


    // RECENT JOBS VIEWS
    public function recent() {

    }


    // SEARCH RESULT VIEW
    public function search() {
        
    }

}