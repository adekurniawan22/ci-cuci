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

        //Get nota
        $this->db->select('transaction_id,time');
        $this->db->from('transaction');
        $this->db->group_by('transaction.transaction_id');
        $data['transactions'] = $this->db->get()->result_array();

        //get detail
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->join('transaction_details', 'transaction_details.transaction_details_id = transaction.transaction_details_id');
        $this->db->join('vehicle', 'vehicle.vehicle_id=transaction_details.vehicle_id');
        $data['details'] = $this->db->get()->result_array();

        //get vehicle
        $data['vehicles'] = $this->db->get('vehicle')->result_array();

        //get employe
        $data['users'] = $this->db->get('user')->result_array();

        //get transaction
        $data['transaction'] = $this->db->get('transaction')->result_array();

        //get transaction details
        $data['transaction_details'] = $this->db->get('transaction_details')->result_array();

        //get customer
        $data['customers'] = $this->db->get('customer')->result_array();

        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('employee/transaction', $data);
        $this->load->view('templates/footer');
    }

    public function deleteTransaction()
    {
        for ($i = 1; $i <= count($this->input->post('transaction_details_id')); $i++) {
            $this->db->where('transaction_details_id', $this->input->post('transaction_details_id[' . $i . ']'));
            $this->db->delete('transaction_details');
        }
        $this->db->where('transaction_id', $this->input->post('transaction_id'));
        $this->db->delete('transaction');

        $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
        Delete Transaction Success!
        </div>');
        redirect('employee');
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
