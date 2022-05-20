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
    }
?>