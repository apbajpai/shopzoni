<?php
class Buyer_List_model extends CI_Model {
    
	private $path = 'public/uploads/buyer_list/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	
	
	public function GetTotalRecord() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('d.*,c.id as seller_id,b.status,b.order_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = f.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		
		$this->db->where('c.id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');		
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("d.id");
		$query = $this->db->get();	
		
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {          
			return $query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit='') {
		$seller_id = $this->session->userdata('seller_id');		
			
		$this->db->select('a.id as product_id,f.seller_id,a.name,a.code,f.price,a.unit,b.id as cart_id, b.quantity,b.date_modified,b.date_created,
		b.order_id,b.order_status,b.buyer_business_name,d.name,c.seller_code,c.business_name,d.email,d.address,d.mobile,e.mailto_buyer_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = f.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		
		$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');		
		$this->db->order_by("c.business_name", "ASC");
		$this->db->group_by("d.id");
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