<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Hutang_model');
    }
    public function index()
    {
        $this->load->view('auth/index');
    }
    public function register(){
        $this->load->view('auth/register');
    }
    public function dashboard()
    {
        $pemilik_id = $this->session->userdata('ses_id');
        $data['jumlah_pelanggan'] = $this->Pelanggan_model->hitung_jumlah_pelanggan_by_id_pemilik($pemilik_id);
        $data['jumlah_hutang'] = $this->Hutang_model->hitung_jumlah_hutang($pemilik_id);
        $data['total_hutang'] = $this->Hutang_model->hitung_total_hutang($pemilik_id);
        $data['hutang_terkini'] = $this->Hutang_model->GetHutangOrderByTanggal($pemilik_id);
        $this->load->view('auth/dashboard', $data);
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $checkLogin = $this->Auth_model->checkLogin($email, $password);

        if ($checkLogin->num_rows() > 0) {
            $data = $checkLogin->row_array();
            $this->session->set_userdata('masuk', TRUE);
            $this->session->set_userdata('ses_id', $data['id_pemilik']);
            $this->session->set_userdata('ses_nama', $data['nama_warung']);
            $this->session->set_userdata('ses_level', $data['level']);
            redirect('auth/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Gagal login: Cek username, password!');
            redirect('auth/index');
        }
    }
    public function do_register(){
        // Validasi form register
        $this->form_validation->set_rules('nama_warung', 'Nama Warung', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan kembali form register
            $this->load->view('auth/register');
        } else {
            // Jika validasi berhasil, tambahkan katering ke database
            $data = array(
                'nama_warung' => $this->input->post('nama_warung'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            $this->Auth_model->CreateUser($data);
            redirect('auth');
        }
    }
    public function do_logout()
    {
        $this->session->sess_destroy();
        redirect('auth/index');
    }


    
}


?>