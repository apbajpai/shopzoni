<?php
class Registration_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	
	public function check_login() {
		$email	=	trim($this->input->post('email_id'));
		$password	=	$this->input->post('password');
		$this->db->where('email', $email);		
		$this->db->where('password', $password);		
		$this->db->where('status', 1);		
		
        $query = $this->db->get("tbl_user");	
		//echo $this->db->last_query(); exit;
		
        $data = array();
			if ($query->num_rows() > 0) {            
				$row = $query->row();
				$data = array(
								'user_id' => $row->id,
								'full_name' => $row->business_name,
								'name' => $row->name,
								);
				$this->session->set_userdata($data); 
				
				$data1 = array(
					'user_id'=>$row->id,
					'user_type'=>3,	
					'login_date'=>date('Y-m-d H:i:s'),
					'ip_address'=>$_SERVER['REMOTE_ADDR']
					);
				$this->db->insert('tbl_login_history',$data1);
				
			return true;
        }
        return false;
    }
	
	public function save_user_data() {
		$name			=	$this->input->post('name');
		$business_name	=	$this->input->post('business_name');
		$address		=	$this->input->post('address');
		$pincode		=	$this->input->post('pincode');
		$email			=	$this->input->post('email');
		$password		=	$this->input->post('password');
		$cpassword		=	$this->input->post('cpassword');
		$mobile			=	$this->input->post('mobile');
		$email_check 	= $this->checkEmailAvailability($email);
		if($email_check==0){
		if($password==$cpassword){
			$data = array(					
						'name'=>$name,					
						'business_name'=>$business_name,					
						'pincode'=>$pincode,					
						'address'=>$address,	
						'email'=>$email,	
						'password'=>$password,		
						'mobile'=>$mobile,	
						'status'=>'0'
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_user',$data); 
				//echo $this->db->last_query();
				$id = $this->db->insert_id();
				return $id;
			//return true;
		}else{
			$data = array('password' => "Password and Confirm Password not matched.",);
			$this->session->set_userdata($data);
			return false;
		}
		}else{
			$data = array('email' => "Email Address allready Registered.",);
			$this->session->set_userdata($data);
			return false;
		}
	}
	
	
	public function change_password() {		
		$user_id	=	$this->input->post('user_id');
		$password	=	$this->input->post('password');
		$cpassword	=	$this->input->post('cpassword');		
		
		if($password==$cpassword){
			$data = array(				
						'password'=>$password					
					);		
				$data['date_created']=date('Y-m-d H:i:s');				
				$this->db->where('id', $user_id);
				$this->db->update('tbl_user', $data);
				//echo $this->db->last_query(); exit;
				return true;
		}else{
			$data = array('password' => "Password and Confirm Password not matched.",);
			$this->session->set_userdata($data);
			return false;
		}
		
	}
	
	
	
	
	function getUserRecordByEmail($email_id){
		$this->db->where('email', $email_id);
		$query = $this->db->get("tbl_user");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	function getBuyerRecordById($id){
		$this->db->where('id', $id);
		$query = $this->db->get("tbl_user");
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
		$query = $this->db->get("tbl_user");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function checkEmailAvailabilityfb($email) {			
		$this->db->where('email', $email);		
		$query = $this->db->get("tbl_user");
		//echo $this->db->last_query();
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function update_user_data() {
		$id				=	$this->input->post('id');
		$name			=	$this->input->post('name');
		$business_name	=	$this->input->post('business_name');
		$address		=	$this->input->post('address');	
		$pincode		=	$this->input->post('pincode');	
		$password		=	$this->input->post('password');
		$cpassword		=	$this->input->post('cpassword');
		$mobile			=	$this->input->post('mobile');
		$subscribe		=	$this->input->post('subscribe');
			
		if($password==$cpassword){
			$data = array(					
						'name'=>$name,					
						'business_name'=>$business_name,					
						'address'=>$address,							
						'pincode'=>$pincode,							
						'password'=>$password,		
						'mobile'=>$mobile,	
						'subscribe'=>$subscribe,						
						'status'=>'1'
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->where('id', $id);
				$this->db->update('tbl_user', $data); 
				//echo $this->db->last_query();
			return $id;
		}else{
			$data = array('password' => "Password and Confirm Password not matched.",);
			//$this->session->set_userdata($data);
			return false;
		}		
	}
	
	public function save_send_request_data($seller_id){			
		$buyer_id		=	$this->session->userdata('user_id');
		$data = array(					
			'seller_id'=>$seller_id,					
			'buyer_id'=>$buyer_id,					
			'status'=>'0'
		);		
		$data['date_created']=date('Y-m-d H:i:s');
		$this->db->insert('buyer_request',$data); 
		//echo $this->db->last_query();
		return true;
	}
	
	
	public function GetRecordsBySellerCode($code) {
		$this->db->where('status =', 1);		
		if($code != ''){
			$this->db->where('seller_code', $code);
		}
				
		$this->db->limit(1,0);
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
	
	
	function getBuyerRequestByBuyerIdAndSellerId($buyer_id,$seller_id){
		$this->db->where('buyer_id', $buyer_id);
		$this->db->where('seller_id', $seller_id);		
		$this->db->where('request_status !=', 2);		
		$query = $this->db->get("buyer_request");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
	}
	
	function facebook_registration($user_profile){
		$name	=	$user_profile['name'];
		$email	=	$user_profile['email'];
		
		$email_check = $this->checkEmailAvailabilityfb($email);
				
		/*[id] => 2
		[name] => test2
		[business_name] => yamini1
		[address] => delhi1
		[email] => devendra4it@gmail.com
		[password] => 12345
		[mobile] => 8459376142
		[date_created] => 2016-05-03
		[date_modified] => 0000-00-00
		[status] => 1 */
		
		if($email_check->id=="" && $email!=""){
			$data = array(					
						'name'=>$name,						
						'email'=>$email,
						'status'=>'1'
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_user',$data); 
				$data['user_id'] = $this->db->insert_id();
				$this->session->set_userdata($data);
				//echo $this->db->last_query();
				
				$data1 = array(
					'user_id'=>$data['user_id'],
					'user_type'=>3,	
					'login_date'=>date('Y-m-d H:i:s'),
					'ip_address'=>$_SERVER['REMOTE_ADDR']
					);
				$this->db->insert('tbl_login_history',$data1);
				
			return true;
		}else{
			$data = array('email' => "Email Address allready Registered.");
			
			$data['user_id'] = $email_check->id;
			$data['name'] = $email_check->name;			
			
			$this->session->set_userdata($data);
			
			$data1 = array(
				'user_id'=>$data['user_id'],
				'user_type'=>3,	
				'login_date'=>date('Y-m-d H:i:s'),
				'ip_address'=>$_SERVER['REMOTE_ADDR']
				);
			$this->db->insert('tbl_login_history',$data1);
			
			return false;
		}
	}
	
	function google_registration(){
		$name		=	$this->input->post('name');
		$email		=	$this->input->post('email');
		
		$email_check = $this->checkEmailAvailabilityfb($email);
				
		/*[id] => 2
		[name] => test2
		[business_name] => yamini1
		[address] => delhi1
		[email] => devendra4it@gmail.com
		[password] => 12345
		[mobile] => 8459376142
		[date_created] => 2016-05-03
		[date_modified] => 0000-00-00
		[status] => 1 */
		
		if($email_check->id=="" && $email!=""){
			$data = array(					
						'name'=>$name,						
						'email'=>$email,
						'status'=>'1'
					);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_user',$data); 
				$data['user_id'] = $this->db->insert_id();
				$this->session->set_userdata($data);
				//echo $this->db->last_query();
				
				$data1 = array(
					'user_id'=>$data['user_id'],
					'user_type'=>3,	
					'login_date'=>date('Y-m-d H:i:s'),
					'ip_address'=>$_SERVER['REMOTE_ADDR']
					);
				$this->db->insert('tbl_login_history',$data1);
				
			return true;
		}else{
			$data = array('email' => "Email Address allready Registered.");
			
			$data['user_id'] = $email_check->id;
			$data['name'] = $email_check->name;			
			
			$this->session->set_userdata($data);
			
			$data1 = array(
				'user_id'=>$data['user_id'],
				'user_type'=>3,	
				'login_date'=>date('Y-m-d H:i:s'),
				'ip_address'=>$_SERVER['REMOTE_ADDR']
				);
			$this->db->insert('tbl_login_history',$data1);
			
			return true;
		}
	}
	
	
	public function insertGooglePlusCustomerData($data_arr, $google_id, $email, $name) {
        $this->db->select('id, email, name');
        $this->db->from("tbl_user");
        //$this->db->where('google_id', $google_id);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data['user_id'] = $row->id;
            }
        } else {
            $this->db->insert('tbl_user', $data_arr);
            $data['user_id'] = $this->db->insert_id();
        }
        $data['email'] = $email;
        $data['name'] = $name;
        $data['valid_name'] = true;
        $this->session->set_userdata($data);
		
		$data1 = array(
				'user_id'=>$data['user_id'],
				'user_type'=>3,	
				'login_date'=>date('Y-m-d H:i:s'),
				'ip_address'=>$_SERVER['REMOTE_ADDR']
				);
			$this->db->insert('tbl_login_history',$data1);
				
		/* ----------Set Cookie----------- */
		
		$shopzoni_identifier = rand(1111,9999).time();
		$cookie_data = array('name'   => 'shopzoni_user_identifier', 'value'  => $shopzoni_identifier, 'expire' => '86500');
		$this->input->set_cookie($cookie_data); 
		/* ------------Insert Session_id -----------  */
		/* $data_sess = array(
			'user_type' => 'customer',
			'user_id' => $data['customer_id'],
			'session_id' => $shopzoni_identifier,
			'ip_address' => getIpAddress(),
			'status' => 1,
			'indate' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('tbl_login_sessions', $data_sess); */
		/* ----------End Set Cookie----------- */
        return $data;
    }
	
	public function activateAccount($id){
			$data['status']=1;
			$this->db->where('id', $id);
			$this->db->update('tbl_user', $data); 
		return true;
	}
	
	function getBuyerMindatoryFields(){
		$this->db->where('id', $this->session->userdata('user_id'));
		$query = $this->db->get("tbl_user");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
	}
	
	
}