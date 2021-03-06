<?php

class Companies extends CI_Controller {

    // CONSTRUCTOR
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
    }
    
    // SET USER DATA
    private function set_data($title) {
        $userdata = NULL;

        if ( $this->session->has_userdata('userType') ) {
            if ($this->session->userType === 'Jobseeker') {
                $userdata = $this->JBSK_model->get_info();
            } else if ($this->session->userType === 'Employer' ) {
                $userdata = $this->EMPL_model->get_info();
            }

            $pageTitle = $userdata['userName'] . ' - ' . $title;
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

    // ==================================================================================================== //

    // COMPANY DETAILS VIEW
    public function details($employerID = NULL) {
        if ($employerID === NULL) {
            $this->AUTH_model->err_page();
        } else {
            $employerDetails = $this->MAIN_model->company_details($employerID);

            if ($employerDetails !== NULL) {
                $data = $this->set_data('Company Details');
                $data['employerDetails'] = $employerDetails;

                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar', $data['userdata']);
                $this->load->view('sections/company_information', $employerDetails);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->AUTH_model->err_page();
            }
        }
    }

    // AVAILABLE JOBS VIEW
    public function available_jobs($employerID = NULL, $page = 1) {
        if ($employerID == NULL) {
            $this->AUTH_model->err_page();
        } else {
            $totalRows = $this->MAIN_model->available_jobs_num($employerID);
            $fetchedRows = 10;
            $totalPages = ceil($totalRows / $fetchedRows);

            if ($page > 0 && $page <= $totalPages) {
                $offsetRows    = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                $AvailableJobs = $this->session->userType === 'Jobseeker' ? $this->JBSK_model->view_available_jobs($employerID, $offsetRows, $fetchedRows) : $this->MAIN_model->available_jobs($employerID, $offsetRows, $fetchedRows);
    
                $employerDetails = $this->MAIN_model->company_details($employerID);

                $config = [
                    'base_url'          => base_url() . 'companies/available_jobs/' . $employerID . '/',
                    'total_rows'        => $totalRows,
                    'use_page_numbers'  => TRUE,
                    'full_tag_open'     => '<nav><ul class="pagination justify-content-end">',
                    'full_tag_close'    => '</ul></nav>',
                    'attributes'        => [ 'class' => 'page-link' ],
                    'first_link'        => 'First',
                    'first_tag_open'    => '<li class="page-item">',
                    'first_tag_close'   => '</li>',
                    'prev_link'         => '<i class="fas fa-caret-left"></i>',
                    'prev_tag_open'     => '<li class="page-item">',
                    'prev_tag_close'    => '</li>',
                    'cur_tag_open'      => '<li class="page-item active"><span class="page-link">',
                    'cur_tag_close'     => '</span></li>',
                    'num_tag_open'      => '<li class="page-item">',
                    'num_tag_close'     => '</li>',
                    'next_link'         => '<i class="fas fa-caret-right"></i>',
                    'next_tag_open'     => '<li class="page-item">',
                    'next_tag_close'    => '</li>',
                    'last_link'         => 'Last',
                    'last_tag_open'     => '<li class="page-item">',
                    'last_tag_close'    => '<li>',
                ];

                $data = $this->set_data('Available Jobs');
                $data['posts']           = $AvailableJobs;
                $data['totalRows']       = $totalRows;
                $data['totalPages']      = $totalPages;
                $data['currentPage']     = $page;
                $data['employerDetails'] = $employerDetails;
                $data['employerID']      = $employerDetails->employerID;
                $data['companyName']     = $employerDetails->companyName;

                $this->pagination->initialize($config);

                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar', $data['userdata']);
                $this->load->view('sections/available_jobs', $data);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->AUTH_model->err_page();
            }
        }
    }
}