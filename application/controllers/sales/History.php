<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/controllers/sales/History.php

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SalesOrder_model');
        $this->load->model('Produk_model');
    }

    public function index()
    {
        $sales_id = $this->session->userdata('user_id');
        $status = $this->input->get('status'); // ambil status dari query string

        $data['title'] = 'Riwayat Order Saya';

        if (!empty($status)) {
            // ambil order berdasarkan status
            $data['orders'] = $this->SalesOrder_model->get_by_sales_and_status($sales_id, $status);
        } else {
            // ambil semua order
            $data['orders'] = $this->SalesOrder_model->get_by_sales($sales_id);
        }

        $this->load->view('templates/header');
        $this->load->view('sales/history', $data);
        $this->load->view('templates/footer');
    }


    public function kirim($id)
    {
        $order = $this->SalesOrder_model->get_by_id_with_pelanggan($id);

        if ($order && $order->status == 'draft') {
            // Ambil detail order
            $details = $this->SalesOrder_model->get_detail($id);

            // Kurangi stok
            foreach ($details as $item) {
                $this->Produk_model->kurangi_stok($item->product_id, $item->jumlah);
            }

            // Update status
            $this->SalesOrder_model->update_status($id, 'kirim');
            $this->session->set_flashdata('success', 'Order berhasil dikirim dan stok dikurangi.');
        } else {
            $this->session->set_flashdata('error', 'Order tidak bisa dikirim.');
        }

        redirect('sales/history');
    }





    public function batalkan($id)
    {
        $order = $this->SalesOrder_model->get_by_id_with_pelanggan($id);

        if ($order && (empty($order->status) || $order->status == 'draft')) {
            $details = $this->SalesOrder_model->get_detail($id);

            // Debug: pastikan detail tidak kosong
            echo "<pre>";
            print_r($details);
            exit;

            foreach ($details as $item) {
                $this->Produk_model->tambah_stok($item->product_id, $item->jumlah);
            }

            $this->SalesOrder_model->update_status($id, 'batal');
            $this->session->set_flashdata('success', 'Order berhasil dibatalkan dan stok dikembalikan.');
        } else {
            $this->session->set_flashdata('error', 'Order tidak bisa dibatalkan.');
        }

        redirect('sales/history');
    }




    public function detail($id)
    {
        $data['title'] = 'Detail Sales Order';
        $data['order'] = $this->SalesOrder_model->get_by_id_with_pelanggan($id);
        $data['details'] = $this->SalesOrder_model->get_detail($id);

        $this->load->view('templates/header', $data);
        $this->load->view('sales/detail', $data);
        $this->load->view('templates/footer');
    }



    public function update_status($id, $status)
    {
        $valid_statuses = [
            'kirim' => 'dikirim',
            'batal' => 'dibatalkan'
        ];

        if (!isset($valid_statuses[$status])) {
            show_error('Status tidak valid', 400);
        }

        $this->SalesOrder_model->update_status($id, $valid_statuses[$status]);
        $this->session->set_flashdata('success', 'Status order diperbarui menjadi: ' . ucfirst($valid_statuses[$status]));
        redirect('sales/history');
    }
}
