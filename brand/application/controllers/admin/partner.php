<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/partner_model');
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
		$data['heading']='Partner'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['city'] 		= $this->input->post('city');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->partner_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/partner/index';
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
		
		$array_records = $this->partner_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/partner', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Partner'; 
		}else{
			$data['heading']='Add Partner'; 
		}
		
		if($param){
			$array_records = $this->partner_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
				
		$state_records = $this->partner_model->GetStateRecord();
		$data['state_records'] = $state_records;
		
		$id = $this->input->post('id');
		if($id){
			$city_records = $this->partner_model->GetStateCity($array_records->state_id);
			$pincode_records = $this->partner_model->GetPincodeByCity($array_records->city_id);
		}else{
			$city_records = $this->partner_model->GetCityRecord();
			$pincode_records = $this->partner_model->GetPincodeRecord();
		}
		$data['city_records'] = $city_records;		
		$data['pincode_records'] = $pincode_records;
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-partner', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/partner/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->partner_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->partner_model->save_partner_data($image);
			
			if($save){
				redirect('admin/partner');
			}
		}	
	}	
	
	function cityDropdown($state_id)
	{
		$state_id = $this->uri->segment(4); 
		if($data['city_records'] = $this->partner_model->GetStateCity($state_id))
		$this->load->view('admin/cityDropdown', $data);
	}
	
	function pincodeDropdown($city_id)
	{
		$city_id = $this->uri->segment(4);
		if($data['pincode_records'] = $this->partner_model->GetPincodeByCity($city_id))
		$this->load->view('admin/pincodeDropdown', $data);
	}
}
?>