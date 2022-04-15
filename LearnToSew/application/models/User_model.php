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

    public function contains_special($str) {
        if (preg_match('@[^\w]@', $str)) {
            return true;
        } else {
            return false;
        }
    }

    public function generate_random_string($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
}
?>
