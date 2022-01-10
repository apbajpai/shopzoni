<?php
class Seller_Terms_Conditions_model extends CI_Model {
    
	private $path = 'public/uploads/terms_conditions/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
				$query = $this->db->get("terms_conditions");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function GetRecordBySellerId() {
		$seller_id = $this->session->userdata('seller_id');
        $this->db->where('seller_id', $seller_id);
				$query = $this->db->get("terms_conditions");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	
	
	public function GetTotalRecord() {
		$this->db->select('a.*,b.name as seller_name,b.business_name');
		$this->db->from("terms_conditions_history as a");		
		$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');
		
		$seller_id = $this->input->post('seller_id');
		if($seller_id != '')
		$this->db->where('a.seller_id', $seller_id);		
		
        $query = $this->db->get();	
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total=$query->num_rows();
        }        
		return 0;
    }
	
	
	public function GetRecords($start=0, $limit=10) {		
		$this->db->select('a.*,b.name as seller_name,b.business_name');
		$this->db->from("terms_conditions_history as a");		
		$this->db->join('tbl_seller_registration as b', 'a.seller_id = b.id', 'left');
		
		$seller_id = $this->input->post('seller_id');
		if($seller_id != ''){
		$this->db->where('a.seller_id', $seller_id);		
		}else{
		$this->db->limit($limit,$start);
		}
		$this->db->order_by("a.id", "DESC");
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