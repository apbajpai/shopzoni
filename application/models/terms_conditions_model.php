<?php
class Terms_Conditions_model extends CI_Model {
    
	private $path = 'public/uploads/terms_conditions/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	public function GetRecordBySellerId() {
		$seller_id = $_SESSION['seller_id'];
        $this->db->where('seller_id', $seller_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("terms_conditions");
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
	
	public function GetRecordBySellerId1($seller_id) {		
        $this->db->where('seller_id', $seller_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get("terms_conditions");
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