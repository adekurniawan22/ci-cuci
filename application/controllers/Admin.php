<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function transaction()
    {
        $data['title'] = "Transaction";

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

        //get customer
        $data['customers'] = $this->db->get('customer')->result_array();

        //Get
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/transaction', $data);
        $this->load->view('templates/footer');
    }

    public function employees()
    {
        $data['title'] = "Employees";
        $this->db->where_not_in('username', $this->session->userdata('username'));
        $data['employees'] = $this->db->get('user')->result_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/employees', $data);
        $this->load->view('templates/footer');
    }

    public function editEmployee()
    {
        $this->form_validation->set_rules('is_active', 'Status active', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to edit status active!
            </div>');
            redirect('admin/employees');
        } else {
            $a = (int)$this->input->post('is_active');
            $this->db->set('is_active', $a);
            $this->db->where('user_id', $this->input->post('user_id'));
            $this->db->update('user',);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Edit Employee Success!
            </div>');
            redirect('admin/employees');
        }
    }

    public function deleteEmployee()
    {
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
                                                        Delete Employee Success!
                                                        </div>');
        redirect('admin/employees');
    }

    public function customers()
    {
        $data['title'] = "Customers";
        $data['customers'] = $this->db->get('customer')->result_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/customers');
        $this->load->view('templates/footer');
    }


    public function vehicles()
    {
        $data['title'] = "Vehicles";
        $data['vehicles'] = $this->db->get('vehicle')->result_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/vehicles');
        $this->load->view('templates/footer');
    }

    public function addVehicle()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to add new vehicle!
            </div>');
            redirect('admin/vehicles');
        } else {
            $data = array(
                'vehicle' => $this->input->post('vehicle_name'),
                'price'  => $this->input->post('price')
            );
            $this->db->insert('vehicle', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Add Vehicle Success!
            </div>');
            redirect('admin/vehicles');
        }
    }

    public function editVehicle()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to edit vehicle!
            </div>');
            redirect('admin/vehicles');
        } else {
            $data = array(
                'vehicle' => $this->input->post('vehicle_name'),
                'price'  => $this->input->post('price')
            );
            $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
            $this->db->update('vehicle', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Edit Vehicle Success!
            </div>');
            redirect('admin/vehicles');
        }
    }

    public function deleteVehicle()
    {
        $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
        $this->db->delete('vehicle');
        $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
                                                        Delete Vehicle Success!
                                                        </div>');
        redirect('admin/vehicles');
    }
}
