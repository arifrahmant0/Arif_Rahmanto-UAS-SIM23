<?php
// application/controllers/admin/Order.php

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $this->load->model('SalesOrder_model');
    }

    public function index()
    {
        $status_filter = $this->input->get('status'); // ambil dari query string
        if ($status_filter) {
            $data['orders'] = $this->SalesOrder_model->get_all_by_status($status_filter);
        } else {
            $data['orders'] = $this->SalesOrder_model->get_all_with_pelanggan();
        }

        $data['selected_status'] = $status_filter;
        $data['title'] = "Data Sales Order";
        $this->load->view('templates/header');
        $this->load->view('admin/order/index', $data);
        $this->load->view('templates/footer');
    }

    public function update_status($id)
    {
        $status = $this->input->post('status');
        $valid_statuses = ['draft', 'dikirim', 'selesai', 'dibatalkan'];

        if (!in_array($status, $valid_statuses)) {
            show_error('Status tidak valid', 400);
        }

        $this->SalesOrder_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status order diperbarui.');
        redirect('admin/order');
    }
}
