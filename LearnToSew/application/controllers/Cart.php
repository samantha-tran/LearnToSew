<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function index() {
        $this->load->view('template/header');
        $this->load->view('cart');
        $this->load->view('template/footer');
    }
	public function add() {
        $data = array(
            'course_id' => $this->input->post('courseID'),
            'user_id' => $this->input->post('userID')
        );
        $this->db->insert('cart', $data);
    }

    public function remove() {
        var_dump($this->input->post('cartID'));
        $this->db->where('cart_id', $this->input->post('cartID'));
        $this->db->delete('cart');
    }
}
