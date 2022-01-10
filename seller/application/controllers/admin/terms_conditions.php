<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_Conditions extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/terms_conditions_model');
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
		
	/*public function page($page_no)
	{
		$data['heading']='Terms Conditions'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->terms_conditions_model->GetTotalRecord();		
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
		
		$array_records = $this->terms_conditions_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/brand', $data);
		$this->load->view('admin/footer');
	} */
	
	
	public function page($param)
	{
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Terms Conditions'; 
		}else{
			$data['heading']='Add Terms Conditions'; 
		}
		
		if($param){
			$array_records = $this->terms_conditions_model->GetRecordById($param);
		}else{
			$array_records=$this->terms_conditions_model->GetRecordBySellerId();
		}
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add_edit_terms_conditions', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/terms_conditions');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->terms_conditions_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			$save = $this->terms_conditions_model->save_terms_conditions_data($image);
			
			if($save){
				//redirect('admin/terms_conditions');
				if(is_numeric($param)){
					$data['heading']='Edit Terms Conditions'; 
				}else{
					$data['heading']='Add Terms Conditions'; 
				}
				
				if($param){
					$array_records = $this->terms_conditions_model->GetRecordById($param);
				}else{
					$array_records=$this->terms_conditions_model->GetRecordBySellerId();
				}
				
				$data['row'] = $array_records; 	
				$data['sucess_msg']= "Updated Successfully..!";
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');		
				$this->load->view('admin/add_edit_terms_conditions', $data);
				$this->load->view('admin/footer');
			}
		}	
	}	
	
}
?>