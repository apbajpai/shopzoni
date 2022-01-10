<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_Approval_Product extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/brand_approval_product_model');
		$this->load->model('admin/product_model');
		$this->load->model('admin/product_category_model');
		$this->load->model('admin/brand_model');
		$this->load->model('admin/section_model');
		$this->load->model('admin/offer_model');
		$this->load->model('admin/seller_Registration_model');
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
		$data['heading']='Brad Product'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['brand_id'] 	= $this->input->post('brand_id');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->brand_approval_product_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/brand_approval_product/index';
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
		
		$array_records = $this->brand_approval_product_model->GetRecords($offset,$per_page);		
		$data['records'] = $array_records; 
		
		$brands = $this->brand_model->GetAssociatedRecordsControl();
		$data['brands'] = $brands;
		
		$this->load->view('admin/brand_approval_product', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{		
		if(is_numeric($param)){
			$data['heading']='Edit Brand Product'; 
			$product_id = $param;
		}else{
			$data['heading']='Add Brand Product'; 
		}
		
		if($product_id){
			$array_records = $this->brand_approval_product_model->GetRecordById($product_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		
		$category = $this->product_category_model->GetParentRecordsControl();		
		$data['category'] = $category;
		
		//category parent id		
		$parent_id = $this->db->query("select parent_id from tbl_product_category where id = '".$array_records->category_id."'")->row()->parent_id;
		$data['parent_id'] = $parent_id;
		
		$seller_product_id = $array_records->seller_product_id;
		$product_record = $this->product_model->GetRecordById($seller_product_id);
		
		if($parent_id != 0){
			$sub_category = $this->product_category_model->GetChildRecordsControl1($parent_id,$product_record->seller_id);
			$data['sub_category'] = $sub_category;
		}else{ 		
			$sub_category = $this->product_category_model->GetChildRecordsControlNew1($product_record->seller_id);
			$data['sub_category'] = $sub_category;
		}
		
		$associatedbrands = $this->brand_model->GetAssociatedRecordsControl();
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
		
		$data['selected_brand_id'] = $this->input->post('brand_id');
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-brand_approval_product', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|xss_clean');		
		if($this->form_validation->run() == FALSE){
			redirect('admin/brand_product/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$imageFileType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
				$image=$this->brand_approval_product_model->upload1('image',$imageFileType);	
			}else{
				$image=$this->input->post('image_old');
			}
			$seller_id = $this->session->userdata('seller_id');
			if($seller_id!=""){
				$save = $this->brand_approval_product_model->save_brand_product_data($image);
				
				if($save){				
					redirect('admin/brand_approval_product');
				}else{
					
				}
			}else{
				redirect('admin/logout');
			}
		}	
	}
	
}
?>