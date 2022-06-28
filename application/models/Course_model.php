<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Course_model extends CI_Model{

    public function upload($title, $description, $difficulty, $price) {
        $success = true;
        $this->db->trans_begin();

        //upload course details
        $courseID = $this->upload_course_details($title, $description, $difficulty, $price);
        $success = $success && $this->file_model->upload_thumbnail($courseID);
        
        $success = $success && $this->file_model->crop_thumbail($this->course_model->get_course_path($courseID));
        $success = $success && $this->file_model->upload_video($courseID);
        $success = $success && $this->file_model->upload_patterns($courseID);

        //if any part of file upload failed, roll back transaction
        //delete course created as well as any files uploaded
        if (!$success || $this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return null;
        } else {
            $this->db->trans_commit();
            return $courseID;
        }
    }

    public function upload_course_details($title, $description, $difficulty, $price) {
        $data = array(
            'title' => $title,
            'descript' => $description,
            'skill' => $difficulty,
            'price' => $price,
            'authorID' => $this->user_model->get_ID($this->session->userdata['username']),
            'createdDate' => date('Y-m-d H:i:s')
        );

        $query = $this->db->insert('courses', $data);
        return $this->db->insert_id();
    }

    public function search_courses($query) {
        if ($query == '') {
            return null;
        } else {
            $this->db->select(array('courses.courseID as courseID', 'courses.title as title', 'courses.descript as description'));
            $this->db->from('courses');
            $this->db->like('title', $query);
            $this->db->or_like('descript', $query);
            $this->db->order_by('title', 'DESC');
            return $this->db->get();
        }
    }

    public function get_recent_courses($limit = 12) {
        $this->db->select('*');
            $this->db->from('courses');
            $this->db->order_by('createdDate', 'DESC');
            $this->db->limit($limit);  
            return $this->db->get();
    }

    public function get_course_thumbnail($id) {
        $this->db->select('filename');
            $this->db->from('images');
            $this->db->where('courseID', $id);
            $this->db->limit(1);  
            return $this->db->get()->row();
    }

    public function get_course_path($id) {
        $this->db->select('path');
            $this->db->from('images');
            $this->db->where('courseID', $id);
            $this->db->limit(1);  
            return $this->db->get()->row()->path;
    }

    public function course_exists($courseID) {
        $this->db->where('courseID', $courseID);
        $result = $this->db->get('courses');
        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function get_course_details($courseID) {
        $this->db->select(array('courses.courseID as courseID', 'courses.title as title', 'courses.descript as description', 'username', 'images.filename as image', 'videos.filename as video'));
            $this->db->from('courses');
            $this->db->join('images', 'courses.courseID = images.courseID', 'inner');
            $this->db->join('patterns', 'courses.courseID = patterns.courseID', 'inner');
            $this->db->join('videos', 'courses.courseID = videos.courseID', 'inner');
            $this->db->join('users', 'users.ID = courses.authorID', 'inner');
            $this->db->where('courses.courseID', $courseID);
            $this->db->limit(1);  
            return $this->db->get()->row();
    }

    public function get_reviews($courseID) {
		$result = $this->db->select(array('reviews.title as title', 'reviews.review as review', 'reviews.rating as rating', 'users.username as username', 'reviews.createdDate as uploadDate'))
				 ->join('users', 'users.ID = reviews.reviewerID', 'inner')
                 ->where('courseID', $courseID)
                 ->get('reviews');
        return $result;
	}

    public function get_average_rating($courseID) {
        $result = $this->db->select_avg('rating')
                 ->where('courseID', $courseID)
                 ->get('reviews');
        return $result->row()->rating;
    }

    public function upload_review($reviewerID, $courseID, $title, $review, $rating, $createdDate) {
        $data = array(
            'reviewerID' => $reviewerID,
            'courseID' => $courseID,
            'title' => $title,
            'review' => $review,
			'rating' => $rating,
			'createdDate' => $createdDate
        );

        $query = $this->db->insert('reviews', $data);
    }
}
?>