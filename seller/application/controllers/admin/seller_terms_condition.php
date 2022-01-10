<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller_Terms_condition extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/seller_terms_conditions_model');
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
		$data['heading']="Seller's Terms Conditions"; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['seller_id'] 		= $this->input->post('seller_id');
		$data['search'] = $search;
		//serach query ends//
		
		$sellers = $this->seller_Registration_model->GetRecordsControl();
		$data['sellers'] = $sellers;
		
		$per_page=25;
		$data['per_page'] = $per_page;
		$total_record	= $this->seller_terms_conditions_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/seller_terms_condition/index';
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
		
		$array_records = $this->seller_terms_conditions_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/seller_terms_condition', $data);
		$this->load->view('admin/footer');
	} 
	
	
	/*public function page($param)
	{
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
	} */
	
}
?>