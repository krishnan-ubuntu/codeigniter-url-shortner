<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Krishnan ks@geedesk.com
 *
 * @license 
 * 
 */

class Url_model extends CI_Model {


	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('string');
	}


	public function get_actual_url($url_code) {
		$this->db->select('*');
		$this->db->from('url_index');
		$this->db->where('url_code', $url_code);
		foreach ($this->db->get()->result() as $value) {
			return $value->actual_url;
		}
	}


	public function check_if_actual_url_exists($actual_url) {
		$this->db->select('*');
		$this->db->from('url_index');
		$this->db->where('actual_url', $actual_url);
		$result = count($this->db->get()->result());
		if ($result == 0) {
			return "no";
		}
		else {
			return "yes";
		}
	}


	public function make_url_short($random_code, $actual_url) {
		$data = array(
			'actual_url' 	=> $actual_url,
			'url_code' 		=> $random_code,
			'created_date' 	=> date('Y-m-d')
			);
		return $this->db->insert('url_index', $data);
	}


	public function update_short_url($random_code, $actual_url) {
		$data = array(
			'url_code' 		=> $random_code,
			'created_date' 	=> date('Y-m-d')
			);
		$this->db->where('actual_url', $actual_url);
		return $this->db->update('url_index', $data);
	}
	

} // class ends