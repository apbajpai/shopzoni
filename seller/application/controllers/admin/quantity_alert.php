<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quantity_Alert extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/quantity_alert_model');
		$this->load->model('admin/product_model');
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
		$data['heading']='Quantity Alert List'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['category_id'] 	= $this->input->post('category_id'); 
		$search['brand_id'] 	= $this->input->post('brand_id');
		$search['sub_category_id'] 	= $this->input->post('sub_category_id');
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		//$category = $this->category_model->GetParentRecordsControl();
		$category = $this->category_model->GetSellerCategory();
		$categorywdchild = array();
		foreach($category as $catg){
			$catg->child = $this->category_model->GetChildRecordsControlNew($catg->id);
			$categorywdchild[] = $catg;
		}			
		
		$data['category'] = $categorywdchild;
		
		$brand = $this->quantity_alert_model->GetSellerBrand();
		$data['brand'] = $brand;
		
		$per_page=100;
		$total_record	= $this->quantity_alert_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/quantity_alert/index';
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
		
		$array_records = $this->quantity_alert_model->GetRecords($offset,$per_page); 
		
		$data['per_page'] = $per_page;
		$data['records'] = $array_records; 
		$this->load->view('admin/quantity_alert', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{	
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Quantity Alert'; 
			$id = $param;
		}else{
			$data['heading']='Add Quantity Alert'; 
		}
		
		if($id){
			$array_records = $this->quantity_alert_model->GetRecordById($id);
		}else{
			$array_records=array();
		}
		$seller_id = $this->session->userdata('seller_id'); 
		$product_id = $array_records->product_id;
		if($seller_id!='')
		$data['packet_records'] = $this->product_model->getPacketRecord($seller_id,$product_id);
		
		$data['row'] = $array_records; 
		
		
		$category = $this->category_model->GetParentRecordsControl();		
		$data['category'] = $category;
		
		//category parent id		
		$parent_id = $this->db->query("select parent_id from tbl_category where id = '".$array_records->category_id."'")->row()->parent_id;
		$data['parent_id'] = $parent_id;
		
		
		
		if($parent_id != 0){
			$sub_category = $this->category_model->GetChildRecordsControl($parent_id);
			$data['sub_category'] = $sub_category;
		}else{ 		
			$sub_category = $this->category_model->GetChildRecordsControlNew();
			$data['sub_category'] = $sub_category;
		}
		
		$associatedbrands = $this->brand_model->GetRecordsControl();
		$data['associatedbrands'] = $associatedbrands;
		
		if($array_records->sell_yours==1){
			$brands = $this->brand_model->GetAllRecordsControl();
		}else{
			$brands = $this->brand_model->GetRecordsControl();
		}
		$data['brands'] = $brands;
				
		$sections = $this->section_model->GetRecordsControl();
		$data['sections'] = $sections;
		
		$offers = $this->offer_model->GetRecordsControl();
		$data['offers'] = $offers;
		
		$sellers = $this->seller_Registration_model->GetRecordsControl();
		$data['sellers'] = $sellers;
		
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-quantity-alert', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$save = $this->quantity_alert_model->save_product_data1();				
		if($save){
			redirect('admin/quantity_alert');
		}else{
			
		}		
	}
	
	public function update_price(){		
		$save = $this->quantity_alert_model->updateProductPrice();
		if($save)
			redirect('admin/quantity_alert');
	}
	
}
?>