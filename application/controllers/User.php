<?php

class User extends CI_Controller {

    public function index() {
        if ($this->session->has_userdata('userType')) {
            redirect();
        } else {
            redirect('user/login');
        }
    }

    // LOGIN VIEW
    public function login() {
        if ($this->session->has_userdata('USER_type')) {
            redirect();
        } else {
            $this->form_validation->set_rules([
                [
                    'field' => 'email',
                    'rules' => 'required',
                ],
                [
                    'field' => 'password',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required' => 'This is a required field',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $data = ['title' => 'Login'];
                $this->load->view('templates/fullpage_header', $data);
                $this->load->view('sections/login_form');
                $this->load->view('templates/footer');
            } else {
                $this->AUTH_model->login();
            }
        }
    }
    
    // JOBSEEKER REGISTRATION VIEW
    public function jobseeker_registration() {
        if ($this->session->has_userdata('USER_type')) {
            redirect();
        } else {
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
                [
                    'field' => 'email',
                    'rules' => 'required|valid_email|is_unique[UserAccounts.email]',
                ],
                [
                    'field' => 'password',
                    'rules' => 'required|min_length[8]',
                ],
                [
                    'field' => 'retypePassword',
                    'rules' => 'required|matches[password]',
                ],
                [
                    'field' => 'agreement',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required'      => 'This is a required field',
                'is_unique'     => 'This email is already used.',
                'valid_email'   => 'This email contains invalid characters',
                'min_length'    => 'Your password must be 8 characters and above',
                'matches'       => 'It doesn\'t match to your password',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $data = [        
                    'title'         => 'Register as Job Seeker',
                    'header'        => 'Register as Job Seeker',
                    'header_img'    => 'header.jpg',
                ];

                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar', $data);
                $this->load->view('sections/jobseeker_regform', $data);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->AUTH_model->register_jobseeker();
            }
        }
    }

    // EMPLOYER REGISTRATION VIEW
    public function employer_registration() {
        if ($this->session->has_userdata('USER_type')) {
            redirect();
        } else {
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
                [
                    'field' => 'email',
                    'rules' => 'required|valid_email|is_unique[UserAccounts.email]',
                ],
                [
                    'field' => 'password',
                    'rules' => 'required|min_length[8]',
                ],
                [
                    'field' => 'retypePassword',
                    'rules' => 'required|matches[password]',
                ],
                [
                    'field' => 'agreement',
                    'rules' => 'required',
                ],
            ]);

            $this->form_validation->set_message([
                'required'      => 'This is a required field',
                'is_unique'     => 'This email is already used.',
                'valid_email'   => 'This email contains invalid characters',
                'min_length'    => 'Your password must be 8 characters and above',
                'matches'       => 'It doesn\'t match to your password',
            ]);

            if ($this->form_validation->run() === FALSE) {
                $data = [        
                    'title'         => 'Register as Employer',
                    'header'        => 'Register as Employer',
                    'header_img'    => 'header.jpg',
                ];

                $this->load->view('templates/header', $data);
                $this->load->view('sections/navbar', $data);
                $this->load->view('sections/employer_regform', $data);
                $this->load->view('sections/footer');
                $this->load->view('templates/footer');
            } else {
                $this->AUTH_model->register_employer();
            }
        }
    }
}