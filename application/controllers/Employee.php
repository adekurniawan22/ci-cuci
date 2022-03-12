<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Add Transaction";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('employee/transactions');
        $this->load->view('templates/footer');
    }

    public function customers()
    {
        $data['title'] = "Add Customers";
        $data['customers'] = $this->db->get('customer')->result_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('employee/customers');
        $this->load->view('templates/footer');
    }

    public function addCustomer()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to add new customer!
            </div>');
            redirect('employee/customers');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'address'  => $this->input->post('address'),
                'phone_number'  => $this->input->post('phone_number')
            );
            $this->db->insert('customer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Add Customer Success!
            </div>');
            redirect('employee/customers');
        }
    }

    public function editCustomer()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|integer');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to edit customer!
            </div>');
            redirect('employee/customers');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'address'  => $this->input->post('address'),
                'phone_number'  => $this->input->post('phone_number'),
            ];

            $this->db->where('customer_id', $this->input->post('customer_id'));
            $this->db->update('customer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Edit Customer Success!
            </div>');
            redirect('employee/customers');
        }
    }

    public function deleteCustomer()
    {

        $this->db->where('customer_id', $this->input->post('customer_id'));
        $this->db->delete('customer');
        $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
                                                        Delete Customer Success!
                                                        </div>');
        redirect('employee/customers');
    }
}
