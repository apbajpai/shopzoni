<?php
class Brand_Details_model extends CI_Model {
    
	private $path = 'public/uploads/brand_details/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$brand_id = $this->session->userdata('brand_id');
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get("tbl_brand_details");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$brand_id = $this->session->userdata('brand_id');
		$this->db->where('status !=', 5);
		$this->db->where('brand_id', $brand_id);
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_brand_details");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
	
	public function GetRecordById($id) {
        $this->db->where('id', $id);
		$query = $this->db->get("tbl_brand_details");
		//echo $this->db->last_query(); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	
	public function save_brand_details_data($image=null) {
		$id = $this->input->post('id');		
		$description = $this->input->post('description');
		$status = $this->input->post('status');
		
		$created_by = $this->session->userdata('adminid');
		$brand_id = $this->session->userdata('brand_id');
		$date_published = $this->input->post('date_published');			
		
		$data = array(									
					'brand_id'=>$brand_id,	
					'description'=>$description,	
					'created_by'=>$created_by,					
					'status'=>$status
				);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');			
			$this->db->where('id', $id);
			$this->db->update('tbl_brand_details', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_brand_details',$data); 			
			$id = $this->db->insert_id();
		}
		return true;
		
	}
	
}