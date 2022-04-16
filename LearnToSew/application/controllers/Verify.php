<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

	public function index()
	{
        $username = $this->session->userdata('username');
        $verification_code = $this->user_model->get_verification_token($username);
		$this->send_verification_email($this->user_model->get_email($username), $verification_code);
        $this->load->view('verify');
	}

    public function validate() 
    {
        // get validation string from inputs
            $verification_code = $this->input->post('field1') . $this->input->post('field2') . $this->input->post('field3') . $this->input->post('field4') . $this->input->post('field5');
            
        // compare validation token and set account as verified
        if ($this->user_model->validate_token($this->session->userdata('username'), $verification_code)) {
            $this->user_model->verify_account($this->session->userdata('username'));

            //redirect to main page
        }
        
    }

    public function send_verification_email($email, $token) {
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

        $data['verification_token'] = $token;
        $this->email->initialize($config);
        $this->email->from('samantha.tran@uqconnect.edu.au');
        $this->email->to($email);
        $this->email->subject('Verify your LearnToSew account');
        $this->email->message($this->load->view('verify_email', $data, true));
        $this->email->send();
    }
}
