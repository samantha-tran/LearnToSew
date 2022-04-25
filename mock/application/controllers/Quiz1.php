<?php

/**
 *	Quiz 01, INFS3202/7202, semester 1, 2020 
 *	Student ID: <You Student ID>
 *	Prac Session: <Your Prac Session>	
 */
class Quiz1 extends CI_Controller {

    public function index() {
        $this->load->view('style_sheet');
        $this->load->view('start_quiz');
    }

    /**
     * Load a basic static webpage, including header.php, body.php, and footer.php.
     */
    public function task_a() {
        $this->load->view('style_sheet');
		
        // START WRITING YOUR CODE HERE
        $this->load->view('header');
        $this->load->view('body');
        $this->load->view('footer');
		
		// END
    }

    /**
     * Load the required page content in the following two scenarios.
     * 
     * Scenario 1. When a user visits http://localhost/infs3202_quiz1/Quiz1/task_b, enters a page
	 * number (e.g., 1) and clicks the Confirm button, the content in the corresponding page
	 * (e.g., /views/1.php) should be loaded.
     * 
     * Scenario 2. Load the required page content by simply appending the page number to the URL for
	 * task B (i.e., http://localhost/infs3202_quiz1/quiz1/task_b). For example, you will be able to
	 * load the page content of /views/1.php via http://localhost/infs3202_quiz1/quiz1/task_b/1.
	 *
     */
    public function task_b($page_num = NULL) {
        $this->load->view('style_sheet');
        $this->load->view('b_input');

        // START WRITING YOUR CODE HERE

        $page_number = $this->input->post('num');

        if ($page_num) {
            $this->load->view($page_num);
        } else if ($page_number) {
            $this->load->view($page_number);
        }
		//END

	}

}


?>
