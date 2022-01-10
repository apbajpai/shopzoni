<?php
class Report_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function GetTotalRecordBuyer() {
		$this->db->select('a.*,b.name,b.business_name,b.email,b.address,b.mobile');
		$this->db->from("tbl_login_history as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		if($from_date>0 && $to_date>0){
		$this->db->where('DATE(a.login_date) >=', $from_date);
		$this->db->where('DATE(a.login_date) <=', $to_date);
		}
		
		$this->db->where('a.user_type', 3);		
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }
	
		
	public function GetRecordsBuyer($start=0, $limit=10) {				
			$this->db->select('a.*,b.name,b.business_name,b.email,b.address,b.mobile');
			$this->db->from("tbl_login_history as a");
			$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
			
			$from_date 	= $this->input->post('from_date');
			$to_date 	= $this->input->post('to_date');
			if($from_date>0 && $to_date>0){
			$this->db->where('DATE(a.login_date) >=', $from_date);
			$this->db->where('DATE(a.login_date) <=', $to_date);
			}
			
			$this->db->where('a.user_type', 3);
			$this->db->limit($limit,$start);
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
	
	
	public function GetTotalRecordSeller() {
		$this->db->select('a.*,b.name,b.business_name,b.email_id,b.business_address,b.mobile_number');
		$this->db->from("tbl_login_history as a");
		$this->db->join('tbl_seller_registration as b', 'a.user_id = b.id', 'left');	
		
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		if($from_date>0 && $to_date>0){
		$this->db->where('DATE(a.login_date) >=', $from_date);
		$this->db->where('DATE(a.login_date) <=', $to_date);
		}
		$business_name 	= $this->input->post('business_name');
		if($business_name)
		$this->db->where('b.business_name', $business_name); 
		
		$this->db->where('a.user_id !=', 'NULL'); 
		$this->db->where('a.user_type', 2);		
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {           
			return $query->num_rows();
        }        
		return 0;
    }
	
		
	public function GetRecordsSeller($start=0, $limit=10) {			
			$this->db->select('a.*,b.name,b.business_name,b.email_id,b.business_address,b.mobile_number');
			$this->db->from("tbl_login_history as a");
			$this->db->join('tbl_seller_registration as b', 'a.user_id = b.id', 'left');	
			
			$from_date 	= $this->input->post('from_date');
			$to_date 	= $this->input->post('to_date');
			if($from_date>0 && $to_date>0){
			$this->db->where('DATE(a.login_date) >=', $from_date);
			$this->db->where('DATE(a.login_date) <=', $to_date);
			}
			$email 	= trim($this->input->post('email'));
			if($email)
			$this->db->where('b.email_id', $email);
			$this->db->where('a.user_id !=', 'NULL'); 
			$this->db->where('a.user_type', 2);
			$this->db->limit($limit,$start);
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
	
	
	public function GetTotalRecordShopVisitor() {
		$this->db->select('a.*,b.seller_code,b.business_name,c.name as buyer_name,c.business_name as buyer_business_name,c.email as buyer_email,c.mobile as buyer_mobile');
		$this->db->from("tbl_shop_visitor as a");
		$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');	
		$this->db->join('tbl_user as c', 'a.buyer_id = c.id', 'left');
		
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		if($from_date>0 && $to_date>0){
		$this->db->where('DATE(a.date_time) >=', $from_date);
		$this->db->where('DATE(a.date_time) <=', $to_date);
		}
		
		$this->db->where('a.buyer_id !=', 0);
		$this->db->where('a.buyer_id !=', '');
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }
	
		
	public function GetRecordsShopVisitor($start=0, $limit="") {		
				
			$this->db->select('a.*,b.seller_code,b.business_name,c.name as buyer_name,c.business_name as buyer_business_name,c.email as buyer_email,c.mobile as buyer_mobile');
			$this->db->from("tbl_shop_visitor as a");
			$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');	
			$this->db->join('tbl_user as c', 'a.buyer_id = c.id', 'left');
			
			$from_date 	= $this->input->post('from_date');
			$to_date 	= $this->input->post('to_date');
			$seller_code 	= $this->input->post('seller_code');
			
			if($from_date>0 && $to_date>0){
			$this->db->where('DATE(a.date_time) >=', $from_date);
			$this->db->where('DATE(a.date_time) <=', $to_date);
			}
			
			if($seller_code)
			$this->db->where('b.seller_code', $seller_code);
		
			$this->db->where('a.buyer_id !=', 0);
			$this->db->where('a.buyer_id !=', '');
			if($limit)
			$this->db->limit($limit,$start);
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
	
	
	public function GetTotalRecordOrder() {
		$this->db->select('a.*,b.name,b.business_name,b.email_id,b.business_address,b.mobile_number');
		$this->db->from("tbl_product_order as a");
		$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');
		$this->db->join('tbl_user as c', 'a.buyer_id = c.id', 'left');
		
		$this->db->where('a.status !=', 5);
		$this->db->where('a.order_status !=', '1');
		$this->db->where('a.order_status !=', '2');
		
		$from_date 	= trim($this->input->post('from_date'));
		$to_date 	= trim($this->input->post('to_date'));
		if($from_date>0 && $to_date>0){
		$this->db->where('DATE(a.date_created) >=', $from_date);
		$this->db->where('DATE(a.date_created) <=', $to_date);
		}
		
		$seller_email 	= trim($this->input->post('seller_email'));
		if($seller_email!="")
		$this->db->where('b.email_id', $seller_email);
		
		$buyer_email 	= trim($this->input->post('buyer_email'));
		if($buyer_email!="")
		$this->db->where('c.email', $buyer_email);	
		
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
			
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {            
			return $query->num_rows();
        }        
		return 0;
    }
	
		
	public function GetRecordsOrder($start=0, $limit=10) {				
			$this->db->select('a.*,b.name,b.business_name,b.email_id,b.business_address,b.mobile_number');
			$this->db->from("tbl_product_order as a");
			$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');
			$this->db->join('tbl_user as c', 'a.buyer_id = c.id', 'left');
			
			$this->db->where('a.status !=', 5);
			$this->db->where('a.order_status !=', '1');
			$this->db->where('a.order_status !=', '2');
			
			$from_date 	= trim($this->input->post('from_date'));
			$to_date 	= trim($this->input->post('to_date'));
			if($from_date>0 && $to_date>0){
			$this->db->where('DATE(a.date_created) >=', $from_date);
			$this->db->where('DATE(a.date_created) <=', $to_date);
			}			
			
			$order_id 	= trim($this->input->post('order_id'));
			if($order_id!="")
			$this->db->where('a.order_id', $order_id);
			
			$seller_email 	= trim($this->input->post('seller_email'));
			if($seller_email!="")
			$this->db->where('b.email_id', $seller_email);
			
			$buyer_email 	= trim($this->input->post('buyer_email'));
			if($buyer_email!="")
			$this->db->where('c.email', $buyer_email);
			
			$this->db->limit($limit,$start);
			$this->db->order_by("a.id", "desc");			
			$this->db->group_by("a.order_id");
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
	
	
	public function GetRecordsByOrderId($order_id) {
		//$seller_id = $this->session->userdata('seller_id');
			
		$this->db->select('b.*,c.email_id as seller_email,d.name,d.address,d.pincode');
		$this->db->from("tbl_product as a");		
		$this->db->join('tbl_seller_product_map as e', 'e.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = e.id', 'left');		
		$this->db->join('tbl_delivery_location as f', 'b.delivery_location_id = f.id', 'left');		
		$this->db->join('tbl_time_slot as g', 'b.time_slot_id = g.id', 'left');		
		$this->db->join('tbl_user as d', 'd.id = b.buyer_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = e.seller_id', 'left');
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status !=', 5);
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
	
	
	public function GetTotalRecordBuyerRequest() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->from("buyer_request as a");
		$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
					
		$this->db->where('a.status !=', 5);
		$this->db->where('b.name !=', "");
		$this->db->where('c.id !=', "");
		$query = $this->db->get();			
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecordsBuyerRequest($start=0, $limit=10) {
			$seller_id = $this->session->userdata('seller_id');
			
			$this->db->select('a.*, b.name,b.business_name,b.address,b.email,c.id as seller_id,c.name as seller_name,c.seller_code,c.email_id as seller_email');
			$this->db->from("buyer_request as a");
			$this->db->join('tbl_user as b', 'a.buyer_id  = b.id', 'left');
			$this->db->join('tbl_seller_registration as c', 'a.seller_id = c.id', 'left');		
						
			$this->db->where('a.status !=', 5);
			$this->db->where('b.name !=', "");
			$this->db->where('c.id !=', "");
			$this->db->limit($limit,$start);
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
	
	
	
}