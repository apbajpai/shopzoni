<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_History extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/email_history_model');
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
		
		$data['heading']='Email History'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		//search query start//
		$search['to'] = $this->input->post('to');
		$data['to'] = $search;
		$search['from'] = $this->input->post('from');
		$data['from'] = $search;
		//serach query ends//
		
		$per_page=50;
		$total_record	= $this->email_history_model->GetTotalRecord();		
		$config['base_url'] = site_url().'admin/email_history/index';
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
		
		$array_records = $this->email_history_model->GetRecords($offset,$per_page);
		
		$data['records'] = $array_records; 
		$this->load->view('admin/email_history', $data);
		$this->load->view('admin/footer');
	}
	
	public function view_message($id){
		$id = $this->uri->segment(4);
		$data['heading']='Email History'; 
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');
		
		$record = $this->email_history_model->GetRecordById($id);
		
		$data['records'] = $record; 
		$this->load->view('admin/view_email_history', $data);
		$this->load->view('admin/footer');
		
	}
	
}
?>