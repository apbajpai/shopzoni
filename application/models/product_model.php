<?php
class Product_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		session_start();
		$this->load->database();
	}	
	
	public function GetTotalRecords($seller_id,$section_id='',$category_ids='',$brand_ids='',$product_name='') {
	
		$this->db->select('a.*,f.quantity,f.quantity_option,b.name as category_name,c.name as parent_name,d.name as sectin_name,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status', 1);
		$this->db->where('f.status', 1);
				
		if($seller_id)
		$this->db->where('f.seller_id', $seller_id);
		if($brand_ids[0]!='')
		$this->db->where_in('a.brand_id', $brand_ids);
		
		if($section_id!='')
		$this->db->where('d.id', $section_id);
		
		if($product_name)
		$this->db->like('a.name',"$product_name");
		
		if($category_ids[0]!=''){
			$this->db->where_in('a.category_id',$category_ids);
		} 
		
		//$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				if($row->quantity_option==1)
				{
					if($row->quantity>0)
						$data[] = $row;
				}else{
					$data[] = $row;
				}
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetTotalRecord($seller_id='',$section_id='',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10,$product_code='') {
		$department	=	$this->input->post('department');
		$this->db->select('a.*,f.id as product_map_id,f.quantity_option,f.quantity,f.offer,f.price,b.name as category_name,c.name as parent_name,d.name as sectin_name,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		//$this->db->join('tbl_brand_department_map as g', 'g.brand_id = e.id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status', 1);
		$this->db->where('f.status', 1);
		//$this->db->where('f.quantity_option !=', 1);
		//$this->db->or_where('f.quantity !=', 0);

		if($seller_id)
		$this->db->where('f.seller_id', $seller_id);
		if($brand_ids[0]!='')
		$this->db->where_in('a.brand_id', $brand_ids);
		
		if($section_id!='')
		$this->db->where('d.id', $section_id);
		
		if($product_name)
		$this->db->like('a.name',"$product_name");
	
		if($product_code)
		$this->db->where('a.code',"$product_code");
		
		if($category_ids[0]!=''){
			$this->db->where_in('a.category_id',$category_ids);
		} 
		
		//if($department[0]!='')
		//$this->db->where_in('g.department_id', $department);
		
		//$this->db->limit($limit,$start);
		$this->db->group_by('a.id');
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		/*echo "<!---";
		echo $this->db->last_query();
		echo "---->";   */

		
        $data = array();
		if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	
	
	public function GetRecords($seller_id='',$section_id='',$category_ids='',$brand_ids='',$product_name='',$start=0, $limit=10,$product_code='') {
		$department	=	$this->input->post('department');
		$this->db->select('a.*,f.id as product_map_id,f.quantity_option,f.quantity,f.offer,f.price,b.name as category_name,c.name as parent_name,d.name as sectin_name,e.name as brand_name, e.slug as brand_slug');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		//$this->db->join('tbl_brand_department_map as g', 'g.brand_id = e.id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status', 1);
		$this->db->where('f.status', 1);
		

		//$this->db->where('f.quantity_option !=', 1);
		//$this->db->or_where('f.quantity !=', 0);

		if($seller_id)
		$this->db->where('f.seller_id', $seller_id);
		if($brand_ids[0]!='')
		$this->db->where_in('a.brand_id', $brand_ids);
		
		if($section_id!='')
		$this->db->where('d.id', $section_id);
		
		if($product_name)
		$this->db->like('a.name',"$product_name");
	
		if($product_code)
		$this->db->where('a.code',"$product_code");
		
		if($category_ids[0]!=''){
			$this->db->where_in('a.category_id',$category_ids);
		} 
		
		//if($department[0]!='')
		//$this->db->where_in('g.department_id', $department);
		
		$this->db->limit($limit,$start);
		$this->db->group_by('a.id');
		//$this->db->group_by('f.id');
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		/*echo "<!---";
		echo $this->db->last_query();
		echo "---->"; */ 
		
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$row->packet = $this->GetPacketBySellerProductID($seller_id,$row->id);
				if($row->packet[0]->id!=""){
					if($row->packet[0]->quantity_option==1)
					{
						if($row->packet[0]->quantity>0)						
							$data[] = $row;					
					}else{					
						$data[] = $row;
					}
					//$data[] = $row;					
				}else{				
					if($row->quantity_option==1)
					{
						if($row->quantity>0)						
							$data[] = $row;					
					}else{					
						$data[] = $row;
					}
				}
            }
            return $data;
        }
        return false;
    }	
	
	
	public function addtocart() {
		
		$product_map_id				=	$this->input->post('product_id');
		$packet_map_id				=	$this->input->post('packet_map_id');
		$seller_product_map_data 	= 	$this->GetRecordsBySellerMapId($product_map_id);		
		$product_id 				= 	$seller_product_map_data->product_id;
		$quantity					=	$this->input->post('quantity');
		$seller_id					=	$this->input->post('seller_id'); 		
		$buyer_id					=	$this->session->userdata('user_id');
		
		if($quantity>0){
		$data = array(					
					'quantity'=>$quantity,					
					'product_id'=>$product_id,					
					'product_map_id'=>$product_map_id,					
					'packet_map_id'=>$packet_map_id,					
					'seller_id'=>$seller_id,					
					'buyer_id'=>$buyer_id,					
					'order_status'=>'1',					
					'status'=>'1'
				);		
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_product_order',$data); 
			//echo $this->db->last_query();
		return true;
		}else{
		return false;
		}
	}
	
	
	public function getProductRecordById($id){
		
		$this->db->select('a.*,b.id as product_map_id,b.quantity,minimum_quantity_alert,quantity_option,price,offer,offer_code');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');		
		$this->db->where('b.id', $id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				//$row->packet = $this->GetPacketBySellerProductID($seller_id,$row->id);
				$data = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function getProductRecordByIdNew($id,$seller_id){		
		$this->db->select('a.*,b.id as product_map_id,b.seller_id,b.quantity,minimum_quantity_alert,quantity_option,price,offer,offer_code');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');		
		$this->db->where('b.id', $id);
		$this->db->where('b.seller_id', $seller_id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				//$row->packet = $this->GetPacketBySellerProductID($seller_id,$row->id);
				$data = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function getCartRecordSellerB2B(){		
		$buyer_id	=	$this->session->userdata('user_id');		
		$this->db->select('a.id as product_id,c.id as seller_id,c.seller_code,c.name,c.business_name,c.type');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as d', 'd.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = d.id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('c.type', 'B2B');
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("b.seller_id");
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
	
	
	public function getCartRecordSeller(){		
		$buyer_id	=	$this->session->userdata('user_id');		
		$this->db->select('a.id as product_id,c.id as seller_id,c.seller_code,c.name,c.business_name,c.type,c.minimum_order_amount');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as d', 'd.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = d.id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("b.seller_id");
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
	
	
	public function getCartRecordSellerB2C(){		
		$buyer_id	=	$this->session->userdata('user_id');		
		$this->db->select('a.id as product_id,c.id as seller_id,c.seller_code,c.name,c.business_name,c.type');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as d', 'd.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = d.id', 'left');
		
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('c.type', 'B2C');
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("b.seller_id");
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
	
	
	public function getCartRecord_new(){
		//$seller_id	=	$_SESSION['seller_id']; 
		$buyer_id	=	$this->session->userdata('user_id');
		
		$this->db->select('a.id as product_id,c.seller_id,a.name,c.price,a.unit,a.weight,a.code,b.id as cart_id, b.quantity,b.packet_map_id,d.price as packet_price,d.quantity as packet_quantity,d.minimum_quantity_alert as packet_minimum_quantity_alert,d.quantity_option as packet_quantity_option,e.weight as packet_weight,e.unit as packet_unit,e.mrp as packet_mrp');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as c', 'c.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = c.id', 'left');
		$this->db->join('tbl_seller_packet_map as d', 'b.packet_map_id = d.id', 'left');
		$this->db->join('tbl_packet as e', 'd.packet_id = e.id', 'left');
		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				//$row->packet = $this->GetPacketByProductID($seller_id,$row->id);
				$data[$row->seller_id][] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	public function getCartRecord(){
		//$seller_id	=	$_SESSION['seller_id']; 
		$buyer_id	=	$this->session->userdata('user_id');
		
		$this->db->select('sum(b.quantity)as quantity,a.id as product_id,c.seller_id,a.name,c.price,a.unit,a.weight,a.code,b.id as cart_id,b.packet_map_id,d.price as packet_price,d.quantity as packet_quantity,d.minimum_quantity_alert as packet_minimum_quantity_alert,d.quantity_option as packet_quantity_option,e.weight as packet_weight,e.unit as packet_unit,e.mrp as packet_mrp');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as c', 'c.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = c.id', 'left');
		$this->db->join('tbl_seller_packet_map as d', 'b.packet_map_id = d.id', 'left');
		$this->db->join('tbl_packet as e', 'd.packet_id = e.id', 'left');
		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$this->db->group_by("a.id");
		$this->db->group_by("d.id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				//$row->packet = $this->GetPacketByProductID($seller_id,$row->id);
				$data[$row->seller_id][] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function GetTotalCartRecordByBuyer() {

		$buyer_id	=	$this->session->userdata('user_id');
		
		$this->db->select('a.id as product_id,c.seller_id,a.name,c.price,a.unit,a.weight,b.id as cart_id, b.quantity,b.packet_map_id,d.price as packet_price,d.quantity as packet_quantity,d.minimum_quantity_alert as packet_minimum_quantity_alert,d.quantity_option as packet_quantity_option,e.weight as packet_weight,e.unit as packet_unit,e.mrp as packet_mrp');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as c', 'c.product_id = a.id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = c.id', 'left');
		$this->db->join('tbl_seller_packet_map as d', 'b.packet_map_id = d.id', 'left');
		$this->db->join('tbl_packet as e', 'd.packet_id = e.id', 'left');
		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.buyer_id', $buyer_id);
		$this->db->where('b.status', '1');
		$this->db->where('b.order_status', '1');
		$this->db->order_by("b.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {           
            return $query->num_rows();
        }
        return 0;
    }
	
	
	public function removetocart(){
		$cart_id	=	$this->input->post('cart_id');
		$cart_data = $this->GetProductOrderById($cart_id);
		$data['date_modified']=date('Y-m-d H:i:s');
		$data['order_status']=2;
		//$this -> db -> where('id', $cart_id);
		$this -> db -> where('seller_id', $cart_data->seller_id);
		$this -> db -> where('buyer_id', $cart_data->buyer_id);
		$this -> db -> where('product_id', $cart_data->product_id);
		$this -> db -> where('product_map_id', $cart_data->product_map_id);
		$this -> db -> where('packet_map_id', $cart_data->packet_map_id);
		$this->db->update('tbl_product_order', $data); 
		//echo $this->db->last_query();
	}
	
	public function place_order(){
		//$cart_ids	=	$this->input->post('cart_ids');
		$buyer_id		=	$this->session->userdata('user_id');
		$seller_id	=	$this->input->post('seller_id');  
		$cart_deta = $this->product_model->getCartRecordSellerBuyer($seller_id,$buyer_id);	
	
		foreach($cart_deta as $crtkey=>$crt_record){
			$cart_ids[] = $crt_record->id;
		}		
		
		$insufficient = 1;
		foreach($cart_ids as $cart_id){			 
			
			$record = $this->getProductAndOrderRecord($cart_id);
			
			if($record->packet_map_id>0){
				$record = $this->getProductAndOrderRecordPacketWise($cart_id);
				$avl_quantity = $record->product_quantity-$record->order_quantity;
				if($record->quantity_option==1){
					if($avl_quantity>=0){
						$order_genrated_status = 0;
						if($order_id==""){
							$order_id	=	$this->generateOrderId($cart_id);
							$order_genrated_status = 1;
						} 
						if($order_id!=""){
							//$data['date_created']=date('Y-m-d H:i:s');
							$data['order_status']=3;
							$data['order_id']=$order_id;
							$this -> db -> where('id', $cart_id);
							$this->db->update('tbl_product_order', $data);
							
							$data4['quantity'] = $avl_quantity;
							if($avl_quantity==0 && $record->seller_product_status !=5){
								$data4['status'] = 0;
							}
							$this->db-> where('id', $record->packet_map_id);
							$this->db->update('tbl_seller_packet_map', $data4);
							
							if($avl_quantity<$record->minimum_quantity_alert){
								$data3['quantity_alert'] = 1;
								$data3['quantity_option'] = '1';
								$this->db-> where('id', $record->seller_map_id);
								$this->db->update('tbl_seller_product_map', $data3);
								//echo $this->db->last_query(); 
							}							
							
							if($order_genrated_status==1){
								$data2 = array('order_id'	=>	$order_id,
												'seller_id' =>  $record->seller_id);				
								$this->db->insert('tbl_order',$data2);
							}
						}
					}else{
						//$return_data[]
						$insufficient = 0;
						//return 0;
					}
				}else{
					$order_genrated_status = 0;
					if($order_id==""){
						$order_id	=	$this->generateOrderId($cart_id);
						$order_genrated_status = 1;
					}
					if($order_id!=""){
						//$data['date_created']=date('Y-m-d H:i:s');
						$data['order_status']=3;
						$data['order_id']=$order_id;
						$this -> db -> where('id', $cart_id);
						$this->db->update('tbl_product_order', $data);
						
						$data4['quantity'] = $avl_quantity;
						$this->db-> where('id', $record->packet_map_id);
						$this->db->update('tbl_seller_packet_map', $data4);
						
						if($order_genrated_status==1){
							$data2 = array('order_id'	=>	$order_id,
											'seller_id' =>  $record->seller_id);				
							$this->db->insert('tbl_order',$data2);
						}
					}
				}				
			}else{			
				$avl_quantity = $record->product_quantity-$record->order_quantity;
				if($record->quantity_option==1){
					if($avl_quantity>=0){
						$order_genrated_status = 0;
						if($order_id==""){
							$order_id	=	$this->generateOrderId($cart_id);
							$order_genrated_status = 1;
						} 
						if($order_id!=""){
							//$data['date_created']=date('Y-m-d H:i:s');
							$data['order_status']=3;
							$data['order_id']=$order_id;
							$this -> db -> where('id', $cart_id);
							$this->db->update('tbl_product_order', $data);
							
							$data1['quantity'] = $avl_quantity;
							if($avl_quantity==0 && $record->seller_product_status !=5){
								$data1['status'] = 0;
							}
							if($avl_quantity<$record->minimum_quantity_alert){
								$data1['quantity_alert'] = 1;								
							}
							$this->db-> where('id', $record->seller_map_id);
							$this->db->update('tbl_seller_product_map', $data1);
							if($order_genrated_status==1){
								$data2 = array('order_id'	=>	$order_id,
												'seller_id' =>  $record->seller_id);				
								$this->db->insert('tbl_order',$data2);
							}
						}
					}else{
						//$return_data[]
						$insufficient = 0;
						//return 0;
					}
				}else{
					$order_genrated_status = 0;
					if($order_id==""){
						$order_id	=	$this->generateOrderId($cart_id);
						$order_genrated_status = 1;
					}
					if($order_id!=""){
						//$data['date_created']=date('Y-m-d H:i:s');
						$data['order_status']=3;
						$data['order_id']=$order_id;
						$this -> db -> where('id', $cart_id);
						$this->db->update('tbl_product_order', $data);
						
						$data1['quantity'] = $avl_quantity;
						$this -> db -> where('product_id', $record->product_id);
						$this->db->update('tbl_seller_product_map', $data1);
						
						if($order_genrated_status==1){
							$data2 = array('order_id'	=>	$order_id,
											'seller_id' =>  $record->seller_id);				
							$this->db->insert('tbl_order',$data2);
						}
					}
				}
				//$oreder[]=$order_id;
				//echo $this->db->last_query();			
			}
		}
		return $order_id.'###'.$insufficient;		
	}
	
	
	public function b2c_place_order(){
		$error_message = "";
		//$cart_ids				=	$this->input->post('cart_ids');
		$buyer_id		=	$this->session->userdata('user_id');
		$seller_id	=	$this->input->post('seller_id');  
		$cart_deta = $this->product_model->getCartRecordSellerBuyer($seller_id,$buyer_id);	
	
		foreach($cart_deta as $crtkey=>$crt_record){
			$cart_ids[] = $crt_record->id;
		}
		
		$delivery_location_id	=	$this->input->post('delivery_location_id');
		$time_slot_id			=	$this->input->post('time_slot_id'); 
		$grand_total			=	$this->input->post('grand_total'); 
		$delivery_type			=	$this->input->post('delivery_type');  		
		$shipping_charge		=	$this->input->post('shipping_charge');
		$quantity				=	$this->input->post('quantity'); 
		$delivery_date			=	$nice_date = date('Y-m-d', strtotime( $this->input->post('delivery_date') ));		
		
		$is_different		=	$this->input->post('is_different');
		
		$billing_name		=	$this->input->post('billing_name');  
		$billing_mobile		=	$this->input->post('billing_mobile');  
		$billing_email		=	$this->input->post('billing_email');  
		$billing_address	=	$this->input->post('billing_address');  
		$billing_pincode	=	$this->input->post('billing_pincode');  
		
		if($is_different=="yes"){
			$delivery_name		=	$this->input->post('delivery_name');  
			$delivery_mobile	=	$this->input->post('delivery_mobile');  
			$delivery_email		=	$this->input->post('delivery_email');  
			$delivery_address	=	$this->input->post('delivery_address');  
			$delivery_pincode	=	$this->input->post('delivery_pincode');
		}else{
			$delivery_name		=	$this->input->post('billing_name');  
			$delivery_mobile	=	$this->input->post('billing_mobile');  
			$delivery_email		=	$this->input->post('billing_email');  
			$delivery_address	=	$this->input->post('billing_address');  
			$delivery_pincode	=	$this->input->post('billing_pincode');
		}
		
		$time_slot_record = $this->GetTimeSloteById($time_slot_id);		
		$total_delivery_date_wise_order	=	$this->GetTimeSlotAndDeliveryDateWiseOrderCounter($time_slot_id,$delivery_date); 
		
		/*echo "<pre>";
		print_r($cart_ids);
		echo "</pre>"; exit; */
		
		$insufficient = 1;
		if($time_slot_record->maximum_no_of_order>$total_delivery_date_wise_order->counter){
			foreach($cart_ids as $cart_id){	
				$record = $this->getProductAndOrderRecord($cart_id);
				
				//$record = $this->getProductAndOrderRecordPacketWise($cart_id);
				$seller_record	=	$this->GetSellerRecordById($record->seller_id);
				if($seller_record->minimum_order_amount>0){
					$minimum_order_amount	=	$seller_record->minimum_order_amount;
					if($grand_total>=$minimum_order_amount){
						$minimum_order_amount_status = 1;
					}else{
						$minimum_order_amount_status = 0;
						$error_message = "Minimum Order Amount - ".$minimum_order_amount;
					}
				}else{
					$minimum_order_amount_status = 1;
				}
				
				if($minimum_order_amount_status==1){
				
				
				if($record->packet_map_id>0){
					$record = $this->getProductAndOrderRecordPacketWise($cart_id);
				
					$avl_quantity = $record->product_quantity-$quantity[$cart_id];
					
					if($record->quantity_option==1){
						if($avl_quantity>=0){
							$order_genrated_status = 0;
							if($order_id==""){
								$order_id	=	$this->generateOrderId($cart_id);
								$order_genrated_status = 1;
							} 
							if($order_id!=""){
								
								$data['date_modified']			=	date('Y-m-d H:i:s');
								$data['order_status']			=	3;
								$data['order_id']				=	$order_id;
								$data['delivery_location_id']	=	$delivery_location_id;
								$data['time_slot_id']			=	$time_slot_id;
								$data['grand_total']			=	$grand_total;
								$data['delivery_date']			=	$delivery_date;
								$data['shipping_charge']		=	$shipping_charge;
								$data['delivery_type']			=	$delivery_type;
								$data['is_different']			=	$is_different;
								$data['billing_name']			=	$billing_name;
								$data['billing_mobile']			=	$billing_mobile;
								$data['billing_email']			=	$billing_email;
								$data['billing_address']		=	$billing_address;
								$data['billing_pincode']		=	$billing_pincode;
								$data['delivery_name']			=	$delivery_name;
								$data['delivery_mobile']		=	$delivery_mobile;
								$data['delivery_email']			=	$delivery_email;
								$data['delivery_address']		=	$delivery_address;
								$data['delivery_pincode']		=	$delivery_pincode;
								$data['quantity']				=	$quantity[$cart_id];
								
								$this -> db -> where('id', $cart_id);
								$this->db->update('tbl_product_order', $data);
								//echo $this->db->last_query(); exit;
								
								$data4['quantity'] = $avl_quantity;
								if($avl_quantity==0 && $record->seller_product_status !=5){
									$data4['status'] = 0;
								}
								$this->db-> where('id', $record->packet_map_id);
								$this->db->update('tbl_seller_packet_map', $data4);
								
								if($avl_quantity<$record->minimum_quantity_alert){
									$data3['quantity_alert'] = 1;
									$data3['quantity_option'] = '1';
									$this->db-> where('id', $record->seller_map_id);
									$this->db->update('tbl_seller_product_map', $data3);
									//echo $this->db->last_query();  exit;
								}							
								
								if($order_genrated_status==1){
									$data2 = array('order_id'	=>	$order_id,
													'seller_id' =>  $record->seller_id);				
									$this->db->insert('tbl_order',$data2);
								}
							}
						}else{
							//$return_data[]
							$insufficient = 0;
							//return 0;
						}
					}else{
						$order_genrated_status = 0;
						if($order_id==""){
							$order_id	=	$this->generateOrderId($cart_id);
							$order_genrated_status = 1;
						}
						if($order_id!=""){
							
							$data['date_modified']			=	date('Y-m-d H:i:s');
							$data['order_status']			=	3;
							$data['order_id']				=	$order_id;
							$data['delivery_location_id']	=	$delivery_location_id;
							$data['time_slot_id']			=	$time_slot_id;
							$data['grand_total']			=	$grand_total;
							$data['delivery_date']			=	$delivery_date;
							$data['shipping_charge']		=	$shipping_charge;
							$data['delivery_type']			=	$delivery_type;
							$data['is_different']			=	$is_different;
							$data['billing_name']			=	$billing_name;
							$data['billing_mobile']			=	$billing_mobile;
							$data['billing_email']			=	$billing_email;
							$data['billing_address']		=	$billing_address;
							$data['billing_pincode']		=	$billing_pincode;
							$data['delivery_name']			=	$delivery_name;
							$data['delivery_mobile']		=	$delivery_mobile;
							$data['delivery_email']			=	$delivery_email;
							$data['delivery_address']		=	$delivery_address;
							$data['delivery_pincode']		=	$delivery_pincode;
							$data['quantity']				=	$quantity[$cart_id];
							
							$this -> db -> where('id', $cart_id);
							$this->db->update('tbl_product_order', $data);
							
							$data4['quantity'] = $avl_quantity;
							$this->db-> where('id', $record->packet_map_id);
							$this->db->update('tbl_seller_packet_map', $data4);
							
							if($order_genrated_status==1){
								$data2 = array('order_id'	=>	$order_id,
												'seller_id' =>  $record->seller_id);				
								$this->db->insert('tbl_order',$data2);
							}
						}
					}				
				}else{					
					//$avl_quantity = $record->product_quantity-$record->order_quantity;
					$avl_quantity = $record->product_quantity-$quantity[$cart_id];
					if($record->quantity_option==1){
						if($avl_quantity>=0){
							$order_genrated_status = 0;
							if($order_id==""){
								$order_id	=	$this->generateOrderId($cart_id);
								$order_genrated_status = 1;
							} 
							
							if($order_id!=""){
								$data['date_modified']			=	date('Y-m-d H:i:s');
								$data['order_status']			=	3;
								$data['order_id']				=	$order_id;
								$data['delivery_location_id']	=	$delivery_location_id;
								$data['time_slot_id']			=	$time_slot_id;
								$data['grand_total']			=	$grand_total;
								$data['delivery_date']			=	$delivery_date;
								$data['shipping_charge']		=	$shipping_charge;
								$data['delivery_type']			=	$delivery_type;
								$data['is_different']			=	$is_different;
								$data['billing_name']			=	$billing_name;
								$data['billing_mobile']			=	$billing_mobile;
								$data['billing_email']			=	$billing_email;
								$data['billing_address']		=	$billing_address;
								$data['billing_pincode']		=	$billing_pincode;
								$data['delivery_name']			=	$delivery_name;
								$data['delivery_mobile']		=	$delivery_mobile;
								$data['delivery_email']			=	$delivery_email;
								$data['delivery_address']		=	$delivery_address;
								$data['delivery_pincode']		=	$delivery_pincode;
								$data['quantity']				=	$quantity[$cart_id];
								
								$this -> db -> where('id', $cart_id);
								$this->db->update('tbl_product_order', $data);
								//echo $this->db->last_query(); exit;
								
								$data1['quantity'] = $avl_quantity;
								if($avl_quantity==0 && $record->seller_product_status !=5){
									$data1['status'] = 0;
								}
								if($avl_quantity<$record->minimum_quantity_alert){
									$data1['quantity_alert'] = 1;
								}							
								
								$this->db-> where('id', $record->seller_map_id);
								$this->db->update('tbl_seller_product_map', $data1);
								//echo $this->db->last_query();		
								if($order_genrated_status==1){
									$data2 = array('order_id'	=>	$order_id,
													'seller_id' =>  $record->seller_id);				
									$this->db->insert('tbl_order',$data2);
								}
							}
						}else{
							//$return_data[]
							$insufficient = 0;
							//return 0;
						}
					}else{
						$order_genrated_status = 0;
						if($order_id==""){
							$order_id	=	$this->generateOrderId($cart_id);
							$order_genrated_status = 1;
						}
						if($order_id!=""){
							$data['date_modified']			=   date('Y-m-d H:i:s');
							$data['order_status']			=   3;
							$data['order_id']				=   $order_id;
							$data['delivery_location_id']	=   $delivery_location_id;
							$data['time_slot_id']			=   $time_slot_id;
							$data['grand_total']			=   $grand_total;
							$data['delivery_date']			=   $delivery_date;
							$data['shipping_charge']		=   $shipping_charge;
							$data['delivery_type']			=   $delivery_type;
							$data['is_different']			=	$is_different;
							$data['billing_name']			=	$billing_name;
							$data['billing_mobile']			=	$billing_mobile;
							$data['billing_email']			=	$billing_email;
							$data['billing_address']		=	$billing_address;
							$data['billing_pincode']		=	$billing_pincode;
							$data['delivery_name']			=	$delivery_name;
							$data['delivery_mobile']		=	$delivery_mobile;
							$data['delivery_email']			=	$delivery_email;
							$data['delivery_address']		=	$delivery_address;
							$data['delivery_pincode']		=	$delivery_pincode;
							$data['quantity']				=	$quantity[$cart_id];
							$this -> db -> where('id', $cart_id);
							$this->db->update('tbl_product_order', $data);	
							//echo $this->db->last_query(); exit;
							
							$data1['quantity'] = $avl_quantity;
							$this -> db -> where('product_id', $record->product_id);
							$this->db->update('tbl_seller_product_map', $data1);
							
							if($order_genrated_status==1){
								$data2 = array('order_id'	=>	$order_id,
												'seller_id' =>  $record->seller_id);				
								$this->db->insert('tbl_order',$data2);
							}
						}
					}
				}
				//$oreder[]=$order_id;
				//echo $this->db->last_query(); exit;			
			}
			}
			
		}else{
			$error_message = "Maximum Number Of Order Limit Exceed";
		}
			
		return $order_id.'###'.$insufficient.'###'.$error_message;		
	}
	
	
	public function getProductAndOrderRecord($cart_id){
		$this->db->select('a.id as product_id,c.id as seller_map_id,c.quantity as product_quantity,c.quantity_option,c.status as seller_product_status,
		c.minimum_quantity_alert,b.quantity as order_quantity,b.status,b.order_status,b.seller_id,b.buyer_id,b.order_id,b.packet_map_id');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as c', 'a.id = c.product_id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = c.id', 'left');
		
		$this->db->where('b.id', $cart_id);
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
	
	public function getProductAndOrderRecordPacketWise($cart_id){
		$this->db->select('a.id as product_id,c.id as seller_map_id,d.quantity as product_quantity,d.quantity_option,d.status as seller_product_status,
		d.minimum_quantity_alert,b.quantity as order_quantity,b.status,b.order_status,b.seller_id,b.buyer_id,b.order_id,b.packet_map_id');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as c', 'a.id = c.product_id', 'left');
		$this->db->join('tbl_product_order as b', 'b.product_map_id = c.id', 'left');
		$this->db->join('tbl_seller_packet_map as d', 'd.id = b.packet_map_id', 'left');
		
		$this->db->where('b.id', $cart_id);
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
	
	
	
	public function generateOrderId($id){
		$this->db->where('id', $id);
		$query = $this->db->get("tbl_product_order");		
			
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$order_row = $this->GetMaxOrderCounter($row->seller_id); 		
				$max_order_id = $order_row->counter;
				
				if($row->order_id==""){
					$code1 = date("y");
					$code2 = str_pad($row->seller_id, 5, '0', STR_PAD_LEFT);
					$code3 = str_pad($max_order_id+1, 5, '0', STR_PAD_LEFT);				
					$order_id = $code1.$code2.$code3;
				}else{
					$order_id="";
				}
            }
            return $order_id;
        }
        return false;
	}
	
	public function GetMaxOrderCounter($seller_id) {  
		$this->db->select('id, count(*) as counter');
		$this->db->where('seller_id', $seller_id);	
		$query = $this->db->get("tbl_order");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function GetMaxOrderId($seller_id) {    
		$this->db->select_max('id');
		$query = $this->db->get("tbl_order");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }

	public function GetSellerRecordById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_seller_registration");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	
	public function GetBuyerRecordById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
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
	
	
	public function GetTimeSlotAndDeliveryDateWiseOrderCounter($time_slot_id,$delivery_date) {  
		$this->db->select('id, count(*) as counter');
		$this->db->where('time_slot_id', $time_slot_id);	
		$this->db->where('DATE(delivery_date)', date("Y-m-d", strtotime($delivery_date)));	
		$this->db->group_by("order_id");
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$row->counter = $query->num_rows();
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	
	public function getRecordById($product_id){
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->where('a.id', $product_id);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
							$data = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function GetImageByProductID($product_id) {
		$this->db->where('status', 1);		
		$this->db->where('product_id', $product_id);	
        $query = $this->db->get("tbl_image");	
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
	
	public function GetBradWiseProductold($brand_id) {
		$this->db->where('status', 1);		
		$this->db->where('brand_id', $brand_id);	
        $query = $this->db->get("tbl_product");	
		//echo $this->db->last_query(); 
        $data = array();
			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetBradWiseProduct($brand_id,$start='',$limit='') {		
		$this->db->select('distinct(c.id) as seller_id ,c.seller_code,a.*');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');		
		
		$this->db->where('a.status', '1');
		$this->db->where('b.status', '1');
		$this->db->where('a.brand_id', $brand_id);
		$this->db->group_by('a.id');
		if($limit)		
		$this->db->limit($limit,$start);
		$this->db->order_by("c.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	function GetStateRecord()
	{
		$this->db->order_by('state_name ASC');		
		$query = $this->db->get("tbl_state_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function GetCityRecord()
	{
		$this->db->order_by('district_name ASC');		
		$query = $this->db->get("tbl_district_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	function GetPincodeRecord()
	{
		$this->db->order_by('pincode ASC');		
		$query = $this->db->get("tbl_pincode_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetStateCity($state_id) {
		//$state_record = $this->getStateID($state);
		//$state_id = $state_record->id;
		$this->db->where('state_id', $state_id);
		$query = $this->db->get("tbl_district_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetPincodeByCity($city_id) {
		$this->db->where('district_id', $city_id);
		$query = $this->db->get("tbl_pincode_master");
		
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function getProductByBrandID($brand_id){
		$state		= trim($this->input->post('state'));	
		$city		= trim($this->input->post('city'));	
		$pincode	= trim($this->input->post('pincode'));	
		
		$state_id	=	$this->GetStateIDByState($state);
		$city_id	=	$this->GetCityIDByCity($city);
		$pincode_id	=	$this->GetPincodeIDByPincode($pincode);
		
		$this->db->select('distinct(a.id) as product_id ,c.*,a.name as product_name,a.code as product_code,a.id as product_id');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('a.status', '1');
		$this->db->where('b.status', '1');
		$this->db->where('a.brand_id', $brand_id);
		if($state_id)
		$this->db->where('c.state_id', $state_id);
		if($city_id)
		$this->db->like('c.city_id', $city_id);
		if($pincode_id)
		$this->db->where('c.pincode_id', $pincode_id);
		//$this->db->where('c.type', 1);
		$this->db->order_by("c.id", "desc");
		$this->db->group_by("a.id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->product_id);
				$data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	public function getSellerByBrandID($brand_id){
		$state		= trim($this->input->post('state'));	
		$city		= trim($this->input->post('city'));	
		$pincode	= trim($this->input->post('pincode'));	
		
		$state_id	=	$this->GetStateIDByState($state);
		$city_id	=	$this->GetCityIDByCity($city);
		$pincode_id	=	$this->GetPincodeIDByPincode($pincode);
		
		$this->db->select('distinct(c.id) as seller_id ,c.*');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status', '1');
		$this->db->where('a.brand_id', $brand_id);
		if($state_id)
		$this->db->where('c.state_id', $state_id);
		if($city_id)
		$this->db->like('c.city_id', $city_id);
		if($pincode_id)
		$this->db->where('c.pincode_id', $pincode_id);
		$this->db->where('c.type', 1);
		$this->db->order_by("c.id", "desc");
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
	
	
	public function getSellerByProductCode($code){
		$state		= trim($this->input->post('state'));	
		$city		= trim($this->input->post('city'));	
		$pincode	= trim($this->input->post('pincode'));	
		$packet_id	= trim($this->input->post('packet_id'));	
		$product_id	= trim($this->input->post('product_id'));	
		
		$state_id	=	$this->GetStateIDByState($state);
		$city_id	=	$this->GetCityIDByCity($city);
		$pincode_id	=	$this->GetPincodeIDByPincode($pincode);
		if($packet_id)
		$this->db->select('distinct(c.id) as seller_id ,c.*,b.price,b.offer,b.id as product_map_id');
		else
		$this->db->select('distinct(c.id) as seller_id ,c.*,b.price,b.offer,b.id as product_map_id');	
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_seller_product_map as b', 'b.product_id = a.id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = b.seller_id', 'left');		
		//$this->db->join('tbl_seller_packet_map as d', 'd.seller_id = b.seller_id', 'left');		
		
		
		//$this->db->where('b.seller_id', $seller_id);
		$this->db->where('b.status', '1');
		//$this->db->where('d.status', '1');
		$this->db->where('c.type', '1');
		$this->db->where('a.code', $code);
		if($state_id)
		$this->db->where('c.state_id', $state_id);
		if($city_id)
		$this->db->like('c.city_id', $city_id);
		if($pincode_id)
		$this->db->where('c.pincode_id', $pincode_id);
	
		/*if($packet_id)
		$this->db->where('d.packet_id', $packet_id);
		if($product_id)
		$this->db->where('d.product_id', $product_id); */
	
		$this->db->order_by("c.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->delivery_locations = $this->GetDeliveryLocation($row->seller_id);				
				$data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	
	public function getSellerByProductPacketCode($code){
		$state		= trim($this->input->post('state'));	
		$city		= trim($this->input->post('city'));	
		$pincode	= trim($this->input->post('pincode'));	
		$packet_id	= trim($this->input->post('packet_id'));	
		$product_id	= trim($this->input->post('product_id'));	
		
		$state_id	=	$this->GetStateIDByState($state);
		$city_id	=	$this->GetCityIDByCity($city);
		$pincode_id	=	$this->GetPincodeIDByPincode($pincode);
		
		if($packet_id)
		$this->db->select('distinct(c.id) as seller_id ,c.*,d.price as packet_price,d.product_id,d.id as packet_map_id');
		else
		$this->db->select('distinct(c.id) as seller_id ,c.*,d.id as packet_map_id');	
		$this->db->from("tbl_product as a");
		
		$this->db->join('tbl_seller_packet_map as d', 'd.product_id = a.id', 'left');	
		//$this->db->join('tbl_seller_product_map as b', 'b.product_id = d.product_id', 'left');
		$this->db->join('tbl_seller_registration as c', 'c.id = d.seller_id', 'left');		
			
		
		//$this->db->where('b.seller_id', $seller_id);
		//$this->db->where('b.status', '1');
		$this->db->where('d.status', '1');
		$this->db->where('c.type', '1');
		$this->db->where('a.code', $code);
		if($state_id)
		$this->db->where('c.state_id', $state_id);
		if($city_id)
		$this->db->like('c.city_id', $city_id);
		if($pincode_id)
		$this->db->where('c.pincode_id', $pincode_id);
		if($packet_id)
		$this->db->where('d.packet_id', $packet_id);
		if($product_id)
		$this->db->where('d.product_id', $product_id);
	
		$this->db->order_by("c.id", "desc");
		$this->db->group_by('c.id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->delivery_locations = $this->GetDeliveryLocation($row->seller_id);				
				$row->seller_map_record = $this->GetSellerMapRecordsBySellerAndProductId($row->seller_id,$row->product_id);	
				if($row->seller_map_record->id!="")
				$data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	public function getPartnerByBrandID($brand_id){
		$state		= trim($this->input->post('state'));	
		$city		= trim($this->input->post('city'));	
		$pincode	= trim($this->input->post('pincode'));
		
		$state_id = $this->GetStateIDByState($state);
		$city_id = $this->GetCityIDByCity($city);
		$pincode_id = $this->GetPincodeIDByPincode($pincode);		
		
		$this->db->select('distinct(brand_id),id,name,address,type,email');		
		
		$this->db->where('status', '1');
		$this->db->where('brand_id', $brand_id);
		if($state_id)
		$this->db->where('state_id', $state_id);
		if($city_id)
		$this->db->where('city_id', $city_id);
		if($pincode_id)
		$this->db->where('pincode_id', $pincode_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('tbl_partner');
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
	
	function GetStateIDByState($state)
	{
		$this->db->where('state_name', $state);
		$query = $this->db->get("tbl_state_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row->id;
			}
			return $data;
		}
		return false;
	}
	
	function GetCityIDByCity($city)
	{
		$this->db->where('district_name', $city);
		$query = $this->db->get("tbl_district_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row->id;
			}
			return $data;
		}
		return false;
	}
	
	function GetPincodeIDByPincode($pincode)
	{
		$this->db->where('pincode', $pincode);
		$query = $this->db->get("tbl_pincode_master");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row->id;
			}
			return $data;
		}
		return false;
	}
	
	public function GetDeliveryLocation($seller_id="") {
		//$seller_id	=	$_SESSION['seller_id']; 
		$this->db->where('status =', 1);		
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_delivery_location");	
		//echo $this->db->last_query();
		
        $data = array();
			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$time_slot = $this->GetTimeSlote($seller_id,$row->id);
				if($time_slot[0]->id)
				$data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetDeliveryLocationByID($id,$seller_id) {
		//$seller_id	=	$_SESSION['seller_id']; 
		$this->db->where('status =', 1);		
		$this->db->where('id', $id);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_delivery_location");	
		//echo $this->db->last_query();        
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetTimeSlote($seller_id="",$delivery_location_id="") {
		//$seller_id	=	$_SESSION['seller_id']; 
		$this->db->where('status =', 1);		
		$this->db->where('seller_id', $seller_id);
		$this->db->where('delivery_location_id', $delivery_location_id);
		$this->db->order_by("fromtime", "ASC");
		$this->db->order_by("totime", "ASC");
		$query = $this->db->get("tbl_time_slot");	
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
	
	public function GetTimeSloteByOrderEndingTime($seller_id="",$delivery_location_id="",$delivery_date) {
		//$seller_id	=	$_SESSION['seller_id']; 
		$this->db->where('status =', 1);		
		$this->db->where('seller_id', $seller_id);
		$this->db->where('delivery_location_id', $delivery_location_id);
		$this->db->order_by("fromtime", "ASC");
		$this->db->order_by("totime", "ASC");
		$query = $this->db->get("tbl_time_slot");	
		//echo $this->db->last_query();
		
        $data = array();
			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$order_ending_time = $row->order_ending_time;
				$system_time = date("H:i");
				$system_date = date("d-m-Y");
				$dateTimestamp1 = strtotime($system_date);
				$dateTimestamp2 = strtotime($delivery_date);
				if($system_time<$order_ending_time || $dateTimestamp1<$dateTimestamp2){
					$data[] = $row;
				}
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetTimeSloteById($id) {
		//$seller_id	=	$_SESSION['seller_id']; 
		$this->db->where('status =', 1);		
		$this->db->where('id', $id);		
		$this->db->order_by("fromtime", "ASC");
		$this->db->order_by("totime", "ASC");
		$query = $this->db->get("tbl_time_slot");	
		//echo $this->db->last_query();
        
			if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordsBySellerMapId($id) {
		$this->db->where('id', $id);		
		$query = $this->db->get(" tbl_seller_product_map");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {				
				$data = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetSellerMapRecordsBySellerAndProductId($seller_id,$product_id) {
		$this->db->where('status', 1);		
		$this->db->where('seller_id', $seller_id);		
		$this->db->where('product_id', $product_id);		
		$query = $this->db->get("tbl_seller_product_map");
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
	
	
	public function cancel_order(){
		$order_ids	=	$this->input->post('order_ids');
			
		foreach($order_ids as $cart_id){		
			$record = $this->getProductAndOrderRecord($cart_id);
			$avl_quantity = $record->product_quantity+$record->order_quantity;
			if($record->quantity_option==1){							
				$data['date_modified']=date('Y-m-d H:i:s');
				$data['order_status']=5;						
				//$this -> db -> where('id', $cart_id);
				$this->db->where('product_id', $record->product_id);
				$this->db->where('order_id', $record->order_id);
				$this->db->update('tbl_product_order', $data);				
				$data1['quantity'] = $avl_quantity;
				if($avl_quantity==0 && $record->seller_product_status !=5){
					$data1['status'] = 0;
				}
				$this->db->where('id', $record->seller_map_id);
				$this->db->update('tbl_seller_product_map', $data1);					
				
			}else{
				$data['date_modified']=date('Y-m-d H:i:s');
				$data['order_status']=5;					
				//$this -> db -> where('id', $cart_id);
				$this->db->where('product_id', $record->product_id);
				$this->db-> where('order_id', $record->order_id);
				$this->db->update('tbl_product_order', $data);				
				$data1['quantity'] = $avl_quantity;
				$this->db->where('product_id', $record->product_id);
				$this->db->update('tbl_seller_product_map', $data1);
			}			
			$order_id = $record->order_id; 
			//echo $this->db->last_query(); exit;
		}
		return  $order_id; 
	}
	
	
	public function GetPacketBySellerProductID_17082017($seller_id="",$product_id) {

		$this->db->select('a.*,b.weight,b.unit,b.mrp,b.id as pocket_id');
		$this->db->from("tbl_seller_packet_map as a");
		$this->db->join('tbl_packet as b', 'b.id = a.packet_id', 'left');
		
		$this->db->where('a.status', 1);		
		$this->db->where('a.product_id', $product_id);	
		if($seller_id)
		$this->db->where('a.seller_id', $seller_id);	
		$this->db->order_by("b.weight", "asc");
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
	
	public function GetPacketBySellerProductID($seller_id="",$product_id) {

		$this->db->select('a.*,b.weight,b.unit,b.mrp,b.id as pocket_id');
		$this->db->from("tbl_seller_packet_map as a");
		$this->db->join('tbl_packet as b', 'b.id = a.packet_id', 'left');
		
		$this->db->where('a.status', 1);		
		$this->db->where('a.product_id', $product_id);	
		if($seller_id)
		$this->db->where('a.seller_id', $seller_id);		
		$this->db->group_by('b.id');
		$this->db->order_by("b.weight", "asc");
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
	
	
	function GetPacketByProductID($product_id)
	{
		$this->db->where('product_id', $product_id);
		$query = $this->db->get("tbl_packet");
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
	
	function getPacketRecordByMapId($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get("tbl_seller_packet_map");
		//echo $this->db->last_query(); 
		//$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row;
			}
			return $data;
		}
		return false;
	}
	
	function getPacketRecordByMapIdNew($id,$seller_id)
	{
		$this->db->where('id', $id);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_seller_packet_map");
		//echo $this->db->last_query(); 
		//$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	
	function update_product_order($id)
	{		
		$product_order_data 		=	$this->GetProductOrderById($id);
		$delivery_location_id	=	$this->input->post('delivery_location_id');
		$time_slot_id			=	$this->input->post('time_slot_id');
		
		$seller_data 				= 	$this->GetSellerRecordById($product_order_data->seller_id);
		$buyer_data 				=	$this->GetBuyerRecordById($product_order_data->buyer_id);				
		$product_data 				= 	$this->GetProductDetailsById($product_order_data->product_id);
		$seller_product_map_data 	= 	$this->GetRecordsBySellerMapId($product_order_data->product_map_id);
		$seller_packet_map_data 	= 	$this->getPacketRecordByMapId($product_order_data->packet_map_id);
		$delivery_location_data 	= 	$this->GetDeliveryLocationsById($delivery_location_id);
		$time_slot_data 			= 	$this->GetTimeSlotById($time_slot_id);
		
		
		// Seller Data
		$seller_code				=	$seller_data->seller_code;
		$seller_name				=	$seller_data->name;
		$seller_business_name		=	$seller_data->business_name;
		$seller_business_address	=	$seller_data->business_address;
		$type						=	$seller_data->type;
		
		//Buyer Data
		$buyer_name					=	$buyer_data->name;
		$buyer_business_name		=	$buyer_data->business_name;
		$buyer_email				=	$buyer_data->email;
		$buyer_address				=	$buyer_data->address;
		$buyer_mobile				=	$buyer_data->mobile;
		$buyer_pincode				=	$buyer_data->pincode;
		
		// Product Data
		$product_name				=	$product_data->name;
		$product_model_no			=	$product_data->model_no;
		$product_color				=	$product_data->color;
		$product_unit				=	$product_data->unit;
		//$product_weight				=	$product_data->weight;
		$product_size				=	$product_data->size;
		$product_tax_category		=	$product_data->tax_category;
		$product_mrp				=	$product_data->mrp;
		$product_discount			=	$product_data->discount;
		
		
		//Seller Product Map Data		
		$product_offer				=	$seller_product_map_data->offer;
		$product_offer_code			=	$seller_product_map_data->offer_code;
		
		if($product_order_data->packet_map_id>0){
			$product_price				=	$seller_packet_map_data->price;
			$packet_record     			=	$this->GetPacketById($seller_packet_map_data->packet_id);
			$product_weight				=	$packet_record->weight;
		}else{
			$product_price				=	$seller_product_map_data->price;
			$product_weight				=	$product_data->weight;
		}
		
		
		// Delivery Location Data
		$delivery_location				=	$delivery_location_data->delivery_location;		
		
		// Time Slot Data
		$totime					=	$time_slot_data->totime;
		$fromtime				=	$time_slot_data->fromtime;
		$order_ending_time		=	$time_slot_data->order_ending_time;
		$maximum_no_of_order	=	$time_slot_data->maximum_no_of_order;
		
		
		$data['seller_code']				=	$seller_code;
		$data['seller_name']				=	$seller_name;
		$data['seller_business_name']		=	$seller_business_name;
		$data['seller_business_address']	=	$seller_business_address;
		$data['type']						=	$type;
		$data['buyer_name']					=	$buyer_name;
		$data['buyer_business_name']		=	$buyer_business_name;
		$data['buyer_email']				=	$buyer_email;
		$data['buyer_address']				=	$buyer_address;
		$data['buyer_mobile']				=	$buyer_mobile;
		$data['buyer_pincode']				=	$buyer_pincode;
		$data['product_name']				=	$product_name;
		$data['product_model_no']			=	$product_model_no;
		$data['product_color']				=	$product_color;
		$data['product_unit']				=	$product_unit;
		$data['product_weight']				=	$product_weight;
		$data['product_size']				=	$product_size;
		$data['product_tax_category']		=	$product_tax_category;
		$data['product_mrp']				=	$product_mrp;
		$data['product_discount']			=	$product_discount;
		$data['product_offer']				=	$product_offer;
		$data['product_offer_code']			=	$product_offer_code;
		$data['product_price']				=	$product_price;
		$data['delivery_location']			=	$delivery_location;
		$data['totime']						=	$totime;
		$data['fromtime']					=	$fromtime;
		$data['order_ending_time']			=	$order_ending_time;
		$data['maximum_no_of_order']		=	$maximum_no_of_order;
		
		$this -> db -> where('id', $id);
		$this->db->update('tbl_product_order', $data); 
		//echo $this->db->last_query(); 
	}
	
	
	public function GetProductOrderById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function GetProductDetailsById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_product");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function GetDeliveryLocationsById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_delivery_location");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function GetProductOffer($id) { 
		$this->db->select('a.*,a.name as product_name,f.id as product_map_id,f.quantity_option,f.quantity,f.offer,f.price,g.name as seller_name,g.business_name,g.seller_code,e.name as brand_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->join('tbl_seller_product_map as f', 'f.product_id = a.id', 'left');
		$this->db->join('tbl_seller_registration as g', 'g.id = f.seller_id', 'left');
		//$this->db->join('tbl_brand_department_map as g', 'g.brand_id = e.id', 'left');
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status', 1);
		$this->db->where('f.status', 1);
		$this->db->where('g.status', 1);
	
		$this->db->where('f.id', $id);
		
		$this->db->group_by('a.id');	
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		/*echo "<!---";
		echo $this->db->last_query();
		echo "---->"; */ 
		
        $data = array();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$row->packet = $this->GetPacketBySellerProductID($seller_id,$row->id);
				if($row->packet[0]->id!=""){
					if($row->packet[0]->quantity_option==1)
					{
						if($row->packet[0]->quantity>0)						
							$data = $row;					
					}else{					
						$data = $row;
					}
					//$data[] = $row;					
				}else{				
					if($row->quantity_option==1)
					{
						if($row->quantity>0)						
							$data = $row;					
					}else{					
						$data = $row;
					}
				}
            }
            return $data;
        }
        return false;		
    }
	
	
	public function GetTimeSlotById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_time_slot");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function GetPacketById($id) {    
		$this->db->where('id', $id);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_packet");
		//echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row){
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	
	public function getProductQuantityCart($product_id="",$seller_id="") {  
		$this->db->select_sum('quantity');
		$this->db->where('product_map_id', $product_id);	
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('order_status', 1);	
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	public function getPacketQuantityCart($packet_map_id="",$seller_id="") {  
		$this->db->select_sum('quantity');
		$this->db->where('packet_map_id', $packet_map_id);	
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('order_status', 1);	
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data = $row;
				}
				return $data;
			}
        return false;
    }
	
	
	public function getCartRecordSellerBuyer($seller_id="",$buyer_id="") {  
		$this->db->where('seller_id', $seller_id);	
		$this->db->where('buyer_id', $buyer_id);	
		$this->db->where('order_status', 1);	
		$query = $this->db->get("tbl_product_order");
		//echo $this->db->last_query(); 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
        return false;
    }
	
	
}