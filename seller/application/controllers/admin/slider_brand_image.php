<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_Brand_image extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/slider_brand_image_model');	
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
		$data['heading']='Brand Slider Image'; 
				
		//search query start//
		$search['caption'] 		= $this->input->post('caption');
		$data['search'] = $search;
		//serach query ends//
		
		
		$per_page=100;
		$total_record	= $this->slider_brand_image_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/slider_brand_image/index';
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
		
		$array_records = $this->slider_brand_image_model->GetRecords($offset,$per_page); 
		
		$data['records'] = $array_records; 
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/slider_brand_image', $data);
		$this->load->view('admin/footer');
	}

	public function addedit($param)
	{		
		if(is_numeric($param)){
			$data['heading']='Edit Brand Slider Image'; 			
		}else{
			$data['heading']='ADD Brand Slider Image'; 
		}		
		$id = $param;
		
		if($id){
			$array_records = $this->slider_brand_image_model->GetRecordById($id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records;		
						
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-slider_brand_image', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('caption', 'caption', 'trim|required|xss_clean');		
		if($this->form_validation->run() == FALSE){
			redirect('admin/slider_brand_image/addedit');
		}
		else{
			
			if($_FILES['image']['name']!= ""){
				$imageFileType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
				$image=$this->slider_brand_image_model->upload1('image',$imageFileType);	
			}else{
				$image=$this->input->post('image_old');
			}
			$save = $this->slider_brand_image_model->save_slider_brand_image_data($image);
			
			if($save){				
				redirect('admin/slider_brand_image');
			}else{
				$data['product_id'] = $this->input->post('product_id');
				$data['caption'] = $this->input->post('caption');
				$data['status'] = $this->input->post('status');
				$this->load->view('admin/header', $data);		
				$this->load->view('admin/sidebar');		
				$this->load->view('admin/add-edit-slider_brand_image', $data);
				$this->load->view('admin/footer');
			}			
		}	
	}	
	
}
?>