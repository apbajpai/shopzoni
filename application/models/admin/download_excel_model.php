<?php
class Download_Excel_model extends CI_Model {
    
	private $path = 'public/uploads/download_excel/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');	
		$this->db->where('status !=', 5);
		$user_id = $this->session->userdata('adminid');
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);		
		$query = $this->db->get("tbl_minimum_order");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$user_id = $this->session->userdata('adminid');
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_minimum_order");
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
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_minimum_order");
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
				$query = $this->db->get("tbl_minimum_order");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_minimum_order_data($image=null) {
		$id = $this->input->post('id');
		$minimum_order_amount = $this->input->post('minimum_order_amount');		
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		$data = array(
					'minimum_order_amount'=>$minimum_order_amount ,					
					'status'=>$status,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');				
			$this->db->where('id', $id);
			$this->db->update('tbl_minimum_order', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_minimum_order',$data); 
			$id = $this->db->insert_id();					
			$this->db->where('id', $id);
			$this->db->update('tbl_minimum_order', $data); 
		}
		return true;
	}

	
}