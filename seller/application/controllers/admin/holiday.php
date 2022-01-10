<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Holiday extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/holiday_model');
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
		$data['heading']='Holiday'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['totime'] 		= $this->input->post('totime');
		$search['fromtime'] 		= $this->input->post('fromtime');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=10;
		$total_record	= $this->holiday_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/holiday/index';
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
		
		$array_records = $this->holiday_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/holiday', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		$param = $this->uri->segment(4); 
		if(is_numeric($param)){
			$data['heading']='Edit Holiday'; 
		}else{
			$data['heading']='Add Holiday'; 
		}
		
		$array_records = $this->holiday_model->GetRecordBySellerId($param);	
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-holiday', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('seller_id', 'seller_id', 'trim|required|xss_clean');
				
		if($this->form_validation->run() == FALSE){
			redirect('admin/holiday/addedit');
		}
		else{				
			$save = $this->holiday_model->save_holiday($image);
			if($save){
				redirect('admin/holiday/index');
			}else{
					
			}			
		}	
	}	
}
?>