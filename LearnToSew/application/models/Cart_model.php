<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
    class Cart_model extends CI_Model{

        public function get_cart_details($userID) {
            $this->db->select(array('courses.title as title', 'courses.price', 'cart.cart_id'));
            $this->db->join('courses', 'courses.courseID = cart.course_id');
            $this->db->where('user_id', $userID);
            $result = $this->db->get('cart');

            return $result;
        }

        public function get_total_cost($userID) {
	    $this->db->select('sum(courses.price) as cost');
	    $this->db->from('cart');
            $this->db->join('courses', 'courses.courseID = cart.course_id');
            $this->db->where('user_id', $userID);
            $result = $this->db->get();
            return $result->row()->cost;
        }

        public function is_in_cart($userID, $courseID) {
            $this->db->where('user_id', $userID);
            $this->db->where('course_id', $courseID);
            $this->db->from('cart');
            return ($this->db->count_all_results() > 0);
        }

        public function get_cartID($userID, $courseID) {
            $result = $this->db->select('cart_id as cartID')
                    ->where('user_id', $userID)
                    ->where('course_id', $courseID)
                    ->limit(1)
                    ->get('cart');
            if ($result->num_rows() > 0) {
                return $result->row()->cartID;
            } else {
                return 0;
            }
        }
    }
?>
