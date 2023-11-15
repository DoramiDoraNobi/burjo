<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model 
{
    public function CheckLogin($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password',$password);
        return $this->db->get('pemilikwarmindo');
    }
    public function CreateUser($data)
    {
        $this->db->insert('pemilikwarmindo',$data);
        return $this->db->affected_rows();
    }
}

?>