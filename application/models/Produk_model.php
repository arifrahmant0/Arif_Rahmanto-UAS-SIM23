<?php
class Produk_model extends CI_Model
{
    private $table = 'produk';

    public function get_all()
    {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, [
            'kode_produk' => $data['kode_produk'],
            'nama_produk' => $data['nama_produk'],
            'harga'       => $data['harga'],
            'stok'        => $data['stok'],
            'created_at'  => date('Y-m-d H:i:s')
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, [
            'kode_produk' => $data['kode_produk'],
            'nama_produk' => $data['nama_produk'],
            'harga'       => $data['harga'],
            'stok'        => $data['stok']
        ]);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }

    // application/models/Produk_model.php
    public function kurangi_stok($produk_id, $jumlah)
    {
        $this->db->set('stok', 'stok - ' . (int)$jumlah, FALSE);
        $this->db->where('id', $produk_id);
        $this->db->update('produk');
    }

    public function tambah_stok($produk_id, $jumlah)
    {
        log_message('debug', 'Menambahkan stok: produk_id=' . $produk_id . ', jumlah=' . $jumlah);

        $this->db->set('stok', 'stok + ' . (int)$jumlah, FALSE);
        $this->db->where('id', $produk_id);
        $this->db->update('produk');
    }
}
