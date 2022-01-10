<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_Details extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));		
		$this->load->model('admin/brand_details_model');		
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
		$data['heading']='Brand Details'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		
		//search query start//
		//$search['brand_id'] 		= $this->input->post('brand_id');
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
			
		$per_page=100;
		$total_record	= $this->brand_details_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/brand_details/index';
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
		
		$array_records = $this->brand_details_model->GetRecords($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/brand_details', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{
		$param = $this->uri->segment(4);	
		if(is_numeric($param)){
			$data['heading']='Edit Brand Details'; 
			$id = $param;
		}else{
			$data['heading']='Add Brand Details'; 
		}
		
		if($id){
			$array_records = $this->brand_details_model->GetRecordById($id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records;
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-brand_details', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');		
		if($this->form_validation->run() == FALSE){
			redirect('admin/brand_details/addedit');
		}else{
			if($_FILES['image']['name']!= ""){
				$imageFileType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
				$image=$this->brand_details_model->upload1('image',$imageFileType);	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->brand_details_model->save_brand_details_data($image);
			
			if($save){				
				redirect('admin/brand_details');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');
				$data['description'] = $this->input->post('description');
				$this->load->view('admin/add-edit-brand_details', $data);
				$this->load->view('admin/footer');			
			}
		}	
	}
}
?>