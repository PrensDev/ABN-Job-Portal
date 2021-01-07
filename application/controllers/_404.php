<?php

class _404 extends CI_Controller {

    // FOR ERROR PAGE
    public function index() {
        $this->AUTH_model->err_page();
    }

}