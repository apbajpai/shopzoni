<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand_Profile extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/brand_profile_model');
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
	
	public function addedit($param)
	{
		$param = $this->session->userdata('brand_id');
		if(is_numeric($param)){
			$data['heading']='View Brand Profile'; 
		}else{
			$data['heading']='Add Brand Profile'; 
		}
		
		if($param){
			$array_records = $this->brand_profile_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$department_records = $this->department_model->GetDepartmentMapRecord($param);
		$data['department_records'] = $department_records;
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-brand_profile', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/brand_profile/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->brand_profile_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->brand_profile_model->save_brand_profile_data($image);
			
			if($save){
				session_start();
				echo $_SESSION['sucess_msg'] = "Updated Sucessfully..!"; 
				redirect('admin/brand_profile/addedit');
			}else{
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');	
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');
				$data['validation_msg'] = "Brand Name Already Exist"; 
				$this->load->view('admin/add-edit-brand_profile', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
}
?>