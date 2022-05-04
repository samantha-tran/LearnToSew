<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); //enable session
    }

    public function index() {
		$this->load->view('register');
    }

    public function register() {
        // load form validation library
        $this->load->library('form_validation');

        //set validation rules
        $this->form_validation->set_rules('username', 'Username', 
            array(
                'trim',
                'required',
                'min_length[5]',
                'max_length[15]',
                array('username_callable', array($this->user_model, 'check_username'))
            ),
            array(
                'required' => 'You have not provided %s.',
                'username_callable' => '<div>This username already exists.',
            ));
        $this->form_validation->set_rules('email', 'Email', 
            array(
                'trim',
                'required', 
                'valid_email', 
                array('email_callable', array($this->user_model, 'check_email'))
            ),
            array(
                'email_callable' => 'An account with this email already exists.'
            ));
        $this->form_validation->set_rules('password', 'Password',
            array(
                'trim',
                'required',
                'min_length[8]',
                array('password_callable', array($this->user_model, 'contains_special'))
            ),
            array(
                'password_callable' => 'Password must contain at least one special character.'
            ));

        if (($this->form_validation->run() == TRUE) && $this->captcha_model->verify_captcha()) {
            $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'verification_token' => $this->user_model->generate_random_string(),
            'is_verified' => 0
            );
            $this->user_model->register_user($data);
            redirect('login');
        } else {
            if (!$this->captcha_model->verify_captcha()) {
                $data = array(
                    'captcha_error' => 'Captcha was invalid',
                );
            } else {
                $data = array(
                    'captcha_error' => '',
                );
            }
            $this->load->view('register', $data);
        }
    }
}