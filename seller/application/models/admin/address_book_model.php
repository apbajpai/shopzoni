<?php
class Address_Book_model extends CI_Model {
    
	private $path = 'public/uploads/address_book/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/*public function GetTotalRecord() {	
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->where('seller_id', $seller_id);
		$this->db->where('status !=', 5);
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->like('email', $email);
		$query = $this->db->get("tbl_address_book");		
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		if($this->session->userdata('arole') == '2'){
			$seller_id = $this->session->userdata('seller_id');
			$this->db->where('seller_id', $seller_id);
		}
		$this->db->where('status !=', 5);		
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->like('email', $email);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_address_book");		
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	} */
	
	
	public function GetTotalRecord() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');							
			$this->db->where('a.status !=', 5);
			$this->db->where('a.request_status', '1');	
			$this->db->where('b.email !=', '');	
			$email  =  trim($this->input->post('email'));
			if($email != '')
			$this->db->like('b.email', $email);
			$this->db->where('a.seller_id', $seller_id);
			$this->db->order_by("b.name", "asc");
			$query = $this->db->get();	
		
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit='') {
			$seller_id = $this->session->userdata('seller_id');
			
			$this->db->select('a.*, b.name,b.business_name,b.address,b.email,c.id as seller_id');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
						
			$this->db->where('a.status !=', 5);
			$this->db->where('a.request_status', '1');	
			$this->db->where('b.email !=', '');	
			$email  =  trim($this->input->post('email'));
			if($email != '')
			$this->db->like('b.email', $email);
			$this->db->where('a.seller_id', $seller_id);
			if($limit)
			$this->db->limit($limit,$start);
			$this->db->order_by("b.name", "asc");
			$query = $this->db->get();	
			
			$this->db->last_query();		
			$data = array();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;
	}
	
	
	public function GetRecordsCompose($start=0, $limit='') {
			$seller_id = $this->session->userdata('seller_id');
			
			$this->db->select('a.*, b.name,b.business_name,b.address,b.email,c.id as seller_id');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
						
			$this->db->where('a.status', 1);
			$this->db->where('a.request_status', '1');	
			$this->db->where('b.email !=', '');	
			$email  =  trim($this->input->post('email'));
			if($email != '')
			$this->db->like('b.email', $email);
			$this->db->where('a.seller_id', $seller_id);
			if($limit)
			$this->db->limit($limit,$start);
			$this->db->order_by("b.email", "asc");
			$query = $this->db->get();	
			
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
	
	
	public function GetRecordsInviteBuyer($start=0, $limit=10) {
			$seller_id = $this->session->userdata('seller_id');
			
			$this->db->select('a.*, b.name,b.business_name,b.address,b.email,c.id as seller_id');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
						
			$this->db->where('a.status', 1);
			$this->db->where('a.request_status', '1');	
			$email  =  trim($this->input->post('email'));
			if($email != '')
			$this->db->like('b.email', $email);
			$this->db->where('a.seller_id', $seller_id);
			//$this->db->limit($limit,$start);
			$this->db->order_by("b.email", "asc");
			$query = $this->db->get();	
			
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
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('status', 1);
		$this->db->where('seller_id', $seller_id);
		$this->db->order_by('id DESC');
		$query = $this->db->get("tbl_address_book");
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
		$seller_id = $this->session->userdata('seller_id');
        $this->db->where('id', $id);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_address_book");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordByName($email) {
		$seller_id = $this->session->userdata('seller_id');
        $this->db->where('email', $email);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_address_book");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_address_book_data($image=null) {
		$id = $this->input->post('id');
		$email = $this->input->post('email');		
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		$seller_id = $this->session->userdata('seller_id');
		
		if($id=="" || $id==0){
			$res = $this->GetRecordByName($email);
		}
		
		if($res==0){		
			$data = array(
						'email'=>$email ,
						'status'=>$status,
						'created_by'=>$created_by,
						'seller_id'=>$seller_id
						);
			if($id)			
			{
				$data['date_modified']=date('Y-m-d H:i:s');					
				$this->db->where('id', $id);
				$this->db->update('tbl_address_book', $data); 
			}
			else
			{
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_address_book',$data); 			
				//$this->db->where('id', $id);
				//$this->db->update('tbl_address_book', $data); 
			}
			
			$user_data = $this->getUserRecordByEmail($email);
			$inserted_id = $user_data->id;
			if($inserted_id==""){
				$data = array(					
								//'name'=>$name,						
								'email'=>$email,
								'status'=>'1'
							);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_user',$data); 
				$inserted_id = $this->db->insert_id();
			}
			
			
			$data1 = array(					
				'seller_id'=>$seller_id,					
				'buyer_id'=>$inserted_id,					
				'status'=>'1',
				'request_status'=>'1'			
			);		
			$data1['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('buyer_request',$data1);
		
			
			//echo $this->db->last_query();
			return true;
		}else{
		return false;
		}
	}
	
	function getUserRecordByEmail($email_id){
		$this->db->where('status', 1);
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
	
	public function save_email_data($to,$from,$subject,$message,$page="") {
		$seller_id = $this->session->userdata('seller_id');
		
		$data = array(
					'to'=>$to ,
					'from'=>$from,
					'subject'=>$subject,
					'message'=>$message,
					'page'=>$page,
					'seller_id'=>$seller_id
					);
		
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_email_history',$data);
			//echo $this->db->last_query(); exit;
		return true;		
	}
	
}