<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        //set rules form validation
        $this->form_validation->set_rules('username', 'Username or Numberphone', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Sign In";
            $this->load->view('templates/header_auth', $data);
            $this->load->view('auth/index');
            $this->load->view('templates/footer_auth');
        } else {
            var_dump($this->input->post('username'));
        }
    }

    public function signup()
    {
        $this->form_validation->set_rules('name', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|min_length[3]|integer');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|min_length[4]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Sign Up";
            $this->load->view('templates/header_auth', $data);
            $this->load->view('auth/signup');
            $this->load->view('templates/footer_auth');
        } else {

            $datauser  = [
                'role_id' => 2,
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'phone_number' => $this->input->post('phone_number'),
                'gender' => $this->input->post('gender'),
                'is_active' => 0,
                'image' => "default.jpg",
                'created' => time()
            ];
            var_dump($datauser);

            $this->db->insert('user', $datauser);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                                        Your Account has been created, please wait Admin to accept!
                                                        </div>');
            redirect('auth');
        }
    }
}
