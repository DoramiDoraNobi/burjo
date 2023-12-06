<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load model yang akan digunakan
        $this->load->model('Payment_model');
    }

    public function index() {
        // Tampilkan halaman konfirmasi pembayaran
        $this->load->view('payment_confirm_view');
    }

    public function process_payment_confirmation() {
        // Tangkap data dari formulir
        $user_id = $this->session->userdata('ses_id');
        $amount = $this->input->post('amount');
        $payment_date = $this->input->post('payment_date');
        $payment_method = $this->input->post('payment_method');

        // Upload gambar bukti pembayaran ke direktori assets/payment_confirm
        $config['upload_path'] = './assets/payment_confirm/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // Maksimal ukuran file 2MB
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('payment_proof')) {
            // Jika gagal upload
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            // Jika berhasil upload
            $upload_data = $this->upload->data();
            $payment_proof = 'assets/payment_confirm/' . $upload_data['file_name'];

            // Simpan data konfirmasi pembayaran ke database
            $this->Payment_model->save_payment_confirmation($user_id, $amount, $payment_date, $payment_method, $payment_proof);

            // Redirect ke halaman sukses atau lainnya
            redirect('auth/dashboard');
        }
    }

    public function success() {
        // Tampilkan halaman sukses konfirmasi pembayaran
        $this->load->view('payment_success_view');
    }

    public function manage_subscription() {
        // Ambil data SubscriptionPayments dari model
        $data['payments'] = $this->Payment_model->get_payments();

        // Tampilkan view dengan data yang telah diambil
        $this->load->view('admin/manage_subscription', $data);
    }

    public function change_status() {
        $payment_id = $this->input->post('payment_id');
        // Update status pembayaran ke Accepted
        $this->Payment_model->update_payment_status($payment_id, 'Accepted');

        // Redirect kembali ke halaman admin subscription payments setelah mengubah status
        redirect('payment/manage_subscription');
    }
}
?>
