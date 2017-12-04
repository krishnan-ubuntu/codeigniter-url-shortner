<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('url_model');
	}


	public function index() {
		$url_code = $this->uri->segment(1);
		if (!empty($url_code)) {
			$actual_url = $this->url_model->get_actual_url($url_code);
			if (!empty($actual_url)) {
				redirect($actual_url, 'refresh');
			}
			else {
				echo "Error";
			}
		}
		else {
			echo "Error";
		}
	}

} //class ends