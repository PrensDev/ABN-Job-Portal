
<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function auth_login() {
        $FindUser_sql = "
            EXEC [FindUser]
                @email = '" . $this->input->post( 'email' ) . "'
        ";
        $query = $this->db->query($FindUser_sql);

        if(! $query) {
            echo $this->db->error();
        } else {

            $data = ['title' => 'Login'];

            if ( $query->num_rows() == 1 ) {
                $row = $query->row(0);
                if( password_verify( $this->input->post( 'password' ), $row->password ) ) {
                    if( $row->userType == 'Job Seeker' ) {
                        echo 'Job Seeker';
                    } else if ( $row->userType == 'Employer' ) {
                        echo 'Employer';
                    } else {
                        echo 'Inavlid User';
                    }
                } else {
                    $this->load->view('templates/fullpage_header', $data);
                    $this->load->view('sections/login_form');
                    $this->load->view('templates/footer');
                }
            } else {
                $this->load->view('templates/fullpage_header', $data);
                $this->load->view('sections/login_form');
                $this->load->view('templates/footer');
            }
        }
    }
}