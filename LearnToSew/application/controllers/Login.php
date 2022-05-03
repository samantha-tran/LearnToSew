<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

	public function index()
	{
		$data['error'] = "";
		
		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('login', $data);
		} else {
			redirect('home');
		}
	}
	public function check_login()
	{
		$data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!</div> ";

		$username = $this->input->post('username'); //get username from login form
		$password = $this->input->post('password'); //get password from login form
		$remember = $this->input->post('remember'); //get remember me from login form

		if (!$this->session->userdata('logged_in')) //check if user is already logged in
		{
			if ($this->user_model->login($username, $password)) //check if username and password is valid
			{
				$user_data = array(
					'username' => $username,
					'logged_in' => true //create session variable
				);
				if ($remember) { // if remember me is activated create cookie
					set_cookie("username", $username, '300'); //set cookie username
					set_cookie("password", $this->encryption->encrypt($password), '300'); //set cookie password
					set_cookie("remember", $remember, '300'); //set cookie remember
				}
				$this->session->set_userdata($user_data);
				redirect('login'); //redirect user to login page
			} else {
				$this->load->view('login', $data); //if username and/or password is incorrect, show error message and ask user to re-attempt login
			}
		} else {
			redirect('login'); //user is already logged in so redirect to homepage
		}
	}

	public function forgot() {
		$this->load->view('password_reset');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login');
	}
/**
	public function reset_password() {
		$hash = md5(rand(0,1000));
		$url = base_url()."login/reset?token=".$hash;
		//insert token
		//generate email
	}

	public fucntion reset() {
		$token = $_GET['token'];
		//verify whether the token exists //return true and delete token
		//if token exists then prompt 
		//otherwise echo you are not allowed
	} 
**/
}
