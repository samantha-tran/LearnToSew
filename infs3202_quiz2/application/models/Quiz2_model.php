<?php

class Quiz2_model extends CI_Model{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function consultant_count(){
		
		// --------------------------------
		// START WRITING YOUR OWN CODE HERE


		$this->db->select("count(*) as consultant_count");
		$query = $this->db->get("consultant");

		// --------------------------------
		// Uncomment the following line when you finished your Query builder
		return $query->row();
	}
	
	public function appointments($record_limit, $keyword, $order){
		// --------------------------------
		// START WRITING YOUR OWN CODE HERE
		//array('customer_name', 'consultant_name', 'date', 'duration')
		$this->db->select("*");
		// Optional search restrictions
		if ($record_limit) {
			$this->db->limit($record_limit);
		}
		if ($keyword) {
			$this->db->like('consultant.consultant_name', $keyword);
		}
		$this->db->join('customer', 'customer.customer_id = appointment.customer_id');
		$this->db->join('consultant', 'consultant.consultant_code = appointment.consultant_code');
		$this->db->order_by('duration', $order);
		$query = $this->db->get('appointment');



		// --------------------------------
		// Uncomment the following line when you finished your Query builder
		return $query->result();

		
	}
	

		
}