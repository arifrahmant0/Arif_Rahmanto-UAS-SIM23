<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }

        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Kelola User';
        $data['users'] = $this->User_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/user/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        // Form tambah user
    }

    public function edit($id)
    {
        // Form edit user
    }

    public function hapus($id)
    {
        $this->User_model->hapus($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/user');
    }
}
