<?php
class Section_model extends CI_Model {
    
	private $path = 'public/uploads/section/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRecords($seller_id) {
		$this->db->where('status', 1);		
		$this->db->order_by('id DESC');		
		$query = $this->db->get("tbl_section");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->category_record  =  $this->getCategory($row->id,$seller_id);
				if($row->category_record[0]->id!='')
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function GetHomeRecords($seller_id="") {
		$this->db->where('status', 1);		
		$this->db->where('home_status', 1);		
		$this->db->order_by('id DESC');		
		$query = $this->db->get("tbl_section");
		//echo $this->db->last_query();
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->category_record  =  $this->getCategory($row->id,$seller_id);
				if($row->category_record[0]->id!='')
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	public function getCategory($section_id,$seller_id) {
        $this->db->where('parent_id', 0);
		$this->db->where('status', 1);
		$this->db->where('section_id', $section_id);
		$query = $this->db->get("tbl_category");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
				$row->subcategory_record  =  $this->getSubCategory($row->id,$seller_id);
				if($row->subcategory_record[0]->id!='')
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function getSubCategory($category_id,$seller_id) {
  		$this->db->select('distinct(b.name),b.*,f.seller_id');
		//$this->db->from("tbl_category as a");
		//$this->db->join('tbl_product as b', 'b.category_id = a.id', 'left');
		//$this->db->join('tbl_seller_product_map as c', 'c.product_id = a.id', 'left');
		//$this->db->join('tbl_seller_sub_category_map as b', 'b.category_id = a.id', 'left');
		
		$this->db->from("tbl_product as a");
		$this->db->join('tbl_category as b', 'a.category_id = b.id', 'left');
		$this->db->join('tbl_category as c', 'b.parent_id = c.id', 'left');		
		$this->db->join('tbl_section as d', 'd.id = c.section_id', 'left');	
		$this->db->join('tbl_brand as e', 'e.id = a.brand_id','left');
		$this->db->join('tbl_seller_product_map as f', 'a.id = f.product_id', 'left');
		
		
				
		$this->db->where('b.parent_id !=', 0);
		$this->db->where('b.parent_id', $category_id);
		if($seller_id)
		$this->db->where('f.seller_id', $seller_id);
		
		$this->db->where('a.status', 1);
		$this->db->where('b.status', 1);
		$this->db->where('c.status', 1);
		$this->db->where('d.status', 1);
		$this->db->where('e.status', 1);
		$this->db->where('f.status', 1);
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordsByCode($code) {
		$this->db->where('status', 1);		
		$this->db->where('code', $code);	
        $query = $this->db->get("tbl_section");	
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