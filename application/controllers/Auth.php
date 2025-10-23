<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
    }

    public function index()
    {
        // Jika sudah login, arahkan ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('login');
    }

    public function login_action()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->User_model->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $userdata = [
                'id'        => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($userdata);
            echo json_encode(['status' => 'success', 'message' => 'Login berhasil!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Username atau password salah!']);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    // Opsional: register manual
    public function register()
    {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                'name' => $this->input->post('name', TRUE)
            ];
            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Pendaftaran berhasil, silakan login!');
            redirect('auth');
        } else {
            $this->load->view('auth/register');
        }
    }
}
