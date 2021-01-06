<?php

class Jobs extends CI_Controller {
    
    // SET DATA
    private function set_data($title) {
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

    // SET JOBPAGE DATA
    private function set_jobpage_data($title, $bodyTitle, $bodySubtitle, $posts, $totalRows, $currentPage, $totalPages) {
        $data = $this->set_data($title);

        $data['bodyTitle']    = $bodyTitle;
        $data['bodySubtitle'] = $bodySubtitle;
        $data['posts']        = $posts;
        $data['totalRows']    = $totalRows;
        $data['currentPage']  = $currentPage;
        $data['totalPages']   = $totalPages;

        return $data;
    }

    // GET ALL RECENT POSTS
    private function get_all_recent_posts() {
        if ($this->session->userType == 'Job Seeker') {
            return $this->Jobseeker_model->view_all_recent_posts();
        } else {
            return $this->View_model->all_recent_posts();
        }
    }

    // GET RECENT POSTS
    private function get_recent_posts($offsetRows, $fetchedRows) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->Jobseeker_model->view_recent_posts($offsetRows, $fetchedRows);
        } else {
            return $this->View_model->recent_posts($offsetRows, $fetchedRows); 
        }
    }

    // GET ALL SEARCH RESULT
    private function get_all_search_result() {
        if ($this->session->userType == 'Job Seeker') {
            return $this->Jobseeker_model->view_all_search_result();
        } else {
            return $this->View_model->all_search_result();
        }
    }

    // GET SEARCH RESULT
    private function get_search_result($offsetRows, $fetchedRows) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->Jobseeker_model->view_search_result($offsetRows, $fetchedRows);
        } else {
            return $this->View_model->search_result($offsetRows, $fetchedRows); 
        }
    }

    // GET JOB DETAILS
    private function get_job_details($jobPostID) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->Jobseeker_model->job_details($jobPostID);
        } else {
            return $this->View_model->job_details($jobPostID);
        }
    }

    // ==================================================================================================== //

    // JOBS VIEW / INDEX
    public function index() {
        $data = $this->set_data('Jobs');

        if ($this->input->get() == NULL) {
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/search_fullpage');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            if ($this->input->get('keyword') == NULL && $this->input->get('place') == NULL) {
                redirect('jobs');
            } else {
                $AllSearchResult = $this->get_all_search_result();
                $totalRows = $AllSearchResult->num_rows();
                $fetchedRows = 10;
                $totalPages = ceil($totalRows / $fetchedRows);
                
                $page = 1;

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows         = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $RecentPosts = $this->get_search_result($offsetRows, $fetchedRows);
                    
                    $data = $this->set_jobpage_data(
                        'Search Result',
                        'Search Result',
                        'Here are the result of your search',
                        $RecentPosts,
                        $totalRows,
                        $page,
                        $totalPages
                    );

                    $config = [
                        'base_url'          => base_url() . 'jobs/recent/',
                        'total_rows'        => $AllSearchResult->num_rows(),
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
        }
    }
    
    // JOB DETAILS VIEW
    public function details($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->Auth_model->err_page();
        } else {
            $jobDetails = $this->get_job_details($jobPostID);
            if (! $jobDetails) {
                $this->Auth_model->err_page();
            } else {
                $data = $this->set_data('Job Details');    
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
        $AllRecentPosts = $this->get_all_recent_posts();
        $totalRows = $AllRecentPosts->num_rows();
        $fetchedRows = 10;
        $totalPages = ceil($totalRows / $fetchedRows);
        
        if ($page > 0 && $page <= $totalPages) {
            $offsetRows  = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
            $RecentPosts = $this->get_recent_posts($offsetRows, $fetchedRows);

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
}