<?php
class Order_model extends CI_Model {
    
	private $path = 'public/uploads/order/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {		
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('a.id as product_id,f.seller_id,a.name,a.code,f.price,a.unit,b.id as cart_id,
		b.quantity,b.date_modified,b.date_created,b.order_id,b.order_status,d.name,d.email,d.address,d.mobile,d.business_name,e.mailto_buyer_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_product_order as b', 'b.product_id = a.id', 'left');			
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		$this->db->where('f.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		
		$order_id  =  trim($this->input->post('order_id'));
		if($order_id != '')
		$this->db->where('b.order_id', $order_id);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->where('d.email', $email);
		
		$this->db->order_by("b.order_id", "desc");
		$this->db->group_by("b.order_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('a.id as product_id,f.seller_id,a.name,a.code,f.price,a.unit,b.id as cart_id,
		b.quantity,b.date_modified,b.date_created,b.order_id,b.order_status,d.name,d.email,d.address,d.mobile,d.business_name,e.mailto_buyer_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_product_order as b', 'b.product_id = a.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		$this->db->where('f.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		
		$order_id  =  trim($this->input->post('order_id'));
		if($order_id != '')
		$this->db->where('b.order_id', $order_id);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->where('d.email', $email);
		
		//$this->db->where('e.mailto_buyer_status !=', '1');
		$this->db->limit($limit,$start);
		$this->db->order_by("b.date_modified", "desc");
		$this->db->group_by("b.order_id");
		$query = $this->db->get();
		echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$res = $this->CheckOrderStatusByOrderID($row->order_id);
				if($res>0)
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}	
	
	public function approveOrderStatus(){
		$cart_id  =  trim($this->input->post('cart_id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['order_status']=4;
		$this -> db -> where('id', $cart_id);
		$this->db->update('tbl_product_order', $data); 
	}
	
	public function sendMailToBuyer(){
		$order_id  =  trim($this->input->post('order_id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['mailto_buyer_status']=1;
		$this -> db -> where('order_id', $order_id);
		$this->db->update('tbl_order', $data); 
	}
	
	
	public function rejectOrderStatus(){
		$cart_id  =  trim($this->input->post('cart_id'));		
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['order_status']=5;
		$this -> db -> where('id', $cart_id);
		$this->db->update('tbl_product_order', $data); 
	}
	
	public function GetRecordsByOrderId($order_id) {
		$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('a.id as product_id,e.seller_id,a.name,a.code,e.price,a.unit,b.id as cart_id, b.quantity,b.date_modified,b.order_id,b.order_status,c.seller_code,c.business_name as seller_business_name,c.email_id as seller_email,d.name,d.email,d.address,d.mobile');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_product_order as b', 'b.product_id = a.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = e.seller_id', 'left');
		$this->db->where('e.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_id', $order_id);
		
		//$this->db->limit($limit,$start);
		$this->db->order_by("b.id", "desc");
		//$this->db->group_by("a.seller_id");
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
	
	public function CheckOrderStatusByOrderID($order_id) {
		$this->db->where('order_status', 3);
		$this->db->where('order_id', $order_id);
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
		
}