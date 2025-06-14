<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') !== 'user') {
            redirect('dashboard');
        }
    }

    public function dashboard()
    {
        $this->load->view('templates/header');
        $this->load->view('user/dashboard');
        $this->load->view('templates/footer');
    }
}
