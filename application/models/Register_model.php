<?php

class Register_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

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
            }
        }         
    }

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
            }
        }
    }
}