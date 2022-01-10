<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller{
	
	public function __Construct() {
		parent::__Construct();
		$this->load->library('session');		
		$this->load->helper('url');
		$this->load->library('user_agent');
		//$this->load->library('facebook/fb','fb');
		}
	function index() {
		$loginPath	=	base_url();
		//$this->session->sess_destroy();	
		$this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
		//$this->fb->facebookLogout();
		$_SESSION['reset'] = 0;
		//printpre($this->session);
		redirect("/");	
	}	
}
?>