<?php
class Order_model extends CI_Model {
    
	private $path = 'public/uploads/order/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {		
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('b.*,e.mailto_buyer_status,e.view_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_product_order as b', 'b.product_id = a.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_status !=', '4');
		$this->db->where('b.order_status !=', '5');
		
		$order_id  =  trim($this->input->post('order_id'));
		if($order_id != '')
		$this->db->where('b.order_id', $order_id);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->where('d.email', $email);
	
		$delivery_location_id  =  trim($this->input->post('delivery_location_id'));
		if($delivery_location_id != '')
		$this->db->where('b.delivery_location_id', $delivery_location_id);
	
		$delivery_date  =  trim($this->input->post('delivery_date'));
		if($delivery_date != '')
		$this->db->where('b.delivery_date', $delivery_date);
		
		$time_slot_id  =  trim($this->input->post('time_slot_id'));
		if($time_slot_id != '')
		$this->db->where('b.time_slot_id', $time_slot_id);
		
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
			
		$this->db->select('b.*,e.mailto_buyer_status,e.view_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_product_order as b', 'b.product_id = a.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		//1-added to cart, 3-order placed, 5- order cancel, 4-Order Approved
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_status !=', '4');
		$this->db->where('b.order_status !=', '5');
		
		$order_id  =  trim($this->input->post('order_id'));
		if($order_id != '')
		$this->db->where('b.order_id', $order_id);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')
		$this->db->where('d.email', $email);
	
		$delivery_location_id  =  trim($this->input->post('delivery_location_id'));
		if($delivery_location_id != '')
		$this->db->where('b.delivery_location_id', $delivery_location_id);
	
		$delivery_date  =  trim($this->input->post('delivery_date'));
		if($delivery_date != '')
		$this->db->where('b.delivery_date', $delivery_date);
		
		$time_slot_id  =  trim($this->input->post('time_slot_id'));
		if($time_slot_id != '')
		$this->db->where('b.time_slot_id', $time_slot_id);
		
		//$this->db->where('e.mailto_buyer_status !=', '1');
		$this->db->limit($limit,$start);
		//$this->db->order_by("b.date_modified", "desc");
		$this->db->order_by("b.order_id", "desc");
		$this->db->group_by("b.order_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
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
	
	
	public function GetRecordsByOrderId_29_10_2020($order_id) {
		$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('b.*,c.email_id as seller_email,d.name,d.address,d.pincode,d.mobile,d.email');
		$this->db->from("tbl_product as a");		
		$this->db->join('tbl_seller_product_map as e', 'e.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = e.id', 'left');		
		$this->db->join('tbl_delivery_location as f', 'b.delivery_location_id = f.id', 'left');		
		$this->db->join('tbl_time_slot as g', 'b.time_slot_id = g.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = e.seller_id', 'left');
		$this->db->where('b.seller_id', $seller_id);
		//$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_id', $order_id);
		
		//$this->db->limit($limit,$start);
		$this->db->order_by("b.id", "desc");
		//$this->db->group_by("e.product_id");
		//$this->db->group_by("a.seller_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->packet = $this->GetSellerPacketByID($row->packet_map_id);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetRecordsByOrderId($order_id) {
		//$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('sum(b.quantity)as total_quantity,b.*,c.mobile_number,c.email_id as seller_email');
		$this->db->from("tbl_product as a");		
		$this->db->join('tbl_seller_product_map as e', 'e.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = e.id', 'left');		
		$this->db->join('tbl_delivery_location as f', 'b.delivery_location_id = f.id', 'left');		
		$this->db->join('tbl_time_slot as g', 'b.time_slot_id = g.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = e.seller_id', 'left');
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
		//$this->db->where('b.order_status !=', '5');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_id', $order_id);
		
		//$this->db->limit($limit,$start);
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("a.id");
		//$this->db->group_by("e.product_id");
		//$this->db->group_by("a.seller_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->packet = $this->GetSellerPacketByID($row->packet_map_id);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function approveOrderStatus(){
		$product_id  =  trim($this->input->post('product_id'));			
		$order_id  =  trim($this->input->post('order_id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['order_status']=4;
		$this -> db -> where('product_id', $product_id);
		$this -> db -> where('order_id', $order_id);
		$this->db->update('tbl_product_order', $data); 
		//echo $this->db->last_query();
	}
	
	public function sendMailToBuyer(){
		$order_id  =  trim($this->input->post('order_id'));			
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['mailto_buyer_status']=1;
		$this->db->where('order_id', $order_id);
		$this->db->update('tbl_order', $data); 
	}
	
	
	public function rejectOrderStatus(){
		$cart_id  =  trim($this->input->post('cart_id'));		
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['order_status']=5;
		$this -> db -> where('id', $cart_id);
		$this->db->update('tbl_product_order', $data); 
	}
	
	
	
	public function CheckOrderStatusByOrderID($order_id) {
		$this->db->where('order_status', 3);
		$this->db->or_where('order_status', 5);
		$this->db->where('order_id', $order_id);
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
	public function changeViewStatus($order_id){
		$data['view_status']=1;
		$this -> db -> where('order_id', $order_id);
		$this->db->update('tbl_order', $data); 
	}
	
	public function totalUnreadOrder() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$this->db->where('view_status', 0);
		$query = $this->db->get("tbl_order");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
	}
	
	public function GetSellerPacketByID($id) {

		$this->db->select('a.*,b.weight,b.unit,b.mrp,b.id as pocket_id');
		$this->db->from("tbl_seller_packet_map as a");
		$this->db->join('tbl_packet as b', 'b.id = a.packet_id', 'left');
		
		$this->db->where('a.status', 1);		
		$this->db->where('a.id', $id);	
		if($seller_id)
		$this->db->where('a.seller_id', $seller_id);	
		
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