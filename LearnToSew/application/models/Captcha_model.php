<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Captcha_model extends CI_Model{

    public function generate_captcha() {
        $word = $this->user_model->generate_random_string();
        $vals = array(
            'word'          => $word,
            'img_path'      => '/var/www/htdocs/LearnToSew/assets/img/captcha/',
            'img_url'       => base_url() . 'assets/img/captcha/',
            'font_path'     => '/var/www/htdocs/LearnToSew/system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);

        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );

        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);
        
        echo $cap['image'];
    }

    public function verify_captcha() {
        // Delete old captchas
        $expiration = time() - 7200; // Two hour limit
        $this->db->where('captcha_time < ', $expiration)
                ->delete('captcha');

        // Check if captcha exists
        $this->db->select('COUNT(*) as count');
        $this->db->where('word', $_POST['captcha']);
        $this->db->where('ip_address', $this->input->ip_address());
        $this->db->where('captcha_time >', $expiration);
        $result = $this->db->get('captcha');

        if ($result->row()->count == 0) {
            return false;
        }
        
        return true;
    }
}
?>
