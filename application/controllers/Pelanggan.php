<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_pemilik = $this->session->userdata('ses_id');
        $data['daftar_pelanggan'] = $this->Pelanggan_model->GetPelangganbyPemilikID($id_pemilik);
        $this->load->view('pelanggan/index', $data);

    }
    public function do_create(){
        $id_pemilik = $this->session->userdata('ses_id');

        $jumlah_pelanggan = $this->Pelanggan_model->hitung_jumlah_pelanggan($id_pemilik);
        $langganan = $this->Pelanggan_model->cek_langganan($id_pemilik);

        if ($jumlah_pelanggan >= 150 && !$langganan) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah pelanggan sudah mencapai batas maksimal. Silahkan upgrade ke premium untuk menambah pelanggan.</div>');
            redirect('pelanggan');
        }
        elseif ($jumlah_pelanggan >= 50 && $langganan) {
            $this->session->set_flashdata('error', 'Anda telah mencapai batas maksimum pelanggan untuk berlangganan.');
            redirect('pelanggan');
        }
        else {
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'alamat' => $this->input->post('alamat'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
                'catatan_tambahan' => $this->input->post('catatan_tambahan'),
                'id_pemilik' => $id_pemilik

            );
            $this->Pelanggan_model->CreatePelanggan($data);
            redirect('pelanggan');
        }
    }
    public function do_update(){
        $id_pemilik = $this->session->userdata('ses_id');
    
        $data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'id_pemilik' => $id_pemilik,
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon'),
            'catatan_tambahan' => $this->input->post('catatan_tambahan'),
        );
        $this->Pelanggan_model->UpdatePelanggan($data);
        redirect('pelanggan');
    }
    
    
    public function do_delete(){
        $id_pelanggan = $this->input->post('id_pelanggan');
        $this->Pelanggan_model->DeletePelanggan($id_pelanggan);
        redirect('pelanggan');
    }
}


?>