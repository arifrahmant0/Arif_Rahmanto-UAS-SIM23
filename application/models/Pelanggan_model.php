<?php
class Pelanggan_model extends CI_Model
{
    private $table = 'pelanggan';

    public function get_all()
    {
        return $this->db->get('pelanggan')->result(); // tabel "pelanggan"
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, [
            'nama'      => $data['nama'],
            'alamat'    => $data['alamat'],
            'telepon'   => $data['telepon'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, [
            'nama'      => $data['nama'],
            'alamat'    => $data['alamat'],
            'telepon'   => $data['telepon']
        ]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}
