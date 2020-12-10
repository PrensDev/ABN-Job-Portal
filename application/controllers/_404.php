<?php

class _404 extends CI_Controller {

    public function index() {
        $this->Auth_model->err_page();
    }

}