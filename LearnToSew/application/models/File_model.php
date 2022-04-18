<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class File_model extends CI_Model{

    public function upload_file($table, $filename, $path, $courseID) {
        $data = array(
            'filename' => $filename,
            'path' => $path,
            'courseID' => $courseID
        );

        $query = $this->db->insert($table, $data);
    }
    
    public function do_upload($name, $table, $courseID, $config) {

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($name)) {
			//$this->load->view('template/header');
			//$this->load->view('create_course', array('error' => $this->upload->display_errors()));
			//$this->load->view('template/footer');
            return false;

		} else {
			$fileData = $this->upload->data();
			$this->file_model->upload_file($table, $fileData['file_name'], $fileData['full_path'], $courseID);
			// load course page here
            return true;

		}
	}

    public function upload_thumbnail($courseID) {
        //upload thumbail image
		$config['upload_path'] = 'uploads/images';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size'] = 10000;
		$config['max_width'] = 500;
		$config['max_height'] = 500;

		return $this->file_model->do_upload('thumbnail', 'images', $courseID, $config);
    }

    public function upload_video($courseID) {
        //upload video
		$config['upload_path'] = 'uploads/videos';
		$config['allowed_types'] = 'mp4';
		$config['max_size'] = 10000;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;

		return $this->file_model->do_upload('videoFile', 'videos', $courseID, $config);
    }

    public function upload_patterns($courseID) {
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

			if (!$this->file_model->do_upload('patternFile', 'patterns', $courseID, $config)) {
                return false;
            }
		}

        return true;
    }
}
?>