<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Course_model extends CI_Model{

    public function upload_course($title, $description, $difficulty, $price) {
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