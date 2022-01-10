<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minimum_Order extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/minimum_order_model');
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
		$data['heading']='Minimum Order'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');	
		
		$per_page=10;
		$total_record	= $this->minimum_order_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/minimum_order/index';
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
		
		$array_records = $this->minimum_order_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records;		
		$this->load->view('admin/minimum_order', $data);
		$this->load->view('admin/footer');
	}
	
	public function addedit($param)
	{
		if(is_numeric($param)){
			$data['heading']='Edit Minimum Order'; 
		}else{
			$data['heading']='Add Brand'; 
		}
		
		if($param){
			$array_records = $this->minimum_order_model->GetRecordById($param);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-minimum-order', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('minimum_order_amount', 'minimum_order_amount', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
			redirect('admin/minimum_order/addedit');
		}
		else{
			if($_FILES['image']['name']!= ""){
				$image=$this->minimum_order_model->upload1('image');	
			}else{
				$image=$this->input->post('image_old');
			}
			
			$save = $this->minimum_order_model->save_minimum_order_data($image);
			
			if($save){
				redirect('admin/minimum_order/index');
			}else{
				
			}
		}	
	}	
}
?>