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


    // ==================================================================================================== //


    // COMPANY DETAILS VIEW
    public function details($employerID = NULL) {
        if ($employerID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $employerDetails = $this->View_model->company_details($employerID);

            $data = $this->set_data('Company Details');
            $data['employerDetails'] = $employerDetails;

            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/company_information', $employerDetails);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        }
    }


    // AVAILABLE JOBS VIEW
    public function available_jobs($employerID = NULL, $page = 1) {
        if ($employerID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $AllAvailableJobs = $this->View_model->all_available_jobs($employerID);
            $totalRows = $AllAvailableJobs->num_rows();
            $fetchedRows = 10;
            $totalPages = ceil($totalRows / $fetchedRows);

            if ($page > 0 && $page <= $totalPages) {
                $offsetRows    = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                $AvailableJobs = $this->session->userType == 'Job Seeker' ? $this->Jobseeker_model->view_available_jobs($employerID, $offsetRows, $fetchedRows) : $this->View_model->available_jobs($employerID, $offsetRows, $fetchedRows);
    
                $employerDetails = $this->View_model->company_details($employerID);

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
                $this->Auth_model->err_page();
            }
        }
    }
}