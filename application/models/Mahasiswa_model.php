<?php 


class Mahasiswa_model extends CI_Model{

    private $table = "mahasiswa";
    public function insert(
        $fullname,
        $email,
        $nim, 
        $kelas,
        $prodi,
        $born
    ){
        $query = $this->db->insert($this->table, [
            'fullname' => $fullname,
            'email' => $email,
            'nim' => $nim,
            'kelas' => $kelas,
            'prodi' => $prodi,
            'born' => $born 
        ]);

        return $query == true;
    }

    public function update(
        $id,
        $fullname,
        $email,
        $nim, 
        $kelas,
        $prodi,
        $born
    ){
        $this->db->where('id', $id);
        $query = $this->db->update($this->table,array(
            'fullname' => $fullname,
            'email' => $email,
            'nim' => $nim,
            'kelas' => $kelas,
            'prodi' => $prodi,
            'born' => $born
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