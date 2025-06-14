<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'manager') {
            redirect('auth/login');
        }

        $this->load->model('SalesOrder_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Manager';

        // Ambil data penjualan per produk (pie chart)
        $data['produk_data'] = $this->SalesOrder_model->get_total_penjualan_per_produk();

        // Ambil data penjualan per bulan (bar chart)
        $data['bulan_data'] = $this->SalesOrder_model->get_total_penjualan_per_bulan();

        $this->load->view('templates/header', $data);
        $this->load->view('manager/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
