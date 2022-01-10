<?php
class Query_model extends CI_Model {
    
	private $path = 'public/uploads/query/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_query as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
		
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {

		$this->db->select('a.*,b.name,b.business_name,b.email,b.mobile');
		$this->db->from("tbl_query as a");
		$this->db->join('tbl_user as b', 'a.user_id = b.id', 'left');	
		
		$name  =  trim($this->input->post('name'));
		if($name != '')		
		$this->db->like('b.name', $name);
		
		$email  =  trim($this->input->post('email'));
		if($email != '')			
		$this->db->where('b.email', $email);
		
		$this->db->order_by('a.id DESC');
		$this->db->limit($limit,$start);
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