<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('pelanggan')->result(); // atau sesuaikan nama tabel kamu
    }

    public function get($id)
    {
        return $this->db->get_where('pelanggan', ['id' => $id])->row();
    }
}
