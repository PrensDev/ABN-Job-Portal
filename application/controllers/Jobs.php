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
            'userdata'      => $userdata,
        ];

        return $data;
    }

    protected function set_jobpage_data($title, $bodyTitle, $bodySubtitle, $posts, $totalRows, $currentPage, $totalPages) {
        $data = $this->set_data($title);

        $data['bodyTitle']    = $bodyTitle;
        $data['bodySubtitle'] = $bodySubtitle;
        $data['posts']        = $posts;
        $data['totalRows']    = $totalRows;
        $data['currentPage']  = $currentPage;
        $data['totalPages']   = $totalPages;

        return $data;
    }


    // ==================================================================================================== //


    // JOBS VIEW / INDEX
    public function index() {
        $data = $this->set_data('Jobs');

        $this->load->view('templates/header', $data);
        $this->load->view('sections/navbar', $data['userdata']);
        $this->load->view('sections/search_fullpage');
        $this->load->view('sections/footer');
        $this->load->view('templates/footer');
    }


    // JOB DETAILS VIEW
    public function details($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $jobDetails = $this->View_model->job_details($jobPostID);
            if (! $jobDetails) {
                $this->Auth_model->err_page();
            } else {
                $data = $this->set_data('Job Details');

                if ($this->session->userType == "Job Seeker") {
                    $applied = $this->Jobseeker_model->is_job_applied($jobPostID);
                    if ($applied) {
                        $jobDetails['status']        = $applied->status;
                        $jobDetails['dateApplied']   = $applied->dateApplied;
                    }
                }
    
                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar', $data['userdata']);
                $this->load->view('sections/job_details', $jobDetails);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            }
        }
    }


    // RECENT JOB LIST 
    public function recent($page = 1) {
        $AllRecentPosts     = $this->View_model->all_recent_posts();
        $totalRows = $AllRecentPosts->num_rows();
        $fetchedRows = 10;
        $totalPages = ceil($totalRows / $fetchedRows);
        
        if ($page > 0 && $page <= $totalPages) {
            $offsetRows         = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
            $RecentPosts = $this->View_model->recent_posts($offsetRows, $fetchedRows); 

            $data = $this->set_jobpage_data(
                'Recent Jobs',
                'Recent Jobs',
                'Here are the list of the most recent available jobs',
                $RecentPosts,
                $totalRows,
                $page,
                $totalPages
            );

            $config = [
                'base_url'          => base_url() . 'jobs/recent/',
                'total_rows'        => $AllRecentPosts->num_rows(),
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

            $this->pagination->initialize($config);
            
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/search_header');
            $this->load->view('sections/job_list', $data);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->Auth_model->err_page();
        }
    }


    public function search() {
        
    }
}