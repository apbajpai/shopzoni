<?php
class Registration_model extends CI_Model {
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_registration");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$this->db->order_by('registrationID DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_registration");
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
	
}