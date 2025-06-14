<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'manager') {
            redirect('auth/login');
        }

        $this->load->model('SalesOrder_model');
        $this->load->model('Produk_model');
        $this->load->model('Sales_model');
    }

    public function index()
    {
        $this->load->model('SalesOrder_model');

        $filters = [
            'start_date' => $this->input->get('start_date'),
            'end_date'   => $this->input->get('end_date'),
            'sales_id'   => $this->input->get('sales_id'),
            'produk_id'  => $this->input->get('produk_id'),
            'status'     => $this->input->get('status'), // tambahkan ini
        ];

        $data['title'] = 'Laporan Penjualan';
        $data['laporan'] = $this->SalesOrder_model->get_laporan_penjualan($filters);
        $data['sales_list'] = $this->Sales_model->get_all();
        $data['produk_list'] = $this->Produk_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('manager/laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function export_pdf()
    {
        $this->load->library('pdf'); // pastikan ada application/libraries/pdf.php

        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $sales_id = $this->input->get('sales_id');
        $produk_id = $this->input->get('produk_id');

        $data['laporan'] = $this->SalesOrder_model->get_laporan_filtered($start_date, $end_date, $sales_id, $produk_id);

        $html = $this->load->view('manager/laporan/laporan_pdf_view', $data, TRUE);

        $this->pdf->load();
        $this->pdf->mpdf->WriteHTML($html);
        $this->pdf->mpdf->Output('Laporan_Penjualan.pdf', 'I');
    }

    public function cetak()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $sales_id = $this->input->get('sales_id');
        $produk_id = $this->input->get('produk_id');

        $data['title'] = 'Cetak Laporan Penjualan';
        $data['laporan'] = $this->SalesOrder_model->get_laporan_filtered($start_date, $end_date, $sales_id, $produk_id);

        $this->load->view('manager/laporan/laporan_cetak', $data);
    }
}
