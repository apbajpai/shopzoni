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
		$this->load->model('admin/delivery_location_model');
	  $this->check_isvalidated();
	}	
	
	public function index($page_no)
	{
		$page_no = $this->uri->segment(4);
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
		$param = $this->uri->segment(4);
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
		$data['delivery_location'] = $this->delivery_location_model->GetRecords();
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-time-slot', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$data['validation_errors'] = "";
		$this->session->set_userdata($data);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('delivery_location_id', 'Delivery Location', 'trim|required|xss_clean');
		$this->form_validation->set_rules('totime', 'totime', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fromtime', 'fromtime', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('order_ending_time', 'Order Ending Time', 'trim|required|xss_clean');
		$this->form_validation->set_rules('maximum_no_of_order', 'Maximum Number Of Order', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){					
			$data['validation_errors'] = validation_errors();
			$this->session->set_userdata($data); 
			$data = array(
				'delivery_location_id'			=>	$this->input->post('delivery_location_id'),
				'totime'	=>	$this->input->post('totime'),
				'fromtime'		=>	$this->input->post('fromtime'),
				'order_ending_time'		=>	$this->input->post('order_ending_time'),
				'maximum_no_of_order'			=>	$this->input->post('maximum_no_of_order'),				
				'maximum_no_of_order'			=>	$this->input->post('maximum_no_of_order'),				
				'id'			=>	$this->input->post('id'),				
				);
			$this->session->set_userdata($data); 

			if($this->input->post('id')>0)
				redirect('admin/time_slot/addedit/'.$this->input->post('id'));
			else
				redirect('admin/time_slot/addedit');
		}
		else{
			$total = $this->time_slot_model->GetTotalRecordSellerWise();
			if($total<24){
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
			}else{
				$data['error_msg'] = "Delivery Location not more than 20";
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');		
				$this->load->view('admin/add-edit-time-slot', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>