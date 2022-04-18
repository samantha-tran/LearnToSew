<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Course_model extends CI_Model{

    public function upload($filename, $path, $courseID) {
        $data = array(
            'filename' => $filename,
            'path' => $path,
            'courseID' => $courseID
        );

        $query = $this->db->insert('patterns', $data);
    }
}
?>