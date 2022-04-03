<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('login', $data);
		} else {
			$this->load->view('welcome_message');
		}
		$this->load->view('template/footer');
	}
	public function check_login()
	{
		$this->load->model('user_model');
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form

		if (!$this->session->userdata('logged_in')) {

			if ( $this->user_model->login($username, $password) ) 
			{
				$user_data = array(
					'username' => $username,
					'logged_in' => true //create session variable
				);
				$this->session->set_userdata($user_data); //set user status to logged in
				redirect('login'); //redirect user to home page
			} else {
				$this->load->view('login', $data);
			}
		} else {
			redirect('login');
		}
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$this->load->helper('url');
		$this->session->unset_userdata('logged_in');
		redirect('login');
	}
}


