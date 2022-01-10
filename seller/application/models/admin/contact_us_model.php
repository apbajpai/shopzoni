<?php
class Contact_Us_model extends CI_Model {
    
	private $path = 'public/uploads/brand/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');			
		$name  =  trim($this->input->post('name'));
		if($name != '')			
		$this->db->like('name', $name);
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('email', $email);
		$query = $this->db->get("tbl_contact_us");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('name', $name);
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('email', $email);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_contact_us");
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