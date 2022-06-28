<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
		$this->load->model('reset_model');
    }

	public function reset_email() {
		$this->load->view('get_reset_email');
	}

	public function send_reset_email() {
		$email = $this->input->post('email');
		$uid = $this->user_model->get_ID_from_email($email);

		if ($uid == null) {
			echo "Email is not associated with any account!";
		} else {
			//generate reset token
			$hash = md5(rand(0,1000));
			$url = base_url()."reset/reset?token=".$hash;
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

    public function reset_password() {
        $password = $this->input->post('password');
        $uid = $this->input->post('uid');
        $this->user_model->update_user_details($uid, "", "", $password);
        echo "Password successfully reset. Click <a href='" . base_url() . "login'>here </a> To return to the login page.";
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