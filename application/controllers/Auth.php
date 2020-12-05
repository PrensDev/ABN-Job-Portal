<?php

class Auth extends CI_Controller {

    public function information() {
        if($this->session->has_userdata('userType')) {
            $userType = $this->session->userType;
            
            if ( $userType == 'Job Seeker' ) {
                $data = [
                    'title' => 'Information',
                    'header_img' => 'jobseeker_header.jpg',
                ];
            }
            
            if ( $userType == 'Employer' ) {
                $data = [
                    'title' => 'Information',
                    'header_img' => '',
                ];
            } 

            

            $this->load->view('templates/header', $data);
            $this->load->view('sections/header', $data);
            $this->load->view('test');
            $this->load->view('sections/footer');
            $this->load->view('templates/footer');
        } else {
            redirect();
        }
    }

}