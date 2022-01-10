<?php
class Offer_model extends CI_Model {
    
	private $path = 'public/uploads/offer/';
    
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function GetTotalRecord() {	
		$this->db->select('count(*) as total');		
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);
		if($name != '')
		$this->db->where('name', $name);
		$query = $this->db->get("tbl_offer");
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result();
			return $data[0]->total;
        }        
		return 0;
    }
	
	public function GetRecords($start=0, $limit=10) {
		$this->db->where('status !=', 5);
		$name  =  trim($this->input->post('name'));
		$user_id = $this->session->userdata('adminid');
		$user_record = $this->admin_model->GetRecordById($user_id);
		
		if($user_record->role == 2)
		$this->db->where('created_by', $user_id);		
		if($name != '')
		$this->db->where('name', $name);
		
		$this->db->order_by('id DESC');
		$this->db->limit($limit,$start);
		$query = $this->db->get("tbl_offer");
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
		$query = $this->db->get("tbl_offer");
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
				$query = $this->db->get("tbl_offer");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function save_offer_data($image=null) {
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$cash_back = $this->input->post('cash_back');
		$slug = GetSlug($this->input->post('name'));
		$status = $this->input->post('status');				
		$created_by = $this->session->userdata('adminid');
		
		$data = array(
					'name'=>$name,
					'start_date'=>$start_date,
					'end_date'=>$end_date,
					'cash_back'=>$cash_back,
					'slug'=>$slug,	
					'status'=>$status,
					'created_by'=>$created_by
					);
		if($id)			
		{
			$data['date_modified']=date('Y-m-d H:i:s');
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_offer', $data); 
		}
		else
		{
			$data['date_created']=date('Y-m-d H:i:s');
			$this->db->insert('tbl_offer',$data); 
			$id = $this->db->insert_id();
			$data['code'] = GetCode($name, $id);			
			$this->db->where('id', $id);
			$this->db->update('tbl_offer', $data); 
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
}