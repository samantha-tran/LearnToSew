<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Course_model extends CI_Model{

    public function upload($title, $description, $difficulty, $price) {
        $success = true;
        $this->db->trans_begin();

        //upload course details
        $courseID = $this->upload_course_details($title, $description, $difficulty, $price);
        $success = $success && $this->file_model->upload_thumbnail($courseID);
        $success = $success && $this->file_model->upload_video($courseID);
        $success = $success && $this->file_model->upload_patterns($courseID);

        //if any part of file upload failed, roll back transaction
        //delete course created as well as any files uploaded
        if (!$success || $this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function upload_course_details($title, $description, $difficulty, $price) {
        $data = array(
            'title' => $title,
            'descript' => $description,
            'skill' => $difficulty,
            'price' => $price,
            'authorID' => $this->user_model->get_ID($this->session->userdata['username'])
        );

        $query = $this->db->insert('courses', $data);
        return $this->db->insert_id();
    }

    
}
?>