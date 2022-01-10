<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Approval extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/product_approval_model');
		$this->load->model('admin/product_category_model');
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
		$data['heading']='Product'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		$search['category_id'] 	= $this->input->post('category_id'); 
		$search['sub_category_id'] 	= $this->input->post('sub_category_id');
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$category = $this->product_category_model->GetParentRecordsControl();
		$categorywdchild = array();
		foreach($category as $catg){
			$catg->child = $this->product_category_model->GetChildRecords($catg->id);
			$categorywdchild[] = $catg;
		}			
		
		$data['category'] = $categorywdchild;
		
		$per_page=100;
		$total_record	= $this->product_approval_model->GetTotalRecord();		
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
		
		$array_records = $this->product_approval_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/product', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{
			
		if(is_numeric($param)){
			$data['heading']='Edit product'; 
			$article_id = $param;
		}else{
			$data['heading']='Add product'; 
		}
		
		if($article_id){
			$array_records = $this->product_approval_model->GetRecordById($article_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		
		$category = $this->product_category_model->GetParentRecordsControl();		
		$data['category'] = $category;
		
		//category parent id
		$parent_id = $this->db->query("select parent_id from tbl_product_category where id = '".$array_records->category_id."'")->row()->parent_id;
		$data['parent_id'] = $parent_id;
		if($parent_id != 0){
			$sub_category = $this->product_category_model->GetChildRecordsControl($parent_id);
			$data['sub_category'] = $sub_category;
		}
		
		$brands = $this->brand_model->GetRecordsControl();
		$data['brands'] = $brands;
				
		$sections = $this->section_model->GetRecordsControl();
		$data['sections'] = $sections;
		
		$offers = $this->offer_model->GetRecordsControl();
		$data['offers'] = $offers;
		
		$sellers = $this->seller_Registration_model->GetRecordsControl();
		$data['sellers'] = $sellers;
		
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-product', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'product_name', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			redirect('admin/product/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->product_approval_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->product_approval_model->save_product_data($image);
			
			if($save){
				redirect('admin/product');
			}else{
				
			}
		}	
	}
	
}
?>