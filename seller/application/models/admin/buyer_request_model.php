<?php
class Buyer_Request_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->from("buyer_request as a");
		$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
					
		$this->db->where('a.status !=', 5);
		$this->db->where('a.request_status !=', '1');
		$this->db->where('a.request_status !=', '2');
		$this->db->where('a.seller_id', $seller_id);
		$query = $this->db->get();	
		
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
			$seller_id = $this->session->userdata('seller_id');
			
			$this->db->select('a.*, b.name,b.business_name,b.address,b.email,c.id as seller_id');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
						
			$this->db->where('a.status !=', 5);
			$this->db->where('a.request_status !=', '1');
			$this->db->where('a.request_status !=', '2');
			$this->db->where('a.seller_id', $seller_id);
			//$this->db->limit($limit,$start);
			$this->db->order_by("a.id", "desc");
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
	
	public function approveRequest(){
		$id  =  trim($this->input->post('id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['request_status']=1;
		$data['status']=1;
		$this -> db -> where('id', $id);
		$this->db->update('buyer_request', $data); 
	}
	
	
	public function rejectRequest(){
		$id  =  trim($this->input->post('id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['request_status']=2;
		$this -> db -> where('id', $id);
		$this->db->update('buyer_request', $data); 
	}
	
	public function getRecordByID($id) {
			$this->db->select('a.*,b.name,b.business_name,b.address,b.email,c.id as seller_id,c.email_id,c.seller_code,c.mobile_number,c.business_name as seller_business_name,c.business_address,c.name as seller_name');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');
			$this->db->where('a.id', $id);
			//$this->db->limit($limit,$start);
			$this->db->order_by("a.id", "desc");
			$query = $this->db->get();	
			
			//echo $this->db->last_query();		
			$data = array();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
								$data = $row;
				}
				return $data;
			}
			return false;
	}
		
}