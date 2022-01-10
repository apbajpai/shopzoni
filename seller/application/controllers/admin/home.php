<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __Construct()
	{
		parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');	
	   	$this->check_isvalidated();
	}	
	public function index()
	{		
		$this->viewForm();
	}	
	
	function check_isvalidated(){
        if(! $this->session->userdata('validated')){
		     redirect('admin/login');
        }
    }
	
	function viewForm()
	{   	
		$this->load->view('admin/header');		
		$this->load->view('admin/sidebar');					
		$this->load->view('admin/home');
		$this->load->view('admin/footer');		
	}

	
}
