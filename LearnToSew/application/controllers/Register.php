<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

    public function index() {
        $data['error']= "";
		$this->load->view('register', $data);
		$this->load->view('template/footer');
    }

    public function register() {
        // initialise empty error string
        $data['error'] = "";

        // get details from register form
        $username = $this->input->post('username'); 
        $email = $this->input->post('email'); 
		$password = $this->input->post('password'); 

        if (!$this->user_model->check_email($email)) {
            $data['error'] .= "<div class=\"alert alert-danger\" role=\"alert\"> Account with email already exists. </div>";
        }

        if (!$this->user_model->check_username($password)) {
            $data['error'] .= "<div class=\"alert alert-danger\" role=\"alert\"> Username is taken. </div>";
        }

        // check if password is strong enough
        if (!$this->user_model->check_password($password)) {
            $data['error'] .= "<div class=\"alert alert-danger\" role=\"alert\"> Password must be at least 8 characters in length, contain a number, an uppercase character and a special character. </div>";
        }

        if ($data['error'] == "") {
            //if no errors
            $this->user_model->register_user($username, $email, $password);
        }

        redirect('register', $data);

    }
}