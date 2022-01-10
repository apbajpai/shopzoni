<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_page_view extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');		
		$this->load->helper(array('form'));
		$this->load->model('admin/home_page_view_model');
	  $this->check_isvalidated();
	}	
	
	public function index($page_no)
	{
		$this->page($page_no);
	}	
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('admin/login');
        }
    }	
		
	public function page($page_no)
	{
		$data['heading']='Home Page View'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');	
		
		$array_records = $this->home_page_view_model->GetRecords();	
		
		$articles=array();
		
		foreach($array_records as $record){
			$articles[$record->id]=$this->home_page_view_model->GetArticleById($record->id);
		}		
		
		$data['articles'] = $articles; 
		$data['records'] = $array_records; 
		$this->load->view('admin/home_page_view', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{		
		if($param){
			$array_records = $this->home_page_view_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/home_page_view', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$save = $this->home_page_view_model->save_home_page_view_data($_POST); 
			
			if($save){
				$this->page();
			}else{
				
			}
			
	}
}
?>