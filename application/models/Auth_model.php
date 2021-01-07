<?php

class AUTH_model extends CI_Model {

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
        $FindUserAccount_sql = "EXEC [AUTH_FindUserAccount] @email = ?";
        $FindUserAccount_val = [$this->input->post('email')];
        $query = $this->db->query($FindUserAccount_sql, $FindUserAccount_val);

        if (! $query) {
            echo $this->db->error();
        } else {
            if ( $query->num_rows() == 1 ) {
                $USER_row = $query->row();

                if (password_verify($this->input->post('password'), $USER_row->password)) {
                    if ($USER_row->userType == 'Job Seeker') {
                        $FindJBSK_sql = "EXEC [AUTH_FindJobseeker] @email = ?";
                        $FindJBSK_query = $this->db->query($FindJBSK_sql, [$this->input->post('email')]);
                        $JBSK_row  = $FindJBSK_query->row();
                        
                        $this->session->set_userdata([
                            'userType'    => $USER_row->userType,
                            'id'          => $JBSK_row->jobseekerID,
                            'email'       => $JBSK_row->email,
                        ]);
                    } else if ($USER_row->userType == 'Employer') {
                        $FindEMPL_sql = "EXEC [AUTH_FindEmployer] @email = ?";
                        $FindEMPL_query = $this->db->query($FindEMPL_sql, [$this->input->post('email')]);
                        $EMPL_row  = $FindEMPL_query->row();
                        
                        $this->session->set_userdata([
                            'userType'    => $USER_row->userType,
                            'id'          => $EMPL_row->employerID,
                            'email'       => $EMPL_row->email,
                        ]);
                    }

                    // SET UNACTIVE ACCOUNT TO ACTIVE AGAIN AFTER LOG IN
                    if ( $USER_row->status == 0 ) { $this->setAccountFlag(1); }

                    redirect('auth/profile');
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
        $AddUserAccount_sql = "
            EXEC [AUTH_AddUserAccount]
                @email	  = ?,
                @password = ?,
                @userType = ?
        ";
        $AddUserAccount_val = [
            $this->input->post( 'email' ),
            password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I),
            'Job Seeker'
        ];
        if (! $this->db->query($AddUserAccount_sql, $AddUserAccount_val)) {
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
        $input = $this->input->post();
        $AddEmployerAccount_sql = "
            EXEC [AUTH_AddUserAccount]
                @email			= '" . $input['email'] . "',
                @password		= '" . password_hash($input[ 'password' ], PASSWORD_ARGON2I) . "',
                @userType       = 'Employer'
        ";
        if (! $this->db->query($AddEmployerAccount_sql)) {
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
                $input[ 'companyName'   ],
                $input[ 'street'        ],
                $input[ 'brgyDistrict'  ],
                $input[ 'cityProvince'  ],
                $input[ 'contactNumber' ],
                $input[ 'email'         ],
                $input[ 'website'       ],
                $input[ 'description'   ],
            ]);
            $this->login();
        }
    }

    // CHANGE PASSWORD
    public function update_password() {
        return $this->db->query("
            EXEC [AUTH_UpdatePassword]
                @email    = ?,
                @password = ?
        ", [
            $this->session->email,
            password_hash($this->input->post( 'retypepassword' ), PASSWORD_ARGON2I),
        ]);
    }

    // SET ACCOUNT FLAG 
    public function setAccountFlag($flag) {
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