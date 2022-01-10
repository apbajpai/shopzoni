<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Category extends MY_Controller {
	
	public function __Construct()
	{
	   	parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/product_category_model');
		$this->load->model('admin/section_model');
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
		$data['heading']='Product Sub Category'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');	
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=10;
		$total_record	= $this->product_category_model->GetSubTotalRecord();
		$config['base_url'] = site_url().'admin/product_category/index';
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
		
		$array_records = $this->product_category_model->GetSubRecords($offset,$per_page);
		
		/*echo "<pre>";
		print_r($array_records);
		echo "</pre>"; */
		
		$data['records'] = $array_records; 
		$this->load->view('admin/product_category', $data);
		$this->load->view('admin/footer');
	}
	
	public function main($page_no)
	{
		$page_no = $this->uri->segment(4);
		$data['heading']='Category';
		$data['type'] = 'main';
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		
		$total_record	= $this->product_category_model->GetTotalRecord(); 		
		$config['base_url'] = site_url().'admin/product_category/main/';
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
		
		$array_records = $this->product_category_model->GetParentRecords($offset,$per_page);
				
		$data['records'] = $array_records; 
		$this->load->view('admin/product_category', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Sub Category'; 
			$category_id = $param;
		}else{
			$data['heading']='Add Sub Category'; 
		}
		
		if($category_id){
			$array_records = $this->product_category_model->GetRecordById($category_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$section = $this->section_model->GetRecordsControl();
		$data['section'] = $section;
		
		$category = $this->product_category_model->GetParentRecordsControl();
		$data['category'] = $category; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-product-category', $data);
		$this->load->view('admin/footer');
	}
	
	public function addeditmain($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Category'; 
			$category_id = $param;
		}else{
			$data['heading']='Add Category'; 
		}
		
		if($category_id){
			$array_records = $this->product_category_model->GetRecordById($category_id);
		}else{
			$array_records=array();
		}
		
		$data['type'] = 'main';
		$data['row'] = $array_records; 
		
		$category = $this->product_category_model->GetParentRecordsControl();
		$data['category'] = $category; 
		
		$section = $this->section_model->GetRecordsControl();
		$data['section'] = $section; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-product-category', $data);
		$this->load->view('admin/footer');
	}
	
	function uniqueCategory()
	{
		$name=$this->input->post('name');
		$parent_id=$this->input->post('parent_id');
		$id=$this->input->post('id');
		echo $this->product_category_model->uniqueCategory($name, $parent_id, $id);
	}
	
	function categoryDropdown($section_id)
	{
		$section_id = $this->uri->segment(4); 
		if($data['category'] = $this->product_category_model->GetSectionCategory($section_id))
		$this->load->view('admin/categoryDropdown', $data);
	}
	
	function subCatDropdown($parent_id,$view='',$subcat_id)
	{
		$parent_id = $this->uri->segment(4);
		$view = $this->uri->segment(5);
		$subcat_id = $this->uri->segment(6);
		$data['view'] =$view;
		$data['subcat_id'] =$subcat_id;
		$data['category'] = $this->product_category_model->GetChildRecordsControl($parent_id);
		$this->load->view('admin/subCatDropdown', $data);
	}
	
	function deleteCategory($id){
		$id = $this->uri->segment(4);
		$this->product_category_model->deleteCategory($id);
	}
	
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('section_id', 'section_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		if($this->session->userdata('seller_id')!=0 && $this->session->userdata('seller_id')>0){
		$this->form_validation->set_rules('category_id', 'category_id', 'trim|required|xss_clean');
		}
		$parent_id = $this->input->post('category_id');
		
		if($this->form_validation->run() == FALSE){
			if($this->session->userdata('seller_id')!=0 && $this->session->userdata('seller_id')>0)
			redirect('admin/product_category/addedit');
			else
			redirect('admin/product_category/addeditmain');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->product_category_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			 $save = $this->product_category_model->save_product_category_data($image);
			
			if($save){
				if($parent_id == 0)
				redirect('admin/product_category/main');
				else
				redirect('admin/product_category/index');
			}else{
				
			}
		}	
	}	
}
?>