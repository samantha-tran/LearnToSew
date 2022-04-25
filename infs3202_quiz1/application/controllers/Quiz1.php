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
     * Load a basic webpage, including header.php, body.php, and footer.php.
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
     * Load the required page content.
     *
     * Subtask 1. Load only one required page by simply appending the page number to the URL for
	 * task B (i.e., http://localhost/infs3202_quiz1/quiz1/task_b). For example, you will be able to
	 * load the page content of /views/1.php via http://localhost/infs3202_quiz1/quiz1/task_b/1.
	 * Please consider all cases possible with user input. Use if statement where necessary to check input.
	 *
	 **/
    public function task_b($page_num = NULL) {
        $this->load->view('style_sheet');
		$this->load->view('b_input');

        // Subtask 1
		// START WRITING YOUR CODE HERE

		if (!file_exists(APPPATH.'views/task_b_pages/'.$page_num.'.php')) {
			// if page number doesn't exist
			show_404();
		} else if ($page_num) {
			// if page exists and isn't null
			$this->load->view('task_b_pages/'.$page_num);
		}
		//no page number is given, don't load any extra views
		
		// END
    }

	/**
	 * subtask2:
	 * Create a new function, when user clicks the button 'Details' in each page,
	 * a detailed page corresponding to that number of page should be loaded
	 * Hints: Go to views and have look at the directory and pages.
	 *
	 * Remember to add the code: $this->load->view('style_sheet');
	 * at the beginning of your function.
	 *
	 */
	//write your code here for loading detail pages
	// START WRITING YOUR CODE HERE

	public function details($page_num = NULL) {
		$this->load->view('style_sheet');
		if (!file_exists(APPPATH.'views/task_b_pages_details/'.$page_num.'.php')) {
			// if page number doesn't exist
			show_404();
		} else if ($page_num) {
			// if page exists and isn't null
			$this->load->view('task_b_pages_details/'.$page_num);
		}
	}

	// END
	//taskb ends here

}

?>
