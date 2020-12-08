<?php

class Jobseeker_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    public function get_info() {
        $sql   = "EXEC [FindJobseeker] @email = '" . $this->session->email . "'";
        $query = $this->db->query($sql);
        $row   = $query->row();

        if ( $row->middleName == '' ) {
            $fullName = $row->firstName . ' ' . $row->lastName;
        } else {
            $fullName = $row->firstName . ' ' . $row->middleName . ' ' . $row->lastName;
        }

        $location = $row->brgyDistrict . ', ' . $row->cityMunicipality;

        $userdata = [
            'username'      => $fullName,
            'birthDate'     => $row->birthDate,
            'age'           => $row->age,
            'gender'        => $row->gender,
            'location'      => $location,
            'contactNumber' => $row->contactNumber,
            'email'         => $row->email,
            'description'   => $row->description,
            'skills'        => $row->skills,
            'experiences'   => $row->experiences,
            'education'     => $row->education,
        ];

        return $userdata;
    }
}