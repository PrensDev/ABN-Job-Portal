<?php

class Jobseeker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function register_jobseeker() {
        $AddJobseekerAccount_sql = "
            EXEC AddJobseekerAccount
                @email			= '" . $this->input->post( 'email'    ) . "',
                @password		= '" . $this->input->post( 'password' ) . "'
        ";
        
        if (! $this->db->query($AddJobseekerAccount_sql)) {
            echo $this->db->error();
        } else {
            $RegisterJobseeker_sql = "
                EXEC RegisterJobseeker
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
}