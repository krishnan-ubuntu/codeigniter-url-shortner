<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Urlshortner extends REST_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('url_model');
    }


    public function make_url_short_post() 
    {
        header('Access-Control-Allow-Origin: *');
        $base_url = 'Enter your base URL here';
        $actual_url = $this->post('actualUrl');
        $digits = 4;
        $random_code = rand(pow(10, $digits-1), pow(10, $digits)-1);

        $is_url_present = $this->url_model->check_if_actual_url_exists($actual_url);

        if ($is_url_present == "no") {
            $url_shortened = $this->url_model->make_url_short($random_code, $actual_url);
        }
        else {
            $url_shortened = $this->url_model->update_short_url($random_code, $actual_url);
        }
    	
        if ($url_shortened) {
            $short_url = $base_url.$random_code;
            $result = array(
                'status' => 'success', 
                'short_url' => $short_url
                );
            $this->response($result, 200);
        }
        else {
            $this->response(array('status' => 'failed', 'msg' => 'There was an error, please try again'));
        }
    }


} //class ends