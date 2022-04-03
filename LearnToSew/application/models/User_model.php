<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
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

    // Check if password is sufficient strength
    public function check_password($password) {
        $number    = preg_match('@[0-9]@', $password);
        $specialChar = preg_match('@[^\w]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);

        if (!$number || !$specialChar || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }

    public function register_user($username, $email, $password) {
        $query = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";
        $this->db->query($query);
    }



}
?>
