<?php


class Peminjaman_Model extends CI_Model{
    private $table = 'peminjaman';

    public function insert(
        $id_peminjaman,
        $mahasiswa,
        $buku,
        $tanggal_pinjam,
        $tanggal_kembali
    ){
        $query = $this->db->insert($this->table, [
            'id_peminjaman' => $id_peminjaman,
            'mahasiswa' => $mahasiswa,
            'buku' => $buku,
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali
        ]);

        return $query == true;
    }

    public function get()
    {
        $query = $this->db->get($this->table)->result();
        return $query;
    }

    public function update(
        $id,
        $id_peminjaman,
        $mahasiswa,
        $buku,
        $tanggal_pinjam,
        $tanggal_kembali
    ){
        $this->db->where('id', $id);
        $query = $this->db->update($this->table, [
            'id_peminjaman' => $id_peminjaman,
            'mahasiswa' => $mahasiswa,
            'buku' => $buku,
            'tanggal_pinjam' => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali
        ]);

        return $query == true;
    }

    public function delete($id){
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table);

        return $query == true;
    }

    public function findById($id){
        $query = $this->db->get_where($this->table, array(
            'id' => $id
        ));

        return $query->row(1);
    }

    public function length()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }   
}