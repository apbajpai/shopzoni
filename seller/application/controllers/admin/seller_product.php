<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller_Product extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/seller_product_model');
		$this->load->model('admin/category_model');
		$this->load->model('admin/brand_model');
		$this->load->model('admin/section_model');
		$this->load->model('admin/seller_Registration_model');
		$this->load->model('admin/offer_model');
		$this->load->model('admin/admin_model');
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
		$data['heading']='Seller Product'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['seller_id'] 	= $this->input->post('seller_id'); 
		$search['name'] 		= $this->input->post('name');
		$search['type'] 		= $this->input->post('type');
		$search['brand_id'] 		= $this->input->post('brand_id');
		$data['search'] = $search;
		//serach query ends//
		
		$sellers = $this->seller_Registration_model->GetRecordsControl();
		$data['sellers'] = $sellers;
		
		$per_page=100;
		$total_record	= $this->seller_product_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/product/index';
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
		
		$array_records = $this->seller_product_model->GetRecords($offset,$per_page); 
		
		$brand_record = $this->brand_model->GetRecordsControl();
		$data['brand_record'] = $brand_record;
		
		$data['records'] = $array_records; 
		$this->load->view('admin/seller_product', $data);
		$this->load->view('admin/footer');
	}
	
	public function sell_yours(){
		//echo $product_id =$this->input->post('product_id');
		echo $this->brand_product_model->sell_yours();
	}
	
}
?>