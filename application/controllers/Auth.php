<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // GET USER DATA
    protected function get_userdata() {
        if ( $this->session->userType == 'Job Seeker' ) {
            return $this->JBSK_model->get_info();
        } else if ( $this->session->userType == 'Employer' ) {
            return $this->EMPL_model->get_info();
        }
    }

    // lOAD SESSIONED VIEW
    protected function load_sess_view($view, $data = []) {
        if ($this->session->userType == 'Job Seeker') {
            $this->load->view('auth_sections/jobseeker/' . $view, $data);
        } else if ($this->session->userType == 'Employer') {
            $this->load->view('auth_sections/employer/' . $view, $data);
        }
    }

    // PAGINATION CONFIGURATION
    protected function pagination_config($path, $numRows) {
        return [
            'base_url'          => base_url() . $path . '/',
            'total_rows'        => $numRows,
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
    }

    // UPLOAD IMAGE
    public function upload_img() {
        if ($this->session->has_userdata('userType')) {
            $img = $this->input->post('img');
            $img_array1 = explode(';', $img);
            $img_array2 = explode(',', $img_array1[1]);
            $base64_decode = base64_decode($img_array2[1]);

            if ($this->session->userType == "Job Seeker") {
                $imgName = 'JBSK_' . time() . '.png';
                file_put_contents('public/img/jobseekers/' . $imgName, $base64_decode);
                $this->JBSK_model->set_profile_pic($imgName);
            } else if ($this->session->userType == "Employer") {
                $imgName = 'EMPL_' . time() . '.png';
                file_put_contents('public/img/employers/' . $imgName, $base64_decode);
                $this->EMPL_model->set_profile_pic($imgName);
            }
        }
    }

    // ==================================================================================================== //
    // USER MAIN VIEWS
    // ==================================================================================================== //

    // INDEX FUNCTION
    public function index() {
        if ($this->session->has_userdata('userType')) {
            redirect();
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // LOGOUT VIEW
    public function logout() {
        if ($this->session->has_userdata('userType')) {
            if($this->input->is_ajax_request() && $this->input->post('request') == 'logout') {
                session_destroy();
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // DEACTIVATE VIEW
    public function deactivate() {
        $this->AUTH_model->set_account_flag(0);
        session_destroy();
        redirect();
    }
    
    // PERMISSION VIEW
    public function permission() {
        if (! $this->session->has_userdata('userType')) {
            $this->AUTH_model->err_page();
        } else {
            if ($this->session->has_userdata('request_permission')) {
                if ($this->session->userType == 'Job Seeker') {
                    $userdata = $this->JBSK_model->get_info();
                } else if ($this->session->userType == 'Employer') {
                    $userdata = $this->EMPL_model->get_info();
                } 
                $pagedata = ['title' => $userdata['username'] . ' - Permission'];

                $this->form_validation->set_rules([
                    [
                        'field' => 'password',
                        'rules' => 'required',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {    
                    $this->session->keep_flashdata('request_permission');
                    $this->load->view('templates/fullpage_header', $pagedata);
                    $this->load->view('auth_sections/permission', $userdata);
                    $this->load->view('templates/footer');
                } else {
                    if (password_verify($this->input->post('password'), $this->AUTH_model->get_user_password())) {
                        if ($this->session->request_permission == 'change password') {
                            $this->session->unset_userdata('request_permission');
                            $this->session->set_flashdata(['permission' => 'change password']);
                            redirect('auth/change_password');
                        } else if ($this->session->request_permission == 'change email') {
                            $this->session->unset_userdata('request_permission');
                            $this->session->set_flashdata(['permission' => 'change email']);
                            redirect('auth/change_email');
                        }
                    } else {
                        $this->session->keep_flashdata('request_permission');
                        $this->session->set_flashdata('account_authentication', 'incorrect password');
                        redirect('auth/permission');
                    }
                }
            } else {
                $this->AUTH_model->err_page();
            }
        }
    }

    // CHANGE PASSWORD VIEW
    public function change_password() {
        if ($this->session->has_userdata('userType')) {
            if ($this->session->permission == 'change password') {
                if ($this->session->userType == 'Job Seeker') {
                    $userdata = $this->JBSK_model->get_info();
                } else if ($this->session->userType == 'Employer') {
                    $userdata = $this->EMPL_model->get_info();
                } 
                $pagedata = ['title' => $userdata['username'] . ' - Change Password'];

                $this->form_validation->set_rules([
                    [
                        'field' => 'newPassword',
                        'rules' => 'required|min_length[8]',
                    ],
                    [
                        'field' => 'retypeNewPassword',
                        'rules' => 'required|matches[newPassword]',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {    
                    $this->session->keep_flashdata('permission');
                    $this->load->view('templates/fullpage_header', $pagedata);
                    $this->load->view('auth_sections/change_password', $userdata);
                    $this->load->view('templates/footer');
                } else {
                    if ($this->AUTH_model->update_password()) {
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');
                    };
                    redirect('auth/settings');
                }
            } else {
                $this->session->set_flashdata([
                    'request_permission' => 'change password'
                ]);
                redirect('auth/permission');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // CHANGE EMAIL VIEW
    public function change_email() {
        if ($this->session->has_userdata('userType')) {
            if ($this->session->permission == 'change email') {
                if ($this->session->userType == 'Job Seeker') {
                    $userdata = $this->JBSK_model->get_info();
                } else if ($this->session->userType == 'Employer') {
                    $userdata = $this->EMPL_model->get_info();
                } 
                $pagedata = ['title' => $userdata['username'] . ' - Change Email'];

                $this->form_validation->set_rules([
                    [
                        'field' => 'email',
                        'rules' => 'required|valid_email|is_unique[UserAccounts.email]',
                    ],
                ]);

                $this->form_validation->set_message([
                    'required'      => 'This is a required field',
                    'is_unique'     => 'This email is already used.',
                    'valid_email'   => 'This email contains invalid characters',
                ]);

                if ($this->form_validation->run() === FALSE) {    
                    $this->session->keep_flashdata('permission');
                    $this->load->view('templates/fullpage_header', $pagedata);
                    $this->load->view('auth_sections/change_email', $userdata);
                    $this->load->view('templates/footer');
                } else {
                    if ($this->AUTH_model->update_email()) {
                        $this->session->set_userdata(['email' => $this->input->post('email')]);
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');
                    }
                    redirect('auth/settings');
                }
            } else {
                $this->session->set_flashdata(['request_permission' => 'change email']);
                redirect('auth/permission');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // USER INFORMATION VIEW
    public function profile() {
        if( $this->session->has_userdata('userType') ) {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Information'];

            if ($this->session->userType == 'Job Seeker') {
                $userdata['resumeData'] = $this->JBSK_model->view_resume();
            }
            
            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);
            $this->load_sess_view('header', $userdata);
            $this->load_sess_view('profile', $userdata);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // EDIT INFORMATION VIEW
    public function edit_information() {
        if ( $this->session->has_userdata('userType')) {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Edit Information'];

            $this->form_validation->set_message(['required' => 'This field cannot be blank']);
            
            if ( $this->session->userType == 'Job Seeker' ) {
                $this->form_validation->set_rules([
                    [
                        'field' => 'firstName',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'lastName',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'birthDate',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'gender',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'cityProvince',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'contactNumber',
                        'rules' => 'required',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load_sess_view('edit_information_form', $userdata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    if ($this->JBSK_model->update_info()) {
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');
                    }
                    redirect('auth/settings');
                }
            } else if ( $this->session->userType == 'Employer' ) {
                $this->form_validation->set_rules([
                    [
                        'field' => 'companyName',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'street',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'brgyDistrict',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'cityProvince',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'description',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'website',
                        'rules' => 'valid_url',
                    ],
                    [
                        'field' => 'contactNumber',
                        'rules' => 'required',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load_sess_view('edit_information_form', $userdata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    if ($this->EMPL_model->update_info()) {
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');
                    }
                    redirect('auth/profile');
                }
            }
        } else {
            $this->AUTH_model->err_page();
        } 
    }

    // USER SETTINGS
    public function settings() {
        if( $this->session->has_userdata('userType') ) {
            $userdata = $this->get_userdata();
            $pagedata = ['title'=> $userdata['username'] . ' - Settings'];

            $this->load->view('templates/header', $pagedata);
            $this->load->view('sections/navbar', $userdata);
            $this->load_sess_view('header', $userdata);            
            $this->load->view('auth_sections/settings', $userdata);
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // ==================================================================================================== //
    // JOB SEEKER VIEWS
    // ==================================================================================================== //

    // CREATE RESUME VIEW
    public function create_resume() {
        if ($this->session->userType == 'Job Seeker') {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Create Resume'];

            $this->form_validation->set_message(['required' => 'This field cannot be blank']);

            $this->form_validation->set_rules([
                [
                    'field' => 'headline',
                    'rules' => 'required',
                ],
                [
                    'field' => 'description',
                    'rules' => 'required',
                ],
                [
                    'field' => 'education',
                    'rules' => 'required',
                ],
                [
                    'field' => 'skills',
                    'rules' => 'required',
                ],
                [
                    'field' => 'experiences',
                    'rules' => 'required',
                ],
            ]);

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load_sess_view('create_resume_form', $userdata);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                if ($this->JBSK_model->create_resume()) {
                    $this->session->set_flashdata('added', 'success');
                    $this->session->set_flashdata('component', 'resume');
                } else {
                    $this->session->set_flashdata('added', 'failed');
                }
                redirect('auth/profile');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // EDIT RESUME VIEW
    public function edit_resume($resumeID = NULL) {
        if ($this->session->userType == 'Job Seeker') {
            $resumeData = $this->JBSK_model->view_resume();

            if ($resumeData->resumeID == $resumeID) {
                $userdata = $this->get_userdata();
                $pagedata = ['title' => $userdata['username'] . ' - Edit Resume'];
                

                $this->form_validation->set_message(['required' => 'This field cannot be blank']);

                $this->form_validation->set_rules([
                    [
                        'field' => 'headline',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'description',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'education',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'skills',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'experiences',
                        'rules' => 'required',
                    ],
                ]);

                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);
                    $this->load_sess_view('edit_resume_form', $resumeData);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    if ($this->JBSK_model->update_resume($resumeID)) {
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');
                    }
                    redirect('auth/profile');
                }
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // REMOVE RESUME
    public function remove_resume($resumeID = NULL) {
        if ($this->session->userType == 'Job Seeker') {
            if ($resumeID == NULL) {
                $this->AUTH_model->err_page();
            } else {
                if ($this->JBSK_model->remove_resume($resumeID)) {
                    $this->session->set_flashdata('removed', 'success');
                    $this->session->set_flashdata('component', 'resume');
                } else {
                    $this->session->set_flashdata('removed', 'failed');
                }
                redirect('auth/profile');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // APPLICATIONS VIEW
    public function applications($statusPage = NULL, $page = 1) {
        if ($this->session->userType == "Job Seeker") {
            if ($statusPage == NULL) {
                redirect('auth/applications/pending');
            } else {
                $status = [
                    'pending'       => 'Pending',
                    'interviewing'  => 'Interviewing',
                    'hired'         => 'Hired',
                    'rejected'      => 'Rejected',
                ];
                
                if (array_key_exists($statusPage, $status)) {
                    $userdata = $this->get_userdata();
                    $AllJobApplications = $this->JBSK_model->all_applied_jobs($statusPage);

                    $pagedata = [
                        'title'      => $userdata['username'] . ' - ' . $status[$statusPage] . ' applications',
                        'statusPage' => $status[$statusPage]
                    ];

                    if ($AllJobApplications->result() == NULL) {
                        $this->load->view('templates/header', $pagedata);
                        $this->load->view('sections/navbar', $userdata);
                        $this->load->view('auth_sections/jobseeker/empty_applications', $pagedata);
                        $this->load->view('sections/footer');
                        $this->load->view('templates/footer');   
                    } else {
                        $numRows = $AllJobApplications->num_rows();
                        $fetchedRows = 10;
                        $totalPages = ceil($numRows / $fetchedRows);

                        if ($page > 0 && $page <= $totalPages) {
                            $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                            $posts      = $this->JBSK_model->applied_jobs($statusPage, $offsetRows, $fetchedRows); 
                            
                            $pagedata = [
                                'title'         => $userdata['username'] . ' - ' . $status[$statusPage] . ' applications',
                                'posts'         => $posts,
                                'totalRows'     => $numRows,
                                'totalPages'    => $totalPages,
                                'currentPage'   => $page,
                                'statusPage'    => $status[$statusPage],
                            ];
                            
                            $this->pagination->initialize($this->pagination_config('auth/applications/' . $statusPage, $numRows));
                            
                            $this->load->view('templates/header', $pagedata);
                            $this->load->view('sections/navbar', $userdata);                    
                            $this->load->view('auth_sections/jobseeker/applications', $pagedata);
                            $this->load->view('sections/footer');
                            $this->load->view('templates/footer');
                        } else {
                            $this->AUTH_model->err_page();
                        }
                    }         
                } else {
                    $this->AUTH_model->err_page();
                }
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // SUBMIT APPLICATION
    public function submit_application() {
        if ($this->session->userType == 'Job Seeker') {
            if ($this->input->is_ajax_request()) {
                $applicationStatus = $this->JBSK_model->submit_application();
                $data['response'] = $applicationStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // REJECT APPLICATION
    public function reject_application() {
        if ($this->session->userType == 'Job Seeker') {
            if ($this->input->is_ajax_request()) {
                $jobPostID = $this->input->post('jobPostID');
                $applicationStatus = $this->JBSK_model->reject_application($jobPostID);
                $data['response'] = $applicationStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // CANCEL APPLICATION
    public function cancel_application() {
        if ($this->session->userType == 'Job Seeker') {
            if ($this->input->is_ajax_request()) {
                $applicationStatus = $this->JBSK_model->cancel_application();
                $data['response'] = $applicationStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // BOOKMARKS
    public function bookmarks($page = 1) {
        if ($this->session->userType == "Job Seeker") {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['username'] . ' - Bookmarks'];

            $AllAppliedJobs = $this->JBSK_model->get_all_bookmarks();

            if ($AllAppliedJobs->result() == NULL) {
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/jobseeker/empty_bookmarks');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');   
            } else {
                $numRows = $AllAppliedJobs->num_rows();
                $fetchedRows = 10;
                $totalPages = ceil($numRows / $fetchedRows);

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $posts      = $this->JBSK_model->get_bookmarks($offsetRows, $fetchedRows); 
                    
                    $pagedata = [
                        'title'         => $userdata['username'] . ' - Bookmarks',
                        'posts'         => $posts,
                        'totalRows'     => $numRows,
                        'totalPages'    => $totalPages,
                        'currentPage'   => $page,
                    ];
                    
                    $this->pagination->initialize($this->pagination_config('auth/bookmarks', $numRows));
                    
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);                    
                    $this->load->view('auth_sections/jobseeker/bookmarks', $pagedata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                }
            }         
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // ADD BOOKMARK
    public function add_bookmark() {
        if ($this->session->userType == 'Job Seeker') {
            if ($this->input->is_ajax_request()) {
                $jobPostID = $this->input->post('jobPostID');
                $bookmarkStatus = $this->JBSK_model->add_bookmark($jobPostID);
                $data['response'] = $bookmarkStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        }
    }

    // REMOVE BOOKMARK
    public function remove_bookmark() {
        if ($this->session->userType == 'Job Seeker') {
            if ($this->input->is_ajax_request()) {
                $bookmarkID = $this->input->post('bookmarkID');
                $bookmarkStatus = $this->JBSK_model->remove_bookmark($bookmarkID);
                $data['response'] = $bookmarkStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        }
    }

    // ==================================================================================================== //
    // EMPLOYER VIEWS
    // ==================================================================================================== //

    // JOB POSTS VIEW
    public function job_posts($page = 1) {
        if ( $this->session->userType == 'Employer' ) {
            $userdata = $this->get_userdata();
            $pagedata['title'] = $userdata['username'] . ' - Job Posts';
            
            $AllPosts = $this->EMPL_model->get_all_posts();

            if ($AllPosts->result() == NULL) {    
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/empty_job_posts');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $numRows = $AllPosts->num_rows();
                $fetchedRows = 10;
                $totalPages = ceil($numRows / $fetchedRows);

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $posts      = $this->EMPL_model->get_posts($offsetRows, $fetchedRows); 
                    
                    $pagedata = [
                        'title'         => $userdata['username'] . ' - Job Posts',
                        'posts'         => $posts,
                        'totalRows'     => $numRows,
                        'totalPages'    => $totalPages,
                        'currentPage'   => $page,
                    ];
                    
                    $this->pagination->initialize($this->pagination_config('auth/job_posts', $numRows));
                    
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);                    
                    $this->load->view('auth_sections/employer/job_posts', $pagedata);
                    $this->load->view('sections/footer');
                    $this->load->view('templates/footer');
                } else {
                    $this->AUTH_model->err_page();
                }
            } 
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // JOB DETAILS VIEW
    public function job_details($jobPostID = NULL) {
        if ($jobPostID == NULL) {
            $this->AUTH_model->err_page();
        } else {
            $userdata   = $this->get_userdata();
            $jobDetails = $this->EMPL_model->get_job_details($jobPostID);

            if (! $jobDetails) {
                $this->AUTH_model->err_page();
            } else {
                $pagedata = ['title' => $jobDetails['jobTitle'] . ' - Job Details'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/job_details', $jobDetails);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            }
        }
    }

    // POST NEW JOB VIEW
    public function post_new_job() {
        if ( $this->session->userType == 'Employer' ) {
            $this->form_validation->set_rules([
                [
                    'field' => 'jobTitle',
                    'rules' => 'required',
                ],
                [
                    'field' => 'jobType',
                    'rules' => 'required',
                ],
                [
                    'field' => 'field',
                    'rules' => 'required',
                ],
                [
                    'field' => 'minSalary',
                    'rules' => 'required',
                ],
                [
                    'field' => 'maxSalary',
                    'rules' => 'required',
                ],
                [
                    'field' => 'description',
                    'rules' => 'required',
                ],
                [
                    'field' => 'responsibilities',
                    'rules' => 'required',
                ],
                [
                    'field' => 'skills',
                    'rules' => 'required',
                ],
                [
                    'field' => 'experiences',
                    'rules' => 'required',
                ],
                [
                    'field' => 'education',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required' => 'This is a required field',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $userdata = $this->EMPL_model->get_info();
                $pagedata = ['title' => $userdata['username'] . ' - Job Posts'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/post_new_job', $pagedata);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                if ($this->EMPL_model->post_new_job()) {
                    $this->session->set_flashdata('added', 'success');
                    $this->session->set_flashdata('component', 'job post');
                } else {
                    $this->session->set_flashdata('added', 'failed');
                }
                redirect('auth/job_posts');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // EDIT POST VIEW
    public function edit_post($jobPostID = NULL) {
        if ( $this->session->userType == 'Employer' ) {
            if ($jobPostID == NULL) {
                $this->AUTH_model->err_page();
            } else {
                $this->form_validation->set_rules([
                    [
                        'field' => 'jobTitle',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'jobType',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'field',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'minSalary',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'maxSalary',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'description',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'responsibilities',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'skills',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'experiences',
                        'rules' => 'required',
                    ],
                    [
                        'field' => 'education',
                        'rules' => 'required',
                    ],
                ]);
        
                $this->form_validation->set_message([
                    'required' => 'This field cannot be blank',
                ]);
        
                if ($this->form_validation->run() === FALSE) { 
                    $jobDetails = $this->EMPL_model->get_job_details($jobPostID);
                    if(! $jobDetails) {
                        $this->AUTH_model->err_page();
                    } else {
                        $userdata = $this->get_userdata();
                        $pagedata = ['title' => $userdata['username'] . ' - Edit Job Post'];
    
                        $this->load->view('templates/header', $pagedata);
                        $this->load->view('sections/navbar', $userdata);
                        $this->load->view('auth_sections/employer/edit_post_form', $jobDetails);
                        $this->load->view('sections/footer');
                        $this->load->view('templates/footer');
                    }
                } else {
                    if ($this->EMPL_model->update_post($jobPostID)) {
                        $this->session->set_flashdata('updated', 'success');
                    } else {
                        $this->session->set_flashdata('updated', 'failed');    
                    }
                    redirect('auth/job_details/' . $jobPostID);
                }
            }
        } else {
            $this->AUTH_model->err_page();
        }        
    }

    // DELETE POST VIEW
    public function delete_post($jobPostID = NULL) {
        if ($this->session->userType == 'Employer') {
            if ($jobPostID == NULL) {
                $this->AUTH_model->err_page();
            } else {
                if ($this->EMPL_model->delete_post($jobPostID)) {
                    $this->session->set_flashdata('removed', 'success');
                    $this->session->set_flashdata('component', 'job post');
                } else {
                    $this->session->set_flashdata('removed', 'failed');
                }
                redirect('auth/job_posts');
            }
        } else {
            $this->AUTH_model->err_page();
        }      
    }

    // MANAGE APPLICANTS
    public function manage_applicants($jobPostID = NULL, $statusPage = NULL, $page = 1) {
        if ($this->session->userType == 'Employer') {
            if ($jobPostID == NULL) {
                $this->AUTH_model->err_page();
            } else {
                if ($statusPage == NULL) {
                    redirect('auth/manage_applicants/' . $jobPostID . '/pending');
                } else {

                    $status = [
                        'pending'       => 'Pending',
                        'interviewing'  => 'Interviewing',
                        'hired'         => 'Hired',
                        'rejected'      => 'Rejected',
                    ];
    
                    if (array_key_exists($statusPage, $status)) {
                        $AllApplicants = $this->EMPL_model->view_all_applicants($jobPostID, $status[$statusPage]);
                        $userdata = $this->EMPL_model->get_info();
                        $jobDetails = $this->EMPL_model->get_job_details($jobPostID);

                        $pagedata = [
                            'title'      => $userdata['username'] . ' - Manage Applicants (' . $status[$statusPage] . ')',
                            'jobTitle'    => $jobDetails['jobTitle'],
                            'jobPostID'   => $jobDetails['jobPostID'],
                            'statusPage' => $status[$statusPage],
                        ];
                        
                        if ($AllApplicants->result() == NULL) {
                            $this->load->view('templates/header', $pagedata);
                            $this->load->view('sections/navbar', $userdata);
                            $this->load->view('auth_sections/employer/empty_applicants', $pagedata);
                            $this->load->view('sections/footer');
                            $this->load->view('templates/footer');
                        } else {
                            $numRows = $AllApplicants->num_rows();
                            $fetchedRows = 10;
                            $totalPages = ceil($numRows / $fetchedRows);
                            
                            if ($page > 0 && $page <= $totalPages) {
                                $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                                $posts      = $this->EMPL_model->view_applicants($offsetRows, $fetchedRows, $jobPostID, $status[$statusPage]); 
                                
                                $pagedata = [
                                    'title'       => $userdata['username'] . ' - Manage Applicants (' . $status[$statusPage] . ')',
                                    'posts'       => $posts,
                                    'totalRows'   => $numRows,
                                    'totalPages'  => $totalPages,
                                    'currentPage' => $page,
                                    'jobTitle'    => $jobDetails['jobTitle'],
                                    'jobPostID'   => $jobDetails['jobPostID'],
                                    'statusPage'  => $status[$statusPage],
                                ];
                                
                                $this->pagination->initialize($this->pagination_config('auth/manage_applicants/' . $jobPostID, $numRows));
                                
                                $this->load->view('templates/header', $pagedata);
                                $this->load->view('sections/navbar', $userdata);
                                $this->load->view('auth_sections/employer/manage_applicants', $pagedata);
                                $this->load->view('sections/footer');
                                $this->load->view('templates/footer');
                            } else {
                                $this->AUTH_model->err_page();
                            }
                        }
                        

                    } else {
                        $this->AUTH_model->err_page();
                    }
                }
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // APPICANT PROFILE
    public function applicant_profile($jobPostID = NULL, $jobseekerID = NULL) {
        if ($this->session->userType == 'Employer') {
            if ($jobseekerID == NULL || $jobPostID == NULL) {
                $this->AUTH_model->err_page();
            } else {
                $ApplicantDetails = $this->EMPL_model->view_applicant_profile($jobseekerID, $jobPostID);

                $userdata = $this->EMPL_model->get_info();
                $pagedata = ['title' => $userdata['username'] . ' - Applicant Profile'];

                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/applicant_profile', $ApplicantDetails);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // HIRE APPLICANT
    public function hire_applicant() {
        if ($this->session->userType == 'Employer') {
            if ($this->input->is_ajax_request()) {
                $hireStatus = $this->EMPL_model->hire_applicant();
                $data['response'] = $hireStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // REJECT APPLICANT
    public function reject_applicant() {
        if ($this->session->userType == 'Employer') {
            if ($this->input->is_ajax_request()) {
                $applicationID = $this->input->post('applicationID');
                $hireStatus = $this->EMPL_model->reject_applicant($applicationID);
                $data['response'] = $hireStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // CANCEL HIRING AND REJECTING
    public function cancel_hiring_rejecting() {
        if ($this->session->userType == 'Employer') {
            if ($this->input->is_ajax_request()) {
                $applicationID = $this->input->post('applicationID');
                $hireStatus = $this->EMPL_model->cancel_hiring_rejecting($applicationID);
                $data['response'] = $hireStatus ? 'success' : 'failed';    
                echo json_encode($data);
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }
}