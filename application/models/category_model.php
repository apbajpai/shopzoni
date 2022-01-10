<?php
class Category_model extends CI_Model {
    
	private $path = 'public/uploads/product_category/';
    
	function __construct(){
		parent::__construct();
		session_start();
		$this->load->database();
	}
	
		
	public function getCategory() {
        $this->db->where('parent_id', 0);
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_category");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function getSubCategory() {
		$this->db->select('a.*,b.seller_id');
		$this->db->from("tbl_category as a");
		$this->db->join('tbl_seller_sub_category_map as b', 'b.category_id = a.id', 'left');
		$this->db->where('b.seller_id', $_SESSION['seller_id']);
		$this->db->where('a.parent_id !=', 0);		
		$this->db->where('a.status', 1);
		$query = $this->db->get();		
		
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){				
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }	
	
	public function getSubCategoryByCategory($category_id) {
        $this->db->select('a.*,b.seller_id');
		$this->db->from("tbl_category as a");
		$this->db->join('tbl_seller_sub_category_map as b', 'b.category_id = a.id', 'left');
		$this->db->where('a.parent_id',$category_id);
		$this->db->where('b.seller_id', $_SESSION['seller_id']);
		$this->db->where('a.status', 1);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
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
        $query = $this->db->get("tbl_category");	
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