<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function transaction()
    {
        $data['title'] = "Transaction";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/transaction');
        $this->load->view('templates/footer');
    }

    public function employees()
    {
        $data['title'] = "Employees";
        $this->db->where_not_in('username', $this->session->userdata('username'));
        $data['employees'] = $this->db->get('user')->result_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/employees', $data);
        $this->load->view('templates/footer');
    }

    public function customers()
    {
        $data['title'] = "Customers";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/customers');
        $this->load->view('templates/footer');
    }

    public function vehicles()
    {
        $data['title'] = "Vehicles";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/vehicles');
        $this->load->view('templates/footer');
    }

    public function deleteEmployee()
    {
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                                        Delete Employee Success!
                                                        </div>');
        redirect('admin/employees');
    }

    public function editEmployee()
    {
        $a = (int)$this->input->post('is_active');
        $this->db->set('is_active', $a);
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->update('user',);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                                        Edit Employee Success!
                                                        </div>');
        redirect('admin/employees');
    }
}
