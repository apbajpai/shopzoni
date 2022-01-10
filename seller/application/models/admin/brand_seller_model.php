<?php
class Brand_Seller_model extends CI_Model {
    
	private $path = 'public/uploads/product/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function GetTotalRecord() {	
		$brand_id = $this->input->post('brand_id');
		
		$this->db->select('a.*,b.name as category_name,c.name as parent_name,d.name as sectin_name,f.name as brand_name,e.price,e.id as seller_map_id,e.status as seller_map_status,g.business_name');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');		
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');	
		$this->db->join('tbl_seller_registration as g', 'g.id = e.seller_id', 'left');
			
			
			$this->db->where('e.status !=', 5);
			$this->db->where('a.status', 1);
			$this->db->where('a.status', 1);	
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			
		$this->db->where('f.status', 1);

		if($brand_id!="")
		$this->db->where('a.brand_id',$brand_id);		
		
		$this->db->order_by("a.id", "desc");
		$this->db->group_by("e.seller_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total=$query->num_rows();
        }        
		return 0;
    }
	
	
	public function GetRecords($start=0, $limit=10) {		
		$brand_id = $this->input->post('brand_id');
		
		$this->db->select('f.name as brand_name,g.*');
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');		
		$this->db->join('tbl_seller_product_map as e', 'a.id = e.product_id', 'left');
		$this->db->join('tbl_brand as f', 'f.id = a.brand_id', 'left');	
		$this->db->join('tbl_seller_registration as g', 'g.id = e.seller_id', 'left');
			
			
			$this->db->where('e.status !=', 5);
			$this->db->where('a.status', 1);
			$this->db->where('a.status', 1);	
			$this->db->where('b.status', 1);
			$this->db->where('c.status', 1);
			$this->db->where('d.status', 1);
			
		

			
		$this->db->where('f.status', 1);		

		if($brand_id!="")
		$this->db->where('a.brand_id',$brand_id);
	
		$this->db->limit($limit,$start);
		$this->db->order_by("a.id", "desc");
		$this->db->group_by("e.seller_id");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); 

		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				//$row->image = $this->GetImageByProductID($row->id);
				//$row->packet = $this->GetSellerPacketByProductID($seller_id,$row->id);
				$data[] = $row;
			}
			return $data;
		}
		return false;
    }
	
	
	
	
}