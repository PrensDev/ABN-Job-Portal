<?php

class Employer_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function register_employer() {
        $AddEmployerAccount_sql = "
            EXEC AddEmployerAccount
                @email			= '" . $this->input->post( 'email'    ) . "',
                @password		= '" . $this->input->post( 'password' ) . "'
        ";
        if (! $this->db->query($AddEmployerAccount_sql)) {
            echo $this->db->error();
        } else {
            $RegisterEmployer_sql = "
                EXEC RegisterEmployer
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