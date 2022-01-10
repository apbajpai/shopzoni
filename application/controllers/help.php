<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();		
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		//$this->load->library('email');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('seller_registration_model');
		$this->load->model('category_model');	
		$this->load->model('section_model');	
		$this->load->model('product_model');	
		$this->load->model('registration_model');	
		$this->load->library('facebook/fb','fb');
		$this->load->model('terms_conditions_model');			
		$this->load->model('help_model');
		$this->load->library('user_agent');
	}	
	
	public function index($page_no)
	{
		$this->page($page_no);
	}	
		

	public function page($param)
	{		
		
	}	
	
	
	
	public function contactus()
	{	
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header1', $data);			
			$this->load->view('contact_us', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	public function savecontactus(){		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');			
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]+$/]|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		
		
		if($this->form_validation->run() == FALSE){			
			$data = array(
							'name' => form_error('name'),							
							'email' => form_error('email'),
							'phone' => form_error('phone'),
							'message' => form_error('message'),							
							);
			$this->session->set_userdata($data);  
			redirect('/contactus');
		}
		else{
			$this->load->view('common/header1', $data);		
			$inserted_id	=	$this->help_model->save_contact_us_data();
			if($inserted_id){
				$data['success_msg']	=	'Data Submitted Successfully..!';
				$this->load->view('contact_us', $data);
			}	
			$this->load->view('common/footer');
		}
	}
	
	public function send_query(){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header1', $data);			
			$this->load->view('send_query', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	public function savesend_query(){	
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		
		
		if($this->form_validation->run() == FALSE){			
			$data = array(
							'message' => form_error('message'),							
							);
			$this->session->set_userdata($data);  
			redirect('/send_query');
		}
		else{
			$this->load->view('common/header1', $data);		
			$inserted_id	=	$this->help_model->save_send_query_data();
			if($inserted_id){
				$data['success_msg']	=	'Data Submitted Successfully..!';
				$this->load->view('send_query', $data);
			}	
			$this->load->view('common/footer');
		}
	}
	
	public function feedback(){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header1', $data);			
			$this->load->view('feedback', $data);
			$this->load->view('common/footer2');
		}else{
			redirect('/login');
		}
	}
	
	public function savefeedback(){	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('seller_code', 'Seller Code', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rating', 'Rating', 'trim|required|xss_clean');			
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		
		
		if($this->form_validation->run() == FALSE){			
			$data = array(
							'seller_code' => form_error('seller_code'),	
							'rating' => form_error('rating'),							
							'message' => form_error('message'),							
							);
			$this->session->set_userdata($data);  
			redirect('/feedback');
		}
		else{
			$this->load->view('common/header1', $data);		
			$inserted_id	=	$this->help_model->save_feedback_data();
			if($inserted_id){
				$data['success_msg']	=	'Data Submitted Successfully..!';				
			}else{
				$data['error_msg']	=	'Invalid Seller Code..!';
			}			
			$this->load->view('feedback', $data);
			$this->load->view('common/footer');
		}
	}
	
	public function faq(){
	
	}
	
	public function testimonials(){
	
	}
	
	public function message_seller(){
		if($this->session->userdata('user_id')!=""){
			$this->load->view('common/header', $data);			
			$this->load->view('message_seller', $data);
			$this->load->view('common/footer');
		}else{
			redirect('/login');
		}
	}
	
	public function savemessage_seller(){	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('seller_code', 'Vendor Code', 'trim|required|xss_clean');			
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		
		
		if($this->form_validation->run() == FALSE){					
			$data = array(
							'error_seller_code' => form_error('seller_code'),								
							'error_message' => form_error('message'),							
							);
			//$this->session->set_userdata($data1);  
			//redirect('/message_seller');
			$data['seller_code']  = $this->input->post('seller_code');
			$data['message']  = $this->input->post('message');
			
			$this->load->view('common/header', $data);			
			$this->load->view('message_seller', $data);
			$this->load->view('common/footer');
		}
		else{
			$this->load->view('common/header', $data);		
			$inserted_id	=	$this->help_model->save_message_seller_data();
			$seller_code = $this->input->post('seller_code');
			$seller_record = $this->seller_registration_model->GetRecordsBySellerCode($seller_code);
			
			if($inserted_id){
				$data['success_msg']	=	'Your Message has Sent Successfully to';				
				$data['seller_info']	=	'<br>'.$seller_record[0]->business_name;				
				$data['seller_info']	.=	'<br>'.$seller_record[0]->business_address;				
								
				$data['success']	=	1;				
			}else{
				$data['error_msg']	=	'Invalid Seller Code..!';
			}
			$this->load->view('message_seller', $data);
			$this->load->view('common/footer');
		}
	}
	
}
?>