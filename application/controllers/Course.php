<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

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
		$this->load->view('template/header');
        $this->load->view('create_course', array('error'=>""));
        $this->load->view('template/footer');
	}

    public function upload()
    {
		//upload course
		$courseID = $this->course_model->upload($this->input->post('title'), $this->input->post('description'), $this->input->post('difficulty'), $this->input->post('price'));
		
		if ($courseID != null) {
			redirect('home');
		} else {
			$this->load->view('template/header');
			$this->load->view('create_course', array('error' => $this->upload->display_errors()));
			$this->load->view('template/footer');
		}
	}

	public function details($id = null) {
		if ($id && $this->course_model->course_exists($id)) {
			$this->load->view('template/header');
			$this->load->view('course_details', array('course_details'=> $this->course_model->get_course_details($id)));
			$this->load->view('template/footer');
		} else {
			show_404();
		}
	}

	public function upload_review($courseID) {
		$this->course_model->upload_review($this->user_model->get_ID($_SESSION['username']), $courseID, $this->input->post("title"), $this->input->post("review"), $this->input->post("rating"), date('Y-m-d H:i:s'));
		redirect('course/details/'.$courseID);
	}

	
	
}
