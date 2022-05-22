<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//only load if user is signed in and verified
		if ($this->session->userdata('username') == null) {
			redirect('login');
		} else if ($this->user_model->is_verified($this->session->userdata('username'))) {
			$this->load->view('template/header');
			$this->load->view('user_courses');
			$this->load->view('template/footer');
		} else {
			redirect('verify');
		}
	}

	public function details() {
		$user_details = $this->user_model->get_user_details($_SESSION['username']);
		$this->load->view('template/header');
		$this->load->view('user_details',  array('error' => "", 'user_details'=> $this->user_model->get_user_details($_SESSION['username'])));
		$this->load->view('template/footer');
	}

	public function update() {
		$this->load->library('form_validation');

		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$error = "";

		//check if username is unique
		if ($username && !$this->user_model->check_username($username, $this->user_model->get_ID($_SESSION['username']))) {
			$error .= "Username is already taken.";
		}

		//check if email is unique
		if ($email && !$this->user_model->check_email($email, $this->user_model->get_ID($_SESSION['username']))) {
			$error .= "Email has already been used.";
		}

		//check if password is sufficiently strong
		$this->form_validation->set_rules('password', 'Password',
            array(
                'trim',
                'required',
                'min_length[8]',
                array('password_callable', array($this->user_model, 'contains_special')
			)));

		if ($password && $this->form_validation->run() == FALSE) {
			$error .= "Password must be at least 8 characters and contain at least 1 special character.";
		}

		if ($error != "") {
			$this->load->view('template/header');
			$this->load->view('user_details', array('error' => $error, 'user_details' => $this->user_model->get_user_details($_SESSION['username'])));
			$this->load->view('template/footer');
		} else {
			// update details in DB
			$this->user_model->update_user_details($this->user_model->get_ID($_SESSION['username']), $username, $email, $password);

			// update session username if username was changed
			if ($username) {
				$this->session->set_userdata('username', $username);
			}
			
			$this->load->view('template/header');
			$this->load->view('user_details', array('error' => "", 'user_details' => $this->user_model->get_user_details($_SESSION['username'])));
			$this->load->view('template/footer');
		}
		
	}
}
