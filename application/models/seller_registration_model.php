<?php
class Seller_Registration_model extends CI_Model {
    
	private $path = 'public/uploads/seller_registration/';
    
	function __construct(){
		parent::__construct();
		$this->load->library('session');		
		$this->load->database();
	}

	
	public function GetRecordsBySeller() {
		$this->db->where('status =', 1);		
		
		if($_SESSION['vendor'] != ''){
			//$this->db->where('display_name', $_SESSION['vendor']);
			//$this->db->or_where('seller_code', $_SESSION['vendor']);
			$this->db->where('seller_code', $_SESSION['vendor']);
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
	
	
	public function GetRecordsBySellerCode($seller_code) {
		$this->db->where('status =', 1);		
		$this->db->where('seller_code', $seller_code);
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
	

	public function vendor_list() {		
		$buyer_id	=	$this->session->userdata('user_id');
		$this->db->select('b.seller_code,b.business_name,a.date_modified');
		$this->db->from("buyer_request as a");
		$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');
		
		$this->db->where('a.buyer_id', $buyer_id);
		$this->db->where('a.request_status', 1);
		$this->db->where('a.status', 1);
		$this->db->where('b.type', 0);
		$this->db->order_by("b.business_name", "ASC");
		$this->db->group_by("b.seller_code");
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
	
	
	public function order_list() {
		$buyer_id	=	$this->session->userdata('user_id');		
		$this->db->select('b.*,e.mailto_buyer_status,e.view_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = f.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		//$this->db->where('c.type', 0);
		//$this->db->where('b.order_status !=', '5');
		//$this->db->limit($limit,$start);
		$this->db->order_by("b.id", "DESC");
		$this->db->group_by("b.order_id");
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
	
	
	public function vendor_listByOrder() {
		$buyer_id	=	$this->session->userdata('user_id');		
		$this->db->select('a.id as product_id,f.seller_id,a.name,a.code,f.price,a.unit,b.id as cart_id, b.quantity,b.date_modified,b.date_created,
		b.order_id,b.order_status,d.name,c.seller_code,c.business_name,d.email,d.address,d.mobile,e.mailto_buyer_status');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = f.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_order as e', 'e.order_id = b.order_id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = f.seller_id', 'left');
		
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('c.type', 1);
		//$this->db->where('b.order_status !=', '5');
		//$this->db->limit($limit,$start);
		$this->db->order_by("c.business_name", "ASC");
		$this->db->group_by("c.seller_code");
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
	
	
	/*public function GetRecordsByOrderId($order_id) {
		$buyer_id = $this->session->userdata('user_id');
			
		$this->db->select('a.id as product_id,e.seller_id,a.name as product_name,a.code,e.price,a.unit,b.id as cart_id, 
		b.quantity,b.date_modified,b.date_created,b.order_id,b.order_status,c.seller_code,c.business_name as seller_business_name,
		c.email_id as seller_email,d.name,d.email,d.address,d.mobile');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = e.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = e.seller_id', 'left');
		
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status !=', 5);
		$this->db->where('b.order_status !=', '1');
		$this->db->where('b.order_status !=', '2');
		$this->db->where('b.order_status !=', '5');
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
	} */
	
	public function GetRecordsByOrderId_09_10_2020($order_id) {
		//$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('b.*,c.mobile_number');
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
			
		$this->db->select('sum(b.quantity)as total_quantity,b.*,c.mobile_number');
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
	
	
	public function saveShopVisitor($seller_record) {		
		$data1 = array(
			'shop_code'=>$seller_record[0]->seller_code,				
			'seller_id'=>$seller_record[0]->id,
			'buyer_id'=>$this->session->userdata('user_id'),
			'date_time'=>date('Y-m-d H:i:s'),
			'ip_address'=>$_SERVER['REMOTE_ADDR']
			);
			$this->db->insert('tbl_shop_visitor',$data1);
	}
	
}