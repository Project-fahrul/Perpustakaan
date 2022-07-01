<?php 


class Buku_model extends CI_Model{

    private $table = "buku";

    public function insert(
        $judul,
        $jumlah,
        $pengarang, 
        $penerbit
    ){
        $query = $this->db->insert($this->table, [
            'judul' => $judul,
            'jumlah' => $jumlah,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit
        ]);

        return $query == true;
    }

    public function update(
        $id,
        $judul,
        $jumlah,
        $pengarang, 
        $penerbit
    ){
        $this->db->where('id', $id);
        $query = $this->db->update($this->table,array(
            'judul' => $judul,
            'jumlah' => $jumlah,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit
        ));

        return $query == true;
    }

    public function get(){
        return $this->db->get($this->table)->result();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table);

        return $query == true;
    }

    public function length(){
       $query =  $this->db->get($this->table);
       return $query->num_rows();
    }

    public function findById($id){
        $query = $this->db->get_where($this->table, array(
            'id' => $id
        ));

        return $query->row(1);
    }
}