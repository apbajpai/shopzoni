<?php
class Buyer_Request_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		session_start();
		$this->load->database();
	}
		
	
	/*public function CkeckBuyerApproval($seller_id,$buyer_id) {
		$this->db->select('count(*) as total');	
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('buyer_id', $buyer_id);	 			
		$this->db->where('request_status', 1);	
		$this->db->where('status', 1);	
		$query = $this->db->get("buyer_request");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
	}	*/
	
	
	public function CkeckBuyerApproval($seller_id,$buyer_id) {
		$this->db->select('*');	
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('buyer_id', $buyer_id);	 			
		$this->db->where('request_status', 1);	
		//$this->db->where('status', 1);	
		$query = $this->db->get("buyer_request");
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
		
	
}