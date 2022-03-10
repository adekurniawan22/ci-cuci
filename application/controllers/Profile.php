<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Profile";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('profile/index');
        $this->load->view('templates/footer');
    }
}
