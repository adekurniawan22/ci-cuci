<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Menu Admin";
        $this->load->view('admin/index', $data);
    }
}
