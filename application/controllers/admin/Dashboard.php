<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/logout');
        }
    }

    public function index()
    {
        $data['total_user'] = $this->db->count_all('users');
        $data['total_produk'] = $this->db->count_all('produk');
        $data['total_order'] = $this->db->count_all('sales_orders');
        $data['total_laporan'] = $this->db->where('status !=', 'draft')->count_all_results('sales_orders');

        $data['title'] = 'Dashboard Admin';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
