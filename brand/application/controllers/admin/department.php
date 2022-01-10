<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
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
		$data['heading']='Department'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->department_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/department/index';
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
		
		$array_records = $this->department_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/department', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Department'; 
		}else{
			$data['heading']='Add Department'; 
		}
		
		if($param){
			$array_records = $this->department_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-department', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/department/addedit');
		}
		else{
			/*if($_FILES['image']['name']!= ""){
				$image=$this->department_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			} */
			
			$save = $this->department_model->save_department_data($image);
			
			if($save){
				redirect('admin/department');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');	
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['validation_msg'] = "Department Name Already Exist"; 
				$this->load->view('admin/add-edit-department', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>