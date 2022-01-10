<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller{
	
	public function __Construct() {
		parent::__Construct();
		$this->load->library('session');
		$this->load->helper('url');
		}
	function index() {
		$loginPath	=	base_url();
		$this->session->sess_destroy();
		//printpre($this->session);
		redirect(base_url());	
	}	
}
