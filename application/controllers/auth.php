<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function login()
    {
        //$this->load->view('templates/header');
        $this->load->view('auth/login');
        //$this->load->view('templates/footer');
    }
    public function register()
    {
        $this->load->view('templates/header');
        $this->load->view('auth/register');
        $this->load->view('templates/footer');
    }

    public function process_register()
    {
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'konfirmasi password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];

            if ($this->user_model->insert_user($data)) {
                $this->session->set_flashdata('success', 'pendaftaran berhasil');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'pendaftaran gagal');
                redirect('auth/register');
            }
        }
    }
    public function process_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->user_model->check_user($username, $password);
        if ($user) {
            $this->session->set_userdata([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'logged_in' => true
            ]);
            $this->redirect_by_role($user->role);
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect('auth/login');
        }
    }
    private function redirect_by_role($role)
    {
        switch ($role) {
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'sales':
                redirect('sales/dashboard');
                break;
            case 'manager':
                redirect('manager/dashboard');
                break;
            default:
                redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function send_reset_link()
    {
        $email = $this->input->post('email');

        // Cek apakah email ada di database (contoh)
        $user = $this->db->get_where('users', ['email' => $email])->row();

        if ($user) {
            // Di sini seharusnya kamu kirim email dengan token (disederhanakan)
            $this->session->set_flashdata('message', 'Reset link telah dikirim ke email Anda.');
        } else {
            $this->session->set_flashdata('message', 'Email tidak ditemukan.');
        }

        redirect('forgot-password');
    }

    public function forgot_password()
    {
        $this->load->view('auth/forgot_password');
    }
}
