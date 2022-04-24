<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
			$this->load->view('search');
			$this->load->view('template/footer');
		} else {
			redirect('verify');
		}
	}

	public function fetch() {
		$query = '';
		if ($this->input->get('query')) {
			$query = $this->input->get('query'); // get search query send from ajax search form
		}
		$data = $this->course_model->search_courses($query); // send query to course_model and put result into $data
		if (!$data == null) {
			echo json_encode($data->result()); //send result back
		} else {
			echo "";
		}
	}
}
