<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'sales') {
            redirect('auth/login');
        }

        $this->load->model('Produk_model');
        $this->load->model('Pelanggan_model'); // ✅ Ubah dari Customer_model ke Pelanggan_model
        $this->load->model('SalesOrder_model');
    }

    // TAMPILKAN FORM
    public function index()
    {
        $data['produk'] = $this->Produk_model->get_all();
        $data['pelanggan'] = $this->Pelanggan_model->get_all(); // ✅ Sesuai model
        $this->load->view('templates/header');
        $this->load->view('sales/order/index', $data);
        $this->load->view('templates/footer');
    }

    // SIMPAN DATA ORDER
    public function store()
    {
        $pelanggan_id   = $this->input->post('pelanggan_id');
        $produk_id     = $this->input->post('produk_id');
        $jumlah        = $this->input->post('jumlah');
        $harga_satuan  = $this->input->post('harga_satuan');
        $total_harga   = $this->input->post('total_harga');

        // Validasi pelanggan_id
        if (!$pelanggan_id) {
            $this->session->set_flashdata('error', 'Pelanggan harus dipilih!');
            redirect('sales/order');
        }

        // Siapkan data order utama
        $data_order = [
            'pelanggan_id' => $pelanggan_id,
            'sales_id'    => $this->session->userdata('user_id'),
            'status'      => 'draft',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        // Siapkan array data_detail sebelum dikirim ke model
        $data_detail = [];
        for ($i = 0; $i < count($produk_id); $i++) {
            $data_detail[] = [
                'product_id'   => $produk_id[$i],
                'jumlah'       => $jumlah[$i],
                'harga_satuan' => $harga_satuan[$i],
                'total_harga'  => $total_harga[$i],
                'created_at'   => date('Y-m-d H:i:s')
            ];
        }

        // Kirim ke model: insert order + detail sekaligus
        $this->SalesOrder_model->insert_order($data_order, $data_detail);

        redirect('sales/history');
    }
}
