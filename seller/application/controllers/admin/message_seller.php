<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_Seller extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/message_seller_model');
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
		$data['heading']='Buyer Message'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['name'] 		= $this->input->post('name');
		$search['email'] 		= $this->input->post('email');
		$data['search'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->message_seller_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/message_seller/index';
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
		
		$array_records = $this->message_seller_model->GetRecords($offset,$per_page);		
		$data['records'] = $array_records; 
		$this->load->view('admin/message_seller', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function view($id){
		$id = $this->uri->segment(4); 
		$this->message_seller_model->changeViewStatus($id);
		$data['heading']='Buyer Message';
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		$array_records = $this->message_seller_model->GetRecordsById($id);
		$data['records'] = $array_records; 
		$this->load->view('admin/view_message_seller', $data);
		$this->load->view('admin/footer');
	}
	
}
?>