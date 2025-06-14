<?php

class User_model extends CI_Model
{
    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }
    public function check_user($username, $password)
    {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
    public function get_all()
    {
        return $this->db->get('users')->result();
    }

    public function hapus($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }
}
