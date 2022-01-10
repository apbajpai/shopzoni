<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time_Slot extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/time_slot_model');
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
		$data['heading']='Time Slot'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['totime'] 		= $this->input->post('totime');
		$search['fromtime'] 		= $this->input->post('fromtime');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=10;
		$total_record	= $this->time_slot_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/time_slot/index';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 4;
		
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		$array_records = $this->time_slot_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/time_slot', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		if(is_numeric($param)){
			$data['heading']='Edit Time Slot'; 
		}else{
			$data['heading']='Add Time Slot'; 
		}
		
		if($param){
			$array_records = $this->time_slot_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-time-slot', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('totime', 'totime', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fromtime', 'fromtime', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/time_slot/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->time_slot_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->time_slot_model->save_time_slot_data($image);
			
			if($save){
				redirect('admin/time_slot/index');
			}else{
				
			}
		}	
	}	
}
?>