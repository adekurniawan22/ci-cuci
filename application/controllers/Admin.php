<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

    public function index()
    {
        //get amount of employee
        $this->db->where_not_in('role_id', 1);
        $data['employees'] = $this->db->count_all_results('user');

        //get transaction
        $this->db->group_by('transaction_id');
        $data['transactions'] = $this->db->count_all_results('transaction');

        $this->db->select('*');
        $this->db->from('transaction_details');
        $this->db->join('vehicle', 'vehicle.vehicle_id = transaction_details.vehicle_id');
        $data['income'] = $this->db->get()->result_array();

        $data['title'] = "Dashboard";
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }

    public function transaction()
    {
        $data['title'] = "Transactions";

        //Get nota
        if ($this->input->post('keyword')) {
            $config['base_url'] = base_url('admin/transaction');
            $config['total_rows'] = $this->db->like('transaction_id', $this->input->post('keyword'))->group_by('transaction_id')->get('transaction')->num_rows();
            $config['per_page'] = 10;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $this->db->select('transaction_id,time');
            $this->db->like('transaction_id', $this->input->post('keyword'));
            $this->db->group_by('transaction.transaction_id');
            $data['transactions'] = $this->db->get('transaction', $config['per_page'], $from)->result_array();
        } else {
            $config['base_url'] = 'http://localhost/ci-cuci/admin/transaction';
            $config['total_rows'] = $this->db->group_by('transaction_id')->get('transaction')->num_rows();
            $config['per_page'] = 5;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $this->db->select('transaction_id,time');
            $this->db->group_by('transaction.transaction_id');
            $data['transactions'] = $this->db->get('transaction', $config['per_page'], $from)->result_array();
        }

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

        //Get
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/transaction', $data);
        $this->load->view('templates/footer');
    }

    public function employees()
    {
        $data['title'] = "Employees";

        if ($this->input->post('keyword')) {
            $config['base_url'] = 'http://localhost/ci-cuci/admin/employees';
            $config['total_rows'] = $this->db->where_not_in('role_id', 1)->like('name', $this->input->post('keyword'))->get('user')->num_rows();
            $config['per_page'] = 10;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $this->db->where_not_in('role_id', 1);
            $this->db->like('name', $this->input->post('keyword'));
            $data['employees'] = $this->db->get('user', $config['per_page'], $from)->result_array();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/employees', $data);
            $this->load->view('templates/footer');
        } else {
            $config['base_url'] = 'http://localhost/ci-cuci/admin/employees';
            $config['total_rows'] = $this->db->where_not_in('role_id', 1)->get('user')->num_rows();
            $config['per_page'] = 1;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $this->db->where_not_in('role_id', 1);
            $data['employees'] = $this->db->get('user', $config['per_page'], $from)->result_array();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/employees', $data);
            $this->load->view('templates/footer');
        }
    }

    public function editEmployee()
    {
        $this->form_validation->set_rules('is_active', 'Status active', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-3" role="alert">
            Failed to edit status active!
            </div>');
            redirect('admin/employees');
        } else {
            $a = (int)$this->input->post('is_active');
            $this->db->set('is_active', $a);
            $this->db->where('user_id', $this->input->post('user_id'));
            $this->db->update('user',);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-3" role="alert">
            Edit employee success!
            </div>');
            redirect('admin/employees');
        }
    }

    public function deleteEmployee()
    {
        $this->db->where('user_id', $this->input->post('user_id'));
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success col-3" role="alert">
                                                        Delete employee success!
                                                        </div>');
        redirect('admin/employees');
    }

    public function vehicles()
    {
        $data['title'] = "Vehicles";


        if ($this->input->post('keyword')) {
            $config['base_url'] = 'http://localhost/ci-cuci/admin/vehicles';
            $config['total_rows'] = $this->db->like('vehicle', $this->input->post('keyword'))->get('vehicle')->num_rows();
            $config['per_page'] = 10;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $this->db->like('vehicle', $this->input->post('keyword'));
            $data['vehicles'] = $this->db->get('vehicle', $config['per_page'], $from)->result_array();

            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/vehicles');
            $this->load->view('templates/footer');
        } else {
            $config['base_url'] = 'http://localhost/ci-cuci/admin/vehicles';
            $config['total_rows'] = $this->db->get('vehicle')->num_rows();
            $config['per_page'] = 5;
            $from = $this->uri->segment(3);
            $this->pagination->initialize($config);

            $data['vehicles'] = $this->db->get('vehicle', $config['per_page'], $from)->result_array();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/vehicles');
            $this->load->view('templates/footer');
        }
    }

    public function addVehicle()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-3" role="alert">
            Failed to add new vehicle!
            </div>');
            redirect('admin/vehicles');
        } else {
            $data = array(
                'vehicle' => $this->input->post('vehicle_name'),
                'price'  => $this->input->post('price')
            );
            $this->db->insert('vehicle', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-3" role="alert">
            Add vehicle success!
            </div>');
            redirect('admin/vehicles');
        }
    }

    public function editVehicle()
    {
        $this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-3" role="alert">
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
            $this->session->set_flashdata('message', '<div class="alert alert-success col-3" role="alert">
            Edit vehicle success!
            </div>');
            redirect('admin/vehicles');
        }
    }

    public function deleteVehicle()
    {
        $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
        $this->db->delete('vehicle');
        $this->session->set_flashdata('message', '<div class="alert alert-success col-3" role="alert">
                                                        Delete vehicle success!
                                                        </div>');
        redirect('admin/vehicles');
    }
}
