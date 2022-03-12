<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Add Transaction";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('employee/addtransaction');
        $this->load->view('templates/footer');
    }
}
