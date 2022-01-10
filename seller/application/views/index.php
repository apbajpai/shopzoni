<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
	
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
	}	
	
	public function index($page_no)
	{
		if($this->session->userdata['name'] !=""){
			redirect(base_url()."admin/home");
		}else{
			$this->addedit($page_no);
		}
	}	
		

	public function addedit($param)
	{		
		$data['heading']='Seller Registration'; 		
			/*	function sendmail()
				{
					$this->load->library('email'); // load email library
					$this->email->from('devendra4it@gmail.com', 'Devendra Kumar');
					$this->email->to('devendra4net@gmail.com');
					$this->email->cc('yaminibhardwaj23@gmail.com'); 
					$this->email->subject('Your Subject');
					$this->email->message('Your Message');
					$this->email->attach('/path/to/file1.png'); // attach file
					$this->email->attach('/path/to/file2.pdf');
					if ($this->email->send())
						echo "Mail Sent!";
					else
						echo "There is error in sending mail!";
				}
				exit; */		
		//$this->load->view('common/header', $data);
		$this->load->view('common/seller_header', $data);
		$this->load->view('reg_step1', $data);		
		//$this->load->view('common/footer');
	}
	
	public function register($param)
	{
		$this->load->view('common/seller_header', $data);
		$state_records = $this->seller_registration_model->GetStateRecord();
		$data['state_records'] = $state_records;
		
		$id = $param;
		if($id){
			$city_records = $this->seller_registration_model->GetStateCity($array_records->state_id);
			$pincode_records = $this->seller_registration_model->GetPincodeByCity($array_records->city_id);
		}else{
			$city_records = $this->seller_registration_model->GetCityRecord();
			$pincode_records = $this->seller_registration_model->GetPincodeRecord();
		}
		$data['city_records'] = $city_records;		
		$data['pincode_records'] = $pincode_records;		
		$this->load->view('registration_step1', $data);
		$this->load->view('common/footer');
	}
	
	public function save()
	{	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('display_name', 'display_name', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			redirect('addedit');
		}
		else{
			if($_FILES['identity_proof']['name']!= ""){
				$identity_proof=$this->seller_registration_model->upload1('identity_proof');	
			}else{
				$identity_proof=$this->input->post('identity_proof_old');
			}
			
			if($_FILES['address_proof']['name']!= ""){
				$address_proof=$this->seller_registration_model->upload1('address_proof');	
			}else{
				$address_proof=$this->input->post('address_proof_old');
			}
			
			if($_FILES['gst_proof']['name']!= ""){
				$gst_proof=$this->seller_registration_model->upload1('gst_proof');	
			}else{
				$gst_proof=$this->input->post('gst_proof_old');
			}
			
			if($_FILES['cancelled_cheque']['name']!= ""){
				$cancelled_cheque=$this->seller_registration_model->upload1('cancelled_cheque');	
			}else{
				$cancelled_cheque=$this->input->post('cancelled_cheque_old');
			}
						
			$display_name = $this->input->post('display_name');
			$passkey_array = explode($display_name);
			$password = $passkey_array[0].rand(1000,9999);
			
			$insertid = $this->seller_registration_model->save_seller_registration_data($identity_proof,$address_proof,$gst_proof,$cancelled_cheque);
			
			if($insertid !=''){	
				$data['email_id'] = $this->input->post('email_id');
				$data['insertid'] = $insertid;
				$this->load->view('mail_template', $data);		
				redirect('sucess/'.$insertid);
			}else{
				redirect('error');
			}
		}	
	}	
	
	public function sucess($insertid){
		$seller_record  =  $this->seller_registration_model->GetRecordById($insertid);
		$data['seller_record'] = $seller_record;
		$data['msg'] = "Seller Registered sucessfully...!";
		$this->load->view('common/seller_header', $data);
		$this->load->view('registration_step2', $data);
		$this->load->view('common/footer');
	}
	
	public function activate_account($id){
		$this->seller_registration_model->activateAccount($id);
		$seller_record  =  $this->seller_registration_model->GetRecordById($id);
		$data['seller_record'] = $seller_record;
		$this->load->view('common/seller_header', $data);
		$this->load->view('registration_step3', $data);
		$this->load->view('common/footer');		
	}
	
	public function seller_login(){		
		$seller_record = $this->seller_registration_model->checkSellerLogin();	
		if(isset($seller_record) && !empty($seller_record)){
			$data['seller_record'] = $seller_record;
			//$this->load->view('common/seller_header', $data);
			//$this->load->view('registration_step3', $data);
			//$this->load->view('common/footer');	
			redirect(base_url()."admin/home");
		}else{
			$data['error_msg']='Invalid User Name or Password....!';
			/*$this->load->view('common/seller_header', $data);
			$this->load->view('seller', $data);
			$this->load->view('common/footer'); */
			
			
			$this->load->view('common/seller_header', $data);
			$this->load->view('reg_step1', $data);
			$this->load->view('common/footer');
		}
	}
	
	public function send_email_verification_link($id){
		$seller_record  =  $this->seller_registration_model->GetRecordById($id);
		$data['email_id'] = $seller_record->email_id;
		$data['insertid'] = $id;
		$this->load->view('mail_template', $data);
		$this->load->view('common/seller_header', $data);
		$this->load->view('mail_confirmation', $data);
		$this->load->view('common/footer');
	}
	
	public function error(){
		$data['msg'] = "Seller Email address Already Registered...!";
		$this->load->view('common/seller_header', $data);
		$this->load->view('registration_step1', $data);
		$this->load->view('common/footer');
	}
	
	public function email_availability($email)
	{
		echo $res = $this->seller_registration_model->checkEmailAvailability($_REQUEST['email']);
	}
	
	public function forgot_password()
	{
		$email = $this->input->post('email');
		$res = $this->seller_registration_model->getSellerRecordByEmail($email);
		$data['email_id'] = $res->email_id;
		$data['password'] = $res->password;
		
		$this->load->view('forgot_mail', $data);
		redirect(base_url());
	}	
	
	public function termsconditions($param)
	{
		$this->load->view('common/seller_header', $data);
		$this->load->view('termsconditions', $data);
		$this->load->view('common/footer');
	}
	
	function cityDropdown($state_id)
	{
		if($data['city_records'] = $this->seller_registration_model->GetStateCity($state_id))
		$this->load->view('cityDropdown', $data);
	}
	
	function pincodeDropdown($city_id)
	{
		if($data['pincode_records'] = $this->seller_registration_model->GetPincodeByCity($city_id))
		$this->load->view('pincodeDropdown', $data);
	}
	
}
?>