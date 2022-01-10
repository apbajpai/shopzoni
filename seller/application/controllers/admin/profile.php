<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	public function __Construct()
	{
	  parent::__Construct();
		ob_start();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->helper(array('form'));
		$this->load->model('admin/seller_registration_model');
		
	   $this->check_isvalidated();
	}	
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('admin/login');
        }
    }
	
	public function addedit($param)
	{	
		$param = $this->uri->segment(4);
		if(is_numeric($param)){
			$data['heading']='Edit Profile'; 
			$seller_id = $param;
		}else{
			$data['heading']='Edit Profile'; 
		}
		
		if($seller_id){
			$array_records = $this->seller_registration_model->GetRecordById($seller_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records; 
		
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
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');			
		$this->load->view('admin/add-edit-profile', $data);
		$this->load->view('admin/footer');
	}
	
	public function save()
	{
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE){
			redirect('admin/seller-registration/addedit');
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
						
			$name = $this->input->post('name'); 
			$passkey_array = explode($name);
			$password = $passkey_array[0].rand(1000,9999);
			
			$save = $this->seller_registration_model->save_seller_profile_data($identity_proof,$address_proof,$gst_proof,$cancelled_cheque);
			
			if($save){
				$email_id = $this->input->post('email_id');
				$data['email_id'] = $email_id;
				$data['password'] = $password;
				//$this->load->view('admin/mail_template', $data);
				$id 				= $this->input->post('id');
				$data1 = array(							
							'name' => $name
					);
				$this->session->set_userdata($data1);
				session_start();
				echo $_SESSION['sucess_msg'] = "Updated Sucessfully..!"; 
				
				redirect('admin/profile/addedit/'.$id);
			}else{				
				redirect('admin/profile/addeditfailure');
			}
		}	
	}	
	
	
	public function addeditfailure($param)
	{
		
		if(is_numeric($param)){
			$data['heading']='Edit Profile'; 
			$seller_id = $param;
		}else{
			$data['heading']='Edit Profile'; 
		}
		
		if($seller_id){
			$array_records = $this->seller_registration_model->GetRecordById($seller_id);
		}else{
			$array_records=array();
		}
		
		$data['row'] = $array_records;
		$data['validation_msg'] = "Seller Email address Already Exist"; 
				
		$this->load->view('admin/header', $data);		
		$this->load->view('admin/sidebar');		
		$this->load->view('admin/add-edit-seller-registration', $data);
		$this->load->view('admin/footer');
	}
	
	public function email_availability($email)
	{
		echo $res = $this->seller_registration_model->checkEmailAvailability($_REQUEST['email']);
	}
	
	function cityDropdown($state_id)
	{
		$state_id = $this->uri->segment(4);
		if($data['city_records'] = $this->seller_registration_model->GetStateCity($state_id))
		$this->load->view('admin/cityDropdown', $data);
	}
	
	function pincodeDropdown($city_id)
	{
		$city_id = $this->uri->segment(4);
		if($data['pincode_records'] = $this->seller_registration_model->GetPincodeByCity($city_id))
		$this->load->view('admin/pincodeDropdown', $data);
	}
	
}
?>