<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    function  __construct(){ 
        parent::__construct(); 
         
        // Load paypal library 
        $this->load->library('paypal_lib'); 
    } 

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

    function buy($id){ 
        // Set variables for paypal form 
        $returnURL = base_url().'paypal/success'; //payment success url 
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url 
        $notifyURL = base_url().'paypal/ipn'; //ipn url 
         
        // Get product data from the database 
        $product = $this->product->getRows($id); 
         
        // Get current user ID from the session (optional) 
        $userID = !empty($_SESSION['userID'])?$_SESSION['userID']:1; 
         
        // Add fields to paypal form 
        $this->paypal_lib->add_field('return', $returnURL); 
        $this->paypal_lib->add_field('cancel_return', $cancelURL); 
        $this->paypal_lib->add_field('notify_url', $notifyURL); 
        $this->paypal_lib->add_field('item_name', $product['name']); 
        $this->paypal_lib->add_field('custom', $userID); 
        $this->paypal_lib->add_field('item_number',  $product['id']); 
        $this->paypal_lib->add_field('amount',  $product['price']); 
         
        // Render paypal form 
        $this->paypal_lib->paypal_auto_form(); 
    } 
}
