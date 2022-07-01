<?php

class Penerbit_model extends CI_Model{
    private $table = 'penerbit';

    public function insert(
        $kode_penerbit,
        $penerbit_buku
    ){
        $query = $this->db->insert($this->table, [
            'kode_penerbit' => $kode_penerbit,
            'penerbit_buku' => $penerbit_buku
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
        $kode_penerbit,
        $penerbit_buku
    ){
        $this->db->where('id', $id);
        $query = $this->db->update($this->table, [
            'kode_penerbit' => $kode_penerbit,
            'penerbit_buku' => $penerbit_buku
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