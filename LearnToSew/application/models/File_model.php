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
			$this->load->view('template/header');
			$this->load->view('create_course', array('error' => $this->upload->display_errors()));
			$this->load->view('template/footer');
		} else {
			$fileData = $this->upload->data();
			$this->file_model->upload_file($table, $fileData['file_name'], $fileData['full_path'], $courseID);
			// load course page here
		}
	}
}
?>