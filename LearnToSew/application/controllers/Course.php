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
		$courseID = $this->course_model->upload_course($this->input->post('title'), $this->input->post('description'), $this->input->post('difficulty'), $this->input->post('price'));

		// Count total of pattern files
		$pattern_file_count = count($_FILES['patternFiles']['name']);

		// Loop through all files and upload patterns
		for ($i = 0; $i < $pattern_file_count; $i++) {
			$_FILES['patternFile']['name'] = $_FILES['patternFiles']['name'][$i];
			$_FILES['patternFile']['type'] = $_FILES['patternFiles']['type'][$i];
			$_FILES['patternFile']['size'] = $_FILES['patternFiles']['size'][$i];
			$_FILES['patternFile']['tmp_name'] = $_FILES['patternFiles']['tmp_name'][$i];
			$_FILES['patternFile']['error'] = $_FILES['patternFiles']['error'][$i];

			$config['upload_path'] = 'uploads/pdfs';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = 10000;

			$this->file_model->do_upload('patternFile', 'patterns', $courseID, $config);
		}

		//upload video
		$config['upload_path'] = 'uploads/videos';
		$config['allowed_types'] = 'mp4';
		$config['max_size'] = 10000;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;

		$this->file_model->do_upload('videoFile', 'videos', $courseID, $config);



		//upload thumbail image
		$config['upload_path'] = 'uploads/images';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size'] = 10000;
		$config['max_width'] = 500;
		$config['max_height'] = 500;

		$this->file_model->do_upload('thumbnail', 'images', $courseID, $config);
    }

	
}
