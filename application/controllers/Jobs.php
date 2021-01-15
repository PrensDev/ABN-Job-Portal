<?php

class Jobs extends CI_Controller {
    
    // SET DATA
    private function set_data($title) {
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
    private function recent_posts_num() {
        if ($this->session->userType == 'Job Seeker') {
            return $this->JBSK_model->recent_posts_num();
        } else {
            return $this->MAIN_model->recent_posts_num();
        }
    }

    // GET RECENT POSTS
    private function get_recent_posts($offsetRows, $fetchedRows) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->JBSK_model->view_recent_posts($offsetRows, $fetchedRows);
        } else {
            return $this->MAIN_model->recent_posts($offsetRows, $fetchedRows); 
        }
    }

    // GET ALL SEARCH RESULT
    private function search_result_num() {
        if ($this->session->userType == 'Job Seeker') {
            return $this->JBSK_model->search_result_num();
        } else {
            return $this->MAIN_model->search_result_num();
        }
    }

    // GET SEARCH RESULT
    private function get_search_result($offsetRows, $fetchedRows) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->JBSK_model->view_search_result($offsetRows, $fetchedRows);
        } else {
            return $this->MAIN_model->search_result($offsetRows, $fetchedRows); 
        }
    }

    // GET JOB DETAILS
    private function get_job_details($jobPostID) {
        if ($this->session->userType == 'Job Seeker') {
            return $this->JBSK_model->job_details($jobPostID);
        } else {
            return $this->MAIN_model->job_details($jobPostID);
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
            $keyword = $this->input->get('keyword');
            $place   = $this->input->get('place');

            if ($keyword == NULL && $place == NULL) {
                redirect('jobs');
            } else {
                $totalRows = $this->search_result_num();
                $fetchedRows = 10;
                $totalPages = ceil($totalRows / $fetchedRows);

                if ($this->input->get('page') == NULL) {
                    $page = 1;
                } else {
                    $page = $this->input->get('page');
                }

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows         = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $RecentPosts = $this->get_search_result($offsetRows, $fetchedRows);
                    
                    if ($keyword != NULL && $place != NULL) {
                        $bodySubtitle = 'You searched for "' . $keyword . '" in "' . $place . '".';
                    } else if ($keyword != NULL && $place == NULL) {
                        $bodySubtitle = 'You searched for "' . $keyword . '".';
                    } else if ($keyword == NULL && $place != NULL) {
                        $bodySubtitle = 'You searched available jobs in "' . $place . '".';
                    }

                    $data = $this->set_jobpage_data(
                        'Search Result',
                        'Search Result',
                        $bodySubtitle,
                        $RecentPosts,
                        $totalRows,
                        $page,
                        $totalPages
                    );

                    $config = [
                        'reuse_query_string'    => TRUE,
                        'use_page_numbers'      => TRUE,
                        'page_query_string'     => TRUE,
                        'total_rows'            => $totalRows,
                        'query_string_segment'  => 'page',
                        'full_tag_open'         => '<nav><ul class="pagination justify-content-end">',
                        'full_tag_close'        => '</ul></nav>',
                        'attributes'            => [ 'class' => 'page-link' ],
                        'first_link'            => 'First',
                        'first_tag_open'        => '<li class="page-item">',
                        'first_tag_close'       => '</li>',
                        'prev_link'             => '<i class="fas fa-caret-left"></i>',
                        'prev_tag_open'         => '<li class="page-item">',
                        'prev_tag_close'        => '</li>',
                        'cur_tag_open'          => '<li class="page-item active"><span class="page-link">',
                        'cur_tag_close'         => '</span></li>',
                        'num_tag_open'          => '<li class="page-item">',
                        'num_tag_close'         => '</li>',
                        'next_link'             => '<i class="fas fa-caret-right"></i>',
                        'next_tag_open'         => '<li class="page-item">',
                        'next_tag_close'        => '</li>',
                        'last_link'             => 'Last',
                        'last_tag_open'         => '<li class="page-item">',
                        'last_tag_close'        => '<li>',
                    ];

                    $this->pagination->initialize($config);
                    
                    $this->load->view('templates/header', $data);
                    $this->load->view('sections/navbar', $data['userdata']);
                    $this->load->view('sections/search_header');
                    $this->load->view('sections/job_list', $data);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    $data = $this->set_data('Search Result');
                    $data['bodyTitle'] = 'Search Result';
                    $data['bodySubtitle'] = 'No result are found.';

                    $this->load->view('templates/header', $data);
                    $this->load->view('sections/navbar', $data['userdata']);
                    $this->load->view('sections/search_header');
                    $this->load->view('sections/empty_job_list', $data);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                }
            }
        }
    }
    
    // JOB DETAILS VIEW
    public function details($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->AUTH_model->err_page();
        } else {
            $jobDetails = $this->get_job_details($jobPostID);
            if (! $jobDetails) {
                $this->AUTH_model->err_page();
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
        $totalRows   = $this->recent_posts_num();
        $fetchedRows = 10;
        $totalPages  = ceil($totalRows / $fetchedRows);
        
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

            $this->pagination->initialize($config);
            
            $this->load->view('templates/header', $data);
            $this->load->view('sections/navbar', $data['userdata']);
            $this->load->view('sections/search_header');
            $this->load->view('sections/job_list', $data);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->AUTH_model->err_page();
        }
    }
}