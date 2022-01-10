<?php
class Department_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$this->db->order_by('name ASC');
		//$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_department");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$row->parent_name = '';
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	// Get Department when brand with product will appear in particular Department 
	public function GetDepartmentRecordswithBrandProducts(){							
		$this->db->select('distinct(a.id),a.*');
		$this->db->from("tbl_department as a");
		$this->db->join('tbl_brand_department_map as b', 'b.department_id  = a.id', 'LEFT');	
		$this->db->join('tbl_brand as d', 'b.brand_id  = d.id', 'LEFT');	
		$this->db->join('tbl_product as c', 'c.brand_id = d.id','LEFT');
		
		$this->db->where_in('b.department_id', $department_ids);
		$this->db->where('a.status !=', 5);		
		$this->db->where('d.status !=', 5);	
		$this->db->where('d.status !=', 0);	
		$this->db->where('c.status !=', 5);	
		$this->db->where('c.status !=', 0);	
		$this->db->where('b.status !=', 0);	
		$this->db->order_by("a.id", "desc");
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); exit;
	
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