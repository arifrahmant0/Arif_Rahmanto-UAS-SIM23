<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }

        $this->load->model('SalesOrder_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
    }

    // Tampilkan semua sales order
    public function index()
    {
        $status = $this->input->get('status');

        if ($status) {
            $data['orders'] = $this->SalesOrder_model->get_all_by_status($status);
        } else {
            $data['orders'] = $this->SalesOrder_model->get_all_with_pelanggan();
        }

        $data['title'] = 'Semua Sales Order';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/sales_order/index', $data);
        $this->load->view('templates/footer');
    }

    // Tampilkan detail order
    public function detail($id)
    {
        $data['order'] = $this->SalesOrder_model->get_by_id_with_pelanggan($id);
        $data['details'] = $this->SalesOrder_model->get_detail($id);
        $data['title'] = 'Detail Sales Order';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/sales_order/detail', $data);
        $this->load->view('templates/footer');
    }

    public function update_status($id, $status)
    {
        $allowed_status = ['draft', 'dikirim', 'selesai', 'dibatalkan'];

        if (!in_array($status, $allowed_status)) {
            show_error('Status tidak valid.');
        }

        $this->SalesOrder_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status order berhasil diubah.');
        redirect('admin/sales_order');
    }


    public function export_pdf()
    {
        // Load mPDF
        $this->load->library('pdf'); // kita akan buat pdf.php di /libraries

        $status = $this->input->get('status');

        $this->db->select('so.*, p.nama AS nama_pelanggan');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'p.id = so.pelanggan_id');
        if ($status) {
            $this->db->where('so.status', $status);
        }
        $this->db->order_by('so.created_at', 'DESC');
        $data['orders'] = $this->db->get()->result();

        $data['title'] = 'Laporan Sales Order';

        // Load view ke dalam string
        $html = $this->load->view('admin/sales_order/laporan_cetak', $data, TRUE);

        // Buat PDF
        $this->pdf->load();
        $this->pdf->mpdf->WriteHTML($html);
        $this->pdf->mpdf->Output('laporan_sales_order.pdf', 'D'); // D = download
    }
    public function cetak()
    {
        $status = $this->input->get('status');

        $this->db->select('so.*, p.nama AS nama_pelanggan');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'p.id = so.pelanggan_id');
        if ($status) {
            $this->db->where('so.status', $status);
        }
        $this->db->order_by('so.created_at', 'DESC');
        $data['orders'] = $this->db->get()->result();

        $data['title'] = 'Laporan Sales Order';

        // Tampilkan ke browser (tanpa download PDF)
        $this->load->view('admin/sales_order/laporan_cetak', $data);
    }

    public function laporan()
    {
        $data['orders'] = $this->SalesOrder_model->get_all_with_pelanggan(); // atau sesuai model kamu
        $data['title'] = 'Laporan Sales Order';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/sales_order/laporan_cetak', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_detail($id)
    {
        $data['order'] = $this->SalesOrder_model->get_by_id_with_pelanggan($id);
        $data['details'] = $this->SalesOrder_model->get_detail($id);
        $this->load->view('admin/sales_order/cetak_detail', $data);
    }

    public function laporan_cetak()
    {
        $status = $this->input->get('status');

        $this->db->select('so.*, p.nama AS nama_pelanggan');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'p.id = so.pelanggan_id');
        if ($status) {
            $this->db->where('so.status', $status);
        }
        $this->db->order_by('so.created_at', 'DESC');
        $data['orders'] = $this->db->get()->result();

        $data['title'] = 'Laporan Sales Order';

        // Tampilkan view

        $this->load->view('templates/header', $data);
        $this->load->view('admin/sales_order/laporan_cetak', $data);
        $this->load->view('templates/footer');
    }
}
