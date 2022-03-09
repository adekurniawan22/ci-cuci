<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Sign In";

        $this->load->view('templates/header_auth', $data);
        $this->load->view('auth/index');
        $this->load->view('templates/footer_auth');
    }
}
