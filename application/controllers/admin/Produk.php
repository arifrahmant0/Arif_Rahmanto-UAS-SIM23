<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/logout');
        }

        $this->load->model('Produk_model');
    }

    public function index()
    {
        $data['title'] = 'Data Produk';
        $data['produk'] = $this->Produk_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Produk';
        if ($this->input->post()) {
            $this->Produk_model->insert($this->input->post());
            redirect('admin/produk');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('produk/form');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Produk';
        $data['produk'] = $this->Produk_model->get($id);
        if ($this->input->post()) {
            $this->Produk_model->update($id, $this->input->post());
            redirect('admin/produk');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('produk/form', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Produk_model->delete($id);
        redirect('admin/produk');
    }
}
