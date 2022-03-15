<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Profile";
        $data['user'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row_array();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar');
        $this->load->view('profile/index');
        $this->load->view('templates/footer');
    }

    public function editProfile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger col-4" role="alert">
            Failed to edit profile!
            </div>');
            redirect('profile');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'address'  => $this->input->post('address'),
                'phone_number'  => $this->input->post('phone_number')
            );
            $this->db->where('user_id', $this->input->post('user_id'));
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-4" role="alert">
            Edit Profile Success!
            </div>');
            redirect('profile');
        }
    }
}
