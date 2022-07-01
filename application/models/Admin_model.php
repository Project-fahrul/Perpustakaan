<?php 

class Admin_Model extends CI_Model{
    public function checkAdminByEmailPassword($email, $pass){
        $query = $this->db->get_where('admin', array(
            'email' => $email,
            'password' => $pass
        ));

        return isset($query) ? $query->row(1) : null;
    }

    public function registerAdmin($email, $pass, $nim, $nama, $kelas, $prodi){
       $query =  $this->db->insert("admin", [
            'email' => $email,
            'password' => $pass,
            'nim' => $nim,
            'kelas' => $kelas,
            'fullname' => $nama,
            'prodi' => $prodi
        ]);

        return $query == true;
    }

    public function checkAdminByEmaiAndNim($email, $nim){
        $query = $this->db->get_where('admin', array(
            'email' => $email,
            'nim' => $nim
        ));

        return isset($query) ? $query->row(1) : null;
    }
}