<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Pattern_model extends CI_Model{

    function get_purchased_patterns($uid) {
        $result = $this->db->select('courses.title, patterns.filename')
                ->where('user_id', $uid)
                ->join('patterns', 'purchases.course_id = patterns.courseID')
                ->join('courses', 'purchases.course_id = courses.courseID')
                ->get('purchases');
        return $result;
    }

    function is_purchased($uid, $cid) {
        $result = $this->db->select('1')
                ->where('user_id', $uid)
                ->where('course_id', $cid)
                ->get('purchases');
        return $result->num_rows() >= 1;
    }
}
?>
