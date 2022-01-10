<?php
class Holiday_model extends CI_Model {
    
	private $path = 'public/uploads/holiday/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	
	
	public function GetRecordBySellerId($seller_id) {
		
        $this->db->where('seller_id', $seller_id);
		$query = $this->db->get("tbl_holiday");
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