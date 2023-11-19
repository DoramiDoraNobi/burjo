<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hutang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_pemilik = $this->session->userdata('ses_id');
        $data['daftar_hutang'] = $this->Hutang_model->GetHutangbyPemilikID($id_pemilik);
        $data['list_pelanggan'] = $this->Hutang_model->GetPelangganbyPemilikID($id_pemilik);
        $this->load->view('hutang/index', $data);

    }
    public function do_create(){
        $id_pemilik = $this->session->userdata('ses_id');

        $jumlah_hutang = $this->Hutang_model->hitung_jumlah_hutang($id_pemilik);
        $langganan = $this->Hutang_model->cek_langganan($id_pemilik);

        if ($jumlah_hutang >= 150 && !$langganan) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jumlah pelanggan sudah mencapai batas maksimal. Silahkan upgrade ke premium untuk menambah pelanggan.</div>');
            redirect('hutang');
        }
        elseif ($jumlah_hutang >= 50 && $langganan) {
            $this->session->set_flashdata('error', 'Anda telah mencapai batas maksimum pelanggan untuk berlangganan.');
            redirect('hutang');
        }
        else {
            $data = array(
                'id_pelanggan' => $this->input->post('nama_pelanggan'),
                'jumlah_hutang' => $this->input->post('jumlah_hutang'),
                'id_pemilik' => $id_pemilik

            );
            $this->Hutang_model->CreateHutang($data);
            redirect('hutang');
        }
    }
    public function do_update(){
        $id_pemilik = $this->session->userdata('ses_id');
    
        $data = array(
            'id_hutang' => $this->input->post('id_hutang'),
            'id_pemilik' => $id_pemilik,
            'id_pelanggan' => $this->input->post('nama_pelanggan'),
            'jumlah_hutang' => $this->input->post('jumlah_hutang'),
            'status_pembayaran' => $this->input->post('status_pembayaran'), // 'lunas' atau 'belum lunas
            'id_pemilik' => $id_pemilik

        );
        $this->Hutang_model->UpdateHutang($data);
        redirect('hutang');
    }
    
    
    public function do_delete(){
        $id_hutang = $this->input->post('id_hutang');
        $this->Hutang_model->DeleteHutang($id_hutang);
        redirect('hutang');
    }
}


?>