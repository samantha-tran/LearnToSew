<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        if($result->num_rows() == 1 && password_verify($password, trim($result->row()->password))) {
            return true;
        } else {
            return false;
        }
    }

    // Check if username already exists
    public function check_username($username) {
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return false;
        } else {
            return true;
        }
    }

    // Check if email already exists
    public function check_email($email) {
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return false;
        } else {
            return true;
        }
    }

    //TODO: put to helper class
    public function contains_special($str) {
        if (preg_match('@[^\w]@', $str)) {
            return true;
        } else {
            return false;
        }
    }

    //TODO: put to helper class
    public function generate_random_string($length = 5) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function register_user($data) {
        $this->db->insert('users', $data);
    }

    public function validate_token($username, $token) {
        return $this->get_verification_token($username) == $token;
    }

    public function verify_account($username) {
        $this->db->set('is_verified', 1)
                 ->where('username', $username);
        $this->db->update('users');
    }

    public function get_verification_token($username) {
        $result = $this->db->select('verification_token')
                 ->where('username', $username)
                 ->limit(1)
                 ->get('users')
                 ->row();
        return $result->verification_token;
    }

    public function get_email($username) {
        $result = $this->db->select('email')
                 ->where('username', $username)
                 ->limit(1)
                 ->get('users')
                 ->row();
        return $result->email;
    }

    public function get_ID($username) {
        $result = $this->db->select('id')
                 ->where('username', $username)
                 ->limit(1)
                 ->get('users')
                 ->row();
        return $result->id;
    }

    public function is_verified($username) {
        $result = $this->db->select('is_verified')
                 ->where('username', $username)
                 ->limit(1)
                 ->get('users')
                 ->row();
        return $result->is_verified == 1;
    }
}
?>
