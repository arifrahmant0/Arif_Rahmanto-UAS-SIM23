<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder_model extends CI_Model
{
    private $table_order = 'sales_orders';
    private $table_detail = 'sales_order_details';

    public function insert_order($data_order, $data_detail)
    {
        $this->db->insert($this->table_order, $data_order);
        $sales_order_id = $this->db->insert_id();

        foreach ($data_detail as &$detail) {
            $detail['sales_order_id'] = $sales_order_id;
        }

        $this->db->insert_batch($this->table_detail, $data_detail);
        $this->load->model('Produk_model');

        foreach ($data_detail as $detail) {
            $this->Produk_model->kurangi_stok($detail['product_id'], $detail['jumlah']);
        }
    }

    // application/models/SalesOrder_model.php

    public function get_by_sales($sales_id)
    {
        $this->db->select('sales_orders.*, pelanggan.nama AS nama_pelanggan');
        $this->db->from('sales_orders');
        $this->db->join('pelanggan', 'pelanggan.id = sales_orders.pelanggan_id');
        $this->db->where('sales_orders.sales_id', $sales_id);
        $this->db->order_by('sales_orders.created_at', 'DESC');
        return $this->db->get()->result();
    }



    public function update_status($id, $status)
    {
        $allowed_status = ['draft', 'dikirim', 'selesai', 'dibatalkan'];
        if (!in_array($status, $allowed_status)) {
            show_error('Status tidak valid.');
        }

        $order = $this->db->get_where('sales_orders', ['id' => $id])->row();
        if (!$order) {
            show_error('Order tidak ditemukan.');
        }

        // Cegah update ulang jika sudah dibatalkan
        if ($order->status === 'dibatalkan') {
            return false; // atau tampilkan pesan
        }

        if ($status === 'dibatalkan') {
            $details = $this->get_detail($id);

            foreach ($details as $item) {
                $this->db->set('stok', 'stok + ' . (int)$item->jumlah, FALSE);
                $this->db->where('id', $item->product_id);
                $this->db->update('produk');
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('sales_orders', ['status' => $status]);
    }







    public function get_all_with_pelanggan()
    {
        $this->db->select('sales_orders.*, pelanggan.nama as nama_pelanggan');
        $this->db->from('sales_orders');
        $this->db->join('pelanggan', 'pelanggan.id = sales_orders.pelanggan_id');
        return $this->db->get()->result();
    }

    public function get_by_id_with_pelanggan($id)
    {
        $this->db->select('so.*, p.nama AS nama_pelanggan, p.alamat, p.telepon');
        $this->db->from('sales_orders so');
        $this->db->join('pelanggan p', 'p.id = so.pelanggan_id');
        $this->db->where('so.id', $id);
        return $this->db->get()->row();
    }

    public function detail($id)
    {
        $data['order'] = $this->SalesOrder_model->get_by_id_with_pelanggan($id);
        $data['details'] = $this->SalesOrder_model->get_order_details($id);
        $this->load->view('admin/order/cetak_detail', $data);
    }



    public function get_detail($order_id)
    {
        $this->db->select('sales_order_details.*, produk.nama_produk');
        $this->db->from('sales_order_details');
        $this->db->join('produk', 'produk.id = sales_order_details.product_id');
        $this->db->where('sales_order_id', $order_id);
        return $this->db->get()->result(); // PERBAIKI INI
    }



    public function get_order_details($order_id)
    {
        $this->db->select('sales_order_details.product_id, produk.nama_produk, sales_order_details.*');

        $this->db->from('sales_order_details');
        $this->db->join('produk', 'produk.id = sales_order_details.product_id');
        $this->db->where('sales_order_id', $order_id);
        return $this->db->get()->result();
    }



    // application/models/SalesOrder_model.php

    public function get_all_by_status($status)
    {
        $this->db->select('sales_orders.*, pelanggan.nama as nama_pelanggan');
        $this->db->from('sales_orders');
        $this->db->join('pelanggan', 'pelanggan.id = sales_orders.pelanggan_id');
        $this->db->where('sales_orders.status', $status);
        return $this->db->get()->result();
    }

    public function get_laporan_filtered($start_date = null, $end_date = null, $sales_id = null, $produk_id = null)
    {
        $this->db->select('so.created_at, sod.jumlah, sod.harga_satuan, sod.total_harga, p.nama_produk, s.username AS nama_sales');
        $this->db->from('sales_order_details sod');
        $this->db->join('sales_orders so', 'so.id = sod.sales_order_id');
        $this->db->join('produk p', 'p.id = sod.product_id'); // ✅ kolom benar
        $this->db->join('users s', 's.id = so.sales_id');

        if ($start_date) {
            $this->db->where('DATE(so.created_at) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(so.created_at) <=', $end_date);
        }
        if ($sales_id) {
            $this->db->where('so.sales_id', $sales_id);
        }
        if ($produk_id) {
            $this->db->where('sod.product_id', $produk_id); // ✅ sesuaikan juga di sini
        }

        $this->db->order_by('so.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_total_penjualan_per_produk()
    {
        return $this->db->select('p.nama_produk, SUM(sod.total_harga) as total_penjualan')
            ->from('sales_order_details sod')
            ->join('produk p', 'p.id = sod.product_id')
            ->join('sales_orders so', 'so.id = sod.sales_order_id')
            ->where('so.status', 'selesai')
            ->group_by('p.id')
            ->get()->result_array();
    }

    public function get_total_penjualan_per_bulan()
    {
        return $this->db->select("DATE_FORMAT(so.created_at, '%M %Y') as bulan, SUM(sod.total_harga) as total")
            ->from('sales_order_details sod')
            ->join('sales_orders so', 'so.id = sod.sales_order_id')
            ->where('so.status', 'selesai')
            ->group_by("DATE_FORMAT(so.created_at, '%Y-%m')")
            ->order_by('so.created_at', 'ASC')
            ->get()->result_array();
    }

    public function get_by_sales_and_status($sales_id, $status)
    {
        $this->db->select('sales_orders.*, pelanggan.nama AS nama_pelanggan');
        $this->db->from('sales_orders');
        $this->db->join('pelanggan', 'pelanggan.id = sales_orders.pelanggan_id');
        $this->db->where('sales_orders.sales_id', $sales_id);
        $this->db->where('sales_orders.status', $status);
        $this->db->order_by('sales_orders.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_all_orders_with_pelanggan()
    {
        return $this->get_all_with_pelanggan();
    }

    public function get_laporan_penjualan($filters = [])
    {
        $this->db->select('sales_orders.*, sales_order_details.*, produk.nama_produk, users.username as nama_sales');

        $this->db->from('sales_order_details');
        $this->db->join('sales_orders', 'sales_orders.id = sales_order_details.sales_order_id');
        $this->db->join('produk', 'produk.id = sales_order_details.product_id');
        $this->db->join('users', 'users.id = sales_orders.sales_id');

        if (!empty($filters['start_date'])) {
            $this->db->where('sales_orders.created_at >=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $this->db->where('sales_orders.created_at <=', $filters['end_date']);
        }

        if (!empty($filters['sales_id'])) {
            $this->db->where('sales_orders.sales_id', $filters['sales_id']);
        }

        if (!empty($filters['produk_id'])) {
            $this->db->where('sales_order_details.product_id', $filters['produk_id']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('sales_orders.status', $filters['status']); // INI FILTER STATUS
        }

        return $this->db->get()->result();
    }
}
