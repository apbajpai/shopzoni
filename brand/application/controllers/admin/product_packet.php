<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Packet extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/product_model');	
		$this->load->model('admin/product_packet_model');	
		$this->load->model('admin/admin_model');
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
		$data['heading']='Product Packet'; 
		//$this->load->view('admin/header', $data);		
		//$this->load->view('admin/sidebar');
		
		//search query start//
		//$search['brand_id'] 		= $this->input->post('brand_id');
		//$search['caption'] 		= $this->input->post('caption');
		//$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->product_packet_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/product_packet/index';
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
		
		$array_records = $this->product_packet_model->GetRecords($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar_packet');
		$this->load->view('admin/product_packet', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param,$param2)
	{		
		$param = $this->uri->segment(4);
		$param2 = $this->uri->segment(5);
		$this->session->set_userdata('product_id', $param);		
		
		if(is_numeric($param2)){
			$data['heading']='Edit product Packet'; 			
			$id = $param2;
		}else{
			$data['heading']='Add product Packet'; 
		}		
		$product_id = $param;
		
		if($product_id){
			$product_records = $this->product_model->GetRecordById($product_id);
			$array_records = $this->product_packet_model->GetRecordById($id);
		}else{
			$array_records=array();
			$product_records=array();
		}
		
		$data['row'] = $array_records;		
		$data['product_records'] = $product_records;	
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar_packet');		
		$this->load->view('admin/add-edit-product-packet', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('weight', 'weight', 'trim|required|xss_clean');		
		if($this->form_validation->run() == FALSE){
			redirect('admin/product_packet/addedit');
		}
		else{
			
			
			$save = $this->product_packet_model->save_product_packet_data();
			
			if($save){				
				redirect('admin/product_packet');
			}else{
				$data['mrp'] = $this->input->post('mrp');
				$data['product_id'] = $this->input->post('product_id');
				$data['weight'] = $this->input->post('weight');
				$data['unit'] = $this->input->post('unit');
				$data['status'] = $this->input->post('status');
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar_packet');		
				$this->load->view('admin/add-edit-product-packet', $data);
				$this->load->view('admin/footer');
			}			
		}	
	}	
	
}
?>