<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function transaction()
    {
        $data['title'] = "Transaction";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/transaction');
        $this->load->view('templates/footer');
    }

    public function employees()
    {
        $data['title'] = "Employees";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/employees');
        $this->load->view('templates/footer');
    }

    public function customers()
    {
        $data['title'] = "Customers";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/customers');
        $this->load->view('templates/footer');
    }

    public function vehicles()
    {
        $data['title'] = "Vehicles";
        $this->load->view('templates/header', $data);
        $this->load->view('admin/vehicles');
        $this->load->view('templates/footer');
    }
}
