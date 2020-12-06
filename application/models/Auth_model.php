
<?php

class Auth_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    // REGISTER JOB SEEKER
    public function register_jobseeker() {
        $AddJobseekerAccount_sql = "
            EXEC [AddJobseekerAccount]
                @email			= '" . $this->input->post( 'email' ) . "',
                @password		= '" . password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I) . "'
        ";
        
        if (! $this->db->query($AddJobseekerAccount_sql)) {
            echo $this->db->error();
        } else {
            $RegisterJobseeker_sql = "
                EXEC [RegisterJobseeker]
                    @firstName			= '" . $this->input->post( 'firstName'          ) . "',
                    @middleName			= '" . $this->input->post( 'middleName'         ) . "',
                    @lastName			= '" . $this->input->post( 'lastName'           ) . "',
                    @birthDate			= '" . $this->input->post( 'birthDate'          ) . "',
                    @gender				= '" . $this->input->post( 'gender'             ) . "',
                    @street				= '" . $this->input->post( 'street'             ) . "',
                    @brgyDistrict	    = '" . $this->input->post( 'brgyDistrict'       ) . "',
                    @cityMunicipality	= '" . $this->input->post( 'cityMunicipality'   ) . "',
                    @contactNumber		= '" . $this->input->post( 'contactNumber'      ) . "',
                    @email              = '" . $this->input->post( 'email'              ) . "',
                    @description		= '" . $this->input->post( 'description'        ) . "',
                    @skills				= '" . $this->input->post( 'skills'             ) . "',
                    @experiences		= '" . $this->input->post( 'experiences'        ) . "',
                    @education		    = '" . $this->input->post( 'education'          ) . "'
            "; 

            if (! $this->db->query($RegisterJobseeker_sql)) {
                echo $this->db->error();
            } else {
                $this->Login_model->auth_login();
            }
        }         
    }

    // REGISTER EMPLOYER
    public function register_employer() {
        $AddEmployerAccount_sql = "
            EXEC [AddEmployerAccount]
                @email			= '" . $this->input->post( 'email' ) . "',
                @password		= '" . password_hash($this->input->post( 'password' ), PASSWORD_ARGON2I) . "'
        ";
        if (! $this->db->query($AddEmployerAccount_sql)) {
            echo $this->db->error();
        } else {
            $RegisterEmployer_sql = "
                EXEC [RegisterEmployer]
                    @companyName		= '" . $this->input->post( 'companyName'        ) . "',
                    @street				= '" . $this->input->post( 'street'             ) . "',
                    @brgyDistrict		= '" . $this->input->post( 'brgyDistrict'       ) . "',
                    @cityMunicipality	= '" . $this->input->post( 'cityMunicipality'   ) . "',
                    @contactNumber		= '" . $this->input->post( 'contactNumber'      ) . "',
                    @email				= '" . $this->input->post( 'email'              ) . "',
                    @website			= '" . $this->input->post( 'website'            ) . "',
                    @description		= '" . $this->input->post( 'description'        ) . "'
            ";
            if (! $this->db->query($RegisterEmployer_sql)) {
                echo $this->db->error();
            } else {
                $this->Login_model->auth_login();
            }
        }
    }

    // LOGIN
    public function login() {
        $FindUser_sql = "EXEC [FindUserAccount] @email = '" . $this->input->post( 'email' ) . "'";
        $UserAccount_query = $this->db->query($FindUser_sql);

        if (! $UserAccount_query) {
            echo $this->db->error();
        } else {
            $data = ['title' => 'Login'];

            if ( $UserAccount_query->num_rows() == 1 ) {
                $UserAccount_row = $UserAccount_query->row(0);

                if ( password_verify( $this->input->post( 'password' ), $UserAccount_row->password ) ) {
                    if ( $UserAccount_row->userType == 'Job Seeker' ) {
                        
                        $FindJobseeker_sql = "EXEC [FindJobseeker] @email = '" . $this->input->post( 'email' ) . "'";
                        $Jobseeker_query = $this->db->query($FindJobseeker_sql);
                        
                        if(! $Jobseeker_query) {
                            echo $this->db->error();
                        } else {
                            if ( $Jobseeker_query->num_rows() == 1) {
                                $Jobseeker_row  = $Jobseeker_query->row(0);

                                if ( $Jobseeker_row->middleName != '' ) {
                                    $fullName = $Jobseeker_row->firstName . ' ' . $Jobseeker_row->middleName . ' ' . $Jobseeker_row->lastName;
                                } else {
                                    $fullName = $Jobseeker_row->firstName . ' ' . $Jobseeker_row->lastName;
                                }

                                $location = $Jobseeker_row->brgyDistrict . ', ' . $Jobseeker_row->cityMunicipality;

                                $userdata = [
                                    'userType'          => $UserAccount_row->userType,
                                    'id'                => $Jobseeker_row->jobseekerID,
                                    'fullName'          => $fullName,
                                    'firstName'         => $Jobseeker_row->firstName,
                                    'middleName'        => $Jobseeker_row->middleName,
                                    'lastName'          => $Jobseeker_row->lastName,
                                    'birthDate'         => $Jobseeker_row->birthDate,
                                    'age'               => $Jobseeker_row->age,
                                    'gender'            => $Jobseeker_row->gender,
                                    'street'            => $Jobseeker_row->street,
                                    'brgyDistrict'      => $Jobseeker_row->brgyDistrict,
                                    'cityMunicipality'  => $Jobseeker_row->cityMunicipality,
                                    'location'          => $location,
                                    'contactNumber'     => $Jobseeker_row->contactNumber,
                                    'email'             => $Jobseeker_row->email,
                                    'description'       => $Jobseeker_row->description,
                                    'skills'            => $Jobseeker_row->skills,
                                    'experiences'       => $Jobseeker_row->experiences,
                                    'education'         => $Jobseeker_row->education,
                                ];

                                $this->session->set_userdata($userdata);
                                redirect('auth/information');
                            } else {
                                
                            }
                        }
                    } else if ( $UserAccount_row->userType == 'Employer' ) {
                        
                        $FindEmployer_sql = "EXEC [FindEmployer] @email = '" . $this->input->post( 'email' ) . "'";
                        $Employer_query = $this->db->query($FindEmployer_sql);
                        
                        if(! $Employer_query) {
                            echo $this->db->error();
                        } else {
                            if ( $Employer_query->num_rows() == 1) {
                                $Employer_row  = $Employer_query->row(0);

                                $location = $Employer_row->brgyDistrict . ', ' . $Employer_row->cityMunicipality;

                                $userdata = [
                                    'userType'          => $UserAccount_row->userType,
                                    'id'                => $Employer_row->employerID,
                                    'companyName'       => $Employer_row->companyName,
                                    'street'            => $Employer_row->street,
                                    'brgyDistrict'      => $Employer_row->brgyDistrict,
                                    'cityMunicipality'  => $Employer_row->cityMunicipality,
                                    'location'          => $location,
                                    'contactNumber'     => $Employer_row->contactNumber,
                                    'email'             => $Employer_row->email,
                                    'website'           => $Employer_row->website,
                                    'description'       => $Employer_row->description,
                                ];

                                $this->session->set_userdata($userdata);
                                redirect('auth/information');
                            } else {
                                die("Multiple Employers are detected");
                            }
                        }
                    } else {
                        die('Invalid User');
                    }
                } else {
                    $this->load->view('templates/fullpage_header', $data);
                    $this->load->view('sections/login_form');
                    $this->load->view('templates/footer');
                }
            } else {
                die("Multiple User Accounts are detected");
            }
        }
    }
}