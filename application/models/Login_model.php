
<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function auth_login() {
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

                                $userdata = [
                                    'userType'          => $UserAccount_row->userType,
                                    'firstName'         => $Jobseeker_row->firstName,
                                    'middleName'        => $Jobseeker_row->middleName,
                                    'lastName'          => $Jobseeker_row->lastName,
                                    'birthDate'         => $Jobseeker_row->birthDate,
                                    'gender'            => $Jobseeker_row->gender,
                                    'street'            => $Jobseeker_row->street,
                                    'brgyDistrict'      => $Jobseeker_row->brgyDistrict,
                                    'cityMunicipality'  => $Jobseeker_row->cityMunicipality,
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
                                die("Multiple Jobseekers are detected");
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

                                $userdata = [
                                    'userType'          => $UserAccount_row->userType,
                                    'companyName'       => $Employer_row->companyName,
                                    'street'            => $Employer_row->street,
                                    'brgyDistrict'      => $Employer_row->brgyDistrict,
                                    'cityMunicipality'  => $Employer_row->cityMunicipality,
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