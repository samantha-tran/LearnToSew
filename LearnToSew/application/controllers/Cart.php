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

    function buy(){ 
        $userID = $this->user_model->get_ID($_SESSION['username']);
        // Set variables for paypal form 
        $returnURL = base_url().'paypal/success'; //payment success url 
        $cancelURL = base_url().'paypal/cancel'; //payment cancel url 
        $notifyURL = base_url().'paypal/ipn'; //ipn url 
         
        // Get product data from the database 
        $totalCost = $this->cart_model->get_total_cost($userID);
         
        // Add fields to paypal form 
        $this->paypal_lib->add_field('return', $returnURL); 
        $this->paypal_lib->add_field('cancel_return', $cancelURL); 
        $this->paypal_lib->add_field('notify_url', $notifyURL); 
        //$this->paypal_lib->add_field('item_name', $product['name']); 
        $this->paypal_lib->add_field('custom', "test"); 
        //$this->paypal_lib->add_field('item_number',  $product['id']); 
        $this->paypal_lib->add_field('amount',  $totalCost); 
         
        // Render paypal form 
        $this->paypal_lib->paypal_auto_form(); 
    } 
}
