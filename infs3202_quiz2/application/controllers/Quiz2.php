<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz2 extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Quiz2_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
    }
	
	public function index()
	{
		$data = array("count"=>null, "record_limit"=>null, "keyword"=>null, "sort_by"=>null, "movie_rate"=>null);
		
		$keyword = $this->input->get('keyword');
		$sort_by = $this->input->get('sort_by');
        $record_limit = $this->input->get('record_limit');

        $data['count'] = $this->Quiz2_model->consultant_count();
	
		if(isset($keyword) && isset($sort_by)){
			$data['keyword'] = $keyword;
            $data['record_limit'] = $record_limit;
            $data['sort_by'] = $sort_by;
			$data['appointment'] = $this->Quiz2_model->appointments($record_limit, $keyword, $sort_by);
		}
		
		$this->load->view('quiz2_consultation',$data);
		
	}
	
}
