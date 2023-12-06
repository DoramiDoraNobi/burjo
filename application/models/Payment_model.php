<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function save_payment_confirmation($user_id, $amount, $payment_date, $payment_method, $payment_proof) {
        // Simpan data konfirmasi pembayaran ke dalam tabel
        $data = array(
            'User_ID' => $user_id,
            'Amount' => $amount,
            'Payment_Date' => $payment_date,
            'Payment_Method' => $payment_method,
            'Payment_Proof' => $payment_proof
        );
        $this->db->insert('SubscriptionPayments', $data);
    }

    public function get_payments() {
        // Ambil semua data SubscriptionPayments
        return $this->db->get('SubscriptionPayments')->result();
    }

    public function update_payment_status($payment_id, $new_status) {
        // Update Payment_Status ke Accepted untuk Payment_ID tertentu
        $this->db->set('Payment_Status', $new_status);
        $this->db->where('ID', $payment_id);
        $this->db->update('SubscriptionPayments');
    }
}
?>
