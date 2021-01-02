<?php

class Auth_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // ERROR PAGE
    public function err_page() {
        $this->load->view('templates/fullpage_header', ['title' => '404: Page Not Found']);
        $this->load->view('_404');
        $this->load->view('templates/footer');
        set_status_header(404);
    }

    // LOGIN
    public function login() {
        $sql = "EXEC [AUTH_FindUserAccount] @email = '" . $this->input->post( 'email' ) . "'";
        $query = $this->db->query($sql);

        if (! $query) {
            echo $this->db->error();
        } else {
            if ( $query->num_rows() == 1 ) {
                $row = $query->row(0);

                if ( password_verify( $this->input->post( 'password' ), $row->password ) ) {
                    if ( $row->userType == 'Job Seeker' ) {
                        $FindJobseeker_sql = "EXEC [AUTH_FindJobseeker] @email = '" . $this->input->post( 'email' ) . "'";
                        $Jobseeker_query = $this->db->query($FindJobseeker_sql);
                        $Jobseeker_row  = $Jobseeker_query->row();

                        $this->session->set_userdata([
                            'userType' => $row->userType,
                            'id'       => $Jobseeker_row->jobseekerID,
                            'email'    => $Jobseeker_row->email,
                        ]);
                    } else if ( $row->userType == 'Employer' ) {
                        $FindEmployer_sql = "EXEC [AUTH_FindEmployer] @email = '" . $this->input->post( 'email' ) . "'";
                        $Employer_query = $this->db->query($FindEmployer_sql);
                        $Employer_row  = $Employer_query->row(0);

                        $this->session->set_userdata( [
                            'userType'    => $row->userType,
                            'id'          => $Employer_row->employerID,
                            'email'       => $Employer_row->email,
                        ]);
                    }

                    if ( $row->status == 0 ) { $this->setAccountFlag(1); }
                    
                    redirect('auth/information');
                } else {
                    return 'Incorrect Password';
                }
            } else {
                return "That account doesn't not exist";
            }
        }
    }

    // REGISTER JOB SEEKER
    public function register_jobseeker() {
        $AddJobseekerAccount_sql = "
            EXEC [AUTH_AddUserAccount]
                @email	  = '" . $this->input->post( 'email' ) . "',
                @password = '" . password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I) . "',
                @userType = 'Job Seeker'
        ";
        
        if (! $this->db->query($AddJobseekerAccount_sql)) {
            echo $this->db->error();
        } else {
            $this->db->query("
                EXEC [AUTH_RegisterJobseeker]
                    @firstName	   = '" . $this->input->post( 'firstName'     ) . "',
                    @middleName	   = '" . $this->input->post( 'middleName'    ) . "',
                    @lastName	   = '" . $this->input->post( 'lastName'      ) . "',
                    @birthDate	   = '" . $this->input->post( 'birthDate'     ) . "',
                    @gender		   = '" . $this->input->post( 'gender'        ) . "',
                    @cityProvince  = '" . $this->input->post( 'cityProvince'  ) . "',
                    @contactNumber = '" . $this->input->post( 'contactNumber' ) . "',
                    @email         = '" . $this->input->post( 'email'         ) . "'
            ");
            $this->login();
        }         
    }

    // REGISTER EMPLOYER
    public function register_employer() {
        $AddEmployerAccount_sql = "
            EXEC [AUTH_AddUserAccount]
                @email			= '" . $this->input->post( 'email' ) . "',
                @password		= '" . password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I) . "',
                @userType       = 'Employer'
        ";
        if (! $this->db->query($AddEmployerAccount_sql)) {
            echo $this->db->error();
        } else {
            $this->db->query("
                EXEC [AUTH_RegisterEmployer]
                    @companyName	= '" . $this->input->post( 'companyName'   ) . "',
                    @street			= '" . $this->input->post( 'street'        ) . "',
                    @brgyDistrict	= '" . $this->input->post( 'brgyDistrict'  ) . "',
                    @cityProvince	= '" . $this->input->post( 'cityProvince'  ) . "',
                    @contactNumber	= '" . $this->input->post( 'contactNumber' ) . "',
                    @email			= '" . $this->input->post( 'email'         ) . "',
                    @website		= '" . $this->input->post( 'website'       ) . "',
                    @description	= '" . $this->input->post( 'description'   ) . "'
            ");
            $this->login();
        }
    }

    // CHANGE PASSWORD
    public function change_password() {
        $sql = "
            EXEC [AUTH_ChangeUserPassword]
                @email    = '" . $this->session->email . "',
                @password = '" . password_hash($this->input->post( 'retypepassword' ), PASSWORD_ARGON2I) . "',
        ";
    }

    // SET ACCOUNT FLAG 
    public function setAccountFlag($flag) {
        $this->db->query("
            EXEC [AUTH_SetAccountFlag] 
                @email = '" . $this->session->email . "',
                @flag  =  " . $flag . "
        ");
    }
}