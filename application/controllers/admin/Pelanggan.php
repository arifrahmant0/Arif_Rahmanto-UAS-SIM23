<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model
        $this->load->model('Pelanggan_model');
        // Optional: Cek login dan role di sini jika ada
        // $this->load->library('session');
        // if (!$this->session->userdata('logged_in')) redirect('login');
    }

    public function index()
    {
        $data['pelanggan'] = $this->Pelanggan_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($_POST) {
            $data = [
                'nama'      => $this->input->post('nama'),
                'alamat'    => $this->input->post('alamat'),
                'telepon'   => $this->input->post('telepon'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->Pelanggan_model->insert($data);
            redirect('admin/pelanggan');
        }

        $this->load->view('templates/header');
        $this->load->view('pelanggan/form');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['pelanggan'] = $this->Pelanggan_model->get($id);

        if (!$data['pelanggan']) {
            show_404();
        }

        if ($_POST) {
            $update = [
                'nama'    => $this->input->post('nama'),
                'alamat'  => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon'),
            ];
            $this->Pelanggan_model->update($id, $update);
            redirect('admin/pelanggan');
        }

        $this->load->view('templates/header');
        $this->load->view('pelanggan/form', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Pelanggan_model->delete($id);
        redirect('admin/pelanggan');
    }
}
