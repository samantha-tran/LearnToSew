<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
		$this->load->model('reset_model');
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

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login');
	}


	public function reset_email() {
		$this->load->view('get_reset_email');
	}

	public function reset_password() {
		$email = $this->input->post('email');
		$uid = $this->user_model->get_ID_from_email($email);

		if ($uid == null) {
			echo "Email is not associated with any account!";
		} else {
			//generate reset token
			$hash = md5(rand(0,1000));
			$url = base_url()."login/reset?token=".$hash;
			//insert token
			$this->reset_model->insert_token($hash, $uid);
			//generate email
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'mailhub.eait.uq.edu.au',
				'smtp_port' => 25,
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE,
				'starttls' => TRUE,
				'newline' => "\r\n"
			);

			$data['reset_url'] = $hash;
			$data['username'] = $this->user_model->get_username($uid);
			$this->email->initialize($config);
			$this->email->from('samantha.tran@uqconnect.edu.au');
			$this->email->to($email);
			$this->email->subject('Password Change Request');
			$this->email->message($this->load->view('reset_email', $data, true));
			$this->email->send();

			echo sprintf("An email containing password reset link has been sent to %s", $email);
		}

		
	}

	public function reset() {
		$token = $_GET['token'];
		//verify whether the token exists //return true and delete token
		if ($this->reset_model->token_exists($token)) {
			//get user id
			$uid = $this->reset_model->get_user_id($token);
			//delete token
			$this->reset_model->delete_token($token);
			//prompt reset
			$data['uid'] = $uid;
			$this->load->view('password_reset', $data);
		} else {
			echo "Invalid reset token";
		}
	} 

}
