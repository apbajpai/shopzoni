<?php
class Seller_Registration_model extends CI_Model {
    
	private $path = 'public/uploads/seller_registration/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');	
				
		$seller_name 		=  trim($this->input->post('seller_name'));
		$email_id 			=  trim($this->input->post('email_id'));				
		$seller_code 		=  trim($this->input->post('seller_code'));				
				
		if($seller_name != '')
		$this->db->like('name', $seller_name);
		if($seller_code != '')
		$this->db->where('seller_code', $seller_code);
		if($email_id!="")
		$this->db->where('email_id', $email_id);		
		
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_seller_registration");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);

		$seller_name 		=  trim($this->input->post('seller_name'));
		$email_id 			=  trim($this->input->post('email_id'));
		$seller_code 			=  trim($this->input->post('seller_code'));
		
		if($seller_name != '')
		$this->db->like('name', $seller_name);
		if($seller_code != '')
		$this->db->where('seller_code', $seller_code);
		if($email_id!="")
		$this->db->where('email_id', $email_id);
				
		$this->db->limit($limit,$start);
		$this->db->order_by("id", "desc");
        $query = $this->db->get("tbl_seller_registration");	
		//echo $this->db->last_query();
		
        $data = array();
				if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
							$data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_seller_registration");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
				$query = $this->db->get("tbl_seller_registration");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function save_seller_profile_data($identity_proof=null,$address_proof=null,$gst_proof=null,$cancelled_cheque=null) {
		$id 					= $this->input->post('id');		
		$name 					= $this->input->post('name');
		
		$business_name 			= $this->input->post('business_name');
		$business_address 		= $this->input->post('business_address');
		
		$mobile_number 			= $this->input->post('mobile_number');
		$phone_number 			= $this->input->post('phone_number');
		$email_id 				= $this->input->post('email_id');
		$password 				= $this->input->post('password');
		$confirm_password 		= $this->input->post('confirm_password');
		$gst 					= $this->input->post('gst');
		
		$state_id 				= $this->input->post('state_id');
		$city_id 				= $this->input->post('city_id');		
		$pincode_id 			= $this->input->post('pincode_id');
		$minimum_order_amount 	= $this->input->post('minimum_order_amount');
		$delivery_location 		= $this->input->post('delivery_location');
		$account_number 		= $this->input->post('account_number');
		$bank_name 				= $this->input->post('bank_name');
		$bank_address 			= $this->input->post('bank_address');
		$bank_phone_number 		= $this->input->post('bank_phone_number');
		$ifsc_code 				= $this->input->post('ifsc_code');
		
		$time_slot 				= $this->input->post('time_slot');
		$created_date 			= $this->input->post('created_date');
		$modified_date 			= $this->input->post('modified_date');
		$added_by 				= $this->input->post('added_by');
		$status 				= $this->input->post('status');
		if($status==''){
			$status=1;
		}
		
		$arr = explode(' ',trim($business_name));
		$seller_code = $arr[0]; 
		$created_by = $this->session->userdata('adminid');
		
		
		if($id=="" || $id==0){
			$admin_record = $this->getAdminRecordByEmail($email_id);
			$res = $this->checkEmailAvailability($email_id);
		}else{
			$admin_record[]='sucess';
		}
		if($res==0){
		$data = array(					
					'name'					=>	$name,
					'identity_proof'		=>	$identity_proof,
					'business_name'			=>	$business_name,
					'business_address'		=>	$business_address,
					'address_proof'			=>	$address_proof,
					'mobile_number'			=>	$mobile_number,
					'phone_number'			=>	$phone_number,
					'email_id'				=>	$email_id,
					'password'				=>	$password,					
					'gst'					=>	$gst,
					'gst_proof'				=>	$gst_proof,
					'state_id'				=>	$state_id,
					'city_id'				=>	$city_id,					
					'pincode_id'			=>	$pincode_id,
					'minimum_order_amount'	=>	$minimum_order_amount,
					'delivery_location'		=>	$delivery_location,
					'account_number'		=>	$account_number,
					'bank_name'				=>	$bank_name,
					'bank_address'			=>	$bank_address,
					'bank_phone_number'		=>	$bank_phone_number,
					'ifsc_code'				=>	$ifsc_code,
					'cancelled_cheque'		=>	$cancelled_cheque,
					'time_slot'				=>	$time_slot,
					'status'				=>	$status,
					'created_by'			=>	$created_by
				);
				
				$data1 = array(
					'name'=>$name ,
					'email'=>$email_id,	
					'role'=>2,
					'indate'=>date('Y-m-d H:i:s')					
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			//$data['seller_code'] = GetSlug($seller_code, $id);
			$data['seller_code'] = 'SZ'.$id.$seller_code;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data); 
			//echo $this->db->last_query(); exit;
			
			if($password != ''){
				$data1['password'] = md5($password);
			}
			$data1['indate']=date('Y-m-d H:i:s');
			$this->db->where('seller_id', $id);
			$this->db->update('tbl_admin', $data1); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_seller_registration',$data); 
			$id = $this->db->insert_id();
			
			//$data2['seller_code'] = GetSlug($seller_code, $id);
			$data2['seller_code'] = 'SZ'.$id.$seller_code;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data2);
			
			if($password != ''){
				$data1['password'] = md5($password);
			}
			$data1['indate']=date('Y-m-d H:i:s');
			$data1['seller_id']=$id;
			$this->db->insert('tbl_admin',$data1);
		}
		
		$data3['seller_id'] = $id;
		$this->db->insert('terms_conditions',$data3);	
		
		//echo $this->db->last_query(); exit;
		return true;
		}
		return false;
	}
	
	
	
	public function save_seller_registration_data($identity_proof=null,$address_proof=null,$gst_proof=null,$cancelled_cheque=null) {
		$id 					= $this->input->post('id');		
		$name 					= $this->input->post('name');
		
		$business_name 			= $this->input->post('business_name');
		$business_address 		= $this->input->post('business_address');
		
		$mobile_number 			= $this->input->post('mobile_number');
		$phone_number 			= $this->input->post('phone_number');
		$email_id 				= $this->input->post('email_id');
		$password 				= $this->input->post('password');
		$confirm_password 		= $this->input->post('confirm_password');
		$gst 					= $this->input->post('gst');
		
		$state_id 				= $this->input->post('state_id');
		$city_id 				= $this->input->post('city_id');		
		$pincode_id 			= $this->input->post('pincode_id');
		$minimum_order_amount 	= $this->input->post('minimum_order_amount');
		$delivery_location 		= $this->input->post('delivery_location');
		$account_number 		= $this->input->post('account_number');
		$bank_name 				= $this->input->post('bank_name');
		$bank_address 			= $this->input->post('bank_address');
		$bank_phone_number 		= $this->input->post('bank_phone_number');
		$ifsc_code 				= $this->input->post('ifsc_code');
		
		$time_slot 				= $this->input->post('time_slot');
		$created_date 			= $this->input->post('created_date');
		$modified_date 			= $this->input->post('modified_date');
		$added_by 				= $this->input->post('added_by');
		$status 				= $this->input->post('status');
		
		
		$arr = explode(' ',trim($business_name));
		$seller_code = $arr[0]; 
		$created_by = $this->session->userdata('adminid');
		
		
		if($id=="" || $id==0){
			$admin_record = $this->getAdminRecordByEmail($email_id);
			$res = $this->checkEmailAvailability($email_id);
		}else{
			$admin_record[]='sucess';
		}
		if($res==0){
		$data = array(					
					'name'					=>	$name,
					'identity_proof'		=>	$identity_proof,
					'business_name'			=>	$business_name,
					'business_address'		=>	$business_address,
					'address_proof'			=>	$address_proof,
					'mobile_number'			=>	$mobile_number,
					'phone_number'			=>	$phone_number,
					'email_id'				=>	$email_id,
					'password'				=>	$password,					
					'gst'					=>	$gst,
					'gst_proof'				=>	$gst_proof,
					'state_id'				=>	$state_id,
					'city_id'				=>	$city_id,					
					'pincode_id'			=>	$pincode_id,
					'minimum_order_amount'	=>	$minimum_order_amount,
					'delivery_location'		=>	$delivery_location,
					'account_number'		=>	$account_number,
					'bank_name'				=>	$bank_name,
					'bank_address'			=>	$bank_address,
					'bank_phone_number'		=>	$bank_phone_number,
					'ifsc_code'				=>	$ifsc_code,
					'cancelled_cheque'		=>	$cancelled_cheque,
					'time_slot'				=>	$time_slot,
					'status'				=>	$status,
					'created_by'			=>	$created_by
				);
				
				$data1 = array(
					'name'=>$name ,
					'email'=>$email_id,	
					'role'=>2,
					'indate'=>date('Y-m-d H:i:s'),
					'status'=>$status
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			//$data['seller_code'] = GetSlug($seller_code, $id);
			$data['seller_code'] = 'SZ'.$id.$seller_code;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data); 
			//echo $this->db->last_query(); 
			
			if($password != ''){
				$data1['password'] = md5($password);
			}
			$data1['indate']=date('Y-m-d H:i:s');
			$this->db->where('seller_id', $id);
			$this->db->update('tbl_admin', $data1); 
			
			//echo $this->db->last_query(); exit;
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_seller_registration',$data); 
			$id = $this->db->insert_id();
			
			//$data2['seller_code'] = GetSlug($seller_code, $id);
			$data2['seller_code'] = 'SZ'.$id.$seller_code;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data2);
			
			if($password != ''){
				$data1['password'] = md5($password);
			}
			$data1['indate']=date('Y-m-d H:i:s');
			$data1['seller_id']=$id;
			$this->db->insert('tbl_admin',$data1);
		}
		
		$data3['seller_id'] = $id;
		$this->db->insert('terms_conditions',$data3);	
		
		//echo $this->db->last_query(); exit;
		return true;
		}
		return false;
	}
	
	function upload1($fieldname)
	{
		$config['upload_path'] = $this->path;
		if (!is_dir($this->path))
		{
			mkdir($this->path, 0777);
		}
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2000';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);            
		
		if (!$this->upload->do_upload($fieldname)){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$upload_data = $this->upload->data();
			return $upload_data['file_name'];		
		}							
	}

	function getAdminRecordByEmail($email){
		$this->db->where('email', $email);
		$query = $this->db->get("tbl_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function checkEmailAvailability($email) {	
		$this->db->select('count(*) as total');	
		$this->db->where('email', $email);		
		$query = $this->db->get("tbl_admin");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	function GetStateRecord()
	{
		$this->db->order_by('state_name ASC');		
		$query = $this->db->get("tbl_state_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetStateCity($state_id) {
		//$state_record = $this->getStateID($state);
		//$state_id = $state_record->id;
		$this->db->where('state_id', $state_id);
		$query = $this->db->get("tbl_district_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetPincodeByCity($city_id) {
		$this->db->where('district_id', $city_id);
		$query = $this->db->get("tbl_pincode_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	function GetCityRecord()
	{
		$this->db->order_by('district_name ASC');		
		$query = $this->db->get("tbl_district_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function GetPincodeRecord()
	{
		$this->db->order_by('id ASC');		
		$query = $this->db->get("tbl_pincode_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function getStateID($state) {
		$this->db->where('state_name', $state);
		$query = $this->db->get("tbl_state_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
}