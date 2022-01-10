<?php
class Message_Seller_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
		
		$seller_code = $this->session->userdata('seller_code');
		$this->db->where('a.seller_code', $seller_code);
		
		$this->db->order_by('a.id DESC');
		
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			$query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {

		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
		
		$seller_code = $this->session->userdata('seller_code');
		$this->db->where('a.seller_code', $seller_code);
		
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
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
	
	
	public function GetTotalRecordReport() {			
		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
				
		$this->db->order_by('a.id DESC');
		
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecordsReport($start=0, $limit=10) {

		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
	
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
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
	
	
	
	public function totalUnreadMessage() {			
		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
		
		$seller_code = $this->session->userdata('seller_code');
		$this->db->where('a.seller_code', $seller_code);
		$this->db->where('a.read_unread_status', 0);
		
		$this->db->order_by('a.id DESC');
	
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {			
			return $query->num_rows();
		}
		return false;
    }
	
	public function changeViewStatus($id){
		$data['read_unread_status']=1;
		$this -> db -> where('id', $id);
		$this->db->update('tbl_message_seller', $data); 
	}
	
	
	public function GetRecordsById($id) {

		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_message_seller as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');
		
		$this->db->where('a.id', $id);
		
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
		
}