<?php
class Email_History_model extends CI_Model {
    
	private $path = 'public/uploads/address_book/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');	
		$this->db->where('seller_id', $seller_id);
		
		$to  =  trim($this->input->post('to'));
		$from  =  trim($this->input->post('from'));
		if($to != '')
		$this->db->like('to', $to);
		if($from != '')
		$this->db->like('from', $from);
		$query = $this->db->get("tbl_email_history");	
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		if($this->session->userdata('arole') == '2'){
			$seller_id = $this->session->userdata('seller_id');
			$this->db->where('seller_id', $seller_id);
		}
		
		$to  =  trim($this->input->post('to'));
		$from  =  trim($this->input->post('from'));
		if($to != '')
		$this->db->like('to', $to);
		if($from != '')
		$this->db->like('from', $from);
		
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_email_history");	
		//echo $this->db->last_query(); 
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
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_email_history");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
}