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
				
		//echo "<pre>";
		//print_r($search);
		
		if($seller_name != '')
		$this->db->where('seller_name', $seller_name);
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
				
				//echo "<pre>";
				//print_r($search);
				
				if($seller_name != '')
				$this->db->where('seller_name', $seller_name);
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
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function checkSellerLogin1111() {		
		$email_id 		= $this->input->post('lemail_id');
		$password 		= $this->input->post('lpassword');        
		$this->db->where('email_id', $email_id);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_seller_registration");
		echo $this->db->last_query(); exit;
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data1 = $row;
				$row = $query->row();
				$data = array(
							'sellerid' => $row->id,
							'seller_id' => $row->id,
							'name' => $row->name,
							'seller_code' => $row->seller_code,
							'email_id' => $row->email_id,
							'validated' => true
							);
				$this->session->set_userdata($data);
            }
            return $data1;
        }
        return false;
    }
	
	
	public function checkSellerLogin(){
	$this->load->library('form_validation');
	$this->form_validation->set_rules('lemail_id', 'lemail_id', 'trim|required|xss_clean');
	$this->form_validation->set_rules('lemail_id', 'lemail_id', 'trim|required|xss_clean|callback_check_database');
	
	$username = $this->security->xss_clean($this->input->post('lemail_id'));
	$password = $this->security->xss_clean($this->input->post('lpassword'));
	
	if($this->form_validation->run() == FALSE)
	{
		return false;
	}
	else
	{		 
			$this->db->where('email', $username);
			$this->db->where('password', md5($password));
			$this->db->where('status', 1);
			$query = $this->db->get('tbl_admin');
			//echo $this->db->last_query();
			if($query->num_rows == 1)
			{
				$row = $query->row();					
				$seller_record = $this->getSeller($row->seller_id); 
								
				if($seller_record->id!='' && $seller_record->status!=0){					
					$data = array(
									'adminid' => $row->id,
									'name' => $seller_record->name,
									'seller_code' => $seller_record->seller_code,									
									'type' => $seller_record->type,
									'aemail' => $row->email,
									'seller_id' => $row->seller_id,
									'validated' => true,
									'arole' => $row->role,									
									'sellerid' => $seller_record->id,								
									'email_id' => $seller_record->email_id									
									);
					$this->session->set_userdata($data);
					
					$data1 = array(
					'user_id'=>$seller_record->id,
					'user_type'=>2,	
					'login_date'=>date('Y-m-d H:i:s'),
					'ip_address'=>$_SERVER['REMOTE_ADDR']
					);
					$this->db->insert('tbl_login_history',$data1);			
					
					return $seller_record;
				}
				return $seller_record;
			}
			return false;
	}
	}
	
	
	public function getSeller($id){
		$this->db->where('id', $id);
		$this->db->where('status !=', 5);
		$query = $this->db->get("tbl_seller_registration");
		//echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
	}	
	
	public function save_seller_registration_data($identity_proof=null,$address_proof=null,$gst_proof=null,$cancelled_cheque=null) {
		$id 			= $this->input->post('id');		
		$name 			= $this->input->post('name');
		$identity_proof 	= $this->input->post('identity_proof');
		$business_name 		= $this->input->post('business_name');
		$business_address 	= $this->input->post('business_address');
		$address_proof 		= $this->input->post('address_proof');
		$mobile_number 		= $this->input->post('mobile_number');
		$phone_number 		= $this->input->post('phone_number');
		$email_id 		= $this->input->post('email_id');
		$password 		= $this->input->post('password');
		$confirm_password 	= $this->input->post('confirm_password');
		$gst 			= $this->input->post('gst');
		$gst_proof 		= $this->input->post('gst_proof');
		$state_id 		= $this->input->post('state_id');
		$city_id 		= $this->input->post('city_id');		
		$pincode_id 		= $this->input->post('pincode_id');
		$delivery_location 	= $this->input->post('delivery_location');
		$type 			= $this->input->post('type');
		$account_number 	= $this->input->post('account_number');
		$bank_name 		= $this->input->post('bank_name');
		$bank_address 		= $this->input->post('bank_address');
		$bank_phone_number 	= $this->input->post('bank_phone_number');
		$ifsc_code 		= $this->input->post('ifsc_code');
		$cancelled_cheque 	= $this->input->post('cancelled_cheque');
		$time_slot 		= $this->input->post('time_slot');
		$created_date 		= $this->input->post('created_date');
		$modified_date 		= $this->input->post('modified_date');
		$added_by 		= $this->input->post('added_by');
		$status 		= $this->input->post('status');
				
		$created_by = $this->session->userdata('adminid');
		
		if($id=="" || $id==0){
			$admin_record = $this->getAdminRecordByEmail($email_id);
			$res = $this->checkEmailAvailability($email_id);
		}else{
			$admin_record[]='sucess';
		}
		
		
		$arr = explode(' ',trim($business_name));
		$seller_code = $arr[0]; 
		
		if(empty($admin_record) && $res==0){
		$data = array(					
					'name'			=>	$name,
					'identity_proof'	=>	$identity_proof,
					'business_name'		=>	$business_name,
					'business_address'	=>	$business_address,
					'address_proof'		=>	$address_proof,
					'mobile_number'		=>	$mobile_number,
					'phone_number'		=>	$phone_number,
					'email_id'		=>	$email_id,
					'password'		=>	$password,					
					'gst'			=>	$gst,
					'gst_proof'		=>	$gst_proof,
					'state_id'		=>	$state_id,
					'city_id'		=>	$city_id,					
					'pincode_id'		=>	$pincode_id,
					'delivery_location'	=>	$delivery_location,
					'type'			=>	$type,
					'account_number'	=>	$account_number,
					'bank_name'		=>	$bank_name,
					'bank_address'		=>	$bank_address,
					'bank_phone_number'	=>	$bank_phone_number,
					'ifsc_code'		=>	$ifsc_code,
					'cancelled_cheque'	=>	$cancelled_cheque,
					'time_slot'		=>	$time_slot,
					'status'		=>	0,
					'created_by'		=>	$created_by
				);
				
				$data1 = array(
					'name'=>$name ,
					'email'=>$email_id,	
					'role'=>2,
					'indate'=>date('Y-m-d H:i:s'),
					'status'=>0
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['seller_code'] = 'SZ'.$id.$seller_code;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_seller_registration',$data); 
			$this->db->last_query(); 
			$id = $this->db->insert_id();
			
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
		
		return $id;
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
	
	function getSellerRecordByEmail($email_id){
		$this->db->where('email_id', $email_id);
		$query = $this->db->get("tbl_seller_registration");
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
	
	public function activateAccount($id){
			$data['status']=1;
			$this->db->where('id', $id);
			$this->db->update('tbl_seller_registration', $data); 
			
			$this->db->where('seller_id', $id);			
			$this->db->update('tbl_admin',$data);
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