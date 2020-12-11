<?php

class Companies extends CI_Controller {
    
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
            'userdata'      => $userdata,
        ];

        return $data;
    }


    // COMPANY DETAILS VIEW
    public function details($employerID = NULL) {
        if ($employerID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $employerDetails = $this->View_model->view_company_details($employerID);

            $data = $this->set_data('Company Details');

            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/company_details', $employerDetails);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        }
    }

    public function available_jobs($employerID = NULL) {
        if ($employerID == NULL) {
            $this->Auth_model->err_page();
        } else {
            echo $employerID;
        }
    }

}