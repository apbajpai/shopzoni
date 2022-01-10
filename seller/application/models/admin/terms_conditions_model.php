<?php
class Terms_Conditions_model extends CI_Model {
    
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
        //$this->db->order_by('id DESC');
		$query = $this->db->get("terms_conditions");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_terms_conditions_data() {
		
		$id = $this->input->post('id');
		$description = $this->input->post('description');
		$seller_id = $this->session->userdata('seller_id');
		
		$data = array(
					'description'=>$description ,					
					'seller_id'=>$seller_id
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');			
			$this->db->where('id', $id);
			$this->db->update('terms_conditions', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('terms_conditions',$data); 
			$id = $this->db->insert_id();				
			$this->db->where('id', $id);
			$this->db->update('terms_conditions', $data); 
		}		
		$this->db->insert('terms_conditions_history',$data); 
		//echo $this->db->last_query(); exit;
		
		return true;		
	}

		
}