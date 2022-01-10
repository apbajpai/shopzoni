<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/report_model');		
		$this->load->model('admin/order_model');		
		$this->load->model('admin/brand_seller_model');		
		$this->load->model('admin/brand_model');		
		$this->load->model('admin/seller_Registration_model');		
		$this->load->model('admin/message_seller_model');		
		$this->load->model('admin/product_model');		
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
		
	public function buyer($page_no)
	{
		$data['heading']='Buyer Report'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->report_model->GetTotalRecordBuyer();		
		$config['base_url'] = site_url().'admin/report/buyer';
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
		
		$array_records = $this->report_model->GetRecordsBuyer($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/report', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function seller($page_no)
	{
		$data['heading']='Seller Report'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$search['email'] 	= $this->input->post('email'); 
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->report_model->GetTotalRecordSeller();		
		$config['base_url'] = site_url().'admin/report/seller';
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
		
		$array_records = $this->report_model->GetRecordsSeller($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/seller_report', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	public function shop_visitor($page_no)
	{
		$data['heading']='Shop Visitor Report'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$search['seller_code'] 	= $this->input->post('seller_code'); 
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->report_model->GetTotalRecordShopVisitor();		
		$config['base_url'] = site_url().'admin/report/shop_visitor';
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
		
		$array_records = $this->report_model->GetRecordsShopVisitor($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/shop_visitor_report', $data);
		$this->load->view('admin/footer');
	}
	
		
	public function export_shop_visitor($page_no)
	{
		
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$search['seller_code'] 	= $this->input->post('seller_code'); 
		$data['search'] = $search;
		//serach query ends//		
		
		$array_records = $this->report_model->GetRecordsShopVisitor(); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/export_shop_visitor', $data);
	
	}
	
	
	public function order($page_no)
	{
		$data['heading']='Order Details'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$search['order_id'] 	= $this->input->post('order_id'); 
		$search['seller_email'] 	= $this->input->post('seller_email'); 
		$search['buyer_email'] 	= $this->input->post('buyer_email'); 
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->report_model->GetTotalRecordOrder();		
		$config['base_url'] = site_url().'admin/report/order';
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
		
		$array_records = $this->report_model->GetRecordsOrder($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/order_report', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function export_order($page_no)
	{
		$data['heading']='Order Details'; 
		//$this->load->view('admin/header', $data);		
		//$this->load->view('admin/sidebar');
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$search['order_id'] 	= $this->input->post('order_id'); 
		$search['seller_email'] 	= $this->input->post('seller_email'); 
		$search['buyer_email'] 	= $this->input->post('buyer_email'); 
		$data['search'] = $search;
		//serach query ends//
				
		$array_records = $this->report_model->GetRecordsOrder(); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/export_order_report', $data);
		//$this->load->view('admin/footer');
	}
	
	
	public function view_order($order_id){			
		$data['heading']='View Order Report'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		$array_records = $this->report_model->GetRecordsByOrderId($order_id);
		$data['records'] = $array_records; 
		$this->load->view('admin/view_order_report', $data);
		$this->load->view('admin/footer');
	}
	
	public function brand_seller_report(){
		
		$data['heading']='Seller Details'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//		
		$search['brand_id'] 		= $this->input->post('brand_id');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=100;
		$total_record	= $this->brand_seller_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/product/index';
		$config['total_rows'] = $total_record;
		$config['per_page'] = $per_page;
		$config["uri_segment"] = 5;
		
		$config['cur_tag_open'] = '<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		
		if($page_no=='')
			$limit=0;
		else
			$limit=$config["per_page"]*($page_no-1);
			
		$offset = ($limit) ? $limit : 0;
		
		$array_records = $this->brand_seller_model->GetRecords($offset,$per_page); 
		
		$brand_record = $this->brand_model->GetRecordsControl();
		$data['brand_record'] = $brand_record;
		
		$data['records'] = $array_records; 
		$this->load->view('admin/brand_seller_report', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function product($page_no)
	{
		$data['heading']='Product Details'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//		
		$search['model_no'] 	= $this->input->post('model_no'); 
		$data['search'] = $search;
		//serach query ends//
		
		if($search['model_no'])
		$array_records = $this->product_model->GetRecordByModelNo(); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/product_report', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function buyer_request($page_no)
	{
		$data['heading']='Buyer Request'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['from_date'] 	= $this->input->post('from_date');
		$search['to_date'] 	= $this->input->post('to_date'); 
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->report_model->GetTotalRecordBuyerRequest();		
		$config['base_url'] = site_url().'admin/report/buyer_request';
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
		
		$array_records = $this->report_model->GetRecordsBuyerRequest($offset,$per_page); 
		$data['records'] = $array_records; 
		$this->load->view('admin/buyer_request_report', $data);
		$this->load->view('admin/footer');
	}
	
	public function message_seller($page_no)
	{
		$data['heading']='Buyer Message'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['email'] 		= $this->input->post('email');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->message_seller_model->GetTotalRecordReport();		
		$config['base_url'] = site_url().'admin/report/message_seller/index';
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
		
		$array_records = $this->message_seller_model->GetRecordsReport($offset,$per_page);		
		$data['records'] = $array_records; 
		$this->load->view('admin/message_seller_report', $data);
		$this->load->view('admin/footer');
	}
	
	
}
?>