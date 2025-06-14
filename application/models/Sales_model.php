<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get_where('users', ['role' => 'sales'])->result();
    }
}
