<?php
class Holiday_model extends CI_Model {
    
	private $path = 'public/uploads/holiday/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {			
		$this->db->select('count(*) as total');			
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);	
		$query = $this->db->get("tbl_holiday");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->where('seller_id', $seller_id);
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_holiday");
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
	
	public function GetRecordsControl() {
		$this->db->where('status', 1);
		$query = $this->db->get("tbl_holiday");
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
				$query = $this->db->get("tbl_holiday");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function GetRecordBySellerId($id) {
		$seller_id = $this->session->userdata('seller_id');
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
	
	public function save_holiday($image=null) {
		$id 		= 	$this->input->post('id');
		$sunday 	= 	$this->input->post('sunday');
		$monday 	= 	$this->input->post('monday');
		$tuesday 	= 	$this->input->post('tuesday');		
		$wednesday 	= 	$this->input->post('wednesday');
		$thursday 	= 	$this->input->post('thursday');
		$friday 	= 	$this->input->post('friday');
		$saturday 	= 	$this->input->post('saturday');
		$seller_id 	= 	$this->input->post('seller_id');
				
		$created_by = $this->session->userdata('adminid');
		
		$total = $this->GetTotalRecordSellerWise();
		
		
		$data = array(
					'sunday'	=>	$sunday ,
					'monday'	=>	$monday,	
					'tuesday'	=>	$tuesday,	
					'wednesday'	=>	$wednesday,	
					'thursday'	=>	$thursday,	
					'friday'	=>	$friday,	
					'saturday'	=>	$saturday,	
					'seller_id'	=>	$seller_id
					);
		if($total>0)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$this->db->where('seller_id', $seller_id);
			$this->db->update('tbl_holiday', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_holiday',$data); 
			$id = $this->db->insert_id();
			$this->db->where('id', $id);
			$this->db->update('tbl_holiday', $data); 
		}
		return true;
	}
	

	function upload1($fieldname)
	{
		$config['upload_path'] = $this->path;
		if (!is_dir($this->path))
		{
			mkdir($this->path, 0777);
		}
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2000';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['encrypt_name'] = true;
		$config['max_width']  = '';
		$config['max_height']  = '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);            
		
		if (!$this->upload->do_upload($fieldname)){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$upload_data = $this->upload->data();
			return $upload_data['file_name'];		
		}							
	}	
	
	public function GetTotalRecordSellerWise() {
		$seller_id = $this->session->userdata('seller_id');
		$this->db->select('count(*) as total');			
		$this->db->where('seller_id', $seller_id);			
		$query = $this->db->get("tbl_holiday");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
}