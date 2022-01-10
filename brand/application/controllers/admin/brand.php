<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/brand_model');
		$this->load->model('admin/department_model');		
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
		$data['heading']='Brand'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->brand_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/brand/index';
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
		
		$array_records = $this->brand_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/brand', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4); 
		if(is_numeric($param)){
			$data['heading']='Edit Brand'; 
		}else{
			$data['heading']='Add Brand'; 
		}
		
		if($param){
			$array_records = $this->brand_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$department_records = $this->department_model->GetDepartmentMapRecord($param);
		$data['department_records'] = $department_records;
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-brand', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');			
		if($_FILES['image']['name']== "" && $this->input->post('image_old')==""){
			$this->form_validation->set_rules('image', 'Logo', 'trim|required|xss_clean');
		}
		$this->form_validation->set_rules('customer_care_number', 'Customer Care Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_feedback', 'Email Feedback', 'trim|required|xss_clean');		
		
		if($this->form_validation->run() == FALSE){
			$department_records = $this->department_model->GetDepartmentMapRecord($param);
			$data['department_records'] = $department_records;
			$data = array(
				'name'					=>	$this->input->post('name'),
				'owner'					=>	$this->input->post('owner'),
				'contact_person'		=>	$this->input->post('contact_person'),
				'phone'					=>	$this->input->post('phone'),
				'mobile'				=>	$this->input->post('mobile'),
				'website'				=>	$this->input->post('website'),
				'email'					=>	$this->input->post('email'),
				'communication_address'	=>	$this->input->post('communication_address'),
				'registered_office'		=>	$this->input->post('registered_office'),
				'image'					=>	$this->input->post('image'),
				'customer_care_number'	=>	$this->input->post('customer_care_number'),
				'email_feedback'		=>	$this->input->post('email_feedback'),
				'status'				=>	$this->input->post('status'),
				);
				
			$department_records = $this->department_model->GetDepartmentMapRecord($param);
			$data['department_records'] = $department_records;	
			$this->load->view('admin/header', $data);		
			$this->load->view('admin/sidebar');		
			$this->load->view('admin/add-edit-brand', $data);
			$this->load->view('admin/footer');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->brand_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->brand_model->save_brand_data($image);
			
			if($save){
				redirect('admin/brand');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');	
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['validation_msg'] = "Brand Name Already Exist"; 
				$this->load->view('admin/add-edit-brand', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>