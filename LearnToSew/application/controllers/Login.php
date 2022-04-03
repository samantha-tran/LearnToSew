<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

	public function index()
	{
		$data['error']= "";
		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('login', $data);
		} else {
			$this->load->view('homepage');
		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		if (!$this->session->userdata('logged_in'))
		{
			if ($this->user_model->login($username, $password)) //check if username and password is valid
			{
				$user_data = array(
					'username' => $username,
					'logged_in' => true //create session variable
				);
				$this->session->set_userdata($user_data);
				redirect('homepage'); //redirect user to login page
			} else {
				$this->load->view('login', $data); //if username and/or password is incorrect, show error message and ask user to re-attempt login
			}
		} else {
			redirect('homepage'); //user is already logged in so redirect to homepage
		}
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login');
	}
}
