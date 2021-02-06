<?php

class AUTH_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // INSERTING USER VALUE IN UserAccounts TABLE
    private function register_user($userType) {
        $Register_sql = "
            EXEC [AUTH_AddUserAccount]
                @email    = ?,
                @password = ?,
                @userType = ?
        ";
        $User_val = [
            $this->input->post('email'),
            password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I),
            $userType,
        ];
        return $this->db->query($Register_sql, $User_val);
    }

    // SETTING USER SESSION
    private function set_user_session($userType) {
        $FindUser_sql = "EXEC [AUTH_Find" . $userType ."] @email = ?";
        $FindUser_query = $this->db->query($FindUser_sql, [$this->input->post('email')]);
        $User_row  = $FindUser_query->row();
        
        if ($userType == 'Jobseeker') {
            $User_id   = $User_row->jobseekerID;
        } else if ($userType == 'Employer') {
            $User_id   = $User_row->employerID;
        }

        $this->session->set_userdata([
            'userType' => $userType,
            'id'       => $User_id,
            'email'    => $User_row->email,
        ]);
    }

    //============================================================================================//

    // ERROR PAGE
    public function err_page() {
        $this->load->view('templates/fullpage_header', ['title' => '404: Page Not Found']);
        $this->load->view('_404');
        $this->load->view('templates/footer');
        set_status_header(404);
    }

    // LOGIN
    public function login() {
        $query = $this->db->query("EXEC [AUTH_FindUserAccount] @email = ?", [$this->input->post('email')]);

        if (! $query) {
            echo $this->db->error();
        } else {
            if ( $query->num_rows() == 1 ) {
                $USER_row = $query->row();

                if (password_verify($this->input->post('password'), $USER_row->password)) {
                    
                    // SET USER SESSION
                    $this->set_user_session($USER_row->userType);
                    
                    // SET UNACTIVE ACCOUNT TO ACTIVE AGAIN AFTER LOG IN
                    if ( $USER_row->userAccountFlag == 0 ) $this->set_account_flag(1);

                    redirect('auth/profile');
                } else {
                    $this->session->set_flashdata('account_authentication', 'incorrect password');
                    redirect('user/login');
                }
            } else {
                $this->session->set_flashdata('account_authentication', 'no existing account');
                redirect('user/login');
            }
        }
    }

    // REGISTER JOB SEEKER
    public function register_jobseeker() {
        if (! $this->register_user('Jobseeker')) {
            echo $this->db->error();
        } else {
            $this->db->query("
                EXEC [AUTH_RegisterJobseeker]
                    @firstName	   = ?,
                    @middleName	   = ?,
                    @lastName	   = ?,
                    @birthDate	   = ?,
                    @gender		   = ?,
                    @cityProvince  = ?,
                    @contactNumber = ?,
                    @email         = ?
            ", [
                $this->input->post( 'firstName'     ),
                $this->input->post( 'middleName'    ),
                $this->input->post( 'lastName'      ),
                $this->input->post( 'birthDate'     ),
                $this->input->post( 'gender'        ),
                $this->input->post( 'cityProvince'  ),
                $this->input->post( 'contactNumber' ),
                $this->input->post( 'email'         ),
            ]);
            $this->login();
        }         
    }

    // REGISTER EMPLOYER
    public function register_employer() {
        if (! $this->register_user('Employer')) {
            echo $this->db->error();
        } else {
            $this->db->query("
                EXEC [AUTH_RegisterEmployer]
                    @companyName	= ?,
                    @street			= ?,
                    @brgyDistrict	= ?,
                    @cityProvince	= ?,
                    @contactNumber	= ?,
                    @email			= ?,
                    @website		= ?,
                    @description	= ?
            ", [
                $this->input->post( 'companyName'   ),
                $this->input->post( 'street'        ),
                $this->input->post( 'brgyDistrict'  ),
                $this->input->post( 'cityProvince'  ),
                $this->input->post( 'contactNumber' ),
                $this->input->post( 'email'         ),
                $this->input->post( 'website'       ),
                $this->input->post( 'description'   ),
            ]);
            $this->login();
        }
    }

    // GET USER PASSWORD
    public function get_user_password() {
        $query = $this->db->query("EXEC [AUTH_GetUserPassword] @email = ?", [$this->session->email]);
        $row = $query->row();
        return $row->password;
    }

    // UPDATE PASSWORD
    public function update_password() {
        return $this->db->query("
            EXEC [AUTH_UpdatePassword]
                @email    = ?,
                @password = ?
        ", [
            $this->session->email,
            password_hash($this->input->post('retypeNewPassword'), PASSWORD_ARGON2I),
        ]);
    }

    // UPDATE EMAIL
    public function update_email() {
        return $this->db->query("
            EXEC [AUTH_UpdateEmail]
                @email    = ?,
                @newEmail = ?
        ", [
            $this->session->email,
            $this->input->post('email'),
        ]);
    }

    // SET ACCOUNT FLAG 
    public function set_account_flag($flag) {
        $this->db->query("
            EXEC [AUTH_SetAccountFlag] 
                @email = ?,
                @flag  = ?
        ", [
            $this->session->email,
            $flag,
        ]);
    }
}