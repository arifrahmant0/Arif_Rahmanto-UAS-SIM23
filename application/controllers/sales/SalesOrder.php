<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'sales') {
            redirect('auth/logout');
        }

        $this->load->model('SalesOrder_model');
        $this->load->model('Produk_model');
        $this->load->model('Pelanggan_model');
    }

    public function tambah()
    {
        $data['title'] = 'Buat Sales Order';
        $data['produk'] = $this->Produk_model->get_all();
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('sales/sales_order_form', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $pelanggan_id = $this->input->post('pelanggan_id');
        $produk_ids = $this->input->post('produk_id');
        $jumlahs = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');
        $sales_id = $this->session->userdata('user_id');

        $data_order = [
            'pelanggan_id' => $pelanggan_id,
            'sales_id' => $sales_id,
            'status' => 'draft',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Persiapkan detail
        $data_detail = [];
        for ($i = 0; $i < count($produk_ids); $i++) {
            $data_detail[] = [
                'product_id' => $produk_ids[$i],
                'jumlah' => $jumlahs[$i],
                'harga_satuan' => $harga_satuan[$i],
                'total_harga' => $jumlahs[$i] * $harga_satuan[$i],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->SalesOrder_model->insert_order($data_order, $data_detail);

        $this->session->set_flashdata('success', 'Sales order berhasil disimpan sebagai draft.');
        redirect('sales/salesorder/tambah');
    }

    public function detail($id)
    {
        $data['order'] = $this->SalesOrder_model->get_by_id_with_pelanggan($id);
        $data['details'] = $this->SalesOrder_model->get_order_details($id);
        $data['title'] = 'Detail Sales Order';
        $this->load->view('admin/order/detail', $data);
    }



    public function ubah_status($id, $status)
    {
        if ($status == 'dibatalkan') {
            $details = $this->SalesOrder_model->get_detail($id);

            foreach ($details as $item) {
                $this->Produk_model->tambah_stok($item->product_id, $item->jumlah);
            }
        }

        $this->SalesOrder_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status order berhasil diubah.');
        redirect('sales/history');
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

        // View untuk ditampilkan langsung di browser atau dicetak
        $this->load->view('admin/sales_order/laporan_cetak', $data);
    }
}
