<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Reset_model extends CI_Model{

    public function insert_token($hash, $userID) {
        $currentTime = date("Y-m-d H:i:s");
        $data = array(
            'token' => $hash,
            'user_id' => $userID,
            'expiry_time' => date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($currentTime)))
        );
        $this->db->insert('reset_tokens', $data);
    }

    public function token_exists($token) {
        //delete all tokens that have expired
        $this->db->where('expiry_time <=', date("Y-m-d H:i:s"));
        $this->db->delete('reset_tokens');

        //check if token exists
        $result = $this->db->select('1')
                ->where('token =', $token)
                ->get('reset_tokens');
        
        return $result->num_rows() > 0;
    }

    public function delete_token($token) {
        $this->db->where('token =', $token);
        $this->db->delete('reset_tokens');
    }

    public function get_user_id($token) {
        $result = $this->db->select('user_id')
                ->where('token =', $token)
                ->get('reset_tokens');
        return $result->row()->user_id;
    }
}
?>
