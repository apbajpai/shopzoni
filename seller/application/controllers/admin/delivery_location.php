<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_Location extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/delivery_location_model');
		$this->load->model('admin/seller_registration_model');
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
		$data['heading']='Delivery Location'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['delivery_location'] 		= $this->input->post('delivery_location');		
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=20;
		$total_record	= $this->delivery_location_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/delivery_location/index';
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
		
		$array_records = $this->delivery_location_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/delivery_location', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Delivery Location'; 
		}else{
			$data['heading']='Add Delivery Location'; 
		}
		
		if($param){
			$array_records = $this->delivery_location_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		
		$state_records = $this->seller_registration_model->GetStateRecord();
		$data['state_records'] = $state_records;
		
		$id = $param;
		if($id){
			$city_records = $this->seller_registration_model->GetStateCity($array_records->state_id);
			$pincode_records = $this->seller_registration_model->GetPincodeByCity($array_records->city_id);
		}else{
			$city_records = $this->seller_registration_model->GetCityRecord();
			$pincode_records = $this->seller_registration_model->GetPincodeRecord();
		}
		$data['city_records'] = $city_records;		
		$data['pincode_records'] = $pincode_records;
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-delivery-location', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('delivery_location', 'Delivery Location', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('shipping_charge', 'Shipping Charge', 'trim|required|xss_clean');		
		
		if($this->form_validation->run() == FALSE){			
			redirect('admin/delivery_location/addedit');
		}
		else{
			$total = $this->delivery_location_model->GetTotalRecordSellerWise();
			$id = $this->input->post('id');
			if($total<20 || $id!=""){
				if($_FILES['image']['name']!= ""){
					$image=$this->delivery_location_model->upload1('image');	
				}else{
					$image=$this->input->post('image_old');
				}
				
				$save = $this->delivery_location_model->save_delivery_location_data($image);
				
				if($save){
					redirect('admin/delivery_location/index');
				}else{
					
				}
			}else{
				$data['error_msg'] = "Delivery Location not more than 20";
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');		
				$this->load->view('admin/add-edit-delivery-location', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>