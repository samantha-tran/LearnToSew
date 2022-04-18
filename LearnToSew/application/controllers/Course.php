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
		$data = array();

		// Count total of pattern files
		$pattern_file_count = count($_FILES['patternFiles']['name']);

		// Loop through all files
		for ($i = 0; $i < $pattern_file_count; $i++) {
			$_FILES['patternFile']['name'] = $_FILES['patternFiles']['name'][$i];
			$_FILES['patternFile']['type'] = $_FILES['patternFiles']['type'][$i];
			$_FILES['patternFile']['size'] = $_FILES['patternFiles']['size'][$i];
			$_FILES['patternFile']['tmp_name'] = $_FILES['patternFiles']['tmp_name'][$i];
			$_FILES['patternFile']['error'] = $_FILES['patternFiles']['error'][$i];

			$upload_path = "uploads/pdfs";
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = 10000;

			$upload_success = $this->do_upload('patternFile', $config);
		}
    }

	public function do_upload($name, $config) {

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($name)) {
			$this->load->view('template/header');
			$this->load->view('create_course', array('error' => $this->upload->display_errors()));
			$this->load->view('template/footer');
		} else {
			$fileData = $this->upload->data();
			$this->course_model->upload($fileData['file_name'], $fileData['full_path'], 2);
			// load course page here
		}
	}
}
