<?php

class Jobseeker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    protected function run_query($sql, $successPath) {
        if (! $this->db->query($sql) ) {
            echo $this->db->error();
        } else {
            redirect('auth/' . $successPath);
        }
    }


    // GET INFORMATION METHOD
    public function get_info() {
        $sql   = "EXEC [AUTH_FindJobseeker] @email = '" . $this->session->email . "'";
        $query = $this->db->query($sql);
        $row   = $query->row();

        if ( $row->middleName == '' ) {
            $fullName = $row->firstName . ' ' . $row->lastName;
        } else {
            $fullName = $row->firstName . ' ' . $row->middleName . ' ' . $row->lastName;
        }

        $location = $row->brgyDistrict . ', ' . $row->cityMunicipality;

        $userdata = [
            'username'         => $fullName,
            'firstName'        => $row->firstName,
            'middleName'       => $row->middleName,
            'lastName'         => $row->lastName,
            'birthDate'        => $row->birthDate,
            'age'              => $row->age,
            'gender'           => $row->gender,
            'street'           => $row->street,
            'brgyDistrict'     => $row->brgyDistrict,
            'cityMunicipality' => $row->cityMunicipality,
            'location'         => $location,
            'contactNumber'    => $row->contactNumber,
            'email'            => $row->email,
            'description'      => $row->description,
            'skills'           => $row->skills,
            'experiences'      => $row->experiences,
            'education'        => $row->education,
        ];

        return $userdata;
    }


    // UPDATE INFORMATION METHOD
    public function update_info() {
        $input = $this->input->post();
        $this->run_query("
            EXEC [JBSK_UpdateInfo]
                @jobseekerID	  = '" . $this->session->id . "',
                @firstName		  = '" . $input[ 'firstName'        ] . "',
                @middleName		  = '" . $input[ 'middleName'       ] . "',
                @lastName		  = '" . $input[ 'lastName'         ] . "',
                @birthDate		  = '" . $input[ 'birthDate'        ] . "',
                @gender			  = '" . $input[ 'gender'           ] . "',
                @street			  = '" . $input[ 'street'           ] . "',
                @brgyDistrict	  = '" . $input[ 'brgyDistrict'     ] . "',
                @cityMunicipality = '" . $input[ 'cityMunicipality' ] . "',
                @contactNumber	  = '" . $input[ 'contactNumber'    ] . "',
                @description	  = '" . $input[ 'description'      ] . "',
                @skills			  = '" . $input[ 'skills'           ] . "',
                @experiences	  = '" . $input[ 'experiences'      ] . "',
                @education		  = '" . $input[ 'education'        ] . "'
        ", 'information');
    }
}