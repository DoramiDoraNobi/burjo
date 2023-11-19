<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    public function cek_langganan($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('Berlangganan');
    
        return $query->num_rows() > 0; // Mengembalikan true jika memiliki langganan
    }
    
    public function hitung_jumlah_pelanggan($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('Pelanggan');
        return $query->num_rows();
    }

    public function CreatePelanggan($data)
    {
        $this->db->insert('Pelanggan', $data);
    }

    public function GetPelangganbyPemilikID($id_pemilik)
    {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('Pelanggan');
        return $query->result();
    }

    public function GetPelangganbyID($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('Pelanggan');
        return $query->row_array();
    }

    public function UpdatePelanggan($data)
    {
        $this->db->where('id_pelanggan', $data['id_pelanggan']);
        $this->db->update('Pelanggan', $data);
    }

    public function DeletePelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('Pelanggan');
    }
    
}

?>