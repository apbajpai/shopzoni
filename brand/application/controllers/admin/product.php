<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/product_model');		
		$this->load->model('admin/brand_model');
		$this->load->model('admin/section_model');
		$this->load->model('admin/category_model');
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
		$data['heading']='Product'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		//$search['brand_id'] 		= $this->input->post('brand_id');
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$data['brand'] = $this->brand_model->GetRecords();
		
		$per_page=100;
		$total_record	= $this->product_model->GetTotalRecord();		
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
		
		$array_records = $this->product_model->GetRecords($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/product', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit product'; 
			$product_id = $param;
		}else{
			$data['heading']='Add product'; 
		}
		
		if($product_id){
			$array_records = $this->product_model->GetRecordById($product_id);
		}else{
			$array_records=array();
		}
		
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
		
		$sections = $this->section_model->GetRecordsControl();
		$data['sections'] = $sections;
				
		$brands = $this->brand_model->GetRecordsControl();
		$data['brands'] = $brands;
		
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-product', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Product Name', 'trim|required|xss_clean');		
		if($this->form_validation->run() == FALSE){
			redirect('admin/product/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$imageFileType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
				$image=$this->product_model->upload1('image',$imageFileType);	
			}else{
				$image=$this->input->post('image_old');
			}
			$brand_id = $this->session->userdata('brand_id');
			if($brand_id!=""){
			$save = $this->product_model->save_product_data($image);
			
			if($save){				
				redirect('admin/product');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');
				
				$sections = $this->section_model->GetRecordsControl();
				$data['sections'] = $sections;
						
				$brands = $this->brand_model->GetRecordsControl();
				$data['brands'] = $brands;
				
				$category = $this->category_model->GetParentRecordsControl();		
				$data['category'] = $category;
				
				$sub_category = $this->category_model->GetChildRecordsControlNew();
				$data['sub_category'] = $sub_category;
				
				$data['product_name'] = $this->input->post('product_name');
				$data['model_no'] = $this->input->post('model_no');
				$data['section_id'] = $this->input->post('section_id');
				$data['category_id'] = $this->input->post('category_id');
				$data['sub_category_id'] = $this->input->post('sub_category_id');
				$data['manufacturer'] = $this->input->post('manufacturer');
				$data['color'] = $this->input->post('color');
				$data['short_description'] = $this->input->post('short_description');
				$data['description'] = $this->input->post('description');
				$data['unit'] = $this->input->post('unit');
				$data['weight'] = $this->input->post('weight');
				$data['size'] = $this->input->post('size');
				$data['tax_category'] = $this->input->post('tax_category');
				$data['mrp'] = $this->input->post('mrp');
				$data['status'] = $this->input->post('status');
				
				$data['validation_msg'] = "Model Number Already Exist"; 
				$this->load->view('admin/add-edit-product', $data);
				$this->load->view('admin/footer');
			}
			}else{
				redirect('admin/logout');
			}
		}	
	}
	
	public function update_price(){		
		$save = $this->product_model->updateProductPrice();
		if($save)
			redirect('admin/product');
	}
	
}
?>