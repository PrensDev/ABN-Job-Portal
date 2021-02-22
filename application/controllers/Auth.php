<?php

class Auth extends CI_Controller {

    // CONSTRUCTOR
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
    }

    // GET USER DATA
    private function get_userdata() {
        if ( $this->session->userType === 'Jobseeker' ) {
            return $this->JBSK_model->get_info();
        } else if ( $this->session->userType === 'Employer' ) {
            return $this->EMPL_model->get_info();
        }
    }

    // lOAD SESSIONED VIEW
    private function load_sess_view($view, $data = []) {
        if ($this->session->userType === 'Jobseeker') {
            $this->load->view('auth_sections/jobseeker/' . $view, $data);
        } else if ($this->session->userType === 'Employer') {
            $this->load->view('auth_sections/employer/' . $view, $data);
        }
    }

    // PAGINATION CONFIGURATION
    private function pagination_config($path, $numRows) {
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

    // RETURNS TRUE IS SESSION IS BY USERTYPE PARAM AND IF IT IS AJAX REQUEST
    private function is_user_ajax_request($userType) {
        return $this->session->userType === $userType && $this->input->is_ajax_request();
    }

    // USER AJAX REQUEST
    private function user_ajax_request($userType, $dataModel) {
        if($this->is_user_ajax_request($userType)) {
            $data['response'] = $dataModel ? 'success' : 'failed';    
            echo json_encode($data);
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // UPLOAD IMAGE
    public function upload_img() {
        if ($this->session->has_userdata('userType')) {
            $img = $this->input->post('img');
            $img_array1 = explode(';', $img);
            $img_array2 = explode(',', $img_array1[1]);
            $base64_decode = base64_decode($img_array2[1]);

            if ($this->session->userType === "Jobseeker") {
                $imgName = 'JBSK_' . time() . '.png';
                file_put_contents('public/img/jobseekers/' . $imgName, $base64_decode);
                $this->JBSK_model->set_profile_pic($imgName);
            } else if ($this->session->userType === "Employer") {
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
            redirect('auth/profile');
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // LOGOUT VIEW
    public function logout() {
        if ($this->session->has_userdata('userType') && $this->input->post('request') == 'logout') {
            session_destroy();
        } else {
            $this->AUTH_model->err_page();
        }
    }
    
    // PERMISSION VIEW
    public function permission() {
        if ($this->session->has_userdata('userType') && $this->session->has_userdata('request_permission')) {
            if ($this->session->userType === 'Jobseeker') {
                $userdata = $this->JBSK_model->get_info();
            } else if ($this->session->userType === 'Employer') {
                $userdata = $this->EMPL_model->get_info();
            } 
            
            $pagedata = ['title' => $userdata['userName'] . ' - Permission'];

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

    // CHANGE PASSWORD VIEW
    public function change_password() {
        if ($this->session->has_userdata('userType')) {
            if ($this->session->permission == 'change password') {
                if ($this->session->userType === 'Jobseeker') {
                    $userdata = $this->JBSK_model->get_info();
                } else if ($this->session->userType === 'Employer') {
                    $userdata = $this->EMPL_model->get_info();
                } 
                $pagedata = ['title' => $userdata['userName'] . ' - Change Password'];

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

                $this->form_validation->set_message([
                    'required'      => 'This is a required field',
                    'min_length'    => 'Your password must be 8 characters and above',
                    'matches'       => 'It doesn\'t match to your password',
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
                if ($this->session->userType === 'Jobseeker') {
                    $userdata = $this->JBSK_model->get_info();
                } else if ($this->session->userType === 'Employer') {
                    $userdata = $this->EMPL_model->get_info();
                } 
                $pagedata = ['title' => $userdata['userName'] . ' - Change Email'];

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
            $pagedata = ['title' => $userdata['userName'] . ' - Information'];

            if ($this->session->userType === 'Jobseeker') {
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
        if ($this->session->has_userdata('userType')) {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['userName'] . ' - Edit Information'];

            $this->form_validation->set_message(['required' => 'This field cannot be blank']);
            
            if ( $this->session->userType === 'Jobseeker' ) {
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
            } else if ( $this->session->userType === 'Employer' ) {
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
            $pagedata = ['title'=> $userdata['userName'] . ' - Settings'];

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
        if ($this->session->userType === 'Jobseeker') {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['userName'] . ' - Create Resume'];

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
    public function edit_resume() {
        if ($this->session->userType === 'Jobseeker') {
            $resumeData = $this->JBSK_model->view_resume();

            if ($resumeData != NULL && $resumeData->jobseekerID == $this->session->id) {
                $userdata = $this->get_userdata();
                $pagedata = ['title' => $userdata['userName'] . ' - Edit Resume'];

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
                    if ($this->JBSK_model->update_resume()) {
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
    public function remove_resume() {
        if ($this->is_user_ajax_request('Jobseeker')) {
            if ($this->JBSK_model->remove_resume()) {
                $this->session->set_flashdata('removed', 'success');
                $this->session->set_flashdata('component', 'resume');
                $data['response'] = 'success';    
            } else {
                $this->session->set_flashdata('removed', 'failed');
                $data['response'] = 'failed';    
            }
            echo json_encode($data);
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // APPLICATIONS VIEW
    public function applications($statusPage = NULL, $page = 1) {
        if ($this->session->userType === 'Jobseeker') {
            if ($statusPage == NULL) {
                redirect('auth/applications/pending');
            } else {
                $status = [
                    'pending'       => 'Pending',
                    'hired'         => 'Hired',
                    'rejected'      => 'Rejected',
                ];
                
                if (array_key_exists($statusPage, $status)) {
                    $userdata = $this->get_userdata();
                    $JobsToStatusNum = $this->JBSK_model->applied_jobs_to_status_num($statusPage);

                    $PendingJobsNum       = $this->JBSK_model->applied_jobs_to_status_num('Pending');
                    $HiredJobsNum         = $this->JBSK_model->applied_jobs_to_status_num('Hired');
                    $RejectedJobsNum      = $this->JBSK_model->applied_jobs_to_status_num('Rejected');

                    $pagedata = [
                        'title'      => $userdata['userName'] . ' - ' . $status[$statusPage] . ' applications',
                        'statusPage' => $status[$statusPage],
                        'pendingJobsNum'        => $PendingJobsNum,
                        'hiredJobsNum'          => $HiredJobsNum,
                        'rejectedJobsNum'       => $RejectedJobsNum,
                    ];

                    if ($JobsToStatusNum == 0) {
                        $this->load->view('templates/header', $pagedata);
                        $this->load->view('sections/navbar', $userdata);
                        $this->load->view('auth_sections/jobseeker/empty_applications', $pagedata);
                        $this->load->view('sections/footer');
                        $this->load->view('templates/footer');
                    } else {
                        $fetchedRows = 10;
                        $totalPages = ceil($JobsToStatusNum / $fetchedRows);

                        if ($page > 0 && $page <= $totalPages) {
                            $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                            $posts      = $this->JBSK_model->applied_jobs_to_status($statusPage, $offsetRows, $fetchedRows); 
                            
                            $pagedata = [
                                'title'                 => $userdata['userName'] . ' - ' . $status[$statusPage] . ' applications',
                                'posts'                 => $posts,
                                'totalRows'             => $JobsToStatusNum,
                                'totalPages'            => $totalPages,
                                'currentPage'           => $page,
                                'statusPage'            => $status[$statusPage],
                                'pendingJobsNum'        => $PendingJobsNum,
                                'hiredJobsNum'          => $HiredJobsNum,
                                'rejectedJobsNum'       => $RejectedJobsNum,
                            ];
                            
                            $this->pagination->initialize($this->pagination_config('auth/applications/' . $statusPage, $JobsToStatusNum));
                            
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
        $this->user_ajax_request('Jobseeker', $this->JBSK_model->submit_application());
    }

    // CANCEL APPLICATION
    public function cancel_application() {
        $this->user_ajax_request('Jobseeker', $this->JBSK_model->cancel_application());
    }

    // BOOKMARKS
    public function bookmarks($page = 1) {
        if ($this->session->userType === 'Jobseeker') {
            $userdata = $this->get_userdata();
            $pagedata = ['title' => $userdata['userName'] . ' - Bookmarks'];

            $AllAppliedJobs = $this->JBSK_model->bookmarks_num();

            if ($AllAppliedJobs == 0) {
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/jobseeker/empty_bookmarks');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');   
            } else {
                $fetchedRows = 10;
                $totalPages = ceil($AllAppliedJobs / $fetchedRows);

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $posts      = $this->JBSK_model->get_bookmarks($offsetRows, $fetchedRows); 
                    
                    $pagedata = [
                        'title'         => $userdata['userName'] . ' - Bookmarks',
                        'posts'         => $posts,
                        'totalRows'     => $AllAppliedJobs,
                        'totalPages'    => $totalPages,
                        'currentPage'   => $page,
                    ];
                    
                    $this->pagination->initialize($this->pagination_config('auth/bookmarks', $AllAppliedJobs));
                    
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);                    
                    $this->load->view('auth_sections/jobseeker/bookmarks', $pagedata);
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

    // ADD BOOKMARK
    public function add_bookmark() {
        $this->user_ajax_request('Jobseeker', $this->JBSK_model->add_bookmark());
    }

    // REMOVE BOOKMARK
    public function remove_bookmark() {
        $this->user_ajax_request('Jobseeker', $this->JBSK_model->remove_bookmark());
    }

    // JOBSEEKER NOTIFICATIONS
    public function notifications($page = 1) {
        if ($this->session->userType === 'Jobseeker') {
            $userdata = $this->get_userdata();
            $pagedata['title'] = $userdata['userName'] . ' - Notifications';

            $AllStatusNotificationsNum = $this->JBSK_model->status_notifications_num();

            if ($AllStatusNotificationsNum == 0) {
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/jobseeker/empty_notifications');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $fetchedRows = 10;
                $totalPages = ceil($AllStatusNotificationsNum / $fetchedRows);

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows     = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $notifications  = $this->JBSK_model->get_status_notifications($offsetRows, $fetchedRows); 
                    
                    $pagedata = [
                        'title'         => $userdata['userName'] . ' - Notifications',
                        'notifications' => $notifications,
                        'totalRows'     => $AllStatusNotificationsNum,
                        'totalPages'    => $totalPages,
                        'currentPage'   => $page,
                    ];
                    
                    $this->pagination->initialize($this->pagination_config('auth/bookmarks', $AllStatusNotificationsNum));
                    
                    $this->load->view('templates/header', $pagedata);
                    $this->load->view('sections/navbar', $userdata);                    
                    $this->load->view('auth_sections/jobseeker/notifications', $pagedata);
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

    // SET NOTIFICATION READFLAG
    public function set_notification_readflag() {
        $this->user_ajax_request('Jobseeker', $this->JBSK_model->set_notification_readflag());
    }

    // ==================================================================================================== //
    // EMPLOYER VIEWS
    // ==================================================================================================== //

    // JOB POSTS VIEW
    public function job_posts($page = 1) {
        if ( $this->session->userType === 'Employer' ) {
            $userdata = $this->get_userdata();
            $pagedata['title'] = $userdata['userName'] . ' - Job Posts';
            
            $PostsNum = $this->EMPL_model->posts_num();

            if ($PostsNum == 0) {    
                $this->load->view('templates/header', $pagedata);
                $this->load->view('sections/navbar', $userdata);
                $this->load->view('auth_sections/employer/empty_job_posts');
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $fetchedRows = 10;
                $totalPages = ceil($PostsNum / $fetchedRows);

                if ($page > 0 && $page <= $totalPages) {
                    $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                    $posts      = $this->EMPL_model->get_posts($offsetRows, $fetchedRows); 
                    
                    $pagedata = [
                        'title'         => $userdata['userName'] . ' - Job Posts',
                        'posts'         => $posts,
                        'totalRows'     => $PostsNum,
                        'totalPages'    => $totalPages,
                        'currentPage'   => $page,
                    ];
                    
                    $this->pagination->initialize($this->pagination_config('auth/job_posts', $PostsNum));
                    
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
        if ($this->session->userType === 'Employer' && $jobPostID !== NULL) {
            $userdata   = $this->get_userdata();
            $jobDetails = $this->EMPL_model->get_job_details($jobPostID);

            if ($jobDetails) {
                $jobDetails['pendingApplicantsNum'] = $this->EMPL_model->applicants_num($jobPostID, 'Pending');
                $jobDetails['hiredApplicantsNum']   = $this->EMPL_model->applicants_num($jobPostID, 'Hired');

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
            } else {
                $this->AUTH_model->err_page();
            }
        } else {
            $this->AUTH_model->err_page();
        }
    }

    // POST NEW JOB VIEW
    public function post_new_job() {
        if ( $this->session->userType === 'Employer' ) {

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
                $pagedata = ['title' => $userdata['userName'] . ' - Job Posts'];

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
        if ( $this->session->userType === 'Employer' ) {
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
                        $pagedata = ['title' => $userdata['userName'] . ' - Edit Job Post'];
    
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
    public function delete_post() {
        if ($this->is_user_ajax_request('Employer')) {
            $postDeleted = $this->EMPL_model->delete_post();
            if ($postDeleted) {
                $this->session->set_flashdata('removed', 'success');
                $this->session->set_flashdata('component', 'job post');
                $data['response'] = 'success';    
            } else {
                $this->session->set_flashdata('removed', 'failed');
                $data['response'] = 'failed';    
            }  
            echo json_encode($data);
        } else {
            $this->AUTH_model->err_page();
        }      
    }

    // MANAGE APPLICANTS
    public function manage_applicants($jobPostID = NULL, $statusPage = NULL, $page = 1) {
        if ($this->session->userType === 'Employer') {
            if ($jobPostID == NULL) {
                redirect('auth/job_posts');
            } else {
                if ($statusPage == NULL) {
                    redirect('auth/manage_applicants/' . $jobPostID . '/pending');
                } else {
                    $jobExists =$this->EMPL_model->get_job_details($jobPostID);
                    
                    if ($jobExists) {
                        $status = [
                            'pending'       => 'Pending',
                            'hired'         => 'Hired',
                            'rejected'      => 'Rejected',
                        ];
        
                        if (array_key_exists($statusPage, $status)) {
                            $CurrApplicantsNum          = $this->EMPL_model->applicants_num($jobPostID, $status[$statusPage]);
    
                            $pendingApplicantsNum       = $this->EMPL_model->applicants_num($jobPostID, 'Pending');
                            $hiredApplicantsNum         = $this->EMPL_model->applicants_num($jobPostID, 'Hired');
                            $rejectedApplicantsNum      = $this->EMPL_model->applicants_num($jobPostID, 'Rejected');
                            
                            $userdata = $this->EMPL_model->get_info();
                            $jobDetails = $this->EMPL_model->get_job_details($jobPostID);
    
                            $pagedata = [
                                'title'                     => $userdata['userName'] . ' - Manage Applicants (' . $status[$statusPage] . ')',
                                'jobTitle'                  => $jobDetails['jobTitle'],
                                'jobPostID'                 => $jobDetails['jobPostID'],
                                'statusPage'                => $status[$statusPage],
                                'pendingApplicantsNum'      => $pendingApplicantsNum,
                                'hiredApplicantsNum'        => $hiredApplicantsNum,
                                'rejectedApplicantsNum'     => $rejectedApplicantsNum,
                            ];
                            
                            if ($CurrApplicantsNum == 0) {
                                $this->load->view('templates/header', $pagedata);
                                $this->load->view('sections/navbar', $userdata);
                                $this->load->view('auth_sections/employer/empty_applicants', $pagedata);
                                $this->load->view('sections/footer');
                                $this->load->view('templates/footer');
                            } else {
                                $fetchedRows = 10;
                                $totalPages = ceil($CurrApplicantsNum / $fetchedRows);
                                
                                if ($page > 0 && $page <= $totalPages) {
                                    $offsetRows = $page == 1 ? 0 : ($page - 1) * $fetchedRows;
                                    $applicants = $this->EMPL_model->view_applicants($offsetRows, $fetchedRows, $jobPostID, $status[$statusPage]); 
                                    
                                    $pagedata = [
                                        'title'                     => $userdata['userName'] . ' - Manage Applicants (' . $status[$statusPage] . ')',
                                        'applicants'                => $applicants,
                                        'totalRows'                 => $CurrApplicantsNum,
                                        'totalPages'                => $totalPages,
                                        'currentPage'               => $page,
                                        'jobTitle'                  => $jobDetails['jobTitle'],
                                        'jobPostID'                 => $jobDetails['jobPostID'],
                                        'statusPage'                => $status[$statusPage],
                                        'pendingApplicantsNum'      => $pendingApplicantsNum,
                                        'hiredApplicantsNum'        => $hiredApplicantsNum,
                                        'rejectedApplicantsNum'     => $rejectedApplicantsNum,
                                    ];
                                    
                                    $this->pagination->initialize($this->pagination_config('auth/manage_applicants/' . $jobPostID, $CurrApplicantsNum));
                                    
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
        if ($this->session->userType === 'Employer' && $jobseekerID != NULL && $jobPostID != NULL) {
            $ApplicantDetails = $this->EMPL_model->view_applicant_profile($jobseekerID, $jobPostID);
                
            if ($ApplicantDetails == NULL) {
                $this->AUTH_model->err_page();
            } else {
                $userdata = $this->EMPL_model->get_info();
                $pagedata = ['title' => $userdata['userName'] . ' - Applicant Profile'];

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
        $this->user_ajax_request('Employer', $this->EMPL_model->hire_applicant());
    }

    // REJECT APPLICANT
    public function reject_applicant() {
        $this->user_ajax_request('Employer', $this->EMPL_model->reject_applicant());
    }

    // CANCEL HIRING AND REJECTING
    public function cancel_hiring_rejecting() {
        $this->user_ajax_request('Employer', $this->EMPL_model->cancel_hiring_rejecting());
    }
}