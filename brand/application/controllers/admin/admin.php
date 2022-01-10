<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/admin_model');
		$this->load->model('admin/brand_model');
	  $this->check_isvalidated();
	}	
	
	public function index($page_no)
	{
		$page_no = $this->uri->segment(4);
		$this->page($page_no);
	}	
	
	private function check_isvalidated(){
        if(!$this->session->userdata('validated')){
          redirect('admin/login');
        }
				
    }	
		
	public function page($page_no)
	{
		$data['heading']='User'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->admin_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/admin/index';
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
		
		$array_records = $this->admin_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/admin', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4); 
		if(is_numeric($param)){
			$data['heading']='Edit Admin'; 
		}else{
			$data['heading']='Add Admin'; 
		}
		
		if($param){
			$array_records = $this->admin_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records;
		
		$brands = $this->brand_model->GetRecords();
		$data['brands'] = $brands;
		
		$roles = $this->role_model->GetRecords();
		$data['roles'] = $roles;
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-admin', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/admin/addedit');
		}
		else{
			
			$save = $this->admin_model->save_admin_data($image);
			if($save){
				redirect('admin/admin/index');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');		
				$data['msg'] = "Brand Email address Already Registered...!";
				
				$brands = $this->brand_model->GetRecords();
				$data['brands'] = $brands;
				
				$data['brand_id'] 	=	$this->input->post('brand_id');
				$data['name'] 		= $this->input->post('name');
				$data['email'] 		= $this->input->post('email');
				$data['password']   = $this->input->post('password');
				$data['role'] 		= $this->input->post('role');
				$data['indate'] 	= $this->input->post('indate');
				$data['status'] 	= $this->input->post('status');
				
				$this->load->view('admin/add-edit-admin', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>