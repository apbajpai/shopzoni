<?php
class Seller_product_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function GetTotalRecord() {
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$seller_id = $this->input->post('seller_id');
		$brand_id = $this->input->post('brand_id');
		
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,f.name as brand_name,e.price,e.id as seller_map_id,e.status as seller_map_status,g.business_name,g.type');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');		
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');	
		$this->db->join('tbl_seller_registration as g', 'g.id = e.seller_id', 'left');
			
			
			$this->db->where('e.status !=', 5);
			$this->db->where('a.status', 1);				
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			$this->db->where('g.status', 1);
			$this->db->where('f.status', 1);
		
		
		
		$this->db->where('e.seller_id', $seller_id);
		if($sub_category_id!="")
		$this->db->where('a.category_id',$sub_category_id);	
		
		if($category_id!="")
		$this->db->where('c.id',$category_id);	

		if($brand_id!="")
		$this->db->where('a.brand_id',$brand_id);
		
		if($name != '')
		$this->db->like('a.name', $name);
	
		if($type != '')
		$this->db->where('g.type', $type);	
		
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total=$query->num_rows();
        }        
		return 0;
    }
	
	
	public function GetRecords($start=0, $limit=10) {	
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$seller_id = $this->input->post('seller_id');
		$brand_id = $this->input->post('brand_id');
		
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,f.name as brand_name,e.price,e.id as seller_map_id,e.status as seller_map_status,g.business_name,g.seller_code,g.type');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');		
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');	
		$this->db->join('tbl_seller_registration as g', 'g.id = e.seller_id', 'left');
			
			
			$this->db->where('e.status !=', 5);
			$this->db->where('a.status', 1);				
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			$this->db->where('g.status', 1);
			$this->db->where('f.status', 1);		
		
		if($seller_id)
		$this->db->where('e.seller_id', $seller_id);
		if($sub_category_id!="")
		$this->db->where('a.category_id',$sub_category_id);	
		
		if($category_id!="")
		$this->db->where('c.id',$category_id);	

		if($brand_id!="")
		$this->db->where('a.brand_id',$brand_id);
		
		if($name != '')
		$this->db->like('a.name', $name);
	
		if($type != '')
		$this->db->where('g.type', $type);
		
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); 

		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->image = $this->GetImageByProductID($row->id);
				$row->packet = $this->GetSellerPacketByProductID($seller_id,$row->id);
				$data[] = $row;
			}
			return $data;
		}
		return false;
    }
	
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
				$query = $this->db->get("tbl_product");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function sell_yours() {
		$product_id	=	$this->input->post('product_id');		
		$seller_id	= $this->session->userdata('seller_id');
		$sell_your_data = $this->check_sell_yours_data($product_id,$seller_id);
		if($sell_your_data->id==""){
			$data = array(					
						'product_id'=>$product_id,					
						'seller_id'=>$seller_id,
						);		
				$data['date_created']=date('Y-m-d H:i:s');
				$this->db->insert('tbl_sell_yours',$data); 
				//echo $this->db->last_query();
			return true;
		}else{
			return false;
		}
	}
	
	
	public function check_sell_yours_data($product_id,$seller_id) {
        $this->db->where('product_id', $product_id);
		$this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_sell_yours");
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
	
	
	public function GetSellerPacketByProductID($seller_id,$product_id) {

		$this->db->select('a.*,b.weight,b.unit,b.mrp,b.id as pocket_id');
		$this->db->from("tbl_seller_packet_map as a");
		$this->db->join('tbl_packet as b', 'b.id = a.packet_id', 'left');
		
		$this->db->where('a.status', 1);		
		$this->db->where('a.product_id', $product_id);	
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