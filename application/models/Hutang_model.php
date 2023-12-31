<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang_model extends CI_Model 
{
    public function cek_langganan($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('Berlangganan');
    
        return $query->num_rows() > 0; // Mengembalikan true jika memiliki langganan
    }
    
    public function hitung_jumlah_hutang($id_pemilik) {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('hutang');
        return $query->num_rows();
    }

    public function CreateHutang($data)
    {
        $this->db->insert('hutang', $data);
    }

    public function GetHutangbyPemilikID($id_pemilik)
    {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('hutang');
        return $query->result();
    }

    public function GetPelangganbyPemilikID($id_pemilik)
    {
        $this->db->where('id_pemilik', $id_pemilik);
        $query = $this->db->get('Pelanggan');
        return $query->result();
    }

    public function GetHutangbyID($id_hutang)
    {
        $this->db->where('id_hutang', $id_hutang);
        $query = $this->db->get('hutang');
        return $query->row_array();
    }

    public function UpdateHutang($data)
    {
        $this->db->where('id_hutang', $data['id_hutang']);
        $this->db->update('hutang', $data);
    }

    public function DeleteHutang($id_hutang)
    {
        $this->db->where('id_hutang', $id_hutang);
        $this->db->delete('hutang');
    }
    public function GetPelanngganbyID($id_pelanggan)
    {
        $this->db->select('nama_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $result = $this->db->get('pelanggan')->row();
    
        return ($result) ? $result->nama_pelanggan : '';
        
    }
    #menampilkan history hutang bedasarkan id_pemilik dengan order bedasarkan tanggal
    public function GetHistoryHutang($id_pemilik)
    {
        $this->db->where('id_pemilik', $id_pemilik);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get('hutang');
        return $query->result();
    }

    public function GetHutangbyPelangganID($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('hutang');
        return $query->result();
    }

    

public function hitung_total_hutang($id_pemilik) {
    $this->db->select_sum('jumlah_hutang');
    $this->db->where('id_pemilik', $id_pemilik);
    $query = $this->db->get('hutang');
    $result = $query->row();
    return $result->jumlah_hutang;
}



public function GetHutangOrderByTanggal($id_pemilik)
{
    $this->db->where('id_pemilik', $id_pemilik);
    $this->db->order_by('tanggal', 'DESC');
    $query = $this->db->get('hutang');
    return $query->result();
}

}
